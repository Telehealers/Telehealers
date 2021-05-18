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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'DB_NAME', getenv('DB_NAME') );

/** MySQL database username */
define( 'DB_USER', getenv('DB_USERNAME'));


/** MySQL database password */
define( 'DB_PASSWORD', getenv('DB_PASSWORD') );

/** MySQL hostname */
define( 'DB_HOST', getenv('DB_HOSTNAME') );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8_general_ci' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'p!ny!)4)zCa/lmevN2:JUWe/S9$lkTX6g5vmEUCoet^IT<?Nc@FZHXHyqntzhHu+' );
define( 'SECURE_AUTH_KEY',  'Z_Wz7vY(N@p*#OZM{O.-0~.)._:L=Yw!yM&Q5`!P^@SEa3I%v0yR3foBPv{qeSYD' );
define( 'LOGGED_IN_KEY',    'kKwU8jgR,_ug}9igpT4/Uw((a?Ik)GjS`VPLVq&9%joal8e0V9XtR}.HY ^pJN0(' );
define( 'NONCE_KEY',        'wR.]Mw3mK_+Ey-3HRsoHTm5hM QV~Cadl/:fuQBqD[u?IT0Q5S5mRLnjG 4S9<Cg' );
define( 'AUTH_SALT',        '!lxbl/@FBo4#FA252`Knl#hibbQr{-}[?ya,gzk5Jjo5;]Q#pvMs2t]bMuDc-nyk' );
define( 'SECURE_AUTH_SALT', 'al-^v[cPGP$S`co3 WQ:Hz !v)mi!n/iHF0#:rpyB4-I#LkG<U;b&mr$!+ms0X6r' );
define( 'LOGGED_IN_SALT',   '4tH6{IE5yQCxZdY@J$Mr*8QMS4>dpS!nV;F8KlJ!x!TPeiylcY*pb~BA+N}{Ur3i' );
define( 'NONCE_SALT',       '^ee@s_Z0U|zDnW[0Tj$hNiv?9)LGrX`/bN5Z&|=s$:^m3%W%cKj=81hDv.3G;t94' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_blog_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
