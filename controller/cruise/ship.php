<?php
/**
 * Ship class controller for BareBoneMVC.
 *
 * @package BareBone\Controller\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCruiseShip extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('cruise/ship');
    	
		$this->document->setTitle($this->language->get('text_ships')); 
		
		$this->load->model('cruise/ship');
		
		$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('cruise/ship');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('cruise/ship');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_ship->addShip($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_company'])) {
				$url .= '&filter_company=' . $this->request->get['filter_company'];
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
			
			$this->redirect($this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('cruise/ship');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/ship');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_ship->editShip($this->request->get['ship_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_company'])) {
				$url .= '&filter_company=' . $this->request->get['filter_company'];
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
			
			$this->redirect($this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('cruise/ship');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/ship');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $ship_id) {
				$this->model_cruise_ship->deleteShip($ship_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_company'])) {
				$url .= '&filter_company=' . $this->request->get['filter_company'];
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
			
			$this->redirect($this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('cruise/ship');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/ship');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $ship_id) {
				$this->model_cruise_ship->copyShip($ship_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_company'])) {
				$url .= '&filter_company=' . $this->request->get['filter_company'];
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
			
			$this->redirect($this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {				
		if (isset($this->request->get['filter_title'])) {
			$filter_title = $this->request->get['filter_title'];
		} else {
			$filter_title = null;
		}
		if (isset($this->request->get['filter_company'])) {
			$filter_company = $this->request->get['filter_company'];
		} else {
			$filter_company = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 's.ship_name';
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
						
		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}
			
		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . $this->request->get['filter_company'];
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
       		'text'      => $this->language->get('text_cruise'),
			'href'      => $this->url->link('cruise/ship', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_ships'),
			'href'      => $this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('cruise/ship/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('cruise/ship/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('cruise/ship/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['ships'] = array();

		$data = array(
			'filter_title'	  => $filter_title, 
			'filter_company'  => $filter_company, 
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$ships_total = $this->model_cruise_ship->getTotalShips($data);
			
		$results = $this->model_cruise_ship->getShips($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('cruise/ship/update', 'token=' . $this->session->data['token'] . '&ship_id=' . $result['ship_id'] . $url, 'SSL')
			);
				
      		$this->data['ships'][] = array(
				'ship_id' 		=> $result['ship_id'],
				'company_id' 	=> $result['shipping_company_id'],
				'company_name' 	=> $result['shipping_company_name'],
				'title' 		=> $result['ship_name'],
				'shipnumber' 	=> $result['ship_number'],
				'selected'  	=> isset($this->request->post['selected']) && in_array($result['ship_id'], $this->request->post['selected']),
				'action'    	=> $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('text_ships');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');		
			
		$this->data['column_title'] = $this->language->get('column_title');	
		$this->data['column_company'] = $this->language->get('column_company');	

		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
	
		$this->load->model('cruise/shippingcompany');
    	$this->data['companies'] = $this->model_cruise_shippingcompany->getShippingCompanies();

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

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . $this->request->get['filter_company'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_title'] = $this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . '&sort=s.ship_name' . $url, 'SSL');
		$this->data['sort_company'] = $this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . '&sort=sc.shipping_company_name' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . $this->request->get['filter_company'];
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
				
		$pagination = new Pagination();
		$pagination->total = $ships_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_title'] = $filter_title;
		$this->data['filter_company'] = $filter_company;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'cruise/ship_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 
    	$this->data['text_enabled'] 		= $this->language->get('text_enabled');
    	$this->data['text_disabled'] 		= $this->language->get('text_disabled');
    	$this->data['text_none'] 			= $this->language->get('text_none');
    	$this->data['text_yes'] 			= $this->language->get('text_yes');
    	$this->data['text_no'] 				= $this->language->get('text_no');
		$this->data['text_select_all'] 		= $this->language->get('text_select_all');
		$this->data['text_unselect_all'] 	= $this->language->get('text_unselect_all');
		$this->data['text_plus'] 			= $this->language->get('text_plus');
		$this->data['text_minus'] 			= $this->language->get('text_minus');
		$this->data['text_default'] 		= $this->language->get('text_default');
		$this->data['text_image_manager'] 	= $this->language->get('text_image_manager');
		$this->data['text_browse'] 			= $this->language->get('text_browse');
		$this->data['text_clear'] 			= $this->language->get('text_clear');
		$this->data['text_option'] 			= $this->language->get('text_option');
		$this->data['text_option_value'] 	= $this->language->get('text_option_value');
		$this->data['text_select'] 			= $this->language->get('text_select');
		$this->data['text_none'] 			= $this->language->get('text_none');
		$this->data['text_percent'] 		= $this->language->get('text_percent');
		$this->data['text_amount'] 			= $this->language->get('text_amount');

		$this->data['entry_title'] 			= $this->language->get('entry_title');
		$this->data['entry_company'] 		= $this->language->get('entry_company');
		$this->data['entry_shipnumber'] 	= $this->language->get('entry_shipnumber');
		$this->data['entry_active_from'] 	= $this->language->get('entry_active_from');
		$this->data['entry_active_untill'] 	= $this->language->get('entry_active_untill');
		$this->data['entry_impression'] 	= $this->language->get('entry_impression');
		$this->data['entry_facilities'] 	= $this->language->get('entry_facilities');
		$this->data['entry_boatdata'] 		= $this->language->get('entry_boatdata');
				
    	$this->data['button_save'] 		= $this->language->get('button_save');
    	$this->data['button_cancel'] 	= $this->language->get('button_cancel');
    	$this->data['button_remove'] 	= $this->language->get('button_remove');
    	$this->data['button_add_description'] 	= $this->language->get('button_add_description');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_descriptions'] = $this->language->get('tab_descriptions');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['title'])) {
			$this->data['error_title'] = $this->error['title'];
		} else {
			$this->data['error_title'] = '';
		}

 		if (isset($this->error['company_id'])) {
			$this->data['error_company_id'] = $this->error['company_id'];
		} else {
			$this->data['error_company_id'] = '';
		}

 		if (isset($this->error['shipnumber'])) {
			$this->data['error_shipnumber'] = $this->error['shipnumber'];
		} else {
			$this->data['error_shipnumber'] = '';
		}

 		if (isset($this->error['descriptions'])) {
			$this->data['error_descriptions'] = $this->error['descriptions'];
		} else {
			$this->data['error_descriptions'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}

		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . $this->request->get['filter_company'];
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
       		'text'      => $this->language->get('text_cruise'),
			'href'      => $this->url->link('cruise/ship', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['ship_id'])) {
			$this->data['action'] = $this->url->link('cruise/ship/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('cruise/ship/update', 'token=' . $this->session->data['token'] . '&ship_id=' . $this->request->get['ship_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('cruise/ship', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['ship_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$ship_info = $this->model_cruise_ship->getShip($this->request->get['ship_id']);
    	}
		
		if (isset($this->request->post['title'])) {
      		$this->data['title'] = $this->request->post['title'];
    	} elseif (!empty($ship_info)) {
			$this->data['title'] = $ship_info['ship_name'];
		} else {
      		$this->data['title'] = '';
    	}
		
		$this->load->model('cruise/shippingcompany');
    	$this->data['companies'] = $this->model_cruise_shippingcompany->getShippingCompanies();

		if (isset($this->request->post['company_id'])) {
      		$this->data['company_id'] = $this->request->post['company_id'];
    	} elseif (!empty($ship_info)) {
			$this->data['company_id'] = $ship_info['shipping_company_id'];
		} else {
      		$this->data['company_id'] = '';
    	}
		
		if (isset($this->request->post['shipnumber'])) {
      		$this->data['shipnumber'] = $this->request->post['shipnumber'];
    	} elseif (!empty($ship_info)) {
			$this->data['shipnumber'] = $ship_info['ship_number'];
		} else {
      		$this->data['shipnumber'] = '';
    	}
		
		if (isset($this->request->post['descriptions'])) {
      		$this->data['descriptions'] = $this->request->post['descriptions'];
    	} elseif (!empty($ship_info)) {
			$this->data['descriptions'] = $this->model_cruise_ship->getShipDescriptions($this->request->get['ship_id']);
		} else {
      		$this->data['descriptions'] = array();
    	}
				
		$this->template = 'cruise/ship_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'cruise/ship')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if (strlen($this->request->post['title']) < 3 || !isset($this->request->post['title']) ) {
      		$this->error['title'] = $this->language->get('error_title');
    	}

    	if ($this->request->post['company_id'] < 1 || !isset($this->request->post['company_id']) ) {
      		$this->error['company_id'] = $this->language->get('error_company_id');
    	}

    	if (strlen($this->request->post['shipnumber']) < 2 || !isset($this->request->post['shipnumber']) ) {
      		$this->error['shipnumber'] = $this->language->get('error_shipnumber');
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
    	if (!$this->user->hasPermission('modify', 'cruise/ship')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'cruise/ship')) {
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