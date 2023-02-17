<?php
include "includes/header.php";
include "includes/db.php";
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0 text-dark">Edit Relevent Employement Record</h4>
                </div><!-- /.col -->
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Edit Relevent Employement Record </li>
                    </ol>
                    </div><!-- /.col -->
                    </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <section class="content">
                    <div class="container-fluid" class="text-center">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-dark" class="text-center">
                                    <div class="card-header">
                                        <div class="card-title">Edit Record</div>
                                    </div>
                                    <br>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <?php
                                        $exper_Id = $_GET['expere_id'];
                                        $fetchData= "SELECT * FROM  work_experince WHERE id = '$exper_Id'";
                                        $runData = mysqli_query($connection,$fetchData);
                                        $rowData = mysqli_fetch_array($runData);
                                        // $id = $rowData['id'];
                                        $company = $rowData['company'];
                                        $job_title   = $rowData['job_title'];
                                        $date_from     = $rowData['date_from'];
                                        $date_to   = $rowData['date_to'];
                                        ?>
                                        <!-- form start -->
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Organization/ Company</label>
                                                        <input type="text" name="company" placeholder="Name" class="form-control"
                                                        autocomplete="off" value="<?php echo $company ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Job Title(Job Relevent Experince) </label>
                                                        <input type="text" name="job" placeholder="Name" class="form-control"
                                                        autocomplete="off" value="<?php echo $job_title ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Date From</label>
                                                        <input type="date" name="date_from" placeholder="username" class="form-control"
                                                        autocomplete="off" value="<?php echo $date_from ?>" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Date To</label>
                                                        <input type="date" name="date_to" placeholder="Email" class="form-control"
                                                        autocomplete="off" value="<?php echo $date_to?>" required>
                                                    </div>
                                                </div><br><br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <center>
                                                        <input type="submit" class="btn btn-success shadow" value="Update"
                                                        name="saveUser">
                                                        <a href="employement_experince.php" class="btn btn-danger shadow">Cancle</a>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                        if(isset($_POST['saveUser']))
                                        {
                                        $u_company   = $_POST['company'];
                                        $u_job      = $_POST['job'];
                                        $u_date_from     = $_POST['date_from'];
                                        $u_date_to  = $_POST['date_to'];
                                        $update = "UPDATE work_experince SET `company` = '$u_company', `job_title` = '$u_job', `date_from` = '$u_date_from', `date_to`= '$u_date_to' WHERE id = '$exper_Id'";
                                        $run = mysqli_query($connection,$update);
                                        if($run)
                                        {
                                        echo "<script>alert('Record updated successfully')</script>";
                                        echo "<script>window.location.href = 'employement_experince.php'</script>";
                                        }
                                        }
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