<?php
/**
 * ARoutes class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisARoutes extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('vis/aroutes');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/aroutes');
		
		$this->getList();
  	}
  
  	public function insert() {
    	$this->load->language('vis/aroutes');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/aroutes');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_aroutes->addRoute($this->request->post);
	  		
			$this->session->data['success'] = $this->language->get('text_success');
	  
			$url = '';
			
			if (isset($this->request->get['filter_departure'])) {
				$url .= '&filter_departure=' . $this->request->get['filter_departure'];
			}
		
			if (isset($this->request->get['filter_destination'])) {
				$url .= '&filter_destination=' . $this->request->get['filter_destination'];
			}
			
			if (isset($this->request->get['filter_carrier'])) {
				$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
			}
			
			if (isset($this->request->get['filter_klasse'])) {
				$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
			}
		
			if (isset($this->request->get['filter_doorvlucht'])) {
				$url .= '&filter_doorvlucht=' . $this->request->get['filter_doorvlucht'];
			}
					
			if (isset($this->request->get['filter_sell'])) {
				$url .= '&filter_sell=' . $this->request->get['filter_sell'];
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
			
			$this->redirect($this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('vis/aroutes');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/aroutes');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_aroutes->editRoute($this->request->get['route_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_departure'])) {
				$url .= '&filter_departure=' . $this->request->get['filter_departure'];
			}
		
			if (isset($this->request->get['filter_destination'])) {
				$url .= '&filter_destination=' . $this->request->get['filter_destination'];
			}
			
			if (isset($this->request->get['filter_carrier'])) {
				$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
			}
			
			if (isset($this->request->get['filter_klasse'])) {
				$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
			}	
		
			if (isset($this->request->get['filter_doorvlucht'])) {
				$url .= '&filter_doorvlucht=' . $this->request->get['filter_doorvlucht'];
			}
					
			if (isset($this->request->get['filter_sell'])) {
				$url .= '&filter_sell=' . $this->request->get['filter_sell'];
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
			
			$this->redirect($this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('vis/aroutes');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/aroutes');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $route_id) {
				$this->model_vis_aroutes->deleteRoute($route_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_departure'])) {
				$url .= '&filter_departure=' . $this->request->get['filter_departure'];
			}
		
			if (isset($this->request->get['filter_destination'])) {
				$url .= '&filter_destination=' . $this->request->get['filter_destination'];
			}
			
			if (isset($this->request->get['filter_carrier'])) {
				$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
			}
			
			if (isset($this->request->get['filter_klasse'])) {
				$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
			}	
		
			if (isset($this->request->get['filter_doorvlucht'])) {
				$url .= '&filter_doorvlucht=' . $this->request->get['filter_doorvlucht'];
			}
					
			if (isset($this->request->get['filter_sell'])) {
				$url .= '&filter_sell=' . $this->request->get['filter_sell'];
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
			
			$this->redirect($this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('vis/aroutes');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/aroutes');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			$cnt = 1;
			foreach ($this->request->post['selected'] as $route_id) {
				$this->model_vis_aroutes->copyRoute($route_id, $cnt);
				$cnt++;
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_departure'])) {
				$url .= '&filter_departure=' . $this->request->get['filter_departure'];
			}
		
			if (isset($this->request->get['filter_destination'])) {
				$url .= '&filter_destination=' . $this->request->get['filter_destination'];
			}
			
			if (isset($this->request->get['filter_carrier'])) {
				$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
			}
			
			if (isset($this->request->get['filter_klasse'])) {
				$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
			}	
		
			if (isset($this->request->get['filter_doorvlucht'])) {
				$url .= '&filter_doorvlucht=' . $this->request->get['filter_doorvlucht'];
			}
					
			if (isset($this->request->get['filter_sell'])) {
				$url .= '&filter_sell=' . $this->request->get['filter_sell'];
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
			
			$this->redirect($this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {				
		if (isset($this->request->get['filter_departure'])) {
			$filter_departure = $this->request->get['filter_departure'];
		} else {
			$filter_departure = null;
		}

		if (isset($this->request->get['filter_destination'])) {
			$filter_destination = $this->request->get['filter_destination'];
		} else {
			$filter_destination = null;
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$filter_carrier = $this->request->get['filter_carrier'];
		} else {
			$filter_carrier = null;
		}

		if (isset($this->request->get['filter_klasse'])) {
			$filter_klasse = $this->request->get['filter_klasse'];
		} else {
			$filter_klasse = null;
		}

		if (isset($this->request->get['filter_via'])) {
			$filter_via = $this->request->get['filter_via'];
		} else {
			$filter_via = null;
		}

		if (isset($this->request->get['filter_doorvlucht'])) {
			$filter_doorvlucht = (int)$this->request->get['filter_doorvlucht'];
		} else {
			$filter_doorvlucht = null;
		}

		if (isset($this->request->get['filter_sell'])) {
			$filter_sell = (int)$this->request->get['filter_sell'];
		} else {
			$filter_sell = 1;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'VERTREK,BESTEMMING';
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
						
		if (isset($this->request->get['filter_departure'])) {
			$url .= '&filter_departure=' . $this->request->get['filter_departure'];
		}
		
		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_klasse'])) {
			$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
		}		
		
		if (isset($this->request->get['filter_via'])) {
			$url .= '&filter_via=' . $this->request->get['filter_via'];
		}		

		if (isset($this->request->get['filter_doorvlucht'])) {
			$url .= '&filter_doorvlucht=' . (int)$this->request->get['filter_doorvlucht'];
		}
						
		if (isset($this->request->get['filter_sell'])) {
			$url .= '&filter_sell=' . (int)$this->request->get['filter_sell'];
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
			'href'      => $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('vis/aroutes/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('vis/aroutes/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('vis/aroutes/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['routes'] = array();

		$data = array(
			'filter_departure'	  => $filter_departure, 
			'filter_destination'	=> $filter_destination,
			'filter_carrier'	  => $filter_carrier,
			'filter_klasse' 	=> $filter_klasse,
			'filter_via' 		=> $filter_via,
			'filter_doorvlucht'   => $filter_doorvlucht,
			'filter_sell'   => $filter_sell,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$routes_total = $this->model_vis_aroutes->getTotalRoutes($data);
			
		$results = $this->model_vis_aroutes->getRoutes($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('vis/aroutes/update', 'token=' . $this->session->data['token'] . '&route_id=' . $result['ID'] . $url, 'SSL')
			);
			
			$price_check = ($this->model_vis_aroutes->checkPrices($result['ID'])) ? 1 : 0;
				
      		$this->data['routes'][] = array(
				'route_id' 		=> $result['ID'],
				'departure'      => $result['VERTREK'],
				'destination'    => $result['BESTEMMING'],
				'carrier'        => $result['CARRIER'],
				'klasse'        => $result['KLASSE'],
				'via'			=> $result['via'],
				'ma'			=> $result['ma'],
				'di'			=> $result['di'],
				'wo'			=> $result['wo'],
				'do'			=> $result['do'],
				'vr'			=> $result['vr'],
				'za'			=> $result['za'],
				'zo'			=> $result['zo'],
				'ma_b'			=> $result['ma_b'],
				'di_b'			=> $result['di_b'],
				'wo_b'			=> $result['wo_b'],
				'do_b'			=> $result['do_b'],
				'vr_b'			=> $result['vr_b'],
				'za_b'			=> $result['za_b'],
				'zo_b'			=> $result['zo_b'],
				'basis' 		=> ($result['BASIS'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'combin' 		=> ($result['COMBIN'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'tourbox' 		=> $result['Tourcode_box'],
				'min_stay' 		=> $result['MIN'],
				'max_stay' 		=> $result['MAX'],
				'kind_discount' => $result['KIND'],
				'baby_discount' => $result['BABY'],
				'is_doorvlucht' => ($result['is_doorvlucht'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'doorvlucht_van'=> $result['doorvlucht_van'],
				'one_tax' 		=> $result['one_tax'],
				'main_segment' 	=> $result['main_segment'],
				'open_jaw' 		=> $result['open_jaw'],
				'bagage' 		=> $result['bagage'],
				'stopovers' 	=> $result['stopovers'],
				'wijzigen' 		=> $result['wijzigen'],
				'refunds_cancel'=> $result['refunds_cancel'],
				'reserve_ticket'=> $result['reserve_ticket'],
				'overige_voorw' => $result['overige_voorw'],
				'show_periods_from' => $result['show_periods_from'],
				'show_periods_to' 	=> $result['show_periods_to'],
				'category' 		=> $result['category'],
				'sell'     => ($result['sell'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'selected'   => isset($this->request->post['selected']) && in_array($result['ID'], $this->request->post['selected']),
				'price_check' => $price_check,
				'prices'		=> $this->url->link('vis/prices', 'token=' . $this->session->data['token'] . '&filter_flight=' . $result['ID'] . '&filter_departure_start=' . $this->session->data['aDates'][$_COOKIE['season']]['season_date_start'] . '&filter_departure_end=' . $this->session->data['aDates'][$_COOKIE['season']]['season_date_end'], 'SSL'),
				'action'     => $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');		
			
		$this->data['column_departure'] = $this->language->get('column_departure');		
		$this->data['column_destination'] = $this->language->get('column_destination');	
		$this->data['column_carrier'] = $this->language->get('column_carrier');	
		$this->data['column_klasse'] = $this->language->get('column_klasse');
		$this->data['column_via'] = $this->language->get('column_via');
		$this->data['column_days'] = $this->language->get('column_days');
		$this->data['column_basis'] = $this->language->get('column_basis');
		$this->data['column_combin'] = $this->language->get('column_combin');
		$this->data['column_tourbox'] = $this->language->get('column_tourbox');
		$this->data['column_minstay'] = $this->language->get('column_minstay');
		$this->data['column_maxstay'] = $this->language->get('column_maxstay');
		$this->data['column_discount'] = $this->language->get('column_discount');
		$this->data['column_doorvlucht'] = $this->language->get('column_doorvlucht');
		$this->data['column_doorvlucht_van'] = $this->language->get('column_doorvlucht_van');

		$this->data['column_sell'] = $this->language->get('column_sell');		
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

		if (isset($this->request->get['filter_departure'])) {
			$url .= '&filter_departure=' . $this->request->get['filter_departure'];
		}
		
		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_klasse'])) {
			$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
		}
		
		if (isset($this->request->get['filter_via'])) {
			$url .= '&filter_via=' . $this->request->get['filter_via'];
		}
		
		if (isset($this->request->get['filter_doorvlucht'])) {
			$url .= '&filter_doorvlucht=' . $this->request->get['filter_doorvlucht'];
		}
								
		if (isset($this->request->get['filter_sell'])) {
			$url .= '&filter_sell=' . $this->request->get['filter_sell'];
		}
								
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_departure'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=VERTREK' . $url, 'SSL');
		$this->data['sort_destination'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=BESTEMMING' . $url, 'SSL');
		$this->data['sort_carrier'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=CARRIER' . $url, 'SSL');
		$this->data['sort_klasse'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=KLASSE' . $url, 'SSL');
		$this->data['sort_doorvlucht'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=is_doorvlucht' . $url, 'SSL');
		$this->data['sort_sell'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=sell' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_departure'])) {
			$url .= '&filter_departure=' . $this->request->get['filter_departure'];
		}
		
		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_klasse'])) {
			$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
		}
		
		if (isset($this->request->get['filter_via'])) {
			$url .= '&filter_via=' . $this->request->get['filter_via'];
		}

		if (isset($this->request->get['filter_doorvlucht'])) {
			$url .= '&filter_doorvlucht=' . $this->request->get['filter_doorvlucht'];
		}

		if (isset($this->request->get['filter_sell'])) {
			$url .= '&filter_sell=' . $this->request->get['filter_sell'];
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
		$pagination->url = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . str_replace('#', '%23', $url) . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_departure'] = $filter_departure;
		$this->data['filter_destination'] = $filter_destination;
		$this->data['filter_carrier'] = $filter_carrier;
		$this->data['filter_klasse'] = $filter_klasse;
		$this->data['filter_via'] = $filter_via;
		$this->data['filter_doorvlucht'] = $filter_doorvlucht;
		$this->data['filter_sell'] = $filter_sell;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'vis/aroutes_list.tpl';
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

		$this->data['entry_departure'] = $this->language->get('entry_departure');
		$this->data['entry_destination'] = $this->language->get('entry_destination');
		$this->data['entry_carrier'] = $this->language->get('entry_carrier');
		$this->data['entry_klasse'] = $this->language->get('entry_klasse');
		$this->data['entry_via'] = $this->language->get('entry_via');
		$this->data['entry_days_to'] = $this->language->get('entry_days_to');
		$this->data['entry_days_back'] = $this->language->get('entry_days_back');
		$this->data['entry_combin'] = $this->language->get('entry_combin');
		$this->data['entry_sell'] = $this->language->get('entry_sell');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_tarief_type'] = $this->language->get('entry_tarief_type');
		$this->data['entry_tourbox'] = $this->language->get('entry_tourbox');
		$this->data['entry_min_stay'] = $this->language->get('entry_min_stay');
		$this->data['entry_max_stay'] = $this->language->get('entry_max_stay');
		$this->data['entry_discount'] = $this->language->get('entry_discount');
		$this->data['entry_kind'] = $this->language->get('entry_kind');
		$this->data['entry_baby'] = $this->language->get('entry_baby');
		$this->data['entry_is_doorvlucht'] = $this->language->get('entry_is_doorvlucht');
		$this->data['entry_doorvlucht_van'] = $this->language->get('entry_doorvlucht_van');
		
		$this->data['entry_one_tax'] = $this->language->get('entry_one_tax');
		$this->data['entry_main_segment'] = $this->language->get('entry_main_segment');
		$this->data['entry_open_jaw'] = $this->language->get('entry_open_jaw');
		$this->data['entry_bagage'] = $this->language->get('entry_bagage');
		$this->data['entry_stopovers'] = $this->language->get('entry_stopovers');
		$this->data['entry_wijzigen'] = $this->language->get('entry_wijzigen');
		$this->data['entry_refunds'] = $this->language->get('entry_refunds');
		$this->data['entry_reserve'] = $this->language->get('entry_reserve');
		$this->data['entry_overige'] = $this->language->get('entry_overige');
		
				
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['routeid'])) {
			$this->data['error_routeid'] = $this->error['routeid'];
		} else {
			$this->data['error_routeid'] = '';
		}

 		if (isset($this->error['departure'])) {
			$this->data['error_departure'] = $this->error['departure'];
		} else {
			$this->data['error_departure'] = '';
		}

 		if (isset($this->error['destination'])) {
			$this->data['error_destination'] = $this->error['destination'];
		} else {
			$this->data['error_destination'] = '';
		}

 		if (isset($this->error['carrier'])) {
			$this->data['error_carrier'] = $this->error['carrier'];
		} else {
			$this->data['error_carrier'] = '';
		}

 		if (isset($this->error['klasse'])) {
			$this->data['error_klasse'] = $this->error['klasse'];
		} else {
			$this->data['error_klasse'] = '';
		}

 		if (isset($this->error['kind'])) {
			$this->data['error_kind'] = $this->error['kind'];
		} else {
			$this->data['error_kind'] = '';
		}

 		if (isset($this->error['baby'])) {
			$this->data['error_baby'] = $this->error['baby'];
		} else {
			$this->data['error_baby'] = '';
		}


		$url = '';

		if (isset($this->request->get['filter_departure'])) {
			$url .= '&filter_departure=' . $this->request->get['filter_departure'];
		}
		
		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_klasse'])) {
			$url .= '&filter_klasse=' . $this->request->get['filter_klasse'];
		}	
		
		if (isset($this->request->get['filter_via'])) {
			$url .= '&filter_via=' . $this->request->get['filter_via'];
		}	
		
		if (isset($this->request->get['filter_sell'])) {
			$url .= '&filter_sell=' . $this->request->get['filter_sell'];
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
			'href'      => $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['route_id'])) {
			$this->data['action'] = $this->url->link('vis/aroutes/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('vis/aroutes/update', 'token=' . $this->session->data['token'] . '&route_id=' . $this->request->get['route_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('vis/aroutes', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['route_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$route_info = $this->model_vis_aroutes->getRoute($this->request->get['route_id']);
    	}
		
		if (isset($this->request->post['departure'])) {
      		$this->data['departure'] = $this->request->post['departure'];
    	} elseif (!empty($route_info)) {
			$this->data['departure'] = $route_info['VERTREK'];
		} else {
      		$this->data['departure'] = '';
    	}

		if (isset($this->request->post['destination'])) {
      		$this->data['destination'] = $this->request->post['destination'];
    	} elseif (!empty($route_info)) {
			$this->data['destination'] = $route_info['BESTEMMING'];
		} else {
      		$this->data['destination'] = '';
    	}
		
		if (isset($this->request->post['carrier'])) {
      		$this->data['carrier'] = $this->request->post['carrier'];
    	} elseif (!empty($route_info)) {
			$this->data['carrier'] = $route_info['CARRIER'];
		} else {
      		$this->data['carrier'] = '';
    	}
				
		if (isset($this->request->post['klasse'])) {
      		$this->data['klasse'] = $this->request->post['klasse'];
    	} elseif (!empty($route_info)) {
			$this->data['klasse'] = $route_info['KLASSE'];
		} else {
      		$this->data['klasse'] = '';
    	}
				
		if (isset($this->request->post['via'])) {
      		$this->data['via'] = $this->request->post['via'];
    	} elseif (!empty($route_info)) {
			$this->data['via'] = $route_info['via'];
		} else {
      		$this->data['via'] = '';
    	}
				
		if (isset($this->request->post['ma'])) {
      		$this->data['ma'] = $this->request->post['ma'];
    	} elseif (!empty($route_info)) {
			$this->data['ma'] = $route_info['ma'];
		} else {
      		$this->data['ma'] = 1;
    	}
				
		if (isset($this->request->post['di'])) {
      		$this->data['di'] = $this->request->post['di'];
    	} elseif (!empty($route_info)) {
			$this->data['di'] = $route_info['di'];
		} else {
      		$this->data['di'] = 1;
    	}
				
		if (isset($this->request->post['wo'])) {
      		$this->data['wo'] = $this->request->post['wo'];
    	} elseif (!empty($route_info)) {
			$this->data['wo'] = $route_info['wo'];
		} else {
      		$this->data['wo'] = 1;
    	}
				
		if (isset($this->request->post['do'])) {
      		$this->data['do'] = $this->request->post['do'];
    	} elseif (!empty($route_info)) {
			$this->data['do'] = $route_info['do'];
		} else {
      		$this->data['do'] = 1;
    	}
				
		if (isset($this->request->post['vr'])) {
      		$this->data['vr'] = $this->request->post['vr'];
    	} elseif (!empty($route_info)) {
			$this->data['vr'] = $route_info['vr'];
		} else {
      		$this->data['vr'] = 1;
    	}
				
		if (isset($this->request->post['za'])) {
      		$this->data['za'] = $this->request->post['za'];
    	} elseif (!empty($route_info)) {
			$this->data['za'] = $route_info['za'];
		} else {
      		$this->data['za'] = 1;
    	}
				
		if (isset($this->request->post['zo'])) {
      		$this->data['zo'] = $this->request->post['zo'];
    	} elseif (!empty($route_info)) {
			$this->data['zo'] = $route_info['zo'];
		} else {
      		$this->data['zo'] = 1;
    	}
				
		if (isset($this->request->post['ma_b'])) {
      		$this->data['ma_b'] = $this->request->post['ma_b'];
    	} elseif (!empty($route_info)) {
			$this->data['ma_b'] = $route_info['ma_b'];
		} else {
      		$this->data['ma_b'] = 1;
    	}
				
		if (isset($this->request->post['di_b'])) {
      		$this->data['di_b'] = $this->request->post['di_b'];
    	} elseif (!empty($route_info)) {
			$this->data['di_b'] = $route_info['di_b'];
		} else {
      		$this->data['di_b'] = 1;
    	}
				
		if (isset($this->request->post['wo_b'])) {
      		$this->data['wo_b'] = $this->request->post['wo_b'];
    	} elseif (!empty($route_info)) {
			$this->data['wo_b'] = $route_info['wo_b'];
		} else {
      		$this->data['wo_b'] = 1;
    	}
				
		if (isset($this->request->post['do_b'])) {
      		$this->data['do_b'] = $this->request->post['do_b'];
    	} elseif (!empty($route_info)) {
			$this->data['do_b'] = $route_info['do_b'];
		} else {
      		$this->data['do_b'] = 1;
    	}
				
		if (isset($this->request->post['vr_b'])) {
      		$this->data['vr_b'] = $this->request->post['vr_b'];
    	} elseif (!empty($route_info)) {
			$this->data['vr_b'] = $route_info['vr_b'];
		} else {
      		$this->data['vr_b'] = 1;
    	}
				
		if (isset($this->request->post['za_b'])) {
      		$this->data['za_b'] = $this->request->post['za_b'];
    	} elseif (!empty($route_info)) {
			$this->data['za_b'] = $route_info['za_b'];
		} else {
      		$this->data['za_b'] = 1;
    	}
				
		if (isset($this->request->post['zo_b'])) {
      		$this->data['zo_b'] = $this->request->post['zo_b'];
    	} elseif (!empty($route_info)) {
			$this->data['zo_b'] = $route_info['zo_b'];
		} else {
      		$this->data['zo_b'] = 1;
    	}
				
		if (isset($this->request->post['combin'])) {
      		$this->data['combin'] = $this->request->post['combin'];
    	} elseif (!empty($route_info)) {
			$this->data['combin'] = $route_info['COMBIN'];
		} else {
      		$this->data['combin'] = 1;
    	}
				
		if (isset($this->request->post['sell'])) {
      		$this->data['sell'] = $this->request->post['sell'];
    	} elseif (!empty($route_info)) {
			$this->data['sell'] = $route_info['sell'];
		} else {
      		$this->data['sell'] = 1;
    	}
				
		if (isset($this->request->post['category'])) {
      		$this->data['category'] = $this->request->post['category'];
    	} elseif (!empty($route_info)) {
			$this->data['category'] = $route_info['category'];
		} else {
      		$this->data['category'] = 'Economy';
    	}
				
		if (isset($this->request->post['tourbox'])) {
      		$this->data['tourbox'] = $this->request->post['tourbox'];
    	} elseif (!empty($route_info)) {
			$this->data['tourbox'] = $route_info['Tourcode_box'];
		} else {
      		$this->data['tourbox'] = '';
    	}
				
		if (isset($this->request->post['min_stay'])) {
      		$this->data['min_stay'] = $this->request->post['min_stay'];
    	} elseif (!empty($route_info)) {
			$this->data['min_stay'] = $route_info['MIN'];
		} else {
      		$this->data['min_stay'] = '';
    	}
				
		if (isset($this->request->post['max_stay'])) {
      		$this->data['max_stay'] = $this->request->post['max_stay'];
    	} elseif (!empty($route_info)) {
			$this->data['max_stay'] = $route_info['MAX'];
		} else {
      		$this->data['max_stay'] = '';
    	}
		
		// get values for dropdown
		$this->data['discount_kind'] = $this->model_vis_aroutes->getDiscountKind();
		
		if (isset($this->request->post['kind'])) {
      		$this->data['kind'] = $this->request->post['kind'];
    	} elseif (!empty($route_info)) {
			$this->data['kind'] = $route_info['KIND'];
		} else {
      		$this->data['kind'] = '';
    	}
		
		// get values for dropdown
		$this->data['discount_baby'] = $this->model_vis_aroutes->getDiscountBaby();
		
		if (isset($this->request->post['baby'])) {
      		$this->data['baby'] = $this->request->post['baby'];
    	} elseif (!empty($route_info)) {
			$this->data['baby'] = $route_info['BABY'];
		} else {
      		$this->data['baby'] = '';
    	}
				
		if (isset($this->request->post['doorvlucht'])) {
      		$this->data['doorvlucht'] = $this->request->post['doorvlucht'];
    	} elseif (!empty($route_info)) {
			$this->data['doorvlucht'] = $route_info['is_doorvlucht'];
		} else {
      		$this->data['doorvlucht'] = '';
    	}
				
		if (isset($this->request->post['doorvlucht_van'])) {
      		$this->data['doorvlucht_van'] = $this->request->post['doorvlucht_van'];
    	} elseif (!empty($route_info)) {
			$this->data['doorvlucht_van'] = $route_info['doorvlucht_van'];
		} else {
      		$this->data['doorvlucht_van'] = '';
    	}
				
		if (isset($this->request->post['one_tax'])) {
      		$this->data['one_tax'] = $this->request->post['one_tax'];
    	} elseif (!empty($route_info)) {
			$this->data['one_tax'] = $route_info['one_tax'];
		} else {
      		$this->data['one_tax'] = '';
    	}
				
		if (isset($this->request->post['main_segment'])) {
      		$this->data['main_segment'] = $this->request->post['main_segment'];
    	} elseif (!empty($route_info)) {
			$this->data['main_segment'] = $route_info['main_segment'];
		} else {
      		$this->data['main_segment'] = '';
    	}
				
		if (isset($this->request->post['open_jaw'])) {
      		$this->data['open_jaw'] = $this->request->post['open_jaw'];
    	} elseif (!empty($route_info)) {
			$this->data['open_jaw'] = $route_info['open_jaw'];
		} else {
      		$this->data['open_jaw'] = 1;
    	}
				
		if (isset($this->request->post['bagage'])) {
      		$this->data['bagage'] = $this->request->post['bagage'];
    	} elseif (!empty($route_info)) {
			$this->data['bagage'] = $route_info['bagage'];
		} else {
      		$this->data['bagage'] = '';
    	}
				
		if (isset($this->request->post['stopovers'])) {
      		$this->data['stopovers'] = $this->request->post['stopovers'];
    	} elseif (!empty($route_info)) {
			$this->data['stopovers'] = $route_info['stopovers'];
		} else {
      		$this->data['stopovers'] = '';
    	}
				
		if (isset($this->request->post['wijzigen'])) {
      		$this->data['wijzigen'] = $this->request->post['wijzigen'];
    	} elseif (!empty($route_info)) {
			$this->data['wijzigen'] = $route_info['wijzigen'];
		} else {
      		$this->data['wijzigen'] = '';
    	}
				
		if (isset($this->request->post['refunds'])) {
      		$this->data['refunds'] = $this->request->post['refunds'];
    	} elseif (!empty($route_info)) {
			$this->data['refunds'] = $route_info['refunds_cancel'];
		} else {
      		$this->data['refunds'] = '';
    	}
												
		$this->template = 'vis/aroutes_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function savevia(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->saveViaValueById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['val']);

		if(TRUE===$result){
			$output = '<span style="color: darkgreen;">Saved</span>';
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}		
		$this->response->setOutput($output);
	}
	
	public function saveklasse(){
		$this->load->model('vis/aroutes');
		$f_id = htmlspecialchars_decode($this->request->get['f_id']);
		$val = $this->request->get['val'];
		$new_id = substr($f_id, 0, -1).$val;
		if($this->checkRouteId($new_id)){
			$output = '<span style="color: red;">Klasse bestaat reeds!</span>';
		}else{
			$result = $this->model_vis_aroutes->saveKlasseValueById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['val']);
			if(TRUE===$result){
				$output = '<span style="color: darkgreen;">Saved</span>';
			}else{
				$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
			}		
		}
		
		$this->response->setOutput($output);
	}
	
	public function saveminstay(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->saveMinStayValueById(htmlspecialchars_decode($this->request->get['f_id']), htmlspecialchars_decode($this->request->get['val']));

		if(TRUE===$result){
			$output = '<span style="color: darkgreen;">Saved</span>';
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}		
		$this->response->setOutput($output);
	}
	
	public function savemaxstay(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->saveMaxStayValueById(htmlspecialchars_decode($this->request->get['f_id']), htmlspecialchars_decode($this->request->get['val']));

		if(TRUE===$result){
			$output = '<span style="color: darkgreen;">Saved</span>';
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}		
		$this->response->setOutput($output);
	}
	
	public function swdoorvlucht(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->switchDoorvluchtById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['val']);
		
		if(TRUE===$result){
			if($this->request->get['val']=='on'){
				$output = '<img src="view/image/accept.png" onClick="javascript:switchDoorvluchtValue(\''.$this->request->get['f_id'].'\',\'off\');" />';
			}else{
				$output = '<img src="view/image/delete.png" onClick="javascript:switchDoorvluchtValue(\''.$this->request->get['f_id'].'\',\'on\');" />';
			}
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}
		$this->response->setOutput($output);
	}
	
	public function savedoorvluchtvan(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->saveDoorvluchtVanValueById(htmlspecialchars_decode($this->request->get['f_id']), htmlspecialchars_decode($this->request->get['val']));

		if(TRUE===$result){
			$output = '<span style="color: darkgreen;">Saved</span>';
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}		
		$this->response->setOutput($output);
	}
	
	public function swtripday(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->switchTripDayById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['day'], $this->request->get['val']);
		
		if(TRUE===$result){
			if($this->request->get['val']=='on'){
				$output = '<img src="view/image/accept.png" onClick="javascript:switchTripDay(\''.$this->request->get['f_id'].'\',\''.$this->request->get['day'].'\',\'off\');" />';
			}else{
				$output = '<img src="view/image/delete.png" onClick="javascript:switchTripDay(\''.$this->request->get['f_id'].'\',\''.$this->request->get['day'].'\',\'on\');" />';
			}
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}
		$this->response->setOutput($output);
	}
	
	public function swbasis(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->switchBasisById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['val']);
		
		if(TRUE===$result){
			if($this->request->get['val']=='on'){
				$output = '<img src="view/image/accept.png" onClick="javascript:switchBasisValue(\''.$this->request->get['f_id'].'\',\'off\');" />';
			}else{
				$output = '<img src="view/image/delete.png" onClick="javascript:switchBasisValue(\''.$this->request->get['f_id'].'\',\'on\');" />';
			}
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}
		$this->response->setOutput($output);
	}
	
	public function swcombin(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->switchCombinById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['val']);
		
		if(TRUE===$result){
			if($this->request->get['val']=='on'){
				$output = '<img src="view/image/accept.png" onClick="javascript:switchCombinValue(\''.$this->request->get['f_id'].'\',\'off\');" />';
			}else{
				$output = '<img src="view/image/delete.png" onClick="javascript:switchCombinValue(\''.$this->request->get['f_id'].'\',\'on\');" />';
			}
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}
		$this->response->setOutput($output);
	}
	
	public function savetourbox(){
		$this->load->model('vis/aroutes');

		$result = $this->model_vis_aroutes->saveTourBoxValueById(htmlspecialchars_decode($this->request->get['f_id']), $this->request->get['val']);

		if(TRUE===$result){
			$output = '<span style="color: darkgreen;">Saved</span>';
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}		
		$this->response->setOutput($output);
	}
	
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'vis/aroutes')) {
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
		
		if($this->checkRouteId($this->request->post['departure'],$this->request->post['destination'],$this->request->post['carrier'],$this->request->post['klasse'])){
      		$this->error['routeid'] = sprintf($this->language->get('error_routeid'),strtoupper($this->request->post['departure'].$this->request->post['destination'].$this->request->post['carrier'].$this->request->post['klasse']));
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
    	if (!$this->user->hasPermission('modify', 'vis/aroutes')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
  	
  	private function validateCopy() {
    	if (!$this->user->hasPermission('modify', 'vis/aroutes')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	
	private function checkRouteId($departure,$destination,$carrier,$klasse){
		$route_id = strtoupper($departure.$destination.$carrier.$klasse);
		$this->load->model('vis/aroutes');
		if($this->model_vis_aroutes->getRoute($route_id)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}
?>