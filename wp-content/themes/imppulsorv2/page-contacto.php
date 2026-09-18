<div class="header-white no-hero">
<?php
/**
 * Template Name: Contacto
 * Description: Página Contacto — estructura base siguiendo Impulsor v2.
 */
get_header();
?>
</div>

<main class="page-contacto bg-light">

  <!--  -->


<section class="section reveal reveal-up">
  <div class="container grid-2 grid-2--2fr-1fr">

    <!-- Columna izquierda -->
    <div class="contacto__formulario text-dark">
      <h2 class="heading-lg mb-10">Contáctanos</h2>
      <div class="footer-middle__social mb-40">
        <a href="https://www.linkedin.com/company/imppulsor/" target="_blank" rel="noopener" aria-label="Compartir en LinkedIn" class="hero-social__link">
          <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24" style="">
        </a>
        <a href="https://x.com/imppulsor" target="_blank" rel="noopener" aria-label="Compartir en X" class="hero-social__link">
          <img src="/wp-content/uploads/icon-x.png" alt="X (Twitter)" width="24" height="24" style="">
        </a>
    </div>

      <p class=" ">
        En Imppulsor ayudamos a organizaciones de diversos países a comprender con claridad sus desafíos estructurales y tomar mejores decisiones de negocio. Nuestra propuesta combina dos líneas de productos: diagnósticos de madurez empresarial que revelan patrones críticos y soluciones de consultoría que habilitan mejoras sostenibles en gestión, desempeño y escalabilidad.
      </p>

      <p class=" ">
        A través de un equipo global de consultores con experiencia multidisciplinar, diseñamos e implementamos intervenciones adaptadas al contexto y a los objetivos reales de cada cliente.
      </p>

      <p class=" ">
        Si estás enfrentando fricciones persistentes, desafíos de crecimiento o dudas sobre cómo optimizar tu arquitectura operativa, conversemos. Completa el formulario y uno de nuestros especialistas se pondrá en contacto para ayudarte a explorar, sin compromiso, cuál podría ser tu punto de partida.
      </p>

      <!-- Formulario principal -->
      <div class="formulario-contacto cf7-clean mt-40">
        <?php echo do_shortcode('[contact-form-7 id="bb0babf" title="Formulario de contacto pagina contacto"]'); ?>
      </div>
      <!--  -->
       <div class="separator-40y"></div>
       <!--  -->
      <p class="text-sm ">
        Imppulsor Limited se compromete a proteger tu información. Tus datos serán tratados conforme a la legislación aplicable en materia de privacidad, nuestras políticas internas y nuestra política de protección de datos. Al ser una organización con presencia internacional, tu información podrá ser almacenada y procesada fuera de tu país de residencia, siempre bajo estrictos estándares de seguridad, confidencialidad y respeto por tu privacidad.
      </p>
    </div>
    

    <!-- Columna derecha -->
    <aside class="contacto__sidebar text-white bg-gradient-light-blue py-60 px-40">

      <div class=" ">
        <h3 class="heading-sm  ">Política de privacidad</h3>
        <p class="text-sm  ">
          Protegemos tu información de acuerdo con estrictos principios de confidencialidad, legalidad y respeto por tus datos personales.
        </p>
        <a href="/politica-de-privacidad/" class="btn-arrow  mt-20-mob">Acceder</a>
      </div>
      <!-- fin fila 1 -->
       <div class="separator-40y"></div> 
       <!--  -->
      <div class=" ">
        <h3 class="heading-sm  ">Política de cookies</h3>
        <p class="text-sm  ">
          Consulta cómo usamos cookies para mejorar tu experiencia y asegurar el funcionamiento adecuado de nuestro sitio web.
        </p>
        <a href="/politica-de-cookies/" class="btn-arrow  mt-20-mob">Acceder</a>
      </div>
      <!-- fin fila 2 -->
       <div class="separator-40y"></div> 
        <!--  -->
      <div class=" ">
        <h3 class="heading-sm  ">Reproducciones</h3>
        <p class="text-sm  ">
          Si deseas citar o republicar contenido de nuestro blog o casos de éxito, contáctanos para conocer condiciones de uso y autorizaciones.
        </p>
      </div>
        <!-- fin fila 3 -->
         <div class="separator-40y"></div> 
         <!--  -->
      <div>
        <h3 class="heading-sm  ">Trabaja con nosotros</h3>
        <p class="text-sm  ">
          En Imppulsor trabajamos con líderes que enfrentan decisiones complejas y buscan generar impacto real. Si te apasiona transformar organizaciones desde la raíz, queremos conocerte.
        </p>
        <div class="contacto-profesional__form cf7-clean">
            <?php echo do_shortcode('[contact-form-7 id="eae9bc5" title="Formulario de contacto trabaja con nosotros"]'); ?>
        </div>
      </div>
      <!-- fin fila 4 -->
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
    .header-white button.mobile-search-toggle,
    .header-white .main-nav .menu-link,
    .header-white .mega-insight h4 a {
        color: #000 !important;
    }
    .header-white .header-search form {
        border: 1px solid #000000;
    }
    .header-white .header-inner {
        border-bottom: 1px solid #000;
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

    /* 4. Estilo de los enlaces del Nivel 3 */
    .header-white .mega__col--menu .mega__menu .sub-menu a {
        color: #000 !important; 
    }

    /* Hover en los enlaces del nivel 3 */
    .header-white .mega__col--menu .mega__menu .sub-menu a:hover {
        color: #000 !important;
    }

    .header-white .header-search input[type="search"]:focus {
        color: #000 !important;
    }

    .header-white .header-search input[type="search"]::placeholder {
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