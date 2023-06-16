<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Checking Autogrid_Latest_Posts_Widget class is exists or not.
 */
if( !class_exists('Autogrid_Latest_Posts_Widget') ){
    /**
     * Autogrid_Latest_Posts_Widget class is responsible for latest Post author image and name Widget.
     *
     * @since 1.0.0
     */
    class Autogrid_Latest_Posts_Widget extends \Elementor\Widget_Base {

        /**
         * Get Widget Name
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_name() {
            return __('Latest Posts','autogrid');
        }

        /**
         * Get Widget Title
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_title() {
            return __('Latest Posts','autogrid');
        }

        /**
         * Get Widget Icon
         *
         * @since 1.0.0
         *
         * @return string
         */
        public function get_icon() {
            return 'eicon-posts-grid';
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
            return [ 'post', 'latest posts' ];
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
                    'label' => __('Latest Posts','autogrid'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'latest_post_title',
                [
                    'label' => __('Title','autogrid'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Latest Posts','autogrid'),
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'latest_post_per_page',
                [
                    'label' => __('Post Per Page','autogrid'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3,
                    'min' => 0,
                    'max' => 4,
                    'placeholder' => 1,
                    'responsive' => true,
                ]
            );
            $this->end_controls_section();

            $this->start_controls_section(
                'latest_post_general_style',
                array(
                    'label' => __( 'General', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'latest_post_heading_color',
                [
                    'label' => __('Heading Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-heading' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'latest_post_heading_typography',
                    'selector' => '{{WRAPPER}} .autogrid-latest-post-heading',
                ]
            );
            $this->add_control(
                'background_color',
                [
                    'label' => __('Background color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-wrapper' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'card_background_color',
                [
                    'label' => __('Card background color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-article' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'latest_post_article_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '0',
                        'bottom' => '0',
                        'left' => '0',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'latest_post_article_margin',
                [
                    'label' => __('Margin','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '1',
                        'bottom' => '0',
                        'left' => '0',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'latest_post_title_style',
                array(
                    'label' => __( 'Title', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'latest_post_title_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'latest_post_title_typography',
                    'selector' => '{{WRAPPER}} .autogrid-latest-post-title',
                ]
            );
            $this->add_responsive_control(
                'latest_post_title_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '0.938',
                        'bottom' => '0',
                        'left' => '0',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'latest_post_section_category_style',
                array(
                    'label' => __( 'Category', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'latest_post_category_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F47920',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-category' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'latest_post_category_typography',
                    'selector' => '{{WRAPPER}} .autogrid-latest-post-category',
                ]
            );
            $this->add_responsive_control(
                'latest_post_category_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '0.938',
                        'bottom' => '0',
                        'left' => '0',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-category-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'latest_post_reading_style',
                array(
                    'label' => __( 'Reading time', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'latest_post_reading_time_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#CCCCCC',
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-read-time-wrapper' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'latest_post_reading_time_typography',
                    'selector' => '{{WRAPPER}} .autogrid-latest-post-read-time-wrapper',
                ]
            );
            $this->add_responsive_control(
                'latest_post_reading_time_padding',
                [
                    'label' => __('Padding','autogrid'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', 'rem', '%' ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'default' => [
                        'top' => '0.938',
                        'bottom' => '0.938',
                        'left' => '0',
                        'right' => '0',
                        'unit' => 'em',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .autogrid-latest-post-read-time-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
        }

        /**
         * Display featured post html structure.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function render() {
            $settings = $this->get_settings_for_display();
            $post_per_page = !empty( $settings['latest_post_per_page'] ) ? (int)$settings['latest_post_per_page'] : 3;
            $term = get_queried_object();
            $autogrid_get_settings = autogrid_get_settings( 'general');
            $autogrid_featured_posts = !empty($autogrid_get_settings['featured_posts']) ? $autogrid_get_settings['featured_posts'] : array();
            $frontpage_id = get_option('page_on_front');
            if( (!empty( $frontpage_id ) && (int)get_the_ID() === (int)$frontpage_id) || is_front_page()){
                $featured_post_id =  !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? $autogrid_featured_posts['home_page_featured_post'] : '';
            }elseif ( !empty( $term->taxonomy ) && !empty( $term->term_id ) && $term->taxonomy === 'category' ){
                $term_slug = !empty($term->slug) ? $term->slug : '';
                $term_id = !empty($term->term_id) ? $term->term_id : '';;
                $autogrid_cat_name = $term_slug.'-'.$term_id;
                $featured_post_id =  ! empty( $autogrid_featured_posts[$autogrid_cat_name] ) ? $autogrid_featured_posts[$autogrid_cat_name] : '';
                $featured_post_id = empty( $featured_post_id ) && !empty( $autogrid_featured_posts['home_featured_post'] ) ? !empty( $autogrid_featured_posts['home_featured_post'] ) : $featured_post_id;
            }else{
                $featured_post_id =  !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? $autogrid_featured_posts['home_page_featured_post'] : '';
            }

            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $post_per_page,
				'latest_post_excluded' => true,
            );

            if( !empty( $featured_post_id ) ){
                $args['post__not_in'] = (array)$featured_post_id;
            }

            $latest_posts = new \WP_Query( $args );
            ?>
            <div class="autogrid-latest-post-wrapper">
                <?php if( !empty($settings['latest_post_title']) ){ ?>
                    <h2 class="autogrid-latest-post-heading"><?php echo esc_html($settings['latest_post_title']); ?></h2>
                    <?php
                }
                if ($latest_posts->have_posts()) {
                    while($latest_posts->have_posts() ) {
                        $latest_posts->the_post();
                        $post_id = get_the_ID();
                        $categories = get_the_category($post_id);
                        $post_permalink = get_the_permalink();
                        $post_title = get_the_title();
                        ?>
                        <article class="autogrid-latest-post-article">
                            <a class="autogrid-latest-post-link" href="<?php echo !empty( $post_permalink ) ? esc_url($post_permalink) : '#'; ?>">
                                <div class="autogrid-latest-post-content-wrapper">
                                    <div class="autogrid-latest-post-thumbnail">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'medium'); ?>
                                    </div>
                                    <div class="autogrid-latest-post-content">
                                        <?php if( !empty( $categories ) && is_array($categories) ){
                                            $post_term = $categories[0] ? $categories[0] : (object)array();?>
                                            <div class="autogrid-latest-post-category-wrapper">
                                                <?php
                                                $post_term_name = !empty($post_term->name) ? $post_term->name : ''; ?>
                                                <span class="autogrid-latest-post-category"><?php echo !empty($post_term_name) ? esc_html($post_term_name) : ''; ?></span>
                                            </div>
                                        <?php }?>
                                        <div class="autogrid-latest-post-title-wrapper">
                                            <h5 class="autogrid-latest-post-title"><?php echo strlen($post_title) > 60 ? substr( $post_title, 0, 57 ).'...' : $post_title; ?></h5>
                                        </div>
                                        <div class="autogrid-latest-post-read-time-wrapper">
                                            <?php echo get_content_reading_time($post_id); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                        <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
            <?php
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
