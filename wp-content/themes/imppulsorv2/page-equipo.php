<?php
/**
 * Template Name: Equipo
 * Description: Página Equipo — siguiendo la estandarización Impulsor v2.
 */
get_header();
?>

<main class="page-equipo">

  <!-- HERO reutilizable -->
  <div class="hero-slider__bloque-1">
    <?php imppulsor_render_page_hero('default'); ?>
  </div>

  <div class="bg-white fade-in" style="background-color: #fff !important;">





  <!-- =========================================
     SECCIÓN 2: Diagnósticos + Cómo funciona
     ========================================= -->
     <section class="section section-2 pb-0 fade-in">
    <div class="container">

      <!-- Bloque principal -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 text-dark">Nuestro equipo de<br>research & delivery</h2>

          <p>
          Nuestro equipo está formado por profesionales que no solo entienden las organizaciones, sino que saben
            conectar los puntos, leer el contexto y traducir información compleja en decisiones estructuradas para
            acompañar a líderes que enfrentan desafíos reales.
          </p>

          <p>
          Nuestro equipo lo integran especialistas en administración de empresas, tecnologías de gestión empresarial,
            desarrollo organizacional, ciencia de datos investigación social aplicada. Profesionales, en su mayoría con
            formación de posgrado a nivel MSc o PhD, que integran rigurosidad académica, experiencia consultiva y
            práctica empresarial.
          </p>

          
        </div>

        <div class="h-420 mb-40-mob">
          <img src="/wp-content/uploads/nuestro-equipo.jpg" alt="Diagnósticos de madurez empresarial" class="w-100  object-cover">
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->

   

    <!-- =========================================
     SECCIÓN: Listado del equipo (Slider 2x2)
