@extends('layouts.app')
@section('title','Patient Stories - Central Hospital Indore')
@section('meta_description', 'Read reviews, testimonials, and patient stories from those treated at Central Hospital Indore.')
@section('content')
@include('partials.inner-hero', ['label' => 'Patient stories', 'eyebrow' => 'IN THEIR OWN WORDS', 'headline' => 'The care.', 'accent' => 'The connection.', 'description' => 'Personal experiences shared by patients and families on our Google listing.', 'cta' => 'Share your experience', 'href' => '#share-feedback'])
@include('partials.home.testimonials', ['testimonials' => $testimonials])
<div style="padding:24px 0 60px;background:var(--primary)"><div class="container">{{ $testimonials->links() }}</div></div>

<section id="share-feedback" style="padding: 80px 0; background: var(--bg-light);">
  <div class="container" style="max-width: 700px;">
    <div style="background: white; border-radius: var(--radius-xl); padding: 40px; box-shadow: var(--shadow-md); border: 1px solid var(--border-light);">
      <div style="text-align: center; margin-bottom: 32px;">
        <h2 style="font-size: 24px; font-weight: 700; color: var(--text);">Share Your Feedback</h2>
        <p style="color: var(--text-secondary); margin-top: 8px;">Your experience helps us improve our care.</p>
      </div>

      @if(session('success'))
        <div style="background: var(--primary-50); color: var(--primary); padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid var(--primary-100); text-align: center; font-weight: 500;">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())<div role="alert" style="color:#b91c1c;margin-bottom:20px"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
      <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
          <div>
            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: var(--text);">Your Name <span style="color: red;">*</span></label>
            <input type="text" name="patient_name" value="{{ old('patient_name') }}" required style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit;">
          </div>
          <div>
            <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: var(--text);">Department <span style="color: red;">*</span></label>
            <select name="department" required style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit; background: white;">
              <option value="">Select department</option>
              <option value="OPD" @selected(old('department') === 'OPD')>OPD Consultation</option>
              <option value="IPD" @selected(old('department') === 'IPD')>In-Patient (Admitted)</option>
              <option value="Emergency" @selected(old('department') === 'Emergency')>Emergency</option>
              <option value="Diagnostics" @selected(old('department') === 'Diagnostics')>Diagnostics / Lab</option>
              <option value="Pharmacy" @selected(old('department') === 'Pharmacy')>Pharmacy</option>
              <option value="Other" @selected(old('department') === 'Other')>Other</option>
            </select>
          </div>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: var(--text);">Rating <span style="color: red;">*</span></label>
          <div style="display: flex; gap: 10px;">
            @foreach([1,2,3,4,5] as $rating)
              <label style="cursor: pointer; display: flex; align-items: center; gap: 4px;">
                <input type="radio" name="rating" value="{{ $rating }}" @checked(old('rating') == $rating) required>
                {{ $rating }} Star
              </label>
            @endforeach
          </div>
        </div>

        <div style="margin-bottom: 24px;">
          <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: var(--text);">Your Feedback <span style="color: red;">*</span></label>
          <textarea name="feedback" required rows="4" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit; resize: vertical;">{{ old('feedback') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px;">Submit Feedback</button>
      </form>
    </div>
  </div>
</section>
@endsection
