<?php
/**
 * CookieCuttr Plugin 
 * 
 * @package blesta
 * @subpackage blesta.plugins.CookieCuttr
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class AdminManagePlugin extends AppController {
	
	/**
	 * Performs necessary initialization
	 */
	private function init() {
		// Require login
		$this->parent->requireLogin();
		Language::loadLang("cookiecuttr", null, PLUGINDIR . "cookiecuttr" . DS . "language" . DS);
		
		$this->uses(array("Companies"));	
		
		// Set the company ID
		$this->company_id = Configure::get("Blesta.company_id");

		// Set the plugin ID
		$this->plugin_id = (isset($this->get[0]) ? $this->get[0] : null);
		$this->CookieCuttrSettings =  $this->Companies->getSetting($this->company_id , "CookieCuttrPlugin");
		// Set the page title
		$this->parent->structure->set("page_title", Language::_("CookiecuttrPlugin.admin_main", true));
		
		// Set the view to render for all actions under this controller
		$this->view->setView(null, "Cookiecuttr.default");		
		
	}
	
	/**
	 * Returns the view to be rendered when managing this plugin
	 */
	public function index() {
		$this->init();

		if (!empty($this->post)) {
			$this->Companies->setSetting($this->company_id , "CookieCuttrPlugin", serialize($this->post)  );
			$this->parent->setMessage("success", Language::_("CookieCuttrPlugin.!success.settings_saved", true) , false, null, false);				
			$this->CookieCuttrSettings =  $this->Companies->getSetting($this->company_id , "CookieCuttrPlugin");	
		}
		// print_r($this->GetkudosSettings['site_name']);
		$vars = array(
			'plugin_id'=> $this->plugin_id,
			'settings'=> unserialize($this->CookieCuttrSettings->value)
		);		
		// print_r(unserialize($this->CookieCuttrSettings->value));
		// Set the view to render
		return $this->partial("admin_manage_plugin" , $vars );		

	}
}	
?>