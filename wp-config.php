<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sherrillproperties');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '=a@g?+TNyp2z0ZG`v[Dv8VF9|9+4F$lh$P[zU8r]naC.|9s@.wr7[u)dNn)[hSF`');
define('SECURE_AUTH_KEY',  'tBC*U/V%Bs?wHti#N?v*a){o&v3X(0:pXao^[BL&qT- ve a?B[m`VI>vzy+HE`)');
define('LOGGED_IN_KEY',    '$?<$+Oa)y@hFf_^D8xAj+T9f?MC*N:!1lvR2/R]sC)N0L)>eu`gz$EW{=aw(mzQ:');
define('NONCE_KEY',        '%[TwI >RV!R5R e4~Ek<w24Ij-Du18uVl&v5e++8HoBE..w~;umBJr>.(DF|-ar+');
define('AUTH_SALT',        '3%8S*POdg4kI<nqBZ{Jy]stx=c(Xjh3^YGg+qWH,ql!m1GF2|6z5q%(%jx|x_*(:');
define('SECURE_AUTH_SALT', 'J3k6S{}nT}KX_TGo%UsdufxM_JoXS;}!d[@|jLY16Z,wo&_,q@Tu2d}yjAS613&!');
define('LOGGED_IN_SALT',   '$d*}Z(7 Py,PDX9W@hqu]3Pn3RsiCi-SH^T8tJAYVjw82]l;a!m@(;Rf9n|U&r6W');
define('NONCE_SALT',       'w;fn$%z(3U),eh9(I/KBGUeC2 .3+2$vJKJasPuf+M`Yd3?rCKk+=4=^A.mpReT)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sr_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
