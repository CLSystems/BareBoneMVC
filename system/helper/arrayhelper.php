<?php
/**
 * Helper file for SilverJet BareBone.
 *
 * Contains several functions to manipulate arrays.
 *
 * @package BareBone\System\Helper 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  
/**
 * Function deep_ksort sorts every level of an array by key.
 * 
 * @param array $arr The array that will be sorted by key.
 *
 * @return void
 * 
 */
function deep_ksort(&$arr) {
	ksort($arr);
	foreach ($arr as &$a) {
		if (is_array($a) && !empty($a)) {
			deep_ksort($a);
		}
	}
} 
  
/**
 * Function array_pluck returns a single item from an associative array.
 * 
 * @param string $key The item wanted
 * @param array $input The array where the item is in
 *
 * @return array
 * 
 */
function array_pluck($key, $input) {
	if (is_array($key) || !is_array($input)) return array();
	$array = array();
//	foreach($input as $v) {
		if(array_key_exists($key, $input)) { $array=$input[$key]; }
//	}
	return $array;
} 
  
/**
 * Function array_put_to_position inserts an item into an array at the given position.
 * 
 * @param array $array The array to store in
 * @param array $object The object to be stored
 * @param int $position The position to store the object at
 * @param string $name The name the item should be given
 *
 * @return array
 * 
 */
function array_put_to_position(&$array, $object, $position, $name = null){
	$count = 0;
	$inserted = false;
	$return = array();
	foreach ($array as $k => $v){  
		// insert new object
		if ($count == $position){  
			if (!$name) $name = $count;
			$return[$name] = $object;
			$inserted = true;
		}  
		// insert old object
		$return[$k] = $v;
		$count++;
	}  
	if (!$name) $name = $count;
	if (!$inserted) $return[$name];
	$array = $return;
	return $array;
}

?>