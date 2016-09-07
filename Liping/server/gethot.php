<?php
// 获取热门课程

include '../class/courseclass.php';
include 'connect.php';

$sql="select * from course ORDER BY Cnof DESC ";
$res=$conn->query($sql);

if($res->num_rows>0){
    $ary=array();
    while($row=$res->fetch_assoc()){
        $cou=new course($row['Cname'],$row['Cno'],$row['Cteacher'],$row['Ctime']);
        $cou->setCnoc($row['Cnoc']);
        $cou->setCnof($row['Cnof']);
        $cou->setCimg($row['Cimg']);
        array_push($ary,$cou);
    }

    $json=json_encode($ary);

    echo $json;
}

$conn->close();