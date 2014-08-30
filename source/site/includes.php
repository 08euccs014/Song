<?php

jimport('joomla.filesystem.file');

define("CUSTOM_APPS_PATH", __DIR__.DS.'apps');
define("CUSTOM_MODEL_PATH", __DIR__.DS.'custom'.DS.'model');

JLoader::register('customEvent', __DIR__.DS.'event.php');
JLoader::register('customApp', __DIR__.DS.'app.php');
JLoader::register('customModelResource', CUSTOM_MODEL_PATH.DS.'resource.php');
JLoader::register('CustomTableResource', CUSTOM_MODEL_PATH.DS.'resource.php');
JLoader::register('CustomModelformResource', CUSTOM_MODEL_PATH.DS.'resource.php');
JLoader::register('customModelApp', CUSTOM_MODEL_PATH.DS.'app.php');
JLoader::register('CustomTableApp', CUSTOM_MODEL_PATH.DS.'app.php');
JLoader::register('CustomModelformApp', CUSTOM_MODEL_PATH.DS.'app.php');

$files	=	JFolder::files(CUSTOM_APPS_PATH,".php$");

if(is_array($files)){
	foreach($files as $file ){
		$classname 	= JFile::stripExt($file);
		JLoader::register($classname, CUSTOM_APPS_PATH.DS.$file);
	}
}