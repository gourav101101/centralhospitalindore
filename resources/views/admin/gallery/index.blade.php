@extends('admin.layouts.app')
@section('title', 'Gallery - Admin')
@section('page-title', 'Gallery')
@section('breadcrumb', 'Manage website gallery')

@section('content')
  @if(session('success'))
    <div class="notice">{{ session('success') }}</div>
  @endif

  <div class="page-head">
    <div>
      <form class="filters" method="get">
        <input type="text" name="search" placeholder="Search caption..." value="{{ request('search') }}">
        <select name="status">
          <option value="">All statuses</option>
          <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="button">Filter</button>
      </form>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="button">+ Add Image</a>
  </div>

  <div class="card">
    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Caption</th>
            <th>Sort Order</th>
            <th>Status</th>
            <th style="text-align:right">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($images as $image)
            <tr>
              <td>
                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image" style="width:80px;height:60px;object-fit:cover;border-radius:4px;border:1px solid var(--border)">
              </td>
              <td style="font-weight:600">{{ $image->caption ?: '—' }}</td>
              <td>{{ $image->sort_order }}</td>
              <td><span class="pill {{ $image->is_active ? 'success' : 'danger' }}">{{ $image->is_active ? 'Active' : 'Inactive' }}</span></td>
              <td style="text-align:right;white-space:nowrap">
                <a href="{{ route('admin.gallery.edit', $image) }}" class="button-muted" style="padding:4px 8px;font-size:12px;margin-right:5px">Edit</a>
                <form action="{{ route('admin.gallery.destroy', $image) }}" method="post" style="display:inline-block" onsubmit="return confirm('Delete this image?')">
                  @csrf @method('delete')
                  <button type="submit" class="button-muted" style="padding:4px 8px;font-size:12px;color:var(--danger)">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="empty" style="text-align:center">No gallery images found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($images->hasPages())
      <div style="margin-top:20px;padding-top:20px;border-top:1px solid var(--border)">
        {{ $images->links() }}
      </div>
    @endif
  </div>
@endsection
