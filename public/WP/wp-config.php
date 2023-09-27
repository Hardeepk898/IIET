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
define( 'DB_NAME', 'iiet' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'vishal@123' );

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
define( 'AUTH_KEY',         'F/_Y{$8/*B?!Nt5Xc9O!j!S8ciNyLy)b]}uXe5WU+fwjVQw!j;d9F1aT7Ux@58v ' );
define( 'SECURE_AUTH_KEY',  '$hznmT6x<S#I@z]~8oBD^|B[kb>!!kjUm*jh,n>=(blFrQ$9PM<w$Rgrm#TV<c(h' );
define( 'LOGGED_IN_KEY',    'i15,%}}m`HClj?pF (a1dqkPO|wj{_OQW@`_QvLCW*9j6-mOfGWS^G(Q[#e|Ci29' );
define( 'NONCE_KEY',        'a0bjVI hs(Cm]bBc?YAC`)lO$0-rACo,kNx&}3RW%W8rU% fJWzh,>}%TqQJ:RX!' );
define( 'AUTH_SALT',        't*5,!GQ3 o)R>yyE?.[ooh ^d]^U?HC?eL{vBOhk)a+@-~|S4]>1+rwhqT9FxyzB' );
define( 'SECURE_AUTH_SALT', '^[6hDQF;?p-oZKN&iICJ(]-t9.))p~9e0lWeVpp1acuWH+7.u-:@)$uv9`d;J&)[' );
define( 'LOGGED_IN_SALT',   'UF2dp>Wd)0+%+SJSiKsSzj`bqba4EcSp`{VW$`$<mOyKT3(SM,Gr(CoO44f8 k}+' );
define( 'NONCE_SALT',       'Q-|q}=aCF4`dGVn.$t@NfdD(Rn@E6W*tKH7YM71CVPFBh}d~{V?xbc1HbKO|fZMC' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
