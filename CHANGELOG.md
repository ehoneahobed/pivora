# Changelog

All notable changes to the Pivora WordPress theme and Pivora Core companion plugin are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned for 1.0.0

- Full manual QA sign-off ([docs/ADMIN_TESTING.md](docs/ADMIN_TESTING.md))
- Lighthouse performance and accessibility gates on representative pages
- WordPress.org / public release after stability is confirmed

## [0.8.0] - 2026-06-17

Pivora Core plugin only (theme remains 0.1.0).

### Added

**Phase 5 — WooCommerce behavior**

- **Mini cart** (`pivora/mini-cart`) — dropdown cart with WooCommerce fragments and accessible toggle
- **Shipping progress** (`pivora/shipping-progress`) — free shipping goal bar with auto-detect or manual threshold
- **Product collection** (`pivora/product-collection`) — latest, category, or hand-picked product queries
- Shared WooCommerce helpers in `includes/integrations/woocommerce.php`

### Changed

- **Product grid** render path now uses shared product card helpers
- Store kit WooCommerce import seeds demo products when the catalog is empty

## [0.7.0] - 2026-06-17

Pivora Core plugin only (theme remains 0.1.0).

### Added

**Phase 4 — portable content types**

- **Client logos** CPT (`pivora_client_logo`) with optional industry taxonomy and logo grid CPT source mode
- **Case studies** CPT (`pivora_case_study`) with project tag, client, and card variant meta
- **Team members** CPT (`pivora_team_member`) with role, initials, and featured image support
- **Case study grid** (`pivora/case-study-grid`) and **team grid** (`pivora/team-grid`) blocks with admin empty states
- Admin list table image + excerpt columns; REST meta for headless-ready fields
- Demo seed content for portfolio and agency kit imports

### Changed

- **Team member** block accepts `memberId` to pull from the Team Members library
- `logo-cloud`, `portfolio-grid`, and `team-grid` patterns use CPT-powered blocks when Core is active

## [0.6.0] - 2026-06-17

Pivora Core plugin only (theme remains 0.1.0).

### Added

**Phase 3 — capture & conversion**

- **Lead capture** (`pivora/lead-capture`) — native form with `wp_mail`, optional webhook, honeypot, and inline/stacked layouts
- **Form embed** (`pivora/form-embed`) — WPForms, Contact Form 7, Forminator, or custom shortcode with style-preserving wrapper
- **Slide-in CTA** (`pivora/slide-in-cta`) — accessible once-per-session panel with reduced-motion support

### Changed

- **Announcement bar** supports optional start/end schedule dates (server-side visibility)
- `lead-capture-band` pattern uses the lead capture block
- `contact-section` and `newsletter-cta` theme patterns use Core forms with plugin swap guidance

## [0.5.0] - 2026-06-17

Pivora Core plugin only (theme remains 0.1.0).

### Added

**Phase 2 blocks**

- **Stats grid** (`pivora/stats-grid`) — impact metrics with labels, values, and copy; premium/light variants
- **Process steps** (`pivora/process-steps`) — numbered workflow with vertical or horizontal layout
- **Comparison tabs** (`pivora/comparison-tabs`) — accessible tabbed feature comparison tables
- **Product grid** (`pivora/product-grid`) — curated WooCommerce product cards with graceful empty state

### Changed

- `pivora/metrics-band`, `pivora/comparison-table`, and `pivora/product-spotlight` patterns use Core blocks when the plugin is active
- New `pivora/process-steps` theme pattern with list fallback when Core is inactive

## [0.4.0] - 2026-06-17

Pivora Core plugin only.

### Added

**Block styling**

- Native block supports on all Pivora blocks: typography, colors, spacing, borders, and alignment
- **Social Links Bar** style panel: layout, content alignment, link styles (pill, solid, ghost, plain), label visibility and label text style
- **Card blocks** surface styles: card, soft, outline, minimal (icon box, testimonial, team member, FAQ item, logo grid)
- **Announcement bar** density styles: default, compact, bold
- Block style presets registered in the editor (e.g. social links: centered, compact, minimal)

## [0.3.0] - 2026-06-17

Pivora Core plugin only (theme remains 0.1.0).

### Added

**Pivora Core**

