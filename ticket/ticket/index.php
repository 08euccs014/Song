<?php
include_once 'mFactory.php';
include_once 'mView.php';
include_once 'commentModel.php';
include_once 'ticketModel.php';
include_once 'helper.php';
include_once 'commentView.php';
include_once 'ticketView.php';
include_once 'cronView.php';

$option = frameworkHelper::getVar('option','ticket');
$task	= frameworkHelper::getVar('view','display');

switch ($option){
	case 'ticket' :  	$viewObj = new ticketView();
						$viewObj->$task();
						break;
	
	case 'comment' :  	$viewObj = new commentView();
						$viewObj->$task();
						break;
	
	case 'cron'	   :	$viewObj = new cronView();
						$viewObj->$task();
						break;					
}

$viewObj->render();

include_once 'media.php';
