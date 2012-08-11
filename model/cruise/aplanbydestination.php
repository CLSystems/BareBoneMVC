<?php
/**
 * Model class APlanByDestination for SilverJet BareBone.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseAPlanByDestination extends Model {
	
	public function getRoutesByDestination($port_dep='',$port_arr=''){
		$sql = "SELECT * 
				FROM " . DB_PREFIX . "cruise_route  
				WHERE port_departure LIKE '".$port_dep."%' 
				AND port_arrival LIKE '".$port_arr."%' 
				ORDER BY port_departure ASC 
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
	
	public function getShipNameByRouteId($route_id){
		$sql = "SELECT s.ship_name AS s_name 
				FROM " . DB_PREFIX . "cruise_route r 
				LEFT JOIN " . DB_PREFIX . "cruise_ship s ON r.ship_id = s.ship_id 
				WHERE r.route_id = '".$route_id."' 
				";
		$query = $this->db->query($sql);

		return $query->row['s_name'];
	}
	
	
	
}
?>