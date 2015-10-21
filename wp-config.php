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
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress/lemongrid');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress/lemongrid');

/** The name of the database for WordPress */
define('DB_NAME', 'bears_lemongrid');

/** MySQL database username */
define('DB_USER', 'bears_lemongrid');

/** MySQL database password */
define('DB_PASSWORD', 'Developer20');

/** MySQL hostname */
define('DB_HOST', '188.166.245.6');

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
define('AUTH_KEY',         'hF5~_pL{5SV.7=.Dk}/]1?Sl$BzT<q8QJ/bwd{-=fl[SApX_?-74%|hD**D31(cd');
define('SECURE_AUTH_KEY',  '5&{|>9b8wu<+-[NXth3,^TG~y/+T|&+yww&DY# iOOF|hl|N5X99| 1JVZL&+p.w');
define('LOGGED_IN_KEY',    'x(fo?>;2}^lV1_t8$| K8^4cky1hMU*D34j10J|FWLr8s0ajC}X@ef40Rv4dTfb0');
define('NONCE_KEY',        'GMRzIl`E}PQ[Df6}>><EJ`J3Ku5+o6j;oOaMs!U+gNmX^4ug;MDYK*r_ahzCg~hS');
define('AUTH_SALT',        '=Rnr^x9embAWlg0?7P]foY9F8f8,Y Mk?l]^Wau0#5Ko`!wgi;rZs2G|8D 8 &7l');
define('SECURE_AUTH_SALT', 'E3(tRINh^(Ok7U<-+V||{#$2d%b Az^3lF9N4}1!k(2k}9,2|4K,E<iA8fZXytd2');
define('LOGGED_IN_SALT',   'Z!5{YBn_E(%tjYY`YF#^(V-n@fLOt&aLMxq/k<Yi&Uw0H1bO]OOmo^p[e0R%  )V');
define('NONCE_SALT',       '~-Bs5NdPnQ7(nfD^-_rTRjL4>q=.Ne6*.V)JllCBX5(E/-y)YZi!Yw-J+Za>>`S9');

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
