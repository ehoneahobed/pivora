=== Pivora Core ===
Contributors: ehoneahobed
Requires at least: 6.5
Tested up to: 6.8
Requires PHP: 8.0
Stable tag: 0.9.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Conversion-focused blocks, starter kits, and patterns for block themes — with or without the Pivora theme.

== Description ==

Pivora Core is the **content and conversion layer** for WordPress block sites:

* **Twenty-three custom blocks** — SEO breadcrumb, mini cart, product collection, and more
* **Three content libraries** — client logos, case studies, and team members (theme-independent CPTs)
* **Starter Site Studio** — eight demo kits, partial import, rollback, and JSON kit export/import for agencies
* **Bonus patterns** — lead capture, integrations strip, agency landing, and more

Install Core when you want dynamic sections and one-click starter content. The Pivora theme adds templates, hero styling, and a larger pattern library — but blocks work on any block theme that exposes standard `theme.json` presets.

== Installation ==

1. Upload `pivora-core` to `/wp-content/plugins/` or install from the release zip.
2. Activate the plugin through the **Plugins** screen.
3. Open **Pivora → Starter Kits** to preview and import a starter kit.

**Requirements**

* WordPress 6.5+
* PHP 8.0+
* Pivora theme (recommended for full starter kits and header/footer variants)
* WooCommerce (required only for the **store** demo kit — install and activate before import)

== Starter Site Studio ==

* **Eight built-in kits** — business, SaaS, blog, portfolio, store, agency, local business, nonprofit
* **Partial import** — choose homepage, starter pages, sample posts, or WooCommerce pages
* **Snapshot + rollback** — restores reading settings, header/footer variants, and page content
* **Kit export/import** — download `.pivora-kit.json` or upload agency handoff files
* **Live preview** — preview any kit in the browser before importing

== Development ==

From the theme repository root:

```bash
npm install
npm run build          # compile blocks to plugins/pivora-core/build/blocks/
npm run package        # dist/pivora.zip + dist/pivora-core.zip
npm run kit:export -- business
```

== Frequently Asked Questions ==

= Does the theme require this plugin? =

No. Pivora works standalone. Install Pivora Core when you want custom blocks or starter kit import.

= Can I use the blocks without the Pivora theme? =

Yes. Blocks ship their own surface styles with `theme.json` preset fallbacks. See `docs/CORE_PLUGIN_COMPAT.md` in the repository.

= Why is WooCommerce not auto-installed for the store kit? =

Demo import never silently activates plugins. Install and activate WooCommerce first, then run the store kit import.

== Changelog ==

= 0.9.0 =
* SEO breadcrumb block with Rank Math, Yoast, and fallback support
* Display conditions for announcement bar and slide-in CTA blocks
* Documented hooks in docs/CORE_PLUGIN_HOOKS.md
* Kit export CLI and PHPUnit snapshot tests

= 0.8.0 =
* Mini cart, shipping progress, and product collection WooCommerce blocks
* Store kit import seeds demo products when the catalog is empty
* Shared WooCommerce integration helpers for product cards and cart fragments

= 0.7.0 =
* Client logos, case studies, and team members CPTs with REST meta
* Case study grid and team grid blocks; logo grid CPT source mode
* Portfolio and agency kit imports seed CPT demo content

= 0.6.0 =
* Lead capture form block with wp_mail and optional webhook delivery
* Form embed bridge for WPForms, Contact Form 7, and Forminator
* Slide-in CTA block with session dismiss and reduced-motion support
* Announcement bar schedule start/end dates

= 0.5.0 =
* Phase 2 blocks: stats grid, process steps, comparison tabs, and WooCommerce product grid
* Theme patterns wired with Core fallbacks: metrics band, process steps, comparison table, product spotlight

= 0.4.0 =
* Block styling: typography, colors, spacing, borders, and alignment on all blocks
* Social links bar layout, link styles, and alignment controls
* Card surface styles and announcement bar density options

= 0.3.0 =
* Kit export/import JSON for agency handoffs
* Local business and nonprofit starter kits
* Logo grid block; logo cloud pattern uses block when Core is active
* WooCommerce install prompt when store kit is selected without WC

= 0.2.0 =
* Starter Site Studio: partial import scopes, pre-import snapshot, one-click rollback
* Pivora admin dashboard with Starter Kits, Blocks, and Help screens

= 0.1.0 =
* Pre-release preview: nine blocks with self-contained styles
* Demo import for six kits
