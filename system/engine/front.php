<?php
/**
 * Final classs Front for BareBoneMVC.
 *
 * @package BareBone\System\Engine 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Front {
	protected $registry;
	protected $pre_action = array();
	protected $error;
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
	 * Function addPreAction().
	 *
	 * @param string $pre_action
	 * 
	 * @return void
	 */
	public function addPreAction($pre_action) {
		$this->pre_action[] = $pre_action;
	}
	/**
	 * Function dispatch().
	 *
	 * @param string $action
	 * @param array #error
	 * 
	 * @return void
	 */
  	public function dispatch($action, $error) {
		$this->error = $error;
			
		foreach ($this->pre_action as $pre_action) {
			$result = $this->execute($pre_action);
					
			if ($result) {
				$action = $result;
				
				break;
			}
		}
			
		while ($action) {
			$action = $this->execute($action);
		}
  	}
	/**
	 * Function execute().
	 *
	 * @param string $action
	 * 
	 * @return string|array
	 */
	private function execute($action) {
		$file = $action->getFile();
		$class = $action->getClass();
		$method = $action->getMethod();
		$args = $action->getArgs();

		$action = '';

		if (file_exists($file)) {
			require_once($file);

			$controller = new $class($this->registry);
			
			if (is_callable(array($controller, $method))) {
				$action = call_user_func_array(array($controller, $method), $args);
			} else {
				$action = $this->error;
			
				$this->error = '';
			}
		} else {
			$action = $this->error;
			
			$this->error = '';
		}
		
		return $action;
	}
}
?>