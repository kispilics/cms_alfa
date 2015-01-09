<?php
	
	
	/**
	*
	*	
	*	Példányositja a rooter osztályt.
	*	
	*/
	
	
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	session_start();
	
	
	require_once 'classes/rooter.php';
	
	$obj_controller = new rooter;
	$obj1 = new $obj_controller->className;

	$methodName = $obj_controller->method;	
	$obj1->$methodName();
	
?>