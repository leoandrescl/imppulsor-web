<?php
/**
 * Template Name: Front Page
 */
get_header();
?>

<main class="page-home">

  <?php imppulsor_render_page_hero('slider'); ?>

  <div class="bg-no-gradient">
  <?php get_template_part('template-parts/blocks/bloque-introduccion-conectar-los-puntos-home'); ?>
  </div>


  <?php get_template_part('template-parts/blocks/bloque-como-ayudamos-a-nuestros-clientes'); ?>


<!-- Bloque: Tome acción, vaya a la raíz de sus desafíos -->
<section class="section bg-light pb-60 reveal reveal-up">
    <div class="container grid-2">

      <!-- Columna izquierda -->
      <div>
        <h2 class="heading-lg mb-20 text-dark mb-0-mob">
          Tome acción, vaya a la raíz de sus desafíos
        </h2>
        
      </div>

      <!-- Columna derecha -->
      <div>
      <p class="mb-20">
      Nuestros diagnósticos de madurez empresarial permiten comprender con mayor claridad el estado real de sus capacidades de gestión, identificar brechas estructurales y priorizar decisiones de mejora, transformación o escalamiento según la etapa, objetivos y restricciones de su organización.
        </p>
        <ul class="list-check">
          <li>
          Revelan causas raíz detrás de síntomas visibles, conectando datos, percepciones y evidencia para comprender qué limita realmente el desempeño empresarial.
          </li>
          <li>
          Entregan una lectura estructurada del nivel de madurez de la organización, separando lo crítico de lo accesorio y lo urgente de lo estratégico.
          </li>
          <li>
          Orientan decisiones de inversión, rediseño organizacional y desarrollo de capacidades, reduciendo el riesgo de actuar sobre diagnósticos incompletos o intuiciones aisladas.
          </li>
          <li>
          Transforman información dispersa en una hoja de ruta accionable, alineada con la realidad operativa, los objetivos estratégicos y la capacidad de ejecución.
          </li>
        </ul>
      </div>

    </div>
  </section>
  <!-- ========================================= -->




  

  <div class="pb-40 pb-0-mob bg-dark-solid">
  <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>







  <!-- Sección: Capacidades destacadas -->
  <section class="section bg-white reveal reveal-up pb-60">
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



  <section class="section py-0 bg-white">
    <div class="container">
      <div class="text-dark separator separator-0"></div>
    </div>
  </section>



    <!-- Sección: perfil de clientes -->
    <section class="section reveal reveal-up pb-60"
    style="background-color: #fff !important;">
    <div class="container">

      <!-- Subbloque siguiente (Nuestro perfil de clientes) -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 mb-0-mob">Nuestro perfil de clientes</h2>

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


          <div class="texto-expandible texto-expandible--oculto">
            <p>
            Lo que define a nuestros clientes no es su industria, sino su disposición a verse con claridad,
            medirse frente a estándares exigentes y actuar en consecuencia.
            </p>
          </div>

          <a href="#" class="texto-expandible__toggle mt-10 d-block">Leer más …</a>

          <a href="/clientes-y-socios-de-negocios/" class="btn-arrow mt-20-mob">Conoce a quienes ya confiaron en
            nosotros</a>
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->



    <!-- Bloque: Nuestra experiencia internacional -->
    <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>




  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>

  

  


</main>

<style>
  div#hero-swiper {
    margin-bottom: -26px;
  }


  .separator-0::after {
    padding-top: 0;
  }
</style>

<?php get_footer(); ?>



