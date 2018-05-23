<?php
/*
Plugin Name: WSU MU Simple Filters
Plugin URI: https://github.com/washingtonstateuniversity/WSUWP-Plugin-MU-Simple-Filters
Description: A collection of simple multisite filters deployed as a must use plugin.
Author: washingtonstateuniversity, jeremyfelt
Author URI: https://web.wsu.edu
Version: 1.6.2
*/

/**
 * Disable all of the standard update and version checks on all other sites
 * beyond the main site on the main network.
 */
if ( ! is_main_network() && ! is_main_site() ) {
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'wp_version_check', 'wp_version_check' );

	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-update.php', 'wp_update_plugins' );
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_plugins' );

	remove_action( 'load-themes.php', 'wp_update_themes' );
	remove_action( 'load-update.php', 'wp_update_themes' );
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	remove_action( 'admin_init', '_maybe_update_themes' );
	remove_action( 'wp_update_themes', 'wp_update_themes' );

	remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );

	remove_action( 'init', 'wp_schedule_update_checks' );
}

/**
 * Remove WordPress core privacy export actions to prevent unnecessary
 * scheduled events from appearing.
 */
add_action( 'init', 'wp_schedule_delete_old_privacy_export_files' );
add_action( 'wp_privacy_delete_old_export_files', 'wp_privacy_delete_old_export_files' );

/**
 * ms_files_rewriting should never be enabled.
 */
add_filter( 'pre_option_ms_files_rewriting', '__return_false' );

/**
 * We should always use yearmonth folders for uploads.
 */
add_filter( 'pre_option_uploads_use_yearmonth_folders', '__return_true' );

/**
 * Disable the multisite database upgrade routine.
 *
 * @see wp-admin/admin.php
 */
add_filter( 'do_mu_upgrade', '__return_false' );

// Prevent WordPress from dropping tables for a deleted site.
add_filter( 'wpmu_drop_tables', '__return_empty_array' );
