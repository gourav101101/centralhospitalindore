<section style="padding: 100px 0; background: linear-gradient(180deg, #043C50 0%, #07566E 40%, #0B6F8A 100%); position: relative; overflow: hidden;">
  {{-- Background decoration --}}
  <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px); background-size: 28px 28px; pointer-events: none;"></div>
  <div style="position: absolute; top: -20%; right: -10%; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(221,246,251,0.08) 0%, transparent 70%); pointer-events: none;"></div>

  <div class="container" style="position: relative; z-index: 1;">
    <div style="text-align: center; margin-bottom: 60px;">
      <div class="section-badge" style="margin: 0 auto 16px; background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.9); border-color: rgba(255,255,255,0.15);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" />
        </svg>
        Our Facilities
      </div>
      <h2 class="section-title" style="color: white;">
        World-Class <span style="color: var(--accent);">Infrastructure</span>
      </h2>
      <p class="section-subtitle" style="margin: 0 auto; color: rgba(255,255,255,0.7);">
        Equipped with advanced medical technology and modern amenities to deliver the highest standard of care.
      </p>
    </div>

    <div class="facilities-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">

      {{-- ICU --}}
      <div class="facility-card" style="padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-xl); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.3s ease; cursor: default;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'"
           onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
        <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--accent) 0%, rgba(221,246,251,0.3) 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary-dark)" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2" /></svg>
        </div>
        <h3 style="font-size: 18px; font-weight: 700; color: white; margin-bottom: 8px;">Intensive Care Unit</h3>
        <p style="font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.7; margin: 0;">Advanced ICU with round-the-clock monitoring, ventilator support, and critical care specialists.</p>
      </div>

      {{-- Operation Theatre --}}
      <div class="facility-card" style="padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-xl); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.3s ease; cursor: default;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'"
           onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
        <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--accent) 0%, rgba(221,246,251,0.3) 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary-dark)" stroke-width="1.5"><circle cx="12" cy="12" r="3" /><path d="M12 2v4m0 12v4M2 12h4m12 0h4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83" /></svg>
        </div>
        <h3 style="font-size: 18px; font-weight: 700; color: white; margin-bottom: 8px;">Operation Theatre</h3>
        <p style="font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.7; margin: 0;">Fully equipped modular OT with laminar airflow, modern surgical instruments, and anaesthesia systems.</p>
      </div>

      {{-- Diagnostic Lab --}}
      <div class="facility-card" style="padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-xl); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.3s ease; cursor: default;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'"
           onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
        <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--accent) 0%, rgba(221,246,251,0.3) 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary-dark)" stroke-width="1.5"><path d="M9 3v11M15 3v7M9 14c0 2.21 1.79 4 4 4h2c2.21 0 4 1.79 4 4" /><circle cx="9" cy="14" r="2" /></svg>
        </div>
        <h3 style="font-size: 18px; font-weight: 700; color: white; margin-bottom: 8px;">Diagnostic Laboratory</h3>
        <p style="font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.7; margin: 0;">In-house pathology and imaging services including X-Ray, ultrasound, and comprehensive blood testing.</p>
      </div>

      {{-- Pharmacy --}}
      <div class="facility-card" style="padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-xl); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.3s ease; cursor: default;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'"
           onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
        <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--accent) 0%, rgba(221,246,251,0.3) 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary-dark)" stroke-width="1.5"><path d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5" /><path d="M12 11v4m-2-2h4" /></svg>
        </div>
        <h3 style="font-size: 18px; font-weight: 700; color: white; margin-bottom: 8px;">24/7 Pharmacy</h3>
        <p style="font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.7; margin: 0;">Round-the-clock in-house pharmacy ensuring immediate availability of medicines and medical supplies.</p>
      </div>

      {{-- Patient Rooms --}}
      <div class="facility-card" style="padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-xl); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.3s ease; cursor: default;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'"
           onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
        <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--accent) 0%, rgba(221,246,251,0.3) 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary-dark)" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><path d="M9 14h2v4H9z" /><path d="M13 14h2v4h-2z" /></svg>
        </div>
        <h3 style="font-size: 18px; font-weight: 700; color: white; margin-bottom: 8px;">Patient Rooms</h3>
        <p style="font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.7; margin: 0;">Comfortable private and semi-private rooms with modern amenities for a restful recovery experience.</p>
      </div>

      {{-- Ambulance --}}
      <div class="facility-card" style="padding: 32px 28px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-xl); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); transition: all 0.3s ease; cursor: default;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-6px)'"
           onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
        <div style="width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg, var(--accent) 0%, rgba(221,246,251,0.3) 100%); display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary-dark)" stroke-width="1.5"><path d="M10 17h4V5H2v12h3m15 0h2v-3.34a4 4 0 0 0-.54-2L17.5 7H14v10h1" /><circle cx="7.5" cy="17.5" r="2.5" /><circle cx="17.5" cy="17.5" r="2.5" /></svg>
        </div>
        <h3 style="font-size: 18px; font-weight: 700; color: white; margin-bottom: 8px;">Ambulance Service</h3>
        <p style="font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.7; margin: 0;">Call to confirm transport availability. Our team coordinates emergency patient transfers when possible.</p>
      </div>

    </div>

    <div style="text-align: center; margin-top: 48px;">
      <a href="{{ route('services') }}" class="btn btn-primary btn-lg" style="background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.25); color: white;"
         onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.borderColor='rgba(255,255,255,0.4)'"
         onmouseout="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.25)'">
        View All Services →
      </a>
    </div>
  </div>

  <style>
    @media (max-width: 1024px) {
      .facilities-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 640px) {
      .facilities-grid { grid-template-columns: 1fr !important; }
    }
  </style>
</section>
