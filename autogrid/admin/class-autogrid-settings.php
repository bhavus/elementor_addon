<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check Autogrid_Admin_Settings class exists or not.
 */
if( !class_exists('Autogrid_Admin_Settings')) {

    /**
     * Autogrid_Admin_Settings class is responsible for all admin side settings.
     *
     * @since 1.0.0
     */
    class Autogrid_Admin_Settings extends autogrid_Admin {

        /**
         * Defined all admin side functionality
         *
         * @since 1.0.0
         */
        public function __construct() {
            add_action( 'autogrid_section_content_general',array($this,'general_settings'));
            add_action('wp_ajax_autogrid_featured_posts',array($this,'get_autogrid_featured_posts'));
            add_action('wp_ajax_nopriv_autogrid_featured_posts',array($this,'get_autogrid_featured_posts'));
            add_action('wp_ajax_autogrid_category_cta',array($this,'get_autogrid_elementor_sections'));
            add_action('wp_ajax_nopriv_autogrid_category_cta',array($this,'get_autogrid_elementor_sections'));
        }

        /**
         * Callback function of wp_ajax_autogrid_featured_posts hook.
         * Response the searched keyword related post
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function get_autogrid_featured_posts() {
            $status = false;
            if( empty($_POST['keyword']) || empty( $_POST['nonce'] ) || !wp_verify_nonce(sanitize_text_field($_POST['nonce']),'_autogrid_get_posts')){
                wp_send_json(array('status' => $status));
                wp_die();
            }
            $post_data = array();
            $search = sanitize_text_field($_POST['keyword']);

            $search_posts = get_posts( array(
                's' => $search,
                'fields' => 'ids',
                'post_type' => 'post'
            ));
            if( !empty( $search_posts ) && is_array( $search_posts ) ){
                $status = true;
                foreach ( $search_posts as $post_id ) {
                    $post_data[] = array(
                        'post_id' => $post_id,
                        'post_title' => get_the_title($post_id),
                    );
                }
            }
            $response = array(
                'status' => $status,
                'post_data' => $post_data,
            );
            wp_send_json( $response );
            wp_die();
        }

        /**
         * Callback function of wp_ajax_autogrid_featured_posts hook.
         * Response the searched keyword related post
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function get_autogrid_elementor_sections() {
            $status = false;
            if( empty($_POST['keyword']) || empty( $_POST['nonce'] ) || !wp_verify_nonce(sanitize_text_field($_POST['nonce']),'_autogrid_get_cta')){
                wp_send_json(array('status' => $status));
                wp_die();
            }
            $post_data = array();
            $search = sanitize_text_field($_POST['keyword']);

            $search_posts = get_posts( array(
                's' => $search,
                'fields' => 'ids',
                'post_type'         => 'elementor_library',
                'post_status'       => 'publish',
                'elementor_library_type' => 'section',
            ));
            if( !empty( $search_posts ) && is_array( $search_posts ) ){
                $status = true;
                foreach ( $search_posts as $post_id ) {
                    $post_data[] = array(
                        'post_id' => $post_id,
                        'post_title' => get_the_title($post_id),
                    );
                }
            }
            $response = array(
                'status' => $status,
                'post_data' => $post_data,
            );
            wp_send_json( $response );
            wp_die();
        }

        /**
         * Display general settings for featured post.
         *
         * @since 1.0.0
         *
         * @return void
         */
        public function general_settings() {

            $autogrid_settings = autogrid_get_settings( 'general');
            $autogrid_featured_posts = !empty($autogrid_settings['featured_posts']) ? $autogrid_settings['featured_posts'] : array();
            $autogrid_cta = !empty($autogrid_settings['category_cta']) ? $autogrid_settings['category_cta'] : array();
            $post_per_page = !empty($autogrid_featured_posts) && is_array( $autogrid_featured_posts ) ? count($autogrid_featured_posts) : 10;
            $post_per_page = $post_per_page > get_option('posts_per_page') ? $post_per_page : get_option('posts_per_page');
            $args = array(
                'numberposts'       => $post_per_page,
                'post_type'         => 'post',
                'fields'            => 'ids'
            );
            if( !empty( $autogrid_featured_posts ) && is_array($autogrid_featured_posts) ){
                $args['include'] = array_values($autogrid_featured_posts);
            }

            $AutoGrid_posts = get_posts( $args );
            $categories = get_categories( array('hide_empty' => false));
            $home_page_featured_post = !empty($autogrid_featured_posts['home_page_featured_post']) ? $autogrid_featured_posts['home_page_featured_post'] : 0;

            $post_per_page = !empty($autogrid_cta) && is_array( $autogrid_cta ) ? count($autogrid_cta) : 10;
            $post_per_page = $post_per_page > get_option('posts_per_page') ? $post_per_page : get_option('posts_per_page');
            $args = array(
                'numberposts'       => $post_per_page,
                'fields'            => 'ids',
                'post_type'         => 'elementor_library',
                'post_status'       => 'publish',
                'elementor_library_type' => 'section',
            );
            if( !empty( $autogrid_cta ) && is_array($autogrid_cta) ){
                $args['include'] = array_values($autogrid_cta);
            }
            $elementor_templates = get_posts( $args );
            ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <th colspan="3"><label for="autogrid_per_page"><?php _e( 'Featured Blog Post Settings', 'autogrid-featured-image' ); ?></label></th>
                </tr>
                <tr>
                    <th><label for="autogrid_per_page"><?php _e( 'Home Page Featured Post', 'autogrid-featured-image' ); ?></label></th>
                    <td colspan="2">
                        <select name="featured_posts[home_page_featured_post]" id="homepage-featured-post" class="autogrid-select-posts regular-text" data-nonce="<?php echo wp_create_nonce('_autogrid_get_posts'); ?>">
                            <?php
                            if( !empty($AutoGrid_posts) && is_array($AutoGrid_posts) ){
                                foreach($AutoGrid_posts as $post_id) { ?>
                                    <option value="<?php echo $post_id; ?>" <?php selected( (int)$post_id, (int)$home_page_featured_post ); ?>><?php echo get_the_title($post_id); ?></option>
                                <?php }
                            } ?>
                        </select>
                    </td>
                </tr>
                <?php
                if( !empty( $categories ) && is_array($categories) ){
                    foreach($categories as $category) {
                        $term_name = !empty($category->name) ? $category->name : '';
                        $term_slug = !empty($category->slug) ? $category->slug : '';
                        $term_id = !empty($category->term_id) ? $category->term_id : '';
                        $autogrid_cat_name = '';
                        $autogrid_cat_cta_name = '';
                        if( !empty($term_name) && !empty($term_id) ) {
                            $autogrid_cat_name = $term_slug . '-' . $term_id;
                            $autogrid_cat_cta_name = $term_slug . '-' . $term_id.'-cta';
                        }
                        $current_category_featured_post = !empty($autogrid_featured_posts[$autogrid_cat_name]) ? $autogrid_featured_posts[$autogrid_cat_name] : 0 ;
                        $current_cat_cta_name = !empty($autogrid_cta[$autogrid_cat_cta_name]) ? $autogrid_cta[$autogrid_cat_cta_name] : '' ;
                        ?>
                        <tr>
                            <th> <label><?php  echo $term_name.__(' Featured Post','autogrid'); ?></label></th>
                            <td>
                                <select name="featured_posts[<?php  echo $autogrid_cat_name; ?>]" id="<?php echo $term_slug.'_featured_post'?>" class="autogrid-select-posts regular-text" data-nonce="<?php echo wp_create_nonce('_autogrid_get_posts'); ?>">
                                    <?php
                                    if( !empty($AutoGrid_posts) && is_array($AutoGrid_posts) ){
                                        foreach($AutoGrid_posts as $post_id) { ?>
                                            <option value="<?php echo $post_id; ?>" <?php selected( (int)$post_id, (int)$current_category_featured_post); ?>><?php echo get_the_title($post_id); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select name="category_cta[<?php  echo $autogrid_cat_cta_name; ?>]" id="<?php echo $term_slug.'_cta'?>"  class="autogrid-select-cta regular-text" data-nonce="<?php echo wp_create_nonce('_autogrid_get_cta'); ?>">
                                    <?php
                                    if ( !empty($elementor_templates) && is_array($elementor_templates) ) {
                                        foreach ($elementor_templates as $template_id) { ?>
                                            <option value="<?php echo $template_id; ?>"  <?php selected( (int)$template_id, $current_cat_cta_name); ?>><?php echo get_the_title($template_id); ?></option>
                                            <?php
                                        }
                                    } ?>
                                </select>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <?php
        }
    }

    new Autogrid_Admin_Settings();
}
