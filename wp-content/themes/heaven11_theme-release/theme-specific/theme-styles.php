<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage HEAVEN11
 * @since HEAVEN11 1.0
 */

// Return CSS with custom colors and fonts
if ( ! function_exists( 'heaven11_customizer_get_css' ) ) {

	function heaven11_customizer_get_css( $args = array() ) {

		$colors        = isset( $args['colors'] ) ? $args['colors'] : null;
		$scheme        = isset( $args['scheme'] ) ? $args['scheme'] : null;
		$fonts         = isset( $args['fonts'] ) ? $args['fonts'] : null;
		$vars          = isset( $args['vars'] ) ? $args['vars'] : null;
		$remove_spaces = isset( $args['remove_spaces'] ) ? $args['remove_spaces'] : true;

		$css = array(
			'vars'   => '',
			'fonts'  => '',
			'colors' => '',
		);

		// Theme fonts
		//---------------------------------------------
		if ( null === $fonts ) {
			$fonts = heaven11_get_theme_fonts();
		}

		if ( $fonts ) {

			// Make theme-specific fonts rules
			$fonts = heaven11_customizer_add_theme_fonts( $fonts );

			$rez          = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
p, ul, ol, dl, blockquote, address,
.post_item_single .wp-block-button, 
.post_item_single .wp-block-cover, 
.post_item_single .wp-block-image, 
.post_item_single .wp-block-video, 
.post_item_single .wp-block-search, 
.post_item_single .wp-block-archives, 
.post_item_single .wp-block-categories, 
.post_item_single .wp-block-calendar, 
.post_item_single .wp-block-media-text,
.post_item_single figure.wp-block-gallery,
.post_item_single .wp-block-group.has-background,
.wp-block-group.has-background .wp-block-group__inner-container > * {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1, .front_page_section_caption {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
.tribe-events-c-nav__list-item.tribe-events-c-nav__list-item--today a,
.wp-block-button__link,
form button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.sc_layouts_row .sc_button,
.gallery_preview_show .post_readmore,
.post_item .more-link,
div.esg-filter-wrapper .esg-filterbutton > span,
.mptt-navigation-tabs li a,
.heaven11_tabs .heaven11_tabs_titles li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

.top_panel .slider_engine_revo .slide_title {
	{$fonts['h1_font-family']}
}

blockquote,
mark, ins,
.logo_text,
.post_price.price,
table th,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.author_title,
.widget_recent_comments .recentcomments> a,
.post_tags .post_meta_label,
.theme_scroll_down {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}

em, i,
.post-date, .rss-date 
.post_date, .post_meta_item,
.post_meta .vc_inline-link,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.format-audio .post_featured .post_audio_author,
.trx_addons_audio_player .audio_author,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}
.search_wrap .search_results .post_meta_item,
#services_page_tab_contacts .sc_form input[type="text"],
#services_page_tab_contacts .sc_form textarea {
	{$fonts['p_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area > ul,
.sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav,
.sc_layouts_menu_dir_vertical .sc_layouts_menu_nav {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li > a,
.sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav > li > a {
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_main_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description {
	{$fonts['menu_font-weight']}
}
.menu_main_nav > li > ul,
.sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav > li > ul,
.sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_popup .sc_layouts_menu_nav {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_line-height']}
}
.menu_main_nav > li ul > li > a,
.sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav > li ul > li > a,
.sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_popup .sc_layouts_menu_nav > li > a {
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}

.menu_mobile .menu_mobile_nav_area > ul {
	{$fonts['menu_font-family']}
}
.menu_mobile .menu_mobile_nav_area > ul > li ul {
	{$fonts['submenu_font-family']}
}
CSS;
			$rez          = apply_filters( 'heaven11_filter_get_css', $rez, array( 'fonts' => $fonts ) );
			$css['fonts'] = $rez['fonts'];
		}

		// Theme vars
		//---------------------------------------------
		if ( null === $vars ) {
			$vars = heaven11_get_theme_vars();
		}

		if ( $vars ) {

			// Make theme-specific fonts rules
			$vars = heaven11_customizer_add_theme_vars( $vars );
			extract( $vars );

			// Border radius
			//--------------------------------------
			$rez         = array();
			$rez['vars'] = <<<CSS

/* Buttons */
body .booked-modal input[type=submit],
body .booked-modal button,
body .booked-calendar button,
button:not(.components-button),
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.post_item .more-link,
.gallery_preview_show .post_readmore,

/* Fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="password"],
input[type="search"],
select,
.select_container,
textarea,

/* Search fields */
.widget_search .search-field,
.woocommerce.widget_product_search .search_field,
.widget_display_search #bbp_search,
#bbpress-forums #bbp-search-form #bbp_search,

/* Comment fields */
.comments_wrap .comments_field input,
.comments_wrap .comments_field textarea,

/* Select 2 */
.select2-container.select2-container--default span.select2-choice,
.select2-container.select2-container--default span.select2-selection,

/* Images in widgets */
.widget_area .post_item .post_thumb img,
aside .post_item .post_thumb img,

/* Sidebar control */
.sidebar .sidebar_control,
.sidebar .sidebar_control:after,

/* Events */
.tribe-events .tribe-events-c-ical__link,
.tribe-events-c-nav__list .tribe-events-c-nav__list-item a,
/* Tags cloud */
.sc_edd_details .downloads_page_tags .downloads_page_data > a,
.widget_product_tag_cloud a,
.widget_tag_cloud a {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}
.select_container:before {
	-webkit-border-radius: 0 {$rad} {$rad} 0;
	    -ms-border-radius: 0 {$rad} {$rad} 0;
			border-radius: 0 {$rad} {$rad} 0;
}
textarea.wp-editor-area {
	-webkit-border-radius: 0 0 {$rad} {$rad};
	    -ms-border-radius: 0 0 {$rad} {$rad};
			border-radius: 0 0 {$rad} {$rad};
}

/* Radius 50% or 0 */
.widget li a > img,
.widget li span > img {
	-webkit-border-radius: {$rad50};
	    -ms-border-radius: {$rad50};
			border-radius: {$rad50};
}

CSS;

			// Content and sidebar
			//--------------------------------------
			$rez['vars'] .= <<<CSS
.body_style_boxed .page_wrap {
	width: $page_boxed;
}
.content_wrap,
.content_container {
	width: $page;
}

body.body_style_wide:not(.expand_content) [class*="content_wrap"] > .content,
body.body_style_boxed:not(.expand_content) [class*="content_wrap"] > .content {	width: $content; }
[class*="content_wrap"] > .sidebar { 											width: $sidebar; }

.body_style_fullwide.sidebar_right [class*="content_wrap"] > .content,
.body_style_fullscreen.sidebar_right [class*="content_wrap"] > .content { padding-right: $sidebar_gap; }
.body_style_fullwide.sidebar_right [class*="content_wrap"] > .sidebar,
.body_style_fullscreen.sidebar_right [class*="content_wrap"] > .sidebar { margin-left: -$sidebar; }
.body_style_fullwide.sidebar_left [class*="content_wrap"] > .content,
.body_style_fullscreen.sidebar_left [class*="content_wrap"] > .content { padding-left:  $sidebar_gap; }
.body_style_fullwide.sidebar_left [class*="content_wrap"] > .sidebar,
.body_style_fullscreen.sidebar_left [class*="content_wrap"] > .sidebar { margin-right:-$sidebar; }

CSS;
			$rez          = apply_filters( 'heaven11_filter_get_css', $rez, array( 'vars' => $vars ) );
			$css['vars']  = $rez['vars'];
		}

		// Theme colors
		//--------------------------------------
		if ( false !== $colors ) {
			$schemes = empty( $scheme ) ? array_keys( heaven11_get_sorted_schemes() ) : array( $scheme );

			if ( count( $schemes ) > 0 ) {
				$rez = array();
				foreach ( $schemes as $s ) {
					// Prepare colors
					if ( empty( $scheme ) ) {
						$colors = heaven11_get_scheme_colors( $s );
					}

					// Make theme-specific colors and tints
					$colors = heaven11_customizer_add_theme_colors( $colors );

					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags 
------------------------------------------ */
body,
.body_style_boxed .page_wrap {
	background-color: {$colors['bg_color']};
}
.scheme_self {
	color: {$colors['text']};
}
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a,
[class*="color_style_"] h1 a, [class*="color_style_"] h2 a, [class*="color_style_"] h3 a, [class*="color_style_"] h4 a, [class*="color_style_"] h5 a, [class*="color_style_"] h6 a, [class*="color_style_"] li a {
	color: {$colors['text_dark']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
li a:hover {
	color: {$colors['text_link']};
}
.color_style_link2 h1 a:hover, .color_style_link2 h2 a:hover, .color_style_link2 h3 a:hover, .color_style_link2 h4 a:hover, .color_style_link2 h5 a:hover, .color_style_link2 h6 a:hover, .color_style_link2 li a:hover {
	color: {$colors['text_link2']};
}
.color_style_link3 h1 a:hover, .color_style_link3 h2 a:hover, .color_style_link3 h3 a:hover, .color_style_link3 h4 a:hover, .color_style_link3 h5 a:hover, .color_style_link3 h6 a:hover, .color_style_link3 li a:hover {
	color: {$colors['text_link3']};
}
.color_style_dark h1 a:hover, .color_style_dark h2 a:hover, .color_style_dark h3 a:hover, .color_style_dark h4 a:hover, .color_style_dark h5 a:hover, .color_style_dark h6 a:hover, .color_style_dark li a:hover {
	color: {$colors['text_link']};
}

dt, b, strong, em, mark, ins {	/* not 'i', because it used as icons container */
	color: {$colors['text_dark']};
}
s, strike, del {	
	color: {$colors['text_light']};
}

code {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
code a {
	color: {$colors['alter_link']};
}
code a:hover {
	color: {$colors['alter_hover']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}
.color_style_link2 a {
	color: {$colors['text_link2']};
}
.color_style_link2 a:hover {
	color: {$colors['text_hover2']};
}
.color_style_link3 a {
	color: {$colors['text_link3']};
}
.color_style_link3 a:hover {
	color: {$colors['text_hover3']};
}
.color_style_dark a {
	color: {$colors['text_dark']};
}
.color_style_dark a:hover {
	color: {$colors['text_link']};
}

blockquote,
.wp-block-pullquote:not(.is-style-solid-color) {
	color: {$colors['alter_text']};
	background-color: {$colors['extra_bg_color']};
}
blockquote:not([style=""]):not(.has-text-color):not(.has-text-link-3-color):not(.has-bd-color-color):before {
	color: {$colors['inverse_link']};
}
blockquote a {
	color: {$colors['alter_text']};
}
blockquote a:hover {
	color: {$colors['extra_dark']};
}

blockquote dt, blockquote b, blockquote strong, blockquote i, blockquote em, blockquote mark, blockquote ins,
blockquote:not([style=""]):not(.has-text-color):not(.has-text-link-3-color):not(.has-bd-color-color) cite {
	color: {$colors['extra_dark']};
}
blockquote s, blockquote strike, blockquote del {	
	color: {$colors['extra_light']};
}
blockquote code {
	color: {$colors['text_dark']};
	background-color: {$colors['extra_bg_hover']};
	border-color: {$colors['extra_bd_hover']};
}
blockquote a:hover code {
	color: {$colors['text_link']};
}
.sc_item_descr blockquote {
	background-color: transparent !important;
}
.sc_item_descr blockquote:before {
	color: {$colors['text_hover']} !important;
}

table th, table th + th, table td + th  {
	border-color: {$colors['extra_dark']};
}
table td, table th + td, table td + td {
	color: {$colors['alter_dark']};
	border-color: {$colors['bg_color']};
}
table th, table th a {
	color: {$colors['extra_dark']};
	background-color: {$colors['extra_bg_color']};
}
table th b, table th strong {
	color: {$colors['extra_dark']};
}
table > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['alter_bd_hover']};
}
table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['alter_bg_hover']};
}
table th a:hover {
	color: {$colors['inverse_hover']};
}
.properties-table table tr>td:first-child {
    color: {$colors['text_hover']};
}

.sc_table_alter table > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['extra_link2']};
}
.sc_table_alter table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['extra_hover2']};
}
.sc_table_alter table td, .sc_table_alter table th + td, .sc_table_alter table td + td {
	color: {$colors['bg_color']};
	border-color: {$colors['extra_bd_color']};
}
.sc_table_alter td a {
    color: {$colors['inverse_link']};
}

hr {
	border-color: {$colors['bd_color']};
}
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	color: {$colors['inverse_link']};
	background-color: {$colors['bg_color_0']};
}

figure.wp-block-video figcaption,
figure.wp-block-embed figcaption,
.wp-block-gallery > .blocks-gallery-caption,
.wp-block-embed__wrapper + figcaption {
	color: {$colors['text_dark']};
}
ul > li:before {
	color: {$colors['text_link']};
}
ul.trx_addons_list_extra[class*="trx_addons_list"] {
    color: {$colors['alter_dark']};
}


/* Form fields
-------------------------------------------------- */
.widget_search form.wp-block-search .wp-block-search__inside-wrapper:after,
.widget_search form:not(.wp-block-search):after,
.woocommerce.widget_product_search form:after,
.widget_display_search form:after,
#bbpress-forums #bbp-search-form:after {
	color: {$colors['text_link']};
}
.widget_search form.wp-block-search .wp-block-search__inside-wrapper:hover:after,
.widget_search form:not(.wp-block-search):hover:after,
.woocommerce.widget_product_search form:hover:after,
.widget_display_search form:hover:after,
#bbpress-forums #bbp-search-form:hover:after {
	color: {$colors['input_text']};
}
.sidebar .widget.widget_search  {
	background-color: {$colors['alter_dark']};
}
.sidebar .widget_search.widget .wp-block-search__label,
.sidebar .widget_search.widget .widget_title,
.sidebar .widget_search.widget .widgettitle {
	color: {$colors['bg_color']};
}

/* Field set */
fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

/* Text fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="search"],
input[type="password"],
.select_container,
.select2-container.select2-container--default span.select2-choice,
.select2-container.select2-container--default span.select2-selection,
.select2-container.select2-container--default .select2-selection--single .select2-selection__rendered,
.select2-container.select2-container--default .select2-selection--multiple,
textarea,
textarea.wp-editor-area,
/* Tour Master */
.tourmaster-form-field input[type="text"],
.tourmaster-form-field input[type="email"],
.tourmaster-form-field input[type="password"],
.tourmaster-form-field textarea,
.tourmaster-form-field select,
.tourmaster-form-field.tourmaster-with-border input[type="text"],
.tourmaster-form-field.tourmaster-with-border input[type="email"],
.tourmaster-form-field.tourmaster-with-border input[type="password"],
.tourmaster-form-field.tourmaster-with-border textarea,
.tourmaster-form-field.tourmaster-with-border select,
/* BB Press */
#buddypress .dir-search input[type="search"],
#buddypress .dir-search input[type="text"],
#buddypress .groups-members-search input[type="search"],
#buddypress .groups-members-search input[type="text"],
#buddypress .standard-form input[type="color"],
#buddypress .standard-form input[type="date"],
#buddypress .standard-form input[type="datetime-local"],
#buddypress .standard-form input[type="datetime"],
#buddypress .standard-form input[type="email"],
#buddypress .standard-form input[type="month"],
#buddypress .standard-form input[type="number"],
#buddypress .standard-form input[type="password"],
#buddypress .standard-form input[type="range"],
#buddypress .standard-form input[type="search"],
#buddypress .standard-form input[type="tel"],
#buddypress .standard-form input[type="text"],
#buddypress .standard-form input[type="time"],
#buddypress .standard-form input[type="url"],
#buddypress .standard-form input[type="week"],
#buddypress .standard-form select,
#buddypress .standard-form textarea,
#buddypress form#whats-new-form textarea,
/* Booked */
#booked-page-form input[type="email"],
#booked-page-form input[type="text"],
#booked-page-form input[type="password"],
#booked-page-form textarea,
.booked-upload-wrap,
.booked-upload-wrap input,
body .booked-form .field select,
body .booked-form .field input[type="text"],
body .booked-form .field input[type="password"],
body .booked-form .field input[type="tel"],
body .booked-form .field input[type="email"],
body .booked-form .field textarea,
/* MailChimp */
form.mc4wp-form input[type="email"] {
	color: {$colors['input_text']};
	border-color: {$colors['input_dark']};
	background-color: {$colors['input_bg_color']};
}
.form_white input[type="text"],
.form_white input[type="email"],
.form_white textarea {
	background-color: {$colors['input_bg_hover']};
}
input[type="text"]:hover,
input[type="number"]:hover,
input[type="email"]:hover,
input[type="tel"]:hover,
input[type="search"]:hover,
input[type="password"]:hover,
.select_container:hover,
select option:hover,
select option:hover,
.select2-container .select2-choice:hover,
textarea:hover,
textarea.wp-editor-area:hover,
/* BB Press */
#buddypress .dir-search input[type="search"]:hover,
#buddypress .dir-search input[type="text"]:hover,
#buddypress .groups-members-search input[type="search"]:hover,
#buddypress .groups-members-search input[type="text"]:hover,
#buddypress .standard-form input[type="color"]:hover,
#buddypress .standard-form input[type="date"]:hover,
#buddypress .standard-form input[type="datetime-local"]:hover,
#buddypress .standard-form input[type="datetime"]:hover,
#buddypress .standard-form input[type="email"]:hover,
#buddypress .standard-form input[type="month"]:hover,
#buddypress .standard-form input[type="number"]:hover,
#buddypress .standard-form input[type="password"]:hover,
#buddypress .standard-form input[type="range"]:hover,
#buddypress .standard-form input[type="search"]:hover,
#buddypress .standard-form input[type="tel"]:hover,
#buddypress .standard-form input[type="text"]:hover,
#buddypress .standard-form input[type="time"]:hover,
#buddypress .standard-form input[type="url"]:hover,
#buddypress .standard-form input[type="week"]:hover,
#buddypress .standard-form select:hover,
#buddypress .standard-form textarea:hover,
#buddypress form#whats-new-form textarea:hover,
/* Booked */
#booked-page-form input[type="email"]:hover,
#booked-page-form input[type="text"]:hover,
#booked-page-form input[type="password"]:hover,
#booked-page-form textarea:hover,
.booked-upload-wrap:hover,
.booked-upload-wrap input:hover {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}
input[type="text"]:focus,
input[type="text"].filled,
input[type="number"]:focus,
input[type="number"].filled,
input[type="email"]:focus,
input[type="email"].filled,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="search"].filled,
input[type="password"]:focus,
input[type="password"].filled,
.select_container:hover,
select option:hover,
select option:focus,
.select2-container.select2-container--default span.select2-choice:hover,
.select2-container.select2-container--focus span.select2-choice,
.select2-container.select2-container--open span.select2-choice,
.select2-container.select2-container--focus span.select2-selection--single .select2-selection__rendered,
.select2-container.select2-container--open span.select2-selection--single .select2-selection__rendered,
.select2-container.select2-container--default span.select2-selection--single:hover .select2-selection__rendered,
.select2-container.select2-container--default span.select2-selection--multiple:hover,
.select2-container.select2-container--focus span.select2-selection--multiple,
.select2-container.select2-container--open span.select2-selection--multiple,
textarea:focus,
textarea.filled,
textarea.wp-editor-area:focus,
textarea.wp-editor-area.filled,
/* Tour Master */
.tourmaster-form-field input[type="text"]:focus,
.tourmaster-form-field input[type="text"].filled,
.tourmaster-form-field input[type="email"]:focus,
.tourmaster-form-field input[type="email"].filled,
.tourmaster-form-field input[type="password"]:focus,
.tourmaster-form-field input[type="password"].filled,
.tourmaster-form-field textarea:focus,
.tourmaster-form-field textarea.filled,
.tourmaster-form-field select:focus,
.tourmaster-form-field select.filled,
.tourmaster-form-field.tourmaster-with-border input[type="text"]:focus,
.tourmaster-form-field.tourmaster-with-border input[type="text"].filled,
.tourmaster-form-field.tourmaster-with-border input[type="email"]:focus,
.tourmaster-form-field.tourmaster-with-border input[type="email"].filled,
.tourmaster-form-field.tourmaster-with-border input[type="password"]:focus,
.tourmaster-form-field.tourmaster-with-border input[type="password"].filled,
.tourmaster-form-field.tourmaster-with-border textarea:focus,
.tourmaster-form-field.tourmaster-with-border textarea.filled,
.tourmaster-form-field.tourmaster-with-border select:focus,
.tourmaster-form-field.tourmaster-with-border select.filled,
/* BB Press */
#buddypress .dir-search input[type="search"]:focus,
#buddypress .dir-search input[type="search"].filled,
#buddypress .dir-search input[type="text"]:focus,
#buddypress .dir-search input[type="text"].filled,
#buddypress .groups-members-search input[type="search"]:focus,
#buddypress .groups-members-search input[type="search"].filled,
#buddypress .groups-members-search input[type="text"]:focus,
#buddypress .groups-members-search input[type="text"].filled,
#buddypress .standard-form input[type="color"]:focus,
#buddypress .standard-form input[type="color"].filled,
#buddypress .standard-form input[type="date"]:focus,
#buddypress .standard-form input[type="date"].filled,
#buddypress .standard-form input[type="datetime-local"]:focus,
#buddypress .standard-form input[type="datetime-local"].filled,
#buddypress .standard-form input[type="datetime"]:focus,
#buddypress .standard-form input[type="datetime"].filled,
#buddypress .standard-form input[type="email"]:focus,
#buddypress .standard-form input[type="email"].filled,
#buddypress .standard-form input[type="month"]:focus,
#buddypress .standard-form input[type="month"].filled,
#buddypress .standard-form input[type="number"]:focus,
#buddypress .standard-form input[type="number"].filled,
#buddypress .standard-form input[type="password"]:focus,
#buddypress .standard-form input[type="password"].filled,
#buddypress .standard-form input[type="range"]:focus,
#buddypress .standard-form input[type="range"].filled,
#buddypress .standard-form input[type="search"]:focus,
#buddypress .standard-form input[type="search"].filled,
#buddypress .standard-form input[type="tel"]:focus,
#buddypress .standard-form input[type="tel"].filled,
#buddypress .standard-form input[type="text"]:focus,
#buddypress .standard-form input[type="text"].filled,
#buddypress .standard-form input[type="time"]:focus,
#buddypress .standard-form input[type="time"].filled,
#buddypress .standard-form input[type="url"]:focus,
#buddypress .standard-form input[type="url"].filled,
#buddypress .standard-form input[type="week"]:focus,
#buddypress .standard-form input[type="week"].filled,
#buddypress .standard-form select:focus,
#buddypress .standard-form select.filled,
#buddypress .standard-form textarea:focus,
#buddypress .standard-form textarea.filled,
#buddypress form#whats-new-form textarea:focus,
#buddypress form#whats-new-form textarea.filled,
/* Booked */
#booked-page-form input[type="email"]:focus,
#booked-page-form input[type="email"].filled,
#booked-page-form input[type="text"]:focus,
#booked-page-form input[type="text"].filled,
#booked-page-form input[type="password"]:focus,
#booked-page-form input[type="password"].filled,
#booked-page-form textarea:focus,
#booked-page-form textarea.filled,
.booked-upload-wrap:hover,
.booked-upload-wrap input:focus,
.booked-upload-wrap input.filled,
/* MailChimp */
form.mc4wp-form input[type="email"]:focus,
form.mc4wp-form input[type="email"].filled {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_hover']};
}

input[placeholder]::-webkit-input-placeholder,
textarea[placeholder]::-webkit-input-placeholder	{ color: {$colors['input_light']}; }
input[placeholder]::-moz-placeholder,
textarea[placeholder]::-moz-placeholder				{ color: {$colors['input_light']}; }
input[placeholder]:-ms-input-placeholder,
textarea[placeholder]:-ms-input-placeholder			{ color: {$colors['input_light']}; }
input[placeholder]::placeholder,
textarea[placeholder]::placeholder					{ color: {$colors['input_light']}; }

/* Select containers */
.select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.select_container:focus:before,
.select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_color']};
}
.select_container:after {
	color: {$colors['input_text']};
}
.select_container:focus:after,
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.select_container select {
	color: {$colors['input_text']};
	background: {$colors['input_bg_color']} !important;
}
.select_container select:focus {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']} !important;
}
.sidebar .select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['bg_color']};
}
.sidebar .select_container:focus:before,
.sidebar .select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['bg_color']};
}
.sidebar .select_container select {
	color: {$colors['input_text']};
	background: {$colors['bg_color']} !important;
}
.sidebar .select_container select:focus {
	color: {$colors['input_text']};
	background-color: {$colors['bg_color']} !important;
}

