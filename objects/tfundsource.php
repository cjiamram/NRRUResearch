<?php
include_once "keyWord.php";
class  tfundsource{
	private $conn;
	private $table_name="t_fundsource";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $fundSource;
	public function create(){
		$query='INSERT INTO t_fundsource  
        	SET 
			code=:code,
			fundSource=:fundSource
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":fundSource",$this->fundSource);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_fundsource 
        	SET 
			code=:code,
			fundSource=:fundSource
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":fundSource",$this->fundSource);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			fundSource
		FROM t_fundsource WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
		//$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		//$key=($key!="")?$key:"keyWord";
		$query="SELECT  id,
			code,
			fundSource
		FROM t_fundsource ";
		$stmt = $this->conn->prepare($query);
		//$keyWord="%{$keyWord}%";
		//$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_fundsource WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_fundsource WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>