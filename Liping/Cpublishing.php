<?php
error_reporting(0);
$database="mydb";
// 创建连接
$conn = new mysqli("localhost", "root", "", $database);
// 检测连接
if ($conn->connect_error) {
    echo "error";
}
if(isset($_POST['pbutton'])) {
    $Cname = $_POST["Cname"];
    $Cno = $_POST["Cno"];
    $Cteacher = $_POST["Cteacher"];
    $Spart = $_POST["Stype"];
    $Scollage = $_POST["Scollage"];
    $Ctime = $_POST["Ctime"];
    $Cders=$_POST["content"];
    if($Cname&&$Cno&&$Cteacher){
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 2 * 1024 * 1024 * 1024)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "img/courseImg/" . $_FILES["file"]["name"]);
            $img = $_FILES["file"]["name"];
            $sql = "insert into course(Cname,Cno,Cteacher,Cpart,Ccollage,Ctime,Cimg,Cders,Cnoc,Cnof)values('" . $Cname . "','" . $Cno . "','" . $Cteacher . "','" . $Spart . "','" . $Scollage . "','" . $Ctime . "','" . $img . "','" . $Cders . "','0','0')";
            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("课程发布成功！")</script>';
                echo "<script> setTimeout(function(){location.href='Cpublishing.php';},0);</script>";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            echo "<script>alert('图片格式不对！或未选择上传图片')</script>";
        }
    }
    else{
        echo "<script>alert('课程信息输入不完整！'); setTimeout(function(){location.href='Cpublishing.php';},0);</script>";
    }
}
$conn->close();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/Admincommon.css"/>
    <link rel="stylesheet" type="text/css" href="css/Adminmain.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<?php include 'header.php'?>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>管理员权限</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="Crevise.php"><i class="icon-font">&#xe008;</i>课程修改</a></li>
                        <li><a href="Cpublishing.php"><i class="icon-font">&#xe005;</i>课程发布</a></li>
                        <li><a href="Cdelete.php"><i class="icon-font">&#xe006;</i>课程删除</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>用户操作</a>
                    <ul class="sub-menu">
                        <li><a href="Cstudent.php"><i class="icon-font">&#xe037;</i>学生管理</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="">课程发布</a></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="Cpublishing.php" method="post" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                            <th width="120"><i class="require-red">*</i>学科分类：</th>
                            <td>
                                <select id="Stype" class="required"  name="Stype">
                                    <option value="未填写">--</option>
                                    <option value="工科">工科</option>
                                    <option value="文科">文科</option>
                                    <option value="理科">理科</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th width="120"><i class="require-red">*</i>所属学院：</th>
                            <td>
                                <select class="Scollage" id="Scollage" name="Scollage">
                                    <option value="未填写">--</option>
                                    <option value="计算机与软件学院">计算机与软件学院</option><option value="数学与统计学院">数学与统计学院</option><option value="经济学院">经济学院</option>
                                    <option value="土木工程学院">土木工程学院</option><option value="信息工程学院">信息工程学院</option><option value="生命与海洋学院">生命与海洋学院</option>
                                    <option value="心理学院">心理学院</option><option value="外国语学">外国语学院</option><option value="文学院">文学院</option>
                                    <option value="医学院">医学院</option><option value="材料学院">材料学院</option><option value="电子科学与技术学院">电子科学与技术学院</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>课程名称：</th>
                            <td>
                                <input class="common-text required" id="Cname" name="Cname" size="50" value="" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>课程编号：</th>
                            <td>
                                <input class="common-text required" id="Cno" name="Cno" size="50" value="" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>主讲老师：</th>
                            <td>
                                <input class="common-text required" id="Cteacher"  name="Cteacher" size="50" value="" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>开课时间：</th>
                            <td>
                                <input class="common-text required" id="Ctime" type="date" name="Ctime" size="50" value="" >
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>封面图片：</th>
                                <td><input type="file" name="file" id="file"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>--></td>
                            </tr>
                            <tr>
                                <th>课程介绍：</th>
                                <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-info btn6 mr10" value="发布" id="pbutton" name="pbutton"  type="submit">
                                    <input class="btn btn6" value="重置" type="reset">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
<?php include 'footer.php'?>
</body>
</html>