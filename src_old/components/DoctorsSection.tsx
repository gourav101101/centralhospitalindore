'use client';

import React from 'react';

const doctors = [
  {
    name: 'Dr. Ramesh Sharma',
    speciality: 'Chief Cardiologist',
    experience: '22+ Years',
    image: '/images/doctors-team.png', // Using the group photo as placeholder, can be replaced with individual ones
  },
  {
    name: 'Dr. Anita Desai',
    speciality: 'Senior Neurologist',
    experience: '18+ Years',
    image: '/images/doctors-team.png',
  },
  {
    name: 'Dr. Vikram Singh',
    speciality: 'Orthopaedic Surgeon',
    experience: '15+ Years',
    image: '/images/doctors-team.png',
  },
  {
    name: 'Dr. Priya Patel',
    speciality: 'Head of Pediatrics',
    experience: '12+ Years',
    image: '/images/doctors-team.png',
  }
];

export default function DoctorsSection() {
  return (
    <section id="doctors" style={{
      padding: '100px 0',
      background: 'var(--bg-lighter)',
    }}>
      <div className="container">
        <div style={{ textAlign: 'center', marginBottom: '60px' }}>
          <div className="section-badge" style={{ margin: '0 auto 16px' }}>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="8.5" cy="7" r="4" />
              <polyline points="17 11 19 13 23 9" />
            </svg>
            Our Experts
          </div>
          <h2 className="section-title">
            Meet Our <span style={{ color: 'var(--primary)' }}>Specialists</span>
          </h2>
          <p className="section-subtitle" style={{ margin: '0 auto' }}>
            Dedicated professionals committed to providing the highest standard of care.
          </p>
        </div>

        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(4, 1fr)',
          gap: '24px',
        }} className="doctors-grid">
          {doctors.map((doc, index) => (
            <div key={doc.name} className="card" style={{
              overflow: 'hidden',
              animation: `fadeInUp 0.5s ease-out ${index * 0.1}s forwards`,
              opacity: 0,
            }}>
              <div style={{
                height: '240px',
                backgroundImage: `url(${doc.image})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                position: 'relative'
              }}>
                 {/* This gradient makes the text below it stand out more if we placed text over the image, but we are placing it below. We can leave it for aesthetics */}
                 <div style={{
                     position: 'absolute',
                     bottom: 0,
                     left: 0,
                     right: 0,
                     height: '40%',
                     background: 'linear-gradient(to top, rgba(0,0,0,0.5), transparent)'
                 }}></div>
              </div>
              <div style={{ padding: '24px', textAlign: 'center' }}>
                <h3 style={{
                  fontSize: '18px',
                  fontWeight: 700,
                  marginBottom: '4px',
                  color: 'var(--text)'
                }}>
                  {doc.name}
                </h3>
                <p style={{
                  fontSize: '14px',
                  color: 'var(--primary)',
                  fontWeight: 600,
                  marginBottom: '12px'
                }}>
                  {doc.speciality}
                </p>
                <div style={{
                  display: 'inline-block',
                  background: 'var(--bg-light)',
                  padding: '4px 12px',
                  borderRadius: '12px',
                  fontSize: '12px',
                  color: 'var(--text-secondary)',
                  fontWeight: 500,
                  marginBottom: '20px'
                }}>
                  {doc.experience} Experience
                </div>
                <a href="#contact" className="btn btn-outline btn-sm" style={{ width: '100%' }}>
                  Book Appointment
                </a>
              </div>
            </div>
          ))}
        </div>
      </div>
      <style>{`
        @media (max-width: 1024px) {
          .doctors-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
        @media (max-width: 640px) {
          .doctors-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}
