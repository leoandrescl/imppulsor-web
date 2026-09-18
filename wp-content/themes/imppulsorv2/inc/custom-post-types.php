<?php
/**
 * Registro de Custom Post Types para Imppulsor v2
 */

add_action('init', function() {

    /**
     * Helper para registrar CPT de forma compacta
     */
    function imppulsor_register_cpt($slug, $singular, $plural, $icon = 'dashicons-admin-post', $position = null, $rewrite_slug = null) {
        $labels = [
            'name'               => $plural,
            'singular_name'      => $singular,
            'menu_name'          => $plural,
            'name_admin_bar'     => $singular,
            'add_new'            => 'Añadir nuevo',
            'add_new_item'       => "Añadir nuevo $singular",
            'edit_item'          => "Editar $singular",
            'new_item'           => "Nuevo $singular",
            'view_item'          => "Ver $singular",
            'view_items'         => "Ver $plural",
            'search_items'       => "Buscar $plural",
            'not_found'          => "No se encontraron $plural",
            'not_found_in_trash' => "No hay $plural en la papelera",
            'all_items'          => "Todos los $plural",
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'show_in_menu'       => true,
            'menu_icon'          => $icon,
            'menu_position'      => $position,
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
            'has_archive'        => false,
            'rewrite'            => ['slug' => $rewrite_slug ?? $slug, 'with_front' => false],
            'show_in_rest'       => true,
        ];

        register_post_type($slug, $args);
    }


    // === Registro de CPTs ===

    // 1. Home Sections
    // imppulsor_register_cpt('home_sections', 'Sección Home', 'Secciones Home', 'dashicons-screenoptions', 5);

    // 2. Testimonios ("La voz de nuestros clientes")
    imppulsor_register_cpt('testimonios', 'Testimonio', 'Testimonios', 'dashicons-format-quote', 6);

    // 3. Casos de Éxito
    imppulsor_register_cpt('casos_exito', 'Caso de Éxito', 'Casos de Éxito', 'dashicons-awards', 7, 'casos-de-exito');

    // 4. Insights
    imppulsor_register_cpt('insights', 'Insight', 'Insights', 'dashicons-lightbulb', 8);

    // 5. Autores (para Insights)
    imppulsor_register_cpt('autores', 'Autor', 'Autores', 'dashicons-admin-users', 9);

    // 6. Equipo
    imppulsor_register_cpt('equipo', 'Miembro del Equipo', 'Equipo', 'dashicons-groups', 10);

    // 7. Diagnósticos
    // imppulsor_register_cpt('diagnosticos', 'Diagnóstico', 'Diagnósticos', 'dashicons-analytics', 11);

    // 8. Áreas de Trabajo
imppulsor_register_cpt('areas_trabajo', 'Área de Trabajo', 'Áreas de Trabajo', 'dashicons-chart-pie', 12);

    // 9. Bloques reutilizables (para contenido global)
imppulsor_register_cpt('bloques_globales', 'Bloque Reutilizable', 'Bloques Reutilizables', 'dashicons-layout', 13);

    // 10. Banners hero (asignables por página; varios = slider)
    $labels_banner = [
        'name'               => 'Banners hero',
        'singular_name'      => 'Banner hero',
        'menu_name'          => 'Banners hero',
        'name_admin_bar'     => 'Banner hero',
        'add_new'            => 'Añadir nuevo',
        'add_new_item'       => 'Añadir nuevo banner',
        'edit_item'          => 'Editar banner',
        'new_item'           => 'Nuevo banner',
        'view_item'          => 'Ver banner',
        'search_items'       => 'Buscar banners',
        'not_found'          => 'No hay banners',
        'not_found_in_trash' => 'No hay banners en la papelera',
        'all_items'          => 'Todos los banners',
    ];

    register_post_type('banner_hero', [
        'labels'              => $labels_banner,
        'public'              => false,
        'publicly_queryable'  => false,
        'exclude_from_search' => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => false,
        'menu_icon'           => 'dashicons-images-alt2',
        'menu_position'       => 14,
        'supports'            => ['title', 'thumbnail', 'page-attributes'],
        'has_archive'         => false,
        'rewrite'             => false,
        'query_var'           => false,
        'capability_type'     => 'post',
    ]);


});
