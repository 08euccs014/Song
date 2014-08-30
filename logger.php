<?php

define('GATEWAY_LOGGER_PATH' ,__DIR__.DS.'requestLog');

class gatewayLogger {	

	public static function log($msg, $extra = null)
	{
		$string =  	PHP_EOL.date("F j, Y, g:i a")
					." From IP : ".$_SERVER['REMOTE_ADDR']
					." Using : ".php_sapi_name()
					.PHP_EOL."$msg".PHP_EOL;

		if(!empty($extra)) {
			$string .= var_export($extra,true).PHP_EOL;
		}
				
		//open file in append mode
		$fp = fopen(GATEWAY_LOGGER_PATH, 'a');
		// file will acquire an exclusive lock (writer).
		flock($fp, LOCK_EX);
		//write info file
		fwrite($fp, $string);
		// release a lock from file
		flock($fp, LOCK_UN);
		
		return true;
	}	
}