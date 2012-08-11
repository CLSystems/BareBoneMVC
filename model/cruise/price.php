<?php
/**
 * Model class Price for SilverJet BareBone.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruisePrice extends Model {
	public function addPrice($data) {
	
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_price 
							SET 
							cruise_id = '". $data['cruise_id'] ."', 
							cabin_id = '". $data['cabin_id'] ."', 
							price =  '". $data['price'] ."', 
							own_commission =   '". $data['own_commission'] ."', 
							agent_commission =   '". $data['agent_commission'] ."'  
						");
	}
	
	public function editPrice($price_id, $data) {
	
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_price 
							SET 
							cruise_id = '". $data['cruise_id'] ."', 
							cabin_id = '". $data['cabin_id'] ."', 
							price =  '". $data['price'] ."', 
							own_commission =   '". $data['own_commission'] ."', 
							agent_commission =   '". $data['agent_commission'] ."'  
							WHERE price_id = '" . (int)$price_id . "'
						");
	}
	
	public function deletePrice($price_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_price 
							WHERE price_id = '" . (int)$price_id . "'
						");
	}	
	
	public function copyPrice($price_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_price 
									WHERE price_id = '" . $price_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			$data = $query->row;
			
			$this->addPrice($data);
		}
	}
	
	public function getPrice($price_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_price 
									WHERE price_id = '" . (int)$price_id . "'
								");
		return $query->row;
	}
		
	public function getPrices($data = array()) {
		if ($data) {
			$sql = "SELECT *, p.price_id AS price_id 
					FROM " . DB_PREFIX . "cruise_price p 
					LEFT JOIN " . DB_PREFIX . "cruise_cruise cr ON p.cruise_id = cr.cruise_id 
					LEFT JOIN " . DB_PREFIX . "cruise_route r ON cr.route_id = r.route_id 
					LEFT JOIN " . DB_PREFIX . "cruise_ship s ON r.ship_id = s.ship_id 
					LEFT JOIN " . DB_PREFIX . "cruise_cabin c ON p.cabin_id = c.cabin_id 
					LEFT JOIN " . DB_PREFIX . "cruise_cabin_type ct ON c.cabin_type_id = ct.cabin_type_id 
					LEFT JOIN " . DB_PREFIX . "cruise_cabin_category cc ON c.cabin_category_id = cc.cabin_category_id 
					WHERE 1 
					";
		
			if($data['filter_ship']){
				$sql .= " AND s.ship_id = '".$data['filter_ship']."' ";
			}
		
			if($data['filter_route']){
				$sql .= " AND r.route_id = '".$data['filter_route']."' ";
			}
		
			if($data['filter_cabin_type']){
				$sql .= " AND c.cabin_type_id = '".$data['filter_cabin_type']."' ";
			}
		
			if($data['filter_cabin_category']){
				$sql .= " AND c.cabin_category_id = '".$data['filter_cabin_category']."' ";
			}

			if($data['filter_price']){
				$sql .= " AND p.price >= '".$data['filter_price']."' ";
			}
		
			$sort_data = array(
				's.ship_name',
				'r.route_title',
				'ct.cabin_type_name',
				'cc.cabin_category_name',
				'p.price'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY p.cruise_id";	
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
										FROM " . DB_PREFIX . "cruise_price p 
										ORDER BY p.route_id ASC");

			$ship_data = $query->rows;

			return $ship_data;			
		}
	}
		
	public function getTotalPrices($data=array()) {
      	$sql = "SELECT COUNT(*) AS total 
				FROM " . DB_PREFIX . "cruise_price p 
				LEFT JOIN " . DB_PREFIX . "cruise_cruise cr ON p.cruise_id = cr.cruise_id 
				LEFT JOIN " . DB_PREFIX . "cruise_route r ON cr.route_id = r.route_id 
				LEFT JOIN " . DB_PREFIX . "cruise_ship s ON r.ship_id = s.ship_id 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin c ON p.cabin_id = c.cabin_id 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_type ct ON c.cabin_type_id = ct.cabin_type_id 
				LEFT JOIN " . DB_PREFIX . "cruise_cabin_category cc ON c.cabin_category_id = cc.cabin_category_id 
				WHERE 1 
				";
		
		if($data['filter_ship']){
			$sql .= " AND s.ship_id = '".$data['filter_ship']."' ";
		}
	
		if($data['filter_route']){
			$sql .= " AND r.route_id = '".$data['filter_route']."' ";
		}
		
		if($data['filter_cabin_type']){
			$sql .= " AND c.cabin_type_id = '".$data['filter_cabin_type']."' ";
		}
	
		if($data['filter_cabin_category']){
			$sql .= " AND c.cabin_category_id = '".$data['filter_cabin_category']."' ";
		}

		if($data['filter_price']){
			$sql .= " AND p.price >= '".$data['filter_price']."' ";
		}
	
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	
	


}
?>