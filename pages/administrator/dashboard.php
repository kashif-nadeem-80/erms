<?php
include('includes/header.php');
?>
<style type="text/css">
  .inner:hover {
opacity: 0.6;
}
</style>
<br>
<?php
$activePostsQuery = "SELECT po.id FROM projects_posts AS po LEFT JOIN projects AS p 
                            ON p.id=po.project_id WHERE p.status='1'";
$actPostsQ = mysqli_query($connection, $activePostsQuery);

$activePosts = [];
while($actPostsRes = mysqli_fetch_array($actPostsQ)) {
    array_push($activePosts, $actPostsRes['id']);
}
$posts = implode(',', $activePosts);
?>
<section class="content">
  <div class="container-fluid">
    <h2>Administration Dashboard</h2>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary shadow">
              <div class="inner">
                <h3>
                  <?php
                    $query = "SELECT count(distinct candidate_id) AS total FROM candidate_applied_post WHERE post_id IN ($posts)";
                    $result = mysqli_query($connection,$query);
                    $total = mysqli_fetch_assoc($result);
                    echo $total['total'];
                  ?>
                </h3>
                <p>Total Registration</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="registered_users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success shadow">
              <div class="inner">
                <h3>
                  <?php

                    $query = "SELECT * FROM candidate_applied_post WHERE post_id IN ($posts)";
                    $result = mysqli_query($connection,$query);
                    echo $total = mysqli_num_rows($result);
                  ?>
                </h3>
                <p>Total Apply</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="report_application_sumarize.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning shadow">
              <div class="inner">
                <h3>
                  <?php
                    $query = "SELECT * FROM candidate_applied_post WHERE post_id IN ($posts) AND challan_file != ''";
                    $result = mysqli_query($connection,$query);
                    echo $total = mysqli_num_rows($result);
                  ?>
                </h3>

                <p>Total Apply With Challan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="candidate_withChallan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <hr style="border:2px solid darkblue;">
          <form method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Project Title</label>
                  <select class="form-control select2" name="projectId" required>
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
                  <label>Candidate CNIC #</label>
                  <input type="text" name="cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" maxlenght="15" class="form-control">
                </div>
              </div>
              <br>
              <div class="col-md-12 text-center">
                <input type="submit" name="chechcnic" class="btn btn-info shadow" value="Search">
              </div>
            </div>
          </form>
          <?php
          if(isset($_POST['chechcnic']))
          {
            $project_id = $_POST['projectId'];
            $cnic       = $_POST['cnic'];
            ?>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-hover datatable bg-white table-responsive"  style="font-size: 11px" data-page-length="100">
                  <thead class="bg-dark printColor">
                    <tr>
                      <th width="6%">S.No</th>
                      <th>Post</th>
                      <th>Name</th>
                      <th>Father/Guardian Name</th>
                      <th>Gender</th>
                      <th>CNIC NO</th>
                      <th>Contact No</th>
                      <th>Test City</th>
                      <th>Apply Date</th>
                      <th>Application Status</th>
                      <th>Status Details</th>
                      <th>Image</th>
                      <th class="printBlock">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image, ct.c_name, cp.apply_date, cp.status,
                      cp.status_details, cp.challan_file, cp.challan_upload_date, pp.post_name FROM candidate_applied_post AS cp LEFT JOIN candidates AS c ON c.id = cp.candidate_id LEFT JOIN projects_posts AS pp ON pp.id = cp.post_id LEFT JOIN projects AS p ON p.id = pp.project_id LEFT JOIN city AS ct ON ct.id = cp.city_id WHERE p.id = '$project_id' AND c.cnic = '$cnic' ORDER BY pp.post_name ASC";
                      $runQ = mysqli_query($connection,$fetchData);
                      $count = 0;
                      while ($rowQ = mysqli_fetch_array($runQ)) {
                        $count++;
                        $post_name = $rowQ['post_name'];
                        $applyId = $rowQ['apply_id'];
                        $cand_id = $rowQ['cand_id'];
                        $name = $rowQ['name'];
                        $f_name = $rowQ['f_name'];
                        $path = "../../images/candidates/profile picture/".$rowQ['image'];
                        $gender = $rowQ['gender'];
                        $cnic = $rowQ['cnic'];
                        $phone = $rowQ['phone'];
                        $c_name = $rowQ['c_name'];
                        $status = $rowQ['status'];
                        $status_details = $rowQ['status_details'];
                        $apply_date = date("d-m-Y",strtotime($rowQ['apply_date']));
                        $challan_file = $rowQ['challan_file'];
                        $challan_upload_date = date("d-m-Y",strtotime($rowQ['challan_upload_date']));
                    ?>
                    <tr>
                      <td>
                        <?php echo $count ?>
                        <input type="hidden" id="autoInc<?php echo $count ?>" value="<?php echo $count ?>">
                        <input type="hidden" id="applyId<?php echo $count ?>" value="<?php echo $applyId ?>">
                        <input type="hidden" id="cand_id<?php echo $count ?>" value="<?php echo $cand_id ?>">
                        <input type="hidden" id="pic_name<?php echo $count ?>" value="<?php echo $rowQ['image'] ?>">
                      </td>
                      <td><?php echo $post_name ?></td>
                      <td><?php echo $name ?></td>
                      <td><?php echo $f_name ?></td>
                      <td><?php echo $gender ?></td>
                      <td><?php echo $cnic ?></td>
                      <td><?php echo $phone ?></td>
                      <td><?php echo $c_name ?></td>
                      <td><?php echo $apply_date ?></td>
                      <td><b><?php echo $status ?></b></td>
                      <td><?php echo $status_details ?></td>
                      <td>

                        <?php
                          if($rowQ['image'] == NULL OR $rowQ['image'] == '')
                          {
                            echo "Image Not Found";
                          }
                          else
                          {
                            echo '<a href="#image_view" data-toggle="modal" onclick="pic_view('.$count.')"><img id="log1" class="shadow" style="border: 1px blue solid; border-radius: 5px;" width="60px;" height="60px"  src="'.$path.'" alt="Candidate Image"></a>';
                          }
                          ?>
                      </td>
                      <td class="printBlock">
                        <a class="btn btn-sm btn-success title shadow" onclick="Data_Ajax1(<?php echo $count ?>)" title="Update Status" href="#edit" data-toggle='modal'><i class="fa fa-edit"></i></a>

                        <a style="margin-top: 2px" onclick="challan_view(<?php echo $count ?>)" href="#edit" data-toggle='modal' title="View Challan" class="btn btn-sm btn-info title shadow"><i class="fa fa-receipt"></i></a>

                        <a style="margin-top: 2px" target="_blank" href="personal_info_view.php?can_id=<?php echo $cand_id ?>" class="detail btn btn-sm btn-warning shadow title" title="Cadidate's Details"><span><i class="fa fa-eye"></i></span>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
        <?php } ?>

        <hr style="border:2px solid darkblue;">

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Project Title</label>
                <select class="form-control select2" id="proj" onchange="getPost()" required>
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
                <label>Posts</label>
                <select class="form-control select2" onchange="getApplicantData()" name="post" id="post_id" required>
                  <option value="0">First Select Project</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Application Status</label>
                <select class="form-control select2" onchange="getApplicantData()" id="candStatus" required>
                  <option value="Pending">Pending</option>
                  <option value="Accepted">Accepted</option>
                  <option value="Inquiry">Inquiry</option>
                  <option value="Rejected">Rejected</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label>City</label>
                <select class="form-control select2" onchange="getApplicantData()" name="city" id="city_id" required>
                  <option value="0">All</option>
                  <?php
                  $fetchData = "SELECT * FROM city ORDER BY c_name ASC";
                  $run = mysqli_query($connection,$fetchData);
                  while ($row = mysqli_fetch_array($run)) {
                    $id = $row['id'];
                    $name = $row['c_name'];
                  ?>
                  <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
              <div class="col-md-12 text-right">
                  <input type="button" class="btn btn-success" onclick="exportDataToExcel()" value="Export To Excel">
              </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-md-12">
              <div id="ajaxData">
                <table class="table table-hover bg-white" id="ajaxDataTable" data-page-length="100" style="margin0; width: 100%;font-size: 11px">
                  <thead class="bg-dark">
                    <tr>
                      <th width="6%">S.No</th>
                      <th>Name</th>
                      <th>Father/Guardian Name</th>
                      <th>Gender</th>
                      <th>CNIC NO</th>
                      <th>Contact No</th>
                      <th>Test City</th>
                      <th>Apply Date</th>
                      <th>Application Status</th>
                      <th>Status Details</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- card body end -->
    </div>
    <!-- card end -->
  </div>
</section>

<?php include('includes/footer.php') ?>
<script type="text/javascript">
  function getPost()
  {
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'admin_ajax.php',
      data: {
          projId: projId
      },
      dataType: "html",
      success:function(result){
        $("#post_id").html(result);
      }
    }).done(function(){
      getApplicantData();
    });
  }

  function exportDataToExcel() {
      var post_id = $("#post_id").val();
      var city_id = $("#city_id").val();
      var candStatus = $("#candStatus").val();
      if(post_id != '' && post_id != '0') {
          window.open('application_export_excel.php?postId='+post_id+'&city_id='+city_id+'&candStatus='+candStatus);
          // $("#preloader").fadeIn(100);
          // $.ajax({
          //     method:'POST',
          //     url:'application_export_execl.php',
          //     data: {
          //         postId: post_id,
          //         city_id: city_id,
          //         candStatus: candStatus
          //     },
          //     dataType: "json",
          //     success:function(result){
          //         console.log("Result::", result);
          //         // $("#ajaxData").html(result);
          //         // $(".datatable").DataTable();
          //         $("#preloader").fadeOut(100);
          //
          //     }
          // });
      }
  }
    $(document).ready(function() {

    })
  function getApplicantData()
  {
      if ($.fn.DataTable.isDataTable('#ajaxDataTable')) {
          $('#ajaxDataTable').dataTable().fnClearTable();
          $('#ajaxDataTable').dataTable().fnDestroy();

      }
      var post_id = $("#post_id").val();
      var city_id = $("#city_id").val();
      var candStatus = $("#candStatus").val();

      $('#ajaxDataTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',

          'ajax': {
              'url':'applications_data_ajax.php',
              'data': function(d) {
                  d.post_id2 = $("#post_id").val();
                  d.city_id =  $("#city_id").val();
                  d.candStatus = $("#candStatus").val();
              }
          },
          'columns': [
              { data: 'sno' },
              { data: 'name' },
              { data: 'fatherName' },
              { data: 'gender' },
              { data: 'cnic' },
              { data: 'contact_no' },
              { data: 'test_city' },
              { data: 'apply_date' },
              { data: 'status' },
              { data: 'status_detail' },
              { data: 'image' },
              { data: 'action' },
          ]

      });
    // var post_id = $("#post_id").val();
    // var city_id = $("#city_id").val();
    // var candStatus = $("#candStatus").val();
    //
    // if(post_id != '0' && city_id != '0')
    // {
    //   $("#preloader").fadeIn(100);
    //
    //   $.ajax({
    //     method:'POST',
    //     url:'applications_data_ajax.php',
    //     data: {
    //         postId: post_id,
    //         city_id: city_id,
    //         candStatus: candStatus
    //     },
    //     dataType: "html",
    //     success:function(result){
    //       $("#ajaxData").html(result);
    //       $(".datatable").DataTable();
    //       $("#preloader").fadeOut(100);
    //
    //     }
    //   });
    // }
    // else if(post_id != '0' && city_id == '0')
    // {
    //   $("#preloader").fadeIn(100);
    //
    //   $.ajax({
    //     method:'POST',
    //     url:'applications_data_ajax.php',
    //     data: {
    //         post_id2: post_id,
    //         candStatus: candStatus
    //     },
    //     dataType: "html",
    //     success:function(result){
    //
    //       $("#ajaxData").html(result);
    //       $(".datatable").DataTable();
    //       $("#preloader").fadeOut(100);
    //
    //     }
    //   });
    // }
    // else if(post_id == '' && city_id == '0')
    // {
    //   $("#ajaxData").html("");
    // }
  }

  function pic_view(id)
  {
    $("#preloader").fadeIn(100);

    var pic_name = $("#pic_name"+id).val();
    $.ajax({
      method:'POST',
      url:'applications_data_ajax.php',
      data: {
        pic_name: pic_name
      },
      datatype: "html",
      success:function(result){

        $(".image_view").html(result);
    $("#preloader").fadeOut(100);

    }
    });
  }

