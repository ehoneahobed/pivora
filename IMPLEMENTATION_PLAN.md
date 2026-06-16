# Pivora WordPress Theme Implementation Plan

## 1. Vision

Pivora should become a modern, high-performance, multi-purpose WordPress theme for creators, businesses, agencies, publishers, and ecommerce sites. The goal is not to ship a bloated "everything theme." The goal is to ship a clean, modular design system that gives users broad site-building power while preserving speed, accessibility, SEO readiness, maintainability, and long-term WordPress compatibility.

The theme should feel professional out of the box, easy for beginners to use, and clean enough for developers to extend without fighting the codebase.

## 2. Product Principles

### 2.1 WordPress-Native First

Use WordPress-native APIs and editor capabilities before adding custom abstractions.

- Use `theme.json` as the source of truth for design tokens.
- Use block templates, template parts, style variations, and patterns for site building.
- Use WordPress enqueue APIs for assets.
- Use WordPress sanitization, escaping, translation, and security APIs.
- Avoid custom admin UI unless it solves a real onboarding or customization problem.

### 2.2 Presentation Belongs In The Theme

The theme should control design and layout. It should not own business-critical functionality that disappears when a user switches themes.

The theme may provide:

- Layouts.
- Templates.
- Patterns.
- Global styles.
- WooCommerce presentation.
- Editor styling.
- Accessibility improvements.
- SEO-friendly markup structure.

The theme should not provide:

- SEO settings.
- Analytics tracking.
- Contact forms.
- Custom post types for business data.
- Shortcodes.
- Caching systems.
- Social sharing systems.
- Plugin auto-installation.

### 2.3 Performance Is A Feature

Every implementation decision should protect Core Web Vitals.

Targets:

- Largest Contentful Paint: under 2.5 seconds.
- Interaction to Next Paint: under 200 milliseconds.
- Cumulative Layout Shift: under 0.1.
- Lighthouse Performance: 90+ on representative pages.
- No unnecessary render-blocking scripts.
- No global frontend JavaScript unless needed.
- CSS and JS loaded only where needed.

### 2.4 SEO-Ready, Not SEO-Bloated

The theme should create excellent foundations for search visibility without replacing dedicated SEO plugins.

SEO readiness means:

- Semantic HTML.
- Clean heading hierarchy.
- Fast pages.
- Responsive mobile-first layouts.
- Accessible navigation.
- Crawlable content.
- Schema-compatible markup.
- Clean archive, taxonomy, search, single, page, and 404 templates.
- Compatibility with popular SEO plugins.

### 2.5 Modular Multi-Purpose Design

Pivora should support many site types through templates and patterns, not through tightly coupled feature code.

Target use cases:

- Business websites.
- SaaS and startup landing pages.
- Agencies and freelancers.
- Blogs and editorial sites.
- Portfolios.
- Education sites.
- Nonprofits.
- Restaurants and local businesses.
- WooCommerce stores.
- Product launch pages.

## 3. Recommended Architecture

### 3.1 Theme Type

Build Pivora as a block-first theme with carefully scoped PHP support.

This gives us:

- Full Site Editing support.
- Better user customization.
- Cleaner global styles.
- Easier pattern-driven site creation.
- Future compatibility with WordPress direction.

PHP should be used for setup, asset loading, theme support, translations, pattern registration when needed, editor integrations, and optional compatibility layers.

### 3.2 Proposed File Structure

```text
pivora/
├── assets/
│   ├── css/
│   │   ├── base.css
│   │   ├── blocks/
│   │   ├── components/
│   │   ├── editor.css
│   │   └── woocommerce.css
│   ├── fonts/
│   ├── images/
│   └── js/
│       ├── navigation.js
│       └── editor.js
├── inc/
│   ├── assets.php
│   ├── setup.php
│   ├── template-tags.php
│   ├── compatibility/
│   │   ├── woocommerce.php
│   │   └── seo-plugins.php
│   └── admin/
│       └── onboarding.php
├── parts/
│   ├── header.html
│   ├── footer.html
│   ├── sidebar.html
│   └── comments.html
├── patterns/
│   ├── hero-business.php
│   ├── hero-saas.php
│   ├── feature-grid.php
│   ├── pricing-table.php
│   ├── testimonials.php
│   ├── faq.php
│   ├── cta.php
│   ├── blog-grid.php
│   ├── portfolio-grid.php
│   └── ecommerce-featured-products.php
├── styles/
│   ├── professional.json
│   ├── editorial.json
│   ├── minimal.json
│   ├── bold.json
│   └── ecommerce.json
├── templates/
│   ├── 404.html
│   ├── archive.html
│   ├── home.html
│   ├── index.html
│   ├── page.html
│   ├── search.html
│   ├── single.html
│   └── page-landing.html
├── theme.json
├── functions.php
├── style.css
├── readme.txt
├── screenshot.png
└── package.json
```

