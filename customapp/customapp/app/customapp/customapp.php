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

class PayplansApp@app.nameuppper@ extends PayplansApp
{
	
	//inherited properties
	protected $_location	= __FILE__;

	public function isApplicable($refObject = null, $eventName='') {
			return parent::isApplicable($subscription, $eventName);
	}
}
 
