<?php
include "includes/header.php";
$proj_id = $_GET['proj_id'];
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Project Information</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Project Information</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="project_list.php" class="btn btn-warning shadow mb-1">Back</a>
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Project Information</div>
          </div>
          <?php
          $query = "SELECT * FROM projects WHERE id = '$proj_id'";
          $result = mysqli_query($connection,$query);
          while($row = mysqli_fetch_array($result))
          {
          $project_name = $row['project_name'];
          $project_id = $row['project_id'];
          $organization = $row['organization'];
          $start_date = date("d-m-Y",strtotime($row['start_date']));
          $last_date = date("d-m-Y",strtotime($row['last_date']));
          $create_date = date("d-m-Y",strtotime($row['create_date']));
          $update_date = date("d-m-Y",strtotime($row['update_date']));
          $status = $row['status'];
          if($row['status'] == '1')
          {
          $status   = "Active";
          }
          else
          {
          $status   = "In-Active";
          }
          }
          ?>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Project Name</label>
                  <input type="text" class="form-control" value="<?php echo $project_name;?>" disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Project Id</label>
                  <input type="text" class="form-control" value="<?php echo $project_id;?>"disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Organization</label>
                  <input type="text" class="form-control" value="<?php echo $organization;?>"disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Start Date</label>
                  <input type="text" class="form-control" value="<?php echo $start_date;?>"disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Last Date</label>
                  <input type="text" class="form-control" value="<?php echo $last_date;?>"disabled>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Create Date</label>
                  <input type="text" class="form-control" value="<?php echo $create_date;?>"disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Upate Date</label>
                  <input type="text" class="form-control" value="<?php echo $update_date;?>"disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Status</label>
                  <input type="text" class="form-control" value="<?php echo $status;?>"disabled>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h3 class=" text-primary text-center">Post's Details</h3>
        <table class="table table-bordered bg-white">
          <thead class="bg-dark">
            <tr>
              <th width="6%">S.No</th>
              <th width="48%">Post Name</th>
              <th width="8%">BPS</th>
              <th width="13%">No of Posts</th>
              <th width="25%">Challan Title</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            $fetchData= "SELECT pp.id,pp.post_name,pp.post_bps,pp.no_of_posts,pc.challan_title,pc.id AS c_id FROM projects_posts AS pp LEFT JOIN projects_challans AS pc ON pc.id = pp.proj_challan_id WHERE pp.project_id = '$proj_id' ORDER BY pp.id ASC";
            $runData = mysqli_query($connection,$fetchData);
            while($rowData = mysqli_fetch_array($runData)) {
            $count++;
            $id  = $rowData['id'];
            $c_id  = $rowData['c_id'];
            $post_name  = $rowData['post_name'];
            $post_bps  = $rowData['post_bps'];
            $no_of_posts  = $rowData['no_of_posts'];
            $challan_title  = $rowData['challan_title'];
            ?>
            <tr>
              <td><?php echo $count ?></td>
              <td><?php echo $post_name ?></td>
              <td><?php echo $post_bps ?></td>
              <td><?php echo $no_of_posts ?></td>
              <td>
                <a href="post_challan.php?challan_id=<?php echo $c_id ?>"><?php echo $challan_title ?></a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</section>
<?php include "includes/footer.php"; ?>