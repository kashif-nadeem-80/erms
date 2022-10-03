<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Add New Challan Form</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Challan Form</li>
        </ol>
      </div>
    </div>
  </div>
</div>
 <section class="content" >
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <a href="dashboard.php" class="btn btn-warning shadow mb-3">Back</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 table-responsive">  
            <table class="table table-striped table-bordered datatable" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th>S.No</th>
                  <th>Project Name</th>
                  <th>Challan Title</th>
                  <th>Test's Amount</th>
                  <th>Amount in Word</th>
                  <th>Generate Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              $count = 0;
              $fetchData= "SELECT cp.id,p.project_name,cp.challan_title,cp.test_amount,cp.amount_words,cp.challan_date,cp.logo1,cp.logo2,cp.logo3 FROM projects_challans AS cp INNER JOIN projects AS p ON p.id = cp.project_id";
              $runData = mysqli_query($connection,$fetchData);
              while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id         = $rowData['id'];
                $project_name       = $rowData['project_name'];
                $challan_title       = $rowData['challan_title'];
                $test_amount   = $rowData['test_amount'];
                $amount_words      = $rowData['amount_words'];

                $path1U      = "../../images/admin/bank_logo/".$rowData['logo1'];
                $path2U      = "../../images/admin/bank_logo/".$rowData['logo2'];
                $path3U      = "../../images/admin/bank_logo/".$rowData['logo3'];

                $challan_date   = date("d-m-Y",strtotime($rowData['challan_date']));
              ?>
                <tr>

                  <td><?php echo $count ?></td>
                  <td><?php echo $project_name ?></td>
                  <td><?php echo $challan_title ?></td>
                  <td><?php echo $test_amount ?></td>
                  <td><?php echo $amount_words ?></td>
                  <td><?php echo $challan_date ?></td>
                  <td> 
                    <a href="project_challan_edit.php?challan_id=<?php echo $id ?>" class="btn btn-sm btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                    <a href="project_challan_view.php?challan_id=<?php echo $id ?>" class="btn btn-sm btn-warning shadow title" title="Details"><span><i class="fa fa-eye"></i></span></a>

                    <input type="hidden" id="challan_id<?php echo $count ?>" value="<?php echo $id ?>">
                    <input type="hidden" id="path1U<?php echo $count ?>" value="<?php echo $path1U ?>">
                    <input type="hidden" id="path2U<?php echo $count ?>" value="<?php echo $path2U ?>">
                    <input type="hidden" id="path3U<?php echo $count ?>" value="<?php echo $path3U ?>">
                    
                    <a onclick="deleteData(<?php echo $count ?>)" class="btn btn-sm btn-danger text-white shadow title" title="Delete"><span><i class="fa fa-trash-alt"></i></span></a> 
                   </td>
                </tr>
              <?php }?>
              </tbody>
            </table>
          </div>
        </div>
        <hr>

        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Challan Form</div>
            <div class="card-tools">
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body">
          <!-- form start -->
          
          <form method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Project Title</label>
                  <select class="form-control select2" name="projectId">
                    <option value="">Choose</option>
                    <?php
                    $fetchData = "SELECT * FROM projects WHERE status = '1' ORDER BY id DESC";
                    $run = mysqli_query($connection,$fetchData);
                    while ($row = mysqli_fetch_array($run)) {
                      $id = $row['id'];
                      $name = $row['project_name'];
                    ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Challan Title</label>
                  <input type="text" name="challan_title" placeholder="Challan Title" class="form-control">
                  <span class="text-danger">Challan title must be unique</span>
                </div>
              </div>
              
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Test's Amount</label>
                  <input type="number" name="testAmount" placeholder="Test's Amount" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Amount in Words</label>
                  <input type="text" name="ammountWord" placeholder="Amount in Words" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center text-info">First Bank Details</h4>
                <center><p style="border: 1px lightblue solid; width: 20%;"></p></center>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank Name</label>
                  <input type="text" name="bank1" placeholder="Bank Name" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank Logo</label>
                  <input type="file" style="overflow-x: hidden;" accept="image/PNG" name="logo1"  class="form-control" id="file1" onchange="showImage1(event)">
                </div>
              </div>
              <div class="col-md-4">
                <div class="m-3">
                  <img id="log1" src="../../images/file_icon.png" height="50px">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Branch</label>
                  <input type="text" name="branch1" placeholder="Branch" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>A/C Title</label>
                  <input type="text" name="title1" placeholder="A/C Title" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>A/C No</label>
                  <input type="text" name="acco_no1" placeholder="A/C No" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center text-info">Second Bank Details</h4>
                <center><p style="border: 1px lightblue solid; width: 20%;"></p></center>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank Name</label>
                  <input type="text" name="bank2" placeholder="Bank Name" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank Logo</label>
                  <input type="file" style="overflow-x: hidden;" accept="image/PNG" name="logo2"  class="form-control" id="file2" onchange="showImage2(event)">
                </div>
              </div>
              <div class="col-md-4">
                <div class="m-3">
                  <img id="log2" src="../../images/file_icon.png" height="50px">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Branch</label>
                  <input type="text" name="branch2" placeholder="Branch" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>A/C Title</label>
                  <input type="text" name="title2" placeholder="A/C Title" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>A/C No</label>
                  <input type="text" name="acco_no2" placeholder="A/C No" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h4 class="text-center text-info">Third Bank Details</h4>
                <center><p style="border: 1px lightblue solid; width: 20%;"></p></center>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank Name</label>
                  <input type="text" name="bank3" placeholder="Bank Name" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Bank Logo</label>
                  <input type="file" style="overflow-x: hidden;" accept="image/PNG" name="logo3"  class="form-control" id="file3" onchange="showImage3(event)">
                </div>
              </div>
              <div class="col-md-4">
                <div class="m-3">
                  <img id="log3" src="../../images/file_icon.png" height="50px">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Branch</label>
                  <input type="text" name="branch3" placeholder="Branch" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>A/C Title</label>
                  <input type="text" name="title3" placeholder="A/C Title" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>A/C No</label>
                  <input type="text" name="acco_no3" placeholder="A/C No" class="form-control">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <center>
                <input type="submit" class="btn btn-success shadow" value="Add" name="saveUser">
                </center>
              </div>
            </div>
            
          </form>
          <?php
          if(isset($_POST['saveUser']))
          {
            $challan_title  = $_POST['challan_title'];
            $projectId  = $_POST['projectId'];
            $testAmount  = $_POST['testAmount'];
            $ammountWord     = $_POST['ammountWord'];

            $bank1  = $_POST['bank1'];
            if($_FILES['logo1']['name'] == '')
            {
              $logo1 = '';
            }
            else
            {
              $logo1 = $_FILES['logo1']['name'];
              $temp_logo1  = $_FILES['logo1']['tmp_name'];
              $pathImg1    = "../../images/admin/bank_logo/".$logo1;
              move_uploaded_file($temp_logo1,$pathImg1);
            }
            $branch1   = $_POST['branch1'];
            $title1      = $_POST['title1'];
            $acco_no1      = $_POST['acco_no1'];

            $bank2  = $_POST['bank2'];
            if($_FILES['logo2']['name'] == '')
            {
              $logo2 = '';
            }
            else
            {
              $logo2 = $_FILES['logo2']['name'];
              $temp_logo2  = $_FILES['logo2']['tmp_name'];
              $pathImg2    = "../../images/admin/bank_logo/".$logo2;

              move_uploaded_file($temp_logo2,$pathImg2);
            }
            $branch2   = $_POST['branch2'];
            $title2      = $_POST['title2'];
            $acco_no2      = $_POST['acco_no2'];

            $bank3  = $_POST['bank3'];
            if($_FILES['logo3']['name'] == '')
            {
              $logo3 = '';
            }
            else
            {
              $logo3 = $_FILES['logo3']['name'];
              $temp_logo3  = $_FILES['logo3']['tmp_name'];
              $pathImg3    = "../../images/admin/bank_logo/".$logo3;
              
              move_uploaded_file($temp_logo3,$pathImg3);
            }
            $branch3   = $_POST['branch3'];
            $title3      = $_POST['title3'];
            $acco_no3      = $_POST['acco_no3'];
            $date       = date('Y-m-d');

            $insert = "INSERT INTO `projects_challans`(`project_id`, `challan_title`,`test_amount`, `amount_words`, `bank1`, `logo1`, `branch1`, `title1`, `acc_no1`, `bank2`, `logo2`, `branch2`, `title2`, `acc_no2`, `bank3`, `logo3`, `branch3`, `title3`, `acc_no3`, `challan_date`) VALUES ('$projectId','$challan_title','$testAmount','$ammountWord','$bank1','$logo1','$branch1','$title1','$acco_no1','$bank2','$logo2','$branch2','$title2','$acco_no2','$bank3','$logo3','$branch3','$title3','$acco_no3','$date')";
            $run = mysqli_query($connection,$insert);
            $challanId = mysqli_insert_id($connection);
            if($run) 
            {
              echo "<!DOCTYPE html>
              <html>
                <body> 
                <script>
                Swal.fire(
                  'Challan !',
                  'Challan has been added successfully',
                  'success'
                ).then((result) => {
                  if (result.isConfirmed) {
                     window.location.href = 'project_challan.php';
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
                  'Challan not add, Some error occure',
                  'error'
                ).then((result) => {
                  if (result.isConfirmed) {
                     window.location.href = 'project_challan.php';
                  }
                });
                </script>
                </body>
              </html>";
            }
          }

          ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php 
 include "includes/footer.php";
?>

<?php 
  if(isset($_GET['deleteId']))
  {
      $id = $_GET['deleteId'];
      $path1 = $_GET['path1'];
      $path2 = $_GET['path2'];
      $path3 = $_GET['path3'];
      @unlink($path1);
      @unlink($path2);
      @unlink($path3);
      $delete = "DELETE FROM projects_challans WHERE id = '$id'";
      $run = mysqli_query($connection,$delete);
      if($run)
      {
        echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Challan !',
              'The selected record has been disabled',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href= 'project_challan.php';
              }
            });
            </script>
            </body>
          </html>";
    }
  }
