<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial
 */

// ==============================================================
// URLs DE BROCHURE DMC
// Ingresa la URL del PDF o documento correspondiente.
// Si dejas la URL vacía (''), no aparecerá el botón para ese idioma.
// Si todas están vacías, no aparecerá el botón "Descarga el Brochure del DMC".
// ==============================================================
$url_brochure_dmc_es = '';
$url_brochure_dmc_en = '';
$url_brochure_dmc_pt = '';

$mostrar_boton_brochure = (!empty($url_brochure_dmc_es) || !empty($url_brochure_dmc_en) || !empty($url_brochure_dmc_pt));

get_header();

/**
 * Helper para imprimir botones de bloques
 */
function impulsor_print_buttons($prefix)
{
  $out = [];
  for ($i = 1; $i <= 3; $i++) {
    $t = get_field("{$prefix}_boton_{$i}_texto");
    $u = get_field("{$prefix}_boton_{$i}_enlace");
    if ($t && $u)
      $out[] = ['t' => $t, 'u' => $u];
  }
  if ($out) {
    echo '<div class="botones-flex">';
    foreach ($out as $b) {
      echo '<a class="btn-arrow" href="' . esc_url($b['u']) . '">' . esc_html($b['t']) . '</a>';
    }
    echo '</div>';
  }
}
?>

