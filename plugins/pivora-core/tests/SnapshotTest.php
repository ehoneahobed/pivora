<?php
/**
 * Import snapshot unit tests.
 *
 * @package Pivora_Core
 */

declare( strict_types=1 );

use Brain\Monkey;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;

/**
 * Tests for starter-studio snapshot helpers.
 */
final class SnapshotTest extends TestCase {

	/**
	 * Sets up Brain Monkey.
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Tears down Brain Monkey.
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Empty options should not count as a snapshot.
	 */
	public function test_has_import_snapshot_returns_false_when_empty(): void {
		Functions\when( 'get_option' )->justReturn( array() );

		$this->assertFalse( pivora_core_has_import_snapshot() );
	}

	/**
	 * Snapshots with saved_at should be restorable.
	 */
	public function test_has_import_snapshot_returns_true_when_saved_at_present(): void {
		Functions\when( 'get_option' )->justReturn(
			array(
				'saved_at' => time(),
			)
		);

		$this->assertTrue( pivora_core_has_import_snapshot() );
	}

	/**
	 * Restore without a snapshot should return an error.
	 */
	public function test_restore_import_snapshot_without_snapshot_returns_error(): void {
		Functions\when( 'get_option' )->justReturn( array() );

		$result = pivora_core_restore_import_snapshot();

		$this->assertInstanceOf( WP_Error::class, $result );
		$this->assertSame( 'pivora_core_no_snapshot', $result->code );
	}

	/**
	 * Saving a snapshot should persist tracked reading settings.
	 */
	public function test_save_import_snapshot_persists_reading_settings(): void {
		$captured = null;

		Functions\when( 'get_page_by_path' )->justReturn( null );
		Functions\when( 'get_option' )->alias(
			function ( string $key, $fallback = false ) {
				$options = array(
					'show_on_front'          => 'page',
					'page_on_front'          => 12,
					'page_for_posts'         => 34,
					'pivora_header_variant'  => 'header-alt',
					'pivora_footer_variant'  => 'footer-alt',
					'pivora_active_demo_kit' => 'agency',
				);

				return $options[ $key ] ?? $fallback;
			}
		);
		Functions\when( 'update_option' )->alias(
			function ( string $key, $value ) use ( &$captured ): bool {
				if ( PIVORA_CORE_IMPORT_SNAPSHOT_OPTION === $key ) {
					$captured = $value;
				}

				return true;
			}
		);

		$this->assertTrue( pivora_core_save_import_snapshot() );
		$this->assertIsArray( $captured );
		$this->assertSame( 'page', $captured['show_on_front'] );
		$this->assertSame( 12, $captured['page_on_front'] );
		$this->assertSame( 'agency', $captured['pivora_active_demo_kit'] );
	}

	/**
	 * Restoring a snapshot should write reading settings back.
	 */
	public function test_restore_import_snapshot_updates_reading_settings(): void {
		$updates = array();

		Functions\when( 'get_option' )->alias(
			function ( string $key, $fallback = false ) {
				if ( PIVORA_CORE_IMPORT_SNAPSHOT_OPTION === $key ) {
					return array(
						'saved_at'               => time(),
						'show_on_front'          => 'posts',
						'page_on_front'          => 0,
						'page_for_posts'         => 0,
						'pivora_header_variant'  => 'header',
						'pivora_footer_variant'  => 'footer',
						'pivora_active_demo_kit' => '',
						'pages'                  => array(),
					);
				}

				return $fallback;
			}
		);
		Functions\when( 'update_option' )->alias(
			function ( string $key, $value ) use ( &$updates ): bool {
				$updates[ $key ] = $value;

				return true;
			}
		);
		Functions\when( 'flush_rewrite_rules' )->justReturn( null );

		$result = pivora_core_restore_import_snapshot();

		$this->assertTrue( $result );
		$this->assertSame( 'posts', $updates['show_on_front'] );
		$this->assertSame( 0, $updates['page_on_front'] );
	}
}
