'use client';

import React, { useState } from 'react';
import Link from 'next/link';

const departments = [
  'Accident & Emergency',
  'Cardiac Sciences',
  'Neurosciences',
  'Mother & Child',
  'Bone & Joint (Orthopaedics)',
  'Critical Care',
  'Cancer Care',
  'Physical Medicine & Rehabilitation',
  'General Medicine',
  'General Surgery',
];

const doctors = [
  { name: 'Dr. Ramesh Sharma', dept: 'Cardiac Sciences', exp: '22+ Years' },
  { name: 'Dr. Anita Desai', dept: 'Neurosciences', exp: '18+ Years' },
  { name: 'Dr. Vikram Singh', dept: 'Bone & Joint (Orthopaedics)', exp: '15+ Years' },
  { name: 'Dr. Priya Patel', dept: 'Mother & Child', exp: '12+ Years' },
  { name: 'Dr. Sanjay Verma', dept: 'Critical Care', exp: '15+ Years' },
  { name: 'Dr. Meera Gupta', dept: 'Cancer Care', exp: '10+ Years' },
  { name: 'Dr. Arjun Reddy', dept: 'General Surgery', exp: '14+ Years' },
  { name: 'Dr. Kavita Joshi', dept: 'General Medicine', exp: '20+ Years' },
];

const timeSlots = [
  '09:00 AM', '09:30 AM', '10:00 AM', '10:30 AM',
  '11:00 AM', '11:30 AM', '02:00 PM', '02:30 PM',
  '03:00 PM', '03:30 PM', '04:00 PM', '04:30 PM',
];

