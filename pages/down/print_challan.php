<?php
include('../includes/db.php');
session_start();
if(!isset($_SESSION['pbs_cand'])) {
    ?>
    <script>
        location.href = 'index.php';
    </script>
    <?php
}
include('header.php');
$candidateId = $_SESSION['pbs_cand'];
$challan_id = $_GET['id'];
$fetchData= "SELECT cp.id,p.project_name,p.id AS proj_id,p.project_id,cp.test_amount,cp.amount_words,cp.bank1,
       cp.logo1,cp.branch1,cp.title1,cp.acc_no1,cp.bank2,cp.logo2,cp.branch2,cp.title2,cp.acc_no2,cp.bank3,cp.logo3,
       cp.branch3,cp.title3,cp.acc_no3,cp.challan_date,cp.challan_update,p.last_date, pp.post_name 
        FROM projects_challans AS cp 
    INNER JOIN projects AS p ON p.id = cp.project_id 
    INNER JOIN projects_posts AS pp ON cp.id=pp.proj_challan_id
    WHERE cp.id = '$challan_id'";
$runData = mysqli_query($connection,$fetchData) or die(mysqli_error());
$rowData = mysqli_fetch_array($runData);

$candidateSql = "SELECT name, f_name, phone, cnic from candidates WHERE id='$candidateId'";
$candidateQ = mysqli_query($connection, $candidateSql);
$candidateRes = mysqli_fetch_assoc($candidateQ);
$id       = $rowData['id'];
$proj_id       = $rowData['proj_id'];
$project_id       = $rowData['project_id'];
$project_name       = $rowData['project_name'];
$test_amount   = $rowData['test_amount'];
$amount_words      = $rowData['amount_words'];

$bank1      = $rowData['bank1'];
$logo1      = $rowData['logo1'];
$branch1      = $rowData['branch1'];
$title1      = $rowData['title1'];
$acc_no1      = $rowData['acc_no1'];

$bank2      = $rowData['bank2'];
$logo2      = $rowData['logo2'];
$branch2      = $rowData['branch2'];
$title2      = $rowData['title2'];
$acc_no2      = $rowData['acc_no2'];

$bank3      = $rowData['bank3'];
$logo3      = $rowData['logo3'];
$branch3      = $rowData['branch3'];
$title3      = $rowData['title3'];
$acc_no3      = $rowData['acc_no3'];
$post_name = $rowData['post_name'];
$last_date      = date("d-m-Y",strtotime($rowData['last_date']));
?>
<body style="background: #e6e6e6; overflow-x: hidden;">
<style type="text/css">
    @media print {
        #print-challan {
            background-color: white;
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            margin: 0;
            padding: 15px;
            font-size: 14px;
            line-height: 18px;
        }
    }