### 3.3 Naming And Prefixing

Use `pivora_` for PHP functions, filters, actions, constants, and option names.

Examples:

- `pivora_setup()`
- `pivora_enqueue_assets()`
- `pivora_register_pattern_categories()`
- `pivora_is_woocommerce_active()`

Asset handles should use the `pivora-` prefix:

- `pivora-base`
- `pivora-editor`
- `pivora-navigation`
- `pivora-woocommerce`

## 4. Design System Plan

### 4.1 Design Tokens

Define all core visual decisions in `theme.json`.

Tokens:

- Color palette.
- Gradients only where truly useful.
- Typography scale.
- Font families.
- Font sizes.
- Line heights.
- Spacing scale.
- Content widths.
- Border radii.
- Shadows.
- Layout constraints.

Avoid a one-note visual language. The default theme should feel refined, practical, and broadly useful. Style variations can provide stronger visual personalities.

### 4.2 Typography

Use a small, high-quality typography system.

Requirements:

- System font stack by default for speed.
- Optional bundled local font pair if the visual identity requires it.
- No remote font loading by default.
- Stable line heights for good readability.
- Responsive typography through discrete sizes, not viewport-width scaling.
- Strong defaults for headings, paragraphs, captions, buttons, navigation, and form controls.

### 4.3 Layout

Define predictable layout primitives:

- Narrow content width.
- Standard content width.
- Wide content width.
- Full-width sections.
- Responsive grid utilities.
- Consistent vertical rhythm.
- Stable image aspect ratios.
- Sidebar-ready layouts.
- Landing page layouts.

### 4.4 Style Variations

Initial style variations:

1. Professional: default business style.
2. Minimal: clean portfolio and personal brand style.
3. Editorial: blog, magazine, and publishing style.
4. Bold: launch pages and creative agencies.
5. Ecommerce: product-focused store style.

Each style variation should change tokens, not rewrite the theme.

## 5. Template System

### 5.1 Required Templates

Ship polished versions of:

- `index.html`
- `home.html`
- `front-page.html`
- `single.html`
- `page.html`
- `archive.html`
- `search.html`
- `404.html`
- `page-landing.html`

### 5.2 Recommended Optional Templates

Add as the theme matures:

- `single-product.html` if WooCommerce block templates are supported.
- `archive-product.html`.
- `page-sidebar.html`.
- `page-full-width.html`.
- `page-blank.html`.
- `single-sidebar.html`.

### 5.3 Template Parts

Header variants:

- Default header.
- Centered logo header.
- Split navigation header.
- Transparent landing header.
- Ecommerce header.

Footer variants:

- Simple footer.
- Multi-column footer.
- Newsletter-ready footer.
- Ecommerce footer.

Other parts:

- Comments.
- Sidebar.
- Post meta.
- Pagination.
- Search form.

## 6. Pattern Library

Patterns are the core of the multi-purpose experience.

### 6.1 Business Patterns

- Hero with CTA.
- Logo cloud.
- Service grid.
- Feature split.
- Process steps.
- Testimonials.
- Team section.
- FAQ.
- Contact CTA.

### 6.2 SaaS And Startup Patterns

- Product hero.
- Feature grid.
- Metrics band.
- Integration logos.
- Pricing table.
- Comparison table.
- Security/trust section.
- Product screenshot section.

### 6.3 Blog And Editorial Patterns

- Featured post hero.
- Post grid.
- Category highlights.
- Newsletter CTA.
- Author bio.
- Related posts.
- Sidebar composition.

