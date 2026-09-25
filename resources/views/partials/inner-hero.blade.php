<section class="inner-hero {{ !empty($image) ? 'inner-hero--image' : 'inner-hero--type' }}">
 <div class="container inner-hero-grid">
  <div class="inner-hero-copy">
   <nav class="inner-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span><span>{{ $label }}</span></nav>
   <span class="at-eyebrow">{{ $eyebrow ?? 'CENTRAL HOSPITAL INDORE' }}</span>
   <h1>{{ $headline }} @if(!empty($accent))<em>{{ $accent }}</em>@endif</h1>
   @if(!empty($description))<p>{{ $description }}</p>@endif
   @if(!empty($cta))<a class="at-link" href="{{ $href }}">{{ $cta }} <span aria-hidden="true">↗</span></a>@endif
  </div>
  @if(!empty($image))
   <figure class="inner-hero-visual"><img src="{{ asset($image) }}" alt="{{ $imageAlt ?? '' }}" fetchpriority="high">@if(!empty($caption))<figcaption>{{ $caption }}</figcaption>@endif</figure>
  @else
   <div class="inner-orbit" aria-hidden="true"><span></span><span></span><span></span><i>+</i></div>
  @endif
 </div>
</section>
