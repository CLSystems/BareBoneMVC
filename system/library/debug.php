<?php
/**
 * Final class Debug for SilverJet BareBone.
 *
 * @package BareBone\System\Library 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

final class Debug {
	/**
	 * Simple debugging method
	 *
	 * @param mixed $mixed
	 */
  	static function dump($mixed, $csv = false) {
		echo '<pre>';
		if($csv) {
			echo implode(', ', array_keys($mixed[0])) . "\n";
			echo '<hr/>';
			foreach ($mixed AS $line) {
				echo implode(', ', $line) . "\n";
			}
		} else {
			var_dump($mixed);
		}
		echo '</pre>';
		return $mixed;
  	}
	
	/**
	 * Debugging method for readable arrays
	 *
	 * @param array $data
	 */
	static function print_r_html ($data, $return_data=false){
		$data = print_r($data,true);
		$data = str_replace( " ","&nbsp;", $data);
		$data = str_replace( "\r\n","<br>\r\n", $data);
		$data = str_replace( "\r","<br>\r", $data);
		$data = str_replace( "\n","<br>\n", $data);
		
		$out = $data;
		$out .= '<br />';
	
		if (!$return_data) {
			echo $out;
		}else{ 
			return $out;
		}
	}
	

} # END final class Debug
?>