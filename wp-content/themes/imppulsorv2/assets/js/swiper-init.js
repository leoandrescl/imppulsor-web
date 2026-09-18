document.addEventListener('DOMContentLoaded', () => {

  // === Testimonios ===
  if (document.querySelector('.testimonios-slider')) {
    new Swiper('.testimonios-slider', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      pagination: {
        el: '.testimonios-slider .swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.testimonios-slider .swiper-button-next',
        prevEl: '.testimonios-slider .swiper-button-prev',
      },
      autoplay: {
        delay: 6000,
      },
    });
  }

  // === Casos de Éxito ===
  if (document.querySelector('.casos-slider')) {
    new Swiper('.casos-slider', {
      slidesPerView: 3,
      spaceBetween: 20,
      loop: true,
      pagination: {
        el: '.casos-slider .swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.bloque-casos-exito__nav .swiper-button-next',
        prevEl: '.bloque-casos-exito__nav .swiper-button-prev',
      },
      autoplay: {
        delay: 5000,
      },
      breakpoints: {
        0: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 }
      }
    });
  }

  // === Insights ===
  if (document.querySelector('.insights-slider')) {
    new Swiper('.insights-slider', {
      slidesPerView: 3,
      spaceBetween: 20,
      loop: true,
      pagination: {
        el: '.insights-slider .swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.insights-slider .swiper-button-next',
        prevEl: '.insights-slider .swiper-button-prev',
      },
      autoplay: {
        delay: 7000,
      },
      breakpoints: {
        0: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 }
      }
    });
  }

  // Hero global (banner_hero): init en hero-global-banners.php

});
