<?php
	session_start();
	if(isset($_SESSION['std_id'])){
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
				  <a class="navbar-brand" href="#">Internshala	</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav ml-auto">		      
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
			require('db_conn.php');
			$query="SELECT i.id,i.title,i.category,i.apply_by,i.duration,i.location,i.des,i.stipend,i.status,i.timestamp,e.cmp_name FROM internships i,emp_account e WHERE i.emp_id=e.id and i.id IN (SELECT int_id FROM applied WHERE std_id = {$_SESSION['std_id']}) ORDER BY i.id DESC;";
			$result=mysqli_query($conn,$query);
		?>
		<br>		
		<div class="container-fluid">
	    <div class="row">
      	<div class="col-md-2">
      	</div>
      	<!--internship cards area-->
				<div class="col-md-8" id="internship">
					<div class="card mb-3">
						<div class="card-body">
						<center><b>Applied Internships</b></center>
						</div>
					</div>
					<?php
						if(mysqli_num_rows($result)>0)
						{	
							while($row=mysqli_fetch_array($result))
							{
								$id=$row['id'];
								$cmp_name=$row['cmp_name'];
								$title=$row['title'];
								$cat=$row['category'];
								$apply_by=$row['apply_by'];
								$dur=$row['duration'];
								$loc=$row['location'];
								$des=$row['des'];
								$stipend=$row['stipend'];
								$status=$row['status'];
								$timestamp=$row['timestamp'];
					?>
								<!--internship card-->
								<div class="card mb-3">
								  <div class="card-body">
								    <h5 class="card-text font-weight-bold"><?php echo $title ?></h5>
								    <p class="card-text">Company:<b><?php echo $cmp_name ?></b></p>
								    <p class="card-text">Category:<?php echo $cat ?></p>
								    <p class="card-text">Apply By:<?php echo $apply_by ?></p>
								    <p class="card-text">Duration:<?php echo $dur ?> Months</p>
								    <p class="card-text">Location:<?php echo $loc ?></p>
								    <p class="card-text">Description:<?php echo $des ?></p>
								    <p class="card-text">Stipend:<?php echo $stipend ?> Rupees/Month</p>
								    <p class="card-text"><?php echo $timestamp ?></p>
								    <p class="card-text">Status:<?php echo $status ?></p>
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
								<center>You Have Not Applied For Any Internships</center>
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