<?php
/**
 * Bloque: Hero Slider de Insights (Estable y Alineado)
 */
if (!defined('ABSPATH')) exit;

$query = new WP_Query([
  'post_type'      => 'insights',
  'posts_per_page' => 4,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
]);

if (!$query->have_posts()) return;
?>

<section class="hero-section hero-section-no-border hero-wrap hero-insights">
  <div id="hero-insights-swiper" class="swiper hero-swiper">
    <div class="swiper-wrapper">

      <?php while ($query->have_posts()) : $query->the_post();
        $anio = get_the_date('Y');
        $tags = get_the_terms(get_the_ID(), 'tags_insight');
        $tag_name = ($tags && !is_wp_error($tags)) ? esc_html($tags[0]->name) : '';

        $autor_rel = get_field('autor_relacionado');
        $nombre_autor = '';

        if (is_array($autor_rel) && !empty($autor_rel)) {
            $first = $autor_rel[0];
            $autor_id = is_object($first) ? $first->ID : (is_array($first) && isset($first['ID']) ? $first['ID'] : $first);
            $nombre_autor = get_the_title($autor_id);
        } else {
            $nombre_autor = get_field('autor_nombre') ?: get_the_author();
        }

        $img = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if (!$img) {
            $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        }
        $bg_style = $img ? 'background-image:url(\'' . esc_url($img) . '\');' : '';
      ?>
        <div class="swiper-slide">
          <div class="hero-section fullwidth reveal reveal-up"<?php echo $bg_style ? ' style="' . esc_attr($bg_style) . '"' : ''; ?>>
            <div class="hero-overlay"></div>

            <div class="container">
              <section class="bloque-home bloque-hero-insight text-white grid h-100">
                <div class="grid-2 pb-80 pt-20 h-100">

                  <div class="bloque-hero-text top-20x p-relative">

                    <?php if ($tag_name): ?>
                      <div class="badge bg-light-blue px-40 text-bold">Insights</div>
                    <?php endif; ?>

                    <p class="my-10 text-bold"><?php echo $anio; ?><?php echo $tag_name ? " | $tag_name" : ''; ?></p>

                    <h1 class="heading-lg mb-20"><?php the_title(); ?></h1>

                    <?php
                    $resumen = get_field('resumen_insight');
                    if (!$resumen) {
                        $resumen = wp_trim_words(get_the_excerpt(), 35, '…');
                    }
                    if ($resumen): ?>
                    <p class="hero-text mb-20"><?php echo esc_html($resumen); ?></p>
                    <?php endif; ?>

                    <?php if ($nombre_autor): ?>
                    <p class="mb-40 text-sm opacity-80"><?php echo esc_html($nombre_autor); ?></p>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="btn-outline btn-outline--square">
                      Ir a la publicación
                    </a>
                  </div>

                  <div class="bloque-hero-img-col" aria-hidden="true"></div>
                </div>
              </section>
            </div>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>

    </div>

    <div class="hero-insights-pagination-bar">
      <div class="container">
        <div id="hero-insights-pagination" class="hero-pagination"></div>
      </div>
    </div>
  </div>
</section>

<style>
/* Hero Insights — fondo full width como home */
div#hero-insights-swiper {
  height: 100%;
  position: relative;
  width: 100%;
  max-width: none;
}

section.hero-section.hero-insights {
  height: 680px;
  overflow: hidden;
}

section.hero-section.hero-insights::before {
  display: none;
}

.hero-insights .swiper-slide .hero-section.fullwidth {
  position: relative;
  height: 680px;
  width: 100%;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}

.hero-insights .swiper-slide .hero-section.fullwidth::before {
  display: none;
}

