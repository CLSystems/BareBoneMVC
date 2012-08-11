<?php
/**
 * Final class Registry for BareBoneMVC.
 *
 * @package BareBone\System\Engine 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Registry {
	private $data = array();
	/**
	 * Function get().
	 *
	 * @param string $key
	 * 
	 * @return array|null
	 */
	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : NULL);
	}
	/**
	 * Function get().
	 *
	 * @param string $key
	 * @param array|string $value
	 * 
	 * @return void
	 */
	public function set($key, $value) {
		$this->data[$key] = $value;
	}
	/**
	 * Function has().
	 *
	 * @param string $key
	 * 
	 * @return array|string
	 */
	public function has($key) {
    	return isset($this->data[$key]);
  	}
}
?>