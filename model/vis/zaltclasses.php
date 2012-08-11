<?php
/**
 * Model class ZAltClasses for BareBoneMVC.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisZAltClasses extends Model {
	public function addAltClass($data) {
		$this->db->query("INSERT INTO vluchten_airlines_classes 
							SET 
							airline_code = '". $data['airline_code'] ."', 
							description = '" . $data['description'] . "' 
						");
	}
	
	public function editAltClass($v_a_c_id, $data) {
		$this->db->query("UPDATE vluchten_airlines_classes 
							SET 
							airline_code = '". $data['airline_code'] ."', 
							description = '" . $data['description'] . "' 
							WHERE v_a_c_id = '" . (int)$v_a_c_id . "'
						");
	}
	
	public function copyAltClass($v_a_c_id){
		$query = $this->db->query("SELECT DISTINCT * FROM vluchten_airlines_classes  
									WHERE v_a_c_id = '" .$v_a_c_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$this->addAltClass($data);
		}
	}
	
	public function deleteAltClass($v_a_c_id) {
		$this->db->query("DELETE FROM vluchten_airlines_classes 
							WHERE v_a_c_id = '" . (int)$v_a_c_id . "'
						");
	}	

	public function getAltClassById($v_a_c_id) {
		$query = $this->db->query("SELECT * 
									FROM vluchten_airlines_classes 
									WHERE v_a_c_id = '" . (int)$v_a_c_id . "'
								");
		return $query->row;
	}
		
	public function getAllAltClasses($data = array()) {
		if ($data) {
			$sql = "SELECT * 
					FROM vluchten_airlines_classes vac
					LEFT JOIN vluchten_airlines va ON vac.airline_code = va.code 
					WHERE 1 ";
			
			if(isset($data['filter_airline_code'])){
				$sql .= "AND vac.airline_code LIKE '".$data['filter_airline_code']."%' ";
			}
			
			if(isset($data['filter_name'])){
				$sql .= "AND va.name LIKE '%".$data['filter_name']."%' ";
			}
			
			$sort_data = array(
				'vac.airline_code',
				'va.name'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY vac.v_a_c_id";	
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
										FROM vluchten_airlines_classes vac
										LEFT JOIN vluchten_airlines va ON vac.airline_code = va.code 
										ORDER BY vac.v_a_c_id ASC");

			$altclasses_data = $query->rows;

			return $altclasses_data;			
		}
	}
	
		
	public function getTotalAltClasses() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM vluchten_airlines_classes");
		
		return $query->row['total'];
	}	
	
		
	public function getAirlines($filter_data) {
		if ($filter_data) {
			$sql = "SELECT * 
					FROM vluchten_airlines 
					WHERE 1 ";
			
			if($filter_data['filter_airline_code']){
				$sql .= "AND code LIKE '".$filter_data['filter_airline_code']."%' ";
			}
			
			if(isset($filter_data['filter_name'])){
				$sql .= "AND name LIKE '".$filter_data['filter_name']."%' ";
			}
			
			$sort_data = array(
				'code',
				'name'
			);		
		
			if (isset($filter_data['sort']) && in_array($filter_data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $filter_data['sort'];	
			} else {
				$sql .= " ORDER BY name";	
			}
			
			if (isset($filter_data['order']) && ($filter_data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}
		
			if (isset($filter_data['start']) || isset($filter_data['limit'])) {
				if ($filter_data['start'] < 0) {
					$filter_data['start'] = 0;
				}		

				if ($filter_data['limit'] < 1) {
					$filter_data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$filter_data['start'] . "," . (int)$filter_data['limit'];
			}	
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		} else {
			$query = $this->db->query("SELECT * 
										FROM vluchten_airlines 
										ORDER BY name ASC
										");

			$airlines_data = $query->rows;

			return $airlines_data;			
		}
	}
	
		
}
?>