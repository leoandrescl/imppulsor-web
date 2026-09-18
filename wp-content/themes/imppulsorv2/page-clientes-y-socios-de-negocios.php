<?php
/**
 * Template Name: Clientes y socios de negocios
 * Description: Página Clientes y socios de negocios — estructura base siguiendo Impulsor v2.
 */
get_header();
?>

<main class="page-clientes-y-socios-de-negocios">

  <!--  -->

  <div class="hero-slider__bloque-1">

    <?php imppulsor_render_page_hero('default'); ?>

    <!-- ========================================= -->
    <!-- BLOQUE: Confianza que transforma -->
    <!-- ========================================= -->


  </div>
  <!-- fin div de hero + primer bloque -->

  <section class="section bg-white text-dark pb-0 section-2 reveal reveal-up">
    <div class="container">

      <!-- Bloque principal -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 text-dark">Confianza que impulsa resultados
          </h2>
          <p>
          Cada cliente es un punto de partida único. En Imppulsor trabajamos junto a empresas que enfrentan desafíos reales y complejos, acompañándolos a clarificar su rumbo, fortalecer sus capacidades y transformar su desempeño.</p>

          <p>Nos eligen quienes valoran el análisis estructurado de sus problemas, la comprensión sistémica de su operación y la capacidad de traducir visión en ideas accionables, con objetivos medibles y resultados cuantificables.</p>

         
          <div class="desktop-only-cta">
              <a href="/casos-de-exito/" class="btn-arrow mt-20-mob">Descubra nuestros casos de éxito</a>
            </div>
        </div>

        <div class="grid-img-ratio">
          <img src="/wp-content/uploads/clientes-y-socios.jpg" alt="Diagnósticos de madurez empresarial" class="w-100 object-cover">
        </div>
      </div>
      

    </div>
  </section>

  <section class="section bg-white pt-0 text-dark reveal reveal-up">

    <div class="container">
      <div class="separator pb-60 pb-40-mob separator-clientes"></div>
        
        <div class="grid-2 ">

          <!-- Texto -->
          <div>
            <h2 class="heading-lg">Nuestros clientes</h2>
          </div>

          <!-- Grid de logos -->
          <div id="logos-container">
            <div class="logos-grid">
              <div class="logo-cell"><img src="/wp-content/uploads/logo-wbuild.png" alt="W Build"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-hco-cloud.png" alt="H&CO Cloud"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-hco2.png" alt="H&CO Tech"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-inxap.png" alt="Inxap"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-magno.png" alt="Magno"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-mund.png" alt="+Mund"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-propertypartners.png" alt="Property Partners">
              </div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-visualiza.png" alt="Visualiza"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-starkcloud.png" alt="Stark Cloud"></div>
              <div class="logo-cell"><img src="/wp-content/uploads/logo-hco.png" alt="H&CO"></div>
            </div>

            <div class="logos-pagination d-flex justify-between">

              <div class="pagination"></div>
            </div>
          </div>

        </div>
        <!-- fin segundo container -->
</div>

    </section>



  <section class="section bg-white text-dark py-0 clientes-voz-separator-strip" aria-hidden="true">
    <div class="container">
      <div class="clientes-voz-separator-line"></div>
    </div>
  </section>

  <!-- bloque testimonios — diseño La voz de nuestros clientes (nuevo) -->
  <div id="testimonios-voz-clientes">
    <?php get_template_part('template-parts/blocks/bloque-testimonios-voz-clientes'); ?>
  </div>

  <section class="section bg-white text-dark py-0 clientes-voz-separator-strip" aria-hidden="true">
    <div class="container">
      <div class="clientes-voz-separator-line"></div>
    </div>
  </section>






  <section class="section bg-white text-dark pb-0 reveal reveal-up">
    <div class="container">
      <!-- ============================== -->
      <!-- GRID PRINCIPAL (imagen izquierda / texto derecha) -->
      <!-- ============================== -->
      <div class="grid-2">

        <!-- Texto -->
        <div>
          <h2 class="heading-lg">Alianzas que expanden nuestro propósito</h2>
          <p>
          Creemos en alianzas que complementan nuestra capacidad de ayudar a las organizaciones a comprender sus desafíos y activar mejores decisiones. Por eso colaboramos con cámaras empresariales, universidades, centros de investigación, medios y sponsors.
          </p>
          <p class="mt-10">
          Estas relaciones amplían nuestro alcance, fortalecen nuestra propuesta de valor y nos permiten generar mayor impacto en nuestros clientes desde múltiples frentes.
          </p>

          <div class="mt-30 mt-0-mob btn-links">
            <a href="/contacto/" class="btn-arrow mt-20-mob">¿Le interesa ser nuestro partner?</a>
          </div>
        </div>

        <!-- Imagen -->
        <div class="grid-img-ratio">
          <img src="/wp-content/uploads/alianzas2.jpg" alt="Alianza estratégica"
            class="w-100 object-cover">
        </div>
      </div>
    </div>
  </section>

  <!-- ============================== -->
  <!-- GRID DE LOGOS CON PAGINACIÓN -->
  <!-- ============================== -->
  <section class="section bg-white pt-0 text-dark reveal reveal-up">
    <div class="container">
      <div class="separator pb-60 pb-40-mob separator-clientes"></div>

      <div class="grid-2 align-start">
        <!-- Texto lateral -->
        <div>
          <h2 class="heading-lg">Nuestros socios de negocios</h2>
        </div>

        <!-- Grid de logos -->
        <div id="logos-container-2" class="logos-container">
          <div class="logos-grid">
            <div class="logo-cell"><img src="/wp-content/uploads/logo-wbuild.png" alt="W Build"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-hco-cloud.png" alt="H&CO Cloud"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-hco2.png" alt="H&CO Tech"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-inxap.png" alt="Inxap"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-magno.png" alt="Magno"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-mund.png" alt="+Mund"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-propertypartners.png" alt="Property Partners">
            </div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-visualiza.png" alt="Visualiza"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-starkcloud.png" alt="Stark Cloud"></div>
            <div class="logo-cell"><img src="/wp-content/uploads/logo-hco.png" alt="H&CO"></div>
          </div>

          <div class="logos-pagination d-flex justify-between">
            <div class="pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Bloque: Nuestra experiencia internacional -->
  <?php get_template_part('template-parts/blocks/bloque-experiencia-internacional'); ?>
 

  <!-- Bloque: Ingishts -->
  <?php get_template_part('template-parts/blocks/bloque-insights'); ?>

