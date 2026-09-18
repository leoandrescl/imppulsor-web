<?php
/**
 * Template Name: Soluciones
 * Description: Página Soluciones — estructura base siguiendo Impulsor v2.
 */
get_header();
?>

<main class="page-soluciones">

  <!--  -->

  <div class="hero-slider__bloque-1">

    <?php imppulsor_render_page_hero('default'); ?>


  </div>

  <!-- =========================================
     SECCIÓN 2: Diagnósticos + Cómo funciona
     ========================================= -->
  <section class="section section-2 pb-0 fade-in">
    <div class="container">

      <!-- Bloque principal -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 text-dark">Soluciones de consultoría</h2>

          <p>
          Algunas organizaciones acumulan ideas, planes y buenas intenciones, pero se enfrentan a un problema recurrente: la brecha entre la estrategia y la capacidad real de ejecución. Esto conlleva iniciativas que no avanzan, proyectos que se diluyen, esfuerzos de cambio que consumen recursos sin generar impacto sostenible.
          </p>

          <p>
          En Imppulsor ayudamos a cerrar esa brecha con soluciones de consultoría en gestión empresarial diseñadas para convertir el conocimiento y las ideas estratégicas en decisiones accionables, adaptando nuestras propuestas a las capacidades de cada organización, evitando soluciones genéricas que ignoran el contexto operativo y cultural.
          </p>

        </div>

        <div class="h-420">
          <img src="/wp-content/uploads/Soluciones-Consultoria-2.jpg" alt="Diagnósticos de madurez empresarial" class="w-100  object-cover">
        </div>
      </div>
      

    </div>
  </section>
  <!-- ========================================= -->

  <!-- =========================================
     SECCIÓN 4: El resultado
     ========================================= -->

  <!-- Soluciones de consultoría -->
  <section class="section section-8 pt-0 fade-in text-dark">
    <div class="container">

      <div class="text-dark separator mb-40"></div>

      <h2 class="heading-lg mb-20 text-dark mb-40">Cómo trabajamos</h2>

      <div class="grid-2">

        <div class="  pb-20">
          <span class="num text-white">1</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Discovery empresarial</h3>
          <p class="mt-30">
          Investigamos su modelo de negocio, desafíos prioritarios, restricciones operativas y capacidades clave para definir el alcance correcto de intervención y evitar soluciones mal enfocadas.

          </p>
        </div>

        <div class="  pb-20">
          <span class="num text-white">2</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Adherencia organizacional</h3>
          <p class="mt-30">
          Diseñamos soluciones con fit organizacional, alineadas a la estrategia y ajustadas a las capacidades, restricciones y condiciones reales de implementación de cada empresa.
          </p>
        </div>

        <div class="  pb-20">
          <span class="num text-white">3</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Acompañamiento inicial</h3>
          <p class="mt-30">
          Acompañamos la ejecución inicial para transformar decisiones en acciones concretas, instalando planificación, seguimiento y retroalimentación que sostengan avances visibles y medibles.
          </p>
        </div>

        <div class="  pb-20 pb-0-mob">
          <span class="num text-white">4</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Visión holística</h3>
          <p class="mt-30">
          Integramos una mirada sistémica sobre funciones, procesos, personas, tecnología y datos para conectar los puntos críticos que condicionan el desempeño empresarial.
          </p>
        </div>

      </div>

    </div>
  </section>
  <!-- ========================================= -->



  <!-- SECCIÓN Imagen parallax -->
  <section class="section section-9 bg-light fade-in spp-section" style="aspect-ratio: 1728 / 503; width: 100%;">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/section-9-parallax.jpg" alt="" class="spp-bg-image">
    </div>
  </section>

  <!-- =========================================
     SECCIÓN 4: El resultado
     ========================================= -->
     <section class="section bg-white text-dark section-4 pb-0 fade-in">
    <div class="container grid-2">

      <!-- Columna izquierda -->
      <div>
        <h2 class="heading-lg mb-20 mb-0-mob">El resultado</h2>
        
      </div>

      <!-- Columna derecha -->
      <div>
        <p class="mb-20">
        Una solución de consultoría práctica y accionable que permite a los directivos avanzar con claridad sobre preguntas críticas:
        </p>

        <ul class="list-check mb-20">
          <li>¿Qué debe rediseñarse para mejorar la ejecución y capturar valor real?</li>
          <li>¿Cómo convertir prioridades estratégicas en capacidades, procesos y estructuras viables?</li>
          <li>¿Qué cambios deben implementarse primero para generar impacto con menor riesgo?</li>
        </ul>

        <p>
        Las organizaciones que trabajan con nuestras soluciones logran transformar desafíos específicos en intervenciones concretas, ajustadas a su realidad operativa, nivel de madurez y capacidad de implementación.
        </p>

        <a href="/contacto/" class="btn-arrow  mobile-only-cta mt-20-mob">Solicite una reunión con nuestros especialistas</a>

        <a href="/contacto/" class="btn-arrow  desktop-only-cta">Solicite una reunión con nuestros
          especialistas</a>
          
      </div>

    </div>
  </section>





  <div class="container text-dark">
    <div class="separator mb-60 separator-mob mb-40-mob mt-20-mob"></div>
  </div>

  <!-- bloque ocho areas gestion -->
  <div class="py-40-mob">
    <?php get_template_part('template-parts/blocks/bloque-ocho-areas-gestion'); ?>
  </div>


  <!-- Bloque: Casos de éxito -->
  <div class="bg-dark-blue pb-60 pb-0-mob">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>
  <!-- ========================================= -->

  <!-- bloque con un marco que conecta todos los puntos -->
  <section class="section py-60 bg-light-blue text-white fade-in">
    <div class="container grid-2 align-center px-0-mob">

      <div class="soluciones-marco__media">
        <img
          src="/wp-content/uploads/marco-conecta-todos-los-puntos.jpg"
          alt="Con un marco que conecta todos los puntos"
          class="soluciones-marco__img w-100 object-cover"
          loading="lazy"
          decoding="async"
        >
      </div>

      <div class="soluciones-marco__content">
        <h3 class="heading-sm mb-10">¿Cómo lo hacemos?</h3>
        <h2 class="heading-lg mb-20">Con un marco que conecta todos los puntos</h2>

        <p>
        De esta forma diseñamos soluciones de gestión empresarial con una visión integral de la operación y centrados en aquello que realmente impacta el desempeño.
        </p>
      </div>

    </div>
  </section>

  <style>
    .soluciones-marco__media,
    .soluciones-marco__content {
      min-width: 0;
    }

    .soluciones-marco__img {
      display: block;
      width: 100%;
      max-width: 100%;
      height: auto;
      aspect-ratio: 4 / 3;
      object-fit: cover;
      object-position: center;
    }

    @media (max-width: 992px) {
      .soluciones-marco__img {
        aspect-ratio: 16 / 10;
      }
    }
  </style>
  <!-- ========================================= -->



  <!-- Bloque: Tome acción, vaya a la raíz de sus desafíos -->
  <section class="section pb-0 fade-in">
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
          La granularidad de nuestra propuesta de valor permite que nuestros clientes diagnóstiquen el estado de sus
          capacidades de gestión, desarrollen una mejora crítica o aborden la necesidad de gobernar un cambio
          estructural en función de sus capacidades y objetivos.
        </p>
        <ul class="list-check">
          <li>
            Nuestros diagnósticos le permiten acceder a una comprensión más clara y profunda de su organización, revelar
            conexiones causales entre variables clave y facilitar decisiones informadas con mayor enfoque estratégico.
          </li>
          <li>
            Diseñamos soluciones ajustadas a la realidad operativa y nivel de madurez de cada organización, combinando
            relevancia analítica con viabilidad práctica.
          </li>
          <li>
            Acompañamos la ejecución con modelos de gobernanza estructurados y seguimiento riguroso, asegurando
            coherencia, trazabilidad y resultados sostenibles en el tiempo.
          </li>
          <li>
            Actuamos bajo una lógica sistémica que conecta funciones, personas, tecnología y procesos, generando impacto
            integral y alineado con los objetivos estratégicos del negocio.
          </li>
        </ul>
      </div>

    </div>
  </section>
  <!-- ========================================= -->

  <section class="section sep-linea bg-light">
    <div class="container sep-linea__inner"></div>
  </section>


 <!-- Bloque: Nuestro perfil de clientes -->
 <section class="section pt-0 pb-60 bg-white text-dark fade-in">
    <div class="container grid-2">

      <!-- Columna izquierda -->
      <div>
        <h2 class="heading-lg mb-0-mob">Nuestro perfil de clientes</h2>
        
      </div>

      <!-- Columna derecha -->
      <div>
        <p>
          Colaboramos con empresas en etapas tempranas, de consolidación o en fases avanzadas de escalabilidad que
          enfrentan desafíos complejos y requieren un abordaje sistémico para tomar decisiones transformadoras.
        </p>
        <p>Nos enfocamos en organizaciones que presentan síntomas estructurales como bajo aprovechamiento de su
          potencial de crecimiento, debilidad en sus capacidades organizacionales o desconexión entre estrategia y
          ejecución. Lo que define a nuestros clientes no es su industria, sino su disposición a verse con claridad, medirse
          frente a estándares exigentes y actuar en consecuencia. </p>
        

          <a href="/clientes-y-socios-de-negocios/" class="btn-arrow mt-20-mob">
          Conoce a quienes ya confiaron en nosotros
        </a>
      </div>
      

    </div>
  </section>
  <!--  -->


  <!-- ========================================= -->

  <!-- Bloque: Nuestra experiencia internacional -->
  <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>


 






  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>

</main>

<?php get_footer(); ?>