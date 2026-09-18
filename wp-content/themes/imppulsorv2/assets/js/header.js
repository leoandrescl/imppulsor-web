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

// modal buscador header
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

  // Evita que clicks dentro del formulario cierren el modal
  modal.querySelector('.searchfs__stage').addEventListener('click', e => e.stopPropagation());
})();
// modal buscador header fin


// Cierra mega cuando se sale del header con el teclado (accesibilidad)
document.addEventListener('keydown', (e)=>{
  if (e.key !== 'Escape') return;
  document.querySelectorAll('.has-mega .mega').forEach(p=>{
    // el hover se maneja por CSS, aquí solo quitamos focus
    const focused = p.querySelector('a:focus');
    if (focused) focused.blur();
  });
});

// Megamenú desktop: :hover pegado tras menú contextual (clic derecho).
// No ocultamos en "contextmenu": solo alineamos con la posición real del puntero.
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

  /** Tras clic derecho el foco puede quedar en el <a>; :focus-within + esto impedía mega--pointer-out. */
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

    // Tras clic derecho evitamos tocar el estado mientras el puntero siga dentro
    // del área mega+panel (el menú nativo suele estar ahí). Si ya salió de esa
    // zona, reactivamos la sync y cerramos por geometría sin exigir otro clic.
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

// Evitar que el click en la raíz navegue si solo se quiere abrir el mega (opcional):
document.querySelectorAll('.main-nav .has-mega > .menu-link').forEach(a=>{
  a.addEventListener('click', (ev)=>{
    if (window.matchMedia('(min-width:992px)').matches) {
      // Si el link es solo "#", evitamos navegación
      if (a.getAttribute('href') === '#') ev.preventDefault();
    }
  });
});

// ================================================
// Submenús desplegables en el menú móvil
// ================================================
document.addEventListener('DOMContentLoaded', () => {
  // Seleccionar TODOS los niveles del menú móvil
  const menuItems = document.querySelectorAll('.mobile-menu li.menu-item-has-children');

  menuItems.forEach(item => {

    // Evitar duplicados
    if (item.querySelector('.submenu-toggle')) return;

    const link = item.querySelector('a');

    // Crear botón toggle
    const toggle = document.createElement('button');
    toggle.classList.add('submenu-toggle');
    toggle.setAttribute('aria-label', 'Mostrar submenú');
    toggle.innerHTML = '+';

    // Insertar justo después del link
    link.insertAdjacentElement('afterend', toggle);

    // Activar toggle
    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      const isOpen = item.classList.toggle('open');
      toggle.innerHTML = isOpen ? '–' : '+';
    });
  });
});





// Cambiar fondo del header al hacer scroll
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
    // 1. Buscamos todas las columnas de menú
    const menuColumns = document.querySelectorAll('.mega__col--menu');

    menuColumns.forEach(column => {
        const originalList = column.querySelector('.mega__menu');
        if (!originalList) return;

        // Evitar duplicados si ya se ejecutó
        if (column.querySelector('.mega-split-container')) return;

        const items = Array.from(originalList.children);
        const totalItems = items.length;
        
        // 2. CALCULAMOS LA MITAD EXACTA
        // Math.ceil asegura que si son impares (ej: 9), 
        // queden 5 a la izquierda y 4 a la derecha.
        const splitPoint = Math.ceil(totalItems / 2);

        // 3. Creamos las listas nuevas
        const leftList = document.createElement('ul');
        leftList.className = 'mega__menu mega-split-left';
        
        const rightList = document.createElement('ul');
        rightList.className = 'mega__menu mega-split-right';

        // 4. Repartimos: Primera mitad a la IZQ, resto a la DER
        items.forEach((item, index) => {
            if (index < splitPoint) {
                leftList.appendChild(item); // Del 0 al punto medio
            } else {
                rightList.appendChild(item); // Del punto medio al final
            }
        });

        // 5. Creamos el contenedor y reemplazamos
        const container = document.createElement('div');
        container.className = 'mega-split-container';
        
        container.appendChild(leftList);
        container.appendChild(rightList);

        originalList.replaceWith(container);
    });
});