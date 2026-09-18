<?php
/**
 * Block: Success Stories
 * - Fully clickable slide
 * - Prioritizes company variety: least frequent companies appear first
 */

$args_query = $args['query'] ?? new WP_Query([
  'post_type' => 'casos_exito',
  'posts_per_page' => -1,        // ⚠ Fetch ALL to mix properly
  'orderby' => 'date',
  'order' => 'DESC'
]);
?>

<section class="bloque bloque-casos-exito pt-60 reveal reveal-up">
  <div class="container">
    <div class="bloque-casos-exito__header text-white">
      <h2 class="heading-lg">Success stories</h2>
      <div class="bloque-casos-exito__nav">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>

    <?php
    /* ============================================================
       1) Save all posts and separate Andrés Carey's posts (ID 928)
    ============================================================ */
    $posts_raw_others = [];
    $posts_andres_carey = [];
    $target_author_id = 928; // Andrés Carey ID
    
    while ($args_query->have_posts()):
      $args_query->the_post();
      $p = get_post();

      // Check related author
      $auth_field = get_field('autor_relacionado', $p->ID);
      $is_andres = false;

      if ($auth_field) {
        if (is_array($auth_field)) {
          foreach ($auth_field as $af) {
            $aid = is_object($af) ? $af->ID : $af;
            if ($aid == $target_author_id) {
              $is_andres = true;
              break;
            }
          }
        } elseif (is_object($auth_field)) {
          if ($auth_field->ID == $target_author_id)
            $is_andres = true;
        } else {
          if ($auth_field == $target_author_id)
            $is_andres = true;
        }
      }

      if ($is_andres) {
        $posts_andres_carey[] = $p;
      } else {
        $posts_raw_others[] = $p;
      }
    endwhile;
    wp_reset_postdata();

    /* If there are no posts (neither Andrés's nor others), exit */
    if (empty($posts_raw_others) && empty($posts_andres_carey)): ?>
      <p class="text-white mt-20">No success stories available.</p>
    </div>
  </section>
  <?php return; endif;

    /* ============================================================
       2) Group posts by company (case > author > "No company")
    ============================================================ */
    $empresa_posts = [];

    foreach ($posts_raw_others as $p) {

      // Related author
      $autor_field = get_field('autor_relacionado', $p->ID);
      $autor = null;

      if ($autor_field) {
        if (is_array($autor_field)) {
          $first = reset($autor_field);
          $autor = is_object($first) ? $first : get_post($first);
        } else {
          $autor = is_object($autor_field) ? $autor_field : get_post($autor_field);
        }
      }

      // Company from the case and from the author
      $empresa_case = get_field('empresa_especifico_caso', $p->ID);
      $empresa_autor = $autor ? get_field('empresa_autor', $autor->ID) : '';

      // Rule: specific case company first, then the author's company
      $empresa_final = $empresa_case ?: $empresa_autor;
      if (!$empresa_final) {
        $empresa_final = 'No company';
      }

      // Group
      $empresa_posts[$empresa_final][] = $p;
    }

    /* ============================================================
       3) Sort companies from least → most frequent
       (companies that repeat the least come first)
    ============================================================ */
    uasort($empresa_posts, function ($a, $b) {
      return count($a) <=> count($b);
    });

    /* ============================================================
       4) Interleave posts for maximum diversity
    ============================================================ */
    $posts_finales = [];
    $max_items = max(array_map('count', $empresa_posts));

    for ($i = 0; $i < $max_items; $i++) {
      foreach ($empresa_posts as $grupo) {
        if (isset($grupo[$i])) {
          $posts_finales[] = $grupo[$i];
        }
      }
    }

    /* ============================================================
       4.5) Merge with Andrés Carey first
    ============================================================ */
    // Merge: Andrés first, then the rest interleaved
    $posts_finales = array_merge($posts_andres_carey, $posts_finales);

    /* ============================================================
       5) Limit to N visible slides (e.g. 6)
    ============================================================ */
    $max_a_mostrar = 6;
    $posts_finales = array_slice($posts_finales, 0, $max_a_mostrar);
    ?>

<div class="swiper casos-slider">
  <div class="swiper-wrapper">

    <?php
    /* ============================================================
       6) Final render of cards in the new order
    ============================================================ */
    foreach ($posts_finales as $p):
      setup_postdata($p);

      // Author
      $autor_field = get_field('autor_relacionado', $p->ID);
      $autor = null;

      if ($autor_field) {
        if (is_array($autor_field)) {
          $first = reset($autor_field);
          $autor = is_object($first) ? $first : get_post($first);
        } else {
          $autor = is_object($autor_field) ? $autor_field : get_post($autor_field);
        }
      }

      $nombre_autor = $autor ? $autor->post_title : '';
      $empresa_autor = $autor ? get_field('empresa_autor', $autor->ID) : '';

      // Case fields
      $empresa_case = get_field('empresa_especifico_caso', $p->ID);
      $anio_case = get_field('anio_especifico_caso', $p->ID);

      // Final values
      $empresa_final = $empresa_case ?: $empresa_autor;
      $anio_final = $anio_case ?: get_the_date('Y', $p->ID);
      ?>

      <div class="swiper-slide caso-item">
        <a href="<?php echo get_permalink($p->ID); ?>" class="caso-link">

          <div class="caso-imagen">
            <div class="caso-imagen">
              <?php
              $custom_thumb = get_field('imagen_miniatura_casos', $p->ID);
              if ($custom_thumb && is_array($custom_thumb)): ?>
                <img src="<?php echo esc_url($custom_thumb['url']); ?>" alt="<?php echo esc_attr($custom_thumb['alt']); ?>"
                  style="width:100%; height:100%; object-fit:cover;">
              <?php elseif (has_post_thumbnail($p->ID)): ?>
                <?php echo get_the_post_thumbnail($p->ID, 'large'); ?>
              <?php else: ?>
                <span class="caso-imagen--placeholder"></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="py-10 text-white">

            <!-- Year | Company -->
            <?php if ($anio_final || $empresa_final): ?>
              <p class="mb-10 truncate-1 text-left">
                <?php echo esc_html($anio_final); ?>
                <?php if ($empresa_final)
                  echo ' | ' . esc_html($empresa_final); ?>
              </p>
            <?php endif; ?>

            <!-- Title -->
            <h3 class="heading-sm truncate-2"><?php echo esc_html(get_the_title($p->ID)); ?></h3>

            <!-- Author -->
            <?php if ($nombre_autor): ?>
              <p class="mt-10 mb-30"><?php echo esc_html($nombre_autor); ?></p>
            <?php endif; ?>

            <span class="btn-outline">Read more</span>
          </div>

        </a>
      </div>

    <?php endforeach;
    wp_reset_postdata(); ?>

  </div>
</div>
</div>
</section>

<style>
  /* Corporate blue placeholder when there is no image */
  .caso-item .caso-imagen--placeholder {
    width: 100%;
    height: 410px;
    background-color: var(--azul-corporativo, #001f3f);
    display: block;
  }
</style>