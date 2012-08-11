<?php
/**
 * Header class controller for SilverJet BareBone.
 * Contains special adaptations for Module VIS.
 *
 * @package BareBone\Controller\Common 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ControllerCommonHeader extends Controller {
	protected function index() {
		$this->data['title'] = $this->document->getTitle(); 
		
		
		
		// VIS-specials
		
		// EDIT HERE !!!
		$this->session->data['aSeasons'] = array(
						'winter1112'	=> 'Winter 2011/2012', 
						'zomer12'		=> 'Zomer 2012', 
						'winter1213'	=> 'Winter 2012/2013',
						'zomer13'		=> 'Zomer 2013' 
						);
		$this->session->data['aDates'] = array(
						'winter1112' 	=> array('season_date_start'=>'01-11-2011', 'season_date_end'=>'31-03-2012'),
						'zomer12' 		=> array('season_date_start'=>'01-04-2012', 'season_date_end'=>'31-10-2012'),
						'winter1213' 	=> array('season_date_start'=>'01-11-2012', 'season_date_end'=>'31-03-2013'),
						'zomer13' 		=> array('season_date_start'=>'01-04-2013', 'season_date_end'=>'31-10-2013')
						);
		
		if(!isset($_COOKIE['prefix'])){
			setcookie("prefix", "zomer12_" );
			setcookie("season", "zomer12" );
		}
		// END EDIT HERE
		
		if(isset($this->request->get['setseason'])){
			setcookie("prefix", $this->request->get['setseason'].'_' );
			setcookie("season", $this->request->get['setseason']);
			header('location:index.php?route=vis/aroutes&token=' . $this->session->data['token']);
		}
		
		$this->load->model('common/header');
		$season_html = $this->model_common_header->CheckSeason($_COOKIE["season"], $this->session->data['aSeasons'], $this->session->data['token']);
		// only show when accessing the VIS-module
		if(strstr($_SERVER['QUERY_STRING'], 'vis')){
			$this->data['vis_html'] = $season_html;
		}else{
			$this->data['vis_html'] = '';
		}
		// end VIS-specials
		
		
		

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = HTTPS_SERVER;
		} else {
			$this->data['base'] = HTTP_SERVER;
		}
		
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
				
		$this->load->language('common/header');

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_dashboard'] = $this->language->get('text_dashboard');
		
		$this->data['text_system'] = $this->language->get('text_system');
		$this->data['text_error_log'] = $this->language->get('text_error_log');
		$this->data['text_user'] = $this->language->get('text_user');
		$this->data['text_user_group'] = $this->language->get('text_user_group');
		$this->data['text_users'] = $this->language->get('text_users');

		$this->data['text_confirm'] = $this->language->get('text_confirm');


		if (!$this->user->isLogged() || !isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$this->data['logged'] = '';
			
			$this->data['home'] = $this->url->link('common/login', '', 'SSL');
		} else {			
			$this->data['logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());

			$this->data['home'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
			$this->data['token'] = $this->session->data['token'];
			
			$this->data['group_id'] = $this->user->getUserGroupId();
			$this->load->model('user/user_groups');
			$permissions = $this->model_user_user_groups->getUserGroup($this->user->getUserGroupId());
			$item = array();
			$tree = array();
			$menu = array();
			if($this->user->getUserGroupId() == 10){
				if(isset($permissions['permission']['access'])){
					foreach($permissions['permission']['access'] as $permission) {
						$this->load->language($permission);
						$item = explode('/', $permission);
						$tree[$item[0]]['label'] = $item[0];
						$tree[$item[0]]['subs'][] = array(
														'label' => $this->language->get('menu_title'),
														'item' => $item[1]
														);
						$menu = $tree;
					} // END foreach
				} // END if isset
			}else{
				if(isset($permissions['permission']['modify'])){
					foreach($permissions['permission']['modify'] as $permission) {
						$this->load->language($permission);
						$item = explode('/', $permission);
						$tree[$item[0]]['label'] = $item[0];
						$tree[$item[0]]['subs'][] = array(
														'label' => $this->language->get('menu_title'),
														'item' => $item[1]
														);
						$menu = $tree;
					} // END foreach
				} // END if isset
			} // END if/else getUserGroupId == 10
			ksort($menu);
			if($this->user->getUserGroupId() >= 1){unset($menu['common']);}
			if($this->user->getUserGroupId() == 1){
				unset($menu['setting']);
				
				$tools = array_pluck('tool', $menu);
				unset($menu['tool']);
				array_push($menu, $tools);
				
				$users = array_pluck('user', $menu);
				unset($menu['user']);
				array_push($menu, $users);
			}

			$this->data['menu'] = $menu;
			
			$this->data['error_log'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
			
			$this->data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
			$this->data['user_group'] = $this->url->link('user/user_groups', 'token=' . $this->session->data['token'], 'SSL');
		}
		
		$this->template = 'common/header.tpl';
		
		$this->render();
	}
}
?>