export default function AppointmentPage() {
  const [selectedDept, setSelectedDept] = useState('');
  const [selectedDoctor, setSelectedDoctor] = useState('');
  const [selectedTime, setSelectedTime] = useState('');
  const [submitted, setSubmitted] = useState(false);

  const filteredDoctors = selectedDept
    ? doctors.filter((d) => d.dept === selectedDept)
    : doctors;

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <>
      {/* Hero Banner */}
      <section className="page-hero">
        <div className="container">
          <div className="breadcrumb">
            <Link href="/">Home</Link>
            <span className="separator">/</span>
            <span style={{ color: 'white' }}>Book Appointment</span>
          </div>
          <h1>
            Book an <span style={{ color: 'var(--secondary)' }}>Appointment</span>
          </h1>
          <p>
            Schedule your visit with our expert specialists. Fill in the form below and our team will confirm your appointment promptly.
          </p>
        </div>
      </section>

      {/* ── Main Form Section ── */}
      <section style={{ padding: '80px 0', background: 'var(--bg-light)' }}>
        <div className="container">
          {submitted ? (
            /* ── Success State ── */
            <div style={{
              maxWidth: '600px',
              margin: '0 auto',
              textAlign: 'center',
              padding: '60px 40px',
              background: 'white',
              borderRadius: 'var(--radius-xl)',
              boxShadow: 'var(--shadow-lg)',
              animation: 'fadeInUp 0.5s ease-out',
            }}>
              <div style={{
                width: '80px', height: '80px', borderRadius: '50%',
                background: 'linear-gradient(135deg, #2ECC71, #27AE60)',
                display: 'flex', alignItems: 'center', justifyContent: 'center',
                margin: '0 auto 24px',
              }}>
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="2.5">
                  <path d="M20 6L9 17l-5-5" />
                </svg>
              </div>
              <h2 style={{ fontSize: '28px', fontWeight: 800, marginBottom: '12px', color: 'var(--text)' }}>
                Appointment Requested!
              </h2>
              <p style={{ fontSize: '16px', color: 'var(--text-secondary)', lineHeight: 1.7, marginBottom: '32px' }}>
                Thank you for booking with Central Hospital Indore. Our team will contact you shortly to confirm your appointment schedule.
              </p>
              <div style={{ display: 'flex', gap: '12px', justifyContent: 'center', flexWrap: 'wrap' }}>
                <button onClick={() => setSubmitted(false)} className="btn btn-primary">
                  Book Another
                </button>
                <Link href="/" className="btn btn-outline">
                  Back to Home
                </Link>
              </div>
            </div>
          ) : (
            /* ── Form ── */
            <div style={{
              display: 'grid',
              gridTemplateColumns: '1fr 1.4fr',
              gap: '48px',
              alignItems: 'flex-start',
            }} className="appointment-grid">
              {/* Left: Info Panel */}
              <div>
                <div style={{
                  background: 'var(--dark)',
                  borderRadius: 'var(--radius-xl)',
                  padding: '40px',
                  color: 'white',
                  marginBottom: '24px',
                }}>
                  <h3 style={{ fontSize: '22px', fontWeight: 700, color: 'white', marginBottom: '16px' }}>
                    Why Book With Us?
                  </h3>
                  <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                    {[
                      { icon: '✓', text: 'Instant confirmation via SMS & Email' },
                      { icon: '✓', text: 'Choose your preferred doctor & time slot' },
                      { icon: '✓', text: 'No waiting — priority scheduling' },
                      { icon: '✓', text: 'Reschedule or cancel hassle-free' },
                    ].map((item, i) => (
                      <div key={i} style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                        <div style={{
                          width: '28px', height: '28px', borderRadius: '50%',
                          background: 'var(--accent)', color: 'white',
                          display: 'flex', alignItems: 'center', justifyContent: 'center',
                          fontSize: '14px', fontWeight: 700, flexShrink: 0,
                        }}>
                          {item.icon}
                        </div>
                        <span style={{ fontSize: '15px', color: 'rgba(255,255,255,0.85)' }}>{item.text}</span>
                      </div>
                    ))}
                  </div>
                </div>

                <div style={{
                  background: 'white',
                  borderRadius: 'var(--radius-xl)',
                  padding: '32px',
                  border: '1px solid var(--border-light)',
                }}>
                  <h4 style={{ fontSize: '16px', fontWeight: 700, marginBottom: '20px' }}>Need Immediate Help?</h4>
                  <div style={{ display: 'flex', flexDirection: 'column', gap: '16px' }}>
                    <a href="tel:+917310000000" style={{
                      display: 'flex', alignItems: 'center', gap: '12px',
                      textDecoration: 'none', color: 'var(--text)',
                    }}>
                      <div style={{
                        width: '44px', height: '44px', borderRadius: '12px',
                        background: 'var(--primary-50)', display: 'flex', alignItems: 'center', justifyContent: 'center',
                        color: 'var(--primary)',
                      }}>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                          <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                      </div>
                      <div>
                        <div style={{ fontSize: '12px', color: 'var(--text-light)' }}>Call Us</div>
                        <div style={{ fontSize: '16px', fontWeight: 700 }}>+91 731 000 0000</div>
                      </div>
                    </a>
                    <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
                      <div style={{
                        width: '44px', height: '44px', borderRadius: '12px',
                        background: 'rgba(232,137,47,0.08)', display: 'flex', alignItems: 'center', justifyContent: 'center',
                        color: 'var(--secondary)',
                      }}>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                          <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
                        </svg>
                      </div>
                      <div>
                        <div style={{ fontSize: '12px', color: 'var(--text-light)' }}>OPD Timings</div>
                        <div style={{ fontSize: '16px', fontWeight: 700 }}>Mon–Sat: 9AM – 5PM</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {/* Right: Form */}
              <div style={{
                background: 'white',
                borderRadius: 'var(--radius-xl)',
                padding: '48px',
                boxShadow: 'var(--shadow-lg)',
                border: '1px solid var(--border-light)',
              }}>
                <h3 style={{ fontSize: '24px', fontWeight: 800, marginBottom: '8px' }}>
                  Schedule Your Visit
                </h3>
                <p style={{ fontSize: '15px', color: 'var(--text-secondary)', marginBottom: '32px' }}>
                  Fill in your details and we&apos;ll get back to you within an hour.
                </p>

                <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                  {/* Patient Info */}
                  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="form-row-grid">
                    <div>
                      <label className="form-label">Full Name *</label>
                      <input type="text" className="form-input" placeholder="John Doe" required />
                    </div>
                    <div>
                      <label className="form-label">Phone Number *</label>
                      <input type="tel" className="form-input" placeholder="+91 98765 43210" required />
                    </div>
                  </div>

                  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="form-row-grid">
                    <div>
                      <label className="form-label">Email Address</label>
                      <input type="email" className="form-input" placeholder="john@example.com" />
                    </div>
                    <div>
                      <label className="form-label">Date of Birth</label>
                      <input type="date" className="form-input" />
                    </div>
                  </div>

                  {/* Department & Doctor */}
                  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="form-row-grid">
                    <div>
                      <label className="form-label">Department *</label>
                      <select
                        className="form-input"
                        value={selectedDept}
                        onChange={(e) => { setSelectedDept(e.target.value); setSelectedDoctor(''); }}
                        required
                      >
                        <option value="">Select Department</option>
                        {departments.map((d) => (
                          <option key={d} value={d}>{d}</option>
                        ))}
                      </select>
                    </div>
                    <div>
                      <label className="form-label">Preferred Doctor</label>
                      <select
                        className="form-input"
                        value={selectedDoctor}
                        onChange={(e) => setSelectedDoctor(e.target.value)}
                      >
                        <option value="">Any Available Doctor</option>
                        {filteredDoctors.map((d) => (
                          <option key={d.name} value={d.name}>{d.name} ({d.exp})</option>
                        ))}
                      </select>
                    </div>
                  </div>

                  {/* Date & Time */}
                  <div>
                    <label className="form-label">Preferred Date *</label>
                    <input type="date" className="form-input" required />
                  </div>

                  <div>
                    <label className="form-label">Preferred Time Slot</label>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '8px' }} className="time-slots-grid">
                      {timeSlots.map((slot) => (
                        <button
                          key={slot}
                          type="button"
                          onClick={() => setSelectedTime(slot)}
                          style={{
                            padding: '10px 8px',
                            border: selectedTime === slot ? '2px solid var(--primary)' : '1px solid var(--border)',
                            borderRadius: 'var(--radius-md)',
                            background: selectedTime === slot ? 'var(--primary-50)' : 'white',
                            color: selectedTime === slot ? 'var(--primary)' : 'var(--text-secondary)',
                            fontWeight: selectedTime === slot ? 600 : 400,
                            fontSize: '13px',
                            cursor: 'pointer',
                            transition: 'all 0.15s ease',
                            fontFamily: 'inherit',
                          }}
                        >
                          {slot}
                        </button>
                      ))}
                    </div>
                  </div>

                  {/* Insurance */}
                  <div>
                    <label className="form-label">Insurance Provider (Optional)</label>
                    <select className="form-input">
                      <option value="">None / Self-Pay</option>
                      <option value="star">Star Health</option>
                      <option value="icici">ICICI Lombard</option>
                      <option value="hdfc">HDFC Ergo</option>
                      <option value="nia">New India Assurance</option>
                      <option value="ayushman">Ayushman Bharat</option>
                      <option value="other">Other</option>
                    </select>
                  </div>

                  {/* Message */}
                  <div>
                    <label className="form-label">Describe Your Concern (Optional)</label>
                    <textarea className="form-input" placeholder="Briefly describe your symptoms or reason for visit..." rows={3} />
                  </div>

                  <button type="submit" className="btn btn-secondary btn-lg" style={{ width: '100%', marginTop: '8px' }}>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                      <line x1="16" y1="2" x2="16" y2="6" />
                      <line x1="8" y1="2" x2="8" y2="6" />
                      <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Request Appointment
                  </button>

                  <p style={{ fontSize: '12px', color: 'var(--text-light)', textAlign: 'center', marginTop: '4px' }}>
                    By submitting, you agree to our privacy policy. We&apos;ll contact you within 1 hour during business hours.
                  </p>
                </form>
              </div>
            </div>
          )}
        </div>

        <style>{`
          @media (max-width: 968px) {
            .appointment-grid { grid-template-columns: 1fr !important; }
          }
          @media (max-width: 640px) {
            .form-row-grid { grid-template-columns: 1fr !important; }
            .time-slots-grid { grid-template-columns: repeat(3, 1fr) !important; }
          }
        `}</style>
      </section>
    </>
  );
}
