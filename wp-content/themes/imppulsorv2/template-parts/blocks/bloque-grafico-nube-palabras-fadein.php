<div id="wc-wrapper-unique" class="wordcloud-wrapper bg-light">
    <div id="wordcloud-loader" class="wc-loader">Generando nube...</div>
    <div id="wordcloud-container" class="wordcloud-container"></div>
</div>

<style>
    .wordcloud-wrapper.bg-light {
        display: flex;
        flex-direction: column;
        min-height: 350px;
        font-family: 'Jost', sans-serif;
        position: relative;
        overflow: hidden;
        padding: 20px 0;
        width: 100%;
    }

    .wc-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        color: #007bff;
        font-weight: 500;
        letter-spacing: 1px;
        z-index: 20;
    }

    .wordcloud-container {
        position: relative;
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.8s ease;
        z-index: 1;
    }

    .wordcloud-container.visible {
        visibility: visible;
        opacity: 1;
    }

    /* --- PALABRAS --- */
    .wc-word {
        position: absolute;
        line-height: 0.85;
        /* Altura de línea compacta */
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
        font-family: 'Jost', sans-serif;
        transition: transform 0.3s ease, color 0.3s ease;
        text-align: center;
        z-index: 10;
        transform-origin: center center;
        /* Inicialmente invisibles pero ocupando espacio para cálculo */
        opacity: 0;
        color: #061C2C;
        will-change: transform, opacity;
    }

    .wc-word.visible {
        opacity: 1;
        animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }

    @keyframes popIn {
        from {
            opacity: 0;
            transform: scale(0.5);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .wc-word.vertical {
        writing-mode: vertical-rl;
        text-orientation: mixed;
    }

    .wc-word:hover {
        z-index: 100 !important;
        color: #126CFB !important;
    }

    /* Clases de jerarquía para grosor y color */
    .p-1 {
        font-weight: 700;
        color: #126CFB !important;
    }

    /* Título azul */
    .p-1:hover {
        color: #061C2C !important;
    }

    .p-2 {
        font-weight: 500;
    }

    .p-3 {
        font-weight: 400;
    }

    .p-4 {
        font-weight: 300;
    }

    .p-5 {
        font-weight: 300;
        opacity: 0.8;
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
            padding: 4,
            stepAngle: 0.2,
            stepRadius: 5
        };

        function intersect(r1, r2) {
            return !(r2.left > r1.right ||
                r2.right < r1.left ||
                r2.top > r1.bottom ||
                r2.bottom < r1.top);
        }

        async function initCloud() {
            if (!container) return;

            // Intento seguro de carga de fuentes (con timeout para no bloquear)
            try {
                await Promise.race([
                    document.fonts.ready,
                    new Promise(resolve => setTimeout(resolve, 500))
                ]);
            } catch (e) { }

            container.innerHTML = "";
            loader.style.display = "none";

            // 1. Obtener Ancho Real
            let cw = container.offsetWidth;
            // Fallback: Si offsetWidth es 0, usar wrapper o ventana (menos padding)
            if (cw <= 0 && wrapper) cw = wrapper.offsetWidth;
            if (cw <= 0) cw = Math.min(window.innerWidth - 40, 1000); // Fallback final

            // Si aun así es muy pequeño (rara vez), forzar mínimo
            if (cw < 300) cw = 300;

            // 2. Definir breakpoints
            const isMobile = cw < 500;
            const isTablet = cw >= 500 && cw < 900;

            // 3. Altura Dinámica: Más alto en móvil para que quepan las palabras
            let ch = isMobile ? cw * 1.2 : cw * 0.8; // Menos altura relativa
            if (ch < 300) ch = 300;

            container.style.height = ch + 'px';

            const cx = cw / 2;
            const cy = ch / 2;

            // 4. Factor de Escala
            // 4. Factor de Escala (Aumentado para llenar más espacio)
            let denominator = 550; // Antes 700 - Fuentes más grandes
            if (isTablet) denominator = 750; // Antes 900
            if (isMobile) denominator = 850; // Antes 1000

            let scaleFactor = cw / denominator;
            if (scaleFactor < 0.3) scaleFactor = 0.3; // Mínimo más permisivo

            // Tamaños base
            const fontSizes = {
                'p-1': 100, 'p-2': 60, 'p-3': 45, 'p-4': 32, 'p-5': 24
            };

            const placed = [];

            // Variables para Bounding Box
            let minX = Infinity, maxX = -Infinity;
            let minY = Infinity, maxY = -Infinity;

            // 5. Crear y Medir Elementos
            const elements = words.map((item) => {
                const el = document.createElement('div');
                el.className = `wc-word ${item.cls}`;
                el.textContent = item.text;

                let baseSize = fontSizes[item.cls] || 20;
                let finalSize = Math.floor(baseSize * scaleFactor);
                el.style.fontSize = `${finalSize}px`;

                // Solo permitir verticalidad en Desktop
                let allowVertical = !isMobile && !isTablet;
                if (allowVertical && item.cls !== 'p-1' && Math.random() < 0.3) {
                    el.classList.add('vertical');
                }

                container.appendChild(el);

                // --- AJUSTE DE SEGURIDAD (CRÍTICO) ---
                // Si la palabra es más ancha que el contenedor (común en móviles),
                // reducir la fuente hasta que quepa con un margen.
                let width = el.offsetWidth;
                let safeWidth = cw * 0.95; // 95% del ancho del contenedor

                // Si es vertical, chequeamos altura contra ancho de contenedor (raro, pero posible)
                if (el.classList.contains('vertical')) {
                    if (el.offsetHeight > ch * 0.9) {
                        el.classList.remove('vertical'); // Forzar horizontal si es muy alta
                        width = el.offsetWidth; // Recalcular ancho horizontal
                    }
                }

                // Bucle de reducción de tamaño
                while (width > safeWidth && finalSize > 10) {
                    finalSize -= 2;
                    el.style.fontSize = `${finalSize}px`;
                    width = el.offsetWidth;
                }

                return { el, w: el.offsetWidth, h: el.offsetHeight };
            });

            // 6. Algoritmo de Colocación
            for (let i = 0; i < elements.length; i++) {
                const item = elements[i];
                let angle = Math.random() * 6.28;
                let radius = 0;
                let found = false;
                let maxIter = 2500; // Intentos

                while (maxIter-- > 0) {
                    // Espiral elíptica adaptada al ratio del contenedor
                    const ratio = ch / cw;
                    const x = cx + (radius * Math.cos(angle));
                    const y = cy + (radius * ratio * Math.sin(angle));

                    const left = x - (item.w / 2);
                    const top = y - (item.h / 2);

                    const rect = {
                        left: left - CONFIG.padding,
                        top: top - CONFIG.padding,
                        right: left + item.w + CONFIG.padding,
                        bottom: top + item.h + CONFIG.padding
                    };

                    // Chequeo de límites (Bounds Check)
                    if (rect.left < 0 || rect.top < 0 || rect.right > cw || rect.bottom > ch) {
                        radius += CONFIG.stepRadius;
                        angle += CONFIG.stepAngle;
                        continue;
                    }

                    // Chequeo de colisiones
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

                        // Guardar posición real (sin padding extra del algoritmo)
                        item.x = x - item.w / 2;
                        item.y = y - item.h / 2;

                        placed.push(rect);
                        found = true;

                        // Actualizar Bounding Box global
                        if (item.x < minX) minX = item.x;
                        if (item.x + item.w > maxX) maxX = item.x + item.w;
                        if (item.y < minY) minY = item.y;
                        if (item.y + item.h > maxY) maxY = item.y + item.h;

                        break;
                    }

                    angle += CONFIG.stepAngle;
                    radius += (CONFIG.stepRadius / 10);
                }

                if (!found) {
                    // Si falla, intentamos una última vez en el centro absoluto
                    // Si aún así no cabe, se oculta.
                    console.warn("No se pudo colocar:", item.el.textContent);
                    item.el.style.display = 'none';
                }
            // Pequeña pausa para no bloquear la UI en arrays grandes
                if (i % 3 === 0) await new Promise(r => setTimeout(r, 0));
            }

            // 7. FIT TO CONTENT & ZOOM TO FILL (Eliminar TODO espacio vacío)
            if (minY !== Infinity && maxY !== -Infinity && minX !== Infinity && maxX !== -Infinity) {
                const contentWidth = maxX - minX;
                const contentHeight = maxY - minY;
                
                // 1. Shift words to origin (0,0) with small safe margin
                const safeMargin = 2;
                elements.forEach(item => {
                    if (item.el.style.display !== 'none') {
                        const newLeft = item.x - minX + safeMargin;
                        const newTop = item.y - minY + safeMargin;
                        
                        item.el.style.left = newLeft + 'px';
                        item.el.style.top = newTop + 'px';
                    }
                });

                // 2. Calculate Zoom to fill Width perfectly
                // cw is container width.
                // We want: (contentWidth + margins) * zoom = cw
                // Using 0.999 factor to be almost exact but avoid subpixel rounding overflow
                const totalWidth = contentWidth + (safeMargin * 2);
                const zoom = (cw / totalWidth) * 0.999;
                
                // 3. Apply Zoom and Dimension
                container.style.transformOrigin = '0 0';
                container.style.transform = `scale(${zoom})`;
                container.style.width = totalWidth + 'px'; 
                container.style.height = (contentHeight + (safeMargin * 2)) + 'px'; 
                
                // 4. Adjust Wrapper Height
                // The visual height is what matters for the page flow
                const visualHeight = (contentHeight + (safeMargin * 2)) * zoom;
                if (wrapper) {
                    wrapper.style.height = visualHeight + 'px';
                    wrapper.style.minHeight = 'auto'; // Override CSS min-height
                }
            }

            container.classList.add('visible');
            if (wrapper) wrapper.classList.add('charts-loaded');

            // Animación cascada
            elements.forEach((item, idx) => {
                if (item.el.style.display !== 'none') {
                    setTimeout(() => {
                        item.el.classList.add('visible');
                    }, idx * 30);
                }
            });
        }

        // Observer para iniciar cuando sea visible
        const cloudObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initCloud();
                    cloudObserver.disconnect();
                }
            });
        }, { threshold: 0.1 });

        if (wrapper) {
            cloudObserver.observe(wrapper);
        } else {
            // Fallback de seguridad
            setTimeout(initCloud, 500);
        }

        // Resize eficiente
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                // Solo recargar si el contenedor es visible para ahorrar recursos
                if (container && container.classList.contains('visible')) {
                    initCloud();
                }
            }, 300);
        });

    })();
</script>