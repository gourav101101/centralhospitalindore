'use client';

import React, { useState } from 'react';
import Link from 'next/link';

/* ────── Services Data ────── */
const services = [
  {
    id: 'diagnostics',
    icon: '🔬',
    title: 'Labs & Diagnostics',
    desc: 'Advanced imaging and pathology lab services for accurate and timely diagnosis.',
    details: 'Our diagnostic centre is equipped with state-of-the-art imaging technology including digital X-ray, 128-slice CT scanner, 1.5T MRI, ultrasound and colour Doppler. Our pathology lab offers a full spectrum of tests — haematology, biochemistry, microbiology and histopathology — with rapid turnaround times.',
    features: ['Digital X-Ray & CT Scan', '1.5T MRI Imaging', 'Full Pathology Lab', 'Ultrasound & Colour Doppler', 'Same-day Reports Available', 'Home Sample Collection'],
    color: '#3498DB',
  },
  {
    id: 'checkup',
    icon: '🩺',
    title: 'Health Checkup Packages',
    desc: 'Comprehensive preventive health packages for all age groups.',
    details: 'Prevention is better than cure. Our health checkup packages are designed by experts to screen for common lifestyle diseases, cardiac risks, diabetes, thyroid disorders, and more. Each package includes consultation with a specialist, comprehensive blood work, imaging, and a personalised health report.',
    features: ['Basic Health Screening', 'Executive Health Checkup', 'Cardiac Risk Assessment', 'Women\'s Wellness Package', 'Senior Citizen Package', 'Corporate Health Camps'],
    color: '#2ECC71',
  },
  {
    id: 'pharmacy',
    icon: '💊',
    title: '24/7 Pharmacy',
    desc: 'Well-stocked in-house pharmacy available round the clock.',
    details: 'Our in-house pharmacy is staffed 24 hours a day, 7 days a week, ensuring patients and visitors always have access to prescribed medications, surgical supplies, and OTC products. We maintain a comprehensive inventory of drugs from trusted manufacturers at competitive prices.',
    features: ['24-Hour Availability', 'Prescription Dispensing', 'OTC Medications', 'Surgical Supplies', 'Home Delivery Service', 'Competitive Pricing'],
    color: '#E67E22',
  },
  {
    id: 'ambulance',
    icon: '🚑',
    title: 'Ambulance Service',
    desc: 'Fully equipped ACLS/BLS ambulances for emergency patient transport.',
    details: 'Our ambulance fleet is equipped with Advanced Cardiac Life Support (ACLS) and Basic Life Support (BLS) equipment. Staffed by trained paramedics, our ambulances ensure safe and rapid patient transport with continuous monitoring. GPS-enabled tracking ensures the nearest available unit is dispatched.',
    features: ['ACLS Equipped Ambulances', 'BLS Transport Units', 'Trained Paramedic Staff', 'GPS-Enabled Dispatch', 'Inter-Hospital Transfers', 'Coverage Across Indore'],
    color: '#E74C3C',
  },
  {
    id: 'homecare',
    icon: '🏠',
    title: 'Homecare Services',
    desc: 'Nursing and physiotherapy services at the comfort of your home.',
    details: 'For patients recovering at home after surgery, or those needing ongoing nursing care, our homecare team brings hospital-quality care to your doorstep. Services include wound care, IV therapy, physiotherapy, post-operative monitoring, and elderly care by trained professionals.',
    features: ['Post-Surgical Nursing', 'Wound Care & IV Therapy', 'Physiotherapy at Home', 'Elderly Care Services', 'Trained & Certified Staff', 'Flexible Scheduling'],
    color: '#8E44AD',
  },
  {
    id: 'rehab',
    icon: '🏃',
    title: 'Rehabilitation Centre',
    desc: 'Post-surgery recovery programs and physical therapy.',
    details: 'Our rehabilitation centre offers comprehensive recovery programs for patients post-surgery, post-stroke, or managing chronic musculoskeletal conditions. Our team of physiotherapists, occupational therapists, and speech therapists work together to create personalised recovery plans.',
    features: ['Post-Surgery Rehabilitation', 'Stroke Recovery Programs', 'Sports Injury Rehab', 'Occupational Therapy', 'Speech & Language Therapy', 'Pain Management'],
    color: '#1ABC9C',
  },
];

