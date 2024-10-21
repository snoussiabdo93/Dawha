<?php
/**
 * ThemeREX Addons Posts and Comments Reviews (Shortcodes)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.47
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

	
	
// trx_sc_reviews
//-------------------------------------------------------------
/*
[trx_sc_reviews id="unique_id" type="default"]
*/
// Reviews are used on single posts and comments. Use parameter "post_id" if you want to show reviews in blog archive or shortcodes.
if ( !function_exists( 'trx_addons_sc_reviews' ) ) {
	function trx_addons_sc_reviews($atts, $content=null) {	
		$atts = trx_addons_sc_prepare_atts('trx_sc_reviews', $atts, trx_addons_sc_common_atts('id,icon', array(
			// Individual params
			"type" => "default",
			"title" => "",
			"post_id" => "",		// use it for display in shortcodes or blog archive (not in a singular posts)
			"location" => "post",	// post|comment
			"rating_max_level" => "",
			"rating_style" => "",
			"rating_color" => "",
			"rating_text_template" => "",
			"allow_voting" => "1",
			))
		);

		$output = '';
		$allow_reviews = trx_addons_get_option('allow_reviews');
		$reviews_post_types = trx_addons_get_option('reviews_post_types');
		if ($allow_reviews && !empty($reviews_post_types) && (!empty($atts['post_id']) || is_singular())) {
			if (!empty($reviews_post_types[get_post_type()])) {
				if (!empty($atts['post_id']) && !in_array(substr($atts['post_id'], 0, 1), array('c', 'p'))) {
					$atts['post_id'] = ($atts['location'] == 'comment' ? 'c' : 'p') . intval($atts['post_id']);
				}
				$atts['class'] .= ($atts['class'] ? ' ' : '')
								. ($atts['location'] == 'comment' ? 'comment_rating' : 'post_rating') 
								. ' sc_reviews';
				ob_start();
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_REVIEWS . 'tpl.reviews.'.trx_addons_esc($atts['type']).'.php',
											'trx_addons_args_sc_reviews',
											$atts
											);
				$output = ob_get_contents();
				ob_end_clean();
			}
		}
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_reviews', $atts, $content);
	}
}


// Add shortcode [trx_sc_reviews]
if (!function_exists('trx_addons_sc_reviews_add_shortcode')) {
	function trx_addons_sc_reviews_add_shortcode() {

		if (!trx_addons_reviews_enable()) return;

		add_shortcode("trx_sc_reviews", "trx_addons_sc_reviews");
	}
	add_action('init', 'trx_addons_sc_reviews_add_shortcode', 20);
}
