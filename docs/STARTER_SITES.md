# Starter Sites

Pivora includes one-click **starter compositions** in the block inserter under **Pivora Starters**. Use them on any page with the **Landing Page** template.

## Available starters

| Starter | Best for | Sections included |
|---------|----------|-------------------|
| **Business landing** | SaaS, agencies, services | Hero, metrics, features, services, pricing, CTA |
| **SaaS landing** | Startups, product launches | SaaS hero, metrics, features, pricing, CTA |
| **Blog landing** | Editorial, publishing | Editorial feature, latest posts, CTA |
| **Store landing** | WooCommerce demos | Store hero, benefits, features, CTA |
| **Portfolio landing** | Creatives, studios | Portfolio grid, editorial feature, CTA |

## Quick setup in wp-admin

1. **Pages → Add New**
2. Set template to **Landing Page**
3. Open the block inserter → **Patterns** → **Pivora Starters**
4. Insert the starter that matches your site type
5. Publish and assign the page under **Settings → Reading** if needed

The demo script preloads Portfolio with the portfolio starter:

```bash
npm run setup:demo
```

## Mix and match

Starters are composed of existing Pivora section patterns. After inserting a starter, you can:

- Reorder sections
- Delete blocks you do not need
- Insert additional patterns from other Pivora categories
- Customize copy, colors, and buttons in the Site Editor

## Related docs

- [SETUP.md](./SETUP.md) — local environment and admin login
- [BLOG_LAYOUTS.md](./BLOG_LAYOUTS.md) — archive and single-post layout switcher
- [ADMIN_TESTING.md](./ADMIN_TESTING.md) — full site-owner test checklist