<main class="page-diagnostico">

  <?php imppulsor_render_page_hero('default'); ?>


  <?php
  // BLOQUE 1 - Madurez comercial 
  if (get_field('bloque_1_titulo')): ?>
    <section class="section section-madurez-comercial mt-60 reveal">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="text">
            <h2 class="heading-lg"><?php the_field('bloque_1_titulo'); ?></h2>
            <p><?php the_field('bloque_1_texto'); ?></p>
          </div>
          <div class="image-grid text-center h-100 w-100">
            <img src="<?php the_field('bloque_1_imagen'); ?>" class="rounded-diagonal w-100 h-100 h-420"
              alt="Madurez comercial, el eslabón estructural que muchas empresas no están viendo.">
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 2 – Qué es el diagnóstico de madurez comercial
  if (get_field('bloque_2_titulo')): ?>
    <section class="section section-que-es-el-diagnostico reveal">
      <div class="container section--light separator pt-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-md line-left"><?php the_field('bloque_2_titulo'); ?></h2>
          </div>
          <div class="grid-right">
            <p><?php the_field('bloque_2_texto'); ?></p>
          </div>
        </div>

        <div class="image-grid text-center mt-40">
          <img src="<?php the_field('bloque_2_imagen'); ?>" alt="Diagrama diagnóstico de madurez comercial">
          <?php
          //  get_template_part( 'template-parts/blocks/bloque-grafico-dmc' ); 
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 3 - Conozca su punto de partida
  if (get_field('bloque_3_titulo')): ?>
    <section class="section section-conozca-su-punto-de-partida reveal">
      <div class="container section--light separator pt-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-md line-left"><?php the_field('bloque_3_titulo'); ?></h2>
          </div>
          <div class="grid-right">
            <p><?php the_field('bloque_3_texto'); ?></p>
          </div>
        </div>

        <div class="image-grid text-center mt-40">
          <img src="<?php the_field('bloque_3_imagen'); ?>" alt="">
          <?php the_field('bloque_3_texto_inferior'); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 4 - Revele lo que los números no muestran
  if (get_field('bloque_4_titulo')): ?>
    <section class="section section-revele-lo-que-los-numeros-no-muestran reveal">
      <div class="container section--light separator pt-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-md line-left"><?php the_field('bloque_4_titulo'); ?></h2>
            <p><?php the_field('bloque_4_texto'); ?></p>
          </div>
          <div class="grid-right">
            <p><?php the_field('bloque_4_texto_2'); ?></p>
            <img src="<?php the_field('bloque_4_imagen_1'); ?>" alt="">
          </div>
        </div>

        <div class="mt-40">
          <p><?php the_field('bloque_4_texto_inferior'); ?></p>
        </div>

        <div class="image-grid text-center mt-40">
          <img src="<?php the_field('bloque_4_imagen_2'); ?>" alt="">
        </div>

        <?php
        // Botones dinámicos desde ACF
        $boton1 = get_field('bloque_4_boton_1');
        $boton2 = get_field('bloque_4_boton_2');

        if ($boton1 || $boton2): ?>
          <div class="mt-40 btn-links">
            <?php
            $boton1 = get_field('bloque_4_boton_1');
            $boton2 = get_field('bloque_4_boton_2');

            // Función auxiliar para imprimir cada botón
            function render_acf_link($boton)
            {
              if (is_array($boton) && isset($boton['url']) && isset($boton['title'])) {
                echo '<a href="' . esc_url($boton['url']) . '" class="btn-arrow">' . esc_html($boton['title']) . '</a><br>';
              } elseif (is_string($boton) && !empty($boton)) {
                echo '<a href="' . esc_url($boton) . '" class="btn-arrow">Ver más</a><br>';
              }
            }

            render_acf_link($boton1);
            render_acf_link($boton2);
            ?>
          </div>

        <?php endif; ?>

      </div>
    </section>
  <?php endif; ?>



  <?php
  // BLOQUE 5 - Compare el nivel de madurez
  if (get_field('bloque_5_titulo_1')): ?>
    <section class="section section-compare-el-nivel-de-madurez reveal">
      <div class="container section--light separator pt-0">
        <h2 class="heading-md mb-40"><?php the_field('bloque_5_titulo_1'); ?></h2>
        <div class="grid-2">
          <div>
            <p><?php the_field('bloque_5_texto_1'); ?></p>
          </div>
          <div class="image-grid text-center">
            <img src="<?php the_field('bloque_5_imagen_1'); ?>" alt="">
          </div>
        </div>

        <h2 class="heading-md mt-60 mb-40"><?php the_field('bloque_5_titulo_2'); ?></h2>
        <div class="grid-2">
          <div>
            <p><?php the_field('bloque_5_texto_2'); ?></p>
          </div>
          <div class="image-grid text-center">
            <img src="<?php the_field('bloque_5_imagen_2'); ?>" alt="">
          </div>
        </div>

        <div class="mt-40">
          <p><?php the_field('bloque_5_texto_final'); ?></p>
        </div>

        <div class="image-grid text-center mt-40">
          <img src="<?php the_field('bloque_5_imagen_final'); ?>" alt="">
        </div>

        <div class="text-left mt-40">
          <?php
          // Botones dinámicos desde ACF
          $boton1 = get_field('bloque_5_boton_1');
          $boton2 = get_field('bloque_5_boton_2');
          $boton3 = get_field('bloque_5_boton_3');

          if ($boton1 || $boton2 || $boton3): ?>
            <div class="mt-40 btn-links">
              <?php if ($boton1): ?>
                <a href="<?php echo esc_url($boton1['url']); ?>" class="btn-arrow"
                  target="<?php echo esc_attr($boton1['target']); ?>"><?php echo esc_html($boton1['title']); ?></a><br>
              <?php endif; ?>
              <?php if ($boton2): ?>
                <a href="<?php echo esc_url($boton2['url']); ?>" class="btn-arrow"
                  target="<?php echo esc_attr($boton2['target']); ?>"><?php echo esc_html($boton2['title']); ?></a><br>
              <?php endif; ?>
              <?php if ($boton3): ?>
                <a href="<?php echo esc_url($boton3['url']); ?>" class="btn-arrow"
                  target="<?php echo esc_attr($boton3['target']); ?>"><?php echo esc_html($boton3['title']); ?></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 6 - Testimonio 
  ?>
  <div class="my-60">
    <?php get_template_part('template-parts/blocks/bloque', 'testimonio'); ?>
  </div>




  <?php
  // BLOQUE 7 - ¿Para qué sirve este diagnóstico?
  if (get_field('bloque_7_titulo')): ?>
    <section class="section section-para-que-sirve-este-diagnostico reveal">
      <div class="container section--light">
        <h2 class="heading-lg"><?php the_field('bloque_7_titulo'); ?></h2>
        <h3 class="heading-md"><?php the_field('bloque_7_subtitulo'); ?></h3>
        <p><?php the_field('bloque_7_texto'); ?></p>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 8
  if (get_field('bloque_8_titulo_1')): ?>
    <section class="section reveal">
      <div class="container section--light">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-md"><?php the_field('bloque_8_titulo_1'); ?></h2>
            <p><?php the_field('bloque_8_texto_1'); ?></p>
          </div>
          <div class="grid-right">
            <h2 class="heading-md"><?php the_field('bloque_8_titulo_2'); ?></h2>
            <p><?php the_field('bloque_8_texto_2'); ?></p>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 9 – DIMENSIONES DE ANÁLISIS
  if (get_field('bloque_9_titulo')): ?>
    <section class="section section-dimensiones-de-analisis reveal">
      <div class="container section--light pt-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-lg mb-0"><?php the_field('bloque_9_titulo'); ?></h2>
          </div>
          <div class="grid-right">
            <?php the_field('bloque_9_texto'); ?>
          </div>
        </div>

        <div class="mt-60">
          <?php
          $dimensiones = [
            ['titulo' => 'Dimensión 1', 'subtitulo' => 'Estrategia y planificación', 'contenido' => 'Analizar si la organización cuenta con una estrategia comercial clara, compartida y activa, que oriente la toma de decisiones, estructure las prioridades operativas y habilite una ejecución coherente, rentable y sostenible en los mercados objetivo.'],
            ['titulo' => 'Dimensión 2', 'subtitulo' => 'Gobernanza empresarial', 'contenido' => 'Evaluar si la estructura de gobierno y liderazgo promueve la toma de decisiones ágil, transparente y alineada con los objetivos estratégicos.'],
            ['titulo' => 'Dimensión 3', 'subtitulo' => 'Innovación y adaptabilidad', 'contenido' => 'Determinar la capacidad de la organización para incorporar innovación continua, adaptarse a entornos cambiantes y sostener ventajas competitivas.'],
            ['titulo' => 'Dimensión 4', 'subtitulo' => 'Experiencia de cliente', 'contenido' => 'Analizar si la empresa gestiona la experiencia de cliente de forma integral, coherente y centrada en el valor.'],
            ['titulo' => 'Dimensión 5', 'subtitulo' => 'Marketing y generación de demanda', 'contenido' => 'Revisar la efectividad de las acciones de marketing y generación de demanda como motor del crecimiento comercial.'],
            ['titulo' => 'Dimensión 6', 'subtitulo' => 'Metodología comercial', 'contenido' => 'Evaluar la madurez de los procesos comerciales y la estandarización de prácticas que aseguren eficiencia y consistencia.'],
            ['titulo' => 'Dimensión 7', 'subtitulo' => 'Digitalización, automatización e IA', 'contenido' => 'Analizar el nivel de integración tecnológica y el uso de herramientas de IA en la gestión comercial y de clientes.'],
            ['titulo' => 'Dimensión 8', 'subtitulo' => 'Monitoreo y análisis de datos', 'contenido' => 'Determinar la capacidad de la organización para medir, analizar y tomar decisiones basadas en información confiable y oportuna.'],
            ['titulo' => 'Dimensión 9', 'subtitulo' => 'Eficiencia operativa', 'contenido' => 'Evaluar el uso eficiente de recursos, la gestión del tiempo y la productividad del equipo comercial.'],
            ['titulo' => 'Dimensión 10', 'subtitulo' => 'Organización', 'contenido' => 'Analizar la estructura organizacional y su grado de alineación con los objetivos y estrategias comerciales.'],
            ['titulo' => 'Dimensión 11', 'subtitulo' => 'Liderazgo', 'contenido' => 'Evaluar la calidad del liderazgo, el empoderamiento del equipo y la capacidad de inspirar resultados sostenibles.'],
            ['titulo' => 'Dimensión 12', 'subtitulo' => 'Gestión del talento', 'contenido' => 'Analizar la capacidad de la organización para atraer, desarrollar y retener talento comercial de alto rendimiento.']
          ];


          $col1 = array_slice($dimensiones, 0, 6);
          $col2 = array_slice($dimensiones, 6);
          ?>

          <div class="dimensiones-grid">
            <div class="dimensiones-col">
              <?php foreach ($col1 as $item): ?>
                <div class="accordion-item">
                  <div class="accordion-header">
                    <div class="accordion-title">
                      <span class="dimension-num"><?php echo esc_html($item['titulo']); ?></span>
                      <h4 class="dimension-subtitulo fs-18 mb-0"><?php echo esc_html($item['subtitulo']); ?></h4>
                    </div>
                    <div class="accordion-icon"></div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner">
                      <?php echo esc_html($item['contenido']); ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="dimensiones-col">
              <?php foreach ($col2 as $item): ?>
                <div class="accordion-item">
                  <div class="accordion-header">
                    <div class="accordion-title">
                      <span class="dimension-num"><?php echo esc_html($item['titulo']); ?></span>
                      <h4 class="dimension-subtitulo fs-18 mb-0"><?php echo esc_html($item['subtitulo']); ?></h4>
                    </div>
                    <div class="accordion-icon"></div>
                  </div>
                  <div class="accordion-content">
                    <div class="accordion-content-inner">
                      <?php echo esc_html($item['contenido']); ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOQUE 10 – ¿Por qué tomar el diagnóstico?
  if (get_field('bloque_10_titulo')): ?>
    <section class="section section-por-que-tomar-el-diagnostico reveal">
      <div class="container section--light">
        <div>
          <h2 class="heading-lg"><?php the_field('bloque_10_titulo'); ?></h2>
          <h3 class="heading-md line-left"><?php the_field('bloque_10_subtitulo'); ?></h3>
        </div>

        <div class="grid-2 mt-40">
          <div class="grid-left">
            <ul class="diagnostico-list">
              <li><span class="num">1</span>
                <p>Visualización sistémica de la función comercial, permitiendo entender cómo se articulan procesos,
                  estructura, tecnología, talento y liderazgo, y cómo impactan en la capacidad de generar ingresos
                  sostenibles y escalables.</p>
              </li>
              <li><span class="num">2</span>
                <p>Identificación de brechas estructurales y focos críticos de intervención, que limitan la eficiencia
                  operativa, generan dependencias indeseadas o reducen el control directivo sobre el desempeño comercial.
                </p>
              </li>
              <li><span class="num">3</span>
                <p>Medición objetiva del nivel de madurez comercial a partir de un modelo de 12 dimensiones clave, con
                  indicadores cualitativos y cuantitativos que permiten priorizar mejoras con base en evidencia.</p>
              </li>
              <li><span class="num">4</span>
                <p>Comparación frente a un benchmark regional y sectorial, para contextualizar resultados y definir
                  trayectorias de evolución realistas en función de referentes comparables.</p>
              </li>
              <li><span class="num">5</span>
                <p>Generación de insumos estratégicos para la toma de decisiones, incluyendo rediseño organizacional,
                  definición de inversiones, desarrollo de capacidades, reorganización del modelo comercial o ajustes en
                  roles clave.</p>
              </li>
              <li><span class="num">6</span>
                <p>Reducción del riesgo en decisiones comerciales estructurales, al contar con un marco de análisis
                  robusto que alinea visión, acción y resultados con foco en eficiencia, autonomía y sostenibilidad.</p>
              </li>
            </ul>
          </div>

          <div class="image-grid teeest">
            <img src="<?php the_field('bloque_10_imagen'); ?>" class="rounded-diagonal w-100 h-420"
              alt="Equipo de trabajo colaborando">


            <div class="mt-40 btn-links"><a href="https://imppulsor.com/contacto/" class="btn-arrow mt-20-mob"
                target="_self">Solicite una reunión con nuestros especialistas</a>

              <br>
              <?php if ($mostrar_boton_brochure): ?>
                <!-- aca debe ir el boton de descarga de la presentacion -->
                <button class="btn-brochure-dmc btn-brochure-dmc-open mt-20">Descarga el Brochure del DMC</button>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- bloque carousel casos de exito  -->
  <div class="bg-ellipse">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>
  <!-- bloque ocho areas -->
  <?php get_template_part('template-parts/blocks/bloque-ocho-areas'); ?>

  <div class="mt-60">
    <!-- bloque experiencia internacional -->
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </div>

  <!-- bloque carousel insights -->
  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>


