<?php
/**
 * Check get_content_reading_time function is exists or not.
 */
if( ! function_exists('get_content_reading_time') ){
    /**
     * Get the content reading time based on content size.
     *
     * @param int $post_id
     * @return string return the content reading time.
     *
     * @since 1.0.0
     */
    function get_content_reading_time( $post_id = 0 ) {
        if(empty($post_id) || $post_id <= 0){
            return "";
        }
        $post_content = get_the_content($post_id);
        $content_word_count = !empty( $post_content ) ? str_word_count( strip_tags( $post_content ) ) : 0;
        $reading_time = !empty($content_word_count) && $content_word_count > 0 ? ceil($content_word_count / 250) : 0;

        return $reading_time . __(" min read","autogrid");
    }
}

/**
 * Check autogrid_get_settings function is exists or not.
 */
if( ! function_exists('autogrid_get_settings') ){
    /**
     * Get autogrid settings.
     *
     * @since 1.0.0
     *
     * @param $section
     * @return array|mixed
     */
    function autogrid_get_settings($section = '') {

        $autogrid_settings = get_option( 'autogrid_settings', true );
        $autogrid_settings = !empty( $autogrid_settings ) ? $autogrid_settings : array();

        return !empty( $autogrid_settings[$section] ) ? $autogrid_settings[$section] : $autogrid_settings;
    }
}

/**
 * Check autogrid_sanitize_text_field function is exists or not.
 */
if( ! function_exists('autogrid_sanitize_text_field') ){
    /**
     * This function used for sanitize text fields.
     *
     * @since 1.0.0
     *
     * @param $fields
     * @return array
     */
    function autogrid_sanitize_text_field( $fields ) {

        $settings = array();

        if( !empty($fields) && is_array($fields)) {

            foreach ($fields as $key => $field ) {

                if( !empty($field) && is_array($field)) {
                    $sanitize_field = autogrid_sanitize_text_field($field);
                } else{
                    $sanitize_field = sanitize_text_field($field);
                }

                $settings[$key] = $sanitize_field;
            }
        }
        return $settings;
    }
}
