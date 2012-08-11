<?php
/**
 * LetOp class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisLetOp extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('vis/letop');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/letop');
		
		$this->getList();
  	}
  
  	public function insert() {
    	$this->load->language('vis/letop');

    	$this->document->setTitle($this->language->get('heading_title')); 
		
		$this->load->model('vis/letop');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_letop->addLetOp($this->request->post);
	  		
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
			
			$this->redirect($this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('vis/letop');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/letop');
	
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vis_letop->editLetOp($this->request->post);
			
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
			
			$this->redirect($this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getForm();
  	}

  	public function delete() {
    	$this->load->language('vis/letop');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/letop');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $letop_id) {
				$this->model_vis_letop->deleteLetOp($letop_id);
	  		}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			if (isset($this->request->get['filter_destination'])) {
				$url .= '&filter_destination=' . $this->request->get['filter_destination'];
			}
			
			if (isset($this->request->get['filter_carrier'])) {
				$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
			}
			
			if (isset($this->request->get['filter_season'])) {
				$url .= '&filter_season=' . $this->request->get['filter_season'];
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
			
			$this->redirect($this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}

  	public function copy() {
    	$this->load->language('vis/letop');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('vis/letop');
		
		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			$cnt = 1;
			foreach ($this->request->post['selected'] as $route_id) {
				$this->model_vis_letop->copyLetOp($route_id, $cnt);
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
			
			$this->redirect($this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

    	$this->getList();
  	}
	
  	private function getList() {				
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
		
		if (isset($this->request->get['filter_season'])) {
			$filter_season = $this->request->get['filter_season'];
		} else {
			$filter_season = $_COOKIE['season'];
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'dest';
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
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_season'])) {
			$url .= '&filter_season=' . $this->request->get['filter_season'];
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
			'href'      => $this->url->link('vis/letop', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
		$this->data['insert'] = $this->url->link('vis/letop/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('vis/letop/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('vis/letop/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
    	
		$this->data['letops'] = array();

		$data = array(
			'filter_destination'	=> $filter_destination,
			'filter_carrier'	  => $filter_carrier,
			'filter_season' 	=> $filter_season,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
		
		$letops_total = $this->model_vis_letop->getTotalLetOps($data);
			
		$results = $this->model_vis_letop->getLetOps($data);
				    	
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('vis/letop/update', 'token=' . $this->session->data['token'] . '&dest=' . $result['dest'] . '&carr=' . $result['carrier'] . $url, 'SSL')
			);
				
      		$this->data['letops'][] = array(
				'dest'    	=> $result['dest'],
				'carrier'    => $result['carrier'],
				'season'     => $result['season'],
				'letop'		=> $result['letop'],
				'selected'   => isset($this->request->post['selected']) && in_array($result['dest'].$result['carrier'], $this->request->post['selected']),
				'action'     => $action
			);
    	}
		
		$this->data['heading_title'] = $this->language->get('heading_title');		
				
		$this->data['text_yes'] = $this->language->get('text_yes');		
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_prices'] = $this->language->get('text_prices');		
			
		$this->data['column_destination'] = $this->language->get('column_destination');	
		$this->data['column_carrier'] = $this->language->get('column_carrier');	
		$this->data['column_season'] = $this->language->get('column_season');
		$this->data['column_letop'] = $this->language->get('column_letop');
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
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_season'])) {
			$url .= '&filter_season=' . $this->request->get['filter_season'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
					
		$this->data['sort_destination'] = $this->url->link('vis/letop', 'token=' . $this->session->data['token'] . '&sort=dest' . $url, 'SSL');
		$this->data['sort_carrier'] = $this->url->link('vis/letop', 'token=' . $this->session->data['token'] . '&sort=carrier' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_season'])) {
			$url .= '&filter_season=' . $this->request->get['filter_season'];
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
		$pagination->total = $letops_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('vis/letop', 'token=' . $this->session->data['token'] . str_replace('#', '%23', $url) . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
	
		$this->data['filter_destination'] = $filter_destination;
		$this->data['filter_carrier'] = $filter_carrier;
		$this->data['filter_season'] = $filter_season;
		
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'vis/letop_list.tpl';
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

		$this->data['entry_destination'] = $this->language->get('entry_destination');
		$this->data['entry_carrier'] = $this->language->get('entry_carrier');
		$this->data['entry_letop'] = $this->language->get('entry_letop');
		
				
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		
    	$this->data['tab_general'] = $this->language->get('tab_general');
		 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['dest'])) {
			$this->data['error_dest'] = $this->error['dest'];
		} else {
			$this->data['error_dest'] = '';
		}

 		if (isset($this->error['carrier'])) {
			$this->data['error_carrier'] = $this->error['carrier'];
		} else {
			$this->data['error_carrier'] = '';
		}

 		if (isset($this->error['letop'])) {
			$this->data['error_letop'] = $this->error['letop'];
		} else {
			$this->data['error_letop'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_destination'])) {
			$url .= '&filter_destination=' . $this->request->get['filter_destination'];
		}
		
		if (isset($this->request->get['filter_carrier'])) {
			$url .= '&filter_carrier=' . $this->request->get['filter_carrier'];
		}
		
		if (isset($this->request->get['filter_season'])) {
			$url .= '&filter_season=' . $this->request->get['filter_season'];
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
			'href'      => $this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		if (!isset($this->request->get['dest'])) {
			$this->data['action'] = $this->url->link('vis/letop/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('vis/letop/update', 'token=' . $this->session->data['token'] . '&dest=' . $this->request->get['dest'] . '&carr=' . $this->request->get['carr'] . $url, 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('vis/letop', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['dest']) && isset($this->request->get['carr']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$letop_info = $this->model_vis_letop->getLetOp($this->request->get['dest'], $this->request->get['carr']);
    	}
		
		if (isset($this->request->post['dest'])) {
      		$this->data['dest'] = $this->request->post['dest'];
    	} elseif (!empty($letop_info)) {
			$this->data['dest'] = $letop_info['dest'];
		} else {
      		$this->data['dest'] = '';
    	}
		
		if (isset($this->request->post['carrier'])) {
      		$this->data['carrier'] = $this->request->post['carrier'];
    	} elseif (!empty($letop_info)) {
			$this->data['carrier'] = $letop_info['carrier'];
		} else {
      		$this->data['carrier'] = '';
    	}
				
		if (isset($this->request->post['letop'])) {
      		$this->data['letop'] = $this->request->post['letop'];
    	} elseif (!empty($letop_info)) {
			$this->data['letop'] = $letop_info['letop'];
		} else {
      		$this->data['letop'] = '';
    	}
				
		$this->template = 'vis/letop_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	} 
	
	public function saveletop(){
		$this->load->model('vis/letop');

		$result = $this->model_vis_letop->saveLetOpValueById($this->request->get['dest'], $this->request->get['carr'], htmlspecialchars_decode($this->request->get['val']));

		if(TRUE===$result){
			$output = '<span style="color: darkgreen;">Saved</span>';
		}else{
			$output = '<span style="color: red;">'.Debug::print_r_html($result,true).'</span>';
		}		
		$this->response->setOutput($output);
	}
		
  	private function validateForm() { 
    	if (!$this->user->hasPermission('modify', 'vis/letop')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}

    	if (utf8_strlen($this->request->post['dest']) < 3 || !isset($this->request->post['dest']) ) {
      		$this->error['dest'] = $this->language->get('error_dest');
    	}

    	if (utf8_strlen($this->request->post['carrier']) < 2 || !isset($this->request->post['carrier']) ) {
      		$this->error['carrier'] = $this->language->get('error_carrier');
    	}

    	if (utf8_strlen($this->request->post['letop']) < 1 || !isset($this->request->post['letop']) ) {
      		$this->error['letop'] = $this->language->get('error_letop');
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
    	if (!$this->user->hasPermission('modify', 'vis/letop')) {
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