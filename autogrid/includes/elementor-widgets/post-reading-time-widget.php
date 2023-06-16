<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

/**
 * Checking Post_Reading_Time_Widget class is exists or not.
 */
if( !class_exists('Post_Reading_Time_Widget') ){
    /**
     * Post_Reading_Time_Widget class is responsible for Post reading time Widget.
     *
     * @since 1.0.0
     */
    class Post_Reading_Time_Widget extends \Elementor\Widget_Base {

        /**
         * Get Widget Name
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_name() {
            return __('Reading Time','autogrid');
        }

        /**
         * Get Widget Title
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_title() {
            return __('Post Reading time','autogrid');
        }

        /**
         * Get Widget Icon
         *
         * @since 1.0.0
         *
         * @return string
         */
        public function get_icon() {
            return 'eicon-countdown';
        }

        /**
         * Get Widget Category
         *
         * @since 1.0.0
         *
         * @return string[]
         */
        public function get_categories() {
            return [ 'basic' ];
        }

        /**
         * Get Widget Keywords
         *
         * @since 1.0.0
         *
         * @return string[]
         */
        public function get_keywords() {
            return [ 'post' ];
        }

        /**
         * Register All Settings controls.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function register_controls() {

            $this->start_controls_section(
                'Content',
                [
                    'label' => __('Post Reading time','autogrid'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'reading_time_icon',
                [
                    'label' => esc_html__( 'Active Icon', 'elementor' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon_active',
                    'default' => [
                        'value' => 'fas fa-stopwatch',
                        'library' => 'fa-solid',
                    ]
                ]
            );
            $this->end_controls_section();
            // style control
            $this->start_controls_section(
                'section_style',
                [
                    'label' => __('Style','autogrid'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );
            $this->add_control(
                'background_color',
                [
                    'label' => __('Background color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post-reading-time-container' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'description_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#CCCCCC',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-post-reading-time' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'icon_color',
                [
                    'label' => __('Icon color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#CCCCCC',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-reading-time-icon svg' => 'fill: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .autogrid-post-reading-time',
                ]
            );
            $this->add_responsive_control(
                'distance',
                [
                    'label' => __('Distance','autogrid'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                        ]
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                        'size' => 1.563,
                        'unit' => 'em',
                    ],
                    'tablet_default' => [
                        'size' => 1.563,
                        'unit' => 'em',
                    ],
                    'mobile_default' => [
                        'size' => 0.625,
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-post-reading-time' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            //end style control
        }

        /**
         * Display reading time widget html structure.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function render() {
            global $post;
            $post_id = !empty( $post->ID ) ? $post->ID : '';
            if( empty( $post_id ) ){ ?>
            <?php } else {
                $settings = $this->get_settings_for_display();
                $icon_html = Icons_Manager::try_get_icon_html( $settings['reading_time_icon'], [ 'aria-hidden' => 'true' ] );
                ?>
                <div class="post-reading-time-container">
                    <p class="autogrid-post-reading-time"><?php if(!empty( $icon_html )){ ?><span class="autogrid-reading-time-icon"><?php echo $icon_html.' '; ?></span> <?php } echo get_content_reading_time($post_id); ?></p>
                </div>
                <?php
            }
        }

        /**
         * Display preview in elementor edit screen.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function content_template() {

        }

    }
}
