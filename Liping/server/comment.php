<?php
session_start();
// 完成插入commments表工作

include "connect.php";

$level=$_POST['level'];
$sco1=$_POST['sco1'];
$sco2=$_POST['sco2'];
$sco3=$_POST['sco3'];
$content=$_POST['content'];
date_default_timezone_set('PRC');
$cdate=date("Y-m-d H:i");
$sql="select count(*) from comments";
$res=$conn->query($sql);
$row=$res->fetch_assoc();
$cid=$row['count(*)']+1;


$sql="insert into comments values($cid,$sco1,$sco2,$sco3,$level,'$content','$cdate')";
$conn->query($sql);

$Cuser=$_SESSION['username'];
$Cno=$_POST['Cno'];

$sql="insert into cc values('$Cno','$Cuser',$cid)";
$conn->query($sql);

$sql="update course set Cnoc=Cnoc+1 where Cno='$Cno'";
$conn->query($sql);

$conn->close();