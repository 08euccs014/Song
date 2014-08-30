<?php


class customModelResource extends Rb_Model
{
	public $_name = 'resource';
	
	public	$_component	= 'custom';
	
	protected $uniqueColumns = Array();
	
	public function xloadRecords($filters)
	{

		$record1 = new stdClass();
		$record1->user_id = 1;
		$record1->type 	  = 'test';
		$record1->created_by = 1;
		$record1->value = true;
		$record1->applied_on = 1;
		$record1->used = null;

		$record2 = new stdClass();
		$record2->user_id = 1;
		$record2->type 	  = 'test';
		$record2->created_by = 2;
		$record2->value = false;
		$record2->applied_on = 1;
		$record2->used = null;

		$record3 = new stdClass();
		$record3->user_id = 0;
		$record3->type 	  = 'test';
		$record3->created_by = 1;
		$record3->value = true;
		$record3->applied_on = 1;
		$record3->used = null;

		$records = array($record1, $record2);
		// $filteredRecords = array();

		// foreach ($records as $record) {
			
		// 	foreach ($filters as $filter => $value) {
		// 		if ($record->$filter == $value) {
		// 			$filteredRecords[] = $record;
		// 		}
		// 	}
		
		// }
		
		return $records;
	}
	
	public function loadRecords(Array $queryFilters=array(), Array $queryClean = array(), $emptyRecord=false, $indexedby = null, $groupBy = null)
	{
		$query = $this->getQuery();
	
		//there might be no table and no query at all
		if($query === null )
			return null;
	
		//Support Query Filters, and query cleanup
		$tmpQuery = clone ($query);
	
		foreach($queryClean as $clean){
			$tmpQuery->clear(strtolower($clean));
		}
	
		$this->_buildWhereClause($tmpQuery, $queryFilters);
	
		if($indexedby === null){
			$indexedby = $this->getTable()->getKeyName();
		}
	
		if (null !== $groupBy) {
			$tmpQuery->group($groupBy);
		}
		
		//we want returned record indexed by columns
		$this->_recordlist = $tmpQuery->dbLoadQuery()
		->loadObjectList($indexedby);
	
		//handle if some one required empty records, only if query records were null
		if($emptyRecord && empty($this->_recordlist)){
			$this->_recordlist = $this->getEmptyRecord();
		}
	
		return $this->_recordlist;
	}

}

class CustomModelformResource extends Rb_Modelform
{
	public	$_component			= 'custom';
}

class CustomTableResource extends Rb_Table {
	public	$_component			= 'custom';
}