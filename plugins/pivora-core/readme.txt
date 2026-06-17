=== Pivora Core ===
Contributors: ehoneahobed
Requires at least: 6.5
Tested up to: 6.8
Requires PHP: 8.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Companion plugin for the Pivora block theme: custom blocks, demo import, and bonus patterns.

== Description ==

Pivora Core extends the Pivora theme with:

* Eight custom blocks (icon box, testimonial card, pricing card, FAQ item, announcement bar, social links bar, curated post grid, team member)
* One-click demo kit import (business, SaaS, blog, portfolio, store, agency)
* Three bonus patterns (lead capture band, integrations strip, agency starter)

The theme ships patterns and templates. Pivora Core adds editor blocks and import tooling without bloating the theme zip. Block styles are self-contained and work with any block theme that exposes standard `theme.json` color and spacing presets.

== Installation ==

1. Upload `pivora-core` to `/wp-content/plugins/` or install from the release zip in this repository.
2. Activate the plugin through the **Plugins** screen.
3. Open **Pivora → Demo Import** to load a starter kit.

**Requirements**

* WordPress 6.5+
* PHP 8.0+
* Pivora theme (recommended; blocks work on other block themes with preset fallbacks)
* WooCommerce (required only for the **store** demo kit — must be installed and active before import)

== Development ==

From the theme repository root:

```bash
npm install
npm run build          # compile blocks to plugins/pivora-core/build/blocks/
npm run package        # dist/pivora.zip + dist/pivora-core.zip
```

Block sources live in `plugins/pivora-core/src/blocks/` and compile via `@wordpress/scripts` block discovery (`--webpack-copy-php`).

== Frequently Asked Questions ==

= Does the theme require this plugin? =

No. Pivora works standalone. Install Pivora Core when you want custom blocks or demo import.

= Why is WooCommerce not auto-installed for the store kit? =

Demo import never silently activates plugins. Install and activate WooCommerce first, then run the store kit import.

= Can I use the blocks without the Pivora theme? =

Yes. Blocks ship their own surface styles with `theme.json` preset fallbacks.

== Changelog ==

= 1.0.0 =
* Production release: seven blocks with self-contained styles
* Demo import for six kits (business, SaaS, blog, portfolio, store, agency)
* Native wp-scripts block discovery build (no copy scripts)
* `pivora-core` text domain and `load_plugin_textdomain`
* WooCommerce guard on store kit import
