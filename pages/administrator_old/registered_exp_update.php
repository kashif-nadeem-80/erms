<?php
include "includes/header.php";
$exp_id = $_GET['exp_id'];
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-6">
                <h4 class="m-0 text-dark">Employement Record</h4>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Employement Record</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <div class="card-title">Employement Experience</div>
                    </div>
                    <?php
                    $query12 = "SELECT c.id AS cand_id, we.`id`, we.`company`, we.`job_title`, we.`date_from`, we.`date_to`, we.`file`,we.`candidate_id`, we.`payment`, we.`total_exp` FROM `work_experince` AS we LEFT JOIN candidates AS c ON c.id= we.candidate_id WHERE we.id='$exp_id'";
                    $result12 = mysqli_query($connection, $query12);

                    $rowData2 = mysqli_fetch_array($result12);

                    $organization = $rowData2['company'];
                    $job_title = $rowData2['job_title'];
                    $date_from = $rowData2['date_from'];
                    $date_to = $rowData2['date_to'];
                    $payment = $rowData2['payment'];
                    $total_exp = $rowData2['total_exp'];
                    $file = $rowData2['file'];
                    $total_exp = $rowData2['total_exp'];
                    $cand_id = $rowData2['cand_id'];
                    $file = $rowData2['file'];
                    // $pathImg1U = "../../images/candidates/employee_experince/".$file;
                    ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Organization/ Company</label>
                                                <input type="text" class="form-control" name="company"
                                                       value="<?php echo $organization ?>"
                                                       placeholder="Organization/ Company" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Job Title(Job Relevent Experince)</label>
                                                <input type="text" class="form-control" name="job"
                                                       placeholder="Job Experince" value="<?php echo $job_title ?>"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date From</label>
                                                <input type="date" id="dateFrom" class="form-control" name="date_from"
                                                       value="<?php echo $date_from ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date To</label><span class="float-right"
                                                                            style="font-size:12px"><b>Currently Working</b> <input
                                                            type="checkbox" value="yes" name="check"
                                                            id="checkbox"></span>
                                                <input type="date" onchange="dToChange()" class="form-control"
                                                       name="date_to" value="<?php echo $date_to ?>" id="working"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Total Experience</label>
                                                <input type="text" name="exp_total" id="tExperience"
                                                       class="form-control" placeholder="Total Experience"
                                                       value="<?php echo $total_exp ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pay Package (Rs)</label>
                                                <input type="number" placeholder="Pay Package" class="form-control"
                                                       name="exp_payment" value="<?php echo $payment ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Uploaded File <span
                                                            class="text-info">&nbsp;(Optional)</span></label>
                                                <input type="file" class="form-control" id="file1" name="logo1"
                                                       onchange="showImage1(event)" style="overflow-x: hidden;"
                                                       accept="image/*">
                                                <?php
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-center">
                                                <img id="log1" class="shadow"
                                                     style="border: 1px blue solid; border-radius: 10%;" width="170px"
                                                     height="150px"
                                                     src="../../images/candidates/employee_experince/<?php
                                                    if($file == NULL OR $file == '')
                                                    {
                                                    echo "../../file_icon.png";
                                                    }
                                                    else
                                                    {
                                                    echo $file;
                                                    }
                                                    ?> " alt="">

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn btn-success shadow" value="Update"
                                                   name="saveData12">

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['saveData12'])) {
            $company1 = $_POST['company'];
            $job1 = $_POST['job'];
            $date_from1 = $_POST['date_from'];
            $exp_payment1 = $_POST['exp_payment'];
            $exp_total1 = $_POST['exp_total'];

            @$check = $_POST['check'];
            if ($check == 'yes') {
                $profImage = 'Continue';
                $date_to1 = '0000-00-00';
                $pathImg1U1 = "../../images/candidates/employee_experince/" . $file;
                @unlink($pathImg1U1);
            } else {
                if ($_FILES['logo1']['name'] == '') {
                    $profImage = $file;
                } else {
                    $profImage = date("Y-m-d H-i-s") . $_FILES['logo1']['name'];
                    $temp_profImage = $_FILES['logo1']['tmp_name'];
                    $pathImg1U1 = "../../images/candidates/employee_experince/" . $profImage;
                    move_uploaded_file($temp_profImage, $pathImg1U1);
                    $pathImg1U = "../../images/candidates/employee_experince/".$file;
                    @unlink($pathImg1U);
                }
                $date_to1 = $_POST['date_to'];
            }

            $query1 = "UPDATE `work_experince` SET `company`='$company1', `job_title`='$job1', `date_from`='$date_from1', `date_to`='$date_to1', `file`='$profImage', `payment`='$exp_payment1', `total_exp`='$exp_total1' WHERE id = '$exp_id'";
            $run1 = mysqli_query($connection, $query1);
            if ($run1) {
                echo "<!DOCTYPE html>
			<html>
								<body>
					<script>
					Swal.fire(
					'Updated !',
					'Experience has been updated successfully',
					'success'
					).then((result) => {
					if (result.isConfirmed) {
					window.location.href = 'registered_user_update.php?u_id=$cand_id';
					}
					});
					</script>
				</body>
			</html>";
            } else {
                echo "<!DOCTYPE html>
			<html>
				<body>
					<script>
					Swal.fire(
					'Error !',
					'Experience not update, Some error occure',
					'error'
					).then((result) => {
					if (result.isConfirmed) {
					window.location.href = 'registered_user_update.php?u_id=$cand_id';
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
    $('.Data_Ajax1').click(function () {
        var std_image1 = $(this).attr('data-id');
        $.ajax({
            method: 'POST',
            url: 'employement_experince_ajax.php',
            data: {
                std_image1: std_image1
            },
            datatype: "html",
            success: function (result) {
                $(".std1").html(result);
            }
        });
    });
</script>
<!-- Modal Start-->
<div class="modal fade" id="image1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 550px">
        <div class="modal-content std1">
        </div>
    </div>
</div>
<!-- Modal end -->
<script>
    function showImage1(event) {
        var uploadField = document.getElementById("file1");
        if (uploadField.files[0].size > 80000) {
            uploadField.value = "";
            // alert("File is too big! Upload File under 80kB");
            Swal.fire(
                'Error !',
                'File size is too big! upload file under 80kB !',
                'error'
            ).then((result) => {
                if (result.isConfirmed) {
                }
            });
        } else {
            var logoId = document.getElementById('log1');
            logoId.src = URL.createObjectURL(event.target.files[0]);
        }
    }

    ///////////////////////////////
    $(function () {
        $("#checkbox").click(function (event) {
            var x = $(this).is(':checked');
            if (x == true) {
                $("#working").attr('disabled', 'disabled');
                $("#file1").attr('disabled', 'disabled');
                dToChange();
            } else {

                $("#working").attr('disabled', false);
                $("#file1").attr('disabled', false);
                $("#tExperience").val('');
            }
        });
    });

    function dToChange() {
        var dateTo = $("#working").val();
        var mdate = $("#dateFrom").val();
        var yearThen = parseInt(mdate.substring(0, 4), 10);
        var monthThen = parseInt(mdate.substring(5, 7), 10);
        var dayThen = parseInt(mdate.substring(8, 10), 10);

        // Calculate Experience
        var from = new Date(mdate);
        if ($('#checkbox').is(":checked")) {
            var to = new Date();
        } else {
            var to = new Date(dateTo);
        }
        var birthday = new Date(yearThen, monthThen - 1, dayThen);

        var differenceInMilisecond = to.valueOf() - birthday.valueOf();

        var year_age = Math.floor(differenceInMilisecond / 31536000000);
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);
        var month_age = Math.floor(day_age / 30);

        day_age = day_age % 30;
        if (year_age != 0 && month_age != 0) {
            var total_exp = year_age + " years & " + month_age + " months";
        } else if (year_age == 0 && month_age != 0) {
            var total_exp = month_age + " months";
        } else if (year_age != 0 && month_age == 0) {
            var total_exp = year_age + " years";
        } else {
            var total_exp = day_age + " days";
        }
        $("#tExperience").val(total_exp);
    }
</script>