<?php
include "../../vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;
include "includes/db.php";
$candidate_id = $_GET['cand_id'];

$query = "SELECT p.id AS pro_id,p.pro_name,z.zone_name ,d.id AS d_id,d.dis_name, c.name, c.cnic, 
              c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, 
              c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,
              c.widow_gov_emp, c.district_id, c.id,c.disable_file,c.widow_file FROM `candidates` AS c 
              LEFT JOIN district AS d ON d.id = c.district_id
              LEFT JOIN zone AS z ON z.id = d.zone_id
              LEFT JOIN province AS p ON p.id = d.pro_id
              LEFT JOIN candidate_applied_post AS cap ON c.id = cap.candidate_id
              WHERE c.id = '$candidate_id'";
$result = mysqli_query($connection,$query);
if(mysqli_num_rows($result) == 0) {
    exit();
}
$rowData = mysqli_fetch_array($result);
$d_id = $rowData['d_id'];
$d_name = $rowData['dis_name'];
$name = $rowData['name'];
$cnic = $rowData['cnic'];
$email = $rowData['email'];
$phone = $rowData['phone'];
$password = $rowData['password'];
$zone_name = $rowData['zone_name'];
$pro_namee = $rowData['pro_name'];
$pro_idd = $rowData['pro_id'];
$disable_file = $rowData['disable_file'];
$widow_file = $rowData['widow_file'];
$image = $rowData['image'];
$signupdate = $rowData['signUpDate'];
$f_name = $rowData['f_name'];
$gender = $rowData['gender'];
$disability = $rowData['disability'];
if($rowData['dob'] != '')
{
    $dob = date("Y-m-d",strtotime($rowData['dob']));
}
else
{
    $dob = "";
}
$postal_address = $rowData['postal_address'];
$telephone = $rowData['telephone'];
$religion = $rowData['religion'];
$gov_employee = $rowData['gov_employee'];
$simple_exper = $rowData['simple_exper'];
$retired_pak = $rowData['retired_pak'];
$army_exper = $rowData['army_exper'];
$widow_gov_emp = $rowData['widow_gov_emp'];

$html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'UTF-8', [5,5,5,8]);
$html = '<page>
<page_footer>
        <table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">uts.com.pk</td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>

<style>
    .challan_image {
        max-height: 900px;
    }
    table {
    width: 100%;
    }
    table.top td {
        width: 25%;
    }
    tr.info td {
        padding: 0 0 20px 0;
    }
    tr.head td, tr.head th {
        font-weight: bold;
        padding: 0 0 5px 0;
    }
    table.edu tr td.info {
        width: 60px;
        word-wrap: anywhere;
        word-break: break-all;
        padding: 0 5px 10px 5px;
        vertical-align: middle;
    }
    table.edu tr.head th {
        padding: 0 3px 0 3px;
        vertical-align: middle;
        width: 60px;
        word-break: break-all;
        word-wrap: anywhere;
    }
    table.exp tr td.info {
        width: 85px;
        word-wrap: anywhere;
        word-break: break-all;
        padding: 0 5px 10px 5px;
        vertical-align: middle;
    }
    table.exp tr.head th {
        padding: 0 3px 0 3px;
        vertical-align: middle;
        width: 85px;
        word-break: break-all;
        word-wrap: anywhere;
    }
    .sec-title h3 {
        padding: 0;
        margin: 15px 0 0;
    }
    table.user-image {
    width: 100%;
    }
    table.user-image td {
        width: 750px;
        text-align: center;
    }
    .html2pdf-page-break {
    page-break-before:always
    }
</style>

<table class="user-image">
    <tbody>
        <tr>
         <td align="right" style="text-align: right">
            <img id="log1" class="shadow" style="
                border: 1px solid blue; border-radius: 10%;" width="120px;" height="130px"  
                src="../../images/candidates/profile picture/';
                      if($image == NULL || $image == '')
                      {
                        $html .= "../../file_icon.png";
                      }
                      else
                      {
                        $html .= $image;
                      }
          $html .= '" alt=""> 
        </td>
        </tr>
    </tbody>
