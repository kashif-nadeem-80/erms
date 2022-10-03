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
        <h4 class="m-0 text-dark">Reject Projects</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Reject</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <form method="post">
      <div class="row">
        <div class="col-md-6">
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
            <label>Minimun Education</label>
            <select class="form-control select2" onchange="getApplicantData()" name="education" id="edu_level" required>
              <?php
              $fetchData = "SELECT * FROM edu_level ORDER BY level_name ASC";
              $run = mysqli_query($connection,$fetchData);
              while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $name = $row['level_name'];
              ?>
              <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php } ?>
            </select>
          </div>
        </div>
         <div class="col-md-4">
           <div class="form-group">
            <label>Upto Date</label>
            <input type="date" value="<?php echo date('Y-m-d') ?>" id="uptoDate" onchange="getApplicantData()" name="uptoDate" class="form-control">
          </div>
        </div>
      </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData">
        </div>
      </div>
    </div>
  </form>
  </div>
</section>
<?php 
if(isset($_POST['Update_All']))
{
                // Challan Missing Rejection
              $fetchData_chalan = "SELECT cp.challan_file,c.id AS c_id FROM candidate_applied_post AS cp
                INNER JOIN candidates AS c ON c.id = cp.candidate_id
                INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
                INNER JOIN projects AS p ON p.id = pp.project_id
                WHERE cp.challan_file IS NULL";
                $run_chalan = mysqli_query($connection,$fetchData_chalan);
                while($row_chalan = mysqli_fetch_array($run_chalan)) 
    {
                 $c_id = $row_chalan['c_id']; 
                 $upto_Challan = "UPDATE candidate_applied_post AS cp SET status = 'Rejected', status_details = 'Challan is missing'  WHERE  cp.candidate_id='$c_id' ";
                 $run_chalan2 = mysqli_query($connection,$upto_Challan);
    }
              // Loower Age Rejection
         $uptoDate = $_POST['uptoDate'];
         $fetchData_lower = "SELECT (ROUND((TIMESTAMPDIFF(DAY,c.dob,'2020-03-19')/365.28),3)) AS age,c.id AS c_id,pp.age_lower,pp.age_upper,cp.status FROM candidate_applied_post AS cp
            INNER JOIN candidates AS c ON c.id = cp.candidate_id
            INNER JOIN projects_posts AS pp ON pp.id = cp.post_id
            INNER JOIN projects AS p ON p.id = pp.project_id
            
             WHERE  pp.age_lower BETWEEN (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoDate')/365.28),3)) and pp.age_lower";
            $runQ_lower = mysqli_query($connection,$fetchData_lower);
           while ($rowQ_lower = mysqli_fetch_array($runQ_lower)) 
           {
                 $lower_c_id = $rowQ_lower['c_id'];
                 $update_lower = "UPDATE candidate_applied_post AS cp SET status = 'Rejected', status_details = 'Under Age'  WHERE  cp.candidate_id='$lower_c_id' ";
                 $run_chalan3 = mysqli_query($connection,$update_lower);
           }    
         // Required Education Missing
         $education = $_POST['education'];
       $fetchData_edu = "SELECT cp.candidate_id ,el.level_name FROM candidate_applied_post AS cp
    LEFT JOIN candidates AS c ON c.id = cp.candidate_id
    LEFT JOIN projects_posts AS pp ON pp.id = cp.post_id
    LEFT JOIN projects AS p ON p.id = pp.project_id
    LEFT JOIN education AS ed ON ed.candi_id = c.id
    LEFT JOIN degree as d ON d.id = ed.degree_id
    LEFT JOIN edu_level AS el ON el.id = d.level_id WHERE el.id < '$education'";
            $runQ_edu = mysqli_query($connection,$fetchData_edu);
           while ($rowQ_edu = mysqli_fetch_array($runQ_edu)) 
           {
            $edu_id = $rowQ_edu['candidate_id'];
            $update_edu = "UPDATE candidate_applied_post AS cp SET status = 'Rejected', status_details = 'Required Education Missing' WHERE cp.candidate_id='$edu_id'";
            $run_chalan4 = mysqli_query($connection,$update_edu);
           }
        if(@$run_chalan4)
           {
            echo "<!DOCTYPE html>
                  <html>
                    <body> 
                    <script>
                    Swal.fire(
                      'Rejected !',
                      'Candidates Has Been Rejected',
                      'success'
                    ).then((result) => {
                      if (result.isConfirmed) {
                         window.location.href = 'reject_projects.php';
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
?>
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
  
  function getApplicantData()
  {

    var post_id = $("#post_id").val();
    var edu_level = $("#edu_level").val();
    var uptoDate = $("#uptoDate").val();

    if(post_id != '0' && edu_level != '0')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'reject_project_ajax.php',
        data: {
            postId: post_id,
            edu_level: edu_level,
            uptoDate: uptoDate
        },
        dataType: "html",
        success:function(result){
          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);
          
        }
      });
    }
    else if(post_id != '0' && edu_level == '0')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'reject_project_ajax.php',
        data: {
            post_id2: post_id
        },
        dataType: "html",
        success:function(result){

          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);

        }
      });
    }
 else if(post_id == '' && edu_level == '0' && uptoDate == '0')
    {
      $("#ajaxData").html("");
    }
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