<?php
session_start();

include 'connect.php';

$username=$_POST['username'];
$password=$_POST['password'];
$Sno=$_POST['Sno'];
$type=$_REQUEST['k'];

if($type==1){
    $email=$_POST['email'];

    $sql="select * from client where user='$username'";
    $res=$conn->query($sql);

    if($res->num_rows>0){
        echo "exist user";
    }
    else{
        $sql="insert into client(user,email,password,Sno)values('$username','$email','$password','$Sno')";
        $conn->query($sql);
        $_SESSION['username']=$username;
        $_SESSION['Sno']=$Sno;
        echo "insert success";
    }

}
else{
    $sql="select * from client where user='$username'";
    $res=$conn->query($sql);

    if($res->num_rows==0){
        echo "no user";
    }
    else{
        $row=$res->fetch_assoc();
        if($row['password']===$password){
            $_SESSION['username']=$username;
            $_SESSION['Sno']=$Sno;
            echo "yes";
        }
        else {
            echo "no";
        }
    }
}

$conn->close();




