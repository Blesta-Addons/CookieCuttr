<?php
/**
 * CookieCuttr Plugin 
 * 
 * @package blesta
 * @subpackage blesta.plugins.CookieCuttr
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */
 
class CookiecuttrPlugin extends Plugin {

	public function __construct() {
		Language::loadLang("cookiecuttr", null, dirname(__FILE__) . DS . "language" . DS);
		
		// Load components required by this plugin
		Loader::loadComponents($this, array("Input", "Record"));
		
        // Load modules for this plugun
        Loader::loadModels($this, array("ModuleManager"));
		$this->loadConfig(dirname(__FILE__) . DS . "config.json");
	}
	
	/**
	 * Performs any necessary bootstraping actions
	 *
	 * @param int $plugin_id The ID of the plugin being installed
	 */
	public function install($plugin_id) {	
			
		// Add the system overview table, *IFF* not already added
		try {

					
		}
		catch(Exception $e) {
			// Error adding... no permission?
			// $this->Input->setErrors(array('db'=> array('create'=>$e->getMessage())));
			return;
		}
	}
	
    /**
     * Performs migration of data from $current_version (the current installed version)
     * to the given file set version
     *
     * @param string $current_version The current installed version of this plugin
     * @param int $plugin_id The ID of the plugin being upgraded
     */
	public function upgrade($current_version, $plugin_id) {
		
		// Upgrade if possible
		if (version_compare($this->getVersion(), $current_version, ">")) {
			// Handle the upgrade, set errors using $this->Input->setErrors() if any errors encountered
		}
	}
	
    /**
     * Performs any necessary cleanup actions
     *
     * @param int $plugin_id The ID of the plugin being uninstalled
     * @param boolean $last_instance True if $plugin_id is the last instance across all companies for this plugin, false otherwise
     */
	public function uninstall($plugin_id, $last_instance) {
		if (!isset($this->Record))
			Loader::loadComponents($this, array("Record"));
		
		// Remove all tables *IFF* no other company in the system is using this plugin
		if ($last_instance) {
			try {

			}
			catch (Exception $e) {
				// Error dropping... no permission?
				// $this->Input->setErrors(array('db'=> array('create'=>$e->getMessage())));
				return;
			}
		}
 
	}

	
 
    public function getEvents() {
        return array(
            array(
                'event' => "Appcontroller.structure",
                'callback' => array("this", "addCookiecuttrJs")
            )
            // Add multiple events here
        );
    }
 
    public function addCookiecuttrJs($event) {
	

		$params = $event->getParams();
		$return = $event->getReturnVal();
	
		// $params['controller'] = "admin_main"; // this is the controller file name client_main.php
		// $params['action'] = "MyFunction"; // a function inside the appcontroller file set in $params['controller']
		// $params['portal'] = "client"; // injest the markup in client side structure 		
		// $event->setParams($params);
		
        // Set return val if not set
        if (!isset($return['head']))
                $return['head'] = null;
				
        // Update return val -- ONLY set if client portal
        if ($params['portal'] == "client")            
			$return['head'] .= " 
				<script src='". WEBDIR . "plugins/cookiecuttr" . DS . "views" . DS . "default" . DS . "js/jquery.cookie.js'></script>		
				<script src='". WEBDIR . "plugins/cookiecuttr" . DS . "views" . DS . "default" . DS . "js/jquery.cookiecuttr.js'></script>		
				<link rel='stylesheet' href='". WEBDIR . "plugins/cookiecuttr" . DS . "views" . DS . "default" . DS . "css/styles.css'>
				<script>

				$(document).ready(function () {
					// activate cookie cutter
					$.cookieCuttr({
					cookieDeclineButton: true,
					cookieAcceptButtonText : '". Language::_("CookiecuttrPlugin.index.cookieAcceptButtonText", true) ." ',
					cookieDeclineButtonText : '". Language::_("CookiecuttrPlugin.index.cookieDeclineButtonText", true) ." ',
					cookieResetButtonText : '". Language::_("CookiecuttrPlugin.index.cookieResetButtonText", true) ." ',
					cookieWhatAreLinkText : '". Language::_("CookiecuttrPlugin.index.cookieWhatAreLinkText", true) ." ',
					cookieMessage : '". Language::_("CookiecuttrPlugin.index.cookieMessage", true) ." '
					});
				});
				  
				</script>
				
			" ;
		
		// echo json_encode($return);

		// $return['head'] = file_get_contents($changelog) ;			
		// $return['body_start'] = "<p>Set at top of body</p>";
		// $return['body_end'] = "<p>Set at bottom of body</p>";
		
		// ob_start(); // Start output buffering		
		// include $file; // Include the file		
		// $contents = ob_get_clean(); // Get the contents of the buffer and close buffer.
		
		// $return['head'] = "<script>alert('".$params['portal']."');</script>" ;
		$event->setReturnVal($return);	
		
	}
	
	/**
	 * Returns all actions to be configured for this widget (invoked after install() or upgrade(), overwrites all existing actions)
	 *
	 * @return array A numerically indexed array containing:
	 * 	-action The action to register for
	 * 	-uri The URI to be invoked for the given action
	 * 	-name The name to represent the action (can be language definition)
	 */
	public function getActions() {

	}

	
	/**
	 * Execute the cron task
	 *
	 */

	public function cron($key) {
		// Todo a task 
	}

	
	/**
	 * Attempts to add new cron tasks for this plugin
	 *
	 */

	private function addCronTasks(array $tasks) {
		// TODO
	}	
	
}
?>