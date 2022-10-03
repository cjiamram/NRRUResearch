var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDate.test($("#obj_createDate").val());
		if (flag==false){
				$("#obj_createDate").focus();
				return flag;
		}
		return flag;
}
function displayData(){
		var url="tproporsal/displayData.php?tableName=t_proporsal&dbName=dbresearch&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tproporsal/create.php';
		jsonObj={
			proporsalName:$("#obj_proporsalName").val(),
			detail:$("#obj_detail").val(),
			userCode:$("#obj_userCode").val(),
			createDate:$("#obj_createDate").val(),
			projectYear:$("#obj_projectYear").val(),
			status:$("#obj_status").val(),
			notification:$("#obj_notification").val(),
			fileAttachment:$("#obj_fileAttachment").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tproporsal/update.php';
		jsonObj={
			proporsalName:$("#obj_proporsalName").val(),
			detail:$("#obj_detail").val(),
			userCode:$("#obj_userCode").val(),
			createDate:$("#obj_createDate").val(),
			projectYear:$("#obj_projectYear").val(),
			status:$("#obj_status").val(),
			notification:$("#obj_notification").val(),
			fileAttachment:$("#obj_fileAttachment").val(),
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
			$("#obj_userCode").val(data.userCode);
			$("#obj_createDate").val(data.createDate);
			$("#obj_projectYear").val(data.projectYear);
			$("#obj_status").val(data.status);
			$("#obj_notification").val(data.notification);
			$("#obj_fileAttachment").val(data.fileAttachment);
			$("#obj_id").val(data.id);
		}
}
function saveData(){
		var flag;
		flag=validInput();
		if(flag==true){
					if($("#obj_id").val()!=""){
			flag=updateData();
			}else{
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
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
