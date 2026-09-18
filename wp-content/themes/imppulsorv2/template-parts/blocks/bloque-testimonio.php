<?php
/**
 * Block 6 – Testimonials Slider (Hardcoded with Swiper)
 */
if (!defined('ABSPATH'))
  exit;

// Hardcoded data structure
$testimonios = [
  // TESTIMONIAL 1: Andrés Carey (With Logo, no company in the job-title text)
  [
    'titulo' => 'It all started with the need to scale',
    'texto' => 'We had already validated our value proposition in a demanding market, with growing demand and room for financial and technological innovation. With clear signs of product-market fit, the challenge shifted from convincing to scaling the business. The team understood that the next stage required strengthening the sales operation. We engaged Imppulsor’s Commercial Maturity Diagnostic because it matched our moment, pace, and need for clarity with precision. It provided a structured framework to analyze our operation, along with comparable evaluation criteria and a prioritized agenda of enabling actions for subsequent structural and operational improvements.',
    'autor' => 'Andrés Carey',
    'cargo' => 'Co-Founder, Chief Legal Officer',
    'imagen' => '/wp-content/uploads/andres-carey.jpg', /* <-- REPLACE WITH ANDRES'S PHOTO PATH */
    'logo_empresa' => '/wp-content/uploads/logo-wbuild.png',  /* <-- REPLACE WITH THE WBUILD LOGO PATH */
  ],
  // TESTIMONIAL 2: Cristian Arriagada (No logo, company included in the job-title text)
  [
    'titulo' => 'It all started with a diagnostic',
    'texto' => 'We had a talented team, but we knew we were far from reaching our true potential. The diagnostic gave us more than data: it showed us precisely where we were losing efficiency, which profiles needed support, and which practices we had to strengthen to grow with structure. From there we redesigned our ways of working, aligned the regional team, and improved key performance indicators across several countries. Today we operate with greater clarity, focus, and consistency, and we steadily raise the average effectiveness and productivity of our sales team.',
    'autor' => 'Cristian Arriagada',
    'cargo' => 'Regional Sales Director',
    'imagen' => '/wp-content/uploads/cristian-arriagada.jpg', /* <-- REPLACE WITH CRISTIAN'S PHOTO PATH */
    'logo_empresa' => '/wp-content/uploads/logo-hco2.png', /* <-- LEFT BLANK SO NO LOGO IS SHOWN */
  ]
];

if (empty($testimonios))
  return;
?>

<section class="section section-testimonio reveal">
  <div class="container section--dark p-relative bg-gradiente-insights-casos">

    <div id="testimonio-swiper" class="swiper testimonio-swiper w-100">
      <div class="swiper-wrapper">

        <?php foreach ($testimonios as $t): ?>
          <div class="swiper-slide">
            <div class="grid-2">

              <div class="grid-left image-grid h-100 w-100 h-420">
                <img src="<?php echo esc_url($t['imagen']); ?>" class="rounded-diagonal w-100 h-100 object-cover"
                  alt="<?php echo esc_attr($t['autor']); ?>">
              </div>

              <div class="grid-right text-white">
                <div class="testimonio-content">
                  <h2 class="heading-lg text-white line-left mb-40">
                    <?php echo esc_html($t['titulo']); ?>
                  </h2>

                  <div class="testimonio-text">
                    <p><?php echo wp_kses_post($t['texto']); ?></p>
                  </div>

                  <div class="testimonio-autor mt-20">
                    <strong class="fs-32"><?php echo esc_html($t['autor']); ?></strong><br>
                    <span class="cargo text-white"><?php echo wp_kses_post($t['cargo']); ?></span>

                    <?php if (!empty($t['logo_empresa'])): ?>
                      <div class="testimonio-logo mt-30">
                        <img src="<?php echo esc_url($t['logo_empresa']); ?>"
                          alt="Logo <?php echo esc_attr($t['autor']); ?>" style="max-height: 45px; object-fit: contain;">
                      </div>
                    <?php endif; ?>

                  </div>
                </div>

                <!-- Paginator inside the Slide -->
                <div class="logos-pagination d-flex justify-between mt-40 logos-pagination-absolute-bottom">
                  <div class="pagination testimonio-nav">
                    <span class="pagination-btn btn-prev-custom">Previous</span>
                    <div class="swiper-pagination-custom position-static w-auto d-flex align-center gap-10">
                      <?php foreach ($testimonios as $p_index => $p_t): ?>
                        <span class="pagination-number custom-bullet <?php echo $p_index === 0 ? 'active' : ''; ?>"
                          data-slide-index="<?php echo $p_index; ?>"><?php echo $p_index + 1; ?></span>
                      <?php endforeach; ?>
                    </div>
                    <span class="pagination-btn btn-next-custom">Next</span>
                  </div>
                </div>

              </div>

            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>

  </div>
