<div class="radar-wrapper bg-light">
    <div class="radar-container">




        <div class="radar-canvas-holder">
            <canvas id="radarChart"></canvas>

            <div id="radar-tooltip" class="radar-tooltip-custom">
                <div class="tooltip-val"></div>
                <div class="tooltip-label">SCORE</div>
            </div>
        </div>

        <div class="radar-legend">
            <div class="radar-legend-item">
                <span class="radar-legend-box box-empresa"></span>
                <span class="radar-legend-text">Company Profile</span>
            </div>
            <div class="radar-legend-item">
                <span class="radar-legend-box box-benchmark"></span>
                <span class="radar-legend-text">Benchmark Profile</span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .radar-wrapper.bg-light {
        display: flex;
        justify-content: center;
        font-family: 'Jost', sans-serif;
        position: relative;
        position: relative;
        overflow: visible;
    }

    .radar-wrapper .block-header {
        /* Aligns with other content padding */
        margin-bottom: 20px;
    }

    .radar-container {
        width: 100%;
        max-width: 100%;
        background: #fff;
        opacity: 0;
    }

    .radar-container.visible {
        animation: slideIn 0.8s ease-out forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .radar-main-title {
        font-size: 32px;
        font-weight: 500;
        color: #000;
        margin-bottom: 5px;
        padding-left: 20px;
        line-height: 1.2;
    }

    .radar-subtitle {
        font-size: 20px;
        color: #555;
        padding-left: 20px;
        margin-bottom: 30px;
        font-weight: 300;
    }

    .radar-canvas-holder {
        position: relative;
        z-index: 1;
    }

    /* --- STABILIZED POPUP (Custom Scoped) --- */
    .radar-tooltip-custom {
        position: absolute;
        padding: 10px 18px;
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        pointer-events: none;
        opacity: 0;
        z-index: 100;
        backdrop-filter: blur(6px);
        transition: opacity 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Center align items */
        width: 200px;
        height: 55px;
        /* Rigid height as requested */
        text-align: center;
        /* Center text */
        justify-content: center;
        /* Center vertically */
        padding: 0 10px;
        /* Horizontal padding for safety */

        /* Default/Fallback alignment */
        transform: translate(-50%, -50%);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);

        /* Ensure text wrapping */
        white-space: normal;
        line-height: 1.2;
    }

    /* Smart Anchoring Styles */
    .radar-tooltip-custom.anchored-top {
        transform: translate(-50%, calc(-100% - 15px));
    }

    .radar-tooltip-custom.anchored-right {
        transform: translate(15px, -50%);
        /* text-align left inherited */
    }

    .radar-tooltip-custom.anchored-left {
        transform: translate(calc(-100% - 15px), -50%);
        /* text-align left inherited, NO right align */
    }

    .radar-tooltip-custom.anchored-bottom {
        transform: translate(-50%, 15px);
        /* Render below point (inwards for top) */
    }

    .radar-tooltip-custom.active {
        opacity: 1;
    }

    .tooltip-val {
        font-size: 22px;
        font-weight: 500;
        color: #126CFB;
        line-height: 1;
        margin-bottom: 4px;
    }

    .tooltip-label {
        font-size: 16px;
        line-height: 1.3;
        color: #555;
        font-weight: 300;
    }

    .radar-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        /* Centered */
        margin-top: 20px;
        margin-right: 0;
        opacity: 0;
        animation: fadeIn 0.8s ease 1.5s forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    .radar-legend-item {
        display: flex;
        align-items: center;
        margin: 0 15px;
    }

    .radar-legend-box {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        border-radius: 4px;
    }

    .box-empresa {
        background-color: #126CFB;
    }

    .box-benchmark {
        background-color: #12217C;
    }

    .radar-legend-text {
        font-size: 16px;
        font-weight: 300;
    }

    @media (max-width: 768px) {
        .radar-wrapper.bg-light {
            padding: 0px 0;
            /* Reduced padding */
        }

        .radar-container {
            padding: 0px;
            /* Minimal padding on mobile */
            border-radius: 0;
            box-shadow: none;
        }

        .radar-main-title,
        .radar-subtitle {
            padding-left: 10px;
        }

        .radar-main-title,
        .radar-subtitle {
            padding-left: 10px;
        }
    }

    .radar-interaction-hint {
        font-size: 14px;
        color: #555;
        background: #f0f4ff;
        border: 1px solid #d0e1fd;
        padding: 8px 16px;
        border-radius: 20px;
        text-align: center;
        margin: 0 auto 20px auto;
        font-weight: 500;
        width: fit-content;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* --- Modal Styles (Global for this block) --- */
    .radar-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000000 !important;
        /* Critical High Z-Index */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(5px);
    }

    .radar-modal-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }

    .radar-modal-content {
        background: #fff;
        width: 90%;
        max-width: 400px;
        border-radius: 12px;
        padding: 30px 25px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transform: translateY(20px);
        transition: transform 0.3s ease;
        position: relative;
    }

    .radar-modal-overlay.active .radar-modal-content {
        transform: translateY(0);
    }

    .radar-modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 28px;
        color: #999;
        cursor: pointer;
    }

    .radar-modal-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 15px;
    }

    .radar-modal-number {
        width: 40px;
        height: 40px;
        background: #126CFB;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .radar-modal-title {
        font-size: 24px;
        color: #051631;
        margin: 0;
        font-weight: 700;
    }

    .radar-modal-desc {
        font-size: 18px;
        color: #555;
        line-height: 1.4;
        margin: 0;
        font-weight: 500;
    }
