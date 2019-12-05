<?php
/**
 * Thmpw Logo Widget.
 *
 *
 * @since 1.0.0
 */
namespace Pawelements\Widgets\Elementor;

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Scheme_Color;
use  Elementor\Group_Control_Typography;
use  Elementor\Scheme_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Pawelements_Logo extends \Elementor\Widget_Base{

	public function get_name(){
		return 'pawelem_logo';
	}

	public function get_title(){
		return __('Pawelements Logo ', 'pawelem-companion');
	}

	public function get_icon(){
		return ('eicon-logo');
	}

	public function get_categories(){
		return ['pawelements'];
	}

	public function get_keywords(){
		return ['logo', 'brand', 'company'];
	}

	protected function _register_controls(){

		$this->start_controls_section('logo_section',
			[
				'label' => __( 'Brand Logo', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		if ( pawelem_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
	            'pawlele_logo_icon',
	            [
	                'label' => esc_html__( 'Right Icon', 'pawelem-companion' ),
	                'type' => Controls_Manager::ICON,
	                
	            ]
	    	);
	    	$condition = ['pawlele_logo_icon!' => ''];
    	}else{
    		$this->add_control(
			 	'pawlele_logo_as_icons',
	            [
	                'label' => esc_html__( 'Right Icon', 'pawelem-companion' ),
	                'type' => Controls_Manager::ICONS,
	                'fa4compatibility' => 'pawlele_logo_icon',

	            ]
            );
            $condition = ['pawlele_logo_as_icons[value]!' => ''];
		 };



		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pawelem_logo_imgae', [
				'label' => __( 'Logo', 'pawelem-companion' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'show_label' => false,
			]
		);

		$repeater ->add_control(
			'link', [
                'label'         => __('Website Url', 'pawelem-companion'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => 'https://pawelements.com/',
                'label_block'   => true,
            ]
        );


		$repeater->add_control(
			'pawelem_logo_content', [
				'label' => __( 'Description', 'pawelem-companion' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->add_control(
			'logo_list',
			[
				'label' => __( 'Logo List', 'pawelem-companion' ),
				'type' =>    Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'pawelem_logo_iamge' => ['url' => Utils::get_placeholder_image_src()],
						'pawelem_logo_content' => __( '', 'pawelem-companion' ),
						'link' => __( '', 'pawelem-companion' ),
					],
					[
						'pawelem_logo_iamge' => ['url' => Utils::get_placeholder_image_src()],
						'pawelem_logo_content' => __( '', 'pawelem-companion' ),
						'link'  => __( '', 'pawelem-companion' ),
					],
					[
						'pawelem_logo_iamge' => ['url' => Utils::get_placeholder_image_src()],
						'pawelem_logo_content' => __( '', 'pawelem-companion' ),
						'link' => __( '', 'pawelem-companion' ),
					],
					[
						'pawelem_logo_iamge' => ['url' => Utils::get_placeholder_image_src()],
						'pawelem_logo_content' => __( '', 'pawelem-companion' ),
						'link' => __( '', 'pawelem-companion' ),
					],
					[
						'pawelem_logo_iamge' => ['url' => Utils::get_placeholder_image_src()],
						'pawelem_logo_content' => __( '', 'pawelem-companion' ),
						'link' => __( '', 'pawelem-companion' ),
					],
					[
						'pawelem_logo_iamge' => ['url' => Utils::get_placeholder_image_src()],
						'pawelem_logo_content' => __( '', 'pawelem-companion' ),
						'link' => __( '', 'pawelem-companion' ),
					],

				],
				
			]
		);
		$this->end_controls_section();

		$this->start_controls_section('logo_settings',
			[
				'label' => __( 'Settings', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
            'layout',
            [
                'label' => __( 'Grid Layout', 'pawelem-companion' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'box' => __( 'Box', 'pawelem-companion' ),
                    'border' => __( 'Border', 'pawelem-companion' ),
                ],
                'default' => 'box',
                'prefix_class' => 'pawelem-logo-grid--'
            ]
        );

		$this->add_responsive_control(
		    'columns',
		    [    
		        'label'                 => __( 'Columns', 'pawelem-companion' ),
		        'type'                  => Controls_Manager::SELECT,
		        'default'               => '3',
		        'tablet_default'        => '2',
		        'mobile_default'        => '1',
		        'options'               => [
		         '2' => __('2 Column', 'pawelem-companion'),
		         '3' => __('3 Column', 'pawelem-companion'),
		         '4' => __('4 Column', 'pawelem-companion'),
		         '5' => __('5 Column', 'pawelem-companion'),
		         '6' => __('6 Column', 'pawelem-companion'),
		        ],
		        'prefix_class'          => 'pawelem-logo--grid-col%s-',
		        'frontend_available'    => true,
		    ]
		);
		$this->add_control(
			'pawelem_logo_align',
			[
				'label'                 => __( 'Text Align', 'pawelem-companion' ),
				'type'                  => Controls_Manager::CHOOSE,
                'label_block'           => false,
				'default'               => 'top',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'pawelem-companion' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Center', 'pawelem-companion' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'pawelem-companion' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors'             => [
					'{{WRAPPER}} .pawelem-logo-grid-figure' => 'text-align: {{VALUE}};',
				],
				'selectors_dictionary'  => [
					'top'          => 'left',
					'middle'       => 'center',
					'bottom'       => 'right',
				],
			]
		);

		$this->end_controls_section();

		// Logo Style Section
		$this->start_controls_section(
			'iamge_style',
			[
				'label' => __( 'Image', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'pawelem-companion' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Start Style Tabs
		$this->start_controls_tabs('button_style_tabs');
		$this->start_controls_tab('style_normal_tab',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);

		$this->add_control(
            'logo_bg_color',
            [
                'label' => __( 'Background Color', 'pawelem-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pawelem-logo-grid-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'pawelem_logo_border_radius',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pawelem-logo-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'pawelem_logo_padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pawelem-logo-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'logo_box_shadow',
				'label' => __( 'Box Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-logo-grid-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('style_hover_tab',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);

		$this->add_control(
            'logo_bg_hover_color',
            [
                'label' => __( 'Background Hover Color', 'pawelem-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pawelem-logo-grid-item:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'pawelem_logo_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pawelem-logo-grid-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'pawelem_logo_padding_hover',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pawelem-logo-grid-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'log_box_shadow_hover',
				'label' => __( 'Box Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-logo-grid-item:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		
		$this->end_controls_section();


		// Log Style Section
		$this->start_controls_section(
			'_content_style',
			[
				'label' => __( 'Content Style', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_content_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pawelem-logo-grid-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty($settings['logo_list'] ) ) {
            return;
        }
		?>
		
		<div class="pawelem-logo-grid-wraper">
			
			<span class="tpw-tab-plus-icon">	
				<?php pawelem_render_icon( $settings, 'pawlele_logo_icon', 'pawlele_logo_as_icons' ); ?>
			</span>

			<?php foreach ($settings['logo_list'] as $index => $item):

				$image = wp_get_attachment_image_url( $item['pawelem_logo_imgae']['id'], 'full');
				if (!$image) {
					$image = Utils::get_placeholder_image_src();
				};
	            $repeater_key = 'item-' . $index;
	            $tag = 'div';
	            if ($item['link']['url']) {
	            	$tag = 'a';
                    $this->add_render_attribute( $repeater_key, 'target', '_blank' );
                    $this->add_render_attribute( $repeater_key, 'rel', 'noopener' );
                    $this->add_render_attribute( $repeater_key, 'href', esc_url( $item['link']['url'] ) );
	            }


	            $this->add_render_attribute( $repeater_key, 'class', 'pawelem-logo-grid-item' );
			 ?>
				<<?php echo $tag; ?> <?php $this->print_render_attribute_string($repeater_key) ?>>
					<figure class="pawelem-logo-grid-figure pawelem-macth-height">
						<div class="logo">
							<img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr('name') ?>">
						</div>
						
                    	<?php echo pawelements_get_meta($item['pawelem_logo_content']) ?>
                    </figure>
				</<?php echo $tag; ?>>
			<?php endforeach ?>
		</div>

		<?php

	}

}