</section>

<style>
  @media (min-width:992px) {
    .logos-pagination-absolute-bottom {
      position: absolute;
      bottom: 0;
    }

    .section-testimonio .image-grid {
      height: 810px !important;
    }

    .section-testimonio .image-grid img {
      height: 100% !important;
      object-fit: cover;
    }
  }

  .grid-right.text-white {
    height: 100%;
  }

  /* Testimonials Slider */
  .testimonio-swiper {
    overflow: hidden;
  }

  /* Fade Transition */
  .testimonio-swiper .swiper-slide {
    opacity: 0 !important;
    transition: opacity 0.6s ease-in-out;
    height: auto;
  }

  .testimonio-swiper .swiper-slide-active {
    opacity: 1 !important;
    z-index: 2;
  }

  /* Logo image */
  .testimonio-logo img {
    display: block;
    max-width: 200px;
  }

  /* Navigation and Pagination */
  .logos-pagination {
    width: 100%;
  }

  .testimonio-nav {
    display: inline-flex;
    gap: 8px;
    align-items: center;
    position: relative;
    z-index: 10;
  }

  .swiper-pagination-testimonio {
    display: inline-flex;
    gap: 8px;
    position: static;
  }

  .testimonio-nav .pagination-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border: 1px solid #fff;
    border-radius: 0;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all .3s ease;
    color: #fff;
    background: transparent;
    opacity: 1;
    /* override swiper disabled opacity */
    margin: 0 !important;
  }

  .testimonio-nav .pagination-number:hover,
  .testimonio-nav .pagination-number.active {
    background: #fff;
    color: #01224D !important;
    border-color: #fff;
  }

  .testimonio-nav .pagination-btn {
    border: 1px solid #fff;
    padding: 0px 8px;
    height: 26px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    cursor: pointer;
    transition: all .3s ease;
    font-weight: 600;
    width: max-content;
    color: #fff;
    text-transform: lowercase;
  }

  .testimonio-nav .pagination-btn::after {
    display: none;
    /* override default swiper arrows */
  }

  .testimonio-nav .pagination-btn:hover {
    background: #fff;
    border-color: #fff;
    color: #01224D !important;
  }

  .testimonio-nav .pagination-btn.swiper-button-disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: transparent !important;
    color: #fff !important;
  }

  /* Responsive */
  @media (max-width: 992px) {
    .testimonio-content {
      min-height: 600px;
    }

    .logos-pagination {
      justify-content: start !important;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    function initTestimonioSlider() {
      if (typeof Swiper === 'undefined') {
        setTimeout(initTestimonioSlider, 50);
        return;
      }

      const sliderElement = document.querySelector('#testimonio-swiper');
      if (!sliderElement || sliderElement.dataset.initialized) return;
      sliderElement.dataset.initialized = '1';

      const testimonioSwiper = new Swiper(sliderElement, {
        loop: true,
        speed: 800,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
          delay: 6000,
          disableOnInteraction: false,
        },
        on: {
          init: function () {
            updateCustomPagination(this.realIndex);
          },
          slideChangeTransitionStart: function () {
            this.slides.forEach(s => s.style.opacity = '0');
            if (this.slides[this.activeIndex]) {
              this.slides[this.activeIndex].style.opacity = '1';
            }
            updateCustomPagination(this.realIndex);
          }
        }
      });

      // Sincronizar clases active en todos los paginadores (clonados por loop)
      function updateCustomPagination(activeIndex) {
        // Actualizar bullets
        document.querySelectorAll('#testimonio-swiper .custom-bullet').forEach(bullet => {
          if (parseInt(bullet.dataset.slideIndex) === activeIndex) {
            bullet.classList.add('active');
          } else {
            bullet.classList.remove('active');
          }
        });

        // Actualizar botones prev/next
        const totalSlides = <?php echo count($testimonios); ?>;

        document.querySelectorAll('#testimonio-swiper .btn-prev-custom').forEach(btn => {
          btn.style.display = activeIndex === 0 ? 'none' : 'flex';
        });

        document.querySelectorAll('#testimonio-swiper .btn-next-custom').forEach(btn => {
          btn.style.display = activeIndex === totalSlides - 1 ? 'none' : 'flex';
        });
      }

      // Event delegation para los clics en los paginadores dentro del slider interactivo
      sliderElement.addEventListener('click', function (e) {
        if (e.target.closest('.custom-bullet')) {
          const index = parseInt(e.target.closest('.custom-bullet').dataset.slideIndex);
          testimonioSwiper.slideToLoop(index);
        } else if (e.target.closest('.btn-prev-custom')) {
          testimonioSwiper.slidePrev();
        } else if (e.target.closest('.btn-next-custom')) {
          testimonioSwiper.slideNext();
        }
      });
    }

    initTestimonioSlider();
  });
</script>