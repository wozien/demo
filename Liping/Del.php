<?php
$Sno=$_GET['Sno'];
$con=mysqli_connect("localhost","root","","mydb");
if (mysqli_connect_errno())
{
    echo "未能连接上数据库: " . mysqli_connect_error();
}
mysqli_query($con,"DELETE  FROM client WHERE Sno='$Sno'");
echo "ok";
mysqli_close($con);
?>