<?php

class paypalGateway extends gateway
{
	public $responseType = null;
	
	public $responsePath = __DIR__;
	
	public function request()
	{
		self::$responseType = 'fixed';
	}
	
	public function response()
	{

		$content = file_get_contents(self::$responsePath.DS.'response'.DS.self::$responseType);
		
		gatewayLogger::log('Reponse send' , $content);
		
		return $content;
	}
}