'use client';

import React, { useState, useEffect, useRef } from 'react';
import Link from 'next/link';

/* ────── Animated Counter (reusable) ────── */
function AnimatedCounter({ end, suffix = '' }: { end: number; suffix?: string }) {
  const [count, setCount] = useState(0);
  const ref = useRef<HTMLDivElement>(null);
  const hasAnimated = useRef(false);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !hasAnimated.current) {
          hasAnimated.current = true;
          const duration = 2000;
          const startTime = performance.now();

          const animate = (currentTime: number) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            setCount(Math.floor(eased * end));
            if (progress < 1) requestAnimationFrame(animate);
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

/* ────── Data ────── */
const stats = [
  { num: 200, suffix: '+', label: 'Patient Beds', icon: '🏥' },
  { num: 50, suffix: '+', label: 'Expert Doctors', icon: '👨‍⚕️' },
  { num: 8, suffix: '', label: 'Specialities', icon: '🔬' },
  { num: 15000, suffix: '+', label: 'Patients Treated', icon: '❤️' },
];

const values = [
  {
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
      </svg>
    ),
    title: 'Compassion',
    desc: 'Every patient is treated with empathy, dignity and respect as we focus on their complete wellbeing.',
  },
  {
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
      </svg>
    ),
    title: 'Excellence',
    desc: 'We pursue the highest standards in medical care, continuously advancing our protocols and outcomes.',
  },
  {
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <circle cx="12" cy="12" r="10" />
        <path d="M12 16v-4M12 8h.01" />
      </svg>
    ),
    title: 'Integrity',
    desc: 'Ethical practices, transparency, and honest communication form the foundation of our healthcare delivery.',
  },
  {
    icon: (
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
        <circle cx="9" cy="7" r="4" />
        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
      </svg>
    ),
    title: 'Teamwork',
    desc: 'Our multidisciplinary teams collaborate to deliver comprehensive, coordinated patient care.',
  },
];

const leaders = [
  { name: 'Dr. Arun Mehta', role: 'Managing Director & Chief Surgeon', exp: '25+ Years' },
  { name: 'Dr. Kavita Joshi', role: 'Medical Director', exp: '20+ Years' },
  { name: 'Mr. Rajendra Gupta', role: 'CEO & Hospital Administrator', exp: '18+ Years' },
  { name: 'Dr. Sanjay Verma', role: 'Head of Clinical Operations', exp: '15+ Years' },
];

const awards = [
  { title: 'NABH Accreditation', desc: 'National Accreditation Board for Hospitals & Healthcare Providers', year: '2020' },
  { title: 'Best Multispeciality Hospital', desc: 'Indore Healthcare Excellence Awards', year: '2022' },
  { title: 'Green Hospital Certification', desc: 'Environmentally sustainable healthcare practices', year: '2023' },
  { title: 'Patient Safety Excellence', desc: 'State Medical Council Recognition', year: '2024' },
];

const galleryImages = [
  { src: '/images/hospital-hero.png', alt: 'Hospital Exterior' },
  { src: '/images/hospital-interior.png', alt: 'Hospital Interior' },
  { src: '/images/doctors-team.png', alt: 'Our Medical Team' },
];

