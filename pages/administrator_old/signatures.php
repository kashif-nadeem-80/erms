<?php
include "includes/header.php";
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-md-6">
				<h4 class="m-0 text-dark">Add Signature</h4>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb float-md-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">Add Signature Image</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header bg-dark">
						<div class="card-title">Signature</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="">Operation Manager</label>
								<input id="sign" required name="signature" onchange="showImage1(event)"  type="file" class="form-control overflow-hidden" placeholder="Insert Your Image" accept="image/PNG">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group ">
								<img id="sign_img" class="shadow" style="border: 1px blue solid; border-radius: 10%; margin-top: -4%" width="120px;" height="130px"  src="../../images/file_icon.png">
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-12">
							<center>
							<input type="submit" class="btn btn-success shadow m-2" value="Add" name="saveUser">
							</center>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered bg-white text-center" style="font-size: 12px">
							<thead class="bg-dark">
								<tr>
									<th>Signature</th>
									<th>Action</th>
								</tr>
								
							</thead>
							<tbody>
								<?php
									$query1 = "SELECT * FROM signatures";
									$result = mysqli_query($connection,$query1);
									$count=0;
									while($rowData = mysqli_fetch_array($result)) {
								$count++;
								$id = $rowData['id'];
								$manager_path  = "../../images/admin/signatures/". $rowData['manager_operation'];
								?>
								<tr>
									<td><img src="<?php echo $manager_path ?>" alt="" height="90px" width="120px" class="rounded"></td>
									<td>
									<input type="hidden" id="sig_id<?php echo $count ?>" value="<?php echo $id ?>">
			                       <input type="hidden" id="pathImg<?php echo $count ?>" value="<?php echo $manager_path ?>">
			                        <a class="btn btn-sm btn-danger shadow text-white" title="Delete"
			                        onclick="deleteData(<?php echo $count ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
			                        </td>
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
		if(isset($_POST['saveUser']))
		{
			$signature = mt_rand().$_FILES['signature']['name'];
			$temp_Image = $_FILES['signature']['tmp_name'];
			
			$file="SELECT * FROM signatures";
			$query = mysqli_query($connection,$file);
			$check = mysqli_num_rows($query);
			
			if($check == 0)
			{
				$row = mysqli_fetch_array($query);
				$query1 ="INSERT INTO signatures (manager_operation) VALUES ('$signature')";
				$newpath = "../../images/admin/signatures/".$signature;
				move_uploaded_file($temp_Image,$newpath);
			}
			else
			{
				$row = mysqli_fetch_array($query);
				$id = $row['id'];
				$oldpath = "../../images/admin/signatures/".$row['manager_operation'];
				@unlink($oldpath);
				$query1 ="UPDATE signatures SET manager_operation ='$signature' WHERE id='$id'";
				$newpath = "../../images/admin/signatures/".$signature;
				move_uploaded_file($temp_Image,$newpath);
			}

			$result1 = mysqli_query($connection,$query1);
			if($result1)
			{
          echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Added !',
                'Signature has been added successfully',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                   window.location.href = 'signatures.php';
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
                'Signature not add, Some error occure',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                   window.location.href = 'signatures.php';
                }
              });
              </script>
              </body>
            </html>";
        }
	}	 
	?>
	<?php
  if(isset($_GET['deletId']))
  {
  	$id = $_GET['deletId'];
  	$path = $_GET['pathImg'];
		
	$delete = "DELETE FROM signatures WHERE id ='$id'";
    $run = mysqli_query($connection,$delete);
    if($run)
    {
    	@unlink($path);
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
                 window.location.href = 'signatures.php';
              }
            });
            </script>
            </body>
          </html>";
    }
    
	}
  ?>
	<?php include "includes/footer.php"; ?>
	<script>
	var showImage1 = function(event) {
		var uploadField = document.getElementById("sign");
		if (uploadField.files[0].size > 300000) {
		uploadField.value = "";
		Swal.fire(
                'Error !',
                'File is too big! Upload File under 300kB !',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                    uploadField.value = "";
                }
              });
		}
		else
		{
		var logoId = document.getElementById('sign_img');
		logoId.src = URL.createObjectURL(event.target.files[0]);
		}
	}


  function deleteData(id)
  {
    var sig_id = $("#sig_id"+id).val();
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
      window.location.href= "signatures.php?deletId="+sig_id+"&pathImg="+pathImg;
    }
});

  }
</script>