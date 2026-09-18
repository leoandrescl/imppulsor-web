<?php
/**
 * Template Name: Diagnóstico de Madurez Comercial
 */

// ==============================================================
// DMC BROCHURE URLs
// Enter the URL of the corresponding PDF or document.
// If you leave the URL empty (''), the button for that language will not appear.
// If all are empty, the "Download the DMC Brochure" button will not appear.
// ==============================================================
$url_brochure_dmc_es = '';
$url_brochure_dmc_en = '';
$url_brochure_dmc_pt = '';

$mostrar_boton_brochure = (!empty($url_brochure_dmc_es) || !empty($url_brochure_dmc_en) || !empty($url_brochure_dmc_pt));

get_header();

/**
 * Helper to render block buttons
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
  // BLOCK 1 - Commercial maturity 
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
              alt="Commercial maturity, the structural link many companies are overlooking.">
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOCK 2 - What the commercial maturity diagnostic is
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
          <img src="<?php the_field('bloque_2_imagen'); ?>" alt="Commercial maturity diagnostic diagram">
          <?php
          //  get_template_part( 'template-parts/blocks/bloque-grafico-dmc' ); 
          ?>
        </div>
      </div>
    </section>
  <?php endif; ?>


  <?php
  // BLOCK 3 - Know your starting point
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
  // BLOCK 4 - Reveal what the numbers don't show
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
        // Dynamic buttons from ACF
        $boton1 = get_field('bloque_4_boton_1');
        $boton2 = get_field('bloque_4_boton_2');

        if ($boton1 || $boton2): ?>
          <div class="mt-40 btn-links">
            <?php
            $boton1 = get_field('bloque_4_boton_1');
            $boton2 = get_field('bloque_4_boton_2');

            // Helper function to render each button
            function render_acf_link($boton)
            {
              if (is_array($boton) && isset($boton['url']) && isset($boton['title'])) {
                echo '<a href="' . esc_url($boton['url']) . '" class="btn-arrow">' . esc_html($boton['title']) . '</a><br>';
              } elseif (is_string($boton) && !empty($boton)) {
                echo '<a href="' . esc_url($boton) . '" class="btn-arrow">Read more</a><br>';
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
  // BLOCK 5 - Compare the maturity level
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
          // Dynamic buttons from ACF
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
  // BLOCK 6 - Testimonial 
  ?>
  <div class="my-60">
    <?php get_template_part('template-parts/blocks/bloque', 'testimonio'); ?>
  </div>




  <?php
  // BLOCK 7 - What is this diagnostic for?
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
  // BLOCK 8
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
  // BLOCK 9 - ANALYSIS DIMENSIONS
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
  // BLOCK 10 - Why take the diagnostic?
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

          <div class="image-grid teeest">
            <img src="<?php the_field('bloque_10_imagen'); ?>" class="rounded-diagonal w-100 h-420"
              alt="Team collaborating">


            <div class="mt-40 btn-links"><a href="https://imppulsor.com/contacto/" class="btn-arrow mt-20-mob"
                target="_self">Request a meeting with our specialists</a>

              <br>
              <?php if ($mostrar_boton_brochure): ?>
                <!-- brochure download button goes here -->
                <button class="btn-brochure-dmc btn-brochure-dmc-open mt-20">Download the DMC Brochure</button>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- success stories carousel block  -->
  <div class="bg-ellipse">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>
  <!-- eight areas block -->
  <?php get_template_part('template-parts/blocks/bloque-ocho-areas'); ?>

  <div class="mt-60">
    <!-- international experience block -->
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
  </div>

  <!-- insights carousel block -->
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
  <!-- DMC Brochure Modals -->
  <div id="brochure-popup" class="brochure-popup-overlay">
    <div class="brochure-popup-content">
      <button id="close-brochure-popup" class="brochure-popup-close">&times;</button>
      <h3 class="heading-md mb-20 text-dark">Download DMC brochure</h3>
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