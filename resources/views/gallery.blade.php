@extends('layouts.app')

@section('title', 'Gallery - Central Hospital Indore, Indore')
@section('meta_description', 'Explore photos of Central Hospital Indore in Indore — our facilities, departments, patient care areas, and hospital events.')

@section('content')
  @include('partials.inner-hero', ['label' => 'Gallery', 'eyebrow' => 'A SENSE OF PLACE', 'headline' => 'Space to pause.', 'accent' => 'Room for care.', 'description' => 'Explore our hospital through photographs and discover the vision for its next chapter.', 'image' => 'images/hospital/reception-preview.webp', 'imageAlt' => 'AI completion preview of the actual hospital reception', 'caption' => 'AI completion preview', 'cta' => 'Explore the gallery', 'href' => '#gallery-collection'])

  <section id="gallery-collection" style="padding: 80px 0; background: var(--bg-light); min-height: 60vh;">
    <div class="container">

      @if($images->count())
        {{-- Filter Buttons --}}
        <div class="gallery-filters" style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-bottom: 48px;">
          <button class="gallery-filter-btn active" data-filter="all" type="button">All Photos</button>
        </div>

        {{-- Gallery Grid --}}
        <div class="gallery-grid" id="gallery-grid">
          @foreach($images as $image)
            <div class="gallery-item" data-category="{{ strtolower($image->caption ?? 'general') }}">
              <div class="gallery-item__inner">
                <img
                  src="{{ asset('storage/' . $image->image) }}"
                  alt="{{ $image->caption ?: 'Central Hospital Indore gallery image' }}"
                  loading="lazy"
                />
                <div class="gallery-item__overlay">
                  <div class="gallery-item__caption">{{ $image->caption ?: 'Central Hospital Indore' }}</div>
                  <button class="gallery-item__zoom" data-lightbox="{{ asset('storage/' . $image->image) }}" data-caption="{{ $image->caption ?: 'Central Hospital Indore' }}" type="button" aria-label="View full image">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="11" cy="11" r="8" /><path d="m21 21-4.35-4.35" /><path d="M11 8v6M8 11h6" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="v2-heading"><div><span class="eyebrow">OUR NEXT CHAPTER</span><h2>A vision for<br><em>feeling better.</em></h2></div><p>Reception and exterior previews are AI-enhanced from actual site photos. The recovery room is an illustrative concept.</p></div>
        <div class="gallery-grid">
        @foreach([['images/hospital/reception-preview.webp','Reception completion preview'],['images/atelier/recovery-concept.webp','A place to recover'],['images/hospital/exterior-preview.webp','Exterior completion preview']] as [$imagePath,$imageTitle])
          <div class="gallery-item"><div class="gallery-item__inner"><img src="{{ asset($imagePath) }}" alt="{{ $imageTitle }} — architectural concept" loading="lazy"><div class="gallery-item__overlay"><div class="gallery-item__caption">{{ $imageTitle }}<small style="display:block;font:11px Arial,sans-serif;margin-top:10px;letter-spacing:.08em">ARCHITECTURAL CONCEPT</small></div><button class="gallery-item__zoom" data-lightbox="{{ asset($imagePath) }}" data-caption="{{ $imageTitle }} — architectural concept" type="button" aria-label="Enlarge {{ $imageTitle }}">↗</button></div></div></div>
        @endforeach
        </div>
      @endif
    </div>
  </section>

  {{-- Lightbox Modal --}}
  <div class="gallery-lightbox" id="gallery-lightbox" role="dialog" aria-modal="true" aria-label="Image viewer" style="display:none;">
    <div class="gallery-lightbox__backdrop"></div>
    <button class="gallery-lightbox__close" aria-label="Close image viewer" type="button">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12" /></svg>
    </button>
    <button class="gallery-lightbox__nav gallery-lightbox__prev" aria-label="Previous image" type="button">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6" /></svg>
    </button>
    <button class="gallery-lightbox__nav gallery-lightbox__next" aria-label="Next image" type="button">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 6 15 12 9 18" /></svg>
    </button>
    <div class="gallery-lightbox__content">
      <img class="gallery-lightbox__img" id="lightbox-img" src="" alt="" />
      <div class="gallery-lightbox__caption" id="lightbox-caption"></div>
    </div>
  </div>

  <style>
    /* ===== Gallery Grid ===== */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
    }
    .gallery-item {
      border-radius: var(--radius-lg);
      overflow: hidden;
      transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .gallery-item__inner {
      position: relative;
      padding-bottom: 75%;
      overflow: hidden;
      border-radius: var(--radius-lg);
      background: #e2e8f0;
    }
    .gallery-item__inner img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gallery-item:hover .gallery-item__inner img {
      transform: scale(1.08);
    }
    .gallery-item__overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 40%, transparent 100%);
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      padding: 20px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .gallery-item:hover .gallery-item__overlay {
      opacity: 1;
    }
    .gallery-item__caption {
      color: white;
      font-size: 14px;
      font-weight: 600;
      max-width: 70%;
    }
    .gallery-item__zoom {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.25);
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s, transform 0.2s;
    }
    .gallery-item__zoom:hover {
      background: var(--primary);
      border-color: var(--primary);
      transform: scale(1.1);
    }

    /* ===== Filter Buttons ===== */
    .gallery-filter-btn {
      padding: 10px 24px;
      border-radius: var(--radius-full);
      border: 1px solid var(--border);
      background: white;
      color: var(--text-secondary);
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .gallery-filter-btn:hover {
      border-color: var(--primary);
      color: var(--primary);
    }
    .gallery-filter-btn.active {
      background: var(--primary);
      border-color: var(--primary);
      color: white;
    }

    /* ===== Lightbox ===== */
    .gallery-lightbox {
      position: fixed;
      inset: 0;
      z-index: 10000;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .gallery-lightbox__backdrop {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.92);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }
    .gallery-lightbox__close {
      position: absolute;
      top: 20px;
      right: 20px;
      z-index: 2;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }
    .gallery-lightbox__close:hover { background: rgba(255,255,255,0.2); }
    .gallery-lightbox__nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 2;
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.15);
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }
    .gallery-lightbox__nav:hover { background: rgba(255,255,255,0.18); }
    .gallery-lightbox__prev { left: 20px; }
    .gallery-lightbox__next { right: 20px; }
    .gallery-lightbox__content {
      position: relative;
      z-index: 1;
      max-width: 90vw;
      max-height: 85vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .gallery-lightbox__img {
      max-width: 90vw;
      max-height: 78vh;
      object-fit: contain;
      border-radius: 12px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
    .gallery-lightbox__caption {
      color: rgba(255,255,255,0.85);
      font-size: 15px;
      font-weight: 500;
      margin-top: 16px;
      text-align: center;
    }

    /* ===== Responsive ===== */
    @media (max-width: 1024px) {
      .gallery-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
      .gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
      .gallery-lightbox__nav { display: none; }
    }
    @media (max-width: 480px) {
      .gallery-grid { grid-template-columns: 1fr; }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Lightbox functionality
      const lightbox = document.getElementById('gallery-lightbox');
      if (!lightbox) return;

      const lightboxImg = document.getElementById('lightbox-img');
      const lightboxCaption = document.getElementById('lightbox-caption');
      const closeBtn = lightbox.querySelector('.gallery-lightbox__close');
      const backdrop = lightbox.querySelector('.gallery-lightbox__backdrop');
      const prevBtn = lightbox.querySelector('.gallery-lightbox__prev');
      const nextBtn = lightbox.querySelector('.gallery-lightbox__next');
      const zoomButtons = document.querySelectorAll('[data-lightbox]');
      let currentIndex = 0;
      let returnFocus = null;
      const images = Array.from(zoomButtons);

      function openLightbox(index) {
        returnFocus = images[index];
        currentIndex = index;
        const btn = images[index];
        lightboxImg.src = btn.dataset.lightbox;
        lightboxImg.alt = btn.dataset.caption;
        lightboxCaption.textContent = btn.dataset.caption;
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        closeBtn.focus();
      }

      function closeLightbox() {
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
        lightboxImg.src = '';
        returnFocus?.focus({ preventScroll: true });
      }

      function navigate(direction) {
        currentIndex = (currentIndex + direction + images.length) % images.length;
        const btn = images[currentIndex];
        lightboxImg.src = btn.dataset.lightbox;
        lightboxImg.alt = btn.dataset.caption;
        lightboxCaption.textContent = btn.dataset.caption;
      }

      zoomButtons.forEach((btn, i) => btn.addEventListener('click', () => openLightbox(i)));
      closeBtn.addEventListener('click', closeLightbox);
      backdrop.addEventListener('click', closeLightbox);
      prevBtn.addEventListener('click', () => navigate(-1));
      nextBtn.addEventListener('click', () => navigate(1));

      document.addEventListener('keydown', (e) => {
        if (lightbox.style.display === 'none') return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigate(-1);
        if (e.key === 'ArrowRight') navigate(1);
        if (e.key === 'Tab') {
          const controls = [closeBtn, prevBtn, nextBtn].filter(button => button.getClientRects().length);
          const first = controls[0], last = controls[controls.length - 1];
          if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
          else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        }
      });
    });
  </script>
@endsection
