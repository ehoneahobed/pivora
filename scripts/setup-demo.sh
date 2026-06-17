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

site_url() {
	wp option get home
}

echo "→ Activating Pivora…"
wp theme activate pivora

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

echo "→ Creating core pages…"
HOME_ID="$(wp post list --post_type=page --name=home --field=ID --format=ids)"
if [[ -z "${HOME_ID}" ]]; then
	HOME_ID="$(wp post create --post_type=page --post_title='Home' --post_status=publish --post_name=home --porcelain)"
else
	echo "  Home page already exists (ID ${HOME_ID})."
fi

BLOG_ID="$(wp post list --post_type=page --name=blog --field=ID --format=ids)"
if [[ -z "${BLOG_ID}" ]]; then
	BLOG_ID="$(wp post create --post_type=page --post_title='Blog' --post_status=publish --post_name=blog --porcelain)"
else
	echo "  Blog page already exists (ID ${BLOG_ID})."
fi

CONTACT_ID="$(wp post list --post_type=page --name=contact --field=ID --format=ids)"
if [[ -z "${CONTACT_ID}" ]]; then
	CONTACT_ID="$(wp post create --post_type=page --post_title='Contact' --post_status=publish --post_name=contact --porcelain)"
else
	echo "  Contact page already exists (ID ${CONTACT_ID})."
fi

PORTFOLIO_ID="$(wp post list --post_type=page --name=portfolio --field=ID --format=ids)"
if [[ -z "${PORTFOLIO_ID}" ]]; then
	PORTFOLIO_ID="$(wp post create --post_type=page --post_title='Portfolio' --post_status=publish --post_name=portfolio --porcelain)"
else
	echo "  Portfolio page already exists (ID ${PORTFOLIO_ID})."
fi

echo "→ Assigning page templates and starter content…"
wp post meta delete "${CONTACT_ID}" _wp_page_template >/dev/null 2>&1 || true
wp post update "${CONTACT_ID}" --post_content='<!-- wp:paragraph --><p>Reach out to discuss your next WordPress project, editorial launch, or storefront refresh.</p><!-- /wp:paragraph -->' >/dev/null

wp post meta update "${PORTFOLIO_ID}" _wp_page_template 'page-landing' >/dev/null
wp post update "${PORTFOLIO_ID}" --post_content='<!-- wp:pattern {"slug":"pivora/starter-portfolio-landing"} /-->' >/dev/null

echo "→ Setting Reading options…"
wp option update show_on_front page
wp option update page_on_front "${HOME_ID}"
wp option update page_for_posts "${BLOG_ID}"

echo "→ Seeding blog posts…"
ensure_post() {
	local title="$1"
	local content="$2"
	local existing

	existing="$(wp post list --post_type=post --title="${title}" --field=ID --format=ids)"
	if [[ -n "${existing}" ]]; then
		return 0
	fi

	wp post create --post_title="${title}" --post_status=publish --post_content="${content}" >/dev/null
}

ensure_post 'Hello world' 'Welcome to Pivora. This starter post helps you preview blog cards, archives, and single-post templates.'
ensure_post 'Building with block patterns' 'Patterns keep layouts consistent across landing pages, blog sections, and campaign pages without page-builder lock-in.'
ensure_post 'Launching a WooCommerce storefront' 'Pair Pivora with WooCommerce to test product archives, single product layouts, and store patterns.'

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
else
	echo "  WooCommerce not installed."
	echo "  Run: PIVORA_INSTALL_WOO=1 npm run setup:demo"
fi

echo ""
echo "════════════════════════════════════════════════════════"
echo " Pivora demo site is ready"
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
echo "  Site Editor $(site_url)/wp-admin/site-editor.php"
echo "  Username    ${ADMIN_USER}"
echo "  Password    ${ADMIN_PASS}"
echo ""
echo "Suggested admin checks:"
echo "  1. Appearance → Editor → Templates (front page, blog, single, shop)"
echo "  2. Appearance → Editor → Patterns (insert pricing, editorial, store hero)"
echo "  3. Pages → Portfolio (Landing Page template + portfolio pattern)"
echo "  4. Settings → Reading (static front page is already configured)"
echo ""
