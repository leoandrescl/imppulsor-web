<?php
echo "<!-- TEMPLATE: archive-insights.php LOADED -->";
get_header();
?>


<section class="bloque-insights mt-60 reveal reveal-up">
  <div class="container section--light grid-2">
    <div>
      <h2 class="heading-lg mb-40">Recent insights</h2>

      <div class="insights-grid grid-2">
        <?php if (have_posts()):
          while (have_posts()):
            the_post(); ?>
            <?php
            // Autor (ACF relacionado o fallback)
            $autor_rel = get_field('autor_relacionado');
            $nombre_autor = '';
            if (is_array($autor_rel) && !empty($autor_rel)) {
              $first = $autor_rel[0];
              $autor_id = is_object($first) ? $first->ID : (is_array($first) && isset($first['ID']) ? $first['ID'] : $first);
              $nombre_autor = get_the_title($autor_id);
            } else {
              $nombre_autor = get_field('autor_nombre') ?: get_the_author();
            }
            $anio = get_the_date('Y');
            $tags = get_the_terms(get_the_ID(), 'tags_insight');
            $tag_name = ($tags && !is_wp_error($tags)) ? esc_html($tags[0]->name) : '';
            ?>
            <div class="insight-item">
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
                  <?php endif; ?>

                  <div class="insight-card__content">
                    <?php if ($anio || $tag_name): ?>
                      <p class="fs-14 mb-10 insight-meta">
                        <?php echo esc_html($anio); ?>
                        <?php if ($tag_name)
                          echo ' | ' . esc_html($tag_name); ?>
                      </p>
                    <?php endif; ?>

                    <h3 class="fs-18 mb-10"><?php the_title(); ?></h3>

                    <?php if ($nombre_autor): ?>
                      <p class="fs-14 mb-20 insight-author"><?php echo esc_html($nombre_autor); ?></p>
                    <?php endif; ?>

                    <span class="btn-outline--black">Read article</span>
                  </div>
                </div>
              </a>
            </div>
          <?php endwhile; else: ?>
          <p>No insights available right now.</p>
        <?php endif; ?>
      </div>

      <div class="paginacion mt-40">
        <?php
        global $wp_query;
        echo paginate_links([
          'total' => $wp_query->max_num_pages,
          'current' => max(1, get_query_var('paged')),
          'prev_text' => __('« Previous'),
          'next_text' => __('Next »'),
        ]);
        ?>
      </div>
    </div>

    <aside class="sidebar">
      <div class="sidebar-block mb-40">
        <h3 class="heading-md mb-15">Search</h3>
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
          <input type="hidden" name="post_type" value="insights">
          <input type="search" name="s" placeholder="Enter keyword…" class="w-100">
        </form>
      </div>

      <div class="sidebar-block mb-40">
        <h3 class="heading-md mb-15">Management areas</h3>
        <ul class="list-unstyled">
          <?php
          $terms = get_terms([
            'taxonomy' => 'tags_insight',
            'hide_empty' => true,
            'orderby' => 'count',
            'order' => 'DESC',
          ]);
          if ($terms):
            foreach ($terms as $t):
              $link = get_term_link($t);
              $is_active = (is_tax('tags_insight') && get_queried_object_id() === $t->term_id);
              ?>
              <li>
                <a href="<?php echo esc_url($link); ?>"
                  class="d-flex justify-between py-5 px-10 rounded-sm <?php echo $is_active ? 'bg-blue text-white fw-600' : 'text-dark'; ?>">
                  <span><?php echo esc_html($t->name); ?></span>
                  <span>(<?php echo intval($t->count); ?>)</span>
                </a>
              </li>
            <?php endforeach;
          endif;
          ?>
        </ul>
      </div>

      <div class="sidebar-block">
        <h3 class="heading-md mb-15">Recent authors</h3>
        <?php
        $q_aut = new WP_Query([
          'post_type' => 'insights',
          'posts_per_page' => 50,
          'post_status' => 'publish',
          'fields' => 'ids',
          'no_found_rows' => true,
        ]);

        $autores = [];
        if ($q_aut->have_posts()) {
          foreach ($q_aut->posts as $pid) {
            $nombre = get_field('autor_nombre', $pid);
            $foto = get_field('autor_foto', $pid);
            $cargo = get_field('autor_cargo', $pid);
            $linkedin = get_field('autor_linkedin', $pid);
            if ($nombre && empty($autores[$nombre])) {
              $autores[$nombre] = compact('foto', 'cargo', 'linkedin');
            }
          }
        }
        wp_reset_postdata();

        $autores = array_slice($autores, 0, 3, true);
        if ($autores):
          foreach ($autores as $nombre => $data): ?>
            <div class="autor-card d-flex align-center mb-15">
              <?php if (!empty($data['foto']['url'])): ?>
                <img src="<?php echo esc_url($data['foto']['url']); ?>" alt="<?php echo esc_attr($nombre); ?>"
                  class="autor-foto rounded w-60 h-60 object-cover">
              <?php endif; ?>
              <div class="ml-10">
                <strong class="d-block text-dark"><?php echo esc_html($nombre); ?></strong>
                <?php if (!empty($data['cargo'])): ?>
                  <span class="text-sm text-muted"><?php echo esc_html($data['cargo']); ?></span>
                <?php endif; ?>
              </div>
              <?php if (!empty($data['linkedin'])): ?>
                <a href="<?php echo esc_url($data['linkedin']); ?>" target="_blank" rel="noopener"
                  class="ml-auto text-dark">in</a>
              <?php endif; ?>
            </div>
          <?php endforeach;
        endif;
        ?>
      </div>
    </aside>
  </div>
</section>

<?php get_footer(); ?>