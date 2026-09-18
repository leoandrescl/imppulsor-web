<?php
/**
 * Block: Featured products (DMC, benefits bar) in a standard container (no extra section--light padding).
 * Swiper slider ready for multiple products; today one DMC slide. Visual column: three focus areas with pointed cut (SVG).
 */
if (!defined('ABSPATH')) {
  exit;
}

/** File URL in wp-content/uploads (block icons). */
$bpd_upload = static function ( string $file ): string {
  return esc_url( content_url( 'uploads/' . ltrim( $file, '/' ) ) );
};

$productos_destacados = [
  [
    'titulo_seccion' => 'Do you know what is really holding back your sales operation?',
    'producto_titulo' => 'Commercial Maturity Diagnostic (DMC)',
    'producto_texto' => 'Rigorously assesses the maturity of your sales function using a 12-dimension framework, with qualitative and quantitative evidence to prioritize improvements with real impact.',
    'lista_titulo' => 'It enables you to:',
    'lista_items' => [
      'See systemically how processes, structure, technology, talent, and leadership come together to generate revenue.',
      'Identify gaps and critical areas for intervention with traceability to the decision.',
      'Benchmark your position against sector and regional peers.',
    ],
    'cta_primario_label' => 'Learn more about the DMC',
    'cta_primario_url' => '/diagnostico-de-madurez-comercial/',
    'cta_secundario_1_label' => 'Contact an expert',
    'cta_secundario_1_url' => '/contacto/',
    'cta_secundario_2_label' => 'Explore our success stories',
    'cta_secundario_2_url' => '/casos-de-exito/',
  ],
];

$barra_beneficios = [
  [
    'texto' => 'World-class methodological rigor.',
    'icon' => 'icono-respaldo.svg',
  ],
  [
    'texto' => 'Fixed-scope project delivered in 6 weeks.',
    'icon' => 'icono-proyecto.svg',
  ],
  [
    'texto' => 'Expert guidance and an independent perspective.',
    'icon' => 'icono-acompanamiento.svg',
  ],
  [
    'texto' => 'Confidentiality protected throughout the process.',
    'icon' => 'icono-confidencialidad.svg',
  ],
];

$bpd_icon_default = 'icono-respaldo.svg';

/** URL of the page with `section-dimensiones-analisis-dmc-v2` (Diagnostics 2 template). */
$bpd_dmc_v2_page_url = home_url( '/diagnostico-de-madurez-comercial-2/' );
if ( function_exists( 'get_pages' ) ) {
  $bpd_v2_pages = get_pages(
    array(
      'meta_key'   => '_wp_page_template',
      'meta_value' => 'page-diagnostico-2.php',
      'number'     => 1,
    )
  );
  if ( ! empty( $bpd_v2_pages[0] ) && $bpd_v2_pages[0] instanceof WP_Post ) {
    $bpd_dmc_v2_page_url = get_permalink( $bpd_v2_pages[0]->ID );
  }
}
$bpd_dmc_v2_page_url = untrailingslashit( (string) $bpd_dmc_v2_page_url );

/** Three DMC focus areas; each row links to the 4 dimensions of the v2 accordion (#dimension-v2-N). */
$bpd_focos_dmc = [
  [
    'titulo'      => 'Leadership and Governance',
    'modificador' => 'bpd-focos__row--navy',
    'icono'       => 'icono-direccion.svg',
    'dimensiones' => array(
      array( 'num' => 1, 'etiqueta' => 'Strategy' ),
      array( 'num' => 2, 'etiqueta' => 'Governance' ),
      array( 'num' => 10, 'etiqueta' => 'Organization' ),
      array( 'num' => 11, 'etiqueta' => 'Leadership' ),
    ),
  ],
  array(
    'titulo'      => 'Commercial Execution',
    'modificador' => 'bpd-focos__row--royal',
    'icono'       => 'icono-ejecucion.svg',
    'dimensiones' => array(
      array( 'num' => 5, 'etiqueta' => 'Marketing' ),
      array( 'num' => 6, 'etiqueta' => 'Methodology' ),
      array( 'num' => 4, 'etiqueta' => 'Experience' ),
      array( 'num' => 9, 'etiqueta' => 'Efficiency' ),
    ),
  ),
  array(
    'titulo'      => 'Enabling Capabilities',
    'modificador' => 'bpd-focos__row--azure',
    'icono'       => 'icono-capacidades.svg',
    'dimensiones' => array(
      array( 'num' => 7, 'etiqueta' => 'Automation & AI' ),
      array( 'num' => 8, 'etiqueta' => 'Data' ),
      array( 'num' => 3, 'etiqueta' => 'Innovation' ),
      array( 'num' => 12, 'etiqueta' => 'Talent' ),
    ),
  ),
];

