<?php
/**
 * ZAltSeats class controller for BareBoneMVC.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisZAltSeats extends Controller { 
	private $error = array();

	public function index() {
		$this->load->language('vis/zaltseats');

		$this->document->setTitle($this->language->get('heading_title'));
		 
		$this->load->model('vis/zaltseats');

		$this->getList();
	}

	public function insert() {
		$this->load->language('vis/zaltseats');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/zaltseats');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_zaltseats->addAltSeat($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_airline_code'])) {
				$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
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
			
			$this->redirect($this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('vis/zaltseats');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/zaltseats');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_zaltseats->editAltSeat($this->request->get['v_a_s_r_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_airline_code'])) {
				$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
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
			
			$this->redirect($this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
 
	public function delete() {
		$this->load->language('vis/zaltseats');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/zaltseats');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $v_a_s_r_id) {
				$this->model_vis_zaltseats->deleteAltSeat($v_a_s_r_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['filter_airline_code'])) {
				$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
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
			
			$this->redirect($this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

  	public function copy() {
    	$this->load->language('vis/zaltseats');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/zaltseats');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $v_a_s_r_id) {
				$this->model_vis_zaltseats->copyAltSeat($v_a_s_r_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_airline_code'])) {
				$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
			}
			
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
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
			
			$this->redirect($this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
	private function getList() {
		if (isset($this->request->get['filter_airline_code'])) {
			$filter_airline_code = $this->request->get['filter_airline_code'];
		} else {
			$filter_airline_code = null;
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'vac.airline_code';
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
			
		if (isset($this->request->get['filter_airline_code'])) {
			$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
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
			'href'      => $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
							
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = $this->url->link('vis/zaltseats/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('vis/zaltseats/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('vis/zaltseats/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$data = array(
			'filter_airline_code' => $filter_airline_code,
			'filter_name' => $filter_name,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$altseats_total = $this->model_vis_zaltseats->getTotalAltSeats();
	
		$results = $this->model_vis_zaltseats->getAllAltSeats($data);

		$this->data['altseats'] = array();

    	foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('vis/zaltseats/update', 'token=' . $this->session->data['token'] . '&v_a_s_r_id=' . $result['v_a_s_r_id'] . $url, 'SSL')
			);
						
			$this->data['altseats'][] = array(
				'v_a_s_r_id' 			=> $result['v_a_s_r_id'],
				'airline_code'      => $result['airline_code'],
				'name' 				=> $result['name'],
				'description'       => $result['description'],
				'selected'       => isset($this->request->post['selected']) && in_array($result['v_a_s_r_id'], $this->request->post['selected']),
				'action'         => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_airline_code'] = $this->language->get('column_airline_code');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_copy'] = $this->language->get('button_copy');
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
			
		if (isset($this->request->get['filter_airline_code'])) {
			$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_airline_code'] = $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . '&sort=vac.airline_code' . $url, 'SSL');
		$this->data['sort_name'] = $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . '&sort=va.name' . $url, 'SSL');
		
		$url = '';
			
		if (isset($this->request->get['filter_airline_code'])) {
			$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $altseats_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		
		$this->data['pagination'] = $pagination->render();

		$this->data['filter_airline_code'] = $filter_airline_code;
		$this->data['filter_name'] = $filter_name;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'vis/zaltseats_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_airline_code'] = $this->language->get('entry_airline_code');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
    	
		$this->data['tab_general'] = $this->language->get('tab_general');
		
		$this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['airline_code'])) {
			$this->data['error_airline_code'] = $this->error['airline_code'];
		} else {
			$this->data['error_airline_code'] = '';
		}

 		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = '';
		}
		
		$url = '';
			
		if (isset($this->request->get['filter_airline_code'])) {
			$url .= '&filter_airline_code=' . $this->request->get['filter_airline_code'];
		}
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
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
			'href'      => $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		if (!isset($this->request->get['v_a_s_r_id'])) {
			$this->data['action'] = $this->url->link('vis/zaltseats/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('vis/zaltseats/update', 'token=' . $this->session->data['token'] . '&v_a_s_r_id=' . $this->request->get['v_a_s_r_id'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('vis/zaltseats', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['v_a_s_r_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$altclass_info = $this->model_vis_zaltseats->getAltSeatById($this->request->get['v_a_s_r_id']);
		}
		
		if (isset($this->request->post['airline_code'])) {
			$this->data['airline_code'] = $this->request->post['airline_code'];
		} elseif (!empty($altclass_info)) {
			$this->data['airline_code'] = $altclass_info['airline_code'];
		} else {
			$this->data['airline_code'] = '';
		}
		
		if (isset($this->request->post['description'])) {
			$this->data['description'] = $this->request->post['description'];
		} elseif (!empty($altclass_info)) {
			$this->data['description'] = $altclass_info['description'];
		} else {
			$this->data['description'] = '';
		}
		
		$this->template = 'vis/zaltseats_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'vis/zaltseats')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (strlen($this->request->post['airline_code']) != 2) {
			$this->error['airline_code'] = $this->language->get('error_airline_code');
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

	private function validateCopy() {
		if (!$this->user->hasPermission('modify', 'vis/zaltseats')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'vis/zaltseats')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function autocomplete() {
		$json = array();
		
		$this->load->model('vis/zaltseats');
		
		if ($this->request->get['filter_airline_code']) {
			$filter_airline_code = $this->request->get['filter_airline_code'];
		} else {
			$filter_airline_code = '';
		}
					
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		$filter_data = array(
			'filter_airline_code' => $filter_airline_code,
			'filter_name'        => $filter_name
		);
		
		$results = $this->model_vis_zaltseats->getAirlines($filter_data);
		
		foreach ($results as $result) {
			$json[] = array(
				'code' => $result['code'],
				'name' => $result['name'] 	
			);	
		}

		$this->response->setOutput(json_encode($json));
	}	
} // end class
?>