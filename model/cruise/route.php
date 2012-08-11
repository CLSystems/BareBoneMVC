<?php
/**
 * Model class Route for BareBoneMVC.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseRoute extends Model {
	public function addRoute($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_route 
							SET 
							ship_id = '". $data['ship_id'] ."', 
							route_title = '". $data['route_title'] ."', 
							port_departure = '". $data['port_departure'] ."', 
							port_arrival = '". $data['port_arrival'] ."', 
							harbours = '". $data['harbours'] ."', 
							tax_harbours = '". $data['tax_harbours'] ."', 
							transfers = '". $data['transfers'] ."', 
							handling = '". $data['handling'] ."' 
						");
	}
	
	public function editRoute($route_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "cruise_route 
							SET 
							ship_id = '". $data['ship_id'] ."', 
							route_title = '". $data['route_title'] ."', 
							port_departure = '". $data['port_departure'] ."', 
							port_arrival = '". $data['port_arrival'] ."', 
							harbours = '". $data['harbours'] ."', 
							tax_harbours = '". $data['tax_harbours'] ."', 
							transfers = '". $data['transfers'] ."', 
							handling = '". $data['handling'] ."' 
							WHERE route_id = '" . (int)$route_id . "'
						");
	}
	
	public function deleteRoute($route_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_route 
							WHERE route_id = '" . (int)$route_id . "'
						");
	}	
	
	public function copyRoute($route_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_route 
									WHERE route_id = '" . $route_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$this->addRoute($data);
		}
	}
	
	public function getRoute($route_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_route 
									WHERE route_id = '" . (int)$route_id . "'
								");
		return $query->row;
	}
		
	public function getRoutes($data = array()) {
		if ($data) {
			$sql = "SELECT *
					FROM " . DB_PREFIX . "cruise_route r 
					LEFT JOIN " . DB_PREFIX . "cruise_ship s ON r.ship_id=s.ship_id  
					WHERE 1 
					";
	
			if($data['filter_route']){
				$sql .= " AND r.route_title LIKE '".$data['filter_route']."%' ";
			}
	
			if($data['filter_ship']){
				$sql .= " AND r.ship_id = '".$data['filter_ship']."' ";
			}
		
			if($data['filter_port_departure']){
				$sql .= " AND r.port_departure LIKE '".$data['filter_port_departure']."%' ";
			}

			if($data['filter_port_arrival']){
				$sql .= " AND r.port_arrival LIKE '".$data['filter_port_arrival']."%' ";
			}
	
			$sort_data = array(
				'r.route_title',
				's.ship_name',
				'r.port_departure',
				'r.port_arrival'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY r.route_title";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
		
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}		

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	

			$query = $this->db->query($sql);
			
			return $query->rows;
		} else {
			$query = $this->db->query("SELECT *
										FROM " . DB_PREFIX . "cruise_route r 
										LEFT JOIN " . DB_PREFIX . "cruise_ship s ON r.ship_id=s.ship_id  
										ORDER BY r.route_title ASC");

			$trip_data = $query->rows;

			return $trip_data;			
		}
	}
		
	public function getTotalRoutes($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_route r 
				WHERE 1 
				";
	
		if($data['filter_route']){
			$sql .= " AND r.route_title LIKE '".$data['filter_route']."%' ";
		}
	
		if($data['filter_ship']){
			$sql .= " AND r.ship_id = '".$data['filter_ship']."' ";
		}
	
		if($data['filter_port_departure']){
			$sql .= " AND r.port_departure LIKE '".$data['filter_port_departure']."%' ";
		}

		if($data['filter_port_arrival']){
			$sql .= " AND r.port_arrival LIKE '".$data['filter_port_arrival']."%' ";
		}
	
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	public function getRouteDropdownData(){
		$sql = "SELECT *
				FROM " . DB_PREFIX . "cruise_route r 
				LEFT JOIN  " . DB_PREFIX . "cruise_ship s ON r.ship_id=s.ship_id 
				ORDER BY r.route_title 
				";
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}


}
?>