### 6.4 Portfolio Patterns

- Project grid.
- Case study hero.
- Project details.
- Client testimonial.
- Services summary.
- Availability CTA.

### 6.5 Ecommerce Patterns

- Store hero.
- Featured products.
- Category grid.
- Product benefits.
- Trust badges.
- Promo banner.
- Product comparison.

### 6.6 Local Business Patterns

- Opening hours.
- Location/contact band.
- Service area section.
- Menu/pricing section.
- Booking CTA.
- Reviews section.

## 7. SEO Implementation Strategy

### 7.1 Markup

Use semantic HTML across every template:

- One `main` landmark per page.
- Clear `header`, `nav`, `footer`, and `article` landmarks.
- Logical heading order.
- Search results and archive pages that expose meaningful titles and descriptions.
- Post templates that expose title, date, author, categories, tags, and content clearly.

### 7.2 Compatibility With SEO Plugins

Test with:

- Yoast SEO.
- Rank Math.
- The SEO Framework.

The theme should avoid duplicate schema, duplicate breadcrumbs, duplicate meta tags, and hardcoded SEO controls.

### 7.3 Structured Data Position

Do not build a full schema manager into the theme.

Acceptable theme responsibilities:

- Use semantic markup that SEO plugins can enhance.
- Avoid markup that conflicts with schema plugins.
- Optionally expose clean hooks/classes around article, breadcrumb, and product areas.

### 7.4 Internal Linking And Navigation

Provide strong layouts for:

- Breadcrumb plugin output.
- Related posts.
- Category archives.
- Pagination.
- Previous/next post navigation.
- Footer navigation.

### 7.5 Image SEO

Theme responsibilities:

- Preserve WordPress image attributes.
- Use responsive image output.
- Avoid replacing images with CSS backgrounds when the image is content.
- Reserve image dimensions to prevent layout shifts.
- Style captions cleanly.

## 8. Performance Implementation Strategy

### 8.1 Asset Loading

Rules:

- Enqueue assets through WordPress APIs.
- Load frontend JS only when required.
- Use small, focused CSS files.
- Prefer block-specific styles where useful.
- Avoid large frontend frameworks.
- Avoid icon font libraries.
- Use SVG icons inline or as optimized assets where needed.
- Do not load remote assets by default.

### 8.2 CSS Strategy

Recommended structure:

- `base.css`: normalized base styles and low-level utilities.
- `components/*.css`: reusable theme components.
- `blocks/*.css`: block-specific enhancements.
- `editor.css`: editor-only styling.
- `woocommerce.css`: WooCommerce-only styling.

Use CSS custom properties tied to `theme.json` tokens.

### 8.3 JavaScript Strategy

JavaScript should be rare and purposeful.

Allowed initial scripts:

- Accessible mobile navigation.
- Optional small UI enhancements.
- Editor-only helper behavior if needed.

Avoid:

- jQuery dependency unless WordPress or compatibility requires it.
- Sliders in the core theme.
- Animation libraries.
- Scroll hijacking.
- Global listeners that run on every page without need.

### 8.4 Media Strategy

- Use modern image sizes.
- Define stable aspect ratios.
- Avoid layout shifts from late-loading images.
- Keep screenshot and bundled demo assets optimized.
- Do not bundle large demo media in the production theme.

### 8.5 Performance Budgets

Initial budgets for a clean page:

- Theme CSS: under 50 KB compressed.
- Theme JS: under 10 KB compressed.
- No more than 1 theme frontend JS file by default.
- No render-blocking third-party resources.
- Lighthouse Performance: 90+.
- Lighthouse Accessibility: 95+.
- Lighthouse Best Practices: 95+.
- Lighthouse SEO: 95+.

## 9. Accessibility Implementation Strategy

### 9.1 Baseline Requirements

- Skip link.
- Visible focus states.
- Keyboard-accessible navigation.
- Accessible mobile menu.
- Correct button/link semantics.
- Reduced motion support.
- Sufficient color contrast.
- Form controls with clear focus and labels.
- Logical DOM order.

### 9.2 Testing

Test with:

