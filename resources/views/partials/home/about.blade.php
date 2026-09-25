<section id="about" style="padding:100px 0;background:var(--bg-white);position:relative;overflow:hidden">
  <div style="position:absolute;top:0;right:0;width:40%;height:100%;background:radial-gradient(circle at 70% 30%,var(--primary-50) 0%,transparent 60%);pointer-events:none"></div>
  <div class="container" style="position:relative;z-index:1">
    <div class="about-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center">
      <div class="about-image" style="position:relative">
        <img src="{{ asset('images/hospital-interior.png') }}" alt="Patient care area at Central Hospital Indore" style="width:100%;border-radius:20px;box-shadow:var(--shadow-xl)" />
        <a href="{{ $siteSettings->outside_view_url }}" target="_blank" rel="noopener noreferrer" style="position:absolute;bottom:18px;right:18px;padding:11px 16px;border-radius:999px;background:white;color:var(--primary);font-size:13px;font-weight:800;text-decoration:none;box-shadow:var(--shadow-md)">See outside ↗</a>
      </div>
      <div>
        <div class="section-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20" /></svg>
          About Central Hospital Indore
        </div>
        <h2 class="section-title">Compassionate healthcare <span style="color:var(--primary)">for Indore</span></h2>
        <p style="font-size:16px;color:var(--text-secondary);line-height:1.8;margin-bottom:20px">Central Hospital Indore is a leading multi-speciality quaternary care hospital delivering world-class treatment with compassion and innovation.</p>
        <p style="font-size:15px;color:var(--text-secondary);line-height:1.8;margin-bottom:32px;padding-left:16px;border-left:3px solid var(--secondary)"><strong style="color:var(--text)">Our vision:</strong> Ethical, accessible and advanced healthcare delivered with compassion and a human touch.</p>
        <div style="display:flex;gap:16px;flex-wrap:wrap">
          <a href="#departments" class="btn btn-primary">Our Departments <span aria-hidden="true">→</span></a>
          <a href="{{ $siteSettings->directions_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">Get Directions</a>
        </div>
      </div>
    </div>
    <div class="stats-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:80px">
      <a href="{{ $siteSettings->maps_url }}" target="_blank" rel="noopener noreferrer" style="text-align:center;padding:32px 20px;background:var(--bg-light);border-radius:var(--radius-lg);border:1px solid var(--border-light);text-decoration:none;color:inherit">
        <div style="font-size:28px;color:var(--accent);margin-bottom:8px">★</div><div style="font-size:36px;font-weight:800;color:var(--primary);line-height:1.1">{{ $siteSettings->google_rating }}/5</div><div style="font-size:14px;font-weight:500;color:var(--text-secondary);margin-top:4px">{{ $siteSettings->google_review_count }} Google reviews</div>
      </a>
      <div style="text-align:center;padding:32px 20px;background:var(--bg-light);border-radius:var(--radius-lg);border:1px solid var(--border-light)">
        <div style="font-size:28px;color:var(--accent);margin-bottom:8px">◷</div><div style="font-size:30px;font-weight:800;color:var(--primary);line-height:1.1">Open 24 Hours</div><div style="font-size:14px;font-weight:500;color:var(--text-secondary);margin-top:4px">Every day</div>
      </div>
      <a href="{{ $siteSettings->directions_url }}" target="_blank" rel="noopener noreferrer" style="text-align:center;padding:32px 20px;background:var(--bg-light);border-radius:var(--radius-lg);border:1px solid var(--border-light);text-decoration:none;color:inherit">
        <div style="font-size:28px;color:var(--accent);margin-bottom:8px">⌖</div><div style="font-size:30px;font-weight:800;color:var(--primary);line-height:1.1">Rasoma Square</div><div style="font-size:14px;font-weight:500;color:var(--text-secondary);margin-top:4px">Get directions</div>
      </a>
    </div>
  </div>
  <style>@media(max-width:968px){.about-grid{grid-template-columns:1fr!important;gap:40px!important}.about-image{order:2}}@media(max-width:640px){.stats-grid{grid-template-columns:1fr!important}}</style>
</section>
