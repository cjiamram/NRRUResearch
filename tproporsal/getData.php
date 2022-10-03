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
$keyWord=isset($_GET["keyWord"]) ? $_GET["keyWord"] : "";
$userCode=isset($_GET["userCode"]) ? $_GET["userCode"] : "";

$stmt = $obj->getData($keyWord,$userCode);
$num = $stmt->rowCount();
if($num>0){
		$objArr=array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$objItem=array(
					"id"=>$id,
					"proporsalName"=>$proporsalName,
					"detail"=>$detail,
					"userCode"=>$userCode,
					"createDate"=>$createDate,
					"projectYear"=>$projectYear,
					"status"=>$status,
					"notification"=>$notification,
					"fileAttachment"=>$fileAttachment,
				);
				array_push($objArr, $objItem);
			}
			echo json_encode($objArr);
}
else{
			echo json_encode(array("message" => false));
}
?>