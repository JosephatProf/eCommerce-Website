<?php
$machine = '127.0.0.1';
$dbname = 'newclinic';
$password = '';
$user = 'root';
$db = new mysqli($machine,$user,$password,$dbname);
if (mysqli_connect_errno()) {
	echo "Connection failed: ".mysqli_connect_error();
	exit();
}else{
	//echo 'Connected';
	return true;//if connection is successful
}

?>