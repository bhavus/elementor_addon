<?php
use Elementor\Widget_Base;

/**
 * Checking Autogrid_Category_CTA_Widget class is exists or not.
 */
if( !class_exists('Autogrid_Category_CTA_Widget') ){

    /**
     * Autogrid_Category_CTA_Widget class is responsible for Category CTA Widget.
     *
     * @since 1.0.0
     */
    class Autogrid_Category_CTA_Widget extends \Elementor\Widget_Base {

        /**
         * Get Widget Name
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_name() {
            return __('Category CTA','autogrid');
        }

        /**
         * Get Widget Title
         *
         * @since 1.0.0
         *
         * @return string|null
         */
        public function get_title() {
            return __('Category CTA','autogrid');
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
            return [ 'cta', 'category-cta','elementor-cta' ];
        }

        /**
         * Register All Settings controls.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function register_controls() {

        }

        /**
         * Display category CTA html structure.
         *
         * @since 1.0.0
         *
         * @return void
         */
        protected function render() {
            $term = get_queried_object();
            $autogrid_get_settings = autogrid_get_settings( 'general');
            $autogrid_category_cta = !empty($autogrid_get_settings['category_cta']) ? $autogrid_get_settings['category_cta'] : array();
            $post_id = '';
            if ( !empty( $term->taxonomy ) && !empty( $term->term_id ) && $term->taxonomy === 'category' ){
                $term_slug = !empty($term->slug) ? $term->slug : '';
                $term_id = !empty($term->term_id) ? $term->term_id : '';
                $autogrid_cat_cta_name = $term_slug . '-' . $term_id.'-cta';
                $post_id =  ! empty( $autogrid_category_cta[$autogrid_cat_cta_name] ) ? $autogrid_category_cta[$autogrid_cat_cta_name] : '';
            }
            if( !empty( $post_id ) && (int)$post_id > 0 ){
                $short_code = "[elementor-template id=".$post_id."]";
                ?>
                <div class="autogrid-category-cta-container">
                    <?php echo do_shortcode($short_code)?>
                </div>
            <?php } else { ?>
                <div class="autogrid-category-cta-container">
                    <p><?php _e("Element not found.","autogrid"); ?></p>
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
