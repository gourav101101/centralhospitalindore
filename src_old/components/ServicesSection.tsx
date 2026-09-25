'use client';

import React from 'react';

const services = [
  {
    title: 'Labs & Diagnostics',
    desc: 'Advanced imaging and pathology lab services for accurate diagnosis.',
    icon: '🔬'
  },
  {
    title: 'Health Checkup',
    desc: 'Comprehensive preventive health packages for all age groups.',
    icon: '🩺'
  },
  {
    title: '24/7 Pharmacy',
    desc: 'Well-stocked in-house pharmacy available round the clock.',
    icon: '💊'
  },
  {
    title: 'Ambulance',
    desc: 'Fully equipped ACLS/BLS ambulances for emergency transport.',
    icon: '🚑'
  },
  {
    title: 'Homecare',
    desc: 'Nursing and physiotherapy services at the comfort of your home.',
    icon: '🏠'
  },
  {
    title: 'Rehabilitation',
    desc: 'Post-surgery recovery programs and physical therapy.',
    icon: '🏃'
  }
];

export default function ServicesSection() {
  return (
    <section id="services" style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
      <div className="container">
        <div style={{ textAlign: 'center', marginBottom: '60px' }}>
          <div className="section-badge">
             Patient Services
          </div>
          <h2 className="section-title">
            Our <span style={{ color: 'var(--primary)' }}>Support Services</span>
          </h2>
          <p className="section-subtitle" style={{ margin: '0 auto' }}>
            Extending our care beyond treatments with comprehensive support facilities.
          </p>
        </div>

        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(3, 1fr)',
          gap: '24px',
        }} className="services-grid">
          {services.map((svc, i) => (
             <div key={i} style={{
                padding: '24px',
                background: 'var(--bg-light)',
                borderRadius: 'var(--radius-lg)',
                border: '1px solid var(--border-light)',
                display: 'flex',
                alignItems: 'flex-start',
                gap: '16px',
                transition: 'var(--transition)',
             }}
             onMouseEnter={(e) => {
                e.currentTarget.style.transform = 'translateY(-4px)';
                e.currentTarget.style.boxShadow = 'var(--shadow-md)';
             }}
             onMouseLeave={(e) => {
                e.currentTarget.style.transform = 'translateY(0)';
                e.currentTarget.style.boxShadow = 'none';
             }}
             >
                <div style={{
                    fontSize: '32px',
                    width: '60px',
                    height: '60px',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    background: 'white',
                    borderRadius: '12px',
                    boxShadow: 'var(--shadow-sm)',
                    flexShrink: 0
                }}>
                    {svc.icon}
                </div>
                <div>
                    <h3 style={{ fontSize: '18px', fontWeight: 700, marginBottom: '8px', color: 'var(--text)' }}>
                        {svc.title}
                    </h3>
                    <p style={{ fontSize: '14px', color: 'var(--text-secondary)', lineHeight: 1.5, margin: 0 }}>
                        {svc.desc}
                    </p>
                </div>
             </div>
          ))}
        </div>
      </div>
      <style>{`
        @media (max-width: 968px) {
          .services-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
        @media (max-width: 640px) {
          .services-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}
