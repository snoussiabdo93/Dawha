<?php
/**
 * Shortcode: Container for other shortcodes (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.28
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_container_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_container_editor_assets' );
	function trx_addons_gutenberg_sc_container_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-container',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'container/gutenberg/container.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'container/gutenberg/container.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_container_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_container_add_in_gutenberg' );
	function trx_addons_sc_container_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/layouts-container', array(
					'attributes'      => array(
						'type'              => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'align'             => array(
							'type'    => 'title',
							'default' => '',
						),
						'content'       => array(
							'type'    => 'string',
							'default' => ''
						),
						// Hide on devices attributes
						'hide_on_wide'      => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_desktop'      => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_notebook'  => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_tablet'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_mobile'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_frontpage' => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_singular'  => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_other'     => array(
							'type'    => 'boolean',
							'default' => false,
						),
						// ID, Class, CSS attributes
						'id'                => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'             => array(
							'type'    => 'string',
							'default' => '',
						),
						'className'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'               => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_container_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_container_render_block' ) ) {
	function trx_addons_gutenberg_sc_container_render_block( $attributes = array(), $content = '' ) {
		return trx_addons_sc_layouts_container( $attributes, trx_addons_gutenberg_is_content_built( $content ) ? do_blocks( $content ) : $content );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_container_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_container_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_container_get_layouts( $array = array() ) {
		$array['sc_container'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_layouts_container'
		);
		return $array;
	}
}