?>

 <script type="text/javascript">
var showImage1 = function(event) {
  var uploadField = document.getElementById("file1");
  
  if (uploadField.files[0].size > 200000) {
    uploadField.value = "";
    alert("File is too big! Upload logo under 200kB");
  }
  else
  {
    var logoId = document.getElementById('log1');
    logoId.src = URL.createObjectURL(event.target.files[0]);
  }
}

var showImage2 = function(event) {
  var uploadField = document.getElementById("file2");
  
  if (uploadField.files[0].size > 200000) {
    uploadField.value = "";
    alert("File is too big! Upload logo under 200kB");
  }
  else
  {
    var logoId = document.getElementById('log2');
    logoId.src = URL.createObjectURL(event.target.files[0]);
  }
}

var showImage3 = function(event) {
  var uploadField = document.getElementById("file3");
  
  if (uploadField.files[0].size > 200000) {
    uploadField.value = "";
    alert("File is too big! Upload logo under 200kB");
  }
  else
  {
    var logoId = document.getElementById('log3');
    logoId.src = URL.createObjectURL(event.target.files[0]);
  }
}
</script>

<script type="text/javascript">
  function deleteData(id)
  {
    var challan_id = $("#challan_id"+id).val();
    var path1U = $("#path1U"+id).val();
    var path2U = $("#path2U"+id).val();
    var path3U = $("#path3U"+id).val();
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
      window.location.href= "project_challan.php?deleteId="+challan_id+"&path1="+path1U+"&path2="+path2U+"&path3"+path3U;
    }
  });
}
</script>