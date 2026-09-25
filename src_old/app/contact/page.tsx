'use client';

import React, { useState } from 'react';
import Link from 'next/link';

const contactInfo = [
  {
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
      </svg>
    ),
    title: 'Call Us',
    primary: '+91 731 000 0000',
    secondary: '+91 731 111 1111',
    color: 'var(--primary)',
  },
  {
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <rect x="2" y="4" width="20" height="16" rx="2" /><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
      </svg>
    ),
    title: 'Email Us',
    primary: 'info@centralhospitalindore.com',
    secondary: 'appointment@centralhospitalindore.com',
    color: 'var(--secondary)',
  },
  {
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" />
      </svg>
    ),
    title: 'Visit Us',
    primary: 'Central Hospital Indore, Pigdamber',
    secondary: 'Indore, Madhya Pradesh 452001',
    color: '#2ECC71',
  },
  {
    icon: (
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
      </svg>
    ),
    title: 'Working Hours',
    primary: 'OPD: Mon–Sat, 9AM – 5PM',
    secondary: 'Emergency: 24/7 Open',
    color: '#E74C3C',
  },
];

export default function ContactPage() {
  const [formSubmitted, setFormSubmitted] = useState(false);

  return (
    <>
      {/* Hero Banner */}
      <section className="page-hero">
        <div className="container">
          <div className="breadcrumb">
            <Link href="/">Home</Link>
            <span className="separator">/</span>
            <span style={{ color: 'white' }}>Contact Us</span>
          </div>
          <h1>
            Get In <span style={{ color: 'var(--secondary)' }}>Touch</span>
          </h1>
          <p>
            Have questions or need assistance? We&apos;re here to help. Reach out through any of the channels below.
          </p>
        </div>
      </section>

      {/* ── Contact Cards ── */}
      <section style={{ padding: '80px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '24px', marginBottom: '80px' }} className="contact-cards-grid">
            {contactInfo.map((info, i) => (
              <div key={i} style={{
                padding: '32px 24px',
                background: 'var(--bg-light)',
                borderRadius: 'var(--radius-lg)',
                border: '1px solid var(--border-light)',
                textAlign: 'center',
                transition: 'var(--transition)',
              }}
              onMouseEnter={(e) => { e.currentTarget.style.transform = 'translateY(-4px)'; e.currentTarget.style.boxShadow = 'var(--shadow-md)'; }}
              onMouseLeave={(e) => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = 'none'; }}
              >
                <div style={{
                  width: '56px', height: '56px', borderRadius: '16px',
                  background: `${info.color}12`, display: 'flex', alignItems: 'center', justifyContent: 'center',
                  color: info.color, margin: '0 auto 16px',
                }}>
                  {info.icon}
                </div>
                <h3 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '8px' }}>{info.title}</h3>
                <div style={{ fontSize: '15px', fontWeight: 600, color: 'var(--text)', marginBottom: '4px' }}>{info.primary}</div>
                <div style={{ fontSize: '13px', color: 'var(--text-light)' }}>{info.secondary}</div>
              </div>
            ))}
          </div>

          {/* ── Form + Map ── */}
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '48px', alignItems: 'flex-start' }} className="contact-main-grid">
            {/* Contact Form */}
            <div style={{
              background: 'white',
              borderRadius: 'var(--radius-xl)',
              padding: '48px',
              boxShadow: 'var(--shadow-lg)',
              border: '1px solid var(--border-light)',
            }}>
              {formSubmitted ? (
                <div style={{ textAlign: 'center', padding: '40px 0' }}>
                  <div style={{
                    width: '72px', height: '72px', borderRadius: '50%',
                    background: 'linear-gradient(135deg, #2ECC71, #27AE60)',
                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                    margin: '0 auto 20px',
                  }}>
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="2.5">
                      <path d="M20 6L9 17l-5-5" />
                    </svg>
                  </div>
                  <h3 style={{ fontSize: '24px', fontWeight: 700, marginBottom: '12px' }}>Message Sent!</h3>
                  <p style={{ fontSize: '15px', color: 'var(--text-secondary)', marginBottom: '24px' }}>
                    We&apos;ve received your message and will respond within 24 hours.
                  </p>
                  <button onClick={() => setFormSubmitted(false)} className="btn btn-outline">
                    Send Another Message
                  </button>
                </div>
              ) : (
                <>
                  <h3 style={{ fontSize: '24px', fontWeight: 800, marginBottom: '8px' }}>
                    Send Us a Message
                  </h3>
                  <p style={{ fontSize: '15px', color: 'var(--text-secondary)', marginBottom: '32px' }}>
                    Fill out the form and our team will get back to you promptly.
                  </p>
                  <form onSubmit={(e) => { e.preventDefault(); setFormSubmitted(true); }} style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="contact-form-row">
                      <div>
                        <label className="form-label">Full Name *</label>
                        <input type="text" className="form-input" placeholder="Your name" required />
                      </div>
                      <div>
                        <label className="form-label">Email *</label>
                        <input type="email" className="form-input" placeholder="you@example.com" required />
                      </div>
                    </div>
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="contact-form-row">
                      <div>
                        <label className="form-label">Phone</label>
                        <input type="tel" className="form-input" placeholder="+91 98765 43210" />
                      </div>
                      <div>
                        <label className="form-label">Subject *</label>
                        <select className="form-input" required defaultValue="">
                          <option value="" disabled>Select subject</option>
                          <option value="general">General Inquiry</option>
                          <option value="appointment">Appointment Related</option>
                          <option value="feedback">Patient Feedback</option>
                          <option value="billing">Billing & Insurance</option>
                          <option value="careers">Careers</option>
                          <option value="other">Other</option>
                        </select>
                      </div>
                    </div>
                    <div>
                      <label className="form-label">Message *</label>
                      <textarea className="form-input" placeholder="How can we help you?" rows={5} required />
                    </div>
                    <button type="submit" className="btn btn-primary btn-lg" style={{ width: '100%' }}>
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <line x1="22" y1="2" x2="11" y2="13" /><polygon points="22 2 15 22 11 13 2 9 22 2" />
                      </svg>
                      Send Message
                    </button>
                  </form>
                </>
              )}
            </div>

            {/* Map + Emergency */}
            <div>
              {/* Map */}
              <div style={{
                borderRadius: 'var(--radius-xl)',
                overflow: 'hidden',
                boxShadow: 'var(--shadow-md)',
                marginBottom: '24px',
                border: '1px solid var(--border-light)',
              }}>
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.0!2d75.8!3d22.7!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zIndore!5e0!3m2!1sen!2sin!4v1600000000000!5m2!1sen!2sin"
                  width="100%"
                  height="350"
                  style={{ border: 0, display: 'block' }}
                  allowFullScreen
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                  title="Central Hospital Indore Location"
                />
              </div>

              {/* Emergency Block */}
              <div style={{
                background: 'linear-gradient(135deg, #E74C3C, #C0392B)',
                borderRadius: 'var(--radius-xl)',
                padding: '32px',
                color: 'white',
                display: 'flex',
                alignItems: 'center',
                gap: '20px',
              }}>
                <div style={{
                  width: '64px', height: '64px', borderRadius: '50%',
                  background: 'rgba(255,255,255,0.2)', display: 'flex', alignItems: 'center', justifyContent: 'center',
                  flexShrink: 0,
                }}>
                  <span className="emergency-dot" style={{ width: '20px', height: '20px', background: 'white' }} />
                </div>
                <div>
                  <div style={{ fontSize: '13px', fontWeight: 600, opacity: 0.9, marginBottom: '4px', textTransform: 'uppercase', letterSpacing: '0.05em' }}>
                    24/7 Emergency
                  </div>
                  <div style={{ fontSize: '24px', fontWeight: 800, marginBottom: '4px' }}>+91 731 000 0000</div>
                  <div style={{ fontSize: '14px', opacity: 0.85 }}>
                    Our emergency department is open round the clock with trauma care and rapid response teams.
                  </div>
                </div>
              </div>

              {/* Social Links */}
              <div style={{
                background: 'white',
                borderRadius: 'var(--radius-xl)',
                padding: '32px',
                border: '1px solid var(--border-light)',
                marginTop: '24px',
              }}>
                <h4 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '16px' }}>Follow Us</h4>
                <div style={{ display: 'flex', gap: '12px' }}>
                  {[
                    { label: 'Facebook', icon: 'f', color: '#1877F2' },
                    { label: 'Twitter', icon: '𝕏', color: '#000' },
                    { label: 'Instagram', icon: '◎', color: '#E4405F' },
                    { label: 'YouTube', icon: '▶', color: '#FF0000' },
                    { label: 'LinkedIn', icon: 'in', color: '#0A66C2' },
                  ].map((social) => (
                    <a
                      key={social.label}
                      href="#"
                      title={social.label}
                      style={{
                        width: '44px', height: '44px', borderRadius: '12px',
                        background: `${social.color}12`, display: 'flex', alignItems: 'center', justifyContent: 'center',
                        color: social.color, textDecoration: 'none', fontSize: '16px', fontWeight: 700,
                        transition: 'var(--transition)',
                      }}
                      onMouseEnter={(e) => { e.currentTarget.style.background = social.color; e.currentTarget.style.color = 'white'; }}
                      onMouseLeave={(e) => { e.currentTarget.style.background = `${social.color}12`; e.currentTarget.style.color = social.color; }}
                    >
                      {social.icon}
                    </a>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>

        <style>{`
          @media (max-width: 1024px) { .contact-cards-grid { grid-template-columns: repeat(2, 1fr) !important; } }
          @media (max-width: 968px) { .contact-main-grid { grid-template-columns: 1fr !important; } }
          @media (max-width: 640px) { 
            .contact-cards-grid { grid-template-columns: 1fr !important; }
            .contact-form-row { grid-template-columns: 1fr !important; }
          }
        `}</style>
      </section>

      {/* ── Patient Feedback Section ── */}
      <section id="feedback" style={{ padding: '80px 0', background: 'var(--bg-light)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', maxWidth: '600px', margin: '0 auto' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>Your Voice Matters</div>
            <h2 className="section-title">
              Patient <span style={{ color: 'var(--primary)' }}>Feedback</span>
            </h2>
            <p className="section-subtitle" style={{ margin: '0 auto 32px' }}>
              Your feedback helps us improve our services and provide better care.
            </p>
            <div style={{
              background: 'white',
              borderRadius: 'var(--radius-xl)',
              padding: '40px',
              border: '1px solid var(--border-light)',
              textAlign: 'left',
            }}>
              <form onSubmit={(e) => e.preventDefault()} style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                <div>
                  <label className="form-label">Your Name</label>
                  <input type="text" className="form-input" placeholder="Full name" />
                </div>
                <div>
                  <label className="form-label">Department Visited</label>
                  <input type="text" className="form-input" placeholder="e.g. Cardiology" />
                </div>
                <div>
                  <label className="form-label">Rate Your Experience</label>
                  <div style={{ display: 'flex', gap: '8px', marginTop: '4px' }}>
                    {[1, 2, 3, 4, 5].map((star) => (
                      <button key={star} type="button" style={{
                        background: 'none', border: 'none', cursor: 'pointer', padding: '4px',
                      }}>
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--border)" stroke="var(--border)">
                          <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                      </button>
                    ))}
                  </div>
                </div>
                <div>
                  <label className="form-label">Your Feedback</label>
                  <textarea className="form-input" placeholder="Tell us about your experience..." rows={4} />
                </div>
                <button type="submit" className="btn btn-primary" style={{ alignSelf: 'flex-start' }}>
                  Submit Feedback
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>

      {/* ── Careers Teaser ── */}
      <section id="careers" style={{ padding: '80px 0', background: 'var(--dark)', color: 'white', textAlign: 'center' }}>
        <div className="container">
          <div className="section-badge" style={{ margin: '0 auto 16px', background: 'rgba(255,255,255,0.1)', borderColor: 'rgba(255,255,255,0.2)', color: 'white' }}>Careers</div>
          <h2 style={{ fontSize: 'clamp(28px, 4vw, 40px)', fontWeight: 800, color: 'white', marginBottom: '16px' }}>
            Join Our <span style={{ color: 'var(--secondary)' }}>Growing Team</span>
          </h2>
          <p style={{ fontSize: '17px', color: 'rgba(255,255,255,0.7)', maxWidth: '600px', margin: '0 auto 32px', lineHeight: 1.7 }}>
            We&apos;re always looking for passionate healthcare professionals to join our team. Send your resume to <strong style={{ color: 'var(--secondary)' }}>careers@centralhospitalindore.com</strong>
          </p>
          <div style={{ display: 'flex', gap: '16px', justifyContent: 'center', flexWrap: 'wrap' }}>
            <a href="mailto:careers@centralhospitalindore.com" className="btn btn-secondary btn-lg">
              Email Your Resume
            </a>
            <Link href="/" className="btn btn-white btn-lg">
              Learn More
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
