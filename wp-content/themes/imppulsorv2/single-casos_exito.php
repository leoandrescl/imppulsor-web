<div class="no-ellipse">
  <?php
  /**
   * Plantilla individual para Casos de Éxito — versión estandarizada
   */

  if (!defined('ABSPATH'))
    exit;

  get_header();

  // ==========================================================
// HERO GLOBAL — reutilizable
// ==========================================================
  imppulsor_render_page_hero('default');
  ?>
</div>

<div class="bg-light py-60 mt-0">
  <main class="container template-casos-insights grid-2 grid-2--2fr-1fr text-dark">
    <?php while (have_posts()):
      the_post();

      // Contenido principal del caso
      $contenido = get_field('contenido_caso');

      // Autor relacionado (primer autor si hay varios)
      $autores = get_field('autor_relacionado');
      $autor = (is_array($autores) && !empty($autores)) ? $autores[0] : null;

      // Datos del autor (SIN PAÍS)
      if ($autor) {
        $foto = get_field('foto_autor', $autor->ID);
        $empresa = get_field('empresa_autor', $autor->ID);
        $cargo = get_field('cargo_autor', $autor->ID);
        $linkedin = get_field('linkedin_autor', $autor->ID);
        $bio = get_field('bio_autor', $autor->ID);
        $anio = get_field('anio_autor', $autor->ID);
      }

      // Campos específicos del caso
      $anio_especifico = get_field('anio_especifico_caso');
      $proyecto_especifico = get_field('proyecto_especifico_caso');
      $rol_especifico = get_field('rol_autor_especifico_caso');
      $pais_especifico = get_field('pais_especifico_caso');
      $pais_especifico_2 = get_field('pais_especifico_caso_2');
      $empresa_especifico = get_field('empresa_especifico_caso');

      // ===============================
      // REGLAS DE REEMPLAZO
      // ===============================
      $anio_final = $anio_especifico ?: $anio ?: get_the_date('Y');
      $proyecto_final = $proyecto_especifico ?: '';
      $rol_final = $rol_especifico ?: $cargo;
      $empresa_final = $empresa_especifico ?: $empresa;

      // ===============================
      // PAÍSES FINALES (solo específicos)
      // ===============================
      $paises_finales = [];

      if (!empty($pais_especifico)) {
        $paises_finales[] = $pais_especifico;
      }

      if (!empty($pais_especifico_2)) {
        $paises_finales[] = $pais_especifico_2;
      }

      ?>

      <!-- ======================================================
       MAIN CONTENT
  ======================================================= -->
      <section class="main-content reveal reveal-right">

        <?php
        // TODAS las etiquetas asignadas (Áreas de gestión)
        $tags = get_the_terms(get_the_ID(), 'tags_caso_exito');
        $tags_list = [];

        if ($tags && !is_wp_error($tags)) {
          foreach ($tags as $t) {
            $tags_list[] = esc_html($t->name);
          }
        }

        ?>

        <!-- TAG + COUNTRIES + YEAR -->
        <div class="d-inline-flex gap-10 align-center mb-20">

          <?php foreach ($tags_list as $tag_item): ?>
            <span class="px-10 mb-10 mr-5 text-bold bg-light-blue text-white d-inline-block">
              <?php echo $tag_item; ?>
            </span>
          <?php endforeach; ?>


          <?php foreach ($paises_finales as $p): ?>
            <span class="px-10 mb-10 mr-5 text-bold bg-light-blue text-white d-inline-block">
              <?php echo esc_html($p); ?>
            </span>
          <?php endforeach; ?>

          <?php if ($anio_final): ?>
            <span class="px-10 mb-10 text-bold bg-light-blue text-white d-inline-block">
              <?php echo esc_html($anio_final); ?>
            </span>
          <?php endif; ?>

        </div>

        <!-- TITLE -->
        <h2 class="heading-lg mt-20 mb-20"><?php the_title(); ?></h2>


        <!-- AUTHOR BLOCK -->
        <?php if ($autor): ?>
          <div class="d-flex align-center justify-between text-dark" data-open-autor>

            <div class="d-flex align-center">

              <!-- PHOTO -->
              <?php if ($foto): ?>
                <img class="autor-foto rounded-full" src="<?php echo esc_url($foto['url']); ?>"
                  alt="<?php echo esc_attr($autor->post_title); ?>" width="90" height="90">
              <?php else: ?>
                <div class="autor-foto--placeholder rounded-full bg-light-gray" style="width:90px; height:90px;"></div>
              <?php endif; ?>

              <div class="mx-40">

                <!-- NAME + ROLE -->
                <p class="mb-0">
                  <span class="text-dark"><?php echo esc_html($autor->post_title); ?></span>
                  <?php if ($rol_final): ?>
                    | <?php echo esc_html($rol_final); ?>
                  <?php endif; ?>
                </p>

                <!-- COMPANY (goes below, with "Company" in bold) -->
                <?php if ($empresa_final): ?>
                  <p class="mb-0">
                    <span class="text-bold"><?php echo esc_html($empresa_final); ?></span>
                  </p>
                <?php endif; ?>

                <!-- LINKEDIN -->
                <?php if ($linkedin): ?>
                  <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener"
                    class="autor-linkedin fs-20 text-bold text-dark">in</a>
                <?php endif; ?>

              </div>
            </div>


          </div>


          <!-- AUTHOR MODAL -->
          <?php if ($bio): ?>
            <div class="autor-modal" id="autorModal" aria-hidden="true">
              <div class="autor-modal__overlay" data-close-autor></div>

              <div class="autor-modal__dialog" role="dialog" aria-modal="true">
                <button class="autor-modal__close" type="button" aria-label="Close" data-close-autor>×</button>

                <div class="autor-modal__header">

                  <?php if ($foto): ?>
                    <img class="autor-foto grande" src="<?php echo esc_url($foto['url']); ?>"
                      alt="<?php echo esc_attr($autor->post_title); ?>">
                  <?php endif; ?>

                  <div>
                    <h3><?php echo esc_html($autor->post_title); ?></h3>

                    <!-- Role and company -->
                    <?php if ($rol_final || $empresa_final): ?>
                      <p class="autor-cargo-empresa">
                        <?php echo esc_html($rol_final); ?>
                        <?php if ($rol_final && $empresa_final)
                          echo ' — '; ?>
                        <?php echo esc_html($empresa_final); ?>
                      </p>
                    <?php endif; ?>

                    <!-- NO COUNTRY HERE -->

                    <!-- LinkedIn -->
                    <?php if ($linkedin): ?>
                      <p><a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener" class="autor-linkedin">
                          <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24">
                        </a></p>
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

        <!-- MAIN CONTENT -->
        <div class="content-body">
          <?php echo wp_kses_post($contenido ?: get_the_content()); ?>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="acciones mt-40 d-flex align-center">
          <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
            target="_blank" rel="noopener">
            <img src="/wp-content/uploads/icon-compartir.svg" alt="Share" width="21" height="21"> Share
          </a>

          <a href="javascript:void(0)" onclick="window.print()">
            <img src="/wp-content/uploads/icon-imprimir.svg" alt="Print" width="17" height="21"> Print
          </a>

          <a href="<?php echo esc_url(get_stylesheet_directory_uri() . '/inc/generar-pdf.php?id=' . get_the_ID()); ?>">
            <img src="/wp-content/uploads/icon-descargar.svg" alt="Download" width="25" height="21"> Download PDF
          </a>
        </div>

        <!-- Integrated contact form -->
        <div class="contacto-post pt-40 mt-40 border-top reveal reveal-up" style="display: none !important;">
          <h3 class="heading-md mb-20">Contact us</h3>
          <p class="mb-20">If this content resonates with your current challenges, let's talk.</p>
          <div class="formulario-contacto cf7-clean text-dark">
            <?php echo do_shortcode('[contact-form-7 id="bb0babf" title="Formulario de contacto pagina contacto"]'); ?>
          </div>
        </div>

      </section>

      <!-- ======================================================
       SIDEBAR
  ======================================================= -->
      <aside class="sidebar reveal reveal-left">

        <!-- Search -->
        <div class="sidebar-block bg-light-gray mb-20 py-20 px-30">
          <h3 class="heading-sm mb-15">Search</h3>
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
            <input type="hidden" name="post_type" value="casos_exito">
            <input type="search" name="s" placeholder="Enter keyword…" class="w-100">
          </form>
        </div>

        <!-- Management areas -->
        <div class="sidebar-block mb-20 bg-light-gray  py-20 px-30">
          <h3 class="heading-sm mb-15">Management areas</h3>
          <ul class="list-unstyled">
            <?php
            $tags = get_terms([
              'taxonomy' => 'tags_caso_exito',
              'hide_empty' => true,
              'orderby' => 'count',
              'order' => 'DESC',
            ]);

            $page_casos = get_page_by_path('casos-de-exito');
            $base_url = $page_casos ? get_permalink($page_casos->ID) : home_url('/casos-de-exito/');

            if ($tags):
              foreach ($tags as $tag):
                $link = add_query_arg('tag', $tag->slug, $base_url);
                ?>
                <li>
                  <a href="<?php echo esc_url($link); ?>"
                    class="d-flex justify-between mb-10 py-10 px-10 text-dark bg-light  text-normal">
                    <span class=""><?php echo esc_html($tag->name); ?></span>
                    <span class="text-light-blue text-bold ml-20">(<?php echo intval($tag->count); ?>)</span>
                  </a>
                </li>
              <?php endforeach; endif; ?>
          </ul>
        </div>

        <!-- Recent territories (specific countries only) -->
        <div class="sidebar-block bg-light-gray py-30 px-30">
          <h3 class="heading-sm mb-15">Recent territories</h3>
          <ul class="list-unstyled">
            <?php

            $casos_all = get_posts([
              'post_type' => 'casos_exito',
              'numberposts' => -1,
              'post_status' => 'publish',
            ]);

            $paises_sidebar = [];

            foreach ($casos_all as $c) {

              $p1 = get_field('pais_especifico_caso', $c->ID);
              if ($p1)
                $paises_sidebar[$p1] = ($paises_sidebar[$p1] ?? 0) + 1;

              $p2 = get_field('pais_especifico_caso_2', $c->ID);
              if ($p2)
                $paises_sidebar[$p2] = ($paises_sidebar[$p2] ?? 0) + 1;
            }

            foreach ($paises_sidebar as $px => $count): ?>
              <li>
                <a href="<?php echo esc_url(add_query_arg('pais', urlencode($px), $base_url)); ?>"
                  class="d-flex justify-between py-10 px-10 text-dark bg-light mb-10 text-normal">
                  <span class=""><?php echo esc_html($px); ?></span>
                  <span class="text-light-blue text-bold ml-20">(<?php echo intval($count); ?>)</span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
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
// ============================================================
// OTROS CASOS RELACIONADOS (GLOBAL + PRIORIDAD ANDRÉS CAREY)
// ============================================================

