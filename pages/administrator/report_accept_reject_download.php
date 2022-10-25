<?php

include "includes/db.php";
if (isset($_GET['proj_id']) && isset($_GET['post_id']) && isset($_GET['type'])) {
    $proj_id = $_GET['proj_id'];
    $postId = $_GET['post_id'];
    $list_type = $_GET['type'];
    // Set the content type
    header('Content-type: application/csv');
    // Set the file name option to a filename of your choice.
    header('Content-Disposition: attachment; filename='.$list_type.'_report.csv');
    // Set the encoding
    header("Content-Transfer-Encoding: UTF-8");
    $output = fopen("php://output", "a");
    fputcsv($output, array('S.No', 'Post', 'Name', 'Father Name', 'Gender', 'CNIC', 'DOB', 'Address', 'Personal Contact',
        'Other Contact', 'Email', 'Religion', 'Total Experience', 'Education', 'Obtain Marks', 'Test City', 'Application Status'));
    $count = 0;
    $fetchData = "SELECT c.id,pp.post_name,c.image,c.name,c.f_name,c.gender,c.cnic,c.dob,c.postal_address,c.phone,
       c.telephone,c.email,c.religion, ct.c_name, ca.status_details, ca.experienceInYears,
       (
            SELECT GROUP_CONCAT(el.level_name SEPARATOR ', ')
            from education AS e 
            LEFT JOIN degree AS deg ON e.degree_id=deg.id 
            LEFT JOIN edu_level AS el ON deg.level_id=el.id WHERE c.id=e.candi_id 
            ORDER BY e.passing_year ) AS education_level,
            (
            SELECT GROUP_CONCAT(CONCAT(e.obtain_marks,'/',e.total_marks) SEPARATOR ', ')
            from education AS e 
             WHERE c.id=e.candi_id 
            ORDER BY e.passing_year ) AS marks
        FROM candidate_applied_post AS ca 
            INNER JOIN projects_posts AS pp ON pp.id = ca.post_id 
            INNER JOIN projects AS p ON p.id = pp.project_id 
            INNER JOIN candidates AS c ON c.id = ca.candidate_id 
            LEFT JOIN city AS ct ON ct.id = ca.city_id 
        WHERE (ca.post_id = '$postId' OR '$postId' = 'all')
          AND ca.status = '$list_type' AND p.id = '$proj_id' ORDER BY pp.post_name,c.gender,c.name ASC";
    $runData = mysqli_query($connection,$fetchData);

    $countRow = mysqli_num_rows($runData);
    if($countRow > 0) {
        while ($rowData = mysqli_fetch_array($runData)) {
            $count++;
            $post_name = $rowData['post_name'];
            $image = $rowData['image'];
            $imagePath = "../../images/candidates/profile picture/".$image;
            $name = $rowData['name'];
            $cand_id = $rowData['id'];
            $f_name = $rowData['f_name'];
            $gender = $rowData['gender'];
            $cnic = $rowData['cnic'];
            $dob = date("d-m-Y",strtotime($rowData['dob']));
            $postal_address = $rowData['postal_address'];
            $phone = $rowData['phone'];
            $telephone = $rowData['telephone'];
            $email = $rowData['email'];
            $religion = $rowData['religion'];
            $status_detail = $rowData['status_details'];
            $experienceInYears = $rowData['experienceInYears'];

            $level_name = $rowData['education_level'];
            $marks = $rowData['marks'];
            $c_name = $rowData['c_name'];
            $status = strtolower($list_type) == 'accepted' ? 'Accepted' : 'Rejected - '.$status_detail;
            fputcsv($output, array($count, $post_name, $name, $f_name, $gender, $cnic, $dob, $postal_address, $phone, $telephone,
                $email, $religion, $experienceInYears, $level_name, $marks, $c_name, $status));
        }
    }
    fclose($output);
}