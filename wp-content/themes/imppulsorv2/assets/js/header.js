document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.querySelector('.mobile-menu');
  const overlay = document.querySelector('.mobile-menu-overlay');
  const close = document.querySelector('.mobile-close');

  const openMenu = () => {
    menu.classList.add('active');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  };

  const closeMenu = () => {
    menu.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  };

  toggle?.addEventListener('click', openMenu);
  close?.addEventListener('click', closeMenu);
  overlay?.addEventListener('click', closeMenu);
});

// Header search modal
(function(){
  const modal   = document.getElementById('searchModal');
  const openBtn = document.querySelector('.mobile-search-toggle');
  if(!modal || !openBtn) return;

  const backdrop = modal.querySelector('.searchfs__backdrop');
  const closeBtn = modal.querySelector('.searchfs__close');
  const input    = modal.querySelector('input[type="search"]');

  const open = () => {
    modal.classList.add('active');
    document.documentElement.style.overflow = 'hidden';
    setTimeout(()=> input && input.focus(), 60);
  };

  const close = () => {
    modal.classList.remove('active');
    document.documentElement.style.overflow = '';
  };

  openBtn.addEventListener('click', open);
  closeBtn.addEventListener('click', close);
  backdrop.addEventListener('click', close);
  document.addEventListener('keydown', e => { if(e.key === 'Escape') close(); });

  // Prevent clicks inside the form from closing the modal
  modal.querySelector('.searchfs__stage').addEventListener('click', e => e.stopPropagation());
})();
 // Header search modal end


// Close mega when leaving the header with the keyboard (accessibility)
document.addEventListener('keydown', (e)=>{
  if (e.key !== 'Escape') return;
  document.querySelectorAll('.has-mega .mega').forEach(p=>{
    // hover is handled by CSS, here we only remove focus
    const focused = p.querySelector('a:focus');
    if (focused) focused.blur();
  });
});

// Desktop megamenu: sticky :hover after context menu (right click).
// We do not hide on "contextmenu": we only align with the real pointer position.
(function megaMenuPointerGeometry() {
  const mq = window.matchMedia('(min-width:992px)');
  const nav = document.querySelector('.main-nav');
  if (!nav) return;

  let rafId = 0;
  let ctxMenuOpen = false;
  let lastX = 0;
  let lastY = 0;

  function combinedMegaRect(li) {
    const mega = li.querySelector(':scope > .mega');
    const r1 = li.getBoundingClientRect();
    if (!mega) return r1;
    const r2 = mega.getBoundingClientRect();
    return {
      left: Math.min(r1.left, r2.left),
      top: Math.min(r1.top, r2.top),
      right: Math.max(r1.right, r2.right),
      bottom: Math.max(r1.bottom, r2.bottom),
    };
  }

  function inRect(x, y, r) {
    return x >= r.left && x <= r.right && y >= r.top && y <= r.bottom;
  }

  /** After right click, focus may stay on the <a>; :focus-within + this blocked mega--pointer-out. */
  function blurFocusInContainer(container) {
    const ae = document.activeElement;
    if (!ae || !container.contains(ae)) return;
    const tag = ae.tagName;
    if (tag === 'A' || tag === 'BUTTON') ae.blur();
  }

  function clearMegaPointerClasses() {
    nav.querySelectorAll('.has-mega.mega--pointer-out').forEach((el) => el.classList.remove('mega--pointer-out'));
    nav.querySelectorAll('.mega__menu > li.menu-item-has-children.mega-l3--pointer-out').forEach((el) =>
      el.classList.remove('mega-l3--pointer-out')
    );
  }

  function forceCloseMegasUnlessFocused() {
    nav.querySelectorAll('.has-mega').forEach((li) => {
      if (!li.contains(document.activeElement)) li.classList.add('mega--pointer-out');
    });
    nav.querySelectorAll('.mega__col--menu .mega__menu > li.menu-item-has-children').forEach((li) => {
      if (!li.contains(document.activeElement)) li.classList.add('mega-l3--pointer-out');
    });
  }

  function runSync(ev) {
    if (!mq.matches) {
      clearMegaPointerClasses();
      return;
    }

    const x = typeof ev.clientX === 'number' ? ev.clientX : lastX;
    const y = typeof ev.clientY === 'number' ? ev.clientY : lastY;

    // After right click we avoid touching state while the pointer is still inside
    // the mega+panel area (the native menu is usually there). Once it has left that
    // zone, we re-enable sync and close by geometry without requiring another click.
    if (ctxMenuOpen) {
      let insideAnyMegaZone = false;
      nav.querySelectorAll('.has-mega').forEach((li) => {
        if (inRect(x, y, combinedMegaRect(li))) insideAnyMegaZone = true;
      });
      if (insideAnyMegaZone) return;
      ctxMenuOpen = false;
    }

    nav.querySelectorAll('.has-mega').forEach((li) => {
      const r = combinedMegaRect(li);
      const outside = !inRect(x, y, r);
      if (outside) {
        blurFocusInContainer(li);
        li.classList.add('mega--pointer-out');
      } else {
        li.classList.remove('mega--pointer-out');
      }
    });

    nav.querySelectorAll('.mega__col--menu .mega__menu > li.menu-item-has-children').forEach((li) => {
      const r = li.getBoundingClientRect();
      const outside = !inRect(x, y, r);
      if (outside) {
        blurFocusInContainer(li);
        li.classList.add('mega-l3--pointer-out');
      } else {
        li.classList.remove('mega-l3--pointer-out');
      }
    });
  }

  function schedule(ev) {
    if (typeof ev.clientX === 'number' && typeof ev.clientY === 'number') {
      lastX = ev.clientX;
      lastY = ev.clientY;
    }
    cancelAnimationFrame(rafId);
    rafId = requestAnimationFrame(() => runSync(ev));
  }

  nav.addEventListener(
    'contextmenu',
    (e) => {
      if (!mq.matches) return;
      if (!e.target.closest('.has-mega, .mega')) return;
      queueMicrotask(() => {
        ctxMenuOpen = true;
      });
    },
    true
  );

  function endContextMenuAndSync(ev) {
    ctxMenuOpen = false;
    schedule(ev || { clientX: lastX, clientY: lastY });
  }

  document.addEventListener(
    'pointerdown',
    (e) => {
      if (e.isPrimary && e.button === 0) endContextMenuAndSync(e);
      else schedule(e);
    },
    true
  );

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') endContextMenuAndSync({ clientX: lastX, clientY: lastY });
  }, true);

  window.addEventListener('blur', () => {
    ctxMenuOpen = false;
    if (mq.matches) forceCloseMegasUnlessFocused();
  });

  window.addEventListener('focus', () => {
    ctxMenuOpen = false;
    schedule({ clientX: lastX, clientY: lastY });
  });

  document.addEventListener('pointermove', schedule, { passive: true });
  document.addEventListener('mousemove', schedule, { passive: true });

  mq.addEventListener('change', () => {
    ctxMenuOpen = false;
    schedule({ clientX: lastX, clientY: lastY });
  });
})();

