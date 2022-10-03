<?php
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
$keyword=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
$path="tproporsal/getData.php?keyWord=".$keyword."&userCode=".$userCode;
$url=$cnf->restURL.$path;
$api=new ClassAPI();
$data=$api->getAPI($url);
echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","proporsalName","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","detail","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","userCode","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","createDate","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","projectYear","TH")."</th>";
			//echo "<th>".$objLbl->getLabel("t_proporsal","status","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","notification","TH")."</th>";
			echo "<th>".$objLbl->getLabel("t_proporsal","fileAttachment","TH")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";
if($data!=""){
echo "<tbody>";
$i=1;
foreach ($data as $row) {
		echo "<tr>";
			echo '<td>'.$i++.'</td>';
			echo '<td>'.$row["proporsalName"].'</td>';
			echo '<td>'.$row["detail"].'</td>';
			echo '<td>'.$row["userCode"].'</td>';
			$createDate=date("d-m-Y",$row["createDate"]);

			echo '<td>'.$createDate.'</td>';
			echo '<td>'.$row["projectYear"].'</td>';
			//echo '<td>'.$row["status"].'</td>';
			echo '<td>'.$row["notification"].'</td>';
			$files=explode("/", $row["fileAttachment"]);
			$l=count($files);
			$file=$files[$l-1];

			//print_r($l);

			echo '<td><a href=\''.$row["fileAttachment"].'\' target=\'_blank\' ><i class="fa fa-file" aria-hidden="true"></i>&nbsp;'.$file.'</a></td>';

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
