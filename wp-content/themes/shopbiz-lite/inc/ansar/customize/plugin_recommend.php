<?php
/* Notify in customizer */
require get_template_directory() . '/inc/ansar/customizer-notify/shopbiz-customizer-notify.php';

$config_customizer = array(
	'recommended_plugins'       => array(
		'icyclub' => array(
			'recommended' => true,
			'description' => sprintf('Activate by installing <strong>ICYCLUB</strong> plugin to use front page and all theme features %s.', 'shopbiz'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'shopbiz' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'shopbiz' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'shopbiz' ),
	'activate_button_label'     => esc_html__( 'Activate', 'shopbiz' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'shopbiz' ),
);
Shopbiz_Customizer_Notify::init( apply_filters( 'shopbiz_customizer_notify_array', $config_customizer ) );
?>