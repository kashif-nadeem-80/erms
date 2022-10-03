<?php
include "includes/header.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0 text-dark">Applied Posts</h4>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">...</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <center>
                <div class="bg-success text-white p-1 mb-2 rounded" id="succ2" style="display: none">
                    <h4>Challan Successully Upload</h4>
                </div>
                <div class="bg-success text-white p-1 mb-2 rounded" id="succ3" style="display: none">
                    <h4>Challan Successully Update</h4>
                </div>
            </center>
            <div class="card shadow card-dark">
                <!-- <div class="card-header">
                    <div class="card-title">Applied For Posts</div>
                </div> -->
                <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped table-bordered bg-white text-center"
                                style="font-size: 12px">
                                <thead class="bg-green heigh">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Post</th>
                                        <th>Apply Date & Time</th>
                                        <th>Application Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                  $count = 0;
                  $query2 = "SELECT ca.id,p.post_name,p.post_bps,ca.apply_date,ca.status,ca.challan_file FROM candidate_applied_post AS ca INNER JOIN projects_posts AS p ON p.id = ca.post_id WHERE ca.candidate_id = '$canddate_id'";
                  $runData = mysqli_query($connection,$query2);
                  while($rowData = mysqli_fetch_array($runData)) {
                  $count++;
                  $id = $rowData['id'];
                  $encode_id = base64_encode($id);
                  $post_name  = $rowData['post_name'];
                  $status = $rowData['status'];
                  $apply_date   = date("d-m-Y H:i:s", strtotime($rowData['apply_date']));
                  $post_bps     = $rowData['post_bps'];
                  $challan_fileU     = $rowData['challan_file'];
                  ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><b><?php echo $post_name." (BPS-".$post_bps.")"; ?></b></td>
                                        <td><?php echo $apply_date; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <?php if($challan_fileU == '' OR $challan_fileU == NULL)
                      { ?>
                                            <a style="margin-top: 2px"
                                                href="candidate_bank_challan_no.php?id=<?php echo $encode_id ?>"
                                                class="btn btn-sm btn-primary shadow title"
                                                title="Bank Challan">Download Challan</a>
                                            <?php } if($challan_fileU == '' OR $challan_fileU == NULL)
                      { ?>
                                            <a style="margin-top: 2px" data-id="<?php echo $id ?>" href="#edit"
                                                data-toggle='modal' title="Upload File"
                                                class="Data_Ajax btn btn-sm btn-success title shadow">Upload Challan</a>
                                            <?php } else
                      { ?>
                                            <a style="margin-top: 2px" data-id="<?php echo $id ?>" href="#edit"
                                                data-toggle='modal' title="View Challan"
                                                class="Data_Ajax2 btn btn-sm btn-info title shadow"><i
                                                    class="fa fa-receipt"></i></a>
                                            <a style="margin-top: 2px" data-id="<?php echo $id ?>" href="#edit"
                                                data-toggle='modal' title="Update Challan"
                                                class="Data_Ajax3 btn btn-sm btn-success title shadow"><i
                                                    class="fa fa-edit"></i></a>
                                            <?php } ?>
                                            <!-- <a href="candidate_apply_info.php?apply_id=<?php echo $id ?>"
                                                class="btn btn-sm btn-warning title shadow" title="All Details"><i
                                                    class="fa fa-eye"></i></a> -->
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
    </div>
</section>
<?php
include "includes/footer.php";
?>
<script type="text/javascript">
function showDiv() {
    var check1 = $('#test0').val();
    var check2 = $('#test1').val();
    var check3 = $('#test2').val();
    if (check1 != '0' && check2 != '0' && check3 != '0') {
        $('#saveid').attr('disabled', false);
    } else {
        $('#saveid').attr('disabled', true);
    }
}

function undertaking() {
    if ($('#agree').is(":checked")) {
        $('#saveid').attr('disabled', false);
    } else {
        $('#saveid').attr('disabled', true);
    }
}


$('.Data_Ajax').click(function() {
    var apply_id = $(this).attr('data-id');
    $.ajax({
        method: 'POST',
        url: 'candidate_ajax.php',
        data: {
            apply_id: apply_id
        },
        datatype: "html",
        success: function(result) {
            $(".modal-content").html(result);
        }
    });
});


$('.Data_Ajax2').click(function() {
    var apply_id = $(this).attr('data-id');
    $.ajax({
        method: 'POST',
        url: 'candidate_ajax.php',
        data: {
            apply_id2: apply_id
        },
        datatype: "html",
        success: function(result) {
            $(".modal-content").html(result);
        }
    });
});


$('.Data_Ajax3').click(function() {
    var apply_id = $(this).attr('data-id');
    $.ajax({
        method: 'POST',
        url: 'candidate_ajax.php',
        data: {
            apply_id3: apply_id
        },
        datatype: "html",
        success: function(result) {
            $(".modal-content").html(result);
        }
    });
});
</script>

<!-- Modal Start-->
<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- Modal end -->


<?php
// ///////////Upload Challan/////////////////
if(isset($_POST['upload']))
{
    
    $apply_id = $_POST['apply_id'];
    date_default_timezone_set("Asia/Karachi");
    $date       = date("Y-m-d H:i:s");
    if($_FILES['challan_file']['name'] == '')
    {
      $challan_file = '';
    }
    else
    {
      $challan_file = mt_rand().$_FILES['challan_file']['name'];
      $temp_file  = $_FILES['challan_file']['tmp_name'];
      $challan_path    = "../../images/candidates/challans/".$challan_file;
      move_uploaded_file($temp_file,$challan_path);
    }
    $update = "UPDATE candidate_applied_post SET challan_file = '$challan_file', challan_upload_date = '$date' WHERE id = '$apply_id'";
    $run = mysqli_query($connection, $update);
    
    if($run)
    {
      echo "<!DOCTYPE html>
              <html>
                <body> 
                <script>
                Swal.fire(
                  'Uploaded !',
                  'Challan has been Uploaded Successfully',
                  'success'
                ).then((result) => {
                  if (result.isConfirmed) {
                     window.location.href = 'posts_applied.php';
                  }
                });
                </script>
                </body>
              </html>";
    }
}

/////////////Update Challan//////////////
if(isset($_POST['update']))
{
    
    $apply_id = $_POST['apply_id'];
    date_default_timezone_set("Asia/Karachi");
    $date       = date("Y-m-d H:i:s");
    $fetchData = "SELECT challan_file FROM candidate_applied_post WHERE id = '$apply_id'";
    $runData = mysqli_query($connection,$fetchData);
    $rowData = mysqli_fetch_array($runData);
    $challan_pathOld    = "../../images/candidates/challans/".$rowData['challan_file'];
    @unlink($challan_pathOld);

    $challan_file = mt_rand().$_FILES['challan_file']['name'];
    $temp_file  = $_FILES['challan_file']['tmp_name'];
    $challan_pathNew    = "../../images/candidates/challans/".$challan_file;
    move_uploaded_file($temp_file,$challan_pathNew);

    $update = "UPDATE candidate_applied_post SET challan_file = '$challan_file', challan_upload_date = '$date' WHERE id = '$apply_id'";
    $run = mysqli_query($connection, $update);
    
    if($run)
    {
       echo "<!DOCTYPE html>
              <html>
                <body> 
                <script>
                Swal.fire(
                  'Updated !',
                  'Challan has been Updated Successfully',
                  'success'
                ).then((result) => {
                  if (result.isConfirmed) {
                     window.location.href = 'posts_applied.php';
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
        // alert("File is too big! Upload File under 200kB");

        Swal.fire(
            'Error !',
            'File size is too big! upload file under 200kB !',
            'error'
        ).then((result) => {
            if (result.isConfirmed) {

            }
        });
    }
}
</script>