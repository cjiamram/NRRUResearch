<?php

	include_once "config/config.php";
	include_once 'config/database.php';
	include_once 'objects/menu.php';
	
	class MenuRendering{
			public $rootPath;
			public $menu;

			public function __construct($db){
            		//$this->conn = $db;
            		$this->cnf=new Config();
            		$menu=new Menu($db);
            		//$stmt=$menu->getHeadMenu('Admin');
            		//print_r($stmt->rowCount());
        	}
			

			public function renderChildMenu($userCode,$parentMenu){
				$stmt=$menu->getChildMenu($userCode,$parentMenu);
				$strChild="";
				$num=$stmt->rowCount();
				$i=0;
				if($num>0){
					while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						
							$strChild.=($i===0)?"<li class=\"active\">\n":"<li>\n";
							$strChild.="<a href='#' onclick='clickMenu(\"$Link\")'>".$MenuName."</a>\n";
				   			$strChild.="</li>\n";
			   		
						$i++;

					}
				}

				return $strChild;

			}

			public function renderHeadMenu($userCode){
					//print_r($userCode);
					$stmt=$this->menu->getHeadMenu($userCode);
					//print_r($this->userCode);
					$strMenu="";
					if($stmt->rowCount()>0){
						while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
							$extract($row);
							$strMenu.="<li class='nav-item dropdown'>\n";
								$strMenu.="<a class='dropdown-toggle' href='javascript:void(0);'>\n";
								$strMenu.="<span class='icon-holder'>\n";
								$strMenu.="<i class='$Icon'></i>\n";
								$strMenu.="</span>\n";
								$strMenu.="<span class='title'>$MenuName</span>\n";
								$strMenu.="<span class='arrow'>\n";
								$strMenu.="<i class='mdi mdi-chevron-right'></i>\n";
								$strMenu.="</span>\n";
								$strMenu.="</a>\n";
								$strMenu.="<ul class='dropdown-menu'>\n";
								$strMenu.= $this->renderChildMenu($userCode,$parentMenu);
								$strMenu.="</ul>\n";
							$strMenu.="</li>\n";
						}
					}

					return $strMenu;
			}


			public function renderExit(){
					$strExit="<li class='nav-item'>\n";
					$strExit.="<a href='#' onclick='logout()'>\n";
					$strExit.="<span class='icon-holder'>\n";
					$strExit.="<i class='mdi mdi-logout'></i>\n";
					$strExit.="</span>\n";
					$strExit.="<span class='title'>ออกจากระบบ</span>";
					$strExit.="</a>\n";
					$strExit.="</li>\n";
					return $strExit;
		}


	}


	


?>