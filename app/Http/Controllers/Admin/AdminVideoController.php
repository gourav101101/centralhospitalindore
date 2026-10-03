<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
class AdminVideoController extends Controller
{
    public function index() { return view('admin.videos.index', ['videos' => Video::ordered()->paginate(15)]); }
    public function create() { return view('admin.videos.form', ['video' => new Video]); }
    public function store(Request $request) {
        Video::create($this->data($request));
        return redirect()->route('admin.videos.index')->with('success', 'Video added.');
    }
    public function edit(Video $video) { return view('admin.videos.form', compact('video')); }
    public function update(Request $request, Video $video) {
        $video->update($this->data($request));
        return redirect()->route('admin.videos.index')->with('success', 'Video updated.');
    }
    public function destroy(Video $video) {
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video removed.');
    }
    private function data(Request $request): array {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => ['required', 'string', 'max:2000', function ($attribute, $value, $fail) {
                if (Video::idFromUrl($value) === null) { $fail('Enter a valid YouTube video, Shorts, or share URL.'); }
            }],
            'description' => 'nullable|string|max:2000',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0|max:100000',
        ]);
        $data['youtube_id'] = Video::idFromUrl($data['youtube_url']);
        unset($data['youtube_url']);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] ??= 0;
        return $data;
    }
}
