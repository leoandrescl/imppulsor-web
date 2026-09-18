<?php
/**
 * DMC analysis dimensions v2: twelve accordions grouped into three focus areas.
 * Same textual content per dimension as the original version on the page.
 *
 * @package imppulsor
 */

defined('ABSPATH') || exit;

$dmc_dimensiones_por_foco = [
  [
    'foco' => 'Leadership and Governance',
    'dimensiones' => [
      [
        'num' => 1,
        'titulo' => 'Dimension 1',
        'subtitulo' => 'Strategy and Planning',
        'contenido' => 'Assess whether the organization has a clear, shared, and active commercial strategy that guides decision-making, structures operational priorities, and enables coherent, profitable, and sustainable execution in its target markets.',
        'subdimensiones' => [
          'Strategic Direction',
          'Sales Planning',
          'Results Orientation',
        ],
      ],
      [
        'num' => 2,
        'titulo' => 'Dimension 2',
        'subtitulo' => 'Corporate Governance',
        'contenido' => 'Evaluate whether the governance and leadership structure promotes agile, transparent decision-making aligned with strategic objectives.',
        'subdimensiones' => [
          'Roles and Structure',
          'Management Mechanisms',
          'Accountability and Control',
        ],
      ],
      [
        'num' => 11,
        'titulo' => 'Dimension 11',
        'subtitulo' => 'Leadership',
        'contenido' => 'Evaluate leadership quality, team empowerment, and the ability to inspire sustainable results.',
        'subdimensiones' => [
          'Culture, Customers and Results',
          'Leadership and Coaching',
          'Purpose and Belonging',
        ],
      ],
      [
        'num' => 10,
        'titulo' => 'Dimension 10',
        'subtitulo' => 'Organization',
        'contenido' => 'Analyze the organizational structure and how well aligned it is with commercial objectives and strategies.',
        'subdimensiones' => [
          'Structural Design',
          'Coordination and Collaboration',
          'Scalability',
        ],
      ],
    ],
  ],
  [
    'foco' => 'Commercial Execution',
    'dimensiones' => [
      [
        'num' => 5,
        'titulo' => 'Dimension 5',
        'subtitulo' => 'Marketing and Demand Generation',
        'contenido' => 'Review how effective marketing and demand generation efforts are as drivers of commercial growth.',
        'subdimensiones' => [
          'Positioning and Messaging',
          'Channels and Tactics',
          'Lead Management',
        ],
      ],
      [
        'num' => 6,
        'titulo' => 'Dimension 6',
        'subtitulo' => 'Sales Methodology',
        'contenido' => 'Evaluate the maturity of sales processes and how standardized practices are to ensure efficiency and consistency.',
        'subdimensiones' => [
          'Sales Process',
          'Techniques and Approach',
          'Standardization',
        ],
      ],
      [
        'num' => 4,
        'titulo' => 'Dimension 4',
        'subtitulo' => 'Customer Experience',
        'contenido' => 'Analyze whether the company manages the customer experience in an integrated, coherent, and value-centered way.',
        'subdimensiones' => [
          'Customer Understanding',
          'Service Processes',
          'Voice of the Customer',
        ],
      ],
      [
        'num' => 9,
        'titulo' => 'Dimension 9',
        'subtitulo' => 'Operational Efficiency',
        'contenido' => 'Evaluate how efficiently resources are used, how time is managed, and how productive the sales team is.',
        'subdimensiones' => [
          'Workflows and Processes',
          'Sales Productivity',
          'Internal Support',
        ],
      ],
    ],
  ],
  [
    'foco' => 'Enabling Capabilities',
    'dimensiones' => [
      [
        'num' => 7,
        'titulo' => 'Dimension 7',
        'subtitulo' => 'Digitalization, Automation and AI',
        'contenido' => 'Analyze the level of technology integration and the use of AI tools in sales and customer management.',
        'subdimensiones' => [
          'Sales Technology',
          'Automation',
          'Agentic AI Adoption',
        ],
      ],
      [
        'num' => 8,
        'titulo' => 'Dimension 8',
        'subtitulo' => 'Monitoring and Data Analysis',
        'contenido' => 'Determine the ability of the organization to measure, analyze, and make decisions based on reliable, timely information.',
        'subdimensiones' => [
          'Sales Metrics',
          'Analysis and Insights',
          'Decision-Making',
        ],
      ],
      [
        'num' => 3,
        'titulo' => 'Dimension 3',
        'subtitulo' => 'Innovation and Adaptability',
        'contenido' => 'Determine the ability of the organization to embed continuous innovation, adapt to changing environments, and sustain competitive advantages.',
        'subdimensiones' => [
          'Department Adaptability',
          'Experimentation',
          'Continuous Learning',
        ],
      ],
      [
        'num' => 12,
        'titulo' => 'Dimension 12',
        'subtitulo' => 'Talent Management',
        'contenido' => 'Analyze the ability of the organization to attract, develop, and retain high-performing sales talent.',
        'subdimensiones' => [
          'Attraction and Recruitment',
          'Development and Training',
          'Evaluation and Retention',
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
