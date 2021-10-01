<?php
namespace YoloElementorWidgets\Widgets\Merch_Products;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Yolo_Merch_Products extends Widget_Base {

	public function get_name() {
		return 'yolo-merch-products';
	}

	public function get_title() {
		return __( 'Merch Products', 'text-domain' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'woocommerce-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'text-domain' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'text-domain' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'text-domain' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'text-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'text-domain' ),
					'uppercase' => __( 'UPPERCASE', 'text-domain' ),
					'lowercase' => __( 'lowercase', 'text-domain' ),
					'capitalize' => __( 'Capitalize', 'text-domain' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
        ?>
        <div class="elementor-merch-products">
            <div class="merch-products">
                <div class="col-cateogry">
                    Category
                </div>

                <div class="col-products">
                    Products list
                </div>
            </div>
        </div>
        <?php 
	}

	protected function content_template() {

	}
}
