<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>荔评网-所有课程</title>
    <link rel="shortcut icon" href="img/title-icon.ico">
    <link rel="stylesheet" href="css/css1.css">
    <link rel="stylesheet" href="css/courseCss.css">
    <script src="js/jquery-2.2.1.min.js"></script>
    <script>
        $(function(){
            var $Ccollage=$(".Ccollage li a");
            var $part=$(".Cpart li a");
            var $nof=$(".search-sub-tabs li a");
            $Ccollage.bind("click",function(){
                 var $a=$(this).text();
                 if($a=="全部"){
                     setTimeout(function(){location.href="course.php";},0);
                 }
                 else{
                     $.get("courseReturn.php", {collage: $a,part:0,no:0},function(data,textStatus){
                         $("#courseList").html(data);
                     })
                 }
            })
            $part.bind("click",function(){
                var $b=$(this).text();
                if($b=="全部"){
                    setTimeout(function(){location.href="course.php";},0);
                }
                else{
                    $.get("courseReturn.php", {part: $b,collage:0,no:0},function(data,textStatus){
                        $("#courseList").html(data);
                    })
                }
            })
            $nof.bind("click",function(){
                var $c=$(this).text();
                if($c=="近期热门"){
                    setTimeout(function(){location.href="course.php";},0);
                }
                else{
                    $.get("courseReturn.php", {no:$c,part: 0,collage:0},function(data,textStatus){
                        $("#courseList").html(data);
                    })
                }
            })
        });
    </script>
</head>
<body style="background-color: #f3f3f3">
<?php
$navid=1;
include 'header.php'
?>
<div id="search-wrap" class="search-wrap">
    <div id="search-field" class="search-field">
        <h5>学院：</h5>
        <ul class="search-list Ccollage">
            <li class="active"><a href="javascript:void(0)" data-type="lang">全部</a>
            </li><li><a href="javascript:void(0)" data-type="lang">计算机与软件学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang"">数学与统计学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">经济学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">土木工程学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">信息工程学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">生命与海洋学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">心理学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">外国语学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">文学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">医学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">材料学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">传播学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">电子科学与技术学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">法学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">管理学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">光电工程学院</a>
            </li><li><a href="javascript:void(0)" data-type="lang">建筑与城市规划学院</a>
            </li>
        </ul>
    </div>
    <div id="search-field" class="search-field">
        <h5>类别：</h5>
        <ul class="search-list Cpart">
            <li class="active"><a href="javascript:void(0)" data-type="lang">全部</a>
            </li><li><a href="javascript:void(0)" data-type="lang">工科</a>
            </li><li><a href="javascript:void(0)" data-type="lang"">理科</a>
            </li><li><a href="javascript:void(0)" data-type="lang">文科</a></li>
        </ul>
    </div>
</div>
<div class="search-sub-tabs-area">
    <ul class="search-sub-tabs" id="search-sub-tabs">
        <li class="active"><a href="javascript: void 0;">近期热门</a></li>
        <li><a class="tabs" href="javascript:void(0)">评论最多</a></li>
        <li><a class="tabs" href="javascript:void(0)">最多关注</a></li>
        <li class="results-count"><span>共<?php
                $database="mydb";
                // 创建连接
                $conn = new mysqli("localhost", "root", "", $database);
                $sql = "SELECT * FROM course";
                $result = $conn->query($sql);
                echo $result->num_rows;
                ?>门课</span></li>
    </ul>
</div>
<div class="course-tabs-area">
    <ul class="course_list" id="courseList">
        <?php
        $database="mydb";
        // 创建连接
        $conn = new mysqli("localhost", "root", "", $database);
        $Ckey=NULL;                                            //初始化Ckey为空
        if(empty($_GET["Ckey"]))                              //传值判断并进行赋值
        {
            $Ckey=NULL;
        }
        else{
            $Ckey=$_GET["Ckey"];
        }
        if(empty($Ckey)) {                                     //若搜索框有内容，则检索搜索框的值;若无，既Ckey为空，正常显示
            $sql = "SELECT * FROM course ORDER BY Cnoc DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<li class='course_list-li'>";
                    echo '<a class="course-img" href="query.php?Cno='.$row["Cno"].'"target="_blank">';
                    echo '<div class="shade">';
                    echo '<img width="230" height="140" alt="" src="img/courseImg/' . $row['Cimg'] . '"/></div>';
                    echo '<span class="course-time-bg"></span>';
                    echo '<span class="course-time">' . $row['Ctime'] . '</span>';
                    echo '</a>';
                    echo '<h3 class="course-title">';
                    echo '<a href="" target="_blank">';
                    echo '<span class="course-name">' . $row['Cname'] . '</span>';
                    echo '<span class="course-teacher">' . $row['Cteacher'] . "(" . $row['Ccollage'] . ")" . '</span>';
                    echo '</a>';
                    echo '<div><img src="img/tkrz.gif" class="tkrz" width="50" height="50"></div>';
                    echo '</h3>';
                    echo '<div class="course-info">';
                    echo '<span class="course-info-student">' . $row['Cnof'] . "人关注" . '</span><span class="course-info-score">评论数：<b class="course-info-num">' . $row['Cnoc'] . '</b></span>';
                    echo '</div></li>';
                }
            }
        }
        else{
            $Ckey_mm="%".$Ckey."%";
            $sql1 = "SELECT * FROM course WHERE Cname LIKE  '$Ckey_mm' OR Cteacher LIKE '$Ckey_mm'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<li class='course_list-li'>";
                    echo '<a class="course-img" href="query.php?Cno='.$row["Cno"].'"target="_blank">';
                    echo '<div class="shade">';
                    echo '<img width="230" height="140" alt="" src="img/courseImg/' . $row['Cimg'] . '"/></div>';
                    echo '<span class="course-time-bg"></span>';
                    echo '<span class="course-time">' . $row['Ctime'] . '</span>';
                    echo '</a>';
                    echo '<h3 class="course-title">';
                    echo '<a href="" target="_blank">';
                    echo '<span class="course-name">' . $row['Cname'] . '</span>';
                    echo '<span class="course-teacher">' . $row['Cteacher'] . "(" . $row['Ccollage'] . ")" . '</span>';
                    echo '</a>';
                    echo '<div><img src="img/tkrz.gif" class="tkrz" width="50" height="50"></div>';
                    echo '</h3>';
                    echo '<div class="course-info">';
                    echo '<span class="course-info-student">' . $row['Cnof'] . "人关注" . '</span><span class="course-info-score">评论数：<b class="course-info-num">' . $row['Cnoc'] . '</b></span>';
                    echo '</div></li>';
                }
            }
        }
        $conn->close();
        ?>
    </ul>
</div>
  <?php include 'footer.php'?>
</body>
</html>