/* ────── FAQ Data ────── */
const faqs = [
  {
    q: 'How can I book a health checkup?',
    a: 'You can book a health checkup through our appointment page, by calling our helpline at +91 731 000 0000, or by visiting our reception desk. We also offer corporate tie-ups for group bookings.',
  },
  {
    q: 'Do you offer home sample collection for lab tests?',
    a: 'Yes, we offer home sample collection for most lab tests. You can request this service while booking your test or by calling our diagnostics helpline.',
  },
  {
    q: 'What insurance providers do you accept?',
    a: 'CHI is empanelled with all major insurance providers including Star Health, ICICI Lombard, New India Assurance, HDFC Ergo, and government schemes like Ayushman Bharat.',
  },
  {
    q: 'How quickly can an ambulance reach me?',
    a: 'Our GPS-enabled dispatch system ensures the nearest ambulance is sent to your location. Average response time within Indore city limits is 15-20 minutes.',
  },
  {
    q: 'Are homecare services available on weekends?',
    a: 'Yes, our homecare services are available 7 days a week including public holidays. You can schedule visits based on your convenience.',
  },
];

/* ────── Accordion Item ────── */
function AccordionItem({ q, a }: { q: string; a: string }) {
  const [open, setOpen] = useState(false);
  return (
    <div className="accordion-item" style={{ marginBottom: '8px' }}>
      <button className="accordion-trigger" onClick={() => setOpen(!open)}>
        {q}
        <svg
          width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"
          style={{ transition: 'transform 0.2s ease', transform: open ? 'rotate(180deg)' : 'rotate(0)', flexShrink: 0 }}
        >
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </button>
      {open && <div className="accordion-content">{a}</div>}
    </div>
  );
}

