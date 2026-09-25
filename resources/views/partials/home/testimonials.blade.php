<section style="padding:100px 0;background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 100%);color:#fff;position:relative;overflow:hidden">
  <div style="position:absolute;top:-20%;right:-10%;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.08) 0%,transparent 70%);pointer-events:none"></div>
  <div style="position:absolute;bottom:-20%;left:-10%;width:400px;height:400px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,.05) 0%,transparent 70%);pointer-events:none"></div>
  <div class="container" style="position:relative;z-index:1">
    <div style="text-align:center;margin-bottom:60px">
      <h2 class="section-title" style="color:#fff">Patient <span style="color:var(--accent)">Stories</span></h2>
      <p class="section-subtitle" style="margin:0 auto;color:rgba(255,255,255,.88)">Recent feedback from the hospital's Google listing.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px" class="testimonials-grid">
      @forelse($testimonials as $story)
        <article style="background:rgba(255,255,255,.08);border-radius:var(--radius-lg);padding:32px;border:1px solid rgba(255,255,255,.15);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);transition:var(--transition)" onmouseover="this.style.background='rgba(255,255,255,.12)';this.style.borderColor='rgba(255,255,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.borderColor='rgba(255,255,255,.15)'">
          <div style="display:flex;gap:4px;margin-bottom:16px" aria-label="{{ $story->rating }} out of 5 stars">@for($star = 1; $star <= 5; $star++)<span style="color:var(--accent);font-size:17px;line-height:1">{{ $star <= $story->rating ? '★' : '☆' }}</span>@endfor</div>
          <p style="font-size:15px;line-height:1.7;margin-bottom:24px;color:rgba(255,255,255,.9)">“{{ $story->content }}”</p>
          <div><div style="font-weight:700;font-size:16px;color:#fff">{{ $story->client_name }}</div><div style="font-size:13px;color:var(--accent)">{{ $story->client_position ?: $story->client_company ?: 'Central Hospital Indore patient' }}</div></div>
        </article>
      @empty
        <p style="grid-column:1/-1;text-align:center;color:rgba(255,255,255,.85)">Patient stories will be available soon.</p>
      @endforelse
    </div>
    @if(!request()->routeIs('patient-stories'))
      <div style="text-align:center;margin-top:34px"><a href="{{ $siteSettings->maps_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline" style="border-color:rgba(255,255,255,.55);color:#fff">View all Google reviews</a></div>
    @endif
  </div>
  <style>@media(max-width:968px){.testimonials-grid{grid-template-columns:1fr!important}}</style>
</section>
