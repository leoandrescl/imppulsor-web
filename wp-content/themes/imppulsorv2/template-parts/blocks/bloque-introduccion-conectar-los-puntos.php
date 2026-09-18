<?php
/**
 * Bloque: Introducción – Conectar los puntos
 * Tipo: Bloque Reutilizable ACF
 */
if (!defined('ABSPATH'))
  exit;

// Obtiene el bloque global por su slug (usa el slug real en minúsculas y guiones)
$bloque = get_page_by_path('bloque-introduccion-conectar-los-puntos-es-lo-que-hacemos', OBJECT, 'bloques_globales');
if (!$bloque)
  return;

$ID = $bloque->ID;

// Mostrar solo si tiene contenido
if (get_field('bloque_1_titulo', $ID)): ?>
  <section class="section bloque-home bloque-1 bg-gradient reveal reveal-up">
    <div class="container grid-2--2fr-3fr  text-white">
      <div>
        <h2 class="heading-lg"><?php the_field('bloque_1_titulo', $ID); ?></h2>
        <!-- Desktop Button -->
        <a href="<?php the_field('bloque_1_boton_url', $ID); ?>" class="btn-arrow desktop-only-cta">
          <?php the_field('bloque_1_boton_label', $ID); ?>
        </a>
      </div>
      <div>
        <?php the_field('bloque_1_texto', $ID); ?>

        <!-- Mobile Button (Moved below text) -->
        <a href="<?php the_field('bloque_1_boton_url', $ID); ?>" class="btn-arrow mobile-only-cta">
          <?php the_field('bloque_1_boton_label', $ID); ?>
        </a>
      </div>
    </div>
  </section>
<?php endif; ?>