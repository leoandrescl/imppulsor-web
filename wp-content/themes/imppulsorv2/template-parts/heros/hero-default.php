<?php
/**
 * Hero universal — ACF > Destacada > Fallback absoluto
 */

if (!defined('ABSPATH')) exit;

// --- Utilidad: hacer absoluta una ruta (soporta /relativa, http, o ruta de tema) ---
function impulsor_abs_url($path) {
  if (!$path) return '';
  if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) return $path;
  if ($path[0] === '/') return home_url($path); // p.ej. /wp-content/...
  // como último recurso, cuélgalo del tema hijo/activo
  return trailingslashit(get_stylesheet_directory_uri()) . ltrim($path, '/');
}

// --- Resolver ID de la consulta actual de manera segura (singular/archivo) ---
$post_id = get_queried_object_id();

// --- 1) Intentar ACF (si existe) ---
$acf_hero = (function_exists('get_field') && $post_id) ? get_field('hero_imagen', $post_id) : null;
$imagen_destacada = '';

// ACF puede ser array (con ['url']), ID numérico o string URL
if (!empty($acf_hero)) {
  if (is_array($acf_hero) && !empty($acf_hero['url'])) {
    $imagen_destacada = $acf_hero['url'];
  } elseif (is_numeric($acf_hero)) {
    $imagen_destacada = wp_get_attachment_image_url((int)$acf_hero, 'full');
  } elseif (is_string($acf_hero)) {
    $imagen_destacada = $acf_hero;
  }
}

// --- 2) Si aún no hay, usar destacada del post actual (si aplica) ---
if (!$imagen_destacada && $post_id && has_post_thumbnail($post_id)) {
  $imagen_destacada = get_the_post_thumbnail_url($post_id, 'full');
}

// --- 3) Fallback absoluto garantizado ---
if (!$imagen_destacada) {
  $imagen_destacada = impulsor_abs_url('/wp-content/uploads/slider-1.jpg');
} else {
  $imagen_destacada = impulsor_abs_url($imagen_destacada); // normaliza a absoluta por si vino relativa
}

// --- Título y URL para compartir (funciona en singular y archivos) ---
$titulo = function_exists('imppulsor_get_hero_title')
  ? imppulsor_get_hero_title($post_id)
  : get_the_title($post_id);
$current_url = (is_singular() && $post_id) ? get_permalink($post_id) : (home_url( add_query_arg([], $_SERVER['REQUEST_URI'] ?? '/') ));
$url = rawurlencode($current_url);
?>

<section class="hero-wrap">
  <div class="hero-section fullwidth fade-in"
       style="background-image:url('<?php echo esc_url($imagen_destacada); ?>');">

    <div class="hero-content container">
      <div class="inner-container">
        <h1 class="hero-title"><?php echo esc_html($titulo ?: get_bloginfo('name')); ?></h1>
      </div>
    </div>

    <!-- Social links INSIDE the hero -->
    <div class="hero-social fade-in">
      <a href="https://www.linkedin.com/company/imppulsor/"
        target="_blank" rel="noopener" aria-label="Share on LinkedIn" class="hero-social__link">
        <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24" style="filter: invert(1);">
      </a>
      <a href="https://x.com/imppulsor"
        target="_blank" rel="noopener" aria-label="Share on X" class="hero-social__link">
        <img src="/wp-content/uploads/icon-x.png" alt="X (Twitter)" width="24" height="24" style="filter: invert(1);">
      </a>
    </div>

  </div>
</section>


