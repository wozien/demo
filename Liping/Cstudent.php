<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员中心</title>
    <link rel="stylesheet" type="text/css" href="css/Admincommon.css"/>
    <link rel="stylesheet" type="text/css" href="css/Adminmain.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
    <script type="text/javascript" src="js/jquery-2.2.1.min.js"></script>
</head>
<script>
    $(function(){
        $(".Sone").click(function(){
            var $Sone = $(this).parent().find("#Sno").html();
            $.get("Del.php", {Sno:$Sone},function(data,textStatus){
                if(data=="ok"){
                    setTimeout(function(){location.href="Cstudent.php";},0);
                }
                else{
                    alert("删除失败");
                }
            })
        })
    })
</script>
<style>
    .Sone a{
        cursor: pointer;
        color: red;
        text-decoration: underline;
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
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php" color="#white">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">学生管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
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
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>学号</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>学院</th>
                            <th>专业</th>
                            <th>密码</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        $database="mydb";
                        // 创建连接
                        $conn = new mysqli("localhost", "root", "", $database);
                        $name=$_SESSION['username'];
                        if($name){
                            $sql = "SELECT * FROM client";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<tr>';
                                    echo '<td id="Sno">'.$row["Sno"].'</td> <!--课程编号-->';
                                    echo '<td >'.$row["user"].'</td>';
                                    echo '<td>' . $row['email'] . '</td> ';
                                    echo '<td> '.$row['Scollage'] .'</td> ';
                                    echo '<td>'. $row['Smajor'] .'</td> <!--开课时间-->';
                                    echo '<td> '. $row['password'] .'</td>';
                                    echo '<td class="Sone"><a>删除</a></td></tr>';
                                }
                            }
                        }
                        ?>
                    </table>
                    <div class="list-page"> 2 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<?php include 'footer.php'?>
</body>
</html>