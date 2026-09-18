<?php
if (!defined('ABSPATH')) exit;

$url    = urlencode(get_permalink());
$titulo = get_the_title() ?: get_bloginfo('name');

// Slides desde ACF Free
$slides = [];
for ($i = 1; $i <= 4; $i++) {
  $img = get_field("slide_{$i}_imagen");
  if (!empty($img['url'])) {
    $slides[] = [
      'imagen'      => $img['url'],
      'titulo'      => get_field("slide_{$i}_titulo"),
      'texto'       => get_field("slide_{$i}_texto"),
      'boton_label' => get_field("slide_{$i}_boton_label"),
      'boton_url'   => get_field("slide_{$i}_boton_url"),
    ];
  }
}
if (empty($slides)) return;
?>

<section class="hero-wrap">
  <div id="hero-swiper" class="swiper hero-swiper">
    <div class="swiper-wrapper">

      <?php foreach ($slides as $s): ?>
        <div class="swiper-slide">
          <div class="hero-section fullwidth reveal reveal-up"
               style="background-image:url('<?php echo esc_url($s['imagen']); ?>');">

            <div class="hero-overlay"></div>

            <div class="hero-content container">
              <div class="inner-container text-white">
                <h1 class="hero-title mb-30"><?php echo esc_html($s['titulo']); ?></h1>

                <?php if (!empty($s['texto'])): ?>
                  <p class="hero-text mb-60"><?php echo esc_html($s['texto']); ?></p>
                <?php endif; ?>

                <?php if (!empty($s['boton_label']) && !empty($s['boton_url'])): ?>
                  <a href="<?php echo esc_url($s['boton_url']); ?>" class="btn-outline btn-outline--square">
                    <?php echo esc_html($s['boton_label']); ?>
                  </a>
                <?php endif; ?>
              </div>
            </div>

            <!-- Social links inside the hero -->
            <div class="hero-social reveal reveal-up">
              <a href="https://www.linkedin.com/company/imppulsor/"
                target="_blank" rel="noopener" aria-label="LinkedIn" class="hero-social__link ">
                <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24">
              </a>
              <a href="https://x.com/imppulsor"
                target="_blank" rel="noopener" aria-label="X" class="hero-social__link ">
                <img src="/wp-content/uploads/icon-x.png" alt="X" width="24" height="24">
              </a>
            </div>

          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <!-- Numbered pagination -->
    <div id="hero-pagination" class="hero-pagination"></div>
  </div>
</section>

<style>


.hero-section .hero-content h1.hero-title {
    max-width: 90%;
}
.hero-section .hero-content p.hero-text {
    max-width: 90%;
}
    .inner-container {
        max-width: 70%;
    }
    .hero-social :is(a, svg) {
    width: 24px;
    height: 24px;
    display: inline-flex;
}
  /* altura del hero home */
  .page-home .hero-section { height: 680px; }

  /* Bullets numerados con tu estilo */
  .hero-pagination .swiper-pagination-bullet{
    width:26px; height:26px; border:1px solid #fff; background:transparent;
    color:#fff; display:flex; align-items:center; justify-content:center;
    font-size:14px; font-weight:600; opacity:1; transition:.2s;
  }
  .hero-pagination .swiper-pagination-bullet-active,
  .hero-pagination .swiper-pagination-bullet:hover{
    background:var(--azul-claro); 
    border-color:var(--azul-claro);
  }
  /* --- FIX PAGINACIÓN HERO SLIDER --- */
.hero-wrap { 
  position: relative;
  z-index: 5;
}

/* forzar z-index alto y visibilidad encima del hero */
.page-home .hero-pagination {
    position: relative;
    bottom: 80px;
    max-width: 1200px;
    margin: 0 auto !important;
    display: flex;
    gap: 8px;
    z-index: 1;
    padding-left: 0px !important;
    padding-right: 0px !important;
}
@media (max-width: 1220px) {
  .page-home .hero-pagination {
      /* left: 40px; */
      padding-left: 40px !important;
    padding-right: 40px !important;
  }
}
@media (max-width: 768px) {
  .page-home .hero-pagination {
      /* left: 20px; */
      padding-left: 20px !important;
    padding-right: 20px !important;
  }
}
/* bullets numerados, visibles encima de Swiper */
.hero-pagination .swiper-pagination-bullet {
  width: 26px;
  height: 26px;
  border: 1px solid #fff;
  background: rgba(0,0,0,0.3); /* semitransparente por si la imagen es clara */
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 600;
  opacity: 1 !important;
  transition: all .2s ease;
  border-radius: 0;
}

.hero-pagination .swiper-pagination-bullet-active,
.hero-pagination .swiper-pagination-bullet:hover {
  background: var(--azul-claro);
  border-color: var(--azul-claro);
  color: #fff;
}
/* Oculta slides hasta que Swiper esté listo */
.hero-swiper:not(.swiper-initialized) .swiper-slide {
  opacity: 0;
}

/* Muestra recién al inicializar */
.hero-swiper.swiper-initialized .swiper-slide {
  opacity: 1;
  transition: opacity .4s ease;
}

</style>

<script>
/* Inicialización tardía, con reintento, y scoping por ID para evitar choques */
(function initHeroSwiper(){
  function start(){
    if (typeof Swiper === 'undefined') { setTimeout(start, 60); return; }
    const el = document.querySelector('#hero-swiper');
    const pag = document.querySelector('#hero-pagination');
    if (!el || !pag) { setTimeout(start, 60); return; }

    // Evitar doble init
    if (el.dataset.initialized) return;
    el.dataset.initialized = '1';

    new Swiper('#hero-swiper', {
      loop: true,
      speed: 800,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      autoplay: { delay: 5000, disableOnInteraction: false },
      observer: true, observeParents: true,
      pagination: {
        el: '#hero-pagination',
        clickable: true,
        renderBullet: (index, className) =>
          '<span class="' + className + '">' + (index + 1) + '</span>'
      }
    });
  }
  // Espera a que todo (incluido Swiper) esté disponible
  if (document.readyState === 'complete') start();
  else window.addEventListener('load', start);
})();
</script>
