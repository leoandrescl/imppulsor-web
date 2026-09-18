<!-- Header moved inside wrapper for correct layout -->
<div id="wc-wrapper-unique" class="wordcloud-wrapper bg-light">



    <div id="wordcloud-loader" class="wc-loader">Generando nube...</div>
    <div id="wordcloud-container" class="wordcloud-container"></div>
</div>

<style>
    .wordcloud-wrapper.bg-light {
        /* Eliminamos overflow hidden para que el tooltip no se corte en los bordes */
        /* overflow: hidden; */
        display: flex;
        flex-direction: column;
        /* Force Column */

        min-height: 350px;
        font-family: 'Jost', sans-serif;
        position: relative;
    }

    .wordcloud-wrapper .block-header {
        text-align: left;
        width: 100%;
        padding-left: 20px;
    }

    .wc-loader {
        position: absolute;
        font-size: 16px;
        color: #007bff;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .wordcloud-container {
        position: relative;
        width: 100%;
        max-width: 100%;
        /* Height handled by JS for Square Aspect Ratio */
        margin: 0 auto;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.8s ease;
        z-index: 1;
        /* Nivel base */
    }

    .wordcloud-container.visible {
        visibility: visible;
        opacity: 1;
    }

    /* --- PALABRAS --- */
    /* --- PALABRAS --- */
    .wc-word {
        position: absolute;
        line-height: 1;
        /* Tighter line height for packing */
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
        font-family: 'Jost', sans-serif;

        /* Transition */
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease, color 0.3s ease;

        text-align: center;
        z-index: 10;
        transform-origin: center center;

        /* INITIAL STATE: Hidden & Scaled Down */
        opacity: 0;
        transform: scale(0.5);

        /* INITIAL STATE: Standard Words are DARK (#061C2C) */
        color: #061C2C;
    }

    .wc-word.visible {
        opacity: 1;
        transform: scale(1);
    }

    .wc-word.vertical {
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }

    /* HOVER: Standard words turn BLUE (#126CFB) - REMOVED SCALE */
    .wc-word:hover {
        z-index: 100 !important;
        /* transform: scale(1.1) !important; REMOVED AS REQUESTED */
        color: #126CFB !important;
    }

    /* --- HIERARCHY (5 Levels) --- */

    /* 1. LIDERAZGO (Special Case) */
    .p-1 {
        font-size: 110px;
        /* Much larger as requested */
        font-weight: 500;
        /* Normal/Medium weight */
        color: #126CFB !important;
        /* Blue by default */
    }

    /* Hover for LIDERAZGO: Turns DARK */
    .p-1:hover {
        color: #061C2C !important;
    }

    /* 2. Large Words */
    .p-2 {
        font-size: 60px;
        font-weight: 300;
        /* Light weight */
    }

    /* 3. Medium Words */
    .p-3 {
        font-size: 45px;
        font-weight: 300;
    }

    /* 4. Small Words */
    .p-4 {
        font-size: 30px;
        font-weight: 300;
    }

    /* 5. Tiny Words */
    .p-5 {
        font-size: 20px;
        font-weight: 300;
        opacity: 0.8;
        /* Slight opacity variation optional, typically flat color requested */
        color: #061C2C;
        /* Ensure strictly dark */
    }

    /* CSS Font Sizes removed in favor of JS Responsive Scaling */
    @media (max-width: 768px) {
        /* Mobile adjustments if needed */
    }
</style>

