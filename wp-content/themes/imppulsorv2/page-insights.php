<?php
/**
 * Template Name: Insights
 * Descripción: Página principal de Insights (slider + grid + sidebar)
 * - Updated: Unified year logic (Specific > Author > Post Date)
 */
if (!defined('ABSPATH'))
    exit;
get_header();
?>

<?php imppulsor_render_page_hero('insights'); ?>


<section class="bloque-insights reveal reveal-up bg-light">
    <div class="container section--light px-0  grid-2 grid-2--2fr-1fr ">

        <div>
            <h2 class="heading-lg mb-40">Recent insights</h2>

            <?php
            // Detect selected tag
            $current_tag = isset($_GET['tag']) ? sanitize_text_field($_GET['tag']) : '';

            // ✅ Force detection via query string only (?paged=2), ignoring /page/2/
            $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
            set_query_var('paged', $paged);


            // Define base query args
            $args = [
                'post_type' => 'insights',
                'posts_per_page' => 6,
                'paged' => $paged,
                'post_status' => 'publish',
                'tax_query' => [],
            ];

            // If a tag is set, filter by taxonomy
            if ($current_tag) {
                $args['tax_query'][] = [
                    'taxonomy' => 'tags_insight',
                    'field' => 'slug',
                    'terms' => $current_tag,
                ];
            }

            $insights = new WP_Query($args);
            ?>

            <div class="insights-grid grid-2">
                <?php if ($insights->have_posts()): ?>
                    <?php while ($insights->have_posts()):
                        $insights->the_post(); ?>
                        <?php
                        // 1. Related author (ACF) and ID retrieval for the year
                        $autor_rel = get_field('autor_relacionado');
                        $nombre_autor = '';
                        $autor_id = null; // Initialize

                        if (is_array($autor_rel) && !empty($autor_rel)) {
                            $first = $autor_rel[0];
                            $autor_id = is_object($first) ? $first->ID : (is_array($first) && isset($first['ID']) ? $first['ID'] : $first);
                            $nombre_autor = get_the_title($autor_id);
                        } else {
                            $nombre_autor = get_field('autor_nombre') ?: get_the_author();
                        }

                        // 2. YEAR logic (Specific > Author > Date)
                        $anio_especifico = get_field('anio_especifico_insight');
                        $anio_autor      = $autor_id ? get_field('anio_autor', $autor_id) : '';
                        
                        // Final fallback
                        $anio = $anio_especifico ?: ($anio_autor ?: get_the_date('Y'));


                        // 3. Tag (custom taxonomy)
                        $tags = get_the_terms(get_the_ID(), 'tags_insight');
                        $tag_name = ($tags && !is_wp_error($tags)) ? esc_html($tags[0]->name) : '';
                        ?>
                        <div class="insight-item">
                            <a href="<?php the_permalink(); ?>" class="insight-card-link">
                                <div class="insight-card">
                                    <div class="insight-card__image  ">
                                        <?php
                                        // Custom ACF Image (Array format)
                                        $custom_thumb = get_field('imagen_miniatura_insights');
                                        
                                        if ($custom_thumb && is_array($custom_thumb)) : ?>
                                            <img src="<?php echo esc_url($custom_thumb['url']); ?>" 
                                                 alt="<?php echo esc_attr($custom_thumb['alt']); ?>" 
                                                 class="w-100 object-cover" 
                                                 style="height: 100%; object-fit: cover;">
                                        <?php elseif (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('large', ['class' => 'w-100  ']); ?>
                                        <?php else: ?>
                                            <div class="insight-thumb-fallback insight-thumb-fallback--grid"></div>
                                        <?php endif; ?>
                                    </div>


                                    <div class="insight-card__content">
                                        <?php if ($anio || $tag_name): ?>
                                            <p class="mb-10 insight-meta truncate-1">
                                                <?php echo esc_html($anio); ?>
                                                <?php if ($tag_name)
                                                    echo ' | ' . esc_html($tag_name); ?>
                                            </p>
                                        <?php endif; ?>

                                        <h3 class="mb-10 heading-sm truncate-2"><?php the_title(); ?></h3>

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
                <?php else: ?>
                    <p>No insights available at this time.</p>
                <?php endif; ?>
            </div>



            <div class="insights-pagination mt-60">
                <?php
                $base_url = get_permalink();
                if ($current_tag)
                    $base_url = add_query_arg('tag', $current_tag, $base_url);

                $separator = (strpos($base_url, '?') !== false) ? '&' : '?';
                $paginate_base = $base_url . $separator . 'paged=%#%';

                $pagination_links = paginate_links([
                    'base' => $paginate_base,
                    'format' => '',
                    'current' => max(1, $paged),
                    'total' => $insights->max_num_pages,
                    'type' => 'array',
                    'prev_text' => 'previous',
                    'next_text' => 'next',
                ]);

                if (!empty($pagination_links)) {
                    foreach ($pagination_links as $link) {
                        // Replace WP classes with the theme's classes
                        $link = str_replace('page-numbers', 'insights-pagination__bullet', $link);
                        $link = str_replace('current', 'insights-pagination__bullet--active', $link);

                        // Specific adjustments for prev/next
                        if (strpos($link, 'previous') !== false || strpos($link, 'next') !== false) {
                            $link = str_replace('insights-pagination__bullet', 'insights-pagination__bullet insights-pagination__bullet--nav', $link);
                        }

                        // 'dots' handling
                        if (strpos($link, 'dots') !== false) {
                            $link = str_replace('insights-pagination__bullet', 'insights-pagination__bullet border-0', $link);
                        }

                        echo $link;
                    }
                }
                ?>
            </div>







            <?php wp_reset_postdata(); ?>
        </div>

<aside class="sidebar reveal reveal-left">

    <div class="sidebar-block bg-light-gray mb-20 py-20 px-30">
        <h3 class="heading-sm mb-15">Search</h3>
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
            <input type="hidden" name="post_type" value="insights">
            <input type="search" name="s" placeholder="Enter a keyword…" class="w-100">
        </form>
    </div>

    <div class="sidebar-block bg-light-gray mb-20 py-20 px-30">
        <h3 class="heading-sm mb-15">Management areas</h3>
        <ul class="list-unstyled">

            <?php
            $tags = get_terms([
                'taxonomy' => 'tags_insight',
                'hide_empty' => true,
                'orderby' => 'count',
                'order' => 'DESC',
            ]);

            $base_url = get_permalink();

            if ($tags):
                foreach ($tags as $tag):

                    $is_active = ($current_tag === $tag->slug);
                    
                    // if active → back to the full listing
                    $link = $is_active ? $base_url : add_query_arg('tag', $tag->slug, $base_url);
            ?>

            <li>
                <a href="<?php echo esc_url($link); ?>"
                    class="d-flex justify-between py-10 px-10 mb-10 
                    <?php echo $is_active ? 'bg-light-blue text-white fw-600' : 'text-dark bg-light text-normal'; ?>">
                    
                    <span><?php echo esc_html($tag->name); ?></span>
                    <span class="text-light-blue text-bold ml-20">(<?php echo intval($tag->count); ?>)</span>
                </a>
            </li>

            <?php endforeach; endif; ?>

        </ul>
    </div>

    <div class="sidebar-block bg-light-gray py-20 px-30">
        <h3 class="heading-sm mb-20">Recent authors</h3>

        <?php
        $autores = [];
        $posts_autores = get_posts([
            'post_type' => 'insights',
            'numberposts' => 20,
            'post_status' => 'publish',
        ]);

        foreach ($posts_autores as $post_a) {
            $autor_rel = get_field('autor_relacionado', $post_a->ID);
            $nombre = '';
            $foto = $cargo = $linkedin = '';

            if (is_array($autor_rel) && !empty($autor_rel)) {
                $autor_id = is_object($autor_rel[0])
                    ? $autor_rel[0]->ID
                    : (is_array($autor_rel[0]) && isset($autor_rel[0]['ID'])
                        ? $autor_rel[0]['ID']
                        : $autor_rel[0]);

                $nombre   = get_the_title($autor_id);
                $foto     = get_field('foto_autor', $autor_id);
                $cargo    = get_field('cargo_autor', $autor_id);
                $linkedin = get_field('linkedin_autor', $autor_id);
            }

            if ($nombre && empty($autores[$nombre])) {
                $autores[$nombre] = compact('foto', 'cargo', 'linkedin');
            }
        }

        $autores = array_slice($autores, 0, 3, true);

        if (!empty($autores)):
            foreach ($autores as $nombre => $data):
        ?>

        <div class="d-flex align-center mb-20 bg-light text-dark">
            
            <?php if (!empty($data['foto']['url'])): ?>
                <img src="<?php echo esc_url($data['foto']['url']); ?>"
                     alt="<?php echo esc_attr($nombre); ?>"
                     class=""
                     style="width:70px; height:70px;">
            <?php endif; ?>

            <div class="px-10" style="flex:1%;">
                <strong class="fs-14"><?php echo esc_html($nombre); ?></strong>
                <?php if (!empty($data['cargo'])): ?>
                    <span class="fs-12"><?php echo esc_html($data['cargo']); ?></span>
                <?php endif; ?>
            </div>

            <?php if (!empty($data['linkedin'])): ?>
                <a href="<?php echo esc_url($data['linkedin']); ?>" target="_blank" rel="noopener"
                   aria-label="Author's LinkedIn"
                   class="text-bold fs-18 px-10">in</a>
            <?php endif; ?>

        </div>

        <?php endforeach; else: ?>

        <p>No recent authors.</p>

        <?php endif; ?>

    </div>

</aside>

    </div>
</section>

<?php
// ✅ Important: restore global context for ACF
wp_reset_postdata();
?>

<?php get_template_part('template-parts/blocks/bloque-introduccion-conectar-los-puntos'); ?>
<?php get_template_part('template-parts/blocks/bloque-como-ayudamos-a-nuestros-clientes'); ?>

<?php get_footer(); ?>



<style>

/* ========================================
   FALLBACK FOR INSIGHTS LISTING (GRID)
   ======================================== */
.insight-thumb-fallback--grid {
    width: 100%;
    height: 420px; /* You can adjust */
    max-height: 100%;
    background: var(--azul-corporativo);
    border-radius: inherit; /* respects rounded-diagonal */
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.insight-thumb-fallback--grid::before {
    content: "";
    width: 120px;
    height: 120px;
    background-image: url('/wp-content/themes/imppulsorv2/assets/img/logo-imppulsor.svg');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    opacity: 0.25;
}


    /* ===== Pagination for the Insights listing only ===== */
    .insights-pagination {
        display: flex;
        justify-content: start;
        gap: 12px;
        margin-top: 40px;
        width: 100%;
    }

    .insights-pagination__bullet {
        width: 26px;
        height: 26px;
        border: 1px solid #000;
        background: transparent;
        color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        transition: all .2s ease;
        border-radius: 0;
        cursor: pointer;
        text-decoration: none;
    }

    .insights-pagination__bullet--nav {
        width: max-content;
        padding: 0 12px;
        text-transform: lowercase;
    }

    .insights-pagination__bullet--active,
    .insights-pagination__bullet:hover {
        background: #006EFF;
        border-color: #006EFF;
        color: #fff;
    }


    .insights-pagination__bullet:last-child {
        width: max-content;
        padding: 0 12px;
        height: 26px;
    }
</style>