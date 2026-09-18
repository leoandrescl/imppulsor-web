<?php
/**
 * Bloque: Hero Slider de Casos de Éxito (Lógica de Prioridad Año/Empresa Corregida)
 */
if (!defined('ABSPATH')) exit;

/* ============================================================
   Lógica de Obtención y Ordenamiento (Se mantiene igual)
============================================================ */
$all_cases = get_posts([
  'post_type'      => 'casos_exito',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
]);

if (!$all_cases) return;

$empresa_map = [];

foreach ($all_cases as $post) {
    // Para el ordenamiento inicial usamos la misma lógica
    $empresa_case = get_field('empresa_especifico_caso', $post->ID);
    
    $autor_rel = get_field('autor_relacionado', $post->ID);
    $autor_obj = null;
    if ($autor_rel) {
        $first = is_array($autor_rel) ? reset($autor_rel) : $autor_rel;
        $autor_obj = is_object($first) ? $first : get_post($first);
    }
    $empresa_autor = $autor_obj ? get_field('empresa_autor', $autor_obj->ID) : '';
    
    $empresa_final = $empresa_case ?: $empresa_autor;
    if (!$empresa_final) $empresa_final = 'No company';
    
    $empresa_map[$empresa_final][] = $post;
}

uasort($empresa_map, function($a, $b) {
    return count($a) <=> count($b);
});

$ordenados = [];
$max_items = max(array_map('count', $empresa_map));

for ($i = 0; $i < $max_items; $i++) {
    foreach ($empresa_map as $grupo) {
        if (!empty($grupo[$i])) {
            $ordenados[] = $grupo[$i];
        }
    }
}

$slides = array_slice($ordenados, 0, 4);
?>

<section class="hero-section hero-section-no-border hero-wrap hero-casos-exito">
  <div id="hero-casos-exito-swiper" class="swiper hero-swiper">
    <div class="swiper-wrapper">

      <?php foreach ($slides as $post): setup_postdata($post);

        $autor_rel = get_field('autor_relacionado');
        $autor_id = null;
        $nombre_autor = '';

        if (is_array($autor_rel) && !empty($autor_rel)) {
          $first = $autor_rel[0];
          $autor_id = is_object($first) ? $first->ID : (is_array($first) && isset($first['ID']) ? $first['ID'] : $first);
          $nombre_autor = get_the_title($autor_id);
        }

        $anio_especifico = get_field('anio_especifico_caso');
        $anio_autor      = $autor_id ? get_field('anio_autor', $autor_id) : '';
        $anio_final      = $anio_especifico ?: $anio_autor;

        $empresa_especifica = get_field('empresa_especifico_caso');
        $empresa_autor      = $autor_id ? get_field('empresa_autor', $autor_id) : '';
        $empresa_final      = $empresa_especifica ?: $empresa_autor;

        $resumen = get_field('resumen_caso');
        $img     = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if (!$img) {
            $img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        }
        $bg_style = $img ? 'background-image:url(\'' . esc_url($img) . '\');' : '';
      ?>
        <div class="swiper-slide">
          <div class="hero-section fullwidth reveal reveal-up"<?php echo $bg_style ? ' style="' . esc_attr($bg_style) . '"' : ''; ?>>
            <div class="hero-overlay"></div>

            <div class="container">
              <section class="bloque-home bloque-hero-casos-exito text-white grid h-100">
                <div class="grid-2 pb-80 pt-20 h-100">

                  <div class="bloque-hero-text top-20x p-relative">

                    <div class="badge bg-light-blue px-40 text-bold">Success stories</div>

                    <p class="my-10 text-bold">
                      <?php echo esc_html($anio_final); ?>
                      <?php echo $empresa_final ? " | " . esc_html($empresa_final) : ''; ?>
                    </p>

                    <h1 class="heading-lg mb-20"><?php the_title(); ?></h1>

                    <?php
                    if (!$resumen) {
                      $resumen = wp_trim_words(get_the_excerpt(), 35, '…');
                    }
                    if ($resumen): ?>
                      <p class="hero-text mb-20"><?php echo esc_html($resumen); ?></p>
                    <?php endif; ?>

                    <?php if ($nombre_autor): ?>
                      <p class="mb-40"><?php echo esc_html($nombre_autor); ?></p>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="btn-outline btn-outline--square">
                      View full case
                    </a>
                  </div>

                  <div class="bloque-hero-img-col" aria-hidden="true"></div>
                </div>
              </section>
            </div>
          </div>
        </div>
      <?php endforeach; wp_reset_postdata(); ?>

    </div>

    <div class="hero-casos-exito-pagination-bar">
      <div class="container">
        <div id="hero-casos-exito-pagination" class="hero-pagination"></div>
      </div>
    </div>
  </div>
</section>

<style>
/* Hero Casos de éxito — fondo full width como home */
div#hero-casos-exito-swiper {
  height: 100%;
  position: relative;
  width: 100%;
  max-width: none;
}

