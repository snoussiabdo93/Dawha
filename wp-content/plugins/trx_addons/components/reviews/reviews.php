<?php
/**
 * ThemeREX Addons Posts and Comments Reviews
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.47
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Define component's subfolder
if ( !defined('TRX_ADDONS_PLUGIN_REVIEWS') ) define('TRX_ADDONS_PLUGIN_REVIEWS', TRX_ADDONS_PLUGIN_COMPONENTS . 'reviews/');


// Add component to the global list
if (!function_exists('trx_addons_reviews_add_to_components')) {
	add_filter( 'trx_addons_components_list', 'trx_addons_reviews_add_to_components' );
	function trx_addons_reviews_add_to_components($list=array()) {
		$list['reviews'] = array(
					'title' => __('Reviews for posts and comments', 'trx_addons')
					);
		return $list;
	}
}

// Check if module is enabled
if (!function_exists('trx_addons_reviews_enable')) {
	function trx_addons_reviews_enable() {
		static $enable = null;
		if ($enable === null) {
			$enable = trx_addons_components_is_allowed('components', 'reviews');
		}
		return $enable;
	}
}

	
// Merge specific styles into single stylesheet
if ( !function_exists( 'trx_addons_reviews_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_reviews_merge_styles');
	function trx_addons_reviews_merge_styles($list) {
		if (trx_addons_reviews_enable()) {
			$list[] = TRX_ADDONS_PLUGIN_REVIEWS . '_reviews.scss';
		}
		return $list;
	}
}

	
// Merge specific scripts into single file
if ( !function_exists( 'trx_addons_reviews_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_reviews_merge_scripts', 11);
	function trx_addons_reviews_merge_scripts($list) {
		if (trx_addons_reviews_enable()) {
			$list[] = TRX_ADDONS_PLUGIN_REVIEWS . 'reviews.js';
		}
		return $list;
	}
}

// Load module-specific scripts
if (!function_exists('trx_addons_reviews_enqueue_scripts')) {
	add_action( 'wp_enqueue_scripts', 'trx_addons_reviews_enqueue_scripts', 20 );	
	function trx_addons_reviews_enqueue_scripts() {   
		if (trx_addons_reviews_enable() && trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_script( 'trx_addons-reviews', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_REVIEWS . 'reviews.js'), array('jquery'), null, true );
		}
	}
}

// Add module-specific vars to the frontend scripts
if (!function_exists('trx_addons_reviews_localize_scripts')) {
	add_filter( 'trx_addons_filter_localize_script', 'trx_addons_reviews_localize_scripts' );	
	function trx_addons_reviews_localize_scripts($vars) {
		$vars['msg_rating_already_marked'] = addslashes(esc_html__('You have already rated this post with mark {{X}}', 'trx_addons'));
		return $vars;
	}
}


// Add 'Reviews' section in the ThemeREX Addons Options
if (!function_exists('trx_addons_reviews_options')) {
	add_filter( 'trx_addons_filter_options', 'trx_addons_reviews_options');
	function trx_addons_reviews_options($options) {
		// Add section 'Reviews'
		if (trx_addons_reviews_enable()) {
			trx_addons_array_insert_before($options, 'sc_section', array(
				'reviews_section' => array(
					"title" => esc_html__('Reviews', 'trx_addons'),
					"type" => "section"
				),
				'reviews_section_info' => array(
					"title" => esc_html__('Reviews settings', 'trx_addons'),
					"desc" => wp_kses_data( __("Settings of posts and comments reviews", 'trx_addons') ),
					"type" => "info"
				),
				'allow_reviews' => array(
					"title" => esc_html__('Allow reviews',  'trx_addons'),
					"desc" => wp_kses_data( __('Allow to review posts and comments',  'trx_addons') ),
					"std" => "1",
					"type" => "checkbox"
				),		
				'reviews_action_name' => array(
					"title" => esc_html__('Action name',  'trx_addons'),
					"desc" => wp_kses_data( __('Write your action name to call the reviews block in any place you want',  'trx_addons') ),
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"std" => 'trx_addons_action_post_rating',
					"type" => "text"
				),
				"reviews_post_types" => array(
					"title" => esc_html__("Post types", 'trx_addons'),
					"desc" => wp_kses_data( __("Select post types to show reviews", 'trx_addons') ),
					"dir" => 'horizontal',
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"std" => array( 'post' => 1 ),
					"options" => array(),
					"type" => "checklist"
				),					
				'rating_max_level' => array(
					"title" => esc_html__('Max rating level',  'trx_addons'),
					"desc" => wp_kses_data( __('Maximum level for grading marks',  'trx_addons') ),
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"std" => "5",
					"options" => array(
						'5'   => esc_html__('5 stars', 'trx_addons'),
						'10'  => esc_html__('10 stars', 'trx_addons'),
						'100' => esc_html__('100%', 'trx_addons')
					),
					"type" => "radio"
				),
				'rating_style' => array(
					"title" => esc_html__('Show rating as', 'trx_addons'),
					"desc" => wp_kses_data( __('Show rating as icons or as progress bars or as text',  'trx_addons') ),
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"std" => "icons",
					"options" => array(
						'icons'	=> esc_html__('As icons', 'trx_addons'),
						'bar'	=> esc_html__('As progress bar', 'trx_addons'),
						'text'	=> esc_html__('As text (for example: 7.5 / 10)', 'trx_addons'),
					),
					"type" => "radio"
				),			
				'rating_color' => array(
					"title" => esc_html__('Rating color', 'trx_addons'),
					"desc" => wp_kses_data( __('Specify color for rating icons/bar',  'trx_addons') ),
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"std" => "",
					"type" => "color"
				),			
				"rating_icons" => array(
					"title" => esc_html__("Icon", 'trx_addons'),
					"desc" => wp_kses_data( __('Select icon for rating', 'trx_addons') ),
					"dependency" => array(
						"rating_style" => array('inherit','icons','text')
					),
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"std" => "trx_addons_icon-star",
					"options" => array(),
					"style" => trx_addons_get_setting('icons_type'),
					"type" => "icons"
				),
				'rating_text_template' => array(
					"title" => esc_html__('Text template',  'trx_addons'),
					"desc" => wp_kses_data( __('Write text template, where {{X}} - is a current value, {{Y}} - is a max value, {{V}} - is a number of votes. For example "Rating {{X}} from {{Y}} (according {{V}})"',  'trx_addons') ),
					"dependency" => array(
						"allow_reviews" => array('1')
					),
					"dependency" => array(
						"rating_style" => array('inherit', 'text')
					),
					"std" => esc_html__('Rating {{X}} from {{Y}}', 'trx_addons'),
					"type" => "text"
				)
			));
		}		
		return $options;
	}
}


// Add 'Rating' to the order list
if (!function_exists('trx_addons_reviews_add_rating_to_order_list')) {
	add_filter( 'trx_addons_filter_popular_posts_orderby', 'trx_addons_reviews_add_rating_to_order_list');
	add_filter( 'trx_addons_filter_get_list_sc_query_orderby', 'trx_addons_reviews_add_rating_to_order_list', 10, 2);
	function trx_addons_reviews_add_rating_to_order_list($list, $keys=array()) {
		if (trx_addons_reviews_enable())
			$list['rating'] = __('Rating', 'trx_addons');
		return $list;
	}
}

// Add order 'Rating' to the query params
if (!function_exists('trx_addons_reviews_add_rating_to_query_args')) {
	add_filter( 'trx_addons_filter_add_sort_order', 'trx_addons_reviews_add_rating_to_query_args', 10, 3);
	function trx_addons_reviews_add_rating_to_query_args($q_args, $orderby, $order) {
		if (trx_addons_reviews_enable()) {
			if ($orderby =='rating') {
				$q_args['meta_key'] = 'trx_addons_post_rating';
				$q_args['orderby'] = 'meta_value_num';
			}
		}
		return $q_args;
	}
}

// Add stars to the meta
if (!function_exists('trx_addons_reviews_show_post_meta')) {
	add_action( 'trx_addons_action_show_post_meta', 'trx_addons_reviews_show_post_meta', 10, 2);
	function trx_addons_reviews_show_post_meta($meta, $post_id='p0') {
		if (trx_addons_reviews_enable() && (in_array($meta, array('rating', 'reviews')))) {
			if ($post_id == 'p0') $post_id = 'p'.get_the_ID();
			if (!in_array(substr($post_id, 0, 1), array('c', 'p'))) $post_id = 'p'.$post_id;
			$reviews_post_types = trx_addons_get_option('reviews_post_types');
			if (!empty($reviews_post_types) && !empty($reviews_post_types[get_post_type((int)substr($post_id, 1))])) {
				$post_rating = trx_addons_get_post_rating($post_id, trx_addons_get_option('rating_max_level'));
			} else {
				$post_rating = apply_filters('trx_addons_filter_custom_meta_value', '', 'rating_text');
			}
			if ($post_rating > 0) {
				echo '<a href="' . esc_url(get_permalink()) . '" class="post_meta_item post_meta_rating trx_addons_icon-star">'
						. '<span class="post_meta_number">' . wp_kses_data($post_rating) . '</span>'
					. '</a> ';
			}
		}
	}
}


// Fill 'Post types' before show ThemeREX Addons Options
if (!function_exists('trx_addons_reviews_before_show_options')) {
	add_filter( 'trx_addons_filter_before_show_options', 'trx_addons_reviews_before_show_options', 10, 2);
	function trx_addons_reviews_before_show_options($options, $pt='') {
		if (trx_addons_reviews_enable() && isset($options['reviews_post_types'])) {
			$options['reviews_post_types']['options'] = trx_addons_get_list_reviews_posts_types();
		}
		return $options;
	}
}


// Return list of allowed post's types
if ( !function_exists( 'trx_addons_get_list_reviews_posts_types' ) ) {
	function trx_addons_get_list_reviews_posts_types($prepend_inherit=false) {
		static $list = false;
		if ($list === false) {
			$list = array();
			$post_types = get_post_types(array(
												'public' => true,
												'exclude_from_search' => false
												), 'object');
			if (is_array($post_types)) {
				foreach ($post_types as $pt) {
					$list[$pt->name] = $pt->label;
				}
			}
		}
		return $prepend_inherit 
					? trx_addons_array_merge(array('inherit' => esc_html__("Inherit", 'trx_addons')), $list) 
					: $list;
	}
}


// Convert rating value to save
if (!function_exists('trx_addons_rating2save')) {
	function trx_addons_rating2save($mark, $max) {
		if (is_array($mark) && isset($mark['total']))
			$mark = $mark['total'] / $mark['votes'];
		return round( $max > 0 && $max != 100 ? $mark * 100 / $max : $mark, 1);
	}
}


// Convert rating value to display
if (!function_exists('trx_addons_rating2show')) {
	function trx_addons_rating2show($mark, $max) {
		if (is_array($mark) && isset($mark['total']))
			$mark = $mark['total'] / $mark['votes'];
		return round( $max > 0 && $max != 100 ? $mark * $max / 100 : $mark, 1);
	}
}


// Return the post rating
if (!function_exists('trx_addons_get_post_rating')) {
	function trx_addons_get_post_rating($post_id='p0', $max=0){
		$rating = 0;
		$type = substr($post_id, 0, 1) == 'c' ? 'comment' : 'post';
		$post_id = (int) substr($post_id, 1);
		if (!$post_id) {
			$post_id = $type=='comment' ? get_comment_ID() : trx_addons_get_the_ID();				
		}
		if ($post_id) {
			$list = $type == 'comment' 
						? get_comment_meta($post_id, 'trx_addons_post_rating_data', true)
						: get_post_meta($post_id, 'trx_addons_post_rating_data', true);
			if (!empty($list) && is_array($list) && $list['votes'] > 0) {
				$rating = trx_addons_rating2show($list, $max);
			}
		}
		return $rating;
	}
}

// Return the number of votes
if (!function_exists('trx_addons_get_rating_votes')) {
	function trx_addons_get_rating_votes($post_id=0){
		$votes = 0;		
		$type = substr($post_id, 0, 1) == 'c' ? 'comment' : 'post';
		$post_id = (int) substr($post_id, 1);
		if (!$post_id) {
			$post_id = $type=='comment' ? get_comment_ID() : trx_addons_get_the_ID();				
		}
		if ($post_id) {
			$key = 'trx_addons_post_rating_data';
			$list = $type == 'comment' 
						? get_comment_meta($post_id, $key, true)
						: get_post_meta($post_id, $key, true);
			if (is_array($list) && !empty($list['votes'])) {
				$votes = $list['votes'];
			}
		}
		return $votes;
	}
}

// Increment the post's rating 
if (!function_exists('trx_addons_add_post_rating')) {
	function trx_addons_add_post_rating($mark, $max, $post_id) {
		$rating = -1;
		if ($post_id) {
			$type = $post_id[0] == 'c' ? 'comment' : 'post';
			$post_id = (int) substr($post_id, 1);
			// Add vote to the list
			$key = 'trx_addons_post_rating_data';
			$key2 = 'trx_addons_post_rating';
			$list = $type == 'comment' 
						? get_comment_meta($post_id, $key, true)
						: get_post_meta($post_id, $key, true);
			$value = trx_addons_rating2save($mark, $max);
			if (!is_array($list) || empty($list)) {
				$list = array(
								'total' => $value,
								'votes' => 1
								);
				if ($type == 'comment') {
					delete_comment_meta($post_id, $key);
					add_comment_meta($post_id, $key, $list);
					delete_comment_meta($post_id, $key2);
					add_comment_meta($post_id, $key2, $value);
				} else {
					delete_post_meta($post_id, $key);
					add_post_meta($post_id, $key, $list);
					delete_post_meta($post_id, $key2);
					add_post_meta($post_id, $key2, $value);
				}
				$rating = $mark;
			} else {
				$list['total'] += $value;
				$list['votes']++;
				if ($type == 'comment') {
					update_comment_meta($post_id, $key, $list);
					update_comment_meta($post_id, $key2, round($list['total'] / $list['votes'], 1));
				} else {
					update_post_meta($post_id, $key, $list);
					update_post_meta($post_id, $key2, round($list['total'] / $list['votes'], 1));
				}
				$rating = trx_addons_rating2show($list, $max);
			}
		} 
		return $rating;
	}
}

// AJAX: Set post rating
if ( !function_exists( 'trx_addons_callback_post_rating' ) ) {
	add_action('wp_ajax_post_rating', 			'trx_addons_callback_post_rating');
	add_action('wp_ajax_nopriv_post_rating',	'trx_addons_callback_post_rating');
	function trx_addons_callback_post_rating() {
		
		if ( !wp_verify_nonce( trx_addons_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
		
		$response = array('error' => '', 'rating' => -1);
		
		$post_id = trx_addons_get_value_gp('post_id');
		$mark = (float) trx_addons_get_value_gp('mark');
		$max = (float) trx_addons_get_value_gp('mark_max');
		if (!empty($post_id) && !empty($mark) && !empty($max)) {
			$response['rating'] = trx_addons_add_post_rating($mark, $max, $post_id);
		} else {
			$response['error'] = esc_html('Something went wrong. Please try again.', 'trx_addons');
		}
		
		echo json_encode($response);
		die();
	}
}

// Add custom action call
if ( !function_exists( 'trx_addons_post_rating_init' ) ) {
	add_action( 'init', 'trx_addons_post_rating_init' );
	function trx_addons_post_rating_init() { 
		if (function_exists('trx_addons_reviews_enable') && trx_addons_reviews_enable() && trx_addons_get_option('reviews_action_name') != '') {
			add_action(trx_addons_get_option('reviews_action_name'), 'trx_addons_post_rating', 10, 1);
		}
	}
}

// Return post rating layout
if ( !function_exists( 'trx_addons_post_rating' ) ) {
	add_action('trx_addons_action_post_rating', 'trx_addons_post_rating', 10, 1);
	function trx_addons_post_rating($args=array()) {
		if (trx_addons_reviews_enable()) {
			trx_addons_show_layout(trx_addons_sc_reviews($args));
		}
	}
}

// Return value of the custom field for the custom blog items
if ( !function_exists( 'trx_addons_rating_custom_meta_value' ) ) {
	add_filter( 'trx_addons_filter_custom_meta_value', 'trx_addons_rating_custom_meta_value', 11, 2 );
	function trx_addons_rating_custom_meta_value($value, $key) {
		if (empty($value) && trx_addons_reviews_enable()) {
			if (in_array($key, array('rating', 'rating_text', 'rating_bar', 'rating_icons', 'rating_stars'))) {
				$value = trx_addons_sc_reviews(array(
							'post_id' => get_the_ID(),
							'rating_max_level' => 5,
							'rating_style' => $key == 'rating_text' ? 'text' : ($key == 'rating_bar' ? 'bar' : 'icons'),
							'rating_text_template' => $key == 'rating_text' ? '' : '#',	// Don't display text
							'allow_voting' => 0
							));
			}
		}
		return $value;
	}
}


// Widget "Posts by rating"
//--------------------------------------------------------------------
if (!function_exists('trx_addons_reviews_add_widget')){
	add_filter('trx_addons_widgets_list', 'trx_addons_reviews_add_widget', 10, 1);
	function trx_addons_reviews_add_widget($array=array()){		
		if (trx_addons_reviews_enable()) {
			$array['rating_posts'] = array(
				'title' => __('Posts by rating', 'trx_addons')
			);
		}
		return $array;
	}
}

// Include files with widget
if (!function_exists('trx_addons_reviews_widgets_load')) {
	add_action( 'after_setup_theme', 'trx_addons_reviews_widgets_load', 10 );
	function trx_addons_reviews_widgets_load() {
		if (trx_addons_reviews_enable()) {
			$fdir = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_REVIEWS . "rating_posts/rating_posts.php");
			if (trx_addons_components_is_allowed('widgets', 'rating_posts') && $fdir != '') { 
				include_once $fdir;
			}
		}
	}
}


// Add shortcodes
//----------------------------------------------------------------------------
require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_REVIEWS . 'reviews-sc.php';

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_REVIEWS . 'reviews-sc-elementor.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_REVIEWS . 'reviews-sc-vc.php';
}
