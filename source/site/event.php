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
			
			//create instance may be there is something that need to initialize rather than just calling function of class
			$appObject = new $app();
			
			if(method_exists($app, $event)) {
				$result[] = call_user_method_array($event, $appObject, $args);
			}
		}
		
		return $result;
	}
	
	//these are the apps which are has been availabe in ACL manager
	public static function loadApps()
	{
		static $apps = array();
		
		if (!empty($apps)) {
			return $apps;
		}
	
		$files	=	JFolder::files(CUSTOM_APPS_PATH,".php$");
		
		if(is_array($files)){
			foreach($files as $file ){
				$classname 	= JFile::stripExt($file);
				$apps[] = $classname;
			}
		}
		
		return $apps;
	}
}