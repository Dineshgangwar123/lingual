<?php
session_start();
include 'config.php'; 

if(isset($_POST['movieduration'])){
	$data=array();
	$moviename=$_POST['moviename'];
	$movieduration=$_POST['movieduration'];
	mysqli_query($con,"INSERT INTO `movie`(`moviename`, `movieduration`) VALUES('$moviename','$movieduration')");
	if ($con->insert_id>0) {
		$lastmovieid=$con->insert_id;
		$qrycast="INSERT INTO `cast`(`movieid`, `castname`, `castgender`, `cast_char_name`) VALUES";
		for ($i=0; $i <count($_POST['castname']) ; $i++) { 
			$castname=$_POST['castname'][$i];
			$castgender=$_POST['castgender'][$i];
			$castcharacter=$_POST['castcharacter'][$i];
			if ($i==0) {
				$qrycast.="('$lastmovieid','$castname','$castgender','$castcharacter')";
			}else{
				$qrycast.=", ('$lastmovieid','$castname','$castgender','$castcharacter')";
			}
		} 
		mysqli_query($con,$qrycast);
		$qrydialogue="INSERT INTO `dialogue`( `movieid`, `starttime`, `endtime`, `char_name`, `dialogue`) VALUES";
		for ($i=0; $i <count($_POST['dstarttime']) ; $i++) { 
			$starttime=$_POST['dstarttime'][$i];
			$endtime=$_POST['dendtime'][$i];
			$char_name=$_POST['dcharactername'][$i];
			$dialogue=mysqli_real_escape_string($con,$_POST['dialogue'][$i]);
			if ($i==0) {
				$qrydialogue.="('$lastmovieid','$starttime','$endtime','$char_name','$dialogue')";
			}else{
				$qrydialogue.=", ('$lastmovieid','$starttime','$endtime','$char_name','$dialogue')";
			}
		} 

		mysqli_query($con,$qrydialogue);
		if ($con->error!='') {
			$data['status']=0;
		    $data['result']=$con->error;
		}else{
			$data['status']=1;
		    $data['result']='Movie Successflly added';
		}
		
	}else{
		$data['status']=0;
		$data['result']=$con->error;
	}
header('Content-type: application/json');
echo json_encode($data);
}


if(isset($_POST['moviedurationupdate'])){
	$data=array();
	$moviename=$_POST['moviename'];
	$movieduration=$_POST['moviedurationupdate'];
	$movieid=$_POST['movieid'];
	mysqli_query($con,"update movie set moviename='$moviename',movieduration='$movieduration' where id='$movieid' ");
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

if(isset($_POST['deletemovie_id'])){
	$data=array();
	$deletemovie_id=$_POST['deletemovie_id'];
	mysqli_query($con,"delete from movie where id='$deletemovie_id' ");
	if (mysqli_affected_rows($con)>0) {
		$data['status']=1;
		$data['result']='Movie Successflly Deleted';
	}else{
		$data['status']=0;
		$data['result']=$con->error;
	}
    header('Content-type: application/json');
	echo json_encode($data);
}

?>