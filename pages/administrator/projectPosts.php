<?php
include "includes/header.php";
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Project Posts</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Posts</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container">
    <form method="POST">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Project ID <span class="text-danger">*</span></label>
            <select class="form-control select2" onchange="getChallan(1)" name="proj_id" id="projID1"
              required>
              <option value="">Choose</option>
              <?php
              $fetch1 = "SELECT id, project_id FROM projects WHERE status = '1' ORDER BY id DESC";
              $run1 = mysqli_query($connection,$fetch1);
              while($row1 = mysqli_fetch_array($run1))
              {
              $id  = $row1['id'];
              $project_id  = $row1['project_id'];
              ?>
              <option value="<?php echo $id ?>"><?php echo $project_id ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Post Name <span class="text-danger">*</span></label>
            <input type="text" name="post_name" placeholder="Post Name" class="form-control" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Challan Title <span class="text-danger">*</span></label>
            <select class="form-control select2" id="chalanID1" name="challan" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>BPS <span class="text-danger">*</span></label>
            <input type="number" name="post_bps" placeholder="BPS" class="form-control" onKeyPress="if(this.value.length==2) return false;" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>No of Posts <span class="text-danger">*</span></label>
            <input type="number" name="no_of_posts" placeholder="No of Posts" class="form-control" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Age Lower Limitd</label>
            <input type="number" class="form-control" onKeyPress="if(this.value.length==2) return false;" name="age_lower" placeholder="Age Lower Limit">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Age Upper Limit</label>
            <input type="number" class="form-control" onKeyPress="if(this.value.length==2) return false;" name="age_upper" placeholder="Age Upper Limit">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <center>
          <input type="submit" class="btn btn-success shadow" value="Add" name="submit">
          </center>
        </div>
      </div>
    </form>
    <?php
    if(isset($_POST['submit']))
    {
    $proj_id   = $_POST['proj_id'];
    $post_name   = $_POST['post_name'];
    $post_bps    = $_POST['post_bps'];
    $no_of_posts = $_POST['no_of_posts'];
    $challan     = $_POST['challan'];
    $age_lower   = $_POST['age_lower'];
    $age_upper   = $_POST['age_upper'];
    $fetch = "SELECT * FROM projects_posts WHERE post_name = '$post_name' AND post_bps = '$post_bps' AND project_id = '$proj_id'";
    $run = mysqli_query($connection,$fetch);
    $countrec = mysqli_num_rows($run);
    if($countrec == 0)
    {
    $query = "INSERT INTO `projects_posts`(`proj_challan_id`,`post_name`, `post_bps`,`no_of_posts`, `project_id`,`age_lower`, `age_upper`) VALUES ('$challan','$post_name','$post_bps','$no_of_posts','$proj_id','$age_lower','$age_upper')";
    $result = mysqli_query($connection,$query);
    }
    if(@$result)
    {
    echo "<!DOCTYPE html>
    <html>
      <body>
        <script>
        Swal.fire(
        'Post !',
        'Post has been added successfully',
        'success'
        ).then((result) => {
        if (result.isConfirmed) {
        window.location.href = 'projectPosts.php';
        }
        });
        </script>
      </body>
    </html>";
    }
    }
    ?>
  </div>
  <div class="row">
    <div class="col-md-12 table-responsive">
      <table class="table table-bordered bg-white datatable" data-page-length="25" style="font-size: 12px">
        <thead class="bg-dark">
          <tr>
            <th width="6%">S.No</th>
            <th width="22%">Project Title</th>
            <th width="22%">Post Name</th>
            <th width="6%">BPS</th>
            <th width="7%">No of Posts</th>
            <th width="20%">Challan Title</th>
            <th width="2%">Age Lower</th>
            <th width="2%">Age Upper</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 0;
          $fetchData= "SELECT p.project_name,p.project_id,pp.id,pp.post_name,pp.post_bps,pp.no_of_posts,pp.age_lower,pp.age_upper,pc.challan_title,pc.id AS c_id FROM projects_posts AS pp INNER JOIN projects AS p ON p.id = pp.project_id LEFT JOIN projects_challans AS pc ON pc.id = pp.proj_challan_id WHERE p.status = '1' ORDER BY pp.id DESC, p.project_name ASC";
          $runData = mysqli_query($connection,$fetchData);
          while($rowData = mysqli_fetch_array($runData)) {
          $count++;
          $id  = $rowData['id'];
          $project_name  = $rowData['project_name'];
          $project_id  = $rowData['project_id'];
          $c_id  = $rowData['c_id'];
          $post_name  = $rowData['post_name'];
          $post_bps  = $rowData['post_bps'];
          $no_of_posts  = $rowData['no_of_posts'];
          $challan_title  = $rowData['challan_title'];
          $age_lower  = $rowData['age_lower'];
          $age_upper  = $rowData['age_upper'];
          ?>
          <tr>
            <td><?php echo $count ?></td>
            <td><?php echo $project_name." (".$project_id.")"; ?></td>
            <td><?php echo $post_name ?></td>
            <td><?php echo $post_bps ?></td>
            <td><?php echo $no_of_posts ?></td>
            <td>
              <a
              href="project_challan_view_post2.php?challan_id=<?php echo $c_id ?>"><?php echo $challan_title ?></a>
            </td>
            <td><?php echo $age_lower ?></td>
            <td><?php echo $age_upper ?></td>
            <td>
              <input type="hidden" id="pst_id<?php echo $count ?>" value="<?php echo $id ?>">
              <a onclick="deleteData(<?php echo $count ?>)"
                class="btn btn-sm btn-danger title shadow text-white" title="Delete"
                onclick="return confirm('Are you sure you want to delete, the action cannot be undo !')"><span><i
                class="fa fa-trash"></i></span></a>
                <a href="project_posts_edit2.php?challan_id=<?php echo $id ?>"
                  class="btn btn-sm btn-info title shadow" title="Edit"><span><i
                  class="fa fa-edit"></i></span></a>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
  function getChallan(id) {
  var projID = $("#projID" + id).val();
  $.ajax({
  method: 'POST',
  url: 'project_post_ajax.php',
  data: {
  projID: projID
  },
  dataype: "html",
  success: function(result) {
  $("#chalanID" + id).html(result);
  }
  });
  }
  function deleteData(id) {
  var pst_id = $("#pst_id" + id).val();
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
  window.location.href = "projectPosts.php?deleteId=" + pst_id;
  }
  });
  }
  </script>
  <?php
  if(isset($_GET['deleteId']))
  {
  $deleteId = $_GET['deleteId'];
  $delete = "DELETE FROM projects_posts WHERE id = '$deleteId'";
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
      window.location.href = 'projectPosts.php';
      }
      });
      </script>
    </body>
  </html>";
  }
  }
  ?>
  <?php
  include "includes/footer.php";
  // include "projectPosts_row.php";
  ?>