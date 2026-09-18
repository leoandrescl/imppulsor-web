<?php
/**
 * Block: Insights (Carousel + Featured)
 * - Unified year logic: Specific > Author > Post Date
 */

if (!defined('ABSPATH'))
  exit;

$query = new WP_Query([
  'post_type' => 'insights',
  'posts_per_page' => 6,
  'post_status' => 'publish',
  'orderby' => 'date',
  'order' => 'DESC',
]);

if (!$query->have_posts())
  return;

// Extract the first one as featured
$destacado = null;
if ($query->have_posts()) {
  $query->the_post();
  $destacado = get_post();
}
?>

<section class="bloque-insights reveal reveal-up bg-light">
  <div class="container py-60">
    <h2 class="heading-lg mb-0">Insights</h2>

    <div class="grid-2 grid-2--carousel-insights gap-20 text-dark">

      <div class="insights-slider-wrapper">
        <div class="insights-slider-header">
          <div class="slider-arrows">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>

        <div class="swiper insights-slider">
          <div class="swiper-wrapper">
            <?php while ($query->have_posts()):
              $query->the_post(); ?>
              <?php
              // 1. Get Author ID and Name
              $autor_rel = get_field('autor_relacionado');
              $autor_id = null;
              $nombre_autor = '';

              if (is_array($autor_rel) && !empty($autor_rel)) {
                $first = $autor_rel[0];
                $autor_id = is_object($first) ? $first->ID : (is_array($first) && isset($first['ID']) ? $first['ID'] : $first);
                $nombre_autor = get_the_title($autor_id);
              } else {
                $nombre_autor = get_the_author();
              }

              // 2. YEAR logic (Specific > Author > Date)
              $anio_especifico = get_field('anio_especifico_insight');
              $anio_autor = $autor_id ? get_field('anio_autor', $autor_id) : '';

              // Fallback final
              $anio = $anio_especifico ?: ($anio_autor ?: get_the_date('Y'));


              // 3. Tag (custom taxonomy)
              $tags = get_the_terms(get_the_ID(), 'tags_insight');
              $tag_name = ($tags && !is_wp_error($tags)) ? esc_html($tags[0]->name) : '';
              ?>
              <div class="swiper-slide insight-item">
                <a href="<?php the_permalink(); ?>" class="insight-card-link">
                  <div class="insight-card">
                    <?php
                    $custom_thumb = get_field('imagen_miniatura_insights');
                    if ($custom_thumb && is_array($custom_thumb)): ?>
                      <div class="insight-card__image">
                        <img src="<?php echo esc_url($custom_thumb['url']); ?>"
                          alt="<?php echo esc_attr($custom_thumb['alt']); ?>" class="w-100 object-cover"
                          style="height: 100%; object-fit: cover;">
                      </div>
                    <?php elseif (has_post_thumbnail()): ?>
                      <div class="insight-card__image">
                        <?php the_post_thumbnail('large', ['class' => 'w-100']); ?>
                      </div>
                    <?php else: ?>
                      <div class="insight-card__image">
                        <div class="insight-thumb-fallback"></div>
                      </div>
                    <?php endif; ?>


                    <div class="py-10">
                      <?php if ($anio || $tag_name): ?>
                        <p class="mb-10 truncate-1 text-left">
                          <?php echo esc_html($anio); ?>
                          <?php if ($tag_name)
                            echo ' | ' . esc_html($tag_name); ?>
                        </p>
                      <?php endif; ?>

                      <h3 class="heading-sm mb-10 truncate-2"><?php the_title(); ?></h3>

                      <?php if ($nombre_autor): ?>
                        <p class="mb-20 insight-author"><?php echo esc_html($nombre_autor); ?></p>
                      <?php endif; ?>

                      <span class="btn-outline--black">Read article</span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          </div>
        </div>
      </div>

      <?php if ($destacado): ?>
        <?php
        // 1. Get Featured Author ID and Name
        $autor_rel_d = get_field('autor_relacionado', $destacado->ID);
        $autor_id_d = null;
        $nombre_autor_d = '';

        if (is_array($autor_rel_d) && !empty($autor_rel_d)) {
          $first = $autor_rel_d[0];
          $autor_id_d = is_object($first) ? $first->ID : (is_array($first) && isset($first['ID']) ? $first['ID'] : $first);
          $nombre_autor_d = get_the_title($autor_id_d);
        } else {
          $nombre_autor_d = get_the_author_meta('display_name', $destacado->post_author);
        }

        // 2. Featured YEAR logic (Specific > Author > Date)
        $anio_especifico_d = get_field('anio_especifico_insight', $destacado->ID);
        $anio_autor_d = $autor_id_d ? get_field('anio_autor', $autor_id_d) : '';

        // Fallback final
        $anio_d = $anio_especifico_d ?: ($anio_autor_d ?: get_the_date('Y', $destacado->ID));


        // 3. Tag
        $tags_d = get_the_terms($destacado->ID, 'tags_insight');
        $tag_name_d = ($tags_d && !is_wp_error($tags_d)) ? esc_html($tags_d[0]->name) : '';

        // 4. Excerpt
        $resumen_d = get_field('resumen_insight', $destacado->ID);
        if (!$resumen_d) {
          $resumen_d = wp_trim_words(get_the_excerpt($destacado->ID), 25, '…');
        }
        ?>
        <div class="insight-destacado">
          <a href="<?php echo get_permalink($destacado->ID); ?>" class="insight-card-link">
            <div class="insight-card insight-card--destacado">
              <div class="insight-card__image">
                <?php
                $custom_thumb_d = get_field('imagen_miniatura_insights', $destacado->ID);
                if ($custom_thumb_d && is_array($custom_thumb_d)): ?>
                  <img src="<?php echo esc_url($custom_thumb_d['url']); ?>"
                    alt="<?php echo esc_attr($custom_thumb_d['alt']); ?>" class="w-100 object-cover"
                    style="height: 100%; object-fit: cover;">
                <?php elseif (has_post_thumbnail($destacado->ID)): ?>
                  <?php echo get_the_post_thumbnail($destacado->ID, 'large', ['class' => 'w-100']); ?>
                <?php else: ?>
                  <div class="insight-thumb-fallback"></div>
                <?php endif; ?>
              </div>


              <div class="py-10">
                <?php if ($anio_d || $tag_name_d): ?>
                  <p class="mb-10 truncate-1 text-left">
                    <?php echo esc_html($anio_d); ?>
                    <?php if ($tag_name_d)
                      echo ' | ' . esc_html($tag_name_d); ?>
                  </p>
                <?php endif; ?>

                <h3 class="heading-sm mb-10 truncate-2"><?php echo esc_html(get_the_title($destacado->ID)); ?></h3>

                <?php if ($nombre_autor_d): ?>
                  <p class="mb-10 insight-author"><?php echo esc_html($nombre_autor_d); ?></p>
                <?php endif; ?>

                <?php if ($resumen_d): ?>
                  <div class="mb-20 insight-resumen truncate-3">
                    <?php echo esc_html($resumen_d); ?>
                  </div>
                <?php endif; ?>

                <span class="btn-outline--black">Read article</span>
              </div>
            </div>
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php wp_reset_postdata(); ?>


