<?php
/**
 * Model class Cabin for BareBoneMVC.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseCabin extends Model {
	public function addCabin($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cabin 
							SET 
							cabin_type_id = '". $data['cabin_type_id'] ."', 
							cabin_category_id = '". $data['category_id'] ."', 
							ship_id = '". $data['ship_id'] ."' 
						");
		$cabin_id = $this->db->getLastId();
		foreach($data['descriptions'] as $description){
			$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cabin_description 
								SET 
								cabin_id = '". $cabin_id ."', 
								description = '". $description['description'] ."', 
								active_from = '". $description['active_from'] ."', 
								active_untill = '". $description['active_untill'] ."' 
							");
		}
	}
	
	public function editCabin($cabin_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_cabin 
							SET 
							cabin_type_id = '". $data['cabin_type_id'] ."', 
							cabin_category_id = '". $data['category_id'] ."', 
							ship_id = '". $data['ship_id'] ."' 
							WHERE cabin_id = '" . (int)$cabin_id . "'
						");
		if($data['descriptions']) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cabin_description 
								WHERE cabin_id = '" . (int)$cabin_id . "'
							");
			foreach($data['descriptions'] as $description){
				$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_cabin_description 
									SET 
									cabin_id = '". (int)$cabin_id ."', 
									description = '". $description['description'] ."', 
									active_from = '". $description['active_from'] ."', 
									active_untill = '". $description['active_untill'] ."' 
								");
			} // END foreach
		} // END if
	} // END function
	
	public function deleteCabin($cabin_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cabin 
							WHERE cabin_id = '" . (int)$cabin_id . "'
						");
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_cabin_description 
							WHERE cabin_id = '" . (int)$cabin_id . "'
						");
	}	
	
	public function copyCabin($cabin_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_cabin 
									WHERE cabin_id = '" . $cabin_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			$descriptions = array();
			
			$descr_qry = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_cabin_description  
											WHERE cabin_id = '" . $cabin_id . "' 
											");
			if($descr_qry->num_rows) {
				$descriptions = $descr_qry->rows;
			}
			
			
			$data = $query->row;
			$data['cabin_type_id'] 	= $data['cabin_type_id'];
			$data['category_id'] 	= $data['cabin_category_id'];
			$data['ship_id'] 		= $data['ship_id'];
			$data['descriptions'] 	= $descriptions;
			
			$this->addCabin($data);
		}
	}
	
	public function getCabin($cabin_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_cabin 
									WHERE cabin_id = '" . (int)$cabin_id . "'
								");
		return $query->row;
	}
	
	public function getCabinDescriptions($cabin_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_cabin_description  
									WHERE cabin_id = '" . (int)$cabin_id . "'
								");
		return $query->rows;
	}
		
	public function getCabins($data = array()) {
		if ($data) {
			$sql = "SELECT *, 
						s.ship_name AS shipname,
						sc.shipping_company_name AS shippingcompanyname,
						ct.cabin_type_name AS cabintypename,
						cc.cabin_category_name AS cabincategoryname  
					FROM " . DB_PREFIX . "cruise_cabin c 
					LEFT JOIN " . DB_PREFIX . "cruise_cabin_type ct ON c.cabin_type_id = ct.cabin_type_id 
					LEFT JOIN " . DB_PREFIX . "cruise_cabin_category cc ON c.cabin_category_id = cc.cabin_category_id 
					LEFT JOIN " . DB_PREFIX . "cruise_ship s ON c.ship_id = s.ship_id 
					LEFT JOIN " . DB_PREFIX . "cruise_shipping_company sc ON s.shipping_company_id = sc.shipping_company_id 
					WHERE 1 
					";
		
			if($data['filter_title']){
				$sql .= " AND c.cabin_type_id = '".$data['filter_title']."' ";
			}
		
			if($data['filter_category']){
				$sql .= " AND c.cabin_category_id = '".$data['filter_category']."' ";
			}
		
			if($data['filter_ship']){
				$sql .= " AND c.ship_id = '".$data['filter_ship']."' ";
			}
		
			$sort_data = array(
				'ct.cabin_type_name',
				'cc.cabin_category_name',
				's.ship_name' 
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY ct.cabin_type_name";	
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
			$query = $this->db->query("SELECT *, 
											s.ship_name AS shipname,
											sc.shipping_company_name AS shippingcompanyname,
											ct.cabin_type_name AS cabintypename,
											cc.cabin_category_name AS cabincategoryname  
										FROM " . DB_PREFIX . "cruise_cabin c 
										LEFT JOIN " . DB_PREFIX . "cruise_cabin_type ct ON c.cabin_type_id = ct.cabin_type_id 
										LEFT JOIN " . DB_PREFIX . "cruise_cabin_category cc ON c.cabin_category_id = cc.cabin_category_id 
										LEFT JOIN " . DB_PREFIX . "cruise_ship s ON c.ship_id = s.ship_id 
										LEFT JOIN " . DB_PREFIX . "cruise_shipping_company sc ON s.shipping_company_id = sc.shipping_company_id 
										ORDER BY ct.cabin_type_name ASC");

			$ship_data = $query->rows;

			return $ship_data;			
		}
	}
		
	public function getTotalCabins($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_cabin c 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_type ct ON c.cabin_type_id = ct.cabin_type_id 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_category cc ON c.cabin_category_id = cc.cabin_category_id 
				LEFT JOIN " . DB_PREFIX . "cruise_ship s ON c.ship_id = s.ship_id 
				LEFT JOIN " . DB_PREFIX . "cruise_shipping_company sc ON s.shipping_company_id = sc.shipping_company_id 
				WHERE 1
				 ";
		
		if($data['filter_title']){
			$sql .= " AND c.cabin_type_id = '".$data['filter_title']."' ";
		}
		
		if($data['filter_category']){
			$sql .= " AND c.cabin_category_id = '".$data['filter_category']."' ";
		}
		
		if($data['filter_ship']){
			$sql .= " AND c.ship_id = '".$data['filter_ship']."' ";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	public function getCabinTypes(){
		$query = $this->db->query("SELECT *
									FROM " . DB_PREFIX . "cruise_cabin_type 
									ORDER BY cabin_type_name ASC");

		$cabintype_data = $query->rows;

		return $cabintype_data;			
	}
	
	public function getCabinCategories(){
		$query = $this->db->query("SELECT *
									FROM " . DB_PREFIX . "cruise_cabin_category 
									ORDER BY cabin_category_name ASC");

		$cabincat_data = $query->rows;

		return $cabincat_data;			
	}
	
	public function getCabinsByCruiseId($cruise_id){
		$query = $this->db->query("
				SELECT *, c.cabin_id AS cabin_id 
				FROM " . DB_PREFIX . "cruise_cabin c 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_type ct ON c.cabin_type_id = ct.cabin_type_id 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_category cc ON c.cabin_category_id = cc.cabin_category_id 
				LEFT JOIN " . DB_PREFIX . "cruise_ship s ON c.ship_id = s.ship_id 
				LEFT JOIN " . DB_PREFIX . "cruise_route r ON r.ship_id = s.ship_id 
				LEFT JOIN " . DB_PREFIX . "cruise_cruise cr ON cr.route_id = r.route_id 
				WHERE cr.cruise_id = '".$cruise_id."' 
				");

		$cabin_data = $query->rows;

		return $cabin_data;			
	}
	
	public function getCabinByShipId($ship_id){
		$query = $this->db->query("
				SELECT *, cd.description AS cabin_description
				FROM " . DB_PREFIX . "cruise_cabin c 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_description cd ON c.cabin_id = cd.cabin_id 
				LEFT JOIN " . DB_PREFIX . "cruise_ship s ON c.ship_id = s.ship_id 
				WHERE s.ship_id = '".$ship_id."' 
				AND cd.active_from <= NOW() 
				AND cd.active_untill >= NOW() 
				");

		$cabin_data = $query->rows;

		return $cabin_data;			
	}
	
	
	
}
?>