<?php
/**
 * Bloque testimonio (2 hardcoded) — mismo diseño que bloque-testimonios-voz-clientes.
 * Página Clientes y socios; no modifica bloque-testimonio.php.
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!function_exists('imppulsor_btvc_resolve_autor_id')) {
  /**
   * ID del CPT autores por título o ID numérico (misma fuente que bloque-testimonios-voz-clientes).
   */
  function imppulsor_btvc_resolve_autor_id($autor_ref) {
    if (is_numeric($autor_ref) && (int) $autor_ref > 0) {
      return (int) $autor_ref;
    }
    if (!is_string($autor_ref) || $autor_ref === '') {
      return 0;
    }

    global $wpdb;

    $autor_id = $wpdb->get_var(
      $wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_status = 'publish' AND post_title = %s LIMIT 1",
        'autores',
        $autor_ref
      )
    );

    return $autor_id ? (int) $autor_id : 0;
  }
}

$testimonios = [
  [
    'titulo' => 'Todo comenzó con la necesidad de escalar',
    'texto' => 'Ya habíamos validado nuestra propuesta de valor en un mercado exigente, con demanda creciente y espacio para innovación financiera y tecnológica. Con señales claras de product market fit, el desafío dejó de ser convencer y pasó a ser escalar el negocio. El equipo entendió que la siguiente etapa exigía fortalecer la operación comercial. Aplicamos el Diagnóstico de Madurez Comercial de Imppulsor porque calzaba con precisión con nuestro momento, velocidad y necesidad de claridad. Este aportó un marco estructurado para analizar nuestra operación, junto con criterios comparables de evaluación y una agenda priorizada de acciones habilitantes para mejoras estructurales y operativas posteriores.',
    'autor' => 'Andrés Carey',
    'cargo' => 'Co-Founder & Chief Legal Officer',
    'empresa' => '',
    'imagen' => '/wp-content/uploads/andres-carey-carvallo.jpg',
    'logo_empresa' => '/wp-content/uploads/logo-wbuild.png',
    'ubicacion' => 'Chile',
    'linkedin' => '',
  ],
  [
    'titulo' => 'Todo comenzó con un diagnóstico',
    'texto' => 'Teníamos un equipo talentoso, pero sabíamos que estábamos lejos de alcanzar nuestro verdadero potencial. El diagnóstico no solo nos entregó datos: nos mostró con precisión dónde estábamos perdiendo eficiencia, qué perfiles necesitaban acompañamiento y qué prácticas debíamos reforzar para crecer con estructura. A partir de ahí rediseñamos nuestros modelos de trabajo, alineamos al equipo regional y mejoramos los indicadores clave de desempeño en varios países. Hoy operamos con más claridad, foco y consistencia, y elevamos con consistencia la efectividad y productividad promedio de nuestro equipo comercial.',
    'autor' => 'Cristian Arriagada',
    'cargo' => 'Regional Sales Director',
    'empresa' => 'H&CO Tech',
    'imagen' => '/wp-content/uploads/cristian-arriagada.jpg',
    'logo_empresa' => '/wp-content/uploads/logo-hco2.png',
    'ubicacion' => 'América Latina y el Caribe',
    'linkedin' => '',
  ],
];

if (empty($testimonios)) {
  return;
}

$total_slides = count($testimonios);
?>

