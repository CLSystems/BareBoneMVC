<?php
/**
 * Final class Cache for BareBoneMVC.
 *
 * @package BareBone\System\Library 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Cache { 
	private $expire = 3600; 
	/**
	 * Function __contruct().
	 *
	 * @param array $registry
	 * 
	 * @return void
	 */
  	public function __construct() {
		$files = glob(DIR_CACHE . 'cache.*');
		
		if ($files) {
			foreach ($files as $file) {
				$time = substr(strrchr($file, '.'), 1);

      			if ($time < time()) {
					if (file_exists($file)) {
						unlink($file);
						clearstatcache();
					}
      			}
    		}
		}
  	}
	/**
	 * Function get().
	 *
	 * @param string $key
	 * 
	 * @return array
	 */
	public function get($key) {
		$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');

		if ($files) {
			$cache = file_get_contents($files[0]);
			
			return unserialize($cache);
		}
	}
	/**
	 * Function set().
	 *
	 * @param string $key
	 * @param string|array $value
	 * 
	 * @return void
	 */
  	public function set($key, $value) {
    	$this->delete($key);
		
		$file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $this->expire);
    	
		$handle = fopen($file, 'w');

    	fwrite($handle, serialize($value));
		
    	fclose($handle);
  	}
	/**
	 * Function delete().
	 *
	 * @param string $key
	 * 
	 * @return void
	 */
  	public function delete($key) {
		$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
		
		if ($files) {
    		foreach ($files as $file) {
      			if (file_exists($file)) {
					unlink($file);
					clearstatcache();
				}
    		}
		}
  	}
}
?>