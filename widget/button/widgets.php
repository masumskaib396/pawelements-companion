<?php
/**
 * Thmpw Button Widget.
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

class Pawelements_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pawelem_btutton';
	}
	
	public function get_title() {
		return __( 'Pawelements Button', 'pawelem-companion' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'pawelements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section('content_section',
			[
				'label' => __( 'Butoon', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control('button_text',
			[
				'label' => __( 'Button Text', 'pawelem-companion' ),
				'type' => Controls_Manager::TEXT,
                'dynamic'    => [ 'active' => true ],
				'placeholder' => __( 'Button Text', 'pawelem-companion' ),
				'default' => __( 'Awsome Button', 'pawelem-companion' ),
				'label_block' => true,
			]
		);

       $this->add_control('pawelem_button_link_selection', 
        [
            'label'         => __('Link Type', 'pawelem-companion'),
            'type'          => Controls_Manager::SELECT,
            'options'       => [
                'url'   => __('URL', 'premium-addons-for-elementor'),
                'link'  => __('Existing Page', 'pawelem-companion'),
            ],
            'default'       => 'url',
            'label_block'   => true,
        ]
        );
       $this->add_control('pawelem_button_link',
            [
                'label'         => __('Link', 'pawelem-companion'),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'   => '#',
                    'is_external' => '',
                ],
                'show_external' => true,
                'placeholder'   => 'https://themepaw.com/',
                'label_block'   => true,
                'condition'     => [
                    'pawelem_button_link_selection' => 'url'
                ]
            ]
        );
        $this->add_control('pawelem_button_existing_link',
            [
                'label'         => __('Existing Page', 'pawelem-companion'),
                'type'          => Controls_Manager::SELECT2,
                'options'       => pawelements_get_all_pages(),
                'condition'     => [
                    'pawelem_button_link_selection'     => 'link',
                ],
                'multiple'      => false,
                'separator'     => 'after',
                'label_block'   => true,
            ]
        );

        $this->add_responsive_control('pawelem_button_align',
			[
				'label'             => __( 'Alignment', 'pawelem-companion' ),
				'type'              => Controls_Manager::CHOOSE,
				'options'           => [
					'left'    => [
						'title' => __( 'Left', 'pawelem-companion' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'pawelem-companion' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'pawelem-companion' ),
						'icon'  => 'fa fa-align-right',
					],
				],
                'selectors'         => [
                    '{{WRAPPER}} .sb_wraper' => 'text-align: {{VALUE}}',
                ],
				'default' => 'left',
			]
		);
		$this->add_control('pawelem_button_size', 
        	[
            'label'         => __('Size', 'pawelem-companion'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'lg',
            'options'       => [
                    'sm'        => __('Small', 'pawelem-companion'),
                    'md'        => __('Regular', 'pawelem-companion'),
                    'lg'        => __('Large', 'pawelem-companion'),
                    'ex'        => __('Extra Large', 'pawelem-companion'),
                    'block'     => __('Block', 'pawelem-companion'),
                ],
            'label_block'   => true,
            'separator'     => 'after',
            ]
        );

        $this->add_control('pawelem_icon_switcher',
	        [
	            'label'         => __('Icon', 'pawelem-companion'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Enable or disable button icon','pawelem-companion'),
	        ]
        );
		$this->add_control(
			'pawelem_button_icon',
			[
				'label' => __( 'Icon', 'pawelem-companion' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'condition'     => [
                    'pawelem_icon_switcher'  => 'yes'
                ],
				'default' => '',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pawelem-button i' => 'color: {{VALUE}}',
				],
				'condition' => [
                    'pawelem_icon_switcher' => 'yes',
                    'pawelem_button_icon!' => ''
                ],

			]
		);
		$this->add_control(
            'pawelem_button_icon_position',
            [
                'label' => __( 'Icon Position', 'pawelem-companion' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'pawelem-companion' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'pawelem-companion' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'after',
                'condition' => [
                    'pawelem_icon_switcher' => 'yes',
                    'pawelem_button_icon!' => ''
                ]
            ]
        );
        $this->add_responsive_control(
            'pawelem_button_spacing',
            [
                'label' => __( 'Icon Spacing', 'pawelem-companion' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'pawelem_icon_switcher' => 'yes',
                    'pawelem_button_icon!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-btn-icon-before ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pawelem-btn-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pawelem_button_spacing_left_right',
            array(
                'label'      => esc_html__( 'Vertical Align', 'pawelem-companion' ),
                'type'       => Controls_Manager::SLIDER,
                'condition' => [
                    'pawelem_icon_switcher' => 'yes',
                    'pawelem_button_icon!' => ''
                ],
                'selectors'  => array(
                    '{{WRAPPER}} .pawelem-btn-icon-after, {{WRAPPER}} .pawelem-btn-icon-before' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}})',
                ),
            )
        );
        $this->add_responsive_control(
            'pawelem_button_icon_size',
            [
                'label' => __( 'Icon Size', 'pawelem-companion' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => [
                    'pawelem_icon_switcher' => 'yes',
                    'pawelem_button_icon!' => ''
                ],
                 'selectors' => [
                    '{{WRAPPER}} .pawelem-btn-icon-before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pawelem-btn-icon-after' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'button_css_id',
			[
				'label' => __( 'Button ID', 'pawelem-companion' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'pawelem-companion' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'themepaw-companion' ),
				'separator' => 'before',

			]
		);
		$this->end_controls_section();
		// End Content Section


		//Animation Hover
		$this->start_controls_section(
		    'pawelem_button_hover_effect_section',
		    [
		        'label' => __( 'Button Hover Effect', 'pawelem-companion' ),
		        'tab' => Controls_Manager::TAB_CONTENT,
		    ]
		);
		$this->add_control('pawelem_button_hover_effect', 
            [
                'label'         => __('Hover Effect', 'pawelem-companion'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'none',
                'options'       => [
                    'none'          => __('None', 'pawelem-companion'),
                    'style1'        => __('Slide', 'pawelem-companion'),
                    'style2'        => __('Shutter', 'pawelem-companion'),
                    'style3'        => __('In & Out', 'pawelem-companion'),
                ],
                'label_block'   => true,
            ]
        );
		$this->add_control('pawelem_button_style1_dir', 
        [
            'label'         => __('Slide Direction', 'pawelem-companion'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'bottom',
            'options'       => [
                'bottom'       => __('Top to Bottom', 'pawelem-companion'),
                'top'          => __('Bottom to Top', 'pawelem-companion'),
                'left'         => __('Right to Left', 'pawelem-companion'),
                'right'        => __('Left to Right', 'pawelem-companion'),
            ],
            'condition'     => [
                'pawelem_button_hover_effect' => 'style1',
            ],
            'label_block'   => true,
            ]
        );
		$this->add_control('pawelem_button_style2_dir', 
        [
            'label'         => __('Shutter Direction', 'pawelem-companion'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'shutouthor',
            'options'       => [
                'shutinhor'     => __('Shutter in Horizontal', 'pawelem-companion'),
                'shutinver'     => __('Shutter in Vertical', 'pawelem-companion'),
                'shutoutver'    => __('Shutter out Horizontal', 'pawelem-companion'),
                'shutouthor'    => __('Shutter out Vertical', 'pawelem-companion'),
                'scshutoutver'  => __('Scaled Shutter Vertical', 'pawelem-companion'),
                'scshutouthor'  => __('Scaled Shutter Horizontal', 'pawelem-companion'),
                'dshutinver'   => __('Tilted Left'),
                'dshutinhor'   => __('Tilted Right'),
            ],
            'condition'     => [
                'pawelem_button_hover_effect' => 'style2',
            ],
            'label_block'   => true,
            ]
        );
        $this->add_control('pawelem_button_style3_dir', 
        [
            'label'         => __('Style', 'pawelem-companion'),
            'type'          => Controls_Manager::SELECT,
            'default'       => 'radialin',
            'options'       => [
                'radialin'          => __('Radial In', 'pawelem-companion'),
                'radialout'         => __('Radial Out', 'pawelem-companion'),
                'rectin'            => __('Rectangle In', 'pawelem-companion'),
                'rectout'           => __('Rectangle Out', 'pawelem-companion'),
                ],
            'condition'     => [
                'pawelem_button_hover_effect' => 'style3',
                ],
            'label_block'   => true,
            ]
        );
		$this->end_controls_section();

		// Start Style Content
		$this->start_controls_section('style_section',
			[
				'label' => __( 'Button Style', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
        $this->add_control('button_gradient_background',
	        [
	            'label'         => __('Gradient Opction', 'pawelem-companion'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Use Gradient Background','pawelem-companion'),
	        ]
        );
		$this->start_controls_tabs('button_style_tabs');

		//Button Tab Normal Start
		$this->start_controls_tab('style_normal_tab',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'pawelem_button_typo_normal',
                'scheme'            => Scheme_Typography::TYPOGRAPHY_1,
                'selector'          => '{{WRAPPER}} .pawelem-button',

            ]
        );
		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pawelem-button' => 'color: {{VALUE}}',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pawelem_button_gradient_background_normal',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .pawelem-button',
				'condition' => [
					'button_gradient_background' => 'yes'
				],
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#562DD4',
				'selectors' => [
					'{{WRAPPER}} .pawelem-button,
					 {{WRAPPER}} .pawelem-button.pawelem-button-style2-shutinhor:before,
					 {{WRAPPER}} .pawelem-button.pawelem-button-style2-shutinver:before,
					 {{WRAPPER}} .pawelem-button.pawelem-button-style3-radialin:before,
					 {{WRAPPER}} .pawelem-button.pawelem-button-style3-rectin:before'   => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_gradient_background!' => 'yes'
				],
			]
		);
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),[
				'name' => 'button_box_shadow',
				'label' => __( 'Button Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-button',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'border_normal',
                'selector'      => '{{WRAPPER}} .pawelem-button',
            ]

        );
        $this->add_control('border_radius_normal',
            [
                'label'         => __('Border Radius', 'pawelem-companion'),
                'type'          => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .pawelem-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		$this->add_responsive_control('padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .pawelem-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]
				
			]
		);
		$this->add_responsive_control('margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .pawelem-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]
				
			]
		);
		$this->end_controls_tab();
		// Button Tab Normal End
		
		//Button Tab Hover Start
		$this->start_controls_tab('style_hover_tab',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'              => 'pawelem_button_typo_hover',
                'scheme'            => Scheme_Typography::TYPOGRAPHY_1,
                'selector'          => '{{WRAPPER}} .pawelem-button:hover',

            ]
        );
		$this->add_control(
			'hover_color',
			[
				'label' => __( 'Text Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pawelem-button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pawelem_button_gradient_background_hover',
				'types' => [ 'gradient', 'classic' ],
				'selector' => '{{WRAPPER}} .pawelem-button:hover',
				'condition' => [
					'button_gradient_background' => 'yes'
				],
			]
		);
		$this->add_control(
			'background_hover_color',
			[
				'label' => __( 'Background', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'scheme'            => [
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3
                ],
				'default' => '#E2498A',
				'selectors' => ['
					{{WRAPPER}} .pawelem-button-none:hover,
					{{WRAPPER}} .pawelem-button-style1-top:before,
					{{WRAPPER}} .pawelem-button-style1-right:before,
					{{WRAPPER}} .pawelem-button-style1-bottom:before,
					{{WRAPPER}} .pawelem-button-style1-left:before,
					{{WRAPPER}} .pawelem-button-style2-shutouthor:before,
					{{WRAPPER}} .pawelem-button-style2-shutoutver:before,
					{{WRAPPER}} .pawelem-button-style2-shutinhor,
					{{WRAPPER}} .pawelem-button-style2-shutinver,
					{{WRAPPER}} .pawelem-button-style2-dshutinhor:before,
					{{WRAPPER}} .pawelem-button-style2-dshutinver:before,
					{{WRAPPER}} .pawelem-button-style2-scshutouthor:before,
					{{WRAPPER}} .pawelem-button-style2-scshutoutver:before,
					{{WRAPPER}} .pawelem-button-style3-radialin,
					{{WRAPPER}} .pawelem-button-style3-radialout:before,
					{{WRAPPER}} .pawelem-button-style3-rectin:before,
					{{WRAPPER}} .pawelem-button-style3-rectout:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'button_gradient_background!' => 'yes'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .pawelem-button:hover',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(), 
            [
                'name'          => 'border_hover',
                'selector'      => '{{WRAPPER}} .pawelem-button:hover',
            ]
        );
		$this->add_control('border_radius_hover',
            [
                'label'         => __('Border Radius', 'pawelem-companion'),
                'type'          => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units'    => ['px', '%' ,'em'],
                'selectors'     => [
                    '{{WRAPPER}} .pawelem-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control('hover_padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .pawelem-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]
				
			]
		);
		$this->add_responsive_control('hover_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label_block' => true,
				'size_units'    => ['px', 'em', '%'],
	            'selectors'     => [
	                '{{WRAPPER}} .pawelem-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	            ]
				
			]
		);
		$this->end_controls_tabs();
		$this->end_controls_tab();
		$this->end_controls_section();

	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		//Button Text And Style
		$button_text = $settings['button_text'];
		$button_size = 'pawelem-button-' . $settings['pawelem_button_size'];
		$button_hover = $settings['pawelem_button_hover_effect'];

		//Button Hover Effect
		if ($button_hover == 'none') {
			$button_hover_style = 'pawelem-button-none';
		}elseif($button_hover == 'style1'){
			$button_hover_style = 'pawelem-button-style1-' . $settings['pawelem_button_style1_dir'];
		}elseif ($button_hover == 'style2') {
			$button_hover_style = 'pawelem-button-style2-' . $settings['pawelem_button_style2_dir'];
		}elseif ($button_hover == 'style3') {
			$button_hover_style = 'pawelem-button-style3-' . $settings['pawelem_button_style3_dir'];
		}

		//Butoon ID
		if ( ! empty( $settings['button_css_id'] ) ) {
			$this->add_render_attribute( 'pawelem_button', 'id', $settings['button_css_id'] );
		}

        if( $settings['pawelem_button_link_selection'] == 'url' ){
            $button_url = $settings['pawelem_button_link']['url'];
        } else {
            $button_url = get_permalink( $settings['pawelem_button_existing_link'] );
        }
		//Button Class Href
		$this->add_render_attribute( 'pawelem_button', [
			'class'	=> ['pawelem-button', esc_attr($button_size), esc_attr($button_hover_style) ],
			'href'	=> esc_attr($button_url),
		]);

        
		if( $settings['pawelem_button_link']['is_external'] ) {
			$this->add_render_attribute( 'pawelem_button', 'target', '_blank' );
		}
		if( $settings['pawelem_button_link']['nofollow'] ) {
			$this->add_render_attribute( 'pawelem_button', 'rel', 'nofollow');
		}


		$this->add_render_attribute( 'pawelem_button', 'data-text', esc_attr($settings['button_text'] ));

		$pawelem_button_icon = $settings['pawelem_button_icon'];

		//Button Icon Position
		 if ( $settings['pawelem_button_icon'] ) {
            $this->add_render_attribute( 'pawelem_button_icon', 'class', [
                'pawelem-btn-icon',
                'pawelem-btn-icon-' . esc_attr( $settings['pawelem_button_icon_position'] ),
                esc_attr( $settings['pawelem_button_icon'] )
            ] );
        }
		?>
		<div  class="sb_wraper">
			<a  <?php echo $this->get_render_attribute_string( 'pawelem_button' ); ?>>
			 	<?php if ( $settings['pawelem_button_icon_position'] === 'before' ) : ?>
                    <i <?php echo $this->get_render_attribute_string( 'pawelem_button_icon' ); ?>></i>
                <?php endif; ?>
				<span><?php echo esc_html($button_text) ?></span>
				<?php if ( $settings['pawelem_button_icon_position'] === 'after' ) : ?>
                    <i <?php echo $this->get_render_attribute_string( 'pawelem_button_icon' ); ?>></i>
                <?php endif; ?>
				
			</a>
		</div>
		<?php

	}

}
