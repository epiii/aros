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
define('DB_NAME', 'aros');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '*f{1Doa2+/7:x#st$9`r^2*SqP3Ea0q|0pNj|)xZN= wjPs!+-|bzjH,{W4@Z%Uo');
define('SECURE_AUTH_KEY',  'S/XOE7ngH6s|9}^!YK:&r[A-?qn6bIo+&R^Gm5:Jni.j|_I1BLv>0G;33Kfi4d]5');
define('LOGGED_IN_KEY',    ']=e4ndXRW/7U9M`RJ0/2Gb)y(#;do&I!|-@)XT$xO8!`+*g846+3<Ii[Zv#>JYJM');
define('NONCE_KEY',        ',aAy4*9|:saXH~v0,}heYn2ke#AfJq#Xj!1XVh%^;ThBros:VXZuVTF)kEy?A-t5');
define('AUTH_SALT',        'H~7@2~1($b3+N2aTq/m&M^8 {-CHvi?qSHBwXI2K|k+6-yC9Ay`PW#^96)%QXr}X');
define('SECURE_AUTH_SALT', '{NbSQ]Xm>Q0AA(b`ewcZk-eA-Q0!F86-},P*M+;.+`JVpKfgFN<1}3}Dm#Jm.|c|');
define('LOGGED_IN_SALT',   'qeO @s2C6rtXKx/PxAUYkc0cp9nQ6xD~^P<rws,-#d$ @+^:|J0v+QvyurMxf7TI');
define('NONCE_SALT',       ',W#=gHU)w9GZmu]_MjY.@@-J]5-vV5 r-FhHfXp2R@nxux;t+nRD-j#7s}+v1@om');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ar_';

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
