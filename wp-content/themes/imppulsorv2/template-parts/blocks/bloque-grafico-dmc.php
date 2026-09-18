<div class="dmc-wrapper bg-light">
    <div class="dmc-container">


        <div class="dmc-mobile-hint">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                style="margin-bottom:-2px; margin-right:4px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            Toca un círculo para ver detalle
        </div>

        <svg viewBox="0 0 800 600" class="dmc-svg" id="dmcSvg">
            <defs>
                <linearGradient id="gradRight" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#001a33;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#004b99;stop-opacity:1" />
                </linearGradient>
                <linearGradient id="gradLeft" x1="0%" y1="100%" x2="0%" y2="0%">
                    <stop offset="0%" style="stop-color:#004b99;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#007bff;stop-opacity:1" />
                </linearGradient>
            </defs>

            <!-- Centered at X=400 (Previously 300) -->
            <circle cx="400" cy="300" r="220" class="track-line track-solid anim-track" />
            <circle cx="400" cy="300" r="210" class="track-line track-dashed anim-track" />

            <!-- New Center Background Circle -->
            <circle cx="400" cy="300" r="110" fill="#001a33" />

            <g class="arrow-group">
                <!-- Paths shifted +100px on X axis -->
                <path d="M 400,135 A 165,165 0 0,1 400,465" class="animated-arrow arrow-right" stroke-linecap="butt" />
                <path d="M 400,465 A 165,165 0 0,1 400,135" class="animated-arrow arrow-left" stroke-linecap="butt" />

                <!-- Triangle centered at X=400, Y=135 -->
                <polygon points="400,102 440,135 400,168" fill="#007bff" class="arrow-head" />
            </g>

            <g class="center-text-group">
                <text x="400" y="285" class="center-title fade-text">DMC</text>
                <text x="400" y="310" class="center-subtitle fade-text">Diagnóstico de</text>
                <text x="400" y="330" class="center-subtitle fade-text">Madurez
                    Comercial</text>
            </g>

            <g id="nodesGroup"></g>
        </svg>
    </div>

    <!-- Mobile Modal -->
    <div class="dmc-modal-overlay" id="dmcModal">
        <div class="dmc-modal-content">
            <button class="dmc-modal-close" id="closeDmcModal">&times;</button>
            <div class="dmc-modal-header">
                <div class="dmc-modal-number" id="modalDmcNumber"></div>
                <h3 class="dmc-modal-title" id="modalDmcTitle"></h3>
            </div>
            <p class="dmc-modal-desc" id="modalDmcDesc"></p>
        </div>
    </div>
</div>

