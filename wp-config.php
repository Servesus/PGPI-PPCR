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
define( 'DB_NAME', 'PPCR' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '1^JEb!40yXiv&]L![WGC[Bwcj&Mb]2UbqR#7x=K^xFQR5$ v*/{%]wXAf^<*RX|2' );
define( 'SECURE_AUTH_KEY',  'Od X3bLmeZiGdnMFamFVjx.T$`h!G9hp:/| gYD2fb1(=7j,gP.h:ojgk9KHGSg6' );
define( 'LOGGED_IN_KEY',    '00>qz8Q7$C8SR- ~ZIEP4>T`##Eg!/#lEwcX$x|3B):-+WkT>P|)LInVxIs5&[R:' );
define( 'NONCE_KEY',        'J y$D>[V9Xj{Jxid 0s/p.~)O^={chXv]^MxQd>Y6Jj$C88{#:*o`va$kQ%2w:L~' );
define( 'AUTH_SALT',        'g/1i6^jE_Z;$r8cX>6wJ;j.: $4B~%B)xy,`!HR&l jG`D KXXUN,CoE+H.#|1J@' );
define( 'SECURE_AUTH_SALT', 'g+PrPimzYo*ZP5)I.]i|Tn0YBR&XtDN^9RrOp(P33)&&4r|Ajn)z3q7>d-9`T6Uj' );
define( 'LOGGED_IN_SALT',   'Fa~$kwP;Q`)=VtjoE2BXj}Z914IkpZ/SCafg$}$y+d;YA>/pRtuhh|GuflP@:xaX' );
define( 'NONCE_SALT',       '!K%-oWG+e]9h0h0:?ysu8.8{UX$o~,Yw|uT+i7ZGmwj:ls7V;G8(Gq+K;.2~$;?F' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
