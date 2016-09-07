<?php
error_reporting(0);
session_start();
$database="mydb";
// 创建连接
$conn = new mysqli("localhost", "root", "", $database);
// 检测连接
if ($conn->connect_error) {
    echo "error";
}
if(isset($_POST['pbutton'])) {
    $user = $_POST["user"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $major = $_POST["major"];
    $Scollage = $_POST["Scollage"];
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2 * 1024 * 1024 * 1024)) {
        move_uploaded_file($_FILES["file"]["tmp_name"], "img/accountImg/" . $_FILES["file"]["name"]);
        $img = $_FILES["file"]["name"];
        $sql= "UPDATE `client` SET `Simg`='".$img."'WHERE `user`='".$_SESSION['username']."'";
        $conn->query($sql);
    }
    if($user){
        $sql= "UPDATE `client` SET `user`='".$user."'WHERE `user`='".$_SESSION['username']."'";
        $conn->query($sql);
        $_SESSION['username']=$user;
    }
    if($password){
        $sql1= "UPDATE `client` SET `password`='".$password."' WHERE `user`='".$_SESSION['username']."'";
        $conn->query($sql1);
    }
    if($email){
        $sql= "UPDATE `client` SET `email`='".$email."' WHERE `user`='".$_SESSION['username']."'";
        $conn->query($sql);
    }
    if($Scollage){
        $sql= "UPDATE `client` SET `Scollage`='".$Scollage."'  WHERE `user`='".$_SESSION['username']."'";
        $conn->query($sql);
    }
    if($major){
        $sql= "UPDATE `client` SET `Smajor`='".$major."' WHERE `user`='".$_SESSION['username']."'";
        $conn->query($sql);
    }
    echo "<script> setTimeout(function(){location.href='admin.php';},0);</script>";
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="js/jquery-2.2.1.min.js"></script>
</head>
<style>
    .Pcourse{
        background-color: #ffffff;
        width: 1010px;
        height: auto;
        margin: 15px auto;
        border: 1px solid #e9e9e9;
        padding-bottom: 30px;
        padding-top: 30px;
        font-family: "微软雅黑";
    }
    .Pcourse .fbkc{
        color: #16a9e9;
        border-left: 5px solid #0576D3;
        margin-left: 150px;
        padding-left: 10px;
        font-size: 25px;
    }
    .Pcourse p{
        padding-top: 15px;
        padding-bottom: 15px;
        margin-left: 150px;
    }
    .FormName{
        color: #16a9e9;
        padding-right: 10px;
    }
    .Pcourse input{
        height: 26px;
        width: 300px;
        border: 1px solid #e9e9e9;
        padding-left: 5px;
        color: #111111;
    }
    .Pcourse .Stype{
        height: 26px;
        width: 60px;
        border: 1px solid #e9e9e9;
    }
    .Pcourse .Scollage{
        height: 26px;
        width: 150px;
        border: 1px solid #e9e9e9;
    }
    .Pcourse .file{
        width: 305px;
        font-size:16px;
        padding-left: 0px;
    }
    .Pcourse textarea{
        width: 300px;
        height: 80px;
        border: 1px solid #e9e9e9;
        padding-left: 5px;
        vertical-align: middle;
    }
    #pbutton{
        margin-left: 150px;
        margin-right: 100px;
        font-size: 18px;
        color: #ffffff;
        background-color:#16a9e9;
        border-radius: 5px;
        border: 0px;
        height: 30px;
    }
    #rbutton{
        font-size: 18px;
        color: #ffffff;
        background-color:#16a9e9;
        border-radius: 5px;
        border: 0px;
        height: 30px;
    }
    .Pnotice{
        position: absolute;
        width: 340px;
        height: 120px;
        left: 50%;
        top: 50%;
        margin-left: -170px;
        margin-top: -75px;
        background-color: #ffffff;
        border: 1px solid #e9e9e9;
        border-radius:10px;
    }
    .Pnotice h3{
        background-color: #16a9e9;
        padding: 4px;
        color: #ffffff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .Pnotice p{
        padding-top: 30px;
        text-align: center;
        font-size: 18px;
        font-family: "微软雅黑";
    }
    .noticeText{
        font-size: 12px;
        color: #ff0000;
    }
</style>
<body style="background-color: #f3f3f3">
<?php
include 'header.php'
?>
<div id="Pnotice" class="Pnotice" hidden="hidden">
    <h3>消息提示</h3>
    <p>个人信息修改成功(3s后关闭弹窗)</p>
</div>
<div class="Pcourse">
    <div><span class="fbkc">修改个人信息</span></div>
    <div class="PcourseForm">
        <form action="StudenRevise.php" method="post" enctype="multipart/form-data">
            <p><span class="FormName">修改昵称:</span><input id="user" type="text" name="user"></p>
            <p><span class="FormName">修改邮箱:</span><input id="email" type="text" name="email"></p>
            <p><span class="FormName">修改密码:</span><input id="password" type="password" name="password"><span class="noticeText"></span></p>
            <p><span class="FormName">修改专业:</span><input id="major" type="text" name="major"><span class="noticeText"></span></p>
            <p><span class="FormName">修改学院:</span>
                <select class="Scollage" id="Scollage" name="Scollage">
                    <option value="未填写">--</option>
                    <option value="计算机与软件学院">计算机与软件学院</option><option value="数学与统计学院">数学与统计学院</option><option value="经济学院">经济学院</option>
                    <option value="土木工程学院">土木工程学院</option><option value="信息工程学院">信息工程学院</option><option value="生命与海洋学院">生命与海洋学院</option>
                    <option value="心理学院">心理学院</option><option value="外国语学">外国语学院</option><option value="文学院">文学院</option>
                    <option value="医学院">医学院</option><option value="材料学院">材料学院</option><option value="电子科学与技术学院">电子科学与技术学院</option>
                </select>
            </p>
            <p><span class="FormName">个人头像:</span><input type="file" class="file" name="file" id="file"><span class="noticeText">（建议格式jpg,png,jpeg)</span></p>
            <input type="submit" id="pbutton" name="pbutton" value="确认修改"><input type="reset" id="rbutton" value="重置内容">
        </form>
    </div>
</div>
<?php include 'footer.php'?>
</body>
</html>