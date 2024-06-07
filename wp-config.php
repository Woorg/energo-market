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

// define('WP_HOME', 'http://energo-market.loc');
// define('WP_SITEURL', 'http://energo-market.loc');


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'energo-market');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'mariadb');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

// if (!defined('WP_CLI')) {
//     define('WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
//     define('WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
// }



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'kjJOOnaFWKFWfHtWpOBqUSbF7s2zrIocaKiCqsNyZSNsWeS9FuzNsOzdroysuDyh');
define('SECURE_AUTH_KEY',  'VFtMZXbgvWS36tz5nYzcIaK72jZlLt7Bp2x7WjIzdsFm4mkGEDTTB2OjphsbDWBx');
define('LOGGED_IN_KEY',    'ETFXq8zmT9OsqW0N3uPJtLMdbw05vKFOB3xfSsER5zre6zJhuNa3T0obVaPzAvJw');
define('NONCE_KEY',        'AOerd7TwkyM358kPx7bJcHYFCwJHifmZa7vU6AwleEn0rCMkN7SaTLaPKZIHkDEA');
define('AUTH_SALT',        'pYnTbdOAglKjiq3jE73637F6IkawMqJsiMa1n1OdsJT5t7nImcJAqvdpqUXXh1pe');
define('SECURE_AUTH_SALT', 'J3KdNNaebEHjNfVGeFQQhnhnvq3c4jR0GPETWDHBYPKYae7xWqde5SoFBgAI9lqg');
define('LOGGED_IN_SALT',   'xAqikmbWOa97Caoz53kCnBZn21HGdsQqlpCCCQxJ4YzP3omSFP4VIxsfbwFxlKqO');
define('NONCE_SALT',       'rLvce8CnCWQdN9iUWhxUlAhLXBtMzJAiW5qMK0AOnykJEDCs3EBYaZBeszBskqHs');

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
define('WPCF7_LOAD_JS', true);
define('WPCF7_AUTOP', false);
define('WP_ROCKET_WHITE_LABEL_FOOTPRINT', true);
define('WP_ROCKET_WHITE_LABEL_ACCOUNT', true);
define('WP_CACHE_KEY_SALT', 'energo-market.loc');

define('WP_CACHE', false);
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_AUTO_UPDATE_CORE', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
