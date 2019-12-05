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
use  Elementor\Control_Media;
use  Elementor\Group_Control_Typography;
use  Elementor\Scheme_Typography;
use  Elementor\Group_Control_Image_Size;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Pawelements_Team extends \Elementor\Widget_Base{

	public function get_name(){
		return 'pawelem_team';
	}

	public function get_title(){
		return __('Pawelements Team ', 'pawelem-companion');
	}

	public function get_icon(){
		return ('eicon-person');
	}

	public function get_categories(){
		return ['pawelements'];
	}

	public function get_keywords(){
		return ['team', 'membar', 'portfolio', 'profile'];
	}

	protected function _register_controls(){

		$this->start_controls_section('team_section',
			[
				'label' => __( 'Team Content', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
		    'pawelem_team_style',
		    [    
		        'label'                 => __( 'Team Style', 'pawelem-companion' ),
		        'type'                  => Controls_Manager::SELECT,
		        'default'               => 'style_default',
		        'options'               => [
			        'style_default'   => __('Style Default',  'pawelem-companion'),
			        'style_one'   => __('Style One',  'pawelem-companion'),
			        'style_two'   => __('Style Two',  'pawelem-companion'),
			        'style_three' => __('Style Three','pawelem-companion'),
			        'style_four'  => __('Style Four', 'pawelem-companion'),
			        'style_five'  => __('Style Five', 'pawelem-companion'),
			        'style_six'   =>  __('Style Six', 'pawelem-companion'),
			        'style_seven'   =>  __('Style Seven', 'pawelem-companion'),
		        ],
		       	'separator' => 'after',
		    ]
		);

		$this->add_control(
		    'image',
		    [    
		        'label'         => __( 'Photo', 'pawelem-companion' ),
		        'type'          => Controls_Manager::MEDIA,
		        'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
                    'active' => true,
                ]
		    ]
		);
		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );
		$this->add_control(
		    'profile_name',
		    [    
		        'label'        => __( 'Name', 'pawelem-companion' ),
		        'type'         => Controls_Manager::TEXT,
		        'label_block'  => true,
		        'default' => __('JAMES MARTIN', 'pawelem-companion'),
		    ]
		);
		$this->add_control(
		    'job_title',
		    [    
		        'label'       => __( 'Job Title', 'pawelem-companion' ),
		        'type'        => Controls_Manager::TEXT,
		        'label_block' => true,
		        'default'     => __('Co Manager at Logistico', 'pawelem-companion'),
		    ]
		);
		$this->add_control('show_short_bio',
            [
                'label' => __( 'Show Short Bio', 'pawelem-companion' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'pawelem-companion' ),
                'label_off' => __( 'Hide', 'pawelem-companion' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );
		$this->add_control(
		    'short_bio',
		    [    
		        'label'       => __( 'Short Bio', 'pawelem-companion' ),
		        'type'        => Controls_Manager::TEXTAREA,
		        'rows'   => 10,
		         'condition'=>[
                    'show_short_bio'=>'yes',
                ]
		    ]
		);
		$this->add_responsive_control('team_content_align',
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
                    '{{WRAPPER}} .pawelem-team-body' => 'text-align: {{VALUE}}',
                ],
				'default' => 'center',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section('team_section_icon',
			[
				'label' => __( 'Socail Links', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		//Start Socail Content
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
		    'team_select_icon',
		    [    
		        'label'                 => __( 'Icon Or Image', 'pawelem-companion' ),
		        'type'                  => Controls_Manager::SELECT,
		        'default'               => 'icon',
		        'options'               => [
			        'icon'    => __('Icon',  'pawelem-companion'),
			        'icon_image'   => __('Image',  'pawelem-companion'),
		        ],
		    ]
		);
		
		$repeater->add_control(
		    'team_icon',
		    [    
		        'label'         => __( 'Icon', 'pawelem-companion' ),
		        'type'          => Controls_Manager::SELECT2,
                'options'       => pawelem_get_profile_names(),
				'default' => 'fa fa-facebook',
			    'condition'     => [
	                'team_select_icon' => 'icon'
	            ]
		    ]

		);
		$repeater->add_control(
		    'team_icon_img',
		    [    
		        'label'         => __( 'Image', 'pawelem-companion' ),
		        'type'          => Controls_Manager::MEDIA,
		        'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			    'condition'     => [
	                'team_select_icon' => 'icon_image'
	            ]
		    ]
		);

		$repeater->add_control(
            'link', [
                'label' => __( 'Profile Link', 'pawelem-companion' ),
                'placeholder' => __( 'Add your profile link', 'pawelem-companion' ),
                'type' => Controls_Manager::URL,
                'label_block'   => false,
                'autocomplete'  => false,
                'show_external' => false,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
		$this->add_control(
			'pawelem_profiles',
			[
				'label'   => __( 'Icon OR Image', 'pawelem-companion' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'title_field' => '<# print(team_icon.slice(0,1).toUpperCase() + team_icon.slice(1)) #>',
				'default' => [
					[
						'team_icon_img'  => ['url' => Utils::get_placeholder_image_src()],
						'team_icon'      => 'facebook', 'pawelem-companion',
						'link' => ['url' => 'https://facebook.com/'],
					],
					[
						'team_icon_img'  => ['url' => Utils::get_placeholder_image_src()],
						'team_icon'      =>  'twitter', 'pawelem-companion',
						'link' => ['url' => 'https://twitter.com/'],
					],
					[
						'team_icon_img'  => ['url' => Utils::get_placeholder_image_src()],
						'team_icon'      => 'google-plus', 'pawelem-companion',
						'link' => ['url' => 'https://google-plus.com/'],
					],
				],
			]
		);
		$this->add_control(
            'pawelem_show_profiles',
            [
                'label' => __( 'Show Socail Profiles', 'pawelem-companion' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'pawelem-companion' ),
                'label_off' => __( 'Hide', 'pawelem-companion' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );
		$this->end_controls_section();

		// Start Team Style
		$this->start_controls_section(
			'team_style',
			[
				'label' => __( 'Image', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Width', 'pawelem-companion' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 700,
                    ],
                ],
                'default'    => ['unit' => '%'],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-member-figure' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Height', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 100,
                        'max' => 700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-member-figure' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_bottom',
            [
                'label' => __( 'Bottom Spacing', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-member-figure' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'iamge_padding_body',
			[
				'label' => __( 'Padding Body', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pawelem-member-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_iamge_shadow',
				'label' => __( 'Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-member-figure',
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .pawelem-member-figure > img'
            ]
        );
      	$this->add_responsive_control(
			'iamge_border_redius',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => '%'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-member-figure > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Satrt Body
		$this->start_controls_section(
			'team_content_body_style',
			[
				'label' => __( 'Body', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//Body Tab Normal Start
		$this->start_controls_tabs('team_body_tabs',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);

		$this->start_controls_tab('team_body_tab_normal',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_tema_body_bg',
				'label' => __( 'Background', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .pawelem-team-singe',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'body_shadow',
				'label' => __( 'Box Shadow', 'pawelem-companio' ),
				'selector' => '{{WRAPPER}} .pawelem-team-singe',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => '_team_body_normal',
				'label' => __( 'Border', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-team-singe',
			]
		);
		$this->add_responsive_control(
			'_body_padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-singe' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_body_border_radius',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-singe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		//Body  Tab Hover Start
		$this->start_controls_tab('team_body_tab_jover',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_tema_body_bg_hover',
				'label' => __( 'Background', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .pawelem-team-singe:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'body_shadow_hover',
				'label' => __( 'Box Shadow', 'pawelem-companio' ),
				'selector' => '{{WRAPPER}} .pawelem-team-singe:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => '_team_body_hover',
				'label' => __( 'Border', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-team-singe:hover',
			]
		);
		$this->add_responsive_control(
			'_body_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-singe:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();

		// Start Content Body
		$this->start_controls_section(
			'team_content_style',
			[
				'label' => __( 'Content Body', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//Body Content Tab Normal Start
		$this->start_controls_tabs('team_content_tabs',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);

		$this->start_controls_tab('team_content_tab_normal',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_body_bg',
				'label' => __( 'Background', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .pawelem-team-body',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'label' => __( 'Box Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-team-body',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_normal',
				'label' => __( 'Border', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-team-body',
			]
		);

		$this->add_responsive_control(
			'_content_body_padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_content_body_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_content_body_border_radius',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab('team_content_tab_hover',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_body_bg_hover',
				'label' => __( 'Background', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .pawelem-team-wraper:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_shadow_hover',
				'label' => __( 'Box Shadow', 'pawelem-companio' ),
				'selector' => '{{WRAPPER}} .pawelem-team-wraper:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_normal_hover',
				'label' => __( 'Border', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-team-wraper:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Name Style
		$this->start_controls_section(
			'_team_membar_name',
			[
				'label' => __( 'Nmae', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//Body Content Tab Normal Start
		$this->start_controls_tabs('team_name_tabs',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);
		$this->start_controls_tab('team_name_tab_normal',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_team_membar_name',
				'label' => __( 'Typography', 'pawelem-companion' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}}  .pawelem-profile-name',
			]
		);
		$this->add_control(
			'_team_name_color',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-profile-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'_team_membar_name_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => '%'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-profile-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab('team_name_tab_hover',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_team_membar_name_hover',
				'label' => __( 'Typography', 'plugin-domain' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pawelem-profile-name:hover',
			]
		);
		$this->add_control(
			'_team_name_color_hover',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-team-singe:hover .pawelem-profile-name' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Name Style
		$this->start_controls_section(
			'_team_jot_title',
			[
				'label' => __( 'Job Title', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//Body Content Tab Normal Start
		$this->start_controls_tabs('team_job_title_tabs',
			[
				'label' => __( 'Job Title', 'pawelem-companion' ),
			]
		);
		$this->start_controls_tab('team_job_title_tab_normal',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_team_membar_job_title',
				'label' => __( 'Typography', 'pawelem-companion' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}}  .pawelem-job-title',
			]
		);
		$this->add_control(
			'_team_job_title_color',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-job-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'_team_membar_job_title_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  'px', '%','em' ],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab('team_job_title_hover',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_team_membar_job_title_hover',
				'label' => __( 'Typography', 'plugin-domain' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pawelem-job-title:hover',
			]
		);
		$this->add_control(
			'_team_job_title_color_hover',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-team-singe:hover .pawelem-job-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Short Bio Style
		$this->start_controls_section(
			'_team_short_bio',
			[
				'label' => __( 'Short Bio', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_short_bio' => 'yes'
				]
			]
		);
		//Body Content Tab Normal Start
		$this->start_controls_tabs('team_short_bio_tabs',
			[
				'label' => __( 'Short Bio', 'pawelem-companion' ),
			]
		);
		$this->start_controls_tab('team_short_bio_tab_normal',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_team_membar_short_bio_content',
				'label' => __( 'Typography', 'pawelem-companion' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}}  .pawelem-short-bio',
			]
		);
		$this->add_control(
			'_team_short_bio_color',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-short-bio' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'_team_membar_short_bio_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => '%'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-short-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab('team_short_bio_hover',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => '_team_membar_short_bio_hover',
				'label' => __( 'Typography', 'plugin-domain' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pawelem-short-bio:hover',
			]
		);
		$this->add_control(
			'_team_short_bio_color_hover',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-team-singe:hover .pawelem-short-bio' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'_team_porfile_icon_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => '%'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-team-singe:hover .pawelem-short-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Style Normal
		$this->start_controls_section(
			'_profile_link',
			[
				'label' => __( 'Social Profile', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pawelem_show_profiles'=> 'yes'
				]
			]
		);
		$this->start_controls_tabs('team_socail_profile_tabs',
			[
				'label' => __( 'Social Profile', 'pawelem-companion' ),
			]
		);
		$this->start_controls_tab('team_socailprofile_normal',
			[
				'label' => __( 'Normal', 'pawelem-companion' ),
			]
		);
		$this->add_control(
			'_team_socail_profile_color',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-membar-link > a i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_team_socail_profile_bg',
				'label' => __( 'Background', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .pawelem-membar-link > a',
			]
		);
		$this->add_responsive_control(
            '_team_socail_profile_font_size',
            [
                'label' => __( 'Size', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-membar-link > a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_team_socail_profile_height',
            [
                'label' => __( 'Image Height', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-membar-link > a img' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            '_team_socail_profile_width',
            [
                'label' => __( 'Image Width', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-membar-link > a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => '_team_profile_icon_border_normal',
				'label' => __( 'Border', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-membar-link > a',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_normal',
				'label' => __( 'Icon Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-membar-link > a',
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link > a' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_border_radius',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [  '%', 'px','em' ],
				'default'    => ['unit' => 'px'],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		//Start Hover
		$this->start_controls_tab('team_profile_hover',
			[
				'label' => __( 'Hover', 'pawelem-companion' ),
			]
		);
		$this->add_control(
			'_team_socail_profile_hover_color',
			[
				'label' => __( 'Color', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-membar-link > a:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => '_team_socail_profile_hover_bg',
				'label' => __( 'Background', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .pawelem-membar-link > a:hover',
			]
		);
		$this->add_responsive_control(
            '_team_socail_profile_font_size_hover',
            [
                'label' => __( 'Size', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-membar-link > a:hover' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            '_team_socail_profile_hover_height',
            [
                'label' => __( 'Image Height', 'pawelem-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pawelem-membar-link > a:hover img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => '_team_profile_icon_border_hover',
				'label' => __( 'Border', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-membar-link > a:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __( 'Icon Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-membar-link > a:hover',
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_margin_hover',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [   'px','%','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link > a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_padding_hover',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [   'px','%','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link > a:hover' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [   'px','%','em' ],
				'default'    => ['unit' => 'px'],

				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		//Porfile background normal
		
		$this->add_control('team_overly_color',
	        [
	            'label'         => __('Overly Show', 'pawelem-companion'),
	            'type'          => Controls_Manager::SWITCHER,
	            'description'   => __('Show Overly','pawelem-companion'),
	        ]
        );

		$this->start_controls_tabs('team_profile_bg',
			[
				'label' => __( 'profile Overly', 'pawelem-companion' ),
				'condition' => [
					'team_overly_color' => 'yes',
				],
			]
		);
		$this->start_controls_tab('_team_profile_overly',
			[
				'label' => __( 'profile Overly', 'pawelem-companion' ),
				'condition' => [
					'team_overly_color' => 'yes',
				],
			]

		);
		$this->add_control(
			'_team_socail_profile_overly_bg',
			[
				'label' => __( 'Background', 'pawelem-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pawelem-membar-link' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'pawelem-companion' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%' ],
				'default'    => ['unit' => '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .pawelem-membar-link' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => '_team_socail_profile_overly_border',
				'label' => __( 'Border', 'pawelem-companio' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .pawelem-membar-link',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_team_socail_profile_overly_box_shadow',
				'label' => __( 'Shadow', 'pawelem-companion' ),
				'selector' => '{{WRAPPER}} .pawelem-membar-link',
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_overly_padding',
			[
				'label' => __( 'Padding', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [   'px','%','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_overly_margin',
			[
				'label' => __( 'Margin', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [   'px','%','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'_team_socail_profile_overly_border_radius',
			[
				'label' => __( 'Border Radius', 'pawelem-companion' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [   'px','%','em' ],
				'default'    => ['unit' => 'px'],
				'selectors'  => [
					'{{WRAPPER}} .pawelem-membar-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$name      = $settings['profile_name'];
		$job_title = $settings['job_title'];
		$short_bio = $settings['short_bio'];
		$show_short_bio = $settings['show_short_bio'];
		$pawelem_profiles = $settings['pawelem_profiles'];
		$pawelem_show_profiles = $settings['pawelem_show_profiles'];

		$team_style = $settings['pawelem_team_style'];


		if ($team_style == 'style_one') {
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_one']);
		}elseif($team_style == 'style_two'){
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_two' ]);
		}elseif($team_style == 'style_three'){
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_three' ]);
		}elseif($team_style == 'style_four'){
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_four' ]);
		}elseif($team_style == 'style_five'){
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_five' ]);
		}elseif($team_style == 'style_six'){
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_six' ]);
		}elseif($team_style == 'style_seven'){
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe', 'style_seven' ]);
		}else{
			$this->add_render_attribute('team_style', 'class', ['pawelem-team-singe' ]);
		}
		

		$this->add_render_attribute('profile_name', 'class', 'pawelem-profile-name');
		$this->add_render_attribute('job_title',    'class', 'pawelem-job-title');
		$this->add_render_attribute('short_bio',    'class', 'pawelem-short-bio');
		$this->add_render_attribute('membar_link',  'class', 'pawelem-membar-link');

		?>

		<div class="pawelem-team-wraper">
			<div <?php $this->print_render_attribute_string('team_style') ?>>
					
				<?php if ( $settings['image']['url'] || $settings['image']['id'] ) :
				    $this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
				    $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
				    $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );?>
					<figure class="pawelem-member-figure"> 
		                <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
		            </figure>
	            <?php endif ?> 
				<div class="pawelem-team-body">

					<div class="team-content-wrap">
					<!-- name -->
					<?php if ($name): ?>
						<h3 <?php $this->print_render_attribute_string('profile_name') ?>>
							<?php echo esc_html($name) ?>	
						</h3>
					<?php endif ?>
						<!-- title -->
						<?php if ($job_title): ?>
							<h5 <?php $this->print_render_attribute_string('job_title') ?>>
								<?php echo esc_html($job_title) ?></h5>
						<?php endif ?>

						<!-- sub title -->
						<?php if ($short_bio && $show_short_bio): ?>
							<span <?php $this->print_render_attribute_string('short_bio') ?>>
								<?php echo pawelements_get_meta($short_bio) ?>
							</span>
						<?php endif ?>
					</div>
					<!-- profile links -->
					<?php if ($pawelem_show_profiles && is_array($pawelem_profiles)): ?>
						<div <?php $this->print_render_attribute_string('membar_link') ?>>
							<?php 
								foreach ($pawelem_profiles as $pawelem_profile):
									$icon = $pawelem_profile['team_icon'];
									$icon_image = $pawelem_profile['team_icon_img'];
                       				$img_url = wp_get_attachment_image( $icon_image['id'], 'thumbnail' );
                       				$url = esc_url( $pawelem_profile['link']['url'] );

                       				if ($icon) {
	                       					printf( '<a target="_blank" rel="noopener" data-tooltip="links" href="%s" class="elementor-repeater-item-%s"><i class="fa fa-%s" aria-hidden="true"></i></a>',
				                            $url,
				                            esc_attr( $pawelem_profile['_id'] ),
				                            esc_attr( $icon ),
			                        	);
                       				}else{
                       					printf(
                       					    '<a target="_blank" rel="noopener" data-tooltip="links" href="%s" class="elementor-repeater-item-%s">
                       					    	%s
                       					    </a>',
                       						$url,
                       						esc_attr( $pawelem_profile['_id'] ),
                       						$img_url,
                       					);
                       				}
								endforeach;
							 ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
		<?php

	}

}