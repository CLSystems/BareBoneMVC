<?php
/**
 * Final class DB for SilverJet BareBone.
 *
 * @package BareBone\System\Library 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class DB {
	private $driver;
	/**
	* Function __contruct()
	* 
	* @param string $driver
	* @param string $hostname
	* @param string $username
	* @param string $password
	* @param string $database
	*
	* @return void
	*
	*/
	public function __construct($driver, $hostname, $username, $password, $database) {
		if (file_exists(DIR_DATABASE . $driver . '.php')) {
			require_once(DIR_DATABASE . $driver . '.php');
		} else {
			exit('Error: Could not load database file ' . $driver . '!');
		}
				
		$this->driver = new $driver($hostname, $username, $password, $database);
	}
	/**
	* Function query()
	* 
	* @param string $sql
	*
	* @return array|string
	*
	*/
  	public function query($sql) {
		return $this->driver->query($sql);
  	}
	/**
	* Function escape()
	* 
	* @param string $value
	*
	* @return string
	*
	*/
	public function escape($value) {
		return $this->driver->escape($value);
	}
	/**
	* Function countAffected()
	*
	* @return int
	*
	*/
  	public function countAffected() {
		return $this->driver->countAffected();
  	}
	/**
	* Function getLastId()
	*
	* @return int
	*
	*/
  	public function getLastId() {
		return $this->driver->getLastId();
  	}	
}
?>