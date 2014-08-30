<?php

define('DS', DIRECTORY_SEPARATOR);

class process
{
	private static $_gateway = null;
	
	public static $_location = __DIR__; 
	
	public static $_cliParams = array();

	public function __construct($cliParams = array())
	{
		self::$_cliParams = json_decode($cliParams[1]);
		
		include_once self::$_location.DS.'base_gateway.php';
		include_once self::$_location.DS.'logger.php';
	}
	
	public function init() 
	{
		$gateway = $this->getVar('gateway', null);
		
		if ( null == $gateway)
		{
			gatewayLogger::log('Empty Gateway');
			return false;
		}
		
		self::$_gateway = strtolower($gateway);
		
		$this->autoload();
		
		$className = self::$_gateway.'Gateway';
		
		$gateway = new $className();
		
		$gateway->request();
		
		return $gateway->response();
	} 

	public function getVar($variable = null , $default = null)
	{
		if (empty($variable)) {
			return $default;
		}
		
		if (isset($_POST[$variable])) {
			return $_POST[$variable];
		}
		
		if (isset($_GET[$variable])) {
			return $_GET[$variable];
		}
		
		if (isset($_REQUEST[$variable])) {
			return $_REQUEST[$variable];
		}
		
		if (isset(self::$_cliParams->$variable)) {
			return self::$_cliParams->$variable;
		}
		
		return $default;	
	}
	
	public function autoload() 
	{

		$path = self::$_location.DS.'gateways'.DS.self::$_gateway.DS.self::$_gateway.".php";
		
		include_once $path;
		
		return true;
	}

}

//this als works for commandline arguments json encoded, you need to exeucte it like this php process.php '{"gateway":"paypal"}'
$process = new process($argv);

return $process->init();