<section id="departments" class="specialities-section">
  <div class="container">
    <div class="specialities-heading">
      <div class="section-badge">Our departments</div>
      <h2 class="section-title">Care that is built around <span>you</span></h2>
      <p class="section-subtitle">Find the right specialist, explore the care we provide, and request an appointment in just a few steps.</p>
    </div>

    <div class="specialities-grid" data-specialities-grid>
      @forelse($departments->take(4) as $department)
        @php($departmentIcon = strtolower($department->icon ?? ''))
        <article class="speciality-card">
          <div class="speciality-card__top">
            <div class="speciality-icon" aria-hidden="true">
              @switch($departmentIcon)
                @case('heart')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.9-8.6a5.5 5.5 0 0 0-.1-7.8Z"/></svg>
                  @break
                @case('brain')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M9 4a3 3 0 0 0-5.5 1.7A3.7 3.7 0 0 0 4 13a4 4 0 0 0 6 3.5M15 4a3 3 0 0 1 5.5 1.7A3.7 3.7 0 0 1 20 13a4 4 0 0 1-6 3.5M12 3v18M8 8h4m0 4H8m8-4h-4m0 4h4"/></svg>
                  @break
                @case('child')
                @case('mother-child')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><circle cx="12" cy="5" r="2.5"/><path d="M5 21l2.5-7 2.5 2v5m7 0v-5l2.5-2 2.5 7M7.5 14 12 10l4.5 4M12 10v11"/></svg>
                  @break
                @case('bone')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M7.1 8.4a3.3 3.3 0 1 1 4.5-4.7l1.1 1.1 1.1-1.1a3.3 3.3 0 1 1 4.7 4.7l-1.1 1.1 1.1 1.1a3.3 3.3 0 1 1-4.7 4.7l-1.1-1.1-1.1 1.1a3.3 3.3 0 1 1-4.7-4.7l1.1-1.1-1.1-1.1Z"/></svg>
                  @break
                @case('digestive')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M10 3v6a3 3 0 0 0 6 0V6m-6 6c0 5 1.5 8 4 8 3 0 4-3 4-6 0-2-1-4-3-4m-5 2H7a3 3 0 0 0-3 3v1a4 4 0 0 0 4 4h2"/></svg>
                  @break
                @case('skin')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 3c4.5 0 8 3.2 8 7.4 0 5.7-5.1 10.6-8 10.6s-8-4.9-8-10.6C4 6.2 7.5 3 12 3Z"/><path d="M8.5 11.5h.01M12 9h.01m3.5 2.5h.01M10.5 15h3"/></svg>
                  @break
                @case('ear')
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M7.5 14.5V10a4.5 4.5 0 0 1 9 0c0 2.7-1.7 3.7-3 4.8-1 1-1 1.9-1 3.2M12.5 21a1.5 1.5 0 0 1-3 0"/></svg>
                  @break
                @default
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 21V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16M9 21v-5h6v5M8 8h.01M12 8h.01M16 8h.01M8 12h.01M12 12h.01M16 12h.01"/></svg>
              @endswitch
            </div>
            <span class="speciality-label">Specialist care</span>
          </div>
          <div>
            <h3>{{ $department->name }}</h3>
            <p>{{ $department->description ?: 'Personalised diagnosis and treatment from our experienced medical team.' }}</p>
          </div>
        </article>
      @empty
        <div class="specialities-empty">Our department directory is being updated. Please contact us to find the right specialist.</div>
      @endforelse
    </div>
    @if($departments->count() > 4)
      <div class="directory-action">
        <button class="btn btn-outline" type="button" data-show-specialities>View all departments <span aria-hidden="true">↓</span></button>
      </div>
      <template data-extra-specialities>
        @foreach($departments->slice(4) as $department)
          <article class="speciality-card">
            <div class="speciality-card__top"><div class="speciality-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M4 21V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v16M9 21v-5h6v5M8 8h.01M12 8h.01M16 8h.01M8 12h.01M12 12h.01M16 12h.01"/></svg></div><span class="speciality-label">Specialist care</span></div>
            <div><h3>{{ $department->name }}</h3><p>{{ $department->description ?: 'Personalised diagnosis and treatment from our experienced medical team.' }}</p></div>
          </article>
        @endforeach
      </template>
    @endif
  </div>

  <style>
    .specialities-section { padding: 104px 0; background: #F8FAFC; }
    .specialities-heading { max-width: 700px; margin: 0 auto 48px; text-align: center; }
    .specialities-heading .section-badge { margin: 0 auto 15px; }
    .specialities-heading .section-title { margin-bottom: 14px; }
    .specialities-heading .section-title span { color: var(--primary); }
    .specialities-heading .section-subtitle { margin: 0 auto; }
    .specialities-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; }
    .speciality-card { min-height: 240px; display: flex; flex-direction: column; padding: 25px; background: #fff; border: 1px solid #E2E8F0; border-radius: 18px; box-shadow: 0 8px 22px rgba(30, 42, 56, .055); transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease; }
    .speciality-card:hover { transform: translateY(-6px); border-color: #E2E8F0; box-shadow: 0 18px 35px rgba(30, 42, 56, .13); }
    .speciality-card__top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 23px; }
    .speciality-icon { width: 52px; height: 52px; display: grid; place-items: center; color: var(--primary); background: var(--accent); border-radius: 15px; }
    .speciality-icon svg { width: 27px; height: 27px; }
    .speciality-label { color: #5A6B7D; font-size: 11px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
    .speciality-card h3 { margin-bottom: 10px; font-size: 19px; line-height: 1.25; color: var(--text); }
    .speciality-card p { color: var(--text-secondary); font-size: 14px; line-height: 1.65; }
    .directory-action { display: flex; justify-content: center; margin-top: 32px; }
    .directory-action .btn span { margin-left: 7px; font-size: 17px; }
    .specialities-empty { grid-column: 1 / -1; padding: 36px; border: 1px dashed #8896A6; border-radius: 16px; text-align: center; color: var(--text-secondary); }
    @media (max-width: 1024px) { .specialities-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 640px) { .specialities-section { padding: 72px 0; } .specialities-heading { margin-bottom: 32px; } .specialities-grid { grid-template-columns: 1fr; gap: 14px; } .speciality-card { min-height: 250px; } }
  </style>
  <script>
    (() => {
      const trigger = document.querySelector('[data-show-specialities]');
      const template = document.querySelector('[data-extra-specialities]');
      const grid = document.querySelector('[data-specialities-grid]');
      if (!trigger || !template || !grid) return;
      trigger.addEventListener('click', () => {
        grid.append(template.content.cloneNode(true));
        trigger.closest('.directory-action').remove();
      }, { once: true });
    })();
  </script>
</section>
