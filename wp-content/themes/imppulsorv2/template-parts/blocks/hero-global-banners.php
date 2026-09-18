<?php
/**
 * Hero global: slider de banners (layout tipo Insights, imagen a pantalla completa).
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
          $titulo = $titulo_hero !== '' ? $titulo_hero : get_the_title($bid);
          $bajada = function_exists('get_field') ? trim((string) get_field('bajada', $bid)) : '';
          $autor_linea = function_exists('get_field') ? trim((string) get_field('autor_linea', $bid)) : '';
          $cta_texto = function_exists('get_field') ? trim((string) get_field('cta_texto', $bid)) : '';
          $cta_url = function_exists('get_field') ? trim((string) get_field('cta_url', $bid)) : '';
          $img = get_the_post_thumbnail_url($bid, 'full');
          if (!$img) {
              $img = get_the_post_thumbnail_url($bid, 'large');
          }
          ?>
        <div class="swiper-slide hero-global-slide<?php echo $img ? ' hero-global-slide--has-img' : ''; ?>">
          <?php if ($img) : ?>
            <div
              class="hero-global-slide__bg"
              style="background-image: url('<?php echo esc_url($img); ?>');"
              role="img"
              aria-label="<?php echo esc_attr($titulo); ?>"
            ></div>
            <div class="hero-global-slide__overlay" aria-hidden="true"></div>
          <?php endif; ?>

          <div class="container hero-global-slide__content">
            <section class="bloque-home bloque-hero-insight text-white grid h-100">
              <div class="grid-2 pb-80 pt-120 h-100">

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
      <?php endforeach; ?>

    </div>

    <?php if ($total_banners > 1) : ?>
      <div id="hero-global-pagination" class="hero-pagination container"></div>
    <?php endif; ?>
  </div>
</section>

<script>
(function initHeroGlobalBanners() {
  function start() {
    if (typeof Swiper === 'undefined') {
      setTimeout(start, 60);
      return;
    }

    var el = document.querySelector('#hero-global-swiper');
    var pag = document.querySelector('#hero-global-pagination');
    if (!el || el.dataset.initialized) {
      return;
    }
    el.dataset.initialized = '1';

    var swiperConfig = {
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
