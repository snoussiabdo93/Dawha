<?php
/**
 * Plugin support: The Events Calendar (Importer support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_tribe_events_importer_required_plugins' ) ) {
	add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_tribe_events_importer_required_plugins', 10, 2 );
	function trx_addons_tribe_events_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'the-events-calendar')!==false && !trx_addons_exists_tribe_events() )
			$not_installed .= '<br>' . esc_html__('Tribe Events Calendar', 'trx_addons');
		return $not_installed;
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_tribe_events_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options',	'trx_addons_tribe_events_importer_set_options' );
	function trx_addons_tribe_events_importer_set_options($options=array()) {
		if ( trx_addons_exists_tribe_events() && in_array('the-events-calendar', $options['required_plugins']) ) {
			$options['additional_options'][] = 'tribe_events_calendar_options';
		}
		return $options;
	}
}

// Prevent import plugin's specific options if plugin is not installed
if ( !function_exists( 'trx_addons_tribe_events_importer_check_options' ) ) {
	add_filter( 'trx_addons_filter_import_theme_options', 'trx_addons_tribe_events_importer_check_options', 10, 4 );
	function trx_addons_tribe_events_importer_check_options($allow, $k, $v, $options) {
		if ($allow && $k == 'tribe_events_calendar_options') {
			$allow = trx_addons_exists_tribe_events() && in_array('the-events-calendar', $options['required_plugins']);
		}
		return $allow;
	}
}

// Check if the row will be imported
if ( !function_exists( 'trx_addons_tribe_events_importer_check_row' ) ) {
	add_filter('trx_addons_filter_importer_import_row', 'trx_addons_tribe_events_importer_check_row', 9, 4);
	function trx_addons_tribe_events_importer_check_row($flag, $table, $row, $list) {
		if ($flag || strpos($list, 'the-events-calendar')===false) return $flag;
		if (trx_addons_exists_tribe_events() ) {
			if ($table == 'posts')
				$flag = in_array($row['post_type'], array(Tribe__Events__Main::POSTTYPE, Tribe__Events__Main::VENUE_POST_TYPE, Tribe__Events__Main::ORGANIZER_POST_TYPE));
		}
		return $flag;
	}
}

// Fix for the version 6.0+ to enable posts are created in the previous version
if ( !function_exists( 'trx_addons_tribe_events_importer_import_end' ) ) {
	add_action( 'trx_addons_action_importer_import_end', 'trx_addons_tribe_events_importer_import_end', 10, 1 );
	function trx_addons_tribe_events_importer_import_end( $importer = null ) {

		if ( trx_addons_exists_tribe_events() && class_exists( 'TEC\Events\Custom_Tables\V1\Repository\Events' ) ) {

			$tec = new TEC\Events\Custom_Tables\V1\Repository\Events();

			// get_posts() is not work with old events,
			// because a plugin inject own conditions (its ignore an argument 'suppress_filters')
			// and a next call return an empty result
			/*
			$events = get_posts( array(
				'post_type' => Tribe__Events__Main::POSTTYPE,
				'posts_per_page' => -1
			) );
			*/
			// A direct query is used
			global $wpdb;
			$events = $wpdb->get_results( "SELECT ID FROM " . esc_sql( $wpdb->prefix . 'posts' ) . " WHERE post_type='" . Tribe__Events__Main::POSTTYPE . "'", OBJECT );

			if ( is_array( $events ) ) {
				foreach( $events as $event ) {
					$tec->update( $event->ID, array() );
				}
			}
		}
	}
}
