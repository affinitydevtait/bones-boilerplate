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

/* ***************************************************************************
 * Boilerplate Version 2.2.0 WP Config Modifications
 * Custom Constant Settings 
 * - Enable these as see fit
 * ************************************************************************** */

/*********** Set the number of revisions to avoid databse bloating ************/
/*
 * When editing a post, WordPress uses Ajax to auto-save revisions to the post 
 * as you edit. You may want to increase this setting for longer delays in between 
 * auto-saves, or decrease the setting to make sure you never lose changes. 
 * The default is 60 seconds.
 * 
 * If you do not set this value, WordPress defaults WP_POST_REVISIONS to true 
 * (enable post revisions). If you want to disable the awesome revisions feature, 
 * use this setting.
 */

//define('WP_POST_REVISIONS', 5);
//define('WP_POST_REVISIONS', false ); //enable to disable revisions

/******************************************************************************/
/************************ Moving wp-content folder ****************************/
/*
 * Since Version 2.6, you can move the wp-content directory, which holds your 
 * themes, plugins, and uploads, outside of the WordPress application directory.
 * 
 * Set to the full local path of this directory (no trailing slash)
 */

//define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/blog/wp-content' );	
//define( 'WP_CONTENT_URL', 'http://example/blog/wp-content');

/******************************************************************************/
/************************** Moving plugin folder ******************************/

//define( 'WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/blog/wp-content/plugins' );
//define( 'PLUGINDIR', $_SERVER['DOCUMENT_ROOT'] . '/blog/wp-content/plugins' );

/******************************************************************************/
/************************** Moving uploads folder *****************************/
/*
 * This path can not be absolute. It is always relative to ABSPATH
 */

//define( 'UPLOADS', '/blog/wp-content/uploads' ); // This is a good feature to use

/******************************************************************************/
/************************ Modify AutoSave Interval ****************************/

//define('AUTOSAVE_INTERVAL', 160 );  // seconds

/******************************************************************************/
/***************************** Set Cookie Domain ******************************/
/*
 * The domain set in the cookies for WordPress can be specified for those with 
 * unusual domain setups. One reason is if subdomains are used to serve static 
 * content. To prevent WordPress cookies from being sent with each request to 
 * static content on your subdomain you can set the cookie domain to your 
 * non-static domain only.
 */

//define('COOKIE_DOMAIN', 'wwwexample.com');

/******************************************************************************/
/***************************** Increase Memory ******************************/
/*
 * Also released with Version 2.5, the WP_MEMORY_LIMIT option allows you to 
 * specify the maximum amount of memory that can be consumed by PHP. 
 * This setting may be necessary in the event you receive a message such as 
 * "Allowed memory size of xxxxxx bytes exhausted".
 * 
 * This setting increases PHP Memory only for WordPress, not other applications.
 *  By default, WordPress will attempt to increase memory allocated to PHP to 40MB 
 * (code is at beginning of wp-settings.php), so the setting in wp-config.php 
 * should reflect something higher than 40MB.
 * 
 * WordPress will automatically check if PHP has been allocated less memory 
 * than the entered value before utilizing this function. For example, if PHP has 
 * been allocated 64MB, there is no need to set this value to 64M as WordPress 
 * will automatically use all 64MB if need be.
 * 
 * Please note, this setting may not work if your host does not allow for increasing 
 * the PHP memory limit--in that event, contact your host to increase the 
 * PHP memory limit. Also, note that many hosts set the PHP limit at 8MB.
 */

//define('WP_MEMORY_LIMIT', '96M');
//define('WP_MAX_MEMORY_LIMIT', '256M');

/******************************************************************************/
/***************************** Empty Trash ******************************/
/*
 * Added with Version 2.9, this constant controls the number of days before 
 * WordPress permanently deletes posts, pages, attachments, and comments, 
 * from the trash bin. The default is 30 days.
 * 
 * To disable trash set the number of days to zero. Note that WordPress will 
 * not ask for confirmation when someone clicks on "Delete Permanently"
 */

//define('EMPTY_TRASH_DAYS', 30 );  // 30 days

/******************************************************************************/
/***************************** Enable WP Cache ******************************/
/*
 * The WP_CACHE setting, if true, includes the wp-content/advanced-cache.php 
 * script, when executing wp-settings.php.
 */

//define('WP_CACHE', true);

/******************************************************************************/
/*********************** Automatic Database Optimizing ************************/
/*
 * Added with Version 2.9, there is automatic database optimization support, 
 * which you can enable by adding the following define to your wp-config.php 
 * file only when the feature is required
 */

//define('WP_ALLOW_REPAIR', true);


/* 
 * MySQL settings - You can get this info from your web host 
 */

/* The name of the database for WordPress */
if($_SERVER['HTTP_HOST'] == 'localhost') {
	
	define('DB_NAME', 'bones');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_HOST', 'localhost');
	define('WP_HOME', 'http://localhost/boilerplate/wordpress-bones');
	define('WP_SITEURL', 'http://localhost/boilerplate/wordpress-bones');

} elseif($_SERVER['HTTP_HOST'] == 'dev9.affinitynewmedia.com') {


	define('ANM_MODE', 'DEV');
	define('DB_NAME', 'DB_NAME');
	define('DB_USER', 'DB_USER');
	define('DB_PASSWORD', 'DB_PASSWORD'); //generate @ http://strongpasswordgenerator.com/
	define('DB_HOST', 'localhost');
	define('WP_HOME', 'http://dev9.affinitynewmedia.com/boilerplate');
	define('WP_SITEURL', 'http://dev9.affinitynewmedia.com/boilerplate');

} else {

	define('ANM_MODE', 'LIVE');
	define('DB_NAME', '');
	define('DB_USER', '');
	define('DB_PASSWORD', '');
	define('DB_HOST', 'localhost');
	define('WP_HOME', '');
	define('WP_SITEURL', '');
}

define('DB_CHARSET', 'utf8');
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
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
