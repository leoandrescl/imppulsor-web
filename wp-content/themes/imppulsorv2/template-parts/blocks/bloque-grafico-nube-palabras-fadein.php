<div id="wc-wrapper-unique" class="wordcloud-wrapper bg-light">
    <div id="wordcloud-loader" class="wc-loader">Generating word cloud...</div>
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

    /* --- WORDS --- */
    .wc-word {
        position: absolute;
        line-height: 0.85;
        /* Compact line height */
        cursor: pointer;
        user-select: none;
        white-space: nowrap;
        font-family: 'Jost', sans-serif;
        transition: transform 0.3s ease, color 0.3s ease;
        text-align: center;
        z-index: 10;
        transform-origin: center center;
        /* Initially invisible but taking up space for measurement */
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

    /* Hierarchy classes for weight and color */
    .p-1 {
        font-weight: 700;
        color: #126CFB !important;
    }

    /* Blue title */
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
            { text: "LEADERSHIP", cls: "p-1", freq: 100 },
            { text: "CUSTOMERS", cls: "p-2", freq: 90 },
            { text: "TRUST", cls: "p-2", freq: 88 },
            { text: "AUTONOMY", cls: "p-2", freq: 85 },
            { text: "SALES", cls: "p-2", freq: 82 },
            { text: "DISCIPLINE", cls: "p-3", freq: 78 },
            { text: "RISK", cls: "p-3", freq: 75 },
            { text: "MOTIVATION", cls: "p-3", freq: 72 },
            { text: "TRAINING", cls: "p-3", freq: 70 },
            { text: "PROCESSES", cls: "p-3", freq: 68 },
            { text: "REASSURANCE", cls: "p-4", freq: 65 },
            { text: "STANDARDIZATION", cls: "p-4", freq: 62 },
            { text: "EFFICIENCY", cls: "p-4", freq: 60 },
            { text: "GROWTH", cls: "p-4", freq: 58 },
            { text: "CLARITY", cls: "p-4", freq: 55 },
            { text: "PROPOSAL", cls: "p-4", freq: 52 },
            { text: "SCALABILITY", cls: "p-4", freq: 50 },
            { text: "FOLLOW-UP", cls: "p-5", freq: 45 },
            { text: "METRICS", cls: "p-5", freq: 42 },
            { text: "PROFESSIONAL", cls: "p-5", freq: 40 },
            { text: "LIQUIDITY", cls: "p-5", freq: 38 },
            { text: "CULTURE", cls: "p-5", freq: 35 },
            { text: "CLOUD", cls: "p-5", freq: 32 },
            { text: "INTEGRATION", cls: "p-5", freq: 30 },
            { text: "TRANSPARENCY", cls: "p-5", freq: 28 }
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

            // Safe font-loading attempt (with timeout so it never blocks)
            try {
                await Promise.race([
                    document.fonts.ready,
                    new Promise(resolve => setTimeout(resolve, 500))
                ]);
            } catch (e) { }

            container.innerHTML = "";
            loader.style.display = "none";

            // 1. Get Real Width
            let cw = container.offsetWidth;
            // Fallback: If offsetWidth is 0, use wrapper or window (minus padding)
            if (cw <= 0 && wrapper) cw = wrapper.offsetWidth;
            if (cw <= 0) cw = Math.min(window.innerWidth - 40, 1000); // Final fallback

            // If still too small (rare), force a minimum
            if (cw < 300) cw = 300;

            // 2. Define breakpoints
            const isMobile = cw < 500;
            const isTablet = cw >= 500 && cw < 900;

            // 3. Dynamic Height: Taller on mobile so words fit
            let ch = isMobile ? cw * 1.2 : cw * 0.8; // Less relative height
            if (ch < 300) ch = 300;

            container.style.height = ch + 'px';

            const cx = cw / 2;
            const cy = ch / 2;

            // 4. Scale Factor (Increased to fill more space)
            // 4. Scale Factor (Increased to fill more space)
            let denominator = 550; // Previously 700 - Larger fonts
            if (isTablet) denominator = 750; // Previously 900
            if (isMobile) denominator = 850; // Previously 1000

            let scaleFactor = cw / denominator;
            if (scaleFactor < 0.3) scaleFactor = 0.3; // More permissive minimum

            // Base sizes
            const fontSizes = {
                'p-1': 100, 'p-2': 60, 'p-3': 45, 'p-4': 32, 'p-5': 24
            };

            const placed = [];

            // Variables para Bounding Box
            let minX = Infinity, maxX = -Infinity;
            let minY = Infinity, maxY = -Infinity;

            // 5. Create and Measure Elements
            const elements = words.map((item) => {
                const el = document.createElement('div');
                el.className = `wc-word ${item.cls}`;
                el.textContent = item.text;

                let baseSize = fontSizes[item.cls] || 20;
                let finalSize = Math.floor(baseSize * scaleFactor);
                el.style.fontSize = `${finalSize}px`;

                // Only allow vertical orientation on Desktop
                let allowVertical = !isMobile && !isTablet;
                if (allowVertical && item.cls !== 'p-1' && Math.random() < 0.3) {
                    el.classList.add('vertical');
                }

                container.appendChild(el);

                // --- SAFETY FIT (CRITICAL) ---
                // If a word is wider than the container (common on mobile),
                // shrink the font until it fits with a margin.
                let width = el.offsetWidth;
                let safeWidth = cw * 0.95; // 95% of container width

                // If vertical, check height against container width (rare, but possible)
                if (el.classList.contains('vertical')) {
                    if (el.offsetHeight > ch * 0.9) {
                        el.classList.remove('vertical'); // Force horizontal if too tall
                        width = el.offsetWidth; // Recalculate horizontal width
                    }
                }

                // Size-reduction loop
                while (width > safeWidth && finalSize > 10) {
                    finalSize -= 2;
                    el.style.fontSize = `${finalSize}px`;
                    width = el.offsetWidth;
                }

                return { el, w: el.offsetWidth, h: el.offsetHeight };
            });

            // 6. Placement Algorithm
            for (let i = 0; i < elements.length; i++) {
                const item = elements[i];
                let angle = Math.random() * 6.28;
                let radius = 0;
                let found = false;
                let maxIter = 2500; // Attempts

                while (maxIter-- > 0) {
                    // Elliptical spiral adapted to the container ratio
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

                    // Bounds Check
                    if (rect.left < 0 || rect.top < 0 || rect.right > cw || rect.bottom > ch) {
                        radius += CONFIG.stepRadius;
                        angle += CONFIG.stepAngle;
                        continue;
                    }

                    // Collision check
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

                        // Save real position (without extra algorithm padding)
                        item.x = x - item.w / 2;
                        item.y = y - item.h / 2;

                        placed.push(rect);
                        found = true;

                        // Update global Bounding Box
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
                    // If placement fails, try one last time at the absolute center
                    // If it still does not fit, hide it.
                    console.warn("Could not place:", item.el.textContent);
                    item.el.style.display = 'none';
                }
            // Small pause to avoid blocking the UI on large arrays
                if (i % 3 === 0) await new Promise(r => setTimeout(r, 0));
            }

            // 7. FIT TO CONTENT & ZOOM TO FILL (Remove ALL empty space)
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

            // Cascade animation
            elements.forEach((item, idx) => {
                if (item.el.style.display !== 'none') {
                    setTimeout(() => {
                        item.el.classList.add('visible');
                    }, idx * 30);
                }
            });
        }

        // Observer to start when visible
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
            // Safety fallback
            setTimeout(initCloud, 500);
        }

        // Efficient resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                // Only reload if the container is visible to save resources
                if (container && container.classList.contains('visible')) {
                    initCloud();
                }
            }, 300);
        });

    })();
</script>