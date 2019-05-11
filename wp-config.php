<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'i5014246_wp1');

/** MySQL database username */
define('DB_USER', 'i5014246_wp1');

/** MySQL database password */
define('DB_PASSWORD', 'Z.p57D5AZ3NWHOkEbTY22');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uR9UFivOJignacxN8pJD3xIVYZjQJ0EiwAJ12MgJPuOkaKjUYPJbveMUcC5J80BQ');
define('SECURE_AUTH_KEY',  'PZVn4lOLbFgSZ5aMiHOpvsE9R5EnTvz0LYXXs2KhOE2oa71EwCJtF0JNIhpgKiLY');
define('LOGGED_IN_KEY',    'O6uXAp6FVPakbgwDEXjnFV0VBMyXmqk7OCX5hO933iK8OkiHAO0BNtO6JRqr7ogW');
define('NONCE_KEY',        'qsHJbGKGzWI4pwVge19ZoBWRSwrfq1afD2UiEliR8i7sw6v0iWcW5aiPTtbRdMTP');
define('AUTH_SALT',        'zu7o9RuO8cu8cPD1pBkqZRGIUuuzo3tVX1hsDm0qzcfSBrAoASK8iZc35lT98ogO');
define('SECURE_AUTH_SALT', 'g7cKorN1sbwhGbGe11VLbIXTe20Mwrtyv28c0j2dbVFZEthVtOc4VEflBklVtPhZ');
define('LOGGED_IN_SALT',   'Rlq8XkhQ3CTGdC6EEYLV6maKatfpaIEUJ2gDvAQz1qf7ClPJMfcj8FwHTkhG3ooF');
define('NONCE_SALT',       'zu2FECzrykSyWem30zztJwexVxNlfaoibt6nyPql9qBjn39IGV4Vf99ocaSw7EWs');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