// 1. Obtener casos de Andrés Carey (ID 928) primero
$args_andres = [
  'post_type' => 'casos_exito',
  'posts_per_page' => 10,
  'post__not_in' => [get_the_ID()],
  'meta_query' => [
    [
      'key' => 'autor_relacionado',
      'value' => '"928"',
      'compare' => 'LIKE',
    ]
  ]
];
$posts_andres = get_posts($args_andres);
$ids_andres = array_map(function ($p) {
  return $p->ID;
}, $posts_andres);

// 2. Obtener otros casos aleatorios (globales)
$posts_globales = [];
$limit_remaining = 10 - count($posts_andres);

if ($limit_remaining > 0) {
  $excludes = array_merge([get_the_ID()], $ids_andres);
  $args_rel = [
    'post_type' => 'casos_exito',
    'posts_per_page' => $limit_remaining,
    'post__not_in' => $excludes,
    'orderby' => 'rand',
    'post_status' => 'publish',
  ];
  $posts_globales = get_posts($args_rel);
}

$ids_globales = array_map(function ($p) {
  return $p->ID;
}, $posts_globales);

// 3. Fusionar IDs (Andrés primero)
$final_ids = array_merge($ids_andres, $ids_globales);

if (empty($final_ids)) {
  // Fallback si no hay nada (raro), para evitar error en WP_Query
  $final_ids = [0];
}

