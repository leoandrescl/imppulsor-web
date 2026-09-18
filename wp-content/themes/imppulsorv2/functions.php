<?php
/**
 * Funciones principales del tema Imppulsor v2
 */

// Cargar módulos del directorio /inc/
require_once get_stylesheet_directory() . '/inc/setup.php';
require_once get_stylesheet_directory() . '/inc/enqueue.php';
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';
require_once get_stylesheet_directory() . '/inc/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/acf-fields.php';
require_once get_stylesheet_directory() . '/inc/hero-global.php';
// Editor PHP por página (solo admin, post_type=page; sin cambios en front)
if (is_admin()) {
  require_once get_stylesheet_directory() . '/inc/page-php-editor.php';
}

/* -----------------------------------------------------------
 * Mega menu: helper para la tarjeta de insight (cacheado)
 * ----------------------------------------------------------- */
function imppulsor_megamenu_insight_col_html()
{
  static $card_html = null;
  if ($card_html !== null)
    return $card_html;

  $insight = new WP_Query([
    'post_type' => 'insights',
    'posts_per_page' => 1,
    'orderby' => 'rand',
    'no_found_rows' => true,
    'post_status' => 'publish',
  ]);

  ob_start();
  ?>
  <div class="mega__col mega__col--insight">
    <?php if ($insight->have_posts()):
      $insight->the_post(); ?>
      <article class="mega-insight">
        <a class="mega-insight__thumb" href="<?php the_permalink(); ?>">
          <?php if (has_post_thumbnail()) {
            the_post_thumbnail('medium_large');
          } else { ?>
            <div class="mega-insight__thumb--ph"></div>
          <?php } ?>
        </a>

        <h4 class="mega-insight__title">
          <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 16); ?></a>
        </h4>

        <a class="btn btn-borde" href="<?php the_permalink(); ?>">Leer más</a>
      </article>
      <?php wp_reset_postdata(); endif; ?>

    <?php
    $archive = get_post_type_archive_link('insights');
    if ($archive): ?>
      <a class="mega-insight__all btn btn-borde" href="<?php echo esc_url($archive); ?>">
        Ver todos los insights
      </a>
    <?php endif; ?>
  </div>
  <?php
  $card_html = ob_get_clean();
  return $card_html;
}

/* -----------------------------------------------------------
 * Mega menu walker – con clases por nivel (PHP 8+ compatible)
 * ----------------------------------------------------------- */
class Imppulsor_MegaWalker extends Walker_Nav_Menu
{

  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {

    // --- Clases base del <li> ---
    $classes = empty($item->classes) ? [] : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = 'menu-item-level-' . ($depth + 1); // 👈 clase por nivel

    // Marca los padres del primer nivel con mega menú
    if ($depth === 0 && !empty($args->has_children)) {
      $classes[] = 'has-mega';
    }

    $class_names = join(' ', array_map('sanitize_html_class', $classes));
    $output .= '<li class="' . $class_names . '">';

    // --- Atributos del enlace ---
    $atts = ' href="' . esc_attr(!empty($item->url) ? $item->url : '#') . '"';
    $atts .= ' class="menu-link menu-link-level-' . ($depth + 1) . '"'; // 👈 clase por nivel en <a>

    $title = apply_filters('the_title', $item->title, $item->ID);
    $output .= '<a' . $atts . '>' . $title . '</a>';
  }

