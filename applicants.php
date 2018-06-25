<?php
	session_start();
	if(isset($_SESSION['emp_id'])){
?>
		<html>
			<head>
				<title>Internshala</title>
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

				<!-- jquery -->
				<script src="jquery.js"></script>
				
				<!-- bootstrap css and js -->
				<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />		
				<script src="bootstrap/js/bootstrap.min.js"></script>

			</head>
			<body>
				<!-- Navigation -->
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				  <a class="navbar-brand" href="#">Internshala</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav ml-auto">		      
				      <li class="nav-item">
				      	<a class="nav-link" href="emp_dash.php"="#hireModal">Home</a>
				      </li>
				      <li class="nav-item">
				      	<a class="nav-link" href="search.php">Internships</a>
				      </li>		      
				      <li class="nav-item">
				      	<a class="nav-link" href="logout.php">Logout</a>
				      </li>
				    </ul>
				  </div>
				</nav>

				

		<?php 
			$int_id=$_GET['int_id'];
			require('db_conn.php');
			$query="select * from applied a,std_account s where a.int_id=$int_id and a.std_id = s.id order by timestamp;";
			$result=mysqli_query($conn,$query);
		?>
		<br>		
		<div class="container-fluid">
	    <div class="row">
      	<div class="col-md-2">
      	</div>
      	<!--internship cards area-->
				<div class="col-md-8" id="internship">
					<?php
						if(mysqli_num_rows($result)>0)
						{	
							while($row=mysqli_fetch_array($result))
							{
								$id=$row['id'];
								$std_id=$row['std_id'];
								$name=$row['name'];
								$email=$row['email'];
								$app=$row['app'];
								$status=$row['status'];
								$timestamp=$row['timestamp'];
					?>
								<!--internship card-->
								<div class="card mb-3">
								  <div class="card-body">
								    <h5 class="card-text font-weight-bold"><?php echo $name ?></h5>
								    <p class="card-text">Email:<?php echo $email ?></p>
								    <p class="card-text">Status:<?php echo $status ?></p>
								    <p class="card-text">Applied On:<?php echo $timestamp ?></p>
								    <p class="card-text">Application:<?php echo $app ?></p>
								  </div>
								</div>
								<!--internship card ends-->
					<?php	
							}
						}
						else
						{
							echo '
							<div class="card mb-3">
								<div class="card-body">
								<center>No Applicants Yet.</center>
								</div>
							</div>';
						}
					?>
				</div>
	  	</div>
	  </div>		


		</body>
	</html>
<?php
	}
	else{
		echo "<script type='text/javascript'>alert('You need to Log In to access this Page');</script>";
		header('Location:index.php');
	}
?>