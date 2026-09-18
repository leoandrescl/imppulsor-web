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

<main class="page-diagnostico page-diagnostico-2 bg-white">

  <?php imppulsor_render_page_hero('default'); ?>

  <?php
  /* =========================================
     BLOQUE 1 - Madurez comercial
     ========================================= */
  if (get_field('bloque_1_titulo')): ?>
    <section class="section mb-0-mob section-madurez-comercial diag-block-margin fade-in">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="text">
            <h2 class="heading-lg">
            Qué es el Diagnóstico de Madurez Comercial
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
    <section class="section section-niveles-madurez diag-block-margin fade-in">
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
    <section class="section section-conozca-su-punto-de-partida diag-block-margin fade-in">
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

    <section class="section section-revele-lo-que-los-numeros-no-muestran diag-block-margin fade-in">
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

  <!-- SECCIÓN 3: Parallax + panel (mobile = Nosotros, desktop = overlay centrado) -->
  <section class="section section-3 section-diagnostico-parallax fade-in spp-section">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/section-9-parallax.jpg" alt="" class="spp-bg-image">
    </div>
    <div class="container">

      <div class="section-diagnostico-parallax__panel bg-dark text-white rounded-diagonal py-60 px-60 grid-2">
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
    <section class="section pt-60 section-compare-1 diag-block-margin fade-in">
      <div class="container section--light pt-0 pt-40-mob">
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
    <section class="section section-compare-2 diag-block-margin fade-in">
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

    <!-- Fila 1 (repetida): texto izquierda + gráfico IGMC derecha -->
    <section class="section section-compare-1 diag-block-margin fade-in">
      <div class="container section--light pt-0 pb-0">
        <div class="grid-2">
            <div>
              <h2 class="heading-md line-left mb-30">
                Vaya a la causa raíz de sus zonas de dolor
              </h2>
              <p>
                El modelo permite descender hasta el máximo nivel de detalle, mostrando el grado de desarrollo alcanzado en cada subdimensión de la función comercial. Esta lectura revela con claridad dónde están las palancas que impulsan el crecimiento y dónde persisten factores que lo inhiben. Al conectar ambos planos, se obtiene una visión práctica para priorizar intervenciones, concentrar recursos y orientar decisiones con mayor precisión.
              </p>
              <div class="mt-20 btn-links">
                <a href="https://imppulsor.com/contacto/" class="btn-arrow mt-20-mob" target="_self">Solicite una reunión con nuestros especialistas</a>
              </div>
              <div class="mt-20 btn-links">
                <button type="button" class="btn-brochure-dmc btn-brochure-dmc-open">Descarga el brochure del DMC</button>
              </div>
            </div>
            <div class="image-grid text-center">
              <?php get_template_part('template-parts/blocks/bloque-grafico-barras-dmc', null, array('instance' => 2)); ?>
            </div>
          </div>
        </div>
    </section>

    <section class="section bg-light pt-0 pb-0">
      <div class="container text-dark">
        <div class="separator"></div>
      </div>
    </section>

  <?php endif; ?>

  <?php
  /* =========================================
     BLOQUE 6 - Testimonios (La voz de nuestros clientes)
     ========================================= */
  ?>
  <div class="diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque', 'testimonio-voz-clientes'); ?>
  </div>


  <?php
  /* =========================================
     BLOQUE 7 - ¿Para qué sirve?
     ========================================= */
  if (get_field('bloque_7_titulo')): ?>
    <section class="section section-para-que-sirve-este-diagnostico bg-gradient-13 text-white diag-block-margin fade-in">
      <div class="container section--p-60">
        <div class="grid-2">
          <div>
            <h2 class="heading-lg mb-20">
            ¿Para qué sirve este diagnóstico?
            </h2>
            <p class="mb-20">El DMC tiene como propósito ayudar a la organización a descubrir cuán preparada está la operación comercial para mejorar su desempeño o enfrentar un proceso de escalación empresarial.</p>
            <p class="mb-0">
            Evalúa la capacidad organizacional para generar ingresos de forma rentable, eficiente y predecible, identificando aquellas brechas estructurales que limitan la autonomía comercial, generan dependencias críticas o reducen la efectividad en la conversión, retención y desarrollo de clientes.
            </p>
          </div>
          <div>
            <ul class="list-check">
              <li>Identificar fortalezas y vulnerabilidades en estructura, procesos, talento, tecnología y liderazgo.</li>
              <li>Identificar brechas críticas y causas estructurales que limitan la eficiencia, escalabilidad o sostenibilidad de los resultados comerciales.</li>
              <li>Medir la madurez alcanzada en las 12 dimensiones, construyendo un mapa claro del estado de desarrollo comercial de la empresa.</li>
              <li>Analizar cómo la dinámica organizacional influye en la efectividad, coherencia y sostenibilidad del sistema comercial.</li>
              <li>Comparar el desempeño con benchmarks sectoriales y regionales, contextualizando hallazgos y proyectando trayectorias realistas de evolución.</li>
              <li>Priorizar acciones para fortalecer el control comercial, reducir dependencias, mejorar eficiencia y habilitar el potencial de productividad comercial.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOQUE 8 - Información Adicional (2 columnas)
     ========================================= */
  if (get_field('bloque_8_titulo_1')): ?>
    <section class="section diag-block-margin fade-in">
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
    <section class="section section-dimensiones-de-analisis pb-0 diag-block-margin fade-in">
      <div class="container section--light pt-60 pb-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-lg mb-0">
            Dimensiones de análisis

            </h2>
          </div>
          <div class="grid-right">
          El DMC se estructura en torno a doce dimensiones interdependientes de madurez comercial, agrupadas por Dominios Estructurales de la Operación Comercial. A su vez, cada dimensión se desagrega en tres subdimensiones de gestión. Cada unidad de análisis representa un conjunto de capacidades organizacionales que, en conjunto, definen el nivel de madurez comercial de una empresa. Este nivel de granularidad nos permite analizar con rigor cada zona de dolor, hasta identificar el problema correcto y las causas que lo explican.
 
          </div>
        </div>

        <div class="section separator">
    <div class="container">
      <div class="separator-line"></div>
    </div>
  </div>

        <?php get_template_part('template-parts/blocks/bloque', 'dimensiones-analisis-dmc-clasico'); ?>
      </div>
    </section>

    <section class="section section-dimensiones-analisis-dmc-v2 diag-block-margin fade-in">
      <div class="container section--light text-dark">
        <?php get_template_part('template-parts/blocks/bloque', 'dimensiones-analisis-dmc-v2'); ?>
      </div>
    </section>
  <?php endif; ?>


 <section class="section py-0 bg-white">
  <div class="container">
    <div class="text-dark separator separator-0"></div>
  </div>
