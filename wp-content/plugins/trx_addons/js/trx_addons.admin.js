/**
 * Admin utilities (for internal use only!)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */

/* global jQuery:false */
/* global TRX_ADDONS_STORAGE:false */

(function() {

	"use strict";

	if (typeof TRX_ADDONS_STORAGE == 'undefined') window.TRX_ADDONS_STORAGE = {};
	
	jQuery(document).ready(function() {
	
		// Trigger 'admin_action.init_hidden_elements' on meta box hide and show
		jQuery(document).on('postbox-toggled', function() {
			jQuery(document).trigger('admin_action.init_hidden_elements');
		});
		// Trigger 'admin_action.init_hidden_elements' on sorting meta boxes
		jQuery('.meta-box-sortables').on( 'sortstop', function() {
			jQuery(document).trigger('admin_action.init_hidden_elements');
		});


		// Check fields dependencies in widgets
		//-----------------------------------------------------------------------------------
		
		// Check dependencies in widgets in admin menu
		jQuery( '.widget-liquid-right form,.widgets-holder-wrap.inactive-sidebar form,.edit-widgets-block-editor')
			.each( function () {
				trx_addons_admin_check_dependencies(jQuery(this));
			} );
		jQuery('.widget-liquid-right form,.widgets-holder-wrap.inactive-sidebar form,.edit-widgets-block-editor')
			.on( 'change', '[data-param-name]', function() {
				trx_addons_admin_check_dependencies(jQuery(this).parents('form'));
			} );
		// Check dependencies in widgets inside Customize sections (before open for dinamically created sections)
		jQuery( '#customize-theme-controls .control-section' ).on(
			'click', '.widget-title', function() {
				var widget = jQuery( this ).parents('.widget').eq(0).find('.form');
				if (widget.length > 0) {
					trx_addons_admin_check_dependencies( widget );
				}
			}
		);
		jQuery('#customize-theme-controls .control-section')
			.on( 'change', '[data-param-name]', function() {
				trx_addons_admin_check_dependencies(jQuery(this).parents('.form').eq(0));
			} );

		// Check for dependencies
		function trx_addons_admin_check_dependencies(cont) {
			cont.find('[data-param-name]').each(function() {
				var ctrl = jQuery(this),
					id = ctrl.data('param-name'),
					depend = ctrl.data('param-dependency');
				if ( !id || !depend) return;
				if (depend) {
					var dep_cnt = 0, dep_all = 0;
					var dep_cmp = typeof depend.compare != 'undefined' ? depend.compare.toLowerCase() : 'and';
					var dep_strict = typeof depend.strict != 'undefined';
					var fld=null, val='', name='', subname='', i;
					var parts = '', parts2 = '';
					for (i in depend) {
						if (i == 'compare' || i == 'strict') continue;
						dep_all++;
						name = i;
						subname = '';
						if (name.indexOf('[') > 0) {
							parts = name.split('[');
							name = parts[0];
							subname = parts[1].replace(']', '');
						}
						fld = cont.find('[data-param-name="'+name+'"]');
						if (fld.length > 0) {
							val = trx_addons_admin_get_field_value(fld);
							if (subname !== '') {
								parts = val.split('|');
								for (var p=0; p < parts.length; p++) {
									parts2 = parts[p].split('=');
									if (parts2[0]==subname) {
										val = parts2[1];
									}
								}
							}
							for (var j in depend[i]) {
								if ( 
									   (depend[i][j]=='not_empty' && val !== '')	// Main field value is not empty - show current field
									|| (depend[i][j]=='is_empty' && val === '')		// Main field value is empty - show current field
									|| (val !== '' && (!isNaN(depend[i][j]) 		// Main field value equal to specified value - show current field
														? val==depend[i][j]
														: (dep_strict 
																? val==depend[i][j]
																: (''+val).indexOf(depend[i][j])==0
															)
													)
										)
									|| (val !== '' && (""+depend[i][j]).charAt(0) == '^' && (''+val).indexOf(depend[i][j].substr(1))==-1)
																				// Main field value not equal to specified value - show current field
								) {
									dep_cnt++;
									break;
								}
							}
						}
						if (dep_cnt > 0 && dep_cmp == 'or')
							break;
					}
					if ((dep_cnt > 0 && dep_cmp == 'or') || (dep_cnt == dep_all && dep_cmp == 'and')) {
						ctrl.parents('[class^="widget_field_type_"]').show().removeClass('trx_addons_field_no_use');
					} else {
						ctrl.parents('[class^="widget_field_type_"]').hide().addClass('trx_addons_field_no_use');
					}
				}
			});
		}

		function trx_addons_admin_get_field_value(fld) {
			var ctrl = fld.parents('[class^="widget_field_type_"]');
			var val = fld.attr('type')=='checkbox' || fld.attr('type')=='radio' 
						? (ctrl.find('input[type="'+fld.attr('type')+'"]:checked').length > 0
							? (ctrl.find('input[type="'+fld.attr('type')+'"]:checked').val() !== ''
								&& ''+ctrl.find('input[type="'+fld.attr('type')+'"]:checked').val() !== '0'
									? ctrl.find('input[type="'+fld.attr('type')+'"]:checked').val()
									: 1
								)
							: 0
							)
						: fld.val();
			if (val===undefined || val===null) val = '';
			return val;
		}


		// Refresh taxonomies and terms lists when post type is changed
		//-----------------------------------------------------------------------------------
		
		// In widgets mode
		jQuery('.widget-liquid-right,.widgets-holder-wrap,.customize-control-widget_form,.edit-widgets-block-editor,.customize-control-sidebar_block_editor')
			.on('change', '.trx_addons_post_type_selector,.trx_addons_taxonomy_selector', function() {
				var field = jQuery(this),
					num = 0;
				field
					.parent()
					.nextAll()
					.find( field.attr('class').indexOf('_post_type_selector') > 0 ? 'select[class*="_taxonomy_selector"]' : 'select[class*="_terms_selector"]')
					.each(function() {
						var cat_fld = jQuery(this);
						var cat_lbl = cat_fld.prev('label');
						setTimeout(function(){
							trx_addons_refresh_list(cat_fld.attr('class').indexOf('_taxonomy_selector') > 0
													? 'taxonomies'
													: 'terms',
												field.val(),
												cat_fld,
												cat_lbl);
						}, 300*num);
						num++;
					});
				return false;
			});
	
		// In ThemeREX Addons Options
		jQuery('.trx_addons_options')
			.on('change', '.trx_addons_post_type_selector,.trx_addons_taxonomy_selector', function() {
				var field_container = jQuery(this).parents('.trx_addons_options_item');
				var cat_fld = field_container.next().find('[class*="_selector"]');
				var cat_lbl = field_container.next().find('.trx_addons_options_item_title');
				if (cat_fld.length > 0) {
					trx_addons_refresh_list(cat_fld.hasClass('trx_addons_taxonomy_selector')
												? 'taxonomies' 
												: 'terms',
											jQuery(this).val(),
											cat_fld,
											cat_lbl);
				}
				return false;
			});
		
		// In VC editor
		// Attention! Code of this handler is moved to the api/js_composer/js_composer.admin.js
		
		// In Elementor editor
		// Attention! Code of this handler is moved to the api/elementor/elementor.editor.js


		// Refresh link on the post editor when select with layout is changed
		// in Theme Options, VC editor or Elementor editor
		//--------------------------------------------------------------------
		jQuery('body').on('change', 'select', function () {
			var selector = jQuery(this),
				parent = selector.data('setting') !== undefined
							? selector.closest('.elementor-control-content').eq(0)
							: selector.parent();
			var a = parent.find('a.trx_addons_post_editor');
			if (a.length > 0) trx_addons_layout_selector_refresh_link(a);
		});
		
		window.trx_addons_layout_selector_refresh_link = function(a) {
			var parent = a.closest('.elementor-control-content').length > 0
							? a.closest('.elementor-control-content').eq(0)
							: a.parent().parent();
			var selector = parent.find('select');
			if (selector.length > 0) {
				var id = Number(selector.val());
				if (isNaN(id)) id = 0;
				a.attr('href', a.attr('href').replace(/post=[0-9]{1,5}/, "post="+id));
				if (id == 0) {
					a.addClass('trx_addons_hidden');
				} else {
					a.removeClass('trx_addons_hidden');
				}
			}
		};

		// Prepare media selector params
		TRX_ADDONS_STORAGE['media_id'] = '';
		TRX_ADDONS_STORAGE['media_frame'] = [];
		TRX_ADDONS_STORAGE['media_link'] = [];

		// First run init fields
		trx_addons_admin_init_fields();
		jQuery(document).on('action.init_hidden_elements', trx_addons_admin_init_fields);
	});

	

	// Init fields at first run and after clone group
	// -------------------------------------------------------------------------------------
	function trx_addons_admin_init_fields(e, container) {
		
		if (container === undefined) container = jQuery('body');
	
		// Init jQuery Tabs
		if (jQuery.ui && jQuery.ui.tabs) {
			container.find('.trx_addons_tabs:not(.inited)').addClass('inited').tabs({
				create: function( event, ui ) {
					if (ui.panel.length > 0) jQuery(document).trigger('admin_action.init_hidden_elements', [ui.panel]);
				},
				activate: function( event, ui ) {
					if (ui.newPanel.length > 0) jQuery(document).trigger('admin_action.init_hidden_elements', [ui.newPanel]);
				}
			});
			// Check hash and open tab
			var hash  = window.location.hash;
			if (hash && jQuery('a[href="'+hash+'"]').length > 0) {
				setTimeout(function() {
					jQuery('a[href="'+hash+'"]').trigger('click');
				}, 10);
			}
		}
		
		// Init jQuery Accordion
		if (jQuery.ui && jQuery.ui.accordion) {
			container.find('.trx_addons_panels:not(.inited)').addClass('inited').accordion({
				'header': '.trx_addons_panel_title',
				'heightStyle': 'content',
				create: function( event, ui ) {
					if (ui.panel.length > 0) jQuery(document).trigger('admin_action.init_hidden_elements', [ui.panel]);
				},
				activate: function( event, ui ) {
					if (ui.newPanel.length > 0) jQuery(document).trigger('admin_action.init_hidden_elements', [ui.newPanel]);
				}
			});
		}

		// Standard WP Color Picker
		if (container.find('.trx_addons_color_selector:not(.inited)').length > 0) {
			container.find('.trx_addons_color_selector:not(.inited)').addClass('inited').wpColorPicker({
				// you can declare a default color here,
				// or in the data-default-color attribute on the input
				//defaultColor: false,
		
				// a callback to fire whenever the color changes to a valid color
				change: function(e, ui){
					jQuery(e.target).val(ui.color).trigger('change');
				},
		
				// a callback to fire when the input is emptied or an invalid color
				clear: function(e) {
					jQuery(e.target).prev().trigger('change');
				},
		
				// hide the color picker controls on load
				//hide: true,
		
				// show a group of common colors beneath the square
				// or, supply an array of colors to customize further
				//palettes: true
			});
		}
		
		// Icon selector
		// Attention! Init container, because icon_selector appear in a cloneable blocks
		if (!container.hasClass('trx_addons_icon_selector_inited')) {
			container.addClass('trx_addons_icon_selector_inited')
				.on('click', '.trx_addons_icon_selector', function(e) {
					var selector = jQuery(this);
					var list = selector.next('.trx_addons_list_icons');
					if (list.length > 0) {
						if (list.css('display') == 'block') {
							list.slideUp();
						} else {
							var css_obj = {};
							if (selector.parents('#trx_addons_meta_box').length > 0) {
								css_obj = { 
									'position': 'relative',
									'left': 'auto',
									'top': 'auto'
								};
							} else {
								var pos = selector.position();
								css_obj = {
									'position': 'absolute',
									'left': pos.left,
									'top': pos.top+selector.height()+4
								};
							}
							list.find('.trx_addons_list_icons_search').val('');
							list.find('span').removeClass('trx_addons_list_hidden');
							list.css(css_obj).slideDown(function() {
																	list.find('.trx_addons_list_icons_search').focus();
																});
						}
					}
					e.preventDefault();
					return false;
				})
				.on('keyup', '.trx_addons_list_icons_search', function(e) {
					var list = jQuery(this).parent(),
						val = jQuery(this).val();
					list.find('span').removeClass('trx_addons_list_hidden');
					if (val !== '') list.find('span:not([data-icon*="'+val+'"])').addClass('trx_addons_list_hidden');
				})
					.on( 'keydown', '.trx_addons_list_icons span', function( e ) {
						var handled = false,
								icons = jQuery( this ).siblings( 'span' );
						// If 'Enter' or 'Space' is pressed - switch state of the icons list
						if ( [ 13, 32 ].indexOf( e.which ) >= 0 ) {
							jQuery( this ).trigger( 'click' );
							handled = true;
						} else if ( 37 == e.which ) {
							icons.get( Math.max( 0, jQuery( this ).index() - 1 ) ).focus();
							handled = true;
						} else if ( 38 == e.which ) {
							icons.get( Math.max( 0, jQuery( this ).index() - 8 ) ).focus();
							handled = true;
						} else if ( 39 == e.which ) {
							icons.get( Math.min( icons.length - 1, jQuery( this ).index() ) ).focus();
							handled = true;
						} else if ( 40 == e.which ) {
							icons.get( Math.min( icons.length - 1, jQuery( this ).index() + 7 ) ).focus();
							handled = true;
						} else if ( [ 27 ].indexOf( e.which ) >= 0 ) {
							jQuery( this ).parents('.trx_addons_list_icons').prev('.trx_addons_icon_selector').trigger('click');
							handled = true;
						}
						if ( handled ) {
							e.preventDefault();
							return false;
						}
						return true;
					})
					.on('click', '.trx_addons_list_icons span', function(e) {
						var list = jQuery(this).parents('.trx_addons_list_icons');
					list.find('.trx_addons_active').removeClass('trx_addons_active');
					var selector = list.prev('.trx_addons_icon_selector');
					var input = selector.length==1 ? selector.prev('input') : list.prev('input');
					var icon = jQuery(this).addClass('trx_addons_active').data('icon');
					input.val(icon).trigger('change');
					if (selector.length > 0) {
						list.fadeOut();
							var bg = jQuery( this ).css( 'background-image' );
							selector
									.attr('class', trx_addons_chg_icon_class(selector.attr('class'), bg && bg != 'none' ? 'image-selected' : icon))
									.css('background-image', bg && bg != 'none' ? bg : 'none')
									.get(0).focus();
					}
					e.preventDefault();
					return false;
				});
		}
		
		// Media selector
		container.find('#customize-theme-controls:not(.inited)'
						+',.widget-liquid-right:not(.inited)'
						+',.widgets-holder-wrap:not(.inited)'
						+',.widget_field_type_image:not(.inited)'
						+',.form-field:not(.inited)'
						+',.trx_addons_options_item_field:not(.inited)'
						+',.postbox-container:not(.inited)'
						+',#elementor-panel:not(.inited_media_selector)'
						+',.edit-widgets-block-editor:not(.inited)'
						+',.trx_addons_options_item_field:not(.inited)').addClass('inited')
			.on('click', '.trx_addons_media_selector', function(e) {
				trx_addons_show_media_manager(this);
				e.preventDefault();
				return false;
			})
			.on('click', '.trx_addons_media_selector_preview > span', function(e) {
				var image = jQuery(this);
				var button = image.parent().prev('.trx_addons_media_selector');
				var field = jQuery('#'+button.data('linked-field'));
				if (field.length == 0) return;
				if (button.data('multiple')==1) {
					var val = field.val().split('|');
					val.splice(image.index(), 1);
					field.val(val.join('|'));
					image.remove();
				} else {
					field.val('');
					image.remove();
				}
				e.preventDefault();
				return false;
			});
	}
	
	
	// Show WP Media manager to select image
	// -------------------------------------------------------------------------------------
	function trx_addons_show_media_manager(el) {
	
		TRX_ADDONS_STORAGE['media_id'] = jQuery(el).attr('id');
		TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']] = jQuery(el);
		// If the media frame already exists, reopen it.
		if ( TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']] ) {
			TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']].open();
			return false;
		}
	
		// Create the media frame
		var type = TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('type') 
						? TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('type') 
						: 'image';
		var args = {
			// Set the title of the modal.
			title: TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('choose'),
			// Multiple choise
			multiple: TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('multiple')==1 
						? 'add' 
						: false,
			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: true
			}
		};
		// Allow sizes and filters for the images
		if (type == 'image') {
			args['frame'] = 'post';
		}
		// Tell the modal to show only selected post types
		if (type == 'image' || type == 'audio' || type == 'video') {
			args['library'] = {
				type: type
			};
		}
		TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']] = wp.media(args);
	
		// When an image is selected, run a callback.
		TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']].on( 'insert select', function(selection) {
			// Grab the selected attachment.
			var field = jQuery("#"+TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('linked-field')).eq(0);
			var attachment = null, attachment_url = '';
			if (TRX_ADDONS_STORAGE['media_link'][TRX_ADDONS_STORAGE['media_id']].data('multiple')==1) {
				TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']].state().get('selection').map( function( att ) {
					attachment_url += (attachment_url ? "|" : "") + att.toJSON().url;
				});
				var val = field.val();
				attachment_url = val + (val ? "|" : '') + attachment_url;
			} else {
				attachment = TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']].state().get('selection').first().toJSON();
				attachment_url = attachment.url;
				var sizes_selector = jQuery('.media-modal-content .attachment-display-settings select.size');
				if (sizes_selector.length > 0) {
					var size = trx_addons_get_listbox_selected_value(sizes_selector.get(0));
					if (size !== '') attachment_url = attachment.sizes[size].url;
				}
			}
			// Display images in the preview area
			var preview = field.siblings('.trx_addons_media_selector_preview');
			if (preview.length == 0) {
				jQuery('<span class="trx_addons_media_selector_preview"></span>').insertAfter(field);
				preview = field.siblings('.trx_addons_media_selector_preview');
			}
			if (preview.length != 0) preview.empty();
			var images = attachment_url.split("|");
			for (var i=0; i < images.length; i++) {
				if (preview.length != 0) {
					var ext = trx_addons_get_file_ext(images[i]);
					preview.append('<span>'
									+ (ext=='gif' || ext=='jpg' || ext=='jpeg' || ext=='png' 
											? '<img src="'+images[i]+'">'
											: '<a href="'+images[i]+'">'+trx_addons_get_file_name(images[i])+'</a>'
										)
									+ '</span>');
				}
			}
			// Update field
			field.val(attachment_url).trigger('change');
		});
	
		// Finally, open the modal.
		TRX_ADDONS_STORAGE['media_frame'][TRX_ADDONS_STORAGE['media_id']].open();
		return false;
	}

	/* Mutation observers
	---------------------------------------------------------------- */
	var trx_addons_observers = {};

	// Create mutations observer
	window.trx_addons_create_observer = function( id, obj, callback, args ) {
		if ( typeof window.MutationObserver !== 'undefined' && obj.length > 0 ) {
			if ( typeof trx_addons_observers[ id ] == 'undefined' ) {
				var defa = {
						attributes: false,
						childList: true,
						subtree: true
					};
				if ( args ) {
					defa = trx_addons_object_merge( defa, args );
				}
				trx_addons_observers[ id ] = {
					observer: new MutationObserver( callback ),
					obj: obj.get(0)
				};
				trx_addons_observers[ id ].observer.observe( trx_addons_observers[ id ].obj, defa );
			}
			return true;
		}
		return false;
	};

	// Remove mutations observer
	window.trx_addons_remove_observer = function( id ) {
		if ( typeof window.MutationObserver !== 'undefined' ) {
			if ( typeof trx_addons_observers[ id ] !== 'undefined' ) {
				trx_addons_observers[ id ].observer.disconnect(
					trx_addons_observers[ id ].obj
				);
				delete trx_addons_observers[ id ];
			}
			return true;
		}
		return false;
	};


	// Create an observer to add class 'editor-page-attributes__template' to the field's wrap
	// contains a select with templates ( only for pages )
	if ( jQuery('body').hasClass( 'post-type-page' ) ) {
		var add_sidebar_observer = function() {
			// Function to add a class to the template selector
			var add_class_to_template_selector = function() {
				var $option = $page_sidebar.find( 'option[value="blog.php"]' );
				if ( $option.length && $option.parents( '.editor-page-attributes__template' ).length === 0 ) {
					$option.parent().parent().addClass( 'editor-page-attributes__template' );
				}
			};
			// Manual call on page loaded
			add_class_to_template_selector();
			// Add observer to call function on tab clicked (opened)
			trx_addons_create_observer( 'add_class_to_template_selector', $page_sidebar, function( mutationsList ) {
				for ( var mutation of mutationsList ) {
					if ( mutation.type == 'childList' ) {
						add_class_to_template_selector();
					}
				}
			} );
		};
		var $editor = jQuery('#editor').eq(0);
		if ( $editor.length ) {
			var $page_sidebar = $editor.find('.edit-post-sidebar .components-panel').eq(0);
			if ( $page_sidebar.length ) {
				add_sidebar_observer();
			} else {
				trx_addons_create_observer( 'check_for_sidebar_created', $editor, function( mutationsList ) {
					for ( var mutation of mutationsList ) {
						if ( mutation.type == 'childList' ) {
							$page_sidebar = $editor.find('.edit-post-sidebar .components-panel').eq(0);
							if ( $page_sidebar.length ) {
								trx_addons_remove_observer( 'check_for_sidebar_created' );
								add_sidebar_observer();
								break;
							}
						}
					}
				} );
			}
		}
	}
})();