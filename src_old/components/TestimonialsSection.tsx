'use client';

import React from 'react';

const testimonials = [
  {
    name: 'Rajesh Verma',
    treatment: 'Cardiac Surgery',
    text: 'The care I received at CHI was exceptional. The doctors were very patient in explaining the procedure, and the nursing staff was incredibly supportive during my recovery.',
    rating: 5
  },
  {
    name: 'Sneha Kapoor',
    treatment: 'Maternity',
    text: 'Welcoming our first child at CHI was a wonderful experience. The facilities are top-notch and the mother & child care unit made us feel like family.',
    rating: 5
  },
  {
    name: 'Amitabh Singh',
    treatment: 'Orthopaedic Care',
    text: 'Post my accident, the rehabilitation team at CHI helped me get back on my feet faster than I expected. Truly world-class healthcare right here in Indore.',
    rating: 5
  }
];

export default function TestimonialsSection() {
  return (
    <section style={{ padding: '100px 0', background: 'var(--primary)', color: 'white' }}>
       <div className="container">
          <div style={{ textAlign: 'center', marginBottom: '60px' }}>
            <h2 className="section-title" style={{ color: 'white' }}>
              Patient <span style={{ color: 'var(--secondary)' }}>Stories</span>
            </h2>
            <p className="section-subtitle" style={{ margin: '0 auto', color: 'rgba(255,255,255,0.8)' }}>
              Hear what our patients have to say about their healing journey with us.
            </p>
          </div>

          <div style={{
              display: 'grid',
              gridTemplateColumns: 'repeat(3, 1fr)',
              gap: '24px',
          }} className="testimonials-grid">
              {testimonials.map((t, i) => (
                  <div key={i} style={{
                      background: 'rgba(255,255,255,0.1)',
                      borderRadius: 'var(--radius-lg)',
                      padding: '32px',
                      border: '1px solid rgba(255,255,255,0.2)',
                      backdropFilter: 'blur(10px)',
                  }}>
                      <div style={{ display: 'flex', gap: '4px', marginBottom: '16px' }}>
                          {[...Array(t.rating)].map((_, j) => (
                              <svg key={j} width="16" height="16" viewBox="0 0 24 24" fill="var(--secondary)" stroke="var(--secondary)">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                              </svg>
                          ))}
                      </div>
                      <p style={{ fontSize: '15px', lineHeight: 1.7, marginBottom: '24px', color: 'rgba(255,255,255,0.9)' }}>
                          "{t.text}"
                      </p>
                      <div>
                          <div style={{ fontWeight: 700, fontSize: '16px' }}>{t.name}</div>
                          <div style={{ fontSize: '13px', color: 'var(--secondary)' }}>{t.treatment}</div>
                      </div>
                  </div>
              ))}
          </div>
       </div>
       <style>{`
        @media (max-width: 968px) {
          .testimonials-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>
    </section>
  );
}
