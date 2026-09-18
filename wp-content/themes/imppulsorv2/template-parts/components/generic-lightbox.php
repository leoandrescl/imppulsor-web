<?php
/**
 * Generic Lightbox Component for Charts
 * 
 * Provides a universal lightbox wrapper that:
 * 1. Injects "Zoom/Download" buttons into chart wrappers.
 * 2. Captures high-fidelity snapshots of charts using html2canvas.
 * 3. Handles specific layout fixes for Word Cloud, SVG, and Canvas charts.
 */
?>

<!-- HTML Structure -->
<div id="universalLightbox" class="universal-modal">
    <div class="universal-modal-overlay"></div>
    <div class="universal-modal-content">
        <button class="universal-modal-close" aria-label="Close">&times;</button>

        <div id="lightboxLoader" class="lightbox-loader">
            <div class="spinner"></div>
            <p>Generating high-resolution image...</p>
        </div>

        <div class="lightbox-image-container">
            <!-- The snapshot image will be injected here -->
            <img id="lightboxImage" src="" alt="Enlarged chart">
        </div>

        <div class="lightbox-actions">
            <button id="downloadChartBtn" class="action-btn download-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                Download PNG
            </button>
        </div>
    </div>
</div>

<!-- Dependency -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
    /* --- Modal CSS --- */
    .universal-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 100000;
        /* Ultra High Z-Index */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .universal-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .universal-modal-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(5px);
    }

    .universal-modal-content {
        position: relative;
        z-index: 2;
        background: transparent;
        max-width: 95vw;
        max-height: 95vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .universal-modal-close {
        position: absolute;
        top: -40px;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 32px;
        cursor: pointer;
        opacity: 0.8;
    }

    .universal-modal-close:hover {
        opacity: 1;
    }

    .lightbox-image-container {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        background: #fff;
        /* Frame */
        padding: 5px;
    }

    #lightboxImage {
        max-width: 90vw;
        max-height: 85vh;
        /* Leave room for button */
        object-fit: contain;
        display: block;
    }

    .lightbox-actions {
        margin-top: 20px;
    }

    .action-btn {
        padding: 12px 24px;
        background: #126CFB;
        color: white;
        border: none;
        border-radius: 30px;
        font-family: 'Jost', sans-serif;
        font-weight: 500;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(18, 108, 251, 0.4);
    }

    .lightbox-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        gap: 15px;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* --- CHART BUTTONS (NUCLEAR VISIBILITY) --- */
    /* We force these to be visible and correctly positioned on Chart Wrappers */

    .relative-chart-wrapper {
        position: relative !important;
        /* Ensure absolute positioning works */
    }

    .chart-zoom-btn {
        position: absolute !important;
        top: 15px !important;
        right: 15px !important;
        z-index: 9999 !important;
        /* Above EVERYTHING */

        width: 44px;
        height: 44px;
        background: #fff;
        border: 1px solid #d0d0d0;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);

        /* Force Visibility */
        opacity: 0.8;
        transition: opacity 0.3s ease, transform 0.2s ease;
    }

    .chart-zoom-btn:hover {
        opacity: 1 !important;
        transform: scale(1.1);
        border-color: #126CFB;
        box-shadow: 0 6px 16px rgba(18, 108, 251, 0.3);
    }

    .chart-zoom-btn svg {
        stroke: #333;
        width: 22px;
        height: 22px;
        transition: stroke 0.2s;
    }

    .chart-zoom-btn:hover svg {
        stroke: #126CFB;
    }

    /* WORD CLOUD SPECIAL TIMING */
    /* Hide button initially for word cloud until charts are loaded */
    .wordcloud-wrapper .chart-zoom-btn {
        opacity: 0;
        pointer-events: none;
    }

    .wordcloud-wrapper.charts-loaded .chart-zoom-btn {
        opacity: 0.8;
        pointer-events: auto;
    }
</style>

