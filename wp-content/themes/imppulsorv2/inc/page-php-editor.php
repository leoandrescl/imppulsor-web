<?php
/**
 * Editor PHP por página (solo post_type=page).
 *
 * Agrega en "Editar página" un metabox que detecta el archivo PHP que
 * realmente renderiza esa página y permite verlo/editarlo/guardarlo
 * sin modificar la forma en que están construidas las páginas.
 *
 * Solo admin: add_meta_boxes + admin_enqueue_scripts + wp_ajax.
 * Sin hooks de front (no toca template_redirect, wp_head, the_content, etc.).
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Resuelve el archivo PHP que renderiza una página según la jerarquía
 * real de WordPress para este tema (hijo imppulsorv2 + padre generatepress).
 *
 * Orden: plantilla asignada (_wp_page_template) → front-page.php si es
 * portada estática → page-{slug}.php → page-{ID}.php → fallback (page.php
 * del hijo/padre, etc.).
 *
 * @param int  $post_id       ID de la página.
 * @param bool $with_shared   Si true, calcula qué otras páginas usan el mismo archivo.
 * @return array {found, path, relative, in_child, editable, method, method_label, reason, shared_with}
 */
function imppulsor_page_php_resolve($post_id, $with_shared = true) {
    $post_id = (int) $post_id;
    $result = [
        'found'       => false,
        'path'        => '',
        'relative'    => '',
        'in_child'    => false,
        'editable'    => false,
        'method'      => '',
        'method_label'=> '',
        'reason'      => '',
        'shared_with' => [],
    ];

    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'page') {
        $result['reason'] = 'Solo disponible para páginas (post_type=page).';
        return $result;
    }

    $child_dir  = wp_normalize_path(get_stylesheet_directory());
    $method = '';
    $candidate = '';

    // 1) Plantilla asignada explícitamente desde WordPress.
    $assigned = get_page_template_slug($post_id);
    if (!empty($assigned)) {
        $assigned_path = wp_normalize_path($child_dir . '/' . ltrim($assigned, '/'));
        if (file_exists($assigned_path) && is_file($assigned_path)) {
            $method = 'plantilla-asignada';
            $candidate = $assigned_path;
        } else {
            // Existe asignada pero el archivo ya no está en el tema hijo
            // (puede estar en el padre o haber sido borrado): se sigue
            // buscando por jerarquía, pero se informa abajo.
            $parent_try = wp_normalize_path(get_template_directory() . '/' . ltrim($assigned, '/'));
            if (file_exists($parent_try)) {
                $result['found']      = true;
                $result['path']       = $parent_try;
                $result['relative']   = ltrim($assigned, '/') . ' (tema padre)';
                $result['in_child']   = false;
                $result['editable']   = false;
                $result['method']     = 'plantilla-asignada-padre';
                $result['method_label'] = 'Plantilla asignada en el tema padre (no editable desde aquí)';
                $result['reason']     = 'El archivo está en el tema padre GeneratePress. Duplícalo al tema hijo si necesitas personalizarlo.';
                return $result;
            }
        }
    }

    // 2) Portada estática → front-page.php del hijo.
    if ($candidate === '') {
        if (get_option('show_on_front') === 'page' && (int) get_option('page_on_front') === $post_id) {
            $front = $child_dir . '/front-page.php';
            if (file_exists($front)) {
                $method = 'portada';
                $candidate = $front;
            }
        }
    }

    // 3) Jerarquía page-{slug}.php / page-{ID}.php en el hijo.
    if ($candidate === '') {
        $slug = get_post_field('post_name', $post_id);
        $tried = [];
        if (!empty($slug)) {
            $tried[] = 'page-' . $slug . '.php';
        }
        $tried[] = 'page-' . $post_id . '.php';
        foreach ($tried as $file) {
            $try = $child_dir . '/' . $file;
            if (file_exists($try) && is_file($try)) {
                $method = ($file === 'page-' . $post_id . '.php') ? 'id' : 'slug';
                $candidate = $try;
                break;
            }
        }
    }

    // 4) Fallback: lo que WordPress usaría (page.php hijo → padre → index).
    if ($candidate === '') {
        $fallback = locate_template(['page.php', 'singular.php', 'index.php'], false, false);
        if (!empty($fallback)) {
            $result['found']        = true;
            $result['path']         = wp_normalize_path($fallback);
            $result['in_child']     = strpos(wp_normalize_path($fallback), $child_dir . '/') === 0;
            $result['relative']     = $result['in_child']
                ? substr(wp_normalize_path($fallback), strlen($child_dir) + 1)
                : basename($fallback) . ' (tema padre)';
            $result['method']       = 'fallback';
            $result['method_label'] = 'Fallback de jerarquía (la página no tiene archivo propio)';
            if ($result['in_child']) {
                $result['editable'] = true;
            } else {
                $result['editable'] = false;
                $result['reason']   = 'Esta página usa una plantilla genérica del tema padre. Para personalizarla, crea un page-{slug}.php en el tema hijo.';
            }
            if ($with_shared && $result['found']) {
                $result['shared_with'] = imppulsor_page_php_shared_with($post_id, $result['path']);
            }
            return $result;
        }
        $result['reason'] = 'No se encontró ningún archivo PHP para esta página.';
        return $result;
    }

    $candidate = wp_normalize_path($candidate);
    $result['found']    = true;
    $result['path']     = $candidate;
    $result['in_child'] = strpos($candidate, $child_dir . '/') === 0;
    $result['relative'] = $result['in_child'] ? substr($candidate, strlen($child_dir) + 1) : basename($candidate);
    $result['method']   = $method;

    $labels = [
        'plantilla-asignada' => 'Plantilla asignada desde WordPress (Atributos de página)',
        'portada'            => 'Portada estática (front-page.php)',
        'slug'               => 'Archivo por slug (page-{slug}.php), sin plantilla asignada',
        'id'                 => 'Archivo por ID (page-{ID}.php), sin plantilla asignada',
    ];
    $result['method_label'] = isset($labels[$method]) ? $labels[$method] : $method;
    $result['editable'] = $result['in_child'];

    if (!$result['editable']) {
        $result['reason'] = 'El archivo no está en el tema hijo.';
    }

    if ($with_shared) {
        $result['shared_with'] = imppulsor_page_php_shared_with($post_id, $candidate);
    }

    return $result;
}

