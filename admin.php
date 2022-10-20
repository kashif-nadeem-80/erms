<?php
include('includes/db.php');
include('includes/css_links.php');
session_start();
ob_start();
// echo $_SESSION["admin"];
// print_r($_SESSION);
if(isset($_SESSION['admin']))
{
	echo "<script>window.location.href = 'pages/administrator/dashboard.php'; </script>";
}
elseif(isset($_SESSION['executive']))
{
	echo "<script>window.location.href = 'pages/executive/dashboard.php'; </script>";
}
elseif(isset($_SESSION['DataEntryOperator']))
{
	echo "<script>window.location.href = 'pages/data_entry_operator/dashboard.php'; </script>";
}
elseif(isset($_SESSION['deskOperator']))
{
	echo "<script>window.location.href = 'pages/desk_operator/dashboard.php'; </script>";
}
else
{
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
		<style type="text/css">
		#reg:hover {
		font-size: 30px;
		}
		body {
		/* background-image: url(images/logibnBG.jpg); */
		background-image: url(images/loginbg.jpg); background-repeat: no-repeat;
		}
		html {
		overflow-x: hidden !important;
		}
		</style>
		<title>UTS || Sign In</title>
		<link rel="shortcut icon" href="images/logo.png" type="image/png">
	</head>
	<body>
		<div class="row">
			<div class="col-md-12" style="margin-top: 2%">
				<h3 class="text-white">
				<center><br></center>
				</h3>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="card border-primary shadow-lg">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<center>
										<h3 style="font-family: Time New Roman" class="text-info">Universal Testing
										Services</h3>
										</center>
										<div class="card shadow-lg">
											<div class="card-body">
												<form method="post">
													<div class="row">
														<div class="col-md-2"></div>
														<div class="col-md-8"><br>
															<select class="form-control shadow" name="role_id" required>
																<option value="">-- Select Role --</option>
																<?php
																	$data = "SELECT * FROM roles";
																	$run = mysqli_query($connection,$data);
																	while ($row = mysqli_fetch_array($run)) {
																		$id = $row['id'];
																		$role = $row['role_name'];
																		echo "<option value='$id'>$role</option>";
																	}
																?>
															</select>
														</div>
														<div class="col-md-2"></div>
													</div><br>
													<div class="row">
														<div class="col-md-2"></div>
														<div class="col-md-8">
															<input type="text" class="form-control shadow"
															placeholder="Username / email" name="managusername"
															value="<?php if(isset($_COOKIE["rememberAcount"])) { echo $_COOKIE["rememberAcount"]; } ?>"
															required>
														</div>
														<div class="col-md-2"></div>
													</div><br>
													<div class="row">
														<div class="col-md-2"></div>
														<div class="col-md-8">
															<input type="password" class="form-control shadow"
															placeholder="Password" name="managpassword"
															value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"
															required>
														</div>
														<div class="col-md-2"></div>
													</div><br>
													<div class="row">
														<div class="col-md-2"></div>
														<div class="col-md-8">
															<input type="checkbox" name="remember"> <b
															style="color: grey">Remember Me</b>
														</div>
														<div class="col-md-2"></div>
													</div><br><br>
													<div class="row">
														<div class="col-md-12">
															<center>
															<button name="login" style="width:250px ;"
															class="btn btn-info shadow text-white"><b>Sign
															In</b></button><br>
															<a class="float-right" href="#newUser"
															data-toggle='modal'><u>Register Here</u></a>
															</center>
														</div>
													</div>
												</form>
												<?php
													if (isset($_POST["login"]))
													{
														$username = $_POST["managusername"];
														$password = $_POST["managpassword"];
														$role_id  = $_POST['role_id'];
														$fetchData = "SELECT * FROM management_users WHERE (email = '$username' OR username = '$username') AND password = '$password' AND role_id = '$role_id'";
														$runData = mysqli_query($connection,$fetchData);
														$countData = mysqli_num_rows($runData);
														if($countData != 0)
														{
															$rowData  = mysqli_fetch_array($runData);
															$user_id  = $rowData['id'];
															$status = $rowData['status'];
															
															if($status == '1')
															{
																// ======== Admin =============
																if($role_id == '1')
																{
																	$_SESSION["admin"] = $user_id;
																
																	if(isset($_SESSION["admin"]))
																	{
																		if(!empty($_POST["remember"]))
														
														
																		{
																			setcookie("rememberAcount",$username,time()+ (10 * 365 * 24 * 60 * 60));
																			setcookie("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
																		}
																		else
																		{
																			if(isset($_COOKIE["rememberAcount"]))
																			{
																				setcookie ("rememberAcount","");
																			}
																			if(isset($_COOKIE["member_password"]))
																			{
																				setcookie ("member_password","");
																			}
																		}
																		echo "<script>window.location.href = 'pages/administrator/dashboard.php'; </script>";
																	}
																}
																// =======Executive===============
																elseif($role_id == '2')
																{
																	$_SESSION["executive"] = $user_id;
																	if(isset($_SESSION["executive"]))
																	{
																		if(!empty($_POST["remember"]))
																		{
																		setcookie ("rememberAcount",$username,time()+ (10 * 365 * 24 * 60 * 60));
																		setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
																		}
																		else
																		{
																			if(isset($_COOKIE["rememberAcount"]))
																			{
																				setcookie ("rememberAcount","");
																			}
																			if(isset($_COOKIE["member_password"]))
																			{
																				setcookie ("member_password","");
																			}
																		}
																	}
																	echo "<script>window.location.href = 'pages/executive/dashboard.php'; </script>";
																}
																// =======Data Entry Operator==========
																elseif($role_id == '3')
																{
																	$_SESSION["DataEntryOperator"] = $user_id;
																	if(isset($_SESSION["DataEntryOperator"]))
																	{
																		if(!empty($_POST["remember"]))
																		{
																			setcookie ("rememberAcount",$username,time()+ (10 * 365 * 24 * 60 * 60));
																			setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
																		}
																		else
																		{
																			if(isset($_COOKIE["rememberAcount"]))
																			{
																				setcookie ("rememberAcount","");
																			}
																			if(isset($_COOKIE["member_password"]))
																			{
																				setcookie ("member_password","");
																			}
																		}
																		echo "<script>window.location.href = 'pages/data_entry_operator/dashboard.php'; </script>";
																	}
																}
																// ========Desk Operator=============
																elseif($role_id == '4')
																{
																	$_SESSION["deskOperator"] = $user_id;
																	if(isset($_SESSION["deskOperator"]))
																	{
																		if(!empty($_POST["remember"]))
																		{
																			setcookie ("rememberAcount",$username,time()+ (10 * 365 * 24 * 60 * 60));
																			setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
																		}
																		else
																		{
																			if(isset($_COOKIE["rememberAcount"]))
																			{
																				setcookie ("rememberAcount","");
																			}
																			if(isset($_COOKIE["member_password"]))
																			{
																				setcookie ("member_password","");
																			}
																		}
																		echo "<script>window.location.href = 'pages/desk_operator/dashboard.php'; </script>";
																	}
																}
															}
															else
															{
																echo "<span class='text-danger'><center>Your account created but not approved please contact with Administrator</center></span>";
															}
														// ==========  All user end here ================
														}
														//========= Wrong Username Or Password ===============
														else
														{
														echo "<span class='text-danger'><center>Email or Password is Incorrect</center></span>";
														}
													}
												?>
												</div><!-- form card body end -->
												</div><!-- form card -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</body>
		</html>
		<script src="plugins/jquery/jquery.min.js"></script>
		<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
		<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-100 w-75" role="document">
				<div class="modal-content">
					<center class="bg-info text-white">
					<h2>Sign Up</h2>
					</center>
					<form method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<label>Role</label>
									<select class="form-control" autocomplete="off" required name="role_idd">
										<option value="">-- Select Role --</option>
										<?php
											$data = "SELECT * FROM roles";
											$run = mysqli_query($connection,$data);
											while ($row = mysqli_fetch_array($run)) {
											$id = $row['id'];
											$role = $row['role_name'];
											echo "<option value='$id'>$role</option>";
											}
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label>Name</label>
									<input type="text" name="namee" placeholder="Name" class="form-control" autocomplete="off"
									required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label>Username</label>
									<input type="text" name="usernamee" id="username" onchange="ajaxCall1()"
									placeholder="username" class="form-control" autocomplete="off" required>
									<p id="false" style="display: none; color: red">This username already taken</p>
								</div>
								<div class="col-md-6">
									<label>Email</label>
									<input type="email" name="emaill" placeholder="Email" class="form-control"
									autocomplete="off" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label>Password</label>
									<input type="password" name="passwordd" placeholder="Password" class="form-control"
									autocomplete="off" required>
								</div>
								<div class="col-md-6">
									<label>Contact</label>
									<input type="text" name="contactt" placeholder="Contact" class="form-control"
									autocomplete="off" required>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label>Image</label>
									<input type="file" name="imagg" class="form-control" autocomplete="off" accept="image/*"
									required>
								</div>
								<div class="col-md-6">
									<label>Address</label>
									<textarea placeholder="Address" name="address" class="form-control"></textarea>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-12">
									<center>
									<button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
									<input type="submit" class="btn btn-success shadow" value="Add" name="saveUser">
									</center>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
					if(isset($_POST['saveUser']))
					{
						$role_idd   = $_POST['role_idd'];
						$namee      = $_POST['namee'];
						$usernamee  = $_POST['usernamee'];
						$emaill     = $_POST['emaill'];
						$passwordd  = $_POST['passwordd'];
						$address    = $_POST['address'];
						$contactt   = $_POST['contactt'];
						$email      = $_POST['emaill'];
						$date       = date('Y-m-d');
						$image      = $_FILES['imagg']['name'];
						$temp_img   = $_FILES['imagg']['tmp_name'];
						if($image == '')
						{
							$userImage = '';
						}
						else
						{
							$userImage = mt_rand().$image;
						}
						$pathImg  ="images/admin/management_users/".$userImage;
						$insert = "INSERT INTO `management_users`(`role_id`, `status`, `name`, `username`, `email`, `password`, `contact`, `image`, `address`, `signupdate`) VALUES ('$role_idd','0','$namee','$usernamee','$emaill','$passwordd','$contactt','$userImage','$address','$date')";
						$run = mysqli_query($connection,$insert);
						if($run)
						{
							move_uploaded_file($temp_img,$pathImg);
							echo "<!DOCTYPE html>
                <html>
                  <body>
                    <script>
                    Swal.fire(
                    'Acount !',
                    'Account has been created successfully',
                    'success'
                    ).then((result) => {
                    if (result.isConfirmed) {
                    	window.location.href = 'admin.php';
                    }
                    });
                    </script>
                  </body>
                </html>";
		}
		}
		?>
		<?php } ?>
		<script>
		function ajaxCall1() {
		var user = $('#username').val();
		$.ajax({
		method: 'POST',
		url: 'pages/administrator/user_add_ajax.php',
		data: {
		user: user
		},
		success: function(result) {
		if (result == 0) {
		document.getElementById('false').style.display = 'none';
		} else {
		document.getElementById('false').style.display = 'block';
		document.getElementById('username').value = '';
		}
		}
		})
		}
		</script>