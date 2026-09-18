<?php
/**
 * Footer principal del tema Impulsor
 */

// Lógica para estilos condicionales (ej: página de contacto con fondo blanco)
// Se verifica por slug y por template file para mayor robustez
$is_contact_page = is_page('contacto') || is_page_template('page-contacto.php') || is_page('referidos') || is_page_template('page-referidos.php');

$footer_text_class = $is_contact_page ? 'text-dark' : 'text-white';
$footer_bg_class = $is_contact_page ? 'bg-light' : 'bg-dark';
$icon_style = $is_contact_page ? 'style="filter: invert(0);"' : 'style="filter: brightness(0) invert(1);"'; // Contacto: Original. Global: Blanco.
$border_class = $is_contact_page ? 'border-top-000' : 'border-top-fff';

?>

<footer class="footer fade-in <?php echo esc_attr($footer_bg_class); ?>">
  <!-- ===============================
       FILA 1 – CONTACTO (placeholder)
  ================================ -->
  <section id="contacto" class="footer-contact footer-contact--fade-bloc pt-60 mb-60">
    <div class="container grid-2 gap-0">
      <div class="footer-contact__image">
        <img src="/wp-content/uploads/edificio.jpg" alt="Edificio Impulsor">
      </div>

      <div class="footer-contact__form">
        <?php echo do_shortcode('[contact-form-7 id="de13396" title="Formulario de contacto footer"]'); ?>
      </div>
    </div>
  </section>

  <!-- ===============================
       FILA 2 – NUEVO LAYOUT GRID (4 Columnas)
  ================================ -->
  <div class="footer-grid container pt-60 pt-40-mob border-top <?php echo esc_attr($footer_text_class); ?>">

    <!-- COL 1: Branding -->
    <div class="footer-col branding">
      <a href="/" class="footer-logo mb-20 d-block">
        <?php if ($is_contact_page): ?>
          <!-- Logo invertido (negro) para fondo blanco -->
          <img src="/wp-content/uploads/logo.svg" alt="Impulsor" width="190" height="auto" style="filter: invert(1);">
        <?php else: ?>
          <!-- Logo blanco (filtro) para fondo oscuro -->
          <img src="/wp-content/uploads/logo.svg" alt="Impulsor" width="190" height="auto"
            style="filter: brightness(0) invert(1);">
        <?php endif; ?>
      </a>

      <div class="footer-social mb-10 d-flex gap-10">
        <a href="https://www.linkedin.com/company/imppulsor/" target="_blank" rel="noopener" aria-label="LinkedIn">
          <img src="/wp-content/uploads/icon-in.png" alt="LinkedIn" width="24" height="24" <?php echo $icon_style; ?>>
        </a>
        <a href="https://www.instagram.com/imppulsor/" target="_blank" rel="noopener noreferrer" aria-label="Instagram de Imppulsor">
          <svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" <?php echo $is_contact_page ? 'style="color:#01224D;display:block;"' : 'style="color:#fff;display:block;"'; ?>>
            <path fill="currentColor" d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm11.25 1.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5zM12 7.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 0 1 12 7.5zm0 2A2.5 2.5 0 1 0 14.5 12 2.5 2.5 0 0 0 12 9.5z"></path>
          </svg>
        </a>
        <a href="https://x.com/imppulsor" target="_blank" rel="noopener" aria-label="X">
          <img src="/wp-content/uploads/icon-x.png" alt="X" width="24" height="24" <?php echo $icon_style; ?>>
        </a>
      </div>
    </div>

    <!-- COL 2: Navegación -->
    <div class="footer-col navigation">
      <h4 class="footer-heading mb-20 mb-0-mob">Cumplimiento Legal</h4>
      <ul class="footer-menu mt-0-mob">
        <li class="mb-0-mob"><a href="/politica-de-cookies/">Política de cookies</a></li>
        <li><a href="/politica-de-privacidad/">Política de privacidad</a></li>
      </ul>
    </div>

    <!-- COL 3: Europe Hubs -->
    <div class="footer-col hubs">
      <h4 class="footer-heading mb-20 hide-on-mobile">Europa</h4>
      <ul class="footer-address-list">
        <li class="mb-10 hide-on-mobile">
          <strong>Irlanda</strong><br>
          12 South Mall, Cork, Irlanda. T12 RD43
        </li>
        <li class="mb-10 mb-0-mob">
          <strong><span class="hide-on-desktop">Hub</span> Irlanda</strong><br>
          77 Sir John Rogerson’s Quay, Block C, Dublín, Irlanda. D02 NPO
        </li>
        <li class="mb-10 hide-on-mobile">
          <strong>España</strong><br>
          Calle de Velázquez 34, Piso 5, Madrid, España. 28001
        </li>
      </ul>
    </div>

    <!-- COL 4: Latam Hubs -->
    <div class="footer-col hubs hide-on-mobile">
      <h4 class="footer-heading mb-20">América Latina</h4>
      <ul class="footer-address-list">
        <li class="mb-10">
          <strong>Chile</strong><br>
          Avenida Presidente Riesco 6007, Las Condes, Santiago, Chile. 7560621
        </li>
        <li class="mb-10">
          <strong>Argentina</strong><br>
          Avenida Presidente Ramón Castillo 320, Piso 6, Oficina B, Edificio Plaza, Distrito Quartier, Buenos Aires,
          Argentina. 1104
        </li>
        <li class="mb-10">
          <strong>Perú</strong><br>
          Avenida Juan de Arona 735, San Isidro, Lima, Perú. 15046
        </li>
      </ul>
    </div>

  </div>

  <!-- COPYRIGHT ROW -->
  <div
    class="footer-copyright container mt-20 py-20 <?php echo esc_attr($footer_text_class); ?> <?php echo esc_attr($border_class); ?>">
    <p class="text-left fs-14">
      Imppulsor 2026 © Todos los derechos reservados
    </p>
  </div>