$relacionados = new WP_Query([
  'post_type' => 'casos_exito',
  'post__in' => $final_ids,
  'orderby' => 'post__in',
  'posts_per_page' => 10
]);

if ($relacionados->have_posts()):
  ?>
  <section class="bg-gradiente-13 text-white py-60 reveal reveal-up">
    <div class="container">

      <div class="grid-2--35-65">

        <!-- Left column -->
        <div>
          <h2 class="heading-lg mb-40">More related cases <br> in the region</h2>

          <div class="nav-round-group">
            <button class="nav-round nav-round--prev-casos"></button>
            <button class="nav-round nav-round--next-casos"></button>
          </div>
        </div>

        <!-- Right column -->
        <div>
          <div class="swiper casos-relacionados-slider">
            <div class="swiper-wrapper">

              <?php while ($relacionados->have_posts()):
                $relacionados->the_post();

                $anio_rel = get_the_date('Y');
                $tags_rel = get_the_terms(get_the_ID(), 'tags_caso_exito');
                $tag_name_rel = ($tags_rel && !is_wp_error($tags_rel)) ? esc_html($tags_rel[0]->name) : '';

                // Obtener autor de ESTE post relacionado
                $autor_rel_obj = null;
                $autores_rel = get_field('autor_relacionado', get_the_ID());
                if ($autores_rel) {
                  if (is_array($autores_rel)) {
                    $autor_rel_obj = $autores_rel[0]; // Tomar el primero si es array de objetos
                  } elseif (is_object($autores_rel)) {
                    $autor_rel_obj = $autores_rel;
                  }
                }
                $nombre_autor_rel = $autor_rel_obj ? $autor_rel_obj->post_title : '';

                $imagen = get_the_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                <div class="swiper-slide caso-item">
                  <a href="<?php the_permalink(); ?>" class="caso-link">

                    <div class="caso-imagen">
                      <div class="caso-imagen">
                        <?php
                        $custom_thumb_rel = get_field('imagen_miniatura_casos', get_the_ID());

                        if ($custom_thumb_rel && is_array($custom_thumb_rel)): ?>
                          <img src="<?php echo esc_url($custom_thumb_rel['url']); ?>"
                            alt="<?php echo esc_attr($custom_thumb_rel['alt']); ?>"
                            style="width:100%; height:100%; object-fit:cover;">
                        <?php elseif (has_post_thumbnail(get_the_ID())): ?>
                          <?php echo get_the_post_thumbnail(get_the_ID(), 'large', ['style' => 'width:100%; height:100%; object-fit:cover;']); ?>
                        <?php else: ?>
                          <span class="caso-imagen--placeholder"
                            style="width:100%; height:100%; display:block; background-color: var(--azul-corporativo, #001f3f);"></span>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="py-10 text-white">

                      <!-- Year | Company/Tag -->
                      <p class="mb-10 truncate-1 text-left">
                        <?php echo esc_html($anio_rel); ?>
                        <?php if ($tag_name_rel): ?> | <?php echo $tag_name_rel; ?><?php endif; ?>
                      </p>

                      <!-- Title -->
                      <h3 class="heading-sm truncate-2"><?php the_title(); ?></h3>

                      <!-- Author -->
                      <p class="mt-10 mb-30"><?php echo esc_html($nombre_autor_rel); ?></p>

                      <span class="btn-outline">Read more</span>
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

?>

<?php get_footer(); ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    const slider = document.querySelector('.casos-relacionados-slider');
    if (!slider) return;

    new Swiper(slider, {
      slidesPerView: 2,
      spaceBetween: 20,
      navigation: {
        nextEl: '.nav-round--next-casos',
        prevEl: '.nav-round--prev-casos'
      },
      breakpoints: {
        0: { slidesPerView: 1, spaceBetween: 20 },
        768: { slidesPerView: 2, spaceBetween: 20 }
      }
    });

  });
</script>