# Pivora blocks, patterns, and editor roadmap

This document is the build queue for making Pivora competitive with top block themes (Ollie, Frost, Twenty Twenty-Four, Kadence-style kits). Work through items **in order**. Update the status column as each ships.

## Strategy

| Approach | When to use | Maintenance |
|----------|-------------|-------------|
| **Patterns** | Full sections (hero, FAQ, pricing, footer) | Low — PHP + HTML + CSS |
| **Block styles** | Variants on core blocks (outline button, card group) | Low — CSS + `register_block_style()` |
| **Custom blocks** | Repeated components core blocks handle poorly | High — React + `block.json` + build step |
| **PHP features** | Site-wide behavior (blog layouts, toolbars) | Medium — already started in Pivora |

**Rule:** Prefer patterns and block styles first. Add custom blocks only when patterns are awkward for clients.

## What Pivora already ships

- **44 theme patterns** — 8 heroes, 5 CTAs, sections, pricing variants, starters, WooCommerce pack (`patterns/`, `inc/patterns.php`)
- **9 custom blocks** — in `plugins/pivora-core/` (theme shows install notice when plugin is inactive)
- **5 plugin-only patterns** — lead capture, integrations strip, agency starter, announcement bar, social links footer (`plugins/pivora-core/patterns/`)
- **6 demo kits** — includes agency kit via **Pivora → Starter Kits**
- **3 header + 2 footer variants** — `parts/header-centered.html`, `header-minimal.html`, `footer-columns.html`
- **4 style variations** — `styles/*.json`
- **Hero + CTA layout CSS** — `assets/css/hero-variants.css`, `cta-variants.css`, `button-block-styles.css` (frontend + editor)
- **Blog archive toolbar** — search, filters, sort (`inc/blog-archive.php`)
- **Blog / single layout switchers** — `Appearance → Blog Layouts`
- **Sidebar template part** — `parts/sidebar.html`
- **Page display options** — hide title (`inc/page-settings.php`)
- **Template reset** — `Appearance → Reset Templates`
- **SEO plugin compatibility** — `inc/compatibility/seo-plugins.php`

## Build queue

### Phase A — Patterns and block styles (highest ROI)

| # | Item | Type | Status | Files / notes |
|---|------|------|--------|----------------|
| A1 | Pattern categories (Editorial, SaaS, Portfolio, Local) | Categories | done | `inc/patterns.php` |
| A2 | Block styles foundation | Block styles | done | `inc/block-styles.php`, `assets/css/base.css` |
| A3 | FAQ section | Pattern | done | `patterns/faq-section.php` |
| A4 | Testimonials grid | Pattern | done | `patterns/testimonials-grid.php` |
| A5 | Logo cloud / trust bar | Pattern | done | `patterns/logo-cloud.php` |
| A6 | Team grid | Pattern | done | `patterns/team-grid.php` |
| A7 | Contact section | Pattern | done | `patterns/contact-section.php` |
| A8 | Newsletter CTA | Pattern | done | `patterns/newsletter-cta.php` |
| A9 | Comparison table | Pattern | done | `patterns/comparison-table.php` |
| A10 | Page header with breadcrumb | Pattern | done | `patterns/page-header.php` |
| A11 | Footer columns (mega-style) | Pattern | done | `patterns/footer-columns.php` |
| A12 | Metrics band variants (2–3 layouts) | Pattern | done | `patterns/metrics-band-light.php`, `patterns/metrics-band-split.php` |
| A13 | Block style: Button (outline, pill, ghost) | Block style | done | `inc/block-styles.php` |
| A14 | Block style: Group (card, band, bordered) | Block style | done | `inc/block-styles.php` |
| A15 | Block style: Image (rounded, shadow) | Block style | done | `inc/block-styles.php` |
| A16 | Block style: List (checkmarks, steps) | Block style | done | `inc/block-styles.php` |
| A17 | Block style: Quote (testimonial, pull) | Block style | done | `inc/block-styles.php` |
| A18 | Hero pattern library (8 variants) | Pattern | done | `patterns/hero-*.php`, `hero-variants.css` |
| A19 | CTA pattern library (5 variants) | Pattern | done | `patterns/cta-*.php`, `cta-variants.css` |
| A20 | Hero + CTA button block styles | Block style | done | `button-block-styles.css`, `inc/block-styles.php` |

**Phase A acceptance criteria**

- Each pattern appears under **Patterns → Pivora …** in the inserter.
- Patterns use existing Pivora section classes (`pivora-section`, `pivora-eyebrow`, `pivora-card`, etc.).
- `viewportWidth` set for readable previews (1200 or 1440).
- Frontend matches editor (shared `base.css` + `editor.css` where needed).
- Copy is translatable via `esc_html_e()` in pattern PHP files.

### Phase B — Custom blocks (`@wordpress/scripts`)

| # | Item | Why custom | Status |
|---|------|------------|--------|
| B1 | Scaffold `src/blocks/` + build pipeline | Foundation | done |
| B2 | Icon box (icon + title + text) | Repeated feature cards | done |
| B3 | Testimonial card | Avatar, quote, role | done |
| B4 | Pricing card | Featured badge, CTA | done |
| B5 | FAQ item (optional if Details pattern is enough) | Styled accordion | done |
| B6 | Announcement bar | Dismissible top banner | done |
| B7 | Social links bar | Theme-styled icons row | done |
| B8 | Curated post grid block | Card design + query controls | done |

**Phase B acceptance criteria**

- Blocks register under **Pivora** category in the inserter.
- `npm run build` produces `build/blocks/*`.
- Blocks work in Site Editor and post editor.
- No frontend JS unless required (prefer CSS + server render).

### Phase C — Theme features and kits

