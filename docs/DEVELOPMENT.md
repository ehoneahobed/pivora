# Pivora Development Notes

## Local Requirements

- WordPress 6.5 or newer.
- Docker Desktop.
- Node.js suitable for the installed `@wordpress/scripts` version.
- Composer and WordPress Coding Standards when running PHPCS locally or inside `wp-env`.

The recommended local environment is `@wordpress/env`. It runs WordPress, PHP, WP-CLI, MySQL, and test tooling through Docker so the project does not depend on host PHP.

## Useful Commands

```bash
npm install
npm run env:start
npm run env -- run cli composer --working-dir=/var/www/html/wp-content/themes/pivora install
npm run env:status
npm run wp -- theme list
npm run wp -- theme activate pivora
npm run check
npm run check:budget
npm run check:theme
npm run lint:css
npm run check:php
```

The local WordPress site is available at `http://localhost:8888` unless `wp-env` selects another port. Log in with username `admin` and password `password`.

PHP checks run through Composer inside the `wp-env` CLI container, so host PHP is not required.

## Environment Lifecycle

```bash
npm run env:start
npm run env:status
npm run env:logs
npm run env:stop
```

Use `npm run env -- start --update` after changing `.wp-env.json`.

Only use `npm run env -- destroy` when you intentionally want to delete the local WordPress database and containers for this project.

## Architecture Rules

- Keep `functions.php` as a bootstrap file only.
- Place PHP behavior in focused files inside `inc/`.
- Keep design tokens in `theme.json`.
- Prefer block templates, template parts, patterns, and style variations over custom settings screens.
- Do not add plugin territory features to the theme.
- Load assets conditionally when a feature does not need to be global.


## WooCommerce Compatibility

Pivora includes presentational WooCommerce support only. The theme declares WooCommerce image/grid support and conditionally loads `assets/css/woocommerce.css` when WooCommerce is active.

Rules for future ecommerce work:

- Keep commerce data, checkout behavior, carts, and account logic inside WooCommerce.
- Prefer CSS and WooCommerce hooks before template overrides.
- Load WooCommerce-specific assets only when WooCommerce is active.
- Keep ecommerce patterns usable without requiring WooCommerce to be installed.

## Manual Smoke Test

1. Activate the theme.
2. Visit the homepage, a page, a post, an archive, search results, and a 404.
3. Open the Site Editor and confirm header, footer, templates, styles, and patterns are editable.
4. Navigate with the keyboard only.
5. Run a Lighthouse audit on the homepage and a single post.
