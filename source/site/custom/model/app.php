<?php


class customModelApp extends Rb_Model
{
	public $_name = 'app';
	
	public	$_component	= 'custom';
	
	protected $uniqueColumns = Array();
}

class CustomModelformApp extends Rb_Modelform
{
	public	$_component			= 'custom';
}

class CustomTableApp extends Rb_Table {
	public	$_component			= 'custom';
}