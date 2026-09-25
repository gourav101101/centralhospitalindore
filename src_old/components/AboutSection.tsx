'use client';

import React, { useState, useEffect, useRef } from 'react';

function AnimatedCounter({ end, suffix = '' }: { end: number; suffix?: string }) {
  const [count, setCount] = useState(0);
  const ref = useRef<HTMLDivElement>(null);
  const hasAnimated = useRef(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !hasAnimated.current) {
          hasAnimated.current = true;
          let start = 0;
          const duration = 2000;
          const startTime = performance.now();

          const animate = (currentTime: number) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            start = Math.floor(eased * end);
            setCount(start);

            if (progress < 1) {
              requestAnimationFrame(animate);
            }
          };

          requestAnimationFrame(animate);
        }
      },
      { threshold: 0.3 }
    );

    if (ref.current) observer.observe(ref.current);
    return () => observer.disconnect();
  }, [end]);

  return <div ref={ref}>{count}{suffix}</div>;
}

const stats = [
  { num: 200, suffix: '+', label: 'Patient Beds', icon: '🏥' },
  { num: 50, suffix: '+', label: 'Expert Doctors', icon: '👨‍⚕️' },
  { num: 8, suffix: '', label: 'Specialities', icon: '🔬' },
  { num: 15000, suffix: '+', label: 'Patients Treated', icon: '❤️' },
];

export default function AboutSection() {
  return (
    <section id="about" style={{
      padding: '100px 0',
      background: 'var(--bg-white)',
      position: 'relative',
      overflow: 'hidden',
    }}>
      {/* Subtle background pattern */}
      <div style={{
        position: 'absolute',
        top: 0,
        right: 0,
        width: '40%',
        height: '100%',
        background: 'radial-gradient(circle at 70% 30%, var(--primary-50) 0%, transparent 60%)',
        pointerEvents: 'none',
      }} />

      <div className="container" style={{ position: 'relative', zIndex: 1 }}>
        <div style={{
          display: 'grid',
          gridTemplateColumns: '1fr 1fr',
          gap: '80px',
          alignItems: 'center',
        }} className="about-grid">
          {/* Left: Image */}
          <div style={{ position: 'relative' }} className="about-image">
            <img
              src="/images/hospital-interior.png"
              alt="Central Hospital Indore – Advanced Medical Technology"
              style={{
                width: '100%',
                borderRadius: '20px',
                boxShadow: 'var(--shadow-xl)',
              }}
            />
            {/* Experience badge */}
            <div style={{
              position: 'absolute',
              bottom: '-20px',
              right: '-20px',
              width: '130px',
              height: '130px',
              borderRadius: '50%',
              background: 'linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%)',
              display: 'flex',
              flexDirection: 'column',
              alignItems: 'center',
              justifyContent: 'center',
              color: 'white',
              boxShadow: 'var(--shadow-primary)',
            }}>
              <div style={{ fontSize: '36px', fontWeight: 900, lineHeight: 1 }}>10+</div>
              <div style={{ fontSize: '11px', fontWeight: 600, opacity: 0.9 }}>Years of</div>
              <div style={{ fontSize: '11px', fontWeight: 600, opacity: 0.9 }}>Excellence</div>
            </div>
          </div>

          {/* Right: Content */}
          <div>
            <div className="section-badge">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <path d="M12 2L12 22M2 12L22 12" />
              </svg>
              About Central Hospital Indore
            </div>

            <h2 className="section-title">
              A Premier Healthcare{' '}
              <span style={{ color: 'var(--primary)' }}>Destination</span> in Indore
            </h2>

            <p style={{
              fontSize: '16px',
              color: 'var(--text-secondary)',
              lineHeight: 1.8,
              marginBottom: '20px',
            }}>
              Central Hospital Indore is a premier healthcare
              destination, combining world-class medical expertise with
              personalized patient care. We offer emergency care, critical care,
              advanced surgeries, maternity, orthopaedics, and diagnostics under
              one roof.
            </p>

            <p style={{
              fontSize: '15px',
              color: 'var(--text-secondary)',
              lineHeight: 1.8,
              marginBottom: '32px',
              paddingLeft: '16px',
              borderLeft: '3px solid var(--secondary)',
            }}>
              <strong style={{ color: 'var(--text)' }}>Our Mission:</strong> To
              deliver advanced, ethical and compassionate healthcare with a focus
              on patient safety, clinical excellence and complete wellbeing.
            </p>

            <div style={{ display: 'flex', gap: '16px', flexWrap: 'wrap' }}>
              <a href="#departments" className="btn btn-primary">
                Our Departments
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
              </a>
              <a href="#doctors" className="btn btn-outline">
                Meet Our Doctors
              </a>
            </div>
          </div>
        </div>

        {/* Stats Row */}
        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(4, 1fr)',
          gap: '24px',
          marginTop: '80px',
        }} className="stats-grid">
          {stats.map((stat) => (
            <div key={stat.label} style={{
              textAlign: 'center',
              padding: '32px 20px',
              background: 'var(--bg-light)',
              borderRadius: 'var(--radius-lg)',
              border: '1px solid var(--border-light)',
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
              <div style={{ fontSize: '28px', marginBottom: '8px' }}>{stat.icon}</div>
              <div style={{
                fontSize: '36px',
                fontWeight: 800,
                color: 'var(--primary)',
                lineHeight: 1.1,
              }}>
                <AnimatedCounter end={stat.num} suffix={stat.suffix} />
              </div>
              <div style={{
                fontSize: '14px',
                fontWeight: 500,
                color: 'var(--text-secondary)',
                marginTop: '4px',
              }}>
                {stat.label}
              </div>
            </div>
          ))}
        </div>
      </div>

      <style>{`
        @media (max-width: 968px) {
          .about-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
          .about-image { order: 2; }
        }
        @media (max-width: 640px) {
          .stats-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
      `}</style>
    </section>
  );
}
