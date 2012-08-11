<?php
/**
 * Final class Config for SilverJet BareBone.
 *
 * @package BareBone\System\Library 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Config {
	private $data = array();
	/**
	* Function get()
	* 
	* @return array|string|null
	*
	*/
  	public function get($key) {
    	return (isset($this->data[$key]) ? $this->data[$key] : null);
  	}	
	/**
	* Function set()
	* 
	* @return void
	*
	*/
	public function set($key, $value) {
    	$this->data[$key] = $value;
  	}
	/**
	* Function has()
	* 
	* @return array|string
	*
	*/
	public function has($key) {
    	return isset($this->data[$key]);
  	}
	/**
	* Function load()
	*
	* @param string $filename
	* 
	* @return void
	*
	*/
  	public function load($filename) {
		$file = DIR_CONFIG . $filename . '.php';
		
    	if (file_exists($file)) { 
	  		$cfg = array();
	  
	  		require($file);
	  
	  		$this->data = array_merge($this->data, $cfg);
		} else {
			trigger_error('Error: Could not load config ' . $filename . '!');
			exit();
		}
  	}
}
?>