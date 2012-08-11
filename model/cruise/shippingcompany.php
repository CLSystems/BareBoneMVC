<?php
/**
 * Model class ShippingCompany for SilverJet BareBone.
 *
 * @package BareBone\Model\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelCruiseShippingCompany extends Model {
	public function addShippingCompany($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_shipping_company 
							SET 
							shipping_company_name = '". $data['title'] ."', 
							shipping_company_phone = '". $data['phone'] ."', 
							shipping_company_address = '". $data['address'] ."',
						");
		$shipping_company_id = $this->db->getLastId();
		foreach($data['descriptions'] as $description){
			$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_shipping_company_description 
								SET 
								shipping_company_id = '". $shipping_company_id ."', 
								description = '". $description['description'] ."', 
								active_from = '". $description['active_from'] ."', 
								active_untill = '". $description['active_untill'] ."' 
							");
		}
	}
	
	public function editShippingCompany($shipping_company_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cruise_shipping_company 
							SET 
							shipping_company_name = '". $data['title'] ."', 
							shipping_company_phone = '". $data['phone'] ."', 
							shipping_company_address = '". $data['address'] ."' 
							WHERE shipping_company_id = '" . (int)$shipping_company_id . "'
						");
		if($data['descriptions']) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_shipping_company_description 
								WHERE shipping_company_id = '" . (int)$shipping_company_id . "'
							");
			foreach($data['descriptions'] as $description){
				$this->db->query("INSERT INTO " . DB_PREFIX . "cruise_shipping_company_description 
									SET 
									shipping_company_id = '". (int)$shipping_company_id ."', 
									description = '". $description['description'] ."', 
									active_from = '". $description['active_from'] ."', 
									active_untill = '". $description['active_untill'] ."' 
								");
			} // END foreach
		} // END if
	} // END function
	
	public function deleteShippingCompany($shipping_company_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_shipping_company 
							WHERE shipping_company_id = '" . (int)$shipping_company_id . "'
						");
		$this->db->query("DELETE FROM " . DB_PREFIX . "cruise_shipping_company_description 
							WHERE shipping_company_id = '" . (int)$shipping_company_id . "'
						");
	}	
	
	public function copyShippingCompany($shipping_company_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_shipping_company 
									WHERE shipping_company_id = '" . $shipping_company_id . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			$descriptions = array();
			
			$descr_qry = $this->db->query("SELECT * FROM " . DB_PREFIX . "cruise_shipping_company_description  
											WHERE shipping_company_id = '" . $shipping_company_id . "' 
											");
			if($descr_qry->num_rows) {
				$descriptions = $descr_qry->rows;
			}
			
			$data = $query->row;
			$data['title'] 		= $data['shipping_company_name'];
			$data['phone'] 		= $data['shipping_company_phone'];
			$data['address'] 	= $data['shipping_company_address'];
			$data['descriptions'] = $descriptions;
			
			$this->addShippingCompany($data);
		}
	}
	
	public function getShippingCompany($shipping_company_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_shipping_company 
									WHERE shipping_company_id = '" . (int)$shipping_company_id . "'
								");
		return $query->row;
	}
	
	public function getShippingCompanyDescriptions($shipping_company_id) {
		$query = $this->db->query("SELECT * 
									FROM " . DB_PREFIX . "cruise_shipping_company_description  
									WHERE shipping_company_id = '" . (int)$shipping_company_id . "'
								");
		return $query->rows;
	}
		
	public function getShippingCompanies($data = array()) {
		if ($data) {
			$sql = "SELECT * 
					FROM " . DB_PREFIX . "cruise_shipping_company 
					WHERE 1 
					";
		
		
			if($data['filter_title']){
				$sql .= " AND shipping_company_name LIKE '".$data['filter_title']."%' ";
			}
		
			$sort_data = array(
				'shipping_company_name'
			);		
		
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY shipping_company_name";	
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
										FROM " . DB_PREFIX . "cruise_shipping_company 
										ORDER BY shipping_company_name ASC");

			$shippingcompany_data = $query->rows;

			return $shippingcompany_data;			
		}
	}
	
		
	public function getTotalShippingCompanies($data=array()) {
      	$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "cruise_shipping_company WHERE 1 ";
		
		if($data['filter_title']){
			$sql .= " AND shipping_company_name LIKE '".$data['filter_title']."%' ";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	

}
?>