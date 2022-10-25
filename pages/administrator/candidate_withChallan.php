<?php
include "includes/header.php";
?>
<style type="text/css">
.swal-footer {
text-align: center;
}
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Candidate with Challan Details</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Candidate with Challan Details</li>
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
        <div class="card card-dark">
          <div class="card-header">
            <div class="card-title">Candidate with Challan Details</div>
            <div class="card-tools">
            </div>
          </div>
          <br>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <!-- Table start -->
            <table class="table table-striped table-bordered" style="font-size: 12px">
              <thead class="bg-dark">
                <tr>
                  <th width="2%">S.No</th>
                  <th width="10%">Name</th>
                  <th width="10%">Post Applied</th>
                  <th width="2%">BPS</th>
                  <th width="26%">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once "./includes/pagination_config.php";
                $result_count = mysqli_query(
                    $connection,
                    "SELECT COUNT(*) As total_records FROM projects_posts AS p 
                                LEFT JOIN candidate_applied_post AS ca ON ca.post_id = p.id 
                            INNER JOIN candidates as can ON can.id= ca.candidate_id WHERE ca.challan_file IS NOT NULL AND ca.post_id > 3"
                );
                $total_records = mysqli_fetch_array($result_count);
                $total_records = $total_records['total_records'];
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total pages minus 1


                $count = 0;
                $fetchData= "SELECT can.name,can.id, ca.id AS application_id, ca.status_details, ca.status, 
                            p.post_name, p.post_bps FROM projects_posts AS p 
                                LEFT JOIN candidate_applied_post AS ca ON ca.post_id = p.id 
                INNER JOIN candidates as can ON can.id= ca.candidate_id WHERE ca.challan_file IS NOT NULL AND ca.post_id > 3 
                LIMIT $offset, $total_records_per_page
                ";
                $runData = mysqli_query($connection,$fetchData);
                while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id         = $rowData['id'];
               
                $name      = $rowData['name'];
                $postname  = $rowData['post_name'];
                $post_bps  = $rowData['post_bps'];
                $status = $rowData['status'];
                $status_details = $rowData['status_details'];
                $application_id = $rowData['application_id'];
                //$app_form       = $rowData['app_form'];
                //$app = "../../images/admin/project/app_form/".$app_form;
                ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td>
                <a href="personal_info_view.php?can_id=<?php echo $id ?>" class="btn btn-sm btn-info shadow title" title="for detail click"><?php echo $name ?></a>
                </td>
                  <td><?php echo $postname ?></td>
                  <td><?php echo $post_bps ?></td>
             
                  <td>
                      <div class="row">
                          <div class="col-md-3">
                              <select class="form-control" id="status-<?php echo $application_id;?>">
                                  <option value="">Select Status</option>
                                  <option value="Pending" <?php if($status == 'Pending'){ echo "selected";}?> >Pending</option>
                                  <option value="Accepted" <?php if($status == 'Accepted'){ echo "selected";}?>>Accepted</option>
                                  <option value="Inquiry" <?php if($status == 'Inquiry'){ echo "selected";}?>>Inquiry</option>
                                  <option value="Rejected" <?php if($status == 'Rejected'){ echo "selected";}?>>Rejected</option>
                              </select>
                          </div>
                          <div class="col-md-7">
                              <input placeholder="Please provide a reason if any!" type="text" class="form-control"
                                     value="<?php echo $status_details;?>" id="status-reason-<?php echo $application_id;?>"></div>
                          <div class="col-md-2">
                              <input type="button" onclick="handleStatusUpdate('<?php echo $application_id;?>')" value="Update" class="btn btn-success">
                          </div>
                      </div>


                  </td>
                  
                            </tr>
                            <?php }?>
                          </tbody>
                        </table>
              <?php
              require_once "./includes/pagination_ui.php"
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
                function handleStatusUpdate(application_id) {
                    var status = $("#status-" + application_id).val();
                    var reason = $("#status-reason-" + application_id).val();
                    $.ajax({
                        method: 'POST',
                        url: 'admin_ajax.php',
                        data: {
                            appId: application_id,
                            updateStatus: 1,
                            status: status,
                            reason: reason
                        },
                        datatype: "html",
                        success: function(result) {
                            if(result == '1') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: "Candidate status has been updated successfully!",
                                    icon: 'success',
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "Something went wrong!",
                                    icon: 'error',
                                });
                            }
                        }
                    });
                }
            function deleteData(id) {
            var p_id = $("#p_id" + id).val();
            Swal.fire({
            title: 'Are you sure?',
            text: "To complete the selected record !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, complete it!'
            }).then((result) => {
            if (result.isConfirmed) {
            window.location.href = "project_list.php?disId=" + p_id;
            }
            });
            }
            </script>
            <?php
            if(isset($_GET['disId']))
            {
            $id = $_GET['disId'];
            $update = "UPDATE projects SET status = '0' WHERE id = '$id'";
            $run = mysqli_query($connection,$update);
            
            if($run)
            {
            echo "<!DOCTYPE html>
            <html>
              <body>
                <script>
                Swal.fire(
                'Disabled !',
                'The selected record has been convert to completed',
                'success'
                ).then((result) => {
                if (result.isConfirmed) {
                window.location.href= 'project_list.php';
                }
                });
                </script>
              </body>
            </html>";
            }
            }
            ?>