</table>
<table class="top">
    <tbody>
    <tr class="head">
        <td valign="top">Name in Full</td>
        <td valign="top">Father Name</td>
        <td valign="top">Candidate CNIC #</td>
        <td valign="top">Gender</td>
    </tr>
    <tr class="info">
        <td valign="top">'.$name.'</td>
        <td valign="top">'.$f_name.'</td>
        <td valign="top">'.$cnic.'</td>
        <td valign="top">'.$gender.'</td>
    </tr>

    <tr class="head">
        <td valign="top">Have You any disability?</td>
        <td valign="top">Date of Birth (YYYY-MM-DD)</td>
        <td valign="top">Email</td>
        <td valign="top">Province Of Domicile</td>
    </tr>
    <tr class="info">
        <td valign="top">'.$disability.'</td>
        <td valign="top">'.$dob.'</td>
        <td valign="top">'.$email.'</td>
        <td valign="top">'.$pro_namee.'</td>
    </tr>

    <tr class="head">
        <td valign="top">District</td>
        <td valign="top">Zone</td>
        <td valign="top">Postal Address</td>
        <td valign="top">Phone No:(Res.)</td>
    </tr>
    <tr class="info">
        <td valign="top">'.$d_name.'</td>
        <td valign="top">'.$zone_name.'</td>
        <td valign="top">'.$postal_address.'</td>
        <td valign="top">'.$telephone.'</td>
    </tr>

    <tr class="head">
        <td valign="top">Mobile(mandatory)</td>
        <td valign="top">Religion</td>
        <td valign="top" colspan="2">Are You a Govt serving employee?</td>
    </tr>
    <tr class="info">
        <td valign="top">'.$phone.'</td>
        <td valign="top">'.$religion.'</td>
        <td valign="top" colspan="2">'.$gov_employee.'</td>
    </tr>

    <tr class="head">
        <td valign="top" colspan="2">Are You retired from Pakistan Armed Forces?</td>
        <td valign="top" colspan="2">Widow/Son/Daughter of deceased Govt Employee?</td>
    </tr>
    <tr class="info">
        <td valign="top" colspan="2">'.$army_exper.'</td>
        <td valign="top" colspan="2">'.$widow_gov_emp.'</td>
    </tr>
    </tbody>
</table>';

$query2 = "SELECT  e.id,e.passing_year,e.major_subject, e.obtain_marks, e.total_marks, e.university, 
              e.deg_image, d.deg_name, ed.level_name FROM education AS e JOIN degree AS d ON d.id = e.degree_id 
                  LEFT JOIN edu_level AS ed ON ed.id = d.level_id WHERE e.candi_id= '$candidate_id' ORDER BY e.id ASC";
$runData = mysqli_query($connection,$query2);
$countRow = mysqli_num_rows($runData);
$html .= '<div class="row sec-title">
                  <div class="col-md-12 text-center text-primary">
                      <h3>Education\'s Information</h3>
                      <hr class="shadow" style="border: 1px solid #007bff; margin: 0; ">
                  </div>
              </div> ';
