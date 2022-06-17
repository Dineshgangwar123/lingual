<?php
session_start();
include 'config.php'; 

if(isset($_POST['dstarttime'])){
	$data=array();
	$starttime=$_POST['dstarttime'];
	$dialogueid=$_POST['dialogueid'];
	$endtime=$_POST['dendtime'];
	$char_name=$_POST['dcharactername'];
	$dialogue=mysqli_real_escape_string($con,$_POST['dialogue']);
	mysqli_query($con,"update dialogue set starttime='$starttime',endtime='$endtime',char_name='$char_name',dialogue='$dialogue' where id='$dialogueid' ");
	if (mysqli_affected_rows($con)>0) {
		$data['status']=1;
		$data['result']='Dialogue Successflly Updated';
	}else{
		$data['status']=0;
		if ($con->error=='') {
			$data['result']='Change somthing to update';
		}else{
			$data['result']=$con->error;
		}
		
	}

    header('Content-type: application/json');
	echo json_encode($data);
}

if(isset($_POST['deletedialogue_id'])){
	$data=array();
	$deletedialogue_id=$_POST['deletedialogue_id'];
	mysqli_query($con,"delete from dialogue where id='$deletedialogue_id' ");
	if (mysqli_affected_rows($con)>0) {
		$data['status']=1;
		$data['result']='Dialogue Successflly Deleted';
	}else{
		$data['status']=0;
		$data['result']=$con->error;
	}
    header('Content-type: application/json');
	echo json_encode($data);
}


?>