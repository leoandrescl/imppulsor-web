<div class="heatmap-v2-wrapper bg-light">
    <div class="heatmap-v2-container">
        <div class="block-header">
            <h2>Subdimensional Matrix of Commercial Maturity Drivers and Inhibitors</h2>
            <h3>Commercial Maturity Diagnostic</h3>
        </div>

        <div class="heatmap-v2-grid" id="heatmapMatrixV2">
            <!-- Headers -->
            <div class="grid-header">Dimension</div>
            <div class="grid-header">Subdimensions</div>
            <div class="grid-header">Score</div>
            <div class="grid-header">Subdimensions</div>
            <div class="grid-header">Score</div>
            <div class="grid-header">Subdimensions</div>
            <div class="grid-header">Score</div>

            <!-- JavaScript will render rows here -->
        </div>

        <!-- Legend scale -->
        <div class="heatmap-scale-wrapper">
            <span class="scale-label-text">Level</span>
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
            { dim: "Strategy & Planning", subs: [{ name: "Strategic Direction", score: 2.7 }, { name: "Sales Planning", score: 3.8 }, { name: "Results Orientation", score: 2.6 }] },
            { dim: "Corporate Governance", subs: [{ name: "Roles & Structure", score: 2.6 }, { name: "Management Mechanisms", score: 4.2 }, { name: "Accountability & Control", score: 3.3 }] },
            { dim: "Innovation & Adaptability", subs: [{ name: "Team Adaptability", score: 3.0 }, { name: "Experimentation", score: 2.2 }, { name: "Continuous Learning", score: 2.7 }] },
            { dim: "Customer Experience", subs: [{ name: "Customer Understanding", score: 2.4 }, { name: "Service Processes", score: 2.3 }, { name: "Voice of the Customer", score: 2.9 }] },
            { dim: "Marketing & Demand Generation", subs: [{ name: "Positioning & Messaging", score: 2.2 }, { name: "Channels & Tactics", score: 3.8 }, { name: "Lead Management", score: 2.8 }] },
            { dim: "Sales Methodology", subs: [{ name: "Sales Process", score: 2.8 }, { name: "Techniques & Approach", score: 3.0 }, { name: "Standardization", score: 3.9 }] },
            { dim: "Digitalization, Automation & AI", subs: [{ name: "Sales Technology", score: 3.6 }, { name: "Automation", score: 3.6 }, { name: "AI Adoption", score: 2.1 }] },
            { dim: "Monitoring & Data Analytics", subs: [{ name: "Sales Metrics", score: 4.3 }, { name: "Analysis & Insights", score: 2.9 }, { name: "Decision-Making", score: 4.0 }] },
            { dim: "Operational Efficiency", subs: [{ name: "Workflows & Processes", score: 4.3 }, { name: "Sales Productivity", score: 3.2 }, { name: "Internal Support", score: 1.9 }] },
            { dim: "Organization", subs: [{ name: "Structural Design", score: 3.3 }, { name: "Coordination & Collaboration", score: 3.2 }, { name: "Scalability", score: 3.2 }] },
            { dim: "Leadership", subs: [{ name: "Culture, Customers & Results", score: 3.0 }, { name: "Leadership & Coaching", score: 4.0 }, { name: "Purpose & Belonging", score: 3.5 }] },
            { dim: "Talent Management", subs: [{ name: "Attraction & Recruitment", score: 3.1 }, { name: "Development & Training", score: 3.5 }, { name: "Evaluation & Retention", score: 2.7 }] }
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