<?php
/**
 * Model class Ship for BareBoneMVC.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseShip extends Model {
	public function addShip($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_ship 
							SET 
							ship_name = '". $data['title'] ."', 
							shipping_company_id = '". $data['company_id'] ."', 
							ship_number = '". $data['shipnumber'] ."'
						");
		$ship_id = $this->db->getLastId();
		foreach($data['descriptions'] as $description){
			$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_ship_description 
								SET 
								ship_id = '". $ship_id ."', 
								impression = '". $description['impression'] ."', 
								facilities = '". $description['facilities'] ."', 
								boatdata = '". $description['boatdata'] ."', 
								active_from = '". $description['active_from'] ."', 
								active_untill = '". $description['active_untill'] ."' 
							");
		} // END foreach
	} // END function
	
	public function editShip($ship_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_ship 
							SET 
							ship_name = '". $data['title'] ."', 
							shipping_company_id = '". $data['company_id'] ."', 
							ship_number = '". $data['shipnumber'] ."' 
							WHERE ship_id = '" . (int)$ship_id . "'
						");
		if($data['descriptions']) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_ship_description 
								WHERE ship_id = '" . (int)$ship_id . "'
							");
			foreach($data['descriptions'] as $description){
				$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_ship_description 
									SET 
									ship_id = '". $ship_id ."', 
									impression = '". $description['impression'] ."', 
									facilities = '". $description['facilities'] ."', 
									boatdata = '". $description['boatdata'] ."', 
									active_from = '". $description['active_from'] ."', 
									active_untill = '". $description['active_untill'] ."' 
								");
			} // END foreach
		} // END if
	} // END function
	
	public function deleteShip($ship_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_ship 
							WHERE ship_id = '" . (int)$ship_id . "'
						");
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_ship_description  
							WHERE ship_id = '" . (int)$ship_id . "'
						");
	}	
	
	public function copyShip($ship_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_ship 
									WHERE ship_id = '" . $ship_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			$descriptions = array();
			
			$descr_qry = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_ship_description  
											WHERE ship_id = '" . $ship_id . "' 
											");
			if($descr_qry->num_rows) {
				$descriptions = $descr_qry->rows;
			}
			
			$data = $query->row;
			$data['title'] 			= $data['ship_name'];
			$data['company_id'] 	= $data['shipping_company_id'];
			$data['shipnumber'] 	= $data['ship_number'];
			$data['descriptions'] 	= $descriptions;
			
			$this->addShip($data);
		}
	}
	
	public function getShip($ship_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_ship 
									WHERE ship_id = '" . (int)$ship_id . "'
								");
		return $query->row;
	}
	
	public function getShipDescriptions($ship_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_ship_description  
									WHERE ship_id = '". (int)$ship_id."' 
									ORDER BY active_from ASC  
								");
		return $query->rows;
	}
	
	public function getShipDescription($ship_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_ship_description  
									WHERE ship_id = '". (int)$ship_id."' 
									AND active_from <= NOW() 
									AND active_untill >= NOW() 
									ORDER BY active_untill ASC  
									LIMIT 0,1
								");
		return $query->row;
	}
	
	public function getShips($data = array()) {
		if ($data) {
			$sql = "SELECT * 
					FROM " . DB_PREFIX . "cruise_ship s 
					LEFT JOIN " . DB_PREFIX . "cruise_shipping_company sc ON s.shipping_company_id = sc.shipping_company_id 
					WHERE 1 
					";
		
			if($data['filter_title']){
				$sql .= " AND s.ship_name LIKE '%".$data['filter_title']."%' ";
			}
		
			if($data['filter_company']){
				$sql .= " AND s.shipping_company_id = '".$data['filter_company']."' ";
			}
		
			$sort_data = array(
				's.ship_name',
				'sc.shipping_company_name'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY s.ship_name";	
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
										FROM " . DB_PREFIX . "cruise_ship s 
										LEFT JOIN " . DB_PREFIX . "cruise_shipping_company sc ON s.shipping_company_id = sc.shipping_company_id 
										ORDER BY ship_name ASC");

			$ship_data = $query->rows;

			return $ship_data;			
		}
	}
	
		
	public function getTotalShips($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_ship s 
				LEFT JOIN " . DB_PREFIX . "cruise_shipping_company sc ON s.shipping_company_id = sc.shipping_company_id 
				WHERE 1
				 ";
		
		if($data['filter_title']){
			$sql .= " AND s.ship_name LIKE '%".$data['filter_title']."%' ";
		}
		
		if($data['filter_company']){
			$sql .= " AND s.shipping_company_id = '".$data['filter_company']."' ";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	public function getShipNameById($ship_id){
		$query = $this->db->query("SELECT ship_name 
									FROM " . DB_PREFIX . "cruise_ship 
									WHERE ship_id = '" . $ship_id . "' 
									");

		$ship_data = $query->row;

		return $ship_data['ship_name'];			
	}

	public function getShipDescrById($ship_id){
		$query = $this->db->query("SELECT impression, facilities, boatdata  
									FROM " . DB_PREFIX . "cruise_ship_description 
									WHERE ship_id = '" . $ship_id . "' 
									AND active_from <= NOW() 
									AND active_untill >= NOW() 
									ORDER BY active_untill ASC 
									LIMIT 0,1
									");

		$ship_data = $query->row;

		return $ship_data;			
	}
	
	
	

}
?>