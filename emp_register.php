<?php
	if(!empty($_POST['emp_cmpName']) && !empty($_POST['emp_email']) && !empty($_POST['emp_pwd'])){
		// connect to db
		require('db_conn.php');
		
		//prevent SQL injection
		$cmpName = mysqli_real_escape_string($conn,$_POST['emp_cmpName']);
		$email = mysqli_real_escape_string($conn,$_POST['emp_email']);
		$pwd = mysqli_real_escape_string($conn,$_POST['emp_pwd']);

		// hashing password
		$hash = password_hash($pwd, PASSWORD_DEFAULT);

		$query = "insert into emp_account(cmp_name,email,pwd) values('$cmpName','$email','$hash');";

		$res = mysqli_query($conn,$query);

		if($res){
			echo "<script>window.alert('Registration Successful. Please Login');</script>";
		}
		else{
			echo "<script>window.alert('Registration Unsuccessful. Please Try Again');</script>";
		}


		header("Location:index.php");

	}
?>