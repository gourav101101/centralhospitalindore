<section class="home-quick-access" style="position: relative; z-index: 20; margin-top: 48px; margin-bottom: 72px;">
  <div class="container">
    <div class="quick-access-grid">
      <!-- Book Appointment -->
      <a href="{{ route('appointment') }}" style="display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 24px 16px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); text-decoration: none; transition: var(--transition); border: 1px solid var(--border-light); border-left: 3px solid var(--primary); cursor: pointer;"
         onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--primary-200)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'; this.style.borderColor='var(--border-light)';">
        <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--primary-50); display: flex; align-items: center; justify-content: center; color: var(--primary);">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
        </div>
        <span style="font-size: 13px; font-weight: 600; color: var(--text); text-align: center;">Book Appointment</span>
      </a>

      <!-- Call hospital -->
      <a href="tel:{{ $siteSettings->phone_href }}" style="display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 24px 16px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); text-decoration: none; transition: var(--transition); border: 1px solid var(--border-light); border-left: 3px solid var(--secondary); cursor: pointer;"
         onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--primary-200)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'; this.style.borderColor='var(--border-light)';">
        <div style="width: 52px; height: 52px; border-radius: 14px; background: rgba(11, 143, 116, 0.10); display: flex; align-items: center; justify-content: center; color: var(--secondary);">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
          </svg>
        </div>
        <span style="font-size: 13px; font-weight: 600; color: var(--text); text-align: center;">Call Hospital</span>
      </a>

      <!-- Health Checkup -->
      <a href="{{ route('services') }}#checkup" style="display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 24px 16px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); text-decoration: none; transition: var(--transition); border: 1px solid var(--border-light); border-left: 3px solid var(--primary-light); cursor: pointer;"
         onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--primary-200)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'; this.style.borderColor='var(--border-light)';">
        <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--primary-50); display: flex; align-items: center; justify-content: center; color: var(--primary-light);">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 12h6M12 9v6" />
            <rect x="3" y="3" width="18" height="18" rx="3" />
          </svg>
        </div>
        <span style="font-size: 13px; font-weight: 600; color: var(--text); text-align: center;">Health Checkup</span>
      </a>

      <!-- Virtual Consult -->
      <a href="{{ route('contact') }}" style="display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 24px 16px; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-md); text-decoration: none; transition: var(--transition); border: 1px solid var(--border-light); border-left: 3px solid var(--secondary); cursor: pointer;"
         onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--primary-200)';"
         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'; this.style.borderColor='var(--border-light)';">
        <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--primary-50); display: flex; align-items: center; justify-content: center; color: var(--secondary);">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 10l4.553-2.276A1 1 0 0 1 21 8.618v6.764a1 1 0 0 1-1.447.894L15 14" />
            <rect x="1" y="6" width="14" height="12" rx="2" />
          </svg>
        </div>
        <span style="font-size: 13px; font-weight: 600; color: var(--text); text-align: center;">Virtual Consult</span>
      </a>
    </div>
  </div>
  <style>
    .quick-access-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; max-width: 900px; margin: 0 auto; }
    @media (max-width: 968px) {
      .quick-access-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
      .quick-access-grid { grid-template-columns: 1fr; }
    }
  </style>
</section>
