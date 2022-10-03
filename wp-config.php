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
define( 'DB_NAME', 'team4_camberwell_dragons' );

/** MySQL database username */
define( 'DB_USER', 'camberwell_dragons' );

/** MySQL database password */
define( 'DB_PASSWORD', '4v4tTIvCjhaUWYqi' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '4B6tTT&RA(5[]1>]XDXpx$!zt+Hpy&msG|nmVW&UOD+o0=RF(/Ui{]9oY4}hSErz' );
define( 'SECURE_AUTH_KEY',  'chjC:?Ub6C=5U]/^cWI?X`;[!R>Mu2_]P%E_X1).8Q6-|a:OOC9bnWe&#B!6| _^' );
define( 'LOGGED_IN_KEY',    'CN?2j,sEgQu1ABf2){.o~Y]1V$&)Ia_+NJvit:-/^H/H/.I{oZa=y;77jaipkjDx' );
define( 'NONCE_KEY',        '17;SW*HfC.vQN@02Ra=hkG3OS!djIDO2/pNIH0V#3=h*#pfX|e;>ZwM#b2.aI6R:' );
define( 'AUTH_SALT',        '&6@4nG.*IxbG{B fihBH|fVte|yuU1p4F=5^Ya;luJ8xep)a7cx^CK7;6_55Y)YS' );
define( 'SECURE_AUTH_SALT', '04@P@)@LRsxc|e.t%w!7B5PR6M`]<A*Zpoa8,-V)SRHvr=naZH?]jSSF*<~zL:Y$' );
define( 'LOGGED_IN_SALT',   '|0dqn`t~WJsSDK@&mNwWKn&qG8dS/E,ySNvjMY`dRk&Xc`Aq7>A9d,`53cN0JJYn' );
define( 'NONCE_SALT',       'a6<Z`wIApx^@N%>rZ#8;QPedAkF0@DY^~4L;O4,U/_<3@<l(ZkyzWQ1H(/~pTw ?' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'dragons_wp_';

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
define('ALLOW_UNFILTERED_UPLOADS', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Disable revisosion */
define('WP_POST_REVISIONS', false);

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

