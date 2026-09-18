<?php
/**
 * Bloque: Productos destacados
 * - Slider de 2 columnas (fondo azul / fondo blanco)
 * - Basado en swiper.js
 * - Solución Parallax Universal (Desktop + Android + iPhone)
 */

if (!defined('ABSPATH'))
  exit;

// Datos de productos
$productos = [
  [
    'titulo' => 'Diagnóstico de Madurez Comercial',
    'texto_intro' => '¿Está tu operación comercial preparada para escalar con foco, eficiencia y sostenibilidad? 
      <br> <br>
      ¿Estás enfrentando los mismos cuellos de botella, fricciones internas o resultados impredecibles año tras año, sin lograr resolverlos de raíz? ',
    'texto_completo' => 'Este diagnóstico permite conocer con precisión el nivel de desarrollo operacional de tu función comercial, identificando brechas críticas y oportunidades viables de mejora. 
A través de una base de información cuali-cuantitativa y un marco de análisis estructurado, brinda el insumo necesario para tomar decisiones accionables, sólidas y alineadas con la etapa actual de tu negocio.',
    'boton_label' => 'Saber más',
    'boton_url' => '/diagnostico-de-madurez-comercial/',
    'imagen' => '/wp-content/uploads/Que-es-el-diagnostico-de-madurez-comercial.png',
  ],
];

if (empty($productos))
  return;
?>

<section id="special-product-parallax-wrapper" class="bloque-productos section spp-section reveal">

  <div class="spp-gradient-bg"></div>

  <div class="container container-relative">

    <div class="swiper productos-swiper">

      <!-- Nav Header: Line + Nav Arrows -->
      <div class="producto-nav-header">
        <div class="nav-horizontal-line"></div>
        <div class="nav-btns-group">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>

      <div class="swiper-wrapper">

        <?php foreach ($productos as $p): ?>
          <div class="swiper-slide">

            <!-- Fila superior: Texto y Contenido -->
            <div class="producto-header-row grid-2 mb-60">
              <div class="header-left">
                <div class="tag-title mb-20">
                  <span class="blue-line"></span>
                  <p class="fs-24 text-white uppercase">Productos destacados</p>
                </div>
                <h2 class="heading-lg text-white text-left mb-0"><?php echo esc_html($p['titulo']); ?></h2>


              </div>

              <div class="header-right text-white d-flex flex-column justify-end">
                <div class="intro-text-limited">
                  <div class="fs-16 mb-20"><?php echo wp_kses_post($p['texto_intro']); ?></div>

                  <div class="producto-texto producto-texto--oculto">
                    <?php echo wp_kses_post($p['texto_completo']); ?>
                  </div>

                  <a href="#" class="producto-leer-mas">Leer más …</a>
                </div>
              </div>
            </div>

            <!-- Fila inferior: Tabla -->
            <div class="producto-table-row">
              <div class="table-white-bg">
                <?php get_template_part('template-parts/blocks/bloque-grafico-dmc-tabla-nueva'); ?>
              </div>
            </div>

            <div class="mt-60">
              <a href="<?php echo esc_url($p['boton_url']); ?>" class="btn-blue-rect">
                <?php echo esc_html($p['boton_label']); ?>
              </a>
            </div>

          </div>
        <?php endforeach; ?>

      </div>
    </div>

  </div>
</section>

<style>
  /* ==========================================================
     BLOQUE PRODUCTOS DESTACADOS - NEW REDESIGN
     ========================================================== */
  section.bloque-productos {
    background: #000B18 !important;
    padding: 60px 0 !important;
    position: relative;
    overflow: hidden;
    z-index: 1;
  }

  .productos-swiper {
    overflow: visible !important;
  }

  .spp-gradient-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at top right, #01224D 0%, #000B18 80%);
    z-index: -1;
  }

  /* Header structure */
  .tag-title {
    display: flex;
    align-items: center;
    gap: 15px;
  }

  .blue-line {
    width: 6px;
    height: 30px;
    background-color: var(--azul-claro, #126cfb);
    display: block;
  }

  .btn-blue-rect {
    background-color: var(--azul-claro, #126cfb);
    color: #fff;
    padding: 10px 18px;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    display: inline-block;
    transition: all 0.2s ease;
  }

  .btn-blue-rect:hover {
    background-color: #fff;
    color: var(--azul-claro, #126cfb);
  }

  .intro-text-limited {
    max-width: 450px;
    margin-left: auto;
  }

  /* Table Container */
  .table-white-bg {
    background: #fff;
    padding: 60px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
  }

  /* Nav Header: Line + Arrows */
  .producto-nav-header {
    display: flex;
    align-items: center;
    gap: 40px;
    margin-bottom: 60px;
    width: 100%;
    padding-top: 20px;
    /* Space for circles to not be clipped at top */
  }

  .nav-horizontal-line {
    flex-grow: 1;
    height: 1px;
    background: rgba(255, 255, 255, 0.3);
    background: transparent;
  }

  .nav-btns-group {
    display: flex;
    gap: 15px;
    flex-shrink: 0;
  }

  /* Nav Arrows Styling - EXACTLY as Casos de Éxito */
  .nav-btns-group .swiper-button-prev,
  .nav-btns-group .swiper-button-next {
    position: static;
    width: 44px !important;
    height: 44px !important;
    border-radius: 50%;
    background: #fff !important;
    color: var(--azul-claro, #126cfb) !important;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .25s ease;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
  }

  .nav-btns-group .swiper-button-prev:hover,
  .nav-btns-group .swiper-button-next:hover {
    background: #fff !important;
    color: #01224D !important;
  }

  .nav-btns-group .swiper-button-prev::after,
  .nav-btns-group .swiper-button-next::after {
    font-size: 18px;
  }

  .producto-texto--oculto {
    display: none;
    margin-bottom: 15px;
  }

  .producto-texto--oculto.visible {
    display: block;
  }

  .producto-leer-mas {
    color: #fff;
    text-decoration: underline;
    font-size: 14px;
  }

  @media (max-width: 992px) {
    .producto-header-row {
      grid-template-columns: 1fr;
      text-align: center;
    }

    h2.heading-xl.text-white.mb-40 {
      text-align: left;
    }

    .intro-text-limited {
      margin: 0 auto;
      text-align: left;
    }

    .table-white-bg {
      padding: 20px;
    }

    .producto-nav-header {
      gap: 15px;
      margin-bottom: 40px;
    }

    .nav-btns-group .swiper-button-prev,
    .nav-btns-group .swiper-button-next {
      width: 44px !important;
      height: 44px !important;
    }

    .heading-xl {
      font-size: 40px;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.producto-leer-mas');

    toggles.forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();

        // Buscamos el texto oculto anterior
        const wrapper = btn.closest('.intro-text-limited');
        const hiddenText = wrapper.querySelector('.producto-texto--oculto');

        if (hiddenText) {
          hiddenText.classList.toggle('visible');

          // Opcional: cambiar texto del botón
          if (hiddenText.classList.contains('visible')) {
            btn.textContent = 'Leer menos';
          } else {
            btn.textContent = 'Leer más …';
          }
        }
      });
    });
  });
</script>