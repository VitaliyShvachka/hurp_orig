<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'hurpcomu_wp_rlpko' );

/** Database username */
define( 'DB_USER', 'hurpcomu_wp_rycrj' );

/** Database password */
define( 'DB_PASSWORD', 'pM7RyichY@m9*!@6' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', '3[ZVgJ~uMZc|lL16#@:8_i%([1u31[jl[Ql-V%9:7CqA%5gVx+Sr:uJu3!87Xf1@');
define('SECURE_AUTH_KEY', '2x4#Wb)Rc4*+_)_lc6hBg81+q;_bg[4SHy312yF6P|oMi5X52AioXo-KZ3j/b:DH');
define('LOGGED_IN_KEY', '@9L&Fr!##9X|EZSeWB_;O3htYBV#cDk9a]]s58&L(onsG(*aP_8Pne9-p59Wkt;u');
define('NONCE_KEY', 'XsT!40%9:ld]fv%:TL3c;y55Q8HTUvcg2Pce5[-E63fBg+/Vy)4jK7OtOf0+0b:+');
define('AUTH_SALT', ']z5wi9V6;F/HV3_4euSV89fMsDVb*ygvnG_U3!am@f(:-342j*80&_f41@:kH6Dd');
define('SECURE_AUTH_SALT', '0fy|Pvj9r*i5Tdoq|ytTg|Y9Z8TZ3s)6y&7)y4qd237I8ZO~/dw20E0Ai7p*P|SM');
define('LOGGED_IN_SALT', 'l~(f2b+w3wV(X7ae8(1zt|i%v9(C2q+W6[1Y-+J68H_]S1!@4_%15l)3Ed49L~I6');
define('NONCE_SALT', 'X44Vn2L1Jx-Y~55-*BWh9Bd:%)49BOKNC3CvdROvH&nkM;]8RS[!_J%ELb8h744k');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dvaq6u5_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
