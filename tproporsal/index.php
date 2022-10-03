<?php
      include_once '../config/database.php';
      include_once '../config/config.php';
      include_once '../objects/classLabel.php';
      session_start();
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
      $subModule=$objLbl->getLabel("t_proporsal","Module","th");
      $userCode=isset($_SESSION["UserName"])?$_SESSION["UserName"]:"Admin";
      $cDate=date("Y-m-d");
      $cYear=date("Y")+543;



?>
<input type="hidden" id="obj_id" value="">
<section class="content-header">
     <h1>
        <b><?=$cnf->systemModule?></b>

        <small>>><?=$subModule?></small>
      </h1>
      <ol class="breadcrumb">
   
        <!--<input type="button" id="btnSearch"  class="btn btn-success pull-right"  value="ค้นหาข้นสูง">-->
        <input type="button" id="btnInput"   class="btn btn-primary pull-right"  value="สร้าง">


      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box"></div>
        <div class="form-group">
          <div class="col-sm-12">
             <div class="col-sm-6">
               <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="txtSearch">
                </div>
             </div>
             <div>
              <div  class="col-sm-4">
              </div>
          </div>
          </div>
        </div>

      <div>&nbsp;</div>
      <div class="col-sm-12">
      <div class="box box-warning">
      <div class="box-header with-border">
      <h3 class="box-title"><b><?=$subModule?></b></h3>
      </div>
      <table id="tblDisplay" class="table table-bordered table-hover">
      </table>
      </div>  
      </div>
        
    </section>


   <div class="modal fade" id="modal-input">
     <div class="modal-dialog" id="dvInput" style='max-width:800px;width:700px' >
      <div class="modal-content">
          <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?=$subModule?></h4>
           </div>
           <div class="modal-body" id="dvInputBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnSave" value="บันทึก"  class="btn btn-primary" data-dismiss="modal">
                  </div>
          </div>
      </div>
     </div>
   </div>

     <div class="modal fade" id="modal-search">
        <div class="modal-dialog" id="dvSearch">
           <div class="modal-content">
            <div class="box-header with-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Advance Search</h4>
           </div>
           <div class="modal-body" id="dvAdvBody">
           
           </div>
          <div>
                 <div class="modal-footer">
                    <input type="button" id="btnAdvClose" value="ปิด"  class="btn btn-default pull-left" data-dismiss="modal">
                    <input type="button" id="btnAdvSearch" value="ค้นหา"  class="btn btn-primary" data-dismiss="modal">
                  </div>
           </div>
        </div>
     </div>
   </div>
<script src="<?=$rootPath.'/'.$lastPath?>/jsExecute.js"></script>
<script>

 function loadInput(){
      var url="<?=$rootPath.'/'.$lastPath?>/input.php";
      $("#dvInputBody").load(url);
 }

function displayData(){
 
    var url="<?=$rootPath.'/'.$lastPath?>/displayData.php??keyWord="+$("#txtSearch").val()+"&userCode=<?=$userCode?>";
    $("#tblDisplay").load(url);
 }

 function loadPage(){
    loadInput();
    displayData();
 }

 //****************************************************************

function uploadFile(){
    if($("#obj_file").val()!=""){
              var file=$("#obj_file").val().split('\\').pop();
              var fileName =  "<?=$cnf->restURL?>uploads/"+$("#obj_id").val()+"/"+file;
              fileUpload("obj_file","../uploads/"+$("#obj_id").val());
              $("#obj_fileAttachment").val(fileName);
    }
  }

