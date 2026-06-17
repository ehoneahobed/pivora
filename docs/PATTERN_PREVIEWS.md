# Pattern previews in the block editor

WordPress renders pattern thumbnails as scaled-down live previews. Pivora sets `viewportWidth` on every registered pattern so the inserter preview matches the intended layout width.

## Viewport widths

| Width | Used for |
|-------|----------|
| **1440** | Full landing heroes, business/SaaS starters, footer columns, mega sections |
| **1200** | Standard sections, grids, blog/store/editorial patterns |

All values are defined in `inc/patterns.php` on each pattern row.

## Why some previews look sparse

- **Starter patterns** that reference other patterns may show placeholders until nested patterns resolve in the full canvas.
- **Query-based patterns** (latest posts, product spotlight) look empty when the site has no posts or products yet.
- **Template grid** in the Site Editor uses tiny renders; judge layout on the frontend or after inserting into a page.

## Recommended QA flow

1. Run **Pivora → Starter Kits** or `npm run setup:demo` so the home page and sample posts exist.
2. Insert the pattern on a **Landing Page** template (or the home page).
3. Compare editor canvas and frontend at desktop and mobile widths.
4. For store patterns, run `npm run setup:demo:store` with WooCommerce enabled.

## Capturing screenshots (optional)

For marketing or theme directory assets:

1. Import the relevant demo kit.
2. Open the target page on the frontend at 1440px viewport.
3. Capture full-width sections individually; avoid the Site Editor pattern grid for hero shots.
4. Name files by slug, e.g. `pattern-faq-section.webp`, under `docs/screenshots/patterns/` if you add a marketing folder later.

## Related

- [BLOCKS_AND_PATTERNS_ROADMAP.md](./BLOCKS_AND_PATTERNS_ROADMAP.md)
- [STARTER_SITES.md](./STARTER_SITES.md)
- [ADMIN_TESTING.md](./ADMIN_TESTING.md)
