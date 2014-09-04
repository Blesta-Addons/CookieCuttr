<?php
/**
 * CookieCuttr Plugin 
 * 
 * @package blesta
 * @subpackage blesta.plugins.CookieCuttr
 * @copyright Copyright (c) 2005, Naja7host SARL.
 * @link http://www.naja7host.com/ Naja7host
 */

class Cookiecuttr extends CookiecuttrModel {
	
	/**
	 * Initialize
	 */
	public function __construct() {
		parent::__construct();
		
		// Language::loadLang("knowledgebase_categories", null, PLUGINDIR . "knowledgebase" . DS . "language" . DS);
	}
	
}
?>