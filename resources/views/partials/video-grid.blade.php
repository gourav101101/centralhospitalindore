<div class="chi-video-grid">
@foreach($videos as $video)
<article class="chi-video-card"><iframe src="{{ $video->embed_url }}" title="{{ $video->title }}" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><div><h3>{{ $video->title }}</h3>@if($video->description)<p>{{ $video->description }}</p>@endif<a href="{{ $video->youtube_url }}" target="_blank" rel="noopener">Watch on YouTube <span aria-hidden="true">&#8599;</span></a></div></article>
@endforeach
</div>
<style>
.chi-video-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:28px}.chi-video-card{min-width:0;background:#fff;border:1px solid #e5e3df;border-radius:16px;overflow:hidden}.chi-video-card iframe{display:block;width:100%;aspect-ratio:16/9;min-height:200px;border:0;background:#151b19}.chi-video-card>div{padding:24px}.chi-video-card h3{font-size:23px;line-height:1.3;margin:0 0 12px;overflow-wrap:anywhere}.chi-video-card p{font-size:15px;line-height:1.7;color:#616961;white-space:pre-line;overflow-wrap:anywhere;margin:0 0 18px}.chi-video-card a{font-size:14px;font-weight:600;color:var(--primary)}@media(max-width:1000px){.chi-video-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:640px){.chi-video-grid{grid-template-columns:1fr;gap:20px}}
</style>
