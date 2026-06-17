# Pivora Setup Guide

Get Pivora running locally for **frontend browsing** and **full wp-admin testing** — the same workflow a site owner would use.

## Quick start

```bash
npm install
npm run env:start
npm run setup:demo
```

Then log in:

| | |
|---|---|
| **Dashboard** | http://localhost:8888/wp-admin/ |
| **Site Editor** | http://localhost:8888/wp-admin/site-editor.php |
| **Username** | `admin` |
| **Password** | `password` |

For WooCommerce included:

```bash
npm run setup:demo:full
```

See [ADMIN_TESTING.md](./ADMIN_TESTING.md) for the full site-owner test checklist.

---

## What `setup:demo` configures

### Via WP-CLI (automatic)

- Activates Pivora
- Resets/creates the `admin` user (`password` by default)
- Sets pretty permalinks
- Creates **Home**, **Blog**, **Contact**, and **Portfolio** pages
- Assigns **Landing Page** template + portfolio pattern to Portfolio
- Adds starter copy to Contact
- Configures Reading settings (static front page + posts page)
- Seeds three sample blog posts
- Installs WooCommerce shop pages when WooCommerce is active

### In the theme (ready to edit in admin)

- Header navigation links: Blog, Portfolio, Contact, Shop
- Front page template with bundled patterns
- All templates, patterns, and style variations available in the Site Editor

---

## Frontend URLs

| Page | URL |
|------|-----|
| Front page | `/` |
| Blog | `/blog/` |
| Contact | `/contact/` |
| Portfolio | `/portfolio/` |
| Shop (with WooCommerce) | `/shop/` |

Pattern buttons use `pivora_url()` so they follow your page slugs.

---

## wp-admin workflows to test

### Appearance → Editor

- Edit **Templates** (front page, blog, single, pages, shop)
- Edit **Template parts** (header, footer)
- Insert **Patterns** from Pivora categories
- Try **Style variations** (Editorial, Bold, Ecommerce)

### Content

- **Posts → Add New** — test blog cards and single layout
- **Pages** — try Landing, Full Width, and Blank templates
- **Products** (WooCommerce) — test shop archive and single product

### Settings

- **Reading** — already set by `setup:demo`; verify static front page
- **Permalinks** — Post name (`/%postname%/`)
- **Appearance → Blog Layouts** — switch archive and single-post presentation

See [BLOG_LAYOUTS.md](./BLOG_LAYOUTS.md) for layout options.

---

## Pattern link map

| Button | Path |
|--------|------|
| Explore Patterns | `/#patterns` |
| View Templates / View Articles / Read feature | `/blog/` |
| Start Building / pricing CTAs / Learn more | `/contact/` |
| View all work | `/portfolio/` |
| Shop collection | `/shop/` |

Update slugs under **Pages** or edit button URLs in the Site Editor after renaming.

---

## Custom admin credentials

```bash
PIVORA_ADMIN_USER=you PIVORA_ADMIN_PASS=yourpass npm run setup:demo
```

---

## CLI-only workflow (no browser)

If you only need URLs and content seeded without logging in:

```bash
npm run setup:demo
npm run check
```

---

## Troubleshooting

**Cannot access wp-admin**

1. Ensure Docker is running: `npm run env:start`
2. Reset credentials: `npm run setup:demo`
3. Open http://localhost:8888/wp-admin/ (not https)

**404 on `/blog/` or `/contact/`**

```bash
npm run setup:demo
npm run wp -- rewrite flush --hard
```

**Shop link 404**

```bash
npm run setup:demo:full
```

**Theme not found**

```bash
npm run wp -- theme list
npm run wp -- theme activate pivora
```

See [TEST_ENVIRONMENT.md](./TEST_ENVIRONMENT.md) for Docker reset and quality commands.
