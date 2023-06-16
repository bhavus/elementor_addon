<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Checking Post_Author_Details_Widget class is exists or not.
 */
if( !class_exists('Post_Author_Details_Widget') ){
    /**
     * Post_Author_Details_Widget class is responsible for post author details Widget.
     *
     * @since 1.0.0
     */
    class Post_Author_Details_Widget extends \Elementor\Widget_Base {

        /**
         * Get Widget Name
         *
         * @since 1.0.0
         *
         * @return string|null
         */

        public function get_name() {
            return __('Author Detail','autogrid');
        }

        /**
         * Get Widget Title
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_title() {
            return __('Post Author Details','autogrid');
        }

        /**
         * Get Widget Icon
         *
         * @since 1.0.0
         *
         * @return string
         */
        public function get_icon() {
            return 'eicon-person';
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
            return [ 'author', 'post author' ];
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
                    'label' => __('Post Author Detail','autogrid'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'display_image',
                [
                    'label' => __('Display Image','autogrid'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'autogrid' ),
                    'label_off'    => __( 'Hide', 'autogrid' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'display_social_media',
                [
                    'label' => __('Display Social_media','autogrid'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'autogrid' ),
                    'label_off'    => __( 'Hide', 'autogrid' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'display_author_biography',
                [
                    'label' => __('Display Author Biography','autogrid'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'autogrid' ),
                    'label_off'    => __( 'Hide', 'autogrid' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->end_controls_section();

            // style control
            $this->start_controls_section(
                'section_general_style',
                array(
                    'label' => __( 'General', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'section_background_color',
                [
                    'label' => __('Background Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .elementor-author-details-widget' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'section_title_style',
                array(
                    'label' => __( 'Title', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'title_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F47920',
                    'selectors' => [
                        '{{WRAPPER}} .elementor-post-title-url' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .elementor-post-title-url',
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'section_designation_style',
                array(
                    'label' => __( 'Designation', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'designation_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .elementor-post-designation' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'designation_typography',
                    'selector' => '{{WRAPPER}} .elementor-post-designation',
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'section_social_icon_style',
                array(
                    'label' => __( 'Social icons', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'social_icon_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F47920',
                    'selectors' => [
                        '{{WRAPPER}} .elementor-social-icon' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->end_controls_section();
            $this->start_controls_section(
                'section_biography_style',
                array(
                    'label' => __( 'Biography', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'description_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .elementor-post-description' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .elementor-post-description',
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
                        '{{WRAPPER}} .elementor-post__excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_section();
            //end style control
        }

        /**
         * Display author details html structure.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function render() {
            global $post;

            $post_id = !empty( $post->ID ) ? $post->ID : '';
            if( ! empty( $post_id ) && function_exists('get_field') ){

                $settings = $this->get_settings_for_display();
                $post_author_term = wp_get_post_terms($post_id,'blog-author');
                $post_author_term = !empty( $post_author_term[0] ) ? $post_author_term[0] : (object)array();
                if( ! empty( $post_author_term ) && isset($post_author_term->name) && isset($post_author_term->term_id) ){

                    $author_name = !empty( $post_author_term->name ) ? esc_html($post_author_term->name) : "";
                    $author_id = !empty( $post_author_term->term_id ) ? (int)$post_author_term->term_id : "";
                    $author_designation = get_field('title', $post_author_term);
                    $author_biography = get_field('biography', $post_author_term);
                    $author_linkedin_url = get_field('linkedin_url', $post_author_term);
                    $author_twitter_url = get_field('twitter_url', $post_author_term);
                    $author_website_url = get_field('website_url', $post_author_term);
                    $author_headshot_image = get_field('headshot_image', $post_author_term);
                    $post_term_link = !empty(get_term_link($author_id)) ? esc_url(get_term_link($author_id)) : '';
                    $author_image_alt = !empty( $author_headshot_image['alt'] ) ? $author_headshot_image['alt'] : "";
                    $author_image_id = !empty( $author_headshot_image['id'] ) ? $author_headshot_image['id'] : "";
                    $author_headshot_image = !empty( $author_headshot_image['sizes']['medium'] ) ? $author_headshot_image['sizes']['medium'] : AUTOGRID_PATH."/assets/images/no-image.jpg";
                    $author_image_width = !empty( $author_headshot_image['sizes']['medium-width'] ) ? $author_headshot_image['sizes']['medium-width'] : 200;
                    $author_image_height = !empty( $author_headshot_image['sizes']['medium-height'] ) ? $author_headshot_image['sizes']['medium-height'] : 200;

                    $social_icon = !empty( $settings['social_icon_color'] ) ? $settings['social_icon_color'] : '';
                    ?>
                    <div class="elementor-element elementor-author-details-widget elementor-widget">
                        <div class="elementor-posts-container elementor-grid">
                            <article class="elementor-post elementor-author-details-item post-<?php echo !empty($author_id) ? $author_id : '';?>">
                                <?php if (!empty( $settings['display_image'] ) && $settings['display_image'] === 'yes'){ ?>
                                    <div class="elementor-post__thumbnail post-author-details-thumbnail elementor-fit-height">
                                        <img width="<?php echo esc_attr($author_image_width); ?>" height="<?php echo esc_attr($author_image_height); ?>" src="<?php echo !empty($author_headshot_image) ? esc_url($author_headshot_image) : ''; ?>" class="attachment-medium size-medium wp-image-<?php echo esc_attr($author_image_id); ?>" alt="<?php echo esc_attr($author_image_alt); ?>" loading="lazy">
                                    </div>
                                <?php } ?>
                                <div class="elementor-author-details-text">
                                    <div class="author-detail-head">
                                        <div class="author-title-section">
                                            <h5 class="elementor-post__title">
                                                <a class="elementor-post-title-url" href="<?php echo !empty($post_term_link) ? esc_url($post_term_link) : ''; ?>">
                                                    <?php echo !empty($author_name) ? esc_html($author_name) : ''; ?>
                                                </a>
                                            </h5>
                                            <div class="elementor-post__meta-data">
                                                <span class="elementor-post-designation"><?php echo !empty($author_designation) ? wp_kses_post($author_designation) : ''; ?></span>
                                            </div>
                                        </div>
                                        <?php if(!empty( $settings['display_social_media'] ) && $settings['display_social_media'] === 'yes'){ ?>
                                            <div class="author-social-media">
                                                <?php
                                                if(!empty($author_linkedin_url)){ ?>
                                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-linkedin elementor-repeater-item-<?php echo !empty($social_icon) ? $social_icon : ''; ?>" href="<?php echo esc_url($author_linkedin_url); ?>">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                <?php }
                                                if(!empty($author_twitter_url)){ ?>
                                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-twitter elementor-repeater-item-<?php echo !empty($social_icon) ? $social_icon : ''; ?>" href="<?php echo esc_url($author_twitter_url); ?>">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                <?php }
                                                if(!empty($author_website_url)){ ?>
                                                    <a class="elementor-icon elementor-social-icon elementor-social-icon-link elementor-repeater-item-<?php echo !empty($social_icon) ? $social_icon : ''; ?>" href="<?php echo esc_url($author_website_url); ?>">
                                                        <i class="fas fa-link"></i>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if( !empty( $settings['display_author_biography'] ) && $settings['display_author_biography'] === 'yes' ){ ?>
                                        <div class="elementor-post__excerpt">
                                            <p class="elementor-post-description"><?php echo !empty($author_biography) ? wp_kses_post($author_biography) : ''; ?></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </article>
                        </div>
                    </div>
                    <?php
                }
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
