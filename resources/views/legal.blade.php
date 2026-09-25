@extends('layouts.app')

@section('title', $title . ' - Central Hospital Indore')

@section('content')
  <section class="page-hero">
    <div class="container">
      <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><span class="separator">/</span><span style="color: white;">{{ $title }}</span></div>
      <h1>{{ $title }}</h1>
      <p>{{ $intro }}</p>
    </div>
  </section>
  <section style="padding: 88px 0; background: var(--bg-light);">
    <div class="container" style="max-width: 860px;">
      <div style="background: white; border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: clamp(28px, 5vw, 56px); box-shadow: var(--shadow-md);">
        <h2 class="section-title">{{ $heading }}</h2>
        <p class="section-subtitle" style="margin-bottom: 36px;">{{ $intro }}</p>
        @foreach ($sections as [$sectionTitle, $text])
          <div style="padding: 24px 0; border-top: 1px solid var(--border-light);">
            <h3 style="font-size: 19px; margin-bottom: 8px;">{{ $sectionTitle }}</h3>
            <p style="color: var(--text-secondary); line-height: 1.7;">{{ $text }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
