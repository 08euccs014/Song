<?php

define('DS', DIRECTORY_SEPARATOR);

class process
{
	private static $_gateway = null;
	
	public static $_location = __DIR__; 

	public function __construct()
	{
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
		
		return $default;	
	}
	
	public function autoload() 
	{

		$path = self::$_location.DS.'gateways'.DS.self::$_gateway.DS.self::$_gateway.".php";
		
		include_once $path;
		
		return true;
	}

}

$process = new process();

return $process->init();