/**
 * Busca otras páginas (post_type=page, sin papelera) que resuelvan
 * al mismo archivo PHP. Sirve para advertir antes de guardar.
 *
 * @param int    $post_id ID actual (se excluye).
 * @param string $path    Ruta absoluta ya resuelta.
 * @return array Lista de ['ID','title','edit_link'] (máx. 50).
 */
function imppulsor_page_php_shared_with($post_id, $path) {
    $post_id = (int) $post_id;
    $target = wp_normalize_path((string) $path);
    if ($target === '') {
        return [];
    }

    $ids = get_posts([
        'post_type'      => 'page',
        'post_status'    => ['publish', 'draft', 'pending', 'private', 'future'],
        'posts_per_page' => 200,
        'fields'         => 'ids',
        'no_found_rows'  => true,
        'post__not_in'   => [$post_id],
    ]);

    $shared = [];
    foreach ((array) $ids as $id) {
        $r = imppulsor_page_php_resolve((int) $id, false);
        if (!empty($r['found']) && wp_normalize_path((string) $r['path']) === $target) {
            $shared[] = [
                'ID'        => (int) $id,
                'title'     => get_the_title((int) $id),
                'edit_link' => get_edit_post_link((int) $id, 'raw'),
            ];
            if (count($shared) >= 50) {
                break;
            }
        }
    }

    return $shared;
}

/**
 * Registra el metabox solo en páginas.
 */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'imppulsor-page-php',
        'Archivo PHP de esta página',
        'imppulsor_page_php_metabox',
        'page',
        'normal',
        'high'
    );
});

/**
 * Render del metabox: muestra archivo detectado, advertencias y editor.
 *
 * @param WP_Post $post
 */
