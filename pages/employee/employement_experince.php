<?php

include "includes/header.php";

?>

<div class="content-header">

	<div class="container-fluid">

		<div class="row mb-2">

			<div class="col-md-6">

				<h4 class="m-0 text-dark">Employement Record</h4>

			</div>

			<div class="col-md-6">

				<ol class="breadcrumb float-md-right">

					<li class="breadcrumb-item"><a href="index.php">Home</a></li>

					<li class="breadcrumb-item active">..</li>

				</ol>

			</div>

		</div>

	</div>

</div>

<section class="content">

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-12">

				<div class="card card-dark">

					<!-- <div class="card-header">

						<div class="card-title">Employement Experience</div>

					</div> -->

			<div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
		  <br>
		  <br>
		  
					
							<div class="row">

								<div class="col-md-12">

									<form method="post" enctype="multipart/form-data">

										<div class="row">

											<div class="col-md-4">

												<div class="form-group">

													<label>Organization/ Company</label>

													<input type="text" class="form-control" name="company" placeholder="Organization/ Company" required>

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group">

													<label>Job Title(Job Relevent Experince)</label>

													<input type="text" class="form-control" name="job" placeholder="Job Experince" required>

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group">

													<label>Date From</label>

													<input type="date" id="dateFrom" class="form-control" name="date_from" required>

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group">

													<label>Date To</label><span class="float-right" style="font-size:12px"><b>Currently Working</b> <input type="checkbox" value="yes" name="check" id="checkbox"></span>

													<input type="date" onchange="dToChange()" class="form-control" name="date_to" id="working" required>

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group">

													<label>Total Experience</label>

													<input type="text" name="exp_total" id="tExperience" class="form-control" placeholder="Total Experience" readonly>

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group">

													<label>Pay Package (Rs)</label>

													<input type="number" placeholder="Pay Package" class="form-control" name="exp_payment">

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group">

													<label>Uploaded File <span class="text-info">&nbsp;(Optional)</span></label>

													<input type="file" class="form-control" id="file1" name="logo1" onchange="showImage1(event)" style="overflow-x: hidden;" accept="image/*">

													<?php

													?>

												</div>

											</div>

											<div class="col-md-4">

												<div class="form-group text-center">

													<img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 10%;" width="170px" height="150px" src="../../images/file_icon.png" alt="">

												</div>

											</div>

										</div>

										<div class="row">

											<div class="col-md-12 text-right">

												<input type="submit" class="btn btn-success shadow" value="Add" name="saveData1">

												<input type="submit" class="btn btn-primary shadow" value="Add & Next" name="saveData2">

												<a href="apply.php" class="btn btn-warning shadow">Next</a>

											</div>

										</div>

									</form>

								</div>

							</div>
							<div class="card-body">

