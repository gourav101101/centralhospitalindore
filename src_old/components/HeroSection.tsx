'use client';

import React from 'react';

export default function HeroSection() {
  return (
    <section style={{
      position: 'relative',
      minHeight: '88vh',
      display: 'flex',
      alignItems: 'center',
      overflow: 'hidden',
    }}>
      {/* Background */}
      <div style={{
        position: 'absolute',
        inset: 0,
        background: 'linear-gradient(135deg, #0B1D35 0%, #0A4A54 40%, #0A6E7C 70%, #0D8A9A 100%)',
        zIndex: 0,
      }} />

      {/* Decorative circles */}
      <div style={{
        position: 'absolute',
        top: '-10%',
        right: '-5%',
        width: '600px',
        height: '600px',
        borderRadius: '50%',
        background: 'radial-gradient(circle, rgba(232,137,47,0.12) 0%, transparent 70%)',
        zIndex: 1,
      }} />
      <div style={{
        position: 'absolute',
        bottom: '-20%',
        left: '-10%',
        width: '800px',
        height: '800px',
        borderRadius: '50%',
        background: 'radial-gradient(circle, rgba(10,110,124,0.2) 0%, transparent 70%)',
        zIndex: 1,
      }} />

      {/* Floating medical icons */}
      <div className="animate-float" style={{
        position: 'absolute',
        top: '15%',
        right: '10%',
        width: '80px',
        height: '80px',
        background: 'rgba(255,255,255,0.08)',
        borderRadius: '20px',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        backdropFilter: 'blur(10px)',
        zIndex: 2,
      }}>
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.6)" strokeWidth="1.5">
          <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
        </svg>
      </div>

      <div className="animate-float delay-300" style={{
        position: 'absolute',
        bottom: '20%',
        right: '18%',
        width: '60px',
        height: '60px',
        background: 'rgba(255,255,255,0.06)',
        borderRadius: '16px',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        backdropFilter: 'blur(10px)',
        zIndex: 2,
      }}>
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(232,137,47,0.7)" strokeWidth="1.5">
          <path d="M12 2L12 22M2 12L22 12" />
          <circle cx="12" cy="12" r="3" />
        </svg>
      </div>

      {/* Content */}
      <div className="container" style={{
        position: 'relative',
        zIndex: 10,
        display: 'grid',
        gridTemplateColumns: '1fr 1fr',
        gap: '60px',
        alignItems: 'center',
        paddingTop: '40px',
        paddingBottom: '40px',
      }}>
        {/* Left: Text */}
        <div className="hero-text">
          <div className="animate-fade-in-up" style={{
            display: 'inline-flex',
            alignItems: 'center',
            gap: '8px',
            padding: '8px 18px',
            background: 'rgba(255,255,255,0.1)',
            borderRadius: 'var(--radius-full)',
            border: '1px solid rgba(255,255,255,0.15)',
            marginBottom: '24px',
          }}>
            <span className="emergency-dot" />
            <span style={{ color: 'rgba(255,255,255,0.9)', fontSize: '13px', fontWeight: 600 }}>
              Trusted Healthcare Since 2015
            </span>
          </div>

          <h1 className="animate-fade-in-up delay-100" style={{
            fontSize: 'clamp(36px, 5vw, 56px)',
            fontWeight: 900,
            color: 'white',
            lineHeight: 1.08,
            marginBottom: '20px',
            letterSpacing: '-0.03em',
          }}>
            World-Class<br />
            <span style={{
              background: 'linear-gradient(135deg, var(--secondary) 0%, #F9C74F 100%)',
              WebkitBackgroundClip: 'text',
              WebkitTextFillColor: 'transparent',
              backgroundClip: 'text',
            }}>
              Healthcare
            </span>{' '}
            in Indore
          </h1>

          <p className="animate-fade-in-up delay-200" style={{
            fontSize: '17px',
            color: 'rgba(255,255,255,0.75)',
            lineHeight: 1.7,
            maxWidth: '480px',
            marginBottom: '36px',
          }}>
            Central Hospital Indore combines advanced medical
            expertise with compassionate patient care, offering comprehensive
            treatments from emergency care to advanced surgeries.
          </p>

          <div className="animate-fade-in-up delay-300" style={{
            display: 'flex',
            gap: '16px',
            flexWrap: 'wrap',
          }}>
            <a href="#contact" className="btn btn-secondary btn-lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
              Book Appointment
            </a>
            <a href="tel:+917310000000" className="btn btn-white btn-lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              Call Now
            </a>
          </div>

          {/* Trust indicators */}
          <div className="animate-fade-in-up delay-500" style={{
            display: 'flex',
            gap: '32px',
            marginTop: '48px',
            paddingTop: '32px',
            borderTop: '1px solid rgba(255,255,255,0.1)',
          }}>
            {[
              { num: '200+', label: 'Beds' },
              { num: '50+', label: 'Expert Doctors' },
              { num: '8', label: 'Specialities' },
              { num: '10+', label: 'Years of Care' },
            ].map((stat) => (
              <div key={stat.label} style={{ textAlign: 'center' }}>
                <div style={{
                  fontSize: '28px',
                  fontWeight: 800,
                  color: 'var(--secondary)',
                  lineHeight: 1,
                }}>
                  {stat.num}
                </div>
                <div style={{
                  fontSize: '12px',
                  color: 'rgba(255,255,255,0.6)',
                  marginTop: '4px',
                  fontWeight: 500,
                }}>
                  {stat.label}
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Right: Image */}
        <div className="hero-image animate-fade-in-right delay-200" style={{
          position: 'relative',
        }}>
          {/* Glow behind image */}
          <div style={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            width: '90%',
            height: '90%',
            borderRadius: '50%',
            background: 'radial-gradient(circle, rgba(232,137,47,0.15) 0%, transparent 70%)',
          }} />
          <img
            src="/images/hospital-hero.png"
            alt="Central Hospital Indore – Central Hospital Indore"
            style={{
              width: '100%',
              height: 'auto',
              borderRadius: '24px',
              position: 'relative',
              zIndex: 1,
              boxShadow: '0 24px 80px rgba(0,0,0,0.3)',
            }}
          />
          {/* Floating badge */}
          <div className="animate-float delay-400" style={{
            position: 'absolute',
            bottom: '24px',
            left: '-20px',
            background: 'rgba(255,255,255,0.95)',
            backdropFilter: 'blur(20px)',
            borderRadius: '16px',
            padding: '16px 20px',
            boxShadow: 'var(--shadow-lg)',
            zIndex: 2,
            display: 'flex',
            alignItems: 'center',
            gap: '12px',
          }}>
            <div style={{
              width: '44px',
              height: '44px',
              borderRadius: '12px',
              background: 'linear-gradient(135deg, #2ECC71, #27AE60)',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
            }}>
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" strokeWidth="2.5">
                <path d="M20 6L9 17l-5-5" />
              </svg>
            </div>
            <div>
              <div style={{ fontSize: '14px', fontWeight: 700, color: 'var(--text)' }}>NABH Accredited</div>
              <div style={{ fontSize: '12px', color: 'var(--text-secondary)' }}>Quality Healthcare</div>
            </div>
          </div>
        </div>
      </div>

      {/* Responsive */}
      <style>{`
        @media (max-width: 968px) {
          .hero-text { text-align: center; }
          .hero-text > .animate-fade-in-up:nth-child(4) { justify-content: center; }
          .hero-text > .animate-fade-in-up:nth-child(5) { justify-content: center; }
          .hero-image { display: none; }
          section > .container { grid-template-columns: 1fr !important; }
        }
        @media (max-width: 640px) {
          .hero-text > .animate-fade-in-up:nth-child(5) { gap: 16px !important; flex-wrap: wrap; }
        }
      `}</style>
    </section>
  );
}