- Keyboard-only navigation.
- Browser accessibility tree inspection.
- Lighthouse accessibility audit.
- axe DevTools or equivalent.
- Mobile menu keyboard behavior.
- Screen reader smoke test where practical.

### 9.3 Accessibility-Ready Goal

The theme should be built toward WordPress.org `accessibility-ready` expectations even if we do not submit for that tag immediately.

## 10. WooCommerce Strategy

WooCommerce support should be presentational and modular.

Initial support:

- Product grid styling.
- Product card consistency.
- Single product layout polish.
- Cart and checkout visual consistency.
- Notices, buttons, forms, prices, badges, sale states.
- Empty cart state.
- Account pages.

Rules:

- Only load WooCommerce CSS when WooCommerce is active.
- Do not replace WooCommerce business logic.
- Do not override templates unless necessary.
- Prefer hooks and CSS before template overrides.

## 11. Editor Experience

The editor should look close to the frontend.

Requirements:

- Editor stylesheet.
- Accurate content width.
- Accurate typography.
- Accurate block spacing.
- Pattern previews that look polished.
- Clear pattern categories.
- Style variations that preview well.

Pattern categories:

- Pivora Business.
- Pivora SaaS.
- Pivora Editorial.
- Pivora Portfolio.
- Pivora Ecommerce.
- Pivora Local.
- Pivora CTAs.

## 12. Onboarding Strategy

Keep onboarding useful and restrained.

Initial onboarding:

- Welcome page with theme status.
- Documentation links.
- Recommended plugins list using user-triggered install flow only.
- Starter template guidance.
- Changelog link.

Do not:

- Redirect automatically after activation.
- Force plugin installs.
- Show persistent nag notices.
- Hide WordPress UI.

Recommended plugins may include:

- WooCommerce for stores.
- A reputable SEO plugin.
- A forms plugin.
- A performance plugin.

The copy should clearly explain that these are optional and controlled by the user.

## 13. Security And Compliance

### 13.1 PHP Security

Every PHP file should follow:

- Escape output with the correct escaping function.
- Sanitize input before storage.
- Verify nonces for state-changing admin actions.
- Check capabilities before admin operations.
- Avoid direct file access where appropriate.
- Use prepared statements for custom queries if any are ever needed.

### 13.2 WordPress.org Theme Requirements

Design for compliance from day one:

- GPL-compatible licensing.
- Valid `style.css` headers.
- Valid `readme.txt`.
- Translation-ready strings.
- Unique prefixes.
- No PHP or JS warnings.
- No bundled plugin functionality.
- No remote assets without consent.
- Source files included for minified assets.
- Screenshot follows required dimensions and guidelines.

## 14. Internationalization

Requirements:

- Use theme slug as text domain.
- Wrap all user-facing PHP strings in translation functions.
- Avoid hardcoded English text in PHP-rendered UI.
- Support RTL styles.
- Test at least one RTL language.
- Keep templates translatable where WordPress supports it.

## 15. Developer Tooling

### 15.1 Package Scripts

Add scripts for:

- CSS build.
- JS build.
- Lint CSS.
- Lint JS.
- PHPCS.
- Theme Check.
- Format.
- Build production zip.

Example scripts:

```json
{
  "scripts": {
    "build": "wp-scripts build",
    "start": "wp-scripts start",
    "lint:js": "wp-scripts lint-js",
    "lint:css": "wp-scripts lint-style",
    "format": "wp-scripts format",
    "check:php": "phpcs",
    "check:theme": "theme-check",
    "zip": "wp-scripts plugin-zip"
  }
}
```

The exact tooling should be chosen after checking the local development environment.

### 15.2 Coding Standards

Use:

- WordPress Coding Standards for PHP.
- Stylelint for CSS.
- ESLint for JavaScript.
- Prettier where compatible.
- EditorConfig.

### 15.3 Local Development

Recommended setup:

- Docker-based WordPress environment or `wp-env`.
- Latest stable WordPress.
- Latest stable PHP supported by target hosts.
- WooCommerce test install.
- SEO plugin compatibility install.
- Theme unit test data.

## 16. Testing Strategy

### 16.1 Manual Test Matrix

Test pages:

