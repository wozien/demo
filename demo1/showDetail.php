<?php
/*
 * Created by PhpStorm.
 * User: zws
 * Date: 2016/4/10
 * Time: 16:45
 */

header("Content-Type: text/plain");
header("Content-Type:text/html;charset=utf-8");

$hostname="localhost";
$username="zws";
$password="123456";
$dbname="mydb";
$header=$_GET['h'];
$k=$_GET['k'];
$user=$_GET['u'];

$conn=new mysqli($hostname,$username,$password,$dbname);
if($conn->connect_errno)
{
    echo "failed";
}
if($k==='1'){
    $sql="select context from mydiary where header='$header' AND  user='$user'";
    $res=$conn->query($sql);

    if($res->num_rows>0){
        while($row=$res->fetch_assoc())
        {
            echo $row['context'];
        }
    }
}
else if($k==='2'){
    $sql="delete from mydiary where header='$header' and user='$user'";
    $res=$conn->query($sql);
    echo "";
}


$conn->close();