if (empty($productos_destacados)) {
  return;
}

$bpd_total_slides = count( $productos_destacados );
?>

<style id="bpd-reveal-critical">
  #bloque-productos-destacados.reveal.reveal-bpd:not(.visible) {
    opacity: 0;
    transform: translate3d(0, 48px, 0);
  }
</style>

<section class="bloque-productos-destacados bg-light section reveal reveal-bpd diag-block-margin" id="bloque-productos-destacados" data-reveal-manual="bpd">
  <div class="container bg-light text-dark">
    <div class="bpd-card__header btvc-header">
      <div class="btvc-header__text bpd-card__header__text">
        <span class="badge bg-light-blue px-40 text-bold">Featured products</span>
      </div>
      <div class="btvc-header__nav" aria-label="<?php esc_attr_e( 'Featured products carousel navigation', 'imppulsorv2' ); ?>">
        <div class="swiper-button-prev btvc-nav-btn btvc-nav-btn--prev" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Previous', 'imppulsorv2' ); ?>"></div>
        <div class="swiper-button-next btvc-nav-btn btvc-nav-btn--next" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Next', 'imppulsorv2' ); ?>"></div>
      </div>
    </div>

    <div class="swiper bpd-swiper">
        <div class="swiper-wrapper">
          <?php foreach ($productos_destacados as $pd) : ?>
            <div class="swiper-slide">
              <div class="bpd-main grid-2">
                <div class="bpd-col bpd-col--text text-dark">
                  <h2 class="heading-lg bpd-heading"><?php echo esc_html($pd['titulo_seccion']); ?></h2>

                  <div class="bpd-producto">
                    <div class="bpd-producto__icon" aria-hidden="true">
                      <img src="<?php echo $bpd_upload( 'icono-search.svg' ); ?>" alt="" width="28" height="28" loading="lazy" decoding="async" />
                    </div>
                    <div class="bpd-producto__body">
                      <h3 class="heading-sm bpd-producto__titulo"><?php echo esc_html($pd['producto_titulo']); ?></h3>
                      <p class="bpd-producto__desc"><?php echo esc_html($pd['producto_texto']); ?></p>
                    </div>
                  </div>

                  <h3 class="heading-sm fs-20"><?php echo esc_html($pd['lista_titulo']); ?></h3>
                  <ul class="list-check mb-20">
                    <?php foreach ($pd['lista_items'] as $item) : ?>
                      <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                  </ul>

                  <div class="bpd-actions">
                    <a class="bpd-btn bpd-btn--primary" href="<?php echo esc_url( $pd['cta_primario_url'] ); ?>">
                      <?php echo esc_html( $pd['cta_primario_label'] ); ?>
                      <img class="bpd-btn__arrow-img" src="<?php echo $bpd_upload( 'icono-right-arrow.svg' ); ?>" alt="" width="18" height="18" decoding="async" />
                    </a>
                    <a class="bpd-btn bpd-btn--ghost" href="<?php echo esc_url( $pd['cta_secundario_1_url'] ); ?>">
                      <img class="bpd-btn__ico bpd-btn__ico--img" src="<?php echo $bpd_upload( 'icono-contacte.svg' ); ?>" alt="" width="18" height="18" loading="lazy" decoding="async" />
                      <?php echo esc_html( $pd['cta_secundario_1_label'] ); ?>
                    </a>
                    <a class="bpd-btn bpd-btn--ghost" href="<?php echo esc_url( $pd['cta_secundario_2_url'] ); ?>">
                      <img class="bpd-btn__ico bpd-btn__ico--img" src="<?php echo $bpd_upload( 'icono-conozca-2.svg' ); ?>" alt="" width="18" height="18" loading="lazy" decoding="async" />
                      <?php echo esc_html( $pd['cta_secundario_2_label'] ); ?>
                    </a>
                  </div>
                </div>

                <div class="bpd-col bpd-col--visual">
                  <h3 class="heading-sm bpd-producto__titulo bpd-visual__titulo">12 Dimensions Assessed Across 3 Analysis Focus Areas</h3>

                  <div class="bpd-focos" role="group" aria-label="<?php echo esc_attr( 'Three DMC focus areas: leadership and governance, commercial execution, and enabling capabilities.' ); ?>">
                    <?php foreach ( $bpd_focos_dmc as $foco ) : ?>
                      <div class="bpd-focos__row <?php echo esc_attr( $foco['modificador'] ); ?>">
                        <div class="bpd-focos__wing" aria-hidden="true">
                          <?php
                          $bpd_foco_icon = ! empty( $foco['icono'] ) ? (string) $foco['icono'] : $bpd_icon_default;
                          ?>
                          <img
                            class="bpd-focos__svg"
                            src="<?php echo $bpd_upload( $bpd_foco_icon ); ?>"
                            alt=""
                            width="44"
                            height="44"
                            loading="lazy"
                            decoding="async"
                          />
                        </div>
                        <div class="bpd-focos__text">
                          <p class="bpd-focos__title"><?php echo esc_html( $foco['titulo'] ); ?></p>
                          <?php if ( ! empty( $foco['dimensiones'] ) && is_array( $foco['dimensiones'] ) ) : ?>
                            <?php
                            $bpd_dims = $foco['dimensiones'];
                            $bpd_dim_last = count( $bpd_dims ) - 1;
                            ?>
                            <p class="bpd-focos__dims" role="group" aria-label="<?php echo esc_attr( 'Analysis dimensions: ' . $foco['titulo'] ); ?>">
                              <?php
                              foreach ( $bpd_dims as $bpd_di => $dim ) :
                                $num = isset( $dim['num'] ) ? (int) $dim['num'] : 0;
                                if ( $num < 1 ) {
                                  continue;
                                }
                                $hash      = '#dimension-v2-' . $num;
                                $dim_href  = esc_url( $bpd_dmc_v2_page_url . $hash );
                                $dim_label = isset( $dim['etiqueta'] ) ? (string) $dim['etiqueta'] : ( 'Dimension ' . $num );
                                ?>
                                <a class="bpd-focos__dim-link" href="<?php echo $dim_href; ?>"><?php echo esc_html( $dim_label ); ?></a><?php
                                if ( $bpd_di < $bpd_dim_last ) :
                                  ?><span class="bpd-focos__dims-sep" aria-hidden="true"><?php echo $bpd_di === $bpd_dim_last - 1 ? ' and ' : ', '; ?></span><?php
                                endif;
                              endforeach;
                              ?>
                            </p>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <div class="bpd-callout">
                    <div class="bpd-callout__icon" aria-hidden="true">
                      <img src="<?php echo $bpd_upload( 'icono-compare.png' ); ?>" alt="" width="22" height="22" loading="lazy" decoding="async" />
                    </div>
                    <div>
                      <p class="bpd-callout__title">Benchmark your maturity against sector and regional peers.</p>
                      <p class="bpd-callout__text">The DMC shows how advanced or delayed your sales operation is compared with similar companies.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="bpd-barra" role="list">
        <?php foreach ( $barra_beneficios as $b ) :
          $ico_file = isset( $b['icon'] ) && is_string( $b['icon'] ) ? $b['icon'] : $bpd_icon_default;
          ?>
          <div class="bpd-barra__item" role="listitem">
            <span class="bpd-barra__icon" aria-hidden="true">
              <img src="<?php echo $bpd_upload( $ico_file ); ?>" alt="" width="22" height="22" loading="lazy" decoding="async" />
            </span>
            <span class="bpd-barra__text"><?php echo esc_html( $b['texto'] ); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
  </div>
