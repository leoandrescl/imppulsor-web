<?php
/**
 * Generar PDF — versión definitiva (contenido real visible sin sidebar)
 * Compatible con campo ACF 'contenido_caso'
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/template.php');

// ===============================
// 1. Validar ID
// ===============================
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    wp_die('ID no válido.');
}

$post_id = intval($_GET['id']);
$post = get_post($post_id);

if (!$post) {
    wp_die('Entrada no encontrada.');
}

// ===============================
// 2. Cargar Dompdf desde el tema
// ===============================
$dompdf_path = get_stylesheet_directory() . '/dompdf/autoload.inc.php';
if (!file_exists($dompdf_path)) {
    wp_die('❌ No se encontró la librería Dompdf en: ' . esc_html($dompdf_path));
}
require_once $dompdf_path;

use Dompdf\Dompdf;
use Dompdf\Options;

// ===============================
// 3. Obtener contenido real
// ===============================
$titulo = get_the_title($post);

// Primero intenta obtener el campo ACF personalizado (usado en tu plantilla)
$contenido = get_field('contenido_caso', $post_id);

// Si no existe, usa el contenido estándar
if (empty($contenido)) {
    $contenido = apply_filters('the_content', $post->post_content);
}

// ===============================
// 4. Construir HTML completo
// ===============================
$html = '
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
body {
  font-family: DejaVu Sans, sans-serif;
  color: #111;
  font-size: 14px;
  line-height: 1.6;
  margin: 40px;
}
h1 {
  color: #004aad;
  font-size: 22px;
  margin-bottom: 20px;
}
.content-body p {
  margin-bottom: 10px;
}
blockquote {
  border-left: 4px solid #004aad;
  margin: 20px 0;
  padding-left: 15px;
  color: #444;
  font-style: italic;
}
.acciones {
  margin-top: 40px;
  font-size: 13px;
  color: #888;
}
.acciones a {
  color: #004aad;
  text-decoration: none;
  margin-right: 15px;
}
</style>
</head>
<body>
<section class="main-content">
  <h1>' . esc_html($titulo) . '</h1>
  <div class="content-body">' . $contenido . '</div>
  <div class="acciones">
    <span>Fuente: ' . esc_url(get_permalink($post)) . '</span>
  </div>
</section>
</body>
</html>
';

// ===============================
// 5. Generar PDF
// ===============================
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// ===============================
// 6. Descargar PDF
// ===============================
$filename = sanitize_title($titulo) . '.pdf';
$dompdf->stream($filename, ['Attachment' => true]);
exit;
