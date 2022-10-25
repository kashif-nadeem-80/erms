<?php
include "includes/header.php";
?>
<style>
  .modal { overflow: auto !important; }

  @media print{
    .printBlock
    {
      display: none;
    }
    .printColor
    {
      background: white !important;
      color: black !important;
    }
  }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Candidates Result</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Result</li>
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
            <select class="form-control" id="proj" onchange="getPost()" required>
              <option value="">Choose</option>
              <?php
              $fetchData = "SELECT * FROM projects ORDER BY id DESC";
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
            <select class="form-control" name="post" id="post_id" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Shortlist By</label>
            <select class="form-control" id="order_by" name="shortlistBy" required>
              <option value="Aggregate">Aggregate</option>
              <option value="Marks">Written Test Marks</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Shortlist Upto</label>
            <input type="number" name="shortlistUpto" placeholder="Marks or Aggregate" class="form-control" step="any" id="upto_marks">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group text-right">
            <input type="submit" class="btn btn-primary shadow" value="Shortlist" name="saveData" onclick="return confirm('Are you sure want to shortlist upto given value')">
            <button class="btn btn-danger shadow" onclick="window.location.href = 'result_status.php'">Close</button>
          </div>
        </div>
      </div>
    </form>
    <?php
    if(isset($_POST['saveData']))
    {
      $post = $_POST['post'];
      $shortlistUpto = $_POST['shortlistUpto'];
      $shortlistBy = $_POST['shortlistBy'];

      $select = "SELECT * FROM shortlist_value WHERE post_id = '$post'";
      $runSelect = mysqli_query($connection,$select);
      $countRec = mysqli_num_rows($runSelect);
      if($countRec > 0)
      {
        $query = "UPDATE shortlist_value SET shortlist_upto = '$shortlistUpto', shortlist_by = '$shortlistBy' WHERE post_id = '$post'";
      }
      else
      {
        $query = "INSERT INTO shortlist_value (`post_id`, `shortlist_upto`, `shortlist_by`) VALUES ('$post', '$shortlistUpto', '$shortlistBy')";
      }
      $runQ = mysqli_query($connection,$query);

      if($runQ)
      {
        echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
          Swal.fire(
            'Shortlisted !',
            'Candidates in selected post has been shortlisted successfully',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
               window.location.href = 'result_status.php';
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
            'Candidates in selected post not shortlisted, some error occure',
            'error'
          ).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'result_status.php';
            }
          });
          </script>
          </body>
        </html>";
      }
    }


    ?>

    
  </div>
</section>

<?php
  include "includes/footer.php";
?>

<script type="text/javascript">
  function getPost()
  {
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'result_status_ajax.php',
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

    let proj_id = $("#proj").val();
    let post_id = $("#post_id").val();
    let dis_Id = $("#dis_Id").val();
    let gendr = $("#gendr").val();
    let order_by = $("#order_by").val();

    if(proj_id != '' && post_id != '')
    {
      $("#preloader").fadeIn(100);
      
      $.ajax({
        method:'POST',
        url:'result_status_ajax.php',
        data: {
            proj_id: proj_id,
            postId: post_id,
            disId: dis_Id,
            gender: gendr,
            order_by: order_by
        },
        dataType: "html",
        success:function(result){
          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);
        }
      });
    }
  }
</script>

<script type="text/javascript">
function export_all()
{
  $('.dataTable').DataTable().destroy();
  $("#export_table").tableHTMLExport({
    type:'csv',
    filename:'Report_'+Math.floor((Math.random() * 10000000) + 1)+'.csv',
  });
  $('#export_table').DataTable();
}

function printData()
{
  $('#export_table').removeClass("table-responsive");
  $('.datatable').DataTable().destroy();
  $('#export_table').DataTable().destroy();
  window.print();
  getApplicantData();
}
</script>