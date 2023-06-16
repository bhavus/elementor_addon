<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check autogrid_Admin class_exists or not.
 */
if( !class_exists( 'autogrid_Admin' ) ) {

	/**
	 * The admin-specific functionality of the plugin.
	 * 
	 * @since 1.0.0
	 */
	class autogrid_Admin {

		/**
		 * Menu slug.
		 */
		public $menu_slug = AUTOGRID_MENU_SLUG;
		
		/**
		 * settings key.
		 */
		public $settings_key = 'autogrid_settings';

		/**
		 * The errors of this plugin..
		 */
		private static $errors   = array();

		/**
		 * The messages of this plugin..
		 */
		private static $messages   = array();

		/**
		 * Initialize the class and set its properties.
		 */
		public function __construct() {

			add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
			add_action( 'admin_init', array( $this, 'save' ) );
		}

		/**
		 * Add messages for this plugin.
		 */
		public static function add_message( $text ) {

			self::$messages[] = $text;
		}

		/**
		 * Add errors for this plugin.
		 */
		public static function add_error( $text ) {
			self::$errors[] = $text;
		}

		/**
		 * Register admin menu.
		 */
		public function register_admin_menu() {

            add_posts_page(
				__( 'autogrid Featured Image', 'autogrid-featured-image' ),
				__( 'Blog Featured Post','autogrid-featured-image' ),
				'manage_options',
				$this->menu_slug,
				array($this,'process_admin_menu'),
				'dashicons-hourglass'
			);
		}

		/**
		 * Get current page.
		 */
		public function current_page() {

			return !empty( $_REQUEST['page'] ) ? sanitize_text_field( $_REQUEST['page'] ) : '';
		}

		/**
		 * Get curent section.
		 */
		public function current_section() {
			
			$current_section = $this->current_page();

			$current_menu = '';
			if( !empty($current_section) && $current_section == $this->menu_slug ) {
				$current_menu = !empty( $_REQUEST['tab'] ) ? sanitize_text_field( $_REQUEST['tab'] ) : '';
			}

			return $current_menu;
		}

		/**
		 * Get menu items.
		 */
		public function menu_items() {

			return apply_filters( 'autogrid_menu_items', array(
				'' => __( 'General', 'autogrid-featured-image' ),

			) );
		}

		/**
		 * Display menu.
		 */
		public function menu() {

			$menu_items = $this->menu_items();
			
			if(empty($menu_items) || !is_array($menu_items)) {
				return;
			}

			$current_section = $this->current_section();

			$menu_link = admin_url( 'admin.php?page='.$this->menu_slug);

			?>
			<nav class="nav-tab-wrapper">

				<?php foreach ($menu_items as $key => $menu ) {

					if(!empty($key)) {
						$menu_link .= '&tab='.$key;
					}

					$active = '';

					if( !empty( $current_section ) && $key == $current_section) {
						$active = 'nav-tab-active';
					} elseif ( empty( $current_section ) && strtolower($menu) == 'general' ) {
						$active = 'nav-tab-active';
					}
					?>
					<a href="<?php echo $menu_link; ?>" class="nav-tab <?php echo $active; ?>"><?php echo $menu; ?></a>
					<?php
				} ?>	
			</nav>
			<?php

		}

		/**
		 * Get sub menu items.
		 */


		/**
		 * Display heading title.
		 */
		public function heading_title() {

			$menu_items = $this->menu_items();
			$current_section = $this->current_section();

			$heading_title = !empty( $menu_items[$current_section] ) ? sanitize_text_field( $menu_items[$current_section] ).' '.__('Settings','autogrid-featured-image') : '';
			?>
			<h1 class="wp-heading-inline"><?php echo apply_filters( 'autogrid_heading_title',$heading_title,$current_section); ?></h1>
			<?php

		}

		/**
		 * Display notification.
		 */
		public function notification() {
			?>
			<div class="autogrid-notification-wrap">
                <?php
                if ( sizeof( self::$errors ) > 0 ) {
	                foreach ( self::$errors as $error ) {
		                echo '<div id="message" class="error inline notice is-dismissible"><p>' . $error . '</p></div>';
	                }
                } elseif ( sizeof( self::$messages ) > 0 ) {
	                foreach ( self::$messages as $message ) {
		                echo '<div id="message" class="updated inline notice is-dismissible"><p>' . $message . '</p></div>';
	                }
                }
                ?>
            </div>
			<?php
		}

		/**
		 * Process for admin autogrid setting form.
		 */
		public function process_admin_menu() {

			$current_page = $this->current_page();
			$current_section = $this->current_section();

			?>
			<div class="wrap">
				<div class="autogrid-featured-image-wrap">
					<?php
					$this->menu();
					$this->heading_title();
					$this->notification();

					?>
					<form method="post" id="autogrid_form_main" action="" enctype="multipart/form-data">
						<div class="autogrid-content-wrap">
							<?php

							do_action('autogrid_section_before_content', $current_section );

							do_action('autogrid_section_content', $current_section );

							$section = '_general';
							if(!empty($current_section)) {
								$section = '_'.strtolower($current_section);
							}

							do_action('autogrid_section_content'.$section, $current_section );

							do_action('autogrid_section_after_content', $current_section );
							?>
						</div>

						<p class="submit">
							<button name="save" class="button-primary" type="submit" value="Save changes"><?php _e('Save changes','autogrid-featured-image'); ?></button>
							<input type="hidden" name="action" value="autogrid_form_action">
							<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce('autogrid_form_main'); ?>">
							<input type="hidden" name="current_page" value="<?php echo esc_attr( $current_page ); ?>">
							<input type="hidden" name="current_section" value="<?php echo esc_attr( $current_section ); ?>">

						</p>
					</form>
				</div>
			</div>		
			<?php
		}

		/**
		 * Redirect section url.
		 */
		public function redirect_url() {

			$current_section = !empty( $_POST['current_section'] ) ? sanitize_text_field( $_POST['current_section'] ) : '';

			$menu_link = admin_url( 'admin.php?page='.$this->menu_slug);

			if( !empty($current_section)) {
				$menu_link .='&tab='.$current_section;
			}

			return $menu_link;
		}

		/**
		 * Save settings.
		 */
		public function save() {

			if( isset( $_POST['action'] ) && !empty( sanitize_text_field( $_POST['action'] ) ) && sanitize_text_field( $_POST['action'] )  == 'autogrid_form_action' ) {

				if( isset( $_POST['_nonce'] ) && !empty( $_POST['_nonce'] ) && wp_verify_nonce( sanitize_text_field( $_POST['_nonce'] ), 'autogrid_form_main' ) ) {

					$current_section = !empty( $_POST['current_section'] ) ? sanitize_text_field( $_POST['current_section'] ) : 'general';

					if( has_action( 'autogrid_save_section_'.$current_section ) ) {

						do_action('autogrid_save_section_'.$current_section);
						return true;
					}

					$settings = autogrid_sanitize_text_field($_POST);

					unset($settings['save']);
					unset($settings['action']);
					unset($settings['_nonce']);
					unset($settings['current_page']);
					unset($settings['current_section']);
					unset($settings['current_sub_section']);

					$autogrid_settings = get_option( $this->settings_key, true );

					if( !empty( $autogrid_settings ) && is_array( $autogrid_settings ) ) {

			            $autogrid_settings[$current_section] = $settings;
		            } else{
			            $autogrid_settings = array(
				            $current_section =>  $settings,
                        );
                    }

		            update_option( $this->settings_key, $autogrid_settings );

					self::add_message( __( 'Your settings have been saved.', 'autogrid-featured-image' ) );
				} else {
					self::add_error( __( 'Something went wrong. settings nonce not verified.', 'autogrid-featured-image' ) );
				}
			}
		}
	}

	new autogrid_Admin();
}