- Homepage.
- Landing page.
- Blog index.
- Single post.
- Page.
- Archive.
- Search results.
- 404.
- WooCommerce shop.
- Single product.
- Cart.
- Checkout.

Test viewports:

- 360px mobile.
- 768px tablet.
- 1024px laptop.
- 1440px desktop.

Test modes:

- Logged out.
- Logged in admin bar visible.
- Dark browser mode if supported.
- Reduced motion.
- Keyboard navigation.
- RTL language.

### 16.2 Automated Checks

Add quality gates:

- PHP syntax check.
- PHPCS.
- JS lint.
- CSS lint.
- Theme Check.
- Lighthouse CI for representative pages.
- Accessibility scan.

### 16.3 Browser Support

Support current stable versions of:

- Chrome.
- Safari.
- Firefox.
- Edge.

Mobile:

- iOS Safari.
- Android Chrome.

## 17. Documentation Plan

Create documentation for:

- Installation.
- First setup.
- Using style variations.
- Using patterns.
- Building landing pages.
- Customizing header and footer.
- WooCommerce setup.
- Recommended plugins.
- Developer hooks and filters.
- Child theme guidance.
- Performance best practices.
- Accessibility notes.
- Changelog.

Docs should be written for beginners without dumbing down the implementation.

## 18. Release Strategy

### 18.1 Versioning

Use semantic versioning:

- `0.x`: internal development.
- `1.0.0`: first public stable release.
- Patch releases for bug fixes.
- Minor releases for new patterns/templates.
- Major releases for breaking changes.

### 18.2 Release Checklist

Before release:

- Update version in `style.css`.
- Update version in `readme.txt`.
- Update changelog.
- Run linting.
- Run PHPCS.
- Run Theme Check.
- Run accessibility checks.
- Run Lighthouse checks.
- Test WooCommerce if supported.
- Verify screenshot.
- Verify license/resource attributions.
- Build clean zip.
- Install zip on a fresh WordPress site.

## 19. Implementation Phases

### Phase 0: Project Foundation

Deliverables:

- Initialize theme file structure.
- Add `style.css`, `functions.php`, `theme.json`, `readme.txt`.
- Add license and resource attribution files.
- Add development tooling.
- Add basic build scripts.
- Add coding standards configuration.

Acceptance criteria:

- Theme appears in WordPress admin.
- Theme activates without warnings.
- Basic page renders.
- Lint/build scripts run.

### Phase 1: Core Design System

Deliverables:

- Complete initial `theme.json`.
- Add base CSS.
- Add editor CSS.
- Define typography, color, spacing, layout, and block defaults.
- Add first style variation.

Acceptance criteria:

- Editor and frontend share the same visual foundation.
- Common core blocks render cleanly.
- No layout instability from base styles.

### Phase 2: Template Foundation

Deliverables:

- Core templates.
- Header and footer parts.
- Search, archive, single, page, 404 templates.
- Post meta and pagination patterns.

Acceptance criteria:

- All standard WordPress routes render polished layouts.
- Keyboard navigation works.
- SEO-friendly heading structure is preserved.

### Phase 3: Pattern Library V1

Deliverables:

- Business patterns.
- SaaS patterns.
- Editorial patterns.
- CTA patterns.
- Pattern categories.

Acceptance criteria:

- Users can create a professional multi-section homepage from patterns.
- Pattern previews are clean in the editor.
- Patterns are responsive without custom fixes.

### Phase 4: Performance And Accessibility Hardening

Deliverables:

- Conditional asset loading.
- Mobile navigation script if needed.
- Accessibility fixes.
- Performance budgets enforced.
- Lighthouse baseline established.

Acceptance criteria:

- Lighthouse Performance 90+ on representative pages.
- Lighthouse Accessibility 95+.
- Keyboard navigation passes manual testing.
- No avoidable CLS in core templates.

### Phase 5: WooCommerce Support

Deliverables:

- WooCommerce compatibility file.
- Shop/product/cart/checkout styling.
- Store patterns.
- Ecommerce style variation.

Acceptance criteria:

- WooCommerce pages look consistent with the theme.
- WooCommerce assets load only when needed.
- Checkout remains accessible and usable on mobile.

