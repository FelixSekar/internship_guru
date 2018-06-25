<?php
	session_start();
	if(!empty($_POST['std_email']) && !empty($_POST['std_pwd'])){
		$email = $_POST['std_email'];
		$pwd = $_POST['std_pwd'];

		require('db_conn.php');

		$query = "select id,email,pwd from std_account where email='$email';";

		$res = mysqli_query($conn,$query);

		if(mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_assoc($res);
			
			if(password_verify($pwd,$row['pwd'])){
				$_SESSION['std_id']=$row['id'];
				header("Location:std_dash.php");
			}
			else{
				header("Location:index.php");
			}
		}
		else{
			echo "invalid email";
		}
	}

?>