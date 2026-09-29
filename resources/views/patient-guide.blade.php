@extends('layouts.app')
@section('title', 'Patient & Visitor Guide | Central Hospital Indore')
@section('meta_description', 'Plan your visit to Central Hospital Indore. Find practical guidance on appointments, admission, discharge, visitors and insurance enquiries.')
@section('content')
@include('partials.inner-hero', ['label' => 'Patient & visitor guide', 'eyebrow' => 'A LITTLE PREPARATION. MORE PEACE OF MIND.', 'headline' => 'Your visit.', 'accent' => 'Made simpler.', 'description' => 'Practical information for you and the people by your side, from your first enquiry to your journey home.', 'cta' => 'Before you arrive', 'href' => '#before-your-visit'])

<nav class="patient-guide-nav container" aria-label="Patient guide sections">
 <a href="#before-your-visit">Before your visit</a><a href="#admission">Admission & discharge</a><a href="#visitors">For visitors</a><a href="#insurance">Insurance enquiries</a><a href="#visit-faq">Common questions</a>
</nav>

<section id="before-your-visit" class="v2-section"><div class="container">
 <div class="v2-heading"><div><span class="eyebrow">COME PREPARED</span><h2>Less to remember.<br><span>More time for you.</span></h2></div><a class="at-link" href="{{ route('appointment') }}">Request an appointment &nearr;</a></div>
 <div class="v2-values-grid">
  <article><span class="v2-cross" aria-hidden="true">+</span><h3>Confirm your visit</h3><p>Send an appointment request or call our team. Your consultation date and time are confirmed by the hospital after checking the doctor's availability.</p><a class="at-link" href="{{ route('doctors') }}">Meet our doctors &nearr;</a></article>
  <article><span class="v2-cross" aria-hidden="true">+</span><h3>Keep details together</h3><p>Bring your identification, appointment details, previous prescriptions and relevant reports. Keep a list of your current medicines and questions ready for your consultation.</p></article>
  <article><span class="v2-cross" aria-hidden="true">+</span><h3>Find your way</h3><p>{{ $siteSettings->address_line_1 }}<br>{{ $siteSettings->address_line_2 }}</p><a class="at-link" href="{{ $siteSettings->directions_url }}" target="_blank" rel="noopener noreferrer">Get directions &nearr;</a></article>
 </div>
</div></section>

<section id="admission" class="v2-section v2-sand"><div class="container">
 <div class="v2-heading"><div><span class="eyebrow">AT EACH STEP</span><h2>Arriving with clarity.<br><span>Leaving with a plan.</span></h2></div></div>
 <div class="v2-values-grid">
  <article><h3>Before admission</h3><p>If your doctor recommends admission, contact the hospital about registration, room availability, the estimated charges and documents needed. Share insurance details when making your enquiry.</p></article>
  <article><h3>During your stay</h3><p>Ask the care team who to contact for updates, how attendants can help, and which visiting arrangements apply to your ward. Reception can help you reach the appropriate team.</p></article>
  <article><h3>Before you leave</h3><p>Ask your team to explain your discharge summary, prescriptions and follow-up appointment. Check that you have your reports, bills and any documents needed for an insurance claim.</p></article>
 </div>
</div></section>

<section id="visitors" class="v2-section"><div class="container">
 <div class="v2-heading"><div><span class="eyebrow">FOR FAMILY & FRIENDS</span><h2>Being there.<br><span>Thoughtfully.</span></h2></div></div>
 <div class="v2-values-grid">
  <article><h3>Check visiting times</h3><p>Contact reception before travelling to confirm visiting hours and attendant arrangements for the patient's ward. Access to critical care areas may differ from general wards.</p></article>
  <article><h3>Plan your arrival</h3><p>Ask our team about parking, the most convenient entrance, and assistance with access or mobility before your visit.</p><a class="at-link" href="tel:{{ $siteSettings->phone_href }}">{{ $siteSettings->phone_display }} &nearr;</a></article>
  <article><h3>Respect the space</h3><p>Follow the ward team's guidance, keep conversations quiet, and respect other patients' privacy. Check with staff before bringing food or taking photographs.</p></article>
 </div>
</div></section>

<section id="insurance" class="v2-section v2-sand"><div class="container patient-guide-insurance">
 <div><span class="eyebrow">INSURANCE & BILLING</span><h2>Ask early.<br><span>Plan with confidence.</span></h2><p>Contact our team with your insurer or TPA name and policy details to check the arrangements available for your treatment.</p><a class="at-link" href="{{ route('contact') }}">Enquire about insurance &nearr;</a></div>
 <div class="patient-guide-note"><h3>What to ask</h3><ul><li>Is my insurer or TPA currently accepted?</li><li>Is cashless treatment available for my planned admission?</li><li>Which documents and approvals are required?</li><li>What estimated charges or deposits should I plan for?</li><li>Which bills and reports will I receive for reimbursement?</li></ul><p>Bring your policy or insurance card and identification. Cashless arrangements and coverage must be confirmed with the hospital and your insurer before relying on them.</p></div>
</div></section>

<section id="visit-faq" class="v2-section"><div class="container">
 <div class="v2-heading"><div><span class="eyebrow">GOOD TO KNOW</span><h2>A few questions.<br><span>A clearer next step.</span></h2></div></div>
 <div class="patient-guide-faq">
  <details><summary>Does an online request confirm my appointment?</summary><p>No. Your request is saved for the team to review. The hospital will confirm the doctor's availability and your consultation time. You can also choose to continue on WhatsApp after submitting.</p></details>
  <details><summary>Is the hospital open at night?</summary><p>The hospital is open 24 hours. Individual specialists have their own consultation schedules. Call <a href="tel:{{ $siteSettings->phone_href }}">{{ $siteSettings->phone_display }}</a> for assistance; online appointment forms are for appointment requests.</p></details>
  <details><summary>How can I change an appointment request?</summary><p>Call the hospital with your name and requested appointment date so the team can help. Please confirm the revised time before travelling.</p></details>
  <details><summary>Where can I check visiting hours and room availability?</summary><p>Contact reception for current ward visiting arrangements, attendant guidance and room availability. These details depend on the ward and the patient's care needs.</p></details>
  <details><summary>How do I collect reports or request billing documents?</summary><p>Contact the hospital with your visit details and ask about the collection process, required identification and available delivery options.</p></details>
  <details><summary>Can I arrange patient transport?</summary><p>Call the hospital to check transport availability and arrangements. An online appointment request does not book an ambulance or other transport.</p></details>
 </div>
</div></section>
@include('partials.visit-banner')
@endsection
