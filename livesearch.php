<?php
	require('./db_conn.php');
	$q=$_POST['query'];;
	//$q="ma";
	$array=array();

	$query="SELECT title FROM internships WHERE title LIKE '$q%';";
	
	$result=mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0){
		while($int=mysqli_fetch_array($result)){
			$array[]=$int['title'];
		}
		echo json_encode($array);
	}
	else{
		echo json_encode($array);
	}	
?>