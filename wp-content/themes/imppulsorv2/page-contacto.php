<div class="header-white no-hero">
<?php
/**
 * Template Name: Contacto
 * Description: Página Contacto — estructura base siguiendo Imppulsor v2.
 */
get_header();
?>
</div>

<main class="page-contacto bg-light">

  <!--  -->


<section class="section reveal reveal-up">
  <div class="container grid-2 grid-2--2fr-1fr">

    <!-- Left column -->
    <div class="contacto__formulario text-dark">
      <h2 class="heading-lg mb-10">Contact us</h2>
      <div class="footer-middle__social mb-40">
        <a href="https://www.linkedin.com/company/imppulsor/" target="_blank" rel="noopener" aria-label="Compartir en LinkedIn" class="hero-social__link">
          <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24" style="">
        </a>
        <a href="https://x.com/imppulsor" target="_blank" rel="noopener" aria-label="Compartir en X" class="hero-social__link">
          <img src="/wp-content/uploads/icon-x.png" alt="X (Twitter)" width="24" height="24" style="">
        </a>
    </div>

      <p class=" ">
        At Imppulsor, we help organizations across countries gain clear insight into their structural challenges and make better business decisions. Our offering combines two product lines: business maturity diagnostics that reveal critical patterns, and consulting solutions that enable sustainable improvements in management, performance, and scalability.
      </p>

      <p class=" ">
        Through a global team of consultants with multidisciplinary experience, we design and implement interventions tailored to each client's context and real objectives.
      </p>

      <p class=" ">
        If you're facing persistent friction, growth challenges, or questions about how to optimize your operating architecture, let's talk. Fill out the form and one of our specialists will reach out to help you explore — with no commitment — where your starting point could be.
      </p>

      <!-- Main form -->
      <div class="formulario-contacto cf7-clean mt-40">
        <?php echo do_shortcode('[contact-form-7 id="bb0babf" title="Formulario de contacto pagina contacto"]'); ?>
      </div>
      <!--  -->
       <div class="separator-40y"></div>
       <!--  -->
      <p class="text-sm ">
        Imppulsor Limited is committed to protecting your information. Your data will be handled in accordance with applicable privacy legislation, our internal policies, and our data protection policy. As an international organization, your information may be stored and processed outside your country of residence, always under strict standards of security, confidentiality, and respect for your privacy.
      </p>
    </div>
    

    <!-- Right column -->
    <aside class="contacto__sidebar text-white bg-gradient-light-blue py-60 px-40">

      <div class=" ">
        <h3 class="heading-sm  ">Privacy Policy</h3>
        <p class="text-sm  ">
          We protect your information under strict principles of confidentiality, legality, and respect for your personal data.
        </p>
        <a href="/privacy-policy/" class="btn-arrow  mt-20-mob">Read more</a>
      </div>
      <!-- end row 1 -->
       <div class="separator-40y"></div> 
       <!--  -->
      <div class=" ">
        <h3 class="heading-sm  ">Cookie Policy</h3>
        <p class="text-sm  ">
          See how we use cookies to improve your experience and keep our website running properly.
        </p>
        <a href="/cookie-policy/" class="btn-arrow  mt-20-mob">Read more</a>
      </div>
      <!-- end row 2 -->
       <div class="separator-40y"></div> 
        <!--  -->
      <div class=" ">
        <h3 class="heading-sm  ">Reprints &amp; permissions</h3>
        <p class="text-sm  ">
          If you'd like to quote or republish content from our blog or success stories, contact us for terms of use and permissions.
        </p>
      </div>
        <!-- end row 3 -->
         <div class="separator-40y"></div> 
         <!--  -->
      <div>
        <h3 class="heading-sm  ">Work with us</h3>
        <p class="text-sm  ">
          At Imppulsor, we work with leaders facing complex decisions who want to drive real impact. If you're passionate about transforming organizations at the root, we want to meet you.
        </p>
        <div class="contacto-profesional__form cf7-clean">
            <?php echo do_shortcode('[contact-form-7 id="eae9bc5" title="Formulario de contacto trabaja con nosotros"]'); ?>
        </div>
      </div>
      <!-- end row 4 -->
       <div class="separator-40y"></div> 
       <!--  -->
       <div class=""><img src="/wp-content/uploads/aside-contacto.jpg" alt=""></div>

    </aside>
  </div>
</section>


</main>

<div class="no-form">
<?php get_footer(); ?>
</div>

<style>
    .no-hero section.hero-wrap {
        display: none;
    }

    .cf7-clean form.wpcf7-form {
        padding: 0 !important;
    }
    .cf7-clean .wpcf7 .heading-lg,
    .cf7-clean .wpcf7 p.p-header-form,
    .no-form section.footer-contact {
        display: none !important;
    }
    .no-form .bg-dark {
        background-color: #fff !important;
        color: #000 !important;
        padding-top: 0 !important;
    }
    .no-form .footer-middle {
        border-color: #000 !important;
        margin-top: 0 !important;
    }
    .no-form .footer-middle__logo img {
        filter: invert(1) !important;
    }
    .no-form .footer-menu__item a,
    .no-form .footer-bottom__copy,
    .no-form .footer-address__line {
        color: #000 !important;
    }
    .no-form .hero-social__link img {
        filter: none !important;
    }
    .bg-gradient-light-blue {
        background: linear-gradient(90deg, #030F23, #0055C4);
    }

    .header-white .menu-toggle span {
        background: #000000 !important;
    }
    
    .header-white header.site-header {
        background: #fff;
        margin-bottom: 0;
    }
    .header-white .logo a img {
        filter: invert(1);
    }
    .header-white .header-search-toggle,
    .header-white .main-nav .menu-link,
    .header-white .mega-insight h4 a {
        color: #000 !important;
    }
    .header-white .header-inner {
        border-bottom: 1px solid #000;
    }
    .header-white .header-buttons a.btn.btn-secundario {
        border: 1px solid #000;
    }
    .header-white .mega {
        background: #ffffff;
    }
    .header-white .mega__col--menu::after {
        background: #000000;
    }

    .header-white .mega-insight .btn-borde {
      border: 1px solid #000;
      color: #000;
    }

    .header-white .mega-insight .btn-borde:hover {
      border: 1px solid #000;
      color: #fff;
      background: #000;
    }

    /* 4. Level 3 link styling */
    .header-white .mega__col--menu .mega__menu .sub-menu a {
        color: #000 !important; 
    }

    /* Hover on level 3 links */
    .header-white .mega__col--menu .mega__menu .sub-menu a:hover {
        color: #000 !important;
    }

    .formulario-trabajo .wpcf7 input:not([type=submit]), 
    .formulario-trabajo .wpcf7 select, .wpcf7 textarea {
        color: #ffffff;
    }

    aside .form__group {
        display: block;
    }
    aside .form__submit {
        justify-items: start;
        margin-top: 20px;
    }
</style>