</section>
  

  <?php
  /* =========================================
     BLOQUE 10 – ¿Por qué tomar el diagnóstico?
     ========================================= */
  if (get_field('bloque_10_titulo')): ?>
    <section class="section section-por-que-tomar-el-diagnostico diag-block-margin mt-0 fade-in">
      <div class="container section--light text-dark">

        <h2 class="heading-lg mb-60">
          <?php the_field('bloque_10_titulo'); ?>
        </h2>

        <div class="grid-2">

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">1</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Entienda como funciona su operación</h3>
            </div>
            <p>
              Visualización sistémica de la función comercial, permitiendo entender cómo se articulan procesos,
              estructura, tecnología, talento y liderazgo, y cómo impactan en la capacidad de generar ingresos
              sostenibles y escalables.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">2</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Identifique los problemas correctos</h3>
            </div>
            <p>
              Identificación de brechas de gestión que limitan la eficiencia operativa, generan dependencias indeseadas
              o reducen el control directivo sobre el desempeño comercial.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">3</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Mida su nivel de desarrollo con evidencia</h3>
            </div>
            <p>
              Medición objetiva del nivel de madurez comercial a partir de un modelo de 12 dimensiones clave, con
              indicadores cualitativos y cuantitativos que permiten priorizar mejoras con base en evidencia.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">4</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Compare su posición frente a la industria</h3>
            </div>
            <p>
              Comparación frente a un benchmark regional y sectorial, para contextualizar resultados y definir
              trayectorias de evolución realistas en función de referentes comparables.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">5</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Reduzca el riesgo de decidir mal</h3>
            </div>
            <p>
              Reducción del riesgo en decisiones comerciales estructurales, al contar con un marco de análisis robusto
              que alinea visión, acción y resultados con foco en eficiencia, autonomía y sostenibilidad.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">6</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Priorice mejoras con impacto estructural</h3>
            </div>
            <p>
              Generación de insumos estratégicos para la toma de decisiones, incluyendo rediseño organizacional,
              definición de inversiones, desarrollo de capacidades, reorganización del modelo comercial o ajustes en
              roles clave.
            </p>
          </div>
        </div>

        <div class="mt-40 btn-links">
          <a href="https://imppulsor.com/contacto/" class="btn-arrow mt-20-mob" target="_self">Solicite una reunión con nuestros especialistas</a>
        </div>

        <?php if ($mostrar_boton_brochure): ?>
          <div class="mt-20 btn-links">
            <button type="button" class="btn-brochure-dmc btn-brochure-dmc-open">Descarga el brochure del DMC</button>
          </div>
        <?php endif; ?>

      </div>
    </section>
  <?php endif; ?>


  <!-- Bloque Experiencia Internacional -->
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </section>

  <!-- Bloque Insights -->
  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>

