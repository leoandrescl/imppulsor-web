<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial 2
 */

// ==============================================================
// URLs DE BROCHURE DMC
// Ingresa la URL del PDF o documento correspondiente.
// Si dejas la URL vacía (''), no aparecerá el botón para ese idioma.
// Si todas están vacías, no aparecerá el botón "Descarga el Brochure del DMC".
// ==============================================================
$url_brochure_dmc_es = 'https://imppulsor.com/wp-content/uploads/Brochure-Diagnostico-de-Madurez-Comercial_2026_v2.pdf';
$url_brochure_dmc_en = '';
$url_brochure_dmc_pt = '';

$mostrar_boton_brochure = (!empty($url_brochure_dmc_es) || !empty($url_brochure_dmc_en) || !empty($url_brochure_dmc_pt));

get_header();

/**
 * Helper para imprimir botones de forma consistente y validada
 */
function impulsor_render_buttons($prefix, $count = 3)
{
  $has_buttons = false;
  $buttons_html = '';

  for ($i = 1; $i <= $count; $i++) {
    $boton = get_field("{$prefix}_boton_{$i}");
    if ($boton && is_array($boton) && !empty($boton['url']) && !empty($boton['title'])) {
      $has_buttons = true;
      $buttons_html .= sprintf(
        '<a href="%s" class="btn-arrow" target="%s">%s</a><br>',
        esc_url($boton['url']),
        esc_attr($boton['target'] ? $boton['target'] : '_self'),
        esc_html($boton['title'])
      );
    }
  }

  if ($has_buttons) {
    echo '<div class="mt-40 btn-links">';
    echo $buttons_html;
    echo '</div>';
  }
}
?>

<style>
  /* Estilos específicos de la página */
  .diag-block-margin {}

  /* Separator Line Logic */
  .separator {
    display: flow-root;
    /* Fix for float/margin collapse */
  }

  .separator::after {
    content: "";
    width: 100%;
    display: block;
    padding-top: 60px;
    border-bottom: 1px solid #000;
  }

  /* Ajuste para que el último elemento dentro de un separator no duplique márgenes */
  /* .separator:last-child::after {
    display: none;
    border-bottom: none;
  } */

  @media (max-width: 768px) {
    .separator::after {
      padding-top: 60px;
    }

    .mobile-reverse-col {
      display: flex !important;
      flex-direction: column-reverse !important;
    }

    .mobile-reverse-col>div,
    .mobile-reverse-col>.grid-left,
    .mobile-reverse-col>.grid-right {
      width: 100% !important;
    }
  }

  /* Utilidad para asegurar que las secciones no se colapsen */
  .section {
    position: relative;
    overflow: hidden;
    /* Evita que flotantes salgan del contenedor */
  }
</style>

