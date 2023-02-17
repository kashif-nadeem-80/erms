<?php
include "includes/header.php";
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-md-6">
				<h4 class="m-0 text-dark">Roll Number Details</h4>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb float-md-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Roll Number Details</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-dark">
					<div class="card-title">Roll No</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-striped table-bordered bg-white text-center" style="font-size: 12px">
								<thead class="bg-dark">
									<tr>
										<th>S.No</th>
										<th>Post/bps</th>
										<th>Reporting Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$count = 0;
									$query = "SELECT p.id, p.post_name,p.post_bps,cs.reporting_date FROM candidate_applied_post AS ca INNER JOIN projects_posts AS p ON p.id = ca.post_id INNER JOIN assigned_center AS ac ON ac.cand_applied_id = ca.id INNER JOIN center_session AS cs ON cs.id = ac.session_id WHERE ca.candidate_id = '$canddate_id' AND ac.roll_no != '0' AND reporting_date >= CURRENT_DATE()";
									$runData = mysqli_query($connection,$query);
									$countData = mysqli_num_rows($runData);
									if($countData != '0' OR $countData != 0)
									{
									while($rowData = mysqli_fetch_array($runData)) {
									$count++;
									$id = $rowData['id'];
									$post = $rowData['post_name'];
									$bps = $rowData['post_bps'];
									$reporting_date = date("d-m-Y h:i a",strtotime($rowData['reporting_date']));
									?>
									
									
									<tr>
										<td><?php echo $count; ?></td>
										<td><b><?php echo $post." (BPS-".$bps.")"; ?></b></td>
										<td><?php echo $reporting_date; ?></td>
										<td>
											<a href="roll_no_view.php?post_id=<?php echo $id ?>" class="btn btn-sm btn-warning title shadow">Print</a>
											<a href="roll_no_download.php?post_id=<?php echo $id ?>" class="btn btn-sm btn-primary title shadow">Dowload</a>
											
										</td>
									</tr>
									<?php } }
										else
										{
									?>
									<tr>
										<td colspan="4" class="text-center font-weight-bold text-danger">No Roll Number Available</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
include "includes/footer.php";
?>