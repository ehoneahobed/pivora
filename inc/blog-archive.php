<?php
/**
 * Blog archive helpers: sorting, filters, and toolbar shortcodes.
 *
 * @package Pivora
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns allowed blog archive orderby keys.
 *
 * @return array<string, string>
 */
function pivora_get_blog_orderby_options(): array {
	return array(
		'date'   => __( 'Newest', 'pivora' ),
		'oldest' => __( 'Oldest', 'pivora' ),
		'title'  => __( 'Title A–Z', 'pivora' ),
	);
}

/**
 * Returns the active blog archive orderby key.
 *
 * @return string
 */
function pivora_get_blog_orderby(): string {
	$orderby = isset( $_GET['orderby'] ) ? sanitize_key( wp_unslash( (string) $_GET['orderby'] ) ) : 'date'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	return array_key_exists( $orderby, pivora_get_blog_orderby_options() ) ? $orderby : 'date';
}

/**
 * Returns the canonical blog posts index URL.
 *
 * @return string
 */
function pivora_get_blog_posts_url(): string {
	$posts_page = (int) get_option( 'page_for_posts' );

	if ( $posts_page > 0 ) {
		$url = get_permalink( $posts_page );
		if ( is_string( $url ) && '' !== $url ) {
			return $url;
		}
	}

	return home_url( '/blog/' );
}

/**
 * Returns the current archive URL used by toolbar forms.
 *
 * @return string
 */
function pivora_get_current_blog_archive_url(): string {
	if ( is_search() ) {
		return get_search_link( get_search_query( false ) );
	}

	if ( is_category() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$link = get_category_link( $term->term_id );
			if ( ! is_wp_error( $link ) ) {
				return $link;
			}
		}
	}

	if ( is_tag() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$link = get_tag_link( $term->term_id );
			if ( ! is_wp_error( $link ) ) {
				return $link;
			}
		}
	}

	if ( is_author() ) {
		return get_author_posts_url( (int) get_queried_object_id() );
	}

	if ( is_date() ) {
		return get_year_link( (int) get_query_var( 'year' ) );
	}

	return pivora_get_blog_posts_url();
}

/**
 * Applies blog archive sorting from the query string to the main query.
 *
 * @param WP_Query $query Main query instance.
 */
function pivora_blog_archive_pre_get_posts( WP_Query $query ): void {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( ! ( is_home() || is_archive() || is_search() ) ) {
		return;
	}

	if ( $query->is_post_type_archive() && 'post' !== $query->get( 'post_type' ) ) {
		return;
	}

	$orderby = pivora_get_blog_orderby();

	switch ( $orderby ) {
		case 'oldest':
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'ASC' );
			break;
		case 'title':
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
			break;
		default:
			$query->set( 'orderby', 'date' );
			$query->set( 'order', 'DESC' );
			break;
	}
}
add_action( 'pre_get_posts', 'pivora_blog_archive_pre_get_posts' );

/**
 * Renders hidden fields that preserve archive context when sorting.
 *
 * @param string $orderby Active orderby key.
 */
function pivora_render_blog_sort_hidden_fields( string $orderby ): void {
	if ( is_search() ) {
		$search_query = get_search_query( false );
		if ( '' !== $search_query ) {
			printf(
				'<input type="hidden" name="s" value="%s" />',
				esc_attr( $search_query )
			);
		}
	}

	$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
	if ( $paged > 1 ) {
		printf(
			'<input type="hidden" name="paged" value="%d" />',
			$paged
		);
	}

	unset( $orderby );
}

/**
 * Renders the blog archive sort control.
 *
 * @return string
 */
