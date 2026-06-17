# Pivora Test Environment

This project uses `@wordpress/env` for local WordPress testing. That gives us a repeatable Docker-based environment with WordPress, PHP, MySQL, and WP-CLI without requiring PHP or MySQL to be installed on the host machine.

## Why This Setup

Manual local stacks drift over time. A theme like Pivora needs predictable testing for activation, templates, editor behavior, PHP compatibility, performance, accessibility, and WooCommerce/plugin compatibility. `wp-env` keeps that foundation close to WordPress core tooling and makes setup reproducible for every contributor.

## Requirements

- Docker Desktop running.
- Node.js.
- npm.

Host PHP is not required for the local WordPress runtime because PHP runs inside Docker.

## First-Time Setup

```bash
npm install
npm run env:start
npm run env -- run cli composer --working-dir=/var/www/html/wp-content/themes/pivora install
npm run setup:demo
```

The `setup:demo` command activates Pivora, creates core pages, configures Reading settings, and seeds a sample post — no wp-admin required. See [SETUP.md](./SETUP.md) for details.

The local WordPress site should start at:

- Development site: `http://localhost:8888`
- Test site: `http://localhost:8889`

Default login (reset anytime with `npm run setup:demo`):

- Dashboard: `http://localhost:8888/wp-admin/`
- Site Editor: `http://localhost:8888/wp-admin/site-editor.php`
- Username: `admin`
- Password: `password`

Full WooCommerce demo:

```bash
npm run setup:demo:full
```

See [SETUP.md](./SETUP.md) and [ADMIN_TESTING.md](./ADMIN_TESTING.md) for the site-owner test checklist.

## Activate The Theme

Because this repository folder is currently named `pivora`, WordPress registers the local theme slug as `pivora`.

```bash
npm run wp -- theme list
npm run wp -- theme activate pivora
npm run wp -- option get stylesheet
```

Expected active stylesheet:

```text
pivora
```

For public release packaging, the distributable theme folder should be named `pivora` so the final theme slug is clean.

## Daily Workflow

Start the environment:

```bash
npm run env:start
```

Check running containers:

```bash
docker ps
```

Run WP-CLI:

```bash
npm run wp -- theme list
npm run wp -- option get home
```

Stop the environment:

```bash
npm run env:stop
```

View logs:

```bash
npm run env:logs
```

## Smoke Test Checklist

After activating Pivora:

1. Open `http://localhost:8888`.
2. Log in at `http://localhost:8888/wp-admin`.
3. Go to Appearance > Editor.
4. Confirm the header and footer template parts are editable.
5. Confirm the templates appear under Design > Templates.
6. Confirm Pivora patterns appear in the inserter.
7. Create a page using the Business hero pattern.
8. Test the frontend at mobile and desktop widths.
9. Navigate the site using only the keyboard.
10. Check the browser console for errors.

## Quality Commands

```bash
npm run check:json
npm run lint:css
npm run lint:js
npm run check:php
```

`check:php` runs Composer-installed PHPCS inside the `wp-env` CLI container, so it does not require host PHP.

## Known Local Issue

The host machine currently has root-owned files in `~/.npm`, which causes normal npm installs to fail with `EACCES`. This project uses a repository-local npm cache through `.npmrc`:

```text
cache=.npm-cache
```

That keeps this project self-contained. The host-level repair, if you want to fix npm globally later, is the command npm recommended:

```bash
sudo chown -R 501:20 "/Users/ehoneahobed/.npm"
```

Run that manually only if you want to repair the global npm cache outside this project.

## Resetting The Environment

Use this only when you intentionally want to delete the local WordPress database and start over:

```bash
npm run env -- destroy
npm run env:start
```
