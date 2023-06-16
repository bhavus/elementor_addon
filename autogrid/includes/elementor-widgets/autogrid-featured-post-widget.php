<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Checking Autogrid_Featured_Post_Widget class is exists or not.
 */
if( !class_exists('Autogrid_Featured_Post_Widget') ){

    /**
     * Autogrid_Featured_Post_Widget class is responsible for Feature Post Widget.
     *
     * @since 1.0.0
     */
    class Autogrid_Featured_Post_Widget extends \Elementor\Widget_Base {

        /**
         * Get Widget Name
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_name() {
            return __('Featured Post','autogrid');
        }

        /**
         * Get Widget Title
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_title() {
            return __('Featured Post','autogrid');
        }

        /**
         * Get Widget Icon
         *
         * @since 1.0.0
         *
         * @return string
         */
        public function get_icon() {
            return 'uael-icon-posts';
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
            return [ 'post', 'featured-post' ];
        }

        /**
         * Register All Settings controls.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function register_controls() {

            // style control
            $this->start_controls_section(
                'featured_post_general_style',
                array(
                    'label' => __( 'General', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_responsive_control(
                'featured_post_section_shadow',
                [
                    'label' => __('Box Shadow','autogrid'),
                    'type' => Controls_Manager::BOX_SHADOW,
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-container' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'background_color',
                [
                    'label' => __('Background color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-container' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'featured_post_title_style',
                array(
                    'label' => __( 'Title', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'featured_post_title_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F47920',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'featured_post_title_typography',
                    'selector' => '{{WRAPPER}} .autogrid-featured-post-title,{{WRAPPER}} .autogrid-featured-post-title a',
                ]
            );
            $this->add_responsive_control(
                'featured_post_title_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '1.75',
                        'bottom' => '0',
                        'left' => '1.75',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'featured_post_section_category_style',
                array(
                    'label' => __( 'Category', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'featured_post_category_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-category' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'featured_post_category_typography',
                    'selector' => '{{WRAPPER}} .autogrid-featured-post-category',
                ]
            );
            $this->add_responsive_control(
                'featured_post_category_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '1.75',
                        'bottom' => '0',
                        'left' => '1.75',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-category-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'featured_post_reading_style',
                array(
                    'label' => __( 'Reading time', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'featured_post_reading_time_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-read-time-wrapper' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'featured_post_reading_time_typography',
                    'selector' => '{{WRAPPER}} .autogrid-featured-post-read-time-wrapper',
                ]
            );
            $this->add_responsive_control(
                'featured_post_reading_time_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                            'top' => '1.75',
                            'bottom' => '1.75',
                            'left' => '1.75',
                            'right' => '0',
                            'unit' => 'em',
                        ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-featured-post-read-time-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            //end style control
        }

        /**
         * Display featured post html structure.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function render() {
            $term = get_queried_object();
            $autogrid_get_settings = autogrid_get_settings( 'general');
            $autogrid_featured_posts = !empty($autogrid_get_settings['featured_posts']) ? $autogrid_get_settings['featured_posts'] : array();
            $frontpage_id = get_option('page_on_front');
            if( (!empty( $frontpage_id ) && (int)get_the_ID() === (int)$frontpage_id) || is_front_page()){
                $post_id =  !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? $autogrid_featured_posts['home_page_featured_post'] : '';
            } elseif ( !empty( $term->taxonomy ) && !empty( $term->term_id ) && $term->taxonomy === 'category' ){
                $term_slug = !empty($term->slug) ? $term->slug : '';
                $term_id = !empty($term->term_id) ? $term->term_id : '';;
                $autogrid_cat_name = $term_slug.'-'.$term_id;
                $post_id =  ! empty( $autogrid_featured_posts[$autogrid_cat_name] ) ? $autogrid_featured_posts[$autogrid_cat_name] : '';
                $post_id = empty( $post_id ) && !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? !empty( $autogrid_featured_posts['home_page_featured_post'] ) : $post_id;
            }else{
                $post_id =  !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? $autogrid_featured_posts['home_page_featured_post'] : '';
            }
            if( empty( $post_id ) ){ ?>
                <div class="autogrid-main-container">
                </div>
            <?php } else {
                $categories = get_the_category($post_id);
                ?>
                <div class="autogrid-featured-post-container">
                    <a class="feature-post-link" href="<?php echo get_the_permalink($post_id); ?>">
                        <div class="autogrid-featured-post-thumbnail">
                            <?php echo get_the_post_thumbnail($post_id, 'large',array( 'class' => 'attachment-large size-large img featured-post-img' )); ?>
                        </div>
                        <div class="autogrid-featured-post-content">
                            <?php if( !empty( $categories ) && is_array($categories) ){ ?>
                                <div class="autogrid-featured-post-category-wrapper">
                                    <?php $count= 1;
                                    foreach ($categories as $post_term){
                                        $post_term_name = !empty($post_term->name) ? $post_term->name : '';
                                        if( !empty( $post_term_name ) && $count > 1){
                                            $post_term_name = ', '.$post_term_name;
                                        } ?>
                                        <span class="autogrid-featured-post-category"><?php echo !empty($post_term_name) ? esc_html($post_term_name) : ''; ?></span>
                                        <?php
                                        $count++;
                                    } ?>
                                </div>
                            <?php }?>
                            <div class="autogrid-featured-post-title-wrapper">
                                <div class="autogrid-featured-post-title"><?php echo get_the_title($post_id); ?></div>
                            </div>
                            <div class="autogrid-featured-post-read-time-wrapper">
                                <?php echo get_content_reading_time($post_id); ?>
                            </div>
                        </div>
                    </a>
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
