<?php
/**
 * Price class controller for BareBoneMVC.
 *
 * @package BareBone\Controller\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCruisePrice extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('cruise/price');
    	
		$this->document->setTitle($this->language->get('text_prices')); 
		
		$this->load->model('cruise/price');
		
		$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('cruise/price');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('cruise/price');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_price->addPrice($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_cabin_type'])) {
				$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
			}
	
			if (isset($this->request->get['filter_cabin_category'])) {
				$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			
			$this->redirect($this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('cruise/price');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/price');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_price->editPrice($this->request->get['price_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_cabin_type'])) {
				$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
			}
	
			if (isset($this->request->get['filter_cabin_category'])) {
				$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			
			$this->redirect($this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('cruise/price');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/price');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $price_id) {
				$this->model_cruise_price->deletePrice($price_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_cabin_type'])) {
				$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
			}
	
			if (isset($this->request->get['filter_cabin_category'])) {
				$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			
			$this->redirect($this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('cruise/price');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/price');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $price_id) {
				$this->model_cruise_price->copyPrice($price_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_cabin_type'])) {
				$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
			}
	
			if (isset($this->request->get['filter_cabin_category'])) {
				$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			
			$this->redirect($this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {	
				
		if (isset($this->request->get['filter_ship'])) {
			$filter_ship = $this->request->get['filter_ship'];
		} else {
			$filter_ship = null;
		}
				
		if (isset($this->request->get['filter_route'])) {
			$filter_route = $this->request->get['filter_route'];
		} else {
			$filter_route = null;
		}
				
		if (isset($this->request->get['filter_cabin_type'])) {
			$filter_cabin_type = $this->request->get['filter_cabin_type'];
		} else {
			$filter_cabin_type = null;
		}
				
		if (isset($this->request->get['filter_cabin_category'])) {
			$filter_cabin_category = $this->request->get['filter_cabin_category'];
		} else {
			$filter_cabin_category = null;
		}
				
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
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

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_cabin_type'])) {
			$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
		}

		if (isset($this->request->get['filter_cabin_category'])) {
			$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			'href'      => $this->url->link('cruise/price', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_prices'),
			'href'      => $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('cruise/price/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('cruise/price/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('cruise/price/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['prices'] = array();

		$data = array(
			'filter_ship'	  		=> $filter_ship, 
			'filter_route' 			=> $filter_route, 
			'filter_cabin_type'	  	=> $filter_cabin_type, 
			'filter_cabin_category'	=> $filter_cabin_category, 
			'filter_price' 			=> $filter_price,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$this->load->model('cruise/cruise');
		$this->load->model('cruise/route');
		$this->load->model('cruise/ship');
		$this->load->model('cruise/cabin');
		$this->load->model('cruise/cabintype');
		$this->load->model('cruise/cabincategory');

		$prices_total = $this->model_cruise_price->getTotalPrices($data);
		$results = $this->model_cruise_price->getPrices($data);
		
		foreach ($results as $result) {
			$cruise_arr = array();
			$cruise_arr = $this->model_cruise_cruise->getCruise($result['cruise_id']);
			
			$d1 = explode('-', $cruise_arr['date_departure']);
			$date_dep = date('d-m-Y', gmmktime(0,0,0,$d1[1],$d1[2],$d1[0]));
			$d2 = explode('-', $cruise_arr['date_arrival']);
			$date_arr = date('d-m-Y', gmmktime(0,0,0,$d2[1],$d2[2],$d2[0]));
			
			$route_arr = array();
			$route_arr = $this->model_cruise_route->getRoute($cruise_arr['route_id']);
			
			$ship_arr = array();
			$ship_arr = $this->model_cruise_ship->getShip($route_arr['ship_id']);
			
			$cabin_arr = array();
			$cabin_arr = $this->model_cruise_cabin->getCabin($result['cabin_id']);
			$cabin_t = $this->model_cruise_cabintype->getCabinType($cabin_arr['cabin_type_id']);
			$cabin_c = $this->model_cruise_cabincategory->getCabinCategory($cabin_arr['cabin_category_id']);

			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('cruise/price/update', 'token=' . $this->session->data['token'] . '&price_id=' . $result['price_id'] . $url, 'SSL')
			);
				
      		$this->data['prices'][] = array(
				'price_id' 			=> $result['price_id'],
				'ship_name' 		=> $ship_arr['ship_name'],
				'route_title' 		=> $route_arr['route_title'],
				'date_departure' 	=> $date_dep,
				'date_arrival' 		=> $date_arr,
				'cabin_type' 		=> $cabin_t['cabin_type_name'],
				'cabin_category' 	=> $cabin_c['cabin_category_name'],
				'price' 			=> $result['price'],
				'own_commission' 	=> $result['own_commission'],
				'agent_commission' 	=> $result['agent_commission'],
				'selected'  	=> isset($this->request->post['selected']) && in_array($result['ship_id'], $this->request->post['selected']),
				'action'    	=> $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('text_prices');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');	
		$this->data['text_on_request'] = $this->language->get('text_on_request');	
			
		$this->data['column_ship'] = $this->language->get('column_ship');
		$this->data['column_route'] = $this->language->get('column_route');
		$this->data['column_date_departure'] = $this->language->get('column_date_departure');
		$this->data['column_date_arrival'] = $this->language->get('column_date_arrival');
		$this->data['column_cabin_type'] = $this->language->get('column_cabin_type');	
		$this->data['column_cabin_category'] = $this->language->get('column_cabin_category');	
		$this->data['column_price'] = $this->language->get('column_price');	
		$this->data['column_own_commission'] = $this->language->get('column_own_commission');	
		$this->data['column_agent_commission'] = $this->language->get('column_agent_commission');	

		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
	
    	$this->data['ships'] = $this->model_cruise_ship->getShips();
    	$this->data['routes'] = $this->model_cruise_route->getRoutes();
    	$this->data['cabin_types'] = $this->model_cruise_cabintype->getCabinTypes();
    	$this->data['cabin_categories'] = $this->model_cruise_cabintype->getCabinCategories();

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
		
		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_cabin_type'])) {
			$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
		}

		if (isset($this->request->get['filter_cabin_category'])) {
			$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}
	
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_ship'] = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . '&sort=s.ship_name' . $url, 'SSL');
		$this->data['sort_route'] = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . '&sort=r.route_title' . $url, 'SSL');
		$this->data['sort_cabin_type'] = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . '&sort=ct.cabin_type_name' . $url, 'SSL');
		$this->data['sort_cabin_category'] = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . '&sort=cc.cabin_category_name' . $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		
		$url = '';
		
		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_cabin_type'])) {
			$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
		}

		if (isset($this->request->get['filter_cabin_category'])) {
			$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
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
		$pagination->total = $prices_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_ship'] = $filter_ship;
		$this->data['filter_route'] = $filter_route;
		$this->data['filter_cabin_type'] = $filter_cabin_type;
		$this->data['filter_cabin_category'] = $filter_cabin_category;
		$this->data['filter_price'] = $filter_price;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'cruise/price_list.tpl';
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
		
		$this->data['text_choose_cruise'] 			= $this->language->get('text_choose_cruise');

		$this->data['entry_cruise'] 		= $this->language->get('entry_cruise');
		$this->data['entry_cabin'] 			= $this->language->get('entry_cabin');
		$this->data['entry_price'] 			= $this->language->get('entry_price');
		$this->data['entry_own_commission'] 	= $this->language->get('entry_own_commission');
		$this->data['entry_agent_commission'] 	= $this->language->get('entry_agent_commission');
				
    	$this->data['button_save'] 		= $this->language->get('button_save');
    	$this->data['button_cancel'] 	= $this->language->get('button_cancel');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['cruise_id'])) {
			$this->data['error_cruise_id'] = $this->error['cruise_id'];
		} else {
			$this->data['error_cruise_id'] = '';
		}

 		if (isset($this->error['cabin_id'])) {
			$this->data['error_cabin_id'] = $this->error['cabin_id'];
		} else {
			$this->data['error_cabin_id'] = '';
		}

 		if (isset($this->error['price'])) {
			$this->data['error_price'] = $this->error['price'];
		} else {
			$this->data['error_price'] = '';
		}

 		if (isset($this->error['own_commission'])) {
			$this->data['error_own_commission'] = $this->error['own_commission'];
		} else {
			$this->data['error_own_commission'] = '';
		}

 		if (isset($this->error['agent_commission'])) {
			$this->data['error_agent_commission'] = $this->error['agent_commission'];
		} else {
			$this->data['error_agent_commission'] = '';
		}

		$url = '';
		
		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_cabin_type'])) {
			$url .= '&filter_cabin_type=' . $this->request->get['filter_cabin_type'];
		}

		if (isset($this->request->get['filter_cabin_category'])) {
			$url .= '&filter_cabin_category=' . $this->request->get['filter_cabin_category'];
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
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
			'href'      => $this->url->link('cruise/price', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['price_id'])) {
			$this->data['action'] = $this->url->link('cruise/price/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('cruise/price/update', 'token=' . $this->session->data['token'] . '&price_id=' . $this->request->get['price_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('cruise/price', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['price_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$price_info = $this->model_cruise_price->getPrice($this->request->get['price_id']);
    	}
		
		$this->load->model('cruise/cruise');
    	$this->data['cruises'] = $this->model_cruise_cruise->getCruiseDropdownData();
		
		$this->load->model('cruise/cabin');
    	// $this->data['cabins'] = $this->model_cruise_cabin->getCabins();
		
		if (isset($this->request->post['cruise_id'])) {
      		$this->data['cruise_id'] = $this->request->post['cruise_id'];
    	} elseif (!empty($price_info)) {
			$this->data['cruise_id'] = $price_info['cruise_id'];
		} else {
      		$this->data['cruise_id'] = '';
    	}
		
		if (isset($this->request->post['cabin_id'])) {
      		$this->data['cabin_id'] = $this->request->post['cabin_id'];
    	} elseif (!empty($price_info)) {
			$this->data['cabins'] = $this->model_cruise_cabin->getCabinsByCruiseId($price_info['cruise_id']);
			$this->data['cabin_id'] = $price_info['cabin_id'];
		} else {
      		$this->data['cabin_id'] = '';
    	}
		
		if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (!empty($price_info)) {
			$this->data['price'] = $price_info['price'];
		} else {
      		$this->data['price'] = '';
    	}
		
		if (isset($this->request->post['own_commission'])) {
      		$this->data['own_commission'] = $this->request->post['own_commission'];
    	} elseif (!empty($price_info)) {
			$this->data['own_commission'] = $price_info['own_commission'];
		} else {
      		$this->data['own_commission'] = '15';
    	}
		
		if (isset($this->request->post['agent_commission'])) {
      		$this->data['agent_commission'] = $this->request->post['agent_commission'];
    	} elseif (!empty($price_info)) {
			$this->data['agent_commission'] = $price_info['agent_commission'];
		} else {
      		$this->data['agent_commission'] = '11';
    	}
		
		$this->template = 'cruise/price_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'cruise/price')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ($this->request->post['cruise_id'] < 1 || !isset($this->request->post['cruise_id']) ) {
      		$this->error['cruise_id'] = $this->language->get('error_cruise_id');
    	}

    	if ($this->request->post['cabin_id'] < 1 || !isset($this->request->post['cabin_id']) ) {
      		$this->error['cabin_id'] = $this->language->get('error_cabin_id');
    	}

    	if ($this->request->post['price'] == null ||!isset($this->request->post['price']) ) {
      		$this->error['price'] = $this->language->get('error_price');
    	}

    	if (!isset($this->request->post['own_commission']) ) {
      		$this->error['own_commission'] = $this->language->get('error_own_commission');
    	}

    	if (!isset($this->request->post['agent_commission']) ) {
      		$this->error['agent_commission'] = $this->language->get('error_agent_commission');
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
    	if (!$this->user->hasPermission('modify', 'cruise/price')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'cruise/price')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	
	public function getcabinsdropdownbycruiseid(){
		$cruise_id = $this->request->get['cruise_id'];
		$this->load->language('cruise/price');
		$this->load->model('cruise/cabin');
		$cabins_data = $this->model_cruise_cabin->getCabinsByCruiseId($cruise_id);
		
		if($cabins_data){
			$html = '<select name="cabin_id" >';
			$html .= '<option value="0" selected="selected">'. $this->language->get('text_select') .'</option>';
			foreach ($cabins_data as $cabin) { 
				if ($cabin['cabin_id'] == $cabin_id) { 
					$html .= '<option value="'.$cabin['cabin_id'].'" selected="selected">'.$cabin['cabin_type_name'].' | '. $cabin['cabin_category_name'].'</option>';
				} else {
					$html .= '<option value="'.$cabin['cabin_id'].'">'.$cabin['cabin_type_name'].' | '.$cabin['cabin_category_name'].'</option>';
				} 
			} 
			$html .= '</select>';
		}else{
			$html = '<font color=red>Geen hut(ten) gevonden! </font>';
		}
					
		$this->response->setOutput($html);
	}
	
	
	
	
	
}
?>