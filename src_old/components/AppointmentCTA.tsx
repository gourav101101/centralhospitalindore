'use client';

import React from 'react';

export default function AppointmentCTA() {
  return (
    <section id="contact" style={{ padding: '80px 0', background: 'var(--bg-white)' }}>
      <div className="container">
        <div style={{
          background: 'var(--dark)',
          borderRadius: 'var(--radius-xl)',
          overflow: 'hidden',
          display: 'grid',
          gridTemplateColumns: '1fr 1fr',
          boxShadow: 'var(--shadow-xl)',
        }} className="cta-grid">
           
           {/* Left side text */}
           <div style={{ padding: '60px 40px', color: 'white', display: 'flex', flexDirection: 'column', justifyContent: 'center' }} className="cta-text">
               <h2 style={{ fontSize: '36px', color: 'white', marginBottom: '16px' }}>
                  Book an <span style={{ color: 'var(--secondary)' }}>Appointment</span>
               </h2>
               <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: '16px', marginBottom: '32px', lineHeight: 1.6 }}>
                  Get in touch with our specialists. Fill out the form, and our support team will contact you promptly to confirm your schedule.
               </p>
               <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                   <div style={{ display: 'flex', alignItems: 'center', gap: '16px' }}>
                       <div style={{ width: '48px', height: '48px', borderRadius: '50%', background: 'rgba(255,255,255,0.1)', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                          </svg>
                       </div>
                       <div>
                           <div style={{ fontSize: '13px', color: 'rgba(255,255,255,0.6)' }}>Call Us Anytime</div>
                           <div style={{ fontSize: '18px', fontWeight: 700 }}>+91 731 000 0000</div>
                       </div>
                   </div>
                   <div style={{ display: 'flex', alignItems: 'center', gap: '16px' }}>
                       <div style={{ width: '48px', height: '48px', borderRadius: '50%', background: 'rgba(255,255,255,0.1)', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                           <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                              <circle cx="12" cy="10" r="3" />
                           </svg>
                       </div>
                       <div>
                           <div style={{ fontSize: '13px', color: 'rgba(255,255,255,0.6)' }}>Visit Us</div>
                           <div style={{ fontSize: '16px', fontWeight: 700 }}>Pigdamber, Indore</div>
                       </div>
                   </div>
               </div>
           </div>

           {/* Right side form */}
           <div style={{ background: 'var(--primary)', padding: '60px 40px' }} className="cta-form-container">
               <form style={{ display: 'flex', flexDirection: 'column', gap: '16px' }} onSubmit={(e) => e.preventDefault()}>
                  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="form-row">
                      <input type="text" placeholder="Full Name" style={inputStyle} />
                      <input type="tel" placeholder="Phone Number" style={inputStyle} />
                  </div>
                  <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }} className="form-row">
                      <select style={inputStyle} defaultValue="">
                         <option value="" disabled>Select Department</option>
                         <option value="cardio">Cardiology</option>
                         <option value="neuro">Neurology</option>
                         <option value="ortho">Orthopaedics</option>
                         <option value="other">Other</option>
                      </select>
                      <input type="date" style={inputStyle} />
                  </div>
                  <textarea placeholder="Briefly describe your concern (Optional)" rows={3} style={{ ...inputStyle, resize: 'none' }}></textarea>
                  <button type="submit" className="btn btn-secondary btn-lg" style={{ width: '100%', marginTop: '8px' }}>
                     Request Appointment
                  </button>
               </form>
           </div>
        </div>
      </div>
      <style>{`
        @media (max-width: 968px) {
          .cta-grid { grid-template-columns: 1fr !important; }
          .cta-text { padding: 40px 24px !important; }
          .cta-form-container { padding: 40px 24px !important; }
        }
        @media (max-width: 640px) {
          .form-row { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}

const inputStyle = {
    padding: '14px 16px',
    borderRadius: '8px',
    border: 'none',
    background: 'rgba(255,255,255,0.9)',
    fontSize: '15px',
    outline: 'none',
    fontFamily: 'inherit',
    color: 'var(--text)'
};