</main>

<?php get_footer(); ?>


<!-- ========================================= -->
<!-- ESTILOS -->
<!-- ========================================= -->
<style>
  .page-clientes-y-socios-de-negocios .grid-img-ratio {
    aspect-ratio: 570 / 537;
    overflow: hidden;
  }

  .page-clientes-y-socios-de-negocios .grid-img-ratio img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  #logos-container {
    display: grid;
    align-content: space-between;
  }

  .logos-container {
    display: grid;
    align-content: space-between;
  }

  .logos-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 20px;
  }

  .logo-cell {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 12px;
    background: #fff;
    transition: background .3s ease;
  }

  .logo-cell:hover {
    background: #006EFF;
  }

  .logo-cell img {
    max-width: 90%;
    height: auto;
    opacity: 0.75;
    transition: all .3s ease;
    filter: invert(.5) !important;
  }

  .logo-cell:hover img {
    filter: none !important;
    opacity: 1;
  }

  /* ========================================================= */
  /* PAGINADOR ESTILO PROFESIONAL (igual al que hicimos antes) */
  /* ========================================================= */

  .logos-pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .pagination {
    display: flex !important;
    align-items: center;
    gap: 8px;
  }

  /* Numeración */
  .pagination-number {
    width: 26px;
    height: 26px;
    border: 1px solid #000;
    background: transparent;
    color: #000;
    font-weight: 600;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .3s ease;
  }

  /* Hover y activo */
  .pagination-number:hover,
  .pagination-number.active {
    background: #006EFF;
    border-color: #006EFF;
    color: #fff !important;
  }

  /* Flechas (si las usas en futuro) */
  .pagination-btn {
    border: 1px solid #000;
    padding: 4px 12px;
    background: transparent;
    cursor: pointer;
    transition: all .3s ease;
    font-weight: 600;
    width: max-content;
    padding: 0 8px;
    text-transform: lowercase;
  }

  .pagination-btn:hover {
    background: #006EFF;
    border-color: #006EFF;
    color: #fff !important;
  }

  /* Línea negra entre secciones (mismo ancho que .container del sitio) */
  .page-clientes-y-socios-de-negocios .clientes-voz-separator-strip .container {
    width: 100%;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    box-sizing: border-box;
  }

  .page-clientes-y-socios-de-negocios .clientes-voz-separator-line {
    height: 1px;
    background-color: #000;
    margin: 0;
    padding: 0;
    border: 0;
    width: 100%;
    max-width: 100%;
    display: block;
    box-sizing: border-box;
  }
</style>



<!-- ========================================= -->
<!-- SCRIPT SWIPER -->
<!-- ========================================= -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".logos-grid").forEach((grid) => {
      const cells = Array.from(grid.children);
      const container = grid.parentElement;
      const pagination = container.querySelector(".pagination");
      if (!pagination) return;

      const perPage = 9;
      const totalPages = Math.ceil(cells.length / perPage);

      // Ocultar si no hace falta paginar
      if (totalPages <= 1) {
        pagination.style.display = "none";
        return;
      }

      let currentPage = 1;

      function renderPage(page) {
        currentPage = page;

        // Mostrar/ocultar logos
        cells.forEach((cell, i) => {
          cell.style.display =
            i >= (page - 1) * perPage && i < page * perPage ? "flex" : "none";
        });

        // Actualizar activo
        pagination.querySelectorAll(".pagination-number").forEach((btn) =>
          btn.classList.toggle("active", Number(btn.dataset.page) === page)
        );

        // Mostrar/Ocultar botones
        const btnPrev = pagination.querySelector(".pagination-prev");
        const btnNext = pagination.querySelector(".pagination-next");

        btnPrev.style.display = page === 1 ? "none" : "flex";
        btnNext.style.display = page === totalPages ? "none" : "flex";
      }

      // ---------------------------
      // Construcción del paginador
      // ---------------------------
      pagination.innerHTML = "";

      // Botón anterior
      const prev = document.createElement("span");
      prev.classList.add("pagination-btn", "pagination-prev");
      prev.textContent = "Anterior";
      prev.addEventListener("click", () => renderPage(currentPage - 1));
      pagination.appendChild(prev);

      // Números
      for (let i = 1; i <= totalPages; i++) {
        const num = document.createElement("span");
        num.classList.add("pagination-number");
        num.dataset.page = i;
        num.textContent = i;
        num.addEventListener("click", () => renderPage(i));
        pagination.appendChild(num);
      }

      // Botón siguiente
      const next = document.createElement("span");
      next.classList.add("pagination-btn", "pagination-next");
      next.textContent = "Siguiente";
      next.addEventListener("click", () => renderPage(currentPage + 1));
      pagination.appendChild(next);

      // Start
      renderPage(1);
    });
  });
</script>

<style>
  .page-template-page-clientes-y-socios-de-negocios .separator-clientes {
    border-bottom-color: #000;
  }
</style>