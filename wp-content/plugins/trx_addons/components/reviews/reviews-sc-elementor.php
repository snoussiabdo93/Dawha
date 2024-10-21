<?php
/**
 * ThemeREX Addons Posts and Comments Reviews (Elementor support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.47
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_reviews_add_in_elementor')) {
	add_action( 'elementor/widgets/widgets_registered', 'trx_addons_sc_reviews_add_in_elementor' );
	function trx_addons_sc_reviews_add_in_elementor() {
		
		if (!trx_addons_reviews_enable() || !class_exists('TRX_Addons_Elementor_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Reviews extends TRX_Addons_Elementor_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_reviews';
			}

			/**
			 * Retrieve widget title.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget title.
			 */
			public function get_title() {
				return __( 'Reviews', 'trx_addons' );
			}

			/**
			 * Retrieve widget icon.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget icon.
			 */
			public function get_icon() {
				return 'eicon-favorite';
			}

			/**
			 * Retrieve the list of categories the widget belongs to.
			 *
			 * Used to determine where to display the widget in the editor.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return array Widget categories.
			 */
			public function get_categories() {
				return ['trx_addons-elements'];
			}

			/**
			 * Register widget controls.
			 *
			 * Adds different input fields to allow the user to change and customize the widget settings.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function register_controls() {
				$this->start_controls_section(
					'section_sc_reviews',
					[
						'label' => __( 'Reviews', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', array(
														'default' => esc_html__('Default', 'trx_addons')
													), 'trx_sc_reviews'),
						'default' => 'default',
					]
				);

				$this->add_control(
					'title',
					[
						'label' => __( 'Title', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => false,
						'placeholder' => __( "Title", 'trx_addons' ),
						'default' => ''
					]
				);
				
				$this->add_control(
					'rating_max_level',
					[
						'label' => __( 'Max rating level', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
									'inherit' => esc_html__('Inherit', 'trx_addons'),
									'5' => esc_html__('5 stars', 'trx_addons'),
									'10' => esc_html__('10 stars', 'trx_addons'),
									'100' => esc_html__('100%', 'trx_addons')
									],
						'default' => 'inherit'
					]
				);
				
				$this->add_control(
					'rating_style',
					[
						'label' => __( 'Show rating as', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
									'inherit' => esc_html__('Inherit', 'trx_addons'),
									'icons' => esc_html__('As icons', 'trx_addons'),
									'bar' => esc_html__('As progress bar', 'trx_addons'),
									'text' => esc_html__('As text (for example: 7.5 / 10)', 'trx_addons')
									],
						'default' => 'inherit'
					]
				);

				$this->add_control(
					'rating_color',
					[
						'label' => __( 'Color', 'trx_addons' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'default' => '',
						'scheme' => [
							'type' => \Elementor\Core\Schemes\Color::get_type(),
							'value' => \Elementor\Core\Schemes\Color::COLOR_1
						],
					]
				);
				
				$this->add_icon_param('', [], 'icons');

				$this->add_control(
					'rating_text_template',
					[
						'label' => __( 'Text template', 'trx_addons' ),
						'description' => wp_kses_data( __('Write text template, where {{X}} - is a current value, {{Y}} - is a max value, {{V}} - is a number of votes. For example "Rating {{X}} from {{Y}} (according {{V}})"', 'trx_addons') ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => false,
						'default' => ''
					]
				);
				
				$this->add_control(
					'allow_voting',
					[
						'label' => __( 'Allow voting', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_off' => __( 'Off', 'trx_addons' ),
						'label_on' => __( 'On', 'trx_addons' ),
						'return_value' => '1',
					]
				);
			}

			/**
			 * Render widget's template for the editor.
			 *
			 * Written as a Backbone JavaScript template and used to generate the live preview.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function content_template() {
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_REVIEWS . "tpe.reviews.php",
										'trx_addons_args_sc_reviews',
										array('element' => $this)
									);
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Reviews() );
	}
}
