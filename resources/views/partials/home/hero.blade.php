<section class="home-hero" style="position: relative; min-height: 88vh; display: flex; align-items: center; overflow: hidden;">
  <!-- Background -->
  <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #043C50 0%, #07566E 40%, #0B6F8A 70%, #0D7894 100%); z-index: 0;"></div>
  
  <!-- Subtle Grid Overlay -->
  <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255, 255, 255, 0.15) 1px, transparent 1px); background-size: 30px 30px; opacity: 0.5; z-index: 0;"></div>

  <!-- Decorative circles -->
  <div style="position: absolute; top: -10%; right: -5%; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(221,246,251,0.16) 0%, transparent 70%); z-index: 1;"></div>
  <div style="position: absolute; bottom: -20%; left: -10%; width: 800px; height: 800px; border-radius: 50%; background: radial-gradient(circle, rgba(11,111,138,0.20) 0%, transparent 70%); z-index: 1;"></div>

  <!-- Floating medical icons -->
  <div class="animate-float" style="position: absolute; top: 15%; right: 10%; width: 80px; height: 80px; background: rgba(255,255,255,0.08); border-radius: 20px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); z-index: 2;">
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5">
      <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
    </svg>
  </div>

  <div class="animate-float delay-300" style="position: absolute; bottom: 20%; right: 18%; width: 60px; height: 60px; background: rgba(255,255,255,0.06); border-radius: 16px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); z-index: 2;">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(221,246,251,0.95)" stroke-width="1.5">
      <path d="M12 2L12 22M2 12L22 12" />
      <circle cx="12" cy="12" r="3" />
    </svg>
  </div>

  <!-- Content -->
  <div class="container home-hero-content" style="position: relative; z-index: 10; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; padding-top: 56px; padding-bottom: 56px;">
    <!-- Left: Text -->
    <div class="hero-text">
      <div class="animate-fade-in-up" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; background: rgba(255,255,255,0.1); border-radius: var(--radius-full); border: 1px solid rgba(255,255,255,0.15); margin-bottom: 24px; backdrop-filter: blur(4px);">
        <span class="emergency-dot" style="width: 8px; height: 8px; background: var(--accent);"></span>
        <span style="color: rgba(255,255,255,0.95); font-size: 13px; font-weight: 600; letter-spacing: 0.02em;">
          {{ $siteSettings->working_hours }} · Emergency & Trauma Care · Indore
        </span>
      </div>

      <h1 class="animate-fade-in-up delay-100" style="font-size: clamp(36px, 5vw, 56px); font-weight: 900; color: white; line-height: 1.08; margin-bottom: 20px; letter-spacing: -0.03em;">
        Compassionate Care.<br />
        <span style="background: linear-gradient(135deg, #DDF6FB 0%, #FFFFFF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
          Advanced Medicine.
        </span> 
        Better Outcomes.
      </h1>

      <p class="animate-fade-in-up delay-200" style="font-size: 17px; color: rgba(255,255,255,0.8); line-height: 1.7; max-width: 480px; margin-bottom: 36px;">
        Central Hospital Indore is a leading multi-speciality quaternary care hospital delivering world-class treatment with compassion and innovation.
      </p>

      <div class="animate-fade-in-up delay-300" style="display: flex; gap: 16px; flex-wrap: wrap;">
        <a href="{{ route('appointment') }}" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, var(--secondary) 0%, var(--primary-light) 100%); border-color: var(--secondary);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
          Book Appointment
        </a>
        <a href="tel:{{ $siteSettings->phone_href }}" class="btn btn-outline btn-lg" style="color: white; border-color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.05);" onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.5)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.3)'">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
          </svg>
          Talk to Us
        </a>
      </div>

      <!-- Trust indicators -->
      <div class="hero-stats animate-fade-in-up delay-500" style="display: flex; gap: 32px; margin-top: 48px; padding-top: 32px; border-top: 1px solid rgba(255,255,255,0.15);">
        <div style="text-align: center;">
          <div style="font-size: 28px; font-weight: 800; color: var(--accent); line-height: 1;">2</div>
          <div style="font-size: 12px; color: rgba(255,255,255,0.7); margin-top: 4px; font-weight: 500;">Founding doctors</div>
        </div>
        <div style="text-align: center;">
          <div style="font-size: 28px; font-weight: 800; color: var(--accent); line-height: 1;">15+</div>
          <div style="font-size: 12px; color: rgba(255,255,255,0.7); margin-top: 4px; font-weight: 500;">Years experience</div>
        </div>
        <div style="text-align: center;">
          <div style="font-size: 28px; font-weight: 800; color: var(--accent); line-height: 1;">99%</div>
          <div style="font-size: 12px; color: rgba(255,255,255,0.7); margin-top: 4px; font-weight: 500;">Success rate</div>
        </div>
        <div style="text-align: center;">
          <div style="font-size: 28px; font-weight: 800; color: var(--accent); line-height: 1;">5k+</div>
          <div style="font-size: 12px; color: rgba(255,255,255,0.7); margin-top: 4px; font-weight: 500;">Happy patients</div>
        </div>
      </div>
    </div>

    <!-- Right: Image -->
    <div class="hero-image animate-fade-in-right delay-200" style="position: relative;">
      <!-- Glow behind image -->
      <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; height: 90%; border-radius: 50%; background: radial-gradient(circle, rgba(221,246,251,0.18) 0%, transparent 70%);"></div>
      <img src="{{ asset('images/central-hospital-indore-building.jpeg') }}" alt="Central Hospital Indore hospital building" style="width:100%;height:auto;aspect-ratio:16/9;object-fit:cover;object-position:center;border-radius:24px;position:relative;z-index:1;box-shadow:0 24px 80px rgba(30,42,56,.5);" />
      
    </div>
  </div>
</section>
