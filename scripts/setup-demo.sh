#!/usr/bin/env bash
#
# Bootstraps a local Pivora demo site for frontend and wp-admin testing.
# Run from the theme repo with: npm run setup:demo
#
set -euo pipefail

ADMIN_USER="${PIVORA_ADMIN_USER:-admin}"
ADMIN_PASS="${PIVORA_ADMIN_PASS:-password}"
ADMIN_EMAIL="${PIVORA_ADMIN_EMAIL:-admin@pivora.local}"
INSTALL_WOO="${PIVORA_INSTALL_WOO:-0}"
DEMO_KIT="${PIVORA_DEMO_KIT:-business}"

WP_PLUGINS_DIR="/var/www/html/wp-content/plugins"
WP_THEMES_DIR="/var/www/html/wp-content/themes"
CORE_SLUG="pivora-core"
BUNDLED_CORE="${WP_THEMES_DIR}/pivora/plugins/${CORE_SLUG}"

site_url() {
	wp option get home
}

ensure_pivora_core() {
	if wp plugin is-active "${CORE_SLUG}" 2>/dev/null; then
		echo "  Pivora Core already active"
		return 0
	fi

	if wp plugin is-installed "${CORE_SLUG}" 2>/dev/null; then
		wp plugin activate "${CORE_SLUG}"
		return 0
	fi

	if [[ -d "${BUNDLED_CORE}" && -f "${BUNDLED_CORE}/pivora-core.php" ]]; then
		echo "→ Linking Pivora Core from theme bundle…"
		ln -sfn "${BUNDLED_CORE}" "${WP_PLUGINS_DIR}/${CORE_SLUG}"
		wp plugin activate "${CORE_SLUG}"
		return 0
	fi

	echo "Error: Pivora Core is not available in wp-content/plugins." >&2
	echo "Run: npm run env:update" >&2
	echo "Then retry: npm run setup:demo" >&2
	exit 1
}

echo "→ Activating Pivora…"
wp theme activate pivora

echo "→ Activating Pivora Core…"
ensure_pivora_core

echo "→ Ensuring administrator account…"
if wp user get "${ADMIN_USER}" >/dev/null 2>&1; then
	wp user update "${ADMIN_USER}" --user_pass="${ADMIN_PASS}" --user_email="${ADMIN_EMAIL}" --display_name="Site Admin" >/dev/null
	echo "  Updated password for existing user: ${ADMIN_USER}"
else
	wp user create "${ADMIN_USER}" "${ADMIN_EMAIL}" --role=administrator --user_pass="${ADMIN_PASS}" --display_name="Site Admin" >/dev/null
	echo "  Created administrator: ${ADMIN_USER}"
fi

echo "→ Configuring permalinks…"
wp rewrite structure '/%postname%/' --hard

if [[ "${INSTALL_WOO}" == "1" ]] && ! wp plugin is-installed woocommerce; then
	echo "→ Installing WooCommerce…"
	wp plugin install woocommerce --activate
fi

if wp plugin is-installed woocommerce; then
	if ! wp plugin is-active woocommerce; then
		wp plugin activate woocommerce
	fi

	echo "→ Configuring WooCommerce pages…"
	wp wc tool run install_pages --user=1 2>/dev/null || true
fi

if [[ "${DEMO_KIT}" == "store" ]]; then
	INSTALL_WOO=1
	if ! wp plugin is-active woocommerce 2>/dev/null; then
		echo "→ Store kit selected; install WooCommerce with PIVORA_INSTALL_WOO=1 if needed."
	fi
fi

echo "→ Importing demo kit: ${DEMO_KIT}…"
wp eval "pivora_import_demo_kit( '${DEMO_KIT}' );"

echo ""
echo "════════════════════════════════════════════════════════"
echo " Pivora demo site is ready (${DEMO_KIT})"
echo "════════════════════════════════════════════════════════"
echo ""
echo "Frontend"
echo "  Site        $(site_url)/"
echo "  Blog        $(site_url)/blog/"
echo "  Contact     $(site_url)/contact/"
echo "  Portfolio   $(site_url)/portfolio/"
if wp plugin is-active woocommerce 2>/dev/null; then
	echo "  Shop        $(site_url)/shop/"
fi
echo ""
echo "WordPress admin (test like a site owner)"
echo "  Dashboard   $(site_url)/wp-admin/"
echo "  Starter Kits $(site_url)/wp-admin/admin.php?page=pivora-dashboard"
echo "  Site Editor $(site_url)/wp-admin/site-editor.php"
echo "  Username    ${ADMIN_USER}"
echo "  Password    ${ADMIN_PASS}"
echo ""
echo "Other demo kits:"
echo "  PIVORA_DEMO_KIT=saas npm run setup:demo"
echo "  PIVORA_DEMO_KIT=blog npm run setup:demo"
echo "  PIVORA_DEMO_KIT=portfolio npm run setup:demo"
echo "  PIVORA_DEMO_KIT=agency npm run setup:demo"
echo "  PIVORA_INSTALL_WOO=1 PIVORA_DEMO_KIT=store npm run setup:demo"
echo ""
