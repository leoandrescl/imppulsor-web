<?php
/**
 * Hero global: slider de banners (layout Insights/Casos + fondo full width como home).
 */
if (!defined('ABSPATH')) {
    exit;
}

$banner_posts = get_query_var('imppulsor_hero_banner_posts');
if (empty($banner_posts) || !is_array($banner_posts)) {
    return;
}

$total_banners = count($banner_posts);
?>

<section class="hero-section hero-section-no-border hero-wrap hero-global-banners<?php echo $total_banners <= 1 ? ' hero-global-banners--single' : ''; ?>">
  <div id="hero-global-swiper" class="swiper hero-swiper hero-global-swiper">
    <div class="swiper-wrapper">

      <?php foreach ($banner_posts as $banner_post) :
          $bid = (int) $banner_post->ID;
          $etiqueta = function_exists('get_field') ? (string) get_field('etiqueta', $bid) : '';
          $linea_superior = function_exists('get_field') ? (string) get_field('linea_superior', $bid) : '';
          $titulo_hero = function_exists('get_field') ? trim((string) get_field('titulo_hero', $bid)) : '';
          if (is_singular('casos_exito')) {
              $titulo = 'Success stories';
          } elseif (is_singular('insights')) {
              $titulo = 'Insights';
          } else {
              $titulo = $titulo_hero !== '' ? $titulo_hero : get_the_title($bid);
          }
          $bajada = function_exists('get_field') ? trim((string) get_field('bajada', $bid)) : '';
          $autor_linea = function_exists('get_field') ? trim((string) get_field('autor_linea', $bid)) : '';
          $cta_texto = function_exists('get_field') ? trim((string) get_field('cta_texto', $bid)) : '';
          $cta_url = function_exists('get_field') ? trim((string) get_field('cta_url', $bid)) : '';
          $img = get_the_post_thumbnail_url($bid, 'full');
          if (!$img) {
              $img = get_the_post_thumbnail_url($bid, 'large');
          }
          $bg_style = $img ? "background-image:url('" . esc_url($img) . "');" : '';
          ?>
        <div class="swiper-slide">
          <div class="hero-global-slide-pane fullwidth"<?php echo $bg_style ? ' style="' . esc_attr($bg_style) . '"' : ''; ?>>
            <div class="hero-global-slide__overlay" aria-hidden="true"></div>

            <div class="container hero-global-slide__inner">
              <section class="bloque-home bloque-hero-insight text-white grid h-100">
                <div class="grid-2 pb-80 pt-20 h-100">

                  <div class="bloque-hero-text top-20x p-relative">

                    <?php if ($etiqueta !== '') : ?>
                      <span class="badge bg-light-blue px-40 text-bold"><?php echo esc_html($etiqueta); ?></span>
                    <?php endif; ?>

                    <?php if ($linea_superior !== '') : ?>
                      <p class="my-10 text-bold"><?php echo esc_html($linea_superior); ?></p>
                    <?php endif; ?>

                    <h1 class="heading-lg mb-20"><?php echo esc_html($titulo); ?></h1>

                    <?php if ($bajada !== '') : ?>
                      <p class="hero-text <?php echo $autor_linea !== '' ? 'mb-20' : 'mb-40'; ?>"><?php echo esc_html($bajada); ?></p>
                    <?php endif; ?>

                    <?php if ($autor_linea !== '') : ?>
                      <p class="mb-40 text-sm opacity-80"><?php echo esc_html($autor_linea); ?></p>
                    <?php endif; ?>

                    <?php if ($cta_texto !== '' && $cta_url !== '') : ?>
                      <a href="<?php echo esc_url($cta_url); ?>" class="btn-outline btn-outline--square<?php echo ($bajada === '' && $autor_linea === '') ? ' mt-20' : ''; ?>">
                        <?php echo esc_html($cta_texto); ?>
                      </a>
                    <?php endif; ?>
                  </div>

                  <div class="bloque-hero-img-col" aria-hidden="true"></div>
                </div>
              </section>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <?php if ($total_banners > 1) : ?>
      <div class="hero-global-pagination-bar">
        <div class="container">
          <div id="hero-global-pagination" class="hero-pagination"></div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<style>
