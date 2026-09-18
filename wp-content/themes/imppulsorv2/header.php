<?php
/**
 * Header global – Imppulsor v2 (con modal de búsqueda)
 */
if (!defined('ABSPATH')) exit;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="header-inner container">

    <!-- MOBILE MENU BUTTON -->
    <button class="menu-toggle" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>

    <!-- LOGO -->
    <div class="logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo-imppulsor.svg" alt="Imppulsor">
      </a>
    </div>

    <!-- MAIN MENU -->
    <nav class="main-nav">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'menu-list',
          'depth'          => 0,
          'walker'         => new Imppulsor_MegaWalker,
        ]);
      ?>
    </nav>

    <!-- SEARCH (icon only: opens the fullscreen modal) -->
    <button type="button" class="header-search-toggle" aria-label="Search" aria-controls="searchModal">
      <i data-lucide="search"></i>
    </button>

    <!-- BUTTONS -->
    <div class="header-buttons">
      <a href="/contact" class="btn btn-terciario">Contact</a>
      <a href="https://dmc.imppulsor.com/" class="btn btn-secundario" target="_blank" rel="noopener">Dashboard</a>
    </div>

    <!-- GOOGLE TRANSLATE -->
    <div class="header-lang">
      <?php echo do_shortcode('[gtranslate]'); ?>
    </div>
  </div>

  <!-- MOBILE MENU -->
  <div class="mobile-menu-overlay"></div>
  <nav class="mobile-menu">
    <button class="mobile-close" aria-label="Close menu"><i data-lucide="x"></i></button>
    <?php
      $imppulsor_mobile_menu_lang = static function ($items, $args) {
        if (empty($args->menu_class) || $args->menu_class !== 'mobile-menu-list') {
          return $items;
        }
        $lang = do_shortcode('[gtranslate]');
        if ($lang === '') {
          return $items;
        }
        $items .= '<li class="menu-item menu-item-language mobile-menu-lang" aria-label="' . esc_attr__('Select language', 'imppulsorv2') . '">' . $lang . '</li>';
        return $items;
      };
      add_filter('wp_nav_menu_items', $imppulsor_mobile_menu_lang, 10, 2);
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'mobile-menu-list',
        'depth'          => 0,
      ]);
      remove_filter('wp_nav_menu_items', $imppulsor_mobile_menu_lang, 10);
    ?>
  </nav>
</header>


<!-- Fullscreen search modal -->
<div id="searchModal" class="searchfs" aria-hidden="true">
  <div class="searchfs__backdrop" data-close="1"></div>

  <div class="searchfs__stage" role="dialog" aria-modal="true">
    <button class="searchfs__close" type="button" aria-label="Close" data-close="1">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
    </button>

    <form class="searchfs__form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" name="s" placeholder="Type and press Enter…" autocomplete="off" aria-label="Search">
      <button type="submit" class="searchfs__submit" aria-label="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
        <span>Search</span>
      </button>
    </form>
  </div>
</div>
<!-- Fullscreen search modal end -->


<main id="site-main">




