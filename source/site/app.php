<?php

class customApp
{
	protected $_id = null;

	protected $_name = ''; 
	
	protected $_params = null;
	
	protected $_type = null;
	 
	public function __construct($object) 
	{
		$this->_id 		= $object->id;
		$this->_name 	= $object->name;
		$this->_params 	= json_decode($object->params);
		
		$this->_allInstances = $this->getAllInstances();
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
	
	function getAllInstances()
	{
		return $records;
	}
	
	function addResource()
	{
		
	}
	
	function removeResource()
	{
		
	}
}