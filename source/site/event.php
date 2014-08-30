<?php
class customEvent
{
	public static function trigger($event, $args)
	{
		if (!is_array($args)) {
			$args = array($args);
		}

		$apps = self::loadApps();
		
		foreach ($apps as $app) {
			
			if(method_exists($app, $event)) {
				$result[] = call_user_method_array($event, $app, $args);
			}
		}
		
		return $result;
	}
	
	//these are the apps which are loaded from the database
	public static function loadApps()
	{
		static $apps = array();
		
		if (!empty($apps)) {
			return $apps;
		}
		
		$arg1 = new stdClass();
		$arg1->id = 1;
		$arg1->name = 'testing1';
		$arg1->type = 'test';
		$arg1->params = '{"param1":"value1"}';
		
		$arg2 = new stdClass();
		$arg2->id = 2;
		$arg2->name = 'testing2';
		$arg2->type = 'test';
		$arg2->params = '{"param1":"value2"}';
		
		$records = array($arg1, $arg2);
		
		foreach ($records as $app ) {
			$apps[] = new $app->type($app);
		}
		
		return $apps;
	}
}