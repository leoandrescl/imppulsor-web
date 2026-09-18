<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!-- Sección: Experiencia internacional -->
<section class="bloque-experiencia fade-in bg-gradiente-insights-casos text-white">
  <div class="container">
    <div class="grid-2 align-center bloque-experiencia__grid py-60 py-40-mob px-0-mob">

      <div class="bloque-experiencia__texto">
        <h2 class="heading-lg">Experiencia internacional</h2>

        <p>
          Nuestra trayectoria se ha construido principalmente en América Latina, donde hemos trabajado con empresas de distintos sectores y niveles de madurez, lo que nos ha permitido desarrollar una comprensión profunda de los desafíos propios de la región.
        </p>
        <p>
          A lo largo del camino hemos sumado hitos relevantes, como proyectos en Miami, que nos aportaron visibilidad internacional y validación frente a ecosistemas de mayor competitividad.
        </p>

        <p class="texto-expandible texto-expandible--oculto">
          Desde nuestra base en Dublín expandimos de manera progresiva nuestra presencia hacia Europa, abriendo oportunidades en mercados como Irlanda y España, y explorando de forma continua nuevas posibilidades de alcance global.
        </p>

        <a href="#" class="texto-expandible__toggle mt-10 d-block text-white">Leer más …</a>
        <a href="/contacto/" class="btn-arrow mt-20 mt-20-mob">Solicite una reunión con nuestros especialistas</a>
      </div>

      <div class="bloque-experiencia__image">
        <img
          src="/wp-content/uploads/bg-experiencia-internacional.png"
          alt="Experiencia internacional"
          class="bloque-experiencia__img w-100"
          loading="lazy"
          decoding="async"
        >
      </div>

    </div>
  </div>
</section>

<style>
  .bloque-experiencia__texto,
  .bloque-experiencia__image {
    min-width: 0;
  }

  .bloque-experiencia__img {
    display: block;
    width: 100%;
    max-width: 100%;
    height: auto;
  }

  @media (max-width: 992px) {
    .bloque-experiencia__image {
      display: none;
    }
  }
</style>