========================================== -->
<section class="mt-60 mt-0-mob px-0-mob equipo-slider-section equipo-slider-section--gradiente">
  <div class="container">

      <h2 class="heading-lg">Equipo</h2>

      <div class="equipo-slider-wrapper">

        <!-- Swiper: los slides se generan vía JS -->
        <div class="swiper equipo-swiper">
          <div class="swiper-wrapper">
            <!-- Slides dinámicos -->
          </div>

          <!-- PAGINACIÓN NUMÉRICA -->
          <div class="swiper-pagination equipo-pagination"></div>




        </div>

        <!-- LISTA PLANA DE MIEMBROS (fuente de datos) -->
        <div class="equipo-items" style="display:none;">

          <!-- MIEMBRO 1 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Mauricio Moltó, PhD</h3>
            <p class="heading-sm text-blue">
              Senior Researcher
            </p>
            <p class="mb-10"><strong>Hub Argentina</strong></p>
            <p>
              Sociólogo, Magister en Desarrollo y Gestión Territorial, Doctor en Ciencias Sociales. Profesional con
              una destacada trayectoria en investigación aplicada, análisis de datos y evaluación
              de políticas públicas, liderando proyectos en organismos públicos, consultoras
              privadas y universidades.
            </p>
          </div>

          <!-- MIEMBRO 2 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Luis García</h3>
            <p class="heading-sm text-blue">
              Senior Consultant
            </p>
            <p class="mb-10"><strong>Hub Perú</strong></p>
            <p>
              Ingeniero Industrial. Profesional
              con amplia experiencia en planificación comercial y financiera con una alta expertise
              en inteligencia de negocios. Desde su rol en Imppulsor se ha especializado en el
              desarrollo de modelos de gestión para productividad comercial y de experiencia de
              clientes, como también en el modelado de arquitecturas de negocios.
            </p>
          </div>

          <!-- MIEMBRO 3 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Marcos Peña, MSc</h3>
            <p class="heading-sm text-blue">
              Data Cientist
            </p>
            <p class="mb-10"><strong>Hub Chile</strong></p>
            <p>
              Ingeniero Estadístico, Magister en Matemáticas mención Estadísticas. Científico de Datos con amplia experiencia en docencia y consultoría
              aplicada a inteligencia de negocios y análisis estadísticos avanzados.
            </p>
          </div>

          <!-- MIEMBRO 4 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Emmanuel Ramos, MSc</h3>
            <p class="heading-sm text-blue">
              Senior Researcher
            </p>
            <p class="mb-10"><strong>Hub México</strong></p>
            <p>
              Sociólogo, Filósofo, Master en Política Criminal, Master en Educación. Profesional con una
              destacada trayectoria en investigación cualitativa y cuantitativa de mercados,
              ciencias del comportamiento económico e investigación social y política.
            </p>
          </div>

          <!-- MIEMBRO 5 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Victoria Lupo, MSc</h3>
            <p class="heading-sm text-blue">Senior Researcher</p>
            <p class="mb-10"><strong>Hub Argentina</strong></p>
            <p>
              Socióloga, Magister en Comunicación Política.
              Profesional con una destacada trayectoria en análisis e investigación aplicada
              de mercados y consumer insights en compañías como GfK, Nielsen y Kantar y
              actividades de docencia en Sociología en la Universidad de Buenos Aires.
            </p>
          </div>

          <!-- MIEMBRO 6 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Rodrigo Prado</h3>
            <p class="heading-sm text-blue">
            Managing Director
            </p>
            <p class="mb-10"><strong>Hub Ireland</strong></p>
            <p>
              Ingeniero en Finanzas, fundador y Managing Director de Imppulsor. Profesional con una visión
              integral en el diseño y operación de negocios, involucrando las perspectivas
              estratégica, táctica y operativa. Amplia experiencia liderando la transformación
              de negocios, procesos de productividad y buenas prácticas comerciales. Ha asesorado
              a altos ejecutivos y empresarios en Miami y Latinoamérica, destacándose por su
              capacidad para liderar proyectos complejos y fomentar el crecimiento sostenible.
            </p>
          </div>

          <!-- MIEMBRO 7 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Valeria Pozzoli, PhD</h3>
            <p class="heading-sm text-blue">Senior Researcher</p>
            <p class="mb-10"><strong>Hub Argentina</strong></p>
            <p>
              Licenciada en Químicas, Doctora en Ingeniería con mención en Tecnologías Químicas.
              Profesional con una destacada trayectoria en
              investigación, docencia y desarrollo de proyectos científicos en instituciones
              como la Universidad de Buenos Aires entre otras instituciones.
            </p>
          </div>

        </div><!-- /.equipo-items -->

      </div><!-- /.equipo-slider-wrapper -->

  </div>
    </section>



    <!-- Bloque: Contacto profesional -->
  <section class="contacto-profesional-bg-gradiente mt-0 mb-0-mob">
    <?php get_template_part('template-parts/blocks/bloque-contacto-profesional'); ?>
  </section>


   


    <!-- =========================================
       SECCIÓN: Nuestro compromiso
  ========================================== -->
    <section class="compromiso-gradiente pb-120 py-40-mob">
      <div class="container">
        <div class="grid-2 compromiso-gradiente__content">

          <div>
            <h2 class="heading-lg mb-0-mob">Nuestro compromiso</h2>
          </div>

          <div>
            <p>
              Cada intervención se guía por nuestra capacidad de conectar os puntos críticos que impulsan el cambio
              organizacional y de estructurar respuestas adaptadas al contexto de cada cliente. Integramos herramientas
              avanzadas, visión sistémica y sensibilidad humana para diseñar soluciones que habiliten decisiones viables,
              sostenibles y generadoras de impacto tangible y duradero.
            </p>

            <a href="/casos-de-exito/" class="btn-arrow mt-20-mob">Descubre nuestros casos de éxito</a>
          </div>

        </div>
      </div>
    </section>
  </div>



  <!-- =========================================
       BLOQUE: INSIGHTS (reutilizado)
  ========================================== -->
  <div class="">
    <?php get_template_part('template-parts/blocks/bloque-insights'); ?>
  </div>

</main>

