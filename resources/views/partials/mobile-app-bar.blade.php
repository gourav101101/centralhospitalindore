<nav class="mobile-app-bar {{ request()->routeIs('appointment*') ? 'mobile-app-bar--appointment-page' : '' }}" aria-label="Quick navigation">
  <a href="{{ route('home') }}" class="mobile-app-bar__item {{ request()->routeIs('home') ? 'is-active' : '' }}" aria-label="Home">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V10Z"/></svg>
    <span>Home</span>
  </a>

  <a href="{{ route('doctors') }}" class="mobile-app-bar__item {{ request()->routeIs('doctors') ? 'is-active' : '' }}" aria-label="Doctors">
    <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="7" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
    <span>Doctors</span>
  </a>

  <a href="{{ route('appointment') }}" class="mobile-app-bar__appointment {{ request()->routeIs('appointment') ? 'is-active' : '' }}" aria-label="Book an appointment">
    <span class="mobile-app-bar__appointment-icon">
      <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18M12 14v4M10 16h4"/></svg>
    </span>
    <span>Book</span>
  </a>

  <a href="{{ route('contact') }}" class="mobile-app-bar__item {{ request()->routeIs('contact') ? 'is-active' : '' }}" aria-label="Contact us">
    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
    <span>Contact</span>
  </a>

  <a href="tel:{{ $siteSettings->phone_href }}" class="mobile-app-bar__item mobile-app-bar__emergency" aria-label="Call Central Hospital Indore">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.04 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
    <span>Call</span>
  </a>
</nav>
