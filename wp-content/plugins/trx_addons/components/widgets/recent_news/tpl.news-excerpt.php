<?php
/**
 * The "News Excerpt" template to show post's content
 *
 * Used in the widget Recent News.
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */
 
$widget_args = get_query_var('trx_addons_args_recent_news');
$style = $widget_args['style'];
$number = $widget_args['number'];
$count = $widget_args['count'];
$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');

?><article 
	<?php post_class( 'post_item post_layout_'.esc_attr($style)
					.' post_format_'.esc_attr($post_format)
					); ?>
	<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
	
	trx_addons_get_template_part('templates/tpl.featured.php',
								'trx_addons_args_featured',
								apply_filters('trx_addons_filter_args_featured', array(
										'post_info' => '<div class="post_info"><span class="post_categories">'.trx_addons_get_post_categories().'</span></div>',
										'thumb_size' => trx_addons_get_thumb_size('medium')
										), 'recent_news-excerpt')
								);
	?>

	<div class="post_body">

		<?php
		if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
			?>
			<div class="post_header entry-header">
				<?php
				
				the_title( '<h4 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h4>' );
				
				if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
					?><div class="post_meta"><span class="post_author"><?php the_author_link(); ?></span><?php
					?><span class="post_date"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_date(); ?></a></span></div><?php
				}
				?>
			</div><!-- .entry-header -->
			<?php
		}
		?>
		
		<div class="post_content entry-content">
			<?php
			//echo wpautop(get_the_excerpt());
			if ( has_excerpt() ) {
				the_excerpt();
			} else {
				trx_addons_show_layout( trx_addons_strwords( trx_addons_filter_post_content( get_the_content() ), apply_filters( 'excerpt_length', 55 ) ) );
			}
			?>
		</div><!-- .entry-content -->
	
		<div class="post_footer entry-footer">
			<?php
			if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
				trx_addons_sc_show_post_meta('recent_news_excerpt', apply_filters('trx_addons_filter_post_meta_args', array(
									'components' => 'views,likes,comments',
									'seo' => false
									), 'recent_news_excerpt', 1)
								);
			}
			?>
		</div><!-- .entry-footer -->

	</div><!-- .post_body -->

</article>