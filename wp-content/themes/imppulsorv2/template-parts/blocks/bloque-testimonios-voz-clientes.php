<?php
/**
 * Block: Testimonials — "Our clients' voice" design (Clients and partners).
 * Same ordering logic as bloque-testimonios.php; own styles and layout.
 */

if (!defined('ABSPATH')) {
  exit;
}

$query = new WP_Query([
  'post_type'      => 'testimonios',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
]);

if (!$query->have_posts()) {
  return;
}

$all_posts = $query->posts;
$grupos_por_empresa = [];
$sin_empresa = [];

foreach ($all_posts as $p) {
  $empresa_nombre = '';
  $autor_rel = get_field('autor_relacionado', $p->ID);
  if (is_array($autor_rel) && !empty($autor_rel)) {
    $first = $autor_rel[0];
    $autor_id = is_object($first) ? $first->ID : (is_array($first) ? $first['ID'] : $first);
    if ($autor_id) {
      $empresa_nombre = get_field('empresa_autor', $autor_id);
    }
  }
  $empresa_nombre = trim((string) $empresa_nombre);
  if (!empty($empresa_nombre)) {
    $grupos_por_empresa[$empresa_nombre][] = $p;
  } else {
    $sin_empresa[] = $p;
  }
}

$lista_principal = [];
$lista_sobrante = [];
$nombres_de_empresas = array_keys($grupos_por_empresa);
shuffle($nombres_de_empresas);

foreach ($nombres_de_empresas as $empresa) {
  shuffle($grupos_por_empresa[$empresa]);
  $lista_principal[] = array_shift($grupos_por_empresa[$empresa]);
  if (!empty($grupos_por_empresa[$empresa])) {
    $lista_sobrante = array_merge($lista_sobrante, $grupos_por_empresa[$empresa]);
  }
}

shuffle($lista_sobrante);
shuffle($sin_empresa);
$posts_ordenados = array_merge($lista_principal, $sin_empresa, $lista_sobrante);
$total_slides = count($posts_ordenados);
$btvc_imagen_compartida = content_url('uploads/imagen-voz-para-todos.jpg');
?>

