@extends('admin.layouts.app')
@section('title', $gallery->exists ? 'Edit Image - Gallery' : 'Add Image - Gallery')
@section('page-title', $gallery->exists ? 'Edit Image' : 'Add Image')
@section('breadcrumb')
  <a href="{{ route('admin.gallery.index') }}" style="color:var(--blue);text-decoration:none">Gallery</a> / {{ $gallery->exists ? 'Edit' : 'Add' }}
@endsection

@section('content')
  <div class="card" style="max-width:600px">
    <form action="{{ $gallery->exists ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      @if($gallery->exists) @method('put') @endif

      <div class="detail-grid" style="grid-template-columns:1fr">
        <div class="detail-item">
          <label>Image Upload <span style="color:red">*</span> (JPG/PNG, Max 3MB)</label>
          <input type="file" name="image" class="form-control" accept="image/*" {{ $gallery->exists ? '' : 'required' }} style="width:100%">
          @error('image') <div style="color:red;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
          @if($gallery->exists && $gallery->image)
            <div style="margin-top:10px">
              <img src="{{ asset('storage/' . $gallery->image) }}" alt="Current Image" style="height:120px;border-radius:6px;border:1px solid var(--border)">
            </div>
          @endif
        </div>

        <div class="detail-item">
          <label>Caption (Optional)</label>
          <input type="text" name="caption" class="form-control" value="{{ old('caption', $gallery->caption) }}" style="width:100%" placeholder="e.g. Hospital Main Building">
          @error('caption') <div style="color:red;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>

        <div class="detail-item" style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
          <div>
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}" style="width:100%" min="0">
          </div>
          <div>
            <label>Status</label>
            <div style="padding-top:8px">
              <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;color:var(--text);font-size:14px">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $gallery->is_active ?? true) ? 'checked' : '' }}>
                Active (Show on website)
              </label>
            </div>
          </div>
        </div>
      </div>

      <div style="margin-top:24px;padding-top:20px;border-top:1px solid var(--border);display:flex;gap:10px">
        <button type="submit" class="button" style="padding:9px 18px">Save Image</button>
        <a href="{{ route('admin.gallery.index') }}" class="button-muted" style="padding:9px 18px">Cancel</a>
      </div>
    </form>
  </div>
@endsection
