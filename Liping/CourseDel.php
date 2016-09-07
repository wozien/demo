<?php
$Cno=$_GET['Cno'];
$con=mysqli_connect("localhost","root","","mydb");
if (mysqli_connect_errno())
{
    echo "未能连接上数据库: " . mysqli_connect_error();
}
mysqli_query($con,"DELETE  FROM course WHERE Cno='$Cno'");
echo "ok";
mysqli_close($con);
?>