.select2-dropdown,
.select2-container.select2-container--focus span.select2-selection,
.select2-container.select2-container--open span.select2-selection {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_hover']};
}
.select2-container .select2-results__option {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}
.select2-dropdown .select2-highlighted,
.select2-container .select2-results__option--highlighted[aria-selected] {
	color: {$colors['inverse_link']};
	background: {$colors['text_link']};
}

input[type="radio"] + label:before,
input[type="checkbox"] + label:before,
.wpcf7-list-item-label.wpcf7-list-item-right:before {
	border-color: {$colors['input_bd_color']} !important;
}


/* Simple button */
.sc_button_simple:not(.sc_button_bg_image) {
	color:{$colors['text_link']};
}
.sc_button_simple:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover']} !important;
}
.sc_button_simple.color_style_link2:not(.sc_button_bg_image),
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image) {
	color:{$colors['text_link2']};
}
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover2']};
}

.sc_button_simple.color_style_link3:not(.sc_button_bg_image),
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image) {
	color:{$colors['text_link3']};
}
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover3']};
}

.sc_button_simple.color_style_dark:not(.sc_button_bg_image),
.color_style_dark .sc_button_simple:not(.sc_button_bg_image) {
	color:{$colors['text_dark']};
}
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover {
	color:{$colors['text_link']};
}


