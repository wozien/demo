<?php

session_start();
// 根据编号获取课程详情和课程评论
include 'connect.php';
include "../class/courseclass.php";
include "../class/commentclass.php";

$Cno=$_GET['Cno'];
$type=$_GET['type'];
$Cuser=$_SESSION['username'];

if($type==1){
    $sql="select * from course where Cno='$Cno'";
    $res=$conn->query($sql);
    $row=$res->fetch_assoc();

    $cou=new course($row['Cname'],$row['Cno'],$row['Cteacher'],$row['Ctime']);
    $cou->setCnoc($row['Cnoc']);
    $cou->setCnof($row['Cnof']);
    $cou->setCimg($row['Cimg']);
    $cou->setCders($row['Cders']);
    $cou->setCcollage($row['Ccollage']);
    $cou->setCpart($row['Cpart']);

    $json=json_encode($cou);
    echo $json;
}

else if($type==2){

    $sql="select cc. *,comments. * from cc,comments where cc.Cno='$Cno' and cc.Cid=comments.cid";
    $res=$conn->query($sql);
    $json;
    if($res->num_rows>0){
        $ary=array();
        while($row=$res->fetch_assoc()){

            $com=new comment($row['Cuser'],$row['level'],$row['content'],$row['cdate']);
            $avg=($row['sco1']+$row['sco2']+$row['sco3']);
            $com->setSco($avg/3);
            $sql1= "SELECT * FROM client WHERE user="."'".$row['Cuser']."'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    if($row['Simg']){
                        $com->setCimg($row['Simg']);
                    }
                    else{
                        $com->setCimg("defaultuser.png");
                    }
                }
            }
            else{
                $com->setCimg("defaultuser.png");
            }
            array_push($ary,$com);
        }
        $json=json_encode($ary);
    }
    else{
        $json=0;
    }
    echo $json;
}

else if($type==3){

    $sql="insert into cf values('$Cuser','$Cno')";
    $conn->query($sql);
    $sql="update course set Cnof=Cnof+1 where Cno='$Cno'";
    $conn->query($sql);
}
else if($type==4){
    $sql="delete from cf where Cuser='$Cuser' and Cno='$Cno'";
    $conn->query($sql);
    $sql="update course set Cnof=Cnof-1 where Cno='$Cno'";
    $conn->query($sql);
}
else{
    $sql="select * from cf where Cuser='$Cuser' and Cno='$Cno'";
    $res=$conn->query($sql);
    if($res->num_rows>0){
        echo 1;
    }
    else {
        echo 0;
    }
}
$conn->close();



