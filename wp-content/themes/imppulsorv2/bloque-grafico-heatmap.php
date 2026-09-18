<div class="heatmap-container">
    <!-- JS Injected Matrix -->
    <div class="heatmap-matrix" id="heatmapMatrix"></div>

    <!-- Mobile Toggle Button -->
    <div class="heatmap-mobile-toggle">
        <a href="#" class="texto-expandible__toggle mt-10 d-block text-dark" id="heatmapToggleBtn"
            style="text-align: center; text-decoration: underline;">Ver más...</a>
    </div>

    <!-- Legend scale -->
    <div class="heatmap-scale-wrapper">
        <span class="scale-label-text">Nivel de Madurez</span>
        <div class="scale-container">
            <div class="scale-gradient-bar"></div>
            <div class="scale-markers">
                <div class="marker"><span class="tick"></span><span class="number">1.0</span></div>
                <div class="marker"><span class="tick"></span><span class="number">2.0</span></div>
                <div class="marker"><span class="tick"></span><span class="number">3.0</span></div>
                <div class="marker"><span class="tick"></span><span class="number">4.0</span></div>
                <div class="marker"><span class="tick"></span><span class="number">5.0</span></div>
            </div>
        </div>
    </div>
</div>


<style>
    .heatmap-wrapper {
        display: flex;
        justify-content: center;
    }

    .heatmap-wrapper .block-header {
        text-align: left;
        width: 100%;
    }

    .heatmap-wrapper {
        font-family: 'Jost', sans-serif;
    }

    .heatmap-container {
        width: 100%;
        max-width: 100%;
        position: relative;
        /* Standardized to 15px */
        border-radius: 0;
        background: #fff;
    }

    .heatmap-title {
        font-size: 36px;
        font-weight: 500;
        color: #000;
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .heatmap-subtitle {
        font-size: 24px;
        font-weight: 300;
        color: #666;
        margin-bottom: 50px;
    }

    /* Matrix Layout */
    .heatmap-matrix {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        /* Standardized to 15px */
        margin-top: 0px;
    }

    .matrix-group {
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 0;
        /* Slightly tighter radius */
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);

        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.2s ease, box-shadow 0.2s ease;
        /* Exact match to DMC Grid speed/fluidity */
    }

    .matrix-group.visible {
        opacity: 1;
        /* transform: translateY(0); */
    }

    .matrix-group.visible:hover {
        /* transform: translateY(-5px); */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    /* Header Color Change on Card Hover */
    .matrix-group.visible:hover .matrix-dim-header {
        background-color: #126CFB;
        color: #fff;
        border-bottom-color: #126CFB;
    }

    .matrix-dim-header {
        background-color: #061c2c;
        padding: 10px;
        /* Exactly 15px */
        /* Reduced padding */
        font-weight: 500;
        /* Less bold (was 700) */
        font-size: 16px;
        /* Standardised to 16px */
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        line-height: 1.2;
        line-height: 1.2;
        border-bottom: 1px solid #061c2c;
        transition: background 0.3s ease, color 0.3s ease;
        /* Smooth color transition */
        /* Reduced height */
    }

    .matrix-subs-container {
        display: flex;
        flex-direction: column;
    }

    .matrix-sub-row {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        /* Stretch to fill height */
        border-bottom: 1px solid #eee;
        min-height: 38px;
        /* Reduced min-height */
    }

    .matrix-sub-row:last-child {
        border-bottom: none;
    }

    .sub-name {
        padding: 10px;
        /* Exactly 15px */
        /* Compact padding */
        font-size: 16px;
        /* Standardised to 16px */
        color: #444;
        display: flex;
        font-weight: 300;
        /* Light */
        align-items: center;
        width: 100%;
        line-height: 1.2;
    }

    .score-cell {
        width: 60px;
        /* Compact width */
        /* Fixed width for scores */
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: center;
        font-weight: 500;
        /* Standardized weight (was 600) */
        font-size: 16px;
        color: #fff;
        flex-shrink: 0;
    }

    /* Colors - Interpolated from #126CFB (High) to #9CDEFA (Low) */
    .bg-high {
        background: #126CFB;
    }

    /* 4.0 - 5.0 (Electric Blue) */
    .bg-med-high {
        background: #2B7EFF;
    }

    /* 3.7 - 3.9 */
    .bg-med {
        background: #4B91FF;
    }

    /* 3.1 - 3.6 */
    .bg-med-low {
        background: #62A4FE;
    }

    /* 3.0 */
    .bg-low {
        background: #79B7FD;
    }

    /* 2.5 - 2.9 */
    .bg-very-low {
        background: #8DCBFC;
    }

    /* 2.0 - 2.4 */
    .bg-lowest {
        background: #9CDEFA;
    }

    /* < 2.0 (Softest Sky Blue) */

    /* Legend */
    .heatmap-scale-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        /* Align right */
        margin-top: 40px;
    }

    .scale-label-text {
        font-size: 14px;
        color: #888;
        font-weight: 300;
        margin-bottom: 10px;
        margin-right: 2px;
    }

    .scale-container {
        width: 300px;
        position: relative;
    }

    .scale-gradient-bar {
        width: 100%;
        height: 12px;
        background: linear-gradient(to right, #9CDEFA, #126CFB);
        /* Soft Sky Blue to Electric Blue */
        border-radius: 6px;
    }

    .scale-markers {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        margin-top: 8px;
        font-size: 16px;
        /* Standardized to 16px */
        font-weight: 500;
        /* Standardized weight */
        color: #666;
    }

    .marker {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 20px;
    }

    .tick {
        display: none;
        /* No ticks needed for this clean look */
    }

    /* Toggle Button */
    .heatmap-mobile-toggle {
        display: none;
        text-align: center;
        margin-top: 40px;
    }

    @media (max-width: 1200px) {
        .heatmap-matrix {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .heatmap-matrix {
            grid-template-columns: 1fr;
        }

        /* Mobile Collapse Logic */
        .heatmap-matrix.mobile-collapsed .matrix-group:nth-child(n+3) {
            display: none !important;
        }

        .heatmap-mobile-toggle {
            display: block;
        }

        .matrix-dim-header {
            min-height: auto;
            padding: 15px;
        }

        .score-cell {
            width: 60px;
            font-size: 14px;
        }

        .heatmap-scale-wrapper {
            align-items: center;
        }
    }
</style>

<script>
    (function () {
        const data = [
            {
                dim: "Estrategia y Planificación",
                subs: [
                    { name: "Dirección Estratégica", score: 2.7 },
                    { name: "Planificación Comercial", score: 3.8 },
                    { name: "Enfoque a Resultados", score: 2.6 }
                ]
            },
            {
                dim: "Gobernanza Empresarial",
                subs: [
                    { name: "Roles y Estructura", score: 2.6 },
                    { name: "Mecanismos de Gestión", score: 4.2 },
                    { name: "Accountability y Control", score: 3.3 }
                ]
            },
            {
                dim: "Innovación y Adaptabilidad",
                subs: [
                    { name: "Adaptabilidad del Área", score: 3.0 },
                    { name: "Experimentación", score: 2.2 },
                    { name: "Aprendizaje Continuo", score: 2.7 }
                ]
            },
            {
                dim: "Experiencia del Cliente",
                subs: [
                    { name: "Comprensión del Cliente", score: 2.4 },
                    { name: "Procesos de Atención", score: 2.3 },
                    { name: "Voz del Cliente", score: 2.9 }
                ]
            },
            {
                dim: "Marketing y Generación de Demanda",
                subs: [
                    { name: "Posicionamiento y Mensaje", score: 2.2 },
                    { name: "Canales y Tácticas", score: 3.8 },
                    { name: "Gestión de Leads", score: 2.8 }
                ]
            },
            {
                dim: "Metodología Comercial",
                subs: [
                    { name: "Proceso de Ventas", score: 2.8 },
                    { name: "Técnicas y Enfoque", score: 3.0 },
                    { name: "Estandarización", score: 3.9 }
                ]
            },
            {
                dim: "Digitalización, Automatización e IA",
                subs: [
                    { name: "Tecnología Comercial", score: 3.6 },
                    { name: "Automatización", score: 3.6 },
                    { name: "Uso de IA", score: 2.1 }
                ]
            },
            {
                dim: "Monitoreo y Análisis de datos",
                subs: [
                    { name: "Métricas Comerciales", score: 4.3 },
                    { name: "Análisis e Insights", score: 2.9 },
                    { name: "Toma de Decisiones", score: 4.0 }
                ]
            },
            {
                dim: "Eficiencia Operativa",
                subs: [
                    { name: "Flujos y Procesos", score: 4.3 },
                    { name: "Productividad Comercial", score: 3.2 },
                    { name: "Soporte Interno", score: 1.9 }
                ]
            },
            {
                dim: "Organización",
                subs: [
                    { name: "Diseño Estructural", score: 3.3 },
                    { name: "Coordinación y Colaboración", score: 3.2 },
                    { name: "Escalabilidad", score: 3.2 }
                ]
            },
            {
                dim: "Liderazgo",
                subs: [
                    { name: "Cultura, Clientes y Resultados", score: 3.0 },
                    { name: "Liderazgo y Coaching", score: 4.0 },
                    { name: "Propósito y Pertenencia", score: 3.5 }
                ]
            },
            {
                dim: "Gestión del Talento",
                subs: [
                    { name: "Atracción y Reclutamiento", score: 3.1 },
                    { name: "Desarrollo y Capacitación", score: 3.5 },
                    { name: "Evaluación y Retención", score: 2.7 }
                ]
            }
        ];

        function getClassForScore(score) {
            if (score >= 4.0) return 'bg-high';
            if (score >= 3.7) return 'bg-med-high';
            if (score >= 3.1) return 'bg-med';
            if (score >= 3.0) return 'bg-med-low';
            if (score >= 2.5) return 'bg-low';
            if (score >= 2.0) return 'bg-very-low';
            return 'bg-lowest';
        }

        const container = document.getElementById('heatmapMatrix');
        const toggleBtn = document.getElementById('heatmapToggleBtn');
        const toggleContainer = document.querySelector('.heatmap-mobile-toggle');

        // Render Matrix
        if (container) {
            data.forEach((item, index) => {
                const group = document.createElement('div');
                group.className = 'matrix-group';
                group.style.transitionDelay = (index * 100) + 'ms'; // Staggered Animation

                let subsHtml = '';
                item.subs.forEach(sub => {
                    const colorClass = getClassForScore(sub.score);
                    subsHtml += `
                        <div class="matrix-sub-row">
                            <span class="sub-name">${sub.name}</span>
                            <div class="score-cell ${colorClass}">${sub.score.toFixed(1)}</div>
                        </div>
                    `;
                });

                group.innerHTML = `
                    <div class="matrix-dim-header">${item.dim}</div>
                    <div class="matrix-subs-container">
                        ${subsHtml}
                    </div>
                `;

                container.appendChild(group);
            });

            // --- Mobile Toggle Logic ---
            const isMobile = window.matchMedia("(max-width: 768px)").matches;

            if (isMobile) {
                container.classList.add('mobile-collapsed');
                if (toggleContainer) toggleContainer.style.display = 'block';
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    container.classList.toggle('mobile-collapsed');

                    if (container.classList.contains('mobile-collapsed')) {
                        toggleBtn.textContent = "Ver más...";
                    } else {
                        toggleBtn.textContent = "Ver menos...";
                    }
                });
            }


            // Observer for Animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const groups = container.querySelectorAll('.matrix-group');
                        groups.forEach(g => g.classList.add('visible'));

                        // Clear transition delay after entrance animation to prevent hover lag
                        setTimeout(() => {
                            groups.forEach(g => g.style.transitionDelay = '0s');
                        }, 2000);

                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            observer.observe(container);
        }
    })();
</script>