/* ────── Page Component ────── */
export default function AboutPage() {
  return (
    <>
      {/* Hero Banner */}
      <section className="page-hero">
        <div className="container">
          <div className="breadcrumb">
            <Link href="/">Home</Link>
            <span className="separator">/</span>
            <span style={{ color: 'white' }}>About Us</span>
          </div>
          <h1>
            About <span style={{ color: 'var(--secondary)' }}>Central Hospital Indore</span>
          </h1>
          <p>
            Central Hospital Indore — a premier healthcare destination combining world-class medical expertise with compassionate patient care since 2015.
          </p>
        </div>
      </section>

      {/* ── Our Story ── */}
      <section style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '80px', alignItems: 'center' }} className="about-story-grid">
            <div>
              <div className="section-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                  <path d="M12 2L12 22M2 12L22 12" />
                </svg>
                Our Story
              </div>
              <h2 className="section-title">
                A Decade of <span style={{ color: 'var(--primary)' }}>Healing</span> & Hope
              </h2>
              <p style={{ fontSize: '16px', color: 'var(--text-secondary)', lineHeight: 1.8, marginBottom: '20px' }}>
                Founded in 2015, Central Hospital Indore (CHI) was established with a singular vision — to bring world-class healthcare to the heart of Indore. What started as a 50-bed facility has now grown into a 200+ bed multispeciality hospital trusted by thousands of families.
              </p>
              <p style={{ fontSize: '16px', color: 'var(--text-secondary)', lineHeight: 1.8, marginBottom: '32px' }}>
                Under the umbrella of Avark Healthcare Pvt. Ltd., CHI has invested in state-of-the-art medical technology, recruited top specialists from across India, and built a culture of compassionate care that puts patients and their families first.
              </p>
              <div style={{ display: 'flex', gap: '16px', flexWrap: 'wrap' }}>
                <Link href="/appointment" className="btn btn-primary">
                  Book Appointment
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                  </svg>
                </Link>
                <Link href="/contact" className="btn btn-outline">
                  Contact Us
                </Link>
              </div>
            </div>
            <div style={{ position: 'relative' }}>
              <img
                src="/images/hospital-interior.png"
                alt="Central Hospital Indore – Advanced Medical Technology"
                style={{
                  width: '100%',
                  borderRadius: '20px',
                  boxShadow: 'var(--shadow-xl)',
                }}
              />
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
          </div>
        </div>
        <style>{`
          @media (max-width: 968px) {
            .about-story-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
          }
        `}</style>
      </section>

      {/* ── Mission & Vision ── */}
      <section id="mission" style={{ padding: '100px 0', background: 'var(--bg-light)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>Our Purpose</div>
            <h2 className="section-title">
              Mission & <span style={{ color: 'var(--primary)' }}>Vision</span>
            </h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '32px', maxWidth: '900px', margin: '0 auto' }} className="mission-grid">
            <div style={{
              padding: '40px',
              background: 'white',
              borderRadius: 'var(--radius-xl)',
              border: '1px solid var(--border-light)',
              position: 'relative',
              overflow: 'hidden',
            }}>
              <div style={{ position: 'absolute', top: 0, left: 0, right: 0, height: '4px', background: 'linear-gradient(90deg, var(--primary), var(--primary-light))' }} />
              <div style={{
                width: '60px', height: '60px', borderRadius: '16px',
                background: 'var(--primary-50)', display: 'flex', alignItems: 'center', justifyContent: 'center',
                color: 'var(--primary)', marginBottom: '20px',
              }}>
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                  <circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="6" /><circle cx="12" cy="12" r="2" />
                </svg>
              </div>
              <h3 style={{ fontSize: '22px', fontWeight: 700, marginBottom: '12px' }}>Our Mission</h3>
              <p style={{ fontSize: '15px', color: 'var(--text-secondary)', lineHeight: 1.7 }}>
                To deliver advanced, ethical and compassionate healthcare with a focus on patient safety, clinical excellence and complete wellbeing — accessible to every family in the region.
              </p>
            </div>
            <div style={{
              padding: '40px',
              background: 'white',
              borderRadius: 'var(--radius-xl)',
              border: '1px solid var(--border-light)',
              position: 'relative',
              overflow: 'hidden',
            }}>
              <div style={{ position: 'absolute', top: 0, left: 0, right: 0, height: '4px', background: 'linear-gradient(90deg, var(--secondary), #F09D4F)' }} />
              <div style={{
                width: '60px', height: '60px', borderRadius: '16px',
                background: 'rgba(232,137,47,0.08)', display: 'flex', alignItems: 'center', justifyContent: 'center',
                color: 'var(--secondary)', marginBottom: '20px',
              }}>
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                  <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" /><circle cx="12" cy="12" r="3" />
                </svg>
              </div>
              <h3 style={{ fontSize: '22px', fontWeight: 700, marginBottom: '12px' }}>Our Vision</h3>
              <p style={{ fontSize: '15px', color: 'var(--text-secondary)', lineHeight: 1.7 }}>
                To be the most trusted and preferred multispeciality hospital in Central India, recognized for clinical innovation, patient-centric care and outstanding health outcomes.
              </p>
            </div>
          </div>
        </div>
        <style>{`
          @media (max-width: 640px) {
            .mission-grid { grid-template-columns: 1fr !important; }
          }
        `}</style>
      </section>

      {/* ── Core Values ── */}
      <section style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>What We Stand For</div>
            <h2 className="section-title">
              Our Core <span style={{ color: 'var(--primary)' }}>Values</span>
            </h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '24px' }} className="values-grid">
            {values.map((val, i) => (
              <div key={i} style={{
                padding: '32px 24px',
                background: 'var(--bg-light)',
                borderRadius: 'var(--radius-lg)',
                border: '1px solid var(--border-light)',
                textAlign: 'center',
                transition: 'var(--transition)',
              }}
              onMouseEnter={(e) => { e.currentTarget.style.transform = 'translateY(-6px)'; e.currentTarget.style.boxShadow = 'var(--shadow-md)'; }}
              onMouseLeave={(e) => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = 'none'; }}
              >
                <div style={{
                  width: '64px', height: '64px', borderRadius: '16px',
                  background: 'linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%)',
                  display: 'flex', alignItems: 'center', justifyContent: 'center',
                  color: 'white', margin: '0 auto 20px',
                }}>
                  {val.icon}
                </div>
                <h3 style={{ fontSize: '18px', fontWeight: 700, marginBottom: '8px' }}>{val.title}</h3>
                <p style={{ fontSize: '14px', color: 'var(--text-secondary)', lineHeight: 1.6, margin: 0 }}>{val.desc}</p>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 1024px) { .values-grid { grid-template-columns: repeat(2, 1fr) !important; } }
          @media (max-width: 640px) { .values-grid { grid-template-columns: 1fr !important; } }
        `}</style>
      </section>

      {/* ── Stats ── */}
      <section style={{ padding: '80px 0', background: 'var(--primary)', color: 'white' }}>
        <div className="container">
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '24px' }} className="about-stats-grid">
            {stats.map((stat) => (
              <div key={stat.label} style={{ textAlign: 'center', padding: '20px' }}>
                <div style={{ fontSize: '28px', marginBottom: '8px' }}>{stat.icon}</div>
                <div style={{ fontSize: '42px', fontWeight: 800, color: 'var(--secondary)', lineHeight: 1.1 }}>
                  <AnimatedCounter end={stat.num} suffix={stat.suffix} />
                </div>
                <div style={{ fontSize: '14px', fontWeight: 500, color: 'rgba(255,255,255,0.8)', marginTop: '4px' }}>
                  {stat.label}
                </div>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 640px) { .about-stats-grid { grid-template-columns: repeat(2, 1fr) !important; } }
        `}</style>
      </section>

      {/* ── Leadership ── */}
      <section id="leadership" style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>Leadership</div>
            <h2 className="section-title">
              Our <span style={{ color: 'var(--primary)' }}>Leadership</span> Team
            </h2>
            <p className="section-subtitle" style={{ margin: '0 auto' }}>
              Experienced professionals guiding CHI towards excellence in healthcare.
            </p>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '24px' }} className="leaders-grid">
            {leaders.map((leader, i) => (
              <div key={i} className="card" style={{ overflow: 'hidden', opacity: 0, animation: `fadeInUp 0.5s ease-out ${i * 0.1}s forwards` }}>
                <div style={{
                  height: '200px',
                  background: `linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%)`,
                  display: 'flex', alignItems: 'center', justifyContent: 'center',
                }}>
                  <div style={{
                    width: '80px', height: '80px', borderRadius: '50%', background: 'rgba(255,255,255,0.2)',
                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                    fontSize: '32px', fontWeight: 800, color: 'white',
                  }}>
                    {leader.name.split(' ').map(n => n[0]).join('').slice(0, 2)}
                  </div>
                </div>
                <div style={{ padding: '24px', textAlign: 'center' }}>
                  <h3 style={{ fontSize: '18px', fontWeight: 700, marginBottom: '4px' }}>{leader.name}</h3>
                  <p style={{ fontSize: '14px', color: 'var(--primary)', fontWeight: 600, marginBottom: '8px' }}>{leader.role}</p>
                  <div style={{
                    display: 'inline-block', background: 'var(--bg-light)', padding: '4px 12px',
                    borderRadius: '12px', fontSize: '12px', color: 'var(--text-secondary)', fontWeight: 500,
                  }}>
                    {leader.exp} Experience
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 1024px) { .leaders-grid { grid-template-columns: repeat(2, 1fr) !important; } }
          @media (max-width: 640px) { .leaders-grid { grid-template-columns: 1fr !important; } }
        `}</style>
      </section>

      {/* ── Awards & Accreditations ── */}
      <section id="awards" style={{ padding: '100px 0', background: 'var(--bg-light)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>Recognition</div>
            <h2 className="section-title">
              Awards & <span style={{ color: 'var(--primary)' }}>Accreditations</span>
            </h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: '24px' }} className="awards-grid">
            {awards.map((award, i) => (
              <div key={i} style={{
                padding: '32px 24px',
                background: 'white',
                borderRadius: 'var(--radius-lg)',
                border: '1px solid var(--border-light)',
                textAlign: 'center',
                transition: 'var(--transition)',
              }}
              onMouseEnter={(e) => { e.currentTarget.style.transform = 'translateY(-4px)'; e.currentTarget.style.boxShadow = 'var(--shadow-md)'; }}
              onMouseLeave={(e) => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = 'none'; }}
              >
                <div style={{
                  width: '56px', height: '56px', borderRadius: '50%',
                  background: 'linear-gradient(135deg, var(--secondary), #F09D4F)',
                  display: 'flex', alignItems: 'center', justifyContent: 'center',
                  color: 'white', margin: '0 auto 16px',
                }}>
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                    <circle cx="12" cy="8" r="7" /><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                  </svg>
                </div>
                <div style={{ fontSize: '13px', fontWeight: 600, color: 'var(--primary)', marginBottom: '8px' }}>{award.year}</div>
                <h3 style={{ fontSize: '17px', fontWeight: 700, marginBottom: '8px', lineHeight: 1.3 }}>{award.title}</h3>
                <p style={{ fontSize: '13px', color: 'var(--text-secondary)', lineHeight: 1.5, margin: 0 }}>{award.desc}</p>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 1024px) { .awards-grid { grid-template-columns: repeat(2, 1fr) !important; } }
          @media (max-width: 640px) { .awards-grid { grid-template-columns: 1fr !important; } }
        `}</style>
      </section>

      {/* ── Gallery ── */}
      <section id="gallery" style={{ padding: '100px 0', background: 'var(--bg-white)' }}>
        <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <div className="section-badge" style={{ margin: '0 auto 16px' }}>Our Campus</div>
            <h2 className="section-title">
              Hospital <span style={{ color: 'var(--primary)' }}>Gallery</span>
            </h2>
          </div>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: '24px' }} className="gallery-grid">
            {galleryImages.map((img, i) => (
              <div key={i} style={{
                borderRadius: 'var(--radius-lg)',
                overflow: 'hidden',
                position: 'relative',
                cursor: 'pointer',
                transition: 'var(--transition)',
              }}
              onMouseEnter={(e) => { e.currentTarget.style.transform = 'translateY(-6px)'; e.currentTarget.style.boxShadow = 'var(--shadow-xl)'; }}
              onMouseLeave={(e) => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = 'none'; }}
              >
                <img src={img.src} alt={img.alt} style={{ width: '100%', height: '280px', objectFit: 'cover', display: 'block' }} />
                <div style={{
                  position: 'absolute', bottom: 0, left: 0, right: 0,
                  background: 'linear-gradient(to top, rgba(0,0,0,0.7), transparent)',
                  padding: '40px 20px 20px', color: 'white',
                  fontSize: '16px', fontWeight: 600,
                }}>
                  {img.alt}
                </div>
              </div>
            ))}
          </div>
        </div>
        <style>{`
          @media (max-width: 640px) { .gallery-grid { grid-template-columns: 1fr !important; } }
        `}</style>
      </section>

      {/* ── CTA ── */}
      <section style={{ padding: '80px 0', background: 'var(--dark)', color: 'white', textAlign: 'center' }}>
        <div className="container">
          <h2 style={{ fontSize: 'clamp(28px, 4vw, 40px)', fontWeight: 800, color: 'white', marginBottom: '16px' }}>
            Ready to Experience <span style={{ color: 'var(--secondary)' }}>World-Class</span> Healthcare?
          </h2>
          <p style={{ fontSize: '17px', color: 'rgba(255,255,255,0.7)', maxWidth: '600px', margin: '0 auto 32px', lineHeight: 1.7 }}>
            Book your appointment today and let our team of expert specialists take care of you.
          </p>
          <div style={{ display: 'flex', gap: '16px', justifyContent: 'center', flexWrap: 'wrap' }}>
            <Link href="/appointment" className="btn btn-secondary btn-lg">
              Book Appointment
            </Link>
            <Link href="/contact" className="btn btn-white btn-lg">
              Contact Us
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
