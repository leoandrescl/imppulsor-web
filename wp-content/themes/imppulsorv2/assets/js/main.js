// Modal autor (single-insights)
document.addEventListener('DOMContentLoaded', () => {
  const open = document.querySelector('[data-open-autor]');
  const modal = document.getElementById('autorModal');

  if (!open || !modal) return;

  const openModal = () => modal.classList.add('active');
  const closeModal = () => modal.classList.remove('active');

  open.addEventListener('click', openModal);

  modal.addEventListener('click', (e) => {
    if (e.target.matches('[data-close-autor]') || e.target.classList.contains('autor-modal')) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
});




// fade-in al entrar en viewport (solo sections / bloques principales)
document.addEventListener("DOMContentLoaded", () => {
  const FADE_SELECTOR =
    ".fade-in, .reveal, .reveal-up, .reveal-down, .reveal-left, .reveal-right";

  const FADE_CLASS_MAP = {
    "fade-in": "fade-in--animate",
    reveal: "reveal--animate",
    "reveal-up": "reveal-up--animate",
    "reveal-down": "reveal-down--animate",
    "reveal-left": "reveal-left--animate",
    "reveal-right": "reveal-right--animate",
  };

  function isInsideFadeAncestor(el) {
    const parent = el.parentElement;
    if (!parent) return false;
    return !!parent.closest(FADE_SELECTOR);
  }

  /** Sections, footer, bloques y wrappers directos de main — no hijos ni aside */
  function isPrincipalFadeTarget(el) {
    if (!el.matches(FADE_SELECTOR)) return false;
    if (isInsideFadeAncestor(el)) return false;
    if (el.closest("aside")) return false;

    if (el.matches("section, footer")) return true;
    if (el.matches("main > div, main > section")) return true;
    if (el.matches('[class*="bloque-"], [id^="bloque-"]')) return true;
    if (el.matches(".hero-section, #special-product-parallax-wrapper")) return true;

    return false;
  }

  function addAnimateClass(el) {
    Object.entries(FADE_CLASS_MAP).forEach(([source, animate]) => {
      if (el.classList.contains(source)) el.classList.add(animate);
    });
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1 }
  );

  document.querySelectorAll(FADE_SELECTOR).forEach((el) => {
    if (el.dataset.fadeInManual) return;

    if (!isPrincipalFadeTarget(el)) {
      el.classList.add("visible");
      return;
    }

    addAnimateClass(el);
    observer.observe(el);

    if (el.getBoundingClientRect().top < window.innerHeight) {
      el.classList.add("visible");
    }
  });
});

// animacion acordeon diagnostico
document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  document.querySelectorAll('.accordion-item').forEach(item => {
    observer.observe(item);
  });
});


// texto expandible
document.addEventListener('DOMContentLoaded', () => {
  const toggles = document.querySelectorAll('.texto-expandible__toggle');

  toggles.forEach(toggle => {
    toggle.addEventListener('click', e => {
      e.preventDefault();

      const parent = toggle.closest('div');
      const hiddenText = parent.querySelector('.texto-expandible--oculto');

      if (hiddenText) {
        hiddenText.classList.toggle('visible');
        toggle.textContent = hiddenText.classList.contains('visible')
          ? 'Leer menos …'
          : 'Leer más …';
      }
    });
  });
});

/* =========================================================
   SPECIAL PARALLAX (SPP) - Centralized Logic
   Compatible with iOS/Mobile (Bounded + Hardware Accel)
   ========================================================= */
document.addEventListener('DOMContentLoaded', () => {
  const parallaxSections = document.querySelectorAll('.spp-section');

  if (!parallaxSections.length) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      const section = entry.target;

      if (entry.isIntersecting) {
        section.dataset.visible = "true";
        if (!section.dataset.rafId) {
          startParallaxLoop(section);
        }
      } else {
        section.dataset.visible = "false";
        if (section.dataset.rafId) {
          cancelAnimationFrame(parseInt(section.dataset.rafId));
          section.dataset.rafId = ""; // Clear string
        }
      }
    });
  }, { rootMargin: '100px 0px', threshold: 0 });

  parallaxSections.forEach(section => observer.observe(section));

  function startParallaxLoop(section) {
    const image = section.querySelector('.spp-bg-image');
    if (!image) return;

    // Default factor
    const parallaxFactor = 0.25;

    function update() {
      if (section.dataset.visible !== "true") {
        section.dataset.rafId = "";
        return;
      }

      const rect = section.getBoundingClientRect();
      const viewHeight = window.innerHeight;

      // Double check visibility bounds
      if (rect.bottom < 0 || rect.top > viewHeight) {
        section.dataset.rafId = requestAnimationFrame(update);
        return;
      }

      const elementCenter = rect.top + rect.height / 2;
      const viewCenter = viewHeight / 2;
      const distanceFromCenter = elementCenter - viewCenter;

      // Calculate max safe offset
      const imageHeight = image.offsetHeight;
      const sectionHeight = rect.height;
      // Allow a small margin of error (e.g. 1px) to avoid subpixel rounding gaps
      const maxOffset = Math.max(0, (imageHeight - sectionHeight) / 2);

      // Reverse for depth effect (scrolls slower than page)
      let yPos = distanceFromCenter * parallaxFactor * -1;

      // Clamp values to strictly prevent overscroll gaps
      yPos = Math.max(-maxOffset, Math.min(maxOffset, yPos));

      image.style.transform = `translate3d(0, ${yPos}px, 0)`;

      section.dataset.rafId = requestAnimationFrame(update);
    }

    section.dataset.rafId = requestAnimationFrame(update);
  }
});
