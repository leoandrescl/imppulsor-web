<?php
/**
 * Bloque 6 – Slider de Testimonios (Hardcoded con Swiper)
 */
if (!defined('ABSPATH'))
  exit;

// Estructura de datos hardcoded
$testimonios = [
  // TESTIMONIO 1: Andrés Carey (Con Logo, sin empresa en el texto del cargo)
  [
    'titulo' => 'Todo comenzó con la necesidad de escalar',
    'texto' => 'Ya habíamos validado nuestra propuesta de valor en un mercado exigente, con demanda creciente y espacio para innovación financiera y tecnológica. Con señales claras de product market fit, el desafío dejó de ser convencer y pasó a ser escalar el negocio. El equipo entendió que la siguiente etapa exigía fortalecer la operación comercial. Aplicamos el Diagnóstico de Madurez Comercial de Imppulsor porque calzaba con precisión con nuestro momento, velocidad y necesidad de claridad. Este aportó un marco estructurado para analizar nuestra operación, junto con criterios comparables de evaluación y una agenda priorizada de acciones habilitantes para mejoras estructurales y operativas posteriores.',
    'autor' => 'Andrés Carey',
    'cargo' => 'Co-Founder, Chief Legal Officer',
    'imagen' => '/wp-content/uploads/andres-carey.jpg', /* <-- REEMPLAZA CON LA RUTA DE LA FOTO DE ANDRES */
    'logo_empresa' => '/wp-content/uploads/logo-wbuild.png',  /* <-- REEMPLAZA CON LA RUTA DEL LOGO WBUILD */
  ],
  // TESTIMONIO 2: Cristian Arriagada (Sin logo, con empresa en el texto del cargo)
  [
    'titulo' => 'Todo comenzó con un diagnóstico',
    'texto' => 'Teníamos un equipo talentoso, pero sabíamos que estábamos lejos de alcanzar nuestro verdadero potencial. El diagnóstico no solo nos entregó datos: nos mostró con precisión dónde estábamos perdiendo eficiencia, qué perfiles necesitaban acompañamiento y qué prácticas debíamos reforzar para crecer con estructura. A partir de ahí rediseñamos nuestros modelos de trabajo, alineamos al equipo regional y mejoramos los indicadores clave de desempeño en varios países. Hoy operamos con más claridad, foco y consistencia, y elevamos con consistencia la efectividad y productividad promedio de nuestro equipo comercial.',
    'autor' => 'Cristian Arriagada',
    'cargo' => 'Regional Sales Director',
    'imagen' => '/wp-content/uploads/cristian-arriagada.jpg', /* <-- REEMPLAZA CON LA RUTA DE LA FOTO DE CRISTIAN */
    'logo_empresa' => '/wp-content/uploads/logo-hco2.png', /* <-- DEJADO EN BLANCO PARA QUE NO MUESTRE LOGO */
  ]
];

if (empty($testimonios))
  return;
?>

<section class="section section-testimonio reveal">
  <div class="container section--dark p-relative bg-gradiente-insights-casos">

    <div id="testimonio-swiper" class="swiper testimonio-swiper w-100">
      <div class="swiper-wrapper">

        <?php foreach ($testimonios as $t): ?>
          <div class="swiper-slide">
            <div class="grid-2">

              <div class="grid-left image-grid h-100 w-100 h-420">
                <img src="<?php echo esc_url($t['imagen']); ?>" class="rounded-diagonal w-100 h-100 object-cover"
                  alt="<?php echo esc_attr($t['autor']); ?>">
              </div>

              <div class="grid-right text-white">
                <div class="testimonio-content">
                  <h2 class="heading-lg text-white line-left mb-40">
                    <?php echo esc_html($t['titulo']); ?>
                  </h2>

                  <div class="testimonio-text">
                    <p><?php echo wp_kses_post($t['texto']); ?></p>
                  </div>

                  <div class="testimonio-autor mt-20">
                    <strong class="fs-32"><?php echo esc_html($t['autor']); ?></strong><br>
                    <span class="cargo text-white"><?php echo wp_kses_post($t['cargo']); ?></span>

                    <?php if (!empty($t['logo_empresa'])): ?>
                      <div class="testimonio-logo mt-30">
                        <img src="<?php echo esc_url($t['logo_empresa']); ?>"
                          alt="Logo <?php echo esc_attr($t['autor']); ?>" style="max-height: 45px; object-fit: contain;">
                      </div>
                    <?php endif; ?>

                  </div>
                </div>

                <!-- Paginador dentro del Slide -->
                <div class="logos-pagination d-flex justify-between mt-40 logos-pagination-absolute-bottom">
                  <div class="pagination testimonio-nav">
                    <span class="pagination-btn btn-prev-custom">Anterior</span>
                    <div class="swiper-pagination-custom position-static w-auto d-flex align-center gap-10">
                      <?php foreach ($testimonios as $p_index => $p_t): ?>
                        <span class="pagination-number custom-bullet <?php echo $p_index === 0 ? 'active' : ''; ?>"
                          data-slide-index="<?php echo $p_index; ?>"><?php echo $p_index + 1; ?></span>
                      <?php endforeach; ?>
                    </div>
                    <span class="pagination-btn btn-next-custom">Siguiente</span>
                  </div>
                </div>

              </div>

            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>

  </div>
