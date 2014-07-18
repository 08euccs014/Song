<?php
/**
 * @app.name@
 * @app.description@
 * @copyright Copyright (C) 2009 - 2014 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
 * @license GNU/GPL, see LICENSE.php
 * @package payplans
 * @version @app.version@
 * @author Mohit Agrawal <mohit@readybytes.in>
 */
if(defined( '_JEXEC' )==false) {
	die( 'Restricted access' );
}

class plgPayplans@app.nameuppper@ extends XiPlugin
{
	public function onPayplansSystemStart()
	{
		//add app path to app loader
		$appPath = dirname(__FILE__).DS.'@app.name@'.DS.'app';
		PayplansHelperApp::addAppsPath($appPath);

		return true;
	}
}
 
