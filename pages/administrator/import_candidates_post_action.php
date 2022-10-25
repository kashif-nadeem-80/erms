<?php
session_start();
include "includes/db.php";
require "../../vendor/autoload.php";
//use PhpOffice\PhpSpreadsheet\IOFactory;
//use PhpOffice\PhpSpreadsheet\Helper\Dimension;
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
if(!isset($_SESSION['uts_admin'])) {
    ?>
    <script>
        location.href = '../index.php';
    </script>
    <?php
}

if(isset($_POST['proj_id']) && isset($_POST['post_id']) && isset($_FILES['candidates'])) {
    $filename = $_FILES['candidates']['name'];
    $proj_id = $_POST['proj_id'];
    $post_id = $_POST['post_id'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(strtolower($ext) === 'xlsx') {
        $post_sql = "SELECT id from projects_posts WHERE id='$post_id'";
        $postQ = mysqli_query($connection,$post_sql);
        if(mysqli_num_rows($postQ) === 1) {
            $newFileName = time().'.xlsx';
            $targetPath = '../../images/candidates/import/'.$newFileName;
            move_uploaded_file($_FILES['candidates']['tmp_name'], $targetPath);
//            $newFileName = '../../images/candidates/import/1655679760.xlsx';
            $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($targetPath);
            $sheet_data = $spreadsheet->getActiveSheet()->toArray();
            $ij = 1;
            for ($i = 1; $i < count($sheet_data); $i++) {
                $job_serial_no = $sheet_data[$i][0];
                $name = mysqli_real_escape_string($connection, $sheet_data[$i][2]);
                $fatherName = mysqli_real_escape_string($connection, $sheet_data[$i][3]);
                $cnic = mysqli_real_escape_string($connection, $sheet_data[$i][4]);
                //$city = str_replace("\xc2\xa0", '', $sheet_data[$i][4]);
                $dob = date('Y-m-d', strtotime($sheet_data[$i][5]));
                $religion = mysqli_real_escape_string($connection, $sheet_data[$i][7]);
                $gender = mysqli_real_escape_string($connection, $sheet_data[$i][8]);
                $disability = mysqli_real_escape_string($connection, $sheet_data[$i][9]);
                $gov_employee = mysqli_real_escape_string($connection, $sheet_data[$i][10]);

                $domicile = mysqli_real_escape_string($connection, $sheet_data[$i][11]);
                $domicileDist = mysqli_real_escape_string($connection, $sheet_data[$i][12]);
                $postalAddress = mysqli_real_escape_string($connection, $sheet_data[$i][14]);
                $email = mysqli_real_escape_string($connection, $sheet_data[$i][17]);
                $phone = mysqli_real_escape_string($connection, $sheet_data[$i][15]);
                $telephone = mysqli_real_escape_string($connection, $sheet_data[$i][16]);
                $testCenter = mysqli_real_escape_string($connection, $sheet_data[$i][18]);
                $quota_applied_for = mysqli_real_escape_string($connection, $sheet_data[$i][13]);

                $city = $testCenter;

//                $districtSql = "SELECT id from district WHERE dis_name='$domicileDist'";
//                $distQ = mysqli_query($connection,$districtSql);
//                $distRes = mysqli_fetch_assoc($distQ);
//                $districtId = null;
//                echo $domicileDist.'<br>';
//                if(mysqli_num_rows($distQ) > 0) {
//                    $districtId = $distRes['id'];
//                }

                $whereCand = '';
                if($cnic != '' && $cnic != '00000-0000000-0') {
                    $whereCand = "cnic='$cnic'";
                }
                if($whereCand == '' && $email != '') {
                    $whereCand = "email='$email'";
                }
                if($whereCand == '' && $phone != '') {
                    $whereCand = "phone='$phone'";
                }

                if($whereCand == '')
                    continue;
                //Check Data
//                $checkCandSql = "Select c.id, cap.id AS capId from candidates AS c LEFT JOIN candidate_applied_post AS cap
//                                ON c.id = cap.candidate_id
//                                    where c.cnic='$cnic'";
//                $checkQ = mysqli_query($connection, $checkCandSql);
//                $checkRes = mysqli_fetch_assoc($checkQ);
//                if($checkRes['capId'] == '') {
//                    echo $cnic.'<br>';
//                }
                // End Check data




                $isCandidate = "SELECT id from candidates WHERE $whereCand";

                $candidateQ = mysqli_query($connection, $isCandidate);
                $todayDate = date('Y-m-d');
                $candidateId = null;
                if(mysqli_num_rows($candidateQ) === 0) {
                    $newCandidate = "INSERT INTO candidates (name, cnic, email, phone, f_name, dob, postal_address,
                        religion, gender, disability, gov_employee, telephone, quota_applied_for, job_serial_no, signUpDate)
                    VALUES ('$name', '$cnic', '$email', '$phone', '$fatherName', '$dob', '$postalAddress','$religion',
                           '$gender', '$disability', '$gov_employee', '$telephone', '$quota_applied_for', '$job_serial_no',
                            '$todayDate')";
                    $insertCand = mysqli_query($connection, $newCandidate) or die("ERROR CAND INS::".mysqli_error($connection));
                    $candidateId = mysqli_insert_id($connection);
                } else {
                    $existingCand = mysqli_fetch_assoc($candidateQ);
                    $candidateId = $existingCand['id'];
//
//                    if($candidateId = $existingCand['id']) {
//                        $updateCandidate = "UPDATE candidates SET email='$email', phone='$phone',
//                        postal_address='$postalAddress', telephone='$telephone', gov_employee='$gov_employee',
//                        disability='$disability', job_serial_no='$job_serial_no'
//                         WHERE id='$candidateId'";
//                        mysqli_query($connection, $updateCandidate) or die("ERROR CAND UPD::".mysqli_error($connection));
//                    }
                }

                $citySql = "SELECT id FROM city WHERE c_name='$city'";
                $cityQ = mysqli_query($connection, $citySql) or die("ERROR CITY::".mysqli_error($connection));
                $cityData = mysqli_fetch_assoc($cityQ);
                $cityId = isset($cityData['id']) ? $cityData['id']: '';
                $dateTime = date('Y-m-d H:i:s');
                $isAlreadyApplied = "SELECT id from candidate_applied_post
                                        WHERE candidate_id='$candidateId' AND post_id='$post_id'";
                $aleradyAppliedQ = mysqli_query($connection, $isAlreadyApplied);
                if(mysqli_num_rows($aleradyAppliedQ) === 0) {
                    $applyFor = "INSERT INTO candidate_applied_post (candidate_id, post_id, city_id, apply_date, status )
                                VALUES ('$candidateId', '$post_id', '$cityId', '$dateTime', 'Pending')";
                    $applyQ = mysqli_query($connection, $applyFor) or die("ERROR INS::".mysqli_error($connection));
                    $ij++;

                } else {
//                    $applyFor = "UPDATE candidate_applied_post SET candidate_id='$candidateId', post_id='$post_id',
//                                  city_id='$cityId', apply_date='$dateTime' WHERE candidate_id='$candidateId' AND post_id='$post_id'";
//                    $applyQ = mysqli_query($connection, $applyFor) or die("ERROR UPD::".mysqli_error($connection));
                }
            }
            @unlink($targetPath);
            $_SESSION['import_success'] = 1;
            ?>
            <script>
                location.href = 'import_candidates_for_post.php';
            </script>
<?php
        }
    }
}