function createData(){
    var url='tproporsal/create.php';
    var userCode='<?=$userCode?>';
    jsonObj={
      proporsalName:$("#obj_proporsalName").val(),
      detail:$("#obj_detail").val(),
      userCode:userCode,
      createDate:$("#obj_createDate").val(),
      projectYear:$("#obj_projectYear").val(),
      status:0,
      notification:$("#obj_notification").val(),
      fileAttachment:$("#obj_fileAttachment").val(),
      fundSource:$("#obj_fundSource").val(),
      fundDescription:$("#obj_fundDescription").val(),

    }
    var jsonData=JSON.stringify (jsonObj);

    var flag=executeData(url,jsonObj,false);
    return flag;
}
function updateData(){
    var url='tproporsal/update.php';
    var userCode='<?=$userCode?>';

    jsonObj={
      proporsalName:$("#obj_proporsalName").val(),
      detail:$("#obj_detail").val(),
      userCode:userCode,
      createDate:$("#obj_createDate").val(),
      projectYear:$("#obj_projectYear").val(),
      status:0,
      notification:$("#obj_notification").val(),
      fileAttachment:$("#obj_fileAttachment").val(),
      fundSource:$("#obj_fundSource").val(),
      fundDescription:$("#obj_fundDescription").val(),
      id:$("#obj_id").val()
    }
    var jsonData=JSON.stringify (jsonObj);
    var flag=executeData(url,jsonObj,false);
    return flag;
}
function readOne(id){
    var url='tproporsal/readOne.php?id='+id;
    data=queryData(url);
    if(data!=""){
      $("#obj_proporsalName").val(data.proporsalName);
      $("#obj_detail").val(data.detail);
      $("#obj_createDate").val(data.createDate);
      $("#obj_projectYear").val(data.projectYear);
      $("#obj_notification").val(data.notification);
      $("#obj_fileAttachment").val(data.fileAttachment);
      $("#obj_fundSource").val(data.fundSource);
      $("#obj_fundDescription").val(data.fundDescription);
      $("#obj_id").val(data.id);
    }
}

function getMaxId(){
   var url="<?=$rootPath?>/tproporsal/getMaxId.php";
   var data=queryData(url);
   return data.mxId;
}

function saveData(){
    var flag;
    flag=true;
    if(flag==true){
          if($("#obj_id").val()!==""){
              uploadFile();
              flag=updateData();
          }else{
              var maxId=getMaxId()+1;
              $("#obj_id").val(maxId);
              uploadFile();
              flag=createData();
             
        }
    if(flag==true){
          swal.fire({
          title: "การบันทึกข้อมูลเสร็จสมบูรณ์แล้ว",
          type: "success",
          buttons: [false, "ปิด"],
          dangerMode: true,
    });
    displayData();
    }
    else{
          swal.fire({
          title: "การบันทึกข้อมูลผิดพลาด",
          type: "error",
          buttons: [false, "ปิด"],
          dangerMode: true,
    });
    }
    }else{
      swal.fire({
          title: "รูปแบบการกรอกข้อมูลไม่ถูกต้อง",
          type: "error",
          buttons: [false, "ปิด"],
          dangerMode: true,
          });
      }
}
function confirmDelete(id){
    swal.fire({
      title: "คุณต้องการที่จะลบข้อมูลนี้หรือไม่?",
      text: "***กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนกดปุ่มตกลง",
      type: "warning",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก",
      showCancelButton: true,
      showConfirmButton: true
    }).then((willDelete) => {
    if (willDelete.value) {
      url="tproporsal/delete.php?id="+id;
      executeGet(url,false,"");
      displayData();
    swal.fire({
      title: "ลบข้อมูลเรียบร้อยแล้ว",
      type: "success",
      buttons: "ตกลง",
    });
    } else {
      swal.fire({
      title: "ยกเลิกการทำรายการ",
      type: "error",
      buttons: [false, "ปิด"],
      dangerMode: true,
    })
    }
    });
}
function clearData(){
      $("#obj_proporsalName").val("");
      $("#obj_detail").val("");
      $("#obj_userCode").val("");
      $("#obj_createDate").val("");
      $("#obj_projectYear").val("");
      $("#obj_status").val("");
      $("#obj_notification").val("");
      $("#obj_fileAttachment").val("");
}

 //****************************************************************

 $( document ).ready(function() {
    loadPage();
    $("#btnInput").click(function(){
         clearData();
         $("#obj_projectYear").val('<?=$cYear?>');
         $("#obj_createDate").val('<?=$cDate?>');
         $("#modal-input").modal("toggle");

    });

    $("#txtSearch").change(function(){
        displayData();
    });

    $("#btnSave").click(function(){
        saveData();
    });

    //$("#")
 });

</script>
