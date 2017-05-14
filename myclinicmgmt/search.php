<?php
require 'db/db.php';
if(isset($_POST['search_name']) && !empty($_POST['search_name'])){
	$search_name=$_POST['search_name'];
	if(strlen($search_name)>=2){
	$sql="SELECT `pNo` FROM `patients` WHERE `pNo` LIKE  '%".$search_name."%'";
	$sql_run=$db->query($sql);
	$sql_num_rows=mysqli_num_rows($sql_run);
	if($sql_num_rows  >= 1){
		while($sql_fetch = $sql_run->fetch_assoc()){
			echo $sql_fetch['pNo'].'<br>';
		}


	}else{
		echo 'No results found';
	}
}else{
	echo 'Input string must be 4 characters and above.';
}
}
?>