/* ===== Hero global — mismas reglas que Insights/Casos + fondo full bleed ===== */
div#hero-global-swiper {
  height: 100%;
  position: relative;
  width: 100%;
  max-width: none;
}

section.hero-section.hero-global-banners {
  min-height: max-content;
  height: 680px;
  background: url(/wp-content/uploads/bg-hero-insights.svg) no-repeat center center;
  background-size: cover;
  overflow: hidden;
}

section.hero-section.hero-global-banners::before {
  display: none;
}

.hero-global-banners .hero-global-slide-pane {
  position: relative;
  width: 100%;
  height: 680px;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}

.hero-global-banners .hero-global-slide__overlay {
  position: absolute;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  background: linear-gradient(
    90deg,
    rgba(3, 14, 35, 0.9) 0%,
    rgba(3, 14, 35, 0.72) 38%,
    rgba(3, 14, 35, 0.45) 58%,
    rgba(3, 14, 35, 0.2) 100%
  );
}

.hero-global-banners .hero-global-slide__inner {
  position: relative;
  z-index: 2;
  height: 100%;
}

.hero-global-banners .swiper-slide {
  position: relative;
  z-index: 0;
  opacity: 0 !important;
  transition: opacity .6s ease-in-out;
}

.hero-global-banners .swiper-slide-active {
  z-index: 1;
  opacity: 1 !important;
}

.hero-global-banners .bloque-hero-img-col {
  min-height: 1px;
}

.hero-global-banners .badge.bg-light-blue {
  text-transform: uppercase;
}

/* Paginación numerada (igual Insights) */
.hero-global-banners .hero-global-pagination-bar {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 80px;
  z-index: 10;
  pointer-events: none;
}

.hero-global-banners .hero-global-pagination-bar .container {
  pointer-events: auto;
}

.hero-global-banners .hero-pagination {
  position: relative;
  display: flex !important;
  gap: 8px;
  justify-content: flex-start;
  opacity: 0;
  transition: opacity .6s ease-out;
}

.hero-global-banners .hero-pagination.visible {
  opacity: 1;
}

.hero-global-banners .swiper-pagination-bullet {
  width: 26px;
  height: 26px;
  border: 1px solid #fff;
  background: transparent;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 600;
  opacity: 1;
  transition: all .3s ease;
  border-radius: 0;
  cursor: pointer;
}

.hero-global-banners .swiper-pagination-bullet-active,
.hero-global-banners .swiper-pagination-bullet:hover {
  background: #006EFF;
  border-color: #006EFF;
  color: #fff;
}

.hero-global-banners .bloque-hero-text h1 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1.25;
  max-height: calc(1.25em * 2);
}

.hero-global-banners .bloque-hero-text .hero-text {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1.5;
  max-height: calc(1.5em * 3);
}

@media (min-width: 993px) {
  .hero-global-banners .grid-2.pb-80.pt-120 {
    padding-top: 56px;
  }
}

