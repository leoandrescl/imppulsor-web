<div class="heatmap-v2-wrapper bg-light">
    <div class="heatmap-v2-container">
        <div class="block-header">
            <h2>Matriz Subdimensional de Impulsores e Inhibidores de Madurez Comercial</h2>
            <h3>Diagnóstico de Madurez Comercial</h3>
        </div>

        <div class="heatmap-v2-grid" id="heatmapMatrixV2">
            <!-- Headers -->
            <div class="grid-header">Dimensión</div>
            <div class="grid-header">Subdimensiones</div>
            <div class="grid-header">Puntaje</div>
            <div class="grid-header">Subdimensiones</div>
            <div class="grid-header">Puntaje</div>
            <div class="grid-header">Subdimensiones</div>
            <div class="grid-header">Puntaje</div>

            <!-- JavaScript will render rows here -->
        </div>

        <!-- Legend scale -->
        <div class="heatmap-scale-wrapper">
            <span class="scale-label-text">Nivel</span>
            <div class="scale-container">
                <div class="scale-gradient-bar"></div>
                <div class="scale-markers">
                    <div class="marker"><span class="number">5.0</span></div>
                    <div class="marker"><span class="number">4.0</span></div>
                    <div class="marker"><span class="number">3.0</span></div>
                    <div class="marker"><span class="number">2.0</span></div>
                    <div class="marker"><span class="number">1.0</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .heatmap-v2-wrapper {
        padding: 20px;
        background: #fff;
        font-family: 'Jost', sans-serif;
        display: flex;
        justify-content: center;
    }

    .heatmap-v2-container {
        width: 100%;
        max-width: 100%;
    }

    .heatmap-title {
        font-size: 32px;
        font-weight: 500;
        margin-bottom: 5px;
        color: #000;
    }

    .heatmap-subtitle {
        font-size: 20px;
        color: #666;
        margin-bottom: 40px;
        font-weight: 300;
    }

    /* Grid Layout */
    .heatmap-v2-grid {
        display: grid;
        /* 7 Columns: Dim | Sub | Score | Sub | Score | Sub | Score */
        grid-template-columns: 1.5fr 1.5fr 60px 1.5fr 60px 1.5fr 60px;
        border: 1px solid #ddd;
    }

    .grid-header {
        background-color: #fff;
        font-weight: 700;
        color: #000;
        padding: 15px;
        border-bottom: 1px solid #000;
        /* Strong header border */
        border-right: 1px solid #eee;
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .grid-header:last-child {
        border-right: none;
    }

    /* Rows */
    .grid-cell {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        border-right: 1px solid #eee;
        font-size: 14px;
        color: #444;
        display: flex;
        align-items: center;
        background: #fff;
    }

    .grid-cell-dim {
        color: #333;
        font-weight: 400;
        /* Regular as per screenshot */
    }

    .grid-cell-score {
        justify-content: center;
        color: #fff;
        font-weight: 600;
        padding: 0;
        /* Full fill */
    }

    /* Colors using exact scale */
    .bg-high {
        background: #0b5ed7 !important;
    }

    /* 4.0 - 5.0 */
    .bg-med-high {
        background: #1a73e8 !important;
    }

    /* 3.7 - 3.9 */
    .bg-med {
        background: #3fa2f7 !important;
    }

    /* 3.1 - 3.6 */
    .bg-med-low {
        background: #62b5fa !important;
    }

    /* 3.0 */
    .bg-low {
        background: #8ecbff !important;
    }

    /* 2.5 - 2.9 */
    .bg-very-low {
        background: #b0dcff !important;
    }

    /* 2.0 - 2.4 */
    .bg-lowest {
        background: #d0ebff !important;
    }

    /* < 2.0 */

    /* Legend */
    .heatmap-scale-wrapper {
        display: flex;
        justify-content: center;
        /* Centered in V2 */
        align-items: center;
        margin-top: 40px;
        gap: 20px;
    }

    .scale-label-text {
        font-size: 16px;
        color: #444;
    }

    .scale-container {
        width: 500px;
        max-width: 100%;
        position: relative;
    }

    .scale-gradient-bar {
        width: 100%;
        height: 24px;
        /* Reversed Gradient: Dark (5.0) Left -> Light (1.0) Right */
        background: linear-gradient(to right, #0b5ed7, #d0ebff);
        border: none;
    }

    .scale-markers {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
        font-size: 14px;
        color: #666;
    }

    @media (max-width: 1024px) {
        .heatmap-v2-grid {
            /* Scrollable on tablet */
            display: grid;
            overflow-x: auto;
            min-width: 900px;
        }

        .heatmap-v2-container {
            overflow-x: auto;
        }
    }

    @media (max-width: 768px) {
        .heatmap-v2-wrapper {
            display: none !important;
        }
    }
</style>

<script>
    (function () {
        const data = [
            { dim: "Estrategia y Planificación", subs: [{ name: "Dirección Estratégica", score: 2.7 }, { name: "Planificación Comercial", score: 3.8 }, { name: "Enfoque a Resultados", score: 2.6 }] },
            { dim: "Gobernanza Empresarial", subs: [{ name: "Roles y Estructura", score: 2.6 }, { name: "Mecanismos de Gestión", score: 4.2 }, { name: "Accountability y Control", score: 3.3 }] },
            { dim: "Innovación y Adaptabilidad", subs: [{ name: "Adaptabilidad del Área", score: 3.0 }, { name: "Experimentación", score: 2.2 }, { name: "Aprendizaje Continuo", score: 2.7 }] },
            { dim: "Experiencia del Cliente", subs: [{ name: "Comprensión del Cliente", score: 2.4 }, { name: "Procesos de Atención", score: 2.3 }, { name: "Voz del Cliente", score: 2.9 }] },
            { dim: "Marketing y Generación de Demanda", subs: [{ name: "Posicionamiento y Mensaje", score: 2.2 }, { name: "Canales y Tácticas", score: 3.8 }, { name: "Gestión de Leads", score: 2.8 }] },
            { dim: "Metodología Comercial", subs: [{ name: "Proceso de Ventas", score: 2.8 }, { name: "Técnicas y Enfoque", score: 3.0 }, { name: "Estandarización", score: 3.9 }] },
            { dim: "Digitalización, Automatización e IA", subs: [{ name: "Tecnología Comercial", score: 3.6 }, { name: "Automatización", score: 3.6 }, { name: "Uso de IA", score: 2.1 }] },
            { dim: "Monitoreo y Análisis de datos", subs: [{ name: "Métricas Comerciales", score: 4.3 }, { name: "Análisis e Insights", score: 2.9 }, { name: "Toma de Decisiones", score: 4.0 }] },
            { dim: "Eficiencia Operativa", subs: [{ name: "Flujos y Procesos", score: 4.3 }, { name: "Productividad Comercial", score: 3.2 }, { name: "Soporte Interno", score: 1.9 }] },
            { dim: "Organización", subs: [{ name: "Diseño Estructural", score: 3.3 }, { name: "Coordinación y Colaboración", score: 3.2 }, { name: "Escalabilidad", score: 3.2 }] },
            { dim: "Liderazgo", subs: [{ name: "Cultura, Clientes y Resultados", score: 3.0 }, { name: "Liderazgo y Coaching", score: 4.0 }, { name: "Propósito y Pertenencia", score: 3.5 }] },
            { dim: "Gestión del Talento", subs: [{ name: "Atracción y Reclutamiento", score: 3.1 }, { name: "Desarrollo y Capacitación", score: 3.5 }, { name: "Evaluación y Retención", score: 2.7 }] }
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

        const container = document.getElementById('heatmapMatrixV2');
        if (container) {
            data.forEach(item => {
                // Dim Cell
                const dimCell = document.createElement('div');
                dimCell.className = 'grid-cell grid-cell-dim';
                dimCell.textContent = item.dim;
                container.appendChild(dimCell);

                // Subs
                item.subs.forEach(sub => {
                    const nameCell = document.createElement('div');
                    nameCell.className = 'grid-cell';
                    nameCell.textContent = sub.name;
                    container.appendChild(nameCell);

                    const scoreCell = document.createElement('div');
                    scoreCell.className = 'grid-cell grid-cell-score ' + getClassForScore(sub.score);
                    scoreCell.textContent = sub.score.toFixed(1);
                    container.appendChild(scoreCell);
                });
            });
        }
    })();
</script>