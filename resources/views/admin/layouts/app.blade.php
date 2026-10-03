<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Central Hospital Indore Admin')</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --navy: #111827;
      --navy-mid: #172235;
      --navy-hover: #202e43;
      --blue: #1d4f91;
      --blue-light: #eaf1fa;
      --text: #182230;
      --muted: #667085;
      --border: #e6e9ee;
      --canvas: #f6f7f9;
      --white: #ffffff;
      --success-bg: #f0fdf4;
      --success-text: #15803d;
    }
    body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 14px; line-height: 1.5; color: var(--text); background: var(--canvas); }

    /* ── Shell ── */
    .shell { display: grid; grid-template-columns: 240px 1fr; min-height: 100vh; }

    /* ── Sidebar ── */
    .side {
      background: var(--navy);
      display: flex;
      flex-direction: column;
      padding: 0;
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
    }
    .side-header {
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .brand { display: flex; align-items: center; gap: 10px; }
    .brand-icon {
      width: 34px; height: 34px;
      background: #23578f;
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .brand-icon svg { width: 18px; height: 18px; fill: white; }
    .brand-text .name { color: white; font-size: 15px; font-weight: 700; letter-spacing: -0.2px; }
    .brand-text .sub { color: #8ca1bc; font-size: 11px; margin-top: 1px; }

    .nav { padding: 16px 12px; flex: 1; }
    .nav-section { margin-bottom: 4px; }
    .nav-label {
      color: #8293aa;
      font-size: 10px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      padding: 14px 8px 6px;
    }
    .nav a {
      display: flex;
      align-items: center;
      gap: 9px;
      color: #bac6d5;
      text-decoration: none;
      padding: 8px 10px;
      border-radius: 7px;
      font-size: 13.5px;
      font-weight: 500;
      margin-bottom: 1px;
      transition: background-color 0.12s ease, color 0.12s ease;
    }
    .nav a svg { width: 15px; height: 15px; fill: currentColor; flex-shrink: 0; opacity: 0.8; }
    .nav a:hover { background: rgba(255,255,255,0.06); color: #f8fafc; }
    .nav a.active { background: var(--navy-hover); color: white; }
    .nav a.active svg { opacity: 1; }

    .side-footer {
      padding: 16px 20px;
      border-top: 1px solid rgba(255,255,255,0.06);
    }
    .side-footer .user-info { color: #8ca1bc; font-size: 12px; }
    .side-footer .user-name { color: #e2e8f0; font-weight: 600; font-size: 13px; }

    /* ── Main ── */
    .main { display: flex; flex-direction: column; min-height: 100vh; }
    .topbar {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 0 28px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    .topbar-left h1 { font-size: 17px; font-weight: 700; letter-spacing: -0.3px; color: var(--text); }
    .topbar-left .breadcrumb { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .btn-logout {
      padding: 7px 14px;
      background: transparent;
      border: 1px solid var(--border);
      border-radius: 7px;
      color: var(--muted);
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      transition: border-color 0.12s, color 0.12s;
    }
    .btn-logout:hover { border-color: #c5ccd6; color: var(--text); background: #fafafa; }
    button:focus-visible, a:focus-visible { outline: 3px solid rgba(29,79,145,.25); outline-offset: 2px; }

    .content { padding: 28px; flex: 1; }

    /* ── Cards ── */
    .card, .panel {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 10px;
    }
    .card { padding: 20px; }
    .panel { padding: 20px; }

    /* ── Stat grid ── */
    .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
    .stat-card { background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 20px; }
    .stat-label { font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; }
    .stat-value { font-size: 30px; font-weight: 800; color: var(--text); letter-spacing: -1px; margin: 8px 0 4px; line-height: 1; }
    .stat-sub { font-size: 12px; color: var(--blue); font-weight: 500; }

    /* ── Panels ── */
    .panel-grid { display: grid; grid-template-columns: 1.3fr 1fr; gap: 14px; margin-top: 14px; }
    .panel h2 { font-size: 14px; font-weight: 700; color: var(--text); margin-bottom: 14px; letter-spacing: -0.2px; }
    .data-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 11px 0;
      border-top: 1px solid #f1f5f9;
    }
    .data-row:first-of-type { border-top: none; }
    .data-row strong { display: block; font-size: 13px; font-weight: 600; color: var(--text); }
    .data-row span { color: var(--muted); font-size: 12px; margin-top: 1px; }
    .empty { color: var(--muted); font-size: 13px; padding: 8px 0; }

    /* ── Pills ── */
    .pill {
      padding: 3px 9px;
      border-radius: 99px;
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
      flex-shrink: 0;
    }
    .pill { background: #f1f5f9; color: #475569; }
    .pill.blue { background: var(--blue-light); color: #1251a3; }
    .pill.warning { background: #fffbeb; color: #92400e; }
    .pill.danger { background: #fef2f2; color: #b91c1c; }
    .pill.success { background: #f0fdf4; color: #15803d; }

    /* ── Notice ── */
    .notice {
      background: var(--success-bg);
      border: 1px solid #bbf7d0;
      color: var(--success-text);
      padding: 11px 14px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 18px;
    }

    /* ── Info cards ── */
    .info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-top: 14px; }
    .info-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 18px 20px;
    }
    .info-card .ic-value { font-size: 20px; font-weight: 800; color: var(--text); letter-spacing: -0.5px; }
    .info-card .ic-label { font-size: 13px; font-weight: 600; color: var(--text); margin: 4px 0 2px; }
    .info-card .ic-sub { font-size: 12px; color: var(--muted); }
    .page-head { display:flex; align-items:flex-end; justify-content:space-between; gap:18px; margin-bottom:20px; }.page-head h2 { font-size:22px; letter-spacing:-.4px; }.page-head p { color:var(--muted); margin-top:4px; }
    .filters { display:flex; align-items:center; flex-wrap:wrap; gap:9px; margin-bottom:14px; }.filters input,.filters select,.form-control { min-height:36px; padding:8px 10px; border:1px solid var(--border); border-radius:7px; background:#fff; color:var(--text); }.filters input { min-width:220px; }.button-muted { background:#fff; color:var(--text); border:1px solid var(--border); text-decoration:none; display:inline-flex; align-items:center; }.detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }.detail-item { padding:12px 0; border-top:1px solid #eef0f3; }.detail-item:nth-child(-n+2) { border-top:0; }.detail-item label { display:block; color:var(--muted); font-size:12px; margin-bottom:3px; }.notes { width:100%; min-height:120px; resize:vertical; margin:8px 0 14px; font:inherit; }
    .table-wrap { overflow-x:auto; }.table { width:100%; border-collapse:collapse; }.table th { color:var(--muted); font-size:11px; text-align:left; text-transform:uppercase; letter-spacing:.06em; padding:0 12px 10px; }.table td { border-top:1px solid #eef0f3; padding:13px 12px; vertical-align:middle; }.table td:first-child,.table th:first-child { padding-left:0; }.table td:last-child,.table th:last-child { padding-right:0; }.table small { color:var(--muted); display:block; margin-top:2px; }.select { border:1px solid var(--border); color:var(--text); background:#fff; border-radius:7px; padding:7px 26px 7px 8px; font-size:12px; }.button { background:var(--blue); color:#fff; border:0; border-radius:7px; padding:7px 10px; font-weight:600; cursor:pointer; margin-left:5px; }.button:hover { background:#173f73; }.split { display:grid; grid-template-columns:1fr 1fr; gap:14px; }.summary-list { list-style:none; }.summary-list li { padding:12px 0; border-top:1px solid #eef0f3; }.summary-list li:first-child { border-top:0; }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
      .stat-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 900px) {
      .shell { grid-template-columns: 1fr; }
      .side { display: none; }
      .panel-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
      .stat-grid, .info-grid { grid-template-columns: 1fr 1fr; }
      .content { padding: 16px; }
      .topbar { padding: 0 16px; }
      .detail-grid { grid-template-columns:1fr; }.detail-item:nth-child(2) { border-top:1px solid #eef0f3; }
    }
  </style>
</head>
<body>
<div class="shell">
  <aside class="side">
    <div class="side-header">
      <div class="brand">
        <div class="brand-icon">
          <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
        </div>
        <div class="brand-text">
          <div class="name">Central Hospital Indore</div>
          <div class="sub">Operations Portal</div>
        </div>
      </div>
    </div>

    <nav class="nav">
      <div class="nav-section">
        <div class="nav-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
          Dashboard
        </a>
      </div>
      <div class="nav-section">
        <div class="nav-label">Operations</div>
        <a href="{{ route('admin.appointments') }}" class="{{ request()->routeIs('admin.appointments*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
          Appointments
        </a>
        <a href="{{ route('admin.enquiries') }}" class="{{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
          Patient enquiries
        </a>
      </div>
      <div class="nav-section">
        <div class="nav-label">Website</div>
        <a href="{{ route('admin.doctors.index') }}" class="{{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
          Doctors
        </a>
        <a href="{{ route('admin.departments.index') }}" class="{{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
          Departments
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
          Blogs
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg>
          Gallery
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12zM7 9h10v2H7zm0-3h10v2H7zm0 6h7v2H7z"/></svg>
          Patient stories
        </a>
      </div>
      <div class="nav-section">
        <div class="nav-label">System</div>
        <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">YouTube videos</a>
        <a href="{{ route('admin.feedback.index') }}" class="{{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}">Patient feedback</a>
        <a href="{{ route('admin.brochures.index') }}" class="{{ request()->routeIs('admin.brochures.*') ? 'active' : '' }}">Brochure downloads</a>
        <a href="{{ route('home') }}" target="_blank" rel="noopener">View website</a>
        <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
          <svg viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.06-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.73 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.06.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .43-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.49-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
          Settings
        </a>
      </div>
    </nav>

    <div class="side-footer">
      <div class="user-name">Administrator</div>
      <div class="user-info">Central Hospital Indore</div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div class="topbar-left">
        <div class="h1">@yield('page-title', 'Dashboard')</div>
        <div class="breadcrumb">@yield('breadcrumb', 'Central Hospital Indore Admin')</div>
      </div>
      <div class="topbar-right">
        <form method="post" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="btn-logout">Sign out</button>
        </form>
      </div>
    </header>

    <div class="content">
      @if ($errors->any())
        <div style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 13px;">
          <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @yield('content')
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    function attachSweetAlert(element, attr, callback) {
      const str = element.getAttribute(attr);
      if (str && str.includes('confirm(')) {
        const match = str.match(/confirm\(['"](.*?)['"]\)/);
        const msg = match ? match[1] : 'Are you sure you want to proceed?';
        element.removeAttribute(attr);
        
        element.addEventListener(attr === 'onsubmit' ? 'submit' : 'click', function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Are you sure?',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#b91c1c',
            cancelButtonColor: '#667085',
            confirmButtonText: 'Yes, proceed',
            customClass: { popup: 'admin-swal-popup' }
          }).then((result) => {
            if (result.isConfirmed) callback();
          });
        });
      }
    }

    // Handle form onsubmits
    document.querySelectorAll('form').forEach(form => {
      attachSweetAlert(form, 'onsubmit', () => form.submit());
    });

    // Handle button onclicks
    document.querySelectorAll('button, a').forEach(el => {
      attachSweetAlert(el, 'onclick', () => {
        if (el.tagName === 'BUTTON') {
          el.closest('form').submit();
        } else if (el.tagName === 'A') {
          window.location.href = el.href;
        }
      });
    });
  });
</script>
<style>
  /* Optional tweak to match admin font */
  .admin-swal-popup {
    font-family: 'Inter', -apple-system, sans-serif !important;
  }
</style>
</body>
</html>
