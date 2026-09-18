<div class="niveles-wrapper bg-light">
    <div class="niveles-container">

        <div class="pyramid-display">
            <div class="pyramid-structure-wrapper">

                <svg class="pyramid-border-svg" viewBox="0 0 640 550" preserveAspectRatio="none">
                    <polygon points="320,3 3,547 637,547" fill="none" stroke="#061c2c" stroke-width="1" />
                </svg>

                <div class="pyramid-bg"></div>

                <div class="levels-stack">

                    <div class="level-row level-excelencia" onclick="">
                        <div class="level-icon-col">
                            <div class="level-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 6l-9.5 9.5-5-5L1 18" />
                                    <path d="M17 6h6v6" />
                                </svg>
                            </div>
                        </div>
                        <div class="level-content-col">
                            <div class="level-label">
                                <svg class="label-bg-shape" viewBox="0 0 300 64" preserveAspectRatio="none">
                                    <path d="M0,0 L270,0 L300,32 L270,64 L0,64 Z" vector-effect="non-scaling-stroke" />
                                </svg>
                                <span class="label-text">Excellence Level</span>
                            </div>
                        </div>
                    </div>

                    <div class="level-row level-avanzado" onclick="">
                        <div class="level-icon-col">
                            <div class="level-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="18" cy="5" r="3" />
                                    <circle cx="6" cy="12" r="3" />
                                    <circle cx="18" cy="19" r="3" />
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                                </svg>
                            </div>
                        </div>
                        <div class="level-content-col">
                            <div class="level-label">
                                <svg class="label-bg-shape" viewBox="0 0 300 64" preserveAspectRatio="none">
                                    <path d="M0,0 L270,0 L300,32 L270,64 L0,64 Z" vector-effect="non-scaling-stroke" />
                                </svg>
                                <span class="label-text">Advanced Level</span>
                            </div>
                        </div>
                    </div>

                    <div class="level-row level-intermedio" onclick="">
                        <div class="level-icon-col">
                            <div class="level-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                                </svg>
                            </div>
                        </div>
                        <div class="level-content-col">
                            <div class="level-label">
                                <svg class="label-bg-shape" viewBox="0 0 300 64" preserveAspectRatio="none">
                                    <path d="M0,0 L270,0 L300,32 L270,64 L0,64 Z" vector-effect="non-scaling-stroke" />
                                </svg>
                                <span class="label-text">Intermediate Level</span>
                            </div>
                        </div>
                    </div>

                    <div class="level-row level-inicial" onclick="">
                        <div class="level-icon-col">
                            <div class="level-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                                    <path
                                        d="M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                                    <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
                                    <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                                </svg>
                            </div>
                        </div>
                        <div class="level-content-col">
                            <div class="level-label">
                                <svg class="label-bg-shape" viewBox="0 0 300 64" preserveAspectRatio="none">
                                    <path d="M0,0 L270,0 L300,32 L270,64 L0,64 Z" vector-effect="non-scaling-stroke" />
                                </svg>
                                <span class="label-text">Foundational Level</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* --- Global Variables --- */
    :root {
        /* ONLY THE TWO BRAND COLORS */
        --pyr-blue-light: #126CFB;
        /* Light Blue */
        --pyr-blue-dark: #061c2c;
        /* Dark Blue */
    }

    .niveles-wrapper {
        display: flex;
        justify-content: center;
        position: relative;
        overflow: visible;
    }

    .niveles-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .niveles-mobile-hint {
        display: none;
        font-size: 14px;
        color: #555;
        background: #f0f4ff;
        border: 1px solid #d0e1fd;
        padding: 8px 16px;
        border-radius: 20px;
        margin-bottom: 20px;
        align-items: center;
    }

    .pyramid-display {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    /* Fixed Geometry Container */
    .pyramid-structure-wrapper {
        position: relative;
        width: 100%;
        max-width: 640px;
        aspect-ratio: 640 / 550;
        overflow: visible;
    }

    /* Outer Border Triangle */
    .pyramid-border-svg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        overflow: visible;
        opacity: 0;
        animation: fadeInPyramid 1.5s ease-out forwards;
    }

    /* Dark Pyramid Background + Divider Lines */
    .pyramid-bg {
        position: absolute;
        top: 24px;
        left: 30px;
        width: calc(100% - 60px);
        height: calc(100% - 40px);

        /* 1. Solid Dark Blue base background */
        background-color: var(--pyr-blue-dark);

        /* 2. White divider lines drawn with gradient */
        /* This creates 2px lines at 25%, 50% and 75% of the height */
        background-image: linear-gradient(to bottom,
                transparent 25%,
                #ffffff 25%,
                #ffffff calc(25% + 2px),
                transparent calc(25% + 2px),

                transparent 50%,
                #ffffff 50%,
                #ffffff calc(50% + 2px),
                transparent calc(50% + 2px),

                transparent 75%,
                #ffffff 75%,
                #ffffff calc(75% + 2px),
                transparent calc(75% + 2px));

        /* Triangle clip (will crop the lines perfectly) */
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        z-index: 1;
        opacity: 0;
        animation: fadeInPyramid 1.5s ease-out forwards;
    }

    @keyframes fadeInPyramid {
        to {
            opacity: 1;
        }
    }

    /* Levels Container */
    .levels-stack {
        position: absolute;
        top: 24px;
        left: 30px;
        width: calc(100% - 60px);
        height: calc(100% - 40px);
        z-index: 5;
        display: flex;
        flex-direction: column;
    }

    /* INDIVIDUAL ROW */
    .level-row {
        flex: 1;
        width: 100%;
        display: flex;
        align-items: center;
        position: relative;
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.5s ease-out forwards;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .level-inicial {
        animation-delay: 0.5s;
    }

    .level-intermedio {
        animation-delay: 0.7s;
    }

    .level-avanzado {
        animation-delay: 0.9s;
    }

    .level-excelencia {
        animation-delay: 1.1s;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ROW HOVER STATE */
    .level-row:hover {
        z-index: 100;
        transform: scale(1.02);
    }

    /* Layout Columns */
    .level-icon-col {
        width: 50%;
        display: flex;
        justify-content: flex-end;
        padding-right: 0;
        position: relative;
    }

    .level-content-col {
        width: 50%;
        display: flex;
        justify-content: flex-start;
        padding-left: 0;
        position: relative;
    }

    /* --- ICON (CIRCLE) --- */
    .level-icon {
        width: 64px;
        height: 64px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 20;
        transform: translateX(50%);
        margin-right: 0;
        /* Initial border: 1px Dark Blue */
        border: 1px solid var(--pyr-blue-dark);
        color: var(--pyr-blue-dark);
        transition: all 0.3s ease;
    }

    .level-icon svg {
        width: 30px;
        height: 30px;
    }

    /* Icon Hover Effect */
    .level-row:hover .level-icon {
        /* Hover border: 1px Light Blue */
        border-color: var(--pyr-blue-light);
        /* Icon color: Light Blue */
        color: var(--pyr-blue-light);
        /* Subtle light-blue shadow for emphasis */
        box-shadow: 0 0 10px rgba(18, 108, 251, 0.3);
    }

    /* --- LABEL (ARROW) --- */
    .level-label {
        position: relative;
        height: 64px;
        min-width: 180px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding-left: 40px;
        margin-left: 0px;
        z-index: 10;
    }

    /* Label SVG background */
    .label-bg-shape {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: visible;
    }

    .label-bg-shape path {
        fill: var(--pyr-blue-light);
        /* Normal color: Light Blue */
        stroke: transparent;
        stroke-width: 0;
        transition: all 0.3s ease;
    }

    .label-text {
        color: #fff;
        font-weight: 500;
        font-size: 16px;
        position: relative;
        z-index: 2;
        pointer-events: none;
    }

    /* Label Hover Effect */
    .level-row:hover .label-bg-shape path {
        fill: var(--pyr-blue-dark);
        /* Background switches to Dark Blue */
        stroke: var(--pyr-blue-light);
        /* Border becomes Light Blue */
        stroke-width: 1px;
        /* EXACT 1px weight */
    }


    /* --- Mobile Styles --- */
    @media (max-width: 768px) {
        .niveles-mobile-hint {
            display: none !important;
        }

        .pyramid-structure-wrapper {
            width: 100%;
            max-width: 100%;
            height: auto;
            aspect-ratio: 640 / 550;
            margin: 0 auto;
        }

        /* Restore Desktop Layout Structure */
        .level-content-col {
            display: flex;
            width: 50%;
        }

        .level-icon-col {
            width: 50%;
            justify-content: flex-end;
        }

        /* Scale down components */
        .level-icon {
            width: 44px;
            height: 44px;
            transform: translateX(50%);
        }

        .level-icon svg {
            width: 20px;
            height: 20px;
        }

        .level-label {
            height: 44px;
            /* Matches icon */
            min-width: 130px;
            padding-left: 25px;
        }

        .label-text {
            font-size: 13px;
        }

        .level-row:hover .level-icon {
            transform: translateX(50%) scale(1.02);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    const bg = entry.target.querySelector('.pyramid-bg');
                    if (bg) bg.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        const container = document.querySelector('.niveles-wrapper');
        if (container) observer.observe(container);
    });
</script>