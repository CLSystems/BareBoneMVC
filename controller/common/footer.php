<?php
/**
 * Footer class controller for BareBoneMVC.
 *
 * @package BareBone\Controller\Common 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCommonFooter extends Controller {   
	protected function index() {
		$this->load->language('common/footer');
		
		$this->data['text_footer'] = sprintf($this->language->get('text_footer'), VERSION);
		
		$this->template = 'common/footer.tpl';
	
    	$this->render();
  	}
}
?>