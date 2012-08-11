<?php
/**
 * Model class Cruise for BareBoneMVC.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseCruise extends Model {
	public function addCruise($data) {

		$start_date = explode('-', $data['date_departure']);
		$date_dep = date('Y-m-d', gmmktime(0,0,0, $start_date[1],$start_date[0],$start_date[2])); 
	
		$end_date = explode('-', $data['date_arrival']);
		$date_arr = date('Y-m-d', gmmktime(0,0,0, $end_date[1],$end_date[0],$end_date[2])); 
	
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cruise 
							SET 
							route_id = '". $data['route_id'] ."', 
							date_departure = '". $date_dep ."', 
							time_departure = '". $data['time_departure'] ."', 
							date_arrival = '". $date_arr ."', 
							time_arrival = '". $data['time_arrival'] ."',
							flight = '". $data['flight'] ."',
							taxes = '". $data['taxes'] ."',
							hotel = '". $data['hotel'] ."'
						");
		$cruise_id = $this->db->getLastId();
		foreach($data['descriptions'] as $description){
			$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cruise_description 
								SET 
								cruise_id = '". $cruise_id ."', 
								description = '". $description['description'] ."', 
								active_from = '". $description['active_from'] ."', 
								active_untill = '". $description['active_untill'] ."' 
							");
		}
	}
	
	public function editCruise($cruise_id, $data) {

		$start_date = explode('-', $data['date_departure']);
		$date_dep = date('Y-m-d', gmmktime(0,0,0, $start_date[1],$start_date[0],$start_date[2])); 
	
		$end_date = explode('-', $data['date_arrival']);
		$date_arr = date('Y-m-d', gmmktime(0,0,0, $end_date[1],$end_date[0],$end_date[2])); 
	
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_cruise 
							SET 
							route_id = '". $data['route_id'] ."', 
							date_departure = '". $date_dep ."', 
							time_departure = '". $data['time_departure'] ."', 
							date_arrival = '". $date_arr ."', 
							time_arrival = '". $data['time_arrival'] ."',
							flight = '". $data['flight'] ."',
							taxes = '". $data['taxes'] ."',
							hotel = '". $data['hotel'] ."' 
							WHERE cruise_id = '" . (int)$cruise_id . "'
						");
		if($data['descriptions']) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cruise_description 
								WHERE cruise_id = '" . (int)$cruise_id . "'
							");
			foreach($data['descriptions'] as $description){
				$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cruise_description 
									SET 
									cruise_id = '". (int)$cruise_id ."', 
									description = '". $description['description'] ."', 
									active_from = '". $description['active_from'] ."', 
									active_untill = '". $description['active_untill'] ."' 
								");
			} // END foreach
		} // END if
	}
	
	public function deleteCruise($cruise_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cruise 
							WHERE cruise_id = '" . (int)$cruise_id . "'
						");
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cruise_description 
							WHERE cruise_id = '" . (int)$cruise_id . "'
						");
	}	
	
	public function copyCruise($cruise_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_cruise 
									WHERE cruise_id = '" . $cruise_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			$descriptions = array();
			
			$descr_qry = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_cruise_description  
											WHERE cruise_id = '" . $cruise_id . "' 
											");
			if($descr_qry->num_rows) {
				$descriptions = $descr_qry->rows;
			}
			
			$data = $query->row;
			$data['descriptions'] = $descriptions;

			$this->addCruise($data);
		}
	}
	
	public function getCruise($cruise_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_cruise 
									WHERE cruise_id = '" . (int)$cruise_id . "'
								");
		return $query->row;
	}
	
	public function getCruiseDescriptions($cruise_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_cruise_description  
									WHERE cruise_id = '" . (int)$cruise_id . "'
								");
		return $query->rows;
	}
		
	public function getCruises($data = array()) {
		if ($data) {
			$sql = "SELECT *
					FROM " . DB_PREFIX . "cruise_cruise c 
					LEFT JOIN " . DB_PREFIX . "cruise_route r ON c.route_id=r.route_id 
					WHERE 1 
					";
		
			if($data['filter_ship']){
				$sql .= " AND r.ship_id = '".$data['filter_ship']."' ";
			}
		
			if($data['filter_route']){
				$sql .= " AND c.route_id = '".$data['filter_route']."' ";
			}
		
			if($data['filter_port_departure']){
				$sql .= " AND c.port_departure LIKE '".$data['filter_port_departure']."%' ";
			}

			if($data['filter_date_departure']){
				$start_date = explode('-', $data['filter_date_departure']);
				$date_dep = date('Y-m-d', gmmktime(0,0,0, $start_date[1],$start_date[0],$start_date[2])); 
	
				$sql .= " AND c.date_departure >= '".$date_dep."' ";
			}
		
			if($data['filter_port_arrival']){
				$sql .= " AND t.port_arrival LIKE '".$data['filter_port_arrival']."%' ";
			}
	
			if($data['filter_date_arrival']){
				$end_date = explode('-', $data['filter_date_arrival']);
				$date_arr = date('Y-m-d', gmmktime(0,0,0, $end_date[1],$end_date[0],$end_date[2])); 

				$sql .= " AND c.date_arrival >= '".$date_arr."' ";
			}
		
			$sort_data = array(
				'r.route_title',
				'c.port_departure',
				'c.date_departure',
				'c.port_arrival',
				'c.date_arrival'
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
										FROM " . DB_PREFIX . "cruise_cruise c 
										LEFT JOIN " . DB_PREFIX . "cruise_route r ON c.route_id=r.route_id 
										ORDER BY r.route_title ASC");

			$cruise_data = $query->rows;

			return $cruise_data;			
		}
	}
		
	public function getTotalCruises($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_cruise c 
				LEFT JOIN " . DB_PREFIX . "cruise_route r ON c.route_id=r.route_id 
				WHERE 1 
				";
		
		if($data['filter_ship']){
			$sql .= " AND r.ship_id = '".$data['filter_ship']."' ";
		}
		
		if($data['filter_route']){
			$sql .= " AND c.route_id = '".$data['filter_route']."' ";
		}
	
		if($data['filter_date_departure']){ 
			$start_date = explode('-', $data['filter_date_departure']);
			$date_dep = date('Y-m-d', gmmktime(0,0,0, $start_date[1],$start_date[0],$start_date[2])); 
	
			$sql .= " AND c.date_departure >= '".$date_dep."' ";
		}
	
		if($data['filter_date_arrival']){
			$end_date = explode('-', $data['filter_date_arrival']);
			$date_arr = date('Y-m-d', gmmktime(0,0,0, $end_date[1],$end_date[0],$end_date[2])); 

			$sql .= " AND c.date_arrival >= '".$date_arr."' ";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	public function getCruiseDropdownData(){
		$sql = "SELECT *
				FROM " . DB_PREFIX . "cruise_cruise c 
				LEFT JOIN  " . DB_PREFIX . "cruise_route r ON c.route_id=r.route_id 
				LEFT JOIN  " . DB_PREFIX . "cruise_ship s ON r.ship_id=s.ship_id 
				ORDER BY r.route_title
				";
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getCruisesByRouteId($route_id){
		$sql = "SELECT *
				FROM " . DB_PREFIX . "cruise_cruise 
				WHERE route_id = '". $route_id."' 
				";
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
}
?>