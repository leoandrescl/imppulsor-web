<?php
/**
 * Encolado de estilos y scripts del tema hijo Imppulsor v2
 */

add_action('wp_enqueue_scripts', function() {

    /**
     * ============================================================
     * 1. ESTILOS BASE
     * ============================================================
     */

    // Estilo del tema padre (GeneratePress)
    wp_enqueue_style(
        'generatepress-style',
        get_template_directory_uri() . '/style.css'
    );

    // Estilo del tema hijo principal
    wp_enqueue_style(
        'imppulsorv2-style',
        get_stylesheet_directory_uri() . '/style.css',
        ['generatepress-style'],
        filemtime(get_stylesheet_directory() . '/style.css')
    );


    /**
     * ============================================================
     * 2. ESTILOS DEL SITIO
     * ============================================================
     */

    // Utilidades (helpers globales)
    $utilities_css = get_stylesheet_directory() . '/assets/css/utilities.css';
    if (file_exists($utilities_css)) {
        wp_enqueue_style(
            'imppulsorv2-utilities',
            get_stylesheet_directory_uri() . '/assets/css/utilities.css',
            ['imppulsorv2-main-css'],
            filemtime($utilities_css)
        );
    }

    // CSS principal global
    $main_css = get_stylesheet_directory() . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'imppulsorv2-main-css',
            get_stylesheet_directory_uri() . '/assets/css/main.css',
            ['imppulsorv2-style'],
            filemtime($main_css)
        );
    }

    // CSS hero global (usado en todas las páginas)
    $hero_css = get_stylesheet_directory() . '/assets/css/hero.css';
    if (file_exists($hero_css)) {
        wp_enqueue_style(
            'imppulsorv2-hero-css',
            get_stylesheet_directory_uri() . '/assets/css/hero.css',
            ['imppulsorv2-main-css'],
            filemtime($hero_css)
        );
    }

    // CSS MegaMenu
    $megamenu_css = get_stylesheet_directory() . '/assets/css/megamenu.css';
    if (file_exists($megamenu_css)) {
        wp_enqueue_style(
            'imppulsorv2-megamenu-css',
            get_stylesheet_directory_uri() . '/assets/css/megamenu.css',
            ['imppulsorv2-main-css'],
            filemtime($megamenu_css)
        );
    }

    // Header global
    $header_css = get_stylesheet_directory() . '/assets/css/header.css';
    if (file_exists($header_css)) {
        wp_enqueue_style(
            'imppulsorv2-header-css',
            get_stylesheet_directory_uri() . '/assets/css/header.css',
            ['imppulsorv2-main-css'],
            filemtime($header_css)
        );
    }

    

    // Contenido general (bloques institucionales, páginas, diagnósticos)
    $contenido_css = get_stylesheet_directory() . '/assets/css/contenido.css';
    if (file_exists($contenido_css)) {
        wp_enqueue_style(
            'imppulsorv2-contenido-css',
            get_stylesheet_directory_uri() . '/assets/css/contenido.css',
            ['imppulsorv2-main-css'],
            filemtime($contenido_css)
        );
    }


    /**
     * ============================================================
     * 3. ESTILOS DE BLOQUES / SECCIONES MODULARES
     * ============================================================
     */

    // --- Casos de Éxito (reutilizable)
    $casos_css = get_stylesheet_directory() . '/assets/css/casos-exito.css';
    if (file_exists($casos_css)) {
        wp_enqueue_style(
            'imppulsorv2-casos-exito-css',
            get_stylesheet_directory_uri() . '/assets/css/casos-exito.css',
            ['imppulsorv2-main-css'],
            filemtime($casos_css)
        );
    }

    // --- Insights (reutilizable)
    $insights_css = get_stylesheet_directory() . '/assets/css/insights.css';
    if (file_exists($insights_css)) {
        wp_enqueue_style(
            'imppulsorv2-insights-css',
            get_stylesheet_directory_uri() . '/assets/css/insights.css',
            ['imppulsorv2-main-css'],
            filemtime($insights_css)
        );
    }

    // --- Bloque Ocho Áreas (solo Diagnóstico)
    $ocho_areas_css = get_stylesheet_directory() . '/assets/css/ocho-areas.css';
    if (file_exists($ocho_areas_css) && is_page_template('page-diagnostico.php')) {
        wp_enqueue_style(
            'imppulsorv2-ocho-areas-css',
            get_stylesheet_directory_uri() . '/assets/css/ocho-areas.css',
            ['imppulsorv2-main-css'],
            filemtime($ocho_areas_css)
        );
    }

    // --- Experiencia Internacional (solo Diagnóstico)
    $experiencia_css = get_stylesheet_directory() . '/assets/css/experiencia.css';
    if (file_exists($experiencia_css) && is_page_template('page-diagnostico.php')) {
        wp_enqueue_style(
            'imppulsorv2-experiencia-css',
            get_stylesheet_directory_uri() . '/assets/css/experiencia.css',
            ['imppulsorv2-main-css'],
            filemtime($experiencia_css)
        );
    }


    /**
     * ============================================================
     * 4. LIBRERÍAS EXTERNAS
     * ============================================================
     */

    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '11.0.0'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        '11.0.0',
        true
    );


    /**
     * ============================================================
     * 5. SCRIPTS DEL TEMA
     * ============================================================
     */

    // JS global (main.js)
    $main_js = get_stylesheet_directory() . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script(
            'imppulsorv2-main-js',
            get_stylesheet_directory_uri() . '/assets/js/main.js',
            ['jquery'],
            filemtime($main_js),
            true
        );
    }

    // Header interacciones (mobile, overlay)
    $header_js = get_stylesheet_directory() . '/assets/js/header.js';
    if (file_exists($header_js)) {
        wp_enqueue_script(
            'imppulsorv2-header-js',
            get_stylesheet_directory_uri() . '/assets/js/header.js',
            [],
            filemtime($header_js),
            true
        );
    }

    // Swiper inicialización (carouseles globales)
    $swiper_init = get_stylesheet_directory() . '/assets/js/swiper-init.js';
    if (file_exists($swiper_init)) {
        wp_enqueue_script(
            'imppulsorv2-swiper-init',
            get_stylesheet_directory_uri() . '/assets/js/swiper-init.js',
            ['swiper-js'],
            filemtime($swiper_init),
            true
        );
    }

}, 50);