</section>

<style>
  @media (min-width:992px) {
    .logos-pagination-absolute-bottom {
      position: absolute;
      bottom: 0;
    }

    .section-testimonio .image-grid {
      height: 810px !important;
    }

    .section-testimonio .image-grid img {
      height: 100% !important;
      object-fit: cover;
    }
  }

  .grid-right.text-white {
    height: 100%;
  }

  /* Slider Testimonios */
  .testimonio-swiper {
    overflow: hidden;
  }

  /* Transición Fade */
  .testimonio-swiper .swiper-slide {
    opacity: 0 !important;
    transition: opacity 0.6s ease-in-out;
    height: auto;
  }

  .testimonio-swiper .swiper-slide-active {
    opacity: 1 !important;
    z-index: 2;
  }

  /* Imagen del logo */
  .testimonio-logo img {
    display: block;
    max-width: 200px;
  }

  /* Navegación y Paginación */
  .logos-pagination {
    width: 100%;
  }

  .testimonio-nav {
    display: inline-flex;
    gap: 8px;
    align-items: center;
    position: relative;
    z-index: 10;
  }

  .swiper-pagination-testimonio {
    display: inline-flex;
    gap: 8px;
    position: static;
  }

  .testimonio-nav .pagination-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border: 1px solid #fff;
    border-radius: 0;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all .3s ease;
    color: #fff;
    background: transparent;
    opacity: 1;
    /* override swiper disabled opacity */
    margin: 0 !important;
  }

  .testimonio-nav .pagination-number:hover,
  .testimonio-nav .pagination-number.active {
    background: #fff;
    color: #01224D !important;
    border-color: #fff;
  }

  .testimonio-nav .pagination-btn {
    border: 1px solid #fff;
    padding: 0px 8px;
    height: 26px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    cursor: pointer;
    transition: all .3s ease;
    font-weight: 600;
    width: max-content;
    color: #fff;
    text-transform: lowercase;
  }

  .testimonio-nav .pagination-btn::after {
    display: none;
    /* override default swiper arrows */
  }

  .testimonio-nav .pagination-btn:hover {
    background: #fff;
    border-color: #fff;
    color: #01224D !important;
  }

  .testimonio-nav .pagination-btn.swiper-button-disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: transparent !important;
    color: #fff !important;
  }

  /* Responsive */
  @media (max-width: 992px) {
    .testimonio-content {
      min-height: 600px;
    }

    .logos-pagination {
      justify-content: start !important;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    function initTestimonioSlider() {
      if (typeof Swiper === 'undefined') {
        setTimeout(initTestimonioSlider, 50);
        return;
      }

      const sliderElement = document.querySelector('#testimonio-swiper');
      if (!sliderElement || sliderElement.dataset.initialized) return;
      sliderElement.dataset.initialized = '1';

      const testimonioSwiper = new Swiper(sliderElement, {
        loop: true,
        speed: 800,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
          delay: 6000,
          disableOnInteraction: false,
        },
        on: {
          init: function () {
            updateCustomPagination(this.realIndex);
          },
          slideChangeTransitionStart: function () {
            this.slides.forEach(s => s.style.opacity = '0');
            if (this.slides[this.activeIndex]) {
              this.slides[this.activeIndex].style.opacity = '1';
            }
            updateCustomPagination(this.realIndex);
          }
        }
      });

      // Sincronizar clases active en todos los paginadores (clonados por loop)
      function updateCustomPagination(activeIndex) {
        // Actualizar bullets
        document.querySelectorAll('#testimonio-swiper .custom-bullet').forEach(bullet => {
          if (parseInt(bullet.dataset.slideIndex) === activeIndex) {
            bullet.classList.add('active');
          } else {
            bullet.classList.remove('active');
          }
        });

        // Actualizar botones prev/next
        const totalSlides = <?php echo count($testimonios); ?>;

        document.querySelectorAll('#testimonio-swiper .btn-prev-custom').forEach(btn => {
          btn.style.display = activeIndex === 0 ? 'none' : 'flex';
        });

        document.querySelectorAll('#testimonio-swiper .btn-next-custom').forEach(btn => {
          btn.style.display = activeIndex === totalSlides - 1 ? 'none' : 'flex';
        });
      }

      // Event delegation para los clics en los paginadores dentro del slider interactivo
      sliderElement.addEventListener('click', function (e) {
        if (e.target.closest('.custom-bullet')) {
          const index = parseInt(e.target.closest('.custom-bullet').dataset.slideIndex);
          testimonioSwiper.slideToLoop(index);
        } else if (e.target.closest('.btn-prev-custom')) {
          testimonioSwiper.slidePrev();
        } else if (e.target.closest('.btn-next-custom')) {
          testimonioSwiper.slideNext();
        }
      });
    }

    initTestimonioSlider();
  });
</script>