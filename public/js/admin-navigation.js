(() => {
  const side = document.querySelector('#admin-navigation');
  const main = document.querySelector('#admin-main');
  const toggle = document.querySelector('.menu-toggle');
  const close = document.querySelector('.menu-close');
  const backdrop = document.querySelector('.menu-backdrop');
  const mobile = window.matchMedia('(max-width: 900px)');
  let open = false;
  function setOpen(value, restoreFocus = true) {
    open = value && mobile.matches;
    side.classList.toggle('is-open', open);
    document.body.classList.toggle('menu-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    backdrop.hidden = !open;
    main.inert = open;
    side.inert = mobile.matches && !open;
    if (open) {
      side.setAttribute('role', 'dialog');
      side.setAttribute('aria-modal', 'true');
      close.focus();
    } else {
      side.removeAttribute('role');
      side.removeAttribute('aria-modal');
      if (restoreFocus && mobile.matches) toggle.focus();
    }
  }
  toggle.addEventListener('click', () => setOpen(!open));
  close.addEventListener('click', () => setOpen(false));
  backdrop.addEventListener('click', () => setOpen(false));
  side.querySelectorAll('a').forEach(link => {
    if (link.classList.contains('active')) link.setAttribute('aria-current', 'page');
    link.addEventListener('click', () => setOpen(false));
  });
  document.addEventListener('keydown', event => {
    if (!open) return;
    if (event.key === 'Escape') setOpen(false);
    if (event.key !== 'Tab') return;
    const items = [...side.querySelectorAll('a[href], button')];
    const first = items[0], last = items[items.length - 1];
    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault(); last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault(); first.focus();
    }
  });
  mobile.addEventListener('change', () => setOpen(false, false));
  setOpen(false, false);
  document.querySelectorAll('.table').forEach(table => {
    const headers = [...table.querySelectorAll('thead th')].map(th => th.textContent.trim());
    if (!headers.length) return;
    table.setAttribute('role', 'table');
    table.querySelectorAll('thead, tbody').forEach(group => group.setAttribute('role', 'rowgroup'));
    table.querySelectorAll('tr').forEach(row => row.setAttribute('role', 'row'));
    table.querySelectorAll('th').forEach(th => { th.setAttribute('scope', 'col'); th.setAttribute('role', 'columnheader'); });
    table.querySelectorAll('tbody tr').forEach(row => {
      [...row.cells].forEach((cell, index) => {
        cell.setAttribute('role', 'cell');
        if (!cell.hasAttribute('colspan')) cell.dataset.label = headers[index] || 'Actions';
      });
    });
    table.classList.add('mobile-records');
  });
})();
