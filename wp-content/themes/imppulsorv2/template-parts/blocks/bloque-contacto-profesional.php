<?php
/**
 * Block: Professional Contact
 * - Reusable across sections
 * - Layout: 2 columns (image left / form right) inside .container
 */
if (!defined('ABSPATH')) {
    exit;
}

$imagen = get_field('imagen_contacto') ?: '/wp-content/uploads/contacto-profesional.jpg';
$form   = get_field('shortcode_form') ?: '[contact-form-7 id="eae9bc5" title="Formulario de contacto trabaja con nosotros"]';
?>

<section class="section bloque-contacto-profesional bloque-contacto-profesional--light reveal reveal-up">
  <div class="container">
    <div class="grid-2 gap-60 bloque-contacto-profesional__grid">

      <div class="bloque-contacto-profesional__media contacto-profesional__img">
        <img
          src="<?php echo esc_url($imagen); ?>"
          alt=""
          class="bloque-contacto-profesional__img w-100 object-cover"
          loading="lazy"
          decoding="async"
        >
      </div>

      <div class="contacto-profesional__contenido">
        <div class="contacto-profesional__form align-center">
          <?php echo do_shortcode($form); ?>
        </div>
      </div>

    </div>
  </div>
</section>
