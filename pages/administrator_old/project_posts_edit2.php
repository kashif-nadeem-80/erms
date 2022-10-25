<?php
include "includes/header.php";
$challan_id = $_GET['challan_id'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0 text-dark">Project Post</h4>
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
        <div class="row printBlock">
            <div class="col-md-12">
                <a href="projectPosts.php" class="btn btn-warning shadow mb-3">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header text-white bg-dark">
                        <div class="card-title">
                            <h5>Edit Post</h5>
                        </div>
                    </div>
                    <?php
            $fetch1 = "SELECT pp.id,pp.project_id,pp.post_name,pp.post_bps,pp.no_of_posts,pc.challan_title,pp.age_lower,pp.age_upper,pc.id AS c_id FROM projects_posts AS pp LEFT JOIN projects_challans AS pc ON pc.id = pp.proj_challan_id WHERE pp.id = '$challan_id'";
            $run1 = mysqli_query($connection,$fetch1);
            $row1 = mysqli_fetch_array($run1);
            $c_id = $row1['c_id'];
            $proj_idd = $row1['project_id'];
            $post_name  = $row1['post_name'];
            $post_bps   = $row1['post_bps'];
            $no_of_posts    = $row1['no_of_posts'];
            $challan_title  = $row1['challan_title'];
            $age_lower  = $row1['age_lower'];
            $age_upper  = $row1['age_upper'];
          ?>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Post Name</label>
                                        <input type="text" name="post_name" placeholder="Post Name" class="form-control"
                                            value="<?php echo $post_name ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>BPS</label>
                                        <input type="number" onKeyPress="if(this.value.length==2) return false;" name="post_bps" placeholder="BPS" class="form-control"
                                            value="<?php echo $post_bps ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No of Post</label>
                                        <input type="number" name="no_of_posts" placeholder="No of Posts" class="form-control" value="<?php echo $no_of_posts ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Challan Title</label>
                                        <select class="form-control select2" name="challan" required>
                                            <option value="<?php echo $c_id ?>"><?php echo $challan_title ?></option>
                                            <?php
                                              $fetch1 = "SELECT id, challan_title FROM projects_challans WHERE project_id = '$proj_idd'";
                                              $run1 = mysqli_query($connection,$fetch1);
                                              while($row1 = mysqli_fetch_array($run1))
                                              {
                                                $id  = $row1['id'];
                                                $challan_title  = $row1['challan_title'];
                                            ?>
                                            <option value="<?php echo $id ?>"><?php echo $challan_title ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Age Lower Limit</label>
                                        <input type="number" class="form-control" name="age_lower" onKeyPress="if(this.value.length==2) return false;"
                                            placeholder="Age Lower Limit" value="<?php echo $age_lower ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Age Upper Limit</label>
                                        <input type="number" class="form-control" name="age_upper" onKeyPress="if(this.value.length==2) return false;"
                                            placeholder="Age Upper Limit" value="<?php echo $age_upper ?>">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <input type="submit" name="save" value="Update" class="btn btn-primary shadow">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
              if(isset($_POST['save']))
              {
                $post_name   = $_POST['post_name'];
                $post_bps    = $_POST['post_bps'];
                $no_of_posts = $_POST['no_of_posts'];
                $challan     = $_POST['challan'];
                $age_lower     = $_POST['age_lower'];
                $age_upper     = $_POST['age_upper'];
                $query = "UPDATE `projects_posts` SET `proj_challan_id` = '$challan',`post_name` = '$post_name', `post_bps` = '$post_bps',`no_of_posts` = '$no_of_posts', `age_lower` = '$age_lower',`age_upper` = '$age_upper' WHERE id = '$challan_id'";
                $result = mysqli_query($connection,$query);
                if($result) 
                {
                  echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Updated !',
                        'Post has been updated successfully',
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
                else
                {
                  echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Error !',
                        'Post not update, Some error occure',
                        'error'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'project_posts_edit2.php?challan_id=$challan_id';
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