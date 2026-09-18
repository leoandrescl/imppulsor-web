<?php
/**
 * Configuración y registro de elementos del tema Imppulsor v2
 */

if (!defined('ABSPATH')) exit;

/**
 * ==========================================================
 * 1. Registrar CPT: Insights
 * ==========================================================
 */
add_action('init', function() {

  $labels = [
    'name'               => 'Insights',
    'singular_name'      => 'Insight',
    'menu_name'          => 'Insights',
    'name_admin_bar'     => 'Insight',
    'add_new'            => 'Añadir nuevo',
    'add_new_item'       => 'Añadir nuevo Insight',
    'edit_item'          => 'Editar Insight',
    'new_item'           => 'Nuevo Insight',
    'view_item'          => 'Ver Insight',
    'search_items'       => 'Buscar Insights',
    'not_found'          => 'No se encontraron Insights',
    'not_found_in_trash' => 'No hay Insights en la papelera'
  ];

  $args = [
    'labels'             => $labels,
    'public'             => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'menu_icon'          => 'dashicons-lightbulb',
    'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
    'has_archive'        => 'insights-posts',
    'rewrite'            => [
      'slug'       => 'insights-posts',
      'with_front' => false
    ],
    'show_in_rest'       => true,
    'taxonomies'         => ['tags_insight'],
  ];

  register_post_type('insights', $args);
});


/**
 * ==========================================================
 * 2. Registrar Taxonomía: Tags de Insights
 * ==========================================================
 */
add_action('init', function() {

  $labels = [
    'name'              => 'Tags de Insights',
    'singular_name'     => 'Tag de Insight',
    'search_items'      => 'Buscar Tags',
    'all_items'         => 'Todos los Tags',
    'edit_item'         => 'Editar Tag',
    'update_item'       => 'Actualizar Tag',
    'add_new_item'      => 'Agregar nuevo Tag',
    'new_item_name'     => 'Nuevo Tag',
    'menu_name'         => 'Tags de Insights',
  ];

  $args = [
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'         => true,
    'rewrite'           => [
      'slug'       => 'insights-tag',
      'with_front' => false,
    ],
    'show_in_rest'      => true,
    'public'            => true,
  ];

  register_taxonomy('tags_insight', ['insights'], $args);
});


/**
 * ==========================================================
 * 3. Registrar CPT: Casos de Éxito
 * ==========================================================
 */
add_action('init', function() {

  $labels = [
    'name'               => 'Casos de Éxito',
    'singular_name'      => 'Caso de Éxito',
    'menu_name'          => 'Casos de Éxito',
    'name_admin_bar'     => 'Caso de Éxito',
    'add_new'            => 'Añadir nuevo',
    'add_new_item'       => 'Añadir nuevo Caso de Éxito',
    'edit_item'          => 'Editar Caso de Éxito',
    'new_item'           => 'Nuevo Caso de Éxito',
    'view_item'          => 'Ver Caso de Éxito',
    'search_items'       => 'Buscar Casos de Éxito',
    'not_found'          => 'No se encontraron Casos de Éxito',
    'not_found_in_trash' => 'No hay Casos de Éxito en la papelera'
  ];

  $args = [
    'labels'             => $labels,
    'public'             => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'menu_icon'          => 'dashicons-awards',
    'supports'           => ['title', 'thumbnail', 'editor', 'excerpt'],
    'has_archive'        => 'casos-de-exito-posts',
    'rewrite'            => [
      'slug'       => 'casos-de-exito-posts',
      'with_front' => false
    ],
    'show_in_rest'       => true,
    'taxonomies'         => ['tags_caso_exito'], // 👈 Asociamos la nueva taxonomía
  ];

  register_post_type('casos_exito', $args);
});


/**
 * ==========================================================
 * 4. Registrar Taxonomía: Tags de Casos de Éxito
 * ==========================================================
 */
add_action('init', function() {

  $labels = [
    'name'              => 'Tags de Casos de Éxito',
    'singular_name'     => 'Tag de Caso de Éxito',
    'search_items'      => 'Buscar Tags',
    'all_items'         => 'Todos los Tags',
    'edit_item'         => 'Editar Tag',
    'update_item'       => 'Actualizar Tag',
    'add_new_item'      => 'Agregar nuevo Tag',
    'new_item_name'     => 'Nuevo Tag',
    'menu_name'         => 'Tags de Casos de Éxito',
  ];

  $args = [
    'hierarchical'      => false, // Igual que insights
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'         => true,
    'rewrite'           => [
      'slug'       => 'casos-tag',
      'with_front' => false,
    ],
    'show_in_rest'      => true,
    'public'            => true,
  ];

  register_taxonomy('tags_caso_exito', ['casos_exito'], $args);
});


/**
 * ==========================================================
 * 🧩 Solución global: prioridad de páginas sobre CPTs
 * ==========================================================
 */
add_action('registered_post_type', function($post_type, $args) {

  $slug = '';
  if (!empty($args->rewrite['slug'])) {
    $slug = $args->rewrite['slug'];
  } elseif (!empty($post_type)) {
    $slug = $post_type;
  }

  $nativos = ['post', 'page', 'attachment', 'revision', 'nav_menu_item'];
  if (in_array($post_type, $nativos, true)) return;

  if ($slug && get_page_by_path($slug)) {
    global $wp_post_types;
    if (isset($wp_post_types[$post_type])) {
      $wp_post_types[$post_type]->has_archive = false;
      $wp_post_types[$post_type]->rewrite = false;
    }
  }

}, 10, 2);


// 🔁 Forzar regeneración de reglas solo una vez
add_action('init', function() {
  if (get_option('impulsor_cpt_page_conflict_fix') !== 'done') {
    flush_rewrite_rules(false);
    update_option('impulsor_cpt_page_conflict_fix', 'done');
  }
});
