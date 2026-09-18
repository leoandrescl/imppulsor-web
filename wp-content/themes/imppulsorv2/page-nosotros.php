<?php
/**
 * Template Name: Nosotros
 * Description: Página Nosotros — estructura base siguiendo Impulsor v2.
 */

// ==============================================================
// CORPORATE DECK URLS
// Enter the URL of the corresponding PDF or document.
// If you leave a URL empty (''), the button for that language will not appear.
// If all are empty, the "Download our corporate presentation" button will not appear.
// ==============================================================
$url_presentacion_es = 'https://imppulsor.com/wp-content/uploads/Presentacion-de-Servicios-2026_v3.pdf';
$url_presentacion_en = '';
$url_presentacion_pt = '';

$mostrar_boton_presentacion = (!empty($url_presentacion_es) || !empty($url_presentacion_en) || !empty($url_presentacion_pt));

get_header();
?>

<main class="page-nosotros bg-light">

  <!--  -->

  <div class="hero-slider__bloque-1">

    <?php imppulsor_render_page_hero('default'); ?>

    <!-- Section: Who we are -->
    <section class="section bg-white text-dark fade-in">
      <div class="container grid-2">

        <!-- Left column -->
        <div>
          <h2 class="heading-lg mb-20 mb-0-mob">Who we are</h2>
         
        </div>

        <!-- Right column -->
        <div>


          <p>
          We are a boutique consultancy specializing in business maturity diagnostics, capability benchmarking, and strategic execution frameworks. We help organizations gain clarity on their strategic, structural, and operational challenges — and turn them into concrete decisions and measurable results.

          </p>

          <a href="/equipo/" class="btn-arrow mt-20-mob">
            Meet the team behind every transformation
          </a>

          <?php if ($mostrar_boton_presentacion): ?>
            <button class="btn-presentation btn-presentation-open mt-20">Download our
              corporate presentation</button>
          <?php endif; ?>
        </div>

      </div>
    </section>

  </div>



  <!-- Section: Our mission + Our commitment -->
  <section class="section fade-in nosotros-mision-compromiso pt-0  pb-0-mob">
    <div class="container px-0-mob">
      <div class="grid-2 gap-0 nosotros-mision-compromiso__grid">

        <div class="nosotros-mision-compromiso__media">
          <img
            src="/wp-content/uploads/mision-compromiso.jpg"
            alt="Our mission and our commitment"
            class="nosotros-mision-compromiso__img w-100 object-cover"
            loading="lazy"
            decoding="async"
          >
        </div>

        <div class="nosotros-mision-compromiso__panels">
          <div class="bg-light-blue grid align-center text-white py-60 px-60 nosotros-mision-compromiso__panel">
            <div class="max-width-550">
              <h2 class="heading-lg mb-20">Our mission</h2>
              <p>
                We bring clarity to organizations at every stage of development through business maturity diagnostics that pinpoint the right problems, uncover their root causes, and deliver actionable recommendations to strengthen value creation at each phase of the business lifecycle.
              </p>
            </div>
          </div>

          <div class="grid align-center py-60 px-60 nosotros-mision-compromiso__panel nosotros-mision-compromiso__panel--light">
            <div class="max-width-550">
              <h2 class="heading-lg mb-20 text-dark">Our commitment</h2>
              <p>
                At Imppulsor, we are committed to delivering business maturity diagnostics that combine analytical depth, systems thinking, and real-world applicability. Every engagement is held to a high professional standard, grounded in consulting best practices and centered on the client.
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <style>
    .nosotros-mision-compromiso__grid {
      align-items: stretch;
    }

    .nosotros-mision-compromiso__media,
    .nosotros-mision-compromiso__panels {
      min-width: 0;
    }

    .nosotros-mision-compromiso__media {
      display: flex;
      min-height: 100%;
    }

    .nosotros-mision-compromiso__img {
      display: block;
      width: 100%;
      height: 100%;
      min-height: 320px;
      object-fit: cover;
      object-position: center;
    }

    .nosotros-mision-compromiso__panels {
      display: grid;
      grid-template-rows: 1fr 1fr;
    }

    .nosotros-mision-compromiso__panel {
      min-width: 0;
    }

    .nosotros-mision-compromiso__panel--light {
      background: #fff;
    }

    @media (max-width: 992px) {
      .nosotros-mision-compromiso__panels {
        grid-template-rows: auto;
      }

      .nosotros-mision-compromiso__img {
        min-height: 280px;
        aspect-ratio: 16 / 10;
        height: auto;
        object-position: top;
      }

      .nosotros-mision-compromiso__panel {
        padding-left: 20px !important;
        padding-right: 20px !important;
      }
    }
  </style>
  <!-- ========================================= -->


  <!-- Section: A value proposition built for transformation -->
  <!-- Section: A value proposition built for transformation -->
  <section class="section fade-in spp-section">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/una-propuesta-parallax.jpg" alt="" class="spp-bg-image">
    </div>
    <div class="container">

      <div class="bg-dark text-white rounded-diagonal py-60 px-60 grid-2">
        <!-- Left column -->
        <div>
          <h2 class="heading-lg mb-20">A value proposition<br>built for transformation</h2>

        </div>

        <!-- Right column -->
        <div>
          <p>
          Our value proposition rests on two integrated capabilities that enable organizational transformation: business maturity diagnostics and management consulting solutions. Together, these pillars form a robust, modular engagement architecture adaptable to each organization's operating reality.
 
          </p>

          <a href="/soluciones/" class="btn-arrow mt-20-mob">Explore our solutions</a>
          <a href="/contacto/" class="btn-arrow">Request a meeting with our specialists</a>
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->


  <!-- Block: Success stories -->
  <div class="bg-dark-blue pb-60 pb-0-mob">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>
  <!-- ========================================= -->



  <!-- Section: Featured capabilities -->
  <section class="section bg-white fade-in pb-60">
    <div class="container text-dark">

      <!-- Main heading -->
      <h2 class="heading-lg mb-60 mb-40-mob">Our capabilities</h2>

      <!-- Capabilities grid -->
      <div class="grid-2">

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">1</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Research rigor</h3>
          </div>
          <p>
            We design diagnostics grounded in advanced social and organizational research
            methodologies and practices,
            delivering precise, actionable results.
          </p>
        </div>

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">2</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Actionable solutions</h3>
          </div>
          <p>
            We combine strategic thinking, operational design, and effective project governance
            to ensure every recommended solution is feasible, relevant, and executable.
          </p>
        </div>

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">3</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">E-Service delivery</h3>
          </div>
          <p>
            We deliver exclusively through digital platforms,
            ensuring fast access, efficient interaction, and scalability to
            serve clients across markets.
          </p>
        </div>

        <div class="mb-20-mob mb-0-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">4</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Technology and innovation</h3>
          </div>
          <p>
            We apply data science and advanced analytics to connect
            the business's critical dots, delivering data-driven
            diagnostics that drive real, measurable impact.
          </p>
        </div>
      </div>

      

    </div>
  </section>
  <!-- ========================================= -->


  <!-- Block: Our international experience -->
  <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>

  <!-- Block: Professional contact -->
  <section class="contacto-profesional-bg-gradiente">
    <?php get_template_part('template-parts/blocks/bloque-contacto-profesional'); ?>
  </section>


  <!-- Section: Who we work with -->
  <section class="section fade-in pb-120 perfil-clientes-gradiente"
    style="background-image: url('/wp-content/uploads/bg-gradiente-1.svg'); background-repeat: no-repeat; background-size: cover; background-position: center; color: #fff;">
    <div class="container text-white">

      <!-- Sub-block (Who we work with) -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 mb-0-mob text-white">Who we work with</h2>

        </div>

        <div>
          <p class="mb-20">
            We work with early-stage, consolidating, and scaling companies
            facing complex challenges that call for a systemic approach to transformative decision-making.
          </p>
          <p class="mb-20">
            We focus on organizations showing structural symptoms such as underleveraged
            growth potential
            , weak organizational capabilities, or misalignment between strategy and execution.
          </p>
          <p class="mb-20-mob">
            What defines our clients is not their industry, but their willingness to see themselves clearly,
            benchmark against demanding standards, and act accordingly.
          </p>

          <a href="/casos-de-exito/" class="btn-arrow ">Explore our success stories</a>
          <a href="/clientes-y-socios-de-negocios/" class="btn-arrow ">Meet the organizations that already trust
            us</a>
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->




  <!-- Insights block -->
  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>



