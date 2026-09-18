<?php
/**
 * Bloque: Cómo ayudamos a nuestros clientes
 * Tipo: Bloque Reutilizable ACF
 */
if (!defined('ABSPATH'))
  exit;

// Obtiene el bloque global por su slug (usa el slug del bloque reutilizable)
$bloque = get_page_by_path('bloque-como-ayudamos-a-nuestros-clientes', OBJECT, 'bloques_globales');
if (!$bloque)
  return;

$ID = $bloque->ID;

// Mostrar solo si tiene contenido
if (get_field('bloque_2_titulo', $ID)): ?>
  <section class="bloque-como-ayudamos bloque-home bloque-2 text-white bg-light-blue reveal reveal-up">
    <div class="container grid-2 align-center">

      <div class="py-60 px-0">
        <h2 class="heading-lg"><?php the_field('bloque_2_titulo', $ID); ?></h2>
        <p>Aplicamos diagnósticos de madurez empresarial orientados revelar patrones ocultos entre sus problemas operacionales más complejos y sus causas raíz, identificando zonas prioritarias de intervención con base en evidencia.</p>

        <p>Complementamos esta mirada con benchmarking de capacidades empresariales y marcos de ejecución estratégica, para priorizar decisiones, orientar recursos críticos y convertir hallazgos diagnósticos en avances operacionales medibles.
        </p>
        <!-- Desktop Button -->
        <a href="<?php the_field('bloque_2_boton_url', $ID); ?>" class="btn-arrow btn-arrow-dark desktop-only-cta">
          <?php the_field('bloque_2_boton_label', $ID); ?>
        </a>

        <!-- Mobile Button (Moved below text) -->
        <a href="<?php the_field('bloque_2_boton_url', $ID); ?>" class="btn-arrow btn-arrow-dark mobile-only-cta">
          <?php the_field('bloque_2_boton_label', $ID); ?>
        </a>
      </div>

      <?php $img = get_field('bloque_2_imagen', $ID); ?>
      <?php if ($img): ?>
        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="">
      <?php endif; ?>

    </div>
  </section>
<?php endif; ?>

<style>
  /* 1. Contenedor padre relativo para posicionar la imagen absoluta respecto a él */
  .bloque-como-ayudamos {
    position: relative;
    overflow: hidden;
    /* Evita scroll horizontal */
  }

  /* 2. Aseguramos que el contenido (texto) quede por encima de la imagen */
  .bloque-como-ayudamos .container {
    position: relative;
    z-index: 2;
  }

  /* 3. LA CLAVE: Sacamos la imagen del flujo normal */
  .bloque-como-ayudamos img {
    position: absolute;
    top: 0;
    left: 50%;
    /* La imagen empieza EXACTAMENTE en la mitad de la pantalla */
    width: 50vw;
    /* Ocupa el 50% del ancho del Viewport (pantalla completa) */
    height: 100%;
    /* Se estira a todo el alto de la sección */
    object-fit: cover;
    /* Recorte perfecto sin deformar */
    z-index: 1;
  }

  /* 4. Ajuste para Móviles (Vital para que no se rompa) */
  @media (max-width: 992px) {
    .bloque-como-ayudamos img {
      position: relative;
      left: auto;
      width: calc(100% + 40px);
      max-width: calc(100% + 40px);
      height: 420px;
      left: -20px;
    }

    /* En móvil quitamos las columnas para que quede uno debajo del otro */
    .bloque-como-ayudamos .grid-2 {
      grid-template-columns: 1fr;
    }
  }
</style>