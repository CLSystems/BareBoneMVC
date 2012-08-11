<?php
/**
 * Model class LetOp for BareBoneMVC.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisLetOp extends Model {
	
	public function getLetOp($dest, $carr){
      	$query = $this->db->query("SELECT * FROM vluchten_letop WHERE dest='". $dest ."' AND carrier='". $carr ."' AND season = '" . $_COOKIE['season'] . "' ");
		
		return $query->row;
	}
	
	public function addLetOp($data){
		$this->db->query("
			INSERT INTO vluchten_letop 
			 SET 
			 dest = '".strtoupper($data['dest'])."', 
			 carrier = '".strtoupper($data['carrier'])."', 
			 season = '" . $_COOKIE['season'] . "', 
			 letop = '".$data['letop']."'
		 ");
	}
	
	public function editLetOp($data){
		$this->db->query("
			UPDATE vluchten_letop 
			 SET 
			 letop = '".$data['letop']."' 
			 WHERE 
			 dest = '".strtoupper($data['dest'])."' AND 
			 carrier = '".strtoupper($data['carrier'])."' AND 
			 season = '" . $_COOKIE['season'] . "' 
		 ");
	}
	
	public function copyLetOp($dest, $carr){
		
	}
	
	public function deleteLetOp($comp_id){
		$dest = substr($comp_id, 0, 3);
		$carr = substr($comp_id, 3, 2);
		$this->db->query("DELETE FROM vluchten_letop WHERE dest = '" . $dest . "' AND carrier = '" . $carr . "' AND season = '" . $_COOKIE['season'] . "' ");
	}
	
	public function getTotalLetOps($data){
      	$sql = "SELECT COUNT(*) AS total FROM vluchten_letop WHERE 1 ";
		
		if($data['filter_destination']){
			$sql .= "AND dest LIKE '".$data['filter_destination']."%' ";
		}
		
		if($data['filter_carrier']){
			$sql .= "AND carrier LIKE '".$data['filter_carrier']."%' ";
		}
		
		if($data['filter_season']){
			$sql .= "AND season = '".$data['filter_season']."' ";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	

	public function getLetOps($data){
      	$sql = "SELECT * FROM vluchten_letop WHERE 1 ";
		
		if($data['filter_destination']){
			$sql .= "AND dest LIKE '".$data['filter_destination']."%' ";
		}
		
		if($data['filter_carrier']){
			$sql .= "AND carrier LIKE '".$data['filter_carrier']."%' ";
		}
		
		if($data['filter_season']){
			$sql .= "AND season = '".$data['filter_season']."' ";
		}
		
		$sort_data = array(
			'dest',
			'carrier',
			'season'
		);		
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY dest";	
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
		$letop_data = $query->rows;
		return $letop_data;
	}
	
	public function saveLetOpValueById($dest, $carr, $val){
		$sql = "UPDATE vluchten_letop 
				SET letop = '" . $val . "' 
				WHERE dest = '" . strtoupper($dest) . "' 
				AND carrier = '" . strtoupper($carr) . "' 
				AND season = '" . $_COOKIE['season'] . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	
}
?>