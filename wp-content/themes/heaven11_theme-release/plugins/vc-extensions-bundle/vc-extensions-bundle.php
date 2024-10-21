<?php
/* WPBakery PageBuilder Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'heaven11_vc_extensions_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'heaven11_vc_extensions_theme_setup9', 9 );
	function heaven11_vc_extensions_theme_setup9() {

		add_filter( 'heaven11_filter_merge_styles', 'heaven11_vc_extensions_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'heaven11_filter_tgmpa_required_plugins', 'heaven11_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'heaven11_vc_extensions_tgmpa_required_plugins' ) ) {
	
	function heaven11_vc_extensions_tgmpa_required_plugins( $list = array() ) {
		if ( heaven11_storage_isset( 'required_plugins', 'vc-extensions-bundle' ) && heaven11_storage_get_array( 'required_plugins', 'vc-extensions-bundle', 'install' ) !== false && heaven11_is_theme_activated() ) {
			$path = heaven11_get_plugin_source_path( 'plugins/vc-extensions-bundle/vc-extensions-bundle.zip' );
			if ( ! empty( $path ) || heaven11_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => heaven11_storage_get_array( 'required_plugins', 'vc-extensions-bundle', 'title' ),
					'slug'     => 'vc-extensions-bundle',
					'source'   => ! empty( $path ) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( ! function_exists( 'heaven11_exists_vc_extensions' ) ) {
	function heaven11_exists_vc_extensions() {
		return class_exists( 'Vc_Manager' ) && class_exists( 'VC_Extensions_CQBundle' );
	}
}

// Merge custom styles
if ( ! function_exists( 'heaven11_vc_extensions_merge_styles' ) ) {
	
	function heaven11_vc_extensions_merge_styles( $list ) {
		if ( heaven11_exists_vc() && heaven11_exists_vc_extensions() ) {
			$list[] = 'plugins/vc-extensions-bundle/_vc-extensions-bundle.scss';
		}
		return $list;
	}
}
