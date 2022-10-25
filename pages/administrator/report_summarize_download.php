<?php
include "includes/db.php";
if(isset($_GET['proj_id']) && isset($_GET['post_id']) && isset($_GET['city_id'])) {
    $proj_id = $_GET['proj_id'];
    $postId = $_GET['post_id'];
    $city_id = $_GET['city_id'];

    $where = "pp.project_id='$proj_id'";
    if($postId != 'all' && $postId != '') {
        $where .= " AND cap.post_id='$postId'";
    }
    if($city_id != 'all' && $city_id != '') {
        $where .= " AND cap.city_id='$city_id'";
    }
    $today = date('Y-m-d');
    $fetchData = "SELECT  pp.post_name, c.f_name,c.army_exper, c.simple_exper, c.name AS candidate_name, c.phone, c.email, c.cnic, c.gender, c.dob,
       c.postal_address,cit.c_name, d.dis_name AS domicile, cap.experienceInYears, c.gov_employee, cap.challan_file, 
       (SELECT GROUP_CONCAT(el.level_name SEPARATOR ', ') from education AS e LEFT JOIN degree AS deg ON e.degree_id=deg.id 
           LEFT JOIN edu_level AS el ON deg.level_id=el.id 
            WHERE c.id=e.candi_id ORDER BY e.passing_year ) AS education_level,
        (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$today')/365.28),3)) AS age
            
            FROM candidate_applied_post AS cap 
            LEFT JOIN candidates c ON cap.candidate_id = c.id 
            LEFT JOIN city AS cit ON cap.city_id=cit.id 
            LEFT JOIN projects_posts AS pp ON cap.post_id=pp.id 
            LEFT JOIN district AS d ON c.district_id=d.id 
            Where $where";
    $runQ = mysqli_query($connection,$fetchData);
    $count = 0;
    // Set the content type
    header('Content-type: application/csv');
// Set the file name option to a filename of your choice.
    header('Content-Disposition: attachment; filename=Reports.csv');
// Set the encoding
    header("Content-Transfer-Encoding: UTF-8");
    $output = fopen("php://output", "a");
    fputcsv($output, array('S.No', 'Post', 'Name', 'Father Name', 'Contact #', 'Email', 'CNIC', 'DOB', 'Age', 'Gender',
        'City', 'Address', 'Domicile', 'Quota', 'Education', 'Total Experience', 'Govt Employee', 'Eligible',
        'Challan Submitted'));

    while ($rowQ = mysqli_fetch_array($runQ)) {
        $count++;
        $post_name = $rowQ['post_name'];
        $name = $rowQ['candidate_name'];

        $fname = $rowQ['f_name'];
        $phone = $rowQ['phone'];
        $email = $rowQ['email'];
        $cnic = $rowQ['cnic'];
        $gender = $rowQ['gender'];
        $dob = $rowQ['dob'];
        $postal_address = $rowQ['postal_address'];
        $c_name = $rowQ['c_name'];
        $domicile = $rowQ['domicile'];
        $experienceInYears = $rowQ['experienceInYears'];
        $gov_employee = $rowQ['gov_employee'];
        $challan_file = $rowQ['challan_file'] != '' ? 'Yes': 'No';
        $education_level = $rowQ['education_level'];
        $age = $rowQ['age'];
        $diff = null;
        if($rowQ['dob'] != '') {
            $bday = new DateTime($rowQ['dob']);
            $today = new DateTime(date('Y-m-d'));
            $diff = $today->diff($bday);

        }

        $quota = '';
        $eligible = '';
        fputcsv($output, array($count, $post_name, $name, $fname, $phone, $email, $cnic, $dob, $age, $gender, $c_name,
            $postal_address, $domicile, $quota, $education_level, $experienceInYears, $gov_employee, $eligible, $challan_file));
    }
    fclose($output);
}