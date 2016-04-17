<?php
/**
 * Created by PhpStorm.
 * User: zws
 * Date: 2016/4/17
 * Time: 2:05
 */

$user=$_GET['u'];
$date=$_GET['t'];

$hostname="localhost";
$username="zws";
$password="123456";
$dbname="mydb";
$conn=new mysqli($hostname,$username,$password,$dbname);
$sql="select header from mydiary WHERE user='$user' and date='$date'";

$res=$conn->query($sql);
$result=$date;

if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $result.='|'.$row['header'];
    }
    echo $result;
}
else{
    echo "";
}