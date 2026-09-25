'use client';

import React from 'react';

const blogs = [
  {
    title: 'Understanding Heart Health in Your 40s',
    date: 'August 10, 2026',
    category: 'Cardiology',
    image: 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=400&q=80',
    excerpt: 'Key preventive measures and lifestyle changes to ensure your heart stays healthy as you age.',
  },
  {
    title: 'Advances in Minimally Invasive Surgery',
    date: 'August 5, 2026',
    category: 'Surgery',
    image: 'https://images.unsplash.com/photo-1551076805-e1869043e560?auto=format&fit=crop&w=400&q=80',
    excerpt: 'How modern surgical techniques are reducing recovery times and improving patient outcomes.',
  },
  {
    title: 'Nutrition Tips for Post-Surgery Recovery',
    date: 'July 28, 2026',
    category: 'Wellness',
    image: 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=400&q=80',
    excerpt: 'A comprehensive guide to eating right for faster healing and better immune support.',
  }
];

export default function BlogSection() {
  return (
    <section id="blog" style={{ padding: '100px 0', background: 'var(--bg-light)' }}>
      <div className="container">
         <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-end', marginBottom: '60px' }} className="blog-header">
            <div>
               <div className="section-badge">Health Library</div>
               <h2 className="section-title" style={{ marginBottom: 0 }}>
                 Health <span style={{ color: 'var(--primary)' }}>Insights</span>
               </h2>
            </div>
            <a href="#" className="btn btn-outline btn-sm view-all-btn">View All Articles</a>
         </div>

         <div style={{
            display: 'grid',
            gridTemplateColumns: 'repeat(3, 1fr)',
            gap: '24px',
         }} className="blog-grid">
            {blogs.map((blog, i) => (
                <div key={i} className="card" style={{ display: 'flex', flexDirection: 'column' }}>
                    <div style={{ height: '200px', backgroundImage: `url(${blog.image})`, backgroundSize: 'cover', backgroundPosition: 'center' }} />
                    <div style={{ padding: '24px', display: 'flex', flexDirection: 'column', flex: 1 }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '12px', fontSize: '12px', fontWeight: 600, color: 'var(--text-secondary)' }}>
                           <span style={{ color: 'var(--primary)' }}>{blog.category}</span>
                           <span>{blog.date}</span>
                        </div>
                        <h3 style={{ fontSize: '18px', fontWeight: 700, marginBottom: '12px', lineHeight: 1.4 }}>
                            {blog.title}
                        </h3>
                        <p style={{ fontSize: '14px', color: 'var(--text-secondary)', marginBottom: '24px', flex: 1 }}>
                            {blog.excerpt}
                        </p>
                        <a href="#" style={{ color: 'var(--primary)', fontWeight: 600, fontSize: '14px', textDecoration: 'none', display: 'flex', alignItems: 'center', gap: '4px' }}>
                            Read More
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                              <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            ))}
         </div>
      </div>
      <style>{`
        @media (max-width: 968px) {
          .blog-grid { grid-template-columns: repeat(2, 1fr) !important; }
        }
        @media (max-width: 640px) {
          .blog-grid { grid-template-columns: 1fr !important; }
          .blog-header { flex-direction: column; align-items: flex-start !important; gap: 20px; }
          .view-all-btn { width: 100%; }
        }
      `}</style>
    </section>
  );
}
