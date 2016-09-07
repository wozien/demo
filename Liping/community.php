<?php
error_reporting(0);
session_start();
$database="mydb";
$conn = new mysqli("localhost", "root", "", $database);
// 检测连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*下载代码*/
$file_name=NULL;                                            //初始化Ckey为空
if(empty($_GET["filename"]))                              //传值判断并进行赋值
{
    $file_name=NULL;
}
else{
    if($_SESSION['username']){
        $name=$_GET["filename"]; //下载文件名
        $file_dir = "./upload/";        //下载文件存放目录
        $file_name=iconv("UTF-8","GBK",$name);
        //检查文件是否存在
        if (!file_exists ( $file_dir.$file_name )) {
            echo "文件找不到";
            exit ();
        } else {
            //打开文件
            $file = fopen ( $file_dir.$file_name, "r" );
            //输入文件标签
            Header ( "Content-type: application/octet-stream" );
            Header ( "Accept-Ranges: bytes" );
            Header ( "Accept-Length:".filesize ( $file_dir.$file_name ) );
            Header ( "Content-Disposition: attachment; filename=".$file_name );
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            ob_clean();  
            flush(); 
            echo fread ( $file,filesize ( $file_dir.$file_name ) );
            fclose ( $file );
            exit ();
        }
    }
    else{
        echo '<script>alert("请先登录！")</script>';
        echo "<script> setTimeout(function(){location.href='community.php';},100);</script>";
    }
}
if(isset($_POST['upload1']))
{
    if($_SESSION['username']){
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            $size=$_FILES["file"]["size"] / 1024;
            $part=$_POST['bucket_name'];
            $writer=$_SESSION['username'];
            $time=date("Y")."-".date("m")."-".date("d");
            $sql = "insert into file(filename,Fsize,Fpart,Fdate,Fwriter)values('".$_FILES["file"]["name"] . "','" .$size . "','" . $part . "','" . $time . "','" .$writer. "')";
            if ($conn->query($sql) === TRUE) {
                $name=iconv("UTF-8","GBK", $_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" .$name);
                echo '<script>alert("恭喜你，资源上传成功！")</script>';
                echo "<script> setTimeout(function(){location.href='community.php';},100);</script>";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    else{
        echo '<script>alert("请先登录！")</script>';
        echo "<script> setTimeout(function(){location.href='community.php';},100);</script>";
    }
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>荔评网--资源社区</title>
    <link rel="shortcut icon" href="img/title-icon.ico">
    <link rel="stylesheet" href="css/css1.css">
    <script src="js/jquery-2.2.1.min.js"></script>
</head>
<script>
    $(function(){
        $(".uploadbtn").click(function(){
            $(".modal").slideDown(400);
        });
        $("#upload2").click(function(){
            $(".modal").slideUp(400);
        })
        $(".sub").click(function(){
            $filename=$(this).parent().parent().find(".td1").text();
            window.location.href="community.php? filename="+$filename;
        })
    })
</script>
<style>
    .downWrap{
        width: 960px;
        background-color: #ffffff;
        height: auto;
        padding: 30px 20px;
        margin: 30px auto;
        box-shadow: 5px 5px 5px #bfa594;
    }
    .uploadWrap{
        width: 980px;
        margin: 30px auto;
        padding: 10px;
        background-color: #ffffff;
        box-shadow: 5px 5px 5px #bfa594;
    }
    .uploadbtn{
        width: 200px;
        height: 50px;
        margin:auto;
        background-image: url("img/btnbg.jpg");
        background-size: cover;
        border-radius: 5px;
        cursor: pointer;
    }
    .downTitle{
        border-left: 5px solid #0576D3;
        margin-left: 5px;
        padding-left: 5px;
        text-align: left;
        font-weight: 550;
    }
    .downContent{
        width: 940px;
    }
    .downWrap table{
        width: 100%;
        font-size: 16px;
        font-family: "微软雅黑", Arial, Helvetica, sans-serif;
    }
    .trOne .td1{
        color: #049cdb;
        font-size: 14px;
    }
    .trOne .td3{
        font-size: 14px;
        color: #bfa594;
    }
    .downContent .td1{
        width: 374px;
        padding-left: 5px;
    }
    .downContent .td3{
        width: 112px;
        text-align: center;
    }
    .downContent .tr1{
        width: 100%;
        display: block;
        border-bottom: 2px solid #f1f1f1;
    }
    .downContent .trOne{
        padding-top: 3px;
        padding-bottom: 3px;
        width: 100%;
        display: block;
        border-bottom: 2px solid #f1f1f1;
        cursor: default;
    }
    .modal{
        position: fixed;
        width: 562px;
        height: 243px;
        background-color: #ffffff;
        border-radius: 4px;
        border: 1.3px solid #919191;
        box-shadow: 3px 3px 3px #bfa594;
        top: 180px;
        left: 30%;
        margin: 0 auto;
        z-index: 1
    }
    .modal-header{
        height: 35px;
        border-bottom: 1.5px solid #eeeeee;
        padding-top: 12px;
    }
    .modal-header h3{
        color: #3f3f3f;
        text-align: center;
    }
    .modal-header small{
        color: #bdbdbd;
        font-size: 15px;
    }
    .clearfix{
        margin-top: 25px;
    }
    .clearfix label{
        float: left;
        font-size: 14px;
        margin-left: 45px;
    }
    #bucket_name{
        width: 184px;
        margin-left:111px ;
        height: 27px;border-radius: 2px;
    }
    .modal-body{
        height: 105px;
    }
    .modal-footer{
        height: 62px;
        border-top: 1.5px solid #eeeeee;
        background-color: #f5f5f5;
    }
    .xlarge{
        margin-left: 111px;
    }
    #upload1{
        width: 55px;
        height: 30px;
        margin-top: 15px;
        float: right;
        margin-right: 14px;
        background-color: #0064cd;
        border-color: #0064cd;
        color: #ffffff;
    }
    #upload2{
        width: 55px;
        height: 30px;
        margin-top: 15px;
        margin-right: 20px;
        float: right;
    }
    .sub{
        width: 55px;
        height: 26px;
        background-color: #16a9e9;
        border:0;
        color: #ffffff;
        cursor: pointer;
    }
</style>
<body style="background-color: #f3f3f3">
    <?php
    $navid=2;
    include 'header.php';
    ?>
    <div class="uploadWrap">
        <img src="img/Uploadtitle.png" height="40">
        <div class="uploadbtn"></div>
    </div>
    <div class="modal" hidden="hidden">
        <form action="community.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h3>淘课资源<small>&#160;支持大多数文件后缀</small></h3>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    <label for="normalSelect">选择上传文件类型</label>
                    <div class="input">
                        <select name="bucket_name" id="bucket_name">
                            <option value="--">--</option>
                            <option value=".txt">txt</option>
                            <option value="image">图片</option>
                            <option value=".rar">压缩文件</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix">
                    <label for="xlInput">选择需要上传文件</label>
                    <div class="input">
                        <input type="file" size="30" name="file" id="file"class="xlarge"  value="请选择文件"/>
                        <span id="spanButtonPlaceholder"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="flash" id="fsUploadProgress"></div>
                <button class="btn primary" id="upload2" type="button">取消</button>
                <button class="btn primary" id="upload1" name="upload1" type="submit">上传</button>
            </div>
        </form>
    </div>
    <div class="downWrap">
        <div class="downContent">
            <h3 class="downTitle">课程资源</h3>
            <table>
                <tr class="tr1">
                    <td class="td1">资源名称</td>
                    <td class="td3">资源大小</td>
                    <td class="td3">资源类型</td>
                    <td class="td3">作者</td>
                    <td class="td3">上传时间</td>
                    <td class="td3">操作</td>
                </tr>
                <?php
                $database="mydb";
                // 创建连接
                $conn = new mysqli("localhost", "root", "", $database);
                if($name){
                    $sql = "SELECT * FROM file";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $filesize=round($row['Fsize'],2);
                            echo ' <tr class="trOne">';
                            echo '<td class="td1">'.$row["filename"].'</td> <!--资源名称-->';
                            echo '<td class="td3">'. $filesize .'KB</td> <!--资源大小-->';
                            echo '<td class="td3">'.$row['Fpart'] .'</td> <!--资源类型-->';
                            echo '<td class="td3">'.$row['Fwriter'] .'</td> <!--作者-->';
                            echo '<td class="td3">'.$row['Fdate'] .'</td> <!--上传时间-->';
                            echo ' <td class="td3"><input class="sub" class="sub" name="sub" value="下载" type="button"></td></tr>';
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>