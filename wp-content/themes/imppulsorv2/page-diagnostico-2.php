<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial 2
 */

// ==============================================================
// DMC BROCHURE URLs
// Enter the URL of the corresponding PDF or document.
// If you leave the URL empty (''), the button for that language will not appear.
// If all are empty, the "Download the DMC Brochure" button will not appear.
// ==============================================================
$url_brochure_dmc_es = 'https://imppulsor.com/wp-content/uploads/Brochure-Diagnostico-de-Madurez-Comercial_2026_v2.pdf';
$url_brochure_dmc_en = '';
$url_brochure_dmc_pt = '';

$mostrar_boton_brochure = (!empty($url_brochure_dmc_es) || !empty($url_brochure_dmc_en) || !empty($url_brochure_dmc_pt));

get_header();

/**
 * Helper to render buttons consistently and safely
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

  /* Adjust so the last element inside a separator does not duplicate margins */
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
    /* Prevent floats from escaping the container */
  }
</style>

<main class="page-diagnostico page-diagnostico-2 bg-white">

  <?php imppulsor_render_page_hero('default'); ?>

  <?php
  /* =========================================
     BLOCK 1 - Commercial maturity
     ========================================= */
  if (get_field('bloque_1_titulo')): ?>
    <section class="section mb-0-mob section-madurez-comercial diag-block-margin fade-in">
      <div class="container section--light separator">
        <div class="grid-2">
          <div class="text">
            <h2 class="heading-lg">
            What Is the Commercial Maturity Diagnostic
            </h2>
            <p>
            The DMC is a tool built to assess in depth the structural, technical, and operational development of an organization’s commercial function. By analyzing 12 key dimensions, it uncovers critical gaps, hidden dependencies, and improvement opportunities that directly affect the ability to acquire, retain, and profitably grow customers—as well as the capabilities needed to scale the sales operation or improve sales effectiveness and productivity.
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
    <!-- Lower section: Levels Chart + Text + Buttons -->
    <section class="section section-niveles-madurez diag-block-margin fade-in">
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
              The DMC classifies commercial maturity into four levels that reflect an organization’s degree of formalization, integration, and adaptive capacity. Each level represents a specific set of structural, technical, and human capabilities that shape sales performance and show how prepared the operation is to improve sales productivity or support business scaling.
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>




  <?php
  /* =========================================
     BLOCK 4 - Reveal what the numbers don't show
     ========================================= */
  if (get_field('bloque_4_titulo')): ?>


    <!-- Lower section: Silhouette Chart + Text + Buttons -->
    <section class="section section-conozca-su-punto-de-partida diag-block-margin fade-in">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2">
            <div class="grid-left">
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_3_titulo'); ?>
              </h2>
              <p>
              Assess your sales operation’s development level and turn it into a management tool. The DMC reveals each organization’s unique profile, showing clearly which dimensions are well established, which need further development, and how they compare against industry peers. This view brings scattered perceptions into a structured, comparable analytical framework, enabling more precise decisions, focused resources, and an improvement roadmap with strategic and operational coherence.

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

        <!-- Upper section: Text + Word Cloud Chart -->

          <div class="grid-2 mobile-reverse-col">

            <div class="grid-left">
              <?php get_template_part('template-parts/blocks/bloque-grafico-nube-palabras'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
              Uncover what the numbers don't show and get to the heart of your organization's perceptions and disconnects
              </h2>
              <p>
                <?php the_field('bloque_4_texto'); ?>
              </p>

          </div>
        </div>
      </div>
    </section>

  <?php endif; ?>

  <!-- SECTION 3: Parallax + panel (mobile = Nosotros, desktop = centered overlay) -->
  <section class="section section-3 section-diagnostico-parallax fade-in spp-section">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/section-9-parallax.jpg" alt="" class="spp-bg-image">
    </div>
    <div class="container">

      <div class="section-diagnostico-parallax__panel bg-dark text-white rounded-diagonal py-60 px-60 grid-2">
        <div>
          <h2 class="heading-lg mb-20">The structural link many companies are overlooking</h2>
        </div>
        <div>
          <p>
          Commercial maturity is the level of structural, technical, and operational development an organization has reached in its commercial function. It shows how key capabilities—such as strategy, planning, technology, leadership, and talent management—work together to generate revenue sustainably. Assessing it helps identify structural constraints, anticipate risks, and make better decisions about how to scale sales performance in highly complex environments.
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
    <section class="section pt-60 section-compare-1 diag-block-margin fade-in">
      <div class="container section--light pt-0 pt-40-mob">
        <div class="separator">
          <div class="grid-2">
            <div>
              <h2 class="heading-md line-left mb-30">
                <?php the_field('bloque_5_titulo_1'); ?>
              </h2>
              <p>
              Based on your IGMC score, you can place your operation within one of the four levels defined by our model and compare it against the benchmark. This view clearly shows how advanced or behind your organization is, the gap versus the reference standard, and how close you are to the next maturity threshold. Understanding this relative position not only clarifies the current state, but also guides which transformations to prioritize to build competitive advantage.

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
              The DMC is designed to go beyond a surface-level reading. Each of its twelve analysis dimensions breaks down into three specific subdimensions that pinpoint the structural factors behind the area’s competitive capabilities. This approach strikes a rigorous balance between breadth and depth, making it easier to identify root causes—not just symptoms. You will gain a clear view of the factors that currently enable or constrain your sales operation’s performance, productivity, and growth.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Row 1 (repeated): text left + IGMC chart right -->
    <section class="section section-compare-1 diag-block-margin fade-in">
      <div class="container section--light pt-0 pb-0">
        <div class="grid-2">
            <div>
              <h2 class="heading-md line-left mb-30">
                Get to the root cause of your pain points
              </h2>
              <p>
                The model drills down to the finest level of detail, showing the development level achieved in each subdimension of the commercial function. This view clearly reveals where the levers driving growth are—and where the factors holding it back persist. By connecting both levels, you get a practical lens to prioritize interventions, focus resources, and guide decisions with greater precision.
              </p>
              <div class="mt-20 btn-links">
                <a href="https://imppulsor.com/contacto/" class="btn-arrow mt-20-mob" target="_self">Request a meeting with our specialists</a>
              </div>
              <div class="mt-20 btn-links">
                <button type="button" class="btn-brochure-dmc btn-brochure-dmc-open">Download the DMC brochure</button>
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
     BLOCK 6 - Testimonials (Our clients' voice)
     ========================================= */
  ?>
  <div class="diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque', 'testimonio-voz-clientes'); ?>
  </div>


  <?php
  /* =========================================
     BLOCK 7 - What is it for?
     ========================================= */
  if (get_field('bloque_7_titulo')): ?>
    <section class="section section-para-que-sirve-este-diagnostico bg-gradient-13 text-white diag-block-margin fade-in">
      <div class="container section--p-60">
        <div class="grid-2">
          <div>
            <h2 class="heading-lg mb-20">
            What is this diagnostic for?
            </h2>
            <p class="mb-20">The DMC is designed to help organizations assess how prepared their sales operation is to improve performance or navigate a business scaling process.</p>
            <p class="mb-0">
            It evaluates the organizational ability to generate revenue profitably, efficiently, and predictably, identifying the structural gaps that limit sales autonomy, create critical dependencies, or reduce effectiveness in converting, retaining, and growing customers.
            </p>
          </div>
          <div>
            <ul class="list-check">
              <li>Identify strengths and vulnerabilities across structure, processes, talent, technology, and leadership.</li>
              <li>Pinpoint critical gaps and structural causes that limit efficiency, scalability, or sustainable sales results.</li>
              <li>Measure maturity across the 12 dimensions, building a clear map of the company’s commercial development stage.</li>
              <li>Analyze how organizational dynamics affect the effectiveness, consistency, and sustainability of the sales system.</li>
              <li>Compare performance against industry and regional benchmarks, contextualizing findings and charting realistic growth paths.</li>
              <li>Prioritize actions to strengthen sales control, reduce dependencies, improve efficiency, and unlock sales productivity potential.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOCK 8 - Additional Information (2 columns)
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
     BLOCK 9 - ANALYSIS DIMENSIONS
     ========================================= */
  if (get_field('bloque_9_titulo')): ?>
    <section class="section section-dimensiones-de-analisis pb-0 diag-block-margin fade-in">
      <div class="container section--light pt-60 pb-0">
        <div class="grid-2">
          <div class="grid-left">
            <h2 class="heading-lg mb-0">
            Analysis dimensions

            </h2>
          </div>
          <div class="grid-right">
          The DMC is built around twelve interdependent commercial maturity dimensions, grouped by Structural Domains of the Sales Operation. Each dimension is further broken down into three management subdimensions. Each unit of analysis represents a set of organizational capabilities that together define a company’s commercial maturity level. This granularity lets us rigorously examine each pain point to identify the right problem and the causes behind it.

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
     BLOCK 10 - Why take the diagnostic?
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
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Understand how your operation works</h3>
            </div>
            <p>
              Systemic view of the commercial function, showing how processes,
              structure, technology, talent, and leadership connect, and how they affect the ability to generate
              sustainable, scalable revenue.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">2</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Identify the right problems</h3>
            </div>
            <p>
              Identification of management gaps that limit operating efficiency, create unwanted
              dependencies, or reduce executive control over sales performance.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">3</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Measure your development level with evidence</h3>
            </div>
            <p>
              Objective measurement of commercial maturity based on a 12-dimension model, with
              qualitative and quantitative indicators to prioritize evidence-based improvements.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">4</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Benchmark your position against the industry</h3>
            </div>
            <p>
              Benchmarking against regional and industry peers to contextualize results and define
              realistic evolution paths based on comparable references.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">5</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Reduce the risk of poor decisions</h3>
            </div>
            <p>
              Reduced risk in structural commercial decisions through a robust analytical framework
              that aligns vision, action, and results around efficiency, autonomy, and sustainability.
            </p>
          </div>

          <div class="mb-20-mob">
            <div class="flex items-center mb-30">
              <span class="num text-white">6</span>
              <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Prioritize improvements with structural impact</h3>
            </div>
            <p>
              Strategic inputs for decision-making, including organizational redesign,
              investment planning, capability building, sales model restructuring, or key-role
              adjustments.
            </p>
          </div>
        </div>

        <div class="mt-40 btn-links">
          <a href="https://imppulsor.com/contacto/" class="btn-arrow mt-20-mob" target="_self">Request a meeting with our specialists</a>
        </div>

        <?php if ($mostrar_boton_brochure): ?>
          <div class="mt-20 btn-links">
            <button type="button" class="btn-brochure-dmc btn-brochure-dmc-open">Download the DMC brochure</button>
          </div>
        <?php endif; ?>

      </div>
    </section>
  <?php endif; ?>


  <!-- International Experience Block -->
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </section>

  <!-- Insights Block -->
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

    // Function to open from hash (#dimension-N classic or #dimension-v2-N in v2 accordions)
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
  <!-- DMC Brochure Modals -->
  <div id="brochure-popup" class="brochure-popup-overlay">
    <div class="brochure-popup-content">
      <button id="close-brochure-popup" class="brochure-popup-close">&times;</button>
      <h3 class="heading-md mb-20 text-dark">Download</h3>
      <p class="mb-30 text-dark">Please select the brochure language you would like to download:</p>

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