<section id="bloque-testimonio-voz-clientes" class="bloque-testimonio-voz-clientes section py-0 bg-white text-dark reveal<?php echo $total_slides <= 1 ? ' btvc--single' : ''; ?>">
  <div class="container py-60">

    <div class="btvc-header">
      <div class="btvc-header__text">
        <div class="badge bg-light-blue px-40 text-bold mb-20">Testimonios</div>
        <h2 class="heading-lg btvc-title text-dark mb-10">La voz de nuestros <br> clientes</h2>
        <p class="btvc-subtitle text-dark mb-0">
          Organizaciones que han diagnosticado sus operaciones junto a nosotros.
        </p>
      </div>
      <div class="btvc-header__nav" aria-hidden="<?php echo $total_slides <= 1 ? 'true' : 'false'; ?>">
        <div class="swiper-button-prev btvc-nav-btn btvc-nav-btn--prev" role="button" tabindex="0" aria-label="<?php esc_attr_e('Anterior', 'imppulsorv2'); ?>"></div>
        <div class="swiper-button-next btvc-nav-btn btvc-nav-btn--next" role="button" tabindex="0" aria-label="<?php esc_attr_e('Siguiente', 'imppulsorv2'); ?>"></div>
      </div>
    </div>

    <div class="btvc-wrap">
      <div class="swiper btvc-swiper">
        <div class="swiper-wrapper">

          <?php foreach ($testimonios as $t) : ?>
            <?php
            $autor_id = 0;
            if (!empty($t['autor_id'])) {
              $autor_id = (int) $t['autor_id'];
            } elseif (!empty($t['autor'])) {
              $autor_id = imppulsor_btvc_resolve_autor_id($t['autor']);
            }

            $nombre_autor = $t['autor'] ?? '';
            if ($autor_id) {
              $nombre_autor = get_the_title($autor_id) ?: $nombre_autor;
            }

            $cargo_autor = $t['cargo'] ?? '';
            if ($cargo_autor === '' && $autor_id) {
              $cargo_autor = (string) get_field('cargo_autor', $autor_id);
            }

            $empresa_autor = isset($t['empresa']) ? trim((string) $t['empresa']) : '';
            if ($empresa_autor === '' && $autor_id) {
              $empresa_autor = trim((string) get_field('empresa_autor', $autor_id));
            }

            $linkedin_autor = isset($t['linkedin']) ? trim((string) $t['linkedin']) : '';
            if ($linkedin_autor === '' && $autor_id) {
              $linkedin_autor = trim((string) get_field('linkedin_autor', $autor_id));
            }

            $ubicacion_autor = isset($t['ubicacion']) ? trim((string) $t['ubicacion']) : '';

            $rol_linea = trim($cargo_autor . (($cargo_autor && $empresa_autor) ? ' | ' : '') . $empresa_autor);
            ?>

            <div class="swiper-slide">
              <div class="btvc-slide">
                <div class="btvc-slide__media">
                  <?php if (!empty($t['imagen'])) : ?>
                    <img src="<?php echo esc_url($t['imagen']); ?>" class="btvc-slide__img" alt="<?php echo esc_attr($nombre_autor); ?>">
                  <?php else : ?>
                    <div class="btvc-slide__img btvc-slide__img--placeholder" aria-hidden="true"></div>
                  <?php endif; ?>
                </div>

                <div class="btvc-slide__card">
                  <div class="btvc-slide__main">
                    <span class="btvc-quote" aria-hidden="true">
                      <img
                        class="btvc-quote__img"
                        src="<?php echo esc_url( content_url( 'uploads/icono-comillas.svg' ) ); ?>"
                        alt=""
                        width="44"
                        height="44"
                        loading="lazy"
                        decoding="async"
                      />
                    </span>

                    <div class="btvc-slide__body">
                      <p><?php echo wp_kses_post($t['texto']); ?></p>
                    </div>
                  </div>

                  <?php if ($nombre_autor || $rol_linea || $ubicacion_autor || $linkedin_autor) : ?>
                    <div class="btvc-slide__footer">
                      <?php if ($nombre_autor) : ?>
                        <strong class="btvc-slide__name"><?php echo esc_html($nombre_autor); ?></strong>
                      <?php endif; ?>
                      <?php if ($rol_linea) : ?>
                        <span class="btvc-slide__role"><?php echo esc_html($rol_linea); ?></span>
                      <?php endif; ?>
                      <?php if ($ubicacion_autor) : ?>
                        <span class="btvc-slide__loc"><?php echo esc_html($ubicacion_autor); ?></span>
                      <?php endif; ?>
                      <?php if ($linkedin_autor) : ?>
                        <a class="btvc-slide__linkedin" href="<?php echo esc_url($linkedin_autor); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(sprintf(__('LinkedIn de %s', 'imppulsorv2'), $nombre_autor)); ?>">in</a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

        </div>
      </div>

      <?php if ($total_slides > 1) : ?>
        <div class="btvc-pagination-outer">
          <nav class="insights-pagination btvc-insights-pagination" aria-label="<?php esc_attr_e('Paginación testimonio', 'imppulsorv2'); ?>">
            <span class="insights-pagination__bullet insights-pagination__bullet--nav btvc-pag-prev" style="display: none;">anterior</span>
            <span class="btvc-pag-mid"></span>
            <span class="insights-pagination__bullet insights-pagination__bullet--nav btvc-pag-next">siguiente</span>
          </nav>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<style>
  #bloque-testimonio-voz-clientes {
    position: relative;
  }

  #bloque-testimonio-voz-clientes.btvc--single .btvc-header__nav {
    display: none !important;
  }

  #bloque-testimonio-voz-clientes .btvc-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 8px;
  }

  #bloque-testimonio-voz-clientes .badge.bg-light-blue {
    display: inline-block;
    text-align: center;
    min-width: 189px;
    width: max-content;
    max-width: 279px;
    padding: 4px 20px !important;
    text-transform: uppercase;
    background-color: var(--azul-claro, #126cfb) !important;
    color: #fff !important;
  }

  #bloque-testimonio-voz-clientes .btvc-subtitle {
    max-width: 520px;
    font-size: 16px;
    line-height: 1.5;
    opacity: 0.88;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
    margin-top: 4px;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn {
    position: relative !important;
    width: 44px;
    height: 44px;
    margin: 0 !important;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    top: auto !important;
    left: auto !important;
    right: auto !important;
    inset: auto !important;
    overflow: hidden;
  }

  /* Centrado real del glifo: caja flex a todo el botón (evita pelear con Swiper + utilities) */
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn::after {
    position: absolute !important;
    inset: 0 !important;
    left: 0 !important;
    top: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100% !important;
    height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-sizing: border-box !important;
    line-height: 1 !important;
    font-size: 20px !important;
    font-weight: 700 !important;
    font-family: inherit !important;
    content: '➜' !important;
    color: #fff !important;
    transform: none !important;
    transform-origin: 50% 50% !important;
    transition: color 0.2s ease;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn--prev::after {
    transform: rotate(180deg) !important;
  }

  /* Normal: fondo azul, icono blanco */
  #bloque-testimonio-voz-clientes .btvc-nav-btn--prev,
  #bloque-testimonio-voz-clientes .btvc-nav-btn--next,
  #bloque-testimonio-voz-clientes .btvc-nav-btn.swiper-button-disabled,
  #bloque-testimonio-voz-clientes .btvc-nav-btn.swiper-button-lock {
    background: #006eff !important;
    border: 1px solid #006eff !important;
    opacity: 1 !important;
    transition: background 0.2s ease, border-color 0.2s ease;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock {
    pointer-events: auto !important;
    cursor: pointer !important;
    background: #006eff !important;
    border-color: #006eff !important;
    opacity: 1 !important;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock::after {
    color: #fff !important;
  }

  /* Hover / foco: fondo blanco, borde negro, icono negro */
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn:hover,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn:focus-visible,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:hover,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:hover,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:focus-visible,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:focus-visible {
    background: #fff !important;
    border-color: #000 !important;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn:hover::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn:focus-visible::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:hover::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:hover::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:focus-visible::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:focus-visible::after {
    color: #000 !important;
  }

  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn--prev:hover::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn--prev:focus-visible::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn--prev.swiper-button-disabled:hover::after,
  #bloque-testimonio-voz-clientes .btvc-header__nav .btvc-nav-btn--prev.swiper-button-lock:hover::after {
    transform: rotate(180deg) !important;
  }

  /* Safari: capas de reveal/Swiper pintaban la foto encima de la tarjeta azul */
  #bloque-testimonio-voz-clientes.reveal .btvc-slide__img,
  #bloque-testimonio-voz-clientes.reveal.visible .btvc-slide__img {
    opacity: 1 !important;
    filter: none !important;
    transform: translateZ(0) !important;
    transition: none !important;
    will-change: auto !important;
  }

  #bloque-testimonio-voz-clientes .btvc-wrap {
    position: relative;
    isolation: isolate;
  }

  #bloque-testimonio-voz-clientes .btvc-swiper {
    overflow: hidden;
  }

  #bloque-testimonio-voz-clientes .btvc-swiper .swiper-slide {
    position: relative;
    z-index: 0;
  }

  #bloque-testimonio-voz-clientes .btvc-swiper .swiper-slide-active {
    z-index: 2;
  }

  #bloque-testimonio-voz-clientes .btvc-slide {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    align-items: stretch;
    gap: 0;
    margin-top: 95px;
    position: relative;
    isolation: isolate;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__media {
    height: 640px;
    width: calc(100% + 40px);
    overflow: hidden;
    position: relative;
    z-index: 1;
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__img {
    width: 100%;
    height: 100%;
    min-height: 0;
    object-fit: cover;
    display: block;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__img--placeholder {
    width: 100%;
    height: 100%;
    min-height: 0;
    background: #e8e8e8;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__card {
    background: #030f23;
    color: #fff;
    padding: 36px 32px 32px;
    position: relative;
    z-index: 2;
    align-self: start;
    margin-left: -40px;
    transform: translate3d(0, 0, 0);
    isolation: isolate;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  @media (min-width: 993px) {
    #bloque-testimonio-voz-clientes .btvc-header {
      margin-bottom: -80px;
    }

    #bloque-testimonio-voz-clientes .swiper-slide {
      padding-top: 80px;
    }

    #bloque-testimonio-voz-clientes .btvc-slide__card {
      margin-top: -70px;
    min-height: 575px;
    display: flex;
    flex-direction: column;
    width: calc(100% + 40px);
    height: 640px;
    }

    #bloque-testimonio-voz-clientes .btvc-slide__main {
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      min-height: 0;
    }

    #bloque-testimonio-voz-clientes .btvc-slide__body {
      flex: 1 1 auto;
      min-height: 0;
      display: flex;
      flex-direction: column;
    }
  }

  /* Contenido enriquecido del CPT: forzar legibilidad en fondo oscuro */
  #bloque-testimonio-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body,
  #bloque-testimonio-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body * {
    color: #fff !important;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body a {
    text-decoration: underline;
    text-underline-offset: 2px;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body a:hover {
    color: #7eb8ff !important;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body li::marker {
    color: #fff;
  }

  #bloque-testimonio-voz-clientes .btvc-quote {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    background: #006eff;
    margin-bottom: 20px;
    flex-shrink: 0;
  }

  #bloque-testimonio-voz-clientes .btvc-quote__img {
    display: block;
    width: 44px;
    height: auto;
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__body {
    font-size: 16px;
    line-height: 1.6;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__body p {
    color: #fff;
    margin: 0 0 12px;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__body p:last-child {
    margin-bottom: 0;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__footer {
    margin-top: 28px;
    margin-bottom: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 5px;
    align-items: flex-start;
    align-self: flex-start;
    width: max-content;
    max-width: 100%;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__footer > * {
    display: block;
    margin: 0;
    padding: 0;
    line-height: 1.5;
    letter-spacing: 0;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__name {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.4;
    color: #fff !important;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__role,
  #bloque-testimonio-voz-clientes .btvc-slide__loc {
    font-size: 16px;
    font-weight: 300;
    line-height: 1.4;
    color: rgba(255, 255, 255, 0.9) !important;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__linkedin {
    font-size: 20px !important;
    font-weight: 700;
    line-height: 1.4;
    color: #fff !important;
    text-decoration: none;
    border: 0;
    align-self: flex-start;
  }

  #bloque-testimonio-voz-clientes .btvc-slide__linkedin:hover {
    color: #7eb8ff !important;
  }

  #bloque-testimonio-voz-clientes .btvc-pagination-outer {
    display: flex;
    justify-content: center;
    margin-top: 36px;
  }

  /* Misma línea visual que insights (listado), acotado al bloque */
  #bloque-testimonio-voz-clientes .btvc-insights-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    width: 100%;
  }

  #bloque-testimonio-voz-clientes .btvc-insights-pagination .btvc-pag-mid {
    display: inline-flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
  }

  #bloque-testimonio-voz-clientes .btvc-insights-pagination .insights-pagination__bullet {
    width: 26px;
    height: 26px;
    border: 1px solid #000;
    background: transparent;
    color: #000;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
    border-radius: 0;
    cursor: pointer;
    text-decoration: none;
    box-sizing: border-box;
  }

  #bloque-testimonio-voz-clientes .btvc-insights-pagination .insights-pagination__bullet--nav {
    width: max-content;
    padding: 0 12px;
    text-transform: lowercase;
  }

  #bloque-testimonio-voz-clientes .btvc-insights-pagination .insights-pagination__bullet--active,
  #bloque-testimonio-voz-clientes .btvc-insights-pagination .insights-pagination__bullet:not(.dots):hover {
    background: #006eff;
    border-color: #006eff;
    color: #fff !important;
  }

  #bloque-testimonio-voz-clientes .btvc-insights-pagination .insights-pagination__bullet.border-0.dots {
    border: 0;
    width: auto;
    min-width: 0;
    padding: 0 2px;
    cursor: default;
    pointer-events: none;
    background: transparent;
    color: #000;
  }

  #bloque-testimonio-voz-clientes .btvc-insights-pagination .insights-pagination__bullet.border-0.dots:hover {
    background: transparent;
    border: 0;
    color: #000;
  }

  @media (max-width: 992px) {
    #bloque-testimonio-voz-clientes .btvc-slide {
      grid-template-columns: 1fr;
      margin-top: 24px;
    }

    #bloque-testimonio-voz-clientes .btvc-slide__card {
      margin-left: 0;
      margin-top: -40px;
      margin-right: 16px;
      margin-left: 16px;
    }

    #bloque-testimonio-voz-clientes .btvc-header__nav {
      width: 100%;
      justify-content: flex-end;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    function initBtvcTestimonioVozClientes() {
      if (typeof Swiper === 'undefined') {
        setTimeout(initBtvcTestimonioVozClientes, 50);
        return;
      }

      var root = document.querySelector('#bloque-testimonio-voz-clientes');
      if (!root) return;

      var slider = root.querySelector('.btvc-swiper');
      var nextBtn = root.querySelector('.swiper-button-next');
      var prevBtn = root.querySelector('.swiper-button-prev');
      var pag = root.querySelector('.btvc-insights-pagination');
      var pagMid = pag ? pag.querySelector('.btvc-pag-mid') : null;
      var pPrev = pag ? pag.querySelector('.btvc-pag-prev') : null;
      var pNext = pag ? pag.querySelector('.btvc-pag-next') : null;
      if (!slider || !nextBtn || !prevBtn) return;

      if (root.dataset.btvcSwiperInit) return;
      root.dataset.btvcSwiperInit = '1';

      if (slider.swiper) {
        slider.swiper.destroy(true, true);
      }

      var total = root.querySelectorAll('.btvc-swiper .swiper-slide').length;

      function getVisiblePages(current, pageCount) {
        var delta = 2;
        var range = [];
        var i;
        for (i = 1; i <= pageCount; i++) {
          if (i === 1 || i === pageCount || (i >= current - delta && i <= current + delta)) {
            range.push(i);
          }
        }
        var out = [];
        var l = null;
        for (var j = 0; j < range.length; j++) {
          i = range[j];
          if (l !== null) {
            if (i - l === 2) {
              out.push(l + 1);
            } else if (i - l !== 1) {
              out.push('\u2026');
            }
          }
          out.push(i);
          l = i;
        }
        return out;
      }

      var sw = new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: false,
        rewind: total > 1,
        speed: 600,
        autoplay: total > 1 ? {
          delay: 6000,
          disableOnInteraction: false
        } : false,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn
        },
        observer: true,
        observeParents: true,
        allowTouchMove: true
      });

      function renderPaginationMid() {
        if (!pagMid || total <= 1) return;
        var page = sw.activeIndex + 1;
        var items = total <= 9
          ? Array.from({ length: total }, function (_, k) { return k + 1; })
          : getVisiblePages(page, total);

        pagMid.innerHTML = '';
        items.forEach(function (item) {
          if (item === '\u2026') {
            var d = document.createElement('span');
            d.className = 'insights-pagination__bullet border-0 dots';
            d.setAttribute('aria-hidden', 'true');
            d.textContent = '\u2026';
            pagMid.appendChild(d);
            return;
          }
          var span = document.createElement('span');
          span.className = 'insights-pagination__bullet';
          if (item === page) {
            span.classList.add('insights-pagination__bullet--active');
            span.setAttribute('aria-current', 'page');
          }
          span.setAttribute('role', 'button');
          span.setAttribute('tabindex', '0');
          span.setAttribute('data-page', String(item));
          span.textContent = String(item);
          var go = function () {
            sw.slideTo(item - 1);
          };
          span.addEventListener('click', go);
          span.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
              e.preventDefault();
              go();
            }
          });
          pagMid.appendChild(span);
        });
      }

      function syncPagination() {
        if (!pag || total <= 1) return;
        var page = sw.activeIndex + 1;
        renderPaginationMid();
        if (pPrev) pPrev.style.display = page === 1 ? 'none' : 'inline-flex';
        if (pNext) pNext.style.display = page === total ? 'none' : 'inline-flex';
      }

      if (pag && total > 1) {
        if (pPrev) pPrev.addEventListener('click', function () { sw.slidePrev(); });
        if (pNext) pNext.addEventListener('click', function () { sw.slideNext(); });
      }

      sw.on('slideChange', syncPagination);
      syncPagination();

      setTimeout(function () {
        sw.update();
      }, 300);
    }

    initBtvcTestimonioVozClientes();
  });
</script>
