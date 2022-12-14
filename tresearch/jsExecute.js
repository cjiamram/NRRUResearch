var regDec = /^\d+(\.\d{1,2})?$/;
var regEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
var regTel=/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
var regDate=/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/;
function validInput(){
		var flag=true;
		flag=regDec.test($("#obj_budget").val());
		if (flag==false){
			$("#obj_budget").focus();
			return flag;
}
		flag=regDate.test($("#obj_startDate").val());
		if (flag==false){
				$("#obj_startDate").focus();
				return flag;
		}
		flag=regDate.test($("#obj_deuDate").val());
		if (flag==false){
				$("#obj_deuDate").focus();
				return flag;
		}
		return flag;
}
function displayData(){
		var url="tresearch/displayData.php?tableName=t_research&dbName=dbresearch&keyWord="+$("#txtSearch").val();
		$("#tblDisplay").load(url);
}
function createData(){
		var url='tresearch/create.php';
		jsonObj={
			researchCode:$("#obj_researchCode").val(),
			abstract:$("#obj_abstract").val(),
			fundSource:$("#obj_fundSource").val(),
			budget:$("#obj_budget").val(),
			progressStatus:$("#obj_progressStatus").val(),
			startDate:$("#obj_startDate").val(),
			deuDate:$("#obj_deuDate").val(),
			ownerProject:$("#obj_ownerProject").val(),
			topic:$("#obj_topic").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function updateData(){
		var url='tresearch/update.php';
		jsonObj={
			researchCode:$("#obj_researchCode").val(),
			abstract:$("#obj_abstract").val(),
			fundSource:$("#obj_fundSource").val(),
			budget:$("#obj_budget").val(),
			progressStatus:$("#obj_progressStatus").val(),
			startDate:$("#obj_startDate").val(),
			deuDate:$("#obj_deuDate").val(),
			ownerProject:$("#obj_ownerProject").val(),
			topic:$("#obj_topic").val(),
			id:$("#obj_id").val()
		}
		var jsonData=JSON.stringify (jsonObj);
		var flag=executeData(url,jsonObj,false);
		return flag;
}
function readOne(id){
		var url='tresearch/readOne.php?id='+id;
		data=queryData(url);
		if(data!=""){
			$("#obj_researchCode").val(data.researchCode);
			$("#obj_abstract").val(data.abstract);
			$("#obj_fundSource").val(data.fundSource);
			$("#obj_budget").val(data.budget);
			$("#obj_progressStatus").val(data.progressStatus);
			$("#obj_startDate").val(data.startDate);
			$("#obj_deuDate").val(data.deuDate);
			$("#obj_ownerProject").val(data.ownerProject);
			$("#obj_topic").val(data.topic);
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
			title: "?????????????????????????????????????????????????????????????????????????????????????????????",
			type: "success",
			buttons: [false, "?????????"],
			dangerMode: true,
		});
		displayData();
		}
		else{
			swal.fire({
			title: "??????????????????????????????????????????????????????????????????",
			type: "error",
			buttons: [false, "?????????"],
			dangerMode: true,
		});
		}
		}else{
			swal.fire({
			title: "???????????????????????????????????????????????????????????????????????????????????????",
			type: "error",
			buttons: [false, "?????????"],
			dangerMode: true,
			});
			}
}
function confirmDelete(id){
		swal.fire({
			title: "????????????????????????????????????????????????????????????????????????????????????????????????????",
			text: "***??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????",
			type: "warning",
			confirmButtonText: "????????????",
			cancelButtonText: "??????????????????",
			showCancelButton: true,
			showConfirmButton: true
		}).then((willDelete) => {
		if (willDelete.value) {
			url="tresearch/delete.php?id="+id;
			executeGet(url,false,"");
			displayData();
		swal.fire({
			title: "???????????????????????????????????????????????????????????????",
			type: "success",
			buttons: "????????????",
		});
		} else {
			swal.fire({
			title: "???????????????????????????????????????????????????",
			type: "error",
			buttons: [false, "?????????"],
			dangerMode: true,
		})
		}
		});
}
function clearData(){
			$("#obj_researchCode").val("");
			$("#obj_abstract").val("");
			$("#obj_fundSource").val("");
			$("#obj_budget").val("");
			$("#obj_progressStatus").val("");
			$("#obj_startDate").val("");
			$("#obj_deuDate").val("");
			$("#obj_ownerProject").val("");
			$("#obj_topic").val("");
}
function genCode(){
		//var url="genCode.php";
		//var data=queryData(url);
		//return data.code;
}
