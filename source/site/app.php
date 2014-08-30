<?php

class customApp
{
	protected $_id = null;

	protected $_name = ''; 
	
	protected $_params = null;
	
	protected $_type = null;
	 
	public function __construct($object = null) 
	{
		if (null == $object) {
			$object = new stdClass();
			
			$object->app_id = 0;
			$object->name 	= 'parentObject';
			$object->type 	= $this->_type;
			$object->params = $this->_params;
		}
		
		$this->_id 		= $object->app_id;
		$this->_name 	= $object->name;
		$this->_type 	= $object->type;
		$this->_params 	= json_decode($object->params);

	}
	
	public function getParam($key='' , $default = null)
	{
		if(isset($this->_params->$key)) {
			return $this->_params->$key;
		}
		
		return $default;
	}
	
	function getResource($userId = null, $type = null, $mine = true)
	{
		if($type == null) {
			$type = $this->_type;
		}
		
		$filters = array('user_id'=>$userId, 'type' => $type);
		
		if ($mine) {
			$filters['created_by'] = $this->_id;
		}
		
		$model = new customModelResource();
		
		$resources = $model->loadRecords($filters, array(), false, null, 'applied_on');
		
		return $resources;
	}
	
	/**
	 * It will return how many instances are create of an app
	 */
	function getAllInstances()
	{
		$apps = array();
		
		$model = new customModelApp();
		$appInstances = $model->loadRecords(array('type'=>$this->_type));
		
		foreach ($appInstances as $instance) {
			$apps[] = new self($instance);	
		}
		
		return $apps;

	}
	
	function addResource()
	{
		
	}
	
	function removeResource()
	{
		
	}
}