</script>

<!--Pic View Modal Start-->
<div class="modal fade" id="image_view" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width:450px" role="document">
    <div class="modal-content image_view">

    </div>
  </div>
</div>
<!-- Modal end -->

<script type="text/javascript">
function Data_Ajax1(id) {

  var applyId = $("#applyId"+id).val();
  var autoInc = $("#autoInc"+id).val();
  $.ajax({
    method: 'POST',
    url: 'admin_ajax.php',
    data: {
      applyId_for_status: applyId,
      autoInc: autoInc
    },
    datatype: "html",
    success: function(data) {
      $(".modal_data").html(data);
    }
  });
}

function insertData1(id)
{
  $.ajax({
    url: 'admin_ajax.php',
    type: 'POST',
    data: $('#form_submit1').serialize(),
    dataType: 'html',
    success: function(data){
    }
  }).done(function(){
    getApplicantData();
  });
}


function challan_view(id) {
  var applyId = $("#applyId"+id).val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
      apply_id: applyId
    },
    datatype: "html",
    success:function(result){
      $(".modal_data").html(result);
  }
  });
}

function applicant_view(id){
  var cand_id = $("#cand_id"+id).val();
  $.ajax({
    method:'POST',
    url:'applicant_details_ajax.php',
    data: {
      applicant_id: cand_id
    },
    datatype: "html",
    success:function(result){
      $(".info_appl").html(result);
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


<!-- Modal Start-->
<div class="modal fade" id="info_appl" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered mw-100 w-75" role="document" >
    <div class="modal-content info_appl" >

    </div>
  </div>
</div>
<!-- Modal end -->

<!-- Modal Start-->
<div class="modal fade" id="edit1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog bg-white" style="border: blue 2px solid; border-radius: 8px" role="document">
    <div class="modal-content1">

    </div>
  </div>
</div>
<!-- Modal end -->