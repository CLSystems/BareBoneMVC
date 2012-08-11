<?php
/**
 * Abstract class Model for SilverJet BareBone.
 *
 * @package BareBone\System\Engine 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

abstract class Model {
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
}
?>