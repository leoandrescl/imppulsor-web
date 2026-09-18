<?php
/**
 * Dimensiones de análisis DMC v2: doce acordeones agrupados en tres focos.
 * Mismo contenido textual por dimensión que la versión original en página.
 *
 * @package imppulsor
 */

defined('ABSPATH') || exit;

$dmc_dimensiones_por_foco = [
  [
    'foco' => 'Dirección y Gobierno',
    'dimensiones' => [
      [
        'num' => 1,
        'titulo' => 'Dimensión 1',
        'subtitulo' => 'Estrategia y Planificación',
        'contenido' => 'Analizar si la organización cuenta con una estrategia comercial clara, compartida y activa, que oriente la toma de decisiones, estructure las prioridades operativas y habilite una ejecución coherente, rentable y sostenible en los mercados objetivo.',
        'subdimensiones' => [
          'Dirección Estratégica',
          'Planificación Comercial',
          'Enfoque a Resultados',
        ],
      ],
      [
        'num' => 2,
        'titulo' => 'Dimensión 2',
        'subtitulo' => 'Gobernanza Empresarial',
        'contenido' => 'Evaluar si la estructura de gobierno y liderazgo promueve la toma de decisiones ágil, transparente y alineada con los objetivos estratégicos.',
        'subdimensiones' => [
          'Roles y Estructura',
          'Mecanismos de Gestión',
          'Accountability y Control',
        ],
      ],
      [
        'num' => 11,
        'titulo' => 'Dimensión 11',
        'subtitulo' => 'Liderazgo',
        'contenido' => 'Evaluar la calidad del liderazgo, el empoderamiento del equipo y la capacidad de inspirar resultados sostenibles.',
        'subdimensiones' => [
          'Cultura, Clientes y Resultados',
          'Liderazgo y Coaching',
          'Propósito y Pertenencia',
        ],
      ],
      [
        'num' => 10,
        'titulo' => 'Dimensión 10',
        'subtitulo' => 'Organización',
        'contenido' => 'Analizar la estructura organizacional y su grado de alineación con los objetivos y estrategias comerciales.',
        'subdimensiones' => [
          'Diseño Estructural',
          'Coordinación y Colaboración',
          'Escalabilidad',
        ],
      ],
    ],
  ],
  [
    'foco' => 'Ejecución Comercial',
    'dimensiones' => [
      [
        'num' => 5,
        'titulo' => 'Dimensión 5',
        'subtitulo' => 'Marketing y Generación de Demanda',
        'contenido' => 'Revisar la efectividad de las acciones de marketing y generación de demanda como motor del crecimiento comercial.',
        'subdimensiones' => [
          'Posicionamiento y Mensaje',
          'Canales y Tácticas',
          'Gestión de Leads',
        ],
      ],
      [
        'num' => 6,
        'titulo' => 'Dimensión 6',
        'subtitulo' => 'Metodología Comercial',
        'contenido' => 'Evaluar la madurez de los procesos comerciales y la estandarización de prácticas que aseguren eficiencia y consistencia.',
        'subdimensiones' => [
          'Proceso de Ventas',
          'Técnicas y Enfoque',
          'Estandarización',
        ],
      ],
      [
        'num' => 4,
        'titulo' => 'Dimensión 4',
        'subtitulo' => 'Experiencia de Cliente',
        'contenido' => 'Analizar si la empresa gestiona la experiencia de cliente de forma integral, coherente y centrada en el valor.',
        'subdimensiones' => [
          'Comprensión del Cliente',
          'Procesos de Atención',
          'Voz del Cliente',
        ],
      ],
      [
        'num' => 9,
        'titulo' => 'Dimensión 9',
        'subtitulo' => 'Eficiencia Operativa',
        'contenido' => 'Evaluar el uso eficiente de recursos, la gestión del tiempo y la productividad del equipo comercial.',
        'subdimensiones' => [
          'Flujos y Procesos',
          'Productividad Comercial',
          'Soporte Interno',
        ],
      ],
    ],
  ],
  [
    'foco' => 'Capacidades Habilitantes',
    'dimensiones' => [
      [
        'num' => 7,
        'titulo' => 'Dimensión 7',
        'subtitulo' => 'Digitalización, Automatización e IA',
        'contenido' => 'Analizar el nivel de integración tecnológica y el uso de herramientas de IA en la gestión comercial y de clientes.',
        'subdimensiones' => [
          'Tecnología Comercial',
          'Automatización',
          'Uso de IA Agéntica',
        ],
      ],
      [
        'num' => 8,
        'titulo' => 'Dimensión 8',
        'subtitulo' => 'Monitoreo y Análisis de Datos',
        'contenido' => 'Determinar la capacidad de la organización para medir, analizar y tomar decisiones basadas en información confiable y oportuna.',
        'subdimensiones' => [
          'Métricas Comerciales',
          'Análisis e Insights',
          'Toma de decisiones',
        ],
      ],
      [
        'num' => 3,
        'titulo' => 'Dimensión 3',
        'subtitulo' => 'Innovación y Adaptabilidad',
        'contenido' => 'Determinar la capacidad de la organización para incorporar innovación continua, adaptarse a entornos cambiantes y sostener ventajas competitivas.',
        'subdimensiones' => [
          'Adaptabilidad del Área',
          'Experimentación',
          'Aprendizaje Contínuo',
        ],
      ],
      [
        'num' => 12,
        'titulo' => 'Dimensión 12',
        'subtitulo' => 'Gestión del Talento',
        'contenido' => 'Analizar la capacidad de la organización para atraer, desarrollar y retener talento comercial de alto rendimiento.',
        'subdimensiones' => [
          'Atracción y Reclutamiento',
          'Desarrollo y Capacitación',
          'Evaluación y Retención',
        ],
      ],
    ],
  ],
];

