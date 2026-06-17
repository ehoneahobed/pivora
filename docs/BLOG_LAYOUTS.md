# Blog Layouts

Pivora ships multiple blog archive and single-post layouts as **theme features** — no plugin required.

## Switch archive layout (site-wide)

1. Log in to wp-admin
2. Go to **Appearance → Blog Layouts**
3. Choose an archive style:
   - **Card grid** — default 3-column cards
   - **Split list** — horizontal rows with thumbnail + copy
   - **Magazine lead** — first post featured large, remaining posts in a 2-column grid
   - **Compact cards** — dense 2-column text cards
4. Click **Save blog layouts**
5. Visit `/blog/` or any archive to preview

This applies to:

- Blog index (`home.html`)
- Archives (`archive.html`)
- Search results (`search.html`)
- Index fallback (`index.html`)

## Switch single-post layout

### Site-wide default

Under **Appearance → Blog Layouts**, choose a **Single style** default:

- **Classic band** — cloud header band (default `single.html`)
- **Magazine hero** — full-width featured image, then title
- **Minimal focus** — centered typography, narrow column
- **Feature split** — sidebar with image/meta, wide content column

### Per-post override

1. Edit a post
2. Open the **Template** panel in the sidebar (or document settings)
3. Choose a Pivora single template:
   - Single: Magazine Hero
   - Single: Minimal Focus
   - Single: Feature Split
   - Default (Classic band)

Per-post templates always override the site-wide default.

## Site Editor alternative

Archive layouts are powered by the `blog-query` template part. Advanced users can edit the layout parts under **Appearance → Editor → Template Parts → Blog Query** — but the **Appearance → Blog Layouts** screen is the intended switcher for clients.

## Technical notes

- Layout settings are stored in `wp_options` as `pivora_blog_archive_layout` and `pivora_single_post_layout`
- Body classes: `pivora-blog-layout-{slug}` and `pivora-single-layout-{slug}`
- Template part files live in `parts/blog-query-*.html`
- Single templates live in `templates/single-*.html` and are registered in `theme.json`
