<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Checking Post_Author_Widget class is exists or not.
 */
if( !class_exists('Post_Author_Widget') ){
    /**
     * Post_Author_Widget class is responsible for post author image and name Widget.
     *
     * @since 1.0.0
     */
    class Post_Author_Widget extends \Elementor\Widget_Base {

        /**
         * Get Widget Name
         *
         * @since 1.0.0
         *
         * @return string|null
         */

        public function get_name() {
            return __('Post Author','autogrid');
        }

        /**
         * Get Widget Title
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_title() {
            return __('Post Author','autogrid');
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
         * Register All Settings Controls.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function register_controls() {

            $this->start_controls_section(
                'Content',
                [
                    'label' => __('Post Author','autogrid'),
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
                'author_link',
                [
                    'label' => __('Add Author Link','autogrid'),
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
                'section_title_style',
                array(
                    'label' => __( 'Title', 'autogrid' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );
            $this->add_control(
                'background_color',
                [
                    'label' => __('Background color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .elementor-post-author-widget' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label' => __('Color','autogrid'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#656366',
                    'selectors' => [
                        '{{WRAPPER}} .elementor-post-title-url,{{WRAPPER}} .elementor-post__title' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .elementor-post-title-url,{{WRAPPER}} .elementor-post__title',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ]
                ]
            );
            $this->end_controls_section();
            //end style control
        }

        /**
         * Display author name and image widget html structure.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function render() {
            global $post;
            $post_id = !empty( $post->ID ) ? $post->ID : '';
            if( !empty( $post_id ) && function_exists('get_field') ){
                $settings = $this->get_settings_for_display();
                $post_author_term = wp_get_post_terms($post_id,'blog-author');
                $post_author_term = !empty( $post_author_term[0] ) ? $post_author_term[0] : (object)array();
                if( !empty( $post_author_term ) && isset($post_author_term->name) && isset($post_author_term->term_id) ){
                    $author_name = !empty( $post_author_term->name ) ? esc_html($post_author_term->name) : "";
                    $author_id = !empty( $post_author_term->term_id ) ? (int)$post_author_term->term_id : "";
                    $author_headshot_image = get_field('headshot_image', $post_author_term);
                    $post_term_link = !empty(get_term_link($author_id)) ? esc_url(get_term_link($author_id)) : '';
                    $author_image_alt = !empty( $author_headshot_image['alt'] ) ? $author_headshot_image['alt'] : "";
                    $author_image_id = !empty( $author_headshot_image['id'] ) ? $author_headshot_image['id'] : "";
                    $author_image_width = !empty( $author_headshot_image['sizes']['medium-width'] ) ? $author_headshot_image['sizes']['medium-width'] : 200;
                    $author_image_height = !empty( $author_headshot_image['sizes']['medium-height'] ) ? $author_headshot_image['sizes']['medium-height'] : 200;
                    $author_headshot_image_medium = !empty( $author_headshot_image['sizes']['medium'] ) ? $author_headshot_image['sizes']['medium'] : AUTOGRID_PATH."/assets/images/no-image.jpg";
                    ?>
                    <div class="elementor-element elementor-post-author-widget elementor-widget">
                        <article class="elementor-post elementor-post-author-item post-<?php echo !empty($author_id) ? $author_id : '';?>">
                            <?php if (!empty( $settings['display_image'] ) && $settings['display_image'] === 'yes'){ ?>
                                <div class="elementor-post__thumbnail post-author-thumbnail elementor-fit-height">
                                    <img width="<?php echo esc_attr($author_image_width); ?>" height="<?php echo esc_attr($author_image_height); ?>" src="<?php echo !empty($author_headshot_image_medium) ? esc_url($author_headshot_image_medium) : ''; ?>" class="attachment-thumbnail size-small wp-image-<?php echo esc_attr($author_image_id); ?>" alt="<?php echo esc_attr($author_image_alt); ?>" loading="lazy">
                                </div>
                            <?php } ?>
                            <div class="elementor-post-author-text">
                                <h5 class="elementor-post__title">
                                    <?php if (!empty( $settings['author_link'] ) && $settings['author_link'] === 'yes'){ ?>
                                        <a class="elementor-post-title-url" href="<?php echo !empty($post_term_link) ? esc_url($post_term_link) : '#'; ?>">
                                    <?php }
                                        echo !empty($author_name) ? esc_html($author_name) : '';
                                    if (!empty( $settings['author_link'] ) && $settings['author_link'] === 'yes'){ ?>
                                        </a>
                                    <?php } ?>
                                </h5>
                            </div>
                        </article>
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
