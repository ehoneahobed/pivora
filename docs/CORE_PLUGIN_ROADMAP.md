# Pivora Core plugin — implementation roadmap

This is the build queue for **Pivora Core** (`plugins/pivora-core/`). Work through phases **in order** unless a row is marked optional. Update the **Status** column as each item ships.

**Positioning:** Pivora Core is the **conversion and content layer** for block sites — starter kits, dynamic sections, and integrations that patterns alone cannot provide. The theme controls presentation; the plugin controls behavior and portable data.

**Related docs**

- [BLOCKS_AND_PATTERNS_ROADMAP.md](./BLOCKS_AND_PATTERNS_ROADMAP.md) — theme patterns and block styles
- [IMPLEMENTATION_PLAN.md](../IMPLEMENTATION_PLAN.md) — theme vs plugin boundary (§2.2)
- [STARTER_SITES.md](./STARTER_SITES.md) — current starter compositions
- [DEVELOPMENT.md](./DEVELOPMENT.md) — build and package commands

---

## Strategy

| Build in Core | Keep in theme | Do not build |
|---------------|---------------|--------------|
| Custom blocks with logic (query, toggle, dismiss) | Patterns, templates, `theme.json` | SEO suite, analytics, caching |
| CPTs + dynamic blocks (case studies, logos) | Hero/CTA CSS, blog layout switcher | Full page builder, 40+ blocks |
| Starter Site Studio (import, rollback, export) | WooCommerce **styling** | CRM, email marketing platform |
| Form / email / WC **bridges** | Editor parity CSS | Popup rule engines (OptinMonster-style) |
| Lightweight display rules (schedule, dismiss) | Template parts | Plugin auto-install without consent |

**Rules**

1. **Blocks work without Pivora theme** — use `theme.json` preset fallbacks and self-contained block CSS.
2. **Theme patterns must degrade gracefully** when Core is inactive (core-block fallbacks already started).
3. **Server-render by default** — frontend JS only when interaction is required.
4. **Every new block ships in ≥1 theme or plugin pattern** — no orphan blocks.
5. **Prefer integrations over reimplementation** — bridge to WPForms, CF7, Rank Math, WooCommerce.

---

## Current state (0.3.0)

| Area | Ships today |
|------|-------------|
| **Blocks (10)** | `icon-box`, `logo-grid`, `testimonial-card`, `pricing-card`, `pricing-billing-toggle`, `faq-item`, `announcement-bar`, `social-links-bar`, `curated-post-grid`, `team-member` |
| **Plugin patterns (5)** | `announcement-bar`, `lead-capture-band`, `integrations-strip`, `starter-agency-landing`, `social-links-footer` |
| **Demo kits (8)** | business, SaaS, blog, portfolio, store, agency, local business, nonprofit (+ custom imported kits) |
| **Admin** | **Pivora → Dashboard** — partial import, rollback, kit JSON export/import, live preview |
| **Build** | `@wordpress/scripts` → `plugins/pivora-core/build/blocks/` |

**Gap:** Core feels *required* for good patterns, not *chosen* for extra power. This roadmap closes that gap.

---

## Target architecture (end state)

```text
plugins/pivora-core/
├── pivora-core.php
├── includes/
│   ├── class-pivora-core.php      # Bootstrap, hooks
│   ├── blocks.php                 # Block category, shared assets
│   ├── patterns.php               # Plugin pattern registration
│   ├── demo-import.php            # → evolves into starter-studio/
│   ├── starter-studio/            # Phase 1: import, rollback, export
│   ├── cpt/                       # Phase 2: case study, logo, team
│   ├── integrations/              # Phase 1–2: forms, woo, seo bridges
│   ├── admin.php                  # → pivora-dashboard.php
│   └── rest/                      # Phase 2+: kit export API
├── patterns/
├── src/blocks/
└── build/blocks/
```

---

## Phase 0 — Foundation & positioning (before new features)

**Goal:** Make Core maintainable and marketable as a standalone plugin.

| # | Item | Status | Files / notes |
|---|------|--------|----------------|
| P0.1 | Plugin readme positioning — standalone value prop, screenshots, blocks list | done | `plugins/pivora-core/readme.txt` |
| P0.2 | **Works without Pivora theme** test matrix (TT4, Ollie) documented | done | `docs/CORE_PLUGIN_COMPAT.md` |
| P0.3 | Block inventory doc — attributes, patterns used, fallback behavior | pending | This file § Block registry (below) |
| P0.4 | Rename admin menu **Pivora → Dashboard** with sections: Kits, Blocks, Help | done | `includes/dashboard.php` |
| P0.5 | Shared block surface SCSS audit — all blocks use `shared/_surface.scss` | pending | `src/blocks/shared/` |

