<?php
/**
 * Cabin class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCruiseCabin extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('cruise/cabin');
    	
		$this->document->setTitle($this->language->get('text_cabins')); 
		
		$this->load->model('cruise/cabin');
		
		$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('cruise/cabin');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('cruise/cabin');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_cabin->addCabin($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}
			
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
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
			
			$this->redirect($this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('cruise/cabin');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/cabin');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_cabin->editCabin($this->request->get['cabin_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}
			
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
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
			
			$this->redirect($this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('cruise/cabin');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/cabin');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $cabin_id) {
				$this->model_cruise_cabin->deleteCabin($cabin_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}
			
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
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
			
			$this->redirect($this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('cruise/cabin');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/cabin');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $cabin_id) {
				$this->model_cruise_cabin->copyCabin($cabin_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
			
			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
			}
			
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
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
			
			$this->redirect($this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {	
				
		if (isset($this->request->get['filter_title'])) {
			$filter_title = $this->request->get['filter_title'];
		} else {
			$filter_title = null;
		}
		
		if (isset($this->request->get['filter_ship'])) {
			$filter_ship = $this->request->get['filter_ship'];
		} else {
			$filter_ship = null;
		}
		
		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ct.cabin_type_name';
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

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
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
			'href'      => $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_cabins'),
			'href'      => $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('cruise/cabin/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('cruise/cabin/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('cruise/cabin/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['cabins'] = array();

		$data = array(
			'filter_title'	  => $filter_title, 
			'filter_ship'	  => $filter_ship, 
			'filter_category'  => $filter_category, 
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$cabins_total = $this->model_cruise_cabin->getTotalCabins($data);
			
		$results = $this->model_cruise_cabin->getCabins($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('cruise/cabin/update', 'token=' . $this->session->data['token'] . '&cabin_id=' . $result['cabin_id'] . $url, 'SSL')
			);
				
      		$this->data['cabins'][] = array(
				'cabin_id' 		=> $result['cabin_id'],
				'ship' 			=> $result['shipname'],
				'company' 		=> $result['shippingcompanyname'],
				'title' 		=> $result['cabintypename'],
				'category' 		=> $result['cabincategoryname'],
				'selected'  	=> isset($this->request->post['selected']) && in_array($result['cabin_id'], $this->request->post['selected']),
				'action'    	=> $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('text_cabins');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');		
			
		$this->data['column_title'] = $this->language->get('column_title');	
		$this->data['column_category'] = $this->language->get('column_category');	
		$this->data['column_ship'] = $this->language->get('column_ship');	
		$this->data['column_company'] = $this->language->get('column_company');	

		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
	
		$this->load->model('cruise/ship');
    	$this->data['ships'] = $this->model_cruise_ship->getShips();
    	$this->data['cabintypes'] = $this->model_cruise_cabin->getCabinTypes();
    	$this->data['categories'] = $this->model_cruise_cabin->getCabinCategories();

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

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_title'] = $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . '&sort=ct.cabin_type_name' . $url, 'SSL');
		$this->data['sort_category'] = $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . '&sort=cc.cabin_category_name' . $url, 'SSL');
		$this->data['sort_ship'] = $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . '&sort=s.ship_name' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
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
		$pagination->total = $cabins_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_title'] = $filter_title;
		$this->data['filter_category'] = $filter_category;
		$this->data['filter_ship'] = $filter_ship;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'cruise/cabin_list.tpl';
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
		$this->data['entry_category'] 		= $this->language->get('entry_category');
		$this->data['entry_ship'] 			= $this->language->get('entry_ship');
		$this->data['entry_active_from'] = $this->language->get('entry_active_from');
		$this->data['entry_active_untill'] = $this->language->get('entry_active_untill');
		$this->data['entry_description'] = $this->language->get('entry_description');
				
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
    	$this->data['button_remove'] = $this->language->get('button_remove');
    	$this->data['button_add_description'] = $this->language->get('button_add_description');
		
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

 		if (isset($this->error['category_id'])) {
			$this->data['error_category_id'] = $this->error['category_id'];
		} else {
			$this->data['error_category_id'] = '';
		}

 		if (isset($this->error['ship_id'])) {
			$this->data['error_ship_id'] = $this->error['ship_id'];
		} else {
			$this->data['error_ship_id'] = '';
		}

 		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = '';
		}

		$url = '';
			
		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];
		}
		
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		
		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
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
			'href'      => $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['cabin_id'])) {
			$this->data['action'] = $this->url->link('cruise/cabin/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('cruise/cabin/update', 'token=' . $this->session->data['token'] . '&cabin_id=' . $this->request->get['cabin_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('cruise/cabin', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['cabin_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$cabin_info = $this->model_cruise_cabin->getCabin($this->request->get['cabin_id']);
    	}
		
    	$this->data['cabintypes'] = $this->model_cruise_cabin->getCabinTypes();
		
		if (isset($this->request->post['cabin_type_id'])) {
      		$this->data['cabin_type_id'] = $this->request->post['cabin_type_id'];
    	} elseif (!empty($cabin_info)) {
			$this->data['cabin_type_id'] = $cabin_info['cabin_type_id'];
		} else {
      		$this->data['cabin_type_id'] = '';
    	}
	
    	$this->data['categories'] = $this->model_cruise_cabin->getCabinCategories();

		if (isset($this->request->post['category_id'])) {
      		$this->data['category_id'] = $this->request->post['category_id'];
    	} elseif (!empty($cabin_info)) {
			$this->data['category_id'] = $cabin_info['cabin_category_id'];
		} else {
      		$this->data['category_id'] = '';
    	}
		
		$this->load->model('cruise/ship');
    	$this->data['ships'] = $this->model_cruise_ship->getShips();
		
		if (isset($this->request->post['ship_id'])) {
      		$this->data['ship_id'] = $this->request->post['ship_id'];
    	} elseif (!empty($cabin_info)) {
			$this->data['ship_id'] = $cabin_info['ship_id'];
		} else {
      		$this->data['ship_id'] = '';
    	}
		
		if (isset($this->request->post['descriptions'])) {
      		$this->data['descriptions'] = $this->request->post['descriptions'];
    	} elseif (!empty($cabin_info)) {
			$this->data['descriptions'] = $this->model_cruise_cabin->getCabinDescriptions($this->request->get['cabin_id']);
		} else {
      		$this->data['descriptions'] = '';
    	}
				
		$this->template = 'cruise/cabin_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'cruise/cabin')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ($this->request->post['cabin_type_id'] < 1 || !isset($this->request->post['cabin_type_id']) ) {
      		$this->error['title'] = $this->language->get('error_title');
    	}
		
    	if ($this->request->post['category_id'] < 1 || !isset($this->request->post['category_id']) ) {
      		$this->error['category_id'] = $this->language->get('error_category_id');
    	}
		
    	if ($this->request->post['ship_id'] < 1 || !isset($this->request->post['ship_id']) ) {
      		$this->error['ship_id'] = $this->language->get('error_ship_id');
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
    	if (!$this->user->hasPermission('modify', 'cruise/cabin')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'cruise/cabin')) {
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