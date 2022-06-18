<?php
include 'replacestring.php'; 

if(isset($_POST['transstring'])){

	$rep_string = new Replacestring();
	$laststr=substr($_POST['transstring'], -1);

	if ($laststr=="?") {
		echo $rep_string->transformstring($_POST['transstring'],'?');
	}elseif ($laststr=="!") {
		echo $rep_string->transformstring($_POST['transstring'],'!');
	}else {
		echo $_POST['transstring'];
	} 

}



?>