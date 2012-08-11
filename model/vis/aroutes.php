<?php
/**
 * Model class ARoutes for BareBoneMVC.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisARoutes extends Model {
	
	public function getRoute($route_id){
      	$query = $this->db->query("SELECT * FROM ".$_COOKIE['prefix']."inkoop_vluchten WHERE ID='". $route_id ."' ");
		
		return $query->row;
	}
	
	public function addRoute($data){
		$this->db->query("
			REPLACE INTO ".$_COOKIE['prefix']."inkoop_vluchten 
			 SET 
			 ID = '".strtoupper($data['departure'].$data['destination'].$data['carrier'].$data['klasse'])."', 
			 VERTREK = '".strtoupper($data['departure'])."', 
			 BESTEMMING = '".strtoupper($data['destination'])."', 
			 CARRIER = '".strtoupper($data['carrier'])."', 
			 KLASSE = '".strtoupper($data['klasse'])."', 
			 via = '".strtoupper($data['via'])."', 
			 ma = '".$data['ma']."', 
			 di = '".$data['di']."', 
			 wo = '".$data['wo']."', 
			 do ='".$data['do']."', 
			 vr = '".$data['vr']."', 
			 za = '".$data['za']."', 
			 zo = '".$data['zo']."', 
			 ma_b = '".$data['ma_b']."', 
			 di_b = '".$data['di_b']."', 
			 wo_b = '".$data['wo_b']."', 
			 do_b = '".$data['do_b']."', 
			 vr_b = '".$data['vr_b']."', 
			 za_b = '".$data['za_b']."', 
			 zo_b = '".$data['zo_b']."', 
			 BASIS = '".$data['basis']."', 
			 COMBIN = '".$data['combin']."', 
			 Tourcode_box = '".$data['tourbox']."', 
			 MIN = '".$data['min_stay']."', 
			 MAX = '".$data['max_stay']."', 
			 KIND = '".$data['kind']."', 
			 BABY = '".$data['baby']."', 
			 GEZET = NOW(), 
			 is_doorvlucht = '".$data['doorvlucht']."', 
			 doorvlucht_van = '".$data['doorvlucht_van']."', 
			 open_jaw = '".$data['open_jaw']."' , 
			 bagage = '".$data['bagage']."', 
			 stopovers = '".$data['stopovers']."', 
			 wijzigen = '".$data['wijzigen']."', 
			 refunds_cancel = '".$data['refunds']."', 
			 reserve_ticket = '".$data['reserve']."', 
			 overige_voorw = '".$data['overige']."', 
			 category = '".$data['category']."', 
			 sell = '".$data['sell']."' 
		 ");
	}
	
	public function editRoute($route_id, $data){
		$this->db->query("
			UPDATE ".$_COOKIE['prefix']."inkoop_vluchten 
			 SET 
			 ID = '".strtoupper($data['departure'].$data['destination'].$data['carrier'].$data['klasse'])."', 
			 VERTREK = '".strtoupper($data['departure'])."', 
			 BESTEMMING = '".strtoupper($data['destination'])."', 
			 CARRIER = '".strtoupper($data['carrier'])."', 
			 KLASSE = '".strtoupper($data['klasse'])."', 
			 via = '".strtoupper($data['via'])."', 
			 ma = '".$data['ma']."', 
			 di = '".$data['di']."', 
			 wo = '".$data['wo']."', 
			 do ='".$data['do']."', 
			 vr = '".$data['vr']."', 
			 za = '".$data['za']."', 
			 zo = '".$data['zo']."', 
			 ma_b = '".$data['ma_b']."', 
			 di_b = '".$data['di_b']."', 
			 wo_b = '".$data['wo_b']."', 
			 do_b = '".$data['do_b']."', 
			 vr_b = '".$data['vr_b']."', 
			 za_b = '".$data['za_b']."', 
			 zo_b = '".$data['zo_b']."', 
			 BASIS = '".$data['basis']."', 
			 COMBIN = '".$data['combin']."', 
			 Tourcode_box = '".$data['tourbox']."', 
			 MIN = '".$data['min_stay']."', 
			 MAX = '".$data['max_stay']."', 
			 KIND = '".$data['kind']."', 
			 BABY = '".$data['baby']."', 
			 GEZET = NOW(), 
			 is_doorvlucht = '".$data['doorvlucht']."', 
			 doorvlucht_van = '".$data['doorvlucht_van']."', 
			 open_jaw = '".$data['open_jaw']."' , 
			 bagage = '".$data['bagage']."', 
			 stopovers = '".$data['stopovers']."', 
			 wijzigen = '".$data['wijzigen']."', 
			 refunds_cancel = '".$data['refunds']."', 
			 category = '".$data['category']."', 
			 sell = '".$data['sell']."' 
			 WHERE ID = '".strtoupper($route_id)."' 
		 ");
									
	}
	
	public function copyRoute($route_id, $count){
		$query = $this->db->query("SELECT DISTINCT * FROM ".$_COOKIE['prefix']."inkoop_vluchten 
									WHERE ID = '" . strtoupper($route_id) . "' 
									");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			unset($data['KLASSE']);
			$data['departure'] 		= $data['VERTREK'];
			$data['destination'] 	= $data['BESTEMMING'];
			$data['carrier'] 		= $data['CARRIER'];
			$data['klasse'] 		= $count;
			$data['basis'] 			= '0';
			$data['combin'] 		= $data['COMBIN'];
			$data['tourbox'] 		= $data['Tourcode_box'];
			$data['kind'] 			= $data['KIND'];
			$data['baby'] 			= $data['BABY'];
			$data['min_stay'] 		= $data['MIN'];
			$data['max_stay'] 		= $data['MAX'];
			$data['doorvlucht'] 	= $data['is_doorvlucht'];
			$data['refunds'] 		= $data['refunds_cancel'];
			$data['reserve'] 		= $data['reserve_ticket'];
			$data['overige'] 		= $data['overige_voorw'];
			
			$this->addRoute($data);
		}
	}
	
	public function deleteRoute($route_id){
		$this->db->query("DELETE FROM ".$_COOKIE['prefix']."inkoop_vluchten WHERE ID = '" . strtoupper($route_id) . "'");
		$this->db->query("DELETE FROM inkoop_vluchten_prijzen WHERE f_id = '" . strtoupper($route_id) . "'");
	}
	
	public function getTotalRoutes($data){
      	$sql = "SELECT COUNT(DISTINCT ID) AS total FROM ".$_COOKIE['prefix']."inkoop_vluchten WHERE 1 ";
		
		
		if($data['filter_departure']){
			$sql .= "AND VERTREK LIKE '".$data['filter_departure']."%' ";
		}
		
		if($data['filter_destination']){
			$sql .= "AND BESTEMMING LIKE '".$data['filter_destination']."%' ";
		}
		
		if($data['filter_carrier']){
			$sql .= "AND CARRIER LIKE '".$data['filter_carrier']."%' ";
		}
		
		if($data['filter_klasse']){
			$sql .= "AND KLASSE = '".$data['filter_klasse']."' ";
		}
		
		if($data['filter_via']){
			$sql .= "AND Via LIKE '".$data['filter_via']."%' ";
		}
		
		if($data['filter_doorvlucht']){
			$sql .= "AND is_doorvlucht = '".$data['filter_doorvlucht']."' ";
		}
		
		if($data['filter_sell']){
			$sql .= "AND sell = '".(int)$data['filter_sell']."' ";
		}

		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function getRoutes($data){
		$sql = "SELECT * FROM ".$_COOKIE['prefix']."inkoop_vluchten WHERE 1 ";
		
		if($data['filter_departure']){
			$sql .= "AND VERTREK LIKE '".$data['filter_departure']."%' ";
		}
		
		if($data['filter_destination']){
			$sql .= "AND BESTEMMING LIKE '".$data['filter_destination']."%' ";
		}
		
		if($data['filter_carrier']){
			$sql .= "AND CARRIER LIKE '".$data['filter_carrier']."%' ";
		}
		
		if($data['filter_klasse']){
			$sql .= "AND KLASSE = '".$data['filter_klasse']."' ";
		}
		
		if($data['filter_via']){
			$sql .= "AND Via LIKE '".$data['filter_via']."%' ";
		}
		
		if($data['filter_doorvlucht']){
			$sql .= "AND is_doorvlucht = '".$data['filter_doorvlucht']."' ";
		}
		
		if($data['filter_sell']){
			$sql .= "AND sell = '".(int)$data['filter_sell']."' ";
		}

		$sort_data = array(
			'VERTREK',
			'BESTEMMING',
			'CARRIER',
			'KLASSE',
			'is_doorvlucht',
			'sell'
		);		
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY VERTREK";	
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
		$routes_data = $query->rows;
		return $routes_data;
	}
	
	public function checkPrices($flight_id){
		$d_start = explode('-',$this->session->data['aDates'][$_COOKIE['season']]['season_date_start']);
		$date_start = date('Y-m-d', gmmktime(0,0,0, $d_start[1], $d_start[0], $d_start[2]));
		$d_end = explode('-',$this->session->data['aDates'][$_COOKIE['season']]['season_date_end']);
		$date_end = date('Y-m-d', gmmktime(0,0,0, $d_end[1], $d_end[0], $d_end[2]));
		
		$sql = "SELECT f_id FROM inkoop_vluchten_prijzen 
				WHERE f_id LIKE '". $flight_id ."%' 
				AND departure >= '". $date_start ."' 
				AND departure <= '". $date_end ."'
				LIMIT 0,1  
				";
		$query = $this->db->query($sql);
		if($query->row){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function checkRoute($dest=''){
      	$sql = "SELECT COUNT(DISTINCT ID) AS total FROM ".$_COOKIE['prefix']."inkoop_vluchten WHERE 1 ";
				
		if($dest){
			$sql .= "AND BESTEMMING = '".$dest."' ";
		}
		
		$sql .= "AND sell='1' ";
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function checkBasis($dest=''){
      	$sql = "SELECT COUNT(DISTINCT ID) AS total FROM ".$_COOKIE['prefix']."inkoop_vluchten WHERE 1 ";
				
		if($dest){
			$sql .= "AND BESTEMMING = '".$dest."' ";
		}
		
		$sql .= "AND sell='1' AND BASIS='1' ";
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
	public function saveKlasseValueById($f_id, $val){
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET KLASSE = '" . strtoupper($val) . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			$new_id = substr($f_id, 0, -1).$val;
			$this->db->query("UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET ID = '" . strtoupper($new_id) . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				");
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function saveViaValueById($f_id, $val){
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET Via = '" . strtoupper($val) . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function switchTripDayById($f_id, $day, $val){
		if($val == 'on') $val = '1';
		if($val == 'off') $val = '0';
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET ".$day." = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function switchBasisById($f_id, $val){
		if($val == 'on') $val = '1';
		if($val == 'off') $val = '0';
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET `BASIS` = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function switchCombinById($f_id, $val){
		if($val == 'on') $val = '1';
		if($val == 'off') $val = '0';
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET `COMBIN` = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function saveTourBoxValueById($f_id, $val){
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET Tourcode_box = '" . strtoupper($val) . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function saveMinStayValueById($f_id, $val){
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET MIN = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function saveMaxStayValueById($f_id, $val){
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET MAX = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function switchDoorvluchtById($f_id, $val){
		if($val == 'on') $val = '1';
		if($val == 'off') $val = '0';
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET `is_doorvlucht` = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}
	
	public function saveDoorvluchtVanValueById($f_id, $val){
		$sql = "UPDATE " . $_COOKIE['prefix'] . "inkoop_vluchten 
				SET doorvlucht_van = '" . $val . "' 
				WHERE ID = '" . strtoupper($f_id) . "' 
				";
		$query = $this->db->query($sql);
		if($query){
			return TRUE; 
		}else{
			return $sql; 
		}		
	}

	public function getDiscountKind(){
		$sql = "SELECT * FROM " . DB_PREFIX . "discount_kind ORDER BY sort_order ASC";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getDiscountBaby(){
		$sql = "SELECT * FROM " . DB_PREFIX . "discount_baby ORDER BY sort_order ASC";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
}
?>