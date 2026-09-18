<div class="no-ellipse">
  <?php
  /**
   * Plantilla individual para Insights — versión estandarizada
   */
  if (!defined('ABSPATH'))
    exit;

  get_header();

  // HERO GLOBAL
  imppulsor_render_page_hero('default');
  ?>
</div>

<div class="bg-light py-60 mt-0">
  <main class="container template-casos-insights grid-2 grid-2--2fr-1fr text-dark">

    <?php while (have_posts()):
      the_post();

      // Contenido principal del insight
      $contenido = get_field('contenido_insight');

      // Autor relacionado
      $autores = get_field('autor_relacionado');
      $autor = (is_array($autores) && !empty($autores)) ? $autores[0] : null;

      // Datos del autor (idénticos a Casos de Éxito)
      $anio_autor = ''; // Inicializamos variable por seguridad
      if ($autor) {
        $foto = get_field('foto_autor', $autor->ID);
        $cargo = get_field('cargo_autor', $autor->ID);
        $empresa = get_field('empresa_autor', $autor->ID);
        $linkedin = get_field('linkedin_autor', $autor->ID);
        $bio = get_field('bio_autor', $autor->ID);
        $anio_autor = get_field('anio_autor', $autor->ID);
      }

      // Tags del insight (todas)
      $tags = get_the_terms(get_the_ID(), 'tags_insight');
      $tags_list = [];
      if ($tags && !is_wp_error($tags)) {
        foreach ($tags as $t) {
          $tags_list[] = esc_html($t->name);
        }
      }

      // =========================================================
      // MEJORA: LÓGICA DE AÑO ESPECÍFICO (Prioridad: Específico > Autor > Post)
      // =========================================================
      $anio_especifico = get_field('anio_especifico_insight');

      $anio_final = $anio_especifico ?: ($anio_autor ?: get_the_date('Y'));
      // =========================================================
    
      ?>

      <section class="main-content reveal reveal-right">

        <div class="d-inline-flex gap-10 align-center mb-20">

          <?php foreach ($tags_list as $tag_item): ?>
            <span class="px-10 mb-10 mr-5 text-bold bg-light-blue text-white d-inline-block">
              <?php echo $tag_item; ?>
            </span>
          <?php endforeach; ?>

          <span class="px-10 mb-10 mr-5 text-bold bg-light-blue text-white d-inline-block">
            <?php echo esc_html($anio_final); ?>
          </span>

        </div>

        <h2 class="heading-lg mt-20 mb-20"><?php the_title(); ?></h2>

        <?php if ($autor): ?>
          <div class="d-flex align-center justify-between text-dark" data-open-autor>

            <div class="d-flex align-center">

              <?php if ($foto): ?>
                <img class="autor-foto rounded-full" src="<?php echo esc_url($foto['url']); ?>"
                  alt="<?php echo esc_attr($autor->post_title); ?>" width="90" height="90">
              <?php else: ?>
                <div class="autor-foto--placeholder rounded-full bg-light-gray" style="width:90px; height:90px;"></div>
              <?php endif; ?>

              <div class="mx-40">

                <p class="mb-0">
                  <span class="text-dark"><?php echo esc_html($autor->post_title); ?></span>

                  <?php if (!empty($cargo)): ?>
                    | <?php echo esc_html($cargo); ?>
                  <?php endif; ?>

                </p>

                <?php if ($linkedin): ?>
                  <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener"
                    class="autor-linkedin fs-20 text-bold text-dark">in</a>
                <?php endif; ?>

                <?php if (!empty($empresa)): ?>
                  <p class="mb-0" style="display: none !important;">
                    <span class="text-bold">Empresa</span>
                    <span><?php echo esc_html($empresa); ?></span>
                  </p>
                <?php endif; ?>

              </div>
            </div>

          </div>

          <?php if ($bio): ?>
            <div class="autor-modal" id="autorModal" aria-hidden="true">
              <div class="autor-modal__overlay" data-close-autor></div>

              <div class="autor-modal__dialog" role="dialog" aria-modal="true">
                <button class="autor-modal__close" type="button" aria-label="Cerrar" data-close-autor>×</button>

                <div class="autor-modal__header">
                  <?php if ($foto): ?>
                    <img class="autor-foto grande" src="<?php echo esc_url($foto['url']); ?>"
                      alt="<?php echo esc_attr($autor->post_title); ?>">
                  <?php endif; ?>

                  <div>
                    <h3><?php echo esc_html($autor->post_title); ?></h3>

                    <?php if ($cargo || $empresa): ?>
                      <p class="autor-cargo-empresa">
                        <?php echo esc_html($cargo); ?>
                        <?php if ($cargo && $empresa)
                          echo ' — '; ?>
                        <?php echo esc_html($empresa); ?>
                      </p>
                    <?php endif; ?>

                    <?php if ($linkedin): ?>
                      <p>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" class="autor-linkedin">
                          <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24">
                        </a>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="autor-modal__body">
                  <?php echo wpautop($bio); ?>
                </div>

              </div>
            </div>
          <?php endif; ?>

        <?php endif; ?>

        <div class="separator-40y"></div>

        <div class="content-body">
          <?php echo wp_kses_post($contenido ?: get_the_content()); ?>
        </div>

        <div class="acciones mt-40 d-flex align-center">
          <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
            target="_blank" rel="noopener">
            <img src="/wp-content/uploads/icon-compartir.svg" alt="Compartir" width="21" height="21"> Compartir
          </a>

          <a href="javascript:void(0)" onclick="window.print()">
            <img src="/wp-content/uploads/icon-imprimir.svg" alt="imprimir" width="17" height="21"> Imprimir
          </a>

          <a href="<?php echo esc_url(get_stylesheet_directory_uri() . '/inc/generar-pdf.php?id=' . get_the_ID()); ?>">
            <img src="/wp-content/uploads/icon-descargar.svg" alt="descargar" width="25" height="21"> Descargar PDF
          </a>
        </div>

        <!-- Formulario de contacto integrado -->
        <div class="contacto-post mt-40 pt-40 border-top reveal reveal-up" style="display: none !important;">
          <h3 class="heading-md mb-20">Contáctanos</h3>
          <p class="mb-20">Si este contenido conectó con tus desafíos actuales, conversemos.</p>
          <div class="formulario-contacto cf7-clean text-dark">
            <?php echo do_shortcode('[contact-form-7 id="bb0babf" title="Formulario de contacto pagina contacto"]'); ?>
          </div>
        </div>

      </section>

      <aside class="sidebar reveal reveal-left">

        <div class="sidebar-block bg-light-gray mb-20 py-20 px-30">
          <h3 class="heading-sm mb-15">Buscador</h3>
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="hidden" name="post_type" value="insights">
            <input type="search" name="s" placeholder="Ingrese palabra clave…" class="w-100">
          </form>
        </div>

        <div class="sidebar-block mb-20 bg-light-gray py-20 px-30">
          <h3 class="heading-sm mb-15">Áreas de gestión</h3>
          <ul class="list-unstyled">
            <?php
            $tags_sidebar = get_terms([
              'taxonomy' => 'tags_insight',
              'hide_empty' => true,
              'orderby' => 'count',
              'order' => 'DESC',
            ]);

            $page_insights = get_page_by_path('insights');
            $base_url = $page_insights ? get_permalink($page_insights->ID) : home_url('/insights/');

            if ($tags_sidebar && !is_wp_error($tags_sidebar)):
              foreach ($tags_sidebar as $tag):
                $link = add_query_arg('tag', $tag->slug, $base_url);
                ?>
                <li>
                  <a href="<?php echo esc_url($link); ?>"
                    class="d-flex justify-between mb-10 py-10 px-10 text-dark bg-light text-normal">
                    <span><?php echo esc_html($tag->name); ?></span>
                    <span class="text-light-blue text-bold ml-20">(<?php echo intval($tag->count); ?>)</span>
                  </a>
                </li>
              <?php endforeach; endif; ?>
          </ul>
        </div>

        <div class="sidebar-block bg-light-gray py-30 px-30">
          <h3 class="heading-sm mb-20">Autores recientes</h3>

          <?php
          $autores_rec = [];
          $posts_autores = get_posts([
            'post_type' => 'insights',
            'numberposts' => 20,
            'post_status' => 'publish',
          ]);

          foreach ($posts_autores as $p) {
            $autor_rel = get_field('autor_relacionado', $p->ID);
            if (is_array($autor_rel) && !empty($autor_rel)) {
              $autor_id = $autor_rel[0]->ID;
              $nombre = get_the_title($autor_id);

              if (!isset($autores_rec[$nombre])) {
                $autores_rec[$nombre] = [
                  'foto' => get_field('foto_autor', $autor_id),
                  'cargo' => get_field('cargo_autor', $autor_id),
                  'linkedin' => get_field('linkedin_autor', $autor_id),
                ];
              }
            }
          }

          $autores_rec = array_slice($autores_rec, 0, 3);
          ?>

          <?php foreach ($autores_rec as $nombre => $data): ?>
            <div class="d-flex align-center mb-20 bg-light text-dark">
              <?php if (!empty($data['foto']['url'])): ?>
                <img src="<?php echo esc_url($data['foto']['url']); ?>" style="width:70px; height:70px;">
              <?php endif; ?>

              <div class="px-10" style="flex:1%;">
                <strong class="fs-14"><?php echo esc_html($nombre); ?></strong>
                <?php if (!empty($data['cargo'])): ?>
                  <span class="fs-12"><?php echo esc_html($data['cargo']); ?></span>
                <?php endif; ?>
              </div>

              <?php if (!empty($data['linkedin'])): ?>
                <a href="<?php echo esc_url($data['linkedin']); ?>" target="_blank" rel="noopener"
                  class="text-bold fs-18 px-10">in</a>
              <?php endif; ?>

            </div>
          <?php endforeach; ?>

        </div>

      </aside>

    <?php endwhile; ?>

  </main>
