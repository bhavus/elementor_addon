<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check autogrid class_exists or not.
 */
if ( ! class_exists( 'autogrid' ) ) {

    /**
     * The core plugin class.
     *
     * This is used to define internationalization, admin-specific hooks, and
     * public-facing site hooks.
     *
     * Also maintains the unique identifier of this plugin as well as the current
     * version of the plugin.
     *
     * @since      1.0.0
     */
    class autogrid {

        /**
         * The instance of this class. 
         */
        private static $instance;

        public static function get_instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof autogrid ) ) {
                self::$instance = new autogrid;
                self::$instance->includes();
                self::$instance->setup_actions();
            }

            return self::$instance;
        }

        /**
         * Define the core functionality of the plugin.
         */
        private function __construct() {
            self::$instance = $this;
        }

        private function includes() {
            
            /**
             * The function responsible for all common function of this plugin.
             */
            require_once AUTOGRID_PATH . '/includes/functions.php';

            /**
             * The class responsible for all elementor custom widgets.
             */
            require_once AUTOGRID_PATH . 'includes/elementor-widgets/class-autogrid-widgets.php';

            /**
             * The class responsible for defining all actions that occur in the admin area.
             */
            require_once AUTOGRID_PATH . '/admin/class-autogrid-admin.php';

            /**
             * The class responsible for defining all settings fields occur in the admin area.
             */
            require_once AUTOGRID_PATH . '/admin/class-autogrid-settings.php';
        }

        /**
         * Setup actions.
         */
        private function setup_actions() {
            
            $pluing_name = AUTOGRID_PLUGIN_BASENAME;
            add_action( "plugin_action_links_{$pluing_name}", array($this ,'plugin_settings_link'));
            add_action( 'admin_init', array($this,'activation_redirect'));
            add_action( 'admin_enqueue_scripts', array($this,'enqueue_admin_scripts'));
            add_action( 'wp_enqueue_scripts', array($this,'enqueue_public_scripts'));
            add_action( 'init', array($this,'load_textdomain'));
            add_action( 'add_meta_boxes', array($this,'autogrid_register_meta_boxes'));
            add_action( 'save_post', array($this,'save_meta_boxes'));
            add_action( 'after_setup_theme', array($this,'autogrid_theme_setup'));
            add_filter( 'image_size_names_choose', array($this,'register_image_custom_sizes'));
            add_filter( 'rest_prepare_taxonomy', array($this,'remove_blog_meta_taxonomy'),10,3);
            add_action( 'pre_get_posts', array($this,'exclude_featured_post'));
            add_shortcode( 'get_year', array($this,'get_year_cb'));
            add_filter( 'the_author', array($this, 'update_the_author_name'),100);
            //add_filter( 'user_trailingslashit', array($this, 'remove_category_prefix'), 99, 2);
        }

        /**
         * Settings for plugin link.
         *
         * @since 1.0.0
         *
         * @param $links
         * @return array|string[]
         */
        public function plugin_settings_link( $links ) {

            $action_links = array(
                'settings' => '<a href="' . admin_url( 'admin.php?page='.AUTOGRID_MENU_SLUG ) . '" aria-label="' . __( 'Settings', 'autogrid' ) . '">' . esc_html__( 'Settings', 'autogrid' ) . '</a>',
            );

            return array_merge( $action_links, $links );
        }

        /**
         * Activation redirect.
         */
        public function activation_redirect() {

            if ( !get_transient( '_autogrid_activation_redirect' ) ) {
                return;
            }
    
            delete_transient( '_autogrid_activation_redirect' );
    
            wp_safe_redirect( admin_url( 'admin.php?page='.AUTOGRID_MENU_SLUG ) );
            exit;
        }

        /**
         * Register the JavaScript and Style for the admin area.
         *
         * @since    1.0.0
         */
        public function enqueue_admin_scripts() {
            
            if( !empty( $_GET['page'] ) && sanitize_text_field($_GET['page']) === AUTOGRID_MENU_SLUG ){
                wp_enqueue_style('select2-style', AUTOGRID_PLUGIN_URL.'assets/css/select2.min.css');
                wp_enqueue_script( 'select2-script', AUTOGRID_PLUGIN_URL . 'assets/js/select2.min.js', array( 'jquery'), '', true );
                wp_enqueue_script( 'autogrid-admin-js', AUTOGRID_PLUGIN_URL . 'assets/js/autogrid-admin.js', array( 'jquery'), '1.0.2', true );
                wp_localize_script(
                    'autogrid-admin-js',
                    'autogrid_object',
                    array(
                        'ajax_url' => admin_url( 'admin-ajax.php' )
                    )
                );

            }
        }

        /**
         * Register the JavaScript and Style for the Public area.
         *
         * @since    1.0.0
         */
        public function enqueue_public_scripts(){
            wp_enqueue_style('autogrid-public-css',AUTOGRID_PLUGIN_URL.'assets/css/autogrid-style.css',array(),'','all');
            wp_enqueue_style('autogrid-slick-css',AUTOGRID_PLUGIN_URL.'assets/css/slick.min.css',array(),'','all');
            wp_enqueue_style('autogrid-slick-theme-css',AUTOGRID_PLUGIN_URL.'assets/css/slick-theme.min.css',array(),'','all');
            wp_enqueue_script('autogrid-public-script',AUTOGRID_PLUGIN_URL.'assets/js/autogrid-public-script.js',array('jquery'),'1.0.0',true);
            wp_enqueue_script('autogrid-slick-script',AUTOGRID_PLUGIN_URL.'assets/js/slick.min.js',array('jquery'),'1.0.0',true);
        }

        /**
         * Load textdomain.
         *
         * @since    1.0.0
         */
        public function load_textdomain() {
            load_plugin_textdomain( 'autogrid', false, basename( AUTOGRID_PATH ) . '/languages' );
        }

        /**
         * Register meta box
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function autogrid_register_meta_boxes(){
            add_meta_box('autogrid_author', 'AutoGrid Author', array( $this, 'autogrid_author_cb' ), 'post','side','high');
        }

        /**
         * Callback function of AutoGrid author meta box.
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function autogrid_author_cb(){
            global $post;
            $terms = get_terms( array(
                'taxonomy' => 'blog-author',
                'hide_empty' => false
            ));
            $author_data = get_post_meta( $post->ID,'autogrid_author_box', true );
            ?>
            <label><?php _e('Select Author:','autogrid')?></label>
            <select name="autogrid-author-box" style="width: 80%;margin-top: 10px;">
            <?php
            foreach ($terms as $taxonomy){
                ?>
                <option <?php selected( $author_data, $taxonomy->name );?> value="<?php echo $taxonomy->name; ?>"><?php echo $taxonomy->name; ?></option>
                <?php
            }
            ?></select><?php
        }

        /**
         * Save meta boxes data on post save hook.
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function save_meta_boxes(){
            global $post;
            $author_data = ! empty( $_POST['autogrid-author-box'] ) ? sanitize_text_field( $_POST['autogrid-author-box'] ) : '';

            if( ! empty( $author_data ) ) {
                update_post_meta( $post->ID, 'autogrid_author_box', $author_data );
                wp_set_post_terms( $post->ID, array($author_data),'blog-author');
            }
        }

        /**
         * Create images if custom sizes.
         *
         * @since 1.0.0
         */
        public function autogrid_theme_setup(){
            add_image_size( 'latest-post-thumb', 135, 145, array( 'center', 'center' ) );
        }

        /**
         * Add custom image sizes in list.
         *
         * @since 1.0.0
         *
         * @param $sizes
         * @return array
         */
        public function register_image_custom_sizes($sizes){
            return array_merge( $sizes, array(
                'latest-post-thumb' => __('Latest post thumbnail','autogrid'),
            ) );
        }

        /**
         * Remove Blog Author taxonomy from admin post edit sidebar.
         *
         * @since 1.0.0
         *
         * @param $response
         * @param $taxonomy
         * @param $request
         * @return mixed
         */
        public function remove_blog_meta_taxonomy( $response, $taxonomy, $request ){

            if( !empty( $taxonomy->name ) && $taxonomy->name === 'blog-author' ) {
                $data_response = $response->get_data();
                $data_response['visibility']['show_ui'] = false;
                $response->set_data( $data_response );
                $taxonomy->show_ui = false;
            }

            return $response;
        }
        
        /**
         * Exclude the featured post from category page and home page.
         *
         * @since 1.0.0
         * 
         * @param $query
         * @return void
         */
        public function exclude_featured_post($query) {
            $term = get_queried_object();
            $autogrid_get_settings = autogrid_get_settings( 'general');
            $autogrid_featured_posts = !empty($autogrid_get_settings['featured_posts']) ? $autogrid_get_settings['featured_posts'] : array();
            $frontpage_id = get_option('page_on_front');
            $post_id = '';
            $latest_posts = array();
            if( (!empty( $frontpage_id ) && (int)get_the_ID() === (int)$frontpage_id) || is_front_page()){
                $post_id =  !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? $autogrid_featured_posts['home_page_featured_post'] : '';
                $posts_not_in = $query->get('latest_post_excluded');
                if( !isset( $posts_not_in ) || empty( $posts_not_in ) ){
                    $args = array(
                        'fields' => 'ids',
                        'numberposts' => 3,
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'latest_post_excluded' => true,
                    );

                    if( !empty( $post_id ) ){
                        $args['exclude'] = (array)$post_id;
                    }

                    $latest_posts = get_posts( $args );
                }
            } elseif ( !empty( $term->taxonomy ) && !empty( $term->term_id ) && $term->taxonomy === 'category' ){
                $term_slug = !empty($term->slug) ? $term->slug : '';
                $term_id = !empty($term->term_id) ? $term->term_id : '';;
                $autogrid_cat_name = $term_slug.'-'.$term_id;
                $post_id =  ! empty( $autogrid_featured_posts[$autogrid_cat_name] ) ? $autogrid_featured_posts[$autogrid_cat_name] : '';
                $post_id = empty( $post_id ) && !empty( $autogrid_featured_posts['home_page_featured_post'] ) ? !empty( $autogrid_featured_posts['home_page_featured_post'] ) : $post_id;
            }
            
            if ( !empty($post_id) ) {
                $latest_posts[] = $post_id;
                $query->set( 'post__not_in', (array)$latest_posts );
            }
        }
        
        /**
         * Get the current year.
         * 
         * @since 1.0.0
         *
         * @return string
         */
        public function get_year_cb(){
            return date('Y');
        }
        
        /**
         * Update the author name.
         * 
         * @since 1.0.0
         * 
         * @param $display_name
         * @return mixed|string
         */
        public function update_the_author_name( $display_name ) {

            global $post;
            
            $post_type = !empty($post->post_type) ? $post->post_type : 'post';
            $post_id = !empty( $post->ID ) ? $post->ID : '';
            if( !empty( $post_type ) && !empty( $post_id ) && $post_type === 'post' ) {
                $post_author_term = wp_get_post_terms($post_id,'blog-author');
                $post_author_term = !empty( $post_author_term[0] ) ? $post_author_term[0] : (object)array();
                $display_name = !empty($post_author_term->name) ? esc_html($post_author_term->name) : $display_name;
            }

            return $display_name;
        }
        
        /**
         * Remove the category prefix.
         *
         * @since 1.0.0
         *
         * @param $string
         * @param $type
         * @return mixed|string
         */
        public function remove_category_prefix( $string, $type )  {
            
            if( $type === 'category' ) {
                $string  = trailingslashit(str_replace('/category/', '/', $string));
            }
            
            return $string;
        }
    }
}
