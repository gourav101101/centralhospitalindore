<section style="padding: 72px 0; position: relative; z-index: 1;">
  <div class="container">
    <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: var(--radius-xl); padding: 60px; display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-xl); position: relative; overflow: hidden;" class="cta-box">
       <!-- Decoration -->
       <div style="position: absolute; top: -50%; right: -10%; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); pointer-events: none;"></div>
       <div style="position: absolute; bottom: -20%; left: 10%; width: 200px; height: 200px; border-radius: 50%; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); pointer-events: none;"></div>
       
       <div style="position: relative; z-index: 1; max-width: 600px;">
           <h2 style="font-size: 32px; font-weight: 800; color: white; margin-bottom: 16px; line-height: 1.2;">
               Ready to take control of your health?
           </h2>
           <p style="font-size: 16px; color: rgba(255,255,255,0.9); margin-bottom: 0; line-height: 1.6;">
               Request an appointment with our team at Central Hospital Indore, near Rasoma Square, Indore.
           </p>
       </div>
       
       <div style="position: relative; z-index: 1; display: flex; gap: 16px;" class="cta-buttons">
           <a href="{{ route('appointment') }}" class="btn btn-white btn-lg" style="color: var(--primary);">
              Book Appointment
           </a>
           <a href="tel:{{ $siteSettings->phone_href }}" class="btn btn-outline btn-lg" style="color: white; border-color: rgba(255,255,255,0.4);" onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='white'" onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,0.4)'">
              Call Helpline
           </a>
       </div>
    </div>
  </div>
  
  <style>
    @media (max-width: 968px) {
      .cta-box { 
          flex-direction: column !important; 
          text-align: center !important; 
          padding: 40px 24px !important; 
          gap: 32px !important;
      }
      .cta-buttons {
          flex-direction: column;
          width: 100%;
      }
      .cta-buttons .btn {
          width: 100%;
      }
    }
  </style>
</section>
