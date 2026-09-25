@extends('layouts.app')
@section('title', 'Specialities & Services | Central Hospital Indore')
@section('content')
@include('partials.inner-hero', ['label' => 'Specialities & services', 'eyebrow' => 'CARE, CONNECTED', 'headline' => 'For every chapter.', 'accent' => 'For all of you.', 'description' => 'Find your speciality. Meet your team. Take the next step with confidence.', 'image' => 'images/atelier/recovery-concept.webp', 'imageAlt' => 'Light-filled patient room interior concept', 'caption' => 'Interior concept · Hospital under construction', 'cta' => 'Explore specialities', 'href' => '#specialities'])
<section id="specialities" class="v2-section"><div class="container"><div class="v2-heading"><div><span class="eyebrow">OUR MEDICAL SPECIALITIES</span><h2>Connected expertise.<br><span>Considered treatment.</span></h2></div><a class="text-action" href="{{ route('appointment') }}">Plan a consultation ↗</a></div><div class="v2-service-directory">
@foreach($departments as $department)
@php($specialityImage = config('speciality-images')[$department->name] ?? null)
<a class="chi-reveal speciality-card" href="{{ route('appointment', ['department'=>$department->name]) }}">
 <div class="speciality-card-image">
  @if($specialityImage)
   <img src="{{ asset('images/specialities/' . $specialityImage . '.webp') }}" width="960" height="640" loading="lazy" decoding="async" alt="">
  @else
   <span class="speciality-card-symbol" aria-hidden="true">+</span>
  @endif
  <span class="speciality-card-arrow" aria-hidden="true">↗</span>
 </div>
 <div class="speciality-card-copy"><h3>{{ $department->name }}</h3><p>{{ $department->description }}</p><b>Request a consultation <span aria-hidden="true">↗</span></b></div>
</a>
@endforeach
</div></div></section>
<section class="v2-section v2-sand"><div class="container"><div class="v2-heading"><div><span class="eyebrow">SUPPORT BEYOND YOUR CONSULTATION</span><h2>Everything working<br><span>towards your wellbeing.</span></h2></div></div><div class="v2-values-grid">@foreach([['Diagnostics','Laboratory testing and diagnostic support for informed treatment decisions.'],['Critical & surgical care','Advanced ICU monitoring and modular operation theatre facilities.'],['Everyday support','An in-house pharmacy, welcoming patient spaces and help with insurance queries.']] as [$title,$description])<article class="chi-reveal"><span class="v2-cross">+</span><h3>{{ $title }}</h3><p>{{ $description }}</p></article>@endforeach</div></div></section>
@include('partials.visit-banner')
@endsection
