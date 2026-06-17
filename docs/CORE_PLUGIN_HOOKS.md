# Pivora Core hooks and filters

Reference for extending Pivora Core (`plugins/pivora-core/`) without forking. All hooks use the `pivora_core_*` or `pivora_*` prefix.

## Filters

### `pivora_demo_kits`

**File:** `includes/demo-import.php`

Merges or replaces registered starter kit definitions shown in **Pivora → Starter kits**.

```php
add_filter( 'pivora_demo_kits', function ( array $kits ): array {
	$kits['custom'] = array(
		'label'       => 'Custom kit',
		'description' => 'Agency starter',
		'homepage'    => 'starter-agency-landing',
	);

	return $kits;
} );
```

### `pivora_core_form_providers`

**File:** `includes/integrations/forms.php`

Registers detected form plugins for the form embed block.

```php
add_filter( 'pivora_core_form_providers', function ( array $providers ): array {
	$providers['gravityforms'] = array(
		'label'    => 'Gravity Forms',
		'callback' => static fn (): bool => class_exists( 'GFAPI' ),
	);

	return $providers;
} );
```

### `pivora_core_form_shortcode`

**File:** `includes/integrations/forms.php`

Builds a shortcode string for custom form providers.

```php
add_filter(
	'pivora_core_form_shortcode',
	function ( string $shortcode, string $provider, string $form_id ): string {
		if ( 'gravityforms' === $provider ) {
			return sprintf( '[gravityform id="%s" ajax="true"]', esc_attr( $form_id ) );
		}

		return $shortcode;
	},
	10,
	3
);
```

### `pivora_core_seo_breadcrumb_html`

**File:** `includes/integrations/seo.php`

Filters breadcrumb markup before the SEO breadcrumb block wraps it. Use to customize Rank Math, Yoast, or fallback output.

### `pivora_core_display_condition_types`

**File:** `includes/display-conditions.php`

Adds or removes display condition options in the block editor.

### `pivora_core_display_condition_passes`

**File:** `includes/display-conditions.php`

Final gate for whether a `pivora/*` block should render. Receives the condition key, value, and full attribute array.

```php
add_filter(
	'pivora_core_display_condition_passes',
	function ( bool $passes, string $condition, string $value, array $attributes ): bool {
		if ( 'weekend_only' === $condition ) {
			return in_array( (int) gmdate( 'w' ), array( 0, 6 ), true );
		}

		return $passes;
	},
	10,
	4
);
```

## Actions

### `pivora_core_lead_submitted`

**File:** `includes/lead-capture-handler.php`

Fires after a lead capture form is processed.

```php
add_action(
	'pivora_core_lead_submitted',
	function ( array $lead, bool $sent ): void {
		// $lead keys: name, email, message
	},
	10,
	2
);
```

## Helper functions (public API)

These functions are safe to call from themes and companion plugins when Pivora Core is active.

| Function | Purpose |
|----------|---------|
| `pivora_core_has_seo_plugin()` | Whether Rank Math, Yoast, or The SEO Framework is active |
| `pivora_core_get_seo_breadcrumb_html()` | Breadcrumb markup string |
| `pivora_core_render_seo_breadcrumb()` | Echoes breadcrumb block output |
| `pivora_core_passes_display_condition( $attributes )` | Evaluates display rules server-side |
| `pivora_core_get_form_providers()` | Registered form plugin providers |
| `pivora_core_is_woocommerce_active()` | WooCommerce availability check |
| `pivora_core_build_product_query_args( $attributes )` | Product query args for grid/collection blocks |
| `pivora_core_save_import_snapshot()` | Saves pre-import site state |
| `pivora_core_restore_import_snapshot()` | Restores the last snapshot |
| `pivora_core_export_kit_json( $slug )` | JSON manifest for kit export |

## Constants

| Constant | Value |
|----------|-------|
| `PIVORA_CORE_VERSION` | Plugin version string |
| `PIVORA_CORE_PATH` | Absolute plugin directory path |
| `PIVORA_CORE_URL` | Plugin URL |
| `PIVORA_CORE_IMPORT_SNAPSHOT_OPTION` | Option key for rollback snapshots |
| `PIVORA_CORE_RETURNING_VISITOR_COOKIE` | Cookie used by first-visit display rules |

## Adding display conditions to a block

1. Add `displayCondition` and `displayConditionValue` to `block.json`.
2. Import `DisplayConditionPanel` from `src/blocks/shared/display-condition-panel.js` in the block editor script.
3. Server-side filtering is automatic for all `pivora/*` blocks via `render_block`.

## Kit export CLI

```bash
npm run kit:export -- --slug=agency
```

Writes `dist/kits/agency.pivora-kit.json`. Requires wp-env or a local WordPress install with the plugin active.

## PHPUnit

```bash
composer install
composer test:plugin
```

Runs snapshot tests in `plugins/pivora-core/tests/`. Use wp-env for integration-style runs:

```bash
npm run env:start
composer test:plugin
```
