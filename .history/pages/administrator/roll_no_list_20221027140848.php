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
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 table-responsive">
						<table class="table table-striped table-bordered datatable bg-white text-center" style="font-size: 12px" data-page-length="50">
							<thead class="bg-dark">
								<tr>
									<th>S.No</th>
									<th>Roll No</th>
									<th>Name</th>
									<th>F/G Name</th>
									<th>Gender</th>
									<th>CNIC</th>
									<th>Image</th>
									<th>Post</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								$query = "SELECT c.id AS cand_id, ac.roll_no,c.name,c.f_name,c.gender,c.cnic,c.image,
                                    pp.post_name,pp.post_bps, BIN(roll_no) AS roll_binary 
                                    FROM assigned_center AS ac 
                                        INNER JOIN projects_posts AS pp ON pp.id = ac.post_id 
                                        LEFT JOIN projects AS pr ON pr.id = pp.project_id
                                        INNER JOIN candidate_applied_post AS cap ON cap.id = ac.cand_applied_id 
                                        INNER JOIN candidates AS c ON c.id = cap.candidate_id 
                                    WHERE ac.roll_no != '0' AND pr.status = '1' and c.id > 39500
                                    ORDER BY ac.roll_no ASC
                                    limit 700";
								$runData = mysqli_query($connection,$query);
								while($rowData = mysqli_fetch_array($runData)) {
								$count++;
								$roll_no = $rowData['roll_no'];
								$cand_id = $rowData['cand_id'];
								$name = $rowData['name'];
								$f_name = $rowData['f_name'];
								$gender = $rowData['gender'];
								$cnic = $rowData['cnic'];
								$image = $rowData['image'];
								$path = "../../images/candidates/profile picture/".$image;
								$post = $rowData['post_name'];
								$bps = $rowData['post_bps'];
								?>
								
								
								<tr>
									<td><?php echo $count; ?></td>
									<td><?php echo $roll_no; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $f_name; ?></td>
									<td><?php echo $gender; ?></td>
									<td><?php echo $cnic; ?></td>
									<td>
										
										<?php if($image == NULL OR $image == '')
										{
										echo "Image Not Found";
										}
										else
										{ ?>
										<input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $image ?>">
										<a href="#image_view" data-toggle="modal" onclick="pic_view(<?php echo $count ?>)"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="60px;" height="60px"  src="<?php echo $path ?>" alt="Candidate Image"></a>
										<?php } ?>
									</td>
									<td><b><?php echo $post." (BPS-".$bps.")"; ?></b></td>
									<td><a href="roll_no_view.php?roll_no=<?php echo $roll_no ?>&cand_id=<?php echo $cand_id ?>" class="btn btn-sm btn-warning title shadow"><i class="fa fa-eye"></i></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
include "includes/footer.php";
?>
<script type="text/javascript">
	function pic_view(id)
{
var pic_name = $("#pic_name"+id).val();
$.ajax({
method:'POST',
url:'applications_data_ajax.php',
data: {
pic_name: pic_name
},
datatype: "html",
success:function(result){
$(".image_view").html(result);
}
});
}
</script>
<!--Pic View Modal Start-->
<div class="modal fade" id="image_view" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" style="width:450px" role="document">
		<div class="modal-content image_view">
		</div>
	</div>
</div>
<!-- Modal end -->