<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial 3
 */
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

<main class="page-diagnostico">

  <?php imppulsor_render_page_hero('default'); ?>

  <?php
  /* =========================================
     BLOQUE 1 - Madurez comercial
     ========================================= */
  if (get_field('bloque_1_titulo')): ?>
    <section class="section mt-60 section-madurez-comercial diag-block-margin reveal">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="text">
            <h2 class="heading-lg">
              <?php the_field('bloque_1_titulo'); ?>
            </h2>
            <p>
              <?php the_field('bloque_1_texto'); ?>
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
     BLOQUE 2 – Qué es el diagnóstico
     ========================================= */
  if (get_field('bloque_2_titulo')): ?>
    <section class="section section-que-es-el-diagnostico diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div class="grid-left">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_2_titulo'); ?>
              </h2>
              <p>
                <?php the_field('bloque_2_texto'); ?>
              </p>
            </div>
            <div class="grid-right">
              <?php get_template_part('template-parts/blocks/bloque-grafico-dmc-grilla-fadein'); ?>
            </div>
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
              <?php get_template_part('template-parts/blocks/bloque-grafico-niveles-fadein'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
                Niveles de Madurez Comercial
              </h2>
              <p>
                <?php the_field('bloque_4_texto_inferior'); ?>
              </p>

              <?php
              // Renderizado de botones Bloque 4
              impulsor_render_buttons('bloque_4', 2);
              ?>
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
                <?php the_field('bloque_3_texto'); ?>
              </p>
            </div>
            <div class="grid-right">
              <div class="separator-wrapper-graphic">
                <!-- Added wrapper specific for graphics if needed, but using separator as requested -->
                <?php get_template_part('template-parts/blocks/bloque-grafico-silueta-fadein'); ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-revele-lo-que-los-numeros-no-muestran diag-block-margin reveal">
      <div class="container section--light pt-0">

        <!-- Parte Superior: Texto + Grafico Nube -->
        <div class="separator">
          <div class="grid-2 mobile-reverse-col">
            <div class="grid-left">
              <?php get_template_part('template-parts/blocks/bloque-grafico-nube-palabras-fadein'); ?>
            </div>
            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_4_titulo'); ?>
              </h2>
              <p>
                <?php the_field('bloque_4_texto'); ?>
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>

  <?php endif; ?>




  <?php
  /* =========================================
     BLOQUE 5 - Compare el nivel de madurez
     ========================================= */
  if (get_field('bloque_5_titulo_1')): ?>
    <!-- Fila 1: Titulo + Grafico Barras -->
    <section class="section section-compare-1 diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div>
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_5_titulo_1'); ?>
              </h2>
              <p>
                <?php the_field('bloque_5_texto_1'); ?>
              </p>
            </div>
            <div class="image-grid text-center">
              <?php get_template_part('template-parts/blocks/bloque-grafico-barras-dmc-fadein'); ?>
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
              <?php get_template_part('template-parts/blocks/bloque-grafico-barras-estrategia-y-planificacion-fadein'); ?>
            </div>
            <div class="d-flex flex-column justify-center">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_5_titulo_2'); ?>
              </h2>
              <p>
                <?php the_field('bloque_5_texto_2'); ?>
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
            <?php get_template_part('template-parts/blocks/bloque-grafico-heatmap-fadein'); ?>
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
      <div class="container section--light separator pt-0">
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

        <div class="mt-60">
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
            foreach ($items as $item): ?>
              <div class="accordion-item">
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
          </div>

          <div class="image-grid">
            <?php
            $img_10 = get_field('bloque_10_imagen');
            if ($img_10): ?>
              <img src="<?php echo esc_url($img_10); ?>" class="rounded-diagonal w-100 h-420" alt="Equipo de trabajo">
            <?php endif; ?>

            <?php
            // Botones Bloque 10
            impulsor_render_buttons('bloque_10', 3);
            ?>
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
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-ocho-areas'); ?>
  </section>

  <!-- Bloque Experiencia Internacional -->
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </section>

  <!-- Bloque Insights -->
  <section class="section">
    <?php get_template_part('template-parts/blocks/bloque-insights'); ?>
  </section>

</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.accordion-header');

    headers.forEach(header => {
      const content = header.nextElementSibling;
      header.addEventListener('click', () => {
        const isActive = header.classList.contains('active');

        // Cerrar otros
        /* Opcional: Si se desea comportamiento de acordeón estricto (uno abierto a la vez), descomentar:
        headers.forEach(h => {
           if(h !== header) {
              h.classList.remove('active');
              h.nextElementSibling.style.height = 0;
           }
        });
        */

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

    window.addEventListener('resize', () => {
      document.querySelectorAll('.accordion-header.active').forEach(h => {
        const content = h.nextElementSibling;
        const inner = content.querySelector('.accordion-content-inner');
        content.style.height = inner.scrollHeight + 'px';
      });
    });
  });
</script>

<?php get_footer(); ?>