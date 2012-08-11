<?php
/**
 * Model class ZDiscountKind for SilverJet BareBone.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisZDiscountKind extends Model {
	public function addDiscountKind($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "vis_discount_kind 
							SET 
							title = '". $data['title'] ."', 
							sort_order = '" . (int)$data['sort_order'] . "'
						");
	}
	
	public function editDiscountKind($discount_kind_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "vis_discount_kind 
							SET 
							title = '". $data['title'] ."', 
							sort_order = '" . (int)$data['sort_order'] . "' 
							WHERE discount_kind_id = '" . (int)$discount_kind_id . "'
						");
	}
	
	public function deleteDiscountKind($discount_kind_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "vis_discount_kind 
							WHERE discount_kind_id = '" . (int)$discount_kind_id . "'
						");
	}	

	public function getDiscountKindById($discount_kind_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "vis_discount_kind 
									WHERE discount_kind_id = '" . (int)$discount_kind_id . "'
								");
		return $query->row;
	}
		
	public function getAllDiscountKind($data = array()) {
		if ($data) {
			$sql = "SELECT * 
					FROM " . DB_PREFIX . "vis_discount_kind";
		
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
			// $discountkind_data = $this->cache->get('discountkind.' . (int)$this->config->get('config_language_id'));
		
			// if (!$discountkind_data) {
				$query = $this->db->query("SELECT * 
											FROM " . DB_PREFIX . "vis_discount_kind 
											ORDER BY sort_order ASC");
	
				$discountkind_data = $query->rows;
			
			//	$this->cache->set('discountkind.' . (int)$this->config->get('config_language_id'), $discountkind_data);
			//}	
	
			return $discountkind_data;			
		}
	}
	
		
	public function getTotalDiscountKind() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "vis_discount_kind");
		
		return $query->row['total'];
	}	
	

}
?>