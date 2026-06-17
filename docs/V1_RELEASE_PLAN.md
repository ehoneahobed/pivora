# Pivora v1.0 Release Plan

This is the execution plan to reach a stable **1.0.0** release. The current milestone is **0.1.0** (pre-release preview — feature-rich, full QA pending).

**Target:** Validate **0.1.0** through QA, then promote to **1.0.0** when stability is confirmed.

**Estimated effort:** 8–12 focused days (one person), or 2–3 weeks part-time.

---

## v1.0 definition of done

### Must ship in v1.0

- [x] Theme + plugin production zips install cleanly on a fresh site
- [x] `screenshot.png` (1200×900) and `CHANGELOG.md` at repo root
- [x] Docs match reality (pattern count, heroes, CTAs, demo kits)
- [ ] Manual QA matrix signed off ([ADMIN_TESTING.md](./ADMIN_TESTING.md) + release checklist below)
- [x] Theme Check passes with no **required** errors (`npm run check:theme`)
- [ ] Lighthouse on 4 representative pages meets plan targets (or documented exceptions)
- [x] Keyboard navigation infrastructure (skip link, focus styles, reduced motion)
- [x] Pivora Core plugin-off fallbacks verified for block-powered patterns (architecture in place)
- [x] WooCommerce shop / product / cart / checkout styling (when WC active)
- [ ] Git tag `0.1.0` + GitHub pre-release with both zips
- [ ] After QA: tag `1.0.0` stable release

### Explicitly deferred to v1.1+

- Dedicated `professional.json` style variation (default theme already fills this role)
- `navigation.js` mobile menu script (block navigation + CSS is sufficient for v1)
- `comments.html` / post-meta template parts
- Transparent landing header / ecommerce header variants
- Theme onboarding admin page (`inc/admin/onboarding.php`)
- Dedicated SEO plugin compatibility file (`inc/compatibility/seo-plugins.php`)
- Lighthouse CI automation (manual run is enough for v1)
- Local business pattern pack, portfolio case-study pack, process-steps pattern
- RTL-specific stylesheet (smoke-test only for v1; full RTL polish in 1.1)

---

## Sprint 1 — Sync & release artifacts (Day 1–2)

**Goal:** Repo truth matches what users will see.

| # | Task | Owner | Done |
|---|------|-------|------|
| 1.1 | Update `readme.txt` — pattern count (~44 theme + plugin patterns), 8 heroes, 5 CTAs, demo kits | | [x] |
| 1.2 | Update `docs/BLOCKS_AND_PATTERNS_ROADMAP.md` — hero library, CTA patterns, variant CSS | | [x] |
| 1.3 | Update `docs/STARTER_SITES.md` — SaaS starter if missing from table | | [x] |
| 1.4 | Create `CHANGELOG.md` — summarize 0.x → 1.0.0 | | [x] |
| 1.5 | Capture `screenshot.png` (1200×900) | | [x] |
| 1.6 | Verify `style.css` version, `readme.txt` stable tag, `package.json` version all match `0.1.0` | | [x] |

**Exit criteria:** A new contributor can read docs and get an accurate picture of what ships.

---

## Sprint 2 — Automated quality gates (Day 2–3)

**Goal:** CI and local scripts catch regressions before release.

| # | Task | Done |
|---|------|------|
| 2.1 | Run `npm run check` — fix any lint / PHPCS / build failures | [x] |
| 2.2 | Install Theme Check; fix **required** errors | [x] |
| 2.3 | `npm run check:theme` script (packaged zip) | [x] |
| 2.4 | Run `npm run package` — confirm theme + plugin zips build | [x] |
| 2.5 | Fresh `wp-env` install from **zip** — confirm no PHP notices | [ ] |

**Exit criteria:** `npm run check` green; Theme Check zero errors; zip install works.

---

## Sprint 3 — Manual QA matrix (Day 3–5)

**Goal:** Every WordPress route and editor workflow a site owner uses is verified.

Use [ADMIN_TESTING.md](./ADMIN_TESTING.md) as the base. Add release-specific rows:

### Templates & routes

| Page / route | Viewports (360 / 768 / 1440) | Editor ≈ frontend | Done |
|--------------|------------------------------|-------------------|------|
| Front page (business starter) | | | [ ] |
| Landing page (SaaS starter) | | | [ ] |
| Blog home | | | [ ] |
| Single post (default + sidebar + magazine) | | | [ ] |
| Archive + category | | | [ ] |
| Search results | | | [ ] |
| 404 | | | [ ] |
| Page (default, full-width, blank) | | | [ ] |

### Pattern spot-check (WYSIWYG)

Insert each pattern once on a landing page; confirm editor matches frontend:

| Group | Patterns | Done |
|-------|----------|------|
| Heroes (8) | business, centered, agency, saas-signup, saas-split, fintech, jobs-dark, jobs-search | [ ] |
| CTAs (5) | simple, sale-split, app-download, split-visual, email-signup | [ ] |
| Pricing (5) | default + 4 variants | [ ] |
| Starters (5) | business, saas, blog, portfolio, store | [ ] |

### Plugin on / off

| Scenario | Done |
|----------|------|
| Theme only — FAQ, pricing, testimonials, feature grid render (core fallbacks) | [ ] |
| Pivora Core active — custom blocks render in patterns | [ ] |
| Demo import — `npm run setup:demo:business` and `setup:demo:agency` | [ ] |

