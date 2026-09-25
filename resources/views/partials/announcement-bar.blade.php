@if(isset($siteSettings) && $siteSettings->show_announcement && !empty($siteSettings->announcement_text))
<div id="announcement-bar" style="background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; font-size: 13px; font-weight: 500; overflow: hidden; position: relative; z-index: 1000;">
  <div style="display: flex; align-items: center; height: 36px;">
    {{-- Label --}}
    <div style="background: rgba(0,0,0,0.15); padding: 0 14px; height: 100%; display: flex; align-items: center; gap: 6px; flex-shrink: 0; font-weight: 700; font-size: 11px; letter-spacing: 0.06em; text-transform: uppercase;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />
      </svg>
      Updates
    </div>

    {{-- Marquee --}}
    <div style="flex: 1; overflow: hidden; white-space: nowrap; mask-image: linear-gradient(90deg, transparent, black 3%, black 97%, transparent); -webkit-mask-image: linear-gradient(90deg, transparent, black 3%, black 97%, transparent);">
      <div class="announcement-marquee" style="display: inline-block; animation: marquee 35s linear infinite; padding-left: 100%;">
        {{ $siteSettings->announcement_text }}
      </div>
    </div>

    {{-- Dismiss --}}
    <button onclick="document.getElementById('announcement-bar').style.display='none'" style="background: rgba(0,0,0,0.15); border: none; color: white; cursor: pointer; padding: 0 12px; height: 100%; display: flex; align-items: center; flex-shrink: 0; transition: background 0.2s;" onmouseover="this.style.background='rgba(0,0,0,0.25)'" onmouseout="this.style.background='rgba(0,0,0,0.15)'" aria-label="Dismiss announcement">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M18 6 6 18M6 6l12 12" />
      </svg>
    </button>
  </div>

  <style>
    @keyframes marquee {
      0% { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }
    .announcement-marquee:hover {
      animation-play-state: paused;
    }
    @media (max-width: 768px) {
      #announcement-bar { display: none !important; }
    }
  </style>
</div>
@endif
