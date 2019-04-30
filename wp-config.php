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
define('DB_NAME', 'wordbetterpre');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sudip');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'g4wAP+!$~::@0FIzFCm)pH=dsT%*Y/Rs8Ru6GD(KuX_6]OK$(HZPMz^jOiN2WC%_');
define('SECURE_AUTH_KEY',  '3~e0-Ai:N+-v?@PUf(Y@-@}2,cK3h1nhp_GJ]&J8[$}dMBSe<@y~_f(1|k]5}RWY');
define('LOGGED_IN_KEY',    '8K)/M+zap|t}._]uj);JT-SsKHR5L$6)YJky&1(3{&PceWk*I^{U)Cp@vw!w=JW1');
define('NONCE_KEY',        'VZ?=lnl{f!ea#Zh6}o(6p3=}Hq0HYv0{qE38[IG9D~I&v:v}}YN/I-[$*/:U7~ 8');
define('AUTH_SALT',        '7w6`*dD-$W9WRs04niJ<i|) Jq^p?05zW&H;uAn#F3A^%UCHu{Pgh H-=v(DZtFK');
define('SECURE_AUTH_SALT', 'k(d>ZoP84iJAae!bt<cR)8eJxkQ07HZf OPy_jbFBp2MNxlKCi;rnk1O-9xETH^c');
define('LOGGED_IN_SALT',   'n;wTEI8v_3fb!VEnalqo).06L!>0+vgcQL8$^]%9Dh/wvbk;yHbk%j [h~cEHa<%');
define('NONCE_SALT',       '*bWfqsob?oY+0dps!VG7hS5pljBpi,EeO)4&<&Hyr=VUQC[hfzL$?#hXUTXEC2:/');

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
define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
