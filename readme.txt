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

* 44 block patterns — 8 heroes, 5 CTAs, pricing variants, metrics, FAQ, testimonials, WooCommerce sections, and 5 landing starters
* Blog templates (home, archive, single, search, index) with card grids, sidebar layouts, and archive toolbar
* Inner page templates (default, landing, full width, blank, with-sidebar, 404)
* WooCommerce block templates (shop archive and single product) with cart, checkout, and account styling
* Block styles for buttons, groups, images, lists, and quotes — plus hero/CTA button styles with editor parity
* Style variations (Minimal, Editorial, Bold, Ecommerce)
* Header and footer template-part variants (default, centered, minimal, columns)
* Skip link, focus styles, reduced-motion support, and SEO plugin compatibility

The theme provides strong SEO foundations through semantic markup, responsive layouts, accessible navigation, and performance-conscious asset loading. It does not replace dedicated SEO plugins.

**Companion plugin (optional)**

Install [Pivora Core](https://github.com/ehoneahobed/pivora) for custom blocks, one-click demo kits, and bonus patterns. The theme is fully usable without the plugin.

== Installation ==

1. Upload the theme folder to `/wp-content/themes/pivora/`.
2. Activate Pivora from **Appearance → Themes**.
3. Customize global styles and templates in the WordPress Site Editor.
4. (Recommended) Install and activate the **Pivora Core** companion plugin for custom blocks and demo import.

**Local development**

`npm install && npm run env:start && npm run build && npm run setup:demo`

See `docs/SETUP.md` for the full CLI bootstrap guide.

== Frequently Asked Questions ==

= Does Pivora work without the Pivora Core plugin? =

Yes. Patterns, templates, blog layouts, and WooCommerce support are built into the theme. Pivora Core adds nine custom blocks, demo kit import, and five bonus patterns.

= Does Pivora work with WooCommerce? =

Yes. Activate WooCommerce and Pivora loads `woocommerce.css` plus `archive-product` and `single-product` block templates. For the store demo kit, install WooCommerce before importing via Pivora Core.

= Can I build landing pages without code? =

Yes. Use the **Landing Page** template and insert patterns from the Pivora categories in the block inserter.

= Does Pivora include a page builder? =

No. Pivora uses native WordPress blocks, patterns, and the Site Editor.

== Copyright ==

Pivora WordPress Theme, Copyright 2026 ehoneahobed.
Pivora is distributed under the terms of the GNU GPL.

== Resources ==

No third-party fonts are bundled. Pattern preview gradients and placeholders are CSS-only. The centered hero background uses `assets/images/pivora-hero-bg.jpg`.

== Changelog ==

= 0.1.0 =
* Pre-release preview — feature-rich but not yet fully QA'd; 1.0.0 follows stability testing
* 44 theme patterns (8 heroes, 5 CTAs), block styles, 19 templates, 12 template parts
* Hero and CTA variant CSS with explicit button block styles for editor/frontend parity
* Blog layout switcher (4 archive styles, 4 single styles) under Appearance → Blog Layouts
* Pivora Starters — business, SaaS, blog, store, and portfolio landing compositions
* WooCommerce block templates, cart/checkout/account styling, and product patterns
* SEO plugin compatibility (Yoast SEO, Rank Math, The SEO Framework)
* Companion plugin integration notice (Pivora Core)
* CI, packaging scripts, Theme Check script, and wp-scripts block build pipeline
