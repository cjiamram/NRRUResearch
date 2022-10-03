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
$obj->proporsalName = $data->proporsalName;
$obj->detail = $data->detail;
$obj->userCode = $data->userCode;
$obj->createDate = $data->createDate;
$obj->projectYear = $data->projectYear;
$obj->status = $data->status;
$obj->notification = $data->notification;
$obj->fileAttachment = $data->fileAttachment;
$obj->fundSource=$data->fundSource;
$obj->fundDescription=$data->fundDescription;

$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>