<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      $cnf=new Config();
      $rootPath=$cnf->path;
      $database = new Database();
      $db = $database->getConnection();
      $objLbl=new ClassLabel($db);

      function mb_basename($path) {
            if (preg_match('@^.*[\\\\/]([^\\\\/]+)([\\\\/]+)?$@s', $path, $matches)) {
                return $matches[1];
            } else if (preg_match('@^([^\\\\/]+)([\\\\/]+)?$@s', $path, $matches)) {
                return $matches[1];
            }
            return '';
      }
      $dir= getcwd();

      $lastPath=mb_basename($dir);
	  $moduleName="Module";	

?>

 <link rel="stylesheet" href="<?=$rootPath?>/assets/vendor/datatables/media/css/dataTables.bootstrap4.min.css" />



<div class="app header-default side-nav-dark">
	   <div class="card">
				<div class="card-header border bottom">
					<h4 class="card-title"><?=$moduleName?></h4>
				</div>
		   
		   		 <div class="row m-t-30">
					 				<div class="col-md-2">
										  <label class="control-label">Keyword</label>
									</div>
                                    <div class="col-md-5">
                                        <div class="p-h-10">
                                            <div class="form-group">
                                                <input type="text" id="txt_keyword" class="form-control">
                                            </div>
                                        </div>
                                    </div>
					 				<div class="col-md-5">
									</div>
					</div>	
		   
				 <div class="card-body">
					 <!--class="table table-hover table-xl"-->
					<table class="table" id="tblDisplay">
					</table>
				</div>
	  </div>
</div>

		<div class="modal fade" id="modal-input">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4><?=$moduleName?></h4>
					</div>
					<div class="modal-body" id="dvInput">
						
					</div>
					<div class="modal-footer no-border">
						<div class="text-right">
							<button class="btn btn-default" data-dismiss="modal">Close</button>
							<button class="btn btn-success" data-dismiss="modal">OK</button>
						</div>
					</div>
				</div>
			</div>
		</div>


<script src="<?=$rootPath?>/assets/vendor/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?=$rootPath?>/assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=$rootPath?>/assets/js/tables/data-table.js"></script>
