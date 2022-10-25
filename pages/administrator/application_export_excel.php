<?php
require "../../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Dimension;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

include "includes/db.php";
$postId = $_GET['postId'];
$city_id = $_GET['city_id'];
$candStatus = $_GET['candStatus'];
$spreadsheet = new Spreadsheet();

if($postId) {
    $where = "cp.post_id = '$postId' AND cp.status = '$candStatus'";
    if($city_id != '0') {
        $where .= " AND ct.id = '$city_id'";
    }
    $totalRecSql = "SELECT count(*) AS total
            FROM candidate_applied_post AS cp LEFT JOIN candidates AS c ON c.id = cp.candidate_id
            LEFT JOIN projects_posts AS pp ON pp.id = cp.post_id
            LEFT JOIN city AS ct ON ct.id = cp.city_id
            WHERE $where";
    $totalRecQ = mysqli_query($connection, $totalRecSql);
    $totalRes = mysqli_fetch_array($totalRecQ);

    $count = 0;
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'S.NO')
        ->setCellValue('B1', 'Name')
        ->setCellValue('C1', 'Father/Guardian Name')
        ->setCellValue('D1', 'Gender')
        ->setCellValue('E1', 'CNIC NO')
        ->setCellValue('F1', 'Contact No')
        ->setCellValue('G1', 'Test City')
        ->setCellValue('H1', 'Apply Date')
        ->setCellValue('I1', 'Application Status')
        ->setCellValue('J1', 'Status Detail')
        ->setCellValue('L1', 'Image');
    $r = 2;
    $i = 1;
//    print_r($totalRes);
    $spreadsheet->setActiveSheetIndex(0);
    for($j = 0; $j <= $totalRes['total']; $j+=10000) {
         $fetchData = "SELECT cp.id AS apply_id, c.id AS cand_id, c.name, c.cnic, c.phone, c.f_name, c.gender, c.image,
            ct.c_name, cp.apply_date, cp.status, cp.status_details, cp.challan_file, cp.challan_upload_date
            FROM candidate_applied_post AS cp LEFT JOIN candidates AS c ON c.id = cp.candidate_id
            LEFT JOIN projects_posts AS pp ON pp.id = cp.post_id
            LEFT JOIN city AS ct ON ct.id = cp.city_id
            WHERE $where ORDER BY cp.id ASC LIMIT $j, 10000";
        $runQ = mysqli_query($connection, $fetchData);
        while ($rowQ = mysqli_fetch_array($runQ)) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $r, $i)
                ->setCellValue('B' . $r, $rowQ['name'])
                ->setCellValue('C' . $r, $rowQ['f_name'])
                ->setCellValue('D' . $r, $rowQ['gender'])
                ->setCellValue('E' . $r, $rowQ['cnic'])
                ->setCellValue('F' . $r, $rowQ['phone'])
                ->setCellValue('G' . $r, $rowQ['c_name'])
                ->setCellValue('H' . $r, date("d-m-Y", strtotime($rowQ['apply_date'])))
                ->setCellValue('I' . $r, $rowQ['status'])
                ->setCellValue('J' . $r, $rowQ['status_details'])
                ->setCellValue('K' . $r, '');
            if (file_exists(__DIR__ . "/../../images/candidates/profile picture/" . $rowQ['image']) && $rowQ['image'] != '') {
//                $candImage = new Drawing();
//                $candImage->setPath(__DIR__ . "/../../images/candidates/profile picture/" . $rowQ['image']);
//                $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(75, Dimension::UOM_PIXELS);
//                $spreadsheet->getActiveSheet()->getRowDimension($r)->setRowHeight(75, Dimension::UOM_PIXELS);
//                $candImage->setCoordinates('L' . $r);
//                $candImage->setCoordinates2('L'.$r);
//                $candImage->setOffsetX(75);
//                $candImage->setOffsetY(75);
//                $candImage->setWidth(75);
//                $candImage->setHeight(75);
//                $candImage->setWorksheet($spreadsheet->getActiveSheet());
//        $candImage->setEditAs(Drawing::EDIT_AS_ONECELL);
            }
            $r++;
            $i++;
        }
    }
}



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

$file = $candStatus."-Candidate-".date('Y-m-d').".xlsx";
$writer->save($file);

// define file $mime type here
ob_end_clean(); // this is solution
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($file);
@unlink(__DIR__.'/'.$file);
exit;