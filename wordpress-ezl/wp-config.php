<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'EZ' );

/** Database username */
define( 'DB_USER', 'mk_blog' );

/** Database password */
define( 'DB_PASSWORD', 'Qj2f6MqdS9YKkt5CSpqC' );

/** Database hostname */
define( 'DB_HOST', 'database-mk-wordpress.cls8s6w02do6.eu-west-2.rds.amazonaws.com:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'm&=9keHtsMp%PWh?V~VeU~TH]yv7@1,vbZVPze$n+ 0uB()?5p6vR&.I)Y^1-_,}' );
define( 'SECURE_AUTH_KEY',  'uKU$(h5JNhzPKE`o;r(/!JfP;7}z^k_Ugi*Et*OvOlz0bud({4%Eh6mc}.5Y;F~1' );
define( 'LOGGED_IN_KEY',    'SGyE$rMhRU6vH&s*2w%9pK+o,T=r/S!~+NvqT3}@eM)ZWTZxT2FyWd$Pp%%3`k54' );
define( 'NONCE_KEY',        '3t;:ur8pQ{9RD_wZ:z$N+wl}W]RO,%~]z0~I?,xmoE<M9&EFI87bKxem$%%AW!Ez' );
define( 'AUTH_SALT',        '@nZiU`2jA!qtkSEU(#NRr$D0J/iEiy<tJfxN5BsgL>DnC^0uV<pF8jb|-uG|RySt' );
define( 'SECURE_AUTH_SALT', 'za@OM~(=AlMYFzRf{L1rdre3P>6=q6_Y1`9so#`;3.u$h8Av|5M*!_w*pZof!_M_' );
define( 'LOGGED_IN_SALT',   'bQ.dHRI8+u;$=p3?08!thpe{$UI%ZMfb6a3jMpH<_0ty<O4;a*X Hu~lM,~R]@J0' );
define( 'NONCE_SALT',       ']qCoT,o(6-?;s%%8](/q?#wddmbVM9;i|Xp{2_u!YKog7|/V#E}y5B Lb^$%#D)d' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', false );


define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'merkaba.site' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );


define('WP_HOME', 'https://merkaba.site');
define('WP_SITEURL', 'https://merkaba.site');
define('FORCE_SSL_ADMIN', true);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
