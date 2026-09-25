<header id="main-header" class="chi-header atelier-header">
 <div class="container chi-nav">
  <a class="chi-brand" href="{{ route('home') }}" aria-label="Central Hospital Indore home"><img src="{{ asset('images/central-hospital-indore-logo.jpeg') }}" width="64" height="64" alt="CHI logo"><span><strong>Central Hospital</strong><small>INDORE</small></span></a>
  <nav class="chi-desktop" aria-label="Main navigation">@foreach(['about'=>'The hospital','services'=>'Our expertise','doctors'=>'Our doctors','contact'=>'Contact'] as $route=>$label)<a href="{{ route($route) }}" @class(['is-current'=>request()->routeIs($route)]) @if(request()->routeIs($route)) aria-current="page" @endif>{{ $label }}</a>@endforeach</nav>
  <a class="chi-button chi-nav-book" href="{{ route('appointment') }}">Plan your visit <span aria-hidden="true">↗</span></a>
  <button type="button" class="chi-menu-toggle" aria-label="Open navigation" aria-expanded="false" aria-controls="chi-mobile-menu">☰</button>
 </div>
 <nav id="chi-mobile-menu" class="chi-mobile-menu" aria-label="Mobile navigation" hidden>@foreach(['home'=>'Home','about'=>'The hospital','services'=>'Our expertise','doctors'=>'Our doctors','gallery'=>'Our spaces','patient-stories'=>'Patient stories','contact'=>'Contact','appointment'=>'Plan your visit'] as $route=>$label)<a href="{{ route($route) }}" @if(request()->routeIs($route)) aria-current="page" @endif>{{ $label }} <span aria-hidden="true">↗</span></a>@endforeach</nav>
</header>
