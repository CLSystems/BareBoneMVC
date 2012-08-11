<?php
/**
 * Abstract class Controller for SilverJet BareBone.
 *
 * @package BareBone\System\Engine 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

abstract class Controller {
	protected $registry;	
	protected $id;
	protected $layout;
	protected $template;
	protected $children = array();
	protected $data = array();
	protected $output;
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
	 * Function forward().
	 *
	 * @param string $route
	 * @param array $args
	 * 
	 * @return void
	 */
	protected function forward($route, $args = array()) {
		return new Action($route, $args);
	}
	/**
	 * Function redirect().
	 *
	 * @param string $url
	 * @param int $status
	 * 
	 * @return void
	 */
	protected function redirect($url, $status = 302) {
		header('Status: ' . $status);
		header('Location: ' . str_replace('&amp;', '&', $url));
		exit();
	}
	/**
	 * Function getChild().
	 *
	 * @param string $child
	 * @param array $args
	 * 
	 * @return string
	 */
	protected function getChild($child, $args = array()) {
		$action = new Action($child, $args);
		$file = $action->getFile();
		$class = $action->getClass();
		$method = $action->getMethod();
	
		if (file_exists($file)) {
			require_once($file);

			$controller = new $class($this->registry);
			
			$controller->$method($args);
			
			return $controller->output;
		} else {
			trigger_error('Error: Could not load controller ' . $child . '!');
			exit();					
		}		
	}
	/**
	 * Function render().
	 *
	 * @return string
	 */
	protected function render() {
		foreach ($this->children as $child) {
			$this->data[basename($child)] = $this->getChild($child);
		}
		
		if (file_exists(DIR_TEMPLATE . $this->template)) {
			extract($this->data);
			
      		ob_start();
      
	  		require(DIR_TEMPLATE . $this->template);
      
	  		$this->output = ob_get_contents();

      		ob_end_clean();
      		
			return $this->output;
    	} else {
			trigger_error('Error: Could not load template ' . DIR_TEMPLATE . $this->template . '!');
			exit();				
    	}
	}
}
?>