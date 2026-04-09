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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'cxkj`!1-/i|XN~20Y9jVw0R<diU#Ujbg;5zNSko~E3AzI}y}l6vsI3y.@_bOzze9' );
define( 'SECURE_AUTH_KEY',   '1]($GK4{9GJtF_3lX`#`8xx&Xn+C2akM,c]y>p:,aK1rXdX+qIo/M&@?l`_%+vQ@' );
define( 'LOGGED_IN_KEY',     'EkyA(}[?e>c6`&D%[f0.|ii?^+5w~!%o{-5?N#,o+<<)A&jS#vc_xN/-6Pn1I]*8' );
define( 'NONCE_KEY',         't1dNT-8=/j8[(U;B-O%F2a=Jh_-I={U6T^t}Ghqe9L9Z#:RS^z=fTyM$yd6pO]Kr' );
define( 'AUTH_SALT',         'Q1AN-ga0yqBtpb)l(n0XKyqs,;hc(C*6~LD50Ccy0R1Qj9~.V;uqB%*Y:O-BYYu/' );
define( 'SECURE_AUTH_SALT',  ';WeMm=J[S1VZ?!kc`^+-!:SB_W:ZG.ZAZaU(#Uw;Ceu{#S<%2=wS6juqR&W9;9*}' );
define( 'LOGGED_IN_SALT',    'KZsH($-j;9a;ROY#=rl:4/@n}fm0E1di)S8k)_*96PZy%qQIxgWdcc}.M3[7,+dk' );
define( 'NONCE_SALT',        '!mn7]%%_H{-bL#c^t#~@T9}j!4/I1HA8Dw4]&{jix[zuohJ2k!bWb&UXN^St/LP0' );
define( 'WP_CACHE_KEY_SALT', '+unDF2_nI5o4V:F}L+Gd7,>Sc/D(rz7xBe/ze#$OA-B8TOPt9meYHRCYRYB(t+)u' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
