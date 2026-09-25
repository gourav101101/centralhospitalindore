<div class="v2-team-grid">
@foreach($team as $doctor)
 <a class="v2-team-card chi-reveal" href="{{ route('doctor.profile', $doctor) }}">
  <div class="v2-team-visual">@if($doctor->photo)<img src="{{ asset($doctor->photo) }}" alt="{{ $doctor->name }}" loading="lazy">@else<span class="v2-monogram">{{ collect(explode(' ', str_replace('Dr. ', '', $doctor->name)))->map(fn($part)=>mb_substr($part,0,1))->implode('') }}</span><span class="v2-team-watermark" aria-hidden="true">+</span>@endif</div>
  <div class="v2-team-info"><span class="eyebrow">YOUR SPECIALIST</span><h3>{{ $doctor->name }}</h3><p>{{ $doctor->designation }}</p><span class="text-action">Meet your doctor ↗</span></div>
 </a>
@endforeach
</div>
