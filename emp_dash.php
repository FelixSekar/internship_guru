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
				      	<a class="nav-link" href="#" data-toggle="modal" data-target="#hireModal">Hire Interns</a>
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

				<!-- Hire Modal -->
				<div class="modal fade" id="hireModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">Modal title</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<div class="container">		      	
						    	<!-- Hire form -->
						      <form method="POST" action="hire.php">
						      	<div class="form-group row">
						      		<label for="hire_title" class="col-form-label">Title: </label>
						      		<input id="hire_title" name="title" type="text" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="hire_cat" class="col-form-label">Category: </label>
						      		<select id="hire_cat" name="cat" class="form-control">
						      			<option>--select--</option>
						      			<option>Web Development</option>
						      			<option>3D Printing</option>
						      			<option>Marketing</option>
						      			<option>Law</option>
						      			<option>Architecture</option>
						      		</select>
						      	</div>
						      	<div class="form-group row">
						      		<label for="hire_apply_by" class="col-form-label">Apply By: </label>
						      		<input id="hire_apply_by" name="apply_by" type="date" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="hire_dur" class="col-form-label">Duration: </label>
						      		<input id="hire_dur" name="dur" type="int" class="form-control">
						      		<span>Months</span> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="hire_stipend" class="col-form-label">Stipend: </label>
						      		<input id="hire_stipend" name="stipend" type="int" class="form-control">
						      		</span>Rupees/month</span> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="hire_loc" class="col-form-label">Location: </label>
						      		<select id="hire_loc" name="loc" class="form-control">
						      			<option>--select--</option>
						      			<option>Work From Home</option>
						      			<option>Mumbai</option>
						      			<option>Navi Mumbai</option>
						      			<option>Bangalore</option>
						      			<option>Thane</option>
						      			<option>Delhi</option>
						      		</select>
						      	</div>
						      	<div class="form-group row">
						      		<label for="hire_des" class="col-form-label">Description: </label>
						      		<textarea id="hire_des" name="des" type="date" class="form-control" rows="4">
						      		</textarea> 
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="submit">
						      	</div>
						      </form>
						      <!-- form ends -->						    					
				      	</div>
				      </div>
				    </div>
				  </div>
				</div>

		<?php 
			require('db_conn.php');
			$query="select * from internships where emp_id=".$_SESSION['emp_id']." order by timestamp desc;";
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
								$emp_id=$row['emp_id'];
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
								    <p class="card-text">Category:<?php echo $cat ?></p>
								    <p class="card-text">Apply By:<?php echo $apply_by ?></p>
								    <p class="card-text">Duration:<?php echo $dur ?> Months</p>
								    <p class="card-text">Location:<?php echo $loc ?></p>
								    <p class="card-text">Description:<?php echo $des ?></p>
								    <p class="card-text">Stipend:<?php echo $stipend ?> Rupees/Month</p>
								    <p class="card-text"><?php echo $timestamp ?></p>
								    <p class="card-text">Status:<?php echo $status ?></p>
								    <div id="apply_div">
								    	<button class="apply_btn btn btn-primary" onclick="location.href='applicants.php?int_id=<?php echo $id?>';">Check for Interns</button>
								  	</div>
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
								<center>You Dont Have Any Internships</center>
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