| # | Item | Status |
|---|------|--------|
| C1 | One-click demo import UX (expand `setup:demo`) | done |
| C2 | Header/footer template part variants | done |
| C3 | Starter landing compositions using new patterns | done |
| C4 | WooCommerce pattern pack (product spotlight, categories) | done |
| C5 | Editor pattern preview polish (`viewportWidth`, screenshots doc) | done |

### Phase D — Companion plugin (optional, post–theme.org)

| # | Item | Status |
|---|------|--------|
| D1 | `pivora-core` plugin scaffold | done |
| D2 | Move custom blocks to plugin | done |
| D3 | Demo import + extra patterns in plugin | done |

## Block styles reference

Registered in `inc/block-styles.php`. Applied in the block toolbar under **Styles**.

| Block | Style name | Class | Use |
|-------|------------|-------|-----|
| `core/button` | Outline | `is-style-pivora-outline` | Secondary CTA |
| `core/button` | Pill | `is-style-pivora-pill` | Rounded buttons |
| `core/button` | Ghost | `is-style-pivora-ghost` | Text-like actions |
| `core/group` | Card | `is-style-pivora-card` | Bordered panels |
| `core/group` | Band | `is-style-pivora-band` | Full-width cloud background |
| `core/group` | Bordered | `is-style-pivora-bordered` | Subtle outline |
| `core/image` | Rounded | `is-style-pivora-rounded` | 12px radius |
| `core/image` | Shadow | `is-style-pivora-shadow` | Soft elevation |
| `core/list` | Checkmarks | `is-style-pivora-checklist` | Feature lists |
| `core/list` | Steps | `is-style-pivora-steps` | Numbered process |
| `core/quote` | Testimonial | `is-style-pivora-testimonial` | Quote cards |
| `core/quote` | Pull quote | `is-style-pivora-pullquote` | Editorial emphasis |
| `core/button` | Hero gold / teal / green / purple / ink (+ outline variants) | `is-style-pivora-hero-*` | Hero CTAs |
| `core/button` | CTA amber / coral | `is-style-pivora-cta-*` | Sale + download CTAs |

Hero and CTA button styles live in `assets/css/button-block-styles.css`.

## Pattern authoring checklist

1. Create `patterns/{slug}.php` with file header (`Title`, `Slug`, `Categories`, `Viewport width`).
2. Use block markup only (no raw HTML except inside blocks).
3. Register in `inc/patterns.php` `$patterns` array.
4. Add section CSS to `assets/css/base.css` (and `editor.css` if editor preview drifts).
5. Test: **Patterns** tab in inserter + frontend on Landing Page template.
6. Mark row **done** in the table above.

## Custom block authoring checklist (Phase B)

1. `plugins/pivora-core/src/blocks/{name}/block.json` + `index.js` + `save.js` (or `render.php`).
2. Block registration in `plugins/pivora-core/includes/blocks.php`.
3. `npm run build` before commit (outputs to `plugins/pivora-core/build/blocks/`).
4. Document block in this file.

## What we are not building

- Full page builder replacing core blocks
- Classic widget screen clones
- 20+ custom blocks in the theme zip (theme review / maintenance cost)
- Replacing Cover, Query Loop, or Navigation core blocks

## Related docs

- [BLOG_LAYOUTS.md](./BLOG_LAYOUTS.md) — archive and single templates
- [PATTERN_PREVIEWS.md](./PATTERN_PREVIEWS.md) — inserter preview widths and QA
- [STARTER_SITES.md](./STARTER_SITES.md) — starter compositions
- [ADMIN_TESTING.md](./ADMIN_TESTING.md) — QA checklist
- [DEVELOPMENT.md](./DEVELOPMENT.md) — local environment
- [CORE_PLUGIN_ROADMAP.md](./CORE_PLUGIN_ROADMAP.md) — Pivora Core plugin phases and build queue
- [V1_RELEASE_PLAN.md](./V1_RELEASE_PLAN.md) — release checklist

## Roadmap complete — pre-1.0 block integration

Phases A–D are shipped. **Before 1.0**, custom blocks are wired into patterns (not post-1.0 debt).

| Layer | Responsibility |
|-------|----------------|
| **Pivora theme** | Patterns, templates, block styles, blog layouts, WooCommerce |
| **Pivora Core plugin** | Custom blocks, demo import, bonus patterns |

### Block-powered patterns (0.1.0+)

When Pivora Core is active, these sections use custom blocks (core-block fallback without plugin):

| Pattern | Blocks used |
|---------|-------------|
| `pivora/faq-section` | `pivora/faq-item` ×4 |
| `pivora/feature-grid` | `pivora/icon-box` ×3 |
| `pivora/testimonials-grid` | `pivora/testimonial-card` ×3 |
| `pivora/pricing-table` | `pivora/pricing-card` ×3 |
| `pivora/latest-posts` | `pivora/curated-post-grid` |
| `pivora/store-benefits` | `pivora/icon-box` ×3 |
| `pivora/team-grid` | `pivora/team-member` ×3 |

Plugin-only patterns: `pivora-core/announcement-bar`, `pivora-core/social-links-footer`.

### Production checklist (pre-1.0 → 1.0.0)

- [x] Native `@wordpress/scripts` block discovery
- [x] Self-contained block CSS (`shared/_surface.scss`)
- [x] Custom blocks wired into theme patterns
- [x] Enhanced `curated-post-grid` (featured image, date, excerpt controls)
- [x] Enhanced `pricing-card` (badge text, outline CTA)
- [x] Demo import WooCommerce guard
- [x] CI workflow and release packaging

### Quick start

```bash
npm run env:start
npm run build
npm run setup:demo          # business kit + plugin
npm run setup:demo:agency   # agency kit (plugin patterns)
npm run package             # production zips
```
