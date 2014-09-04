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
		// Set the company ID
		$this->company_id = Configure::get("Blesta.company_id");
		
		// Set the plugin ID
		$this->plugin_id = (isset($this->get[0]) ? $this->get[0] : null);
		
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
		
		
		// Set the view to render
		return $this->partial("admin_manage_plugin");		

	}
}	
?>