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
define( 'DB_NAME', 'edugrou1_demo_egs' );

/** MySQL database username */
define( 'DB_USER', 'edugrou1_demo_egs' );

/** MySQL database password */
define( 'DB_PASSWORD', 'c!aAzkwGYd3{' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '>gfHO0ar0N5#Kz:[=SsZ%9Ou(J^;$8)c~HXK9&/j]m>JR#noLquVNhDL#2elnhiF' );
define( 'SECURE_AUTH_KEY',  '?p@[xUqX7U{{!5;ycf!:/*]tr ba>8f_f*aY]Az;,ZNO4&9Ru_Y8Ry;&gdmbJhBS' );
define( 'LOGGED_IN_KEY',    '.V>zZB~ aqV(eDPzUrbhz/iboxcO d[|P%k5JaM+wS)Q[iW&E=rnHyQl2@k+a-J1' );
define( 'NONCE_KEY',        '@8oS0}zoq`;v)g[JVGq{.]}-b{(F@*fxJ^,3 d:YA&J?;J =G4VGQ?SG;vx[oGa(' );
define( 'AUTH_SALT',        'kDoHVJ99 qK7F7/:pEN3nw}!Bs)xaBerdRG{]7_1:PXq,YU(9Q*9q:.[e[l{N`yn' );
define( 'SECURE_AUTH_SALT', '5FIAI^B7K+78KJHB:4D(T}N0l.@cg^Z`6N~fidpLnqPg6~5rWYj#z OY~|q2>EMt' );
define( 'LOGGED_IN_SALT',   ':kx2Acp[u/?enad/Ir=b|A*XZYJkW!WwHi[Q8W^_$uo9b%#d]uRc;MHWHgoBD0}S' );
define( 'NONCE_SALT',       'M5UW(|SEV1N?l6D=AzZ]:)3Yl4TCRG)j4&exHt)umhpW4b;7L1uNB7> 6vr,Xviy' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

define('WP_HOME','http://demo.edugroup.id/');
define('WP_SITEURL','http://demo.edugroup.id/');
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
@ini_set('display_errors',0);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
