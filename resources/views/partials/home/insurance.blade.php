<section style="padding:72px 0;background:#fff">
  <div class="container">
    <div style="text-align:center;margin-bottom:34px"><div class="section-badge" style="margin:0 auto 14px">Insurance & Payment Options</div><h2 class="section-title">Accessible care with <span style="color:var(--primary)">flexible support</span></h2></div>
    <div class="chi-payment-grid">
      @foreach(['Ayushman Bharat', 'All Major TPAs Accepted', 'Mediclaim Accepted', 'EMI Available', 'Cashless Facility', 'Easy Payment Options'] as $option)
        <div><span>✓</span><strong>{{ $option }}</strong></div>
      @endforeach
    </div>
  </div>
  <style>.chi-payment-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:14px}.chi-payment-grid div{min-height:105px;padding:18px 12px;border-radius:14px;background:#f4fafc;border:1px solid #dcecf1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;gap:10px}.chi-payment-grid span{color:var(--primary);font-size:22px}.chi-payment-grid strong{font-size:13px;color:#294356}@media(max-width:900px){.chi-payment-grid{grid-template-columns:repeat(3,1fr)}}@media(max-width:520px){.chi-payment-grid{grid-template-columns:repeat(2,1fr)}}</style>
</section>
