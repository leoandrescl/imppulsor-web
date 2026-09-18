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


<!-- Block: Take action, get to the root of your challenges -->
<section class="section bg-light pb-60 reveal reveal-up">
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
      Our business maturity diagnostics bring sharp clarity to the real state of your management capabilities, uncover structural gaps, and help you prioritize improvement, transformation, or scaling decisions based on your organization's stage, goals, and constraints.
        </p>
        <ul class="list-check">
          <li>
          They reveal the root causes behind visible symptoms, connecting data, perceptions, and evidence to understand what is truly holding back business performance.
          </li>
          <li>
          They deliver a structured read on your organization's maturity level, separating the critical from the incidental and the urgent from the strategic.
          </li>
          <li>
          They guide investment decisions, organizational redesign, and capability building, reducing the risk of acting on incomplete diagnostics or isolated hunches.
          </li>
          <li>
          They turn scattered information into an actionable roadmap, aligned with operational reality, strategic goals, and execution capacity.
          </li>
        </ul>
      </div>

    </div>
  </section>
  <!-- ========================================= -->




  

  <div class="pb-40 pb-0-mob bg-dark-solid">
  <?php get_template_part('template-parts/blocks/bloque-casos-exito'); ?>
  </div>







  <!-- Section: Featured capabilities -->
  <section class="section bg-white reveal reveal-up pb-60">
    <div class="container text-dark">

      <!-- Main title -->
      <h2 class="heading-lg mb-60 mb-40-mob">Our capabilities</h2>

      <!-- Capabilities grid -->
      <div class="grid-2">

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">1</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">Research rigor</h3>
          </div>
          <p>
            We design diagnostics grounded in advanced methodologies and research
            practices for social and organizational phenomena,
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
            to ensure every proposed solution is feasible, relevant, and executable.
          </p>
        </div>

        <div class="mb-20-mob">
          <div class="flex items-center mb-30">
            <span class="num text-white">3</span>
            <h3 class="heading-sm" style="position: absolute; top: -15px; left: 40px;">E-service deployment</h3>
          </div>
          <p>
            We deliver experiences exclusively through digital platforms,
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
            your business's critical dots, delivering diagnostics built on
            solid data that drive real, measurable impact.
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



    <!-- Section: client profile -->
    <section class="section reveal reveal-up pb-60"
    style="background-color: #fff !important;">
    <div class="container">

      <!-- Following sub-block (Who we work with) -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 mb-0-mob">Who we work with</h2>

        </div>

        <div>
          <p class="mb-20">
            We partner with early-stage, consolidating, or advanced-scaling companies
            facing complex challenges that call for a systemic approach to transformative decisions.
          </p>
          <p class="mb-20">
            We focus on organizations showing structural symptoms such as underused
            growth potential,
            weak organizational capabilities, or a disconnect between strategy and execution.
          </p>


          <div class="texto-expandible texto-expandible--oculto">
            <p>
            What defines our clients is not their industry, but their willingness to see themselves clearly,
            measure up against demanding standards, and act accordingly.
            </p>
          </div>

          <a href="#" class="texto-expandible__toggle mt-10 d-block">Read more …</a>

          <a href="/clientes-y-socios-de-negocios/" class="btn-arrow mt-20-mob">Meet the clients who trust
            us</a>
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->



    <!-- Block: Our international experience -->
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



