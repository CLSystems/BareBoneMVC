<?php
/**
 * APlanByDestination class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCruiseAPlanByDestination extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('cruise/aplanbydestination');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('cruise/aplanbydestination');
		
		$this->getForm();
  	}

  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 
		$this->data['tab_planbydestination'] = $this->language->get('tab_planbydestination');

		$this->data['entry_port_departure'] = $this->language->get('entry_port_departure');
		$this->data['entry_port_arrival'] = $this->language->get('entry_port_arrival');
				
    	$this->data['button_search'] = $this->language->get('button_search');
		 
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_cruise'),
			'href'      => $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cruise/aplanbydestination', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['port_departure'] = '';
		$this->data['port_arrival'] = '';
												
		$this->template = 'cruise/aplanbydestination_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function getrouteinfo(){
		$dep_port = $this->request->get['dep_port'];
		$arr_port = $this->request->get['arr_port'];
		
		$this->load->language('cruise/aplanbydestination');
		
		$this->load->model('cruise/aplanbydestination');
		$this->load->model('cruise/ship');
		$this->load->model('cruise/route');
		$this->load->model('cruise/cruise');
		
		$output = '';
		$resus = $this->model_cruise_aplanbydestination->getRoutesByDestination($dep_port, $arr_port);

		if($resus){
			$class = 'even';
			$i=1;
			$output .= '<table class="list"><thead>';
			$output .= '<tr>';
			$output .= '<td>'.$this->language->get('column_ship').'</td>';
			$output .= '<td>'.$this->language->get('column_trip').'</td>';
			$output .= '<td>'.$this->language->get('column_port_departure').'</td>';
			$output .= '<td>'.$this->language->get('column_date_departure').'</td>';
			$output .= '<td>'.$this->language->get('column_port_arrival').'</td>';
			$output .= '<td>'.$this->language->get('column_date_arrival').'</td>';
			$output .= '<td>&nbsp;</td>';
			$output .= '</tr>';
			$output .= '</thead><tbody>';
		
			foreach($resus as $resu){
				
				$cruises = $this->model_cruise_cruise->getCruisesByRouteId($resu['route_id']);
				$ship_descr = $this->model_cruise_ship->getShipDescription($resu['ship_id']);

				
				if($cruises){
				
					foreach($cruises as $cruise){
						($class == 'odd') ? $class = 'even' : $class = 'odd';
						$output .= '<tr class="'.$class.'" id="tr_'.$i.'">';
						$output .= '<td>';
						$output .= '<img class="infoimg" src="view/image/information.png" height=16 rel="#ovl_'.$i.'" />';
						$output .= '<div class="simple_overlay" id="ovl_'.$i.'">';
						$output .= '<div class="details">';
						$output .= '<strong>Impressie</strong><br />'. html_entity_decode($ship_descr['impression']);
						$output .= '<strong>Faciliteiten</strong><br />'. html_entity_decode($ship_descr['facilities']);
						$output .= '<strong>Gegevens</strong><br />'. html_entity_decode($ship_descr['boatdata']);
						$output .= '</div>';
						$output .= '</div>';
						$output .= ' '. $this->model_cruise_ship->getShipNameById($resu['ship_id']).'</td>';
						$output .= '<td>'. $resu['route_title']. '</td>';
						$output .= '<td>'. $resu['port_departure']. '</td>';
						$d1 = explode('-', $cruise['date_departure']);
						$dep_date = date('d-m-Y', gmmktime(0,0,0,$d1[1],$d1[2],$d1[0]));
						$output .= '<td>'.$dep_date.'</td>';
						$output .= '<td>'. $resu['port_arrival'].'</td>';
						$d2 = explode('-', $cruise['date_arrival']);
						$arr_date = date('d-m-Y', gmmktime(0,0,0,$d2[1],$d2[2],$d2[0]));
						$output .= '<td>'.$arr_date.'</td>';
						if($this->checkCabins($cruise['cruise_id'])){
							$output .= '<td><a onclick="getCabins('. $cruise['cruise_id'] .','.$i.')">'.$this->language->get('text_view_cabins').' <img src="view/image/magnifier.png" /></a></td>';
						}else{
							$output .= '<td><img src="view/image/delete.png" /></td>';
						}
						$output .= '</tr>';
						$i++;
					} // END foreach $cruises
						
				} // END if $cruise
			} // END foreach $routes
			$output .= '</tbody></table>';
		}else{
			$output .= '<span style="color: red;">'.$this->language->get('text_no_trips_found').'</span>';
		} // END if/else $routes
		$this->response->setOutput($output);
	} // END public function getrouteinfo()
	
	public function getcabinsinfo(){
		$cruise_id = $this->request->get['cruise_id'];
		
		$this->load->language('cruise/aplanbydestination');
		
		$this->load->model('cruise/aplanbydestination');
		$this->load->model('cruise/cruise');
		$this->load->model('cruise/route');
		$this->load->model('cruise/ship');
		$this->load->model('cruise/cabin');
		
		$cruise = $this->model_cruise_cruise->getCruise($cruise_id);
		$d1 = explode('-', $cruise['date_departure']);
		$dep_date = date('d-m-Y', gmmktime(0,0,0,$d1[1],$d1[2],$d1[0]));
		$d2 = explode('-', $cruise['date_arrival']);
		$arr_date = date('d-m-Y', gmmktime(0,0,0,$d2[1],$d2[2],$d2[0]));
		
		$r = $this->model_cruise_route->getRoute($cruise['route_id']);
		$ship = $this->model_cruise_ship->getShip($r['ship_id']);

		$output = '';
		$i=10000;
		$resus = $this->model_cruise_aplanbydestination->getCabinsByCruiseId($cruise_id);
		if($resus){

			$output .= '<h3>'. $ship['ship_name'].' | '. $r['route_title'] .' | '. $r['port_departure'] .' | '. $dep_date .' | '. $r['port_arrival'] .' | '. $arr_date .'</h3>';
			$output .= '<table class="list"><thead>';
			$output .= '<tr>';
			
			$output .= '<td>'.$this->language->get('column_cabin_type').'</td>';
			$output .= '<td>'.$this->language->get('column_cabin_category').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_targetprice').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_own_commission').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_net_price').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_flight').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_taxes').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_hotel').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_transfers').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_handling').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_nett_buy_in').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_gross_sale').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_vat').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_vat_sale').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_agent_commission').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_travelagent').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_commission_rb').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_result_sj').'</td>';
			$output .= '<td class="right">'.$this->language->get('column_percentage').'</td>';
			
			$output .= '</tr>';
			$output .= '</thead><tbody>';
			
			$class = 'even';
			foreach($resus as $resu){
				($class == 'odd') ? $class = 'even' : $class = 'odd';
				$output .= '<tr class="'.$class.'">';
				$output .= '<td>';
				$output .= '<img class="infoimg" src="view/image/information.png" height=16 rel="#info_'.$i.'" />';
				$output .= '<div class="simple_overlay" id="info_'.$i.'">';
				$output .= '<div class="details">'. html_entity_decode($this->model_cruise_aplanbydestination->getCabinDescrByCabinId($resu['cabin_id'])) .'</div>';
				$output .= '</div>';
				$output .= ' '.$this->model_cruise_aplanbydestination->getCabinTypeByCabinId($resu['cabin_id']).'</td>';
				$output .= '<td>'. $this->model_cruise_aplanbydestination->getCabinCategoryByCabinId($resu['cabin_id']).'</td>';
				if($resu['price']<1){
					$output .= '<td class="right"><font color=red size=3>'.$this->language->get('text_on_request').'</font></td>';
					$output .= '<td class="right">'. $resu['own_commission'] .'%</td>';
					$cruise_netto = 0.000000001 * ((100-$resu['own_commission'])/100);
					$output .= '<td class="right">'.number_format($cruise_netto,2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($cruise['flight'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($cruise['taxes'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($cruise['hotel'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($r['transfers'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($r['handling'],2,',','.').'</td>';
					$calc_buy_nett = $cruise_netto + $cruise['flight'] + $cruise['taxes'] + $cruise['hotel'] + $r['transfers'] + $r['handling'];
					$output .= '<td class="right">'.number_format($calc_buy_nett,2,',','.').'</td>';
					$calc_sale_gross = (($cruise_netto + $cruise['flight'] + $cruise['hotel'] + $r['transfers'] + $r['handling'])*1.21) + $cruise['taxes'];
					$output .= '<td class="right">'.number_format($calc_sale_gross,2,',','.').'</td>';
					$calc_vat = (((($calc_sale_gross-$calc_buy_nett)/$r['harbours'])*$r['tax_harbours'])*1.19) - ((($calc_sale_gross-$calc_buy_nett)/$r['harbours'])*$r['tax_harbours']);
					$output .= '<td class="right">'.number_format($calc_vat,2,',','.').'</td>';
					$calc_sale_vat = $calc_sale_gross + ( $calc_vat * (( 100 + $resu['agent_commission']) /100));
					$output .= '<td class="right">'.number_format($calc_sale_vat,2,',','.').'</td>';
					$output .= '<td class="right">'. $resu['agent_commission'] .'%</td>';
					$calc_agent = ($calc_sale_gross - $cruise['taxes']) * (( 100 - $resu['agent_commission']) /100) + $cruise['taxes'];
					$output .= '<td class="right">'.number_format($calc_agent,2,',','.') .'</td>';
					$calc_comm_rb = $calc_sale_gross - $calc_agent;
					$output .= '<td class="right">'.number_format($calc_comm_rb,2,',','.').'</td>';
					$calc_res_sj = $calc_agent - $calc_buy_nett;
					$output .= '<td class="right">'.number_format($calc_res_sj,2,',','.').'</td>';
					$calc_percent = ($calc_res_sj / $calc_sale_gross) * 100;
					$output .= '<td class="right">'.number_format($calc_percent,2,',','.').'</td>';
				}else{
					$output .= '<td class="right">'. number_format($resu['price'],2,',','.') .'</td>';
					$output .= '<td class="right">'. $resu['own_commission'] .'%</td>';
					$cruise_netto = $resu['price'] * ((100-$resu['own_commission'])/100);
					$output .= '<td class="right">'.number_format($cruise_netto,2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($cruise['flight'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($cruise['taxes'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($cruise['hotel'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($r['transfers'],2,',','.').'</td>';
					$output .= '<td class="right">'.number_format($r['handling'],2,',','.').'</td>';
					$calc_buy_nett = $cruise_netto + $cruise['flight'] + $cruise['taxes'] + $cruise['hotel'] + $r['transfers'] + $r['handling'];
					$output .= '<td class="right">'.number_format($calc_buy_nett,2,',','.').'</td>';
					$calc_sale_gross = (($cruise_netto + $cruise['flight'] + $cruise['hotel'] + $r['transfers'] + $r['handling'])*1.21) + $cruise['taxes'];
					$output .= '<td class="right">'.number_format($calc_sale_gross,2,',','.').'</td>';
					$calc_vat = (((($calc_sale_gross-$calc_buy_nett)/$r['harbours'])*$r['tax_harbours'])*1.19) - ((($calc_sale_gross-$calc_buy_nett)/$r['harbours'])*$r['tax_harbours']);
					$output .= '<td class="right">'.number_format($calc_vat,2,',','.').'</td>';
					$calc_sale_vat = $calc_sale_gross + ( $calc_vat * (( 100 + $resu['agent_commission']) /100));
					$output .= '<td class="right">'.number_format($calc_sale_vat,2,',','.').'</td>';
					$output .= '<td class="right">'. $resu['agent_commission'] .'%</td>';
					$calc_agent = ($calc_sale_gross - $cruise['taxes']) * (( 100 - $resu['agent_commission']) /100) + $cruise['taxes'];
					$output .= '<td class="right">'.number_format($calc_agent,2,',','.') .'</td>';
					$calc_comm_rb = $calc_sale_gross - $calc_agent;
					$output .= '<td class="right">'.number_format($calc_comm_rb,2,',','.').'</td>';
					$calc_res_sj = $calc_agent - $calc_buy_nett;
					$output .= '<td class="right">'.number_format($calc_res_sj,2,',','.').'</td>';
					$calc_percent = ($calc_res_sj / $calc_sale_gross) * 100;
					$output .= '<td class="right">'.number_format($calc_percent,2,',','.').'</td>';
				}
				$output .= '</tr>';
				$i++;
			}
			$output .= '</tbody></table>';
		}else{
			$output .= '<span style="color: red;">'.$this->language->get('text_no_cabins_found').'</span>';
		}
		$this->response->setOutput($output);
	}
	
	private function checkCabins($cruise_id){
		$resus = $this->model_cruise_aplanbydestination->getCabinsByCruiseId($cruise_id);
		if($resus){
			return true;
		}else{
			return false;
		}
	}
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'cruise/aplanbydestination')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if (utf8_strlen($this->request->post['departure']) < 3 || !isset($this->request->post['departure']) ) {
      		$this->error['departure'] = $this->language->get('error_departure');
    	}

    	if (utf8_strlen($this->request->post['destination']) < 3 || !isset($this->request->post['destination']) ) {
      		$this->error['destination'] = $this->language->get('error_destination');
    	}

    	if (utf8_strlen($this->request->post['carrier']) < 2 || !isset($this->request->post['carrier']) ) {
      		$this->error['carrier'] = $this->language->get('error_carrier');
    	}

    	if (utf8_strlen($this->request->post['klasse']) < 1 || !isset($this->request->post['klasse']) ) {
      		$this->error['klasse'] = $this->language->get('error_klasse');
    	}

    	if (utf8_strlen($this->request->post['kind']) < 2 || !isset($this->request->post['kind']) ) {
      		$this->error['kind'] = $this->language->get('error_kind');
    	}

    	if (utf8_strlen($this->request->post['baby']) < 2 || !isset($this->request->post['baby']) ) {
      		$this->error['baby'] = $this->language->get('error_baby');
    	}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
    	if (!$this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}
	
  	private function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'cruise/aplanbydestination')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'cruise/aplanbydestination')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	
}
?>