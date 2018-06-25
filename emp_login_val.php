<?php
	session_start();
	if(!empty($_POST['emp_email']) && !empty($_POST['emp_pwd'])){
		$email = $_POST['emp_email'];
		$pwd = $_POST['emp_pwd'];

		require('db_conn.php');

		$query = "select id,email,pwd from emp_account where email='".$email."';";

		$res = mysqli_query($conn,$query);

		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_assoc($res);
			
			if(password_verify($pwd,$row['pwd'])){
				$_SESSION['emp_id']=$row['id'];
				header("Location:emp_dash.php");
			}
			else{
				header("Location:index.php");
			}
		}
		else{
			echo "<script type='text/javascript'>alert('Invalid Email');</script>";
		}
	}

?>