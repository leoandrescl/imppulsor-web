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
      SECTION 2: Diagnostics + How it works
     ========================================= -->
  <section class="section section-2 pb-0 fade-in">
    <div class="container">

      <!-- MAIN block -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 text-dark">Consulting solutions</h2>

          <p>
          Some organizations accumulate ideas, plans, and good intentions, yet run into a recurring problem: the gap between strategy and real execution capacity. The result is stalled initiatives, diluted projects, and change efforts that consume resources without delivering sustainable impact.
          </p>

          <p>
          At Imppulsor, we close that gap with business management consulting solutions designed to turn knowledge and strategic ideas into actionable decisions, tailoring our engagements to each organization's capabilities and avoiding generic solutions that ignore operational and cultural context.
          </p>

        </div>

        <div class="h-420">
          <img src="/wp-content/uploads/Soluciones-Consultoria-2.jpg" alt="Business maturity diagnostics" class="w-100  object-cover">
        </div>
      </div>
      

    </div>
  </section>
  <!-- ========================================= -->

  <!-- =========================================
      SECTION 4: The outcome
     ========================================= -->

  <!-- Consulting solutions -->
  <section class="section section-8 pt-0 fade-in text-dark">
    <div class="container">

      <div class="text-dark separator mb-40"></div>

      <h2 class="heading-lg mb-20 text-dark mb-40">How we work</h2>

      <div class="grid-2">

        <div class="  pb-20">
          <span class="num text-white">1</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Business discovery</h3>
          <p class="mt-30">
          We investigate your business model, priority challenges, operational constraints, and key capabilities to define the right scope of intervention and avoid misdirected solutions.

          </p>
        </div>

        <div class="  pb-20">
          <span class="num text-white">2</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Organizational fit</h3>
          <p class="mt-30">
          We design solutions with organizational fit, aligned to strategy and tailored to each company's real implementation capabilities, constraints, and conditions.
          </p>
        </div>

        <div class="  pb-20">
          <span class="num text-white">3</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Early execution support</h3>
          <p class="mt-30">
          We support early execution to turn decisions into concrete actions, putting in place planning, follow-up, and feedback that sustain visible, measurable progress.
          </p>
        </div>

        <div class="  pb-20 pb-0-mob">
          <span class="num text-white">4</span><h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Holistic view</h3>
          <p class="mt-30">
          We bring a systemic lens across functions, processes, people, technology, and data to connect the critical dots that shape business performance.
          </p>
        </div>

      </div>

    </div>
  </section>
  <!-- ========================================= -->



  <!-- Parallax image SECTION -->
  <section class="section section-9 bg-light fade-in spp-section" style="aspect-ratio: 1728 / 503; width: 100%;">
    <div class="spp-bg-container">
      <img src="/wp-content/uploads/section-9-parallax.jpg" alt="" class="spp-bg-image">
    </div>
  </section>

  <!-- =========================================
     SECTION 4: The outcome
     ========================================= -->
     <section class="section bg-white text-dark section-4 pb-0 fade-in">
    <div class="container grid-2">

      <!-- Left column -->
      <div>
        <h2 class="heading-lg mb-20 mb-0-mob">The outcome</h2>
        
      </div>

      <!-- Right column -->
      <div>
        <p class="mb-20">
        A practical, actionable consulting solution that gives executives clarity on critical questions:
        </p>

        <ul class="list-check mb-20">
          <li>What must be redesigned to improve execution and capture real value?</li>
          <li>How can strategic priorities be turned into viable capabilities, processes, and structures?</li>
          <li>Which changes should be implemented first to drive impact with the least risk?</li>
        </ul>

        <p>
        Organizations that work with our solutions turn specific challenges into concrete interventions, tailored to their operational reality, maturity level, and implementation capacity.
        </p>

        <a href="/contacto/" class="btn-arrow  mobile-only-cta mt-20-mob">Request a meeting with our specialists</a>

        <a href="/contacto/" class="btn-arrow  desktop-only-cta">Request a meeting with our
          specialists</a>
          
      </div>

    </div>
  </section>





  <div class="container text-dark">
    <div class="separator mb-60 separator-mob mb-40-mob mt-20-mob"></div>
  </div>

  <!-- eight management areas block -->
  <div class="py-40-mob">
    <?php get_template_part('template-parts/blocks/bloque-ocho-areas-gestion'); ?>
  </div>


  <!-- Block: Success stories -->
  <div class="bg-dark-blue pb-60 pb-0-mob">
    <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>
  <!-- ========================================= -->

  <!-- block with a framework that connects all the dots -->
  <section class="section py-60 bg-light-blue text-white fade-in">
    <div class="container grid-2 align-center px-0-mob">

      <div class="soluciones-marco__media">
        <img
          src="/wp-content/uploads/marco-conecta-todos-los-puntos.jpg"
          alt="A framework that connects all the dots"
          class="soluciones-marco__img w-100 object-cover"
          loading="lazy"
          decoding="async"
        >
      </div>

      <div class="soluciones-marco__content">
        <h3 class="heading-sm mb-10">How do we do it?</h3>
        <h2 class="heading-lg mb-20">With a framework that connects all the dots</h2>

        <p>
        This is how we design business management solutions with a comprehensive view of operations, focused on what truly drives performance.
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



  <!-- Block: Take action, get to the root of your challenges -->
  <section class="section pb-0 fade-in">
    <div class="container grid-2">

      <!-- Left column -->
      <div>
        <h2 class="heading-lg mb-20 text-dark mb-0-mob">
          Take action, get to the root of your challenges
        </h2>
        
      </div>

      <!-- Right column -->
      <div>
      <p class="mb-20">
          The granularity of our value proposition lets our clients assess the state of their
          management capabilities, pursue a critical improvement, or take on the need to govern a
          structural change based on their capabilities and goals.
        </p>
        <ul class="list-check">
          <li>
            Our diagnostics give you a clearer, deeper understanding of your organization, reveal
            causal connections between key variables, and enable informed decisions with sharper strategic focus.
          </li>
          <li>
            We design solutions tailored to each organization's operational reality and maturity level, combining
            analytical relevance with practical viability.
          </li>
          <li>
            We support execution with structured governance models and rigorous follow-up, ensuring
            consistency, traceability, and results that last over time.
          </li>
          <li>
            We operate under a systemic logic that connects functions, people, technology, and processes, generating
            comprehensive impact aligned with the business's strategic goals.
          </li>
        </ul>
      </div>

    </div>
  </section>
  <!-- ========================================= -->

  <section class="section sep-linea bg-light">
    <div class="container sep-linea__inner"></div>
  </section>


 <!-- Block: Who we work with -->
 <section class="section pt-0 pb-60 bg-white text-dark fade-in">
    <div class="container grid-2">

      <!-- Left column -->
      <div>
        <h2 class="heading-lg mb-0-mob">Who we work with</h2>
        
      </div>

      <!-- Right column -->
      <div>
        <p>
          We partner with early-stage, consolidating, or advanced-scaling companies that
          face complex challenges and call for a systemic approach to transformative decisions.
        </p>
        <p>We focus on organizations showing structural symptoms such as underused
          growth potential, weak organizational capabilities, or a disconnect between strategy and
          execution. What defines our clients is not their industry, but their willingness to see themselves clearly, measure up
          against demanding standards, and act accordingly. </p>
        

          <a href="/clientes-y-socios-de-negocios/" class="btn-arrow mt-20-mob">
          Meet the clients who trust us
        </a>
      </div>
      

    </div>
  </section>
  <!--  -->


  <!-- ========================================= -->

  <!-- Block: Our international experience -->
  <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>


 






  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>

</main>

<?php get_footer(); ?>