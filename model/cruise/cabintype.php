<?php
/**
 * Model class CabinType for SilverJet BareBone.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseCabinType extends Model {
	public function addCabinType($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cabin_type 
							SET 
							cabin_type_name = '". $data['cabin_type_name'] ."'
						");
	}
	
	public function editCabinType($cabin_type_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_cabin_type 
							SET 
							cabin_type_name = '". $data['cabin_type_name'] ."'
							WHERE cabin_type_id = '" . (int)$cabin_type_id . "'
						");
	}
	
	public function deleteCabinType($cabin_type_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cabin_type 
							WHERE cabin_type_id = '" . (int)$cabin_type_id . "'
						");
	}	
	
	public function copyCabinType($cabin_type_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_cabin_type 
									WHERE cabin_type_id = '" . $cabin_type_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$this->addCabinType($data);
		}
	}
	
	public function getCabinType($cabin_type_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_cabin_type 
									WHERE cabin_type_id = '" . (int)$cabin_type_id . "'
								");
		return $query->row;
	}
		
	public function getCabinTypes($data = array()) {
		if ($data) {
			$sql = "SELECT *
					FROM " . DB_PREFIX . "cruise_cabin_type c 
					WHERE 1 
					";
		
			if($data['filter_title']){
				$sql .= " AND c.cabin_type_name LIKE '%".$data['filter_title']."%' ";
			}
		
			$sort_data = array(
				'c.cabin_type_name'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY c.cabin_type_name";	
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
										FROM " . DB_PREFIX . "cruise_cabin_type c 
										ORDER BY c.cabin_type_name ASC");

			$cabintype_data = $query->rows;

			return $cabintype_data;			
		}
	}
		
	public function getTotalCabinTypes($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_cabin_type c 
				WHERE 1
				 ";
		
		if($data['filter_title']){
			$sql .= " AND c.cabin_type_name LIKE '".$data['filter_title']."' ";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
		
	public function getCabinCategories(){
		$query = $this->db->query("SELECT *
									FROM " . DB_PREFIX . "cruise_cabin_category 
									ORDER BY cabin_category_id ASC 
									");

		$cabincategory_data = $query->rows;

		return $cabincategory_data;			
	}
	

}
?>