/* ────── Page Component ────── */
export default function ServicesPage() {
  return (
    <>
      {/* Hero Banner */}
      <section className="page-hero">
        <div className="container">
          <div className="breadcrumb">
            <Link href="/">Home</Link>
            <span className="separator">/</span>
            <span style={{ color: 'white' }}>Services</span>
          </div>
          <h1>
            Our <span style={{ color: 'var(--secondary)' }}>Patient Services</span>
          </h1>
          <p>
            Comprehensive support facilities that extend our care beyond treatments, ensuring a seamless and comfortable healthcare experience.
          </p>
        </div>
      </section>

      {/* ── Services Grid Overview ── */}
      <section style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>What We Offer</div>
            <h2 className="section-title">
              Complete Healthcare <span style={{ color: 'var(--primary)' }}>Support</span>
            </h2>
            <p className="section-subtitle" style={{ margin: '0 auto' }}>
              From diagnostics to rehabilitation, we provide end-to-end healthcare services under one roof.
            </p>
          </div>

          <div style={{ display: 'flex', flexDirection: 'column', gap: '48px' }}>
            {services.map((svc, i) => (
              <div key={svc.id} id={svc.id} style={{
                display: 'grid',
                gridTemplateColumns: i % 2 === 0 ? '1fr 1.2fr' : '1.2fr 1fr',
                gap: '60px',
                alignItems: 'center',
                padding: '40px',
                background: i % 2 === 0 ? 'var(--bg-light)' : 'white',
                borderRadius: 'var(--radius-xl)',
                border: '1px solid var(--border-light)',
              }} className="service-detail-grid">
                {/* Icon + Title side */}
                <div style={{ order: i % 2 === 0 ? 1 : 2 }}>
                  <div style={{
                    fontSize: '48px',
                    width: '80px', height: '80px',
                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                    background: `${svc.color}12`,
                    borderRadius: '20px',
                    marginBottom: '20px',
                  }}>
                    {svc.icon}
                  </div>
                  <h3 style={{ fontSize: '28px', fontWeight: 700, marginBottom: '12px', color: 'var(--text)' }}>
                    {svc.title}
                  </h3>
                  <p style={{ fontSize: '16px', color: 'var(--text-secondary)', lineHeight: 1.8, marginBottom: '24px' }}>
                    {svc.details}
                  </p>
                  <Link href="/appointment" className="btn btn-primary">
                    Book This Service
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                  </Link>
                </div>

                {/* Features side */}
                <div style={{ order: i % 2 === 0 ? 2 : 1 }}>
                  <div style={{
                    background: 'white',
                    borderRadius: 'var(--radius-lg)',
                    padding: '32px',
                    border: '1px solid var(--border-light)',
                    boxShadow: 'var(--shadow-sm)',
                  }}>
                    <h4 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '20px', color: 'var(--text)' }}>
                      Key Features
                    </h4>
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '12px' }} className="features-sub-grid">
                      {svc.features.map((feat, j) => (
                        <div key={j} style={{
                          display: 'flex', alignItems: 'center', gap: '10px',
                          padding: '10px 12px', borderRadius: '8px', background: 'var(--bg-light)',
                          fontSize: '14px', color: 'var(--text)', fontWeight: 500,
                        }}>
                          <div style={{
                            width: '24px', height: '24px', borderRadius: '50%',
                            background: `${svc.color}20`, display: 'flex', alignItems: 'center', justifyContent: 'center',
                            flexShrink: 0,
                          }}>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke={svc.color} strokeWidth="3">
                              <path d="M20 6L9 17l-5-5" />
                            </svg>
                          </div>
                          {feat}
                        </div>
                      ))}
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 968px) {
            .service-detail-grid { grid-template-columns: 1fr !important; gap: 32px !important; }
            .service-detail-grid > div { order: unset !important; }
          }
          @media (max-width: 640px) {
            .features-sub-grid { grid-template-columns: 1fr !important; }
          }
        `}</style>
      </section>

      {/* ── Process Steps ── */}
      <section style={{ padding: '100px 0', background: 'var(--bg-light)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>How It Works</div>
            <h2 className="section-title">
              Simple <span style={{ color: 'var(--primary)' }}>Process</span>
            </h2>
            <p className="section-subtitle" style={{ margin: '0 auto' }}>
              Getting started with any of our services is easy.
            </p>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '24px', maxWidth: '1000px', margin: '0 auto' }} className="process-grid">
            {[
              { step: '01', title: 'Book Online or Call', desc: 'Schedule through our website, app, or helpline.' },
              { step: '02', title: 'Confirm Appointment', desc: 'Our team confirms your slot and shares details.' },
              { step: '03', title: 'Visit or Get Home Service', desc: 'Arrive at the hospital or receive care at home.' },
              { step: '04', title: 'Get Your Results', desc: 'Access reports digitally or collect from our centre.' },
            ].map((item, i) => (
              <div key={i} style={{ textAlign: 'center', position: 'relative' }}>
                <div style={{
                  width: '64px', height: '64px', borderRadius: '50%',
                  background: 'linear-gradient(135deg, var(--primary), var(--primary-light))',
                  display: 'flex', alignItems: 'center', justifyContent: 'center',
                  color: 'white', fontSize: '22px', fontWeight: 800,
                  margin: '0 auto 16px', boxShadow: 'var(--shadow-primary)',
                }}>
                  {item.step}
                </div>
                <h4 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '8px' }}>{item.title}</h4>
                <p style={{ fontSize: '14px', color: 'var(--text-secondary)', lineHeight: 1.5, margin: 0 }}>{item.desc}</p>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 768px) { .process-grid { grid-template-columns: repeat(2, 1fr) !important; } }
          @media (max-width: 480px) { .process-grid { grid-template-columns: 1fr !important; } }
        `}</style>
      </section>

      {/* ── FAQ ── */}
      <section style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1.5fr', gap: '60px', alignItems: 'flex-start' }} className="faq-grid">
            <div>
              <div className="section-badge">FAQs</div>
              <h2 className="section-title">
                Frequently Asked <span style={{ color: 'var(--primary)' }}>Questions</span>
              </h2>
              <p className="section-subtitle">
                Find answers to common questions about our services and facilities.
              </p>
              <Link href="/contact" className="btn btn-outline" style={{ marginTop: '24px' }}>
                Still have questions? Contact Us
              </Link>
            </div>
            <div>
              {faqs.map((faq, i) => (
                <AccordionItem key={i} q={faq.q} a={faq.a} />
              ))}
            </div>
          </div>
        </div>
        <style>{`
          @media (max-width: 968px) {
            .faq-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
          }
        `}</style>
      </section>

      {/* ── CTA ── */}
      <section style={{ padding: '80px 0', background: 'var(--dark)', color: 'white', textAlign: 'center' }}>
        <div className="container">
          <h2 style={{ fontSize: 'clamp(28px, 4vw, 40px)', fontWeight: 800, color: 'white', marginBottom: '16px' }}>
            Need a <span style={{ color: 'var(--secondary)' }}>Service?</span>
          </h2>
          <p style={{ fontSize: '17px', color: 'rgba(255,255,255,0.7)', maxWidth: '500px', margin: '0 auto 32px', lineHeight: 1.7 }}>
            Book an appointment or call us to learn more about our patient services.
          </p>
          <div style={{ display: 'flex', gap: '16px', justifyContent: 'center', flexWrap: 'wrap' }}>
            <Link href="/appointment" className="btn btn-secondary btn-lg">Book Appointment</Link>
            <a href="tel:+917310000000" className="btn btn-white btn-lg">Call Now</a>
          </div>
        </div>
      </section>
    </>
  );
}
