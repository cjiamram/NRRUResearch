<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once "../config/database.php";
	include_once "../objects/tproporsal.php";
	include_once "../objects/classLabel.php";
	include_once "../config/config.php";
	
	session_start();
	$database = new Database();
	$db = $database->getConnection();
	$objLbl = new ClassLabel($db);
	$cnf=new Config();
	$rootPath=$cnf->path;
	$userCode=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"";
	$fullName=isset($_SESSION["FullName"])?$_SESSION["FullName"]:"";
	$cDate=date("Y-m-d");
	$cYear=date("Y")+543;

?>
<form role='form'>
<div class="box-body">
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","proporsalName","th").":" ?></label>
			<div class="col-sm-12">
				<input type="text" 
							class="form-control" id='obj_proporsalName' 
							placeholder='<?= $objLbl->getLabel("t_proporsal","proporsalName","th")?>'>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","detail","th").":" ?></label>
			<div class="col-sm-12">
				
				<textarea class="form-control" id='obj_detail' style="width:100%" rows="5" ></textarea>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","userCode","th").":" ?>/<?php echo $objLbl->getLabel("t_proporsal","createDate","th").":" ?></label>
			<div class="col-sm-6">
				
				<label id="obj_userCode" class='form-control'><?=$userCode?></label>
			</div>
			<div class="col-sm-6">
				<label id="obj_fullName" class='form-control'><?=$fullName?></label>
			</div>
		</div>

		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","createDate","th").":" ?>/<?php echo $objLbl->getLabel("t_proporsal","projectYear","th").":" ?></label>
			
			<div class="col-sm-6">
				<div class="input-group date">
				<div class="input-group-addon">
				<i class="fa fa-calendar"></i>
				</div>
				<input type="date" value="<?=$cDate?>"   class="form-control" id="obj_createDate">
				</div>
			</div>
			<div class="col-sm-6">
				<input type="text" 
							class="form-control" id='obj_projectYear' value='<?=$cYear?>' 
							placeholder='<?=$objLbl->getLabel("t_proporsal","projectYear","th")?>'>
			</div>
		</div>
		
		

		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","notification","th").":" ?></label>
			<div class="col-sm-12">
			

				<textarea  id='obj_notification' class="form-control" style="width:100%" rows="5"></textarea>
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","fileAttachment","th").":" ?></label>
			<div class="col-sm-12">
				<input type="hidden" 
							id='obj_fileAttachment' >
				<input type="file" id="obj_file">
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","fundSource","th").":" ?></label>
			<div class="col-sm-12">
				<select id="obj_fundSource" class="form-control"></select>

				
			</div>
		</div>
		<div class='form-group'>
			<label class="col-sm-12"><?php echo $objLbl->getLabel("t_proporsal","fundDescription","th").":" ?></label>
			<div class="col-sm-12">
			

				<textarea class="form-control" id="obj_fundDescription" style="width:100%" rows="4"></textarea>
				
			</div>
		</div>
</div>
</form>

<script>
	function listFundSource(){
		var url="<?=$rootPath?>/tfundsource/getData.php";
		setDDLPrefix(url,"#obj_fundSource","***แหล่งทุน***");		
	}

	$(document).ready(function(){
		listFundSource();
		//$("#obj_projectYear").val('<?=$cYear?>');
		//$("#obj_createDate").val('<?=$cDate?>');
	});
</script>