</style>

<script>
    (function () {
        function initRadar() {
            const canvas = document.getElementById('radarChart');
            const tooltip = document.getElementById('radar-tooltip');

            if (!canvas || !tooltip) return;

            const isMobile = window.innerWidth <= 768;
            const chartPadding = isMobile ? 35 : 45; // Increased slightly to show labels

            // Company profile and benchmark data for modal
            const dimensions = [
                { full: "Strategy & Planning", acro: "EP" },
                { full: "Corporate Governance", acro: "GE" },
                { full: "Innovation & Adaptability", acro: "IA" },
                { full: "Customer Experience", acro: "EC" },
                { full: "Marketing & Demand Generation", acro: "MGD" },
                { full: "Sales Methodology", acro: "MC" },
                { full: "Digitalization & Artificial Intelligence", acro: "DIA" },
                { full: "Monitoring & Analytics", acro: "MA" },
                { full: "Operational Efficiency", acro: "EO" },
                { full: "Organizational Structure", acro: "ORG" },
                { full: "Executive Leadership", acro: "LID" },
                { full: "Talent Management", acro: "GT" }
            ];

            const tooltipVal = tooltip.querySelector('.tooltip-val');
            const ctx = canvas.getContext('2d');

            // Company (Light Blue): slightly lower
            const valuesEmpresa = [3.0, 2.9, 3.2, 3.2, 3.1, 3.2, 3.2, 3.5, 3.3, 3.3, 3.4, 3.2];
            // Benchmark (Dark Blue): slightly higher
            const valuesBenchmark = [4.0, 4.2, 3.8, 3.5, 3.6, 3.9, 3.8, 4.2, 4.0, 4.1, 4.3, 4.0];

            const labels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
            const fullLabels = dimensions.map(d => d.full);

            const myRadarChart = new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Benchmark Profile',
                            data: valuesBenchmark,
                            backgroundColor: 'rgba(18, 33, 124, 0.15)', // Dark Blue transparent
                            borderColor: '#12217C',
                            borderWidth: 3,
                            fill: true,

                            pointBackgroundColor: '#12217C',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#12217C',
                        },
                        {
                            label: 'Company Profile',
                            data: valuesEmpresa,
                            backgroundColor: 'rgba(18, 108, 251, 0.15)', // Light Blue transparent
                            borderColor: '#126CFB',
                            borderWidth: 3,
                            fill: true,

                            pointBackgroundColor: '#126CFB',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '#126CFB',
                        }
                    ]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    layout: {
                        padding: {
                            top: 20,
                            bottom: 20,
                            left: chartPadding,
                            right: chartPadding
                        }
                    },
                    animation: {
                        duration: 600,
                        easing: 'easeOutQuart',
                        loop: false,
                        delay: function (context) {
                            let delay = 0;
                            if (context.type === 'data') {
                                // Slower, more obvious sequence: 300ms per point
                                delay = 500 + (context.dataIndex * 300);

                                // Benchmark (Dark Blue) is now Index 0.
                                // Company (Light Blue) is now Index 1.
                                // We want Benchmark first, THEN Company.
                                if (context.datasetIndex === 1) {
                                    // Make 'Company' wait until 'Benchmark' is fully done
                                    // 12 points * 300ms = 3600ms. Add buffer -> 4000ms
                                    delay += 4000;
                                }
                            }
                            return delay;
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    scales: {
                        r: {
                            min: 0,
                            max: 5,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                display: false, /* HIDDEN: We draw manually to shift position */
                            },
                            grid: {
                                color: '#e0e0e0',
                                circular: true,
                                lineWidth: 1
                            },
                            angleLines: {
                                color: '#f0f0f0',
                                lineWidth: 1
                            },
                            pointLabels: { display: false } // Hide default labels
                        }
                    },
                    onHover: (event, chartElements) => {
                        const canvas = event.native.target;
                        const rScale = myRadarChart.scales.r;
                        let hoveringLabelIndex = -1;

                        if (rScale) {
                            const padding = 25;
                            const outerRadius = rScale.drawingArea + padding;
                            const xCenter = rScale.xCenter;
                            const yCenter = rScale.yCenter;
                            const mouseX = event.x;
                            const mouseY = event.y;

                            for (let i = 0; i < labels.length; i++) {
                                const angle = rScale.getIndexAngle(i) - (Math.PI / 2);
                                const labelX = xCenter + Math.cos(angle) * outerRadius;
                                const labelY = yCenter + Math.sin(angle) * outerRadius;

                                const dist = Math.sqrt(Math.pow(mouseX - labelX, 2) + Math.pow(mouseY - labelY, 2));
                                if (dist < 60) { // Hit radius
                                    hoveringLabelIndex = i;
                                    break;
                                }
                            }
                        }

                        if (hoveringLabelIndex !== -1) {
                            canvas.style.cursor = 'pointer';

                            // Show Dimension Name Tooltip
                            const labelX = rScale.xCenter + Math.cos(rScale.getIndexAngle(hoveringLabelIndex) - Math.PI / 2) * (rScale.drawingArea + 25);
                            const labelY = rScale.yCenter + Math.sin(rScale.getIndexAngle(hoveringLabelIndex) - Math.PI / 2) * (rScale.drawingArea + 25);

                            tooltip.querySelector('.tooltip-label').textContent = fullLabels[hoveringLabelIndex];
                            // Hide Score part
                            tooltipVal.style.display = 'none';

                            // Smart Anchoring Logic
                            tooltip.classList.remove('anchored-top', 'anchored-right', 'anchored-left', 'anchored-bottom');
                            const xCenter = rScale.xCenter;
                            const yCenter = rScale.yCenter;
                            const threshold = 60; // Central zone width

                            if (labelX < (xCenter - threshold)) {
                                tooltip.classList.add('anchored-right'); // Point on Left -> Anchor Right (In)
                            } else if (labelX > (xCenter + threshold)) {
                                tooltip.classList.add('anchored-left'); // Point on Right -> Anchor Left (In)
                            } else {
                                // Center X Zone
                                if (labelY < yCenter) {
                                    tooltip.classList.add('anchored-bottom'); // Top Point -> Anchor Bottom (In)
                                } else {
                                    tooltip.classList.add('anchored-top'); // Bottom Point -> Anchor Top (In)
                                }
                            }

                            tooltip.style.left = labelX + 'px';
                            tooltip.style.top = labelY + 'px';
                            tooltip.classList.add('active');

                        } else {
                            canvas.style.cursor = 'default';
                            tooltip.classList.remove('active');
                            // Reset display styles just in case
                            tooltipVal.style.display = 'block';
                        }
                    }
                },
                plugins: [
                    {
                        // Plugin for Values
                        id: 'drawValues',
                        afterDatasetsDraw(chart) {
                            const { ctx, scales: { r } } = chart;
                            if (!r) return;
                            const xCenter = r.xCenter;
                            const yCenter = r.yCenter;

                            chart.data.datasets.forEach((dataset, i) => {
                                // Only draw values for "Company Profile" (Which is now Index 1)
                                if (i !== 1) return;

                                const meta = chart.getDatasetMeta(i);
                                if (!meta.hidden) {
                                    meta.data.forEach((element, index) => {
                                        const value = dataset.data[index];

                                        // Calculate distance from center to check if deployed
                                        const dx = element.x - xCenter;
                                        const dy = element.y - yCenter;
                                        const dist = Math.sqrt(dx * dx + dy * dy);

                                        // Threshold: if visible distance < 40px, don't draw text yet
                                        if (dist < 40) return;

                                        ctx.save();
                                        ctx.fillStyle = dataset.borderColor;
                                        ctx.font = '500 16px Jost'; // Matched to Bar Chart Values (500 weight)
                                        ctx.textAlign = 'center';
                                        ctx.textBaseline = 'middle';

                                        const rScale = chart.scales.r;
                                        const angle = rScale.getIndexAngle(index) - Math.PI / 2;

                                        // Offset text inwards (negative)
                                        const offset = -25;
                                        const textX = element.x + Math.cos(angle) * offset;
                                        const textY = element.y + Math.sin(angle) * offset;

                                        ctx.fillText(value.toFixed(1), textX, textY);

                                        ctx.restore();
                                    });
                                }
                            });
                        }
                    },
                    {
                        // Restored Animated Labels Plugin
                        id: 'animatedLabels',
                        afterDraw(chart) {
                            const { ctx, scales: { r } } = chart;
                            if (!r) return;

                            const padding = 25;
                            const outerRadius = r.drawingArea + padding;

                            ctx.save();
                            ctx.font = '300 15px Jost'; // Updated to 16px Light
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.fillStyle = '#666';

                            const now = Date.now();
                            const startTime = chart._startTime || now;
                            const elapsedTotal = now - startTime;
                            let drawingNeeded = false;

                            chart.data.labels.forEach((label, i) => {
                                const pointDelay = i * 150;
                                const textDelay = pointDelay + 200;
                                const fadeDuration = 400;

                                let alpha = 0;

                                if (elapsedTotal > textDelay) {
                                    alpha = (elapsedTotal - textDelay) / fadeDuration;
                                    if (alpha > 1) alpha = 1;
                                }

                                if (alpha < 1 && elapsedTotal < (textDelay + fadeDuration + 100)) {
                                    drawingNeeded = true;
                                }

                                if (alpha > 0) {
                                    const angle = r.getIndexAngle(i) - (Math.PI / 2);
                                    const x = r.xCenter + Math.cos(angle) * outerRadius;
                                    const y = r.yCenter + Math.sin(angle) * outerRadius;

                                    ctx.globalAlpha = alpha;
                                    ctx.fillText(label, x, y);
                                }
                            });

                            ctx.restore();

                            if (drawingNeeded) {
                                setTimeout(() => {
                                    chart.update('none');
                                }, 20);
                            }
                        }
                    }]
            });

            // Set startTime for custom animation
            myRadarChart._startTime = Date.now();

            // --- NATIVE DOM CLICK LISTENER FOR ROBUSTNESS ---
            canvas.onclick = (e) => {
                // 1. DATA POINTS CLICK (Check using Chart.js API)
                const points = myRadarChart.getElementsAtEventForMode(e, 'nearest', { intersect: true }, true);
                if (points && points.length > 0) {
                    const index = points[0].index;
                    openModalForIndex(index);
                    return;
                }
            };

            function openModalForIndex(i) {
                // Safety check
                if (!dimensions[i]) return;

                const info = dimensions[i];
                const modal = document.getElementById('radarModal');
                const mTitle = document.getElementById('modalRadarTitle');
                const mDesc = document.getElementById('modalRadarDesc');
                const mNum = document.getElementById('modalRadarNumber');

                if (modal && mTitle && mNum) {
                    mTitle.innerText = info.acro;
                    mDesc.innerText = info.full;
                    mNum.innerText = (i + 1);

                    modal.style.display = 'flex';
                    setTimeout(() => {
                        modal.classList.add('active');
                    }, 10);
                }
            }
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const container = document.querySelector('.radar-container');
                    if (container) container.classList.add('visible');
                    initRadar();
                    observer.disconnect();
                }
            });
        }, { threshold: 0.2 });

        const wrapper = document.querySelector('.radar-wrapper');
        if (wrapper) {
            observer.observe(wrapper);
        } else {
            if (document.readyState === 'complete') initRadar();
            else window.addEventListener('load', initRadar);
        }

        // Modal Close Logic
        const modal = document.getElementById('radarModal');
        const modalClose = document.getElementById('closeRadarModal');

        if (modal) {
            // Move modal to body to ensure it sits on top of everything (z-index/overflow fix)
            document.body.appendChild(modal);

            modalClose.onclick = () => modal.classList.remove('active');
            modal.onclick = (e) => {
                if (e.target === modal) modal.classList.remove('active');
            };
        }
    })();
</script>