'use client';

import React, { useState, useEffect, useRef } from 'react';
import Link from 'next/link';

/* ────────── Nav Data Structure ────────── */
interface SubItem {
  label: string;
  href: string;
  desc?: string;
  icon: React.ReactNode;
}

interface NavItem {
  label: string;
  href: string;
  children?: SubItem[];
}

const navItems: NavItem[] = [
  {
    label: 'About',
    href: '/about',
    children: [
      {
        label: 'About CHI',
        href: '/about',
        desc: 'Our history, mission & values',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" /></svg>,
      },
      {
        label: 'Our Mission',
        href: '/about#mission',
        desc: 'What drives us every day',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="6" /><circle cx="12" cy="12" r="2" /></svg>,
      },
      {
        label: 'Leadership',
        href: '/about#leadership',
        desc: 'Meet our management team',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" /></svg>,
      },
      {
        label: 'Awards & Accreditations',
        href: '/about#awards',
        desc: 'NABH & quality certifications',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><circle cx="12" cy="8" r="7" /><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" /></svg>,
      },
      {
        label: 'Gallery',
        href: '/about#gallery',
        desc: 'Inside our hospital campus',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><rect x="3" y="3" width="18" height="18" rx="2" /><circle cx="8.5" cy="8.5" r="1.5" /><polyline points="21 15 16 10 5 21" /></svg>,
      },
    ],
  },
  {
    label: 'Specialities',
    href: '/#departments',
    children: [
      {
        label: 'Cardiac Sciences',
        href: '/#departments',
        desc: 'Interventional & surgical cardiology',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C0392B" strokeWidth="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" /></svg>,
      },
      {
        label: 'Neurosciences',
        href: '/#departments',
        desc: 'Brain, spine & nervous system',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9B59B6" strokeWidth="1.5"><path d="M12 2a7 7 0 0 1 7 7c0 2.38-1.19 4.47-3 5.74V17a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2.26C6.19 13.47 5 11.38 5 9a7 7 0 0 1 7-7z" /><path d="M9 21h6" /></svg>,
      },
      {
        label: 'Orthopaedics',
        href: '/#departments',
        desc: 'Joint replacement & sports medicine',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3498DB" strokeWidth="1.5"><path d="M18 4a2 2 0 0 0-2 2 2 2 0 0 0-2-2 2 2 0 0 0-2 2v1a3 3 0 0 0 3 3h2a3 3 0 0 0 3-3V6a2 2 0 0 0-2-2z" /><line x1="12" y1="10" x2="12" y2="14" /></svg>,
      },
      {
        label: 'Mother & Child',
        href: '/#departments',
        desc: 'Maternity, neonatology & pediatrics',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E91E8C" strokeWidth="1.5"><circle cx="12" cy="4" r="2" /><path d="M12 6v4l-3 5h6l-3-5" /></svg>,
      },
      {
        label: 'Critical Care',
        href: '/#departments',
        desc: '24/7 ICU with advanced monitoring',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E67E22" strokeWidth="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2" /></svg>,
      },
      {
        label: 'Cancer Care',
        href: '/#departments',
        desc: 'Chemo, radiation & surgical oncology',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1ABC9C" strokeWidth="1.5"><circle cx="12" cy="12" r="3" /><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4" /></svg>,
      },
      {
        label: 'Emergency',
        href: '/#departments',
        desc: 'Trauma & rapid response teams',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E74C3C" strokeWidth="1.5"><path d="M12 2L12 22M2 12L22 12" /><circle cx="12" cy="12" r="10" /></svg>,
      },
      {
        label: 'Physical Medicine',
        href: '/#departments',
        desc: 'Rehabilitation & physiotherapy',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2ECC71" strokeWidth="1.5"><circle cx="12" cy="5" r="3" /><path d="M12 8v8M8 12h8M8 20l4-4 4 4" /></svg>,
      },
    ],
  },
  {
    label: 'Services',
    href: '/services',
    children: [
      {
        label: 'Labs & Diagnostics',
        href: '/services#diagnostics',
        desc: 'Advanced imaging & pathology',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M9 3v11M15 3v7M9 14c0 2.21 1.79 4 4 4h2c2.21 0 4 1.79 4 4" /><circle cx="9" cy="14" r="2" /></svg>,
      },
      {
        label: 'Health Checkup',
        href: '/services#checkup',
        desc: 'Preventive health packages',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M9 12h6M12 9v6" /><rect x="3" y="3" width="18" height="18" rx="3" /></svg>,
      },
      {
        label: '24/7 Pharmacy',
        href: '/services#pharmacy',
        desc: 'Round-the-clock medicines',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><rect x="3" y="3" width="18" height="18" rx="2" /><path d="M3 12h18M12 3v18" /></svg>,
      },
      {
        label: 'Ambulance Service',
        href: '/services#ambulance',
        desc: 'ACLS/BLS equipped transport',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><rect x="1" y="6" width="15" height="10" rx="2" /><path d="M16 8h3l3 4v4h-6V8z" /><circle cx="6" cy="18" r="2" /><circle cx="18" cy="18" r="2" /></svg>,
      },
      {
        label: 'Homecare',
        href: '/services#homecare',
        desc: 'At-home nursing & physio',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><path d="M12 12v5" /><path d="M9.5 14.5h5" /></svg>,
      },
      {
        label: 'Rehabilitation',
        href: '/services#rehab',
        desc: 'Post-surgery recovery programs',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><circle cx="12" cy="5" r="3" /><path d="M12 8v4M8 20l4-4 4 4" /><path d="M6 12h12" /></svg>,
      },
    ],
  },
  {
    label: 'Doctors',
    href: '/#doctors',
  },
  {
    label: 'Health Library',
    href: '/#blog',
  },
  {
    label: 'Contact',
    href: '/contact',
    children: [
      {
        label: 'Contact Us',
        href: '/contact',
        desc: 'Get in touch with us',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" /></svg>,
      },
      {
        label: 'Patient Feedback',
        href: '/contact#feedback',
        desc: 'Share your experience',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" /></svg>,
      },
      {
        label: 'Careers',
        href: '/contact#careers',
        desc: 'Join our growing team',
        icon: <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5"><rect x="2" y="7" width="20" height="14" rx="2" /><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" /></svg>,
      },
    ],
  },
];

