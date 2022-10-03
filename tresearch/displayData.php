<?php
session_start();
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../config/database.php";
include_once "../objects/classLabel.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
$database = new Database();
$db = $database->getConnection();
$objLbl = new ClassLabel($db);
$cnf=new Config();
$userCode=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"";
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$path="tresearch/getData.php?keyWord=".$keyword."&userCode=".$userCode;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);

//print_r($data["message"]);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_research","researchCode","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_research","abstract","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","topic","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","fundSource","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","budget","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","progressStatus","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","startDate","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","deuDate","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_research","ownerProject","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if(!isset($data->message)){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["researchCode"].'</td>';
			//echo '<td>'.$row["abstract"].'</td>';
			echo '<td>'.$row["topic"].'</td>';
			echo '<td>'.$row["fundSource"].'</td>';
			echo '<td>'.$row["budget"].'</td>';
			echo '<td>'.$row["progressStatus"].'</td>';
			echo '<td>'.$row["startDate"].'</td>';
			echo '<td>'.$row["deuDate"].'</td>';
			echo '<td>'.$row["ownerProject"].'</td>';
			
			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo "</tr>";
}
echo "</tbody>";
}
?>