/* Bordered button */
.wp-block-button.is-style-outline > .wp-block-button__link,
.sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['text_link']};
	border-color:{$colors['text_link']};
}
.wp-block-button.is-style-outline > .wp-block-button__link:hover,
.sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover']} !important;
	border-color:{$colors['text_hover']} !important;
}
.sc_button_bordered.color_style_link2:not(.sc_button_bg_image) {
	color:{$colors['text_link2']};
	border-color:{$colors['text_link2']};
}
.sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover2']} !important;
	border-color:{$colors['text_hover2']} !important;
}
.sc_button_bordered.color_style_link3:not(.sc_button_bg_image) {
	color:{$colors['text_link3']};
	border-color:{$colors['text_link3']};
}
.sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover3']} !important;
	border-color:{$colors['text_hover3']} !important;
}
.sc_button_bordered.color_style_dark:not(.sc_button_bg_image) {
	color:{$colors['text_dark']};
	border-color:{$colors['text_dark']};
}
.sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover {
	color:{$colors['text_link']} !important;
	border-color:{$colors['text_link']} !important;
}

/* Normal button */
.wp-block-button:not(.is-style-outline)>.wp-block-button__link,
button:not(.components-button),
input[type="reset"],
input[type="submit"],
input[type="button"],
.post_item .more-link,
.comments_wrap .form-submit input[type="submit"],
/* BB & Buddy Press */
#buddypress .comment-reply-link,
#buddypress .generic-button a,
#buddypress a.button,
#buddypress button,
#buddypress input[type="button"],
#buddypress input[type="reset"],
#buddypress input[type="submit"],
#buddypress ul.button-nav li a,
a.bp-title-button,
/* Booked */
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
#booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a,
#booked-profile-page input[type="submit"],
#booked-profile-page button,
.booked-list-view input[type="submit"],
.booked-list-view button,
table.booked-calendar input[type="submit"],
table.booked-calendar button,
.booked-modal input[type="submit"],
.booked-modal button,
/* ThemeREX Addons */
.sc_button_default,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.socials_share:not(.socials_type_drop) .social_icon,
/* Tour Master */
.tourmaster-tour-search-wrap input.tourmaster-tour-search-submit[type="submit"],
/* Tribe Events */
.tribe-events-single .tribe-events-sub-nav .tribe-events-nav-next a,
.tribe-events-single .tribe-events-sub-nav .tribe-events-nav-previous a,
.tribe-events .tribe-events-c-nav__list .tribe-events-c-nav__list-item .tribe-common-b2,
.tribe-events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__button,
#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"],
#tribe-bar-form .tribe-bar-views-toggle,
#tribe-bar-views li.tribe-bar-views-option,
#tribe-events .tribe-events-button,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a,
/* EDD buttons */
.edd_download_purchase_form .button,
#edd-purchase-button,
.edd-submit.button,
.widget_edd_cart_widget .edd_checkout a,
.sc_edd_details .downloads_page_tags .downloads_page_data > a,
/* MailChimp */
.mc4wp-form input[type="submit"],
/* WooCommerce */
.woocommerce #respond input#submit,
.woocommerce .button, .woocommerce-page .button,
.woocommerce a.button, .woocommerce-page a.button,
.woocommerce button.button, .woocommerce-page button.button,
.woocommerce input.button, .woocommerce-page input.button,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"],
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
/* Events */
.tribe-common--breakpoint-medium.tribe-common .tribe-common-c-btn-border-small,
.tribe-common--breakpoint-medium.tribe-common a.tribe-common-c-btn-border-small,
.tribe-events .tribe-events-c-nav__next,
.tribe-events .tribe-events-c-nav__prev,
.tribe-events .tribe-events-c-ical__link,
.tribe-events-cal-links .tribe-events-ics.tribe-events-button,
.tribe-events-cal-links .tribe-events-gcal.tribe-events-button,
.tribe-events-cal-links .tribe-events-ical.tribe-events-button,
/* Grid */
.esg-navigationbutton.esg-loadmore {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

.woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit[disabled]:disabled,
.woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button[disabled]:disabled,
.woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button[disabled]:disabled,
.woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button[disabled]:disabled {
	color: {$colors['inverse_link']};
}
.theme_button {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}
.theme_button.color_style_link2 {
	background-color: {$colors['text_link2']} !important;
}
.theme_button.color_style_link3 {
	background-color: {$colors['text_link3']} !important;
}
.theme_button.color_style_dark {
	color: {$colors['bg_color']} !important;
	background-color: {$colors['text_dark']} !important;
}
.sc_price_item_link {
	color: {$colors['inverse_link']};
	background-color: {$colors['extra_link']};
}
.sc_button_default.color_style_link2,
.sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['text_link2']};
}
.sc_button_default.color_style_link3,
.sc_button.color_style_link3:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['text_link3']};
}
.sc_button_default.color_style_dark,
.sc_button.color_style_dark:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.search_wrap .search_submit:before {
	color: {$colors['input_text']};
}

button[disabled],
input[type="submit"][disabled],
input[type="button"][disabled],
button[disabled]:hover,
input[type="submit"][disabled]:hover,
input[type="button"][disabled]:hover {
	background: {$colors['text_light']} !important;
	color: {$colors['text']} !important;
}

.wp-block-button:not(.is-style-outline)>.wp-block-button__link:hover,
button:hover,
button:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="button"]:hover,
input[type="button"]:focus,
.post_item .more-link:hover,
.comments_wrap .form-submit input[type="submit"]:hover,
.comments_wrap .form-submit input[type="submit"]:focus,
/* BB & Buddy Press */
#buddypress .comment-reply-link:hover,
#buddypress .generic-button a:hover,
#buddypress a.button:hover,
#buddypress button:hover,
#buddypress input[type="button"]:hover,
#buddypress input[type="reset"]:hover,
#buddypress input[type="submit"]:hover,
#buddypress ul.button-nav li a:hover,
a.bp-title-button:hover,
/* Booked */
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:hover,
body #booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a:hover,
body #booked-profile-page input[type="submit"]:hover,
body #booked-profile-page button:hover,
body .booked-list-view input[type="submit"]:hover,
body .booked-list-view button:hover,
body table.booked-calendar input[type="submit"]:hover,
body table.booked-calendar button:hover,
body .booked-modal input[type="submit"]:hover,
body .booked-modal button:hover,
/* ThemeREX Addons */
.sc_button_default:hover,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.socials_share:not(.socials_type_drop) .social_icon:hover,
/* Tour Master */
.tourmaster-tour-search-wrap input.tourmaster-tour-search-submit[type="submit"]:hover,
/* Tribe Events */
.tribe-events .tribe-events-c-search__button:focus,
.tribe-events .tribe-events-c-search__button:hover,
.tribe-events .tribe-events-c-search__button:active,
.tribe-events-single .tribe-events-sub-nav .tribe-events-nav-next a:hover,
.tribe-events-single .tribe-events-sub-nav .tribe-events-nav-previous a:hover,
.tribe-events .tribe-events-c-nav__list .tribe-events-c-nav__list-item .tribe-common-b2:hover,
.tribe-events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__button.tribe-events-c-subscribe-dropdown__button--active,
.tribe-events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__button:active,
.tribe-events .tribe-events-c-subscribe-dropdown .tribe-events-c-subscribe-dropdown__button:hover,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-c-btn-border-small:hover,
.tribe-common--breakpoint-medium.tribe-common a.tribe-common-c-btn-border-small:hover,
#tribe-bar-form .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-form .tribe-bar-views-toggle:hover,
#tribe-bar-views li.tribe-bar-views-option:hover,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active:hover,
#tribe-events .tribe-events-button:hover,
.tribe-events-button:hover,
.tribe-events-cal-links a:hover,
.tribe-events-sub-nav li a:hover,
.tribe-events .tribe-events-c-nav__next:hover,
.tribe-events .tribe-events-c-nav__prev:hover,
.tribe-events .tribe-events-c-ical__link:hover,
.tribe-events-cal-links .tribe-events-ics.tribe-events-button:hover,
.tribe-events-cal-links .tribe-events-gcal.tribe-events-button:hover,
.tribe-events-cal-links .tribe-events-ical.tribe-events-button:hover,
/* EDD buttons */
.edd_download_purchase_form .button:hover, .edd_download_purchase_form .button:active, .edd_download_purchase_form .button:focus,
#edd-purchase-button:hover, #edd-purchase-button:active, #edd-purchase-button:focus,
.edd-submit.button:hover, .edd-submit.button:active, .edd-submit.button:focus,
.widget_edd_cart_widget .edd_checkout a:hover,
.sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
/* MailChimp */
.mc4wp-form input[type="submit"]:hover,
.mc4wp-form input[type="submit"]:focus,
/* WooCommerce */
.woocommerce #respond input#submit:hover,
.woocommerce .button:hover, .woocommerce-page .button:hover,
.woocommerce a.button:hover, .woocommerce-page a.button:hover,
.woocommerce button.button:hover, .woocommerce-page button.button:hover,
.woocommerce input.button:hover, .woocommerce-page input.button:hover,
.woocommerce input[type="button"]:hover, .woocommerce-page input[type="button"]:hover,
.woocommerce input[type="submit"]:hover, .woocommerce-page input[type="submit"]:hover,
/* Grid */
.esg-navigationbutton.esg-loadmore:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['text_hover']};
}
.theme_button:hover,
.theme_button:focus {
	color: {$colors['inverse_hover']} !important;
	background-color: {$colors['text_link_blend']} !important;
}
.theme_button.color_style_link2:hover {
	background-color: {$colors['text_hover2']} !important;
}
.theme_button.color_style_link3:hover {
	background-color: {$colors['text_hover3']} !important;
}
.theme_button.color_style_dark:hover {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']} !important;
}
.sc_price_item:hover .sc_price_item_link,
.sc_price_item_link:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['extra_hover']};
}
.sc_button_default.color_style_link2:hover,
.sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['text_hover2']};
}
.sc_button_default.color_style_link3:hover,
.sc_button.color_style_link3:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['text_hover3']};
}
.sc_button_default.color_style_dark:hover,
.sc_button.color_style_dark:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.search_wrap .search_submit:hover:before {
	color: {$colors['input_dark']};
}
.header_type_default .search_wrap .search_submit:hover:before,
.search .search_wrap .search_submit:hover:before {
	color: {$colors['text_hover']};
}
#trx_addons_login_popup .trx_addons_popup_form_field_remember label:before,
#trx_addons_login_popup .trx_addons_popup_form_field_agree label:before {
  	color: {$colors['text_link']};
}



/* Buttons in sidebars 
------------------------------------- */

/* Simple button */
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image) {
	color:{$colors['alter_link']};
}
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover']} !important;
}

/* Bordered button */
.scheme_self.sidebar .sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['alter_link']};
	border-color:{$colors['alter_link']};
}
.scheme_self.sidebar .sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover']} !important;
	border-color:{$colors['alter_hover']} !important;
}

/* All other buttons */
.scheme_self.sidebar button,
.scheme_self.sidebar input[type="reset"],
.scheme_self.sidebar input[type="submit"],
.scheme_self.sidebar input[type="button"],
/* ThemeREX Addons */
.scheme_self.sidebar .sc_button_default,
.scheme_self.sidebar .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.scheme_self.sidebar .socials_share:not(.socials_type_drop) .social_icon,
/* EDD buttons */
.scheme_self.sidebar .edd_download_purchase_form .button,
.scheme_self.sidebar #edd-purchase-button,
.scheme_self.sidebar .edd-submit.button,
.scheme_self.sidebar .widget_edd_cart_widget .edd_checkout a,
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a,
/* WooCommerce */
.scheme_self.sidebar .woocommerce-message .button,
.scheme_self.sidebar .woocommerce-error .button,
.scheme_self.sidebar .woocommerce-info .button,
.scheme_self.sidebar .widget.woocommerce .button,
.scheme_self.sidebar .widget.woocommerce a.button,
.scheme_self.sidebar .widget.woocommerce button.button,
.scheme_self.sidebar .widget.woocommerce input.button,
.scheme_self.sidebar .widget.woocommerce input[type="button"],
.scheme_self.sidebar .widget.woocommerce input[type="submit"],
.scheme_self.sidebar .widget.WOOCS_CONVERTER .button,
.scheme_self.sidebar .widget.yith-woocompare-widget a.button,
.scheme_self.sidebar .widget_product_search .search_button {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}