function pivora_render_blog_sort_control(): string {
	$current = pivora_get_blog_orderby();
	$action  = pivora_get_current_blog_archive_url();

	ob_start();
	?>
	<form class="pivora-blog-toolbar__sort" method="get" action="<?php echo esc_url( $action ); ?>">
		<?php pivora_render_blog_sort_hidden_fields( $current ); ?>
		<label class="screen-reader-text" for="pivora-blog-orderby"><?php esc_html_e( 'Sort posts', 'pivora' ); ?></label>
		<select id="pivora-blog-orderby" name="orderby" onchange="this.form.submit()">
			<?php foreach ( pivora_get_blog_orderby_options() as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current, $value ); ?>>
					<?php echo esc_html( $label ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</form>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'pivora_blog_sort', 'pivora_render_blog_sort_control' );

/**
 * Renders category filter pills for the blog archive toolbar.
 *
 * @return string
 */
function pivora_render_blog_category_filter(): string {
	$blog_url   = pivora_get_blog_posts_url();
	$categories = get_categories(
		array(
			'hide_empty' => true,
			'parent'     => 0,
		)
	);

	$is_all_active = is_home() || ( is_archive() && ! is_category() && ! is_tag() && ! is_author() && ! is_date() && ! is_search() );

	ob_start();
	?>
	<nav class="pivora-blog-toolbar__categories" aria-label="<?php esc_attr_e( 'Blog categories', 'pivora' ); ?>">
		<span class="pivora-blog-toolbar__filter-label"><?php esc_html_e( 'Filter', 'pivora' ); ?></span>
		<ul class="pivora-blog-toolbar__category-list">
			<li>
				<a class="pivora-blog-toolbar__category-link<?php echo $is_all_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( $blog_url ); ?>">
					<?php esc_html_e( 'All', 'pivora' ); ?>
				</a>
			</li>
			<?php foreach ( $categories as $category ) : ?>
				<?php
				if ( 'uncategorized' === $category->slug ) {
					continue;
				}
				$link = get_category_link( $category->term_id );
				if ( is_wp_error( $link ) ) {
					continue;
				}
				$is_active = is_category( $category->term_id );
				?>
				<li>
					<a class="pivora-blog-toolbar__category-link<?php echo $is_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( $link ); ?>">
						<?php echo esc_html( $category->name ); ?>
						<span class="pivora-blog-toolbar__category-count"><?php echo esc_html( (string) $category->count ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'pivora_blog_categories', 'pivora_render_blog_category_filter' );

/**
 * Renders the current archive result count.
 *
 * @return string
 */
function pivora_render_blog_results_count(): string {
	global $wp_query;

	$found = $wp_query instanceof WP_Query ? (int) $wp_query->found_posts : 0;

	$label = sprintf(
		/* translators: %s: number of posts */
		_n( '%s article', '%s articles', $found, 'pivora' ),
		number_format_i18n( $found )
	);

	return sprintf(
		'<p class="pivora-blog-toolbar__count">%s</p>',
		esc_html( $label )
	);
}
add_shortcode( 'pivora_blog_results', 'pivora_render_blog_results_count' );

/**
 * Renders the blog archive search field.
 *
 * @return string
 */
function pivora_render_blog_search_control(): string {
	$search_query = is_search() ? get_search_query( false ) : '';

	ob_start();
	?>
	<form role="search" method="get" class="pivora-blog-toolbar__search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="pivora-blog-search-field"><?php esc_html_e( 'Search articles', 'pivora' ); ?></label>
		<div class="pivora-blog-toolbar__search-field">
			<input
				type="search"
				id="pivora-blog-search-field"
				class="pivora-blog-toolbar__search-input"
				name="s"
				value="<?php echo esc_attr( $search_query ); ?>"
				placeholder="<?php esc_attr_e( 'Search articles', 'pivora' ); ?>"
			/>
			<button type="submit" class="pivora-blog-toolbar__search-button"><?php esc_html_e( 'Search', 'pivora' ); ?></button>
		</div>
	</form>
	<?php
	return (string) ob_get_clean();
}

/**
 * Renders the complete blog archive toolbar.
 *
 * @return string
 */
function pivora_render_blog_toolbar(): string {
	ob_start();
	?>
	<div class="pivora-blog-toolbar">
		<div class="pivora-blog-toolbar__row">
			<div class="pivora-blog-toolbar__primary">
				<div class="pivora-blog-toolbar__search-col">
					<?php echo pivora_render_blog_search_control(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<div class="pivora-blog-toolbar__filters-col">
					<?php echo pivora_render_blog_category_filter(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
			<div class="pivora-blog-toolbar__meta-col">
				<?php echo pivora_render_blog_results_count(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php echo pivora_render_blog_sort_control(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'pivora_blog_toolbar', 'pivora_render_blog_toolbar' );

/**
 * Prepends the toolbar markup inside the blog archive shell.
 *
 * @param string $markup Rendered blog archive template part HTML.
 * @return string
 */
function pivora_prepend_blog_toolbar_to_archive( string $markup ): string {
	if ( str_contains( $markup, 'pivora-blog-toolbar' ) ) {
		return $markup;
	}

	$toolbar = pivora_render_blog_toolbar();

	if ( '' === $toolbar ) {
		return $markup;
	}

	$replaced = preg_replace(
		'/(class="wp-block-group alignwide pivora-blog-archive[^"]*">)/',
		'$1' . $toolbar,
		$markup,
		1
	);

	return is_string( $replaced ) ? $replaced : $markup;
}
