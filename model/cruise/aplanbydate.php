<?php
/**
 * Model class APlanByDate for SilverJet BareBone.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseAPlanByDate extends Model {
	
	public function getCruisesByDate($date_departure,$date_arrival){
		$date_dep = explode('-', $date_departure);
		$date1 = date('Y-m-d', gmmktime(0,0,0,$date_dep[1],$date_dep[0],$date_dep[2]));
		$date_arr = explode('-', $date_arrival);
		$date2 = date('Y-m-d', gmmktime(0,0,0,$date_arr[1],$date_arr[0],$date_arr[2]));
		$sql = "SELECT * 
				FROM " . DB_PREFIX . "cruise_cruise  
				WHERE date_departure >= '".$date1."' 
				AND date_arrival <= '".$date2."' 
				ORDER BY date_departure ASC 
				";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getCabinsByCruiseId($cruise_id){
		$sql = "SELECT * 
				FROM " . DB_PREFIX . "cruise_price  
				WHERE cruise_id = '".$cruise_id."' 
				ORDER BY price ASC 
				";
		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getCabinTypeByCabinId($cabin_id){
		$sql = "SELECT ct.cabin_type_name AS ct_name
				FROM " . DB_PREFIX . "cruise_cabin_type ct
				LEFT JOIN " . DB_PREFIX . "cruise_cabin c ON ct.cabin_type_id = c.cabin_type_id 
				WHERE c.cabin_id = '".$cabin_id."' 
				";
		$query = $this->db->query($sql);

		return $query->row['ct_name'];
	}
	
	public function getCabinCategoryByCabinId($cabin_id){
		$sql = "SELECT cc.cabin_category_name AS cc_name 
				FROM " . DB_PREFIX . "cruise_cabin_category cc 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin c ON cc.cabin_category_id = c.cabin_category_id 
				WHERE c.cabin_id = '".$cabin_id."' 
				";
		$query = $this->db->query($sql);

		return $query->row['cc_name'];
	}
	
	public function getCabinDescrByCabinId($cabin_id){
		$sql = "SELECT description  
				FROM " . DB_PREFIX . "cruise_cabin_description 
				WHERE cabin_id = '".$cabin_id."' 
				AND active_from <= NOW() 
				AND active_untill >= NOW() 
				ORDER BY active_untill ASC 
				LIMIT 0,1
				";
		$query = $this->db->query($sql);

		return $query->row['description'];
	}
	
	public function getShipNameByTripId($trip_id){
		$sql = "SELECT s.ship_name AS s_name 
				FROM " . DB_PREFIX . "cruise_trip t 
				LEFT JOIN " . DB_PREFIX . "cruise_ship s ON t.ship_id = s.ship_id 
				WHERE t.trip_id = '".$trip_id."' 
				";
		$query = $this->db->query($sql);

		return $query->row['s_name'];
	}
	
	
	
}
?>