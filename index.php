<?php
/**
 * Index file for SilverJet BareBone.
 *
 * Special adaptations for setting the seasons can be found in: /controller/common/header.php .
 * These need to be updated whenever a new season is implemented/started.
 *
 * @package BareBone 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  
  
/** Define version number */
define('VERSION', '0.0.1');

/** Include configuration file */
require_once('config.php');

/** Do Startup */
require_once(DIR_SYSTEM . 'startup.php');

/** Instantiate Registry */
$registry = new Registry();

/** Instantiate Loader */
$loader = new Loader($registry);
$registry->set('load', $loader);

/** Instantiate Config */
$config = new Config();
$registry->set('config', $config);

/** Instantiate Database */
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);
		
/** Load Settings */
$query = $db->query("SELECT * FROM " . FW_PREFIX . "setting");
 
foreach ($query->rows as $setting) {
	if (!$setting['serialized']) {
		$config->set($setting['key'], $setting['value']);
	} else {
		$config->set($setting['key'], unserialize($setting['value']));
	}
}

/** Instantiate Url */
$url = new Url(HTTP_SERVER, $config->get('config_use_ssl') ? HTTPS_SERVER : HTTP_SERVER);	
$registry->set('url', $url);
		
/** Instantiate Log  */
$log = new Log($config->get('config_error_filename'));
$registry->set('log', $log);

function error_handler($errno, $errstr, $errfile, $errline) {
	global $log, $config;
	
	switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = 'Notice';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = 'Warning';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = 'Fatal Error';
			break;
		default:
			$error = 'Unknown';
			break;
	}
		
	if ($config->get('config_error_display')) {
	 	echo '<b>' . $error . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b><br />';
	}
	
	if ($config->get('config_error_log')) {
		$log->write('PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	}

	return true;
}

/** Set Error Handler */
set_error_handler('error_handler');
		
/** Instantiate Request */
$request = new Request();
$registry->set('request', $request);

/** Instantiate Response */
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response); 

/** Instantiate Cache */
$cache = new Cache();
$registry->set('cache', $cache); 

/** Instantiate Session */
$session = new Session();
$registry->set('session', $session); 

/** Load Language */
$languages = array();

$query = $db->query("SELECT * FROM " . FW_PREFIX . "language"); 

foreach ($query->rows as $result) {
	$languages[$result['code']] = $result;
}

$config->set('config_language_id', $languages[$config->get('config_admin_language')]['language_id']);

/** Load Available Languages */
$language = new Language($languages[$config->get('config_admin_language')]['directory']);
$language->load($languages[$config->get('config_admin_language')]['filename']);	
$registry->set('language', $language); 		

/** Instantiate Document */
$document = new Document();
$registry->set('document', $document); 		

/** Instantiate User */
$registry->set('user', new User($registry));

/** Instantiate Front Controller */
$controller = new Front($registry);

//** Start Login */
$controller->addPreAction(new Action('common/home/login'));

/** Load Permission */
$controller->addPreAction(new Action('common/home/permission'));

/** Load Router */
if (isset($request->get['route'])) {
	$action = new Action($request->get['route']);
} else {
	$action = new Action('common/home');
}

/** Dispatch */
$controller->dispatch($action, new Action('error/not_found'));

/** Generate Output */
$response->output();
?>