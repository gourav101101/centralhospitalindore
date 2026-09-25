<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminBlogController extends Controller
{
    /**
     * Display listing of blogs.
     */
    public function index(Request $request)
    {
        $query = Blog::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('tag', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $blogs = $query->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.blogs.form', ['blog' => new Blog]);
    }

    /**
     * Store a new blog.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'author' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDirectory = $this->webUploadPath('uploads/blogs');
            File::ensureDirectoryExists($uploadDirectory);
            $filename = $image->hashName();
            $image->move($uploadDirectory, $filename);
            $validated['image'] = 'uploads/blogs/'.$filename;
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at'] ?? ($validated['is_published'] ? now() : null);

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Show edit form.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    /**
     * Update blog.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,'.$blog->id,
            'author' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDirectory = $this->webUploadPath('uploads/blogs');
            File::ensureDirectoryExists($uploadDirectory);
            $filename = $image->hashName();
            $image->move($uploadDirectory, $filename);
            $validated['image'] = 'uploads/blogs/'.$filename;
        }

        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published'] && ! $blog->published_at) {
            $validated['published_at'] = $validated['published_at'] ?? now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete blog.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    private function webUploadPath(string $relativePath): string
    {
        return rtrim(config('filesystems.web_root'), DIRECTORY_SEPARATOR)
            .DIRECTORY_SEPARATOR.ltrim($relativePath, DIRECTORY_SEPARATOR);
    }
}
