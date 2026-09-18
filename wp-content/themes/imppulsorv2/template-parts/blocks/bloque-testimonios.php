<?php
/**
 * Bloque: Testimonios (Lógica de Variedad + Repetidos al final)
 */

if (!defined('ABSPATH')) exit;

// 1. Obtenemos TODOS los testimonios
$query = new WP_Query([
  'post_type'      => 'testimonios',
  'posts_per_page' => -1, // Traemos todos para poder ordenarlos
  'post_status'    => 'publish',
]);

if (!$query->have_posts()) return;

$all_posts = $query->posts;
$grupos_por_empresa = [];
$sin_empresa = [];

// 2. Clasificamos los posts según la empresa (ACF)
foreach ($all_posts as $p) {
    $empresa_nombre = '';
    
    // Lógica para obtener el nombre de la empresa sin imprimirlo aún
    $autor_rel = get_field('autor_relacionado', $p->ID);
    if (is_array($autor_rel) && !empty($autor_rel)) {
        $first = $autor_rel[0];
        $autor_id = is_object($first) ? $first->ID : (is_array($first) ? $first['ID'] : $first);
        if ($autor_id) {
            $empresa_nombre = get_field('empresa_autor', $autor_id);
        }
    }

    // Limpiamos espacios y si no tiene empresa, va a un grupo aparte
    $empresa_nombre = trim((string)$empresa_nombre);

    if (!empty($empresa_nombre)) {
        $grupos_por_empresa[$empresa_nombre][] = $p;
    } else {
        $sin_empresa[] = $p; // Testimonios sin empresa asignada
    }
}

// 3. Creamos las listas de orden
$lista_principal = []; // Aquí va el primero de cada empresa
$lista_sobrante  = []; // Aquí van los repetidos

// Barajamos el orden de las empresas para que sea random qué empresa sale primero
$nombres_de_empresas = array_keys($grupos_por_empresa);
shuffle($nombres_de_empresas);

foreach ($nombres_de_empresas as $empresa) {
    // Barajamos los testimonios DENTRO de esa empresa (para que no salga siempre el mismo empleado)
    shuffle($grupos_por_empresa[$empresa]);
    
    // Tomamos el primero para la lista principal
    $lista_principal[] = array_shift($grupos_por_empresa[$empresa]);
    
    // Si quedan más, van a la lista de sobrantes (al final)
    if (!empty($grupos_por_empresa[$empresa])) {
        $lista_sobrante = array_merge($lista_sobrante, $grupos_por_empresa[$empresa]);
    }
}

// Barajamos también los sobrantes y los sin empresa para que el final no sea monótono
shuffle($lista_sobrante);
shuffle($sin_empresa);

// 4. Fusionamos todo: 
// [1 de cada empresa] + [Los que no tienen empresa] + [Los repetidos al final]
$posts_ordenados = array_merge($lista_principal, $sin_empresa, $lista_sobrante);

?>

