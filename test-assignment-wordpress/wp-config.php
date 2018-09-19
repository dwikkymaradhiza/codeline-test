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
define('DB_NAME', 'wp_codeline');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '*[K%5#!n3=}!MzmD?zNT`.x*@S[@q+UaXS*`V6%Mcxz/@)?r$kIje{^^!E`{sfcm');
define('SECURE_AUTH_KEY',  '~+1Pv 40@-c6bO~]sR=}%*kd:6q#9<a :`*)#tNr(p@hbm=(CZ@o#ipyas9@JEM2');
define('LOGGED_IN_KEY',    'v>/Lr,Lw-QGp7KUiPry!4`|y_v!FG].5O$KkORz|u4~_d_4X4<aCELxn0$,vHTI@');
define('NONCE_KEY',        ']10RfvoCD%[Oj&,v#Wg9MMR)i7;)VrWa*^sumK9-Uy@S+wm^V@H-1W8YGrMWgZV>');
define('AUTH_SALT',        '6&>kI*!!_kRxlDO`Go BXl>i/@HI:nYQ[u_a/Ofwm-n?B8D@2GJ?[]JK]/6podxu');
define('SECURE_AUTH_SALT', 'RNb3mw0vY4DgY$Az>B82B:v!F*5lb{F6.kZJn?kcy]j{@,s)NA~?y[Kkl0)~UsNJ');
define('LOGGED_IN_SALT',   '$LIO]9Ul?&Wp8YOs9$:fq>;9|( @=VJ/h[T@i0ks/+J[3@oaf#4Tq~H/GPsZ4]]{');
define('NONCE_SALT',       'yTy-z:ivU}MME^lAj-ug8Tw2_2Qgq#ip!v=%FgeQJ/xnajb~+Pi#3vo*s3W4C$$c');

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

if (is_admin()) {
  add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
  define( 'FS_CHMOD_DIR', 0751 );
}