</main>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
      const content = header.nextElementSibling;
      header.addEventListener('click', () => {
        const isActive = header.classList.contains('active');
        headers.forEach(h => {
          h.classList.remove('active');
          h.nextElementSibling.style.height = 0;
        });
        if (!isActive) {
          header.classList.add('active');
          const inner = content.querySelector('.accordion-content-inner');
          content.style.height = inner.scrollHeight + 'px';
        }
      });
    });

    window.addEventListener('resize', () => {
      document.querySelectorAll('.accordion-header.active').forEach(h => {
        const content = h.nextElementSibling;
        const inner = content.querySelector('.accordion-content-inner');
        content.style.height = inner.scrollHeight + 'px';
      });
    });
  });
</script>





</script>

<?php if ($mostrar_boton_brochure): ?>
  <!-- Modales de Brochure DMC -->
  <div id="brochure-popup" class="brochure-popup-overlay">
    <div class="brochure-popup-content">
      <button id="close-brochure-popup" class="brochure-popup-close">&times;</button>
      <h3 class="heading-md mb-20 text-dark">Descargar brochure DMC</h3>
      <p class="mb-30 text-dark">Por favor, selecciona el idioma del brochure que deseas descargar:</p>

      <div class="brochure-langs">
        <?php if (!empty($url_brochure_dmc_es)): ?>
          <a href="<?php echo esc_url($url_brochure_dmc_es); ?>" target="_blank" class="lang-btn" download>
            <img src="/wp-content/plugins/gtranslate/flags/svg/es.svg" alt="Español" width="30" height="30">
            <span>Español</span>
          </a>
        <?php endif; ?>
        <?php if (!empty($url_brochure_dmc_en)): ?>
          <a href="<?php echo esc_url($url_brochure_dmc_en); ?>" target="_blank" class="lang-btn" download>
            <img src="/wp-content/plugins/gtranslate/flags/svg/en.svg" alt="English" width="30" height="30">
            <span>English</span>
          </a>
        <?php endif; ?>
        <?php if (!empty($url_brochure_dmc_pt)): ?>
          <a href="<?php echo esc_url($url_brochure_dmc_pt); ?>" target="_blank" class="lang-btn" download>
            <img src="/wp-content/plugins/gtranslate/flags/svg/pt-br.svg" alt="Português" width="30" height="30">
            <span>Português</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <style>
    .btn-brochure-dmc {
      background-color: var(--azul-oscuro, #01224d);
      color: #fff;
      font-size: 14px;
      text-decoration: none;
      padding: 10px 20px;
      font-weight: 600;
      transition: .2s ease;
      border: none;
      cursor: pointer;
      font-family: inherit;
      display: inline-block;
    }

    .btn-brochure-dmc:hover {
      background-color: var(--azul-claro, #126cfb);
      color: #fff;
    }

    /* Popup Overlays */
    .brochure-popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(1, 34, 77, 0.85);
      /* rgba de var(--azul-oscuro) */
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      backdrop-filter: blur(4px);
    }

    .brochure-popup-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .brochure-popup-content {
      background: #fff;
      padding: 40px;
      max-width: 500px;
      width: 90%;
      position: relative;
      border-radius: 8px;
      transform: translateY(20px);
      transition: all 0.3s ease;
      text-align: center;
    }

    .brochure-popup-overlay.active .brochure-popup-content {
      transform: translateY(0);
    }

    .brochure-popup-close {
      position: absolute;
      top: 15px;
      right: 20px;
      background: transparent;
      border: none;
      font-size: 28px;
      cursor: pointer;
      color: #333;
      transition: color 0.2s;
    }

    .brochure-popup-close:hover {
      color: var(--azul-claro, #126cfb);
    }

    .brochure-langs {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .brochure-langs .lang-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
      color: var(--azul-oscuro, #01224d);
      text-decoration: none;
      font-weight: 600;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      transition: all 0.2s ease;
      min-width: 120px;
      background: #fff;
    }

    .brochure-langs .lang-btn:hover {
      background: var(--gris, #f5f5f5);
      border-color: var(--azul-claro, #126cfb);
      color: var(--azul-claro, #126cfb);
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btnsOpen = document.querySelectorAll('.btn-brochure-dmc-open');
      const popup = document.getElementById('brochure-popup');
      const btnClose = document.getElementById('close-brochure-popup');

      if (btnsOpen.length > 0 && popup && btnClose) {
        btnsOpen.forEach(btn => {
          btn.addEventListener('click', (e) => {
            e.preventDefault();
            popup.classList.add('active');
          });
        });

        btnClose.addEventListener('click', () => {
          popup.classList.remove('active');
        });

        popup.addEventListener('click', (e) => {
          if (e.target === popup) {
            popup.classList.remove('active');
          }
        });
      }
    });
  </script>
<?php endif; ?>

<?php get_footer(); ?>