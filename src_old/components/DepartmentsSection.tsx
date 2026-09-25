'use client';

import React from 'react';

const departments = [
  {
    name: 'Accident & Emergency',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M12 2L12 22M2 12L22 12" />
        <circle cx="12" cy="12" r="10" />
      </svg>
    ),
    description: 'Round-the-clock emergency services with advanced trauma care and rapid response teams.',
    color: '#E74C3C',
  },
  {
    name: 'Cardiac Sciences',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
      </svg>
    ),
    description: 'Comprehensive cardiac care including interventional cardiology, cardiac surgery and rehabilitation.',
    color: '#C0392B',
  },
  {
    name: 'Neurosciences',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M12 2a7 7 0 0 1 7 7c0 2.38-1.19 4.47-3 5.74V17a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2.26C6.19 13.47 5 11.38 5 9a7 7 0 0 1 7-7z" />
        <path d="M9 21h6M10 17v4M14 17v4" />
      </svg>
    ),
    description: 'Expert neurological and neurosurgical care for brain, spine and nervous system disorders.',
    color: '#9B59B6',
  },
  {
    name: 'Mother & Child',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <circle cx="12" cy="4" r="2" />
        <path d="M12 6v4l-3 5h6l-3-5" />
        <circle cx="16" cy="12" r="1.5" />
        <path d="M16 13.5v2l-1 2.5h2l-1-2.5" />
      </svg>
    ),
    description: 'Complete maternity care, neonatology, pediatric ICU, and family-centered birth experiences.',
    color: '#E91E8C',
  },
  {
    name: 'Bone & Joint',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M18 4a2 2 0 0 0-2 2 2 2 0 0 0-2-2 2 2 0 0 0-2 2v1a3 3 0 0 0 3 3h2a3 3 0 0 0 3-3V6a2 2 0 0 0-2-2z" />
        <path d="M6 20a2 2 0 0 1 2-2 2 2 0 0 1 2 2 2 2 0 0 1 2-2v-1a3 3 0 0 1-3-3H7a3 3 0 0 1-3 3v1a2 2 0 0 1 2 2z" />
        <line x1="12" y1="10" x2="12" y2="14" />
      </svg>
    ),
    description: 'Advanced orthopaedic treatments including joint replacement, sports medicine and spine surgery.',
    color: '#3498DB',
  },
  {
    name: 'Critical Care',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
      </svg>
    ),
    description: 'State-of-the-art ICU with 24/7 intensivists, advanced monitoring and life support systems.',
    color: '#E67E22',
  },
  {
    name: 'Cancer Care',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <circle cx="12" cy="12" r="3" />
        <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
      </svg>
    ),
    description: 'Comprehensive oncology services including chemotherapy, radiation therapy and surgical oncology.',
    color: '#1ABC9C',
  },
  {
    name: 'Physical Medicine',
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <circle cx="12" cy="5" r="3" />
        <path d="M12 8v8M8 12h8M8 20l4-4 4 4" />
      </svg>
    ),
    description: 'Rehabilitation and physiotherapy for recovery from surgeries, injuries and chronic conditions.',
    color: '#2ECC71',
  },
];

export default function DepartmentsSection() {
  return (
    <section id="departments" style={{
      padding: '100px 0',
      background: 'var(--bg-light)',
    }}>
      <div className="container">
        {/* Header */}
        <div style={{ textAlign: 'center', marginBottom: '60px' }}>
          <div className="section-badge" style={{ margin: '0 auto 16px' }}>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
              <rect x="3" y="3" width="18" height="18" rx="2" />
              <path d="M3 9h18M9 21V9" />
            </svg>
            Our Departments
          </div>
          <h2 className="section-title">
            Comprehensive{' '}
            <span style={{ color: 'var(--primary)' }}>Specialities</span>
          </h2>
          <p className="section-subtitle" style={{ margin: '0 auto' }}>
            Our expert team provides advanced medical care across a wide range
            of specialities, ensuring complete healthcare under one roof.
          </p>
        </div>

        {/* Department Grid */}
        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(4, 1fr)',
          gap: '24px',
        }} className="departments-grid">
          {departments.map((dept, index) => (
            <div
              key={dept.name}
              className="card"
              style={{
                padding: '32px 24px',
                cursor: 'pointer',
                position: 'relative',
                overflow: 'hidden',
                opacity: 0,
                animation: `fadeInUp 0.5s ease-out ${index * 0.08}s forwards`,
              }}
              onMouseEnter={(e) => {
                const el = e.currentTarget;
                el.style.borderColor = dept.color + '40';
              }}
              onMouseLeave={(e) => {
                const el = e.currentTarget;
                el.style.borderColor = 'var(--border-light)';
              }}
            >
              {/* Top accent line */}
              <div style={{
                position: 'absolute',
                top: 0,
                left: 0,
                right: 0,
                height: '3px',
                background: dept.color,
                opacity: 0.7,
              }} />

              <div style={{
                width: '60px',
                height: '60px',
                borderRadius: '16px',
                background: `${dept.color}12`,
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                color: dept.color,
                marginBottom: '20px',
              }}>
                {dept.icon}
              </div>

              <h3 style={{
                fontSize: '17px',
                fontWeight: 700,
                color: 'var(--text)',
                marginBottom: '10px',
                lineHeight: 1.3,
              }}>
                {dept.name}
              </h3>

              <p style={{
                fontSize: '13px',
                color: 'var(--text-secondary)',
                lineHeight: 1.6,
                margin: 0,
              }}>
                {dept.description}
              </p>

              <div style={{
                marginTop: '16px',
                fontSize: '13px',
                fontWeight: 600,
                color: dept.color,
                display: 'flex',
                alignItems: 'center',
                gap: '6px',
              }}>
                Learn More
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
              </div>
            </div>
          ))}
        </div>
      </div>

      <style>{`
        @media (max-width: 1024px) {
          .departments-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
        @media (max-width: 640px) {
          .departments-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}
