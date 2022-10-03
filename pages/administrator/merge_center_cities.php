<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Merge Center's Cities</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Assigning</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="card card-dark">
      <div class="card-header">
        <div class="card-title">Merge Center's Cities Form</div>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12 text-center text-info m-0 p-0">
                  <h5>City & Post Merge From</h5>
                  <hr style="width: 200px; border: 2px solid #17a2b8;">
                </div>
                <div class="col-md-12">
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Posts</label>
                    <select class="form-control select2" onchange="getApplid()" name="postId" id="post" required>
                      <option value="">First Select Project</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Test City</label>
                    <select class="form-control select2" name="cityIdFrom" id="cityFrom" onchange="getApplid()" required>
                      <option value="">Choose</option>
                      <?php
                      $query = "SELECT c.id, c.c_name FROM city AS c WHERE c.test_center_status = '1' ORDER BY c.c_name ASC";
                        $result = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $c_name = $row['c_name'];
                        echo "<option value='$id'>$c_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Total Apply</label>
                    <input type="text" name="totalApply" id="total_apply" readonly placeholder="Total Apply" required class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Merge To New City</label>
                    <input type="text" name="mergeCand" onkeyup="checkCapacity()" id="mergeTocity" placeholder="Total Apply" required class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-1"><p style="height: 100%; width: 1px; border: 1px solid #4396ad;margin-left: 32px;"></p></div>
            <div class="col-md-5">
              <div class="col-md-12 text-center text-info m-0 p-0">
                <h5>City & Post Merge To</h5>
                <hr style="width: 200px; border: 2px solid #17a2b8;">
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Test City</label>
                  <select class="form-control select2" name="cityIdTo" id="cityTo" required>
                    <option value="">Choose</option>
                    <?php
                      $query = "SELECT c.id, c.c_name FROM city AS c WHERE c.test_center_status = '1' ORDER BY c.c_name ASC";
                        $result = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $c_name = $row['c_name'];
                        echo "<option value='$id'>$c_name</option>";
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 ">
              <input type="submit" class="float-right btn btn-primary shadow" onclick="return confirm('Are you sure to merge the cities')" value="Merge" name="assign">
            </div>
          </div>
        </form>

        <?php
        if(isset($_POST['assign']))
        {
          $cityIdFrom = $_POST['cityIdFrom'];
          $postId = $_POST['postId'];
          $cityIdTo = $_POST['cityIdTo'];
          $totalApply = $_POST['totalApply'];
          $mergeCand = $_POST['mergeCand'];

          if($totalApply == $mergeCand)
          {
            $fetch = "UPDATE candidate_applied_post SET city_id = '$cityIdTo' WHERE city_id = '$cityIdFrom' AND post_id = '$postId'";
          }
          else
          {
            $fetch = "UPDATE candidate_applied_post SET city_id = '$cityIdTo' WHERE city_id = '$cityIdFrom' AND post_id = '$postId' ORDER BY id ASC LIMIT $mergeCand";
          }
          $runQ = mysqli_query($connection,$fetch);

          if($runQ)
          {
          echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Merge !',
              'Post of city has been merged successfully',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href= 'merge_center_cities.php';
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
                        'Post of city not merge, Some error occure',
                        'error'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'merge_center_cities.php';
                        }
                      });
                      </script>
                      </body>
                    </html>";
              }
        }
        ?>
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
    getApplid();
  });
}

function getApplid()
{
  var post = $("#post").val();
  var city = $("#cityFrom").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
      city2: city,
      post: post
    },
    dataType: 'json',
    success:function(result){
      $("#total_apply").val(result.total_apply);
      $("#mergeTocity").val(result.total_apply);
    }
  });
}

function checkCapacity()
{
  var total_apply = parseInt($("#total_apply").val());
  var mergeTocity = parseInt($("#mergeTocity").val());
  if(mergeTocity > total_apply)
  {

    Swal.fire(
      'Error !',
      '\"Merge To New City\", must be less than or equal to \"Total Apply\"',
      'error'
    ).then((result) => {
      if (result.isConfirmed) {
        $("#mergeTocity").val(total_apply);
      }
    });
  }

}
</script>