</footer>

<?php wp_footer(); ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
  });

  document.addEventListener("DOMContentLoaded", function () {
    function cleanCountryCommas() {
      // Buscamos todos los strong dentro de la lista de direcciones
      const countries = document.querySelectorAll('.footer-address-list strong');

      countries.forEach(el => {
        // Esta función busca en todos los elementos hijos (como los <font> de GTranslate)
        const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT, null, false);
        let node;
        while (node = walker.nextNode()) {
          // Reemplazamos la coma si existe en cualquier nodo de texto
          if (node.nodeValue.includes(',')) {
            node.nodeValue = node.nodeValue.replace(/,/g, '').trim();
          }
        }
      });
    }

    // 1. Ejecutar al cargar
    cleanCountryCommas();

    // 2. Ejecutar a los 2 segundos (cuando GTranslate suele terminar de procesar)
    setTimeout(cleanCountryCommas, 2000);

    // 3. Opcional: Ejecutar cuando se detecten cambios en el DOM (MutationObserver)
    // Esto es por si el usuario cambia de idioma varias veces
    const observer = new MutationObserver(cleanCountryCommas);
    observer.observe(document.body, { childList: true, subtree: true });
  });
</script>
</body>

</html>



<style>
  /* =======================================================
   FOOTER PRINCIPAL IMPULSOR
======================================================= */

  .footer {
    color: #fff;
    line-height: 1.5;
  }

  /* -------------------------------
   FILA 1 – CONTACTO
--------------------------------*/
  .footer-contact__form form label,
  .footer-contact__form form select {
    color: #01224D;
  }

  .footer-contact {
    display: flex;
    min-height: 420px;
    align-items: center;
  }

  /* Un solo fade para imagen + formulario (sin animar columnas por separado) */
  .footer.fade-in .footer-contact--fade-bloc {
    opacity: 0;
    transition: opacity 0.85s ease;
  }

  .footer.fade-in.visible .footer-contact--fade-bloc {
    opacity: 1;
  }

  .footer.fade-in .footer-contact--fade-bloc *,
  .footer.fade-in .footer-contact--fade-bloc [class*="grid-"]>* {
    opacity: 1 !important;
    transform: none !important;
    filter: none !important;
    transition: none !important;
    transition-delay: 0s !important;
  }

  section.footer-contact .grid-2 {
    grid-template-columns: calc(50% + 30px) calc(50% - 30px);
    overflow: visible;
  }

  .footer-contact__image {
    height: 100%;
    display: flex;
  }

  .footer-contact__image img {
    object-fit: cover;
  }


  .footer-contact__form {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    /* border-radius: 0 100px 0 0; */
    height: 100%;
  }

  .footer-contact__title {
    font-size: 32px;
    font-weight: 700;
    color: #fff;
  }




  /* Estilos del grid movidos a main.css */

  /* MOBILE CUSTOMIZATION */
  @media (max-width: 992px) {
    .hide-on-mobile {
      display: none !important;
    }

    .mb-0-mob {
      margin-bottom: 0 !important;
    }

    .mt-0-mob {
      margin-top: 0 !important;
    }

    .footer,
    .footer-col,
    .footer-copyright p {
      text-align: left !important;
    }

    .footer-col.branding {
      align-items: start;
    }

    .footer-social {
      justify-content: flex-start !important;
    }

    .footer-logo {
      margin-left: 0 !important;
      margin-right: auto !important;
    }

    .footer-contact__image {
      overflow: hidden;
    }

    .footer-contact__image img {
      width: calc(100% + 40px);
      max-width: none;
      height: 100%;
      margin-left: -40px;
      object-fit: cover;
      object-position: center center;
    }

    /* Ensure only Dublin is visible in its column if parent handles layout */
    /* .footer-col.hubs ul li:not(.hide-on-mobile) usually works */
  }




  @media (min-width:993px) {
    .hide-on-desktop {
      display: none !important;
    }

  }
</style>