<?php
include "includes/db.php";
$request=$_REQUEST;
$col =array(
    0   =>  'image',
    1   =>  'name',
    2   =>  'cnic',
    3   =>  'f_name',
    4   =>  'gender',
    5   =>  'dob',
    6   =>  'phone',
    7   =>  'dis_name',
    8   =>  'password',
    9   =>  'status',
    10  =>  'id'
);
      //create column like table in database

    $sql ="SELECT  c.image,c.name,c.cnic,c.f_name,c.gender,c.dob,c.phone,d.dis_name,c.password,c.status,c.id FROM `candidates` AS c LEFT JOIN district AS d ON d.id = c.district_id";
        $query=mysqli_query($connection,$sql);
        $totalData=mysqli_num_rows($query);
        $totalFilter=$totalData;
        $sql ="SELECT  c.image,c.name,c.cnic,c.f_name,c.gender,c.dob,c.phone,d.dis_name,c.password,c.status,c.id FROM `candidates` AS c LEFT JOIN district AS d ON d.id = c.district_id WHERE 1=1";
//Search For Data
if(!empty($request['search']['value']))
{
    $sql.=" AND (image Like '".$request['search']['value']."%' ";
    $sql.=" OR name Like '".$request['search']['value']."%' ";
    $sql.=" OR cnic Like '".$request['search']['value']."%' ";
    $sql.=" OR f_name Like '".$request['search']['value']."%' ";
    $sql.=" OR gender Like '".$request['search']['value']."%' ";
    $sql.=" OR dob Like '".$request['search']['value']."%' ";
    $sql.=" OR phone Like '".$request['search']['value']."%' ";
    $sql.=" OR dis_name Like '".$request['search']['value']."%' ";
    $sql.=" OR password Like '".$request['search']['value']."%' ";
    $sql.=" OR status Like '".$request['search']['value']."%') ";
}
    $query=mysqli_query($connection,$sql);
    $totalData=mysqli_num_rows($query);

//Order
        $sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
            $request['start']."  ,".$request['length']."  ";
        $query=mysqli_query($connection,$sql);
        $data=array();
        $count = 1;
        while($row=mysqli_fetch_array($query)){
            $subdata=array();
            $subdata[]=$count++;
            if($row[0] != "") 
            {
                $subdata[]='<img src="../../images/candidates/profile picture/'.$row[0].'" class="rounded" width="70px" height="70px">';
            }
            else
            {
                $subdata[]="<span class='text-danger'>Not Uploaded</span>";
            }
            $subdata[]=$row[1];
            $subdata[]=$row[2];
            $subdata[]=$row[3];        
            $subdata[]=$row[4];        
            $subdata[]=$row[5];        
            $subdata[]=$row[6];        
            $subdata[]=$row[7];        
            $subdata[]=$row[8];           
            if($row[9] != 0)
            {
                $subdata[]= "<i class='fa fa-check text-success'></i> Verified";
            }
            else
            {
                $subdata[]= "<i class='fa fa-times text-danger'></i> Not Verified";
            } 

        $subdata[]='<a href="registered_users_details.php?id='.$row[10].'" class="btn btn-xs btn-warning shadow title" title="Details"><span><i class="fa fa-eye"></i></span></a>

        <a style="margin-top:3px" href="registered_user_update.php?u_id='.$row[10].'" class="btn btn-xs btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

        <a href="registered_add_education.php?u_id='.$row[10].'" class="btn btn-xs btn-primary title shadow" style="margin-top: 2px" title="Add Education"><span><i class="fa fa-plus"></i></span></a>

        <a href="registered_add_experience.php?u_id='.$row[10].'" class="btn btn-xs btn-success title shadow" style="margin-top: 2px" title="Add Experience"><span><i class="fa fa-plus"></i></span></a>

        <input type="hidden" id="pathImg'.$row[10].'" value="../../images/candidates/profile picture/'.$row[0].'">

        <a onclick="deleteData('.$row[10].')" class="btn btn-xs btn-danger title shadow" style="margin-top: 2px" title="Delete"><span><i class="fa fa-trash"></i></span></a>';
        $data[]=$subdata;
}
            $json_data=array(
                "draw"              =>  intval($request['draw']),
                "recordsTotal"      =>  intval($totalData),
                "recordsFiltered"   =>  intval($totalFilter),
                "data"              =>  $data
            );
            echo json_encode($json_data);
?>
