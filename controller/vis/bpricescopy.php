<?php
/**
 * BPricesCopy class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisBPricesCopy extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('vis/bpricescopy');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/bpricescopy');
		
		$this->getForm();
  	}
	
	public function copy(){
    	$this->load->language('vis/bpricescopy');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/bpricescopy');
		
		if ($this->validateForm() && isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $range) {
				$pieces = explode('_', $range);
				$date_start = $pieces[0];
				$date_end = $pieces[1];
				$price = $pieces[2];
				$copy_from = $this->request->post['copy_from'];
				$copy_to = $this->request->post['copy_to'];
				$data = array(
					'departure_start'	=> $date_start, 
					'departure_end'		=> $date_end, 
					'flight_id'	  		=> $copy_to, 
					'price'	  			=> $price,
					'valuta'            => 'EUR'
				);
				$this->model_vis_bpricescopy->addPrice($data);
	  		}

			$this->session->data['success'] = $this->language->get('text_success').Debug::print_r_html($this->request->post, true);
			
		}
		 
		$this->getForm();
	}
  
  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 				
		$this->data['entry_copy_from'] = $this->language->get('entry_copy_from');
		$this->data['entry_copy_to'] = $this->language->get('entry_copy_to');
				
    	$this->data['button_copy'] = $this->language->get('button_copy');
		$this->data['copy'] = $this->url->link('vis/bpricescopy/copy', 'token=' . $this->session->data['token'], 'SSL');	

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('crumbs_vis'),
			'href'      => $this->url->link('vis/bprices', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('crumbs_copy'),
			'href'      => $this->url->link('vis/bpricescopy', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['token'] = $this->session->data['token'];

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['copy_from'])) {
			$this->data['error_copy_from'] = $this->error['copy_from'];
		} else {
			$this->data['error_copy_from'] = '';
		}

 		if (isset($this->error['copy_to'])) {
			$this->data['error_copy_to'] = $this->error['copy_to'];
		} else {
			$this->data['error_copy_to'] = '';
		}

 		if (isset($this->error['nothing_selected'])) {
			$this->data['error_nothing_selected'] = $this->error['nothing_selected'];
		} else {
			$this->data['error_nothing_selected'] = '';
		}

		if (isset($this->request->post['copy_from'])) {
      		$this->data['copy_from'] = $this->request->post['copy_from'];
    	} else {
      		$this->data['copy_from'] = '';
    	}

		if (isset($this->request->post['copy_to'])) {
      		$this->data['copy_to'] = $this->request->post['copy_to'];
    	} else {
      		$this->data['copy_to'] = '';
    	}
		
		$this->template = 'vis/bpricescopy_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function getpricesinfo(){
		$flight_id = $this->request->get['flight_id'];
		
		$this->load->language('vis/bpricescopy');
		$this->load->model('vis/bpricescopy');
		$this->load->model('vis/bprices');
		
		$periods_pres = $this->model_vis_bprices->getPeriods($flight_id);
		if($periods_pres){
			$periods = array();
			foreach($periods_pres as $periode_pre){
				$periods[] = array($periode_pre['departure'] => $periode_pre['price']);
			} // END foreach $periods_pres
			$departures_data = array();
			$departures_data = $this->model_vis_bprices->collapsePeriods($periods);
			
			$departures = array();
			foreach($departures_data as $departure_data){
				$dep_f = explode('-',$departure_data['from']);
				$dep_date_from = date('d-m-Y', gmmktime(0,0,0, $dep_f[1], $dep_f[2], $dep_f[0]));
				$dep_t = explode('-',$departure_data['to']);
				$dep_date_to = date('d-m-Y', gmmktime(0,0,0, $dep_t[1], $dep_t[2], $dep_t[0]));
				$price = $departure_data['price'];
				$departures[] = array(
					'from' => $dep_date_from,
					'untill' => $dep_date_to,
					'price' => $price,
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('vis/bprices/update', 'token=' . $this->session->data['token'] . '&flight_id=' . $result['f_id'] . '&departure_start=' . $dep_date_from . '&departure_end=' . $dep_date_to . '&price='.(int)$price . $url, 'SSL')
				);
			} // END foreach $departures_data
		} // END if $periods_pres

		$output = '';
		if($departures){
			$output .= '<h3>'. strtoupper($flight_id).'</h3>';
			$output .= '<table class="white">';
			$output .= '<tbody>';
			foreach($departures as $departure){
				$output .= '<tr>';
				$output .= '<td class=center width=30><input type="checkbox" name="selected[]" value="'.$departure['from'].'_'.$departure['untill'].'_'.(int)$departure['price'].'" /></td>';
				$output .= '<td class=center width=90>'.$departure['from'].'</td>';
				$output .= '<td class=center width=30>'.$this->language->get('text_untill_and').'</td>';
				$output .= '<td class=center width=90>'.$departure['untill'].'</td>';
				$output .= '<td class=left width=20>&rArr;</td>';
				$output .= '<td class=right width=50>&nbsp;'.(int)$departure['price'].'</td>';
				$output .= '</tr>';
			} // END foreach $departures
			$output .= '</tbody></table>';
		}else{
			$output .= '<span style="color: red;">'.$this->language->get('text_no_results').'</span>';
		} // END if/else $departures
		$this->response->setOutput($output);
	}
	
	public function checkflightinfo(){
		$flight_id = $this->request->get['flight_id'];
		
		$this->load->language('vis/bpricescopy');
		$this->load->model('vis/bpricescopy');
		$this->load->model('vis/bprices');
		
		$periods_pres = $this->model_vis_bprices->getPeriods($flight_id);
		if($periods_pres){
			$periods = array();
			foreach($periods_pres as $periode_pre){
				$periods[] = array($periode_pre['departure'] => $periode_pre['price']);
			} // END foreach $periods_pres
			$departures_data = array();
			$departures_data = $this->model_vis_bprices->collapsePeriods($periods);
			
			$departures = array();
			foreach($departures_data as $departure_data){
				$dep_f = explode('-',$departure_data['from']);
				$dep_date_from = date('d-m-Y', gmmktime(0,0,0, $dep_f[1], $dep_f[2], $dep_f[0]));
				$dep_t = explode('-',$departure_data['to']);
				$dep_date_to = date('d-m-Y', gmmktime(0,0,0, $dep_t[1], $dep_t[2], $dep_t[0]));
				$price = $departure_data['price'];
				$departures[] = array(
					'from' => $dep_date_from,
					'untill' => $dep_date_to,
					'price' => $price,
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('vis/bprices/update', 'token=' . $this->session->data['token'] . '&flight_id=' . $result['f_id'] . '&departure_start=' . $dep_date_from . '&departure_end=' . $dep_date_to . '&price='.(int)$price . $url, 'SSL')
				);
			} // END foreach $departures_data
		} // END if $periods_pres

		$output = '';
		if($departures){
			$output .= '<h3>'. strtoupper($flight_id).'</h3>';
			$output .= '<table class="white">';
			$output .= '<tbody>';
			foreach($departures as $departure){
				$output .= '<tr>';
				$output .= '<td class=center width=90>'.$departure['from'].'</td>';
				$output .= '<td class=center width=30>'.$this->language->get('text_untill_and').'</td>';
				$output .= '<td class=center width=90>'.$departure['untill'].'</td>';
				$output .= '<td class=left width=20>&rArr;</td>';
				$output .= '<td class=right width=50>&nbsp;'.(int)$departure['price'].'</td>';
				$output .= '</tr>';
			} // END foreach $departures
			$output .= '</tbody></table>';
		}else{
			$output .= '<span style="color: darkgreen;">'.$this->language->get('text_no_results').'</span>';
		} // END if/else $departures
		$this->response->setOutput($output);
	}
	
	public function copypricesinfo(){
		
	}
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'vis/bpricescopy')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if (strlen($this->request->post['copy_from']) != 9 || !isset($this->request->post['copy_from']) ) {
      		$this->error['copy_from'] = $this->language->get('error_copy_from');
    	}

    	if (strlen($this->request->post['copy_to']) != 9 || !isset($this->request->post['copy_to']) ) {
      		$this->error['copy_to'] = $this->language->get('error_copy_to');
    	}
		
		if(!isset($this->request->post['selected'])){
      		$this->error['nothing_selected'] = $this->language->get('error_nothing_selected');
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
	
	
}
?>