<?php
// We check if the Elementor plugin has been installed / activated.
if ( ! in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return;
}

/**
 * Checking Autogrid_Elementor_Widgets class is exists or not.
 */
if( !class_exists('Autogrid_Elementor_Widgets') ){

    /**
     * Autogrid_Elementor_Widgets class is responsible for all autogrid custom elementor widgets.
     *
     * @since 1.0.0
     */
    class Autogrid_Elementor_Widgets {

        /**
         * Define the functionality of elementor widget in plugin.
         */
        public function __construct() {
            add_action( 'elementor/widgets/register', array( $this, 'register_elementor_widgets') );
        }

        /**
         * Register custom elementor widgets.
         *
         * @since 1.0.0
         *
         * @param $widgets_manager
         * @return void
         */
        public function register_elementor_widgets( $widgets_manager ) {

            require_once AUTOGRID_PATH . 'includes/elementor-widgets/autogrid-latest-post-widget.php';
            require_once AUTOGRID_PATH . 'includes/elementor-widgets/autogrid-featured-post-widget.php';
            require_once AUTOGRID_PATH . 'includes/elementor-widgets/autogrid-category-cta-widgets.php';
            require_once AUTOGRID_PATH . 'includes/elementor-widgets/post-reading-time-widget.php';
            require_once AUTOGRID_PATH . 'includes/elementor-widgets/post-author-details-widget.php';
            require_once AUTOGRID_PATH . 'includes/elementor-widgets/post-author-widget.php';

            $widgets_manager->register( new \Autogrid_Latest_Posts_Widget() );
            $widgets_manager->register( new \Autogrid_Featured_Post_Widget() );
            $widgets_manager->register( new \Autogrid_Category_CTA_Widget() );
            $widgets_manager->register( new \Post_Reading_Time_Widget() );
            $widgets_manager->register( new \Post_Author_Details_Widget() );
            $widgets_manager->register( new \Post_Author_Widget() );

        }

    }

    new Autogrid_Elementor_Widgets();
}