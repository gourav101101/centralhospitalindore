<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Central Hospital Indore Admin — Sign In</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-size: 14px;
    color: #0f172a;
  }
  .panel-left {
    background: #111827;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 48px;
    position: relative;
    overflow: hidden;
  }
  .panel-left::before {
    content: '';
    position: absolute;
    top: -120px; right: -120px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(74,122,174,0.16) 0%, transparent 70%);
    pointer-events: none;
  }
  .panel-left::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -80px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(74,122,174,0.08) 0%, transparent 70%);
    pointer-events: none;
  }
  .brand-mark {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .brand-icon {
    width: 40px; height: 40px;
    background: #23578f;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
  }
  .brand-icon svg { width: 22px; height: 22px; fill: white; }
  .brand-name { color: white; font-size: 18px; font-weight: 700; letter-spacing: -0.3px; }
  .brand-sub { color: #9aabc0; font-size: 12px; margin-top: 1px; }
  .left-body { flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 40px 0; }
  .left-body h2 { color: white; font-size: 28px; font-weight: 700; line-height: 1.3; letter-spacing: -0.5px; margin-bottom: 14px; }
  .left-body p { color: #aab8c9; font-size: 14px; line-height: 1.7; max-width: 320px; }
  .feature-list { margin-top: 36px; display: flex; flex-direction: column; gap: 14px; }
  .feature { display: flex; align-items: center; gap: 12px; }
  .feature-dot { width: 6px; height: 6px; border-radius: 50%; background: #7ea5d1; flex-shrink: 0; }
  .feature span { color: #c2cedd; font-size: 13px; }
  .left-footer { color: #7f91a8; font-size: 12px; }
  .panel-right {
    background: #f5f6f8;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 40px;
  }
  .login-box {
    width: 100%;
    max-width: 400px;
    padding: 38px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 18px 46px rgba(15,23,42,0.07);
  }
  .login-box h1 { font-size: 24px; font-weight: 700; letter-spacing: -0.4px; color: #0f172a; margin-bottom: 6px; }
  .login-box .subtitle { color: #64748b; font-size: 14px; margin-bottom: 32px; }
  .error-box {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
    padding: 11px 14px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 20px;
  }
  .field { margin-bottom: 18px; }
  .field label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
  .field input[type="email"],
  .field input[type="password"] {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    color: #0f172a;
    background: white;
    outline: none;
    transition: border-color 0.15s;
  }
  .field input:focus { border-color: #23578f; box-shadow: 0 0 0 3px rgba(35,87,143,0.10); }
  .remember {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
    color: #64748b;
    font-size: 13px;
    cursor: pointer;
  }
  .remember input[type="checkbox"] {
    width: 15px; height: 15px;
    accent-color: #23578f;
    cursor: pointer;
  }
  .btn-signin {
    width: 100%;
    padding: 11px;
    background: #23578f;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    letter-spacing: 0.1px;
    transition: background-color 0.12s ease;
  }
  .btn-signin:hover { background: #1d4a79; }
  .btn-signin:focus-visible, input:focus-visible { outline: 3px solid rgba(35,87,143,.20); outline-offset: 2px; }
  .login-footer { margin-top: 28px; padding-top: 20px; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px; text-align: center; }
  @media (max-width: 768px) {
    body { grid-template-columns: 1fr; }
    .panel-left { display: none; }
    .panel-right { background: white; padding: 40px 24px; }
    .login-box { border: 0; box-shadow: none; padding: 0; }
  }
</style>
</head>
<body>
  <div class="panel-left">
    <div class="brand-mark">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
      </div>
      <div>
        <div class="brand-name">Central Hospital Indore</div>
        <div class="brand-sub">Admin Portal</div>
      </div>
    </div>
    <div class="left-body">
      <h2>Manage your hospital operations</h2>
      <p>Centralised control for appointments, patient enquiries, content, and team management.</p>
      <div class="feature-list">
        <div class="feature"><div class="feature-dot"></div><span>Real-time appointment tracking</span></div>
        <div class="feature"><div class="feature-dot"></div><span>Patient enquiry management</span></div>
        <div class="feature"><div class="feature-dot"></div><span>Website content control</span></div>
      </div>
    </div>
    <div class="left-footer">© {{ date('Y') }} Central Hospital Indore. All rights reserved.</div>
  </div>

  <div class="panel-right">
    <div class="login-box">
      <h1>Welcome back</h1>
      <p class="subtitle">Sign in to your admin account to continue.</p>

      @if($errors->any())
        <div class="error-box">{{ $errors->first() }}</div>
      @endif

      <form method="post" action="{{ route('admin.login.store') }}">
        @csrf
        <div class="field">
          <label for="email">Email address</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
        </div>
        <div class="field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required placeholder="••••••••">
        </div>
        <label class="remember">
          <input name="remember" type="checkbox"> Keep me signed in
        </label>
        <button type="submit" class="btn-signin">Sign in</button>
      </form>

      <div class="login-footer">Secure access · Central Hospital Indore Operations</div>
    </div>
  </div>
</body>
</html>