function imppulsor_page_php_metabox($post) {
    if (!($post instanceof WP_Post) || $post->post_type !== 'page') {
        return;
    }

    // Si la edición de archivos está bloqueada a nivel WP, no se ofrece guardar.
    if (defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT) {
        echo '<p><strong>La edición de archivos está desactivada</strong> en este sitio (<code>DISALLOW_FILE_EDIT</code>). Pide al administrador que la habilite para usar este editor.</p>';
        return;
    }

    if (!current_user_can('edit_pages') || !current_user_can('edit_theme_options') || !current_user_can('edit_page', $post->ID)) {
        echo '<p>No tienes permisos para editar archivos del tema. Se requiere <code>edit_pages</code> y <code>edit_theme_options</code>.</p>';
        return;
    }

    // Página nueva sin guardar: aún no hay slug/ID estable para resolver.
    if (empty($post->ID) || $post->post_status === 'auto-draft') {
        echo '<p>Guarda la página primero (borrador o publicar) para detectar su archivo PHP.</p>';
        return;
    }

    $resolved = imppulsor_page_php_resolve($post->ID, true);

    if (empty($resolved['found'])) {
        echo '<p>No se encontró archivo PHP para esta página. ' . esc_html(!empty($resolved['reason']) ? $resolved['reason'] : '') . '</p>';
        return;
    }

    if (empty($resolved['editable'])) {
        echo '<p><strong>Archivo detectado:</strong> <code>' . esc_html($resolved['relative']) . '</code></p>';
        echo '<p>' . esc_html($resolved['method_label']) . '.</p>';
        echo '<p>' . esc_html(!empty($resolved['reason']) ? $resolved['reason'] : 'No editable desde aquí.') . '</p>';
        return;
    }

    $code = file_get_contents($resolved['path']);
    if ($code === false) {
        echo '<p>No se pudo leer el archivo <code>' . esc_html($resolved['relative']) . '</code>. Revisa permisos en el servidor.</p>';
        return;
    }

    $shared = isset($resolved['shared_with']) ? $resolved['shared_with'] : [];
    $nonce = wp_create_nonce('imppulsor_save_page_php_' . $post->ID);

    echo '<p><strong>Archivo:</strong> <code>' . esc_html($resolved['relative']) . '</code><br>';
    echo '<span class="description">' . esc_html($resolved['method_label']) . '. El código se muestra tal cual está en el servidor.</span></p>';

    if (!empty($shared)) {
        echo '<div class="notice notice-warning inline" style="margin:0 0 12px"><p><strong>Atención: este mismo archivo lo usan ' . count($shared) + 1 . ' páginas.</strong> Si lo guardas, cambiará en todas:</p><ul style="list-style:disc;margin-left:20px">';
        echo '<li><strong>' . esc_html(get_the_title($post->ID)) . '</strong> (esta página)</li>';
        foreach ($shared as $s) {
            echo '<li><a href="' . esc_url($s['edit_link']) . '">' . esc_html($s['title']) . '</a> (ID ' . (int) $s['ID'] . ')</li>';
        }
        echo '</ul></div>';
    }

    echo '<textarea id="imppulsor-page-php-code" name="imppulsor-page-php-code" rows="30" spellcheck="false" style="width:100%;font-family:Consolas,Menlo,monospace;font-size:12px" data-post-id="' . (int) $post->ID . '" data-file="' . esc_attr($resolved['relative']) . '" data-nonce="' . esc_attr($nonce) . '" data-shared="' . count($shared) . '">' . esc_textarea($code) . '</textarea>';
    echo '<p><button type="button" class="button button-primary" id="imppulsor-page-php-save">Guardar archivo PHP</button> ';
    echo '<span id="imppulsor-page-php-status" class="description" role="status"></span></p>';
    echo '<p class="description">Se crea automáticamente una copia de seguridad antes de guardar (carpeta <code>uploads/imppulsor-php-backups</code>). Después de guardar, revisa la página en el front.</p>';
}

/**
 * Carga CodeMirror (editor de código nativo de WP) + JS de guardado,
 * solo en Editar página.
 *
 * @param string $hook
 */
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || $screen->post_type !== 'page') {
        return;
    }
    if (defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT) {
        return;
    }
    if (!current_user_can('edit_pages') || !current_user_can('edit_theme_options')) {
        return;
    }

    $settings = wp_enqueue_code_editor(['type' => 'text/x-php']);
    if (empty($settings)) {
        return;
    }
    wp_enqueue_script('code-editor');

    $js = <<<'JS'
jQuery(function ($) {
  var ta = document.getElementById('imppulsor-page-php-code');
  if (!ta || !window.wp || !wp.codeEditor) return;
  var ed = wp.codeEditor.initialize(ta, IMPPULSOR_PAGE_PHP_CM);
  window.imppulsorPagePhpEditor = ed;
  $('#imppulsor-page-php-save').on('click', function () {
    var btn = $(this), status = $('#imppulsor-page-php-status');
    var shared = parseInt(ta.getAttribute('data-shared') || '0', 10);
    if (shared > 0) {
      if (!window.confirm('Este archivo lo usan ' + (shared + 1) + ' páginas. Se cambiará en TODAS. ¿Guardar de todos modos?')) return;
    }
    var content = (ed && ed.codemirror) ? ed.codemirror.getValue() : ta.value;
    btn.prop('disabled', true);
    status.text('Guardando…');
    $.post(ajaxurl, {
      action: 'imppulsor_save_page_php',
      nonce: ta.getAttribute('data-nonce'),
      post_id: ta.getAttribute('data-post-id'),
      file: ta.getAttribute('data-file'),
      content: content
    }).done(function (res) {
      if (res && res.success) {
        status.text('Guardado OK. Respaldo: ' + (res.data && res.data.backup ? res.data.backup : '—'));
        if (ed && ed.codemirror) ed.codemirror.markClean();
      } else {
        status.text('Error: ' + ((res && res.data && res.data.message) ? res.data.message : 'no se pudo guardar.'));
      }
    }).fail(function () {
      status.text('Error de red al guardar.');
    }).always(function () {
      btn.prop('disabled', false);
    });
  });
});
JS;

    wp_add_inline_script(
        'code-editor',
        'var IMPPULSOR_PAGE_PHP_CM = ' . wp_json_encode($settings) . ';' . $js,
        'before'
    );
});

