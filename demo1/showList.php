<?php
/**
 * Created by PhpStorm.
 * User: zws
 * Date: 2016/4/10
 * Time: 13:54
 */

header("Content-Type: text/plain");
header("Content-Type:text/html;charset=utf-8");

$hostname="localhost";
$username="zws";
$password="123456";
$dbname="mydb";
$user=$_GET['u'];
$date=date("Y/m/d");

$conn=new mysqli($hostname,$username,$password,$dbname);
if($conn->connect_errno)
{
    echo "failed";
}

$sql="SELECT header FROM mydiary WHERE date='$date' AND user='$user' ";
$res=$conn->query($sql);
$detail=$date;

if($res->num_rows > 0)
{
    while($row=$res->fetch_assoc()){
        $detail.='|'.$row['header'];
    }
}
echo $detail;

$conn->close();