**Exit criteria**

- [ ] Another developer can add a block using the checklist without reading the whole plugin.
- [ ] Plugin readme explains install value without mentioning theme first.

---

## Phase 1 — Starter Site Studio 2.0 (highest ROI)

**Goal:** Demo import becomes a product people install Core for — partial import, rollback, export.

| # | Item | Status | Files / notes |
|---|------|--------|----------------|
| P1.1 | **Partial kit import** — homepage only, blog seed only, shop pages only | done | `includes/starter-studio/import-scopes.php` |
| P1.2 | **Pre-import snapshot + rollback** — store front page ID, menus, header/footer options | done | `includes/starter-studio/snapshot.php`, option `pivora_core_import_snapshot` |
| P1.3 | **Import progress UI** — stepped admin screen, clear errors | done | `includes/demo-import.php` admin render |
| P1.4 | **Kit export (JSON)** — export kit manifest + pattern slugs for agencies | done | `includes/starter-studio/export.php`, `npm run kit:export` |
| P1.5 | **Kit import from JSON** — upload `.pivora-kit.json` | done | `includes/starter-studio/import-manifest.php` |
| P1.6 | **2 new kits** — local business, nonprofit (theme patterns + plugin blocks) | done | `patterns/starter-*.php`, kit registry |
| P1.7 | WooCommerce guard UX polish — clear message when store kit selected without WC | done | Admin notice + disabled import button |

**Acceptance criteria**

- User can import **homepage only** without overwriting blog posts.
- **Rollback** restores previous front page and menu within one admin click.
- Agency can **export** and **re-import** a kit on a fresh install.
- All kit operations use nonces, capability checks (`edit_theme_options`), and sanitized input.

**Theme coordination**

- New starter patterns live in **theme** `patterns/` when possible; plugin only when they require plugin-only blocks.
- Register kits in `pivora_get_demo_kits()` filter.

---

## Phase 2 — High-leverage blocks (focused library)

**Goal:** 5 new blocks that fill pattern gaps and work on any block theme. Target **14 blocks total** (not 40).

| # | Block | Why | Status | Pattern to wire |
|---|-------|-----|--------|-----------------|
| P2.1 | **Logo grid / marquee** | Trust sections on every SaaS/agency site | done | `pivora/logo-grid` block + `logo-cloud` pattern upgrade |
| P2.2 | **Stats counter** | Pairs with metrics bands | done | `pivora/stats-grid` + `metrics-band` pattern |
| P2.3 | **Process steps / timeline** | Missing from pattern library §6 | done | `pivora/process-steps` + `patterns/process-steps.php` |
| P2.4 | **Comparison tabs** | SaaS pricing/feature compare | done | `pivora/comparison-tabs` + `comparison-table` pattern |
| P2.5 | **Woo product grid** (curated) | Store starter becomes dynamic | done | `pivora/product-grid` + `product-spotlight` pattern |

**Per-block checklist**

1. `src/blocks/{name}/block.json` + `index.js` + `render.php` (prefer dynamic render).
2. SCSS in block folder + shared tokens.
3. `npm run build` — commit `build/blocks/{name}/`.
4. Wire into ≥1 pattern (theme `inc/pattern-blocks.php` or plugin pattern).
5. Document in § Block registry below.
6. Test with Core active/inactive on Pivora + one third-party block theme.

**Acceptance criteria**

- [ ] Each block loads **zero frontend JS** unless interaction required (marquee/tabs may need minimal view script).
- [ ] Lighthouse: no block adds render-blocking assets globally.
- [ ] Editor preview matches frontend.

---

## Phase 3 — Capture & conversion bridge

**Goal:** Replace pattern placeholders with real conversion paths without building a form product.

| # | Item | Status | Files / notes |
|---|------|--------|----------------|
| P3.1 | **Lead capture block** — name, email, message → `wp_mail` or webhook URL | done | `src/blocks/lead-capture/` |
| P3.2 | **Form plugin bridge** — detect WPForms / CF7 / Forminator; style-preserving embed wrapper | done | `includes/integrations/forms.php` |
| P3.3 | Upgrade `lead-capture-band` pattern to use lead block | done | `patterns/lead-capture-band.php` |
| P3.4 | **Announcement bar** — schedule (start/end date), dismiss with `localStorage` | done | Extend `announcement-bar` block |
| P3.5 | **Optional slide-in CTA** — single variant, accessible, one per session | done | `src/blocks/slide-in-cta/` |

