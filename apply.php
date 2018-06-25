<?php
	session_start();
	$std_id=$_SESSION['std_id'];
	$int_id=$_POST['id'];
	$app_txt=$_POST['app'];

	require('db_conn.php');
	$query="insert into applied(std_id,int_id,app) values($std_id,$int_id,'$app_txt');";
	$res=mysqli_query($conn,$query);
	if($res){
		$msg="Success";
	}
	else{
		$msg="Unsuccessful. Please try again";
	}
	echo json_encode($msg);
?>