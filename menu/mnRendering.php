<?php
	
	include_once  "../objects/menu.php";
	include_once "../config/config.php";
	include_once "../config/database.php";

	$database=new Database();
	$db=$database->getConnection();
	$cnf=new Config();
	$menu=new Menu($db);

	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"Admin";


			function renderChildMenu($menu,$userCode,$parentMenu){
				$stmt=$menu->getChildMenu($userCode,$parentMenu);
				$strChild="";
				$num=$stmt->rowCount();
				$i=0;
				if($num>0){
					while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row);
						
							$strChild.=($i===0)?"<li class=\"active\">\n":"<li>\n";
							$strChild.="<a href='#' onclick='clickMenu(\"$Link\")'>$MenuName</a>\n";
				   			$strChild.="</li>\n";
			   		
						$i++;

					}
				}

				return $strChild;

			}



			function renderHeadMenu($menu,$userCode){
					$stmt=$menu->getHeadMenu($userCode);
					$strMenu="";
					if($stmt->rowCount()>0){
						while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
							extract($row);
							$strMenu.="<li class='nav-item dropdown'>\n";
								$strMenu.="<a class='dropdown-toggle' href='javascript:void(0);'>\n";
								$strMenu.="<span class='icon-holder'>\n";
								$strMenu.="<i class='".$Icon."'></i>\n";
								$strMenu.="</span>\n";
								$strMenu.="<span class='title'>".$MenuName."</span>\n";
								$strMenu.="<span class='arrow'>\n";
								
								$strMenu.="<i class='mdi mdi-chevron-right'></i>\n";
								$strMenu.="</span>\n";
								$strMenu.="</a>\n";
								$strMenu.="<ul class='dropdown-menu'>\n";
								$strMenu.= renderChildMenu($menu,$userCode,$MenuId);
								$strMenu.="</ul>\n";
							$strMenu.="</li>\n";
						}
					}

					return $strMenu;
			}


			function renderExit(){
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


		    echo renderHeadMenu($menu,$userCode);
		    echo renderExit();





?>