</style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h4 class="m-0 text-dark">
                        Challan Form for - <?php echo $post_name; ?>
                    </h4>
                </div>

                    <div class="col-md-6 text-right">
                        <a href="upload-challan.php" class="">Upload Challan</a> |
                        <a href="challans.php" class="">Download Challan</a> |
                        <a href="profile.php" class="">Profile</a>
                    </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content printClr">
        <div class="container-fluid" id="print-challan">
            <div class="border border-dark invoice sizet">
                <div class="row">
                    <div class="col-md-4">
                        <img class="ml-2 mt-2" width="60px" height="50px" src="../images/logo.png" alt="uts">
                    </div>
                    <div class="col-md-4">
                        <h4>Universal Testing Services</h4>
                        <p class="text- text-center"><span class="bg-dark uts text-white"> Bank Copy</span></p>
                    </div>
                    <div class="col-md-4">
                        <span class="float-right"><b>Apply Last Date : <?php echo $last_date ?></b></span>
                    </div>
                </div>
                <div class="row m-1">
                    <div class="col-md-12">
                        <p class="d-inline ">Date:_________________________</p>
                        <p class="d-inline ml-5">Branch Code:__________________</p>
                        <p class="d-inline float-right">Branch Name:_______________________________</p>
                        <p class="float-right text-danger">?????? : ?????????? ?????????????? ?????? ?????? ?????? ???????? ?????? ?????? ??????????????.?????? ???? ???????? ???? ?????? ?????? ???????? ???? ???????? ?????????????? ???????? ?????? ???? ???????? ???? ?????????? ?????? ???????? ?????????????? ???????? ???????? ?????? ???????? ?????? ???? ?????? ???? ?????????????????? ???????? ?????? ???????? ???? ???????? ?????????????? ???? ???????? ?????????? ????????
                            ?????? </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row ml-1">
                                        <div class="col-md-2">
                                            <input type="checkbox">
                                        </div>
                                        <div class="col-md-6">
                                            <span><?php echo $bank1 ?></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
                                        </div>
                                    </div>
                                    <div class="row ml-1">
                                        <div class="col-md-12">
                                            <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                            <span style="font-size: 12px;"><?php echo $branch1 ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                            <span style="font-size: 12px;"><?php echo $title1 ?></span>
                                        </div>
                                        <div class=" col-md-12 ">
                                            <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                            <span style="font-size: 12px; "><?php echo $acc_no1 ?></span>
                                        </div>
                                    </div>
                                </td>
                                <?php if($bank2 != '') { ?>
                                    <td>
                                        <div class="verticalLine"></div>
                                    </td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-md-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-md-6">
                                                <span><?php echo $bank2 ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $branch2 ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $title2 ?></span>
                                            </div>
                                            <div class=" col-md-12 ">
                                                <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                                <span style="font-size: 12px; "><?php echo $acc_no2 ?></span>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                                <?php if($bank3 != '') { ?>
                                    <td>
                                        <div class="verticalLine"></div>
                                    </td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-md-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-md-6">
                                                <span><?php echo $bank3 ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $branch3 ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $title3 ?></span>
                                            </div>
                                            <div class=" col-md-12 ">
                                                <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                                <span style="font-size: 12px; "><?php echo $acc_no3 ?></span>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-md-5">
                        <p><b>Applicant Name:</b>
                            <u>
                                &nbsp;<?php
                                    echo $candidateRes['name'];
                                    for($i=0; $i<(55 - strlen($candidateRes['name'])); $i++)
                                        echo "&nbsp;"
                                ?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><b>S/D of:</b>
                            <u>
                                &nbsp;<?php
                                echo $candidateRes['f_name'];
                                for($i=0; $i<(55 - strlen($candidateRes['f_name'])); $i++)
                                    echo "&nbsp;"
                                ?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Cell No:</b>
                        <u>
                            <?php echo $candidateRes['phone'];?>
                        </u>
                        </p>
                    </div>
                </div>
                <div class="row m-1 ">
                    <div class="col-md-6">
                        <p><b>CNIC No:</b>
                        <u>
                            <?php echo $candidateRes['cnic'];?>
                        </u>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Post Applied For:</b>
                        <u><?php echo $rowData['post_name'];?></u>
                        </p>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-md-3">
                        <p><b>Amount RS:</b> <?php echo $test_amount ?> /-</p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Amount in Words:</b> <?php echo $amount_words ?>.</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Project ID:</b> <?php echo $project_id ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger text-center">This Fee is non refundable and non transferable.</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    <center><span>------------------------------------------------------------------------------------------------------------------------------------------------</span></center>
                </div>
            </div>
            <div class="border border-dark invoice sizet">
                <div class="row">
                    <div class="col-md-4">
                        <img class="ml-2 mt-2" width="60px" height="50px" src="../images/logo.png" alt="uts">
                    </div>
                    <div class="col-md-4">
                        <h4>Universal Testing Services</h4>
                        <p class="text- text-center"><span class="bg-dark uts text-white"> Candidate Copy</span></p>
                    </div>
                    <div class="col-md-4">
                        <span class="float-right"><b>Apply Last Date : <?php echo $last_date ?></b></span>
                    </div>
                </div>
                <div class="row m-1">
                    <div class="col-md-12">
                        <p class="d-inline ">Date:_________________________</p>
                        <p class="d-inline ml-5">Branch Code:__________________</p>
                        <p class="d-inline float-right">Branch Name:_______________________________</p>
                        <p class="float-right text-danger">?????? : ?????????? ?????????????? ?????? ?????? ?????? ???????? ?????? ?????? ??????????????.?????? ???? ???????? ???? ?????? ?????? ???????? ???? ???????? ?????????????? ???????? ?????? ???? ???????? ???? ?????????? ?????? ???????? ?????????????? ???????? ???????? ?????? ???????? ?????? ???? ?????? ???? ?????????????????? ???????? ?????? ???????? ???? ???????? ?????????????? ???? ???????? ?????????? ????????
                            ?????? </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row ml-1">
                                        <div class="col-md-2">
                                            <input type="checkbox">
                                        </div>
                                        <div class="col-md-6">
                                            <span><?php echo $bank1 ?></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
                                        </div>
                                    </div>
                                    <div class="row ml-1">
                                        <div class="col-md-12">
                                            <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                            <span style="font-size: 12px;"><?php echo $branch1 ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                            <span style="font-size: 12px;"><?php echo $title1 ?></span>
                                        </div>
                                        <div class=" col-md-12 ">
                                            <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                            <span style="font-size: 12px; "><?php echo $acc_no1 ?></span>
                                        </div>
                                    </div>
                                </td>
                                <?php if($bank2 != '') { ?>
                                    <td>
                                        <div class="verticalLine"></div>
                                    </td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-md-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-md-6">
                                                <span><?php echo $bank2 ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $branch2 ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $title2 ?></span>
                                            </div>
                                            <div class=" col-md-12 ">
                                                <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                                <span style="font-size: 12px; "><?php echo $acc_no2 ?></span>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                                <?php if($bank3 != '') { ?>
                                    <td>
                                        <div class="verticalLine"></div>
                                    </td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-md-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-md-6">
                                                <span><?php echo $bank3 ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $branch3 ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $title3 ?></span>
                                            </div>
                                            <div class=" col-md-12 ">
                                                <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                                <span style="font-size: 12px; "><?php echo $acc_no3 ?></span>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-md-5">
                        <p><b>Applicant Name:</b>
                            <u>
                                &nbsp;<?php
                                echo $candidateRes['name'];
                                for($i=0; $i<(55 - strlen($candidateRes['name'])); $i++)
                                    echo "&nbsp;"
                                ?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><b>S/D of:</b>
                            <u>
                                &nbsp;<?php
                                echo $candidateRes['f_name'];
                                for($i=0; $i<(55 - strlen($candidateRes['f_name'])); $i++)
                                    echo "&nbsp;"
                                ?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Cell No:</b>
                            <u>
                                <?php echo $candidateRes['phone'];?>
                            </u>
                        </p>
                    </div>
                </div>
                <div class="row m-1 ">
                    <div class="col-md-6">
                        <p><b>CNIC No:</b>
                            <u>
                                <?php echo $candidateRes['cnic'];?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Post Applied For:</b>
                            <u><?php echo $rowData['post_name'];?></u>
                        </p>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-md-3">
                        <p><b>Amount RS:</b> <?php echo $test_amount ?> /-</p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Amount in Words:</b> <?php echo $amount_words ?>.</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Project ID:</b> <?php echo $project_id ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger text-center">This Fee is non refundable and non transferable.</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    <center><span>------------------------------------------------------------------------------------------------------------------------------------------------</span></center>
                </div>
            </div>
            <div class="border border-dark invoice sizet">
                <div class="row">
                    <div class="col-md-4">
                        <img class="ml-2 mt-2" width="60px" height="50px" src="../images/logo.png" alt="uts">
                    </div>
                    <div class="col-md-4">
                        <h4>Universal Testing Services</h4>
                        <p><p class="text- text-center"><span class="bg-dark uts text-white"> UTS Copy</span></p></p>
                    </div>
                    <div class="col-md-4">
                        <span class="float-right"><b>Apply Last Date : <?php echo $last_date ?></b></span>
                    </div>
                </div>
                <div class="row m-1">
                    <div class="col-md-12">
                        <p class="d-inline ">Date:_________________________</p>
                        <p class="d-inline ml-5">Branch Code:__________________</p>
                        <p class="d-inline float-right">Branch Name:_______________________________</p>
                        <p class="float-right text-danger">?????? : ?????????? ?????????????? ?????? ?????? ?????? ???????? ?????? ?????? ??????????????.?????? ???? ???????? ???? ?????? ?????? ???????? ???? ???????? ?????????????? ???????? ?????? ???? ???????? ???? ?????????? ?????? ???????? ?????????????? ???????? ???????? ?????? ???????? ?????? ???? ?????? ???? ?????????????????? ???????? ?????? ???????? ???? ???????? ?????????????? ???? ???????? ?????????? ????????
                            ?????? </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row ml-1">
                                        <div class="col-md-2">
                                            <input type="checkbox">
                                        </div>
                                        <div class="col-md-6">
                                            <span><?php echo $bank1 ?></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
                                        </div>
                                    </div>
                                    <div class="row ml-1">
                                        <div class="col-md-12">
                                            <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                            <span style="font-size: 12px;"><?php echo $branch1 ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                            <span style="font-size: 12px;"><?php echo $title1 ?></span>
                                        </div>
                                        <div class=" col-md-12 ">
                                            <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                            <span style="font-size: 12px; "><?php echo $acc_no1 ?></span>
                                        </div>
                                    </div>
                                </td>
                                <?php if($bank2 != '') { ?>
                                    <td>
                                        <div class="verticalLine"></div>
                                    </td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-md-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-md-6">
                                                <span><?php echo $bank2 ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $branch2 ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $title2 ?></span>
                                            </div>
                                            <div class=" col-md-12 ">
                                                <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                                <span style="font-size: 12px; "><?php echo $acc_no2 ?></span>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                                <?php if($bank3 != '') { ?>
                                    <td>
                                        <div class="verticalLine"></div>
                                    </td>
                                    <td>
                                        <div class="row ml-1">
                                            <div class="col-md-2">
                                                <input type="checkbox">
                                            </div>
                                            <div class="col-md-6">
                                                <span><?php echo $bank3 ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <span><img height="50px" width="80px" src="../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="row ml-1">
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $branch3 ?></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                                                <span style="font-size: 12px;"><?php echo $title3 ?></span>
                                            </div>
                                            <div class=" col-md-12 ">
                                                <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                                                <span style="font-size: 12px; "><?php echo $acc_no3 ?></span>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-md-5">
                        <p><b>Applicant Name:</b>
                            <u>
                                &nbsp;<?php
                                echo $candidateRes['name'];
                                for($i=0; $i<(55 - strlen($candidateRes['name'])); $i++)
                                    echo "&nbsp;"
                                ?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><b>S/D of:</b>
                            <u>
                                &nbsp;<?php
                                echo $candidateRes['f_name'];
                                for($i=0; $i<(55 - strlen($candidateRes['f_name'])); $i++)
                                    echo "&nbsp;"
                                ?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Cell No:</b>
                            <u>
                                <?php echo $candidateRes['phone'];?>
                            </u>
                        </p>
                    </div>
                </div>
                <div class="row m-1 ">
                    <div class="col-md-6">
                        <p><b>CNIC No:</b>
                            <u>
                                <?php echo $candidateRes['cnic'];?>
                            </u>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Post Applied For:</b>
                            <u><?php echo $rowData['post_name'];?></u>
                        </p>
                    </div>
                </div>
                <div class="row ml-1">
                    <div class="col-md-3">
                        <p><b>Amount RS:</b> <?php echo $test_amount ?> /-</p>
                    </div>
                    <div class="col-md-6">
                        <p><b>Amount in Words:</b> <?php echo $amount_words ?>.</p>
                    </div>
                    <div class="col-md-3">
                        <p><b>Project ID:</b> <?php echo $project_id ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger text-center">This Fee is non refundable and non transferable.</p>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <center>
                        <button class="btn btn-info shadow" onclick="window.print();">Print</button>
                    </center>
                </div>
            </div>
            <br>
        </div>
    </section>

<?php
include('footer.php');
?>
</body>
</html>
