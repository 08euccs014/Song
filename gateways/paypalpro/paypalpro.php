<?php

class paypalproGateway extends gateway
{
	public static $responseType = null;
	
	public static $responsePath = __DIR__;
	
	public function request()
	{
		$action = $this->getVar('ACTION');
		if ($action == 'CANCEL') {
			self::$responseType = 'cancel';
		}
		else {
			self::$responseType = 'recurring';
		}
		
	}
	
	public function response()
	{

		$content = file_get_contents(self::$responsePath.DS.'response'.DS.self::$responseType);

		gatewayLogger::log('Reponse send' , $content);
		
		echo $content;
	}
}