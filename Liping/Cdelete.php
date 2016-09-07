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
            $.get("CourseDel.php", {Cno:$Sone},function(data,textStatus){
                if(data=="ok"){
                    alert("删除课程成功！");
                    setTimeout(function(){location.href="Cdelete.php";},0);
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php" color="#white">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">课程删除</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="">全部</option>
                                    <option value="19">工科</option>
                                    <option value="20">理科</option>
                                    <option value="21">文科</option>
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
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"></th>
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
                                    echo '<tr><td class="tc"><input name="id[]" value="" type="checkbox"></td>';
                                    echo '<td id="Sno">'.$row["Cno"].'</td> <!--课程编号-->';
                                    echo '<td><a target="_blank" href="query.php?Cno='.$row["Cno"].'"target="_blank">' . $row['Cname'] . '</a> <!--课程名称-->';
                                    echo '</td>';
                                    echo '<td>' . $row['Cteacher'] . '</td> <!--课程老师-->';
                                    echo ' <td>' . $row['Cpart'] . '</td> <!--课程类型-->';
                                    echo ' <td>'. $row['Ctime'] .'</td> <!--开课时间-->';
                                    echo ' <td> '. $row['Ccollage'] .'</td>';
                                    echo ' <td class="Sone"><a>删除</a></td></tr>';
                                }
                            }
                        }
                        ?>
                    </table>
                    <div class="list-page"> <?php
                        $database="mydb";
                        // 创建连接
                        $conn = new mysqli("localhost", "root", "", $database);
                        $sql = "SELECT * FROM course";
                        $result = $conn->query($sql);
                        echo $result->num_rows;
                        ?> 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
<?php include 'footer.php'?>
</body>
</html>