  // 🔧 firma corregida para PHP 8+
  public function end_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $output .= '</li>';
  }

  // 🔧 firma corregida para PHP 8+
  public function start_lvl(&$output, $depth = 0, $args = null)
  {
    $level_class = 'menu-level-' . ($depth + 2); // 👈 ul por nivel

    if ($depth === 0) {
      // Primer nivel: estructura del mega
      $output .= '<div class="mega" role="region" aria-label="Submenú ampliado"><div class="mega__inner container">';
      $output .= '<div class="mega__col mega__col--menu"><ul class="mega__menu ' . $level_class . '">';
    } else {
      // Subniveles normales
      $output .= '<ul class="sub-menu ' . $level_class . '">';
    }
  }

  // 🔧 firma corregida para PHP 8+
  public function end_lvl(&$output, $depth = 0, $args = null)
  {
    if ($depth === 0) {
      $output .= '</ul></div>';
      $output .= imppulsor_megamenu_insight_col_html();
      $output .= '</div></div>';
    } else {
      $output .= '</ul>';
    }
  }

  // 🔧 firma corregida para PHP 8+
  public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '')
  {
    if (!$element)
      return;

    $id_field = $this->db_fields['id'];
    if (isset($args[0]) && is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}



/* -----------------------------------------------------------
 * Generar megamenú automáticamente
 * ----------------------------------------------------------- */
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {

  if ($args->theme_location === 'primary' && in_array('menu-item-has-children', $item->classes) && $depth === 0) {

    $item_output .= '
        <div class="mega-dropdown">
          <div class="mega-inner container">
            <div class="mega-links">
              ' . wp_nav_menu([
        'menu' => $args->menu->term_id,
        'container' => false,
        'menu_class' => '',
        'depth' => 1,
        'echo' => false,
        'fallback_cb' => false,
        'items_wrap' => '<ul>%3$s</ul>',
      ]) . '
            </div>
            <div class="mega-insight">
              ' . imppulsor_random_insight() . '
            </div>
          </div>
        </div>';
  }

  return $item_output;
}, 10, 4);

/* -----------------------------------------------------------
 * Función auxiliar: mostrar insight aleatorio en el megamenú
 * ----------------------------------------------------------- */
function imppulsor_random_insight()
{
  $query = new WP_Query([
    'post_type' => 'insights',
    'posts_per_page' => 1,
    'orderby' => 'rand',
  ]);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
      $title = get_the_title();
      $excerpt = wp_trim_words(get_the_excerpt(), 15);
      $link = get_permalink();
      $output = '
            <div>
              ' . ($img ? '<img src="' . esc_url($img) . '" alt="' . esc_attr($title) . '">' : '') . '
              <h4>' . esc_html($title) . '</h4>
              <p>' . esc_html($excerpt) . '</p>
              <a href="' . esc_url($link) . '" class="btn-outline">Leer más</a>
            </div>';
    }
    wp_reset_postdata();
    return $output;
  }
    return '<p>No insights available.</p>';
}

// lucide
function impulsor_enqueue_icons()
{
  wp_enqueue_script(
    'lucide-icons',
    'https://unpkg.com/lucide@latest/dist/umd/lucide.min.js',
    [],
    null,
    true
  );
}
add_action('wp_enqueue_scripts', 'impulsor_enqueue_icons');

// --- Imagen robusta para ACF: URL, ID o Array -> URL ---
function impulsor_get_image_url($value)
{
  if (empty($value))
    return '';
  // Si viene un ID numérico
  if (is_numeric($value)) {
    $u = wp_get_attachment_image_url((int) $value, 'full');
    return $u ? $u : '';
  }
  // Si viene array de ACF {url, id/ID, alt...}
  if (is_array($value)) {
    if (!empty($value['url']))
      return esc_url_raw($value['url']);
    if (!empty($value['id']))
      return wp_get_attachment_image_url((int) $value['id'], 'full') ?: '';
    if (!empty($value['ID']))
      return wp_get_attachment_image_url((int) $value['ID'], 'full') ?: '';
    return '';
  }
  // Si ya es string (URL)
  return esc_url_raw($value);
}

