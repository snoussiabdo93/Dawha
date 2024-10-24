<?php
/**
 * Template to represent shortcode as a widget in the Elementor preview area
 *
 * Written as a Backbone JavaScript template and using to generate the live preview in the Elementor's Editor
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.41
 */

extract(get_query_var('trx_addons_args_sc_socials'));
?><#
var id = settings._element_id ? settings._element_id + '_sc' : 'sc_socials_'+(''+Math.random()).replace('.', '');

var icons = [];

_.each(settings.icons, function(item) {
	if (item.link != '') {
		icons.push({
					'name': item.icon,
					'title': item.title,
					'url': item.link
					});
	}
});
if (icons.length == 0) {
	if (settings.icons_type == 'socials') {
		icons = JSON.parse('<?php
			$list = trx_addons_get_option('socials');
			echo json_encode(is_array($list) ? $list : array());
			?>');
	} else {
		icons = JSON.parse('<?php
			$list = trx_addons_get_option('share');
			if (is_array($list)) {
				foreach($list as $k=>$v) {
					$list[$k]['url'] = "#{$k}";
				}
			}
			echo json_encode(is_array($list) ? $list : array());
			?>');
	}
}
if (icons.length > 0) {
	#><div id="{{ id }}" class="sc_socials sc_socials_{{ settings.type }}<#
				if (settings.align != '') print(' sc_align_'+settings.align);
				#>">
	
		<?php $element->sc_show_titles('sc_socials'); ?>
	
		<div class="socials_wrap {{ settings.icons_type }}_wrap"><#
		var show = settings.type.replace('default', 'icons'),
			socials_type = "<?php
							$socials_type = trx_addons_get_setting('socials_type');
							echo $socials_type=='images' ? 'bg' : ($socials_type == 'svg' ? 'svg' : 'icons');
							?>";
		print( trx_addons_get_socials_links(icons, socials_type, show) );
		
		#></div><!-- /.socials_wrap -->
	
		<?php $element->sc_show_links('sc_icons'); ?>
	
	</div><!-- /.sc_socials --><#
}
#>