<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Registered Candidates</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Candidates List</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general Card elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Registered Candidates Details</div>
            <div class="card-tools">
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          
          <div class="card-body table-responsive">
            <!-- Table start -->
            <table style="font-size: 12px" data-page-length="50" id="datatable_data">
              <thead class="bg-dark" >
                <tr>
                  <th>S.No</th>
                  <th>Picture</th>
                  <th>Name</th>
                  <th>CNIC No</th>
                  <th>Father/Guardian</th>
                  <th>Gender</th>
                  <th>D.O.B</th>
                  <th>Contact</th>
                  <th>Domicile</th>
                  <th>Password</th>
                  <th>Email Verfication</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>

<script>
function deleteData(id)
{
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
      window.location.href= "registered_users.php?deletId="+id+"&path="+pathImg;
    }
});

}
</script>


<?php
  if(isset($_GET['deletId']))
  {
    $id = $_GET['deletId'];
    $path = $_GET['path'];
    unlink($path);
    $delete = "DELETE FROM candidates  WHERE id = '$id'";
    $run = mysqli_query($connection,$delete);
    if($run)
    {
      $delete2 = "DELETE FROM education  WHERE candi_id = '$id'";
      $run2 = mysqli_query($connection,$delete2);

      $delete3 = "DELETE FROM work_experince  WHERE candidate_id = '$id'";
      $run3 = mysqli_query($connection,$delete3);
      
      $delete3 = "DELETE FROM candidate_applied_post  WHERE candidate_id = '$id'";
      $run3 = mysqli_query($connection,$delete3);
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
             window.location.href = 'registered_users.php';
          }
        });
        </script>
        </body>
      </html>";
    }
  }
  ?>

<script>
  $(document).ready(function(){
    var dataTable=$('#datatable_data').DataTable({
      "processing": true,
      "serverSide":true,
      "ajax":{
        url:"register_users_ajax.php",
        type:"post"
      }
    });
  });
</script>