</main>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll(
      '.section-dimensiones-analisis-dmc-v2 .accordion-header, .section-dimensiones-de-analisis .accordion-header'
    );

    function closeAccordion(header) {
      header.classList.remove('active');
      const content = header.nextElementSibling;
      if (content && content.classList.contains('accordion-content')) {
        content.style.height = '0';
      }
    }

    function openAccordion(header) {
      const content = header.nextElementSibling;
      if (!content || !content.classList.contains('accordion-content')) return;
      const inner = content.querySelector('.accordion-content-inner');
      if (!inner) return;
      header.classList.add('active');
      content.style.height = inner.scrollHeight + 'px';
    }

    function closeAllAccordions(exceptHeader) {
      headers.forEach((h) => {
        if (h !== exceptHeader) {
          closeAccordion(h);
        }
      });
    }

    headers.forEach((header) => {
      header.addEventListener('click', () => {
        const isActive = header.classList.contains('active');
        if (isActive) {
          closeAccordion(header);
        } else {
          closeAllAccordions(header);
          openAccordion(header);
        }
      });
    });

    // Función para abrir desde hash (#dimension-N clásico o #dimension-v2-N en acordeones v2)
    function handleHashAction() {
      const hash = window.location.hash;
      if (!hash || hash.length < 2) return;
      const isV2 = hash.startsWith('#dimension-v2-');
      const isClassic = hash.startsWith('#dimension-') && !isV2;
      if (!isV2 && !isClassic) return;
      const targetItem = document.querySelector(hash);
      if (targetItem) {
        const header = targetItem.querySelector('.accordion-header');
        const content = targetItem.querySelector('.accordion-content');
        if (!header || !content) return;
        const inner = content.querySelector('.accordion-content-inner');
        if (!inner) return;

        closeAllAccordions(header);

        if (!header.classList.contains('active')) {
          header.classList.add('active');
          content.style.height = inner.scrollHeight + 'px';
        }

        setTimeout(() => {
          targetItem.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }, 300);
      }
    }

    setTimeout(handleHashAction, 500);

    window.addEventListener('hashchange', handleHashAction);

    window.addEventListener('resize', () => {
      document
        .querySelectorAll(
          '.section-dimensiones-analisis-dmc-v2 .accordion-header.active, .section-dimensiones-de-analisis .accordion-header.active'
        )
        .forEach((h) => {
          const content = h.nextElementSibling;
          const inner = content.querySelector('.accordion-content-inner');
          content.style.height = inner.scrollHeight + 'px';
        });
    });
  });
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

    .separator-0::after {
      padding-top: 0;
    }

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