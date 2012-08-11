<?php
/**
 * Model class BPricesCopy for BareBoneMVC.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisBPricesCopy extends Model {
	
	public function getPrice($flight_id){
      	$query = $this->db->query("SELECT * FROM inkoop_vluchten_prijzen WHERE f_id='". strtoupper($flight_id) ."' ");
		
		return $query->row;
	}
	
	public function addPrice($data){
		//specify a date1
		$start_date = explode('-', $data['departure_start']);
		$date1 = gmmktime(0,0,0, $start_date[1],$start_date[0],$start_date[2]); 
		//specify a date2
		$end_date = explode('-', $data['departure_end']);
		$date2 = gmmktime(0,0,0, $end_date[1],$end_date[0],$end_date[2]); 
		//calculate the difference
		$diff_days = ($date2 - $date1)/86400;

		for($i=0; $i<=$diff_days; $i++){
			$sql = "REPLACE inkoop_vluchten_prijzen
					SET 
					f_id ='".strtoupper($data['flight_id'])."',
					departure ='".date("Y-m-d", gmmktime(0,0,0,$start_date[1],($start_date[0]+$i),$start_date[2]))."',
					price='".$data['price']."', 
					valuta='".$data['valuta']."' 
					";
			$this->db->query($sql);
		}
	}
	
	public function editPrice($flight_id, $data){
		// $this->db->query("
		// 	
		//  ");
									
	}
	
	public function copyPrice($flight_id){
		$query = $this->db->query("
				SELECT DISTINCT * FROM inkoop_vluchten_prijzen 
				WHERE f_id = '" . strtoupper($flight_id) . "' 
				");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			$data['flight_id'] = $data['f_id'];
						
			$this->addPrice($data);
		}
	}
	
	public function deletePrice($flight_id){
		$this->db->query("DELETE FROM inkoop_vluchten_prijzen WHERE f_id = '" . $flight_id . "'");
	}
	
	public function getTotalPrices($data){
      	$sql = "SELECT DISTINCT f_id FROM inkoop_vluchten_prijzen WHERE 1 ";
		
		if($data['filter_flight']){
			$sql .= "AND f_id LIKE '".$data['filter_flight']."%' ";
		}
		
		if($data['filter_departure_start']){
			$sql .= "AND departure >= '".$data['filter_departure_start']."' ";
		}
		
		if($data['filter_departure_end']){
			$sql .= "AND departure <= '".$data['filter_departure_end']."' ";
		}
		
		if($data['filter_price']){
			$sql .= "AND price = '".$data['filter_price'].".00' ";
		}
		
		$query = $this->db->query($sql);
		return $query->num_rows;
	}
	
	public function getPrices($data){
		$sql = "SELECT DISTINCT f_id FROM inkoop_vluchten_prijzen WHERE 1 ";
		
		if($data['filter_flight']){
			$sql .= "AND f_id LIKE '".$data['filter_flight']."%' ";
		}
		
		if($data['filter_departure_start']){
			$sql .= "AND departure >= '".$data['filter_departure_start']."' ";
		}
		
		if($data['filter_departure_end']){
			$sql .= "AND departure <= '".$data['filter_departure_end']."' ";
		}
		
		if($data['filter_price']){
			$sql .= "AND price = '".$data['filter_price'].".00' ";
		}
		
		$sort_data = array(
			'f_id',
			'departure',
			'price'
		);		
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY f_id";	
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
		$prices_data = $query->rows;
		return $prices_data;
	}
	
	public function getPeriods($flight_id, $data=array()){
		$sql = "SELECT * FROM inkoop_vluchten_prijzen WHERE f_id LIKE '".strtoupper($flight_id)."%' ";
		
		if($data['filter_departure_start']){
			$sql .= "AND departure >= '".$data['filter_departure_start']."' ";
		}
		
		if($data['filter_departure_end']){
			$sql .= "AND departure <= '".$data['filter_departure_end']."' ";
		}
		
		$sort_data = array(
			'f_id',
			'departure',
			'price'
		);		
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY departure";	
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		$query = $this->db->query($sql);
		$prices_data = $query->rows;
		return $prices_data;
	
	}

	public function collapsePeriods($aDatePrices) {
		$period = -1;
		$price = 0;
		$aPP = array();
		foreach($aDatePrices as $aDatePrice){
			foreach ($aDatePrice as $d => $p){
				if ($p === $price){
					$aPP[$period]["to"] = $d;
				}else{
					$period++;
					$aPP[$period]["from"] = $d;
					$aPP[$period]["to"] = $d;
					$aPP[$period]["price"] = $p;
				}
				$price=$p;
			}
		}
		return $aPP;
	}
	
	public function checkPrice($dest=''){
		$sql = "SELECT COUNT(DISTINCT ID) AS total FROM ".$_COOKIE['prefix']."inkoop_vluchten, inkoop_vluchten_prijzen 
				WHERE ".$_COOKIE['prefix']."inkoop_vluchten.ID=inkoop_vluchten_prijzen.f_id 
				";
		if($dest){
			$sql .= "AND ".$_COOKIE['prefix']."inkoop_vluchten.BESTEMMING = '".$dest."' ";
		}
		
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	
}
?>