</main>

<?php if ($mostrar_boton_presentacion): ?>
  <!-- Presentation modals -->
  <div id="presentation-popup" class="presentation-popup-overlay">
    <div class="presentation-popup-content">
      <button id="close-presentation-popup" class="presentation-popup-close">&times;</button>
      <h3 class="heading-md mb-20 text-dark">Download</h3>
      <p class="mb-30 text-dark">Please select the language of the presentation you would like to download:</p>

      <div class="presentation-langs">
        <?php if (!empty($url_presentacion_es)): ?>
          <a href="<?php echo esc_url($url_presentacion_es); ?>" target="_blank" class="lang-btn" download>
            <img src="/wp-content/plugins/gtranslate/flags/svg/es.svg" alt="Español" width="30" height="30">
            <span>Español</span>
          </a>
        <?php endif; ?>
        <?php if (!empty($url_presentacion_en)): ?>
          <a href="<?php echo esc_url($url_presentacion_en); ?>" target="_blank" class="lang-btn" download>
            <img src="/wp-content/plugins/gtranslate/flags/svg/en.svg" alt="English" width="30" height="30">
            <span>English</span>
          </a>
        <?php endif; ?>
        <?php if (!empty($url_presentacion_pt)): ?>
          <a href="<?php echo esc_url($url_presentacion_pt); ?>" target="_blank" class="lang-btn" download>
            <img src="/wp-content/plugins/gtranslate/flags/svg/pt-br.svg" alt="Português" width="30" height="30">
            <span>Português</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <style>
    .perfil-clientes-gradiente,
    .perfil-clientes-gradiente p,
    .perfil-clientes-gradiente h1,
    .perfil-clientes-gradiente h2,
    .perfil-clientes-gradiente h3,
    .perfil-clientes-gradiente h4,
    .perfil-clientes-gradiente h5,
    .perfil-clientes-gradiente h6,
    .perfil-clientes-gradiente a {
      color: #fff !important;
    }

    .contacto-profesional-bg-gradiente {
      background: none;
    }


    .btn-presentation {
      background-color: var(--azul-claro, #126cfb);
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

    .btn-presentation:hover {
      background-color: var(--gris, #f5f5f5);
      color: #000;
    }

    /* Popup Overlays */
    .presentation-popup-overlay {
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

    .presentation-popup-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .presentation-popup-content {
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

    .presentation-popup-overlay.active .presentation-popup-content {
      transform: translateY(0);
    }

    .presentation-popup-close {
      position: absolute;
      top: 10px;
      right: 10px;
      background: transparent;
      border: none;
      font-size: 28px;
      cursor: pointer;
      color: #333;
      transition: color 0.2s;
    }

    .presentation-popup-close:hover {
      background: var(--azul-claro, #126cfb);
    }

    .presentation-langs {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .presentation-langs .lang-btn {
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

    .presentation-langs .lang-btn:hover {
      background: var(--gris, #f5f5f5);
      border-color: var(--azul-claro, #126cfb);
      color: var(--azul-claro, #126cfb);
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btnsOpen = document.querySelectorAll('.btn-presentation-open');
      const popup = document.getElementById('presentation-popup');
      const btnClose = document.getElementById('close-presentation-popup');

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