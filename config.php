<?php
/**
 * Config file for BareBoneMVC.
 *
 * @package BareBoneMVC
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

	// HTTP
	define('HTTP_SERVER', 'http://www.yourdomain.com/');
	define('HTTP_CATALOG', 'http://www.yourdomain.com/');
	define('HTTP_IMAGE', 'http://www.yourdomain.com/image/');
	
	// HTTPS
	define('HTTPS_SERVER', 'http://www.yourdomain.com/');
	define('HTTPS_IMAGE', 'http://www.yourdomain.com/image/');
	
	// DIR
	define('DIR_APPLICATION', '/home/www-sites/BareBone/');
	define('DIR_SYSTEM', '/home/www-sites/BareBone/system/');
	define('DIR_DATABASE', '/home/www-sites/BareBone/system/database/');
	define('DIR_LANGUAGE', '/home/www-sites/BareBone/language/');
	define('DIR_TEMPLATE', '/home/www-sites/BareBone/view/template/');
	define('DIR_CONFIG', '/home/www-sites/BareBone/system/config/');
	define('DIR_IMAGE', '/home/www-sites/BareBone/image/');
	define('DIR_CACHE', '/home/www-sites/BareBone/system/cache/');
	define('DIR_DOWNLOAD', '/home/www-sites/BareBone/download/');
	define('DIR_LOGS', '/home/www-sites/BareBone/system/logs/');
	define('DIR_MODULES', '/home/www-sites/BareBone/modules/');
	
	// DB
	define('DB_DRIVER', 'mysql');
	define('DB_HOSTNAME', 'hostname_here');
	define('DB_USERNAME', 'username_here');
	define('DB_PASSWORD', 'password_here');
	define('DB_DATABASE', 'databasename_here');
	define('FW_PREFIX', 'framework__');
	define('DB_PREFIX', 'framework__');
?>