/**
 * Guardado AJAX del archivo PHP. Re-valida todo en servidor
 * (no confía en la ruta enviada por el cliente).
 */
add_action('wp_ajax_imppulsor_save_page_php', function () {
    $post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
    $nonce = isset($_POST['nonce']) ? wp_unslash($_POST['nonce']) : '';

    if ($post_id <= 0 || !wp_verify_nonce($nonce, 'imppulsor_save_page_php_' . $post_id)) {
        wp_send_json_error(['message' => 'Nonce inválido. Recarga la página e inténtalo de nuevo.'], 403);
    }

    if (defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT) {
        wp_send_json_error(['message' => 'La edición de archivos está desactivada (DISALLOW_FILE_EDIT).'], 403);
    }

    if (!current_user_can('edit_pages') || !current_user_can('edit_theme_options') || !current_user_can('edit_page', $post_id)) {
        wp_send_json_error(['message' => 'Sin permisos (se requiere edit_pages y edit_theme_options).'], 403);
    }

    $post = get_post($post_id);
    if (!$post || $post->post_type !== 'page') {
        wp_send_json_error(['message' => 'Solo válido para páginas (post_type=page).'], 400);
    }

    // Resolver de nuevo en servidor y exigir que coincida con lo enviado.
    $resolved = imppulsor_page_php_resolve($post_id, false);
    if (empty($resolved['found']) || empty($resolved['editable'])) {
        wp_send_json_error(['message' => 'Esta página no tiene un archivo editable en el tema hijo.'], 400);
    }

    $sent_file = isset($_POST['file']) ? wp_unslash($_POST['file']) : '';
    if ($sent_file !== $resolved['relative']) {
        wp_send_json_error(['message' => 'El archivo cambió desde que se cargó el editor. Recarga la página.'], 409);
    }

    // Validación de ruta: debe quedar dentro del tema hijo (anti path-traversal).
    $child_dir = wp_normalize_path(get_stylesheet_directory());
    $abs = wp_normalize_path(realpath($resolved['path']));
    if ($abs === '' || strpos($abs, $child_dir . '/') !== 0 || substr($abs, -4) !== '.php') {
        wp_send_json_error(['message' => 'Ruta de archivo no permitida.'], 400);
    }

    $content = isset($_POST['content']) ? wp_unslash($_POST['content']) : null;
    if (!is_string($content) || $content === '') {
        wp_send_json_error(['message' => 'El contenido está vacío. No se guardó nada.'], 400);
    }
    if (strlen($content) > 2000000) {
        wp_send_json_error(['message' => 'Archivo demasiado grande (límite 2 MB).'], 400);
    }

    // Copia de seguridad antes de sobrescribir.
    $upload = wp_upload_dir();
    $backup_dir = trailingslashit($upload['basedir']) . 'imppulsor-php-backups';
    if (!wp_mkdir_p($backup_dir)) {
        wp_send_json_error(['message' => 'No se pudo crear la carpeta de respaldos.'], 500);
    }
    if (!file_exists($backup_dir . '/index.php')) {
        @file_put_contents($backup_dir . '/index.php', "<?php\n// Silence is golden.\n");
    }

    $backup_name = sanitize_file_name(pathinfo($abs, PATHINFO_FILENAME)) . '-' . gmdate('Ymd-His') . '-page' . $post_id . '.bak';
    if (!@copy($abs, $backup_dir . '/' . $backup_name)) {
        wp_send_json_error(['message' => 'No se pudo crear la copia de seguridad. No se guardó nada.'], 500);
    }

    $written = @file_put_contents($abs, $content, LOCK_EX);
    if ($written === false) {
        // Intentar restaurar desde el backup recién creado.
        @copy($backup_dir . '/' . $backup_name, $abs);
        wp_send_json_error(['message' => 'No se pudo escribir el archivo (permisos). Se mantuvo la versión anterior.'], 500);
    }

    wp_send_json_success([
        'message' => 'Archivo guardado.',
        'file'    => $resolved['relative'],
        'backup'  => $backup_name,
        'bytes'   => $written,
    ]);
});
