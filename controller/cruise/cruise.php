<?php
/**
 * Cruise class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Cruise 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCruiseCruise extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('cruise/cruise');
    	
		$this->document->setTitle($this->language->get('text_cruises')); 
		
		$this->load->model('cruise/cruise');
		
		$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('cruise/cruise');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('cruise/cruise');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_cruise->addCruise($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_date_departure'])) {
				$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
			
			$this->redirect($this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('cruise/cruise');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/cruise');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_cruise_cruise->editCruise($this->request->get['cruise_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_date_departure'])) {
				$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
			
			$this->redirect($this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('cruise/cruise');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/cruise');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $cruise_id) {
				$this->model_cruise_cruise->deleteCruise($cruise_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_date_departure'])) {
				$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
			
			$this->redirect($this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('cruise/cruise');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('cruise/cruise');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $cruise_id) {
				$this->model_cruise_cruise->copyCruise($cruise_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['filter_route'])) {
				$url .= '&filter_route=' . $this->request->get['filter_route'];
			}
	
			if (isset($this->request->get['filter_date_departure'])) {
				$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
			
			$this->redirect($this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
				
		if (isset($this->request->get['filter_port_departure'])) {
			$filter_port_departure = $this->request->get['filter_port_departure'];
		} else {
			$filter_port_departure = null;
		}
				
		if (isset($this->request->get['filter_date_departure'])) {
			$filter_date_departure = $this->request->get['filter_date_departure'];
		} else {
			$filter_date_departure = null;
		}
				
		if (isset($this->request->get['filter_port_arrival'])) {
			$filter_port_arrival = $this->request->get['filter_port_arrival'];
		} else {
			$filter_port_arrival = null;
		}
		
		if (isset($this->request->get['filter_date_arrival'])) {
			$filter_date_arrival = $this->request->get['filter_date_arrival'];
		} else {
			$filter_date_arrival = null;
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

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_date_departure'])) {
			$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
       		'text'      => $this->language->get('text_cruises'),
			'href'      => $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('cruise/cruise/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('cruise/cruise/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('cruise/cruise/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['cruises'] = array();

		$data = array(
			'filter_ship'	  => $filter_ship, 
			'filter_route'	  => $filter_route, 
			'filter_port_departure'	  => $filter_port_departure, 
			'filter_date_departure'	  => $filter_date_departure, 
			'filter_port_arrival'	  => $filter_port_arrival, 
			'filter_date_arrival'	  => $filter_date_arrival, 
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$cruises_total = $this->model_cruise_cruise->getTotalCruises($data);
		$results = $this->model_cruise_cruise->getCruises($data);
		
		$this->load->model('cruise/route');
		$this->load->model('cruise/ship');

		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('cruise/cruise/update', 'token=' . $this->session->data['token'] . '&cruise_id=' . $result['cruise_id'] . $url, 'SSL')
			);
			
			$route_arr = array();
			$route_arr = $this->model_cruise_route->getRoute($result['route_id']);
			
			$ship_arr = array();
			$ship_arr = $this->model_cruise_ship->getShip($route_arr['ship_id']);
			
			$dep_f = explode('-',$result['date_departure']);
			$date_dep = date('d-m-Y', gmmktime(0,0,0, $dep_f[1], $dep_f[2], $dep_f[0]));
				
			$dep_t = explode('-',$result['date_arrival']);
			$date_arr = date('d-m-Y', gmmktime(0,0,0, $dep_t[1], $dep_t[2], $dep_t[0]));
				
      		$this->data['cruises'][] = array(
				'cruise_id' 		=> $result['cruise_id'],
				'route_name' 		=> $route_arr['route_title'],
				'ship_name' 		=> $ship_arr['ship_name'],
				'date_departure' 	=> $date_dep,
				'date_arrival' 		=> $date_arr,
				'flight' 			=> $result['flight'],
				'taxes' 			=> $result['taxes'],
				'hotel' 			=> $result['hotel'],
				'selected'  	=> isset($this->request->post['selected']) && in_array($result['ship_id'], $this->request->post['selected']),
				'action'    	=> $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('text_cruises');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');		
			
		$this->data['column_ship'] = $this->language->get('column_ship');	
		$this->data['column_route'] = $this->language->get('column_route');	
		$this->data['column_port_departure'] = $this->language->get('column_port_departure');	
		$this->data['column_date_departure'] = $this->language->get('column_date_departure');	
		$this->data['column_port_arrival'] = $this->language->get('column_port_arrival');	
		$this->data['column_date_arrival'] = $this->language->get('column_date_arrival');
		$this->data['column_flight'] = $this->language->get('column_flight');	
		$this->data['column_taxes'] = $this->language->get('column_taxes');	
		$this->data['column_hotel'] = $this->language->get('column_hotel');
		
		$this->data['column_action'] = $this->language->get('column_action');		
				
		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');
		 
 		$this->data['token'] = $this->session->data['token'];
	
		$this->load->model('cruise/ship');
    	$this->data['ships'] = $this->model_cruise_ship->getShips();

		$this->load->model('cruise/route');
    	$this->data['routes'] = $this->model_cruise_route->getRoutes();

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

		if (isset($this->request->get['filter_date_departure'])) {
			$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
					
		$this->data['sort_route'] = $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . '&sort=r.route_title' . $url, 'SSL');
		$this->data['sort_date_departure'] = $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . '&sort=c.date_departure' . $url, 'SSL');
		$this->data['sort_date_arrival'] = $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . '&sort=c.date_arrival' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_date_departure'])) {
			$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
		$pagination->total = $cruises_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_ship'] = $filter_ship;
		$this->data['filter_route'] = $filter_route;
		$this->data['filter_date_departure'] = $filter_date_departure;
		$this->data['filter_date_arrival'] = $filter_date_arrival;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'cruise/cruise_list.tpl';
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

		$this->data['entry_route'] 			= $this->language->get('entry_route');
		$this->data['entry_date_departure'] 	= $this->language->get('entry_date_departure');
		$this->data['entry_time_departure'] 	= $this->language->get('entry_time_departure');
		$this->data['entry_date_arrival'] 	= $this->language->get('entry_date_arrival');
		$this->data['entry_time_arrival'] 	= $this->language->get('entry_time_arrival');
		$this->data['entry_flight'] 		= $this->language->get('entry_flight');
		$this->data['entry_taxes'] 			= $this->language->get('entry_taxes');
		$this->data['entry_hotel'] 			= $this->language->get('entry_hotel');
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

 		if (isset($this->error['route_id'])) {
			$this->data['error_route_id'] = $this->error['route_id'];
		} else {
			$this->data['error_route_id'] = '';
		}

 		if (isset($this->error['date_departure'])) {
			$this->data['error_date_departure'] = $this->error['date_departure'];
		} else {
			$this->data['error_date_departure'] = '';
		}

 		if (isset($this->error['time_departure'])) {
			$this->data['error_time_departure'] = $this->error['time_departure'];
		} else {
			$this->data['error_time_departure'] = '';
		}

 		if (isset($this->error['date_arrival'])) {
			$this->data['error_date_arrival'] = $this->error['date_arrival'];
		} else {
			$this->data['error_date_arrival'] = '';
		}

 		if (isset($this->error['time_arrival'])) {
			$this->data['error_time_arrival'] = $this->error['time_arrival'];
		} else {
			$this->data['error_time_arrival'] = '';
		}

 		if (isset($this->error['flight'])) {
			$this->data['error_flight'] = $this->error['flight'];
		} else {
			$this->data['error_flight'] = '';
		}

 		if (isset($this->error['taxes'])) {
			$this->data['error_taxes'] = $this->error['taxes'];
		} else {
			$this->data['error_taxes'] = '';
		}

 		if (isset($this->error['hotel'])) {
			$this->data['error_hotel'] = $this->error['hotel'];
		} else {
			$this->data['error_hotel'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_ship'])) {
			$url .= '&filter_ship=' . $this->request->get['filter_ship'];
		}

		if (isset($this->request->get['filter_route'])) {
			$url .= '&filter_route=' . $this->request->get['filter_route'];
		}

		if (isset($this->request->get['filter_date_departure'])) {
			$url .= '&filter_date_departure=' . $this->request->get['filter_date_departure'];
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
			'href'      => $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['cruise_id'])) {
			$this->data['action'] = $this->url->link('cruise/cruise/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('cruise/cruise/update', 'token=' . $this->session->data['token'] . '&cruise_id=' . $this->request->get['cruise_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('cruise/cruise', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['cruise_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$cruise_info = $this->model_cruise_cruise->getCruise($this->request->get['cruise_id']);
    	}
		
		$this->load->model('cruise/route');
    	$this->data['routes'] = $this->model_cruise_route->getRouteDropdownData();
		
		if (isset($this->request->post['route_id'])) {
      		$this->data['route_id'] = $this->request->post['route_id'];
    	} elseif (!empty($cruise_info)) {
			$this->data['route_id'] = $cruise_info['route_id'];
		} else {
      		$this->data['route_id'] = '';
    	}
		
		if (isset($this->request->post['date_departure'])) {
      		$this->data['date_departure'] = $this->request->post['date_departure'];
    	} elseif (!empty($cruise_info)) {
			$dep_f = explode('-',$cruise_info['date_departure']);
			$date_dep = date('d-m-Y', gmmktime(0,0,0, $dep_f[1], $dep_f[2], $dep_f[0]));
			$this->data['date_departure'] = $date_dep;
		} else {
      		$this->data['date_departure'] = '';
    	}
		
		if (isset($this->request->post['time_departure'])) {
      		$this->data['time_departure'] = $this->request->post['time_departure'];
    	} elseif (!empty($cruise_info)) {
			$this->data['time_departure'] = $cruise_info['time_departure'];
		} else {
      		$this->data['time_departure'] = '';
    	}
		
		if (isset($this->request->post['date_arrival'])) {
      		$this->data['date_arrival'] = $this->request->post['date_arrival'];
    	} elseif (!empty($cruise_info)) {
			$dep_a = explode('-',$cruise_info['date_arrival']);
			$date_arr = date('d-m-Y', gmmktime(0,0,0, $dep_a[1], $dep_a[2], $dep_a[0]));
			$this->data['date_arrival'] = $date_arr;
		} else {
      		$this->data['date_arrival'] = '';
    	}
		
		if (isset($this->request->post['time_arrival'])) {
      		$this->data['time_arrival'] = $this->request->post['time_arrival'];
    	} elseif (!empty($cruise_info)) {
			$this->data['time_arrival'] = $cruise_info['time_arrival'];
		} else {
      		$this->data['time_arrival'] = '';
    	}
		
		if (isset($this->request->post['flight'])) {
      		$this->data['flight'] = $this->request->post['flight'];
    	} elseif (!empty($cruise_info)) {
			$this->data['flight'] = $cruise_info['flight'];
		} else {
      		$this->data['flight'] = '';
    	}
		
		if (isset($this->request->post['taxes'])) {
      		$this->data['taxes'] = $this->request->post['taxes'];
    	} elseif (!empty($cruise_info)) {
			$this->data['taxes'] = $cruise_info['taxes'];
		} else {
      		$this->data['taxes'] = '';
    	}
		
		if (isset($this->request->post['hotel'])) {
      		$this->data['hotel'] = $this->request->post['hotel'];
    	} elseif (!empty($cruise_info)) {
			$this->data['hotel'] = $cruise_info['hotel'];
		} else {
      		$this->data['hotel'] = '';
    	}
		
		if (isset($this->request->post['descriptions'])) {
      		$this->data['descriptions'] = $this->request->post['descriptions'];
    	} elseif (!empty($cruise_info)) {
			$this->data['descriptions'] = $this->model_cruise_cruise->getCruiseDescriptions($this->request->get['cruise_id']);
		} else {
      		$this->data['descriptions'] = array();
    	}
		
		$this->template = 'cruise/cruise_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'cruise/cruise')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if ($this->request->post['route_id'] < 1 || !isset($this->request->post['route_id']) ) {
      		$this->error['route_id'] = $this->language->get('error_route_id');
    	}

    	if (strlen($this->request->post['date_departure']) < 10 || !isset($this->request->post['date_departure']) ) {
      		$this->error['date_departure'] = $this->language->get('error_date_departure');
    	}

    	if (strlen($this->request->post['time_departure']) < 5 || !isset($this->request->post['time_departure']) ) {
      		$this->error['time_departure'] = $this->language->get('error_time_departure');
    	}

    	if (strlen($this->request->post['date_arrival']) < 10 || !isset($this->request->post['date_arrival']) ) {
      		$this->error['date_arrival'] = $this->language->get('error_date_arrival');
    	}

    	if (strlen($this->request->post['time_arrival']) < 5 || !isset($this->request->post['time_arrival']) ) {
      		$this->error['time_arrival'] = $this->language->get('error_time_arrival');
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
    	if (!$this->user->hasPermission('modify', 'cruise/cruise')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'cruise/cruise')) {
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