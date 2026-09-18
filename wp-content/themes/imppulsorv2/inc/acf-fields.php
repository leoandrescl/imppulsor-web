<?php
/**
 * Registro de campos ACF vía código
 * para asegurar disponibilidad sin depender de la DB
 */

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_insights_custom_thumb',
        'title' => 'Personalización Insight',
        'fields' => array(
            array(
                'key' => 'field_imagen_miniatura_insights',
                'label' => 'Imagen Miniatura Insights',
                'name' => 'imagen_miniatura_insights',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => 'Esta imagen se usará en grids y carruseles en lugar de la destacada si existe.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'insights',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

    // Campo para Casos de Éxito
    acf_add_local_field_group(array(
        'key' => 'group_casos_exito_custom_thumb',
        'title' => 'Personalización Caso de Éxito',
        'fields' => array(
            array(
                'key' => 'field_imagen_miniatura_casos',
                'label' => 'Imagen Miniatura Casos',
                'name' => 'imagen_miniatura_casos',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => 'Esta imagen se usará en grids y carruseles en lugar de la destacada si existe.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'casos_exito',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    // Banners hero globales (CPT banner_hero)
    acf_add_local_field_group(array(
        'key' => 'group_banner_hero',
        'title' => 'Contenido del banner',
        'fields' => array(
            array(
                'key' => 'field_banner_pagina_destino',
                'label' => 'Página donde se muestra',
                'name' => 'pagina_destino',
                'type' => 'post_object',
                'instructions' => 'Elige la página. Para varios slides en la misma página, crea varios banners con la misma página y ordena con el campo «Orden» del listado.',
                'required' => 1,
                'post_type' => array('page'),
                'taxonomy' => '',
                'return_format' => 'id',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_banner_etiqueta',
                'label' => 'Etiqueta (badge)',
                'name' => 'etiqueta',
                'type' => 'text',
                'instructions' => 'Texto corto encima del título (ej. categoría).',
                'required' => 0,
            ),
            array(
                'key' => 'field_banner_linea_superior',
                'label' => 'Línea superior',
                'name' => 'linea_superior',
                'type' => 'text',
                'instructions' => 'Ej. año | tema (texto libre).',
                'required' => 0,
            ),
            array(
                'key' => 'field_banner_titulo_hero',
                'label' => 'Título en el hero',
                'name' => 'titulo_hero',
                'type' => 'text',
                'instructions' => 'Si está vacío se usa el título del banner (campo arriba).',
                'required' => 0,
            ),
            array(
                'key' => 'field_banner_bajada',
                'label' => 'Bajada',
                'name' => 'bajada',
                'type' => 'textarea',
                'rows' => 4,
                'required' => 0,
            ),
            array(
                'key' => 'field_banner_autor_linea',
                'label' => 'Autor o línea de crédito',
                'name' => 'autor_linea',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_banner_cta_texto',
                'label' => 'Texto del botón (CTA)',
                'name' => 'cta_texto',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_banner_cta_url',
                'label' => 'URL del botón (CTA)',
                'name' => 'cta_url',
                'type' => 'url',
                'required' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'banner_hero',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'description' => 'Imagen derecha: usa la imagen destacada del banner. Orden del carrusel: atributo «Orden» en el editor (igual que las páginas).',
    ));

    // Testimonios: país editable por testimonio (bloque «La voz de nuestros clientes»)
    acf_add_local_field_group(array(
        'key' => 'group_testimonio_datos',
        'title' => 'Datos del testimonio',
        'fields' => array(
            array(
                'key' => 'field_testimonio_pais',
                'label' => 'País o ubicación',
                'name' => 'pais_testimonio',
                'type' => 'text',
                'instructions' => 'Se muestra bajo el nombre del autor en el carrusel de testimonios (ej. Chile, América Latina). Si está vacío, se usa el país del Autor relacionado.',
                'required' => 0,
                'placeholder' => 'Ej. Chile',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonios',
                ),
            ),
        ),
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'show_in_rest' => 0,
    ));

    // Autores: país de respaldo si el testimonio no lo define
    acf_add_local_field_group(array(
        'key' => 'group_autor_datos_btvc',
        'title' => 'Datos del autor (testimonios)',
        'fields' => array(
            array(
                'key' => 'field_autor_pais',
                'label' => 'País o ubicación',
                'name' => 'pais_autor',
                'type' => 'text',
                'instructions' => 'Respaldo cuando el testimonio no tiene «País o ubicación» propio.',
                'required' => 0,
                'placeholder' => 'Ej. Chile',
            ),
            array(
                'key' => 'field_autor_ubicacion',
                'label' => 'Ubicación (alternativo)',
                'name' => 'ubicacion_autor',
                'type' => 'text',
                'instructions' => 'Opcional. Si «País o ubicación» está vacío, también se usa este campo.',
                'required' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'autores',
                ),
            ),
        ),
        'menu_order' => 10,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'show_in_rest' => 0,
    ));

endif;

/**
 * País/ubicación mostrado en testimonios: primero el CPT testimonio, luego el autor.
 *
 * @param int $post_id   ID del post testimonios.
 * @param int $autor_id  ID del CPT autores (opcional).
 */
function imppulsor_get_testimonio_pais( $post_id = 0, $autor_id = 0 ) {
    if ( ! function_exists( 'get_field' ) ) {
        return '';
    }

    $post_id  = (int) $post_id;
    $autor_id = (int) $autor_id;

    if ( $post_id > 0 ) {
        $pais = trim( (string) get_field( 'pais_testimonio', $post_id ) );
        if ( $pais !== '' ) {
            return $pais;
        }
    }

    if ( $autor_id > 0 ) {
        $pais = trim( (string) get_field( 'pais_autor', $autor_id ) );
        if ( $pais !== '' ) {
            return $pais;
        }
        $pais = trim( (string) get_field( 'ubicacion_autor', $autor_id ) );
        if ( $pais !== '' ) {
            return $pais;
        }
    }

    return '';
}
