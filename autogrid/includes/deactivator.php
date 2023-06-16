<?php

/**
 * Checking Autogrid_Deactivator class exists or not.
 */
if( !class_exists('Autogrid_Deactivator')) {

    /**
     * Fired during plugin deactivation.
     *
     * This class defines all code necessary to run during the plugin's deactivation.
     *
     * @since      1.0.0
     */
    class Autogrid_Deactivator{

		public static function deactivate() {

		}
	}
}