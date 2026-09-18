<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial 3
 */
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

<main class="page-diagnostico">

  <?php imppulsor_render_page_hero('default'); ?>

  <?php
  /* =========================================
     BLOCK 1 - Commercial maturity
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
              <img src="<?php echo esc_url($img_1); ?>" class="rounded-diagonal w-100 h-100 h-420" alt="Commercial maturity">
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOCK 2 - What the diagnostic is
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
     BLOCK 3 - Maturity levels
     ========================================= */
  if (get_field('bloque_3_titulo')): ?>
    <!-- Lower section: Levels Chart + Text + Buttons -->
    <section class="section section-niveles-madurez diag-block-margin reveal">
      <div class="container section--light pt-0">
        <div class="separator">
          <div class="grid-2 mobile-reverse-col">
            <div class="grid-left" style="position: relative; z-index: 20;">
              <?php get_template_part('template-parts/blocks/bloque-grafico-niveles-fadein'); ?>
            </div>

            <div class="grid-right">
              <h2 class="heading-md line-left mb-30">
                Commercial Maturity Levels
              </h2>
              <p>
                <?php the_field('bloque_4_texto_inferior'); ?>
              </p>

              <?php
              // Block 4 buttons rendering
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
     BLOCK 4 - Reveal what the numbers don't show
     ========================================= */
  if (get_field('bloque_4_titulo')): ?>


    <!-- Lower section: Silhouette Chart + Text + Buttons -->
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

        <!-- Upper section: Text + Word Cloud Chart -->
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
     BLOCK 5 - Compare the maturity level
     ========================================= */
  if (get_field('bloque_5_titulo_1')): ?>
    <!-- Row 1: Title + Bar Chart -->
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

    <!-- Row 2: Bar Chart 2 + Title 2 -->
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
            <?php get_template_part('template-parts/blocks/bloque-grafico-heatmap-fadein'); ?>
          </div>

          <!-- Final Buttons -->
          <div class="text-left mt-40">
            <?php
            // Block 5 buttons rendering
            impulsor_render_buttons('bloque_5', 3);
            ?>
          </div>

        </div>
      </div> <!-- End Container -->
    </section>
  <?php endif; ?>

  <?php
  /* =========================================
     BLOCK 6 - Testimonials
     ========================================= */
  ?>
  <section class="section section-testimonios diag-block-margin">
    <div class="container my-60">
      <?php get_template_part('template-parts/blocks/bloque', 'testimonio'); ?>
    </div>
  </section>


  <?php
  /* =========================================
     BLOCK 7 - What is it for?
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
     BLOCK 8 - Additional Information (2 columns)
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
     BLOCK 9 - ANALYSIS DIMENSIONS
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
          // We define the dimensions manually as requested, to keep the original content.
          $dimensiones = [
            ['titulo' => 'Dimension 1', 'subtitulo' => 'Strategy and planning', 'contenido' => 'Assess whether the organization has a clear, shared, and active commercial strategy that guides decision-making, structures operating priorities, and enables consistent, profitable, and sustainable execution in target markets.'],
            ['titulo' => 'Dimension 2', 'subtitulo' => 'Corporate governance', 'contenido' => 'Evaluate whether the governance and leadership structure enables agile, transparent decision-making aligned with strategic objectives.'],
            ['titulo' => 'Dimension 3', 'subtitulo' => 'Innovation and adaptability', 'contenido' => 'Assess the organization’s ability to embed continuous innovation, adapt to changing environments, and sustain competitive advantage.'],
            ['titulo' => 'Dimension 4', 'subtitulo' => 'Customer experience', 'contenido' => 'Assess whether the company manages the customer experience in an integrated, consistent, and value-centered way.'],
            ['titulo' => 'Dimension 5', 'subtitulo' => 'Marketing and demand generation', 'contenido' => 'Review how effective marketing and demand-generation efforts are as a driver of commercial growth.'],
            ['titulo' => 'Dimension 6', 'subtitulo' => 'Sales methodology', 'contenido' => 'Evaluate the maturity of sales processes and the standardization of practices that ensure efficiency and consistency.'],
            ['titulo' => 'Dimension 7', 'subtitulo' => 'Digitalization, automation, and AI', 'contenido' => 'Assess the level of technology integration and the use of AI tools in sales and customer management.'],
            ['titulo' => 'Dimension 8', 'subtitulo' => 'Data monitoring and analytics', 'contenido' => 'Assess the organization’s ability to measure, analyze, and make decisions based on reliable, timely information.'],
            ['titulo' => 'Dimension 9', 'subtitulo' => 'Operational efficiency', 'contenido' => 'Evaluate efficient resource use, time management, and sales team productivity.'],
            ['titulo' => 'Dimension 10', 'subtitulo' => 'Organization', 'contenido' => 'Assess the organizational structure and how well it aligns with commercial objectives and strategies.'],
            ['titulo' => 'Dimension 11', 'subtitulo' => 'Leadership', 'contenido' => 'Evaluate leadership quality, team empowerment, and the ability to inspire sustainable results.'],
            ['titulo' => 'Dimension 12', 'subtitulo' => 'Talent management', 'contenido' => 'Assess the organization’s ability to attract, develop, and retain high-performing commercial talent.']
          ];

          $col1 = array_slice($dimensiones, 0, 6);
          $col2 = array_slice($dimensiones, 6);

          // Helper to render accordion
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
     BLOCK 10 - Why take the diagnostic?
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
                <p>Systemic view of the commercial function, showing how processes,
                  structure, technology, talent, and leadership connect, and how they affect the ability to generate
                  sustainable, scalable revenue.</p>
              </li>
              <li><span class="num">2</span>
                <p>Identification of structural gaps and critical areas for intervention that limit operating
                  efficiency, create unwanted dependencies, or reduce executive control over commercial performance.
                </p>
              </li>
              <li><span class="num">3</span>
                <p>Objective measurement of commercial maturity based on a 12-dimension model, with
                  qualitative and quantitative indicators to prioritize evidence-based improvements.</p>
              </li>
              <li><span class="num">4</span>
                <p>Benchmarking against regional and industry peers to contextualize results and define
                  realistic evolution paths based on comparable references.</p>
              </li>
              <li><span class="num">5</span>
                <p>Strategic inputs for decision-making, including organizational redesign,
                  investment planning, capability building, sales model restructuring, or key-role
                  adjustments.</p>
              </li>
              <li><span class="num">6</span>
                <p>Reduced risk in structural commercial decisions through a robust analytical
                  framework that aligns vision, action, and results around efficiency, autonomy, and sustainability.</p>
              </li>
            </ul>
          </div>

          <div class="image-grid">
            <?php
            $img_10 = get_field('bloque_10_imagen');
            if ($img_10): ?>
              <img src="<?php echo esc_url($img_10); ?>" class="rounded-diagonal w-100 h-420" alt="Work team">
            <?php endif; ?>

            <?php
            // Block 10 Buttons
            impulsor_render_buttons('bloque_10', 3);
            ?>
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
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-ocho-areas'); ?>
  </section>

  <!-- International Experience Block -->
  <section class="section diag-block-margin">
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </section>

  <!-- Insights Block -->
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

        // Close others
        /* Optional: For strict accordion behavior (one open at a time), uncomment:
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