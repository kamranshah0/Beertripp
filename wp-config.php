<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Beertrippr' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '45MMnM2Izlf5rGjKZk2xswwcRMwfUE0oL690PCxSv0qiVcSrIXujrbhJj9knpZYS' );
define( 'SECURE_AUTH_KEY',  'w61L3uEx1yiWpMndE0pm1ssjUDiAjomcga9uAfEt0C4xqIrNSiAzB6cozSBJKbjw' );
define( 'LOGGED_IN_KEY',    'GNN4IIRfTcqPGG7sOUfu7DvRi9g8b7TJDo7FotQSNwu4MzfXE9d6FmevniFbd0LS' );
define( 'NONCE_KEY',        '1FjHnbh249vIOG1OeHRtVcvHwj9zkPKT536qapZSrcwrdfrI8e5YhrIppSQz8Jam' );
define( 'AUTH_SALT',        'tFwH3SVQtlzzNM5iTwfjt9rOzaUUJzXGz76LV27t7G0GIK15hzafslD5GC8VsWv1' );
define( 'SECURE_AUTH_SALT', 'au8bt7s9h0mBapL9IcvJ4bvVNZ9ijJPyXAvIsdzVMEqV0BHg1QOP2NndEoJOBcx3' );
define( 'LOGGED_IN_SALT',   'crurjshJFbub1r3QulQdfP3sRjX4S84oTobllKaIuyrraS4L3tAECeHgkV0oipOY' );
define( 'NONCE_SALT',       'u2zflYQ2usKx1ebySKBFBuhPfI2r58B396t7nNisdjCxvgoezTyguyw9YUxitocX' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
