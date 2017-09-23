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
define('DB_NAME', 'thescript');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'kini419,247');

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
define('AUTH_KEY',         ' ojgY1J,r7 ^rkh!2 aHC Tr&n=2s5?@ZhT`>ox7j+Xm<Ujp!UOe7:xLxVSV-rY7');
define('SECURE_AUTH_KEY',  'es^.DvnIsH@dtOxPFIc3<S]HG#xdcS Z0$>jw_9`GwQ^ODB|fJ[A3.(22w[7kuVE');
define('LOGGED_IN_KEY',    'w ^O8@uc[EmD,_Glvy4&6}rYJB7xdlw*5Ys$y1}w#e7<Z!6`S8+N5V1m8_=<YUY-');
define('NONCE_KEY',        'wjt:gx>ap)xe1cvFb&f(NRy:rIdK}c& F*-oPMD.aM8poi7o;50v&>mLJnT?9jrk');
define('AUTH_SALT',        '<6N3 sq3Rz-!%M+DzIBloz%Ffna0.5v#,m-=f50/$huj?)EhPzG-[q^w^]8Eap1<');
define('SECURE_AUTH_SALT', 'pEg2(Ah{VE|*sQ4oy2Orb{-(7KZ]Nzz^ZCbkIlIo7(Rhv{Jf=NNm9$!Nj8.4};Cd');
define('LOGGED_IN_SALT',   '.*{l9v:EY-0gV7rk&E_kbI:,FwD5O6gzG@X:Ov&#rB^KEs:oI7Vn~i2!r.%[c&}k');
define('NONCE_SALT',       '7.{7h)w$KCOwJXcd:m}w_r nQSPxVui GGg]K$-)}u`O=*CQJsZUXmgWv)dN5.Sd');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_thescript';

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