<script>
    (function () {
        // --- MAIN INITIALIZATION ---
        function initLightbox() {
            console.log("Initializing Universal Lightbox...");

            const modal = document.getElementById('universalLightbox');
            const modalImg = document.getElementById('lightboxImage');
            const loader = document.getElementById('lightboxLoader');
            const closeBtn = modal.querySelector('.universal-modal-close');
            const downloadBtn = document.getElementById('downloadChartBtn');
            const overlay = modal.querySelector('.universal-modal-overlay');

            // Close Logic
            const closeModal = () => {
                modal.classList.remove('active');
                setTimeout(() => { modalImg.src = ''; }, 300); // Clear after fade
            };
            closeBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', closeModal);
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });


            // --- INJECTION ENGINE ---
            // Defines the relationship between Wrappers and Content
            const targets = [
                // { wrapper: selector, inner: selector }
                { wrapper: '.dmc-wrapper', inner: '.dmc-container' },
                { wrapper: '.radar-wrapper', inner: '.radar-container' },
                { wrapper: '.igmc-wrapper', inner: '.igmc-chart-area' },
                { wrapper: '.ep-wrapper', inner: '.ep-chart-area' },
                { wrapper: '.niveles-wrapper', inner: '.pyramid-structure-wrapper' },
                { wrapper: '.wordcloud-wrapper', inner: '.wordcloud-container' },
                { wrapper: '.heatmap-wrapper', inner: '.heatmap-container' }
            ];

            targets.forEach(config => {
                const wrappers = document.querySelectorAll(config.wrapper);
                wrappers.forEach(wrapper => {
                    // Verification
                    const innerEl = wrapper.querySelector(config.inner);
                    if (!innerEl) return;

                    // Inject Button into WRAPPER (Safe Zone)
                    if (wrapper.querySelector('.chart-zoom-btn')) return; // Idempotent

                    wrapper.classList.add('relative-chart-wrapper');

                    const btn = document.createElement('button');
                    btn.className = 'chart-zoom-btn';
                    btn.title = "Enlarge and download";
                    btn.innerHTML = `
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <polyline points="9 21 3 21 3 15"></polyline>
                        <line x1="21" y1="3" x2="14" y2="10"></line>
                        <line x1="3" y1="21" x2="10" y2="14"></line>
                    </svg>
                `;

                    // Handle Click
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation(); // Don't trigger chart events
                        openSnapshot(innerEl); // Pass the inner content to capture
                    });

                    wrapper.appendChild(btn);
                });
            });


            // --- SNAPSHOT CORE ---
            async function openSnapshot(element) {
                modal.classList.add('active');
                loader.style.display = 'flex';
                modalImg.style.display = 'none';

                await new Promise(r => setTimeout(r, 100)); // UI Render Breath

                try {
                    if (!window.html2canvas) throw new Error("html2canvas not loaded");

                    // 1. CREATE SANDBOX
                    const sandbox = document.createElement('div');
                    Object.assign(sandbox.style, {
                        position: 'fixed', top: '-10000px', left: '-10000px',
                        width: '2000px', minHeight: '1000px',
                        background: '#ffffff',
                        display: 'flex', justifyContent: 'center', alignItems: 'center',
                        padding: '100px', zIndex: '999'
                    });
                    document.body.appendChild(sandbox);

                    // 2. CLONE & PREPARE
                    let clone;
                    const isWordCloud = element.classList.contains('wordcloud-container');

                    if (isWordCloud) {
                        // *** DEEP FREEZE STRATEGY FOR WORD CLOUD ***
                        clone = element.cloneNode(true);
                        clone.id = ""; // Strip ID

                        // Freeze Container
                        clone.style.width = element.offsetWidth + 'px';
                        clone.style.height = element.offsetHeight + 'px';
                        clone.style.position = 'relative';
                        clone.style.margin = '0 auto';
                        clone.style.background = '#fdfdfd';

                        // Freeze Words (Iterative Computed Style Copy)
                        const originalWords = element.querySelectorAll('.wc-word');
                        const clonedWords = clone.querySelectorAll('.wc-word');
                        originalWords.forEach((orig, i) => {
                            if (clonedWords[i]) {
                                const s = window.getComputedStyle(orig);
                                const d = clonedWords[i];
                                d.style.position = 'absolute';
                                d.style.left = s.left;
                                d.style.top = s.top;
                                d.style.transform = s.transform;
                                d.style.fontSize = s.fontSize;
                                d.style.fontFamily = s.fontFamily;
                                d.style.fontWeight = s.fontWeight;
                                d.style.color = s.color;
                                d.style.lineHeight = s.lineHeight;
                                d.style.margin = '0';
                            }
                        });

                        // Color Boost
                        clone.style.filter = 'saturate(1.3) contrast(1.1)';

                    } else {
                        // *** STANDARD CLONE ***
                        clone = element.cloneNode(true);

                        // Style Cleanup
                        clone.style.transform = 'none';
                        clone.style.margin = '0 auto';
                        clone.style.maxWidth = 'none';
                        clone.style.width = 'fit-content'; // Shrink wrap for canvas
                        clone.style.height = 'auto';

                        // SVG Special Handling (ViewBox Expansion)
                        if (clone.querySelector('svg')) {
                            clone.style.width = '1600px'; // Fixed width for SVGs
                            clone.querySelectorAll('svg').forEach(svg => {
                                svg.style.overflow = 'visible';
                                const vb = svg.getAttribute('viewBox');
                                if (vb) {
                                    const [x, y, w, h] = vb.split(' ').map(Number);
                                    if (!isNaN(x)) {
                                        // +200px Padding Logic
                                        svg.setAttribute('viewBox', `${x - 200} ${y - 200} ${w + 400} ${h + 400}`);
                                    }
                                }
                            });
                        }

                        // Canvas Special Handling (Color Boost)
                        if (clone.querySelector('canvas')) {
                            clone.style.filter = 'saturate(1.3) contrast(1.1)';
                            // Fix Canvas Blanking (Copy Pixels)
                            const origCanvases = element.querySelectorAll('canvas');
                            const clonedCanvases = clone.querySelectorAll('canvas');
                            origCanvases.forEach((oc, i) => {
                                if (clonedCanvases[i]) {
                                    const cc = clonedCanvases[i];
                                    cc.width = oc.width;
                                    cc.height = oc.height;
                                    const ctx = cc.getContext('2d');
                                    ctx.drawImage(oc, 0, 0);
                                }
                            });
                        }
                    }

                    // Remove Garbage
                    clone.querySelectorAll('.block-header, .chart-zoom-btn, .interaction-hint').forEach(el => el.remove());

                    sandbox.appendChild(clone);

                    // 3. CAPTURE
                    const canvas = await html2canvas(sandbox, {
                        scale: 2, // High DPI
                        backgroundColor: '#ffffff',
                        logging: false,
                        useCORS: true,
                        // Ignore tooltips/buttons
                        ignoreElements: (el) => {
                            return el.classList.contains('chart-zoom-btn') ||
                                el.tagName === 'BUTTON' ||
                                el.classList.contains('radar-tooltip-custom');
                        }
                    });

                    // 4. DISPLAY
                    modalImg.src = canvas.toDataURL('image/png');
                    modalImg.style.display = 'block';
                    loader.style.display = 'none';

                    // Cleanup
                    document.body.removeChild(sandbox);


                } catch (error) {
                    console.error("Lightbox Error:", error);
                    alert("Error generating the image.");
                    loader.style.display = 'none';
                    closeModal();
                    const sb = document.querySelector('div[style*="top: -10000px"]');
                    if (sb) document.body.removeChild(sb);
                }
            }


            // --- DOWNLOAD ---
            downloadBtn.addEventListener('click', () => {
                if (modalImg.src) {
                    const a = document.createElement('a');
                    a.download = 'imppulsor-chart.png';
                    a.href = modalImg.src;
                    a.click();
                }
            });

        }

        // Initialize when ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initLightbox);
        } else {
            initLightbox(); // Run immediately if late-loaded
        }

    })();
</script>