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
define('DB_NAME', 'glenncook');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '46(<;D8tu6C>Qj,Svz`i29HL;H@0FuD>B/2s;^N+=R_DS_b NEM:8|Agv0#K[L6e');
define('SECURE_AUTH_KEY',  '|<8y=LbL}:q?APTC;y 5B?$1Ot:MB+?.;=,JnZIX-hxLfMJ:(NtcEKa4)R%io#!&');
define('LOGGED_IN_KEY',    'g@cX7y&/,{8Pj(&|0j0oy>ba`Q7{=m1Gt(Qp-<%-lc<Rsm#F6Yxi|WbcY aK_m(@');
define('NONCE_KEY',        'AeR{PcvI=o.v]6&_F5N12!}/@ZthXgm]9T69vat+9{GvRdUy.-fLGg1b$tQPIZf7');
define('AUTH_SALT',        'u:pixqWkL.,a@NeiS2;jlS$0O7LSBmpa TB?CtAteOYoH/i!i`UEmvlXr5 uMpzj');
define('SECURE_AUTH_SALT', 'BaL{A,,6$@x@^i@iZ;@LF0X[+cT+3vVRtZ?_ ZZlPNo=[mhI}555/9M` %R{yh=w');
define('LOGGED_IN_SALT',   'jLe(>;h#^t>J=)2u=SVY[`WVlbmh8+EI;D]gwu1+.i@*19w`_O=SHsQUQ>(VxX /');
define('NONCE_SALT',       '7=lenvxmwgV&F3e7h9BZ7%gq4elbMAy]q,_mB=*>Oxv|Nt_T:o}/B)=FWII!HQ}e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
