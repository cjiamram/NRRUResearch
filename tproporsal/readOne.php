<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tproporsal.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tproporsal($db);
$data = json_decode(file_get_contents("php://input"));
$obj->id = isset($_GET['id']) ? $_GET['id'] : 0;
$stmt=$obj->readOne();
$num=$stmt->rowCount();
if($num>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$item = array(
			"id"=>$id,
			"proporsalName" =>  $proporsalName,
			"detail" =>  $detail,
			"userCode" =>  $userCode,
			"createDate" =>  $createDate,
			"projectYear" =>  $projectYear,
			"status" =>  $status,
			"notification" =>  $notification,
			"fileAttachment" =>  $fileAttachment,
			"fundSource"=>$fundSource,
			"fundDescription"=>$fundDescription
		);
		echo(json_encode($item));

}
?>