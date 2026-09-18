<?php
/**
 * Template Name: Página de Gráficos DMC Pro
 */

get_header(); ?>

<div class="bg-light text-dark">

    <style>
        /* Global Chart Header Styles */
        .block-header {
            width: 100%;
            text-align: center;
            /* Center all titles */
            margin-bottom: 30px;
        }

        .block-header h2 {
            font-family: 'Jost', sans-serif;
            font-size: 32px;
            font-weight: 500;
            color: #051631;
            margin: 0 0 10px 0;
            line-height: 1.2;
        }

        .block-header h3 {
            font-family: 'Jost', sans-serif;
            font-size: 24px;
            font-weight: 400;
            color: #051631;
            margin: 0 0 10px 0;
        }

        .block-header h4 {
            font-family: 'Jost', sans-serif;
            font-size: 18px;
            font-weight: 400;
            color: #555;
            margin: 0;
        }

        @media (max-width: 768px) {
            .block-header h2 {
                font-size: 26px;
            }

            .block-header h3 {
                font-size: 20px;
            }

            .block-header h4 {
                font-size: 16px;
            }
        }
    </style>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-dmc');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-nube-palabras');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-silueta');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-niveles');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-barras-dmc');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-barras-estrategia-y-planificacion');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-heatmap');
    ?>

    <?php
    get_template_part('template-parts/blocks/bloque-grafico-heatmap-v2');
    ?>


</div>

<?php get_footer(); ?>