/* ===== Mobile / tablet (sin imagen lateral: alto propio, no 380px) ===== */
@media (max-width: 992px) {
  section.hero-section.hero-global-banners {
    height: auto !important;
    min-height: 720px;
    padding-bottom: 0;
  }

  div#hero-global-swiper {
    min-height: 720px;
  }

  .hero-global-banners .swiper-slide {
    min-height: 720px;
    height: auto;
  }

  .hero-global-banners .hero-global-slide-pane {
    min-height: 720px;
    height: auto;
    padding-bottom: 32px;
    box-sizing: border-box;
  }

  .hero-global-banners .hero-global-slide__inner {
    height: auto;
    min-height: 100%;
  }

  .hero-global-banners .hero-global-slide__overlay {
    background: linear-gradient(
      180deg,
      rgba(3, 14, 35, 0.92) 0%,
      rgba(3, 14, 35, 0.82) 42%,
      rgba(3, 14, 35, 0.65) 100%
    );
  }

  /* Espacio bajo el header fijo (como Insights) */
  .hero-global-banners .bloque-hero-text.top-20x {
    top: 0 !important;
  }

  .hero-global-banners .grid-2 {
    display: block;
    padding-top: 160px !important;
    /* Reserva hueco para CTA + paginador sin solaparse */
    padding-bottom: 120px !important;
  }

  .hero-global-banners .bloque-hero-img-col {
    display: none;
  }

  .hero-global-banners .bloque-hero-text {
    max-width: 100%;
    text-align: left;
    padding-right: 0;
  }

  .hero-global-banners .heading-lg {
    font-size: 30px;
    line-height: 1.2;
    margin-bottom: 16px !important;
  }

  .hero-global-banners .bloque-hero-text h1 {
    -webkit-line-clamp: 4;
    max-height: calc(1.2em * 4);
  }

  .hero-global-banners .bloque-hero-text .hero-text {
    font-size: 15px;
    line-height: 1.45;
    margin-bottom: 20px !important;
  }

  .hero-global-banners .bloque-hero-text .btn-outline {
    margin-top: 4px;
  }

  .hero-global-banners .hero-global-pagination-bar {
    bottom: 24px;
  }

  .hero-global-banners .hero-global-pagination-bar .container {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }

  .hero-global-banners .hero-pagination {
    left: 0;
  }

  /* Un solo banner: menos alto, sin hueco de paginador */
  section.hero-section.hero-global-banners.hero-global-banners--single {
    min-height: 580px;
  }

  .hero-global-banners--single .hero-global-slide-pane,
  .hero-global-banners--single .swiper-slide,
  .hero-global-banners--single div#hero-global-swiper {
    min-height: 580px;
  }

  .hero-global-banners--single .grid-2 {
    padding-bottom: 48px !important;
  }
}

@media (max-width: 576px) {
  section.hero-section.hero-global-banners {
    min-height: 680px;
  }

  section.hero-section.hero-global-banners.hero-global-banners--single {
    min-height: 540px;
  }

  div#hero-global-swiper,
  .hero-global-banners .swiper-slide,
  .hero-global-banners .hero-global-slide-pane {
    min-height: 680px;
  }

  .hero-global-banners--single .hero-global-slide-pane,
  .hero-global-banners--single .swiper-slide,
  .hero-global-banners--single div#hero-global-swiper {
    min-height: 540px;
  }


  .hero-global-banners .heading-lg {
    font-size: 26px;
  }

  .hero-global-banners .badge.bg-light-blue {
    font-size: 12px;
    padding-left: 24px !important;
    padding-right: 24px !important;
  }
}
</style>

<script>
(function initHeroGlobalBanners() {
  function start() {
    if (typeof Swiper === 'undefined') {
      setTimeout(start, 60);
      return;
    }

    const el = document.querySelector('#hero-global-swiper');
    const pag = document.querySelector('#hero-global-pagination');
    if (!el || el.dataset.initialized) {
      return;
    }
    el.dataset.initialized = '1';

    const swiperConfig = {
      loop: true,
      speed: 1000,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      autoplay: { delay: 6000, disableOnInteraction: false },
      observer: true,
      observeParents: true,
      on: {
        init: function () {
          if (pag) {
            setTimeout(function () {
              pag.classList.add('visible');
            }, 300);
          }
        },
        slideChangeTransitionStart: function () {
          el.querySelectorAll('.swiper-slide').forEach(function (s) {
            s.style.opacity = '0';
          });
          var active = el.querySelector('.swiper-slide-active');
          if (active) {
            active.style.opacity = '1';
          }
        }
      }
    };

    if (pag) {
      swiperConfig.pagination = {
        el: '#hero-global-pagination',
        clickable: true,
        renderBullet: function (index, className) {
          return '<span class="' + className + '">' + (index + 1) + '</span>';
        }
      };
    }

    new Swiper(el, swiperConfig);
  }

  if (document.readyState === 'complete') {
    start();
  } else {
    window.addEventListener('load', start);
  }
})();
</script>