</section>

<style>
  /* Badge: dimensiones solo en productos destacados (no afecta insights/casos de éxito) */
  #bloque-productos-destacados div.badge.bg-light-blue {
    text-align: center;
    min-width: 189px;
    width: max-content;
    max-width: 279px;
    padding: 4px 20px !important;
    text-transform: uppercase;
  }
  #bloque-productos-destacados .bpd-card__header.btvc-header {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
    padding: 0 0 20px;
    margin-bottom: 0;
  }

  #bloque-productos-destacados .btvc-header__text.bpd-card__header__text {
    flex: 1;
    min-width: 0;
  }

  #bloque-productos-destacados .btvc-header__nav {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
    margin-top: 4px;
  }

  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn {
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

  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn::after {
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
    color: #006eff;
    transform: none !important;
    transform-origin: 50% 50% !important;
    transition: color 0.2s ease;
  }

  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--prev::after {
    transform: rotate(180deg) !important;
  }

  #bloque-productos-destacados .btvc-nav-btn--prev,
  #bloque-productos-destacados .btvc-nav-btn--next {
    background: #fff;
    border: 1px solid #006eff;
    transition: background 0.2s ease, border-color 0.2s ease;
  }

  #bloque-productos-destacados .btvc-nav-btn--prev:hover:not(.swiper-button-disabled),
  #bloque-productos-destacados .btvc-nav-btn--next:hover:not(.swiper-button-disabled),
  #bloque-productos-destacados .btvc-nav-btn--prev:focus-visible:not(.swiper-button-disabled),
  #bloque-productos-destacados .btvc-nav-btn--next:focus-visible:not(.swiper-button-disabled) {
    background: #006eff !important;
    border-color: #006eff !important;
  }

  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--prev:hover:not(.swiper-button-disabled)::after,
  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--next:hover:not(.swiper-button-disabled)::after,
  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--prev:focus-visible:not(.swiper-button-disabled)::after,
  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--next:focus-visible:not(.swiper-button-disabled)::after {
    color: #fff;
  }

  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--prev:hover:not(.swiper-button-disabled)::after,
  #bloque-productos-destacados .btvc-header__nav .btvc-nav-btn--prev:focus-visible:not(.swiper-button-disabled)::after {
    transform: rotate(180deg) !important;
  }

  #bloque-productos-destacados .btvc-nav-btn.swiper-button-disabled {
    opacity: 0.35;
    pointer-events: none;
  }

  .bpd-swiper {
    overflow: hidden;
  }

  .bpd-main {
    gap: 32px;
    padding: 0 0 8px;
    align-items: start;
  }

  .bpd-col.bpd-col--visual {
    background: #d1e5ff30;
    padding: 20px;
  }

  .bloque-productos-destacados .bpd-main.grid-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .bpd-col--text,
  .bpd-col--visual {
    padding-bottom: 24px;
  }

  .bpd-heading {
    margin-bottom: 24px;
  }

  .bpd-producto {
    display: flex;
    gap: 16px;
    margin-bottom: 20px;
  }

  .bpd-producto__icon {
    flex-shrink: 0;
    width: 96px;
    height: 96px;
    border-radius: 50%;
    background: var(--azul-claro, #126cfb);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bpd-producto__icon img {
    display: block;
    width: 60px;
    height: auto;
    object-fit: contain;
}

  .bpd-producto__titulo {
    margin: 0 0 8px;
  }

  .bpd-producto__desc {
    margin: 0;
    color: #444;
    font-size: 16px;
    line-height: 1.5;
  }

  .bpd-lista-titulo {
    font-weight: 600;
    margin: 0 0 10px;
  }

  .bpd-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: stretch;
  }

  @media (min-width: 992px) {
    .bpd-actions {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      align-items: center;
    }

    .bpd-btn {
      justify-content: center;
      text-align: left;
      font-size: 13px;
      padding-inline: 12px;
    }
  }

  .bpd-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 18px;
    font-size: 14px;
    line-height: 1;
    font-weight: 300;
    text-decoration: none;
    border-radius: 0;
    background: #fff !important;
    color: #000 !important;
    border: 1px solid #000 !important;
}




  .bpd-btn:hover,
  .bpd-btn:focus-visible {
    background: var(--azul-claro, #126cfb) !important;
    color: #fff !important;
    border-color: var(--azul-claro, #126cfb) !important;
  }

  #bloque-productos-destacados .bpd-btn:hover img.bpd-btn__ico--img,
  #bloque-productos-destacados .bpd-btn:focus-visible img.bpd-btn__ico--img,
  #bloque-productos-destacados .bpd-btn:hover img.bpd-btn__arrow-img,
  #bloque-productos-destacados .bpd-btn:focus-visible img.bpd-btn__arrow-img {
    filter: brightness(0) invert(1) !important;
  }




  /* --- LÓGICA DE BOTONES DISOCIADA --- */

/* 1. BOTÓN PRIMARIO: Inicia Azul, Hover Blanco */
#bloque-productos-destacados .bpd-btn.bpd-btn--primary {
    background: var(--azul-claro, #126cfb) !important;
    color: #ffffff !important;
    border-color: var(--azul-claro, #126cfb) !important;
}

/* Iconos del botón primario: Blancos por defecto */
#bloque-productos-destacados .bpd-btn--primary img.bpd-btn__arrow-img,
#bloque-productos-destacados .bpd-btn--primary img.bpd-btn__ico--img {
    filter: brightness(0) invert(1) !important;
}

/* Hover del botón primario: Fondo blanco, texto negro, icono negro */
#bloque-productos-destacados .bpd-btn--primary:hover,
#bloque-productos-destacados .bpd-btn--primary:focus-visible {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: #000000 !important;
}