/* All other buttons hovered */
.scheme_self.sidebar button:hover,
.scheme_self.sidebar button:focus,
.scheme_self.sidebar input[type="reset"]:hover,
.scheme_self.sidebar input[type="reset"]:focus,
.scheme_self.sidebar input[type="submit"]:hover,
.scheme_self.sidebar input[type="submit"]:focus,
.scheme_self.sidebar input[type="button"]:hover,
.scheme_self.sidebar input[type="button"]:focus,
/* ThemeREX Addons */
.scheme_self.sidebar .sc_button_default:hover,
.scheme_self.sidebar .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.scheme_self.sidebar .socials_share:not(.socials_type_drop) .social_icon:hover,
/* EDD buttons */
.scheme_self.sidebar .edd_download_purchase_form .button:hover,
.scheme_self.sidebar #edd-purchase-button:hover,
.scheme_self.sidebar .edd-submit.button:hover,
.scheme_self.sidebar .widget_edd_cart_widget .edd_checkout a:hover,
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
/* WooCommerce */
.scheme_self.sidebar .woocommerce-message .button:hover,
.scheme_self.sidebar .woocommerce-error .button:hover,
.scheme_self.sidebar .woocommerce-info .button:hover,
.scheme_self.sidebar .widget.woocommerce .button:hover,
.scheme_self.sidebar .widget.woocommerce a.button:hover,
.scheme_self.sidebar .widget.woocommerce button.button:hover,
.scheme_self.sidebar .widget.woocommerce button.button:focus,
.scheme_self.sidebar .widget.woocommerce input.button:hover,
.scheme_self.sidebar .widget.woocommerce input.button:focus,
.scheme_self.sidebar .widget.woocommerce input[type="button"]:hover,
.scheme_self.sidebar .widget.woocommerce input[type="button"]:focus,
.scheme_self.sidebar .widget.woocommerce input[type="submit"]:hover,
.scheme_self.sidebar .widget.woocommerce input[type="submit"]:focus,
.scheme_self.sidebar .widget.WOOCS_CONVERTER .button:hover,
.scheme_self.sidebar .widget.yith-woocompare-widget a.button:hover,
.scheme_self.sidebar .widget_product_search .search_button:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_hover']};
}

/* Buttons in WP Editor */
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
	    -ms-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
			box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color: {$colors['alter_link']};
}


/* WP Standard classes 
-------------------------------------------- */
.sticky {
	border-color: {$colors['bd_color']};
	background-color: {$colors['input_bg_color']};
}
.sticky .label_sticky {
	border-top-color: {$colors['text_link']};
	color: {$colors['text_hover']};
}
.sticky .label_sticky:before {
    background-color: {$colors['text_hover']};
}


/* Custom layouts
--------------------------------- */

.scheme_self.top_panel,
.scheme_self.footer_wrap {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}


.scheme_self.sc_layouts_row {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}

.sc_layouts_row_delimiter,
.scheme_self.sc_layouts_row_delimiter {
	border-color: {$colors['bd_color']};
}

.footer_wrap .scheme_self.vc_row .sc_layouts_row_delimiter,
.footer_wrap .scheme_self.sc_layouts_row_delimiter,
.scheme_self.footer_wrap .sc_layouts_row_delimiter {
	border-color: {$colors['alter_bd_color']};
}

.sc_layouts_iconed_text .sc_layouts_item_icon {
	color: {$colors['extra_link3']};
}
.sc_layouts_iconed_text .sc_layouts_item_details_line1 {
	color: {$colors['text_dark']};
}
.sc_layouts_iconed_text .sc_layouts_item_details_line2 {
	color: {$colors['extra_link3']};
}

