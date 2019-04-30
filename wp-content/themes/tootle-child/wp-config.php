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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', '24113f82590b29be6ebd01dead432f1d1a92712e2dbc3a0f');

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
define('AUTH_KEY',         'J1H|G~pKNky:++cYKy]t i0nDe ,I5vYy7&*^&2A@5Zfp^/q-:UG:ng}uh3{x&98');
define('SECURE_AUTH_KEY',  '4Xxk}5j}Lo>p~:dSMZMNnG`|<<ckXV>p6MRWR@#siY}`Om:&=$>k^lC`Kv7t,4hY');
define('LOGGED_IN_KEY',    'P;}<~<a[rTBW8tElJJ<B1F8ASpO|G8R%N[cNP=NJ=x%eCYR|Z[P[,6w%g5*dR2.C');
define('NONCE_KEY',        '4n~[6MHop~!8fu}xKSm_SJ?,bIRG@i-0cbr{{#ou+ug$!?(L*KrPS<oJJHLRfpOu');
define('AUTH_SALT',        '2a_[u|NZmU7VtI=(Dz5o*sF2+or0~uUC@;:.&ohnIhS1;g3j7)aZo:!a>TgQ[Y>t');
define('SECURE_AUTH_SALT', '^uJ:m.{0yF@_woBrHQ+yg4+AC&;k -AVX!2aZ|`A/XeVe6:gtn@%9MQGX_^ThG`Q');
define('LOGGED_IN_SALT',   '`u&O]{VsJW,=5f&M?G2IDKZ$K2(lu,@):0j/&ycSxHz|WJ<x@.1S-*r7Tuhye8[2');
define('NONCE_SALT',       'xDeVIfvV@_]S$5fQ1*dSqJOgIrnS,DCtg.!O8o,u-$Yc%hy09me*#w.zJThbgUv}');

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
define('RELOCATE',true);
define('FS_METHOD','direct');
//define('DISALLOW_FILE_MODS',true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
