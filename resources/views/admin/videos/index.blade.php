@extends('admin.layouts.app')
@section('page-title', 'YouTube videos')
@section('content')
<div class="page-head"><div><h2>YouTube videos</h2><p>Visible videos appear on the Videos page. The first three also appear on the homepage.</p></div><a class="button" href="{{ route('admin.videos.create') }}">Add video</a></div>
@if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
<div class="panel table-wrap"><table class="table"><thead><tr><th>Video</th><th>Order</th><th>Visibility</th><th>Actions</th></tr></thead><tbody>
@forelse($videos as $video)<tr><td><strong>{{ $video->title }}</strong><a href="{{ $video->youtube_url }}" target="_blank" rel="noopener">Watch on YouTube</a></td><td>{{ $video->sort_order }}</td><td>{{ $video->is_active ? 'Visible' : 'Hidden' }}</td><td><a class="button button-muted" href="{{ route('admin.videos.edit', $video) }}">Edit</a><form style="display:inline" method="post" action="{{ route('admin.videos.destroy', $video) }}" onsubmit="return confirm('Remove this video from the website?')">@csrf @method('DELETE')<button class="button">Remove</button></form></td></tr>
@empty<tr><td colspan="4">No videos yet. Add a YouTube link to get started.</td></tr>@endforelse
</tbody></table></div>{{ $videos->links() }}
<a href="{{ route('videos') }}" target="_blank" rel="noopener">View website videos</a>
@endsection
