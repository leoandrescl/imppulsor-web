<?php
/**
 * Shortcodes globales de Imppulsor v2
 *
 * [bloque_testimonios]
 * [bloque_casos_exito]
 * [bloque_insights]
 */

//
// === 1. TESTIMONIOS ===
//
add_shortcode('bloque_testimonios', function() {

    $args = [
        'post_type'      => 'testimonios',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    ];

    $testimonios = new WP_Query($args);

    ob_start();

    if ($testimonios->have_posts()) {
        get_template_part('template-parts/blocks/bloque', 'testimonios', ['query' => $testimonios]);
    } else {
        echo '<p>No testimonials available.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
});


//
// === 2. CASOS DE ÉXITO ===
//
add_shortcode('bloque_casos_exito', function() {

    $args = [
        'post_type'      => 'casos_exito',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    ];

    $casos = new WP_Query($args);

    ob_start();

    if ($casos->have_posts()) {
        get_template_part('template-parts/blocks/bloque', 'casos-exito', ['query' => $casos]);
    } else {
        echo '<p>No success stories available.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
});


//
// === 3. INSIGHTS ===
//
add_shortcode('bloque_insights', function() {

    $args = [
        'post_type'      => 'insights',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ];

    $insights = new WP_Query($args);

    ob_start();

    if ($insights->have_posts()) {
        get_template_part('template-parts/blocks/bloque', 'insights', ['query' => $insights]);
    } else {
        echo '<p>No insights available.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
});