<style>
    /* ... styles remain unchanged ... */
    .dmc-wrapper.bg-light {
        display: flex;
        justify-content: center;
        font-family: 'Jost', sans-serif;
    }

    .dmc-wrapper .block-header {
        text-align: left;
        width: 100%;
        margin-bottom: 20px;
    }

    .dmc-wrapper .block-header h2 {
        text-align: left;
    }

    .dmc-container {
        width: 100%;
        max-width: 900px;
        /* Restored max-width to prevent 'zoom' effect on desktop */
        margin: 0 auto;
        /* Center container */
    }

    .dmc-svg {
        width: 100%;
        height: auto;
        overflow: visible;
    }

    /* Animación de Carriles */
    .track-line {
        fill: none;
        stroke: #001a33;
        stroke-width: 1;
        opacity: 0;
        stroke-dasharray: 1400;
        stroke-dashoffset: 1400;
        transition: stroke-dashoffset 2.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s ease;
    }

    .track-dashed {
        stroke-dasharray: 4, 4;
        stroke-dashoffset: 0;
    }

    .start-anim .track-line {
        opacity: 0.4;
        stroke-dashoffset: 0;
    }

    /* Flecha */
    .arrow-group {
        opacity: 0;
        transition: opacity 0.8s ease;
    }

    .start-anim .arrow-group {
        opacity: 1;
    }

    .animated-arrow {
        fill: none;
        stroke-width: 33;
    }

    .arrow-head {
        transform-origin: 400px 300px;
        /* Updated center */
        will-change: transform;
    }

    .start-anim .animated-arrow {
        stroke-dashoffset: 0;
    }

    /* Nodos */
    .node-group {
        cursor: pointer;
        opacity: 0;
        transform: scale(0);
        transform-origin: center;
        transition: opacity 0.2s ease, transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .node-group.visible {
        opacity: 1;
        transform: scale(1);
    }

    /* Hover Pro */
    .node-group:hover .node-circle {
        fill: #001a33;
        stroke: #007bff;
        stroke-width: 4px;
    }

    /* Hover effects for BOTH labels */
    .node-group:hover .label-text {
        fill: #007bff !important;
        text-shadow: 0.5px 0px 0px #007bff;
        opacity: 1 !important;
    }

    .node-circle {
        fill: #007bff;
        stroke: #fff;
        stroke-width: 2;
        transition: all 0.3s ease;
    }

    .node-number {
        fill: #fff;
        font-size: 16px;
        font-weight: 700;
        text-anchor: middle;
        dominant-baseline: central;
        pointer-events: none;
    }

    /* Texto Negro y Hover */
    .label-text {
        fill: #000 !important;
        font-size: 16px;
        opacity: 0;
        transition: fill 0.3s ease, text-shadow 0.3s ease, opacity 0.5s ease;
        pointer-events: all;
    }

    .node-group.visible .label-text {
        opacity: 1 !important;
    }

    /* Center Texts */
    .center-title {
        font-size: 48px;
        text-anchor: middle;
        fill: #ffffff;
        font-weight: 400;
    }

    .center-subtitle {
        font-size: 16px;
        text-anchor: middle;
        fill: #ffffff;
        font-weight: 300;
    }

    .fade-text {
        opacity: 0;
        transition: opacity 1.5s ease;
    }

    .start-anim .fade-text {
        opacity: 1;
    }

    /* Default visibility (Desktop) */
    .label-full {
        display: block;
    }

    .label-acronym {
        display: none;
    }

    @media (max-width: 600px) {

        /* Mobile: Switch to Acronyms */
        .label-full {
            display: none;
        }

        .label-acronym {
            display: block;
            font-size: 24px;
            /* Scaled up from 14px to counteract ViewBox zoom */
            font-weight: 500;
            /* Increased weight slightly for better readability */
        }

        .center-title {
            font-size: 46px;
            /* Scaled up */
        }

        .center-subtitle {
            font-size: 24px;
            /* Scaled up */
        }

        .node-number {
            font-size: 20px;
            /* Scaled up */
        }

        .node-number {
            font-size: 20px;
            /* Scaled up */
        }

        .dmc-mobile-hint {
            display: flex !important;
            margin-bottom: 20px;
        }
    }

    .dmc-mobile-hint {
        display: none;
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
        align-items: center;
        justify-content: center;
    }

    /* --- Modal Styles --- */
    .dmc-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(5px);
    }

    .dmc-modal-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }

    .dmc-modal-content {
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

    .dmc-modal-overlay.active .dmc-modal-content {
        transform: translateY(0);
    }

    .dmc-modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 28px;
        color: #999;
        cursor: pointer;
    }

    .dmc-modal-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 15px;
    }

    .dmc-modal-number {
        width: 40px;
        height: 40px;
        background: #007bff;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .dmc-modal-title {
        font-size: 24px;
        /* Title (Acronym) */
        color: #051631;
        margin: 0;
        font-weight: 700;
    }

    .dmc-modal-desc {
        font-size: 18px;
        /* Description (Full Name) */
        color: #555;
        line-height: 1.4;
        margin: 0;
        font-weight: 500;
    }
</style>

