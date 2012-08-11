<?php
/**
 * Bprices class controller for BareBoneMVC.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisBPrices extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('vis/bprices');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/bprices');
		
		$this->getList();
  	}
  
  	public function insert() {
    	$this->load->language('vis/bprices');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/bprices');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_bprices->addPrice($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_flight'])) {
				$url .= '&filter_flight=' . $this->request->get['filter_flight'];
			}
		
			if (isset($this->request->get['filter_departure_start'])) {
				$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
			}
			
			if (isset($this->request->get['filter_departure_end'])) {
				$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
			
			$this->redirect($this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('vis/bprices');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/bprices');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_bprices->addPrice($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_flight'])) {
				$url .= '&filter_flight=' . $this->request->get['filter_flight'];
			}
	
			if (isset($this->request->get['filter_departure_start'])) {
				$filter_departure_start = $this->request->get['filter_departure_start'];
			} else {
				$filter_departure_start = $this->session->data['aDates'][$_COOKIE['season']]['season_date_start'];
			}
			
			if (isset($this->request->get['filter_departure_end'])) {
				$filter_departure_end = $this->request->get['filter_departure_end'];
			} else {
				$filter_departure_end = $this->session->data['aDates'][$_COOKIE['season']]['season_date_end'];
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
			
			$this->redirect($this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delperiods() {
    	$this->load->language('vis/bprices');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/bprices');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $flight_id) {
				$this->model_vis_bprices->deletePrice($flight_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_flight'])) {
				$url .= '&filter_flight=' . $this->request->get['filter_flight'];
			}
		
			if (isset($this->request->get['filter_departure_start'])) {
				$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
			}
			
			if (isset($this->request->get['filter_departure_end'])) {
				$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
			
			$this->redirect($this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('vis/bprices');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/bprices');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $flight_id) {
				$this->model_vis_bprices->copyPrice($flight_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_flight'])) {
				$url .= '&filter_flight=' . $this->request->get['filter_flight'];
			}
		
			if (isset($this->request->get['filter_departure_start'])) {
				$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
			}
			
			if (isset($this->request->get['filter_departure_end'])) {
				$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
			
			$this->redirect($this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {				
		if (isset($this->request->get['filter_flight'])) {
			$filter_flight = $this->request->get['filter_flight'];
		} else {
			$filter_flight = null;
		}

		if (isset($this->request->get['filter_departure_start'])) {
			$filter_departure_start = $this->request->get['filter_departure_start'];
		} else {
			$filter_departure_start = $this->session->data['aDates'][$_COOKIE['season']]['season_date_start'];
		}
		
		if (isset($this->request->get['filter_departure_end'])) {
			$filter_departure_end = $this->request->get['filter_departure_end'];
		} else {
			$filter_departure_end = '31-12-2099';
		}
		
		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'CAST(price AS DECIMAL)';
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
						
		if (isset($this->request->get['filter_flight'])) {
			$url .= '&filter_flight=' . $this->request->get['filter_flight'];
		}
		
		if (isset($this->request->get['filter_departure_start'])) {
			$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
		}
		
		if (isset($this->request->get['filter_departure_end'])) {
			$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
       		'text'      => $this->language->get('crumbs_vis'),
			'href'      => $this->url->link('vis/bprices', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('vis/bprices/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('vis/bprices/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delperiods'] = $this->url->link('vis/bprices/delperiods', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['routes'] = array();
		
		$filter_depart_start = explode('-', $filter_departure_start);
		$filter_depart_end = explode('-', $filter_departure_end);
		
		$data = array(
			'filter_flight'	  => $filter_flight, 
			'filter_departure_start'	=> date('Y-m-d', gmmktime(0,0,0,$filter_depart_start[1],$filter_depart_start[0],$filter_depart_start[2])),
			'filter_departure_end'	  => date('Y-m-d', gmmktime(0,0,0,$filter_depart_end[1],$filter_depart_end[0],$filter_depart_end[2])),
			'filter_price'	  => $filter_price,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$prices_total = $this->model_vis_bprices->getTotalPrices($data);
			
		$results = $this->model_vis_bprices->getPrices($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('vis/bprices/update', 'token=' . $this->session->data['token'] . '&flight_id=' . $result['f_id'] . $url, 'SSL')
			);
			
			$data['sort'] = 'departure';
			
			$periods_pres = $this->model_vis_bprices->getPeriods($result['f_id'], $data);
			$periods = array();
			foreach($periods_pres as $periode_pre){
				$periods[] = array($periode_pre['departure'] => $periode_pre['price']);
			}
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
			}


      		$this->data['prices'][] = array(
				'flight_id' 	=> $result['f_id'],
				'departures'     => $departures, 
				'action' => $action,
				'selected'   => isset($this->request->post['selected']) && in_array($result['f_id'], $this->request->post['selected'])
			);  //,
				// 'action'     => $action
    	}
		
    	$this->load->language('vis/bprices');

		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_confirm_periods'] = $this->language->get('text_confirm_periods');		
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_untill_and'] = $this->language->get('text_untill_and');		
			
		$this->data['column_flight'] = $this->language->get('column_flight');		
		$this->data['column_departure'] = $this->language->get('column_departure');		
		$this->data['column_price'] = $this->language->get('column_price');	
		$this->data['column_valuta'] = $this->language->get('column_valuta');	

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

		if (isset($this->request->get['filter_flight'])) {
			$url .= '&filter_flight=' . $this->request->get['filter_flight'];
		}
		
		if (isset($this->request->get['filter_departure_start'])) {
			$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
		}
		
		if (isset($this->request->get['filter_departure_end'])) {
			$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
					
		$this->data['sort_flight'] = $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . '&sort=f_id' . $url, 'SSL');
		$this->data['sort_departure'] = $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . '&sort=departure' . $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . '&sort=price' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_flight'])) {
			$url .= '&filter_flight=' . $this->request->get['filter_flight'];
		}
		
		if (isset($this->request->get['filter_departure_start'])) {
			$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
		}
		
		if (isset($this->request->get['filter_departure_end'])) {
			$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
				
		$pagination = new Pagination();
		$pagination->total = $prices_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_flight'] = $filter_flight;
		$this->data['filter_departure_start'] = $filter_departure_start;
		$this->data['filter_departure_end'] = $filter_departure_end;
		$this->data['filter_price'] = $filter_price;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'vis/bprices_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
 
    	$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
    	$this->data['text_none'] = $this->language->get('text_none');
    	$this->data['text_yes'] = $this->language->get('text_yes');
    	$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$this->data['text_plus'] = $this->language->get('text_plus');
		$this->data['text_minus'] = $this->language->get('text_minus');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_option'] = $this->language->get('text_option');
		$this->data['text_option_value'] = $this->language->get('text_option_value');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');
		$this->data['text_untill_and'] = $this->language->get('text_untill_and');

		$this->data['column_flight'] = $this->language->get('column_flight');
		$this->data['column_departure_start'] = $this->language->get('column_departure_start');
		$this->data['column_departure_end'] = $this->language->get('column_departure_end');
		$this->data['column_price'] = $this->language->get('column_price');
		$this->data['column_valuta'] = $this->language->get('column_valuta');
				
		$this->data['entry_flight'] = $this->language->get('entry_flight');
		$this->data['entry_departure'] = $this->language->get('entry_departure');
		$this->data['entry_departure_start'] = $this->language->get('entry_departure_start');
		$this->data['entry_departure_end'] = $this->language->get('entry_departure_end');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_valuta'] = $this->language->get('entry_valuta');
				
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['flight_id'])) {
			$this->data['error_flight_id'] = $this->error['flight_id'];
		} else {
			$this->data['error_flight_id'] = '';
		}

 		if (isset($this->error['departure_start'])) {
			$this->data['error_departure_start'] = $this->error['departure_start'];
		} else {
			$this->data['error_departure_start'] = '';
		}

 		if (isset($this->error['departure_end'])) {
			$this->data['error_departure_end'] = $this->error['departure_end'];
		} else {
			$this->data['error_departure_end'] = '';
		}

 		if (isset($this->error['price'])) {
			$this->data['error_price'] = $this->error['price'];
		} else {
			$this->data['error_price'] = '';
		}

 		if (isset($this->error['valuta'])) {
			$this->data['error_valuta'] = $this->error['valuta'];
		} else {
			$this->data['error_valuta'] = '';
		}


		$url = '';

		if (isset($this->request->get['filter_flight'])) {
			$url .= '&filter_flight=' . $this->request->get['filter_flight'];
		}
		
		if (isset($this->request->get['filter_departure_start'])) {
			$url .= '&filter_departure_start=' . $this->request->get['filter_departure_start'];
		}
		
		if (isset($this->request->get['filter_departure_end'])) {
			$url .= '&filter_departure_end=' . $this->request->get['filter_departure_end'];
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
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['flight_id'])) {
			$this->data['action'] = $this->url->link('vis/bprices/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('vis/bprices/update', 'token=' . $this->session->data['token'] . '&flight_id=' . $this->request->get['flight_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('vis/bprices', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['flight_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$price_info = $this->model_vis_bprices->getPrice($this->request->get['flight_id']);
    	}
		
		if (isset($this->request->post['flight_id'])) {
      		$this->data['flight_id'] = $this->request->post['flight_id'];
    	} elseif (!empty($price_info)) {
			$this->data['flight_id'] = $price_info['f_id'];
		} elseif (isset($this->request->get['filter_flight'])) {
			$this->data['flight_id'] = $this->request->get['filter_flight'];
		} else {
      		$this->data['flight_id'] = '';
    	}
		

		if (isset($this->request->post['departure_start'])) {
      		$this->data['departure_start'] = $this->request->post['departure_start'];
    	//} elseif (!empty($price_info)) {
		//	$this->data['departure_start'] = $price_info['departure'];
		} elseif (isset($this->request->get['departure_start'])) {
      		$this->data['departure_start'] = $this->request->get['departure_start'];
    	} else {
      		$this->data['departure_start'] = '';
    	}
		
		if (isset($this->request->post['departure_end'])) {
      		$this->data['departure_end'] = $this->request->post['departure_end'];
    	//} elseif (!empty($price_info)) {
		//	$this->data['departure_end'] = $price_info['departure'];
		} elseif (isset($this->request->get['departure_end'])) {
      		$this->data['departure_end'] = $this->request->get['departure_end'];
    	} else {
      		$this->data['departure_end'] = '';
    	}

		if (isset($this->request->post['price'])) {
      		$this->data['price'] = $this->request->post['price'];
    	} elseif (isset($this->request->get['price'])) {
      		$this->data['price'] = $this->request->get['price'];
		} else {
      		$this->data['price'] = '';
    	}
				
		if (isset($this->request->post['valuta'])) {
      		$this->data['valuta'] = $this->request->post['valuta'];
    	} else {
      		$this->data['valuta'] = 'EUR';
    	}
				
										
		$this->template = 'vis/bprices_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'vis/bprices')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if (utf8_strlen($this->request->post['flight_id']) != 9 || !isset($this->request->post['flight_id']) ) {
      		$this->error['flight_id'] = $this->language->get('error_flight_id');
    	}

    	if (utf8_strlen($this->request->post['departure_start']) != 10 || !isset($this->request->post['departure_start']) ) {
      		$this->error['departure_start'] = $this->language->get('error_departure_start');
    	}

    	if (utf8_strlen($this->request->post['departure_end']) != 10 || !isset($this->request->post['departure_end']) ) {
      		$this->error['departure_end'] = $this->language->get('error_departure_end');
    	}

    	if (utf8_strlen($this->request->post['price']) < 2 || !isset($this->request->post['price']) ) {
      		$this->error['price'] = $this->language->get('error_price');
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
    	if (!$this->user->hasPermission('modify', 'vis/bprices')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'vis/bprices')) {
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