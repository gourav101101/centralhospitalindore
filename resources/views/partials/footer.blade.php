<footer class="chi-footer">
 <div class="container">
  <div class="chi-footer-top"><div><span class="chi-eyebrow">HERE FOR YOU. EVERY DAY.</span><h2>Good health starts<br>with a conversation.</h2></div><a class="chi-button chi-button-light" href="{{ route('appointment') }}">Let’s plan your visit <span>↗</span></a></div>
  <div class="chi-footer-grid">
   <div><a href="{{ route('home') }}" class="chi-brand"><img src="{{ asset('images/central-hospital-indore-logo.jpeg') }}" width="60" height="60" alt="CHI logo"><span><strong>Central Hospital</strong><small>INDORE</small></span></a><p>Advanced medicine. A human touch.<br>Compassionate care for you and your family.</p></div>
   <div><h3>Explore CHI</h3>@foreach(['about'=>'Our story','doctors'=>'Our doctors','services'=>'Specialities','gallery'=>'Hospital gallery','videos'=>'Videos'] as $route=>$label)<a href="{{ route($route) }}">{{ $label }}</a>@endforeach</div>
   <div><h3>Patient support</h3>@foreach(['appointment'=>'Book an appointment','patient-stories'=>'Patient stories','health-library'=>'Health library','contact'=>'Contact us'] as $route=>$label)<a href="{{ route($route) }}">{{ $label }}</a>@endforeach</div>
   <div><h3>Visit & connect</h3><p>{{ $siteSettings->address_line_1 }}<br>{{ $siteSettings->address_line_2 }}</p><a href="tel:{{ $siteSettings->phone_href }}">{{ $siteSettings->phone_display }}</a><a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a><a href="{{ $siteSettings->directions_url }}" target="_blank" rel="noopener">Get directions ↗</a></div>
  </div>
  <div class="chi-footer-bottom"><span>© {{ date('Y') }} Central Hospital Indore. All rights reserved.</span><div><a href="{{ route('privacy') }}">Privacy policy</a><a href="{{ route('terms') }}">Terms & conditions</a></div></div>
 </div>
</footer>
