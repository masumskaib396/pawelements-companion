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

class Pawelements_Accordion extends \Elementor\Widget_Base{

	public function get_name(){
		return 'pawelem_accordion';
	}

	public function get_title(){
		return __('Pawelements Accordion ', 'pawelem-companion');
	}

	public function get_icon(){
		return ('eicon-accordion');
	}

	public function get_categories(){
		return ['pawelements'];
	}
	public function get_keywords(){
		return ['accordion', 'tab'];
	}

	protected function _register_controls(){

		$this->start_controls_section('accordion_section',
			[
				'label' => __( 'Accordion', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'accordion_title', [
				'label' => __( 'Title', 'pawelem-companion' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
            'paw_acc_is_active',
            [
                'label' => esc_html__('Keep this slide open? ', 'pawelem-companion'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'pawelem-companion' ),
                'label_off' =>esc_html__( 'No', 'pawelem-companion' ),
            ]
        );
		$repeater->add_control(
			'accordion_content', [
				'label' => __( 'Description', 'pawelem-companion' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->add_control(
			'pawele_accordion_items',
			[
				'label' => __( 'Logo List', 'pawelem-companion' ),
				'type' =>    Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'accordion_title' => __('Where is the event location? ', 'pawelem-companion'),
						'accordion_content' => __( 'Incididunt nostrud id eu voluptate qui enim ut fugiat est amet ipsum. Sunt dolore sint aliqua pariatur labore aliquip.', 'pawelem-companion' ),
					],[
						'accordion_title' => __('Where is the event location? ', 'pawelem-companion'),
						'accordion_content' => __( 'Incididunt nostrud id eu voluptate qui enim ut fugiat est amet ipsum. Sunt dolore sint aliqua pariatur labore aliquip.', 'pawelem-companion' ),
					],[
						'accordion_title' => __('Where is the event location? ', 'pawelem-companion'),
						'accordion_content' => __( 'Incididunt nostrud id eu voluptate qui enim ut fugiat est amet ipsum. Sunt dolore sint aliqua pariatur labore aliquip.', 'pawelem-companion' ),
					],[
						'accordion_title' => __('Where is the event location? ', 'pawelem-companion'),
						'accordion_content' => __( 'Incididunt nostrud id eu voluptate qui enim ut fugiat est amet ipsum. Sunt dolore sint aliqua pariatur labore aliquip.', 'pawelem-companion' ),
					],

				],
				
			]
		);
		$this->end_controls_section();


		$this->start_controls_section('accordion_icon_image',
			[
				'label' => __( 'Accordion Icon Image', 'pawelem-companion' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		if ( pawelem_is_elementor_version( '<', '2.6.0' ) ) {
			$this->add_control(
	            'pawlele_a_icon',
	            [
	                'label' => esc_html__( 'Right Icon', 'pawelem-companion' ),
	                'type' => Controls_Manager::ICON,
	                
	            ]
	    	);
	    	$condition = ['pawlele_a_icon!' => ''];
    	}else{
    		$this->add_control(
			 	'pawlele_as_icons',
	            [
	                'label' => esc_html__( 'Right Icon', 'pawelem-companion' ),
	                'type' => Controls_Manager::ICONS,
	                'fa4compatibility' => 'pawlele_a_icon',

	            ]
            );
            $condition = ['pawlele_as_icons[value]!' => ''];
		 };

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'pawelem-companion' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();



	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$accordion_contents = $settings['pawele_accordion_items'];
        $acc_id = uniqid();


        

		?>
		<div class="tpw-evt-accordion-section">
			<div class="accordion" id="tpw-accordion">
				<div class="accordion-content">
					<?php foreach ($accordion_contents as $i => $accordion_content):

						$is_active = ($accordion_content['paw_acc_is_active'] == 'yes') ? 'show collapse' : 'collapse';

						$card__active = ($accordion_content['paw_acc_is_active'] == 'yes') ? 'card card__active' : 'card';

					 ?>
						<div class="card">
							<div class="card-header" id="heading-<?php echo esc_attr($i); ?>">
								<h2 class="mb-0">
									<a class="tpw-tab-title" href="<?php echo esc_attr($accordion_content['_id'].$acc_id) ?>" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($accordion_content['_id'].$acc_id) ?>" aria-expanded="<?php echo esc_attr($is_active);  ?>" aria-controls="collapse-<?php echo esc_attr($accordion_content['_id'].$acc_id) ?>">
									<?php echo esc_html($accordion_content['accordion_title']) ?> 
									<span class="tpw-tab-question-icon"><img src="img/question.png" alt=""></span>
									
									<span class="tpw-tab-plus-icon">	
										<?php pawelem_render_icon( $settings, 'pawlele_a_icon', 'pawlele_as_icons' ); ?>
									</span>
									</a>
								</h2>
							</div>
							<div id="collapse-<?php echo esc_attr($accordion_content['_id'].$acc_id) ?>" class="<?php echo esc_attr($is_active);  ?>" aria-labelledby="heading-<?php echo esc_attr($i) ?>" data-parent="#tpw-accordion">
								<div class="card-body">
								<?php echo pawelements_get_meta($accordion_content['accordion_content']) ?>
								</div>
							</div>
						</div>
					<?php endforeach ?>

					
				</div>
			</div>
		</div><!--End tpw-evt-accordion-section -->
		<?php

	}

}