<style>
  .insight-thumb-fallback {
    width: 100%;
    height: 100%;
    /* Ajusta si quieres */
    background: var(--azul-corporativo);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }

  /* Logo dentro del fallback */
  .insight-thumb-fallback::before {
    content: "";
    display: block;
    width: 140px;
    /* tamaño del logo */
    height: 140px;
    background-image: url('https://imppulsor.com/wp-content/themes/imppulsorv2/assets/img/logo-imppulsor.svg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center center;
    opacity: 0.25;
    /* elegante, tipo marca de agua */
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.insights-slider-wrapper').forEach(function (wrapper) {

      const slider = wrapper.querySelector('.insights-slider');
      const nextBtn = wrapper.querySelector('.slider-arrows .swiper-button-next');
      const prevBtn = wrapper.querySelector('.slider-arrows .swiper-button-prev');
      const pagination = wrapper.querySelector('.swiper-pagination');

      if (!slider || !nextBtn || !prevBtn) return;

      let sw = null;

      // 🟦 1) Esperar a que el slider tenga ancho real y NO antes
      const waitForStableWidth = () => {
        return new Promise(resolve => {
          const check = () => {
            const w = slider.clientWidth;
            if (w > 0) resolve();
            else setTimeout(check, 30);
          };
          check();
        });
      };

      // 🟦 2) Inicializar Swiper solo cuando el ancho es estable
      const initSwiper = () => {

        // destruir previo
        if (slider.swiper) slider.swiper.destroy(true, true);

        sw = new Swiper(slider, {
          slidesPerView: 2,
          spaceBetween: 24,
          loop: false,
          speed: 600,
          allowTouchMove: true,

          navigation: {
            nextEl: nextBtn,
            prevEl: prevBtn
          },

          pagination: {
            el: pagination,
            clickable: true
          },

          breakpoints: {
            0: { slidesPerView: 1, spaceBetween: 16 },
            768: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 2, spaceBetween: 24 }
          }
        });

        // Recalcular una vez más por seguridad
        setTimeout(() => {
          sw.update();
          sw.updateSize();
          sw.updateSlides();
        }, 50);
      };

      // 🟦 3) Inicializar solo cuando el contenedor sea visible en viewport
      const io = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            io.disconnect();  // evitar reinicios

            waitForStableWidth().then(() => {
              initSwiper();
            });
          }
        });
      });

      io.observe(wrapper);

    });

  });
</script>