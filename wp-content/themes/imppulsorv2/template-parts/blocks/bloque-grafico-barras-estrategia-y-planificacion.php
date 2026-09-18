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
                <!-- 2. Dirección Estratégica -->
                <div class="legend-item">
                    <span class="legend-box box-dir"></span>
                    <span class="legend-text">D. Estratégica</span>
                </div>
                <!-- 3. Planificación Comercial -->
                <div class="legend-item">
                    <span class="legend-box box-plan"></span>
                    <span class="legend-text">P. Comercial</span>
                </div>
                <!-- 4. Enfoque a Resultados -->
                <div class="legend-item">
                    <span class="legend-box box-enfoque"></span>
                    <span class="legend-text">E. Resultados</span>
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
        flex-wrap: nowrap;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding-top: 20px;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .legend-item {
        display: flex !important;
        align-items: center;
        gap: 6px;
        flex: 0 0 auto;
        white-space: nowrap;
        font-size: 15px;
        font-weight: 300;
        margin: 0;

        /* Animation Init */
        opacity: 0;
        transform: translateY(20px);
    }

    .legend-item.visible {
        animation: fadeInUpLegend 0.8s ease-out forwards;
    }

    /* Synced Delays with Chart Bars (800ms steps) */
    .legend-item:nth-child(1) {
        animation-delay: 0.2s;
    }

    /* Starts at 0, legend slightly later */
    .legend-item:nth-child(2) {
        animation-delay: 1.0s;
    }

    /* Starts at 800ms */
    .legend-item:nth-child(3) {
        animation-delay: 1.8s;
    }

    /* Starts at 1600ms */
    .legend-item:nth-child(4) {
        animation-delay: 2.6s;
    }

    /* Starts at 2400ms */

    @keyframes fadeInUpLegend {
        to {
            opacity: 1;
            transform: translateY(0);
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

        /* Force 2x2 Grid for Legend on Mobile */
        .ep-legend {
            display: grid;
            grid-template-columns: repeat(2, auto);
            justify-content: center;
            gap: 15px 60px;
            /* Row Gap 15px, Col Gap 30px to match DMC spacing */
        }

        .legend-item {
            margin: 0 !important;
            justify-content: flex-start;
        }
    }
</style>

<script>
    (function () {
        // Animation Trigger
        const container = document.querySelector('.ep-container');
        let chartInstance = null;
        let cutLineProgress = 0;
        let cutLineTimeoutId = null;
        const cutLineDuration = 900;

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

            // Misma línea segmentada que IGMC DMC; altura alineada a IDMC 3.1
            const drawCutLine = {
                id: 'drawCutLine',
                afterDatasetsDraw(chart) {
                    if (cutLineProgress <= 0) return;

                    const { left, right } = chart.chartArea;
                    const y = chart.scales.y.getPixelForValue(3.1);
                    const startX = left - 8;
                    const currentEndX = startX + (((right - startX) * cutLineProgress));

                    const { ctx } = chart;
                    ctx.save();
                    ctx.lineWidth = 2;
                    ctx.strokeStyle = '#e0e0e0';
                    ctx.lineCap = 'butt';

                    const totalWidth = right - startX;
                    const visibleWidth = currentEndX - startX;
                    const dashLength = 8;
                    const minGap = 6;

                    let dashCount = Math.max(2, Math.floor((totalWidth + minGap) / (dashLength + minGap)));
                    while (dashCount > 2 && (dashCount * dashLength) > totalWidth) {
                        dashCount -= 1;
                    }
                    const gap = (totalWidth - (dashCount * dashLength)) / (dashCount - 1);

                    const visibleEndX = startX + visibleWidth;
                    for (let i = 0; i < dashCount; i++) {
                        const dashStart = startX + (i * (dashLength + gap));
                        if (dashStart >= visibleEndX) break;

                        const dashEnd = Math.min(dashStart + dashLength, visibleEndX);
                        ctx.beginPath();
                        ctx.moveTo(dashStart, y);
                        ctx.lineTo(dashEnd, y);
                        ctx.stroke();
                    }
                    ctx.restore();
                }
            };

            const animateCutLine = () => {
                if (!chartInstance) return;
                const start = performance.now();

                const step = (now) => {
                    const elapsed = now - start;
                    cutLineProgress = Math.max(0, Math.min(1, elapsed / cutLineDuration));
                    chartInstance.draw();

                    if (cutLineProgress < 1) {
                        requestAnimationFrame(step);
                    }
                };

                requestAnimationFrame(step);
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
                            label: 'D. Estratégica', // 3.6
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
                            label: 'P. Comercial', // 3.4
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
                            label: 'E. Resultados', // 2.3
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
                                font: { size: 15, family: 'Jost', weight: 300 },
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
                            // Sequential delay for 4 datasets
                            if (context.type === 'data' && context.mode === 'default') {
                                return context.datasetIndex * 800; // 0.8s gap
                            }
                            return 0;
                        },
                        onComplete: () => { }
                    }
                },
                plugins: [drawValues, drawCutLine]
            });

            // Última barra: delay 2400ms + duración 2500ms ≈ 4900ms
            cutLineTimeoutId = setTimeout(animateCutLine, 4980);
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