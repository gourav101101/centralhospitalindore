@extends('layouts.app')

@section('title', 'Contact Us - Central Hospital Indore')
@section('meta_description', 'Get in touch with Central Hospital Indore. Call our 24/7 helpline, find directions to our Rasoma Square location, or send us a message online.')

@section('content')
  <!-- Hero Banner -->
  @include('partials.inner-hero', ['label' => 'Contact', 'eyebrow' => 'A CONVERSATION IS A GOOD BEGINNING', 'headline' => 'We are here', 'accent' => 'to listen.', 'description' => 'A question, a little guidance, or help planning your visit. Let’s take the next step together.', 'cta' => 'Send a message', 'href' => '#contact-form-container'])

  <!-- ── Contact Cards ── -->
  <section style="padding: 80px 0; background: var(--bg-white);">
    <div class="container">
      <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 80px;" class="contact-cards-grid">
        <!-- Call Us -->
        <div style="padding: 32px 24px; background: var(--bg-light); border-radius: var(--radius-lg); border: 1px solid var(--border-light); text-align: center; transition: var(--transition);"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
          <div style="width: 56px; height: 56px; border-radius: 16px; background: rgba(82, 123, 171, 0.12); display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
          </div>
          <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 8px;">Call Us</h3>
          <a href="tel:{{ $siteSettings->phone_href }}" style="font-size:15px;font-weight:700;color:var(--text);text-decoration:none">{{ $siteSettings->phone_display }}</a>
          <div style="font-size:13px;color:var(--text-light);margin-top:4px">Tap to call the hospital</div>
        </div>

        <!-- Google Reviews -->
        <div style="padding: 32px 24px; background: var(--bg-light); border-radius: var(--radius-lg); border: 1px solid var(--border-light); text-align: center; transition: var(--transition);"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
          <div style="width: 56px; height: 56px; border-radius: 16px; background: rgba(232, 137, 47, 0.12); display: flex; align-items: center; justify-content: center; color: var(--accent); margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="2" y="4" width="20" height="16" rx="2" /><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
            </svg>
          </div>
          <h3 style="font-size:16px;font-weight:700;margin-bottom:8px">Google Reviews</h3>
          <a href="{{ $siteSettings->maps_url }}" target="_blank" rel="noopener noreferrer" style="font-size:15px;font-weight:700;color:var(--text);text-decoration:none">{{ $siteSettings->google_rating }} ★ rating</a>
          <div style="font-size:13px;color:var(--text-light);margin-top:4px">{{ $siteSettings->google_review_count }} reviews</div>
        </div>

        <!-- Visit Us -->
        <div style="padding: 32px 24px; background: var(--bg-light); border-radius: var(--radius-lg); border: 1px solid var(--border-light); text-align: center; transition: var(--transition);"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
          <div style="width: 56px; height: 56px; border-radius: 16px; background: rgba(82, 123, 171, 0.12); display: flex; align-items: center; justify-content: center; color: #527bab; margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" />
            </svg>
          </div>
          <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 8px;">Visit Us</h3>
          <div style="font-size:15px;font-weight:600;color:var(--text);margin-bottom:4px">{{ $siteSettings->address_line_1 }}</div>
          <div style="font-size:13px;color:var(--text-light)">{{ $siteSettings->address_line_2 }}</div>
        </div>

        <!-- Working Hours -->
        <div style="padding: 32px 24px; background: var(--bg-light); border-radius: var(--radius-lg); border: 1px solid var(--border-light); text-align: center; transition: var(--transition);"
             onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow-md)';"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
          <div style="width: 56px; height: 56px; border-radius: 16px; background: var(--primary-100); display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 16px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
            </svg>
          </div>
          <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 8px;">Working Hours</h3>
          <div style="font-size:15px;font-weight:700;color:var(--text);margin-bottom:4px">{{ $siteSettings->working_hours }}</div>
          <div style="font-size:13px;color:var(--text-light)">Monday through Sunday</div>
        </div>
      </div>

      <!-- ── Form + Map ── -->
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: flex-start;" class="contact-main-grid">
        <!-- Contact Form -->
        <div style="background: white; border-radius: var(--radius-xl); padding: 48px; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light);" id="contact-form-container">
          <h3 style="font-size: 24px; font-weight: 800; margin-bottom: 8px;">Send Us a Message</h3>
          <p style="font-size: 15px; color: var(--text-secondary); margin-bottom: 32px;">Fill out the form and our team will get back to you promptly.</p>
          @if ($errors->any())
            <div style="padding: 12px 14px; background: #fff1f2; color: #b91c1c; border-radius: 8px; font-size: 14px; margin-bottom: 16px;">Please check your details and submit again.</div>
          @endif
          <form id="contact-form" method="post" action="{{ route('contact.store') }}" style="display: {{ session('contact_success') ? 'none' : 'flex' }}; flex-direction: column; gap: 20px;">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="contact-form-row">
              <div>
                <label class="form-label" for="name-field">Full Name *</label>
                <input name="name" type="text" class="form-input" placeholder="Your name" value="{{ old('name') }}" required id="name-field" />
              </div>
              <div>
                <label class="form-label" for="email-field">Email *</label>
                <input name="email" type="email" class="form-input" placeholder="you@example.com" value="{{ old('email') }}" required id="email-field" />
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="contact-form-row">
              <div>
                <label class="form-label" for="phone-field">Phone</label>
                <input name="phone" type="tel" class="form-input" placeholder="+91 98765 43210" value="{{ old('phone') }}" id="phone-field" />
              </div>
              <div>
                <label class="form-label" for="subject-field">Subject *</label>
                <select name="subject" class="form-input" required id="subject-field">
                  <option value="" disabled selected>Select subject</option>
                  <option value="general">General Inquiry</option>
                  <option value="appointment">Appointment Related</option>
                  <option value="billing">Billing & Insurance</option>
                  <option value="careers">Careers</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div>
              <label class="form-label" for="message-field">Message *</label>
              <textarea name="message" class="form-input" placeholder="How can we help you?" rows="5" required id="message-field">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="22" y1="2" x2="11" y2="13" /><polygon points="22 2 15 22 11 13 2 9 22 2" />
              </svg>
              Send Message
            </button>
          </form>

          <div id="contact-success" style="display: {{ session('contact_success') ? 'block' : 'none' }}; text-align: center; padding: 40px 0;">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, #527bab, #315e95); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                <path d="M20 6L9 17l-5-5" />
              </svg>
            </div>
            <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 12px; display: block;">Message Sent!</h3>
            <p style="font-size: 15px; color: var(--text-secondary); margin-bottom: 24px; display: block;">
              We've received your message and will respond within 24 hours.
            </p>
            <button onclick="document.getElementById('contact-success').style.display = 'none'; document.getElementById('contact-form').style.display = 'flex'; document.querySelector('#contact-form-container h3').style.display = 'block'; document.querySelector('#contact-form-container p').style.display = 'block';" class="btn btn-outline">
              Send Another Message
            </button>
          </div>
        </div>

        <!-- Map + Emergency -->
        <div>
          <!-- Map -->
          <div style="border-radius: var(--radius-xl); overflow: hidden; box-shadow: var(--shadow-md); margin-bottom: 24px; border: 1px solid var(--border-light);">
            <iframe
              src="{{ $siteSettings->map_embed_url }}"
              width="100%"
              height="350"
              style="border: 0; display: block;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Central Hospital Indore Location"
            ></iframe>
          </div>

          <!-- 24-hour contact block -->
          <div style="background: linear-gradient(135deg, var(--primary-dark), var(--primary-light)); border-radius: var(--radius-xl); padding: 32px; color: white; display: flex; align-items: center; gap: 20px;">
            <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
              <span class="emergency-dot" style="width: 20px; height: 20px; background: white; border-radius: 50%;"></span>
            </div>
            <div>
              <div style="font-size: 13px; font-weight: 600; opacity: 0.9; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">
                Speak with our team
              </div>
              <a href="tel:{{ $siteSettings->phone_href }}" style="display:block;font-size:24px;font-weight:800;margin-bottom:4px;color:white;text-decoration:none">{{ $siteSettings->phone_display }}</a>
              <div style="font-size: 14px; opacity: 0.85;">
                Call our team for opening updates and service availability.
              </div>
            </div>
          </div>

          <!-- Location links -->
          <div style="background: white; border-radius: var(--radius-xl); padding: 32px; border: 1px solid var(--border-light); margin-top: 24px;">
            <h4 style="font-size:16px;font-weight:700;margin-bottom:16px">Plan your visit</h4>
            <div style="display:flex;gap:12px;flex-wrap:wrap">
              <a href="{{ $siteSettings->directions_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Get Directions</a>
              <a href="{{ $siteSettings->outside_view_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">See Outside</a>
              <a href="{{ $siteSettings->maps_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline">Google Reviews</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
      @media (max-width: 1024px) { .contact-cards-grid { grid-template-columns: repeat(2, 1fr) !important; } }
      @media (max-width: 968px) { .contact-main-grid { grid-template-columns: 1fr !important; } }
      @media (max-width: 640px) { 
        .contact-cards-grid { grid-template-columns: 1fr !important; }
        .contact-form-row { grid-template-columns: 1fr !important; }
      }
    </style>
  </section>

  <!-- ── Patient Feedback Section ── -->
  @if (false) {{-- Patient feedback retired; existing records are retained. --}}
  <section id="feedback" style="padding: 80px 0; background: var(--bg-light);">
    <div class="container">
      <div style="text-align: center; max-width: 600px; margin: 0 auto;">
        <div class="section-badge" style="margin: 0 auto 16px;">Your Voice Matters</div>
        <h2 class="section-title">
          Patient <span style="color: var(--primary);">Feedback</span>
        </h2>
        <p class="section-subtitle" style="margin: 0 auto 32px;">
          Your feedback helps us improve our services and provide better care.
        </p>
        <div style="background: white; border-radius: var(--radius-xl); padding: 40px; border: 1px solid var(--border-light); text-align: left;">
          <form onsubmit="event.preventDefault(); this.style.display='none'; document.getElementById('feedback-success').style.display='block';" style="display: flex; flex-direction: column; gap: 20px;">
            <div>
              <label class="form-label">Your Name</label>
              <input type="text" class="form-input" placeholder="Full name" />
            </div>
            <div>
              <label class="form-label">Department Visited</label>
              <input type="text" class="form-input" placeholder="e.g. Cardiology" />
            </div>
            <div>
              <label class="form-label">Rate Your Experience</label>
              <div style="display: flex; gap: 8px; margin-top: 4px;" id="star-rating">
                <button type="button" style="background: none; border: none; cursor: pointer; padding: 4px;" onclick="setRating(1)">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--border)" stroke="var(--border)"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                </button>
                <button type="button" style="background: none; border: none; cursor: pointer; padding: 4px;" onclick="setRating(2)">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--border)" stroke="var(--border)"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                </button>
                <button type="button" style="background: none; border: none; cursor: pointer; padding: 4px;" onclick="setRating(3)">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--border)" stroke="var(--border)"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                </button>
                <button type="button" style="background: none; border: none; cursor: pointer; padding: 4px;" onclick="setRating(4)">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--border)" stroke="var(--border)"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                </button>
                <button type="button" style="background: none; border: none; cursor: pointer; padding: 4px;" onclick="setRating(5)">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="var(--border)" stroke="var(--border)"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                </button>
              </div>
              <script>
                function setRating(rating) {
                  const buttons = document.querySelectorAll('#star-rating button svg');
                  buttons.forEach((svg, index) => {
                    if (index < rating) {
                      svg.setAttribute('fill', 'var(--accent)');
                      svg.setAttribute('stroke', 'var(--accent)');
                    } else {
                      svg.setAttribute('fill', 'var(--border)');
                      svg.setAttribute('stroke', 'var(--border)');
                    }
                  });
                }
              </script>
            </div>
            <div>
              <label class="form-label">Your Feedback</label>
              <textarea class="form-input" placeholder="Tell us about your experience..." rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="align-self: flex-start;">
              Submit Feedback
            </button>
          </form>
          <p id="feedback-success" style="display: none; color: var(--primary); font-weight: 600;">Thank you for your feedback. We appreciate you taking the time to help us improve.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ── Careers Teaser ── -->
  @endif
  <section id="careers" style="padding: 80px 0; background: var(--dark); color: white; text-align: center;">
    <div class="container">
      <div class="section-badge" style="margin: 0 auto 16px; background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); color: white;">Careers</div>
      <h2 style="font-size: clamp(28px, 4vw, 40px); font-weight: 800; color: white; margin-bottom: 16px;">
        Join Our <span style="color: var(--accent);">Growing Team</span>
      </h2>
      <p style="font-size: 17px; color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto 32px; line-height: 1.7;">
        Interested in joining our team? Call the hospital to ask about current opportunities and the appropriate application contact.
      </p>
      <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="tel:{{ $siteSettings->phone_href }}" class="btn btn-primary btn-lg" style="background: white; color: var(--primary); border-color: white;">
          Call {{ $siteSettings->phone_display }}
        </a>
        <a href="{{ url('/') }}" class="btn btn-white btn-lg">
          Learn More
        </a>
      </div>
    </div>
  </section>
@endsection
