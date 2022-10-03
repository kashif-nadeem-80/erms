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
        <h4 class="m-0 text-dark">Assiging Roll Numbers</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Roll No</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <h4 class="text-info">Before Assign Roll Numbers make sure that center assigned to all candidates</h4><hr>
    <form method="post">
      <div class="row">
        <div class="col-md-5">
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
        <div class="col-md-5">
          <div class="form-group">
            <label>Posts</label>
            <select class="form-control select2" onchange="getApplicantData()" name="post" id="post_id" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Applied Candidates</label>
            <input type="number" id="TotalCand" name="total_candidates" readonly class="form-control bg-secondary">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label>Roll No Start From</label>
            <input type="text" placeholder="Roll No Start From" id="pre_rollNo" name="Pre_RollNo" pattern="[0-9]{6,}" required onkeyup="check_preNo()" class="form-control">
            <p class="text-danger">Most be unique & atleast 6 digits, Format: [001122]</p>
          </div>
        </div>
      </div>

      <input type="hidden" name="assignC" id="assignC">
      <input type="hidden" name="unassignC" id="unassignC">
      <input type="hidden" name="preR" value="exist" id="preR">

      <div class="row">
        <div class="col-md-12">
          <div class="form-group float-right">
            <input type="submit" value="Assign" name="save" onclick="return confirm('Are you sure to do this action !')" id="assigBtn" class="btn btn-success shadow">
          </div>
        </div>
      </div>
    </form>
    <?php
      if(isset($_POST['save']))
      {
        $unassignC = $_POST['unassignC'];
        $preR = $_POST['preR'];
        if($unassignC == '0')
        {
          if($preR != "exist")
          {
            $projId = $_POST['projectId'];
            $postId = $_POST['post'];
            $total_candidates = $_POST['total_candidates'];
            $Pre_RollNo = $_POST['Pre_RollNo'];

            $fetch = "SELECT ac.id,ac.roll_no FROM assigned_center AS ac INNER JOIN projects_posts As p ON p.id = ac.post_id INNER JOIN projects AS pt ON pt.id = p.project_id WHERE ac.roll_no = '0' AND ac.post_id = '$postId' AND pt.id = '$projId' ORDER BY ac.id ASC LIMIT $total_candidates";
            $runQ = mysqli_query($connection,$fetch);
            $countRow = mysqli_num_rows($runQ);
            if($countRow != 0)
            {
              echo"<script>$('#preloader').fadeIn(100);</script>";
              $insert = "INSERT INTO rollno_prefix (roll_pre) VALUES('$Pre_RollNo')";
              mysqli_query($connection,$insert);
              $rollNoInc = 0;
              while ($row = mysqli_fetch_array($runQ)) {
                $rollNoInc++;
                $ass_center = $row['id'];
                $rolNo = $Pre_RollNo."".$rollNoInc;
                $update = "UPDATE `assigned_center` SET roll_no = '$rolNo' WHERE id = '$ass_center'";
                $runI = mysqli_query($connection,$update);
              }
              echo"<script>$('#preloader').fadeOut(100);</script>";
              echo "<!DOCTYPE html>
                <html>
                  <body> 
                  <script>
                  Swal.fire(
                    'Assigned !',
                    'Roll Numbers have been assigned successfully',
                    'success'
                  ).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = 'roll_no_assign.php';
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
                      'Applied Candidates, Must be greater than 0',
                      'error'
                    ).then((result) => {
                      if (result.isConfirmed) {
                         window.location.href = 'roll_no_assign.php';
                      }
                    });
                    </script>
                    </body>
                  </html>";
            }
          }
          else
          {
            echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Error !',
                '\"Roll No Start From\" Value Must Be Unique, Never Used Before',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                   window.location.href = 'roll_no_assign.php';
                }
              });
              </script>
              </body>
            </html>";
          }
        }
        else
        {
          echo "<!DOCTYPE html>
            <html>
              <body> 
              <script>
              Swal.fire(
                'Error !',
                'Center Not Assigned To $unassignC Candidates, Please First Assign Test Center To All Candidates',
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                   window.location.href = 'roll_no_assign.php';
                }
              });
              </script>
              </body>
            </html>";
        }
      }
    ?>
    <hr>
  </div>
</section>

<?php
  include "includes/footer.php";
?>

<script type="text/javascript">

  function check_preNo(){
    var check  = $('#pre_rollNo').val();
    var TotalCand  = $('#TotalCand').val();
    var unassignC  = $('#unassignC').val();
    $.ajax({                                      
      url: 'admin_ajax.php',
      type: 'post',  
      data: {
        pre_rollNo: check
      },     
      success: function(response) {
        if(response == 1){
          Swal.fire(
              'Error !',
              'This number already used before !',
              'error'
            ).then((result) => {
              if (result.isConfirmed) {
                $('#assigBtn').attr('disabled','disabled');
                $("#preR").val("exist");
              }

          });
        }
        else
        {
          $("#preR").val("UniqNo");
          if(TotalCand != 0 && unassignC == 0)
          {
            $('#assigBtn').attr('disabled',false);
          }
        }

      }

    });
  }

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
    });
  }
  
  function getApplicantData()
  {
    var post_id = $("#post_id").val();

    if(post_id != '0')
    {
      $.ajax({
        method:'POST',
        url:'applications_data_ajax.php',
        data: {
          assign_roll_postId: post_id
        },
        dataType: "json",
        success:function(result){
          let unassign = result.unassign;
          let assigned = result.assigned;
          $("#assignC").val(assigned);
          $("#unassignC").val(unassign);
          var preNo = $("#preR").val();
          if(assigned == 0 || assigned == '0')
          {
            Swal.fire(
                'Error !',
                "Candidates D'nt Exist Without Roll Numbers",
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                  $('#assigBtn').attr('disabled','disabled');
                  $("#TotalCand").val(0);
                }

            });
          }
          else if(unassign == 0 || unassign == '0')
          {
            $("#TotalCand").val(assigned);
            if(preNo != 'exist')
            {
              $('#assigBtn').attr('disabled',false);
            }
          }
          else
          {
            Swal.fire(
                'Error !',
                "Center Not Assigned To "+unassign+" Candidates, Please First Assign Test Center To All Candidates",
                'error'
              ).then((result) => {
                if (result.isConfirmed) {
                  $('#assigBtn').attr('disabled','disabled');
                  $("#TotalCand").val(assigned);
                }

            });
          }
          
        }
      });
    }
  }
</script>
