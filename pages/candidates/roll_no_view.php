<?php
session_start();
include('includes/db.php');
$canddate_id = $_SESSION['candd_id'];
?>
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">
<style>
@media print {
	body {
	/*-webkit-print-color-adjust: exact !important;*/
	}
	.printBlock{
		display: none;
	}
}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card" id="invoice">
				<div class="card-header bg-dark printBlock">
					<div class="card-title">Roll No</div>
				</div>
				<?php
					$p_id = $_GET['post_id'];
					$query = "SELECT p.project_name, p.project_id, can.name, can.f_name, can.cnic,can.image, can.phone, ac.roll_no, pp.post_name, cs.reporting_date, cs.start_time, tc.center_name FROM candidate_applied_post AS cap INNER JOIN projects_posts AS pp ON pp.id = cap.post_id INNER JOIN assigned_center AS ac ON ac.cand_applied_id = cap.id INNER JOIN center_session AS cs ON cs.id = ac.session_id INNER JOIN test_centers AS tc ON tc.id = cs.center_id INNER JOIN candidates AS can ON can.id = cap.candidate_id INNER JOIN projects AS p ON p.id = pp.project_id WHERE pp.id = '$p_id' AND can.id = '$canddate_id'";
						$result = mysqli_query($connection,$query);
						$row = mysqli_fetch_array($result);
						$project_name = $row['project_name'];
						$project_id = $row['project_id'];
						$name = $row['name'];
						$f_name = $row['f_name'];
						$cnic = $row['cnic'];
						$phone = $row['phone'];
						$image = $row['image'];
						$roll_no = $row['roll_no'];
						$post_name = $row['post_name'];
						$reporting_date = date("d-m-Y h:i a",strtotime($row['reporting_date']));
						$start_time = date("h:i a",strtotime($row['start_time']));
						$center_name = $row['center_name'];
				?>
				<div class="card-body">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								&nbsp;<img class="ml-2 mt-2" width="60px" height="50px" src="../../images/logo.png" alt="uts">
							</div>
							<div class="col-md-8">
								<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Universal Testing Services</h4>
								<p>Phone: 051-111-258-369 &nbsp; Email:<a href="info@uts.com.pk"> info@uts.com.pk</a> &nbsp;Website: <a href="http://www.uts.com.pk" target="_blank">www.uts.com.pk</a></p>
							</div>
							<hr style="margin-top: 0;border: 2px solid black; width: 95%;">
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<p class="m-0"><b>Roll No Slip</b></p>
								<p><b><?php echo $project_name." (".$project_id.")"; ?></b></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<p class="m-0">&nbsp;&nbsp;CNIC No: <b><?php echo $cnic; ?></b></p>
								<p class="m-0">&nbsp;&nbsp;Name: <b><?php echo $name; ?></b></p>
								<p class="m-0">&nbsp;&nbsp;Father/Guardian Name: <b><?php echo $f_name; ?></b></p>
							</div>
							<div class="col-md-6"></div>
							<div class="col-md-2">
								<img class="float-right" src="../../images/candidates/profile picture/<?php echo $image; ?>" height="170px" width="160px">
							</div>
						</div>
						<p></p>
						<div class="row">
							<div class="col-md-12 text-center">
								<table class="table table-bordered bg-white text-center border-color" >
									<thead >
										<tr>
											<th>Roll No</th>
											<th>Post Name</th>
											<th>Reporting Date & Time</th>
											<th>Test Start Time </th>
											<th>Test Center</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $roll_no; ?></td>
											<td><?php echo $post_name; ?></td>
											<td><?php echo $reporting_date; ?></td>
											<td><?php echo $start_time; ?></td>
											<td><?php echo $center_name; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<b>&nbsp;&nbsp;INSTRUCTIONS:</b>
						</div>
						<p></p>
						<div class="row">
							<div class="col-md-12">
								<span class="m-0">1. You are required to bring this Roll No Slip along with your original Identity Card for identification. No other identification
									documents like Passport, Driving License and Original Degrees are acceptable for identification, only original CNIC is
								acceptable with Roll No Slip.</span>
								<p class="m-0">2. You are also required to bring a Clipboard and ball pen/Marker (Black or Blue) with you. Clipboard should be clean without
								any writing. No paper for rough work is allowed.</p>
								<p class="m-0">3. Mobile Phone/Calculator or any other electronic device and wearable is not allowed. Please leave it outside the test center.</p>
								<p class="m-0">4. Center Management is not responsible for keeping student’s belongings/valuables. No ladies hand bags are allowed in the
								center</p>
								<p class="m-0">5. Any kind of weapon is strictly prohibited in the Examination Hall.
								</p>
								<p class="m-0">6. This is a provisional test subject to verification of your original documents, any discrepancy found later at any stage you will
								be disqualified.</p>
								<p class="m-0">7. Candidate is not allowed to enter in test center without mask</p>
								<p>8. Keep visiting UTS website <a href="http://www.uts.com.pk" target="_blank">www.uts.com.pk</a> for further information and test result
							</p>
						</div>
					</div>
					<?php
						$query1 = "SELECT * FROM signatures";
						$result1 = mysqli_query($connection, $query1);
						$row = mysqli_fetch_array($result1);
						$signature = $row['manager_operation'];
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<img src="../../images/admin/signatures/<?php echo $signature ?>" alt="ss" height="100px" width="180px">
								<div class="mr-0"><b>Manager Operation</b></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<b>To</b>,<br>
							Name: <b><?php echo $name; ?></b>&nbsp; Guardian/Father Name: <b><?php echo $f_name; ?></b><br>
							CNIC No: <b><?php echo $cnic; ?></b>&nbsp; Mobile : <b><?php echo $phone; ?></b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
<script>

  window.onload=function(){
    window.print();

    window.onafterprint = function() {
    window.location.href = "roll_no.php";
    }
  }
</script>