<?php

	$fetchData= "SELECT * FROM work_experince WHERE candidate_id= '$canddate_id'";

	$runData = mysqli_query($connection,$fetchData);

	$countRow = mysqli_num_rows($runData);

	if($countRow != 0)

	{

?>

<div class="row">

	<div class="col-md-12">

		<table class="table table-bordered bg-white text-center" style="font-size: 12px">

			<thead class="bg-gray">

				<tr>

					<th>S.No</th>

					<th>Organization/Company</th>

					<th>Job Title(Job Relevent Experince)</th>

					<th>Date From </th>

					<th>Date To</th>

					<th>Duration</th>

					<th>Salary</th>

					<th>Docs</th>

					<th>Action</th>

				</tr>

			</thead>

			<tbody>

				<?php

				$count = 0;

				while($rowData = mysqli_fetch_array($runData)) {

				$count++;

				$id  = $rowData['id'];

				$names  = $rowData['company'];

				$jobs  = $rowData['job_title'];

				$date_froms   = date("d-m-Y",strtotime($rowData['date_from']));

				$date_tos   = date("d-m-Y",strtotime($rowData['date_to']));

				$file = $rowData['file'];

				$payment = $rowData['payment'];

				$total_exp = $rowData['total_exp'];

				$pathImg = "../../images/candidates/employee_experince/".$file;

				?>

				<tr>

					<td><?php echo $count ?></td>

					<td><?php echo $names ?></td>

					<td><?php echo $jobs ?></td>

					<td><?php echo $date_froms ?></td>

					<td>

						<?php

							if($rowData['date_to'] != "0000-00-00")

							{

								echo $date_tos;

							}

							else

							{

								echo "Continue";

							}

						?>

					</td>

					<td><?php echo $total_exp ?></td>

					<td><?php echo $payment ?></td>

					<td>

						<?php

						if($file == "Continue")

						{

							echo "Continue";

						}

						elseif($file == '')

						{

							echo "Not Uploaded";

						}

						else

						{

						?>

						<a class="Data_Ajax1" data-id="<?php echo $pathImg ?>" href="#image1"

							data-toggle='modal'>

							View

						</a>

						<?php } ?>

					</td>

					<td>

						<input type="hidden" id="edu_id<?php echo $count ?>" value="<?php echo $id ?>">

						<input type="hidden" id="pathImg<?php echo $count ?>" value="<?php echo $pathImg ?>">

						<a class="btn btn-sm btn-danger shadow text-white" title="Delete"

							onclick="deleteData(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>

						</td>

					</tr>

					<?php }?>

				</tbody>

			</table>

		</div>

	</div>

	<hr>

	<?php } ?>

						</div>

					</div>
				</div>

			</div>

			<?php

			if(isset($_POST['saveData1']) OR isset($_POST['saveData2']))

			{

				$company1 = $_POST['company'];

				$job1 = $_POST['job'];

				$date_from1 = $_POST['date_from'];

				$exp_payment1 = $_POST['exp_payment'];

				$exp_total1 = $_POST['exp_total'];

				

				@$check = $_POST['check'];

				if($check == 'yes')

				{

					$profImage = 'Continue';

					$date_to1 = '0000-00-00';

				}

				else

				{

					if($_FILES['logo1']['name'] == '')

			{

			$profImage = "";

			}

			else

			{

			$profImage = date("Y-m-d H-i-s").$_FILES['logo1']['name'];

						$temp_profImage = $_FILES['logo1']['tmp_name'];

						$pathImg1U = "../../images/candidates/employee_experince/".$profImage;

						move_uploaded_file($temp_profImage,$pathImg1U);

			}

							$date_to1 = $_POST['date_to'];

				}

				

				$query1 = "INSERT INTO `work_experince`(`company`, `job_title`, `date_from`, `date_to`, `file`, `candidate_id`, `payment`, `total_exp`) VALUES ('$company1','$job1','$date_from1','$date_to1','$profImage', '$canddate_id', '$exp_payment1', '$exp_total1')";

				$run1 = mysqli_query($connection,$query1);

				if($run1 AND isset($_POST['saveData1']))

			{

			echo "<!DOCTYPE html>

			<html>

								<body>

					<script>

					Swal.fire(

					'Added !',

					'Experience has been added successfully',

					'success'

					).then((result) => {

					if (result.isConfirmed) {

					window.location.href = 'employement_experince.php';

					}

					});

					</script>

				</body>

			</html>";

			}

			elseif ($run1 AND isset($_POST['saveData2'])) {

			echo "<!DOCTYPE html>

			<html>

				<body>

					<script>

					Swal.fire(

					'Added !',

					'Experience has been added successfully',

					'success'

					).then((result) => {

					if (result.isConfirmed) {

					window.location.href = 'apply.php';

					}

					});

					</script>

				</body>

			</html>";

			}

			else

			{

			echo "<!DOCTYPE html>

			<html>

				<body>

					<script>

					Swal.fire(

					'Error !',

					'Experience not add, Some error occure',

					'error'

					).then((result) => {

					if (result.isConfirmed) {

					window.location.href = 'employement_experince.php';

					}

					});

					</script>

				</body>

			</html>";

			}

			}

			?>

			

		</div>

	</section>

	<script type="text/javascript">

	function deleteData(id)

	{

	var edu_id = $("#edu_id"+id).val();

	var pathImg = $("#pathImg"+id).val();

	Swal.fire({

	title: 'Are you sure?',

	text: "To delete the selected record !",

	icon: 'warning',

	showCancelButton: true,

	confirmButtonColor: '#3085d6',

	cancelButtonColor: '#d33',

	confirmButtonText: 'Yes, delete it!'

	}).then((result) => {

	if (result.isConfirmed) {

	window.location.href= "employement_experince.php?deletId="+edu_id+"&pathImg="+pathImg;

	}

	});

	}

	</script>

	<?php

	if(isset($_GET['deletId']) OR isset($_GET['pathImg']))

	{

	$id = $_GET['deletId'];

	$path = $_GET['pathImg'];

	@unlink($path);

	$delete = "DELETE FROM work_experince WHERE id = '$id'";

	$run = mysqli_query($connection,$delete);

	if($run)

	{

	echo "<!DOCTYPE html>

	<html>

						<body>

			<script>

			Swal.fire(

			'Deleted !',

			'The selected record has been deleted',

			'success'

			).then((result) => {

			if (result.isConfirmed) {

			window.location.href = 'employement_experince.php';

			}

			});

			</script>

		</body>

	</html>";

	}

	}

	?>

	<?php

	include "includes/footer.php";

	?>

	<script type="text/javascript">

	$('.Data_Ajax1').click(function() {

	var std_image1 = $(this).attr('data-id');

	$.ajax({

	method: 'POST',

	url: 'employement_experince_ajax.php',

	data: {

	std_image1: std_image1

	},

	datatype: "html",

	success: function(result) {

	$(".std1").html(result);

	}

	});

	});

	</script>

	<!-- Modal Start-->

	<div class="modal fade" id="image1" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-dialog modal-dialog-centered" role="document" style="width: 550px">

			<div class="modal-content std1">

			</div>

		</div>

	</div>

	<!-- Modal end -->

	<script>

	function showImage1(event) {

	var uploadField = document.getElementById("file1");

	if (uploadField.files[0].size > 80000) {

	uploadField.value = "";

	// alert("File is too big! Upload File under 80kB");

	Swal.fire(

	'Error !',

	'File size is too big! upload file under 80kB !',

	'error'

	).then((result) => {

	if (result.isConfirmed) {

	}

	});

	} else {

	var logoId = document.getElementById('log1');

	logoId.src = URL.createObjectURL(event.target.files[0]);

	}

	}

	///////////////////////////////

	$(function() {

	$("#checkbox").click(function(event) {

	var x = $(this).is(':checked');

	if (x == true) {

	$("#working").attr('disabled', 'disabled');

	$("#file1").attr('disabled', 'disabled');

	dToChange();

	} else {

	

	$("#working").attr('disabled', false);

	$("#file1").attr('disabled', false);

	$("#tExperience").val('');

	}

	});

	});

	function dToChange()

	{

	var dateTo = $("#working").val();

	var mdate = $("#dateFrom").val();

	var yearThen = parseInt(mdate.substring(0,4), 10);

	var monthThen = parseInt(mdate.substring(5,7), 10);

	var dayThen = parseInt(mdate.substring(8,10), 10);

	

	// Calculate Experience

	var from = new Date(mdate);

	if($('#checkbox').is(":checked"))

	{

	var to = new Date();

	}

	else

	{

	var to = new Date(dateTo);

	}

	var birthday = new Date(yearThen, monthThen-1, dayThen);

	

	var differenceInMilisecond = to.valueOf() - birthday.valueOf();

	

	var year_age = Math.floor(differenceInMilisecond / 31536000000);

	var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

	var month_age = Math.floor(day_age/30);

	

	day_age = day_age % 30;

	if(year_age != 0 && month_age != 0)

	{

	var total_exp = year_age + " years & " + month_age + " months";

	}

	else if(year_age == 0 && month_age != 0)

	{

	var total_exp = month_age + " months";

	}

	else if(year_age != 0 && month_age == 0)

	{

	var total_exp = year_age + " years";

	}

	else

	{

	var total_exp = day_age + " days";

	}

	$("#tExperience").val(total_exp);

	}

	</script>

