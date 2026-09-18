<?php
/**
 * Block: Introduction – Connect the dots (Home)
 * Type: Reusable ACF Block
 */
if (!defined('ABSPATH'))
  exit;

$bloque = get_page_by_path('bloque-introduccion-conectar-los-puntos-es-lo-que-hacemos', OBJECT, 'bloques_globales');
if (!$bloque)
  return;

$ID = $bloque->ID;

if (get_field('bloque_1_titulo', $ID)): ?>
  <section class="section bloque-home bloque-1 bg-white reveal reveal-up bloque-intro-home">
    <div class="container bloque-intro-home__grid text-dark">
      <div>
        <h2 class="heading-lg mb-0-mob">Connecting the dots is what we do        </h2>
        
      </div>
      <div>
      <p>
      Organizations rarely stall because they lack ideas, knowledge, or action. They stall because turning those strengths into effective execution is hard. The bottleneck is usually the lack of orchestration between vision and action — between what the market demands and what the company can consistently deliver with speed and practical focus. Without that systemic link between strategic thinking and disciplined operations, growth becomes fragile and potential advantages stay dormant.


      </p>
      
     
        <p>Imppulsor exists to solve that challenge: connecting the critical dots of organizational performance, turning fragmented information into consistent decisions, and translating complexity into operational clarity. We are a boutique consulting firm specializing in business management and transformation, partnering with leaders who understand that growth is not about doing more — it is about doing what matters, with focus, method, and strategic intent.</p>

      </div>
    </div>
  </section>

  <style>
    .bloque-intro-home__grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
    }

    @media (max-width: 992px) {
      .bloque-intro-home__grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
<?php endif; ?>
