<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Total Apply Info</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Info</li>
        </ol>
      </div>
    </div>
  </div>
</div>
 <section class="content" >
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-dark" class="text-center">
          <div class="card-header">
            <div class="card-title">Total Apply Report</div>
            <div class="card-tools">
            </div>
          </div>
          <br>
          <div class="card-body">
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
                  <label>City</label>
                  <select class="form-control select2" onchange="getApplicantData()" name="city" id="city_id" required>
                    <option value="all">All</option>
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
            </div>

            <div class="row">
              <div class="col-md-12 table-responsive" id="ajaxData">
                <table class="table table-striped table-bordered datatable" style="font-size: 12px" data-page-length='100'>
                  <thead class="bg-dark">
                    <tr>
                      <th>S.No</th>
                      <th>Project</th>
                      <th>Post</th>
                      <th>City</th>
                      <th class="text-center bg-info">Total Apply</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="bg-secondary text-center">
                      <td colspan="4" class="text-right"><b>Total</b></td>
                      <td colspan="1" id="sumTotal">0</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "includes/footer.php"; ?>


<script type="text/javascript">
  function getPost()
  {
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'report_summarize_ajax.php',
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
    let city_id = $("#city_id").val();
    if(proj_id != '' && post_id != '' && city_id != '')
    {
      $("#preloader").fadeIn(100);
      
      $.ajax({
        method:'POST',
        url:'report_summarize_ajax.php',
        data: {
            proj_id2: proj_id,
            postId2: post_id,
            city_id2: city_id
        },
        dataType: "html",
        success:function(result){
          $("#ajaxData").html(result);
          $(".datatable").DataTable();
          $("#preloader").fadeOut(100);
        }
      }).done(function(){
        calculateSubTotal();
      });
    }
  }

  function calculateSubTotal()
  {
    var sum = 0;
    $(".total").each(function() {
        var value = $(this).text();
        if(!isNaN(value) && value.length != 0)
        {
          sum += parseFloat(value);
        }
    });
    $('#sumTotal').text(sum);
  }
</script>