<section id="bloque-testimonios-voz-clientes" class="bloque-testimonios-voz-clientes py-0 section bg-white text-dark reveal<?php echo $total_slides <= 1 ? ' btvc--single' : ''; ?>">
  <div class="container py-60">

    <div class="btvc-header">
      <div class="btvc-header__text">
        <div class="badge bg-light-blue px-40 text-bold mb-20">Testimonials</div>
        <h2 class="heading-lg btvc-title text-dark mb-10">The voice of our <br> clients</h2>
        <p class="btvc-subtitle text-dark mb-0">
          Organizations that have transformed their operations with us.
        </p>
      </div>
      <div class="btvc-header__nav" aria-hidden="<?php echo $total_slides <= 1 ? 'true' : 'false'; ?>">
        <div class="swiper-button-prev btvc-nav-btn btvc-nav-btn--prev" role="button" tabindex="0" aria-label="<?php esc_attr_e('Previous', 'imppulsorv2'); ?>"></div>
        <div class="swiper-button-next btvc-nav-btn btvc-nav-btn--next" role="button" tabindex="0" aria-label="<?php esc_attr_e('Next', 'imppulsorv2'); ?>"></div>
      </div>
    </div>

    <div class="btvc-wrap">
      <div class="btvc-stage">
        <div class="btvc-stage__col btvc-stage__col--media">
          <div class="btvc-slide__media">
            <img
              src="<?php echo esc_url($btvc_imagen_compartida); ?>"
              class="btvc-slide__img"
              alt="<?php esc_attr_e('The voice of our clients', 'imppulsorv2'); ?>"
              width="660"
              height="660"
              decoding="async"
            >
          </div>
        </div>

        <div class="btvc-stage__col btvc-stage__col--cards">
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

              <div class="btvc-text-swiper-wrap">
                <div class="swiper btvc-swiper btvc-text-swiper">
                  <div class="swiper-wrapper">

          <?php foreach ($posts_ordenados as $post) : ?>
            <?php setup_postdata($post); ?>

            <?php
            $autor_rel = get_field('autor_relacionado');
            $autor_id = null;
            if (is_array($autor_rel) && !empty($autor_rel)) {
              $first = $autor_rel[0];
              $autor_id = is_object($first) ? $first->ID : (is_array($first) ? $first['ID'] : $first);
            }
            $nombre_autor = $autor_id ? get_the_title($autor_id) : '';
            $empresa_autor = $autor_id ? get_field('empresa_autor', $autor_id) : '';
            $cargo_autor = $autor_id ? get_field('cargo_autor', $autor_id) : '';
            $linkedin_autor = $autor_id ? get_field('linkedin_autor', $autor_id) : '';
            $ubicacion_autor = imppulsor_get_testimonio_pais(get_the_ID(), $autor_id ? (int) $autor_id : 0);
            $rol_linea = trim($cargo_autor . (($cargo_autor && $empresa_autor) ? ' | ' : '') . $empresa_autor);
            $has_footer = $nombre_autor || $rol_linea || $ubicacion_autor || $linkedin_autor;
            ?>

            <div class="swiper-slide">
              <div class="btvc-slide__body">
                <?php echo apply_filters('the_content', get_the_content()); ?>
              </div>
              <?php if ($has_footer) : ?>
                <template class="btvc-footer-source">
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
                    <a class="btvc-slide__linkedin" href="<?php echo esc_url($linkedin_autor); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(sprintf(__('%s on LinkedIn', 'imppulsorv2'), $nombre_autor)); ?>">in</a>
                  <?php endif; ?>
                </template>
              <?php endif; ?>
            </div>

          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>

                  </div>
                </div>
              </div>
            </div>

            <div class="btvc-slide__footer btvc-slide__footer--live" aria-live="polite"></div>
          </div>
        </div>
      </div>

      <?php if ($total_slides > 1) : ?>
        <div class="btvc-pagination-outer">
          <nav class="insights-pagination btvc-insights-pagination" aria-label="<?php esc_attr_e('Testimonials pagination', 'imppulsorv2'); ?>">
            <span class="insights-pagination__bullet insights-pagination__bullet--nav btvc-pag-prev" style="display: none;">previous</span>
            <span class="btvc-pag-mid"></span>
            <span class="insights-pagination__bullet insights-pagination__bullet--nav btvc-pag-next">next</span>
          </nav>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<style>
  #bloque-testimonios-voz-clientes {
    position: relative;
  }

  #bloque-testimonios-voz-clientes.btvc--single .btvc-header__nav {
    display: none !important;
  }

  #bloque-testimonios-voz-clientes .btvc-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 8px;
  }

  #bloque-testimonios-voz-clientes .badge.bg-light-blue {
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

  #bloque-testimonios-voz-clientes .btvc-subtitle {
    max-width: 520px;
    font-size: 16px;
    line-height: 1.5;
    opacity: 0.88;
  }

  #bloque-testimonios-voz-clientes .btvc-header__nav {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
    margin-top: 4px;
  }

  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn {
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
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn::after {
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

  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn--prev::after {
    transform: rotate(180deg) !important;
  }

  /* Normal: fondo azul, icono blanco */
  #bloque-testimonios-voz-clientes .btvc-nav-btn--prev,
  #bloque-testimonios-voz-clientes .btvc-nav-btn--next,
  #bloque-testimonios-voz-clientes .btvc-nav-btn.swiper-button-disabled,
  #bloque-testimonios-voz-clientes .btvc-nav-btn.swiper-button-lock {
    background: #006eff !important;
    border: 1px solid #006eff !important;
    opacity: 1 !important;
    transition: background 0.2s ease, border-color 0.2s ease;
  }

  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock {
    pointer-events: auto !important;
    cursor: pointer !important;
    background: #006eff !important;
    border-color: #006eff !important;
    opacity: 1 !important;
  }

  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock::after {
    color: #fff !important;
  }

  /* Hover / foco: fondo blanco, borde negro, icono negro */
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn:hover,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn:focus-visible,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:hover,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:hover,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:focus-visible,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:focus-visible {
    background: #fff !important;
    border-color: #000 !important;
  }

  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn:hover::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn:focus-visible::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:hover::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:hover::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-disabled:focus-visible::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn.swiper-button-lock:focus-visible::after {
    color: #000 !important;
  }

  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn--prev:hover::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn--prev:focus-visible::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn--prev.swiper-button-disabled:hover::after,
  #bloque-testimonios-voz-clientes .btvc-header__nav .btvc-nav-btn--prev.swiper-button-lock:hover::after {
    transform: rotate(180deg) !important;
  }

  /* Safari: reveal global en img + fade Swiper crean capas que pintan la foto encima de la tarjeta */
  #bloque-testimonios-voz-clientes.reveal .btvc-stage__col--media .btvc-slide__img,
  #bloque-testimonios-voz-clientes.reveal.visible .btvc-stage__col--media .btvc-slide__img {
    opacity: 1 !important;
    filter: none !important;
    transform: translateZ(0) !important;
    transition: none !important;
    will-change: auto !important;
  }

  #bloque-testimonios-voz-clientes .btvc-wrap {
    position: relative;
    overflow: visible;
  }

  #bloque-testimonios-voz-clientes .btvc-stage {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
    align-items: stretch;
    gap: 0;
    margin-top: 95px;
    overflow: visible;
    position: relative;
    isolation: isolate;
  }

  #bloque-testimonios-voz-clientes .btvc-stage__col {
    min-width: 0;
    min-height: 0;
  }

  #bloque-testimonios-voz-clientes .btvc-stage__col--media {
    position: relative;
    z-index: 1;
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  #bloque-testimonios-voz-clientes .btvc-stage__col--cards {
    position: relative;
    z-index: 2;
    min-width: 0;
    transform: translate3d(0, 0, 0);
    isolation: isolate;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__main {
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    min-height: 0;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper-wrap {
    flex: 1 1 auto;
    min-height: 0;
    position: relative;
    overflow: hidden;
    overflow-x: hidden;
    isolation: isolate;
    contain: layout paint;
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  /* Fade solo en el texto; la tarjeta azul permanece fija */
  #bloque-testimonios-voz-clientes .btvc-text-swiper {
    overflow: hidden;
    overflow-x: hidden;
    min-width: 0;
    width: 100%;
    height: 100%;
    position: relative;
  }

  /* Evita barra horizontal al cargar, antes de que Swiper apile los slides */
  #bloque-testimonios-voz-clientes .btvc-text-swiper:not(.swiper-initialized) .swiper-wrapper {
    display: block;
    overflow: hidden;
    overflow-x: hidden;
    transform: none !important;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper:not(.swiper-initialized) .swiper-slide {
    width: 100% !important;
    margin: 0 !important;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper:not(.swiper-initialized) .swiper-slide:not(:first-child) {
    display: none;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper .swiper-wrapper {
    overflow-x: hidden;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper.swiper-fade .swiper-wrapper {
    height: 100%;
    overflow-x: hidden;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper.swiper-fade .swiper-slide {
    height: 100%;
    width: 100%;
    box-sizing: border-box;
    transition-property: opacity;
    overflow: hidden;
    overflow-x: hidden;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper .btvc-slide__body {
    width: 100%;
    max-width: 100%;
    min-width: 0;
    box-sizing: border-box;
    overflow: hidden auto;
    overflow-wrap: break-word;
    word-wrap: break-word;
  }

  #bloque-testimonios-voz-clientes .btvc-text-swiper .btvc-slide__body :is(img, video, iframe, table, pre) {
    max-width: 100%;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__footer--live {
    flex-shrink: 0;
  }

  #bloque-testimonios-voz-clientes .btvc-stage__col--media .btvc-slide__media {
    height: 640px;
    width: calc(100% + 40px);
    overflow: hidden;
    position: relative;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__img {
    width: 100%;
    height: 100%;
    min-height: 0;
    object-fit: cover;
    display: block;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__img--placeholder {
    width: 100%;
    height: 100%;
    min-height: 0;
    background: #e8e8e8;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__card {
    background: #030f23;
    color: #fff;
    padding: 36px 32px 32px;
    position: relative;
    z-index: 1;
    align-self: flex-start;
    width: 100%;
    box-sizing: border-box;
    margin: 0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    overflow-x: hidden;
    transform: translate3d(0, 0, 0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  @media (min-width: 993px) {
    #bloque-testimonios-voz-clientes .btvc-header {
      margin-bottom: -80px;
    }

    #bloque-testimonios-voz-clientes .btvc-stage {
      padding-top: 80px;
      align-items: start;
    }

    /* Mismos offsets que el bloque original, aplicados a la columna (no recorta el texto del Swiper) */
    #bloque-testimonios-voz-clientes .btvc-stage__col--cards {
      margin-left: -40px;
      margin-top: -70px;
      width: calc(100% + 40px);
      align-self: start;
    }

    #bloque-testimonios-voz-clientes .btvc-stage__col--cards .btvc-slide__card {
      min-height: 575px;
      height: 640px;
      width: 100%;
    }

    #bloque-testimonios-voz-clientes .btvc-text-swiper,
    #bloque-testimonios-voz-clientes .btvc-text-swiper .swiper-slide {
      height: 100%;
    }

    #bloque-testimonios-voz-clientes .btvc-slide__body {
      flex: 1 1 auto;
      min-height: 0;
      display: flex;
      flex-direction: column;
      overflow: hidden auto;
      scrollbar-gutter: stable;
      scrollbar-width: thin;
    }

    #bloque-testimonios-voz-clientes .btvc-slide__body::-webkit-scrollbar {
      width: 6px;
      height: 0;
    }
  }

  /* Contenido enriquecido del CPT: forzar legibilidad en fondo oscuro */
  #bloque-testimonios-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body,
  #bloque-testimonios-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body * {
    color: #fff !important;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body a {
    text-decoration: underline;
    text-underline-offset: 2px;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body a:hover {
    color: #7eb8ff !important;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__card .btvc-slide__main .btvc-slide__body li::marker {
    color: #fff;
  }

  #bloque-testimonios-voz-clientes .btvc-quote {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    background: #006eff;
    margin-bottom: 20px;
    flex-shrink: 0;
  }

  #bloque-testimonios-voz-clientes .btvc-quote__img {
    display: block;
    width: 44px;
    height: auto;
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__body {
    font-size: 16px;
    line-height: 1.6;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__body p {
    color: #fff;
    margin: 0 0 12px;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__body p:last-child {
    margin-bottom: 0;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__footer {
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

  #bloque-testimonios-voz-clientes .btvc-slide__footer > * {
    display: block;
    margin: 0;
    padding: 0;
    line-height: 1.4;
    letter-spacing: 0;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__name {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.4;
    color: #fff !important;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__role,
  #bloque-testimonios-voz-clientes .btvc-slide__loc {
    font-size: 16px;
    font-weight: 300;
    line-height: 1.4;
    color: rgba(255, 255, 255, 0.9) !important;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__linkedin {
    font-size: 20px !important;
    font-weight: 700;
    line-height: 1.4;
    color: #fff !important;
    text-decoration: none;
    border: 0;
    align-self: flex-start;
  }

  #bloque-testimonios-voz-clientes .btvc-slide__linkedin:hover {
    color: #7eb8ff !important;
  }

  #bloque-testimonios-voz-clientes .btvc-pagination-outer {
    display: flex;
    justify-content: center;
    margin-top: 36px;
  }

  /* Misma línea visual que insights (listado), acotado al bloque */
  #bloque-testimonios-voz-clientes .btvc-insights-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    width: 100%;
  }

  #bloque-testimonios-voz-clientes .btvc-insights-pagination .btvc-pag-mid {
    display: inline-flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
  }

  #bloque-testimonios-voz-clientes .btvc-insights-pagination .insights-pagination__bullet {
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

  #bloque-testimonios-voz-clientes .btvc-insights-pagination .insights-pagination__bullet--nav {
    width: max-content;
    padding: 0 12px;
    text-transform: lowercase;
  }

  #bloque-testimonios-voz-clientes .btvc-insights-pagination .insights-pagination__bullet--active,
  #bloque-testimonios-voz-clientes .btvc-insights-pagination .insights-pagination__bullet:not(.dots):hover {
    background: #006eff;
    border-color: #006eff;
    color: #fff !important;
  }

  #bloque-testimonios-voz-clientes .btvc-insights-pagination .insights-pagination__bullet.border-0.dots {
    border: 0;
    width: auto;
    min-width: 0;
    padding: 0 2px;
    cursor: default;
    pointer-events: none;
    background: transparent;
    color: #000;
  }

  #bloque-testimonios-voz-clientes .btvc-insights-pagination .insights-pagination__bullet.border-0.dots:hover {
    background: transparent;
    border: 0;
    color: #000;
  }

  @media (max-width: 992px) {
    #bloque-testimonios-voz-clientes .btvc-stage {
      grid-template-columns: 1fr;
      margin-top: 24px;
      padding-top: 0;
    }

    #bloque-testimonios-voz-clientes .btvc-stage__col--media .btvc-slide__media {
      width: 100%;
      height: auto;
      aspect-ratio: 1 / 1;
    }

    #bloque-testimonios-voz-clientes .btvc-stage__col--cards {
      margin-left: 0;
      margin-top: 0;
      width: 100%;
    }

    #bloque-testimonios-voz-clientes .btvc-text-swiper {
      height: 100%;
      min-height: 200px;
    }

    #bloque-testimonios-voz-clientes .btvc-text-swiper.swiper-fade .swiper-slide {
      height: 100%;
    }

    #bloque-testimonios-voz-clientes .btvc-slide__card {
      margin-top: 0;
        margin-right: 0;
        margin-left: 0;
        width: auto;
        height: auto;
        min-height: 0;
    }

    #bloque-testimonios-voz-clientes .btvc-header__nav {
      width: 100%;
      justify-content: flex-end;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    function initBtvcTestimoniosVozClientes() {
      if (typeof Swiper === 'undefined') {
        setTimeout(initBtvcTestimoniosVozClientes, 50);
        return;
      }

      var root = document.querySelector('#bloque-testimonios-voz-clientes');
      if (!root) return;

      var slider = root.querySelector('.btvc-text-swiper');
      var footerLive = root.querySelector('.btvc-slide__footer--live');
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

      var total = slider.querySelectorAll('.swiper-slide').length;

      function updateBtvcFooter(index) {
        if (!footerLive || !slider) return;
        var slide = slider.querySelectorAll('.swiper-slide')[index];
        if (!slide) return;
        var tpl = slide.querySelector('.btvc-footer-source');
        footerLive.innerHTML = '';
        if (tpl && tpl.content) {
          footerLive.appendChild(tpl.content.cloneNode(true));
        }
      }

      function syncStageHeights() {
        var media = root.querySelector('.btvc-stage__col--media .btvc-slide__media');
        var cardsCol = root.querySelector('.btvc-stage__col--cards');
        if (!media || !cardsCol) return;
        cardsCol.style.minHeight = media.offsetHeight + 'px';
      }

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
      speed: 500,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      watchOverflow: true,
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
      allowTouchMove: true,
      on: {
        init: function () {
          this.update();
        }
      }
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

      sw.on('slideChange', function () {
        updateBtvcFooter(sw.activeIndex);
        syncPagination();
        syncStageHeights();
      });
      updateBtvcFooter(sw.activeIndex);
      syncPagination();
      syncStageHeights();

      window.addEventListener('resize', syncStageHeights);

      setTimeout(function () {
        sw.update();
        syncStageHeights();
      }, 300);
    }

    initBtvcTestimoniosVozClientes();
  });
</script>