if($countRow != 0)
{
    $html .= '<div class="row">
        <div class="col-md-12 table-responsive">
            <table class="edu" cellspacing="0" cellpadding="0" border="1">
                <thead>
                    <tr class="head">
                        <th>S.No</th>
                        <th>Level</th>
                        <th>Certificate / Degree </th>
                        <th>Year Passing</th>
                        <th>Major Subject</th>
                        <th>Obtained Marks</th>
                        <th>Total Marks / CGPA</th>
                        <th>University / Board</th>
                        <th>Certificate</th>
                    </tr></thead><tbody>';


                $count = 0;

                while($rowData = mysqli_fetch_array($runData)) {
                $count++;
                $id = $rowData['id'];
                $level1  = $rowData['level_name'];
                $degree1  = $rowData['deg_name'];
                $pas_year = $rowData['passing_year'];
                $major_subject = $rowData['major_subject'];
                $obt_marks  = $rowData['obtain_marks'];
                $tot_marks   = $rowData['total_marks'];
                $Board1   = $rowData['university'];
                $certificate = $rowData['deg_image'];
                $pathImg    = "../../images/candidates/education/".$certificate;

                $html .= '
                
                    <tr>
                        <td class="info">'. $count.'</td>
                        <td class="info">'. $level1.'</td>
                        <td class="info">'. $degree1.'</td>
                        <td class="info">'. $pas_year.'</td>
                        <td class="info">'. $major_subject.'</td>
                        <td class="info">'. $obt_marks.'</td>
                        <td class="info">'. $tot_marks.'</td>
                        <td class="info">'. $Board1.'</td>
                        <td class="info">';
                if($certificate == 'Inprogress') {
                    $html .= 'Inprogress';
                }
                elseif($certificate == '')
                {
                    $html .= "Not Uploaded";
                }
                $html .='</td></tr>';
                }
                $html .='</tbody></table></div></div>';
} else {
    $html .= '<div class="row p-0 m-0"><div class="col-md-12 text-center text-danger"><p><b>Education Details Not Uploaded</b></p>
        </div></div>';
}




    $html .= '<div class="row sec-title">
                  <div class="col-md-12 text-center text-primary">
                      <h3>Experience\'s Information</h3>
                      <hr class="shadow" style="border: 1px solid #007bff; margin: 0; ">
                  </div>
              </div>';

              $fetchData= "SELECT * FROM work_experince WHERE candidate_id = '$candidate_id'";
              $runData = mysqli_query($connection,$fetchData);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
                  $html .= '<div class="row">
                      <div class="col-md-12 table-responsive">
                          <table class="exp" cellpadding="0" cellspacing="0" border="1">
                              <thead>
                              <tr class="head">
                                  <th>S.No</th>
                                  <th>Organization/ Company</th>
                                  <th>Job Title(Job Relevent Experince)</th>
                                  <th>Date From </th>
                                  <th>Date To</th>
                                  <th>Duration</th>
                                  <th>File Upload</th>
                              </tr>
                              </thead>
                              <tbody>';

                              $count = 0;
                              while($rowData = mysqli_fetch_array($runData)) {
                                  $count++;
                                  $id  = $rowData['id'];
                                  $names  = $rowData['company'];
                                  $jobs  = $rowData['job_title'];
                                  $date_froms   = $rowData['date_from'];
                                  $date_tos   = $rowData['date_to'];
                                  $total_exp = $rowData['total_exp'];
                                  $file = $rowData['file'];
                                  $pathImg = "../../images/candidates/employee_experince/".$file;

                                  $html .= '<tr>
                                      <td class="info">'.$count.'</td>
                                      <td class="info">'.$names.'</td>
                                      <td class="info">'.$jobs.'</td>
                                      <td class="info">'.$date_froms.'</td>
                                      <td class="info">';
                                          if($rowData['date_to'] != "0000-00-00")
                                          {
                                              $html .= $date_tos;
                                          }
                                          else
                                          {
                                              $html .= "Continue";
                                          }
                                       $html .= '</td>
                                      <td class="info">'.$total_exp.'</td>
                                      <td class="info">';
                                          if($file == "Continue")
                                          {
                                              $html .= "Continue";
                                          }
                                          elseif($file == '')
                                          {
                                              $html .= "Not Uploaded";
                                          }
                                          $html .='</td>
                                  </tr>';
                              }
                              $html .='</tbody>
                          </table>
                      </div>
                  </div>';
              } else {
                 $html .=  '<div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-danger">
                          <p><b>Experience Details Not Uploaded</b></p>
                      </div>
                  </div>';
              }

    $html .= '<div class="html2pdf-page-break"></div>';

    $html .= '<div class="row sec-title">
                  <div class="col-md-12 text-center text-primary">
                      <h3>Challan Details</h3>
                      <hr class="shadow" style="border: 1px solid #007bff; margin: 0; ">
                  </div>
              </div>';

              $fetchData= "SELECT challan_file, challan_upload_date FROM candidate_applied_post WHERE candidate_id = '$candidate_id'";
              $runData = mysqli_query($connection,$fetchData);
              $countRow = mysqli_num_rows($runData);
              if($countRow != 0)
              {
                 $html .= '<div class="row">
                      <div class="col-md-12 table-responsive">
                          <table class="edu" cellspacing="0" cellpadding="0" border="1">
                              <thead>
                              <tr class="head">
                                  <th>Uploaded Date</th>
                                  <th>Challan</th>
                              </tr>
                              </thead>
                              <tbody>';

                              while($rowData = mysqli_fetch_array($runData)) {
                                  $file  = $rowData['challan_file'];
                                  $challan_date  = $rowData['challan_upload_date'];
                                  $challan_file = "../../images/candidates/challans/".$file;
                                  if($file != '') {

                                  $html .='<tr>
                                      <td style="width: 50px" class="info">'.$challan_date.'</td>
                                      <td style="width: 650px" class="info"><img src="'.$challan_file.'" width="650" class="challan_image"  /></td>

                                  </tr>';
                                    }
                                  }

                              $html .='</tbody>
                          </table>
                      </div>
                  </div>';
              } else {
                  $html .='<div class="row p-0 m-0">
                      <div class="col-md-12 text-center text-danger">
                          <p><b>Challan not uploaded!</b></p>
                      </div>
                  </div>';
              }







$html .= '</page>';
$html2pdf->writeHTML($html);
$html2pdf->output('candidate-'.$candidate_id.'.pdf', 'D');