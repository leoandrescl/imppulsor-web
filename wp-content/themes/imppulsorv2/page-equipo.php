<?php
/**
 * Template Name: Equipo
 * Description: Página Equipo — siguiendo la estandarización Impulsor v2.
 */
get_header();
?>

<main class="page-equipo">

  <!-- Reusable HERO -->
  <div class="hero-slider__bloque-1">
    <?php imppulsor_render_page_hero('default'); ?>
  </div>

  <div class="bg-white fade-in" style="background-color: #fff !important;">





  <!-- =========================================
      SECTION 2: Diagnostics + How it works
      ========================================= -->
     <section class="section section-2 pb-0 fade-in">
    <div class="container">

      <!-- Main block -->
      <div class="grid-2">
        <div>
          <h2 class="heading-lg mb-20 text-dark">Our research & delivery<br>team</h2>

          <p>
          Our team brings together professionals who do more than understand organizations — they
            connect the dots, read the context, and translate complex information into structured decisions to
            support leaders facing real challenges.
          </p>

          <p>
          Our team includes specialists in business administration, enterprise management technologies,
            organizational development, data science, and applied social research. Most hold
            MSc- or PhD-level graduate training, combining academic rigor, consulting experience, and
            business practice.
          </p>

          
        </div>

        <div class="h-420 mb-40-mob">
          <img src="/wp-content/uploads/nuestro-equipo.jpg" alt="Business maturity diagnostics" class="w-100  object-cover">
        </div>
      </div>

    </div>
  </section>
  <!-- ========================================= -->

   

    <!-- =========================================
      SECTION: Team listing (2x2 slider)