.sc_layouts_iconed_text_alter.sc_layouts_iconed_text {
	background-color: transparent;
}
.sc_layouts_iconed_text_alter .sc_layouts_item_icon {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

span.trx_addons_login_menu,
span.trx_addons_login_menu:after {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
span.trx_addons_login_menu .trx_addons_login_menu_delimiter {
	border-color: {$colors['alter_bd_color']};
}
span.trx_addons_login_menu .trx_addons_login_menu_item {
	color: {$colors['alter_text']};
}
span.trx_addons_login_menu .trx_addons_login_menu_item:hover {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_hover']};
}


.sc_layouts_item_details.sc_layouts_login_details:hover span {
    color: {$colors['text_hover']};
}

.sc_layouts_row_fixed_on {
	background-color: {$colors['bg_color']};
}

/* Row type: Narrow */
.sc_layouts_row.sc_layouts_row_type_narrow,
.scheme_self.sc_layouts_row.sc_layouts_row_type_narrow {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_row_type_narrow .sc_layouts_item,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover,

.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover,

.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon {
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_icon {
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.sc_layouts_row_type_narrow .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line2 {
	color: {$colors['alter_text']};
}

.sc_layouts_row_type_narrow .socials_wrap .social_item .social_icon,
.scheme_self.sc_layouts_row_type_narrow .socials_wrap .social_item .social_icon {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .socials_wrap .social_item:hover .social_icon,
.scheme_self.sc_layouts_row_type_narrow .socials_wrap .social_item:hover .social_icon {
	background-color: transparent;
	color: {$colors['alter_hover']};
}

.sc_layouts_row_type_narrow .sc_button_default,
.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_default,
.scheme_self.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button_default:hover,
.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_default:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link2,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2 {
	background-color: {$colors['alter_link2']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover {
	background-color: {$colors['alter_hover2']};
	color: {$colors['inverse_link']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_link3,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link3 {
	background-color: {$colors['alter_link3']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link3:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover {
	background-color: {$colors['alter_hover3']};
	color: {$colors['inverse_link']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_dark,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_dark {
	background-color: {$colors['alter_dark']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_dark:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_dark:hover {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_link']} !important;
}

.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['alter_link']};
	border-color:{$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover']} !important;
	border-color:{$colors['alter_hover']} !important;
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image) {
	color:{$colors['alter_link2']};
	border-color:{$colors['alter_link2']};
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover2']} !important;
	border-color:{$colors['alter_hover2']} !important;
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image) {
	color:{$colors['alter_link3']};
	border-color:{$colors['alter_link3']};
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover3']} !important;
	border-color:{$colors['alter_hover3']} !important;
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image) {
	color:{$colors['alter_dark']};
	border-color:{$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover {
	color:{$colors['alter_link']} !important;
	border-color:{$colors['alter_link']} !important;
}

.sc_layouts_row_type_narrow .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:focus,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:focus {
	color: {$colors['alter_dark']};
}


/* Row type: Compact */
.sc_layouts_row_type_compact .sc_layouts_item,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item {
	color: {$colors['text']};
}

.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,

.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,

.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_dark']};
}

.sc_layouts_row_type_compact .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon {
	color: {$colors['text_link']};
}

.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.sc_layouts_row_type_compact .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line2 {
	color: {$colors['text']};
}

.sc_layouts_row_type_compact .socials_wrap .social_item .social_icon,
.scheme_self.sc_layouts_row_type_compact .socials_wrap .social_item .social_icon {
	background-color: transparent;
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .socials_wrap .social_item:hover .social_icon,
.scheme_self.sc_layouts_row_type_compact .socials_wrap .social_item:hover .social_icon {
	background-color: transparent;
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['text_hover']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit {
	color: {$colors['text_link']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover {
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['text']};
}


/* Row type: Normal */
.sc_layouts_row_type_normal .sc_layouts_item,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item {
	color: {$colors['text']};
}
.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['text']};
}
.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover,

.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover,

.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon {
	color: {$colors['inverse_hover']};
}

.sc_layouts_row_type_normal .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_normal .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['input_text']};
}
.sc_layouts_row_type_normal .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_normal .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['input_dark']};
}


/* Logo */
.sc_layouts_logo b {
	color: {$colors['text_dark']};
}
.sc_layouts_logo i {
	color: {$colors['text_link']};
}
.sc_layouts_logo_text,
.sc_layouts_logo .logo_text {
	color: {$colors['text_dark']} !important;
}
.sc_layouts_logo_text:hover,
.sc_layouts_logo:hover .logo_text {
	color: {$colors['text_link']} !important;
}
.sc_layouts_logo_slogan,
.sc_layouts_logo .logo_slogan {
	color: {$colors['text']} !important;
}


/* Search style 'Expand' */
.search_style_expand.search_opened {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_style_expand.search_opened .search_submit {
	color: {$colors['text']};
}
.search_style_expand .search_submit:hover,
.search_style_expand .search_submit:focus {
	color: {$colors['text_dark']};
}


/* Search style 'Fullscreen' */
.search_style_fullscreen.search_opened .search_form_wrap {
	background-color: {$colors['bg_color_09']};
}
.search_style_fullscreen.search_opened .search_form {
	border-color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close,
.search_style_fullscreen.search_opened .search_field,
.search_style_fullscreen.search_opened .search_submit {
	color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close:hover,
.search_style_fullscreen.search_opened .search_field:hover,
.search_style_fullscreen.search_opened .search_field:focus,
.search_style_fullscreen.search_opened .search_submit:hover,
.search_style_fullscreen.search_opened .search_submit:focus,
.search_style_fullscreen.search_opened .search_submit:hover:before {
	color: {$colors['text_light']};
}
.search_style_fullscreen .search_field::-webkit-input-placeholder {color:{$colors['text_dark']}; opacity: 1;}
.search_style_fullscreen .search_field::-moz-placeholder          {color:{$colors['text_dark']}; opacity: 1;}/* Firefox 19+ */
.search_style_fullscreen .search_field:-moz-placeholder           {color:{$colors['text_dark']}; opacity: 1;}/* Firefox 18- */
.search_style_fullscreen .search_field:-ms-input-placeholder      {color:{$colors['text_dark']}; opacity: 1;}

.search_style_fullscreen.search_opened .search_field::-webkit-input-placeholder {color:{$colors['text_light']}; opacity: 1;}
.search_style_fullscreen.search_opened .search_field::-moz-placeholder          {color:{$colors['text_light']}; opacity: 1;}/* Firefox 19+ */
.search_style_fullscreen.search_opened .search_field:-moz-placeholder           {color:{$colors['text_light']}; opacity: 1;}/* Firefox 18- */
.search_style_fullscreen.search_opened .search_field:-ms-input-placeholder      {color:{$colors['text_light']}; opacity: 1;}

.search_wrap.search_style_fullscreen.layouts_search:not(.search_opened) .search_submit:before {
	color: {$colors['text_dark']};
}


/* Search results */
.search_wrap .search_results {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_wrap .search_results:after {
	background-color: {$colors['bg_color']};
	border-left-color: {$colors['bd_color']};
	border-top-color: {$colors['bd_color']};
}
.search_wrap .search_results .search_results_close {
	color: {$colors['text_light']};
}
.search_wrap .search_results .search_results_close:hover {
	color: {$colors['text_dark']};
}
.search_results.widget_area .post_item + .post_item {
	border-top-color: {$colors['bd_color']};
}


/* Page title and breadcrumbs */
.sc_layouts_title .sc_layouts_title_meta,
.sc_layouts_title .sc_layouts_title_breadcrumbs,
.sc_layouts_title .sc_layouts_title_breadcrumbs a,
.sc_layouts_title .sc_layouts_title_description,
.sc_layouts_title .post_meta,
.sc_layouts_title .post_meta_item,
.sc_layouts_title .post_meta .vc_inline-link,
.sc_layouts_title .post_meta_item a,
.sc_layouts_title .post_meta_item:after,
.sc_layouts_title .post_meta_item:hover:after,
.sc_layouts_title .post_meta_item.post_meta_edit:after,
.sc_layouts_title .post_meta_item.post_meta_edit:hover:after,
.sc_layouts_title .post_meta_item.post_categories,
.sc_layouts_title .post_meta_item.post_categories a,
.sc_layouts_title .post_info .post_info_item,
.sc_layouts_title .post_info .post_info_item a,
.sc_layouts_title .post_info_counters .post_meta_item {
	color: {$colors['text_dark']} !important;
}
.sc_layouts_title .post_meta_item a:hover,
.sc_layouts_title .sc_layouts_title_breadcrumbs a:hover,
.sc_layouts_title .post_meta .vc_inline-link:hover,
.sc_layouts_title a.post_meta_item:hover,
.sc_layouts_title .post_meta_item.post_categories a:hover,
.sc_layouts_title .post_info .post_info_item a:hover,
.sc_layouts_title .post_info_counters .post_meta_item:hover {
	color: {$colors['text_hover']} !important;
}


/* Menu */
.sc_layouts_menu_nav > li > a {
	color: {$colors['text_dark']};
}
.sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['text_hover']} !important;
}
.sc_layouts_menu_nav > li.current-menu-item > a,
.sc_layouts_menu_nav > li.current-menu-parent > a,
.sc_layouts_menu_nav > li.current-menu-ancestor > a {
	color: {$colors['text_hover']} !important;
}
.sc_layouts_menu_nav .menu-collapse > a:before {
	color: {$colors['alter_text']};
}
.sc_layouts_menu_nav .menu-collapse > a:after {
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:before {
	color: {$colors['alter_link']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:after {
	background-color: {$colors['alter_bg_hover']};
}
.menu_hover_path_line .sc_layouts_menu_nav > li > a:hover,
.menu_hover_path_line .sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['text_dark']} !important;
}
.menu_hover_path_line .sc_layouts_menu_nav > li.current-menu-item > a,
.menu_hover_path_line .sc_layouts_menu_nav > li.current-menu-parent > a,
.menu_hover_path_line .sc_layouts_menu_nav > li.current-menu-ancestor > a {
	color: {$colors['text_dark']} !important;
}

/* Submenu */
.sc_layouts_menu_popup .sc_layouts_menu_nav,
.sc_layouts_menu_nav > li ul {
	background-color: {$colors['text_link']};
}
.widget_nav_menu li.menu-delimiter,
.sc_layouts_menu_nav > li li.menu-delimiter {
	border-color: {$colors['extra_bd_color']};
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li li > a {
	color: {$colors['inverse_link']} !important;
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li.sfHover > a,
.sc_layouts_menu_nav > li li > a:hover,
.sc_layouts_menu_nav > li li.sfHover > a {
	color: {$colors['inverse_hover']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav > li li > a:hover:after {
	color: {$colors['inverse_hover']} !important;
}
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children > a:hover,
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children.sfHover > a {
	color: {$colors['inverse_hover']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav > li li[class*="icon-"]:before {
	color: {$colors['inverse_hover']};
}
.sc_layouts_menu_nav > li li[class*="icon-"]:hover:before,
.sc_layouts_menu_nav > li li[class*="icon-"].shHover:before {
	color: {$colors['inverse_hover']};
}
.sc_layouts_menu_nav > li li.current-menu-item > a,
.sc_layouts_menu_nav > li li.current-menu-parent > a,
.sc_layouts_menu_nav > li li.current-menu-ancestor > a {
	color: {$colors['inverse_hover']} !important;
}
.sc_layouts_menu_nav > li li.current-menu-item:before,
.sc_layouts_menu_nav > li li.current-menu-parent:before,
.sc_layouts_menu_nav > li li.current-menu-ancestor:before {
	color: {$colors['inverse_hover']} !important;
}

/* Description in the menu */
.sc_layouts_menu_item_description {
	color: {$colors['extra_light']};
}
.menu_main_nav > li ul [class*="current-menu-"] > a .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li ul li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.menu_main_nav > li ul a:hover .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li ul a:hover .sc_layouts_menu_item_description {
	color: {$colors['text_light']};
}
.menu_main_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.menu_main_nav > li > a:hover .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li > a:hover .sc_layouts_menu_item_description {
	color: {$colors['text']};
}

/* Layouts as submenu */
.sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row,
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row,
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item,
.sc_layouts_menu li > ul.sc_layouts_submenu .post_item,
.sc_layouts_menu li > ul.sc_layouts_submenu .amount,
.sc_layouts_menu li > ul.sc_layouts_submenu li {
	color: {$colors['extra_text']};
}

.sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row a:not(.sc_button):not(.button),
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button),
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['extra_dark']};
}
.sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row a:not(.sc_button):not(.button):hover,
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button):hover,
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row a:hover .sc_layouts_item_icon,
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:hover .sc_layouts_item_icon,
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['extra_link']};
}
ul.sc_layouts_submenu h1,
ul.sc_layouts_submenu h2,
ul.sc_layouts_submenu h3,
ul.sc_layouts_submenu h4,
ul.sc_layouts_submenu h5,
ul.sc_layouts_submenu h6,
ul.sc_layouts_submenu h1 a,
ul.sc_layouts_submenu h2 a,
ul.sc_layouts_submenu h3 a,
ul.sc_layouts_submenu h4 a,
ul.sc_layouts_submenu h5 a,
ul.sc_layouts_submenu h6 a,
ul.sc_layouts_submenu [class*="color_style_"] h1 a,
ul.sc_layouts_submenu [class*="color_style_"] h2 a,
ul.sc_layouts_submenu [class*="color_style_"] h3 a,
ul.sc_layouts_submenu [class*="color_style_"] h4 a,
ul.sc_layouts_submenu [class*="color_style_"] h5 a,
ul.sc_layouts_submenu [class*="color_style_"] h6 a {
	color: {$colors['extra_dark']};
}
ul.sc_layouts_submenu h1 a:hover,
ul.sc_layouts_submenu h2 a:hover,
ul.sc_layouts_submenu h3 a:hover,
ul.sc_layouts_submenu h4 a:hover,
ul.sc_layouts_submenu h5 a:hover,
ul.sc_layouts_submenu h6 a:hover {
	color: {$colors['extra_link']};
}
ul.sc_layouts_submenu .color_style_link2 h1 a:hover,
ul.sc_layouts_submenu .color_style_link2 h2 a:hover,
ul.sc_layouts_submenu .color_style_link2 h3 a:hover,
ul.sc_layouts_submenu .color_style_link2 h4 a:hover,
ul.sc_layouts_submenu .color_style_link2 h5 a:hover,
ul.sc_layouts_submenu .color_style_link2 h6 a:hover {
	color: {$colors['extra_link2']};
}
ul.sc_layouts_submenu .color_style_link3 h1 a:hover,
ul.sc_layouts_submenu .color_style_link3 h2 a:hover,
ul.sc_layouts_submenu .color_style_link3 h3 a:hover,
ul.sc_layouts_submenu .color_style_link3 h4 a:hover,
ul.sc_layouts_submenu .color_style_link3 h5 a:hover,
ul.sc_layouts_submenu .color_style_link3 h6 a:hover {
	color: {$colors['extra_link3']};
}
ul.sc_layouts_submenu .color_style_dark h1 a:hover,
ul.sc_layouts_submenu .color_style_dark h2 a:hover,
ul.sc_layouts_submenu .color_style_dark h3 a:hover,
ul.sc_layouts_submenu .color_style_dark h4 a:hover,
ul.sc_layouts_submenu .color_style_dark h5 a:hover,
ul.sc_layouts_submenu .color_style_dark h6 a:hover {
	color: {$colors['extra_link']};
}

ul.sc_layouts_submenu dt,
ul.sc_layouts_submenu b,
ul.sc_layouts_submenu strong,
ul.sc_layouts_submenu i,
ul.sc_layouts_submenu em,
ul.sc_layouts_submenu mark,
ul.sc_layouts_submenu ins {	
	color: {$colors['extra_dark']};
}
ul.sc_layouts_submenu s,
ul.sc_layouts_submenu strike,
ul.sc_layouts_submenu del,
ul.sc_layouts_submenu .post_meta{	
	color: {$colors['extra_light']};
}

ul.sc_layouts_submenu .sc_recent_news_header {
	border-color: {$colors['extra_bd_color']};
}

/* Layouts submenu in the Custom Menu */
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .post_item{
	color: {$colors['text']};
}

.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row a:not(.sc_button):not(.button),
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button),
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['text_link']};
}
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row a:not(.sc_button):not(.button):hover,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .elementor-row a:hover .sc_layouts_item_icon,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button):hover,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:hover .sc_layouts_item_icon,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button):hover,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_hover']};
}
.widget_nav_menu ul.sc_layouts_submenu h1,
.widget_nav_menu ul.sc_layouts_submenu h2,
.widget_nav_menu ul.sc_layouts_submenu h3,
.widget_nav_menu ul.sc_layouts_submenu h4,
.widget_nav_menu ul.sc_layouts_submenu h5,
.widget_nav_menu ul.sc_layouts_submenu h6,
.widget_nav_menu ul.sc_layouts_submenu h1 a,
.widget_nav_menu ul.sc_layouts_submenu h2 a,
.widget_nav_menu ul.sc_layouts_submenu h3 a,
.widget_nav_menu ul.sc_layouts_submenu h4 a,
.widget_nav_menu ul.sc_layouts_submenu h5 a,
.widget_nav_menu ul.sc_layouts_submenu h6 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h1 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h2 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h3 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h4 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h5 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h6 a {
	color: {$colors['text_dark']};
}
.widget_nav_menu ul.sc_layouts_submenu h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h6 a:hover {
	color: {$colors['text_link']};
}
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h6 a:hover {
	color: {$colors['text_link2']};
}
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h6 a:hover {
	color: {$colors['text_link3']};
}
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h6 a:hover {
	color: {$colors['text_link']};
}

.widget_nav_menu ul.sc_layouts_submenu dt,
.widget_nav_menu ul.sc_layouts_submenu b,
.widget_nav_menu ul.sc_layouts_submenu strong,
.widget_nav_menu ul.sc_layouts_submenu i,
.widget_nav_menu ul.sc_layouts_submenu em,
.widget_nav_menu ul.sc_layouts_submenu mark,
.widget_nav_menu ul.sc_layouts_submenu ins {	
	color: {$colors['text_dark']};
}
.widget_nav_menu ul.sc_layouts_submenu s,
.widget_nav_menu ul.sc_layouts_submenu strike,
.widget_nav_menu ul.sc_layouts_submenu del,
.widget_nav_menu ul.sc_layouts_submenu .post_meta{	
	color: {$colors['text_light']};
}

.widget_nav_menu ul.sc_layouts_submenu .sc_recent_news_header {
	border-color: {$colors['bd_color']};
}


/* Side menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_hover']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.menu_side_inner .sc_layouts_logo {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.menu_side_icons .sc_layouts_logo {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}

.scheme_self.menu_side_icons .toc_menu_item .toc_menu_icon,
.menu_side_inner > .toc_menu_item .toc_menu_icon {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
.scheme_self.menu_side_icons .toc_menu_item:hover .toc_menu_icon,
.scheme_self.menu_side_icons .toc_menu_item_active .toc_menu_icon,
.menu_side_inner > .toc_menu_item:hover .toc_menu_icon,
.menu_side_inner > .toc_menu_item_active .toc_menu_icon {
	background-color: {$colors['inverse_link']};
	color: {$colors['text_link']};
}
.scheme_self.menu_side_icons .toc_menu_icon_default:before,
.menu_side_inner > .toc_menu_icon_default:before {
	background-color: {$colors['text_link']};
}
.scheme_self.menu_side_icons .toc_menu_item:hover .toc_menu_icon_default:before,
.scheme_self.menu_side_icons .toc_menu_item_active .toc_menu_icon_default:before,
.menu_side_inner > .toc_menu_item:hover .toc_menu_icon_default:before,
.menu_side_inner > .toc_menu_item_active .toc_menu_icon_default:before {
	background-color: {$colors['text_dark']};
}
.scheme_self.menu_side_icons .toc_menu_item .toc_menu_description,
.menu_side_inner > .toc_menu_item .toc_menu_description {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

.scheme_self.menu_side_dots #toc_menu .toc_menu_item .toc_menu_icon {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.scheme_self.menu_side_dots #toc_menu .toc_menu_item:hover .toc_menu_icon,
.scheme_self.menu_side_dots #toc_menu .toc_menu_item_active .toc_menu_icon {
	color: {$colors['alter_link']};
}
.scheme_self.menu_side_dots #toc_menu .toc_menu_item .toc_menu_icon:before {
	background-color: {$colors['alter_link']};
}
.scheme_self.menu_side_dots #toc_menu .toc_menu_item:hover .toc_menu_icon:before {
	background-color: {$colors['alter_hover']};
}

/* Mobile menu */
.menu_mobile_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_dark']};
}
.menu_mobile_button:hover {
	color: {$colors['text_link']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_dark']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['alter_link']};
}
.menu_mobile .menu_mobile_nav_area > ul > li li.menu-delimiter > a {
	border-color: {$colors['alter_bd_color']};
}
.menu_mobile_inner a,
.menu_mobile_inner .menu_mobile_nav_area li:before {
	color: {$colors['alter_dark']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a,
.menu_mobile_inner .menu_mobile_nav_area li:hover:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-ancestor:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-item:before {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['input_dark']};
}

.menu_mobile_inner .social_item .social_icon {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}


/* Menu hovers */

/* fade box */
.menu_hover_fade_box .sc_layouts_menu_nav > a:hover,
.menu_hover_fade_box .sc_layouts_menu_nav > li > a:hover,
.menu_hover_fade_box .sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['alter_link']};
	background-color: {$colors['alter_bg_color']};
}

/* slide_line */
.menu_hover_slide_line .sc_layouts_menu_nav > li#blob {
	background-color: {$colors['text_link']};
}

/* slide_box */
.menu_hover_slide_box .sc_layouts_menu_nav > li#blob {
	background-color: {$colors['alter_bg_color']};
}

/* zoom_line */
.menu_hover_zoom_line .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* path_line */
.menu_hover_path_line .sc_layouts_menu_nav > li:before,
.menu_hover_path_line .sc_layouts_menu_nav > li:after,
.menu_hover_path_line .sc_layouts_menu_nav > li > a:before,
.menu_hover_path_line .sc_layouts_menu_nav > li > a:after {
	background-color: {$colors['text_hover']};
}

/* roll_down */
.menu_hover_roll_down .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* color_line */
.menu_hover_color_line .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_dark']};
}
.menu_hover_color_line .sc_layouts_menu_nav > li > a:after,
.menu_hover_color_line .sc_layouts_menu_nav > li.menu-item-has-children > a:after {
	background-color: {$colors['text_link']};
}
.menu_hover_color_line .sc_layouts_menu_nav > li.sfHover > a,
.menu_hover_color_line .sc_layouts_menu_nav > li > a:hover,
.menu_hover_color_line .sc_layouts_menu_nav > li > a:focus {
	color: {$colors['text_link']};
}


/* VC Separator */
.scheme_self.sc_layouts_row .vc_separator.vc_sep_color_grey .vc_sep_line,
.sc_layouts_row .vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['alter_bd_color']};
}

/* Cart */
.sc_layouts_cart_items_short {
	background-color: {$colors['text_dark']};
	color: {$colors['bg_color']};
}
.sc_layouts_cart_widget {
	border-color: {$colors['bd_color']};
	background-color: {$colors['bg_color']};
	color: {$colors['text']};
}
.sc_layouts_cart_widget:after {
	border-color: {$colors['bd_color']};
	background-color: {$colors['bg_color']};
}
.sc_layouts_cart_widget .sc_layouts_cart_widget_close {
	color: {$colors['text_light']};
}
.sc_layouts_cart_widget .sc_layouts_cart_widget_close:hover {
	color: {$colors['text_dark']};
}

/* Currency Switcher */
.sc_layouts_currency .woocommerce-currency-switcher-form .wSelect-selected {
	color: {$colors['alter_text']};
}
.sc_layouts_currency .woocommerce-currency-switcher-form .wSelect-selected:hover {
	color: {$colors['alter_dark']};
}
.sc_layouts_currency .chosen-container .chosen-results,
.sc_layouts_currency .woocommerce-currency-switcher-form .wSelect-options-holder,
.sc_layouts_currency .woocommerce-currency-switcher-form .dd-options,
.sc_layouts_currency .woocommerce-currency-switcher-form .dd-option {
	background: {$colors['alter_bg_color']};
	color: {$colors['alter_dark']};
}
.sc_layouts_currency .chosen-container .chosen-results li,
.sc_layouts_currency .woocommerce-currency-switcher-form .wSelect-option {
	color: {$colors['alter_dark']};
}
.sc_layouts_currency .chosen-container .active-result.highlighted,
.sc_layouts_currency .chosen-container .active-result.result-selected,
.sc_layouts_currency .woocommerce-currency-switcher-form .wSelect-option:hover,
.sc_layouts_currency .woocommerce-currency-switcher-form .wSelect-options-holder .wSelect-option-selected,
.sc_layouts_currency .woocommerce-currency-switcher-form .dd-option:hover,
.sc_layouts_currency .woocommerce-currency-switcher-form .dd-option-selected {
	color: {$colors['alter_link']} !important;
}
.sc_layouts_currency .woocommerce-currency-switcher-form .dd-option-description {
	color: {$colors['alter_text']};
}
	

/* Page 
-------------------------------------------- */
#page_preloader,
.page_content_wrap,
.custom-background .content_wrap > .content,
.page_banner_wrap ~ .content_wrap > .content {
	background-color: {$colors['bg_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

/* Header */
.top_panel,
.scheme_self.top_panel {
	background-color: {$colors['bg_color']};
}
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['bg_color_07']};
}
.scheme_self.top_panel .slider_engine_revo .slide_subtitle,
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}
.top_panel_default .top_panel_navi,
.scheme_self.top_panel_default .top_panel_navi {
	background-color: {$colors['bg_color']};
}
.top_panel_default .top_panel_title,
.scheme_self.top_panel_default .top_panel_title {
	background-color: {$colors['alter_bg_color']};
}

.post_header_position_above .top_panel {
	border-color: {$colors['bd_color']};
}
.post_header_position_on_thumb .header_content_wrap.header_align_bb .post_header {
	border-color: {$colors['bd_color']};
}

/* Tabs */
div.esg-filter-wrapper .esg-filterbutton > span,
.mptt-navigation-tabs li a,
.heaven11_tabs .heaven11_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
div.esg-filter-wrapper .esg-filterbutton > span:hover,
.mptt-navigation-tabs li a:hover,
.heaven11_tabs .heaven11_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
div.esg-filter-wrapper .esg-filterbutton.selected > span,
.mptt-navigation-tabs li.active a,
.heaven11_tabs .heaven11_tabs_titles li.ui-state-active a {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

.sheme_self.sidebar div.esg-filter-wrapper .esg-filterbutton > span,
.sheme_self.sidebar .mptt-navigation-tabs li a,
.sheme_self.sidebar .heaven11_tabs .heaven11_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_hover']};
}
.sheme_self.sidebar div.esg-filter-wrapper .esg-filterbutton > span:hover,
.sheme_self.sidebar .mptt-navigation-tabs li a:hover,
.sheme_self.sidebar .heaven11_tabs .heaven11_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.sheme_self.sidebar div.esg-filter-wrapper .esg-filterbutton.selected > span,
.sheme_self.sidebar .mptt-navigation-tabs li.active a,
.sheme_self.sidebar .heaven11_tabs .heaven11_tabs_titles li.ui-state-active a {
	color: {$colors['alter_bg_color']};
	background-color: {$colors['alter_dark']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
}
.post_meta,
.post_meta_item,
.post_meta_item:after,
.post_meta_item:hover:after,
.post_meta .vc_inline-link,
.post_meta .vc_inline-link:after,
.post_meta .vc_inline-link:hover:after,
.post_meta_item a,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_meta_item {
	color: {$colors['text_hover']};
}
.post_date a:hover,
a.post_meta_item:hover,
.post_meta_item a:hover,
.post_meta .vc_inline-link:hover,
.post_info .post_info_item a:hover,
.post_info_meta .post_meta_item:hover {
	color: {$colors['text_link']};
}
.post_item .post_title a:hover,
.post_item .post_title a:hover em,
.post_item .post_title a:hover b {
	color: {$colors['text_link']};
}

.post_meta_item.post_categories,
.post_meta_item.post_categories a {
	color: {$colors['text_hover']};
}
.post_meta_item.post_categories a:hover {
	color: {$colors['text_link']};
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}

.post_layout_excerpt:not(.sticky) + .post_layout_excerpt:not(.sticky) {
	border-color: {$colors['bd_color']};
}
.post_layout_classic {
	border-color: {$colors['bd_color']};
}

.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}


/* Post Formats
------------------------------------------ */

/* Audio with cover image */
.trx_addons_audio_player.with_cover .audio_author,
.format-audio .post_featured.with_thumb .post_audio_author {
	color: {$colors['text_hover']};
}

.mejs-container .mejs-controls,
.wp-playlist .mejs-container .mejs-controls {
	background: {$colors['extra_hover3']};
}
.trx_addons_audio_player.without_cover .mejs-controls,
.format-audio .post_featured.without_thumb .mejs-controls {
	background: {$colors['extra_hover3']};
}

.mejs-controls .mejs-button > button {
	color: {$colors['extra_hover']};
	background: {$colors['inverse_link']} !important;
}
.mejs-controls .mejs-button > button:hover,
.mejs-controls .mejs-button > button:focus {
	color: {$colors['extra_link']};
	background: {$colors['inverse_link']} !important;
}

.mejs-controls .mejs-time-rail .mejs-time-total,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
.mejs-controls .mejs-time-rail .mejs-time-hovered,
.mejs-controls .mejs-volume-slider .mejs-volume-total,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	background: {$colors['inverse_link']};
}
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-volume-slider .mejs-volume-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	background: {$colors['text_link_07']};
}
.mejs-controls .mejs-time-rail .mejs-time-handle-content {
	border-color: {$colors['extra_link']};
}
.mejs-controls .mejs-volume-slider .mejs-volume-handle,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-handle {
	background: {$colors['extra_link']};
}

/* Audio without cover image */
.trx_addons_audio_player.without_cover,
.format-audio .post_featured.without_thumb .post_audio {
	border-color: {$colors['extra_hover3']};
	background-color: {$colors['extra_hover3']};
}
.trx_addons_audio_player.without_cover .audio_author,
.format-audio .post_featured.without_thumb .post_audio_author {
	color: {$colors['text_link']};
}
.trx_addons_audio_player.without_cover .audio_caption,
.format-audio .post_featured.without_thumb .post_audio_title {
	color: {$colors['alter_dark']};
}
.trx_addons_audio_player.without_cover .audio_description,
.format-audio .post_featured.without_thumb .post_audio_description {
	color: {$colors['alter_text']};
}

/* WordPress Playlist */
.wp-playlist-light {
	background: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text']};
}
.wp-playlist-light .wp-playlist-caption {
	color: {$colors['text_dark']};
}
.wp-playlist-light .wp-playlist-playing {
	background: {$colors['alter_bg_color']};
	color: {$colors['alter_dark']};
}
.wp-playlist-item {
	border-color: {$colors['bd_color']};
}



/* Aside */
.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

/* Link and Status */
.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

/* Chat */
.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}

/* Video */
.trx_addons_video_player.with_cover .video_hover,
.format-video .post_featured.with_thumb .post_video_hover {
	color: {$colors['alter_dark']};
	background-color: {$colors['bg_color']};
}
.trx_addons_video_player.with_cover .video_hover:hover,
.format-video .post_featured.with_thumb .post_video_hover:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.scheme_self.sidebar .trx_addons_video_player.with_cover .video_hover {
	color: {$colors['alter_dark']};
	background-color: {$colors['bg_color']};
}
.scheme_self.sidebar .trx_addons_video_player.with_cover .video_hover:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_hover']};
}

