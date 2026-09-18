<div class="dmc-grid-wrapper">
    <div class="dmc-grid-container">



        <!-- Header -->
        <div class="dmc-grid-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                data-lucide="search" aria-hidden="true" class="dmc-header-icon lucide lucide-search">
                <path d="m21 21-4.34-4.34"></path>
                <circle cx="11" cy="11" r="8"></circle>
            </svg>
            <h3>Analysis Dimensions</h3>
        </div>

        <!-- Grid -->
        <div class="dmc-grid-matrix">
            <!-- 1. Strategy & Planning -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Strategy &<br>Planning</span>
            </div>

            <!-- 2. Corporate Governance -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Corporate<br>Governance</span>
            </div>

            <!-- 3. Innovation & Adaptability -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Innovation &<br>Adaptability</span>
            </div>

            <!-- 4. Customer Experience -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Customer Experience</span>
            </div>

            <!-- 5. Marketing & Demand Generation -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Marketing &<br>Demand Generation</span>
            </div>

            <!-- 6. Sales Methodology -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Sales Methodology</span>
            </div>

            <!-- 7. Digitalization & AI -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Digitalization & AI</span>
            </div>

            <!-- 8. Monitoring & Analytics -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Monitoring & Analytics</span>
            </div>

            <!-- 9. Operational Efficiency -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Operational Efficiency</span>
            </div>

            <!-- 10. Organizational Structure -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Organizational<br>Structure</span>
            </div>

            <!-- 11. Executive Leadership -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Executive Leadership</span>
            </div>

            <!-- 12. Talent Management -->
            <div class="dmc-grid-card">
                <span class="dmc-card-text">Talent Management</span>
            </div>
        </div>

    </div>
</div>

<style>
    .dmc-grid-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
        font-family: 'Jost', sans-serif;
    }

    .dmc-grid-container {
        width: 100%;
        max-width: 900px;
        position: relative;
        position: relative;
        padding: 15px;
        /* Standardized to 15px */
        /* Tightened padding to match Pyramid look */
        background: #fff;
        border: 1px solid #061c2c;
        /* border: 2px solid #126cfb; */
    }



    /* Header with Glossy Gradient */
    .dmc-grid-header {
        background: #061c2c;
        border: 1px solid #126cfb;
        padding: 15px;
        /* Standardized to 15px */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin-bottom: 5px;
        position: relative;
        overflow: hidden;
        height: 70px;
    }

    .dmc-header-icon {
        width: 32px;
        height: 32px;
        color: #fff;
        flex-shrink: 0;
    }

    /* Shine effect on header */
    /* .dmc-grid-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        pointer-events: none;
    } */

    .dmc-grid-header h3 {
        margin: 0;
        color: #fff;
        font-size: 16px;
        /* Standardized to 16px */
        font-weight: 500;
        /* Bold Medium */
        position: relative;
        z-index: 2;
    }

    .dmc-grid-header h3 span {
        border-bottom: 1px dotted rgba(255, 255, 255, 0.5);
        /* Optional underline style from screenshot hint */
    }

    /* Grid Layout */
    .dmc-grid-matrix {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 5px;
        width: 100%;
    }

    /* Card / Button Style */
    .dmc-grid-card {
        background: #126cfb;
        padding: 10px;
        /* Standardized to 15px */
        height: 70px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease, box-shadow 0.2s ease;
        border: 1px solid #061c2c;
        position: relative;
        overflow: hidden;

        /* Init Animation State */
        opacity: 0;
        opacity: 0;
    }

    .dmc-grid-card.visible {
        opacity: 1;
        opacity: 1;
    }

    /* Inner gloss */
    /* .dmc-grid-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 60%);
        pointer-events: none;
    } */

    .dmc-card-text {
        font-size: 16px;
        /* Standardized to 16px */
        color: #fff;
        font-weight: 300;
        /* Light */
        line-height: 1.3;
        position: relative;
        z-index: 2;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    /* Underline on text inside card (as seen in screenshot) */
    .dmc-card-text span {
        text-decoration: underline;
        text-decoration-style: dotted;
        text-decoration-color: rgba(255, 255, 255, 0.5);
    }

    /* Hover Effect */
    .dmc-grid-card:hover {
        /* transform: translateY(-3px); */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        background: #061c2c;
        border: 1px solid #126cfb;
        /* Brighter on hover */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dmc-grid-matrix {
            grid-template-columns: 1fr 1fr;
            /* Single column on mobile */
        }

        .dmc-grid-header h3 {
            font-size: 20px;
        }

        .dmc-card-text {
            font-size: 16px;
        }
    }
</style>

<script>
    (function () {
        // Staggered Animation for DMC Grid
        const gridMatrix = document.querySelector('.dmc-grid-matrix');
        if (!gridMatrix) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const cards = gridMatrix.querySelectorAll('.dmc-grid-card');
                    cards.forEach((card) => {
                        card.classList.add('visible');
                    });
                    observer.disconnect(); // Run once
                }
            });
        }, {
            threshold: 0.2
        });

        observer.observe(gridMatrix);
    })();
</script>