**Acceptance criteria**

- [ ] Lead block works with no third-party plugin.
- [ ] Contact and newsletter theme patterns document how to swap in form plugin blocks.
- [ ] Announcement bar respects `prefers-reduced-motion` and keyboard focus.

**Out of scope:** Multi-step funnels, A/B testing, CRM sync.

---

## Phase 4 — Content types (portable data)

**Goal:** Patterns become live content; data survives theme switches.

| # | CPT | Blocks | Status | Notes |
|---|-----|--------|--------|-------|
| P4.1 | **Client logo** | Logo grid block (manual + query) | pending | Taxonomy: industry optional |
| P4.2 | **Case study** | Card, grid, featured hero | pending | Template parts in **theme**; query in **plugin** |
| P4.3 | **Team member** (CPT) | Migrate from static block-only | pending | Block reads CPT or manual override |

| # | Item | Status |
|---|------|--------|
| P4.4 | Admin list tables with featured image + excerpt | pending |
| P4.5 | Seed demo content for portfolio + agency kits | pending |
| P4.6 | REST exposure for headless-ready fields (optional) | pending |

**Acceptance criteria**

- [ ] Deactivating theme does not delete CPT content.
- [ ] Patterns insert **empty states** with “add case studies” admin links when no posts exist.

---

## Phase 5 — WooCommerce behavior layer

**Goal:** Theme keeps CSS; Core adds store **behavior** blocks.

| # | Item | Status | Files / notes |
|---|------|--------|----------------|
| P5.1 | **Mini-cart block** — drawer or dropdown, WC Blocks compatible | pending | `src/blocks/mini-cart/` |
| P5.2 | **Free shipping progress bar** block | pending | Requires WC cart session |
| P5.3 | **Curated collection block** — hand-pick products or category | pending | Extends P2.5 |
| P5.4 | Store kit uses live products when WC sample data present | pending | `demo-import.php` |

**Acceptance criteria**

- [ ] No WC CSS in plugin — only structure hooks and minimal layout.
- [ ] Blocks no-op gracefully when WooCommerce inactive.

---

## Phase 6 — Integrations & developer ergonomics

| # | Item | Status | Notes |
|---|------|--------|-------|
| P6.1 | SEO breadcrumb bridge — render Rank Math / Yoast breadcrumb in page-header pattern slot | pending | Mirror theme `seo-plugins.php` approach |
| P6.2 | **Display conditions** (light) — show block if: user logged in, first visit, URL contains | pending | Block attribute + server render |
| P6.3 | `pivora_core_*` filters/actions doc | pending | `docs/CORE_PLUGIN_HOOKS.md` |
| P6.4 | Kit CLI — `npm run kit:export -- --slug=agency` | pending | `scripts/kit-export.sh` |
| P6.5 | PHPUnit tests for import snapshot + rollback | pending | `plugins/pivora-core/tests/` |

---

## Phase 7 — Distribution & polish (post–1.0 theme)

| # | Item | Status | Notes |
|---|------|--------|-------|
| P7.1 | WordPress.org plugin submission (standalone listing) | pending | Separate from theme zip |
| P7.2 | Block pattern directory / block screenshots for inserter | pending | |
| P7.3 | **Pro consideration** — premium kits, white-label export, priority support | optional | Business decision |
| P7.4 | Rename debate: **Pivora Core** vs **Pivora Blocks** | optional | See § Open decisions |

---

## Block registry

Update this table when adding blocks.