/* Chess */
.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old {
	color: {$colors['text_dark']};
}
.nav-links-old a:hover {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}

.esg-filters div.esg-navigationbutton,
.woocommerce nav.woocommerce-pagination ul li a,
.page_links > a,
.comments_pagination .page-numbers,
.nav-links .page-numbers {
	color: {$colors['text_dark']};
	border-color: transparent;
	background-color: transparent;
}
.esg-filters div.esg-navigationbutton:hover,
.esg-filters div.esg-navigationbutton.selected,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current,
.page_links > a:hover,
.page_links > span:not(.page_links_title),
.comments_pagination a.page-numbers:hover,
.comments_pagination .page-numbers.current,
.nav-links a.page-numbers:hover,
.nav-links .page-numbers.current {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background-color: transparent;
}
.nav-links:before {
    border-color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_hover']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_hover']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta .vc_inline-link,

.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item .socials_caption {
	color: {$colors['text_hover']};
}
.post_item_single a.post_meta_item:hover,
.post_item_single .post_header .post_meta .vc_inline-link:hover,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_link']};
}
.post_item_single .post_content .post_tags,
.post_item_single .post_content .post_tags a {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_tags a:hover {
	color: {$colors['text_link']};
}
.post_item_single .post_content .post_meta .post_share .socials_type_block .social_item .social_icon {
	color: {$colors['text_dark']} !important;
	border-color: {$colors['text_dark']};
	background-color: transparent;
}
.post_item_single .post_content .post_meta .post_share .socials_type_block .social_item:hover .social_icon {
	color: {$colors['text_link']} !important;
	border-color: {$colors['text_link']};
	background-color: transparent;
}
.socials_share .socials_caption,
.post_tags .post_meta_label {
    color: {$colors['text_dark']} !important;
}

.post-password-form input[type="submit"] {
	border-color: {$colors['text_dark']};
}
.post-password-form input[type="submit"]:hover,
.post-password-form input[type="submit"]:focus {
	color: {$colors['bg_color']};
}

/* Single post navi */
.nav-links-single .nav-links {
	border-color: {$colors['bd_color']};
}
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_link']};
}

.nav-links-single.nav-links-fixed .nav-links .nav-previous,
.nav-links-single.nav-links-fixed .nav-links .nav-next {
	border-color: {$colors['bd_color']};
	background-color: {$colors['bg_color']};
}


