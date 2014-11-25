<?php

abstract class gateway
{
	public function request()
	{
		return true;
	}

	public function response()
	{
		return false;
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
		
		//if (isset(self::$_cliParams->$variable)) {
		//	return self::$_cliParams->$variable;
		//}
		
		return $default;	
	}
}