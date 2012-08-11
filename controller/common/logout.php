<?php
/**
 * Logout class controller for SilverJet BareBone.
 *
 * @package BareBone\Controller\Common 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCommonLogout extends Controller {   
	public function index() { 
    	$this->user->logout();
 
 		unset($this->session->data['token']);

		$this->redirect($this->url->link('common/login', '', 'SSL'));
  	}
}  
?>