<?php
/**
 * Final class Action for BareBoneMVC.
 *
 * @package BareBone\System\Engine 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Action {
	protected $file;
	protected $class;
	protected $method;
	protected $args = array();
	/**
	 * Function __contruct.
	 *
	 * @param string $route The module/function to be loaded
	 * @param array $arg Possible arguments to be passed
	 *
	 * @return void
	 */
	public function __construct($route, $args = array()) {
		$path = '';
		
		$parts = explode('/', str_replace('../', '', (string)$route));
		
		foreach ($parts as $part) { 
			$path .= $part;
			
			if (is_dir(DIR_APPLICATION . 'controller/' . $path)) {
				$path .= '/';
				
				array_shift($parts);
				
				continue;
			}
			
			if (is_file(DIR_APPLICATION . 'controller/' . str_replace('../', '', $path) . '.php')) {
				$this->file = DIR_APPLICATION . 'controller/' . str_replace('../', '', $path) . '.php';
				
				$this->class = 'Controller' . preg_replace('/[^a-zA-Z0-9]/', '', $path);

				array_shift($parts);
				
				break;
			}
		}
		
		if ($args) {
			$this->args = $args;
		}
			
		$method = array_shift($parts);
				
		if ($method) {
			$this->method = $method;
		} else {
			$this->method = 'index';
		}
	}
	/**
	 * Function getFile().
	 *
	 * @return string
	 */
	public function getFile() {
		return $this->file;
	}
	/**
	 * Function getClass().
	 *
	 * @return string
	 */
	public function getClass() {
		return $this->class;
	}
	/**
	 * Function getMethod().
	 *
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}
	/**
	 * Function getArgs().
	 *
	 * @return array
	 */
	public function getArgs() {
		return $this->args;
	}
}
?>