<style>
  .equipo-slider-section--gradiente {
    background-image: url('/wp-content/uploads/bg-gradiente-1.svg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    padding: 40px;
  }

  .equipo-slider-section--gradiente h1,
  .equipo-slider-section--gradiente h2,
  .equipo-slider-section--gradiente h3,
  .equipo-slider-section--gradiente h4,
  .equipo-slider-section--gradiente h5,
  .equipo-slider-section--gradiente h6,
  .equipo-slider-section--gradiente p,
  .equipo-slider-section--gradiente strong {
    color: #fff !important;
  }

  .compromiso-gradiente {
    background-image: url('/wp-content/uploads/bg-gradiente-1.svg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    padding: 60px 0;
  }

  .compromiso-gradiente__content,
  .compromiso-gradiente__content h1,
  .compromiso-gradiente__content h2,
  .compromiso-gradiente__content h3,
  .compromiso-gradiente__content h4,
  .compromiso-gradiente__content h5,
  .compromiso-gradiente__content h6,
  .compromiso-gradiente__content p,
  .compromiso-gradiente__content a {
    color: #fff !important;
  }

  .contacto-profesional-bg-gradiente {
    background: #fff;
  }


  /* === PAGINACIÓN EQUIPO (idéntico a Insights) === */

  .equipo-pagination {
    display: flex !important;
    justify-content: start;
    gap: 12px;
    margin-top: 60px;
    width: 100%;
    position: relative;
  }

  /* Base: bullets numerados y botones nav */
  .equipo-pagination .swiper-pagination-bullet,
  .equipo-pagination .equipo-pagination__nav {
    width: 26px;
    height: 26px;
    border: 1px solid #000;
    background: #fff;
    color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    transition: all .2s ease;
    border-radius: 0;
    cursor: pointer;
    text-decoration: none;
    opacity: 1;
    margin: 0 !important;
  }

  /* Hover + activo */
  .equipo-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
  .equipo-pagination .swiper-pagination-bullet:hover,
  .equipo-pagination .equipo-pagination__nav:hover {
    background: #006EFF;
    border-color: #006EFF;
    color: #fff;
  }

  /* Botones anterior / siguiente */
  .equipo-pagination .equipo-pagination__nav {
    width: max-content;
    padding: 0 8px;
    text-transform: lowercase;
  }
</style>




<script>
  document.addEventListener('DOMContentLoaded', function () {

    const wrapper = document.querySelector('.equipo-slider-wrapper');
    if (!wrapper) return;

    const itemsContainer = wrapper.querySelector('.equipo-items');
    const items = Array.from(itemsContainer.querySelectorAll('.equipo-item'));
    const swiperWrapper = wrapper.querySelector('.equipo-swiper .swiper-wrapper');

    if (!items.length || !swiperWrapper) return;

    // Agrupar en chunks de 4 (2x2)
    const chunkSize = 4;
    for (let i = 0; i < items.length; i += chunkSize) {
      const chunk = items.slice(i, i + chunkSize);

      const slideEl = document.createElement('div');
      slideEl.classList.add('swiper-slide');

      const grid = document.createElement('div');
      grid.classList.add('grid-2');

      chunk.forEach(item => grid.appendChild(item));

      slideEl.appendChild(grid);
      swiperWrapper.appendChild(slideEl);
    }

    // Eliminar la lista fuente
    itemsContainer.remove();

    // Inicializar Swiper
    const swiper = new Swiper('.equipo-swiper', {
      slidesPerView: 1,
      spaceBetween: 40,
      pagination: {
        el: '.equipo-pagination',
        clickable: false, // manejaremos los clicks manualmente
        type: 'bullets',
        renderBullet: function (index, className) {
          // Mantenemos la clase interna de Swiper
          return '<span class="' + className + '" data-index="' + index + '">' + (index + 1) + '</span>';
        }
      }
    });

    // Cuando Swiper ya pintó la paginación
    setTimeout(() => {
      const pag = document.querySelector('.equipo-pagination');
      if (!pag) return;

      const bullets = pag.querySelectorAll('.swiper-pagination-bullet');

      // Click manual en los números (1, 2, 3, ...)
      bullets.forEach((bullet, index) => {
        bullet.dataset.index = index;

        bullet.addEventListener('click', function () {
          swiper.slideTo(index);
        });
      });

      // Crear botones "anterior" y "siguiente"
      const prevBtn = document.createElement('span');
      prevBtn.className = 'equipo-pagination__nav equipo-prev';
      prevBtn.textContent = 'anterior';

      const nextBtn = document.createElement('span');
      nextBtn.className = 'equipo-pagination__nav equipo-next';
      nextBtn.textContent = 'siguiente';

      // Insertarlos al inicio y al final del contenedor
      pag.prepend(prevBtn);
      pag.append(nextBtn);

      function updateButtons() {
        const total = swiper.slides.length;

        // Swiper ya gestiona la clase .swiper-pagination-bullet-active
        // solo controlamos mostrar/ocultar prev/next

        // Página 1 -> ocultar "anterior"
        prevBtn.style.display = (swiper.activeIndex === 0) ? 'none' : 'flex';

        // Última página -> ocultar "siguiente"
        nextBtn.style.display = (swiper.activeIndex === total - 1) ? 'none' : 'flex';
      }

      // Estado inicial
      updateButtons();
      swiper.on('slideChange', updateButtons);

      // Eventos de navegación
      prevBtn.addEventListener('click', () => swiper.slidePrev());
      nextBtn.addEventListener('click', () => swiper.slideNext());

    }, 50);

  });
</script>

<?php get_footer(); ?>