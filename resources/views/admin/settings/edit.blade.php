@extends('admin.layouts.app')
@section('title', 'Site Settings | Central Hospital Indore Admin')
@section('page-title', 'Site Settings')
@section('breadcrumb', 'Central Hospital Indore Admin | Global Settings')

@section('content')
  @if(session('success'))
    <div class="notice">{{ session('success') }}</div>
  @endif

  <div class="page-head">
    <div>
      <h2>Global Settings</h2>
      <p>Changes made here instantly reflect on the public website.</p>
    </div>
  </div>

  <form class="panel" method="post" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')

    <h3 style="margin-bottom: 14px; font-size: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px;">1. Announcement Bar</h3>
    <div class="detail-grid" style="margin-bottom: 24px;">
      <div class="detail-item" style="grid-column: 1 / -1;">
        <label>
          <input type="checkbox" name="show_announcement" value="1" {{ $settings->show_announcement ? 'checked' : '' }}> 
          Enable scrolling announcement banner on the top of the website
        </label>
      </div>
      <div class="detail-item" style="grid-column: 1 / -1;">
        <label>Announcement Text (Keep it short & urgent)</label>
        <input type="text" name="announcement_text" class="form-control" style="width:100%" value="{{ old('announcement_text', $settings->announcement_text) }}">
      </div>
    </div>

    <h3 style="margin-bottom: 14px; font-size: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px;">2. Contact Information</h3>
    <div class="detail-grid" style="margin-bottom: 24px;">
      <div class="detail-item">
        <label>Phone Display (e.g. +91 92430 60260)</label>
        <input type="text" name="phone_display" class="form-control" style="width:100%" value="{{ old('phone_display', $settings->phone_display) }}" required>
      </div>
      <div class="detail-item">
        <label>Phone Link (e.g. +919243060260)</label>
        <input type="text" name="phone_href" class="form-control" style="width:100%" value="{{ old('phone_href', $settings->phone_href) }}" required>
      </div>
      <div class="detail-item">
        <label>WhatsApp Number (without + or spaces, e.g. 919827787080)</label>
        <input type="text" name="whatsapp_number" class="form-control" style="width:100%" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" required>
      </div>
      <div class="detail-item">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" style="width:100%" value="{{ old('email', $settings->email) }}" required>
      </div>
      <div class="detail-item" style="grid-column: 1 / -1;">
        <label>Working Hours Text</label>
        <input type="text" name="working_hours" class="form-control" style="width:100%" value="{{ old('working_hours', $settings->working_hours) }}" required>
      </div>
      <div class="detail-item" style="grid-column: 1 / -1;">
        <label>Address Line 1</label>
        <input type="text" name="address_line_1" class="form-control" style="width:100%" value="{{ old('address_line_1', $settings->address_line_1) }}" required>
      </div>
      <div class="detail-item" style="grid-column: 1 / -1;">
        <label>Address Line 2</label>
        <input type="text" name="address_line_2" class="form-control" style="width:100%" value="{{ old('address_line_2', $settings->address_line_2) }}">
      </div>
    </div>

    <h3 style="margin-bottom: 14px; font-size: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px;">3. Social Media</h3>
    <p style="font-size: 13px; color: var(--muted); margin-bottom: 14px;">Leave a field blank to automatically hide its icon from the website footer.</p>
    <div class="detail-grid" style="margin-bottom: 24px;">
      <div class="detail-item">
        <label>Facebook Profile URL</label>
        <input type="url" name="facebook_url" class="form-control" style="width:100%" value="{{ old('facebook_url', $settings->facebook_url) }}">
      </div>
      <div class="detail-item">
        <label>Instagram Profile URL</label>
        <input type="url" name="instagram_url" class="form-control" style="width:100%" value="{{ old('instagram_url', $settings->instagram_url) }}">
      </div>
      <div class="detail-item">
        <label>Twitter / X Profile URL</label>
        <input type="url" name="twitter_url" class="form-control" style="width:100%" value="{{ old('twitter_url', $settings->twitter_url) }}">
      </div>
      <div class="detail-item">
        <label>YouTube Channel URL</label>
        <input type="url" name="youtube_url" class="form-control" style="width:100%" value="{{ old('youtube_url', $settings->youtube_url) }}">
      </div>
    </div>

    <h3 style="margin-bottom: 14px; font-size: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px;">4. SEO & Google Maps</h3>
    <div class="detail-grid" style="margin-bottom: 24px;">
      <div class="detail-item">
        <label>Google Rating (e.g. 4.7)</label>
        <input type="text" name="google_rating" class="form-control" style="width:100%" value="{{ old('google_rating', $settings->google_rating) }}">
      </div>
      <div class="detail-item">
        <label>Total Google Reviews (e.g. 67)</label>
        <input type="number" name="google_review_count" class="form-control" style="width:100%" value="{{ old('google_review_count', $settings->google_review_count) }}">
      </div>
      <div class="detail-item" style="grid-column: 1 / -1;">
        <label>Site Meta Description (Important for Google Search)</label>
        <textarea name="meta_description" class="form-control notes" rows="2">{{ old('meta_description', $settings->meta_description) }}</textarea>
      </div>
    </div>

    <div class="detail-grid">
      @foreach(['maps_url' => 'Google Maps listing URL', 'directions_url' => 'Directions URL', 'map_embed_url' => 'Map embed URL', 'outside_view_url' => 'Outside view URL'] as $field => $label)
      <div class="detail-item"><label for="{{ $field }}">{{ $label }}</label><input id="{{ $field }}" type="url" class="form-control" style="width:100%" name="{{ $field }}" value="{{ old($field, $settings->$field) }}"></div>
      @endforeach
    </div>
    <div style="margin-top:24px; padding-top:20px; border-top:1px solid var(--border); text-align: right;">
      <button class="button" style="padding: 10px 24px;">Save Settings</button>
    </div>
  </form>
@endsection
