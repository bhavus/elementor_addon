<?php

/**
 * Checking Autogrid_Activator class is exists or not.
 */
if( !class_exists('Autogrid_Activator')) {

    /**
     * Fired during plugin activation.
     *
     * This class defines all code necessary to run during the plugin's activation.
     *
     * @since      1.0.0
     */
	class Autogrid_Activator{

        /**
         * Register settings on plugin activation.
         *
         * @since 1.0.0
         *
         * @return void
         */
		public static function activate() {
            $autogrid_settings = get_option('autogrid_settings');
            if( empty( $autogrid_settings ) ){
                $autogrid_settings = array(
                    'general' => array()
                );
            }

			
			update_option( 'autogrid_settings', $autogrid_settings );

			set_transient( '_autogrid_activation_redirect', true, 30 );
		}
	}
}