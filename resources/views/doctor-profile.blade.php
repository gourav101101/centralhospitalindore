@extends('layouts.app')

@section('title', $doctor->name . ' - Central Hospital Indore')
@section('meta_description', "Book an appointment with {$doctor->name}, {$doctor->designation} in the {$doctor->department} department at Central Hospital Indore.")

@section('content')
  <section class="page-hero">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('doctors') }}">Our Specialists</a>
        <span class="separator">/</span>
        <span style="color: white;">{{ $doctor->name }}</span>
      </div>
    </div>
  </section>

  <section style="padding: 80px 0; background: var(--bg-white);">
    <div class="container">
      <div style="background: white; border-radius: var(--radius-xl); box-shadow: var(--shadow-lg); border: 1px solid var(--border-light); overflow: hidden; display: flex; flex-direction: row;" class="doctor-profile-card">
        
        <!-- Photo Side -->
        <div style="width: 350px; flex-shrink: 0; background: var(--primary-50); position: relative;" class="doctor-profile-photo">
          <img src="{{ $doctor->photo ? asset($doctor->photo) : asset('images/doctors-team.png') }}" alt="{{ $doctor->name }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <!-- Info Side -->
        <div style="padding: 48px; flex: 1;">
          <div style="display: inline-block; padding: 6px 12px; background: var(--primary-50); color: var(--primary); border-radius: 999px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px;">
            {{ $doctor->department }}
          </div>
          
          <h1 style="font-size: 36px; font-weight: 800; color: var(--text); margin-bottom: 8px;">{{ $doctor->name }}</h1>
          <p style="font-size: 18px; color: var(--text-secondary); margin-bottom: 32px; font-weight: 500;">{{ $doctor->designation }}</p>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 40px; border-top: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light); padding: 24px 0;">
            <div>
              <div style="font-size: 13px; color: var(--muted); font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Experience</div>
              <div style="font-size: 16px; color: var(--text); font-weight: 500;">{{ $doctor->experience ?: 'Not specified' }}</div>
            </div>
            <div>
              <div style="font-size: 13px; color: var(--muted); font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">Qualifications</div>
              <div style="font-size: 16px; color: var(--text); font-weight: 500;">{{ $doctor->qualification ?: 'Not specified' }}</div>
            </div>
          </div>

          <div style="display: flex; gap: 16px;">
            <a href="{{ route('appointment') }}" class="btn btn-primary" style="padding: 14px 28px; font-size: 15px;">Book Appointment</a>
            <a href="tel:{{ $siteSettings->phone_href }}" class="btn btn-outline" style="padding: 14px 28px; font-size: 15px;">Call Hospital</a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <style>
    @media (max-width: 768px) {
      .doctor-profile-card { flex-direction: column !important; }
      .doctor-profile-photo { width: 100% !important; height: 350px !important; }
    }
  </style>

  <!-- ── CTA ── -->
  @include('partials.visit-banner')
@endsection
