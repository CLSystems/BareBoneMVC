<?php
/**
 * Route class controller for BareBoneMVC.
 *
 * @package BareBone\Controller\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCruiseRoute extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('cruise/route');
    	
		$this->document->setTitle($this->language->get('text_routes')); 
		
		$this->load->model('cruise/route');
		
		$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('cruise/route');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('cruise/route');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_route->addRoute($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}
	
			if (isset($this->request->get['filter_port_departure'])) {
				$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
			}
	
			if (isset($this->request->get['filter_port_arrival'])) {
				$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
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
			
			$this->redirect($this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('cruise/route');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/route');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_route->editRoute($this->request->get['route_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}
	
			if (isset($this->request->get['filter_port_departure'])) {
				$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
			}
	
			if (isset($this->request->get['filter_port_arrival'])) {
				$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
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
			
			$this->redirect($this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('cruise/route');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/route');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $route_id) {
				$this->model_cruise_route->deleteRoute($route_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}
	
			if (isset($this->request->get['filter_port_departure'])) {
				$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
			}
	
			if (isset($this->request->get['filter_port_arrival'])) {
				$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
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
			
			$this->redirect($this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('cruise/route');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/route');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $route_id) {
				$this->model_cruise_route->copyRoute($route_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_ship'])) {
				$url .= '&filter_ship=' . $this->request->get['filter_ship'];
			}
	
			if (isset($this->request->get['filter_port_departure'])) {
				$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
			}
	
			if (isset($this->request->get['filter_port_arrival'])) {
				$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
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
			
			$this->redirect($this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {	
				
		if (isset($this->request->get['filter_route'])) {
			$filter_route = $this->request->get['filter_route'];
		} else {
			$filter_route = null;
		}
				
		if (isset($this->request->get['filter_ship'])) {
			$filter_ship = $this->request->get['filter_ship'];
		} else {
			$filter_ship = null;
		}
				
		if (isset($this->request->get['filter_port_departure'])) {
			$filter_port_departure = $this->request->get['filter_port_departure'];
		} else {
			$filter_port_departure = null;
		}
				
		if (isset($this->request->get['filter_port_arrival'])) {
			$filter_port_arrival = $this->request->get['filter_port_arrival'];
		} else {
			$filter_port_arrival = null;
		}
				
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'r.route_title';
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

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}
	
		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_port_departure'])) {
			$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
		}

		if (isset($this->request->get['filter_port_arrival'])) {
			$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
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
			'href'      => $this->url->link('cruise/route', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_routes'),
			'href'      => $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('cruise/route/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('cruise/route/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('cruise/route/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['routes'] = array();

		$data = array(
			'filter_route'	  => $filter_route, 
			'filter_ship'	  => $filter_ship, 
			'filter_port_departure'	  => $filter_port_departure, 
			'filter_port_arrival'	  => $filter_port_arrival, 
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$routes_total = $this->model_cruise_route->getTotalRoutes($data);
		$results = $this->model_cruise_route->getRoutes($data);
		
		$this->load->model('cruise/ship');

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('cruise/route/update', 'token=' . $this->session->data['token'] . '&route_id=' . $result['route_id'] . $url, 'SSL')
			);
				
      		$this->data['routes'][] = array(
				'route_id' 			=> $result['route_id'],
				'route_title' 		=> $result['route_title'],
				'ship_name' 		=> $this->model_cruise_ship->getShipNameById($result['ship_id']),
				'port_departure' 	=> $result['port_departure'],
				'port_arrival' 		=> $result['port_arrival'],
				'transfers' 		=> $result['transfers'],
				'handling' 			=> $result['handling'],
				'harbours' 			=> $result['harbours'],
				'tax_harbours' 		=> $result['tax_harbours'],
				'selected'  	=> isset($this->request->post['selected']) && in_array($result['ship_id'], $this->request->post['selected']),
				'action'    	=> $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('text_routes');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');		
			
		$this->data['column_ship'] = $this->language->get('column_ship');	
		$this->data['column_route'] = $this->language->get('column_route');	
		$this->data['column_port_departure'] = $this->language->get('column_port_departure');	
		$this->data['column_port_arrival'] = $this->language->get('column_port_arrival');	
		$this->data['column_transfers'] = $this->language->get('column_transfers');	
		$this->data['column_handling'] = $this->language->get('column_handling');	
		$this->data['column_harbours'] = $this->language->get('column_harbours');	
		$this->data['column_tax_harbours'] = $this->language->get('column_tax_harbours');	

		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
	
		$this->load->model('cruise/ship');
    	$this->data['ships'] = $this->model_cruise_ship->getShips();

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

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}
	
		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_port_departure'])) {
			$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
		}

		if (isset($this->request->get['filter_date_departure'])) {
			$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
		}

		if (isset($this->request->get['filter_port_arrival'])) {
			$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
		}

		if (isset($this->request->get['filter_date_arrival'])) {
			$url .= '&filter_date_arrival=' . $this->request->get['filter_date_arrival'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_route'] = $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . '&sort=r.route_title' . $url, 'SSL');
		$this->data['sort_ship'] = $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . '&sort=s.ship_name' . $url, 'SSL');
		$this->data['sort_port_departure'] = $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . '&sort=t.port_departure' . $url, 'SSL');
		$this->data['sort_port_arrival'] = $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . '&sort=t.port_arrival' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_port_departure'])) {
			$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
		}

		if (isset($this->request->get['filter_date_departure'])) {
			$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
		}

		if (isset($this->request->get['filter_port_arrival'])) {
			$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
		}

		if (isset($this->request->get['filter_date_arrival'])) {
			$url .= '&filter_date_arrival=' . $this->request->get['filter_date_arrival'];
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
		$pagination->total = $routes_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_route'] = $filter_route;
		$this->data['filter_ship'] = $filter_ship;
		$this->data['filter_port_departure'] = $filter_port_departure;
		$this->data['filter_port_arrival'] = $filter_port_arrival;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'cruise/route_list.tpl';
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

		$this->data['entry_ship'] 			= $this->language->get('entry_ship');
		$this->data['entry_route_title'] 	= $this->language->get('entry_route_title');
		$this->data['entry_port_departure'] = $this->language->get('entry_port_departure');
		$this->data['entry_port_arrival'] 	= $this->language->get('entry_port_arrival');
		$this->data['entry_transfers'] 		= $this->language->get('entry_transfers');
		$this->data['entry_handling'] 		= $this->language->get('entry_handling');
		$this->data['entry_harbours'] 		= $this->language->get('entry_harbours');
		$this->data['entry_tax_harbours'] 	= $this->language->get('entry_tax_harbours');
				
    	$this->data['button_save'] 		= $this->language->get('button_save');
    	$this->data['button_cancel'] 	= $this->language->get('button_cancel');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['ship_id'])) {
			$this->data['error_ship_id'] = $this->error['ship_id'];
		} else {
			$this->data['error_ship_id'] = '';
		}

 		if (isset($this->error['route_title'])) {
			$this->data['error_route_title'] = $this->error['route_title'];
		} else {
			$this->data['error_route_title'] = '';
		}

 		if (isset($this->error['port_departure'])) {
			$this->data['error_port_departure'] = $this->error['port_departure'];
		} else {
			$this->data['error_port_departure'] = '';
		}

 		if (isset($this->error['port_arrival'])) {
			$this->data['error_port_arrival'] = $this->error['port_arrival'];
		} else {
			$this->data['error_port_arrival'] = '';
		}

 		if (isset($this->error['transfers'])) {
			$this->data['error_transfers'] = $this->error['transfers'];
		} else {
			$this->data['error_transfers'] = '';
		}

 		if (isset($this->error['handling'])) {
			$this->data['error_handling'] = $this->error['handling'];
		} else {
			$this->data['error_handling'] = '';
		}

 		if (isset($this->error['harbours'])) {
			$this->data['error_harbours'] = $this->error['harbours'];
		} else {
			$this->data['error_harbours'] = '';
		}

 		if (isset($this->error['tax_harbours'])) {
			$this->data['error_tax_harbours'] = $this->error['tax_harbours'];
		} else {
			$this->data['error_tax_harbours'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_port_departure'])) {
			$url .= '&filter_port_departure=' . $this->request->get['filter_port_departure'];
		}

		if (isset($this->request->get['filter_port_arrival'])) {
			$url .= '&filter_port_arrival=' . $this->request->get['filter_port_arrival'];
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
			'href'      => $this->url->link('cruise/route', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['route_id'])) {
			$this->data['action'] = $this->url->link('cruise/route/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('cruise/route/update', 'token=' . $this->session->data['token'] . '&route_id=' . $this->request->get['route_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('cruise/route', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['route_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$route_info = $this->model_cruise_route->getRoute($this->request->get['route_id']);
    	}
		
		$this->load->model('cruise/ship');
    	$this->data['ships'] = $this->model_cruise_ship->getShips();
		
		if (isset($this->request->post['ship_id'])) {
      		$this->data['ship_id'] = $this->request->post['ship_id'];
    	} elseif (!empty($route_info)) {
			$this->data['ship_id'] = $route_info['ship_id'];
		} else {
      		$this->data['ship_id'] = '';
    	}
		
		if (isset($this->request->post['route_title'])) {
      		$this->data['route_title'] = $this->request->post['route_title'];
    	} elseif (!empty($route_info)) {
			$this->data['route_title'] = $route_info['route_title'];
		} else {
      		$this->data['route_title'] = '';
    	}
		
		if (isset($this->request->post['port_departure'])) {
      		$this->data['port_departure'] = $this->request->post['port_departure'];
    	} elseif (!empty($route_info)) {
			$this->data['port_departure'] = $route_info['port_departure'];
		} else {
      		$this->data['port_departure'] = '';
    	}
		
		if (isset($this->request->post['port_arrival'])) {
      		$this->data['port_arrival'] = $this->request->post['port_arrival'];
    	} elseif (!empty($route_info)) {
			$this->data['port_arrival'] = $route_info['port_arrival'];
		} else {
      		$this->data['port_arrival'] = '';
    	}
		
		if (isset($this->request->post['transfers'])) {
      		$this->data['transfers'] = $this->request->post['transfers'];
    	} elseif (!empty($route_info)) {
			$this->data['transfers'] = $route_info['transfers'];
		} else {
      		$this->data['transfers'] = '';
    	}
		
		if (isset($this->request->post['handling'])) {
      		$this->data['handling'] = $this->request->post['handling'];
    	} elseif (!empty($route_info)) {
			$this->data['handling'] = $route_info['handling'];
		} else {
      		$this->data['handling'] = 30;
    	}
		
		if (isset($this->request->post['harbours'])) {
      		$this->data['harbours'] = $this->request->post['harbours'];
    	} elseif (!empty($route_info)) {
			$this->data['harbours'] = $route_info['harbours'];
		} else {
      		$this->data['harbours'] = '';
    	}
		
		if (isset($this->request->post['tax_harbours'])) {
      		$this->data['tax_harbours'] = $this->request->post['tax_harbours'];
    	} elseif (!empty($route_info)) {
			$this->data['tax_harbours'] = $route_info['tax_harbours'];
		} else {
      		$this->data['tax_harbours'] = '0';
    	}
		
		$this->template = 'cruise/route_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'cruise/route')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ($this->request->post['ship_id'] < 1 || !isset($this->request->post['ship_id']) ) {
      		$this->error['ship_id'] = $this->language->get('error_ship_id');
    	}

    	if (strlen($this->request->post['route_title']) < 3 || !isset($this->request->post['route_title']) ) {
      		$this->error['route_title'] = $this->language->get('error_route_title');
    	}

    	if (strlen($this->request->post['port_departure']) < 3 || !isset($this->request->post['port_departure']) ) {
      		$this->error['port_departure'] = $this->language->get('error_port_departure');
    	}

    	if ($this->request->post['transfers'] < 1 || !isset($this->request->post['transfers']) ) {
      		$this->error['transfers'] = $this->language->get('error_transfers');
    	}

    	if ($this->request->post['handling'] < 1 || !isset($this->request->post['handling']) ) {
      		$this->error['handling'] = $this->language->get('error_handling');
    	}

    	if ($this->request->post['harbours'] < 1 || !isset($this->request->post['harbours']) ) {
      		$this->error['harbours'] = $this->language->get('error_harbours');
    	}

    	if (!isset($this->request->post['tax_harbours']) ) {
      		$this->error['tax_harbours'] = $this->language->get('error_tax_harbours');
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
    	if (!$this->user->hasPermission('modify', 'cruise/route')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'cruise/route')) {
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