### Phase 6: Starter Site System

Deliverables:

- Starter pattern compositions.
- Demo content strategy.
- Import/onboarding guidance.
- Industry starter sets.

Initial starter sets:

- Business.
- SaaS.
- Agency.
- Blog.
- Portfolio.
- Ecommerce.

Acceptance criteria:

- A beginner can create a complete site quickly.
- Starter content does not lock users into custom functionality.

### Phase 7: Compatibility And Polish

Deliverables:

- SEO plugin compatibility checks.
- Forms plugin visual compatibility.
- RTL support.
- Browser testing.
- Documentation.
- Release packaging.

Acceptance criteria:

- No duplicate SEO output caused by the theme.
- RTL layout is usable.
- Documentation covers the primary workflows.
- Release zip installs cleanly.

### Phase 8: Public Release

Deliverables:

- `1.0.0` release.
- Final screenshot.
- Final readme.
- Changelog.
- Support documentation.
- Submission-ready zip.

Acceptance criteria:

- Fresh install passes smoke tests.
- Theme Check passes.
- No PHP warnings or notices.
- Performance and accessibility gates pass.

## 20. Initial Backlog

### Critical

- Create base theme scaffold.
- Define `theme.json`.
- Add setup and asset enqueue architecture.
- Add semantic base templates.
- Add accessibility-safe header/navigation.
- Add base style system.
- Add PHPCS and linting.

### High

- Add core pattern library.
- Add style variations.
- Add editor styling.
- Add performance budget checks.
- Add SEO plugin compatibility test notes.
- Add documentation.

### Medium

- Add WooCommerce polish.
- Add onboarding screen.
- Add starter site compositions.
- Add RTL support.
- Add visual regression testing.

### Later

- Add advanced starter templates.
- Add deeper builder compatibility.
- Add optional companion plugin for functionality outside theme territory.
- Add marketplace/demo site.

## 21. Key Technical Decisions To Make Before Coding

1. Should Pivora be submitted to WordPress.org, sold commercially, or both?
2. Should we use only system fonts initially or bundle local brand fonts?
3. Should starter sites be pattern-based only, or include an importer later?
4. Should WooCommerce support ship in version `1.0.0` or `1.1.0`?
5. Should we build a companion plugin for optional functionality such as custom blocks, demo imports, analytics integrations, and advanced starter site management?

## 22. Definition Of Done

A feature is done only when:

- It is implemented using WordPress-native APIs where possible.
- It follows the established file structure.
- It is documented when user-facing.
- It is responsive.
- It is keyboard accessible.
- It does not create avoidable layout shift.
- It does not load unnecessary assets globally.
- It does not introduce PHP, JS, or CSS lint issues.
- It does not cross into plugin territory.
- It has been tested in the editor and frontend.

## 23. Success Metrics

Technical:

- 90+ Lighthouse Performance.
- 95+ Lighthouse Accessibility.
- 95+ Lighthouse SEO.
- Passing Theme Check.
- Passing PHPCS.
- No frontend console errors.
- No PHP warnings or notices.

Product:

- A beginner can create a complete homepage in under 15 minutes.
- A developer can understand the file structure in under 10 minutes.
- A business site, blog, portfolio, and store can all be built without custom code.
- The theme remains fast after activating common plugins.

## 24. Recommended First Sprint

Sprint goal: create a clean, working foundation.

Tasks:

1. Scaffold the theme files and folders.
2. Add valid `style.css` metadata.
3. Add `functions.php` that loads organized files from `inc/`.
4. Add `inc/setup.php` for theme supports.
5. Add `inc/assets.php` for asset loading.
6. Add initial `theme.json`.
7. Add `templates/index.html`, `templates/page.html`, `templates/single.html`, `templates/404.html`.
8. Add `parts/header.html` and `parts/footer.html`.
9. Add `assets/css/base.css` and `assets/css/editor.css`.
10. Add `readme.txt`.
11. Add initial lint/build configuration.
12. Activate the theme locally and fix all warnings.

Expected outcome:

The theme activates, renders basic WordPress content cleanly, has a real design-system foundation, and is ready for templates, patterns, and performance work.
