<?php 
/**
 * Common Function for Shopbiz Theme.
 *
 * @package     Shopbiz
 * @author      Shopbiz
 * @copyright   Copyright (c) 2019, Shopbiz
 * @since       Shopbiz
 */
 

/**
 * Return Theme options.
 */
if ( ! function_exists( 'shopbiz_get_option' ) ){
	/**
	 * Return Theme options.
	 *
	 * @param  string $option       Option key.
	 * @param  string $default      Option default value.
	 * @param  string $deprecated   Option default value.
	 * @return Mixed               Return option value.
	 */
	function shopbiz_get_option( $option, $default = '', $deprecated = '' ){

		if ( '' != $deprecated ) {
			$default = $deprecated;
		}
		$theme_options = shopbiz_Theme_Options::get_options();
		/**
		 * Filter the options array for shopbiz Settings.
		 *
		 * @since  1.0.20
		 * @var Array
		 */
		$theme_options = apply_filters( 'shopbiz_get_option_array', $theme_options, $option, $default );

		$value = ( isset( $theme_options[ $option ] ) && '' !== $theme_options[ $option ] ) ? $theme_options[ $option ] : $default;
         
		/**
		 * Dynamic filter shopbiz_get_option_$option.
		 * $option is the name of the shopbiz Setting, Refer shopbiz_Theme_Options::defaults() for option names from the theme.
		 *
		 * @since  1.0.20
		 * @var Mixed.
		 */
		return apply_filters( "shopbiz_get_option_{$option}", $value, $option, $default );
	}
}


if ( ! function_exists( 'shopbiz_get_pro_url' ) ) :
	/**
	 * Returns an URL with utm tags
	 * the admin settings page.
	 *
	 * @param string $url    URL fo the site.
	 * @param string $source utm source.
	 * @param string $medium utm medium.
	 * @param string $campaign utm campaign.
	 * @return mixed
	 */
	function shopbiz_get_pro_url( $url, $source = '', $medium = '', $campaign = '' ) {

		$url = trailingslashit( $url );

		// Set up our URL if we have a source.
		if ( isset( $source ) ) {
			$url = add_query_arg( 'utm_source', sanitize_text_field( $source ), $url );
		}
		// Set up our URL if we have a medium.
		if ( isset( $medium ) ) {
			$url = add_query_arg( 'utm_medium', sanitize_text_field( $medium ), $url );
		}
		// Set up our URL if we have a campaign.
		if ( isset( $campaign ) ) {
			$url = add_query_arg( 'utm_campaign', sanitize_text_field( $campaign ), $url );
		}

		return esc_url( $url );
	}

endif;


/**
 * Function to check if it is Internet Explorer
 */
if ( ! function_exists( 'shopbiz_check_is_ie' ) ) :

	/**
	 * Function to check if it is Internet Explorer.
	 *
	 * @return true | false boolean
	 */
	function shopbiz_check_is_ie() {

		$is_ie = false;

		$ua = htmlentities( $_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8' );
		if ( strpos( $ua, 'Trident/7.0' ) !== false ) {
			$is_ie = true;
		}

		return apply_filters( 'shopbiz_check_is_ie', $is_ie );
	}

endif;