/* Author info */
.scheme_self .author_info {
	color: {$colors['text']};
	background-color: {$colors['input_bg_color']};
}
.scheme_self .author_info .author_title {
	color: {$colors['text_dark']};
}
.scheme_self .author_info a {
	color: {$colors['text_dark']};
}
.scheme_self .author_info a:hover {
	color: {$colors['text_link']};
}
.scheme_self .author_info .socials_wrap .social_item .social_icon {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background-color: transparent;
}
.scheme_self .author_info .socials_wrap .social_item:hover .social_icon {
	color: {$colors['text_link']};
	border-color: {$colors['text_link']};
	background-color: transparent;
}

/* Related posts */
.related_wrap {
	border-color: {$colors['bd_color']};
}
.related_wrap.related_style_modern .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap.related_style_modern:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap.related_style_modern .post_meta a {
	color: {$colors['text']};
}
.related_wrap.related_style_modern:hover .post_meta a {
	color: {$colors['text_light']};
}
.related_wrap.related_style_modern:hover .post_meta a:hover {
	color: {$colors['text_dark']};
}

/* Contact form */
.page_contact_form {
	border-color: {$colors['bd_color']};
}

/* Comments */
.comments_list_wrap,
.comments_list_wrap > ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap li + li,
.comments_list_wrap li ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .bypostauthor > .comment_body .comment_author_avatar:after {
	border-color: {$colors['text_link2']};
}
.comments_list_wrap .comment_info,
.comments_list_wrap .comment_info h6{
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['text_hover']};
}
.comments_form_wrap {
	border-color: {$colors['bd_color']};
}
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}


/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text_link']};
}
.post_item_404 .go_home {
	border-color: {$colors['text_dark']};
}



/* Sidebar
---------------------------------------------- */
.scheme_self.sidebar .sidebar_inner {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.sidebar_inner .widget + .widget,
.sidebar_right [class*="content_wrap"] > .sidebar,
.sidebar_left [class*="content_wrap"] > .sidebar {
	border-color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget + .widget {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.sidebar a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self.sidebar h1, .scheme_self.sidebar h2, .scheme_self.sidebar h3, .scheme_self.sidebar h4, .scheme_self.sidebar h5, .scheme_self.sidebar h6,
.scheme_self.sidebar h1 a, .scheme_self.sidebar h2 a, .scheme_self.sidebar h3 a, .scheme_self.sidebar h4 a, .scheme_self.sidebar h5 a, .scheme_self.sidebar h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar h1 a:hover, .scheme_self.sidebar h2 a:hover, .scheme_self.sidebar h3 a:hover, .scheme_self.sidebar h4 a:hover, .scheme_self.sidebar h5 a:hover, .scheme_self.sidebar h6 a:hover {
	color: {$colors['alter_link']};
}
.sidebar .widget {
	background-color: {$colors['extra_bd_hover']};
}
.sidebar .widget:nth-child(odd),
.sidebar .widget:nth-child(even) {
    border-color: {$colors['bg_color']};
}

.sidebar_control {
	color: {$colors['alter_dark']} !important;
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
.sidebar_control:hover {
	color: {$colors['alter_link']} !important;
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
}

/* Lists in widgets */
.widget ul > li:before {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar ul > li:before {
	background-color: {$colors['alter_link']};
}
.scheme_self.sidebar li > a,
.scheme_self.sidebar .post_title > a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar li > a:hover,
.scheme_self.sidebar .post_title > a:hover {
	color: {$colors['alter_link']};
}


/* Posts in widgets */
.scheme_self.sidebar .post_meta,
.scheme_self.sidebar .post_meta_item,
.scheme_self.sidebar .post_meta_item:after,
.scheme_self.sidebar .post_meta_item:hover:after,
.scheme_self.sidebar .post_meta .vc_inline-link,
.scheme_self.sidebar .post_meta .vc_inline-link:after,
.scheme_self.sidebar .post_meta .vc_inline-link:hover:after,
.scheme_self.sidebar .post_meta_item a,
.scheme_self.sidebar .post_info .post_info_item,
.scheme_self.sidebar .post_info .post_info_item a,
.scheme_self.sidebar .post_info_counters .post_meta_item {
	color: {$colors['alter_light']};
}
.scheme_self.sidebar .post_date a:hover,
.scheme_self.sidebar a.post_meta_item:hover,
.scheme_self.sidebar .post_meta_item a:hover,
.scheme_self.sidebar .post_meta .vc_inline-link:hover,
.scheme_self.sidebar .post_info .post_info_item a:hover,
.scheme_self.sidebar .post_info_counters .post_meta_item:hover {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar .post_item .post_title a:hover {
	color: {$colors['alter_link']};
}

.scheme_self.sidebar .post_meta_item.post_categories,
.scheme_self.sidebar .post_meta_item.post_categories a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar .post_meta_item.post_categories a:hover {
	color: {$colors['alter_hover']};
}

.scheme_self.sidebar .post_meta_item .socials_share .social_items {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.sidebar .post_meta_item .social_items,
.scheme_self.sidebar .post_meta_item .social_items:before {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_light']};
}

/* Archive */
.scheme_self.sidebar .widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.wp-block-calendar caption,
.wp-block-calendar tbody td a,
.widget_calendar caption,
.widget_calendar tbody td a {
	color: {$colors['text_dark']};
}
.wp-block-calendar th,
.widget_calendar th {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .wp-block-calendar caption,
.scheme_self.sidebar .wp-block-calendar tbody td a,
.scheme_self.sidebar .wp-block-calendar th,
.scheme_self.sidebar .widget_calendar caption,
.scheme_self.sidebar .widget_calendar tbody td a,
.scheme_self.sidebar .widget_calendar th {
	color: {$colors['alter_dark']};
}
.wp-block-calendar tbody td,
.widget_calendar tbody td {
	color: {$colors['text']} !important;
}
.scheme_self.sidebar .wp-block-calendar tbody td,
.scheme_self.sidebar .widget_calendar tbody td {
	color: {$colors['alter_text']} !important;
}
.wp-block-calendar tbody td a:hover,
.widget_calendar tbody td a:hover {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .wp-block-calendar tbody td a:hover,
.scheme_self.sidebar .widget_calendar tbody td a:hover {
	color: {$colors['alter_link']};
}
.wp-block-calendar tbody td a:after,
.widget_calendar tbody td a:after {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .wp-block-calendar tbody td a:after,
.scheme_self.sidebar .widget_calendar tbody td a:after {
	background-color: {$colors['alter_link']};
}
.wp-block-calendar td#today,
.widget_calendar td#today {
	color: {$colors['inverse_link']} !important;
}
.wp-block-calendar td#today a,
.widget_calendar td#today a {
	color: {$colors['inverse_link']};
}
.wp-block-calendar td#today a:hover,
.widget_calendar td#today a:hover {
	color: {$colors['inverse_hover']};
}
.wp-block-calendar td#today:before,
.widget_calendar td#today:before {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .wp-block-calendar td#today:before,
.scheme_self.sidebar .widget_calendar td#today:before {
	background-color: {$colors['alter_link']};
}
.wp-block-calendar td#today a:after,
.widget_calendar td#today a:after {
	background-color: {$colors['inverse_link']};
}
.wp-block-calendar td#today a:hover:after,
.widget_calendar td#today a:hover:after {
	background-color: {$colors['inverse_hover']};
}
.widget_calendar td#prev a,
.widget_calendar td#next a,
.wp-calendar-nav a,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-prev a,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-next a,
.wp-block-calendar .wp-calendar-nav .wp-calendar-nav-prev a,
.wp-block-calendar .wp-calendar-nav .wp-calendar-nav-next a {
	color: transparent;
}
.scheme_self.sidebar .wp-calendar-nav a,
.scheme_self.sidebar .widget_calendar #prev a,
.scheme_self.sidebar .widget_calendar #next a {
	color: {$colors['alter_link']};
}
.widget_calendar td#prev a:hover,
.widget_calendar td#next a:hover,
.wp-calendar-nav a:hover,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-prev a:hover,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-next a:hover,
.wp-block-calendar .wp-calendar-nav .wp-calendar-nav-prev a:hover,
.wp-block-calendar .wp-calendar-nav .wp-calendar-nav-next a:hover {
	color: transparent;
}
.scheme_self.sidebar .wp-calendar-nav a:hover,
.scheme_self.sidebar .widget_calendar #prev a:hover,
.scheme_self.sidebar .widget_calendar #next a:hover {
	color: {$colors['alter_hover']};
}
.wp-calendar-nav a:before,
.widget_calendar td#prev a:before,
.widget_calendar td#next a:before {
	background-color: {$colors['inverse_link']} !important;
}
.scheme_self .sidebar .wp-calendar-nav a:before,
.scheme_self .sidebar .widget_calendar td#prev a:before,
.scheme_self .sidebar .wp-block-calendar td#prev a:before,
.scheme_self .sidebar .widget_calendar .wp-calendar-nav .wp-calendar-nav-prev a:before,
.scheme_self .sidebar .widget_calendar td#next a:before,
.scheme_self .sidebar .wp-block-calendar td#next a:before,
.scheme_self .sidebar .widget_calendar .wp-calendar-nav .wp-calendar-nav-next a:before,
.scheme_self .sidebar .wp-block-calendar .wp-calendar-nav .wp-calendar-nav-next a:before {
	background-color: {$colors['extra_bd_hover']} !important;
}

.wp-calendar-nav a:before,
.widget_calendar td#prev a:before,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-prev a:before,
.widget_calendar td#next a:before,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-next a:before {
	color: {$colors['text_dark']} !important;
	border-color: {$colors['text_dark']} !important;
}

.wp-calendar-nav a:hover:before,
.widget_calendar td#prev a:hover:before,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-prev a:hover:before,
.widget_calendar td#next a:hover:before,
.widget_calendar .wp-calendar-nav .wp-calendar-nav-next a:hover:before,
.scheme_self .sidebar .wp-calendar-nav a:hover:before,
.scheme_self .sidebar .widget_calendar td#prev a:hover:before,
.scheme_self .sidebar .wp-block-calendar td#prev a:hover:before,
.scheme_self .sidebar .widget_calendar .wp-calendar-nav .wp-calendar-nav-prev a:hover:before,
.scheme_self .sidebar .wp-block-calendar .wp-calendar-nav .wp-calendar-nav-prev a:hover:before,
.scheme_self .sidebar .widget_calendar td#next a:hover:before,
.scheme_self .sidebar .wp-block-calendar td#next a:hover:before,
.scheme_self .sidebar .widget_calendar .wp-calendar-nav .wp-calendar-nav-next a:hover:before,
.scheme_self .sidebar .wp-block-calendar .wp-calendar-nav .wp-calendar-nav-next a:hover:before {
	color: {$colors['text_hover']} !important;
	border-color: {$colors['text_hover']} !important;
}


.widget_calendar td#today:before, 
.wp-block-calendar td#today:before {
	background-color: {$colors['text_link']} !important;
}