.hero-insights .hero-overlay {
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

.hero-insights .swiper-slide .hero-section.fullwidth .container {
  position: relative;
  z-index: 2;
  height: 100%;
}

.hero-insights .swiper-slide {
  opacity: 0 !important;
  transition: opacity .6s ease-in-out;
}

.hero-insights .swiper-slide-active {
  opacity: 1 !important;
}

.hero-insights .hero-insights-pagination-bar {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 80px;
  z-index: 10;
  pointer-events: none;
}

.hero-insights .hero-insights-pagination-bar .container {
  pointer-events: auto;
}

.hero-insights .hero-pagination {
  position: relative;
  display: flex !important;
  gap: 8px;
  justify-content: flex-start;
  opacity: 0;
  transition: opacity .6s ease-out;
}

.hero-insights .hero-pagination.visible {
  opacity: 1;
}

.hero-insights .swiper-pagination-bullet {
  width: 26px;
  height: 26px;
  border: 1px solid #fff;
  background: rgba(0, 0, 0, 0.3);
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

.hero-insights .swiper-pagination-bullet-active,
.hero-insights .swiper-pagination-bullet:hover {
  background: #006EFF;
  border-color: #006EFF;
  color: #fff;
}

.hero-insights .bloque-hero-text h1 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1.25;
  max-height: calc(1.25em * 2);
}

.hero-insights .bloque-hero-text .hero-text {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1.5;
  max-height: calc(1.5em * 3);
}

/* ===== Mobile / tablet (mismas alturas que hero-global-banners) ===== */
@media (max-width: 992px) {
  section.hero-section.hero-insights {
    height: auto !important;
    min-height: 720px;
    padding-bottom: 0;
  }

  div#hero-insights-swiper {
    min-height: 720px;
  }

  .hero-insights .swiper-slide {
    min-height: 720px;
    height: auto;
  }

  .hero-insights .swiper-slide .hero-section.fullwidth {
    min-height: 720px;
    height: auto;
    padding-bottom: 32px;
    box-sizing: border-box;
  }

  .hero-insights .swiper-slide .hero-section.fullwidth .container {
    height: auto;
    min-height: 100%;
  }

  .hero-insights .hero-overlay {
    background: linear-gradient(
      180deg,
      rgba(3, 14, 35, 0.92) 0%,
      rgba(3, 14, 35, 0.82) 42%,
      rgba(3, 14, 35, 0.65) 100%
    );
  }

  .hero-insights .bloque-hero-text.top-20x {
    top: 0 !important;
  }

  .hero-insights .grid-2 {
    display: block;
    padding-top: 160px !important;
    padding-bottom: 120px !important;
  }

  .hero-insights .bloque-hero-img-col {
    display: none;
  }

  .hero-insights .bloque-hero-text {
    max-width: 100%;
    text-align: left;
    padding-right: 0;
  }

  .hero-insights .heading-lg {
    font-size: 30px;
    line-height: 1.2;
    margin-bottom: 16px !important;
  }

  .hero-insights .bloque-hero-text h1 {
    -webkit-line-clamp: 4;
    max-height: calc(1.2em * 4);
  }

  .hero-insights .bloque-hero-text .hero-text {
    font-size: 15px;
    line-height: 1.45;
    margin-bottom: 20px !important;
  }

  .hero-insights .bloque-hero-text .btn-outline {
    margin-top: 4px;
  }

  .hero-insights .hero-insights-pagination-bar {
    bottom: 24px;
  }

  .hero-insights .hero-insights-pagination-bar .container {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }

  .hero-insights .hero-pagination {
    left: 0;
  }
}

@media (max-width: 576px) {
  section.hero-section.hero-insights {
    min-height: 680px;
  }

  div#hero-insights-swiper,
  .hero-insights .swiper-slide,
  .hero-insights .swiper-slide .hero-section.fullwidth {
    min-height: 680px;
  }

  .hero-insights .heading-lg {
    font-size: 26px;
  }

  .hero-insights .badge.bg-light-blue {
    font-size: 12px;
    padding-left: 24px !important;
    padding-right: 24px !important;
  }
}
</style>


<script>
(function initHeroInsights(){
  function start(){
    if (typeof Swiper === 'undefined') { setTimeout(start, 60); return; }
    const el = document.querySelector('#hero-insights-swiper');
    const pag = document.querySelector('#hero-insights-pagination');
    if (!el || el.dataset.initialized) return;
    el.dataset.initialized = '1';

    const swiper = new Swiper(el, {
      loop: true,
      speed: 1000,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      autoplay: { delay: 6000, disableOnInteraction: false },
      observer: true,
      observeParents: true,
      pagination: {
        el: '#hero-insights-pagination',
        clickable: true,
        renderBullet: (i, c) => `<span class="${c}">${i + 1}</span>`
      },
      on: {
        init: () => {
          setTimeout(() => pag.classList.add('visible'), 300);
        },
        slideChangeTransitionStart: () => {
          el.querySelectorAll('.swiper-slide').forEach(s => s.style.opacity = '0');
          const active = el.querySelector('.swiper-slide-active');
          if (active) active.style.opacity = '1';
        }
      }
    });
  }

  if (document.readyState === 'complete') start();
  else window.addEventListener('load', start);
})();
</script>