</div>

<style>
  /* Forzar sin padding en el formulario integrado */
  .contacto-post .wpcf7-form {
    padding: 0 !important;
  }
</style>


<?php
if (!empty($autor)):

  $relacionados = new WP_Query([
    'post_type' => 'insights',
    'posts_per_page' => 10,
    'post__not_in' => [get_the_ID()],
    'meta_query' => [
      [
        'key' => 'autor_relacionado',
        'value' => '"' . $autor->ID . '"',
        'compare' => 'LIKE',
      ]
    ]
  ]);

  if ($relacionados->have_posts()):
    ?>

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/casos-exito.css">
    <section class="bg-gradiente-13 text-white py-60 reveal reveal-up">
      <div class="container">

        <div class="grid-2--35-65">

          <div>
            <h2 class="heading-lg mb-40">Otros insights relacionados del autor</h2>

            <div class="nav-round-group">
              <button class="nav-round nav-round--prev"></button>
              <button class="nav-round nav-round--next"></button>
            </div>
          </div>

          <div>
            <div class="swiper insights-relacionados-slider">
              <div class="swiper-wrapper">

                <?php while ($relacionados->have_posts()):
                  $relacionados->the_post();

                  $anio_r = get_the_date('Y');
                  $tags_r = get_the_terms(get_the_ID(), 'tags_insight');
                  $tag_name_r = ($tags_r && !is_wp_error($tags_r)) ? esc_html($tags_r[0]->name) : '';
                  $nombre_autor_r = $autor->post_title;
                  $imagen = get_the_post_thumbnail_url(get_the_ID(), 'large');
                  ?>

                  <div class="swiper-slide caso-item">
                    <a href="<?php the_permalink(); ?>" class="caso-link">

                      <div class="caso-imagen">
                        <div class="caso-imagen">
                          <?php 
                          $custom_thumb_insight = get_field('imagen_miniatura_insights', get_the_ID());
                          
                          if ($custom_thumb_insight && is_array($custom_thumb_insight)): ?>
                            <img src="<?php echo esc_url($custom_thumb_insight['url']); ?>" alt="<?php echo esc_attr($custom_thumb_insight['alt']); ?>" style="width:100%; height:100%; object-fit:cover;">
                          <?php elseif (has_post_thumbnail(get_the_ID())): ?>
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['style' => 'width:100%; height:100%; object-fit:cover;']); ?>
                          <?php else: ?>
                            <span class="caso-imagen--placeholder" style="width:100%; height:100%; display:block; background-color: var(--azul-corporativo, #001f3f);"></span>
                          <?php endif; ?>
                        </div>
                      </div>

                      <div class="py-10 text-white">

                        <!-- Año | Tag -->
                        <p class="mb-10 truncate-1 text-left">
                          <?php echo esc_html($anio_r); ?>
                          <?php if ($tag_name_r): ?> | <?php echo $tag_name_r; ?><?php endif; ?>
                        </p>

                        <!-- Título -->
                        <h3 class="heading-sm truncate-2"><?php the_title(); ?></h3>

                        <!-- Autor -->
                        <p class="mt-10 mb-30"><?php echo esc_html($nombre_autor_r); ?></p>

                        <span class="btn-outline">Leer más</span>
                      </div>

                    </a>
                  </div>

                <?php endwhile;
                wp_reset_postdata(); ?>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <?php
  endif;
endif;

get_footer();
?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.insights-relacionados-slider');
    if (!slider || typeof Swiper === 'undefined') return;

    new Swiper(slider, {
      slidesPerView: 2,
      spaceBetween: 20,
      navigation: {
        nextEl: '.nav-round--next',
        prevEl: '.nav-round--prev',
      },
      breakpoints: {
        0: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 20 },
      }
    });
  });
</script>