- Kit export to `.pivora-kit.json` (admin download + `npm run kit:export`)
- Kit import from uploaded JSON with save-only or import actions
- Two new starter kits: **local business** and **nonprofit**
- **Logo grid** block (`pivora/logo-grid`) with image upload support
- WooCommerce guard UX: blocks store import and links to install when WC is missing

### Changed

- `pivora/logo-cloud` pattern uses the logo grid block when Core is active (paragraph fallback otherwise)
- Starter kit registry now merges saved custom kits from imports

## [0.2.0] - 2026-06-17

Pivora Core plugin only (theme remains 0.1.0).

### Added

**Pivora Core**

- Starter Site Studio: partial import scopes (homepage, starter pages, blog seed, WooCommerce)
- Pre-import snapshot and one-click rollback (`pivora_core_import_snapshot`)
- Pivora admin dashboard with Starter Kits, Blocks, and Help subpages
- Import progress steps after successful kit import
- `docs/CORE_PLUGIN_COMPAT.md` — block theme compatibility matrix

### Changed

- Admin menu **Pivora → Demo Import** renamed to **Pivora → Starter Kits** under the dashboard
- Legacy `?page=pivora-demo-import` URLs redirect to `?page=pivora-dashboard`

## [0.1.0] - 2026-06-17

Pre-release preview. Feature-complete for testing; stability and full QA are pending before **1.0.0**.

### Added

**Theme**

- 44 block patterns across business, SaaS, editorial, portfolio, ecommerce, and CTA categories
- 8 hero patterns: business, centered, agency, SaaS signup, SaaS split, fintech, jobs dark, jobs search
- 5 CTA patterns: simple, sale split, app download, split visual, email signup
- 5 pricing table variants (default, spotlight, soft purple, green band, monochrome)
- 5 landing starters: business, SaaS, blog, portfolio, store
- 19 block templates including sidebar, magazine, blank, full-width, and WooCommerce routes
- 12 template parts (3 headers, 2 footers, sidebar, blog query variants, toolbar)
- 4 global style variations: Editorial, Bold, Ecommerce, Minimal
- Block styles for buttons, groups, images, lists, and quotes
- Hero and CTA button block styles with explicit WYSIWYG editor parity
- Dedicated layout CSS: `hero-variants.css`, `cta-variants.css`, `button-block-styles.css`
- Blog archive toolbar (search, category filter, sort, results count)
- Blog layout switcher under **Appearance → Blog Layouts** (4 archive + 4 single layouts)
- Page option to hide title in the editor
- Template reset under **Appearance → Reset Templates**
- WooCommerce presentation layer (shop, product, cart, checkout, account)
- Skip link, focus styles, and `prefers-reduced-motion` support
- SEO plugin compatibility guards (`inc/compatibility/seo-plugins.php`)

**Pivora Core plugin**

- 9 custom blocks: icon box, testimonial card, pricing card, pricing billing toggle, FAQ item, announcement bar, social links bar, curated post grid, team member
- One-click demo import for 6 kits (business, SaaS, blog, portfolio, store, agency)
- Bonus patterns: announcement bar, lead capture band, integrations strip, agency starter, social links footer

**Tooling**

- `npm run check` — JSON, CSS, JS lint, block build, PHPCS
- `npm run check:budget` — theme CSS/JS size budget
- `npm run check:theme` — Theme Check on production zip
- `npm run package` — production theme + plugin zips
- `npm run setup:demo:*` — wp-env demo kit scripts
- GitHub Actions CI workflow

### Changed

- Hero and CTA patterns use explicit block styles instead of contextual CSS overrides for editor/frontend parity
- Editor grid and full-width breakout rules for split hero and CTA layouts
- Blog toolbar no longer uses shortcodes (Theme Check compliant)

[Unreleased]: https://github.com/ehoneahobed/pivora/compare/0.8.0...HEAD
[0.8.0]: https://github.com/ehoneahobed/pivora/releases/tag/0.8.0
[0.7.0]: https://github.com/ehoneahobed/pivora/releases/tag/0.7.0
[0.4.0]: https://github.com/ehoneahobed/pivora/releases/tag/0.4.0
[0.3.0]: https://github.com/ehoneahobed/pivora/compare/0.2.0...0.3.0
[0.2.0]: https://github.com/ehoneahobed/pivora/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/ehoneahobed/pivora/releases/tag/0.1.0
