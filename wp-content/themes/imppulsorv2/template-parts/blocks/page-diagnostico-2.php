<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial 2
 */

// ==============================================================
// DMC BROCHURE URLs
// Enter the URL of the corresponding PDF or document.
// If you leave the URL empty (''), no button will appear for that language.
// If all are empty, the "Download the DMC Brochure" button will not appear.
// ==============================================================
$url_brochure_dmc_es = 'https://imppulsor.com/wp-content/uploads/Brochure-Diagnostico-de-Madurez-Comercial_2026_v2.pdf';
$url_brochure_dmc_en = '';
$url_brochure_dmc_pt = '';

$mostrar_boton_brochure = (!empty($url_brochure_dmc_es) || !empty($url_brochure_dmc_en) || !empty($url_brochure_dmc_pt));

get_header();

/**
 * Helper to render buttons consistently and with validation
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
  /* Page-specific styles */
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

  /* Adjustment so the last element inside a separator does not duplicate margins */
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

  /* Utility to ensure sections do not collapse */
  .section {
    position: relative;
    overflow: hidden;
    /* Prevents floats from escaping the container */
  }
</style>

<main class="page-diagnostico bg-white ">

  <?php imppulsor_render_page_hero('default'); ?>

  <?php
  /* =========================================
     BLOCK 1 - Commercial maturity
     ========================================= */
  if (get_field('bloque_1_titulo')): ?>
    <section class="section mt-60 mb-0-mob section-madurez-comercial diag-block-margin reveal">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="text">
            <h2 class="heading-lg">
            What is the Commercial Maturity Diagnostic (DMC)
            </h2>
            <p>
            The DMC is a diagnostic tool built to rigorously assess the structural, technical, and operational maturity of an organization's commercial function. Across 12 core dimensions, it uncovers critical gaps, hidden dependencies, and improvement opportunities that directly affect the ability to acquire, retain, and profitably grow customers — as well as the capabilities needed to scale the commercial operation and strengthen sales effectiveness and productivity.
            </p>
          </div>
          <div class="image-grid text-center h-100 w-100">
            <?php
            $img_1 = get_field('bloque_1_imagen');
            if ($img_1): ?>
              <img src="<?php echo esc_url($img_1); ?>" class="rounded-diagonal w-100 h-100 h-420" alt="Commercial maturity">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  

  <?php
  /* =========================================
     BLOCK 3 - Maturity levels
     ========================================= */
  if (get_field('bloque_3_titulo')): ?>
    <!-- Lower Section: Levels Chart + Text + Buttons -->
    <section class="section section-niveles-madurez diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2 mobile-reverse-col">
            <div class="grid-left" style="position: relative; z-index: 20;">
              <?php get_template_part('template-parts/blocks/bloque-grafico-niveles'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
                Commercial maturity levels
              </h2>
              <p>
              The DMC groups commercial maturity into four levels that reflect an organization's degree of formalization, integration, and adaptive capacity. Each level captures a distinct set of structural, technical, and people capabilities that shape sales performance — and signals how ready the operation is to lift productivity or support business-scale growth.
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>




  <?php
  /* =========================================
     BLOCK 4 - Reveal what the numbers do not show
     ========================================= */
  if (get_field('bloque_4_titulo')): ?>


    <!-- Lower Section: Silhouette Chart + Text + Buttons -->
    <section class="section section-conozca-su-punto-de-partida diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div class="grid-left">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_3_titulo'); ?>
              </h2>
              <p>
              Understand how mature your commercial operation is — and turn that insight into a management tool. The DMC reveals each organization's unique profile, showing clearly which dimensions are well established, which need further development, and how you compare against industry benchmarks. This view consolidates scattered perceptions into a structured, comparable framework, so you can decide with greater precision, focus resources, and chart an improvement roadmap with strategic and operational coherence.
 
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

        <!-- Upper Section: Text + Word Cloud Chart -->

          <div class="grid-2 mobile-reverse-col">

            <div class="grid-left">
              <?php get_template_part('template-parts/blocks/bloque-grafico-nube-palabras'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
              Reveal what the numbers do not show — and get to the root of your organization's perceptions and misalignments
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

  <!-- SECTION 3: How we help -->
  <section class="section section-3 section-3-how-ayudamos reveal reveal-up spp-section">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/section-9-parallax.jpg" alt="" class="spp-bg-image">
    </div>
    <div class="container py-40 px-60 rounded-diagonal section-3-how-ayudamos__panel">
      <div class="grid-2 p-40 text-white align-center">
        <div>
          <h2 class="heading-lg mb-20">The structural link many companies are overlooking</h2>
        </div>
        <div>
          <p>
          Commercial maturity is the structural, technical, and operational maturity an organization has built across its commercial function. It reveals how capabilities such as strategy, planning, technology, leadership, and talent management work together to drive sustainable revenue. Assessing it helps surface structural constraints, anticipate risk, and make better decisions on how to scale sales performance in highly complex environments.
          </p>
        </div>
      </div>
    </div>
  </section>


  <?php
  /* =========================================
     BLOCK 5 - Compare the maturity level
     ========================================= */
  if (get_field('bloque_5_titulo_1')): ?>
    <!-- Row 1: Title + Bar Chart -->
    <section class="section pt-60 section-compare-1 diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div>
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_5_titulo_1'); ?>
              </h2>
              <p>
              Using your Global Commercial Maturity Index (IGMC) score, you can place your operation within one of the four levels in our model and benchmark it against peers. This view makes it clear how advanced — or behind — your organization is, how large the gap is to the reference standard, and how close you are to the next maturity threshold. Understanding this relative position not only clarifies where you stand, but also guides which transformations to prioritize to build competitive advantage.
 
              </p>
            </div>
            <div class="image-grid text-center">
              <?php get_template_part('template-parts/blocks/bloque-grafico-barras-dmc'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Row 2: Bar Chart 2 + Title 2 -->
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
              The DMC is designed to go beyond a surface-level read. Each of its twelve dimensions breaks down into three specific subdimensions, so you can precisely analyze the structural factors behind the area's competitive capabilities. This approach strikes a rigorous balance between breadth and depth, making it easier to identify root causes — not just symptoms. You will gain a clear view of the factors currently enabling or constraining your commercial operation's performance, productivity, and evolution.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Row 3: Heatmap -->
    <section class="section section-heatmap diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">

          <!-- Heatmap Intro -->
          <div>
            <h2 class="heading-md line-left mb-30">
              Get to the root cause of your pain points
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
            ['titulo' => 'Dimension 1', 'subtitulo' => 'Strategy and planning', 'contenido' => 'Assess whether the organization has a clear, shared, and active commercial strategy that guides decision-making, structures operational priorities, and enables consistent, profitable, sustainable execution in target markets.'],
            ['titulo' => 'Dimension 2', 'subtitulo' => 'Corporate governance', 'contenido' => 'Assess whether the governance and leadership structure promotes agile, transparent decision-making aligned with strategic goals.'],
            ['titulo' => 'Dimension 3', 'subtitulo' => 'Innovation and adaptability', 'contenido' => 'Gauge the organization’s ability to embrace continuous innovation, adapt to changing environments, and sustain competitive advantages.'],
            ['titulo' => 'Dimension 4', 'subtitulo' => 'Customer experience', 'contenido' => 'Assess whether the company manages customer experience comprehensively, consistently, and with a focus on value.'],
            ['titulo' => 'Dimension 5', 'subtitulo' => 'Marketing and demand generation', 'contenido' => 'Review the effectiveness of marketing and demand-generation efforts as drivers of commercial growth.'],
            ['titulo' => 'Dimension 6', 'subtitulo' => 'Sales methodology', 'contenido' => 'Assess the maturity of sales processes and the standardization of practices that ensure efficiency and consistency.'],
            ['titulo' => 'Dimension 7', 'subtitulo' => 'Digitalization, automation, and AI', 'contenido' => 'Assess the level of technology integration and the use of AI tools in sales and customer management.'],
            ['titulo' => 'Dimension 8', 'subtitulo' => 'Monitoring and data analysis', 'contenido' => 'Gauge the organization’s ability to measure, analyze, and make decisions based on reliable, timely information.'],
            ['titulo' => 'Dimension 9', 'subtitulo' => 'Operational efficiency', 'contenido' => 'Assess the efficient use of resources, time management, and sales team productivity.'],
            ['titulo' => 'Dimension 10', 'subtitulo' => 'Organization', 'contenido' => 'Analyze the organizational structure and how well it aligns with commercial goals and strategies.'],
            ['titulo' => 'Dimension 11', 'subtitulo' => 'Leadership', 'contenido' => 'Assess leadership quality, team empowerment, and the ability to inspire sustainable results.'],
            ['titulo' => 'Dimension 12', 'subtitulo' => 'Talent management', 'contenido' => 'Analyze the organization’s ability to attract, develop, and retain high-performing sales talent.']
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
                <p>Systemic view of the sales function, showing how processes,
                  structure, technology, talent, and leadership connect
                  and how they impact the ability to generate sustainable,
                  scalable revenue.</p>
              </li>
              <li><span class="num">2</span>
                <p>Identification of structural gaps and critical areas for intervention that limit
                  operational efficiency, create unwanted dependencies, or reduce executive control over sales performance.
                </p>
              </li>
              <li><span class="num">3</span>
                <p>Objective measurement of commercial maturity based on a 12-dimension model, with
                  qualitative and quantitative indicators to prioritize evidence-based improvements.</p>
              </li>
              <li><span class="num">4</span>
                <p>Benchmarking against regional and industry peers to put results in context and chart
                  realistic growth paths against comparable references.</p>
              </li>
              <li><span class="num">5</span>
                <p>Generation of strategic inputs for decision-making, including organizational redesign,
                  investment planning, capability building, sales model restructuring, or key
                  role adjustments.</p>
              </li>
              <li><span class="num">6</span>
                <p>Lower risk in structural sales decisions, backed by a robust analytical
                  framework that aligns vision, action, and results around efficiency, autonomy, and sustainability.</p>
              </li>
            </ul>

            <div class="image-grid">

              <div class="mt-40 btn-links"><a href="https://imppulsor.com/contact/" class="btn-arrow"
                  target="_self">Request a meeting with our specialists</a>
                <br>
                <a href="https://imppulsor.com/success-stories/" class="btn-arrow" target="_self">Explore our success
                  stories</a><br>
              </div>

              <?php if ($mostrar_boton_brochure): ?>
                <div class="mt-20 btn-links">
                  <button class="btn-brochure-dmc btn-brochure-dmc-open">Download the DMC Brochure</button>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="image-grid">
            <?php
            $img_10 = get_field('bloque_10_imagen');
            if ($img_10): ?>
              <img src="<?php echo esc_url($img_10); ?>" class="rounded-diagonal w-100 h-420" alt="Work team">
            <?php endif; ?>

          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- Success Stories Block -->
  <section class="section bg-ellipse diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </section>

  <!-- Eight Areas Block -->
  <section class="section mb-60 diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-ocho-areas'); ?>
  </section>

  <!-- International Experience Block -->
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </section>

  <!-- Insights Block -->
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
  <!-- DMC Brochure Modals -->
  <div id="brochure-popup" class="brochure-popup-overlay">
    <div class="brochure-popup-content">
      <button id="close-brochure-popup" class="brochure-popup-close">&times;</button>
      <h3 class="heading-md mb-20 text-dark">Download</h3>
      <p class="mb-30 text-dark">Please select the brochure language you'd like to download:</p>

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