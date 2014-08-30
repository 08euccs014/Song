<?php

$plugins = JPluginHelper::getPlugin('custom');


foreach ($plugins as $plg) {
	$classname = 'plgCustom'.$plg->name;
}


