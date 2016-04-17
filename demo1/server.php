<?php

header("Content-Type: text/plain");
header("Content-Type:text/html;charset=utf-8");

$user=$_POST['u'];
$context=$_POST['c'];
$header=$_POST['h'];
$date=date("Y/m/d");

$hostname="localhost";
$username="zws";
$password="123456";
$dbname="mydb";

$conn=new mysqli($hostname,$username,$password,$dbname);

$sql="insert into mydiary (user,header,context,date) VALUES ('$user','$header','$context','$date')";
if($conn->query($sql)===true){
    echo $date.$header;
}
else{
    echo "error";
}

$conn->close();

