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

extract(get_query_var('trx_addons_args_sc_icons'));
?><#
var id = settings._element_id ? settings._element_id + '_sc' : 'sc_icons_'+(''+Math.random()).replace('.', '');

if (settings.columns.size < 1) settings.columns.size = settings.icons.length;
settings.columns.size = Math.max(1, Math.min(settings.icons.length, settings.columns.size));

var column_class = "<?php echo esc_attr(trx_addons_get_column_class(1, '##')); ?>";

#><div id="{{ id }}" class="sc_icons sc_icons_{{ settings.type }} sc_icons_size_{{ settings.size }} sc_align_{{ settings.align }}">
	
	<?php $element->sc_show_titles('sc_icons'); ?>

	<#
	if (settings.columns.size > 1) {
		#><div class="sc_icons_columns_wrap sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom"><#
	}
	
	_.each(settings.icons, function(item) {
		if (item.color == '') item.color = settings.color;
		if (settings.columns.size > 1) {
			#><div class="<# print(column_class.replace('##', settings.columns.size)); #>"><#
		}
		#><div class="sc_icons_item<# if (item.link && item.link.url != '') print(' sc_icons_item_linked'); #>"><#
			if( settings.type === 'simple' ) {
				#><div class="inner_simple_wrap"><#
			}
			if (item.char != '') {
				#><div class="sc_icons_icon sc_icons_char" data-char="{{ item.char }}"><span data-char="{{ item.char }}"></span></div><#
			} else if (item.image.url != '') {
				#><div class="sc_icons_image"><img src="{{ item.image.url }}" alt="<?php esc_attr_e('Icon', 'trx_addons'); ?>"></div><#
			} else {
				var icon = trx_addons_get_settings_icon( item.icon );
				if ( trx_addons_is_off(icon) ) icon = '';
				if (typeof item.icon_type == 'undefined') item.icon_type = '';
				if (icon != '') {
					var img = '', svg = '';
					if (icon.indexOf('//') >= 0) {
						if (icon.indexOf('.svg') >= 0) {
							svg = icon;
							item.icon_type = 'svg';
						} else {
							img = icon;
							item.icon_type = 'images';
						}
						icon = trx_addons_get_basename(icon);
					}
					#><div class="sc_icons_icon sc_icon_type_{{ item.icon_type }} {{ icon }}"<#
						if (item.color != '') print(' style="color: ' + item.color + '"');
					#>><#
						if (svg != '') {
							#><object type="image/svg+xml" data="{{ svg }}" border="0"></object><#
						} else if (img != '') {
							#><img class="sc_icon_as_image" src="{{ img }}" alt="<?php esc_attr_e('Icon', 'trx_addons'); ?>"><#
						} else {
							#><span class="sc_icon_type_{{ item.icon_type }} {{ icon }}"
								<# if (item.color != '') print(' style="color: '+item.color+'"'); #>
							></span><#
						}
					#></div><#
				}
			}
			if (item.title != '' || item.description != '' || item.link.url != '') {
				#><div class="sc_icons_item_details"><#
			}
				if (item.title != '') {
					item.title = item.title.split('|');
					#><h4 class="sc_icons_item_title"><#
						_.each(item.title, function(str) {
							#><span><# print(str); #></span><#
						});
					#></h4><#
				}
				if (item.description != '') {
					#><div class="sc_icons_item_description"><#
						if (item.description.indexOf('<p>') < 0) {
							item.description = item.description
													.replace(/\[(.*)\]/g, '<b>$1</b>')
													.replace(/\n/g, '|')
													.split('|');
							_.each(item.description, function(str) {
								#><span><# print(str); #></span><#
							});
						} else
							print(item.description);
					#></div><#
				}
				if (item.link && item.link.url != '') {
					#><a href="{{ item.link.url }}" class="sc_icons_item_link"></a><#
				}
			if (item.title != '' || item.description != '' || item.link.url != '') {
				#></div><#
			}
			if( settings.type === 'simple' ) {
				#></div><#
			}
		#></div><#
		if (settings.columns.size > 1) {
			#></div><#
		}
	});

	if (settings.columns.size > 1) {
		#></div><#
	}

	#><?php $element->sc_show_links('sc_icons'); ?>

</div><!-- /.sc_icons -->