<section class="bloque-testimonios reveal reveal-up bg-dark text-white">
  <div class="container py-60">

    <h2 class="heading-lg mb-20">La voz de nuestros <br> clientes</h2>

    <div class="testimonios-slider-wrapper">

      <div class="slider-arrows mb-20 flex justify-end gap-10">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

      <div class="swiper testimonios-slider">
        <div class="swiper-wrapper">
          
          <?php 
          // IMPORTANTE: Usamos foreach sobre nuestro array ordenado, no el while standard
          foreach ($posts_ordenados as $post) : 
            setup_postdata($post); 
          ?>

            <?php
              // --- Tu lógica original de visualización ---
              $subtitulo = get_field('subtitulo_testimonio');
              $autor_rel = get_field('autor_relacionado');
              $autor_id = null;

              if (is_array($autor_rel) && !empty($autor_rel)) {
                $first = $autor_rel[0];
                $autor_id = is_object($first) ? $first->ID : (is_array($first) ? $first['ID'] : $first);
              }

              $nombre_autor = $autor_id ? get_the_title($autor_id) : '';
              $empresa_autor = $autor_id ? get_field('empresa_autor', $autor_id) : '';
              $linkedin_autor = $autor_id ? get_field('linkedin_autor', $autor_id) : '';
            ?>

            <div class="swiper-slide testimonio-item">
              <div class="grid-2 gap-0 align-center">

                <div>
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', ['class' => 'w-100']); ?>
                  <?php else : ?>
                    <div class="w-100" style="height:250px;background:#ccc;"></div>
                  <?php endif; ?>
                </div>

                <div class="">

                  <?php if ($nombre_autor) : ?>
                    <h3 class="heading-lg mb-10 mt-20 pl-30"><?php echo esc_html($nombre_autor); ?></h3>
                  <?php endif; ?>

                  <?php if ($empresa_autor || $linkedin_autor) : ?>
                    <div class="d-flex justify-between align-center mb-20 pl-30">
                      <p class="mb-0">
                        <?php echo esc_html($empresa_autor); ?>
                      </p>
                      <?php if ($linkedin_autor) : ?>
                        <a href="<?php echo esc_url($linkedin_autor); ?>" target="_blank" rel="noopener" class="text-white text-bold">
                          in
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($subtitulo) : ?>
                    <p class="text-blue mb-10"><?php echo esc_html($subtitulo); ?></p>
                  <?php endif; ?>

                  <div class="bg-light px-30 py-30">
                    <div class="text-dark">
                      <?php echo apply_filters('the_content', get_the_content()); ?>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          <?php endforeach; wp_reset_postdata(); ?>

        </div>
        <div class="swiper-pagination mt-20"></div>
      </div>

    </div>

  </div>
</section>


<style>
  /* Paginación centrada */
.bloque-testimonios .swiper-pagination {
    text-align: center;
    margin-top: 30px;
    position: relative;
}

/* Tamaño y forma */
.bloque-testimonios .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #1EA0FF; /* azul claro */
    opacity: 1;
    border-radius: 50%; /* circular */
    margin: 0 4px;
    transition: background 0.2s ease;
}

/* Hover */
.bloque-testimonios .swiper-pagination-bullet:hover {
    background: #ffffff;
}

/* Activo */
.bloque-testimonios .swiper-pagination-bullet-active {
    background: #ffffff;
}
/*  */
.bloque-testimonios {
  position: relative;
}
.testimonios-slider-wrapper {
    position: relative;
}
/* === Flechas del slider de Testimonios arriba a la derecha === */
.bloque-testimonios .slider-arrows {
  position: absolute;
  top: 1px;
  right: 1px;
  z-index: 20;
  display: flex;
  gap: 12px;
}

/* Ajuste visual de las flechas */
.bloque-testimonios .swiper-button-next,
.bloque-testimonios .swiper-button-prev {
  width: 34px;
  height: 34px;
  background: transparent;
  border: 2px solid #fff;
  border-radius: 0; /* recto */
  display: flex;
  justify-content: center;
  align-items: center;
}

.bloque-testimonios .swiper-button-next::after,
.bloque-testimonios .swiper-button-prev::after {
  font-size: 18px;
  font-weight: bold;
  color: #fff;
}
/*  */
@media (max-width:992px) {
  .bloque-testimonios .slider-arrows {
    top: -30px;
  }
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.testimonios-slider-wrapper').forEach(function (wrapper) {
    const slider  = wrapper.querySelector('.testimonios-slider');
    const nextBtn = wrapper.querySelector('.swiper-button-next');
    const prevBtn = wrapper.querySelector('.swiper-button-prev');

    if (!slider || !nextBtn || !prevBtn) return;

    // Destruir Swiper previo si existe
    if (slider.swiper) slider.swiper.destroy(true, true);

    // === SLIDER FINAL FUNCIONAL ===
    const sw = new Swiper(slider, {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      navigation: {
        nextEl: nextBtn,
        prevEl: prevBtn
      },
      pagination: {
        el: wrapper.querySelector('.swiper-pagination'),
        clickable: true,
      },
      observer: true,
      observeParents: true,
      allowTouchMove: true,
      speed: 600,
      autoplay: false,
    });


    // Recalcular tamaños (seguridad extra)
    setTimeout(() => {
      sw.update();
      sw.updateSize();
      sw.updateSlides();
      sw.navigation.update();
    }, 300);

  });

});
</script>

