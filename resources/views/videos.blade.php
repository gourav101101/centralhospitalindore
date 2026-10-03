@extends('layouts.app')
@section('title', 'Videos - Central Hospital Indore')
@section('content')
@include('partials.inner-hero', ['label' => 'Videos', 'eyebrow' => 'WATCH & DISCOVER', 'headline' => 'A closer look.', 'accent' => 'A clearer connection.', 'description' => 'Videos from Central Hospital Indore, together in one place.', 'cta' => 'Explore videos', 'href' => '#hospital-videos'])
<section id="hospital-videos" style="padding:70px 0"><div class="container">
@if($videos->isNotEmpty()) @include('partials.video-grid') <div style="margin-top:30px">{{ $videos->links() }}</div>
@else <p style="text-align:center;padding:40px 0">Our videos will be available here soon.</p> @endif
</div></section>
@endsection
