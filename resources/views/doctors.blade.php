@extends('layouts.app')

@section('title', 'Our Specialists - Central Hospital Indore')
@section('meta_description', 'Meet the experienced doctors and medical specialists at Central Hospital Indore providing patient-first care across various departments.')

@section('content')
  @include('partials.inner-hero', ['label' => 'Our specialists', 'eyebrow' => 'THE PEOPLE BEHIND YOUR CARE', 'headline' => 'Expert hands.', 'accent' => 'Human connections.', 'description' => 'Get to know the people who bring experience, understanding and personal attention to your care.', 'cta' => 'Meet the specialists', 'href' => '#specialists'])

  <section id="specialists" class="v2-section inner-specialists"><div class="container">@include('partials.care-team', ['team' => $doctors])</div></section>
@include('partials.visit-banner')
@endsection
