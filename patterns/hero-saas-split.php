<?php
/**
 * Title: SaaS hero (split with preview)
 * Slug: pivora/hero-saas-split
 * Categories: pivora-saas
 * Viewport width: 1440
 *
 * @package Pivora
 */

?>
<!-- wp:group {"align":"full","className":"pivora-hero pivora-hero--saas-split","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pivora-hero pivora-hero--saas-split">
	<!-- wp:group {"align":"wide","className":"pivora-hero__split","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide pivora-hero__split">
		<!-- wp:columns {"className":"pivora-hero__columns"} -->
		<div class="wp-block-columns pivora-hero__columns">
			<!-- wp:column {"width":"50%","className":"pivora-hero__column pivora-hero__column--copy"} -->
			<div class="wp-block-column pivora-hero__column pivora-hero__column--copy" style="flex-basis:50%">
				<!-- wp:paragraph {"className":"pivora-hero__pill"} -->
				<p class="pivora-hero__pill"><?php esc_html_e( '✨ Stand out as a solopreneur', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":1,"className":"pivora-hero__title"} -->
				<h1 class="wp-block-heading pivora-hero__title"><?php esc_html_e( 'Share your story and build a brand', 'pivora' ); ?></h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"pivora-hero__lede"} -->
				<p class="pivora-hero__lede"><?php esc_html_e( 'Want to get recognised in the community? We help you tell your founder story with structure and style.', 'pivora' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list {"className":"is-style-pivora-checklist pivora-hero__checklist"} -->
				<ul class="wp-block-list is-style-pivora-checklist pivora-hero__checklist">
					<li><?php esc_html_e( 'Build a personal brand that resonates.', 'pivora' ); ?></li>
					<li><?php esc_html_e( 'Stand out with a unique founder profile.', 'pivora' ); ?></li>
					<li><?php esc_html_e( 'Integrate live updates directly on your site.', 'pivora' ); ?></li>
					<li><?php esc_html_e( 'Share startup stories in a coherent timeline.', 'pivora' ); ?></li>
				</ul>
				<!-- /wp:list -->

				<!-- wp:group {"className":"pivora-hero__claim","layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group pivora-hero__claim">
					<!-- wp:paragraph {"className":"pivora-hero__claim-prefix"} -->
					<p class="pivora-hero__claim-prefix">yoursite.com/</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-hero__claim-input"} -->
					<p class="pivora-hero__claim-input"><?php esc_html_e( 'username', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:buttons {"className":"pivora-hero__claim-action"} -->
					<div class="wp-block-buttons pivora-hero__claim-action">
						<!-- wp:button {"className":"is-style-pivora-hero-teal","url":"<?php echo esc_url( home_url( '/contact/' ) ); ?>"} -->
						<div class="wp-block-button is-style-pivora-hero-teal"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Claim username', 'pivora' ); ?></a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"pivora-hero__trust","layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group pivora-hero__trust">
					<!-- wp:group {"className":"pivora-hero__avatars","layout":{"type":"flex","flexWrap":"nowrap"}} -->
					<div class="wp-block-group pivora-hero__avatars">
						<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">JD</p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">LM</p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">OP</p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__avatar"} --><p class="pivora-hero__avatar">QR</p><!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:paragraph {"className":"pivora-hero__stars"} -->
					<p class="pivora-hero__stars" aria-hidden="true">★★★★★</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"pivora-hero__trust-copy"} -->
					<p class="pivora-hero__trust-copy"><?php esc_html_e( 'Trusted by 200+ founders', 'pivora' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"25%","className":"pivora-hero__column pivora-hero__column--cards"} -->
			<div class="wp-block-column pivora-hero__column pivora-hero__column--cards" style="flex-basis:25%">
				<!-- wp:group {"className":"pivora-hero__feed-card","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__feed-card">
					<!-- wp:paragraph {"className":"pivora-hero__feed-name"} --><p class="pivora-hero__feed-name"><?php esc_html_e( 'IndieLogs', 'pivora' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"pivora-hero__feed-copy"} --><p class="pivora-hero__feed-copy"><?php esc_html_e( 'Share your founder journey with a structured timeline and live updates.', 'pivora' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"pivora-hero__feed-meta"} --><p class="pivora-hero__feed-meta"><?php esc_html_e( '▲ 128 · 💬 24', 'pivora' ); ?></p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"pivora-hero__feed-card","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__feed-card">
					<!-- wp:paragraph {"className":"pivora-hero__feed-name"} --><p class="pivora-hero__feed-name"><?php esc_html_e( 'Buildfast', 'pivora' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"pivora-hero__feed-copy"} --><p class="pivora-hero__feed-copy"><?php esc_html_e( 'Ship landing pages faster with reusable block patterns and style presets.', 'pivora' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"pivora-hero__feed-meta"} --><p class="pivora-hero__feed-meta"><?php esc_html_e( '▲ 96 · 💬 18', 'pivora' ); ?></p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"pivora-hero__feed-card","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__feed-card">
					<!-- wp:paragraph {"className":"pivora-hero__feed-name"} --><p class="pivora-hero__feed-name"><?php esc_html_e( 'Videofa.st', 'pivora' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"pivora-hero__feed-copy"} --><p class="pivora-hero__feed-copy"><?php esc_html_e( 'Turn product demos into shareable clips with analytics built in.', 'pivora' ); ?></p><!-- /wp:paragraph -->
					<!-- wp:paragraph {"className":"pivora-hero__feed-meta"} --><p class="pivora-hero__feed-meta"><?php esc_html_e( '▲ 74 · 💬 11', 'pivora' ); ?></p><!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"25%","className":"pivora-hero__column pivora-hero__column--timeline"} -->
			<div class="wp-block-column pivora-hero__column pivora-hero__column--timeline" style="flex-basis:25%">
				<!-- wp:group {"className":"pivora-hero__timeline","layout":{"type":"default"}} -->
				<div class="wp-block-group pivora-hero__timeline">
					<!-- wp:group {"className":"pivora-hero__timeline-item","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-hero__timeline-item">
						<!-- wp:paragraph {"className":"pivora-hero__timeline-date"} --><p class="pivora-hero__timeline-date"><?php esc_html_e( 'Feb 28, 2024', 'pivora' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__timeline-title"} --><p class="pivora-hero__timeline-title"><?php esc_html_e( '🥳 New feature — Indie Logs', 'pivora' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__timeline-copy"} --><p class="pivora-hero__timeline-copy"><?php esc_html_e( 'Launched timeline sharing with embeddable founder profiles.', 'pivora' ); ?></p><!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"pivora-hero__timeline-item pivora-hero__timeline-item--highlight","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-hero__timeline-item pivora-hero__timeline-item--highlight">
						<!-- wp:paragraph {"className":"pivora-hero__timeline-date"} --><p class="pivora-hero__timeline-date"><?php esc_html_e( 'Jan 18, 2024', 'pivora' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__timeline-title"} --><p class="pivora-hero__timeline-title"><?php esc_html_e( '🎉 Got first customers', 'pivora' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__timeline-copy"} --><p class="pivora-hero__timeline-copy"><?php esc_html_e( 'Closed our first ten paying teams after shipping the public beta.', 'pivora' ); ?></p><!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"pivora-hero__timeline-item","layout":{"type":"default"}} -->
					<div class="wp-block-group pivora-hero__timeline-item">
						<!-- wp:paragraph {"className":"pivora-hero__timeline-date"} --><p class="pivora-hero__timeline-date"><?php esc_html_e( 'Jan 8, 2024', 'pivora' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__timeline-title"} --><p class="pivora-hero__timeline-title"><?php esc_html_e( '✅ Validated idea', 'pivora' ); ?></p><!-- /wp:paragraph -->
						<!-- wp:paragraph {"className":"pivora-hero__timeline-copy"} --><p class="pivora-hero__timeline-copy"><?php esc_html_e( 'Interviewed 40 founders and confirmed demand for structured storytelling.', 'pivora' ); ?></p><!-- /wp:paragraph -->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