| Block name | Slug | Frontend JS | Theme pattern(s) | Fallback without plugin |
|------------|------|-------------|------------------|-------------------------|
| Icon box | `pivora/icon-box` | No | `feature-grid`, `store-benefits` | Core columns + heading |
| Testimonial card | `pivora/testimonial-card` | No | `testimonials-grid` | Core quote |
| Pricing card | `pivora/pricing-card` | No | `pricing-table*` | Core group + heading |
| Pricing billing toggle | `pivora/pricing-billing-toggle` | Yes (`view.js`) | Pricing variants | Static monthly copy |
| FAQ item | `pivora/faq-item` | No | `faq-section` | Core details block |
| Announcement bar | `pivora/announcement-bar` | Yes (`view.js`) | Plugin pattern | — |
| Social links bar | `pivora/social-links-bar` | No | Plugin pattern | — |
| Curated post grid | `pivora/curated-post-grid` | No | `latest-posts` | Core query loop |
| Team member | `pivora/team-member` | No | `team-grid` | Core image + text |
| Logo grid | `pivora/logo-grid` | No | `logo-cloud` | Static paragraphs |
| Stats grid | `pivora/stats-grid` | No | `metrics-band` | Static metric groups |
| Process steps | `pivora/process-steps` | No | `process-steps` | Core ordered list |
| Comparison tabs | `pivora/comparison-tabs` | Yes (`view.js`) | `comparison-table` | Core table |
| Woo product grid | `pivora/product-grid` | No | `product-spotlight` | Core query loop |
| Lead capture | `pivora/lead-capture` | No | `lead-capture-band`, contact, newsletter | Paragraph placeholder |
| Form embed | `pivora/form-embed` | No | contact (when form plugin active) | Plugin form blocks |
| Slide-in CTA | `pivora/slide-in-cta` | Yes (`view.js`) | — | — |

---

## Suggested sprint order (first 8 weeks)

| Sprint | Focus | Delivers |
|--------|-------|----------|
| **S1** | P0 + P1.1–P1.3 | Dashboard, partial import, rollback |
| **S2** | P1.4–P1.6 + P2.1 | Kit export, logo grid block, 1 new kit |
| **S3** | P2.2–P2.3 + P3.1 | Stats, process steps, lead capture |
| **S4** | P2.4–P2.5 + P3.2–P3.3 | Comparison tabs, product grid, form bridge |
| **S5** | P3.4–P3.5 + P4.1 | Announcement schedule, slide-in CTA, logos CPT |
| **S6** | P4.2–P4.3 + P5.1 | Case studies, team CPT, mini-cart |
| **S7** | P5.2–P5.4 + P6.1 | Shipping bar, store kit polish, SEO bridge |
| **S8** | QA + P7.1 prep | org readme, compat matrix, 0.x plugin release |

---

## Quality gates (every phase)

Run before merging plugin changes:

```bash
npm run build
npm run check          # includes PHPCS on plugin PHP
npm run package:plugin
```

Manual:

- [ ] Block works in Site Editor and post editor
- [ ] Block works with Pivora theme **and** Twenty Twenty-Four (or Ollie)
- [ ] Pattern degrades acceptably with plugin **deactivated**
- [ ] No new global frontend assets
- [ ] Capabilities + nonces on admin actions
- [ ] Strings wrapped in `pivora-core` text domain

---

## Open decisions

Record decisions here before implementation forks.

| # | Question | Options | Decision |
|---|----------|---------|----------|
| D1 | WordPress.org listing | Theme only / Theme + plugin separate | _TBD_ |
| D2 | Plugin brand name | Pivora Core / Pivora Blocks | _TBD_ |
| D3 | Commercial model | 100% free / Freemium kits / Pro blocks | _TBD_ |
| D4 | CPTs in free vs pro | All free / Case study pro-only | _TBD_ |
| D5 | Logo marquee JS | CSS-only scroll / minimal view.js | _TBD_ |

---

## What we are not building

- Full visual page builder or custom canvas
- SEO, analytics, caching, SMTP, CRM
- 20+ blocks to match Spectra block count
- Replacing core Query Loop, Navigation, or Cover blocks
- Forced plugin install from theme
- Heavy popup targeting (geo, referrer, exit intent suites)

---

## Version mapping

| Plugin version | Milestone |
|----------------|-----------|
| **0.1.x** | Current — blocks, kits, basic import |
| **0.2.0** | Phase 1 complete — Studio 2.0 (partial import + rollback) |
| **0.3.0** | Phase 2 complete — 5 new blocks wired to patterns |
| **0.4.0** | Phase 3 complete — lead capture + form bridge |
| **0.5.0** | Phase 4 complete — CPTs + demo seed |
| **0.6.0** | Phase 5 complete — Woo behavior blocks |
| **1.0.0** | Phases 0–6 stable, org-ready, documented hooks |

Theme **1.0.0** and plugin **1.0.0** do not need to ship on the same day; document compatibility matrix per release.

---

## Quick start (developers)

```bash
# From theme repo root
npm install
npm run build                    # compile blocks
npm run env:start
npm run setup:demo:agency        # plugin + agency kit

# Package plugin only
npm run package:plugin
```

**Add a new block:** follow Phase 2 per-block checklist and update § Block registry in this file.