// Imprime <img> seguro desde un field ACF
function impulsor_print_image($field_name, $attrs = [])
{
  $val = get_field($field_name);
  $src = impulsor_get_image_url($val);
  if (!$src)
    return;

  $defaults = ['alt' => '', 'class' => '', 'loading' => 'lazy', 'decoding' => 'async'];
  $attrs = array_merge($defaults, $attrs);

  $attr_str = '';
  foreach ($attrs as $k => $v) {
    if ($v === '')
      continue;
    $attr_str .= ' ' . $k . '="' . esc_attr($v) . '"';
  }
  echo '<img src="' . esc_url($src) . '"' . $attr_str . '>';
}

/**
 * Inserta automáticamente la elipse debajo del hero
 */
add_action('template_redirect', function () {
  ob_start(function ($content) {

    // Detecta el cierre de <section class="hero-section ...">
    $pattern = '/(<section[^>]*class="[^"]*hero-section[^"]*"[^>]*>.*?<\/section>)/is';

    // Bloque a insertar después del hero
    $ellipse = '<div class="ellipse-hero fade-in">
  <img src="/wp-content/uploads/ellipse-hero.svg" alt="" class="ellipse-hero__img">
</div>';

    // Inserta el div justo después del hero
    $content = preg_replace($pattern, '$1' . $ellipse, $content, 1);

    return $content;
  });
});

/**
 * URL de fondo para el hero inyectado por buffer (misma prioridad que hero-default.php).
 *
 * @param int $post_id ID del objeto consultado (página, etc.) o 0.
 * @return string URL escapada para atributo style.
 */
function imppulsor_fallback_hero_background_url($post_id) {
  $post_id = (int) $post_id;
  $imagen_destacada = '';

  if (function_exists('get_field') && $post_id) {
    $acf_hero = get_field('hero_imagen', $post_id);
    if (!empty($acf_hero)) {
      if (is_array($acf_hero) && !empty($acf_hero['url'])) {
        $imagen_destacada = $acf_hero['url'];
      } elseif (is_numeric($acf_hero)) {
        $imagen_destacada = (string) (wp_get_attachment_image_url((int) $acf_hero, 'full') ?: '');
      } elseif (is_string($acf_hero)) {
        $imagen_destacada = $acf_hero;
      }
    }
  }

  if (!$imagen_destacada && $post_id && has_post_thumbnail($post_id)) {
    $imagen_destacada = (string) (get_the_post_thumbnail_url($post_id, 'full') ?: '');
  }

  if (!$imagen_destacada) {
    $imagen_destacada = home_url('/wp-content/uploads/slider-1.jpg');
  }

  if ($imagen_destacada !== '' && strpos($imagen_destacada, 'http') !== 0) {
    if (isset($imagen_destacada[0]) && $imagen_destacada[0] === '/') {
      $imagen_destacada = home_url($imagen_destacada);
    } else {
      $imagen_destacada = trailingslashit(get_stylesheet_directory_uri()) . ltrim($imagen_destacada, '/');
    }
  }

  return esc_url($imagen_destacada);
}

/**
 * Hero fallback automático — estructura con ellipse fuera del section
 */
