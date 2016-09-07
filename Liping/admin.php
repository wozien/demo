<?php
$database="mydb";
// 创建连接
$conn = new mysqli("localhost", "root", "", $database);
// 检测连接
if ($conn->connect_error) {
    echo "error";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人主页</title>
    <link rel="shortcut icon" href="img/title-icon.ico">
    <link rel="stylesheet" href="css/css1.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <script src="js/jquery-2.2.1.min.js"></script>
</head>
<style>
    .adminWrap{
        position: relative;
        width: 1000px;
        margin: 20px auto;
    }
    .Left{
        float: left;
        width: 300px;
        height: auto;
    }
    .sidebarLeft{
        width: 100%;
        border: 1px solid #e9e9e9;
        background-color: #ffffff;
        padding-bottom: 30px;
    }
    .sidebarLeft .accountImg{
        display: block;
        margin-left: 40px;
        margin-top: 22px;
    }
    .sidebarLeft span{
        display: block;
        width: 220px;
        margin-top: 10px;
        margin-left: 40px;
        font-size: 22px;
        color: #17aaea;
        border-bottom: 1px dashed #e9e9e9;
    }
    .sidebarLeft ul{
        margin-left: 40px;
    }
    .sidebarLeft ul li{
        font-size: 16px;
        color: #949393;
        margin-top: 15px;
    }
    .sidebarLeft a{
        font-size: 14px;
        color: #ff0000;
        text-decoration: underline;
        margin-left: 200px;
    }
    .Right{
        float: left;
        width: 680px;
        margin-left: 20px;
    }
    .sidebarRight{
        width: 100%;
        border: 1px solid #e9e9e9;
        background-color: #ffffff;
        padding: 20px 17px;
        font-family: "微软雅黑";
        margin-bottom: 22px;
    }
    #courseH{
        color: #17aaea;
        font-size: 22px;
        margin-top: 0px;
    }
    .sidebarRight p{
        font-size: 14px;
        color: #949393;
        margin-top: 10px;
    }
    .sidebarRight p a{
        color: #17aaea;
        font-size: 16px;
        letter-spacing: 2px;
    }
    .nullDiv{
        clear: both;
    }
</style>
<body style="background-color: #f3f3f3">
<?php
include 'header.php'
?>
<div class="adminWrap">
    <div class="Left">
        <div class="sidebarLeft">
            <img class="accountImg" src="img/<?php
            $sql = "SELECT * FROM client WHERE user="."'".$_SESSION['username']."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    if($row['Simg']){
                        echo "accountImg/".$row['Simg'];
                    }
                    else{
                        echo "accountImg/defaultuser.png";
                    }
                }
            }
            ?>" width="220">
            <span>个人档案</span>
            <ul>
                <li>昵称：
                    <?php
                    echo $_SESSION['username'];
                    ?>
                </li>
                <li>学院：
                    <?php
                    $sql = "SELECT * FROM client WHERE user="."'".$_SESSION['username']."'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['Scollage']){
                                echo $row['Scollage'];
                            }
                            else{
                                echo "暂未填写O__O ";
                            }
                        }
                    }
                    ?>
                </li>
                <li>专业：
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['Smajor']){
                                echo $row['Smajor'];
                            }
                            else{
                                echo "暂未填写O__O ";
                            }
                        }
                    }
                    ?>
                </li>
                <li>学号：
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row['Sno'];
                        }
                    }
                    ?>
                </li>
                <li>邮箱：
                    <?php
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            if($row['email']){
                                echo $row['email'];
                            }
                            else{
                                echo "暂未填写O__O ";
                            }
                        }
                    }
                    ?>
                </li>
            </ul>
            <span></span>
            <a href="StudenRevise.php"><i>修改资料>></i></a>
        </div>
    </div>
    <div class="Right">
        <div class="sidebarRight">
            <div class="course">
                <p id="courseH">课程</p>
                <p><a href="#"><?php
                        $sql = "select * from cf WHERE Cuser="."'".$_SESSION['username']."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo $result->num_rows;
                        }
                        else{
                            echo "0";
                        }
                        ?></a>个关注课程</p>
            </div>
        </div>
        <div class="sidebarRight">
            <div class="review">
                <p id="courseH">点评</p>
                <p><a href="#"> <?php
                        $sql = "select * from cc WHERE Cuser="."'".$_SESSION['username']."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo $result->num_rows;
                        }
                        else{
                            echo "0";
                        }
                        ?></a>条点评</p>
            </div>
        </div>
        <div class="sidebarRight">
            <div class="review">
                <p id="courseH">资源</p>
                <p><a href="#"> <?php
                        $sql = "select * from file WHERE Fwriter="."'".$_SESSION['username']."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo $result->num_rows;
                        }
                        else{
                            echo "0";
                        }
                        ?></a>个已上传文档</p>
            </div>
        </div>
    </div>
    <div class="nullDiv"></div>
</div>
<?php include 'footer.php'?>
</body>
</html>