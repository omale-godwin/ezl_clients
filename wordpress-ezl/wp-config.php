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
define( 'AUTH_KEY',         '= DY1Uy!<;nHX~vE#[Q38b;yT@)cT 2hS07*<7TvM5?k2{N%ps-iZJjHtsr)-{gZ' );
define( 'SECURE_AUTH_KEY',  'P=3qROg`{_4pK7?2Pbehj7!gByu]YR- t]3t$-Zf2mK2QfN^L``u4gjo:h+~OTv(' );
define( 'LOGGED_IN_KEY',    'sGpxap9[/)*bYQ<ip&[kRh>1T^Mog`/RIc&iPi6]M-K@x0r2#V(v^xM*3,k+nbjH' );
define( 'NONCE_KEY',        'C`/=^K2#&2B(~dyS> Bb.(f`Z8lbe{P!B;As)_vM,h|dkrUl<BJ;t !*E^`jk.m-' );
define( 'AUTH_SALT',        'k|c*Xlemz.@[DV$^KT|``lcyQt#!AqQOwy60n;|3h&I;7V89}y{{+Q<s4^Fp;Mp/' );
define( 'SECURE_AUTH_SALT', 'tgFhmg>g`ur!SG]{d)3DQ@G#-WM:c>XJ&97Ry|[<T4ph^3TfDywfjy(HMhm*TshM' );
define( 'LOGGED_IN_SALT',   'enh_y,a5BY?wwX+lDcuwQaIbM/mF[qx.`n9|WkI>.|{&4L-P-sy?U.;otvc{*-1s' );
define( 'NONCE_SALT',       '#tnv*1-U).S~Jas*v9L{8&Gt396`#vbnsw@mZVtzA&XD5qZ(eS%QAN2j~A{8(n*C' );

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



// Force HTTPS for all URLs
define('WP_HOME', 'https://' . $_SERVER['HTTP_HOST'] . '/');
define('WP_SITEURL', 'https://' . $_SERVER['HTTP_HOST'] . '/');

// Additional security for admin/logins
define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

// Handle proxy headers (needed when using Cloudflare)
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}


// Increase memory limit
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
define( 'DOMAIN_CURRENT_SITE', 'merkaba.site' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
define('COOKIE_DOMAIN', '.merkaba.site');  // For shared login

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