/* Reset del filtro en hover del primario (vuelve a negro) */
#bloque-productos-destacados .bpd-btn--primary:hover img.bpd-btn__arrow-img,
#bloque-productos-destacados .bpd-btn--primary:hover img.bpd-btn__ico--img,
#bloque-productos-destacados .bpd-btn--primary:focus-visible img.bpd-btn__arrow-img,
#bloque-productos-destacados .bpd-btn--primary:focus-visible img.bpd-btn__ico--img {
    filter: none !important;
}


/* 2. BOTONES GHOST: Inician Blancos, Hover Azul (Estilo Original) */
#bloque-productos-destacados .bpd-btn.bpd-btn--ghost {
    background: #ffffff !important;
    color: #000000 !important;
    border: 1px solid #000000 !important;
}

/* Iconos de botones ghost: Negros por defecto */
#bloque-productos-destacados .bpd-btn--ghost img.bpd-btn__ico--img {
    filter: none !important;
}

/* Hover de botones ghost: Fondo azul, texto blanco, icono blanco */
#bloque-productos-destacados .bpd-btn--ghost:hover,
#bloque-productos-destacados .bpd-btn--ghost:focus-visible {
    background: var(--azul-claro, #126cfb) !important;
    color: #ffffff !important;
    border-color: var(--azul-claro, #126cfb) !important;
}

/* Filtro blanco en hover para iconos de botones ghost */
#bloque-productos-destacados .bpd-btn--ghost:hover img.bpd-btn__ico--img,
#bloque-productos-destacados .bpd-btn--ghost:focus-visible img.bpd-btn__ico--img {
    filter: brightness(0) invert(1) !important;
}


  .bpd-btn__arrow-img,
  .bpd-btn__ico--img {
    flex-shrink: 0;
    display: block;
    width: 18px;
    height: 18px;
    object-fit: contain;
  }

  .bpd-col--visual {
    background: transparent;
    border-radius: 0;
    padding: 24px 0;
  }

  .bpd-col--visual .bpd-visual__titulo {
    text-align: center;
    margin: 0 0 16px;
  }


  /* Tres focos DMC: franja icono con punta + texto; filas separadas en blanco */
  .bpd-focos {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    max-width: 100%;
    margin: 0 auto 20px;
    background: #fff;
    box-sizing: border-box;
    overflow: hidden;
  }

  .bpd-focos__row {
    --bpd-tip: 26px;
    --bpd-focos-gap: 10px;
    --bpd-focos-navy: #061a33;
    --bpd-focos-royal: #126cfb;
    --bpd-focos-azure: #3d8ce0;
    display: flex;
    align-items: stretch;
    min-height: 108px;
  }

  .bpd-focos__wing,
  .bpd-focos__text {
    transition: background 0.28s ease;
  }

  @media (prefers-reduced-motion: reduce) {

    .bpd-focos__wing,
    .bpd-focos__text {
      transition-duration: 0.01ms;
    }
  }

  .bpd-focos__wing {
    flex: 0 0 30%;
    max-width: 142px;
    min-width: 84px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    position: relative;
    z-index: 2;
    clip-path: polygon(0 0, calc(100% - var(--bpd-tip)) 0, 100% 50%, calc(100% - var(--bpd-tip)) 100%, 0 100%);
    -webkit-clip-path: polygon(0 0, calc(100% - var(--bpd-tip)) 0, 100% 50%, calc(100% - var(--bpd-tip)) 100%, 0 100%);
  }

  .bpd-focos__svg {
    display: block;
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    left: -10px;
    position: relative;
    object-fit: contain;
  }

  /* Solo columna texto: muesca cuyo vértice coincide con la punta del ala (no modificar .bpd-focos__wing) */
  .bpd-focos__text {
    flex: 1;
    min-width: 0;
    margin-left: calc(-1 * var(--bpd-tip) + var(--bpd-focos-gap));
    padding: 18px 18px 18px calc(var(--bpd-tip) + 14px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    z-index: 1;
    clip-path: polygon(0 0, var(--bpd-tip) 50%, 0 100%, 100% 100%, 100% 0);
    -webkit-clip-path: polygon(0 0, var(--bpd-tip) 50%, 0 100%, 100% 100%, 100% 0);
  }

  #bloque-productos-destacados .bpd-focos__text .bpd-focos__title,
  #bloque-productos-destacados .bpd-focos__text .bpd-focos__dim-link {
    color: #fff !important;
    text-decoration: none;
  }

  #bloque-productos-destacados .bpd-focos__text .bpd-focos__dims-sep {
    color: rgba(255, 255, 255, 0.92) !important;
  }

  /* Fila 1: azul marino (toda la fila) */
  .bpd-focos__row--navy .bpd-focos__wing,
  .bpd-focos__row--navy .bpd-focos__text {
    background: var(--bpd-focos-navy);
  }

  .bpd-focos__row--navy:hover .bpd-focos__text,
  .bpd-focos__row--navy:focus-within .bpd-focos__text {
    background: color-mix(in srgb, var(--bpd-focos-navy) 90%, white);
  }

  /* Fila 2: azul intenso (marca) */
  .bpd-focos__row--royal .bpd-focos__wing,
  .bpd-focos__row--royal .bpd-focos__text {
    background: var(--bpd-focos-royal);
  }

  .bpd-focos__row--royal:hover .bpd-focos__text,
  .bpd-focos__row--royal:focus-within .bpd-focos__text {
    background: color-mix(in srgb, var(--bpd-focos-royal) 90%, white);
  }

  /* Fila 3: azul medio */
  .bpd-focos__row--azure .bpd-focos__wing,
  .bpd-focos__row--azure .bpd-focos__text {
    background: var(--bpd-focos-azure);
  }

  .bpd-focos__row--azure:hover .bpd-focos__text,
  .bpd-focos__row--azure:focus-within .bpd-focos__text {
    background: color-mix(in srgb, var(--bpd-focos-azure) 90%, white);
  }

  .bpd-focos__dims {
    margin: 0;
    padding: 0;
    font-size: clamp(14px, 1.5vw, 16px);
    font-weight: 300;
    line-height: 1.45;
  }

  .bpd-focos__dims-sep {
    font-weight: 400;
  }
  .bpd-focos__dim-link {
    font-size: clamp(14px, 1.5vw, 16px);
    font-weight: 300;
    line-height: 1.35;
    text-decoration: underline;
    text-decoration-color: rgba(255, 255, 255, 0.45);
    text-underline-offset: 3px;
    color: inherit;
  }

  .bpd-focos__dim-link:hover,
  .bpd-focos__dim-link:focus-visible {
    text-decoration-color: #fff;
  }

  .bpd-focos__dim-link:focus-visible {
    outline: none;
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.85);
    border-radius: 2px;
  }

  .bpd-focos__title {
    margin: 0 0 10px;
    font-size: clamp(18px, 2.5vw, 24px);
    font-weight: 600;
    line-height: 1.2;
  }

  @media (max-width: 576px) {
    .bpd-focos__row {
      --bpd-tip: 18px;
      --bpd-focos-gap: 10px;
      min-height: 96px;
    }

    .bpd-focos__wing {
      max-width: 100px;
      min-width: 72px;
    }

    .bpd-focos__svg {
      width: 36px;
      height: 36px;
    }

    .bpd-focos__text {
      padding: 14px 12px 14px calc(var(--bpd-tip) + 10px);
    }
  }

  .bpd-callout {
    display: flex;
    gap: 14px;
    align-items: flex-start;
    background: #e8f1ff;
    border-radius: 0;
    padding: 16px;
  }

  .bpd-callout__icon {
    flex-shrink: 0;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--azul-claro, #126cfb);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .bpd-callout__icon img {
    display: block;
    width: 100%;
    height: auto;
    object-fit: contain;
}

  .bpd-callout__title {
    margin: 0 0 6px;
    font-weight: 500;
    font-size: 16px;
    color: #000;
    line-height: 1.3;
}

  .bpd-callout__text {
    margin: 0;
    font-size: 14px;
    color: #444;
    line-height: 1.45;
  }

  .bpd-barra {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
    margin: 28px 0 0;
    background: #e8f1ff;
    border: none;
    padding: 8px 24px 12px;
    box-sizing: border-box;
  }

  .bpd-barra__item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px;
    border: none;
    border-right: 3px solid #006eff;
  }

  .bpd-barra__item:last-child {
    border-right: none;
  }

  .bpd-barra__icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 0;
    background: transparent;
    color: var(--azul-claro, #126cfb);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .bpd-barra__icon img {
    display: block;
    width: 36px;
    height: auto;
    max-width: 100%;
    object-fit: contain;
}

  .bpd-barra__text {
    font-size: 14px;
    font-weight: 300;
    color: #030F23;
    line-height: 1.3;
}

  @media (max-width: 992px) {
    .bloque-productos-destacados .bpd-main.grid-2 {
      grid-template-columns: 1fr;
    }

    .bpd-barra {
      grid-template-columns: 1fr 1fr;
    }

    .bpd-barra__item {
      border-right: none;
      border-bottom: 3px solid #006eff;
    }

    .bpd-barra__item:nth-child(odd) {
      border-right: 3px solid #006eff;
    }

    .bpd-barra__item:nth-last-child(-n + 2) {
      border-bottom: none;
    }
  }

  @media (max-width: 576px) {
    .bpd-barra {
      grid-template-columns: 1fr;
    }

    .bpd-barra__item {
      border-right: none;
      border-bottom: 3px solid #006eff;
    }

    .bpd-barra__item:last-child {
      border-bottom: none;
    }

    .bpd-actions {
      flex-direction: column;
      align-items: stretch;
    }

    .bpd-btn {
      justify-content: center;
    }
  }