<script>
    (function () {
        function initDMC() {
            const dimensions = [
                { full: "Estrategia y Planificación", acro: "EP" },
                { full: "Gobernanza Empresarial", acro: "GE" },
                { full: "Innovación y Adaptabilidad", acro: "IA" },
                { full: "Experiencia de Cliente", acro: "EC" },
                { full: "MK y Gen. de Demanda", acro: "MGD" },
                { full: "Metodología Comercial", acro: "MC" },
                { full: "Digitalización e Inteligencia Artificial", acro: "DIA" },
                { full: "Monitoreo y Análisis", acro: "MA" },
                { full: "Eficiencia Operativa", acro: "EO" },
                { full: "Estructura Organizacional​", acro: "ORG" },
                { full: "Liderazgo Ejecutivo", acro: "LID" },
                { full: "Gestión del Talento", acro: "GT" }
            ];
            const nodesGroup = document.getElementById('nodesGroup');
            if (!nodesGroup) return;

            // Responsive ViewBox Logic
            const svg = document.getElementById('dmcSvg');
            const updateViewBox = () => {
                if (window.innerWidth <= 600) {
                    // Mobile: "Zoom in" by cropping unused side margins
                    // Center X=400. Circle ends at ~660. Start ~140.
                    // Crop X from 100 to 700 (Width 600).
                    svg.setAttribute('viewBox', '100 0 600 600');
                } else {
                    // Desktop: Full width for long labels
                    svg.setAttribute('viewBox', '0 0 800 600');
                }
            };

            // Run on init and resize
            updateViewBox();
            window.addEventListener('resize', updateViewBox);

            nodesGroup.innerHTML = "";
            const radiusNodes = 220;
            const centerX = 400; // Updated Center
            const centerY = 300;

            dimensions.forEach((item, i) => {
                const angle = (i * 30 - 90) * (Math.PI / 180);
                const x = centerX + radiusNodes * Math.cos(angle);
                const y = centerY + radiusNodes * Math.sin(angle);

                const textRadiusOffset = radiusNodes + 40; // Increased to 40px for better clearance
                const tx = centerX + textRadiusOffset * Math.cos(angle);
                const ty = centerY + textRadiusOffset * Math.sin(angle);

                // Calculate Vertical Alignment (dy) for uniform spacing
                const sinAngle = Math.sin(angle);
                let dy = "0.35em"; // Default Middle (Sides)

                if (sinAngle < -0.5) {
                    // Top Hemisphere: Text above circle -> Baseline (dy=0) works best (sits on radius)
                    dy = "0";
                } else if (sinAngle > 0.5) {
                    // Bottom Hemisphere: Text below circle -> Need to push down (Hanging)
                    dy = "0.9em";
                }

                const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
                g.setAttribute("class", "node-group");
                g.setAttribute("data-index", i);

                let anchor = "middle";
                if (tx > centerX + 40) anchor = "start";
                else if (tx < centerX - 40) anchor = "end";

                g.innerHTML = `
                <circle cx="${x}" cy="${y}" r="22" class="node-circle" />
                <text x="${x}" y="${y}" class="node-number">${i + 1}</text>
                
                <!-- Full Text (Desktop) -->
                <text x="${tx}" y="${ty}" dy="${dy}" class="label-text label-full" style="text-anchor: ${anchor}">${item.full}</text>
                
                <!-- Acronym (Mobile) -->
                <text x="${tx}" y="${ty}" dy="${dy}" class="label-text label-acronym" style="text-anchor: ${anchor}">${item.acro}</text>
            `;

                // Add Click Event for Mobile Modal
                g.addEventListener('click', () => {
                    if (window.innerWidth > 600) return; // Only Mobile

                    const modal = document.getElementById('dmcModal');
                    const modalTitle = document.getElementById('modalDmcTitle');
                    const modalDesc = document.getElementById('modalDmcDesc');
                    const modalNumber = document.getElementById('modalDmcNumber');

                    if (modal && modalTitle && modalDesc) {
                        modalTitle.innerText = item.acro; // Acronym as Title
                        modalDesc.innerText = item.full;  // Full name as Description
                        modalNumber.innerText = i + 1;
                        modal.classList.add('active');
                    }
                });

                nodesGroup.appendChild(g);
            });

            // Modal Events
            const modal = document.getElementById('dmcModal');
            const closeBtn = document.getElementById('closeDmcModal');
            if (modal && closeBtn) {
                closeBtn.onclick = () => modal.classList.remove('active');
                modal.onclick = (e) => {
                    if (e.target === modal) modal.classList.remove('active');
                };
            }

            setTimeout(() => {
                const container = document.querySelector('.dmc-container');
                if (container) {
                    container.classList.add('start-anim');
                    animateArrow();
                }
            }, 300);
        }

        function animateArrow() {
            const arrowRight = document.querySelector('.arrow-right');
            const arrowLeft = document.querySelector('.arrow-left');
            const arrowHead = document.querySelector('.arrow-head');
            if (!arrowRight || !arrowLeft || !arrowHead) return;

            const allNodes = document.querySelectorAll('.node-group');

            // New Stroke Dash Length for Radius 165 (Circumference ~1036.7 -> Half ~518.4)
            // Set to 525 to ensure overlap and no gap at the bottom seam
            const dashLen = 525;

            // Reset styles
            arrowRight.style.strokeDasharray = `${dashLen}`;
            arrowRight.style.strokeDashoffset = `${dashLen}`;
            arrowLeft.style.strokeDasharray = `${dashLen}`;
            arrowLeft.style.strokeDashoffset = `${dashLen}`;
            arrowHead.style.transform = 'rotate(0deg)';

            // Ensure colors are correct
            arrowRight.style.stroke = "url(#gradRight)";
            arrowLeft.style.stroke = "url(#gradLeft)";

            const duration = 3000; // Slower speed (3s decided by user)
            // dashLen is already defined above as 608
            const start = performance.now();
            const epsilon = 1.5;
            const totalNodes = allNodes.length;

            function interpolateColor(color1, color2, factor) {
                var result = color1.slice();
                for (var i = 0; i < 3; i++) {
                    result[i] = Math.round(result[i] + factor * (color2[i] - color1[i]));
                }
                return `rgb(${result[0]}, ${result[1]}, ${result[2]})`;
            }

            // Colors in RGB
            const c1 = [0, 26, 51];   // #001a33
            const c2 = [0, 75, 153];  // #004b99
            const c3 = [0, 123, 255]; // #007bff

            function step(timestamp) {
                const elapsed = timestamp - start;
                let progress = elapsed / duration;
                if (progress > 1) progress = 1;

                // Use Linear easing for perfect coordination
                const p = progress;

                const degrees = p * 360;

                arrowHead.style.transform = `rotate(${degrees}deg)`;

                // Interpolate Color
                let currentColor;
                if (p <= 0.5) {
                    // First Half: c1 -> c2
                    const localP = p / 0.5;
                    currentColor = interpolateColor(c1, c2, localP);
                } else {
                    // Second Half: c2 -> c3
                    const localP = (p - 0.5) / 0.5;
                    currentColor = interpolateColor(c2, c3, localP);
                }
                arrowHead.style.fill = currentColor;


                const indexToReveal = Math.floor(degrees / 30);

                for (let i = 0; i <= indexToReveal && i < totalNodes; i++) {
                    if (!allNodes[i].classList.contains('visible')) {
                        allNodes[i].classList.add('visible');
                    }
                }

                let rightOffset = dashLen;
                let leftOffset = dashLen;

                if (p <= 0.5) {
                    const localP = p / 0.5;
                    let val = dashLen * (1 - localP) - epsilon;
                    if (val < 0) val = 0;
                    rightOffset = val;
                } else {
                    rightOffset = 0;
                    const localP = (p - 0.5) / 0.5;
                    let val = dashLen * (1 - localP) - epsilon;
                    if (val < 0) val = 0;
                    leftOffset = val;
                }

                arrowRight.style.strokeDashoffset = rightOffset;
                arrowLeft.style.strokeDashoffset = leftOffset;

                if (progress < 1) {
                    requestAnimationFrame(step);
                } else {
                    allNodes.forEach(n => n.classList.add('visible'));
                    // Ensure final color matches end of gradient
                    arrowHead.style.fill = `rgb(${c3[0]}, ${c3[1]}, ${c3[2]})`;
                }
            }

            requestAnimationFrame(step);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initDMC();
                    observer.disconnect();
                }
            });
        }

            , {
                threshold: 0.2
            });

        const wrapper = document.querySelector('.dmc-wrapper');

        if (wrapper) {
            observer.observe(wrapper);
        }

        else {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                initDMC();
            }

            else {
                document.addEventListener("DOMContentLoaded", initDMC);
            }
        }
    })();
</script>