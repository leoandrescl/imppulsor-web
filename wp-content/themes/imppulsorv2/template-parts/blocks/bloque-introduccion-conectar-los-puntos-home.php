<?php
/**
 * Bloque: Introducción – Conectar los puntos (Home)
 * Tipo: Bloque Reutilizable ACF
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
        <h2 class="heading-lg mb-0-mob">Conectar los puntos es lo que hacemos        </h2>
        
      </div>
      <div>
      <p>
      Las organizaciones no se estancan necesariamente por escasez de ideas, conocimientos o falta de acción, sino por la dificultad de traducir esas fortalezas en ejecución efectiva. El estancamiento suele estar en la falta de orquestación entre visión y acción, entre lo que el entorno exige y lo que la empresa es capaz de desplegar con consistencia, velocidad y sentido práctico. Sin esa conexión sistémica entre pensamiento estratégico y operación disciplinada, el crecimiento se vuelve frágil y las ventajas potenciales permanecen latentes.


      </p>
      
     
        <p>Imppulsor surge para enfrentar ese desafío: conectar los puntos críticos del desempeño organizacional, traducir información fragmentada en decisiones consistentes y transformar la complejidad en claridad operativa. Somos una consultora boutique especializada en gestión y transformación empresarial y acompañamos a quienes entienden que crecer no es solo hacer más, sino hacer lo correcto, con foco, método y sentido estratégico.</p>

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
