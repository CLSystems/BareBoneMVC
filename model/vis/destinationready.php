<?php
/**
 * Model class DestinationReady for BareBoneMVC.
 *
 * @package BareBone\Model\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelVisDestinationReady extends Model {
	
	public function getDestinationReady($flight_id){
      	$query = $this->db->query("SELECT * FROM inkoop_vluchten_prijzen WHERE f_id='". strtoupper($flight_id) ."' ");
		
		return $query->row;
	}
	
	public function addDestinationReady($data){
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
	
	public function getTotalDestinationReadys($data){
      	$sql = "SELECT BESTEMMING, best_vluchten_ingave_klaar
				FROM ".$_COOKIE['prefix']."inkoop_vluchten, ".$_COOKIE['prefix']."bestem
				WHERE sell='1' 
				AND ".$_COOKIE['prefix']."inkoop_vluchten.BESTEMMING = ".$_COOKIE['prefix']."bestem.best 
				
				";
		
		if($data['filter_destination']){
			$sql .= "AND BESTEMMING LIKE '".$data['filter_destination']."%' group by BESTEMMING ";
		}else{
			$sql .= "group by BESTEMMING ";
		}
		
		$query = $this->db->query($sql);
		return $query->num_rows;
	}
	
	public function getDestinationReadys($data){
		$sql = "SELECT BESTEMMING, best_vluchten_ingave_klaar
				FROM ".$_COOKIE['prefix']."inkoop_vluchten, ".$_COOKIE['prefix']."bestem
				WHERE sell='1' 
				AND ".$_COOKIE['prefix']."inkoop_vluchten.BESTEMMING = ".$_COOKIE['prefix']."bestem.best 
				";
		
		if($data['filter_destination']){
			$sql .= "AND BESTEMMING LIKE '".$data['filter_destination']."%' ";
		}
		
		$sort_data = array(
			'BESTEMMING'
		);		
	
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " group by BESTEMMING ORDER BY " . $data['sort'];	
		} else {
			$sql .= " group by BESTEMMING ORDER BY BESTEMMING";	
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
		$inputreadys_data = $query->rows;
		return $inputreadys_data;
	}
	
	
	public function switchDestinationReadyByDestination($dest, $val){
		if($val == 'on') $val = '1';
		if($val == 'off') $val = '0';
		$sql = "UPDATE " . $_COOKIE['prefix'] . "bestem 
				SET best_vluchten_ingave_klaar = '" . $val . "' 
				WHERE best = '" . strtoupper($dest) . "' 
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