/* ────────── Dropdown Panel ────────── */
function DropdownPanel({ items, onClose }: { items: SubItem[]; onClose: () => void }) {
  // Use 2 columns for Specialities (8 items), single column for others
  const isLarge = items.length > 5;

  return (
    <div
      className="mega-dropdown"
      style={{
        position: 'absolute',
        top: '100%',
        left: isLarge ? '50%' : '0',
        transform: isLarge ? 'translateX(-50%)' : 'none',
        minWidth: isLarge ? '640px' : '340px',
        background: 'white',
        borderRadius: '16px',
        boxShadow: '0 20px 60px rgba(0,0,0,0.15), 0 1px 3px rgba(0,0,0,0.08)',
        border: '1px solid var(--border-light)',
        padding: '12px',
        animation: 'dropdownFadeIn 0.2s ease-out',
        zIndex: 100,
      }}
      onMouseLeave={onClose}
    >
      <div
        style={{
          display: 'grid',
          gridTemplateColumns: isLarge ? 'repeat(2, 1fr)' : '1fr',
          gap: '4px',
        }}
      >
        {items.map((item) => (
          <Link
            key={item.label}
            href={item.href}
            onClick={onClose}
            style={{
              display: 'flex',
              alignItems: 'flex-start',
              gap: '12px',
              padding: '12px 14px',
              borderRadius: '12px',
              textDecoration: 'none',
              transition: 'all 0.15s ease',
              color: 'var(--text)',
            }}
            onMouseEnter={(e) => {
              e.currentTarget.style.background = 'var(--bg-light)';
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.background = 'transparent';
            }}
          >
            <div
              style={{
                width: '40px',
                height: '40px',
                borderRadius: '10px',
                background: 'var(--primary-50)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                color: 'var(--primary)',
                flexShrink: 0,
              }}
            >
              {item.icon}
            </div>
            <div>
              <div
                style={{
                  fontSize: '14px',
                  fontWeight: 600,
                  color: 'var(--text)',
                  marginBottom: '2px',
                }}
              >
                {item.label}
              </div>
              {item.desc && (
                <div
                  style={{
                    fontSize: '12px',
                    color: 'var(--text-light)',
                    lineHeight: 1.4,
                  }}
                >
                  {item.desc}
                </div>
              )}
            </div>
          </Link>
        ))}
      </div>
    </div>
  );
}

