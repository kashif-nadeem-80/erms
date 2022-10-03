<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Challan Form</h4>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Challan Form</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content" >
  <div class="container-fluid" class="text-center">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <center id="succ" style="display: none">
          <h4 class="text-success">Challan Generated Successfully</h4>
        </center>
        <center id="err" style="display: none">
          <h4 class="text-danger">Challan Not Added</h4>
        </center>
        <!-- general form elements -->
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Challan Form</div>
            <div class="card-tools">
              <a href="challan_list.php" class="btn btn-primary btn-sm shadow">Challan's Details</a>
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body">
          <!-- form start -->
          
          <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Project ID</label>
                    <input type="text" name="projId" placeholder="Project ID" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" name="projName" placeholder="Project Name" class="form-control" required>
                  </div>
                </div>
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
                    <input type="file" name="logo1" placeholder="Bank Name" class="form-control" id="file1" onchange="showImage1(event)">
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
                    <input type="file" name="logo2" placeholder="Bank Name" class="form-control" id="file2" onchange="showImage2(event)">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="m-3">
                    <img id="log2" src="../../images/file_icon.png ?>" height="50px">
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
                    <input type="file" name="logo3" placeholder="Bank Name" class="form-control" id="file3" onchange="showImage3(event)">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="m-3">
                    <img id="log3" src="../../images/file_icon.png ?>" height="50px">
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
            </div>
          </form>
          <?php
          if(isset($_POST['saveUser']))
          {
            $projId   = $_POST['projId'];
            $projName      = $_POST['projName'];
            $testAmount  = $_POST['testAmount'];
            $ammountWord     = $_POST['ammountWord'];

            $bank1  = $_POST['bank1'];
            if($_FILES['logo1']['name'] == '')
            {
              $logo1 = '';
            }
            else
            {
              $logo1 = mt_rand().$_FILES['logo1']['name'];
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
              $logo2 = mt_rand().$_FILES['logo2']['name'];
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
              $logo3 = mt_rand().$_FILES['logo3']['name'];
              $temp_logo3  = $_FILES['logo3']['tmp_name'];
              $pathImg3    = "../../images/admin/bank_logo/".$logo3;
              
              move_uploaded_file($temp_logo3,$pathImg3);
            }
            $branch3   = $_POST['branch3'];
            $title3      = $_POST['title3'];
            $acco_no3      = $_POST['acco_no3'];
            $date       = date('Y-m-d');

            echo $insert = "INSERT INTO `challan_form`(`project_id`, `project_name`, `test_amount`, `amount_words`, `bank1`, `logo1`, `branch1`, `title1`, `acc_no1`, `bank2`, `logo2`, `branch2`, `title2`, `acc_no2`, `bank3`, `logo3`, `branch3`, `title3`, `acc_no3`, `challan_date`) VALUES ('$projId','$projName','$testAmount','$ammountWord','$bank1','$logo1','$branch1','$title1','$acco_no1','$bank2','$logo2','$branch2','$title2','$acco_no2','$bank3','$logo3','$branch3','$title3','$acco_no3','$date')";
            $run = mysqli_query($connection,$insert);
            if($run) 
              {
                
                echo "<!DOCTYPE html>
                  <html>
                    <head>
                      <title>Verfied Account</title>
                    </head>
                    <body> 
                    <script>
                      swal({
                          title: 'Challan Form',
                          text: ' Successfully Generate !',
                          icon: 'success'
                        }).then((value) => {
                           window.location.href  = 'challan_add.php';
                          }).catch(swal.noop)

                    </script>
                    </body>
                  </html>";
              }
              else
              {
                echo "<script>document.getElementById('succ').style.display = 'none';</script>";
                echo "<script>document.getElementById('err').style.display = 'block';</script>";
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