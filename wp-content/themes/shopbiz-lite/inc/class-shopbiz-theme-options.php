<?php
/**
 * Shopbiz
 *
 * @package     Shopbiz
 * @author      shopbiz
 * @copyright   Shopbiz (c) 2019, Shopbiz
 * @since       Shopbiz 0.0.3
 */
/**
 * Theme Options
 */
if ( ! class_exists( 'Shopbiz_Theme_Options' ) ) {
	/**
	 * Theme Options
	 */
	  class Shopbiz_Theme_Options {
		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;
		/**
		 * Post id.
		 *
		 * @var $instance Post id.
		 */
		public static $post_id = null;
		/**
		 * A static option variable.
		 *
		 * @since 0.3
		 * @access private
		 * @var mixed $db_options
		 */
		private static $db_options;
		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		/**
		 * Get theme options from static array()
		 *
		 * @return array Return array of theme options.
		 */
		public static function get_options(){
			return self::$db_options;
		}
		/**
		 * Update theme static option array.
		 */
		public static function refresh() {
			self::$db_options = wp_parse_args(
				get_option( SHOPBIZ_THEME_SETTINGS ),
				self::defaults()
			);
		}
	}
}
/**
 * Kicking this off by calling 'get_instance()' method
 */
Shopbiz_Theme_Options::get_instance();
