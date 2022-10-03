<?php
include_once "config/config.php";
$cnf=new Config();
session_start();

function clear($permanent = false)
{
	$key=$_SESSION["id"];
		/*if (isset($_COOKIE[$key])) {
			    unset($_COOKIE[$key]);
			    setcookie($key, '', time() - 3600, '/'); // empty value and old timestamp
			}*/
	unset($_COOKIE['fpc=AnsVOpIQQ2JDvqI7kLO-Oxk']);

    session_destroy();
    session_unset();
	session_destroy();
}


clear(false);

header("location:".$cnf->restURL);


?>

<script>
		
</script>