========================================== -->
<section class="mt-60 mt-0-mob px-0-mob equipo-slider-section equipo-slider-section--gradiente">
  <div class="container">

      <h2 class="heading-lg">Team</h2>

      <div class="equipo-slider-wrapper">

        <!-- Swiper: slides are generated via JS -->
        <div class="swiper equipo-swiper">
          <div class="swiper-wrapper">
            <!-- Dynamic slides -->
          </div>

          <!-- NUMERIC PAGINATION -->
          <div class="swiper-pagination equipo-pagination"></div>




        </div>

        <!-- FLAT MEMBER LIST (data source) -->
        <div class="equipo-items" style="display:none;">

          <!-- MEMBER 1 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Mauricio Moltó, PhD</h3>
            <p class="heading-sm text-blue">
              Senior Researcher
            </p>
            <p class="mb-10"><strong>Hub Argentina</strong></p>
            <p>
              Sociologist with a Master's in Territorial Development and Management and a PhD in Social Sciences. Accomplished
              professional in applied research, data analysis, and public policy
              evaluation, leading projects across public agencies, private
              consultancies, and universities.
            </p>
          </div>

          <!-- MEMBER 2 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Luis García</h3>
            <p class="heading-sm text-blue">
              Senior Consultant
            </p>
            <p class="mb-10"><strong>Hub Peru</strong></p>
            <p>
              Industrial Engineer. Seasoned
              professional with extensive experience in commercial and financial planning with deep
              business intelligence expertise. At Imppulsor, focuses on
              developing management models for commercial productivity and customer
              experience, as well as business architecture modeling.
            </p>
          </div>

          <!-- MEMBER 3 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Marcos Peña, MSc</h3>
            <p class="heading-sm text-blue">
              Data Scientist
            </p>
            <p class="mb-10"><strong>Hub Chile</strong></p>
            <p>
              Statistical Engineer with a Master's in Mathematics, Statistics concentration. Data scientist with extensive experience in teaching and consulting
              focused on business intelligence and advanced statistical analysis.
            </p>
          </div>

          <!-- MEMBER 4 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Emmanuel Ramos, MSc</h3>
            <p class="heading-sm text-blue">
              Senior Researcher
            </p>
            <p class="mb-10"><strong>Hub Mexico</strong></p>
            <p>
              Sociologist, Philosopher, Master's in Criminal Policy, Master's in Education. Accomplished professional with
              a strong track record in qualitative and quantitative market research,
              behavioral economics, and social and political research.
            </p>
          </div>

          <!-- MEMBER 5 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Victoria Lupo, MSc</h3>
            <p class="heading-sm text-blue">Senior Researcher</p>
            <p class="mb-10"><strong>Hub Argentina</strong></p>
            <p>
              Sociologist with a Master's in Political Communication.
              Accomplished professional in applied market
              analysis and research and consumer insights at firms such as GfK, Nielsen, and Kantar, with
              teaching experience in Sociology at the University of Buenos Aires.
            </p>
          </div>

          <!-- MEMBER 6 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Rodrigo Prado</h3>
            <p class="heading-sm text-blue">
            Managing Director
            </p>
            <p class="mb-10"><strong>Hub Ireland</strong></p>
            <p>
              Finance Engineer, founder and Managing Director of Imppulsor. Brings an
              integrated vision to business design and operations, spanning strategic,
              tactical, and operational perspectives. Extensive experience leading business
              transformation, productivity initiatives, and commercial best practices. Has advised
              senior executives and business owners in Miami and Latin America, known for
              leading complex projects and driving sustainable growth.
            </p>
          </div>

          <!-- MEMBER 7 -->
          <div class="equipo-item">
            <h3 class="heading-sm">Valeria Pozzoli, PhD</h3>
            <p class="heading-sm text-blue">Senior Researcher</p>
            <p class="mb-10"><strong>Hub Argentina</strong></p>
            <p>
              Degree in Chemistry, PhD in Engineering with a concentration in Chemical Technologies.
              Accomplished professional with
              a strong track record in research, teaching, and scientific project development at institutions
              such as the University of Buenos Aires, among others.
            </p>
          </div>

        </div><!-- /.equipo-items -->

      </div><!-- /.equipo-slider-wrapper -->

  </div>
    </section>



    <!-- Professional contact block -->
  <section class="contacto-profesional-bg-gradiente mt-0 mb-0-mob">
    <?php get_template_part('template-parts/blocks/bloque-contacto-profesional'); ?>
  </section>


   


    <!-- =========================================
        SECTION: Our commitment
  ========================================== -->
    <section class="compromiso-gradiente pb-120 py-40-mob">
      <div class="container">
        <div class="grid-2 compromiso-gradiente__content">

          <div>
            <h2 class="heading-lg mb-0-mob">Our commitment</h2>
          </div>

          <div>
            <p>
              Every engagement is guided by our ability to connect the critical dots that drive organizational
              change and to structure responses tailored to each client's context. We integrate
              advanced tools, systems thinking, and human sensitivity to design solutions that enable viable,
              sustainable decisions with tangible, lasting impact.
            </p>

            <a href="/success-stories/" class="btn-arrow mt-20-mob">Explore our success stories</a>
          </div>

        </div>
      </div>
    </section>
  </div>



  <!-- =========================================
        BLOCK: INSIGHTS (reused)
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


  /* === TEAM PAGINATION (same as Insights) === */

  .equipo-pagination {
    display: flex !important;
    justify-content: start;
    gap: 12px;
    margin-top: 60px;
    width: 100%;
    position: relative;
  }

  /* Base: numbered bullets and nav buttons */
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

  /* Hover + active */
  .equipo-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
  .equipo-pagination .swiper-pagination-bullet:hover,
  .equipo-pagination .equipo-pagination__nav:hover {
    background: #006EFF;
    border-color: #006EFF;
    color: #fff;
  }

  /* Previous / next buttons */
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

    // Group into chunks of 4 (2x2)
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

    // Remove the source list
    itemsContainer.remove();

    // Initialize Swiper
    const swiper = new Swiper('.equipo-swiper', {
      slidesPerView: 1,
      spaceBetween: 40,
      pagination: {
        el: '.equipo-pagination',
        clickable: false, // we handle clicks manually
        type: 'bullets',
        renderBullet: function (index, className) {
          // Keep Swiper's internal class
          return '<span class="' + className + '" data-index="' + index + '">' + (index + 1) + '</span>';
        }
      }
    });

    // Once Swiper has rendered the pagination
    setTimeout(() => {
      const pag = document.querySelector('.equipo-pagination');
      if (!pag) return;

      const bullets = pag.querySelectorAll('.swiper-pagination-bullet');

      // Manual clicks on the numbers (1, 2, 3, ...)
      bullets.forEach((bullet, index) => {
        bullet.dataset.index = index;

        bullet.addEventListener('click', function () {
          swiper.slideTo(index);
        });
      });

      // Create "previous" and "next" buttons
      const prevBtn = document.createElement('span');
      prevBtn.className = 'equipo-pagination__nav equipo-prev';
      prevBtn.textContent = 'previous';

      const nextBtn = document.createElement('span');
      nextBtn.className = 'equipo-pagination__nav equipo-next';
      nextBtn.textContent = 'next';

      // Insert them at the start and end of the container
      pag.prepend(prevBtn);
      pag.append(nextBtn);

      function updateButtons() {
        const total = swiper.slides.length;

        // Swiper already handles the .swiper-pagination-bullet-active class
        // we only control showing/hiding prev/next

        // Page 1 -> hide "previous"
        prevBtn.style.display = (swiper.activeIndex === 0) ? 'none' : 'flex';

        // Last page -> hide "next"
        nextBtn.style.display = (swiper.activeIndex === total - 1) ? 'none' : 'flex';
      }

      // Initial state
      updateButtons();
      swiper.on('slideChange', updateButtons);

      // Navigation events
      prevBtn.addEventListener('click', () => swiper.slidePrev());
      nextBtn.addEventListener('click', () => swiper.slideNext());

    }, 50);

  });
</script>

<?php get_footer(); ?>