foreach ($dmc_dimensiones_por_foco as $bloque_foco) :
  $dims = $bloque_foco['dimensiones'];
  $mitad = (int) ceil(count($dims) / 2);
  $columnas = [array_slice($dims, 0, $mitad), array_slice($dims, $mitad)];
  ?>
  <div class="dmc-analisis-foco">
    <h3 class="dmc-analisis-foco__titulo heading-sm">
      <?php echo esc_html($bloque_foco['foco']); ?>
    </h3>
    <div class="dimensiones-grid dimensiones-grid--dmc-v2">
      <?php foreach ($columnas as $col_dims) : ?>
        <div class="dimensiones-col">
          <?php foreach ($col_dims as $dim) : ?>
            <?php $dim_id = 'dimension-v2-' . (int) $dim['num']; ?>
            <div class="accordion-item" id="<?php echo esc_attr($dim_id); ?>">
              <div class="accordion-header">
                <div class="accordion-title">
                  <span class="dimension-num"><?php echo esc_html($dim['titulo']); ?></span>
                  <h4 class="dimension-subtitulo fs-18 mb-0"><?php echo esc_html($dim['subtitulo']); ?></h4>
                </div>
                <div class="accordion-icon"></div>
              </div>
              <div class="accordion-content">
                <div class="accordion-content-inner">
                  <p class="dmc-dimension-descripcion"><?php echo esc_html($dim['contenido']); ?></p>
                  <?php if (!empty($dim['subdimensiones'])) : ?>
                    <ul class="diagnostico-list diagnostico-list--no-separators dmc-subdimensiones-list">
                      <?php
                      foreach ($dim['subdimensiones'] as $sub_idx => $subdimension) :
                        $sub_num = ((int) $dim['num'] - 1) * 3 + $sub_idx + 1;
                        ?>
                        <li>
                          <span class="num"><?php echo (int) $sub_num; ?></span>
                          <p><?php echo esc_html($subdimension); ?></p>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endforeach; ?>
