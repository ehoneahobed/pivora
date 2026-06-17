# Changelog

All notable changes to the Pivora WordPress theme and Pivora Core companion plugin are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned for 1.0.0

- Full manual QA sign-off ([docs/ADMIN_TESTING.md](docs/ADMIN_TESTING.md))
- Lighthouse performance and accessibility gates on representative pages
- WordPress.org / public release after stability is confirmed

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

[Unreleased]: https://github.com/ehoneahobed/pivora/compare/0.1.0...HEAD
[0.1.0]: https://github.com/ehoneahobed/pivora/releases/tag/0.1.0
