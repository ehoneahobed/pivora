# Admin Testing Guide

Use this checklist after `npm run setup:demo` to test Pivora the way a site owner or agency would — through **wp-admin** and the **Site Editor**, not only the frontend.

## Log in

| Field | Value |
|-------|-------|
| Admin URL | `http://localhost:8888/wp-admin/` |
| Site Editor | `http://localhost:8888/wp-admin/site-editor.php` |
| Username | `admin` |
| Password | `password` |

Custom credentials (optional):

```bash
PIVORA_ADMIN_USER=you PIVORA_ADMIN_PASS=secret npm run setup:demo
```

Full demo with WooCommerce:

```bash
npm run setup:demo:full
```

---

## 1. Dashboard smoke test

After logging in, confirm:

- [ ] **Appearance → Themes** — Pivora is active
- [ ] **Settings → Reading** — static front page = Home, posts page = Blog
- [ ] **Settings → Permalinks** — Post name structure
- [ ] **Pages** — Home, Blog, Contact, Portfolio exist
- [ ] **Posts** — at least three sample posts

---

## 2. Site Editor — templates

Go to **Appearance → Editor → Templates** and preview:

| Template | What to verify |
|----------|----------------|
| Front Page | Hero, metrics overlap, features, services, latest posts, CTA |
| Home / Index | Blog header band, archive layout (see Blog Layouts), pagination |
| Single Posts | Classic, Magazine, Minimal, or Feature layouts |
| Pages | Cloud title band, optional image, constrained content |
| 404 | Centered empty state with search |
| Archive Product | Shop header, product grid (after WooCommerce setup) |
| Single Product | Gallery + summary columns, details, related products |

Edit a template, save, and confirm changes appear on the frontend.

---

## 3. Site Editor — template parts

Under **Template Parts**:

- [ ] **Header** — logo/title, navigation (Blog, Portfolio, Contact, Shop), mobile overlay
- [ ] **Footer** — grid layout and credits

Try changing the site title or a nav label and publish.

---

## 4. Patterns (inserter)

Create or edit a page, open the block inserter → **Patterns** → Pivora categories:

- [ ] Business hero
- [ ] Feature grid
- [ ] Pricing table
- [ ] Portfolio grid
- [ ] Editorial feature
- [ ] Store hero + store benefits
- [ ] CTA simple

Confirm editor preview matches the frontend after publish.

---

## 5. Page templates

Edit **Portfolio** and confirm:

- Template: **Landing Page**
- Content includes the Portfolio grid pattern

Create a new page and try:

- **Full Width Page** — wide content column
- **Blank Canvas** — no header/footer

---

## 6. Blog workflow

As a site owner would:

1. **Posts → Add New** — write a post with featured image
2. Publish and check `/blog/` archive card
3. Open the single post — prev/next nav, tags if added
4. Confirm the homepage “Latest posts” section picks up new posts

---

## 7. Blog layout switcher

1. Go to **Appearance → Blog Layouts**
2. Try each archive style (grid, list, magazine, compact) and save
3. Preview `/blog/` after each change
4. Set a default single layout, then override one post via **Template** in the post editor

See [BLOG_LAYOUTS.md](./BLOG_LAYOUTS.md).

---

## 8. WooCommerce (optional)

After `npm run setup:demo:full`:

1. **Products → Add New** — create a simple product with image and price
2. Visit `/shop/` — product card grid
3. Open the product — gallery, add to cart, tabs
4. Test cart/checkout styling (WooCommerce blocks or classic checkout)

---

## 9. Style variations

**Appearance → Editor → Styles** — switch between:

- Default
- Editorial
- Bold
- Ecommerce

Confirm colors and typography update without breaking layouts.

---

## 9. Accessibility pass (admin + frontend)

- [ ] Tab from the top — skip link appears and jumps to `#content`
- [ ] Navigate header links with keyboard only
- [ ] Check focus rings on buttons and form fields
- [ ] Test mobile nav overlay at narrow widths

---

## 10. Visitor-mode check

Log out (or use a private window) and browse as a visitor:

- [ ] Homepage CTAs go to `/blog/`, `/contact/`, `/#patterns`
- [ ] Header nav works on all demo pages
- [ ] No console errors in browser devtools

---

## Troubleshooting

**Cannot log in**

```bash
npm run setup:demo
```

This resets the `admin` password to `password`.

**Lost Site Editor changes**

Theme file templates override until customized. Clear customized templates under **Appearance → Editor** if you want to revert to theme defaults.

**Shop 404**

```bash
npm run setup:demo:full
```
