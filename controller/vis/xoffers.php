<?php
/**
 * XOffers class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Vis 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerVisXOffers extends Controller {
	private $error = array(); 
     
  	public function index() {
		$this->load->language('vis/xoffers');
    	
		$this->document->setTitle($this->language->get('heading_title')); 
		
//		$this->load->model('vis/xoffers');
		
		$this->getList();
  	}
  	
  	private function getList() {				
		$url = '';
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('crumbs_vis'),
			'href'      => $this->url->link('vis/xoffers', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
									
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('vis/xoffers', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
      		'separator' => ' :: '
   		);
		
    	
		$this->data['frame_url'] = 'http://sis/live/vluchten_update/SIS21/aero.php';
		
		
    	$this->load->language('vis/xoffers');

		$this->data['heading_title'] = $this->language->get('heading_title');		
				
 		$this->data['token'] = $this->session->data['token'];
		

		$this->template = 'vis/xoffers_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}

	
}
?>