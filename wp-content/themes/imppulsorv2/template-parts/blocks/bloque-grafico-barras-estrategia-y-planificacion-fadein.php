<div class="ep-wrapper">
    <div class="ep-container">


        <div class="ep-chart-area">
            <div class="canvas-holder">
                <canvas id="epChart"></canvas>
            </div>

            <div class="ep-legend">
                <!-- 1. IDMC -->
                <div class="legend-item">
                    <span class="legend-box box-idmc"></span>
                    <span class="legend-text">IDMC</span>
                </div>
                <!-- 2. Strategic Direction -->
                <div class="legend-item">
                    <span class="legend-box box-dir"></span>
                    <span class="legend-text">Strategic Dir.</span>
                </div>
                <!-- 3. Sales Planning -->
                <div class="legend-item">
                    <span class="legend-box box-plan"></span>
                    <span class="legend-text">Sales Planning</span>
                </div>
                <!-- 4. Results Focus -->
                <div class="legend-item">
                    <span class="legend-box box-enfoque"></span>
                    <span class="legend-text">Results Focus</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .ep-wrapper {
        background: #fff;
        font-family: 'Jost', sans-serif;
        display: flex;
        justify-content: center;
    }

    .ep-wrapper .block-header {
        text-align: left;
        width: 100%;
        max-width: 800px;
        /* Match chart width */
    }

    .ep-container {
        width: 100%;
        max-width: 100%;
        position: relative;
    }

    /* Titles Typography */
    .ep-title-main {
        font-size: 42px;
        /* Large H2 */
        font-weight: 500;
        /* Dark Blue */
        margin-bottom: 5px;
        line-height: 1.1;
    }

    .ep-title-sub {
        font-size: 28px;
        /* H3 */
        font-weight: 300;
        margin-bottom: 5px;
        padding-bottom: 2px;
    }

    .ep-title-diag {
        font-size: 18px;
        /* H4 */
        font-weight: 300;
        color: #000;
        margin-bottom: 40px;
        margin-top: 10px;
        display: inline-block;
        padding-bottom: 2px;
    }

    /* Layout: Chart Top, Legend Bottom */
    .ep-chart-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 30px;
    }

    .canvas-holder {
        width: 100%;
        max-width: 800px;
        height: 500px;
        position: relative;
    }

    /* Legend Styles */
    .ep-legend {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        /* Wrap on small screens */
        gap: 10px;
        /* Reduced from 20px */
        padding-top: 20px;
        justify-content: center;
        width: 100%;
    }

    .legend-item {
        display: flex !important;
        align-items: center;
        gap: 6px;
        /* Reduced from 10px */
        font-size: 16px;
        font-weight: 300;
        margin: 0 5px;
        /* Reduced from 15px */

        /* Animation Init */
        opacity: 0;
        opacity: 0;
    }

    .legend-item.visible {
        animation: fadeIn 0.8s ease-out forwards;
    }

    /* Synced Delays with Chart Bars (800ms steps) */
    .legend-item:nth-child(1) {}

    /* Starts at 0, legend slightly later */
    .legend-item:nth-child(2) {}

    /* Starts at 800ms */
    .legend-item:nth-child(3) {}

    /* Starts at 1600ms */
    .legend-item:nth-child(4) {}

    /* Starts at 2400ms */

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    .legend-box {
        width: 18px;
        height: 18px;
        display: block;
        border-radius: 4px;
        margin-right: 0;
        /* Handled by gap: 6px */
    }

    /* Colors */
    .box-idmc {
        background: #061C2C;
    }

    .box-dir {
        background: #9CDEFA;
    }

    .box-plan {
        background: #54C4F5;
    }

    .box-enfoque {
        background: #1CABF1;
    }

    @media (max-width: 768px) {
        .canvas-holder {
            height: 400px;
        }

        .ep-title-main {
            font-size: 32px;
        }

        .ep-title-sub {
            font-size: 22px;
        }
    }
</style>

<script>
    (function () {
        // Animation Trigger
        const container = document.querySelector('.ep-container');
        let chartInstance = null;

        const initChart = () => {
            const ctx = document.getElementById('epChart').getContext('2d');

            // Custom Plugin to draw values inside bars
            const drawValues = {
                id: 'drawValues',
                afterDatasetsDraw(chart) {
                    const { ctx } = chart;
                    chart.data.datasets.forEach((dataset, i) => {
                        const meta = chart.getDatasetMeta(i);
                        if (!meta.hidden) {
                            meta.data.forEach((element, index) => {
                                // Draw animated value based on current bar height
                                const yScale = chart.scales.y;
                                let currentValue = yScale.getValueForPixel(element.y);

                                // Clamp value
                                if (currentValue < 0) currentValue = 0;

                                let text = currentValue.toFixed(1);

                                // FORCE White 16px Medium
                                ctx.fillStyle = '#fff';
                                ctx.font = '500 16px Jost';
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';

                                ctx.fillText(text, element.x, element.y + 20);
                            });
                        }
                    });
                }
            };

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [''], // Single category grouping
                    datasets: [
                        {
                            label: 'IDMC', // 3.1
                            data: [3.1],
                            backgroundColor: '#061C2C',
                            barPercentage: 0.75,
                            categoryPercentage: 0.8,
                            borderRadius: 0,
                            borderSkipped: false,
                            borderSkipped: false,
                            borderSkipped: false,
                            hoverBackgroundColor: '#22445D' // High Contrast Dark Blue
                        },
                        {
                            label: 'Strategic Dir.', // 3.6
                            data: [3.6],
                            backgroundColor: '#9CDEFA',
                            barPercentage: 0.75,
                            categoryPercentage: 0.8,
                            borderRadius: 0,
                            borderSkipped: false,
                            borderSkipped: false,
                            borderSkipped: false,
                            hoverBackgroundColor: '#CDF0FF' // High Contrast Pale Blue
                        },
                        {
                            label: 'Sales Planning', // 3.4
                            data: [3.4],
                            backgroundColor: '#54C4F5',
                            barPercentage: 0.75,
                            categoryPercentage: 0.8,
                            borderRadius: 0,
                            borderRadius: 0,
                            borderSkipped: false,
                            borderSkipped: false,
                            hoverBackgroundColor: '#A6E1FB' // High Contrast Sky Blue
                        },
                        {
                            label: 'Results Focus', // 2.3
                            data: [2.3],
                            backgroundColor: '#1CABF1',
                            barPercentage: 0.75,
                            categoryPercentage: 0.8,
                            borderRadius: 0,
                            borderSkipped: false,
                            borderSkipped: false,
                            borderSkipped: false,
                            hoverBackgroundColor: '#79D2FA' // High Contrast Cyan
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: { padding: { top: 30 } },
                    scales: {
                        y: {
                            min: 1.0,
                            max: 5.0,
                            ticks: {
                                font: { size: 16, family: 'Jost', weight: 300 },
                                color: '#666',
                                stepSize: 1.0,
                                callback: function (value) { return value.toFixed(1); }
                            },
                            grid: {
                                color: '#e0e0e0',
                                borderDash: [],
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false }, // Using custom HTML legend
                        tooltip: { enabled: false }
                    },
                    animation: {
                        duration: 2500, // Slightly longer for 4 bars
                        easing: 'easeOutQuart',
                        delay: (context) => {
                            return 0;
                        }
                    }
                },
                plugins: [drawValues]
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (!chartInstance) {
                        initChart();
                        // Animate Legend Items
                        const legends = entry.target.querySelectorAll('.legend-item');
                        legends.forEach(item => item.classList.add('visible'));
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        if (container) {
            observer.observe(container);
        }
    })();
</script>