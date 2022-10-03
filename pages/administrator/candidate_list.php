<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Post Wise Candidate's List</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">List</li>
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
            <label>Project Title</label>
            <select class="form-control select2" id="proj" onchange="getPost()"required name="projId">
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
            <select class="form-control select2" onchange="getCenter()" name="postId" id="post" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>City</label>
            <select class="form-control select2" name="cityId" id="city" onchange="getCenter()" required>
              <option value="">Choose</option>
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
        <div class="col-md-6">
          <div class="form-group">
            <label>Center</label>
            <select class="form-control select2" onchange="get_test_sesion()" id="center" name="centerId" required>
              <option value="">First Select City</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Session</label>
            <select class="form-control select2" onchange="getData()" id="sesion" name="sesionId" required>
              <option value="">First Select Post & Center</option>
            </select>
          </div>
        </div>
      </div>
    </form>
    <br>
    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData" class="table-responsive"></div>
      </div>
    </div>
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
    url:'admin_ajax.php',
    data: {
        projId: projId
    },
    dataType: "html",
    success:function(result){
      $("#post").html(result);
    }
  }).done(function(){
    getCenter();
  });
}


function getCenter()
{
  var city = $("#city").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        city: city
    },
    dataType: "html",
    success:function(result){
      $("#center").html(result);
    }
  }).done(function(){
    get_test_sesion();
  });
}



function get_test_sesion()
{

  var center = $("#center").val();
  var post = $("#post").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        center: center,
        post_id: post
    },
    dataType: "html",
    success:function(result){
      $("#sesion").html(result);
    }
  }).done(function(){
    getData();
  });
}


function getData()
{
  var sesion = $("#sesion").val();
  var post = $("#post").val();
  if(sesion != '')
  {
    $.ajax({
      method:'POST',
      url:'candidate_list_ajax.php',
      data: {
          post: post,
          sesion: sesion
      },
      dataType: "html",
      success:function(result){
        $("#ajaxData").html(result);
        $(".datatable").DataTable();
      }
    });
  }
  else
  {
    $("#ajaxData").html("");
  }
}

</script>
