<?php
include_once "keyWord.php";
class  tproporsal{
	private $conn;
	private $table_name="t_proporsal";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $proporsalName;
	public $detail;
	public $userCode;
	public $createDate;
	public $projectYear;
	public $status;
	public $notification;
	public $fileAttachment;
	public $fundSource;
	public $fundDescription;
	

	public function create(){
		$query='INSERT INTO t_proporsal  
        	SET 
			proporsalName=:proporsalName,
			detail=:detail,
			userCode=:userCode,
			createDate=:createDate,
			projectYear=:projectYear,
			status=:status,
			notification=:notification,
			fileAttachment=:fileAttachment,
			fundSource=:fundSource,
			fundDescription=:fundDescription
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":proporsalName",$this->proporsalName);
		$stmt->bindParam(":detail",$this->detail);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":projectYear",$this->projectYear);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":notification",$this->notification);
		$stmt->bindParam(":fileAttachment",$this->fileAttachment);
		$stmt->bindParam(":fundSource",$this->fundSource);
		$stmt->bindParam(":fundDescription",$this->fundDescription);
		$flag=$stmt->execute();
		return $flag;
	}
	

	public function update(){
		$query='UPDATE t_proporsal 
        	SET 
			proporsalName=:proporsalName,
			detail=:detail,
			userCode=:userCode,
			createDate=:createDate,
			projectYear=:projectYear,
			status=:status,
			notification=:notification,
			fileAttachment=:fileAttachment,
			fundSource=:fundSource,
			fundDescription=:fundDescription
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":proporsalName",$this->proporsalName);
		$stmt->bindParam(":detail",$this->detail);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":projectYear",$this->projectYear);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":notification",$this->notification);
		$stmt->bindParam(":fileAttachment",$this->fileAttachment);
		$stmt->bindParam(":fundSource",$this->fundSource);
		$stmt->bindParam(":fundDescription",$this->fundDescription);

		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getMaxId(){
		$query="SELECT MAX(id) AS MaxId FROM t_proporsal";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			return $MaxId;
		}
		return 0;
	}


	public function readOne(){
		$query="SELECT  id,
			proporsalName,
			detail,
			userCode,
			createDate,
			projectYear,
			status,
			notification,
			fileAttachment,
			fundSource,
			fundDescription
		FROM t_proporsal WHERE id=:id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord,$userCode){
		$query="SELECT  id,
			proporsalName,
			detail,
			userCode,
			createDate,
			projectYear,
			status,
			notification,
			fileAttachment,
			fundSource,
			fundDescription

		FROM t_proporsal 
		WHERE proporsalName LIKE :keyWord
		AND userCode=:userCode
		";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->bindParam(':userCode',$userCode);

		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_proporsal WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function genCode(){
		$curYear = date("Y")-2000+543;
		$curYear = substr($curYear,1,2);
		$curYear = sprintf("%02d", $curYear);
		$curMonth=date("n");
		$curMonth = sprintf("%02d",$curMonth);
		$prefix= $curYear .$curMonth;
		$query ="SELECT MAX(CODE) AS MXCode FROM t_proporsal WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>