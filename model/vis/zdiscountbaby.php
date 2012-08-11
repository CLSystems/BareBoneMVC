<?php
/**
 * Model class ZDiscountBaby for BareBoneMVC.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisZDiscountBaby extends Model {
	public function addDiscountBaby($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "vis_discount_baby 
							SET 
							title = '". $data['title'] ."', 
							sort_order = '" . (int)$data['sort_order'] . "'
						");
	}
	
	public function editDiscountBaby($discount_baby_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "vis_discount_baby 
							SET 
							title = '". $data['title'] ."', 
							sort_order = '" . (int)$data['sort_order'] . "' 
							WHERE discount_baby_id = '" . (int)$discount_baby_id . "'
						");
	}
	
	public function deleteDiscountBaby($discount_baby_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vis_discount_baby 
							WHERE discount_baby_id = '" . (int)$discount_baby_id . "'
						");
	}	

	public function getDiscountBabyById($discount_baby_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "vis_discount_baby 
									WHERE discount_baby_id = '" . (int)$discount_baby_id . "'
								");
		return $query->row;
	}
		
	public function getAllDiscountBaby($data = array()) {
		if ($data) {
			$sql = "SELECT * 
					FROM " . DB_PREFIX . "vis_discount_baby";
		
			$sort_data = array(
				'title',
				'sort_order'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY sort_order";	
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
			// $discountbaby_data = $this->cache->get('discountbaby.' . (int)$this->config->get('config_language_id'));
		
			// if (!$discountbaby_data) {
				$query = $this->db->query("SELECT * 
											FROM " . DB_PREFIX . "vis_discount_baby 
											ORDER BY sort_order ASC");
	
				$discountbaby_data = $query->rows;
			
			//	$this->cache->set('discountbaby.' . (int)$this->config->get('config_language_id'), $discountbaby_data);
			//}	
	
			return $discountbaby_data;			
		}
	}
	
		
	public function getTotalDiscountBaby() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "vis_discount_baby");
		
		return $query->row['total'];
	}	
	

}
?>