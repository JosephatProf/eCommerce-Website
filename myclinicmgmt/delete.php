<?php
require_once 'db/db.php';
if(isset($_GET['id']) && is_numeric($_GET['id'])){
		$patientNo=$_GET['id'];
		$delete=$db->query("DELETE FROM patients WHERE id='$patientNo'");
		if($delete){
			//echo 'One row successfully deleted';
			header('Location:dashboard.php');
		}else{
			echo 'Error in deleting the record.';
		}
	}
?>