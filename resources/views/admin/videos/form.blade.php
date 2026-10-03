@extends('admin.layouts.app')
@section('page-title', $video->exists ? 'Edit video' : 'Add video')
@section('content')
<div class="page-head"><h2>{{ $video->exists ? 'Edit video' : 'Add video' }}</h2><a href="{{ route('admin.videos.index') }}" class="button button-muted">Back</a></div>
<form class="panel" method="post" action="{{ $video->exists ? route('admin.videos.update', $video) : route('admin.videos.store') }}">@csrf @if($video->exists) @method('PUT') @endif
<div class="detail-grid">
<div class="detail-item"><label for="title">Title</label><input id="title" class="form-control" name="title" value="{{ old('title', $video->title) }}" maxlength="255" required></div>
<div class="detail-item"><label for="youtube_url">YouTube video URL</label><input id="youtube_url" type="url" class="form-control" name="youtube_url" value="{{ old('youtube_url', $video->exists ? $video->youtube_url : '') }}" required><small>Paste a YouTube watch, share, Shorts, or live-video link. The video must allow embedding.</small></div>
<div class="detail-item"><label for="description">Description (optional)</label><textarea id="description" class="form-control notes" name="description" maxlength="2000">{{ old('description', $video->description) }}</textarea></div>
<div class="detail-item"><label for="sort_order">Display order</label><input id="sort_order" type="number" class="form-control" name="sort_order" min="0" max="100000" value="{{ old('sort_order', $video->sort_order ?? 0) }}"><small>Lower numbers appear first.</small></div>
</div><input type="hidden" name="is_active" value="0"><label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $video->is_active ?? false))> Show on website</label>
<div style="margin-top:20px"><button class="button">Save video</button></div></form>
@endsection
