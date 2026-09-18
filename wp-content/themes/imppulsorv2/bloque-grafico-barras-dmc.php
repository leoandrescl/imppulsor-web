<div class="igmc-wrapper">
    <div class="igmc-container">


        <div class="igmc-chart-area">
            <div class="canvas-holder">
                <canvas id="igmcChart"></canvas>
            </div>

            <div class="igmc-legend">
                <div class="legend-item">
                    <span class="legend-box box-benchmark"></span>
                    <span class="legend-text">IGMC Benchmark</span>
                </div>
                <div class="legend-item">
                    <span class="legend-box box-empresa"></span>
                    <span class="legend-text">IGMC Empresa</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .igmc-wrapper {
        background: #fff;
        font-family: 'Jost', sans-serif;
        display: flex;
        justify-content: center;
    }

    .igmc-wrapper .block-header {
        text-align: left;
        width: 100%;
        max-width: 800px;
        /* Match chart width */
    }

    .igmc-container {
        width: 100%;
        max-width: 100%;
        position: relative;
    }

    .igmc-title {
        font-size: 36px;
        font-weight: 500;
        color: #000;
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .igmc-subtitle {
        font-size: 28px;
        font-weight: 300;
        margin-bottom: 40px;
        display: inline-block;
        padding-bottom: 2px;
    }

    .igmc-chart-area {
        display: flex;
        flex-direction: column;
        /* Stack chart then legend */
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .canvas-holder {
        width: 100%;
        max-width: 800px;
        height: 500px;
        /* Force height */
        position: relative;
    }

    .igmc-legend {
        display: flex;
        flex-direction: row;
        /* Horizontal Legend */
        gap: 30px;
        padding-top: 20px;
        justify-content: center;
        width: 100%;
    }

    .legend-item {
        display: flex !important;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 300;
        margin: 0 15px;

        /* Initial State */
        opacity: 0;
        transform: translateY(20px);
    }

    .legend-item.visible {
        animation: fadeInUpLegend 0.8s ease-out forwards;
    }

    .legend-item:nth-child(1) {
        animation-delay: 0.5s;
    }

    .legend-item:nth-child(2) {
        animation-delay: 0.8s;
    }

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
        margin-right: 8px;
    }

    .box-benchmark {
        background: #122238;
    }

    .box-empresa {
        background: #126CFB;
    }

    @media (max-width: 768px) {
        .canvas-holder {
            height: 400px;
        }

        .igmc-legend {
            flex-wrap: wrap;
            gap: 15px;
        }
    }
</style>

<script>
    (function () {
        // Animation Trigger
        const container = document.querySelector('.igmc-container');

        let chartInstance = null;
        let cutLineProgress = 0;
        let cutLineTimeoutId = null;
        const cutLineDuration = 900;

        const initChart = () => {
            const ctx = document.getElementById('igmcChart').getContext('2d');

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
                                // Get current value from the pixel position
                                let currentValue = yScale.getValueForPixel(element.y);

                                // Clamp value for safety
                                if (currentValue < 0) currentValue = 0;

                                let text = currentValue.toFixed(1);

                                // Restore Styles: User requested ALWAYS WHITE, 16px Medium
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

            // Segmented reference line near 3.0; animates left -> right.
            const drawCutLine = {
                id: 'drawCutLine',
                afterDatasetsDraw(chart) {
                    if (cutLineProgress <= 0) return;

                    const { left, right } = chart.chartArea;
                    const y = chart.scales.y.getPixelForValue(3.22) + 3;
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
                    labels: [''], // Single category, hidden logic
                    datasets: [
                        {
                            label: 'IGMC Benchmark',
                            data: [4.4],
                            backgroundColor: '#122238',
                            barPercentage: 0.4, // Increased from 0.3
                            categoryPercentage: 0.8,
                            borderRadius: 0,
                            borderSkipped: false,
                            borderSkipped: false,
                            hoverBackgroundColor: '#22445D' // High Contrast Dark Blue (Matches Strategy Graph 3.1)
                        },
                        {
                            label: 'IGMC Empresa',
                            data: [3.2],
                            backgroundColor: '#126CFB',
                            barPercentage: 0.4, // Increased from 0.3
                            categoryPercentage: 0.8,
                            borderRadius: 0,
                            borderSkipped: false,
                            borderSkipped: false,
                            hoverBackgroundColor: '#5599ff' // High Contrast Blue -> Sky Blue
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
                            border: { display: false } // No axis line
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { display: false } // Hide X labels since we have legend
                        }
                    },
                    plugins: {
                        legend: { display: false }, // Using custom HTML legend
                        tooltip: { enabled: false } // No tooltips needed if values are shown
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart',
                        delay: (context) => {
                            // Sequential delay: dataset 0 then dataset 1
                            if (context.type === 'data' && context.mode === 'default') {
                                return context.datasetIndex * 1000; // 1s delay for second bar
                            }
                            return 0;
                        },
                        onComplete: () => { },
                    }
                },
                plugins: [drawValues, drawCutLine]
            });

            // Bars finish around 3s total (2s + 1s stagger). Draw cut line last.
            cutLineTimeoutId = setTimeout(animateCutLine, 3200);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (!chartInstance) {
                        initChart();
                        // Animate Legend
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