<?php
/**
 * ThemeREX Addons Posts and Comments Reviews (WPBakery support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.47
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Add [trx_sc_reviews] in the VC shortcodes list
if (!function_exists('trx_addons_sc_reviews_add_in_vc')) {
	function trx_addons_sc_reviews_add_in_vc() {

		if (!trx_addons_reviews_enable()) return;

		if (!trx_addons_exists_vc()) return;

		vc_lean_map( "trx_sc_reviews", 'trx_addons_sc_reviews_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Reviews extends WPBakeryShortCode {}
	}
	add_action('init', 'trx_addons_sc_reviews_add_in_vc', 20);
}

// Return params
if (!function_exists('trx_addons_sc_reviews_add_in_vc_params')) {
	function trx_addons_sc_reviews_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_reviews",
				"name" => esc_html__("Reviews", 'trx_addons'),
				"description" => wp_kses_data( __("Display post reviews block", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_reviews',
				"class" => "trx_sc_reviews",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							"std" => "default",
					        'save_always' => true,
							"value" => array_flip(apply_filters('trx_addons_sc_type', array(
								'default' => esc_html__('Default', 'trx_addons')
							), 'trx_sc_reviews')),
							"type" => "dropdown"
						),
						array(
							"param_name" => "title",
							"heading" => esc_html__("Title", 'trx_addons'),
							"description" => wp_kses_data( __("Title of the block. ", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							"std" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "rating_max_level",
							"heading" => esc_html__("Max rating level", 'trx_addons'),
							"description" => wp_kses_data( __("Maximum level for grading marks", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							"std" => "inherit",
							"value" => array(
								__( 'Inherit', 'trx_addons' ) => 'inherit',
								__( '5 stars', 'trx_addons' ) => '5',
								__( '10 stars', 'trx_addons' ) => '10',
								__( '100%', 'trx_addons' ) => '100'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "rating_style",
							"heading" => esc_html__("Show rating as", 'trx_addons'),
							"description" => wp_kses_data( __("Show rating as icons or as progress bars or as text", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							"std" => "inherit",
							"value" => array(
								__( 'Inherit', 'trx_addons' ) => 'inherit',
								__( 'As icons', 'trx_addons' ) => 'icons',
								__( 'As progress bar', 'trx_addons' ) => 'bar',
								__( 'As text (for example: 7.5 / 10)', 'trx_addons' ) => 'text'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "rating_color",
							"heading" => esc_html__("Color", 'trx_addons'),
							"description" => wp_kses_data( __("Specify color for rating icons/bar", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							"std" => "",
							"type" => "colorpicker"
						),
					),
					trx_addons_vc_add_icon_param('', false, 'icons'),
					array(
						array(
							"param_name" => "rating_text_template",
							"heading" => esc_html__("Text template", 'trx_addons'),
							"description" => wp_kses_data( __('Write text template, where {{X}} - is a current value, {{Y}} - is a max value, {{V}} - is a number of votes. For example "Rating {{X}} from {{Y}} (according {{V}})"', 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							'dependency' => array(
								'element' => 'rating_style',
								'value' => array('inherit','text')
							),
							"std" => "",
							"type" => "textfield"
						),
						array(
							"param_name" => "allow_voting",
							"heading" => esc_html__("Allow voting", 'trx_addons'),
							"description" => wp_kses_data( __('Allow users to vote the post', 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							'admin_label' => true,
							"std" => "1",
							"value" => array( __( 'Allow', 'trx_addons' ) => '1' ),
							"type" => "checkbox"
						)
					),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_reviews' );
	}
}
