<section style="padding: 100px 0; background: var(--bg-white);">
  <div class="container" style="max-width: 800px;">
    <div style="text-align: center; margin-bottom: 48px;">
      <h2 class="section-title">Frequently Asked <span style="color: var(--primary);">Questions</span></h2>
      <p class="section-subtitle" style="margin: 0 auto;">Answers to common questions about our hospital services and policies.</p>
    </div>

    <div class="faq-accordion">
      <!-- FAQ 1 -->
      <div class="faq-item">
        <button class="faq-question">
          What are the visiting hours for patients?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="faq-icon"><polyline points="6 9 12 15 18 9" /></svg>
        </button>
        <div class="faq-answer">
          <p>General visiting hours are from 10:00 AM to 12:00 PM and 5:00 PM to 7:00 PM. For the ICU, visiting is strictly restricted to immediate family members for 10 minutes during designated times. Only one attendant is allowed to stay with the patient overnight.</p>
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="faq-item">
        <button class="faq-question">
          Do you accept health insurance and cashless claims?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="faq-icon"><polyline points="6 9 12 15 18 9" /></svg>
        </button>
        <div class="faq-answer">
          <p>Yes, we are empanelled with most major health insurance providers and TPAs for cashless hospitalization. Please bring your health insurance card, government ID (Aadhar/PAN), and previous medical records to the TPA desk during admission.</p>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="faq-item">
        <button class="faq-question">
          Is the pharmacy open 24/7?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="faq-icon"><polyline points="6 9 12 15 18 9" /></svg>
        </button>
        <div class="faq-answer">
          <p>Yes, our in-house pharmacy is open 24 hours a day, 7 days a week for both admitted patients and the general public. We maintain a full stock of emergency and general medicines.</p>
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="faq-item">
        <button class="faq-question">
          How do I book an appointment with a specialist?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="faq-icon"><polyline points="6 9 12 15 18 9" /></svg>
        </button>
        <div class="faq-answer">
          <p>You can book an appointment online through our <a href="{{ route('appointment') }}" style="color: var(--primary); font-weight: 600;">booking page</a>, by calling our helpline at {{ $siteSettings->phone_display }}, or by visiting the reception desk directly. Walk-in consultations are also available depending on doctor availability.</p>
        </div>
      </div>

      <!-- FAQ 5 -->
      <div class="faq-item">
        <button class="faq-question">
          Are emergency services available at night?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="faq-icon"><polyline points="6 9 12 15 18 9" /></svg>
        </button>
        <div class="faq-answer">
          <p>Yes, our Emergency Department and Trauma Center operate 24/7, staffed by experienced emergency physicians, nurses, and support staff. Diagnostic services (X-ray, Pathology) are also available round the clock for emergencies.</p>
        </div>
      </div>
    </div>
  </div>

  <style>
    .faq-accordion {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .faq-item {
      background: white;
      border: 1px solid var(--border-light);
      border-radius: var(--radius-lg);
      overflow: hidden;
      transition: var(--transition);
    }
    .faq-item:hover {
      border-color: var(--primary-200);
      box-shadow: var(--shadow-sm);
    }
    .faq-question {
      width: 100%;
      text-align: left;
      padding: 24px;
      background: none;
      border: none;
      font-size: 16px;
      font-weight: 700;
      color: var(--text);
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: color 0.2s;
    }
    .faq-question:hover {
      color: var(--primary);
    }
    .faq-icon {
      transition: transform 0.3s ease;
      color: var(--primary);
      flex-shrink: 0;
      margin-left: 16px;
    }
    .faq-item.active .faq-icon {
      transform: rotate(180deg);
    }
    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
    }
    .faq-answer p {
      padding: 0 24px 24px;
      margin: 0;
      color: var(--text-secondary);
      line-height: 1.7;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const faqItems = document.querySelectorAll('.faq-item');
      
      faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        question.addEventListener('click', () => {
          const isActive = item.classList.contains('active');
          
          // Close all others
          faqItems.forEach(otherItem => {
            otherItem.classList.remove('active');
            otherItem.querySelector('.faq-answer').style.maxHeight = null;
          });
          
          // Toggle current
          if (!isActive) {
            item.classList.add('active');
            answer.style.maxHeight = answer.scrollHeight + "px";
          }
        });
      });
    });
  </script>
</section>
