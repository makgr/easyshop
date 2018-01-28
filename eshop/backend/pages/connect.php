<?php 

$host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'lict_getco_db';

$con = mysqli_connect($host, $db_user, $db_password, $db_name);

//$con = new Mysql($host, $db_user, $db_password, $db_name);

if(!$con){
	//echo 'Connection failed. '.mysqli_error($con);
}else{
	//echo 'Connected.';
}
 
?>