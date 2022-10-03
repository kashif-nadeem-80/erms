<?php
include "includes/header.php";
?>
<style>
  .modal { overflow: auto !important; }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Assiging Posts To Operators</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Assiging</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Select Operator</label>
            <select class="form-control select2" name="op_id" required>
              <option value="">Choose</option>
              <?php
              $fetchData = "SELECT * FROM management_users WHERE role_id = '3' AND status = '1'";
              $run = mysqli_query($connection,$fetchData);
              while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $name = $row['name'];
              ?>
              <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Project Title</label>
            <select class="form-control select2" id="proj" onchange="getPost()" name="projectId" required>
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
        <div class="col-md-4">
          <div class="form-group">
            <label>Posts</label>
            <select class="form-control select2" name="post" id="post_id" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group float-right">
            <input type="submit" value="Assign" name="save" id="assigBtn" class="btn btn-success shadow">
          </div>
        </div>
      </div>
    </form>
    <?php
      if(isset($_POST['save']))
      {
        $postId = $_POST['post'];
        $op_id = $_POST['op_id'];
        $fetch = "SELECT id FROM project_to_operator WHERE post_id = '$postId' AND operator_id = '$op_id'";
        $runQ = mysqli_query($connection,$fetch);
        $countR = mysqli_num_rows($runQ);
        if($countR != 0)
        {
          echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Error !',
                'This post already assigned to selected operator',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                   window.location.href = 'assign_project_operater.php';
                }
              });
              </script>
              </body>
            </html>";
        }
        else
        {
          $fetch2 = "SELECT id FROM project_to_operator WHERE operator_id = '$op_id' AND status = '1'";
          $runQ2 = mysqli_query($connection,$fetch2);
          $countR2 = mysqli_num_rows($runQ2);

          if($countR2 != 0)
          {
            echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
                Swal.fire(
                  'Error !',
                  'This Operator already active in some other post',
                  'error'
                ).then((result) => {
                  if (result.isConfirmed) {
                     window.location.href = 'assign_project_operater.php';
                  }
                });
              </script>
              </body>
            </html>";
          }
          else
          {
            $insert = "INSERT INTO `project_to_operator`(`post_id`, `operator_id`) VALUES('$postId', '$op_id')";
            $run = mysqli_query($connection,$insert);
            if($run)
            {
              echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Assigned !',
                    'Post have been assigned successfully',
                    'success'
                  ).then((result) => {
                    if (result.isConfirmed) {
                       window.location.href = 'assign_project_operater.php';
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
                    'Some error occure',
                    'error'
                  ).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = 'assign_project_operater.php';
                    }
                  });
                  </script>
                  </body>
                </html>";
            }
          }

          
        }
      }
    ?>
    <hr>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-hover table-bordered datatable" style="font-size: 12px" data-page-length = "100">
          <thead class="bg-dark">
            <tr>
              <th>S.No</th>
              <th>Operator</th>
              <th>Project</th>
              <th>Post</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $count = 0;
          $fetchData= "SELECT u.name, p.post_name, u.id AS operatorid, p.post_bps, o.id, o.status, pj.project_name FROM management_users AS u INNER JOIN project_to_operator AS o ON o.operator_id = u.id INNER JOIN projects_posts AS p ON p.id = o.post_id INNER JOIN projects AS pj ON pj.id = p.project_id ORDER BY pj.id DESC, u.name ASC";
          $runData = mysqli_query($connection,$fetchData);
          while($rowData = mysqli_fetch_array($runData)) {
            $count++;
            $id           = $rowData['id'];
            $operatorid   = $rowData['operatorid'];
            $name         = $rowData['name'];
            $project_name = $rowData['project_name'];
            $post_name    = $rowData['post_name'];
            $post_bps     = $rowData['post_bps'];
            if($rowData['status'] == '1')
            {
              $status = "Active";
            }
            else
            {
              $status = "Inactive";
            }

          ?>
            <tr>
              <td><?php echo $count ?></td>
              <td><?php echo $name ?></td>
              <td><?php echo $project_name ?></td>
              <td><?php echo $post_name." (BPS-".$post_bps; ?></td>
              <td><?php echo $status ?></td>
              <td>
                <input type="hidden" id="opertorID<?php echo $id ?>" value="<?php echo $operatorid ?>">
                <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax(<?php echo $id ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

                <a class="btn btn-sm btn-danger shadow text-white" title="Delete" onclick="deleteData(<?php echo $id ?>)"><span><i class="fa fa-trash-alt"></i></span></a>
              </td>
            </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php
  include "includes/footer.php";
?>

<?php
  if(isset($_GET['deletId']))
  {
    $id = $_GET['deletId'];
    $delete = "DELETE FROM project_to_operator WHERE id = '$id'";
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
               window.location.href = 'assign_project_operater.php';
            }
          });
          </script>
          </body>
        </html>";
    }
  }
?>



<script type="text/javascript">
  function Data_Ajax(id) {
    let opertorID = $("#opertorID"+id).val();
    let assign_postId = id;
    $.ajax({
      method: 'POST',
      url: 'assign_project_operaterAjax.php',
      data: {
        assign_postId: assign_postId,
        opertorID: opertorID
      },
      datatype: "html",
      success: function(data) {
        $(".modal_data").html(data);
      }
    });
  }

  function getPost()
  {    
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'assign_project_operaterAjax.php',
      data: {
          projId: projId
      },
      dataType: "html",
      success:function(result){
        $("#post_id").html(result);
      }
    });
  }

  function deleteData(id)
  {
    var deg_id = id;
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
        window.location.href= "assign_project_operater.php?deletId="+deg_id;
      }
  });

  }
</script>

<!-- Modal Start-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal_data">

    </div>
  </div>
</div>
<!-- Modal end -->


<?php
  if(isset($_POST['updateStatus']))
  {
    $id = $_POST['projToOpId'];
    $operatrid = $_POST['operatrid'];
    $opp_status = $_POST['opp_status'];
    if($opp_status == '0')
    {
      $query = "UPDATE project_to_operator SET status = '$opp_status' WHERE id = '$id'";
      $runq = mysqli_query($connection,$query);
      if($runq)
      {
        echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Updated !',
              'The selected record has been updated',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'assign_project_operater.php';
              }
            });
            </script>
            </body>
          </html>";
      }
    }
    else
    {
      $fetch3 = "SELECT id FROM project_to_operator WHERE operator_id = '$operatrid' AND status = '1'";
      $runQ3 = mysqli_query($connection,$fetch3);
      $countR3 = mysqli_num_rows($runQ3);

      if($countR3 != 0)
      {
        echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
            Swal.fire(
              'Error !',
              'This Operator already active in some other post',
              'error'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'assign_project_operater.php';
              }
            });
          </script>
          </body>
        </html>";
      }
      else
      {
        $query = "UPDATE project_to_operator SET status = '$opp_status' WHERE id = '$id'";
        $runq = mysqli_query($connection,$query);
        if($runq)
        {
          echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Updated !',
                'The selected record has been updated',
                'success'
              ).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'assign_project_operater.php';
                }
              });
              </script>
              </body>
            </html>";
        }
      }
    }
  }
?>