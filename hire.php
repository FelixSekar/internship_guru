<?php
	session_start();
	if(isset($_SESSION['emp_id'])){

		require('db_conn.php');

		$title=mysqli_real_escape_string($conn,$_POST['title']);
		$cat=mysqli_real_escape_string($conn,$_POST['cat']);
		$apply_by=mysqli_real_escape_string($conn,$_POST['apply_by']);
		$stipend=mysqli_real_escape_string($conn,$_POST['stipend']);
		$dur=mysqli_real_escape_string($conn,$_POST['dur']);
		$loc=mysqli_real_escape_string($conn,$_POST['loc']);
		$des=mysqli_real_escape_string($conn,$_POST['des']);
		$emp_id=$_SESSION['emp_id'];


		$query="insert into internships(emp_id,title,category,apply_by,duration,location,des,stipend) values('$emp_id','$title','$cat','$apply_by','$dur','$loc','$des',$stipend);";

		$res=mysqli_query($conn,$query);

		if($res){
			echo "success";
			header('Location:emp_dash.php');
		}
		else{
			echo "unsuccessful";
			header('Location:emp_dash.php');
		}
	}
?>