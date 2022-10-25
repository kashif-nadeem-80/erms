<?php
include "includes/header.php";
$challan_id = $_GET['challan_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Challan Form Edit</h4>
      </div>
      
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Challan Form Edit</li>
        </ol>
      </div>
    </div>
    <div class="col-md-12">
      <a href="project_challan.php" class="btn btn-warning shadow mb-1">Back</a>
    </div>
  </div>
</div>
 <section class="content" >
  <div class="container-fluid" class="text-center">
    <div class="row">
      <div class="col-md-12">
        <center id="succ" style="display: none">
          <h4 class="text-success">Challan Updated Successfully</h4>
        </center>
        <center id="err" style="display: none">
          <h4 class="text-danger">Challan Not Added</h4>
        </center>
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Challan Form Edit</div>
            <div class="card-tools">
              <a href="project_challan_view.php?challan_id=<?php echo $challan_id ?>" class="btn btn-primary btn-sm shadow">Challan's Details</a>
            </div>
          </div>
          <br>
          <div class="card-body">

          <?php
            
            $fetchData= "SELECT cp.id,cp.project_id AS p_id,p.project_name,p.project_id,cp.challan_title,cp.test_amount,cp.amount_words,cp.bank1,cp.logo1,cp.branch1,cp.title1,cp.acc_no1,cp.bank2,cp.logo2,cp.branch2,cp.title2,cp.acc_no2,cp.bank3,cp.logo3,cp.branch3,cp.title3,cp.acc_no3,cp.challan_date,cp.challan_update FROM projects_challans AS cp INNER JOIN projects AS p ON p.id = cp.project_id WHERE cp.id = '$challan_id'";
            $runData = mysqli_query($connection,$fetchData);
            $rowData = mysqli_fetch_array($runData);
            $p_id       = $rowData['p_id'];
            $project_id       = $rowData['project_id'];
            $challan_title       = $rowData['challan_title'];
            $project_name       = $rowData['project_name'];
            $test_amount   = $rowData['test_amount'];
            $amount_words      = $rowData['amount_words'];

            $bank1      = $rowData['bank1'];
            $logo1      = $rowData['logo1'];
            $branch1      = $rowData['branch1'];
            $title1      = $rowData['title1'];
            $acc_no1      = $rowData['acc_no1'];

            $bank2      = $rowData['bank2'];
            $logo2      = $rowData['logo2'];
            $branch2      = $rowData['branch2'];
            $title2      = $rowData['title2'];
            $acc_no2      = $rowData['acc_no2'];

            $bank3      = $rowData['bank3'];
            $logo3      = $rowData['logo3'];
            $branch3      = $rowData['branch3'];
            $title3      = $rowData['title3'];
            $acc_no3      = $rowData['acc_no3'];

          ?>
          
          <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Project Name</label>
                    <textarea class="form-control" disabled><?php echo $project_name ?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Challan Title</label>
                    <textarea class="form-control" name="challan_title"><?php echo $challan_title ?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Test's Amount</label>
                    <input type="number" name="testAmount" placeholder="Test's Amount" class="form-control" value="<?php echo $test_amount ?>" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Amount in Words</label>
                    <input type="text" name="ammountWord" placeholder="Amount in Words" class="form-control" value="<?php echo $amount_words ?>" required>
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
                    <input type="text" name="bank1" placeholder="Bank Name" class="form-control" value="<?php echo $bank1 ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Bank Logo</label>
                    <input type="file" accept="image/PNG" style="overflow-x: hidden;" name="logo1" placeholder="Bank Name" class="form-control" id="file1" onchange="showImage1(event)" value="<?php echo $logo1 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="m-3">
                    <img id="log1" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" height="50px">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Branch</label>
                    <input type="text" name="branch1" placeholder="Branch" class="form-control" value="<?php echo $branch1 ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C Title</label>
                    <input type="text" name="title1" placeholder="A/C Title" class="form-control" value="<?php echo $title1 ?>" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C No</label>
                    <input type="text" name="acco_no1" placeholder="A/C No" class="form-control" value="<?php echo $acc_no1 ?>" required>
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
                    <input type="text" name="bank2" placeholder="Bank Name" class="form-control" value="<?php echo $bank2 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Bank Logo</label>
                    <input type="file" accept="image/PNG" style="overflow-x: hidden;" name="logo2" placeholder="Bank Name" class="form-control" id="file2" onchange="showImage2(event)" value="<?php echo $logo2 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="m-3">
                    <img id="log2" src="../../images/admin/bank_logo/<?php
                    if($logo2 == NULL OR $logo2 == '')
                    { 
                      echo "../../file_icon.png";
                    }
                    else
                    {
                      echo $logo2;
                    } 
                    ?>" style="height:50px">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Branch</label>
                    <input type="text" name="branch2" placeholder="Branch" class="form-control" value="<?php echo $branch2 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C Title</label>
                    <input type="text" name="title2" placeholder="A/C Title" class="form-control" value="<?php echo $title2 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C No</label>
                    <input type="text" name="acco_no2" placeholder="A/C No" class="form-control" value="<?php echo $acc_no2 ?>">
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
                    <input type="text" name="bank3" placeholder="Bank Name" class="form-control" value="<?php echo $bank3 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Bank Logo</label>
                    <input type="file" accept="image/PNG" style="overflow-x: hidden;" name="logo3" placeholder="Bank Name" class="form-control" id="file3" onchange="showImage3(event)" value="<?php echo $logo3 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="m-3">
                    <img id="log3" src="../../images/admin/bank_logo/<?php
                    if($logo3 == NULL OR $logo3 == '')
                    { 
                      echo "../../file_icon.png";
                    }
                    else
                    {
                      echo $logo3;
                    } 
                    ?>" style="height:50px">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Branch</label>
                    <input type="text" name="branch3" placeholder="Branch" class="form-control" value="<?php echo $branch3 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C Title</label>
                    <input type="text" name="title3" placeholder="A/C Title" class="form-control" value="<?php echo $title3 ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C No</label>
                    <input type="text" name="acco_no3" placeholder="A/C No" class="form-control" value="<?php echo $acc_no3 ?>">
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <center>
                    <input type="submit" class="btn btn-success shadow" value="Update" name="saveUser">
                  </center>
                </div>
              </div>
            </div>
          </form>
          <?php
          if(isset($_POST['saveUser']))
          {
            $challan_titleU  = $_POST['challan_title'];
            $testAmountU  = $_POST['testAmount'];
            $ammountWordU     = $_POST['ammountWord'];

            $bank1U  = $_POST['bank1'];
            if($_FILES['logo1']['name'] == '')
            {
              $logo1U = $logo1;
            }
            else
            {
              $logo1U = mt_rand().$_FILES['logo1']['name'];
              $temp_logo1U  = $_FILES['logo1']['tmp_name'];
              $pathImg1U    = "../../images/admin/bank_logo/".$logo1U;
              move_uploaded_file($temp_logo1U,$pathImg1U);
                
              $path1    = "../../images/admin/bank_logo/".$logo1;
              @unlink($path1);
            }
            $branch1U   = $_POST['branch1'];
            $title1U      = $_POST['title1'];
            $acco_no1U      = $_POST['acco_no1'];

            $bank2U  = $_POST['bank2'];
            if($_FILES['logo2']['name'] == '')
            {
              $logo2U = $logo2;
            }
            else
            {
              $logo2U = mt_rand().$_FILES['logo2']['name'];
              $temp_logo2U  = $_FILES['logo2']['tmp_name'];
              $pathImg2U    = "../../images/admin/bank_logo/".$logo2U;
              move_uploaded_file($temp_logo2U,$pathImg2U);
                
              $path2    = "../../images/admin/bank_logo/".$logo2;
              @unlink($path2);
            }
            $branch2U   = $_POST['branch2'];
            $title2U      = $_POST['title2'];
            $acco_no2U      = $_POST['acco_no2'];

            $bank3U  = $_POST['bank3'];
            if($_FILES['logo3']['name'] == '')
            {
              $logo3U = $logo3;
            }
            else
            {
              $logo3U = mt_rand().$_FILES['logo3']['name'];
              $temp_logo3U  = $_FILES['logo3']['tmp_name'];
              $pathImg3U    = "../../images/admin/bank_logo/".$logo3U;
              move_uploaded_file($temp_logo3U,$pathImg3U);

              $path3    = "../../images/admin/bank_logo/".$logo3;
              @unlink($path3);
            }
            $branch3U   = $_POST['branch3'];
            $title3U      = $_POST['title3'];
            $acco_no3U      = $_POST['acco_no3'];
            $dateU       = date('Y-m-d');

            $update = "UPDATE `projects_challans` SET `challan_title` = '$challan_titleU', `test_amount` = '$testAmountU', `amount_words` = '$ammountWordU', `bank1` = '$bank1U', `logo1` = '$logo1U', `branch1` = '$branch1U', `title1` = '$title1U', `acc_no1` = '$acco_no1U', `bank2` = '$bank2U', `logo2` = '$logo2U', `branch2` = '$branch2U', `title2` = '$title2U', `acc_no2` = '$acco_no2U', `bank3` = '$bank3U', `logo3` = '$logo3U', `branch3` = '$branch3U', `title3` = '$title3U', `acc_no3` = '$acco_no3U', `challan_update` = '$dateU' WHERE id = '$challan_id'";
            $run = mysqli_query($connection,$update);
            if($run) 
            {
              echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Challan !',
                    'Challan has been updated successfully',
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
                    'Challan not update, Some error occure',
                    'error'
                  ).then((result) => {
                    if (result.isConfirmed) {
                       window.location.href = 'project_challan_edit.php?challan_id=$challan_id';
                    }
                  });
                  </script>
                  </body>
                </html>";
            }
          }

          ?>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        
      </div>
    <!-- Col-12 -->
    </div>
    <!-- row -->
  </div>
</section>

<?php include "includes/footer.php"; ?>

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