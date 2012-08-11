<?php
/**
 * Final class Loader for SilverJet BareBone.
 *
 * @package BareBone\System\Engine 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Loader {
	protected $registry;
	/**
	 * Function __contruct().
	 *
	 * @param array $registry
	 * 
	 * @return void
	 */
	public function __construct($registry) {
		$this->registry = $registry;
	}
	/**
	 * Function __get().
	 *
	 * @param string $key
	 * 
	 * @return array
	 */
	public function __get($key) {
		return $this->registry->get($key);
	}
	/**
	 * Function __set().
	 *
	 * @param string $key
	 * @param string|array $value
	 * 
	 * @return void
	 */
	public function __set($key, $value) {
		$this->registry->set($key, $value);
	}
	/**
	 * Function library().
	 *
	 * @param string $library
	 * 
	 * @return void
	 */
	public function library($library) {
		$file = DIR_SYSTEM . 'library/' . $library . '.php';
		
		if (file_exists($file)) {
			include_once($file);
		} else {
			trigger_error('Error: Could not load library ' . $library . '!');
			exit();					
		}
	}
	/**
	 * Function model().
	 *
	 * @param string $model
	 * 
	 * @return void
	 */
	public function model($model) {
		$file  = DIR_APPLICATION . 'model/' . $model . '.php';
		$class = 'Model' . preg_replace('/[^a-zA-Z0-9]/', '', $model);
		
		if (file_exists($file)) {
			include_once($file);
			
			$this->registry->set('model_' . str_replace('/', '_', $model), new $class($this->registry));
		} else {
			trigger_error('Error: Could not load model ' . $model . '!');
			exit();					
		}
	}
	/**
	 * Function database().
	 *
	 * @param string $driver
	 * @param string $hostname
	 * @param string $username
	 * @param string $password
	 * @param string $database
	 * @param string $prefix
	 * @param string $charset
	 * 
	 * @return void
	 */
	public function database($driver, $hostname, $username, $password, $database, $prefix = NULL, $charset = 'UTF8') {
		$file  = DIR_SYSTEM . 'database/' . $driver . '.php';
		$class = 'Database' . preg_replace('/[^a-zA-Z0-9]/', '', $driver);
		
		if (file_exists($file)) {
			include_once($file);
			
			$this->registry->set(str_replace('/', '_', $driver), new $class());
		} else {
			trigger_error('Error: Could not load database ' . $driver . '!');
			exit();				
		}
	}
	/**
	 * Function config().
	 *
	 * @param string $config
	 * 
	 * @return void
	 */
	public function config($config) {
		$this->config->load($config);
	}
	/**
	 * Function language().
	 *
	 * @param string $language
	 * 
	 * @return void
	 */
	public function language($language) {
		return $this->language->load($language);
	}
} 
?>