<script>
    (function () {
        const words = [
            { text: "LIDERAZGO", cls: "p-1", freq: 100 },
            { text: "CLIENTES", cls: "p-2", freq: 90 },
            { text: "CONFIANZA", cls: "p-2", freq: 88 },
            { text: "AUTONOMÍA", cls: "p-2", freq: 85 },
            { text: "VENTAS", cls: "p-2", freq: 82 },
            { text: "DISCIPLINA", cls: "p-3", freq: 78 },
            { text: "RIESGO", cls: "p-3", freq: 75 },
            { text: "MOTIVACIÓN", cls: "p-3", freq: 72 },
            { text: "CAPACITACIÓN", cls: "p-3", freq: 70 },
            { text: "PROCESOS", cls: "p-3", freq: 68 },
            { text: "REASEGURAMIENTO", cls: "p-4", freq: 65 },
            { text: "ESTANDARIZACIÓN", cls: "p-4", freq: 62 },
            { text: "EFICIENCIA", cls: "p-4", freq: 60 },
            { text: "CRECIMIENTO", cls: "p-4", freq: 58 },
            { text: "CLARIDAD", cls: "p-4", freq: 55 },
            { text: "PROPUESTA", cls: "p-4", freq: 52 },
            { text: "ESCALABILIDAD", cls: "p-4", freq: 50 },
            { text: "SEGUIMIENTO", cls: "p-5", freq: 45 },
            { text: "INDICADORES", cls: "p-5", freq: 42 },
            { text: "PROFESIONAL", cls: "p-5", freq: 40 },
            { text: "LIQUIDEZ", cls: "p-5", freq: 38 },
            { text: "CULTURA", cls: "p-5", freq: 35 },
            { text: "NUBE", cls: "p-5", freq: 32 },
            { text: "INTEGRACIÓN", cls: "p-5", freq: 30 },
            { text: "TRANSPARENCIA", cls: "p-5", freq: 28 }
        ];

        const wrapper = document.getElementById('wc-wrapper-unique');
        const container = document.getElementById('wordcloud-container');
        const loader = document.getElementById('wordcloud-loader');

        const CONFIG = {
            padding: 2, /* Reduced spacing to pack words tighter */
            stepAngle: 0.1,
            stepRadius: 4
        };

        function intersect(r1, r2) {
            return !(r2.left > r1.right ||
                r2.right < r1.left ||
                r2.top > r1.bottom ||
                r2.bottom < r1.top);
        }

        async function initCloud() {
            if (!container) return;
            await document.fonts.ready;

            container.innerHTML = "";
            loader.style.display = "none";

            // Square Ratio: Height = Width
            const cw = container.offsetWidth;
            const squareSize = cw;
            container.style.height = squareSize + 'px';
            const ch = squareSize;

            const cx = cw / 2;
            const cy = ch / 2;

            // Responsive Font Scaling
            // Base reference width: 900px (Desktop) -> Modified to 650 for tighter fit
            // Scale factor = Current Width / 650
            // Min Scale to prevent effective invisibility: 0.4
            let scaleFactor = cw / 650;
            if (scaleFactor < 0.35) scaleFactor = 0.35; // Floor for very small screens

            // Base Sizes (Desktop)
            const fontSizes = {
                'p-1': 110,
                'p-2': 65,  // Increased from 60
                'p-3': 50,  // Increased from 45
                'p-4': 38,  // Increased from 30
                'p-5': 28   // Increased from 20
            };

            const placed = [];

            const elements = words.map((item, index) => {
                const el = document.createElement('div');
                el.className = `wc-word ${item.cls}`;
                el.textContent = item.text;

                // Apply Scaled Font Size
                const baseSize = fontSizes[item.cls] || 20;
                const scaledSize = Math.floor(baseSize * scaleFactor);
                el.style.fontSize = `${scaledSize}px`;

                let isVertical = false;
                if (item.cls !== 'p-1' && Math.random() < 0.35) {
                    el.classList.add('vertical');
                    isVertical = true;
                }

                container.appendChild(el);
                return { el, w: el.offsetWidth, h: el.offsetHeight };
            });

            // Removed Global Mouse Event for Tooltip

            for (let i = 0; i < elements.length; i++) {
                const item = elements[i];
                let angle = Math.random() * 6.28;
                let radius = 0;
                let found = false;
                let maxIter = 3000;

                while (maxIter-- > 0) {
                    const x = cx + radius * Math.cos(angle);
                    const y = cy + radius * Math.sin(angle); // Removed 0.9 factor for 1:1 ratio

                    const left = x - (item.w / 2);
                    const top = y - (item.h / 2);

                    const rect = {
                        left: left - CONFIG.padding,
                        top: top - CONFIG.padding,
                        right: left + item.w + CONFIG.padding,
                        bottom: top + item.h + CONFIG.padding
                    };

                    if (rect.left < 0 || rect.top < 0 || rect.right > cw || rect.bottom > ch) {
                        radius += CONFIG.stepRadius;
                        angle += CONFIG.stepAngle;
                        continue;
                    }

                    let collision = false;
                    for (let p of placed) {
                        if (intersect(rect, p)) {
                            collision = true;
                            break;
                        }
                    }

                    if (!collision) {
                        item.el.style.left = (x - item.w / 2) + 'px';
                        item.el.style.top = (y - item.h / 2) + 'px';
                        placed.push(rect);
                        found = true;
                        break;
                    }

                    angle += CONFIG.stepAngle;
                    radius += (CONFIG.stepRadius / 15);
                }

                if (!found) {
                    item.el.style.display = 'none';
                }

                if (i % 5 === 0) await new Promise(r => setTimeout(r, 0));
            }

            container.classList.add('visible');
            if (wrapper) wrapper.classList.add('charts-loaded'); // Signal for Lightbox button

            // Sequential Animation: Largest (first in elements) to Smallest
            // We use a small delay between each word to create the "streaming" effect
            elements.forEach((item, index) => {
                if (item.el.style.display !== 'none') {
                    // Mas rápido para las primeras (grandes), un poco más lento si hay muchas?
                    // Flat delay works well usually.
                    setTimeout(() => {
                        item.el.classList.add('visible');
                    }, 50 + (index * 60));
                }
            });
        }

        const cloudObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initCloud();
                    cloudObserver.disconnect();
                }
            });
        }, { threshold: 0.2 });

        if (wrapper) {
            cloudObserver.observe(wrapper);
        } else {
            if (document.readyState === 'complete') initCloud();
            else window.addEventListener('load', initCloud);
        }

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                // Only re-init if it was already visible/initialized
                if (container && container.classList.contains('visible')) {
                    initCloud();
                }
            }, 500);
        });

    })();
</script>