add_action('template_redirect', function () {
  if (is_admin() || is_feed() || defined('REST_REQUEST') || is_front_page())
    return;

  ob_start(function ($html) {


    if (strpos($html, 'hero-section') !== false)
      return $html;

    $post_id = get_queried_object_id();

    $bg_url = imppulsor_fallback_hero_background_url($post_id);

    if (is_search()) {
      $titulo = 'Search results for: ' . get_search_query();
    } elseif (is_404()) {
      $titulo = 'Page not found';
    } elseif (is_archive()) {
      $titulo = get_the_archive_title();
    } elseif ($post_id) {
      $titulo = function_exists('imppulsor_get_hero_title')
        ? imppulsor_get_hero_title($post_id)
        : get_the_title($post_id);
    } else {
      $titulo = get_bloginfo('name');
    }

    $hero_html = '
    <section class="hero-wrap mb-60">
      <div class="hero-section fullwidth fade-in"
           style="background-image:url(' . $bg_url . ');">
        <div class="hero-content container">
          <h1 class="hero-title">' . esc_html(wp_strip_all_tags($titulo)) . '</h1>
        </div>
      </div>

      <div class="hero-social fade-in">
    <a href="https://www.linkedin.com/company/imppulsor/"
      target="_blank" rel="noopener" aria-label="Compartir en LinkedIn" class="hero-social__link">
      <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24" style="filter: invert(1);">
    </a>
    <a href="https://x.com/imppulsor"
      target="_blank" rel="noopener" aria-label="Compartir en X" class="hero-social__link">
      <img src="/wp-content/uploads/icon-x.png" alt="X (Twitter)" width="24" height="24" style="filter: invert(1);">
    </a>
  </div>
      <div class="ellipse-hero">
      <img src="' . esc_url(home_url('/wp-content/uploads/ellipse-bg.svg')) . '" alt="" class="ellipse-hero__img">
    </div>
    </section>';

    $html = preg_replace('/<\/header>/i', '</header>' . $hero_html, $html, 1);
    return $html;
  });
});






/**
 * ==========================================================
 *  Desactiva redirecciones canónicas cuando hay conflicto
 * entre un slug de página y la base de un CPT (como /insights/)
 * ==========================================================
 */
add_action('template_redirect', function () {
  if (is_admin())
    return;

  global $wp_query, $post;

  // Evitar interferencias
  remove_action('template_redirect', 'redirect_canonical');

  // Detectar páginas tipo /page/2/ y redirigir una sola vez
  $uri = $_SERVER['REQUEST_URI'] ?? '';
  if (preg_match('#/page/([0-9]+)/?$#', $uri, $m)) {
    $paged = intval($m[1]);
    $base = preg_replace('#/page/[0-9]+/?$#', '/', $uri);

    // Solo redirige si existe una página estática con ese slug base
    $page_obj = get_page_by_path(trim($base, '/'));
    if ($page_obj && $page_obj->post_type === 'page') {
      $url = home_url(trailingslashit(trim($base, '/')));
      wp_redirect(add_query_arg('paged', $paged, $url), 302);
      exit;
    }
  }
}, 0);




/*************************************************/
/*************************************************/
/******************ZOHO PAGESENSE*******************/
/*************************************************/
/*************************************************/
add_action('wp_head', 'inject_zoho_pagesense', 20);

function inject_zoho_pagesense() {
    ?>
    <script type="text/javascript">
        (function(w,s){
            var e=document.createElement("script");
            e.type="text/javascript";
            e.async=true;
            e.src="https://cdn-eu.pagesense.io/js/imppulsorlimited492/5a076cbbc913463b82d7cefd6eb3c417.js";
            var x=document.getElementsByTagName("script")[0];
            x.parentNode.insertBefore(e,x);
        })(window,"script");
    </script>
    <?php
}
/*************************************************/
/*************************************************/
/******************ZOHO SALESIQ*******************/
/*************************************************/
/*************************************************/
add_action('wp_footer', 'inject_zoho_salesiq', 20);

function inject_zoho_salesiq() {
    ?>
    <script type="text/javascript" id="zsiqchat">
        var $zoho = $zoho || {};
        $zoho.salesiq = $zoho.salesiq || { 
            widgetcode: "siq5a1a43b0e5860a351930b3eed3bb650400ac55c949a1544f60d7bf0c2ba1caaf", 
            values: {}, 
            ready: function(){} 
        };
        var d = document;
        var s = d.createElement("script");
        s.type = "text/javascript";
        s.id = "zsiqscript";
        s.defer = true;
        s.src = "https://salesiq.zohopublic.eu/widget?wc=siq5a1a43b0e5860a351930b3eed3bb650400ac55c949a1544f60d7bf0c2ba1caaf";
        var t = d.getElementsByTagName("script")[0];
        t.parentNode.insertBefore(s, t);
    </script>
    <?php
}
