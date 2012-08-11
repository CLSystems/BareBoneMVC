<?php
/**
 * DestinationReady class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisDestinationReady extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('vis/destinationready');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/destinationready');
		
		$this->getList();
  	}

  	public function deldestenation() {
    	$this->load->language('vis/destinationready');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/destinationready');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $route_id) {
				// $this->model_vis_destinationready->deleteDestinationReady($route_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_destination'])) {
				$url .= '&filter_destination=' . $this->request->get['filter_destination'];
			}
		
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('vis/destinationready', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
			
		$url = '';
		
		if (isset($this->request->post['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->post['filter_destination'];
		}
	
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
			
		$this->redirect($this->url->link('vis/destinationready', 'token=' . $this->session->data['token'] . $url, 'SSL'));
  	}

  	private function getList() {				
		if (isset($this->request->get['filter_destination'])) {
			$filter_destination = $this->request->get['filter_destination'];
		} else {
			$filter_destination = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'BESTEMMING';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
						
		$url = '';
						
		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('crumbs_vis'),
			'href'      => $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('vis/destinationready', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('vis/destinationready/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('vis/destinationready/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('vis/destinationready/deldestenation', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['destinationreadys'] = array();
		
		$data = array(
			'filter_destination' => $filter_destination, 
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('vis/aroutes');
		$this->load->model('vis/bprices');
		
		$destinationready_total = $this->model_vis_destinationready->getTotalDestinationReadys($data);
		$results = $this->model_vis_destinationready->getDestinationReadys($data);
				    	
		foreach ($results as $result) {
			$routecheck = $this->model_vis_aroutes->checkRoute($result['BESTEMMING']);
			$basischeck = $this->model_vis_aroutes->checkBasis($result['BESTEMMING']);
			$pricecheck = $this->model_vis_bprices->checkPrice($result['BESTEMMING']);
			
			$action = array();
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('vis/destinationready/update', 'token=' . $this->session->data['token'] . '&dest=' . $result['BESTEMMING'] . $url, 'SSL')
			);

      		$this->data['destinationreadys'][] = array(
				'destination' 		=> $result['BESTEMMING'],
				'routecheck'		=> ($routecheck>=1 ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'routeurl' 			=> $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&filter_destination=' . $result['BESTEMMING'], 'SSL'),
				'basischeck'		=> ($basischeck>=1 ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'pricecheck'		=> ($pricecheck>=1 ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'priceurl' 			=> $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . '&filter_flight=___' . $result['BESTEMMING'], 'SSL'),
				'klaar' 			=> ($result['best_vluchten_ingave_klaar'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['BESTEMMING'], $this->request->post['selected']),
				'action'     => $action
			);  
    	}
		
    	$this->load->language('vis/destinationready');

		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_confirm_periods'] = $this->language->get('text_confirm_periods');		
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_untill_and'] = $this->language->get('text_untill_and');		
			
		$this->data['column_destination'] = $this->language->get('column_destination');	
		$this->data['column_ready'] = $this->language->get('column_ready');		
		$this->data['column_route'] = $this->language->get('column_route');		
		$this->data['column_price'] = $this->language->get('column_price');	
		$this->data['column_basis'] = $this->language->get('column_basis');	

		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_destination'] = $this->url->link('vis/destinationready', 'token=' . $this->session->data['token'] . '&sort=BESTEMMING' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
				
		$pagination = new Pagination();
		$pagination->total = $destinationready_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('vis/destinationready', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_destination'] = $filter_destination;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'vis/destinationready_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	public function swdestinationready(){
		$this->load->model('vis/destinationready');

		$result = $this->model_vis_destinationready->switchDestinationReadyByDestination($this->request->get['dest'], $this->request->get['val']);
		
		if(TRUE===$result){
			if($this->request->get['val']=='on'){
				$output = '<img src="view/image/accept.png" onClick="javascript:switchDestinationReadyValue(\''.$this->request->get['dest'].'\',\'off\');" />';
			}else{
				$output = '<img src="view/image/delete.png" onClick="javascript:switchDestinationReadyValue(\''.$this->request->get['dest'].'\',\'on\');" />';
			}
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}
		$this->response->setOutput($output);
	}
	
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'vis/destinationready')) {
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
    	if (!$this->user->hasPermission('modify', 'vis/destinationready')) {
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