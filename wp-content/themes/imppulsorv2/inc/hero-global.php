<?php
/**
 * Hero global: banners por página (CPT banner_hero) + fallback a heroes legacy.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Título del hero por defecto (singular insights / casos de éxito usan etiqueta fija).
 *
 * @param int $post_id ID del post consultado; 0 = queried object.
 * @return string
 */
function imppulsor_get_hero_title($post_id = 0) {
    if (is_singular('casos_exito')) {
        return 'Success stories';
    }
    if (is_singular('insights')) {
        return 'Insights';
    }

    $post_id = $post_id ? (int) $post_id : (int) get_queried_object_id();
    return $post_id ? get_the_title($post_id) : '';
}

/**
 * Banners publicados cuyo campo ACF pagina_destino coincide con el objeto consultado.
 *
 * @return WP_Post[]
 */
function imppulsor_get_hero_banners_for_queried_object() {
    if (!function_exists('get_field')) {
        return [];
    }

    $target_id = (int) get_queried_object_id();
    if ($target_id <= 0) {
        return [];
    }

    $q = new WP_Query([
        'post_type'              => 'banner_hero',
        'post_status'            => 'publish',
        'posts_per_page'         => 20,
        'orderby'                => [
            'menu_order' => 'ASC',
            'date'       => 'ASC',
        ],
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
        'meta_query'             => [
            [
                'key'     => 'pagina_destino',
                'value'   => (string) $target_id,
                'compare' => '=',
            ],
        ],
    ]);

    if (!$q->have_posts()) {
        return [];
    }

    return $q->posts;
}

/**
 * Muestra el hero global (slider) si hay banners para la vista actual; si no, el hero legacy.
 *
 * @param string $fallback default|insights|success-stories|slider
 */
function imppulsor_render_page_hero($fallback = 'default') {
    $allowed = ['default', 'insights', 'success-stories', 'slider'];
    if (!in_array($fallback, $allowed, true)) {
        $fallback = 'default';
    }

    $banners = imppulsor_get_hero_banners_for_queried_object();
    if (!empty($banners)) {
        set_query_var('imppulsor_hero_banner_posts', $banners);
        get_template_part('template-parts/heros/hero-global-banners');
        return;
    }

    switch ($fallback) {
        case 'insights':
            get_template_part('template-parts/heros/hero', 'insights');
            break;
        case 'success-stories':
            get_template_part('template-parts/heros/hero', 'success-stories');
            break;
        case 'slider':
            get_template_part('template-parts/heros/hero', 'slider');
            break;
        case 'default':
        default:
            get_template_part('template-parts/heros/hero', 'default');
            break;
    }
}