<main class="page-diagnostico bg-white ">

  <?php imppulsor_render_page_hero('default'); ?>

  <?php
  /* =========================================
     BLOQUE 1 - Madurez comercial
     ========================================= */
  if (get_field('bloque_1_titulo')): ?>
    <section class="section mt-60 mb-0-mob section-madurez-comercial diag-block-margin reveal">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="text">
            <h2 class="heading-lg">
            Qué es el Diagnóstico de Madurez Comercial (DMC)
            </h2>
            <p>
            El DMC es una herramienta desarrollada para evaluar con profundidad el nivel de desarrollo estructural, técnico y operativo de la función comercial de una organización. A través del análisis de 12 dimensiones clave, permite identificar brechas críticas, dependencias ocultas y oportunidades de mejora que impactan directamente en la capacidad de adquirir, retener y rentabilizar clientes, así como en el desarrollo de capacidades para escalar la operación comercial o elevar la efectividad y productividad comercial. 
            </p>
          </div>
          <div class="image-grid text-center h-100 w-100">
            <?php
            $img_1 = get_field('bloque_1_imagen');
            if ($img_1): ?>
              <img src="<?php echo esc_url($img_1); ?>" class="rounded-diagonal w-100 h-100 h-420" alt="Madurez comercial">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  

  <?php
  /* =========================================
     BLOQUE 3 - Niveles de madurez
     ========================================= */
  if (get_field('bloque_3_titulo')): ?>
    <!-- Parte Inferior: Grafico Niveles + Texto + Botones -->
    <section class="section section-niveles-madurez diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2 mobile-reverse-col">
            <div class="grid-left" style="position: relative; z-index: 20;">
              <?php get_template_part('template-parts/blocks/bloque-grafico-niveles'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
                Niveles de madurez comercial
              </h2>
              <p>
              El DMC clasifica la madurez comercial en cuatro niveles que reflejan el grado de formalización, integración y capacidad adaptativa de una organización. Cada nivel refleja un conjunto específico de capacidades estructurales, técnicas y humanas que condicionan el desempeño comercial e indican qué tan preparada está la operación para elevar su productividad comercial o apoyar la escalación empresarial del negocio.
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>




  <?php
  /* =========================================
     BLOQUE 4 - Revele lo que los números no muestran
     ========================================= */
  if (get_field('bloque_4_titulo')): ?>


    <!-- Parte Inferior: Grafico Silueta + Texto + Botones -->
    <section class="section section-conozca-su-punto-de-partida diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div class="grid-left">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_3_titulo'); ?>
              </h2>
              <p>
              Conozca el nivel de desarrollo de su operación comercial y conviértalo en una herramienta de gestión. El DMC revela el perfil único de cada organización, mostrando con claridad qué dimensiones están consolidadas, cuáles requieren mayor desarrollo y cómo se comparan frente a referentes de su industria. Esta visión integra percepciones dispersas en un marco de análisis estructurado y comparable, permitiendo tomar decisiones con mayor precisión, focalizar recursos y trazar una hoja de ruta de mejora con coherencia estratégica y operativa.
 
              </p>
            </div>
            <div class="grid-right">
              <div class="separator-wrapper-graphic">
                <!-- Added wrapper specific for graphics if needed, but using separator as requested -->
                <?php get_template_part('template-parts/blocks/bloque-grafico-silueta'); ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-revele-lo-que-los-numeros-no-muestran diag-block-margin reveal">
      <div class="container section--light pt-0">

        <!-- Parte Superior: Texto + Grafico Nube -->

          <div class="grid-2 mobile-reverse-col">

            <div class="grid-left">
              <?php get_template_part('template-parts/blocks/bloque-grafico-nube-palabras'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
              Revele lo que los números no muestran y vaya al fondo de las percepciones y disonancias de su organización
              </h2>
              <p>
                <?php the_field('bloque_4_texto'); ?>
              </p>

          </div>
        </div>
      </div>
    </section>

  <?php endif; ?>

  <style>
    .section-3-how-ayudamos {
      aspect-ratio: 1728 / 503;
      width: 100%;
      position: relative;
      overflow: hidden;
    }

    .section-3-how-ayudamos__panel {
      background: linear-gradient(180deg, #061834, #042e67);
      position: absolute;
      left: 0;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      z-index: 2;
    }

    @media (max-width: 1024px) {
      .section-3-how-ayudamos__panel {
        position: relative;
        top: auto;
        left: auto;
        right: auto;
        transform: none;
      }
    }
  </style>

  <!-- SECCIÓN 3: Cómo ayudamos -->
  <section class="section section-3 section-3-how-ayudamos reveal reveal-up spp-section">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/section-9-parallax.jpg" alt="" class="spp-bg-image">
    </div>
    <div class="container py-40 px-60 rounded-diagonal section-3-how-ayudamos__panel">
      <div class="grid-2 p-40 text-white align-center">
        <div>
          <h2 class="heading-lg mb-20">El eslabón estructural que muchas empresas no están viendo</h2>
        </div>
        <div>
          <p>
          La madurez comercial es el nivel de desarrollo estructural, técnico y operativo que ha alcanzado una organización en su función comercial. Permite entender cómo se articulan capacidades clave como la estrategia, la planificación, la tecnología, el liderazgo o la gestión del talento para generar ingresos de forma sostenible. Evaluarla ayuda a identificar limitaciones estructurales, anticipar riesgos y tomar mejores decisiones sobre cómo escalar el desempeño comercial en contextos de alta complejidad.
          </p>
        </div>
      </div>
    </div>
  </section>


  <?php
  /* =========================================
     BLOQUE 5 - Compare el nivel de madurez
     ========================================= */
  if (get_field('bloque_5_titulo_1')): ?>
    <!-- Fila 1: Titulo + Grafico Barras -->
    <section class="section pt-60 section-compare-1 diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div>
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_5_titulo_1'); ?>
              </h2>
              <p>
              Con base en el Índice Global de Madurez Comercial (IGMC) obtenido, podrá ubicar su operación dentro de uno de los cuatro niveles definidos por nuestro modelo y compararla frente al benchmark. Esta visualización permite dimensionar con claridad qué tan avanzada o rezagada se encuentra su organización, cuál es la brecha respecto del estándar de referencia y qué tan cerca está del siguiente umbral de madurez. Entender esta posición relativa no solo clarifica la situación actual, sino que también orienta la priorización de transformaciones necesarias para desarrollar ventajas competitivas.
 
              </p>
            </div>
            <div class="image-grid text-center">
              <?php get_template_part('template-parts/blocks/bloque-grafico-barras-dmc'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Fila 2: Grafico Barras 2 + Titulo 2 -->
    <section class="section section-compare-2 diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2 mobile-reverse-col">
            <div class="image-grid text-center mt-0">
              <?php get_template_part('template-parts/blocks/bloque-grafico-barras-estrategia-y-planificacion'); ?>
            </div>
            <div class="d-flex flex-column justify-center">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_5_titulo_2'); ?>
              </h2>
              <p>
              El DMC está diseñado para ir más allá de una lectura superficial. Cada una de sus doce dimensiones de análisis se descompone en tres subdimensiones específicas que permiten analizar con precisión los factores estructurales que explican las capacidades competitivas del área. Este enfoque garantiza un equilibrio riguroso entre amplitud y profundidad, facilitando la identificación de causas raíz y no solo de síntomas. Usted obtendrá una visión clara de los factores que hoy habilitan o restringen el desempeño, la productividad y la evolución de su operación comercial.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Fila 3: Heatmap -->
    <section class="section section-heatmap diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">

          <!-- Heatmap Intro -->
          <div>
            <h2 class="heading-md line-left mb-30">
              Vaya a la causa raíz de sus zonas de dolor
            </h2>
            <p class="mb-40">
              <?php the_field('bloque_5_texto_final'); ?>
            </p>
          </div>

          <div class="heatmap-wrapper">
            <?php get_template_part('template-parts/blocks/bloque-grafico-heatmap'); ?>
          </div>

          <!-- Botones Finales -->
          <div class="text-left mt-40">
            <?php
            // Renderizado de botones Bloque 5
            impulsor_render_buttons('bloque_5', 3);
            ?>
          </div>

        </div>
      </div> <!-- Fin Container -->
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOQUE 6 - Testimonios
     ========================================= */
  ?>
  <section class="section section-testimonios diag-block-margin">
    <div class="container my-60">
      <?php get_template_part('template-parts/blocks/bloque', 'testimonio'); ?>
    </div>
  </section>


  <?php
  /* =========================================
     BLOQUE 7 - ¿Para qué sirve?
     ========================================= */
  if (get_field('bloque_7_titulo')): ?>
    <section class="section section-para-que-sirve-este-diagnostico diag-block-margin reveal">
      <div class="container section--light separator">
        <h2 class="heading-lg">
          <?php the_field('bloque_7_titulo'); ?>
        </h2>
        <h3 class="heading-md">
          <?php the_field('bloque_7_subtitulo'); ?>
        </h3>
        <p>
          <?php the_field('bloque_7_texto'); ?>
        </p>
      </div>
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOQUE 8 - Información Adicional (2 columnas)
     ========================================= */
  if (get_field('bloque_8_titulo_1')): ?>
    <section class="section diag-block-margin reveal">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-md">
              <?php the_field('bloque_8_titulo_1'); ?>
            </h2>
            <p>
              <?php the_field('bloque_8_texto_1'); ?>
            </p>
          </div>
          <div class="grid-right">
            <h2 class="heading-md">
              <?php the_field('bloque_8_titulo_2'); ?>
            </h2>
            <p>
              <?php the_field('bloque_8_texto_2'); ?>
            </p>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOQUE 9 – DIMENSIONES DE ANÁLISIS
     ========================================= */
  if (get_field('bloque_9_titulo')): ?>
    <section class="section section-dimensiones-de-analisis diag-block-margin reveal">
      <div class="container section--light separator pt-0 pb-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-lg mb-0">
              <?php the_field('bloque_9_titulo'); ?>
            </h2>
          </div>
          <div class="grid-right">
            <?php the_field('bloque_9_texto'); ?>
          </div>
        </div>

        <div class="mt-60 mb-0-mob">
          <?php
          // Definimos las dimensiones manualmente como se solicitó, para mantener el contenido original.
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

          // Helper para renderizar acordeón
          function impulsor_msg_render_accordion($items)
          {
            foreach ($items as $item): 
              $dim_num = preg_replace('/[^0-9]/', '', $item['titulo']); // Extract only numbers
              $dim_id = 'dimension-' . $dim_num;
              ?>
              <div class="accordion-item" id="<?php echo esc_attr($dim_id); ?>">
                <div class="accordion-header">
                  <div class="accordion-title">
                    <span class="dimension-num">
                      <?php echo esc_html($item['titulo']); ?>
                    </span>
                    <h4 class="dimension-subtitulo fs-18 mb-0">
                      <?php echo esc_html($item['subtitulo']); ?>
                    </h4>
                  </div>
                  <div class="accordion-icon"></div>
                </div>
                <div class="accordion-content">
                  <div class="accordion-content-inner">
                    <?php echo esc_html($item['contenido']); ?>
                  </div>
                </div>
              </div>
            <?php endforeach;
          }
          ?>

          <div class="dimensiones-grid">
            <div class="dimensiones-col">
              <?php impulsor_msg_render_accordion($col1); ?>
            </div>
            <div class="dimensiones-col">
              <?php impulsor_msg_render_accordion($col2); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOQUE 10 – ¿Por qué tomar el diagnóstico?
     ========================================= */
  if (get_field('bloque_10_titulo')): ?>
    <section class="section section-por-que-tomar-el-diagnostico diag-block-margin reveal">
      <div class="container section--light separator">
        <div>
          <h2 class="heading-lg">
            <?php the_field('bloque_10_titulo'); ?>
          </h2>
          <h3 class="heading-md line-left">
            <?php the_field('bloque_10_subtitulo'); ?>
          </h3>
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

            <div class="image-grid">

              <div class="mt-40 btn-links"><a href="https://imppulsor.com/contacto/" class="btn-arrow"
                  target="_self">Solicite una reunión con nuestros especialistas</a>
                <br>
                <a href="https://imppulsor.com/casos-de-exito/" class="btn-arrow" target="_self">Descubre nuestros casos
                  de éxito</a><br>
              </div>

              <?php if ($mostrar_boton_brochure): ?>
                <div class="mt-20 btn-links">
                  <button class="btn-brochure-dmc btn-brochure-dmc-open">Descarga el Brochure del DMC</button>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="image-grid">
            <?php
            $img_10 = get_field('bloque_10_imagen');
            if ($img_10): ?>
              <img src="<?php echo esc_url($img_10); ?>" class="rounded-diagonal w-100 h-420" alt="Equipo de trabajo">
            <?php endif; ?>

          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Bloque Casos de Éxito -->
  <section class="section bg-ellipse diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </section>

  <!-- Bloque Ocho Áreas -->
  <section class="section mb-60 diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-ocho-areas'); ?>
  </section>

  <!-- Bloque Experiencia Internacional -->
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </section>

  <!-- Bloque Insights -->
  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>

</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
      const content = header.nextElementSibling;
      header.addEventListener('click', () => {
        const isActive = header.classList.contains('active');

        if (!isActive) {
          header.classList.add('active');
          const inner = content.querySelector('.accordion-content-inner');
          content.style.height = inner.scrollHeight + 'px';
        } else {
          header.classList.remove('active');
          content.style.height = 0;
        }
      });
    });

    // Función para abrir desde hash
    function handleHashAction() {
      const hash = window.location.hash;
      if (hash && hash.startsWith('#dimension-')) {
        const targetItem = document.querySelector(hash);
        if (targetItem) {
          const header = targetItem.querySelector('.accordion-header');
          const content = targetItem.querySelector('.accordion-content');
          const inner = content.querySelector('.accordion-content-inner');

          // Abrir si no está activo
          if (!header.classList.contains('active')) {
            header.classList.add('active');
            content.style.height = inner.scrollHeight + 'px';
          }

          // Hacer scroll suave después de un momento
          setTimeout(() => {
            targetItem.scrollIntoView({
              behavior: 'smooth',
              block: 'center'
            });
          }, 300);
        }
      }
    }

    // Ejecutar al cargar
    setTimeout(handleHashAction, 500);

    // Ejecutar si el hash cambia sin recargar
    window.addEventListener('hashchange', handleHashAction);

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
      <h3 class="heading-md mb-20 text-dark">Descargar</h3>
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
      background: #126cfb;
      color: #fff;
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