/* Categories */
.widget_categories li {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_categories li {
	color: {$colors['alter_dark']};
}

/* Recent posts */
.widget_recent_entries .post-date {
	color: {$colors['text_light']};
}
.scheme_self.widget_recent_entries .post-date {
	color: {$colors['alter_light']};
}

.recentcomments,
.recentcomments .comment-author-link a {
	color: {$colors['text_link']};
}
.recentcomments .comment-author-link a:hover {
	color: {$colors['text_hover']};
}

/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child:hover {
	color: {$colors['alter_hover']};
}
.widget_rss .rss-date {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Tag cloud */
.sc_edd_details .downloads_page_tags .downloads_page_data > a,
.widget_product_tag_cloud a,
.widget_tag_cloud a,
.post_item_single .post_content .post_tags a,
.wp-block-tag-cloud a {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.scheme_self .sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a,
.scheme_self .sidebar .widget_product_tag_cloud a,
.scheme_self .sidebar .widget_tag_cloud a {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background-color: {$colors['extra_bd_hover']};
}
.sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
.widget_product_tag_cloud a:hover,
.widget_tag_cloud a:hover,
.post_item_single .post_content .post_tags a:hover,
.wp-block-tag-cloud a:hover {
	color: {$colors['inverse_link']} !important;
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
.scheme_self.sidebar .widget_product_tag_cloud a:hover,
.scheme_self.sidebar .widget_tag_cloud a:hover {
	background-color: {$colors['alter_link']};
}

/*Categories List*/
.sidebar .widget.widget_categories_list {
    background-color: {$colors['text_hover']};
}
.sidebar .widget.widget_categories_list .widget_title,
.sidebar .widget_categories_list .categories_list_title {
    color: {$colors['inverse_link']} !important;
}
.sidebar .widget_categories_list .categories_list_item:hover .categories_list_title {
    color: {$colors['inverse_dark']} !important;
}



/* Footer
--------------------------------- */
.scheme_self.footer_wrap,
.footer_wrap .scheme_self.vc_row {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.scheme_self.footer_wrap .widget,
.scheme_self.footer_wrap .sc_content .wpb_column,
.footer_wrap .scheme_self.vc_row .widget,
.footer_wrap .scheme_self.vc_row .sc_content .wpb_column {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.footer_wrap h1, .scheme_self.footer_wrap h2, .scheme_self.footer_wrap h3,
.scheme_self.footer_wrap h4, .scheme_self.footer_wrap h5, .scheme_self.footer_wrap h6,
.scheme_self.footer_wrap h1 a, .scheme_self.footer_wrap h2 a, .scheme_self.footer_wrap h3 a,
.scheme_self.footer_wrap h4 a, .scheme_self.footer_wrap h5 a, .scheme_self.footer_wrap h6 a,
.footer_wrap .scheme_self.vc_row h1, .footer_wrap .scheme_self.vc_row h2, .footer_wrap .scheme_self.vc_row h3,
.footer_wrap .scheme_self.vc_row h4, .footer_wrap .scheme_self.vc_row h5, .footer_wrap .scheme_self.vc_row h6,
.footer_wrap .scheme_self.vc_row h1 a, .footer_wrap .scheme_self.vc_row h2 a, .footer_wrap .scheme_self.vc_row h3 a,
.footer_wrap .scheme_self.vc_row h4 a, .footer_wrap .scheme_self.vc_row h5 a, .footer_wrap .scheme_self.vc_row h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap h1 a:hover, .scheme_self.footer_wrap h2 a:hover, .scheme_self.footer_wrap h3 a:hover,
.scheme_self.footer_wrap h4 a:hover, .scheme_self.footer_wrap h5 a:hover, .scheme_self.footer_wrap h6 a:hover,
.footer_wrap .scheme_self.vc_row h1 a:hover, .footer_wrap .scheme_self.vc_row h2 a:hover, .footer_wrap .scheme_self.vc_row h3 a:hover,
.footer_wrap .scheme_self.vc_row h4 a:hover, .footer_wrap .scheme_self.vc_row h5 a:hover, .footer_wrap .scheme_self.vc_row h6 a:hover {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .widget li:before,
.footer_wrap .scheme_self.vc_row .widget li:before {
	background-color: {$colors['alter_link']};
}
.scheme_self.footer_wrap a,
.footer_wrap .scheme_self.vc_row a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap a:hover,
.footer_wrap .scheme_self.vc_row a:hover {
	color: {$colors['alter_link']};
}

.footer_wrap .widget_title:after,
.footer_wrap .widgettitle:after {
	background-color: {$colors['text_hover']};
}
.copyright,
.copyright a {
	color: {$colors['text_dark']};
}
.copyright a:hover {
	color: {$colors['text_hover']};
}
footer .socials_wrap .social_item .social_icon {

}

/* Posts in widgets */
.scheme_self.footer_wrap .post_meta,
.scheme_self.footer_wrap .post_meta_item,
.scheme_self.footer_wrap .post_meta_item:after,
.scheme_self.footer_wrap .post_meta_item:hover:after,
.scheme_self.footer_wrap .post_meta .vc_inline-link,
.scheme_self.footer_wrap .post_meta .vc_inline-link:after,
.scheme_self.footer_wrap .post_meta .vc_inline-link:hover:after,
.scheme_self.footer_wrap .post_meta_item a,
.scheme_self.footer_wrap .post_info .post_info_item,
.scheme_self.footer_wrap .post_info .post_info_item a,
.scheme_self.footer_wrap .post_info_counters .post_meta_item {
	color: {$colors['alter_light']};
}
.scheme_self.footer_wrap .post_date a:hover,
.scheme_self.footer_wrap a.post_meta_item:hover,
.scheme_self.footer_wrap .post_meta_item a:hover,
.scheme_self.footer_wrap .post_meta .vc_inline-link:hover,
.scheme_self.footer_wrap .post_info .post_info_item a:hover,
.scheme_self.footer_wrap .post_info_counters .post_meta_item:hover {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap .post_item .post_title a:hover {
	color: {$colors['alter_link']};
}

.scheme_self.footer_wrap .post_meta_item.post_categories,
.scheme_self.footer_wrap .post_meta_item.post_categories a {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .post_meta_item.post_categories a:hover {
	color: {$colors['alter_hover']};
}

.scheme_self.footer_wrap .post_meta_item .socials_share .social_items {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.footer_wrap .post_meta_item .social_items,
.scheme_self.footer_wrap .post_meta_item .social_items:before {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_light']};
}


.footer_logo_inner {
	border-color: {$colors['alter_bd_color']};
}
.footer_logo_inner:after {
	background-color: {$colors['alter_text']};
}
.footer_socials_inner .social_item .social_icon {
	color: {$colors['alter_text']};
}
.footer_socials_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}
.menu_footer_nav_area > ul > li ul,
.footer_wrap .sc_layouts_menu > ul > li ul {
	border-color: {$colors['extra_bd_color']};
}


.footer_copyright_inner {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_dark']};
}
.footer_copyright_inner a {
	color: {$colors['text_dark']};
}
.footer_copyright_inner a:hover {
	color: {$colors['text_link']};
}
.footer_copyright_inner .copyright_text {
	color: {$colors['text']};
}


/*Title*/
.sc_item_subtitle:before,
.sc_item_subtitle:after {
	background-color: {$colors['text_hover']};
}



/* Third-party plugins */

/*CF7*/
.wpcf7-form-control-wrap.wpgdprc {
    color: {$colors['inverse_light']};
}
.form_request input[type="text"],
.form_request input[type="email"],
.form_request input[type="tel"],
.form_request  textarea {
    border-color: {$colors['text_dark']};
}
.form_request input[type="text"]:hover,
.form_request input[type="email"]:hover,
.form_request input[type="tel"]:hover,
.form_request  textarea:hover {
    border-color: {$colors['input_bd_hover']};
}
.form_request input[type="text"]:focus,
.form_request input[type="email"]:focus,
.form_request input[type="tel"]:focus,
.form_request  textarea:focus {
    border-color: {$colors['input_bd_color']};
}
.wpgdprc-checkbox label input[type="checkbox"] {
    color: {$colors['text_dark']};
}
.ui-slider-access.ui-buttonset button.ui-button {
	background-color: {$colors['inverse_hover']};
}
.ui-slider-access.ui-buttonset button.ui-button:hover {
	background-color: {$colors['text_hover']};
}

/*Side menu*/
.toc_soc_title_before {
	background-color: {$colors['text_dark']};
}

/*Properties*/
.sc_properties_slider_columns .trx_addons_list_parameters > li > strong {
    color: {$colors['text_hover']};
}
.properties_search_form .properties_search_basic .sc_form_field_properties_keyword input,
.properties_search_vertical .properties_search_form .properties_search_basic .sc_form_field_properties_keyword input,
.properties_search .select_container select {
    border-color: {$colors['alter_dark']} !important;
}
.widget .properties_search  .select_container:after {
    color: {$colors['extra_link']};
}
.properties_search_form .properties_search_advanced .sc_form_field {
    color: {$colors['alter_text']};
}

.sc_properties_alter .sc_properties_item_option_data {
    color: {$colors['extra_link']};
}
.sc_properties_item_option .sc_properties_item_option_label_icon {
    color: {$colors['text_hover']};
    border-color: {$colors['text_hover']};
}
.properties_address a {
    color: {$colors['text_dark']};
}
.properties_address a:hover {
    color: {$colors['text_hover']};
}
.prop_add_info .sc_properties_item_type a {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}
.prop_add_info .sc_properties_item_type a:hover {
	color: {$colors['inverse_link']} !important;
	border-color: {$colors['text_link']};
	background-color: {$colors['text_link']};
}
.prop_single_info {
	background-color: {$colors['alter_bg_hover']};
}
a.agent_view_all {
    color: {$colors['text_dark']};
}
a.agent_view_all:hover {
    color: {$colors['text_hover']};
}



/*Slider Controls*/
span.slider_pagination_bullet.swiper-pagination-bullet,
span.swiper-pagination-bullet {
    color: {$colors['bg_color']} !important;
}
span.slider_pagination_bullet.swiper-pagination-bullet.slider_pagination_bullet_active,
span.slider_pagination_bullet.swiper-pagination-bullet:hover,
span.swiper-pagination-bullet.swiper-pagination-bullet-active,
span.swiper-pagination-bullet:hover {
    border-color: {$colors['bg_color']}  !important;
    color: {$colors['bg_color']} !important;
}
.slider_container.slider_pagination_pos_bottom .swiper-pagination-bullets,
.slider_outer.slider_outer_pagination_pos_bottom .swiper-pagination-bullets,
.slider_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullets  {
    background-color: {$colors['alter_dark']};
}
.slider_container.slider_pagination_pos_bottom .swiper-pagination-bullets:before,
.slider_outer.slider_outer_pagination_pos_bottom .swiper-pagination-bullets:before,
.slider_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullets:before,
.sc_slider_controls.slider_pagination_style_bullets.sc_align_right .slider_pagination_wrap:before {
    background-color: {$colors['bg_color']};
}
.slider_pagination_style_bullets.sc_slider_controls .slider_controls_wrap {
    background-color: {$colors['alter_dark']};
}

/*Slider controls Custom*/
.slider_container.slider_pagination_pos_bottom .swiper-pagination-custom,
.slider_outer.slider_outer_pagination_pos_bottom .swiper-pagination-custom,
.slider_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-custom {
    background-color: {$colors['extra_light']};
}

/* Lightboxes */
.mfp-bg,
.elementor-lightbox {
	background-color: {$colors['bg_color_07']};
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close,
.mfp-wrap .mfp-close {
	color: {$colors['text_link']};
	background-color: transparent;
}
.elementor-lightbox .dialog-lightbox-close-button,
.elementor-lightbox .elementor-swiper-button {
	color: {$colors['text_dark']};
	background-color: transparent;
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover,
.mfp-close-btn-in .mfp-close:hover {
	color: {$colors['text_hover']};
}
.elementor-lightbox .dialog-lightbox-close-button:hover,
.elementor-lightbox .elementor-swiper-button:hover {
	color: {$colors['text_link']};
}

/*Datepicker*/
.ui-datepicker .ui-datepicker-title,
.ui-timepicker-div dl dt,
.ui-timepicker-div,
.datepicker table tr td span.focused, .datepicker table tr td span:hover {
	color: {$colors['inverse_hover']};
}
.ui-datepicker div.ui-slider {
	background-color: {$colors['inverse_hover']};
}

/*Grid*/
.eg-washington2-wrapper .esg-cc a {
	background-color: {$colors['text_hover']} !important;
	color: {$colors['inverse_link']} !important;
}
.eg-washington2-wrapper .esg-cc a:hover {
	background-color: {$colors['text_link']} !important;
	color: {$colors['inverse_link']} !important;
}

/* Predefined classes for users
-------------------------------------------------------------- */
.accent1 {		color: {$colors['text_link']}; }
.accent2 {		color: {$colors['text_link2']}; }
.accent3 {		color: {$colors['text_link3']}; }
.accent1_bg {	background-color: {$colors['text_link']}; color: {$colors['inverse_text']}; }
.accent2_bg {	background-color: {$colors['text_link2']}; color: {$colors['inverse_text']}; }
.accent3_bg {	background-color: {$colors['text_link3']}; color: {$colors['inverse_text']}; }

.alter_bg {		background-color: {$colors['alter_bg_color']}; }
.alter_text {	color: {$colors['alter_text']}; }
.alter_link {	color: {$colors['alter_link']}; }
.alter_link2 {	color: {$colors['alter_link2']}; }
.alter_link3 {	color: {$colors['alter_link3']}; }

.extra_bg {		background-color: {$colors['extra_bg_color']}; }
.extra_text {	color: {$colors['extra_text']}; }
.extra_link {	color: {$colors['extra_link']}; }
.extra_link2 {	color: {$colors['extra_link2']}; }
.extra_link3 {	color: {$colors['extra_link3']}; }

CSS;

					$rez            = apply_filters(
						'heaven11_filter_get_css', $rez, array(
							'colors' => $colors,
							'scheme' => $s,
						)
					);
					$css['colors'] .= $rez['colors'];
				}
			}
		}

		$css_str = ( ! empty( $css['vars'] ) ? $css['vars'] : '' )
				. ( ! empty( $css['fonts'] ) ? $css['fonts'] : '' )
				. ( ! empty( $css['colors'] ) ? $css['colors'] : '' );

		return apply_filters( 'heaven11_filter_prepare_css', $css_str, $remove_spaces );
	}
}
