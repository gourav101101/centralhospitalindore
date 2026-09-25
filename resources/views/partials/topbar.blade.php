<div class="topbar-container" style="background: linear-gradient(90deg, #1E2A38 0%, #2C3E50 50%, #34495E 100%); color: white; font-size: 13px; height: var(--topbar-height); display: flex; align-items: center; position: relative; z-index: 1001;">
  <div class="container" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
    <!-- Left: Emergency -->
    <div class="topbar-left" style="display: flex; align-items: center; gap: 20px;">
      <div style="display: flex; align-items: center; gap: 8px;">
        <span class="emergency-dot"></span>
        <span style="font-weight: 600; color: #7DE2C1; font-size: 12px; letter-spacing: 0.04em;">OPEN 24 HOURS</span>
      </div>
      <a href="tel:{{ $siteSettings->phone_href }}" style="color: var(--accent); font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 6px; padding: 3px 12px; background: rgba(221, 244, 243, 0.1); border-radius: var(--radius-full); border: 1px solid rgba(221, 244, 243, 0.15); transition: var(--transition-fast);"
         onmouseover="this.style.background='rgba(221, 244, 243,0.18)'"
         onmouseout="this.style.background='rgba(221, 244, 243,0.1)'">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
        </svg>
        {{ $siteSettings->phone_display }}
      </a>
    </div>

    <!-- Right: Info -->
    <div class="topbar-right" style="display: flex; align-items: center; gap: 24px; font-size: 12px; color: rgba(255,255,255,0.55);">
      <a href="{{ $siteSettings->directions_url }}" target="_blank" rel="noopener noreferrer" style="color: rgba(255,255,255,0.55); text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='rgba(255,255,255,0.55)'">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="2" y="4" width="20" height="16" rx="2" />
          <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
        </svg>
        Near Rasoma Square, Indore
      </a>
      <span style="display: flex; align-items: center; gap: 6px;">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10" />
          <polyline points="12 6 12 12 16 14" />
        </svg>
        {{ $siteSettings->working_hours }}
      </span>
    </div>
  </div>
  <style>
    @media (max-width: 768px) {
      .topbar-right { display: none !important; }
      .topbar-container .container { justify-content: center !important; }
      .topbar-left { gap: 10px !important; }
    }
  </style>
</div>