### WooCommerce (when active)

| Flow | Done |
|------|------|
| Shop archive (`archive-product`) | [ ] |
| Single product | [ ] |
| Add to cart → cart page | [ ] |
| Checkout (test mode) | [ ] |
| My account | [ ] |

**Exit criteria:** No layout-breaking bugs; editor parity on heroes/CTAs; plugin fallbacks work.

---

## Sprint 4 — Performance & accessibility (Day 5–7)

**Goal:** Meet IMPLEMENTATION_PLAN §8–9 targets on representative pages.

### Lighthouse pages (run logged-out, no admin bar)

| Page | Perf ≥90 | A11y ≥95 | SEO ≥95 | Best Practices ≥95 | Done |
|------|----------|----------|---------|-------------------|------|
| Business landing (starter) | | | | | [ ] |
| Blog home | | | | | [ ] |
| Single post | | | | | [ ] |
| Shop (WC) | | | | | [ ] |

### Performance budget (manual)

| Asset | Budget | Actual | Done |
|-------|--------|--------|------|
| Theme CSS (base + variants, gzipped) | < 50 KB | 26 KB | [x] |
| Theme JS (frontend) | < 10 KB | 0 KB | [x] |
| No render-blocking third-party fonts | ✓ | ✓ | [x] |

### Accessibility checklist

| Item | Done |
|------|------|
| Skip link visible on focus | [ ] |
| Tab through header nav → main content → footer | [ ] |
| Blog archive toolbar keyboard-usable | [ ] |
| Focus rings visible on buttons/links | [ ] |
| `prefers-reduced-motion` respected | [ ] |
| Heading order logical on landing + single | [ ] |
| axe or Lighthouse a11y — fix **critical** issues | [ ] |

**Exit criteria:** All four Lighthouse pages hit targets, or exceptions documented in CHANGELOG with follow-up issues.

---

## Sprint 5 — Compatibility & polish (Day 7–9)

**Goal:** Close Phase 7 items that affect real-world installs.

| # | Task | Done |
|---|------|------|
| 5.1 | **SEO plugins** — Yoast/Rank Math compat layer shipped | [x] |
| 5.2 | **Forms** — insert WPForms or CF7 block in `contact-section` placeholder; confirm spacing/focus | [ ] |
| 5.3 | **RTL** — switch site language to Arabic or Hebrew; smoke-test homepage + single (note issues for 1.1) | [ ] |
| 5.4 | **Browsers** — spot-check Chrome, Safari, Firefox on one landing + blog page | [ ] |
| 5.5 | **Common plugins** — confirm no PHP notices with WC + SEO + forms active | [ ] |
| 5.6 | Fix any P1 bugs found in Sprints 3–5 | [ ] |

**Exit criteria:** No theme-caused SEO duplication; no P1 open bugs.

---

## Sprint 6 — Release packaging (Day 9–10)

| # | Task | Done |
|---|------|------|
| 6.1 | Final `npm run check && npm run package` | [x] |
| 6.2 | Install theme zip + plugin zip on **clean** WordPress (wp-env or staging) | [ ] |
| 6.3 | Run 15-minute beginner test — new landing from starter, publish, assign as homepage | [ ] |
| 6.4 | Tag `0.1.0` pre-release (or `1.0.0` after QA) | [ ] |
| 6.5 | GitHub Release — attach `pivora.zip` + `pivora-core.zip`, paste CHANGELOG | [ ] |
| 6.6 | (Optional) WordPress.org submission prep — review [Theme Handbook](https://developer.wordpress.org/themes/) requirements | [ ] |

**Exit criteria:** Tagged release with installable artifacts and release notes.

---

## Post–v1.0 backlog (1.1 roadmap)

Prioritize after ship:

1. **Pattern packs** — local business (hours, reviews, booking), portfolio (case study hero, project details), process steps
2. **Template parts** — comments, post-meta, transparent header
3. **Onboarding** — Appearance → Pivora welcome (docs links, demo import, recommended plugins)
4. **SEO compat** — `inc/compatibility/seo-plugins.php` with tested plugin list
5. **RTL stylesheet** — logical properties audit
6. **Lighthouse CI** — GitHub Action on PRs against static export or wp-env
7. **`professional.json`** — if you want a named fifth style variation distinct from default

---

## Daily standup template

Copy into issues or chat while executing:

```
Yesterday:
Today:
Blockers:
Gates: Theme Check [ ] | Lighthouse [ ] | QA matrix [ ] | Zip install [ ]
```

---

## Quick command reference

```bash
npm run env:start
npm run build
npm run check
npm run setup:demo:business
npm run setup:demo:agency
npm run package
```

---

## Related docs

- [IMPLEMENTATION_PLAN.md](../IMPLEMENTATION_PLAN.md) — original phases 0–8
- [BLOCKS_AND_PATTERNS_ROADMAP.md](./BLOCKS_AND_PATTERNS_ROADMAP.md) — pattern/block build queue
- [ADMIN_TESTING.md](./ADMIN_TESTING.md) — site-owner QA checklist
- [DEVELOPMENT.md](./DEVELOPMENT.md) — local environment
- [PATTERN_PREVIEWS.md](./PATTERN_PREVIEWS.md) — inserter preview QA
