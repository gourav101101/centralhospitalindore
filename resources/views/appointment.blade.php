@extends('layouts.app')
@section('title', 'Book an Appointment - Central Hospital Indore')
@section('meta_description', 'Schedule your doctor consultation or health checkup online with Central Hospital Indore.')

@section('content')
  <!-- Hero Banner -->
  @include('partials.inner-hero', ['label' => 'Appointment request', 'eyebrow' => 'MAKE TIME FOR YOU', 'headline' => 'Your next step.', 'accent' => 'Taken together.', 'description' => 'Tell us what you need. Our team will help you plan a consultation and confirm availability.', 'cta' => 'Request a consultation', 'href' => '#appointment-form-container'])

  <!-- ── Appointment Main ── -->
  <section class="appointment-section" style="padding: 100px 0; background: var(--bg-light);">
    <div class="container">
      <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 60px; align-items: flex-start;" class="appointment-page-grid">
        <!-- Form Container -->
        <div class="appointment-form-card" style="background: white; border-radius: var(--radius-xl); padding: 48px; box-shadow: var(--shadow-lg); border: 1px solid var(--border-light);" id="appointment-form-container">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: var(--primary-100); display: flex; align-items: center; justify-content: center; color: var(--primary);">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </div>
            <h2 style="font-size: 24px; font-weight: 800;">Appointment Request</h2>
          </div>
          <p style="font-size: 15px; color: var(--text-secondary); margin-bottom: 32px;">
            Please fill in your details. Our team will contact you to confirm your slot within 2 hours.
          </p>

          @if ($errors->any())
            <div style="padding: 12px 14px; background: #fff1f2; color: #b91c1c; border-radius: 8px; font-size: 14px;">Please correct the highlighted details and submit again.</div>
          @endif
          <form id="appointment-form" method="post" action="{{ route('appointment.store') }}" style="display: {{ session('appointment_success') ? 'none' : 'flex' }}; flex-direction: column; gap: 20px;">
            @csrf
            <!-- Personal Info -->
            <div style="font-size: 14px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: -8px;">
              1. Personal Information
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="appointment-form-row">
              <div>
                <label class="form-label" for="patient_name-field">Full Name *</label>
                <input name="patient_name" type="text" class="form-input" placeholder="Enter patient name" value="{{ old('patient_name') }}" required id="patient_name-field" />
              </div>
              <div>
                <label class="form-label" for="phone-field">Phone Number *</label>
                <input name="phone" type="tel" class="form-input" placeholder="+91 98765 43210" value="{{ old('phone') }}" required id="phone-field" />
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="appointment-form-row">
              <div>
                <label class="form-label" for="email-field">Email Address</label>
                <input name="email" type="email" class="form-input" placeholder="you@example.com" value="{{ old('email') }}" id="email-field" />
              </div>
              <div>
                <label class="form-label">Age & Gender</label>
                <div class="appointment-age-gender" style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                  <input name="age" type="number" class="form-input" placeholder="Age" min="1" max="120" value="{{ old('age') }}" />
                  <select name="gender" class="form-input">
                    <option value="">Gender</option>
                    <option value="male" @selected(old('gender') === 'male')>Male</option>
                    <option value="female" @selected(old('gender') === 'female')>Female</option>
                    <option value="other" @selected(old('gender') === 'other')>Other</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Medical Details -->
            <div style="font-size: 14px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; margin-top: 8px; margin-bottom: -8px;">
              2. Appointment Details
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="appointment-form-row">
              <div>
                <label class="form-label" for="dept-select">Department *</label>
                <select name="department" class="form-input" id="dept-select" required>
                  @php($selectedDepartment = old('department', request('department')))
                  <option value="" disabled @selected(!$selectedDepartment)>Select Speciality</option>
                  @forelse($departments as $department)
                    <option value="{{ $department->name }}" @selected($selectedDepartment === $department->name)>{{ $department->name }}</option>
                  @empty
                    <option value="" disabled>No specialities are currently available</option>
                  @endforelse
                </select>
              </div>
              <div>
                <label class="form-label" for="doctor-select">Preferred Doctor</label>
                <select name="preferred_doctor" class="form-input" id="doctor-select">
                  <option value="">Any Available Doctor</option>
                  @foreach($doctors as $doctor)
                    <option value="{{ $doctor->name }}" data-department="{{ $doctor->department }}" @selected(old('preferred_doctor') === $doctor->name)>{{ $doctor->name }} ({{ $doctor->department }})</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;" class="appointment-form-row">
              <div>
                <label class="form-label" for="preferred_date-field">Preferred Date *</label>
                <input id="preferred_date-field" name="preferred_date" type="date" min="{{ now()->toDateString() }}" class="form-input" value="{{ old('preferred_date') }}" required />
              </div>
              <div>
                <label class="form-label" for="time_slot-field">Preferred Time Slot *</label>
                <select name="time_slot" class="form-input" required id="time_slot-field">
                  <option value="" disabled selected>Select time</option>
                  <option value="morning-1">Morning: 9:00 AM – 11:00 AM</option>
                  <option value="morning-2">Morning: 11:00 AM – 1:00 PM</option>
                  <option value="afternoon-1">Afternoon: 2:00 PM – 4:00 PM</option>
                  <option value="evening-1">Evening: 4:00 PM – 6:00 PM</option>
                  <option value="evening-2">Evening: 6:00 PM – 8:00 PM</option>
                </select>
              </div>
            </div>
            <div>
              <label class="form-label" for="symptoms-field">Reason for Visit / Symptoms</label>
              <textarea name="symptoms" class="form-input" placeholder="Briefly describe your medical issue..." rows="3" id="symptoms-field">{{ old('symptoms') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 8px;">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
              Send Appointment Request
            </button>
          </form>

          <div id="appointment-success" style="display: {{ session('appointment_success') ? 'block' : 'none' }}; text-align: center; padding: 40px 0;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #527bab, #315e95); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                <path d="M20 6L9 17l-5-5" />
              </svg>
            </div>
            <h3 style="font-size: 26px; font-weight: 800; margin-bottom: 12px; display: block;">Appointment Request Received!</h3>
            <p style="font-size: 16px; color: var(--text-secondary); max-width: 450px; margin: 0 auto 24px; line-height: 1.6; display: block;">
              Thank you for choosing Central Hospital Indore. Our patient care executive will call you shortly to confirm your booking and doctor's availability.
            </p>
            <div style="background: var(--bg-light); border-radius: var(--radius-lg); padding: 20px; max-width: 400px; margin: 0 auto 24px; text-align: left; font-size: 14px; color: var(--text);">
              <div style="font-weight: 700; margin-bottom: 8px; color: var(--primary);">Need immediate help?</div>
              <div>Call the hospital: <strong>{{ $siteSettings->phone_display }}</strong></div>
            </div>
            @if(session('appointment_whatsapp_url'))
              <p><a class="btn btn-primary" href="{{ session('appointment_whatsapp_url') }}" target="_blank" rel="noopener noreferrer">Continue on WhatsApp</a></p>
              <p style="font-size:13px;margin:12px 0 24px">Your request is saved. You can also send it to our team on WhatsApp.</p>
            @endif
            <button onclick="document.getElementById('appointment-success').style.display = 'none'; document.getElementById('appointment-form').style.display = 'flex';" class="btn btn-outline">
              Book Another Appointment
            </button>
          </div>
        </div>

        <!-- Sidebar Info -->
        <div class="appointment-sidebar" style="display: flex; flex-direction: column; gap: 24px;">
          <!-- Emergency Card -->
          <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: var(--radius-xl); padding: 32px; color: white; box-shadow: var(--shadow-primary);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
              <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                🚑
              </div>
              <div>
                <div style="font-size: 12px; font-weight: 600; opacity: 0.8; text-transform: uppercase; letter-spacing: 0.05em;">LET’S TALK</div>
                <div style="font-size: 20px; font-weight: 800;">Hospital enquiries</div>
              </div>
            </div>
            <div style="font-size: 28px; font-weight: 900; color: var(--accent); margin-bottom: 12px;">
              {{ $siteSettings->phone_display }}
            </div>
            <p style="font-size: 14px; opacity: 0.85; margin: 0; line-height: 1.5;">
              Call our team for appointments and consultation availability.
            </p>
          </div>

          <!-- Why Book With Us -->
          <div style="background: white; border-radius: var(--radius-xl); padding: 32px; border: 1px solid var(--border-light);">
            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 20px;">Why Book at Central Hospital Indore?</h3>
            <div style="display: flex; flex-direction: column; gap: 16px;">
              <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: #527bab15; display: flex; align-items: center; justify-content: center; color: #527bab; flex-shrink: 0; margin-top: 2px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5" /></svg>
                </div>
                <div>
                  <div style="font-size: 14px; font-weight: 600; color: var(--text);">Help planning your visit</div>
                  <div style="font-size: 13px; color: var(--text-secondary);">Prioritised appointment slots to minimise waiting.</div>
                </div>
              </div>
              <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: #527bab15; display: flex; align-items: center; justify-content: center; color: #527bab; flex-shrink: 0; margin-top: 2px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5" /></svg>
                </div>
                <div>
                  <div style="font-size: 14px; font-weight: 600; color: var(--text);">Top Medical Specialists</div>
                  <div style="font-size: 13px; color: var(--text-secondary);">Consult with experienced, highly-qualified doctors.</div>
                </div>
              </div>
              <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: #527bab15; display: flex; align-items: center; justify-content: center; color: #527bab; flex-shrink: 0; margin-top: 2px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5" /></svg>
                </div>
                <div>
                  <div style="font-size: 14px; font-weight: 600; color: var(--text);">Digital Health Records</div>
                  <div style="font-size: 13px; color: var(--text-secondary);">Easy digital access to your prescriptions and reports.</div>
                </div>
              </div>
              <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 28px; height: 28px; border-radius: 50%; background: #527bab15; display: flex; align-items: center; justify-content: center; color: #527bab; flex-shrink: 0; margin-top: 2px;">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5" /></svg>
                </div>
                <div>
                  <div style="font-size: 14px; font-weight: 600; color: var(--text);">Cashless Insurance Support</div>
                  <div style="font-size: 13px; color: var(--text-secondary);">Empanelled with 30+ insurance companies & TPA desk.</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style>
      @media (max-width: 968px) { .appointment-page-grid { grid-template-columns: 1fr !important; gap: 32px !important; } }
      @media (max-width: 640px) {
        .page-hero { padding: 42px 0 36px !important; }
        .page-hero .breadcrumb { margin-bottom: 12px !important; font-size: 13px !important; }
        .page-hero h1 { font-size: 34px !important; margin-bottom: 10px !important; }
        .page-hero p { font-size: 15px !important; line-height: 1.55 !important; }
        .appointment-section { padding: 32px 0 28px !important; }
        .appointment-section .container { padding: 0 14px !important; }
        .appointment-page-grid { gap: 24px !important; }
        .appointment-form-card { padding: 24px 18px !important; border-radius: 16px !important; }
        .appointment-form-row { grid-template-columns: 1fr !important; gap: 14px !important; }
        .appointment-age-gender { grid-template-columns: minmax(76px, .7fr) 1fr !important; }
        #appointment-form { gap: 18px !important; }
        #appointment-form .form-input { min-height: 48px; padding: 12px 13px; font-size: 16px; }
        #appointment-form textarea.form-input { min-height: 108px; }
        #appointment-form .btn-lg { min-height: 52px; padding: 13px 16px; white-space: normal; font-size: 15px; }
        .appointment-sidebar { gap: 16px !important; }
        .appointment-sidebar > div { padding: 24px !important; border-radius: 16px !important; }
        #appointment-success { padding: 24px 0 !important; }

        /* On its own page, Book is a normal selected tab rather than a
           floating action button above the browser's bottom edge. */
        .mobile-app-bar--appointment-page .mobile-app-bar__appointment {
          min-height: 52px; justify-content: flex-end; gap: 3px; transform: none;
        }
        .mobile-app-bar--appointment-page .mobile-app-bar__appointment-icon {
          width: 21px; height: 21px; margin: 0; color: currentColor;
          background: transparent; border: 0; border-radius: 0; box-shadow: none;
        }
        .mobile-app-bar--appointment-page .mobile-app-bar__appointment-icon svg {
          width: 21px; height: 21px; stroke-width: 1.8;
        }
        .mobile-app-bar--appointment-page .mobile-app-bar__appointment.is-active .mobile-app-bar__appointment-icon { box-shadow: none; }
      }
      @media (max-width: 380px) {
        .appointment-form-card { padding: 20px 14px !important; }
        .appointment-sidebar > div { padding: 20px !important; }
        .mobile-app-bar__item, .mobile-app-bar__appointment { font-size: 9px !important; }
      }
    </style>
  </section>
  <script>
    (() => {
      const department = document.getElementById('dept-select');
      const doctor = document.getElementById('doctor-select');
      const options = Array.from(doctor.options).slice(1);

      const filterDoctors = () => {
        const selectedDepartment = department.value;

        options.forEach((option) => {
          option.hidden = Boolean(selectedDepartment) && option.dataset.department !== selectedDepartment;
          option.disabled = option.hidden;
        });

        if (doctor.selectedOptions[0]?.disabled) {
          doctor.value = '';
        }
      };

      department.addEventListener('change', filterDoctors);
      filterDoctors();
    })();
  </script>
@endsection
