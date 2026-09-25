@php
  $medicalServices = [
    ['Gynecology', 'Comprehensive women’s healthcare services covering all stages of life with complete privacy and care.', ['Routine checkups', 'Pregnancy care', 'PCOS/PCOD treatment', 'Menstrual issues']],
    ['Paediatric', 'Dedicated child healthcare ensuring proper growth, development and treatment in a safe environment.', ['Child checkups', 'Vaccination', 'Growth monitoring', 'Illness treatment']],
    ['Trauma Care', 'Immediate medical attention for injuries and emergencies with quick response and proper care.', ['Emergency care', 'Fracture treatment', 'Wound care', 'Accident support']],
    ['Oncology', 'Focused support for cancer diagnosis, guidance and patient care with a structured treatment approach.', ['Cancer screening', 'Diagnosis support', 'Treatment guidance', 'Patient counseling']],
  ];
@endphp
<section id="services" style="padding:100px 0;background:#f8fbfd">
  <div class="container">
    <div style="text-align:center;max-width:760px;margin:0 auto 46px">
      <div class="section-badge" style="margin:0 auto 16px">Our Medical Services</div>
      <h2 class="section-title">Specialist care, centred around <span style="color:var(--primary)">you</span></h2>
      <p class="section-subtitle" style="margin:0 auto">We provide a wide range of healthcare services focused on accurate diagnosis, effective treatment and patient comfort.</p>
    </div>
    <div class="chi-services-grid">
      @foreach($medicalServices as [$title, $description, $items])
        <article class="chi-service-card">
          <div class="chi-service-icon">+</div>
          <h3>{{ $title }}</h3><p>{{ $description }}</p>
          <ul>@foreach($items as $item)<li>{{ $item }}</li>@endforeach</ul>
        </article>
      @endforeach
    </div>
    <div style="text-align:center;margin-top:38px"><a href="{{ route('services') }}" class="btn btn-primary">View all services</a></div>
  </div>
  <style>.chi-services-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px}.chi-service-card{padding:30px;border:1px solid #dfe9ef;border-radius:18px;background:#fff;box-shadow:0 10px 28px rgba(5,70,95,.07)}.chi-service-icon{width:46px;height:46px;border-radius:14px;display:grid;place-items:center;background:var(--primary);color:#fff;font-size:27px;font-weight:800;margin-bottom:20px}.chi-service-card h3{font-size:21px;margin-bottom:10px}.chi-service-card p{font-size:14px;color:var(--text-secondary);line-height:1.65}.chi-service-card ul{padding:16px 0 0;list-style:none;border-top:1px solid #edf2f5;margin-top:16px}.chi-service-card li{font-size:13px;padding:5px 0;color:#405568}.chi-service-card li:before{content:'✓';color:var(--primary);font-weight:800;margin-right:8px}@media(max-width:1050px){.chi-services-grid{grid-template-columns:repeat(2,1fr)}}@media(max-width:620px){.chi-services-grid{grid-template-columns:1fr}}</style>
</section>
