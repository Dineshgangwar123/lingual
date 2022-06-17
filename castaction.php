<?php
session_start();
include 'config.php'; 

if(isset($_POST['castname'])){
	$data=array();
	$castname=$_POST['castname'];
	$castgender=$_POST['castgender'];
	$castcharacter=$_POST['castcharacter'];
	$castid=$_POST['castid'];
	mysqli_query($con,"update cast set castname='$castname',castgender='$castgender',cast_char_name='$castcharacter' where id='$castid' ");
	if (mysqli_affected_rows($con)>0) {
		$data['status']=1;
		$data['result']='Cast Successflly Updated';
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

if(isset($_POST['deletecast_id'])){
	$data=array();
	$deletecast_id=$_POST['deletecast_id'];
	mysqli_query($con,"delete from cast where id='$deletecast_id' ");
	if (mysqli_affected_rows($con)>0) {
		$data['status']=1;
		$data['result']='Cast Successflly Deleted';
	}else{
		$data['status']=0;
		$data['result']=$con->error;
	}
	header('Content-type: application/json');
	echo json_encode($data);
}


?>