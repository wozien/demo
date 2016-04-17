<?php
/**
 * Created by PhpStorm.
 * User: zws
 * Date: 2016/4/15
 * Time: 12:04
 */
$hostname="localhost";
$username="zws";
$password="123456";
$dbname="mydb";

$conn=new mysqli($hostname,$username,$password,$dbname);
$k=$_POST['k'];
if($k==1){
    $t1=$_POST['txt1'];
    $t2=$_POST['txt2'];
    $sql="select password from client where user='$t1'";
    $res=$conn->query($sql);
    if($res->num_rows){
        $row=$res->fetch_assoc();
        $pw=$row['password'];
        if($pw===$t2){
            echo "登录成功";
        }
        else{
            echo "密码错误";
        }
    }
    else{
        echo "不存在该用户";
    }

}
else if($k==2){
    $t1=$_POST['txt1'];
    $t2=$_POST['txt2'];
    $t3=$_POST['txt3'];
    $sql="insert into client (user,email,password) values ('$t1','$t2','$t3')";
    if($conn->query($sql)===true){
        echo "注册成功";
    }else{
        echo "注册失败";
    }
}


