# Pivora Core — theme compatibility

Pivora Core is designed to work **with or without** the Pivora theme. Blocks ship self-contained styles with `theme.json` preset fallbacks. Starter kits require theme patterns for full fidelity.

## Test matrix

| Environment | Blocks | Plugin patterns | Starter kits | Notes |
|-------------|--------|-----------------|--------------|-------|
| **Pivora theme + Core** | Full | Full | Full | Recommended setup |
| **Twenty Twenty-Four + Core** | Good | Partial | Partial | Theme patterns missing; blocks still insert and render |
| **Ollie + Core** | Good | Partial | Partial | Preset fallbacks apply; kit homepages need Pivora patterns or manual swap |

## What works without Pivora theme

- All nine custom blocks in the block inserter (Pivora category)
- Five plugin-registered patterns (`pivora-core/*`)
- Admin dashboard: **Pivora → Starter Kits**, **Blocks**, **Help**
- Partial import, snapshot, and rollback (pages and options only)

## What requires the Pivora theme

- Theme starter patterns (`pivora/starter-*`) used by most demo kits
- Header/footer variant switching (`pivora_header_variant`, `pivora_footer_variant`)
- Template parts referenced in kit previews (`header`, `footer`, `page-landing`)

## Degradation behavior

1. **Pattern loading** — `pivora_load_pattern_markup()` checks the block registry, then plugin `patterns/`, then theme `patterns/` when `PIVORA_PATH` is defined.
2. **Missing patterns** — Import returns an error if homepage markup cannot be resolved.
3. **Block styles** — Each block enqueues compiled CSS from `build/blocks/` with CSS custom properties mapped to `var(--wp--preset--*)` when available.

## Manual QA checklist (other themes)

1. Activate TT4 or Ollie, install and activate Pivora Core.
2. Create a page; insert `pivora/icon-box`, `pivora/pricing-card`, and `pivora/faq-item`.
3. Save and view the front end — confirm spacing, colors, and typography are readable.
4. Open **Pivora → Blocks** — confirm help screen loads.
5. Optional: import **agency** kit only (uses `pivora-core/starter-agency-landing`) with **Homepage** scope checked.

## Reporting issues

File compatibility bugs with: WordPress version, PHP version, active theme, block or kit slug, and screenshots of editor vs front end.
