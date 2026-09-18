# imppulsor-web — Tema custom WordPress Imppulsor v2 (+ migración EN)

Respaldo en git del tema personalizado **Imppulsor v2** (`wp-content/themes/imppulsorv2`) + archivos esenciales de `imppulsor.com`.
Fecha respaldo: 2026-09-18. Fuente FTP: `170.246.173.86 /public_html`.

## Migración ES → EN americano (2026-09-19, tag `post-migracion-en-20260919`)
- Tema 100% en inglés (plantillas, bloques, heros, header/footer, JS). Reglas: lógica PHP, slugs en código, `Template Name`/`Description` (admin), CF7 ids, campos ACF, marca y GTranslate intactos.
- Front reporta `en_US` (filtro `locale` solo front + `generate_404_*` + blank-option CF7 vía gettext). **WPLANG en BD sigue `es_CL`: admin y login en español.**
- Slugs de páginas e insights/casos en inglés + 301 en `raiz/.htaccess`. Bases CPT (`casos-de-exito`, `testimonios`, `autores`) NO se tocaron: `setup.php` desactiva rewrites si una página comparte slug (riesgo de 404 masivo).
- Contenido BD traducido: 25 páginas (título/slug/Yoast), 34 insights, 17 casos, 13 testimonios, 17 autores, 4 CF7, 3 banners, 3 bloques, tags, Yoast/indexables/breadcrumbs, policies.
- Backups: tag `pre-fase1-english` (pre-traducción) + tablas `bkp_en_*` en BD del servidor + `/backup-pre-english-20260919/` en servidor.

## Que incluye
- `wp-content/themes/imppulsorv2/` — tema hijo de GeneratePress completo (496 archivos, ~12MB):
  - `style.css` → Theme Name: Imppulsor v2, Template: generatepress, Version: 1.0.0
  - `functions.php`, `front-page.php`, `header.php`, `footer.php`
  - `page-*.php` (soluciones, diagnosticos, equipo, contacto, casos-exito, etc.)
  - `bloque-*.php`, `inc/` (setup, acf-fields, CPT, shortcodes, generar-pdf, enqueue, hero-global), `template-parts/`, `assets/`, `dompdf/`
- `raiz/.htaccess` — reglas WP + redirect HTTPS + handler ea-php80
- `raiz/index.php` — loader WP
- `raiz/wp-config.example.php` — estructura SANITIZADA (sin passwords/salts reales, repo es PUBLICO)
- `docs/` — listados FTP para inventario:
  - `listado-themes.txt` (generatepress, imppulsorv2, imppulsorv2-bkp)
  - `listado-plugins.txt` (gtranslate, ACF, Yoast, CF7, etc.)
  - `listado-public_html.txt`, `listado-uploads.txt` (394 items, solo inventario, no se descargan)

## Que NO incluye (a proposito)
- `.env.local`, `raiz/wp-config.php` real, `*.zip`, `*.sql`, `uploads/` — ignorados en `.gitignore` porque el repo es **PUBLICO** y GitHub limita archivos a 100MB.
  - Local tienes `bkp-17-09-26.zip` (130MB) — NO se sube.
  - Credenciales FTP/DB quedan solo en tu maquina.
- `generatepress` padre ni plugins de terceros (se reinstalan desde wp.org). Si quieres también respaldarlos avísame y los descargo.
- `imppulsorv2-bkp` (variante vieja en servidor) — no descargada, solo inventariada. Puedo sumarla si quieres comparar.

## Restaurar
1. Subir `wp-content/themes/imppulsorv2/` a `/public_html/wp-content/themes/` por FTP.
2. En WP activar tema hijo (requiere GeneratePress padre instalado).
3. `raiz/.htaccess` e `index.php` solo si se corrompen los de raiz (respaldar antes).
4. DB y `uploads/` se restauran desde backup cPanel / `bkp-17-09-26.zip`, no desde este repo.

## Seguridad
Repo actualmente PUBLICO. Recomendado pasarlo a PRIVADO si vas a subir `wp-config` real o ACF JSON con datos:
`gh repo edit leoandrescl/imppulsor-web --visibility private`
O avísame y lo cambio.