</style>

<script>
  (function () {
    function initBpdReveal() {
      var root = document.getElementById('bloque-productos-destacados');
      if (!root || !root.classList.contains('reveal-bpd') || root.dataset.bpdRevealInit) return;
      root.dataset.bpdRevealInit = '1';

      function playReveal() {
        if (root.classList.contains('visible')) return;
        root.classList.remove('visible');
        void root.offsetHeight;
        window.setTimeout(function () {
          root.classList.add('visible');
        }, 100);
      }

      function isInView() {
        var rect = root.getBoundingClientRect();
        var vh = window.innerHeight || document.documentElement.clientHeight;
        return rect.top < vh * 0.9 && rect.bottom > vh * 0.1;
      }

      window.setTimeout(function () {
        if ('IntersectionObserver' in window) {
          var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
              if (entry.isIntersecting) {
                playReveal();
                observer.disconnect();
              }
            });
          }, { threshold: 0.08 });

          observer.observe(root);

          window.setTimeout(function () {
            if (isInView() && !root.classList.contains('visible')) {
              playReveal();
              observer.disconnect();
            }
          }, 120);
        } else if (isInView()) {
          playReveal();
        }
      }, 50);
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initBpdReveal);
    } else {
      initBpdReveal();
    }
  })();

  document.addEventListener('DOMContentLoaded', function () {
    function initBpdSwiper() {
      if (typeof Swiper === 'undefined') {
        setTimeout(initBpdSwiper, 50);
        return;
      }

      var root = document.getElementById('bloque-productos-destacados');
      if (!root) return;

      var slider = root.querySelector('.bpd-swiper');
      var nextBtn = root.querySelector('.swiper-button-next');
      var prevBtn = root.querySelector('.swiper-button-prev');
      if (!slider || !nextBtn || !prevBtn) return;

      if (root.dataset.bpdSwiperInit) return;
      root.dataset.bpdSwiperInit = '1';

      if (slider.swiper) {
        slider.swiper.destroy(true, true);
      }

      new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: false,
        speed: 600,
        navigation: {
          nextEl: nextBtn,
          prevEl: prevBtn,
        },
        observer: true,
        observeParents: true,
        allowTouchMove: true,
      });
    }

    initBpdSwiper();
  });
</script>