// Prevent the root click from navigating if the intent is only to open the mega (optional):
document.querySelectorAll('.main-nav .has-mega > .menu-link').forEach(a=>{
  a.addEventListener('click', (ev)=>{
    if (window.matchMedia('(min-width:992px)').matches) {
      // If the link is just "#", prevent navigation
      if (a.getAttribute('href') === '#') ev.preventDefault();
    }
  });
});

// ================================================
// Expandable submenus in the mobile menu
// ================================================
document.addEventListener('DOMContentLoaded', () => {
  // Select ALL mobile menu levels
  const menuItems = document.querySelectorAll('.mobile-menu li.menu-item-has-children');

  menuItems.forEach(item => {

    // Avoid duplicates
    if (item.querySelector('.submenu-toggle')) return;

    const link = item.querySelector('a');

    // Create toggle button
    const toggle = document.createElement('button');
    toggle.classList.add('submenu-toggle');
    toggle.setAttribute('aria-label', 'Show submenu');
    toggle.innerHTML = '+';

    // Insert right after the link
    link.insertAdjacentElement('afterend', toggle);

    // Enable toggle
    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      const isOpen = item.classList.toggle('open');
      toggle.innerHTML = isOpen ? '–' : '+';
    });
  });
});





// Change header background on scroll
document.addEventListener('scroll', function() {
  const header = document.querySelector('.site-header');
  if (!header) return;
  if (window.scrollY > 76) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});








document.addEventListener("DOMContentLoaded", function() {
    // 1. Find all menu columns
    const menuColumns = document.querySelectorAll('.mega__col--menu');

    menuColumns.forEach(column => {
        const originalList = column.querySelector('.mega__menu');
        if (!originalList) return;

        // Avoid duplicates if already executed
        if (column.querySelector('.mega-split-container')) return;

        const items = Array.from(originalList.children);
        const totalItems = items.length;
        
        // 2. CALCULATE THE EXACT HALF
        // Math.ceil ensures that if odd (e.g.: 9), 
        // 5 stay on the left and 4 on the right.
        const splitPoint = Math.ceil(totalItems / 2);

        // 3. Create the new lists
        const leftList = document.createElement('ul');
        leftList.className = 'mega__menu mega-split-left';
        
        const rightList = document.createElement('ul');
        rightList.className = 'mega__menu mega-split-right';

        // 4. Distribute: first half LEFT, rest RIGHT
        items.forEach((item, index) => {
            if (index < splitPoint) {
                leftList.appendChild(item); // From 0 to the midpoint
            } else {
                rightList.appendChild(item); // From the midpoint to the end
            }
        });

        // 5. Create the container and replace
        const container = document.createElement('div');
        container.className = 'mega-split-container';
        
        container.appendChild(leftList);
        container.appendChild(rightList);

        originalList.replaceWith(container);
    });
});