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
    $Cpart = $_POST["Ctype"];
    $Ccollage = $_POST["Ccollage"];
    $Ctime = $_POST["Ctime"];
    $Cders=$_POST["content"];
    if($Cno){
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 2 * 1024 * 1024 * 1024)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "img/courseImg/" . $_FILES["file"]["name"]);
            $img = $_FILES["file"]["name"];
            $sql= "UPDATE `course` SET `Cimg`='".$img."'  WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        if( $Cteacher){
            $sql= "UPDATE `course` SET `Cteacher`='".$Cteacher."'  WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        if($Cname){
            $sql= "UPDATE `course` SET `Cname`='".$Cname."' WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        if($Cpart){
            $sql= "UPDATE `course` SET `Cpart`='".$Cpart."' WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        if( $Ccollage){
            $sql= "UPDATE `course` SET `Ccollage`='".$Ccollage."' WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        if( $Ctime ){
            $sql= "UPDATE `course` SET `Ctime`='".$Ctime ."' WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        if( $Cders){
            $sql= "UPDATE `course` SET `Cders`='".$Cders."' WHERE `Cno`='".$Cno."'";
            $conn->query($sql);
        }
        echo "<script>alert('课程修改成功！');</script>";
        echo "<script> setTimeout(function(){location.href='Crevise.php';},0);</script>";
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
    <script type="text/javascript" src="js/jquery-2.2.1.min.js"></script>
</head>
<script>
    $(function(){
        $(".Sone").click(function(){
            $(" .formWrap").slideDown(500);
        })
        $("#trtitle").click(function(){
            $(" .formWrap").slideUp(500);
        })
    })
</script>
<style>
    .Sone a{
        cursor: pointer;
        color: red;
        text-decoration: underline;
    }
    .formWrap{
        width: 600px;
        position: fixed;
        left: 50%;
        top: 10%;
        margin-left: -300px;
        background-color: #f5f5f5;
        border: 2px solid #e5e5e5;
    }
    .trtitle{
        display: block;
        text-align: center;
        width: 100%;
    }
    .trtitle span{
        float: right;
        color: red;
        font-size: 14px;
        cursor: pointer;
    }
</style>
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
    <div class="formWrap" hidden="hidden" >
        <div class="result-content">
            <form action="Crevise.php" method="post" enctype="multipart/form-data">
                <div class="trtitle" id="trtitle">请填写修改信息(不修改位置可以不填)<span><i>[关闭]</i></span></div>
                <table class="insert-tab" width="100%">
                    <tbody>
                    <tr>
                        <th><i class="require-red">*</i>修改的编号：</th>
                        <td>
                            <input class="common-text required" id="Cno" name="Cno" size="25" value="请输入修改课程编号" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require-red"></i>修改分类：</th>
                        <td>
                            <select id="Stype" class="required"  name="Ctype">
                                <option value="未填写">--</option>
                                <option value="工科">工科</option>
                                <option value="文科">文科</option>
                                <option value="理科">理科</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require-red"></i>修改学院：</th>
                        <td>
                            <select class="Scollage" id="Scollage" name="Ccollage">
                                <option value="未填写">--</option>
                                <option value="计算机与软件学院">计算机与软件学院</option><option value="数学与统计学院">数学与统计学院</option><option value="经济学院">经济学院</option>
                                <option value="土木工程学院">土木工程学院</option><option value="信息工程学院">信息工程学院</option><option value="生命与海洋学院">生命与海洋学院</option>
                                <option value="心理学院">心理学院</option><option value="外国语学">外国语学院</option><option value="文学院">文学院</option>
                                <option value="医学院">医学院</option><option value="材料学院">材料学院</option><option value="电子科学与技术学院">电子科学与技术学院</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require-red">*</i>修改名称：</th>
                        <td>
                            <input class="common-text required" id="Cname" name="Cname" size="50" value="" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require-red">*</i>修改老师：</th>
                        <td>
                            <input class="common-text required" id="Cteacher"  name="Cteacher" size="50" value="" type="text">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require-red"></i>修改时间：</th>
                        <td>
                            <input class="common-text required" id="Ctime" type="date" name="Ctime" size="50" value="" >
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require-red"></i>修改图片：</th>
                        <td><input type="file" name="file" id="file"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>--></td>
                    </tr>
                    <tr>
                        <th>课程介绍：</th>
                        <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="8"></textarea></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input class="btn btn-info btn6 mr10" value="修改" id="pbutton" name="pbutton"  type="submit">
                            <input class="btn btn6" value="重置" type="reset">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">课程修改</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="class00">全部</option>
                                    <option value="class01">文科</option>
                                    <option value="class02">理科</option>
                                    <option value="class03">工科</option>
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text"></td>
                            <td><input class="btn btn-info btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="Cpublishing.php"><i class="icon-font"></i>新增课程</a>
                        <a id="updateOrd" href="Crevise.php"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>课程编号</th>
                            <th>课程名称</th>
                            <th>教师</th>
                            <th>课程类型</th>
                            <th>开课时间</th>
                            <th>所属学院</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        $database="mydb";
                        // 创建连接
                        $conn = new mysqli("localhost", "root", "", $database);
                        $name=$_SESSION['username'];
                        if($name){
                            $sql = "SELECT * FROM course ORDER BY Cnoc DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<tr><td id="Sno">'.$row["Cno"].'</td> <!--课程编号-->';
                                    echo '<td><a target="_blank" href="query.php?Cno='.$row["Cno"].'"target="_blank">' . $row['Cname'] . '</a> <!--课程名称-->';
                                    echo '</td>';
                                    echo '<td>' . $row['Cteacher'] . '</td> <!--课程老师-->';
                                    echo ' <td>' . $row['Cpart'] . '</td> <!--课程类型-->';
                                    echo ' <td>'. $row['Ctime'] .'</td> <!--开课时间-->';
                                    echo ' <td> '. $row['Ccollage'] .'</td>';
                                    echo ' <td class="Sone"><a> '. "修改" .'</a></td>';
                                }
                            }
                        }
                        ?>
                    </table>
                    <div class="list-page">
                        <?php
                        $database="mydb";
                        // 创建连接
                        $conn = new mysqli("localhost", "root", "", $database);
                        $sql = "SELECT * FROM course";
                        $result = $conn->query($sql);
                        echo $result->num_rows;
                        ?> 条 1/1 页</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<?php include 'footer.php'?>
</body>
</html>