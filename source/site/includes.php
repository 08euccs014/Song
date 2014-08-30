<?php

jimport('joomla.filesystem.file');


JLoader::register('customEvent', __DIR__.DS.'event.php');
JLoader::register('customApp', __DIR__.DS.'app.php');
JLoader::register('customModelResource', __DIR__.DS.'model.php');
JLoader::register('CustomTableResource', __DIR__.DS.'model.php');
JLoader::register('CustomModelformResource', __DIR__.DS.'model.php');
//JLoader::register('customTableResource', __DIR__.DS.'table.php');

$folder = __DIR__.DS.'apps';

$files	=	JFolder::files($folder,".php$");

if(is_array($files)){
	foreach($files as $file ){
		$classname 	= JFile::stripExt($file);
		JLoader::register($classname, $folder.DS.$file);
	}
}