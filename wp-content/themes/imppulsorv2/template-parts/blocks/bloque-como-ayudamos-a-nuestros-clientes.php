<?php
/**
 * Block: How we help our clients
 * Type: Reusable ACF Block
 */
if (!defined('ABSPATH')) {
    exit;
}

$bloque = get_page_by_path('bloque-como-ayudamos-a-nuestros-clientes', OBJECT, 'bloques_globales');
if (!$bloque) {
    return;
}

$ID = $bloque->ID;

if (!get_field('bloque_2_titulo', $ID)) {
    return;
}

$img = get_field('bloque_2_imagen', $ID);
?>
  <section class="bloque-como-ayudamos bloque-home bloque-2 text-white bg-light-blue py-60 reveal reveal-up">
    <div class="container px-0-mob grid-2 align-center">

      <div class="px-0 bloque-como-ayudamos__content">
        <h2 class="heading-lg"><?php the_field('bloque_2_titulo', $ID); ?></h2>
        <p>We apply business maturity diagnostics designed to reveal hidden patterns between your most complex operational challenges and their root causes, identifying priority areas for intervention based on evidence.</p>

        <p>We complement this perspective with business capability benchmarking and strategic execution frameworks to prioritize decisions, direct critical resources, and turn diagnostic findings into measurable operational progress.
        </p>
        <a href="https://imppulsor.com/diagnosticos/" class="btn-arrow btn-arrow-dark mt-20-mob">
          Learn more about diagnostics
        </a>
      </div>
 
      <?php if ($img) : ?>
        <div class="bloque-como-ayudamos__media">
          <img
            src="<?php echo esc_url($img['url']); ?>"
            alt="<?php echo esc_attr($img['alt'] ?: ''); ?>"
            class="bloque-como-ayudamos__img w-100 object-cover"
            loading="lazy"
            decoding="async"
          >
        </div>
      <?php endif; ?>

    </div>
  </section>

<style>
  .bloque-como-ayudamos__content,
  .bloque-como-ayudamos__media {
    min-width: 0;
  }

  .bloque-como-ayudamos__img {
    display: block;
    width: 100%;
    max-width: 100%;
    height: auto;
    aspect-ratio: 4 / 3;
    object-fit: cover;
    object-position: center;
  }

  @media (max-width: 992px) {
    .bloque-como-ayudamos__img {
      aspect-ratio: 16 / 10;
    }
  }
</style>
