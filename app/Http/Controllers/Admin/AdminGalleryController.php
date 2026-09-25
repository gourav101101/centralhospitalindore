<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminGalleryController extends Controller
{
    /**
     * Display listing of gallery images.
     */
    public function index(Request $request)
    {
        $query = Gallery::ordered();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('caption', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $images = $query->paginate(15);
        return view('admin.gallery.index', compact('images'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.gallery.form', ['gallery' => new Gallery]);
    }

    /**
     * Store a new gallery image.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $dir = public_path('storage/gallery');
            File::ensureDirectoryExists($dir);
            $filename = $request->file('image')->hashName();
            $request->file('image')->move($dir, $filename);
            $validated['image'] = 'gallery/'.$filename;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Image added to gallery.');
    }

    /**
     * Show edit form.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.form', compact('gallery'));
    }

    /**
     * Update gallery image.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $dir = public_path('storage/gallery');
            File::ensureDirectoryExists($dir);
            $filename = $request->file('image')->hashName();
            $request->file('image')->move($dir, $filename);
            $validated['image'] = 'gallery/'.$filename;
        }

        $validated['is_active'] = $request->boolean('is_active');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated.');
    }

    /**
     * Delete gallery image.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted.');
    }
}
