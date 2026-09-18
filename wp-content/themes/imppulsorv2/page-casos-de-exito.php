<?php
/**
 * Template Name: Casos de Éxito
 * Descripción: Página principal de Casos de Éxito (slider + grid + sidebar con filtros por área y país)
 */
if (!defined('ABSPATH'))
    exit;
get_header();
?>

<!-- Hero -->
<?php imppulsor_render_page_hero('success-stories'); ?>


<section class="bloque-casos-exito reveal reveal-up bg-light">
    <div class="container section--light pt-60 px-0 grid-2 grid-2--2fr-1fr ">

        <!-- ============================================================
      MAIN GRID
============================================================ -->
        <div>
            <h2 class="heading-lg mb-40">Recent success stories</h2>

            <?php
            /* --------------------------
                GET PARAMETERS
            --------------------------- */
            $current_tag = isset($_GET['tag']) ? sanitize_text_field($_GET['tag']) : '';
            $pais_actual = isset($_GET['pais']) ? sanitize_text_field($_GET['pais']) : '';
            $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;

            /* ============================================================
                1) FETCH ALL CASES (respecting TAG)
            ============================================================ */
            $all_args = [
                'post_type' => 'casos_exito',
                'posts_per_page' => -1,
                'post_status' => 'publish',
            ];

            if ($current_tag) {
                $all_args['tax_query'][] = [
                    'taxonomy' => 'tags_caso_exito',
                    'field' => 'slug',
                    'terms' => $current_tag,
                ];
            }

            $all_cases = get_posts($all_args);

            /* ============================================================
                2) FILTER BY COUNTRY
            ============================================================ */
            if ($pais_actual) {
                $all_cases = array_filter($all_cases, function ($post) use ($pais_actual) {

                    $p1 = get_field('pais_especifico_caso', $post->ID);
                    $p2 = get_field('pais_especifico_caso_2', $post->ID);

                    return (
                        ($p1 && strtolower($p1) === strtolower($pais_actual)) ||
                        ($p2 && strtolower($p2) === strtolower($pais_actual))
                    );
                });
            }

            /* If no cases remain */
            if (empty($all_cases)) {
                $ordenados = [];
                $total_pages = 1;
            } else {

                /* ============================================================
                    3) GROUP BY COMPANY (case > author)
                ============================================================ */
                $empresa_map = [];

                foreach ($all_cases as $post) {

                    $empresa_case = get_field('empresa_especifico_caso', $post->ID);

                    $autor_field = get_field('autor_relacionado', $post->ID);
                    $autor = null;

                    if ($autor_field) {
                        $first = is_array($autor_field) ? reset($autor_field) : $autor_field;
                        $autor = is_object($first) ? $first : get_post($first);
                    }

                    $empresa_autor = $autor ? get_field('empresa_autor', $autor->ID) : '';

                    $empresa_final = $empresa_case ?: $empresa_autor;
                    if (!$empresa_final)
                        $empresa_final = 'No company';

                    $empresa_map[$empresa_final][] = $post;
                }

                /* ============================================================
                    4) SORT COMPANIES: least frequent → most frequent
                ============================================================ */
                uasort($empresa_map, function ($a, $b) {
                    return count($a) <=> count($b);
                });

                /* ============================================================
                    5) INTERLEAVE FOR MAXIMUM VARIETY
                ============================================================ */
                $ordenados = [];
                $max_items = max(array_map('count', $empresa_map));

                for ($i = 0; $i < $max_items; $i++) {
                    foreach ($empresa_map as $grupo) {
                        if (!empty($grupo[$i])) {
                            $ordenados[] = $grupo[$i];
                        }
                    }
                }

                /* ============================================================
                    6) MANUAL PAGINATION
                ============================================================ */
                $posts_per_page = 6;
                $total_posts = count($ordenados);
                $total_pages = ceil($total_posts / $posts_per_page);

                $offset = ($paged - 1) * $posts_per_page;
                $casos = array_slice($ordenados, $offset, $posts_per_page);
            }

            ?>

            <div class="casos-grid grid-2">

                <?php if (!empty($casos)): ?>
                    <?php foreach ($casos as $post):
                        setup_postdata($post); ?>

                        <?php
                        /* --------------------------
                            CASE FIELDS
                        --------------------------- */
                        $empresa_case = get_field('empresa_especifico_caso', $post->ID);
                        $anio_case = get_field('anio_especifico_caso', $post->ID);
                        $rol_case = get_field('rol_autor_especifico_caso', $post->ID);

                        /* --------------------------
                            AUTHOR
                        --------------------------- */
                        $autor_field = get_field('autor_relacionado', $post->ID);
                        $autor_obj = null;

                        if ($autor_field) {
                            $first = is_array($autor_field) ? reset($autor_field) : $autor_field;
                            $autor_obj = is_object($first) ? $first : get_post($first);
                        }

                        $empresa_autor = $anio_autor = $cargo_autor = $nombre_autor = '';

                        if ($autor_obj) {
                            $empresa_autor = get_field('empresa_autor', $autor_obj->ID);
                            $anio_autor = get_field('anio_autor', $autor_obj->ID);
                            $cargo_autor = get_field('cargo_autor', $autor_obj->ID);
                            $nombre_autor = $autor_obj->post_title;
                        }

                        /* --------------------------
                            FINAL VALUES
                        --------------------------- */
                        $empresa_final = $empresa_case ?: $empresa_autor;
                        $anio_final = $anio_case ?: $anio_autor ?: get_the_date('Y');
                        $rol_final = $rol_case ?: $cargo_autor;

                        ?>

                        <div class="caso-item">
                            <a href="<?php the_permalink(); ?>" class="caso-card-link">
                                <div class="caso-card">

                                    <div class="caso-card__image rounded-diagonal">
                                        <?php
                                        $custom_thumb = get_field('imagen_miniatura_casos');
                                        if ($custom_thumb && is_array($custom_thumb)): ?>
                                            <img src="<?php echo esc_url($custom_thumb['url']); ?>"
                                                alt="<?php echo esc_attr($custom_thumb['alt']); ?>" class="w-100 object-cover"
                                                style="height: 100%; object-fit: cover;">
                                        <?php elseif (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('large', ['class' => 'w-100']); ?>
                                        <?php else: ?>
                                            <div class="w-100 h-100 bg-dark-blue"></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="caso-card__content text-dark">

                                        <p class="mb-10 caso-meta truncate-1">
                                            <?php echo esc_html($anio_final); ?>
                                            <?php if ($empresa_final): ?> |
                                                <?php echo esc_html($empresa_final); ?>        <?php endif; ?>
                                        </p>

                                        <h3 class="mb-10 truncate-2 heading-sm"><?php the_title(); ?></h3>

                                        <?php if ($nombre_autor): ?>
                                            <p class="mb-20 caso-author"><?php echo esc_html($nombre_autor); ?></p>
                                        <?php endif; ?>

                                        <span class="btn-outline--black">Read more</span>
                                    </div>

                                </div>
                            </a>
                        </div>

                    <?php endforeach;
                    wp_reset_postdata(); ?>

                <?php else: ?>
                    <p>No success stories available at this time.</p>
                <?php endif; ?>
            </div>

            <!-- ============================================================
      PAGINATION
============================================================ -->
            <div class="casos-pagination mt-60">
                <?php
                if ($total_pages > 1) {

                    $base_url = get_permalink();

                    if ($current_tag)
                        $base_url = add_query_arg('tag', $current_tag, $base_url);
                    if ($pais_actual)
                        $base_url = add_query_arg('pais', $pais_actual, $base_url);

                    $separator = (strpos($base_url, '?') !== false) ? '&' : '?';
                    $paginate_base = $base_url . $separator . 'paged=%#%';

                    $pagination_links = paginate_links([
                        'base' => $paginate_base,
                        'format' => '',
                        'current' => $paged,
                        'total' => $total_pages,
                        'type' => 'array',
                        'prev_text' => 'previous',
                        'next_text' => 'next',
                    ]);

                    if (!empty($pagination_links)) {
                        foreach ($pagination_links as $link) {

                            $link = str_replace('page-numbers', 'casos-pagination__bullet', $link);
                            $link = str_replace('current', 'casos-pagination__bullet--active', $link);

                            if (strpos($link, 'previous') !== false || strpos($link, 'next') !== false)
                                $link = str_replace('casos-pagination__bullet', 'casos-pagination__bullet casos-pagination__bullet--nav', $link);

                            echo $link;
                        }
                    }
                }
                ?>
            </div>

        </div>

        <!-- ============================================================
     SIDEBAR
============================================================ -->
        <aside class="sidebar reveal reveal-left">

            <div class="sidebar-block bg-light-gray mb-20 py-20 px-30">
                <h3 class="heading-sm mb-15">Search</h3>
                <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="hidden" name="post_type" value="casos_exito">
                    <input type="search" name="s" placeholder="Enter a keyword…" class="w-100">
                </form>
            </div>

            <div class="sidebar-block bg-light-gray mb-20 py-20 px-30">
                <h3 class="heading-sm mb-15">Management areas</h3>
                <ul class="list-unstyled">

                    <?php
                    $tags = get_terms([
                        'taxonomy' => 'tags_caso_exito',
                        'hide_empty' => true,
                        'orderby' => 'count',
                        'order' => 'DESC',
                    ]);

                    $base_url = get_permalink();

                    if ($tags):
                        foreach ($tags as $tag):
                            $link = add_query_arg('tag', $tag->slug, $base_url);

                            if ($pais_actual) {
                                $link = add_query_arg('pais', $pais_actual, $link);
                            }
                            ?>
                            <li>
                                <a href="<?php echo esc_url($link); ?>"
                                    class="d-flex justify-between py-10 px-10 mb-10 text-dark bg-light text-normal">
                                    <span><?php echo esc_html($tag->name); ?></span>
                                    <span class="text-light-blue text-bold ml-20">(<?php echo intval($tag->count); ?>)</span>
                                </a>
                            </li>
                        <?php endforeach; endif; ?>

                </ul>
            </div>

            <div class="sidebar-block bg-light-gray py-30 px-30">
                <h3 class="heading-sm mb-15">Recent territories</h3>
                <ul class="list-unstyled">

                    <?php
                    $casos_all = get_posts([
                        'post_type' => 'casos_exito',
                        'numberposts' => -1,
                        'post_status' => 'publish',
                    ]);

                    $paises = [];

                    foreach ($casos_all as $item) {
                        $p1 = get_field('pais_especifico_caso', $item->ID);
                        if ($p1)
                            $paises[$p1] = ($paises[$p1] ?? 0) + 1;

                        $p2 = get_field('pais_especifico_caso_2', $item->ID);
                        if ($p2)
                            $paises[$p2] = ($paises[$p2] ?? 0) + 1;
                    }

                    ksort($paises, SORT_NATURAL | SORT_FLAG_CASE);

                    foreach ($paises as $pais => $count):

                        $link = add_query_arg('pais', urlencode($pais), get_permalink());
                        if ($current_tag)
                            $link = add_query_arg('tag', $current_tag, $link);
                        ?>

                        <li>
                            <a href="<?php echo esc_url($link); ?>"
                                class="d-flex justify-between py-10 px-10 mb-10 text-dark bg-light text-normal">
                                <span><?php echo esc_html($pais); ?></span>
                                <span class="text-light-blue text-bold ml-20">(<?php echo intval($count); ?>)</span>
                            </a>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>

        </aside>

    </div>
</section>

<?php
wp_reset_postdata();
get_template_part('template-parts/blocks/bloque-introduccion-conectar-los-puntos');
get_template_part('template-parts/blocks/bloque-como-ayudamos-a-nuestros-clientes');
get_footer();
?>

<style>
    /* ===========================================================
    SUCCESS STORIES PAGINATION — SAME AS INSIGHTS
=========================================================== */

    .casos-pagination {
        display: flex;
        justify-content: start;
        gap: 12px;
        margin-top: 40px;
        width: 100%;
    }

    .casos-pagination__bullet {
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

    .casos-pagination__bullet--nav {
        width: max-content;
        padding: 0 12px;
        text-transform: lowercase;
    }

    .casos-pagination__bullet--active,
    .casos-pagination__bullet:hover {
        background: #006EFF;
        border-color: #006EFF;
        color: #fff;
    }

    .casos-pagination__bullet:last-child {
        width: max-content;
        padding: 0 12px;
        height: 26px;
    }
</style>