/* ────────── Main Header ────────── */
export default function Header() {
  const [scrolled, setScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);
  const [openDropdown, setOpenDropdown] = useState<string | null>(null);
  const [mobileExpandedItem, setMobileExpandedItem] = useState<string | null>(null);
  const timeoutRef = useRef<ReturnType<typeof setTimeout> | null>(null);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 10);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const handleMouseEnter = (label: string) => {
    if (timeoutRef.current) clearTimeout(timeoutRef.current);
    setOpenDropdown(label);
  };

  const handleMouseLeave = () => {
    timeoutRef.current = setTimeout(() => setOpenDropdown(null), 150);
  };

  const handleDropdownMouseEnter = () => {
    if (timeoutRef.current) clearTimeout(timeoutRef.current);
  };

  return (
    <header
      id="main-header"
      style={{
        position: 'sticky',
        top: 0,
        zIndex: 1000,
        background: scrolled ? 'rgba(255,255,255,0.97)' : 'white',
        backdropFilter: scrolled ? 'blur(12px)' : 'none',
        height: 'var(--header-height)',
        display: 'flex',
        alignItems: 'center',
        borderBottom: scrolled
          ? '1px solid var(--border)'
          : '1px solid transparent',
        boxShadow: scrolled ? 'var(--shadow-sm)' : 'none',
        transition: 'var(--transition)',
      }}
    >
      <div
        className="container"
        style={{
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          width: '100%',
        }}
      >
        {/* Logo */}
        <Link
          href="/"
          style={{
            display: 'flex',
            alignItems: 'center',
            gap: '10px',
            textDecoration: 'none',
          }}
        >
          <div
            style={{
              width: '44px',
              height: '44px',
              background:
                'linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%)',
              borderRadius: '12px',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              color: 'white',
              fontWeight: 900,
              fontSize: '18px',
              letterSpacing: '-0.02em',
            }}
          >
            G
          </div>
          <div>
            <div
              style={{
                fontSize: '20px',
                fontWeight: 800,
                color: 'var(--text)',
                lineHeight: 1.1,
                letterSpacing: '-0.02em',
              }}
            >
              CHI
            </div>
            <div
              style={{
                fontSize: '9px',
                fontWeight: 500,
                color: 'var(--text-secondary)',
                letterSpacing: '0.08em',
                textTransform: 'uppercase',
              }}
            >
              Hospital · Indore
            </div>
          </div>
        </Link>

        {/* Desktop Nav */}
        <nav
          style={{
            display: 'flex',
            alignItems: 'center',
            gap: '28px',
          }}
        >
          <ul
            style={{
              display: 'flex',
              listStyle: 'none',
              gap: '4px',
              margin: 0,
              padding: 0,
            }}
            className="desktop-nav"
          >
            {navItems.map((item) => (
              <li
                key={item.label}
                style={{ position: 'relative' }}
                onMouseEnter={() =>
                  item.children && handleMouseEnter(item.label)
                }
                onMouseLeave={handleMouseLeave}
              >
                <Link
                  href={item.href}
                  style={{
                    fontSize: '14px',
                    fontWeight: 500,
                    color:
                      openDropdown === item.label
                        ? 'var(--primary)'
                        : 'var(--text-secondary)',
                    textDecoration: 'none',
                    padding: '8px 14px',
                    borderRadius: 'var(--radius-full)',
                    transition: 'var(--transition)',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '4px',
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.color = 'var(--primary)';
                    e.currentTarget.style.background = 'var(--primary-50)';
                  }}
                  onMouseLeave={(e) => {
                    if (openDropdown !== item.label) {
                      e.currentTarget.style.color = 'var(--text-secondary)';
                      e.currentTarget.style.background = 'transparent';
                    }
                  }}
                >
                  {item.label}
                  {item.children && (
                    <svg
                      width="12"
                      height="12"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      strokeWidth="2"
                      style={{
                        transition: 'transform 0.2s ease',
                        transform:
                          openDropdown === item.label
                            ? 'rotate(180deg)'
                            : 'rotate(0)',
                      }}
                    >
                      <polyline points="6 9 12 15 18 9" />
                    </svg>
                  )}
                </Link>

                {/* Dropdown */}
                {item.children && openDropdown === item.label && (
                  <div onMouseEnter={handleDropdownMouseEnter}>
                    <DropdownPanel
                      items={item.children}
                      onClose={() => setOpenDropdown(null)}
                    />
                  </div>
                )}
              </li>
            ))}
          </ul>

          <Link
            href="/appointment"
            className="btn btn-primary btn-sm"
            style={{ marginLeft: '4px' }}
          >
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
            >
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            Book Appointment
          </Link>

          {/* Mobile hamburger */}
          <button
            onClick={() => setMobileOpen(!mobileOpen)}
            className="mobile-menu-btn"
            style={{
              display: 'none',
              background: 'none',
              border: 'none',
              cursor: 'pointer',
              padding: '8px',
              color: 'var(--text)',
            }}
            aria-label="Toggle menu"
          >
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
            >
              {mobileOpen ? (
                <path d="M18 6L6 18M6 6l12 12" />
              ) : (
                <>
                  <line x1="3" y1="6" x2="21" y2="6" />
                  <line x1="3" y1="12" x2="21" y2="12" />
                  <line x1="3" y1="18" x2="21" y2="18" />
                </>
              )}
            </svg>
          </button>
        </nav>
      </div>

      {/* Mobile Menu */}
      {mobileOpen && (
        <div
          style={{
            position: 'fixed',
            top: 'var(--header-height)',
            left: 0,
            right: 0,
            bottom: 0,
            background: 'white',
            zIndex: 999,
            padding: '24px',
            animation: 'slideInFromBottom 0.3s ease-out',
            overflowY: 'auto',
          }}
        >
          <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
            {navItems.map((item) => (
              <li key={item.label}>
                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                  <Link
                    href={item.href}
                    onClick={() => !item.children && setMobileOpen(false)}
                    style={{
                      display: 'block',
                      padding: '16px 0',
                      fontSize: '18px',
                      fontWeight: 600,
                      color: 'var(--text)',
                      textDecoration: 'none',
                      borderBottom: '1px solid var(--border-light)',
                      flex: 1,
                    }}
                  >
                    {item.label}
                  </Link>
                  {item.children && (
                    <button
                      onClick={() =>
                        setMobileExpandedItem(
                          mobileExpandedItem === item.label ? null : item.label
                        )
                      }
                      style={{
                        background: 'none',
                        border: 'none',
                        padding: '16px 8px',
                        cursor: 'pointer',
                        color: 'var(--text-secondary)',
                        borderBottom: '1px solid var(--border-light)',
                      }}
                      aria-label={`Expand ${item.label}`}
                    >
                      <svg
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        strokeWidth="2"
                        style={{
                          transition: 'transform 0.2s ease',
                          transform:
                            mobileExpandedItem === item.label
                              ? 'rotate(180deg)'
                              : 'rotate(0)',
                        }}
                      >
                        <polyline points="6 9 12 15 18 9" />
                      </svg>
                    </button>
                  )}
                </div>

                {/* Mobile sub-items */}
                {item.children && mobileExpandedItem === item.label && (
                  <div
                    style={{
                      paddingLeft: '16px',
                      paddingBottom: '8px',
                      animation: 'dropdownFadeIn 0.2s ease-out',
                    }}
                  >
                    {item.children.map((sub) => (
                      <Link
                        key={sub.label}
                        href={sub.href}
                        onClick={() => setMobileOpen(false)}
                        style={{
                          display: 'flex',
                          alignItems: 'center',
                          gap: '10px',
                          padding: '10px 0',
                          fontSize: '15px',
                          color: 'var(--text-secondary)',
                          textDecoration: 'none',
                          fontWeight: 500,
                        }}
                      >
                        <span
                          style={{
                            width: '32px',
                            height: '32px',
                            borderRadius: '8px',
                            background: 'var(--primary-50)',
                            display: 'flex',
                            alignItems: 'center',
                            justifyContent: 'center',
                            color: 'var(--primary)',
                            flexShrink: 0,
                          }}
                        >
                          {sub.icon}
                        </span>
                        {sub.label}
                      </Link>
                    ))}
                  </div>
                )}
              </li>
            ))}
          </ul>
          <Link
            href="/appointment"
            className="btn btn-primary btn-lg"
            style={{ width: '100%', marginTop: '24px' }}
            onClick={() => setMobileOpen(false)}
          >
            Book Appointment
          </Link>
        </div>
      )}

      {/* Responsive styles */}
      <style>{`
        @media (max-width: 968px) {
          .desktop-nav { display: none !important; }
          .mobile-menu-btn { display: block !important; }
        }
      `}</style>
    </header>
  );
}
