<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tproporsal.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new  tproporsal($db);
	$mxId=$obj->getMaxId();
	echo json_encode(array("mxId"=>intval($mxId))); 

?>