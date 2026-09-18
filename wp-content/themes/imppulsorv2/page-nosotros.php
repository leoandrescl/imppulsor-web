<?php
/**
 * Template Name: Nosotros
 * Description: Página Nosotros — estructura base siguiendo Impulsor v2.
 */

// ==============================================================
// URLs DE PRESENTACIÓN CORPORATIVA
// Ingresa la URL del PDF o documento correspondiente.
// Si dejas la URL vacía (''), no aparecerá el botón para ese idioma.
// Si todas están vacías, no aparecerá el botón "Descarga nuestra presentación".
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

    <!-- Sección: Quiénes somos -->
    <section class="section bg-white text-dark fade-in">
      <div class="container grid-2">

        <!-- Columna izquierda -->
        <div>
          <h2 class="heading-lg mb-20 mb-0-mob">Quiénes somos</h2>
         
        </div>

        <!-- Columna derecha -->
        <div>


          <p>
          Somos una consultora boutique especializada en diagnósticos de madurez empresarial, benchmarking de capacidades y marcos de ejecución estratégica. Ayudamos a las organizaciones a comprender con claridad sus desafíos estratégicos, estructurales y operativos, para transformarlos en decisiones y resultados concretos.
 
          </p>

          <a href="/equipo/" class="btn-arrow mt-20-mob">
            Conoce al equipo detrás de cada transformación
          </a>

          <?php if ($mostrar_boton_presentacion): ?>
            <button class="btn-presentation btn-presentation-open mt-20">Descarga nuestra
              presentación</button>
          <?php endif; ?>
        </div>

      </div>
    </section>

  </div>



  <!-- Sección: Nuestra misión + Nuestro compromiso -->
  <section class="section fade-in nosotros-mision-compromiso pt-0  pb-0-mob">
    <div class="container px-0-mob">
      <div class="grid-2 gap-0 nosotros-mision-compromiso__grid">

        <div class="nosotros-mision-compromiso__media">
          <img
            src="/wp-content/uploads/mision-compromiso.jpg"
            alt="Nuestra misión y nuestro compromiso"
            class="nosotros-mision-compromiso__img w-100 object-cover"
            loading="lazy"
            decoding="async"
          >
        </div>

        <div class="nosotros-mision-compromiso__panels">
          <div class="bg-light-blue grid align-center text-white py-60 px-60 nosotros-mision-compromiso__panel">
            <div class="max-width-550">
              <h2 class="heading-lg mb-20">Nuestra misión</h2>
              <p>
                Ofrecer claridad a organizaciones en distintas etapas de desarrollo mediante diagnósticos de madurez empresarial que identifiquen los problemas correctos, sus causas raíz y propuestas accionables para fortalecer su capacidad de creación de valor en cada fase de su ciclo de vida.
              </p>
            </div>
          </div>

          <div class="grid align-center py-60 px-60 nosotros-mision-compromiso__panel nosotros-mision-compromiso__panel--light">
            <div class="max-width-550">
              <h2 class="heading-lg mb-20 text-dark">Nuestro compromiso</h2>
              <p>
                En Imppulsor nos comprometemos a entregar diagnósticos de madurez empresarial que combinen profundidad analítica, mirada sistémica y aplicabilidad real. En cada proyecto asumimos un alto estándar de trabajo, orientado por buenas prácticas de consultoría y con el cliente al centro de nuestro quehacer.
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


  <!-- Sección: Una propuesta para transformar -->
  <!-- Sección: Una propuesta para transformar -->
  <section class="section fade-in spp-section">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/una-propuesta-parallax.jpg" alt="" class="spp-bg-image">
    </div>
    <div class="container">

      <div class="bg-dark text-white rounded-diagonal py-60 px-60 grid-2">
        <!-- Columna izquierda -->
        <div>
          <h2 class="heading-lg mb-20">Una propuesta<br>para transformar</h2>

        </div>

        <!-- Columna derecha -->
        <div>
          <p>
          Nuestra propuesta de valor se articula sobre dos capacidades integradas que habilitan procesos de transformación organizacional: diagnósticos de madurez empresarial y soluciones de consultoría en gestión. Estos dos pilares conforman una arquitectura de intervención robusta, modular y adaptable a la realidad operativa de cada organización.
 
          </p>

          <a href="/soluciones/" class="btn-arrow mt-20-mob">Explora nuestras soluciones</a>
          <a href="/contacto/" class="btn-arrow">Solicite una reunión con nuestros especialistas</a>
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->


  <!-- Bloque: Casos de éxito -->
  <div class="bg-dark-blue pb-60 pb-0-mob">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>
  <!-- ========================================= -->



  <!-- Sección: Capacidades destacadas -->
  <section class="section bg-white fade-in pb-60">
    <div class="container text-dark">

      <!-- Título principal -->
      <h2 class="heading-lg mb-60 mb-40-mob">Nuestras capacidades</h2>

      <!-- Grid de capacidades -->
      <div class="grid-2">

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">1</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Rigor investigativo</h3>
          </div>
          <p>
            Diseñamos diagnósticos basados en metodologías y prácticas avanzadas
            de investigación de fenómenos sociales y organizacionales,
            garantizando resultados precisos y accionables.
          </p>
        </div>

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">2</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Soluciones accionables</h3>
          </div>
          <p>
            Combinamos pensamiento estratégico, diseño operativo y una gobernanza efectiva de proyectos
            para asegurar que cada solución propuesta sea factible, relevante y ejecutable.
          </p>
        </div>

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">3</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Despliegue E-Service</h3>
          </div>
          <p>
            Ofrecemos experiencias exclusivamente a través de plataformas digitales,
            garantizando acceso rápido, interacción eficiente y escalabilidad para
            atender a clientes en distintos mercados.
          </p>
        </div>

        <div class="mb-20-mob mb-0-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">4</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Tecnología e innovación</h3>
          </div>
          <p>
            Aplicamos ciencia de datos y técnicas avanzadas de análisis para conectar
            los puntos críticos del negocio, asegurando diagnósticos basados en datos
            sólidos que generan impacto real y medible.
          </p>
        </div>
      </div>

      

    </div>
  </section>
  <!-- ========================================= -->


  <!-- Bloque: Nuestra experiencia internacional -->
  <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>

  <!-- Bloque: Contacto profesional -->
  <section class="contacto-profesional-bg-gradiente">
    <?php get_template_part('template-parts/blocks/bloque-contacto-profesional'); ?>
  </section>


  <!-- Sección: perfil de clientes -->
  <section class="section fade-in pb-120 perfil-clientes-gradiente"
    style="background-image: url('/wp-content/uploads/bg-gradiente-1.svg'); background-repeat: no-repeat; background-size: cover; background-position: center; color: #fff;">
    <div class="container text-white">

      <!-- Subbloque siguiente (Nuestro perfil de clientes) -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 mb-0-mob text-white">Nuestro perfil de clientes</h2>

        </div>

        <div>
          <p class="mb-20">
            Colaboramos con empresas en etapas tempranas, de consolidación o en fases avanzadas de escalabilidad
            que enfrentan desafíos complejos y requieren un abordaje sistémico para tomar decisiones transformadoras.
          </p>
          <p class="mb-20">
            Nos enfocamos en organizaciones que presentan síntomas estructurales como bajo aprovechamiento de su
            potencial
            de crecimiento, debilidad en sus capacidades organizacionales o desconexión entre estrategia y ejecución.
          </p>
          <p class="mb-20-mob">
            Lo que define a nuestros clientes no es su industria, sino su disposición a verse con claridad,
            medirse frente a estándares exigentes y actuar en consecuencia.
          </p>

          <a href="/casos-de-exito/" class="btn-arrow ">Descubre nuestros casos de éxito</a>
          <a href="/clientes-y-socios-de-negocios/" class="btn-arrow ">Conoce a quienes ya confiaron en
            nosotros</a>
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->




  <!-- Bloque: Insights -->
  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>



</main>

<?php if ($mostrar_boton_presentacion): ?>
  <!-- Modales de Presentación -->
  <div id="presentation-popup" class="presentation-popup-overlay">
    <div class="presentation-popup-content">
      <button id="close-presentation-popup" class="presentation-popup-close">&times;</button>
      <h3 class="heading-md mb-20 text-dark">Descargar</h3>
      <p class="mb-30 text-dark">Por favor, selecciona el idioma de la presentación que deseas descargar:</p>

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