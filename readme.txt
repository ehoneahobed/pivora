=== Pivora ===
Contributors: ehoneahobed
Requires at least: 6.5
Tested up to: 6.8
Requires PHP: 8.0
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A modern, block-first, multi-purpose WordPress theme built for fast, accessible, SEO-ready websites.

== Description ==

Pivora is a block-first WordPress theme focused on clean architecture, fast rendering, accessible layouts, and flexible site building through native WordPress templates, template parts, global styles, and patterns.

**Included out of the box**

* Polished front-page pattern stack (hero, metrics, features, services, latest posts, CTA)
* Blog templates (home, archive, single, search, index) with card grids and cloud header bands
* Inner page templates (default, landing, full width, blank, 404)
* WooCommerce block templates (shop archive and single product) with matching product card styling
* Business, content, and ecommerce pattern library
* Style variations (Editorial, Bold, Ecommerce)
* Skip link, focus styles, and keyboard-friendly navigation

The theme provides strong SEO foundations through semantic markup, responsive layouts, accessible navigation, and performance-conscious asset loading. It does not replace dedicated SEO plugins.

== Installation ==

1. Upload the theme folder to `/wp-content/themes/pivora/`.
2. Activate Pivora from **Appearance → Themes**.
3. Customize global styles and templates in the WordPress Site Editor.

**Local development without wp-admin**

If you use the bundled dev environment, run:

`npm install && npm run env:start && npm run setup:demo`

See `docs/SETUP.md` for the full CLI bootstrap guide.

== Frequently Asked Questions ==

= Does Pivora work with WooCommerce? =

Yes. Activate WooCommerce and Pivora will load `woocommerce.css` plus the `archive-product` and `single-product` block templates. Run `npm run setup:demo` after installing WooCommerce to create shop pages.

= Can I build landing pages without code? =

Yes. Use the **Landing Page** template and insert patterns from the Pivora categories in the block inserter.

= Does Pivora include a page builder? =

No. Pivora uses native WordPress blocks, patterns, and the Site Editor.

== Copyright ==

Pivora WordPress Theme, Copyright 2026 ehoneahobed.
Pivora is distributed under the terms of the GNU GPL.

== Resources ==

No third-party fonts or images are bundled. Pattern preview gradients and placeholders are CSS-only.

== Changelog ==

= 0.1.0 =
* Initial release scaffold
* Front page, blog, inner page, and WooCommerce templates
* Blog layout switcher (4 archive styles, 4 single styles) under Appearance → Blog Layouts
* Pattern library with pricing, portfolio, editorial, and store sections
* Pivora Starters — one-click business, blog, store, and portfolio landing compositions
* WP-CLI demo setup script (`npm run setup:demo`)
* Dynamic pattern button URLs and theme screenshot
