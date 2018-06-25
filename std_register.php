<?php
	if(!empty($_POST['std_name']) && !empty($_POST['std_email']) && !empty($_POST['std_pwd'])){
		// connect to db
		require('db_conn.php');
		
		//prevent SQL injection
		$name = mysqli_real_escape_string($conn,$_POST['std_name']);
		$email = mysqli_real_escape_string($conn,$_POST['std_email']);
		$pwd = mysqli_real_escape_string($conn,$_POST['std_pwd']);

		// hashing password
		$hash = password_hash($pwd, PASSWORD_DEFAULT);


		$query = "insert into std_account(name,email,pwd) values('$name','$email','$hash');";

		$res = mysqli_query($conn,$query);
		
		if($res){
			echo "<script>window.alert('Registration Successful. Please Login');</script>";
		}
		else{
			echo "<script>window.alert('Registration Unsuccessful. Please Try Again');</script>";
		}

		echo "<script>window.location.href='index.php';</script>";

	}
?>