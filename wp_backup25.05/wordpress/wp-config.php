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
define('DB_NAME', 'sinsuk17_wordpressdb');

/** MySQL database username */
define('DB_USER', 'sinsuk17_admin');

/** MySQL database password */
define('DB_PASSWORD', 'WebPro101');

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
define('AUTH_KEY',         '61ced3e9f504d3385c7d990281e04ecc023155776f8cc314656ffbd971e4a5ce');
define('SECURE_AUTH_KEY',  '3497ab40f247ee59c424a3ac7fb2b503ed3028e81a924dc2b6b1bed83d7e7ef2');
define('LOGGED_IN_KEY',    '6ac49b0a232a2b8b6c43191126ccd25332962dd4dfc686ba52327008ca7b4c5f');
define('NONCE_KEY',        'b91fd6aac577f5201cdc7216f4291d8e0d158f6e3913b117f1b55970ca5fdc12');
define('AUTH_SALT',        '16d394186b9b94bb2e7f25996294fb2b88467fa4549f230a5bf899180d04d5a7');
define('SECURE_AUTH_SALT', 'c57ceb58fc17c159affe30c858c24f030554a4d50925acc934cfdd51e138eab5');
define('LOGGED_IN_SALT',   'c55ebd36c8a573c33979dc6368b7027675ab9e55bb69fa879c6c8e3c5ea5916d');
define('NONCE_SALT',       '354309acd687c8e538e85351e0ba86c60fa73a6b0894d8f2baec0264433be0b9');

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

/* That's all, stop editing! Happy blogging. */
/**OME
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

if ( defined( 'WP_CLI' ) ) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}
/*
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
*/

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**define('WP_TEMP_DIR', 'C:\Users\koshpreet brar\Documents\Bitnami/apps/wordpress/tmp');*/



//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/?page=apps&name=wordpress&section=how-to-re-enable-the-xml-rpc-pingback-feature

if ( !defined( 'WP_CLI' ) ) {
    // remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    // disable pingbacks
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}
