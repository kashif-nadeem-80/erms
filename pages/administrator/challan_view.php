<?php
include "includes/header.php";?>
<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
        }
        .invoice {
            height: 460px;
        }
        .sizet {
            height: 482px !important;
        }
        .printClr
        {
          background: white;
        }

        .printBlock {
          display: none;
        }
    }
    
    input[type=checkbox] {
        height: 25px;
        width: 25px;
    }
    
    .verticalLine {
        border-width: 1px;
        border-color: grey;
        opacity: 0.5;
        border-style: solid;
        height: 80px;
    }
</style>
<?php
  $challan_id = $_GET['challan_id'];
  $fetchData= "SELECT * FROM challan_form WHERE id = '$challan_id'";
  $runData = mysqli_query($connection,$fetchData);
  $rowData = mysqli_fetch_array($runData);
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
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Challan Form</h4>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Challan Form</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content printClr">
  <div class="container-fluid">
    <div class="border border-dark invoice sizet">
      <div class="row">
        <div class="col-md-4">
          <img class="ml-2 mt-2" width="60px" height="50px" src="../../images/logo.png" alt="uts">
        </div>
        <div class="col-md-4">
          <h4>Universal Testing Services</h4>
          <p class="text- text-center"><span class="bg-dark uts text-white"> UTS Copy</span></p>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      <div class="row m-1">
        <div class="col-md-12">
          <p class="d-inline ">Date:________________</p>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
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
          <p><b>Applicant Name:</b>______________________________________</p>
        </div>
        <div class="col-md-4">
          <p><b>S/D of:</b>_______________________________</p>
        </div>
        <div class="col-md-3">
          <p><b>Cell No:</b>_____________________</p>
        </div>
      </div>
      <div class="row m-1 ">
        <div class="col-md-6">
          <p><b>CNIC No:</b>________________________________</p>
        </div>
        <div class="col-md-6">
          <p><b>Post Applied For:</b>_________________________________________________</p>
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
    <div class="border border-dark invoice">
      <div class="row">
        <div class="col-md-4">
          <img class="ml-2 mt-2" width="70px" height="60px" src="../../images/logo.png" alt="uts">
        </div>
        <div class="col-md-4">
          <h4>Universal Testing Services</h4>
          <p class="text- text-center"><span class="bg-dark uts text-white"> Candidate Copy </span></p>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      <div class="row m-1">
        <div class="col-md-12">
          <p class="d-inline ">Date:________________</p>
          <p class="d-inline ml-5">Branch Code:__________________</p>
          <p class="d-inline float-right">Branch Name:_______________________________</p>
          <p class="float-right text-danger">?????? : ?????????? ?????????????? ?????? ?????? ?????? ???????? ?????? ?????? ??????????????.?????? ???? ???????? ???? ?????? ?????? ???????? ???? ???????? ??????????????</p>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo2 ?>" alt="Logo"></span>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
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
          <p><b>Applicant Name:</b>______________________________________</p>
        </div>
        <div class="col-md-4">
          <p><b>S/D of:</b>_______________________________</p>
        </div>
        <div class="col-md-3">
          <p><b>Cell No:</b>_____________________</p>
        </div>
      </div>
      <div class="row m-1 ">
        <div class="col-md-6">
          <p><b>CNIC No:</b>________________________________</p>
        </div>
        <div class="col-md-6">
          <p><b>Post Applied For:</b>_________________________________________________</p>
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
    <div class="border border-dark invoice">
      <div class="row">
        <div class="col-md-4">
          <img class="ml-2 mt-2" width="60px" height="50px" src="../../images/logo.png" alt="uts">
        </div>
        <div class="col-md-4">
          <h4>Universal Testing Services</h4>
          <p class="text- text-center"><span class="bg-dark uts text-white"> Bank Copy</span></p>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      <div class="row m-1">
        <div class="col-md-12">
          <p class="d-inline ">Date:________________</p>
          <p class="d-inline ml-5">Branch Code:__________________</p>
          <p class="d-inline float-right">Branch Name:_______________________________</p>
          <p class="float-right text-danger">?????? : ?????????? ?????????????? ?????? ?????? ?????? ???????? ?????? ?????? ??????????????.?????? ???? ???????? ???? ?????? ?????? ???????? ???? ???????? ??????????????</p>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
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
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
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
          <p><b>Applicant Name:</b>__________________________________________</p>
        </div>
        <div class="col-md-4">
          <p><b>S/D of:</b>_______________________________</p>
        </div>
        <div class="col-md-3">
          <p><b>Cell No:</b>_____________________</p>
        </div>
      </div>
      <div class="row m-1 ">
        <div class="col-md-6">
          <p><b>CNIC No:</b>________________________________</p>
        </div>
        <div class="col-md-6">
          <p><b>Post Applied For:</b>_________________________________________________</p>
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
    <br>
    <div class="row printBlock">
      <div class="col-md-12">
        <center><button class="btn btn-info shadow" onclick="window.print();">Print</button></center>
      </div>
    </div>
    <br>
  </div>
</section>


 <?php include "includes/footer.php"; ?>