<?php
/**
 * wp-config.php de RESPALDO - CREDENCIALES SANITIZADAS
 * Archivo original: /public_html/wp-config.php (2026-09-18)
 * Repo PUBLICO: NO incluye DB_PASSWORD ni SALTS reales.
 * El archivo real con secrets esta respaldado localmente y NO se sube a git.
 *
 * Para restaurar: copiar a wp-config.php y completar DB_* y SALTS desde cPanel / secret-key service.
 */

// ** Database settings ** //
define( 'DB_NAME', 'REEMPLAZAR_DB_NAME' );
define( 'DB_USER', 'REEMPLAZAR_DB_USER' );
define( 'DB_PASSWORD', 'REEMPLAZAR_DB_PASSWORD' );
define( 'DB_HOST', 'localhost:3306' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// Salts originales NO incluidas por seguridad. Generar en https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY', 'PONER_SALT_AQUI');
define('SECURE_AUTH_KEY', 'PONER_SALT_AQUI');
define('LOGGED_IN_KEY', 'PONER_SALT_AQUI');
define('NONCE_KEY', 'PONER_SALT_AQUI');
define('AUTH_SALT', 'PONER_SALT_AQUI');
define('SECURE_AUTH_SALT', 'PONER_SALT_AQUI');
define('LOGGED_IN_SALT', 'PONER_SALT_AQUI');
define('NONCE_SALT', 'PONER_SALT_AQUI');

// Prefijo original (no es secreto, se necesita para restaurar en la misma DB):
$table_prefix = 'yIUyYVoyf_';

define('WP_ALLOW_MULTISITE', true);
define('WP_AUTO_UPDATE_CORE', false);

if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
require_once ABSPATH . 'wp-settings.php';