section.hero-section.hero-casos-exito {
  height: 680px;
  overflow: hidden;
}

section.hero-section.hero-casos-exito::before {
  display: none;
}

.hero-casos-exito .swiper-slide .hero-section.fullwidth {
  position: relative;
  height: 680px;
  width: 100%;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}

.hero-casos-exito .swiper-slide .hero-section.fullwidth::before {
  display: none;
}

.hero-casos-exito .hero-overlay {
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

.hero-casos-exito .swiper-slide .hero-section.fullwidth .container {
  position: relative;
  z-index: 2;
  height: 100%;
}

.hero-casos-exito .swiper-slide {
  opacity: 0 !important;
  transition: opacity .6s ease-in-out;
}

.hero-casos-exito .swiper-slide-active {
  opacity: 1 !important;
}

.hero-casos-exito .hero-casos-exito-pagination-bar {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 80px;
  z-index: 10;
  pointer-events: none;
}

.hero-casos-exito .hero-casos-exito-pagination-bar .container {
  pointer-events: auto;
}

.hero-casos-exito .hero-pagination {
  position: relative;
  display: flex !important;
  gap: 8px;
  justify-content: flex-start;
  opacity: 0;
  transition: opacity .6s ease-out;
}

.hero-casos-exito .hero-pagination.visible {
  opacity: 1;
}

.hero-casos-exito .swiper-pagination-bullet {
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

.hero-casos-exito .swiper-pagination-bullet-active,
.hero-casos-exito .swiper-pagination-bullet:hover {
  background: #006EFF;
  border-color: #006EFF;
  color: #fff;
}

.hero-casos-exito .bloque-hero-text h1 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  line-height: 1.25;
  max-height: calc(1.25em * 2);
}

.hero-casos-exito .bloque-hero-text .hero-text {
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
  section.hero-section.hero-casos-exito {
    height: auto !important;
    min-height: 720px;
    padding-bottom: 0;
  }

  div#hero-casos-exito-swiper {
    min-height: 720px;
  }

  .hero-casos-exito .swiper-slide {
    min-height: 720px;
    height: auto;
  }

  .hero-casos-exito .swiper-slide .hero-section.fullwidth {
    min-height: 720px;
    height: auto;
    padding-bottom: 32px;
    box-sizing: border-box;
  }

  .hero-casos-exito .swiper-slide .hero-section.fullwidth .container {
    height: auto;
    min-height: 100%;
  }

  .hero-casos-exito .hero-overlay {
    background: linear-gradient(
      180deg,
      rgba(3, 14, 35, 0.92) 0%,
      rgba(3, 14, 35, 0.82) 42%,
      rgba(3, 14, 35, 0.65) 100%
    );
  }

  .hero-casos-exito .bloque-hero-text.top-20x {
    top: 0 !important;
  }

  .hero-casos-exito .grid-2 {
    display: block;
    padding-top: 160px !important;
    padding-bottom: 120px !important;
  }

  .hero-casos-exito .bloque-hero-img-col {
    display: none;
  }

  .hero-casos-exito .bloque-hero-text {
    max-width: 100%;
    text-align: left;
    padding-right: 0;
  }

  .hero-casos-exito .heading-lg {
    font-size: 30px;
    line-height: 1.2;
    margin-bottom: 16px !important;
  }

  .hero-casos-exito .bloque-hero-text h1 {
    -webkit-line-clamp: 4;
    max-height: calc(1.2em * 4);
  }

  .hero-casos-exito .bloque-hero-text .hero-text {
    font-size: 15px;
    line-height: 1.45;
    margin-bottom: 20px !important;
  }

  .hero-casos-exito .bloque-hero-text .btn-outline {
    margin-top: 4px;
  }

  .hero-casos-exito .hero-casos-exito-pagination-bar {
    bottom: 24px;
  }

  .hero-casos-exito .hero-casos-exito-pagination-bar .container {
    padding-left: 20px !important;
    padding-right: 20px !important;
  }

  .hero-casos-exito .hero-pagination {
    left: 0;
  }
}

@media (max-width: 576px) {
  section.hero-section.hero-casos-exito {
    min-height: 680px;
  }

  div#hero-casos-exito-swiper,
  .hero-casos-exito .swiper-slide,
  .hero-casos-exito .swiper-slide .hero-section.fullwidth {
    min-height: 680px;
  }

  .hero-casos-exito .heading-lg {
    font-size: 26px;
  }

  .hero-casos-exito .badge.bg-light-blue {
    font-size: 12px;
    padding-left: 24px !important;
    padding-right: 24px !important;
  }
}
</style>



<script>
(function initHeroCasosExito(){
  function start(){
    if (typeof Swiper === 'undefined') { setTimeout(start, 60); return; }
    const el = document.querySelector('#hero-casos-exito-swiper');
    const pag = document.querySelector('#hero-casos-exito-pagination');
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
        el: '#hero-casos-exito-pagination',
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