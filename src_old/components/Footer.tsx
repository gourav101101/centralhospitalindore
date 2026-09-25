'use client';

import React from 'react';
import Link from 'next/link';

export default function Footer() {
  const quickLinks = [
    { label: 'Home', href: '/' },
    { label: 'About Us', href: '/about' },
    { label: 'Our Doctors', href: '/#doctors' },
    { label: 'Patient Services', href: '/services' },
    { label: 'Health Library', href: '/#blog' },
    { label: 'Contact Us', href: '/contact' },
  ];

  const deptLinks = [
    { label: 'Cardiology', href: '/#departments' },
    { label: 'Neurology', href: '/#departments' },
    { label: 'Orthopaedics', href: '/#departments' },
    { label: 'Pediatrics', href: '/#departments' },
    { label: 'Critical Care', href: '/#departments' },
  ];

  return (
    <footer style={{ background: '#071322', color: 'rgba(255,255,255,0.7)', paddingTop: '80px', borderTop: '4px solid var(--primary)' }}>
      <div className="container">
         <div style={{
            display: 'grid',
            gridTemplateColumns: '2fr 1fr 1fr 1.5fr',
            gap: '40px',
            marginBottom: '60px'
         }} className="footer-grid">
            
            {/* Brand Col */}
            <div>
                <Link href="/" style={{ display: 'flex', alignItems: 'center', gap: '10px', textDecoration: 'none', marginBottom: '24px' }}>
                  <div style={{
                    width: '40px', height: '40px', background: 'var(--primary)', borderRadius: '10px',
                    display: 'flex', alignItems: 'center', justifyContent: 'center', color: 'white',
                    fontWeight: 900, fontSize: '18px'
                  }}>G</div>
                  <div>
                    <div style={{ fontSize: '20px', fontWeight: 800, color: 'white', lineHeight: 1.1 }}>CHI</div>
                    <div style={{ fontSize: '9px', fontWeight: 500, color: 'var(--primary)', letterSpacing: '0.08em', textTransform: 'uppercase' }}>Hospital · Indore</div>
                  </div>
                </Link>
                <p style={{ fontSize: '14px', lineHeight: 1.7, marginBottom: '24px' }}>
                    Central Hospital Indore is a premier healthcare destination offering world-class medical expertise with compassionate patient care.
                </p>
                <div style={{ display: 'flex', gap: '12px' }}>
                    {['facebook', 'twitter', 'instagram', 'youtube'].map((social) => (
                        <a key={social} href="#" style={{
                            width: '36px', height: '36px', borderRadius: '50%', background: 'rgba(255,255,255,0.1)',
                            display: 'flex', alignItems: 'center', justifyContent: 'center', color: 'white', textDecoration: 'none',
                            transition: 'var(--transition)'
                        }}
                        onMouseEnter={(e) => e.currentTarget.style.background = 'var(--primary)'}
                        onMouseLeave={(e) => e.currentTarget.style.background = 'rgba(255,255,255,0.1)'}
                        >
                            {/* Placeholder for social icons */}
                            <span style={{ fontSize: '12px', textTransform: 'uppercase' }}>{social[0]}</span>
                        </a>
                    ))}
                </div>
            </div>

            {/* Quick Links */}
            <div>
                <h4 style={{ color: 'white', fontSize: '16px', marginBottom: '24px' }}>Quick Links</h4>
                <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: '12px' }}>
                   {quickLinks.map(link => (
                       <li key={link.label}>
                          <Link href={link.href} style={{ color: 'rgba(255,255,255,0.7)', textDecoration: 'none', fontSize: '14px', transition: 'var(--transition)' }}
                             onMouseEnter={(e) => e.currentTarget.style.color = 'var(--primary)'}
                             onMouseLeave={(e) => e.currentTarget.style.color = 'rgba(255,255,255,0.7)'}
                          >{link.label}</Link>
                       </li>
                   ))}
                </ul>
            </div>

            {/* Departments */}
            <div>
                <h4 style={{ color: 'white', fontSize: '16px', marginBottom: '24px' }}>Departments</h4>
                <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'flex', flexDirection: 'column', gap: '12px' }}>
                   {deptLinks.map(link => (
                       <li key={link.label}>
                          <Link href={link.href} style={{ color: 'rgba(255,255,255,0.7)', textDecoration: 'none', fontSize: '14px', transition: 'var(--transition)' }}
                             onMouseEnter={(e) => e.currentTarget.style.color = 'var(--primary)'}
                             onMouseLeave={(e) => e.currentTarget.style.color = 'rgba(255,255,255,0.7)'}
                          >{link.label}</Link>
                       </li>
                   ))}
                </ul>
            </div>

            {/* Newsletter */}
            <div>
                <h4 style={{ color: 'white', fontSize: '16px', marginBottom: '24px' }}>Stay Updated</h4>
                <p style={{ fontSize: '14px', lineHeight: 1.6, marginBottom: '16px' }}>
                    Subscribe to our newsletter for health tips and hospital updates.
                </p>
                <div style={{ display: 'flex', gap: '8px' }}>
                   <input type="email" placeholder="Email Address" style={{ padding: '12px', borderRadius: '8px', border: 'none', background: 'rgba(255,255,255,0.1)', color: 'white', flex: 1, outline: 'none' }} />
                   <button className="btn btn-primary" style={{ padding: '12px 16px', borderRadius: '8px' }}>Subscribe</button>
                </div>
            </div>

         </div>

         <div style={{ borderTop: '1px solid rgba(255,255,255,0.1)', padding: '24px 0', display: 'flex', justifyContent: 'space-between', alignItems: 'center', fontSize: '13px' }} className="footer-bottom">
             <div>&copy; {new Date().getFullYear()} Avark Healthcare Pvt. Ltd. All rights reserved.</div>
             <div style={{ display: 'flex', gap: '16px' }}>
                 <Link href="#" style={{ color: 'rgba(255,255,255,0.7)', textDecoration: 'none' }}>Privacy Policy</Link>
                 <Link href="#" style={{ color: 'rgba(255,255,255,0.7)', textDecoration: 'none' }}>Terms of Service</Link>
             </div>
         </div>
      </div>
      <style>{`
        @media (max-width: 968px) {
          .footer-grid { grid-template-columns: 1fr 1fr !important; }
        }
        @media (max-width: 640px) {
          .footer-grid { grid-template-columns: 1fr !important; gap: 32px !important; }
          .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
        }
      `}</style>
    </footer>
  );
}
