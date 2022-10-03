<?php
include_once "keyWord.php";
class  tresearch{
	private $conn;
	private $table_name="t_research";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $researchCode;
	public $abstract;
	public $fundSource;
	public $budget;
	public $progressStatus;
	public $startDate;
	public $deuDate;
	public $ownerProject;
	public $topic;
	public function create(){
		$query='INSERT INTO t_research  
        	SET 
			researchCode=:researchCode,
			abstract=:abstract,
			fundSource=:fundSource,
			budget=:budget,
			progressStatus=:progressStatus,
			startDate=:startDate,
			deuDate=:deuDate,
			ownerProject=:ownerProject,
			topic=:topic
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":researchCode",$this->researchCode);
		$stmt->bindParam(":abstract",$this->abstract);
		$stmt->bindParam(":fundSource",$this->fundSource);
		$stmt->bindParam(":budget",$this->budget);
		$stmt->bindParam(":progressStatus",$this->progressStatus);
		$stmt->bindParam(":startDate",$this->startDate);
		$stmt->bindParam(":deuDate",$this->deuDate);
		$stmt->bindParam(":ownerProject",$this->ownerProject);
		$stmt->bindParam(":topic",$this->topic);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_research 
        	SET 
			researchCode=:researchCode,
			abstract=:abstract,
			fundSource=:fundSource,
			budget=:budget,
			progressStatus=:progressStatus,
			startDate=:startDate,
			deuDate=:deuDate,
			ownerProject=:ownerProject,
			topic=:topic
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":researchCode",$this->researchCode);
		$stmt->bindParam(":abstract",$this->abstract);
		$stmt->bindParam(":fundSource",$this->fundSource);
		$stmt->bindParam(":budget",$this->budget);
		$stmt->bindParam(":progressStatus",$this->progressStatus);
		$stmt->bindParam(":startDate",$this->startDate);
		$stmt->bindParam(":deuDate",$this->deuDate);
		$stmt->bindParam(":ownerProject",$this->ownerProject);
		$stmt->bindParam(":topic",$this->topic);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			researchCode,
			abstract,
			fundSource,
			budget,
			progressStatus,
			startDate,
			deuDate,
			ownerProject,
			topic
		FROM t_research WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord,$userCode){

		$query="SELECT  id,
			researchCode,
			abstract,
			fundSource,
			budget,
			progressStatus,
			startDate,
			deuDate,
			ownerProject,
			topic
		FROM t_research WHERE CONCAT(researchCode,' ',topic) LIKE :keyWord 
		AND ownerProject=:userCode
		";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->bindParam(':userCode',$userCode);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_research WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_research WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>