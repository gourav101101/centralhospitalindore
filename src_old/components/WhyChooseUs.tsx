'use client';

import React from 'react';

const pillars = [
  {
    icon: (
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
        <circle cx="9" cy="7" r="4" />
        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
      </svg>
    ),
    title: 'Expert Doctors',
    description: '50+ specialists across 8 departments with decades of combined experience in world-class medical institutions.',
    stat: '50+',
    statLabel: 'Specialists',
    gradient: 'linear-gradient(135deg, #0A6E7C 0%, #0D8A9A 100%)',
  },
  {
    icon: (
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
        <line x1="8" y1="21" x2="16" y2="21" />
        <line x1="12" y1="17" x2="12" y2="21" />
        <path d="M6 8h.01M10 8h.01" />
      </svg>
    ),
    title: 'Advanced Technology',
    description: 'State-of-the-art equipment including advanced imaging, robotic-assisted procedures, and digital health records.',
    stat: '100+',
    statLabel: 'Equipment',
    gradient: 'linear-gradient(135deg, #8E44AD 0%, #9B59B6 100%)',
  },
  {
    icon: (
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
      </svg>
    ),
    title: 'Compassionate Care',
    description: 'Patient-first philosophy with personalized treatment plans, emotional support, and comprehensive aftercare programs.',
    stat: '98%',
    statLabel: 'Patient Satisfaction',
    gradient: 'linear-gradient(135deg, #E8892F 0%, #F09D4F 100%)',
  },
  {
    icon: (
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <circle cx="12" cy="12" r="10" />
        <polyline points="12 6 12 12 16 14" />
      </svg>
    ),
    title: '24/7 Emergency',
    description: 'Round-the-clock emergency services with rapid response teams, ambulance services, and trauma care specialists.',
    stat: '24/7',
    statLabel: 'Availability',
    gradient: 'linear-gradient(135deg, #E74C3C 0%, #C0392B 100%)',
  },
];

export default function WhyChooseUs() {
  return (
    <section style={{
      padding: '100px 0',
      background: 'var(--bg-white)',
      position: 'relative',
      overflow: 'hidden',
    }}>
      {/* Background decoration */}
      <div style={{
        position: 'absolute',
        top: '50%',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        width: '800px',
        height: '800px',
        borderRadius: '50%',
        background: 'radial-gradient(circle, var(--primary-50) 0%, transparent 60%)',
        pointerEvents: 'none',
      }} />

      <div className="container" style={{ position: 'relative', zIndex: 1 }}>
        <div style={{ textAlign: 'center', marginBottom: '60px' }}>
          <div className="section-badge" style={{ margin: '0 auto 16px' }}>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
            Why Choose Us
          </div>
          <h2 className="section-title">
            Why Patients Trust{' '}
            <span style={{ color: 'var(--primary)' }}>CHI</span>
          </h2>
          <p className="section-subtitle" style={{ margin: '0 auto' }}>
            We are committed to delivering healthcare that combines clinical
            excellence with genuine compassion.
          </p>
        </div>

        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(4, 1fr)',
          gap: '24px',
        }} className="pillars-grid">
          {pillars.map((pillar, index) => (
            <div
              key={pillar.title}
              style={{
                position: 'relative',
                borderRadius: 'var(--radius-xl)',
                overflow: 'hidden',
                background: 'white',
                border: '1px solid var(--border-light)',
                transition: 'var(--transition)',
                cursor: 'pointer',
                opacity: 0,
                animation: `fadeInUp 0.5s ease-out ${index * 0.1}s forwards`,
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.transform = 'translateY(-8px)';
                e.currentTarget.style.boxShadow = 'var(--shadow-xl)';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.transform = 'translateY(0)';
                e.currentTarget.style.boxShadow = 'none';
              }}
            >
              {/* Gradient top bar */}
              <div style={{
                height: '4px',
                background: pillar.gradient,
              }} />

              <div style={{ padding: '32px 24px' }}>
                {/* Icon */}
                <div style={{
                  width: '72px',
                  height: '72px',
                  borderRadius: '20px',
                  background: pillar.gradient,
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  color: 'white',
                  marginBottom: '24px',
                  boxShadow: `0 8px 20px ${pillar.gradient.includes('#0A6E7C') ? 'rgba(10,110,124,0.3)' : 'rgba(0,0,0,0.15)'}`,
                }}>
                  {pillar.icon}
                </div>

                <h3 style={{
                  fontSize: '19px',
                  fontWeight: 700,
                  color: 'var(--text)',
                  marginBottom: '12px',
                }}>
                  {pillar.title}
                </h3>

                <p style={{
                  fontSize: '14px',
                  color: 'var(--text-secondary)',
                  lineHeight: 1.7,
                  marginBottom: '24px',
                }}>
                  {pillar.description}
                </p>

                {/* Stat */}
                <div style={{
                  paddingTop: '16px',
                  borderTop: '1px solid var(--border-light)',
                  display: 'flex',
                  alignItems: 'baseline',
                  gap: '8px',
                }}>
                  <span style={{
                    fontSize: '28px',
                    fontWeight: 800,
                    color: 'var(--primary)',
                  }}>
                    {pillar.stat}
                  </span>
                  <span style={{
                    fontSize: '13px',
                    color: 'var(--text-light)',
                    fontWeight: 500,
                  }}>
                    {pillar.statLabel}
                  </span>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      <style>{`
        @media (max-width: 1024px) {
          .pillars-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
        @media (max-width: 640px) {
          .pillars-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}
