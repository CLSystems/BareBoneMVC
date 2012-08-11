<?php
/**
 * Model class CabinCategory for BareBoneMVC.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseCabinCategory extends Model {
	public function addCabinCategory($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cabin_category 
							SET 
							cabin_category_name = '". $data['cabin_category_name'] ."'
						");
	}
	
	public function editCabinCategory($cabin_category_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_cabin_category 
							SET 
							cabin_category_name = '". $data['cabin_category_name'] ."'
							WHERE cabin_category_id = '" . (int)$cabin_category_id . "'
						");
	}
	
	public function deleteCabinCategory($cabin_category_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cabin_category 
							WHERE cabin_category_id = '" . (int)$cabin_category_id . "'
						");
	}	
	
	public function copyCabinCategory($cabin_category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_cabin_category 
									WHERE cabin_category_id = '" . $cabin_category_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$this->addCabinCategory($data);
		}
	}
	
	public function getCabinCategory($cabin_category_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_cabin_category 
									WHERE cabin_category_id = '" . (int)$cabin_category_id . "'
								");
		return $query->row;
	}
		
	public function getCabinCategories($data = array()) {
		if ($data) {
			$sql = "SELECT *
					FROM " . DB_PREFIX . "cruise_cabin_category cc 
					WHERE 1 
					";
		
			if($data['filter_title']){
				$sql .= " AND cc.cabin_category_name LIKE '%".$data['filter_title']."%' ";
			}
		
			$sort_data = array(
				'cc.cabin_category_name'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY cc.cabin_category_name";	
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
										FROM " . DB_PREFIX . "cruise_cabin_category cc 
										ORDER BY cc.cabin_category_name ASC");

			$ship_data = $query->rows;

			return $ship_data;			
		}
	}
		
	public function getTotalCabinCategories($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_cabin_category cc 
				WHERE 1
				 ";
		
		if($data['filter_title']){
			$sql .= " AND cc.cabin_category_name LIKE '".$data['filter_title']."' ";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
		

}
?>