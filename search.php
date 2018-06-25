<?php
	session_start();
	require('db_conn.php');
	if(isset($_GET['q'])){
		$q=$_GET['q'];
		$query="SELECT i.id,i.title,i.category,i.apply_by,i.duration,i.location,i.des,i.stipend,i.status,i.timestamp,e.cmp_name	FROM internships i,emp_account e WHERE i.title='$q'";
	}
	elseif(isset($_SESSION['std_id'])){
		$query = "SELECT i.id,i.title,i.category,i.apply_by,i.duration,i.location,i.des,i.stipend,i.status,i.timestamp,e.cmp_name FROM internships i,emp_account e WHERE i.emp_id=e.id and i.id NOT IN (SELECT int_id FROM applied WHERE std_id = {$_SESSION['std_id']}) ORDER BY i.id DESC;";		
	}
	else{
		$query = "SELECT i.id,i.title,i.category,i.apply_by,i.duration,i.location,i.des,i.stipend,i.status,i.timestamp,e.cmp_name FROM internships i,emp_account e WHERE i.status='Open' ORDER BY i.id DESC";
	}
	$result=mysqli_query($conn,$query);
?>


<html>
	<head>		      
    <!--Responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script src="jquery.js"></script>
    <style>
  	  #internship{
        padding: 4%;
      }

      .card {
				-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			}
			.card-title:hover{
				cursor: pointer;
				color: green;
			}
  	</style>
  	

  	<!--Font awesome-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
  	<!--Font awesome ends-->

  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

		<link rel="stylesheet" href="livesearch/livesearch.css">  	
  	<script src="livesearch/livesearch.js"></script>

  	<script>
  		$(document).ready(function(){
  			$(".apply_btn").click(function(){
  				<?php
  					if(isset($_SESSION['std_id'])){
  				?>
  						var apply_btn_id=$(this);
			  			var int_id = $(this).attr("id");
			  			$("#app_modal").modal();
			  			$("#modal_btn").click(function(){
			  				var app_txt = $("#app_txt").val();	  				
				  			$.ajax({
				  				url: 'apply.php',
					        type: 'post',
					        data: {id:int_id,app:app_txt},
					        dataType: 'text',
					        success: function(data){
					        	console.log(data);
					        	$("#app_txt").val("");
					        	$("#app_modal").modal('hide');
					        	alert(data);
					        	$(apply_btn_id).parent().empty().append("<span style='color:green'>APPLIED</span>");       	
					        }
				  			});  				
			  			});  					
  				<?php
  					}
	  				else{
	  					echo 'javascript:alert("You have to be logged In to Apply.");';
	  				}
  				?>
  			});
  		});

  	</script>

	</head>
	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="index.php">Internshala</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <?php
		      	if(!isset($_SESSION['std_id']) and !isset($_SESSION['emp_id'])){
		      		echo '
				      <li class="nav-item">
				        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal">Register</a>
				      </li>';
		      	}
		      	else{
		      		echo '
		      		<li class="nav-item">
				        <a class="nav-link" href="logout.php">Logout</a>
				      </li>';
		      	}
		      ?>
		    </ul>
		  </div>
		</nav>
		<br>
		<!-- navigation ends -->

		<?php
			if(!isset($_SESSION['std_id'])){
		?>
		<!-- Login Modal -->
		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						  <ul class="nav nav-tabs">
						    <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#std_lgo_tab">Student</a></li>
						    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#emp_log_tab">Employer</a></li>
						  </ul>
						  <div class="tab-content">
						    <div id="std_log_tab" class="tab-pane fade show active">
						    	<!-- student login form -->
						      <form method="POST" action="std_login_val.php">
						      	<div class="form-group row">
						      		<label for="std_log_email" class="col-form-label">Email: </label>
						      		<input id="std_log_email" name="std_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_log_pwd" class="col-form-label">Password: </label>
						      		<input id="std_log_pwd" name="std_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Login">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						    <div id="emp_log_tab" class="tab-pane fade">
						    	<!-- employer login form -->
						      <form method="POST" action="emp_login_val.php">
						      	<div class="form-group row">
						      		<label for="emp_log_email" class="col-form-label">Email: </label>
						      		<input id="emp_log_email" name="emp_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_log_pwd" class="col-form-label">Password: </label>
						      		<input id="emp_log_pwd" name="emp_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Login">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						  </div>
						</div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- login modal ends -->

		<!-- Register Modal -->
		<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
						  <ul class="nav nav-tabs">
						    <li class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#std_reg_tab">Student</a></li>
						    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#emp_reg_tab">Employer</a></li>
						  </ul>
						  <div class="tab-content">
						    <div id="std_reg_tab" class="tab-pane fade show active">
						    	<!-- student registration form -->
						      <form method="POST" action="std_register.php">
						      	<div class="form-group row">
						      		<label for="std_reg_name" class="col-form-label">Full Name: </label>
						      		<input id="std_reg_name" name="std_name" type="text" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_reg_email" class="col-form-label">Email: </label>
						      		<input id="std_reg_email" name="std_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_reg_pwd" class="col-form-label">Password: </label>
						      		<input id="std_reg_pwd" name="std_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<label for="std_cnf_pwd" class="col-form-label">Confirm Password: </label>
						      		<input id="std_cnf_pwd" type="password" class="form-control">
						      		<span id="std_cnf_msg"></span>
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Register">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						    <div id="emp_reg_tab" class="tab-pane fade">
						    	<!-- employer registration form -->
						      <form method="POST" action="emp_register.php">
						      	<div class="form-group row">
						      		<label for="emp_reg_cmpName" class="col-form-label">Company Name: </label>
						      		<input id="emp_reg_cmpName" name="emp_cmpName" type="text" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_reg_email" class="col-form-label">Email: </label>
						      		<input id="emp_reg_email" name="emp_email" type="email" class="form-control"> 
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_reg_pwd" class="col-form-label">Password: </label>
						      		<input id="emp_reg_pwd" name="emp_pwd" type="password" class="form-control">
						      	</div>
						      	<div class="form-group row">
						      		<label for="emp_cnf_pwd" class="col-form-label">Confirm Password: </label>
						      		<input id="emp_cnf_pwd" type="password" class="form-control">
						      		<span id="emp_cnf_msg"></span>
						      	</div>
						      	<div class="form-group row">
						      		<input type="submit" class="btn btn-primary" value="Register">
						      	</div>
						      </form>
						      <!-- form ends -->
						    </div>
						  </div>
						</div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Register modal ends -->

		<?php 
			}
		?>

		<!--Live Search-->
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="search-wrapper">
				<form id="search-form" method="GET" action="" style="position:relative">
				  <div class="input-group" id="search">
				    <input id="searh-input" type="text" name="q" class="form-control" placeholder="Search for a Internship" autocomplete="off" autofocus="autofocus">
				    <button id="search-btn" type="submit" class="btn btn-outline-primary"><i class="fas fa-search fa-2x"></i></button>
				  </div>
				  <div id="livesearch"></div>
				</form>
			</div>
		</div>
		<!--Live search ends-->

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
								$title=$row['title'];
								$cat=$row['category'];
								$apply_by=$row['apply_by'];
								$dur=$row['duration'];
								$loc=$row['location'];
								$des=$row['des'];
								$stipend=$row['stipend'];
								$status=$row['status'];
								$timestamp=$row['timestamp'];

								$cmp_name=$row['cmp_name'];
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
								    <div id="apply_div">
								    	<button id="<?php echo $id ?>" class="apply_btn btn btn-primary">Apply</button>
								  	</div>
								  </div>
								</div>
								<!--internship card ends-->
					<?php	
							}
						}
						else
						{
							echo "No internships found";
						}
					?>
				</div>
	  	</div>
	  </div>

	  <div class="modal fade" id="app_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Why should you be hired for this Internship ?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="container" id="modal_body">
						  <textarea id="app_txt" rows="5" class="form-control"></textarea>
						  <br>
							<button id="modal_btn" class="btn btn-primary">Apply</button>							
						</div>
		      </div>
		    </div>
		  </div>
		</div>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js " integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q " crossorigin="anonymous "></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>