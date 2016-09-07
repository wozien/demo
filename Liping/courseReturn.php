<?php
$database="mydb";
$conn = new mysqli("localhost", "root", "", $database);// 创建连接
$collage=$_GET["collage"];
$part=$_GET["part"];
$no=$_GET['no'];
if($collage){
    $sql = "SELECT * FROM course WHERE Ccollage='$collage'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
            echo "<li class='course_list-li'>";
            echo '<a class="course-img" href="query.php?Cno='.$row["Cno"].'"target="_blank">';
            echo '<div class="shade">';
            echo '<img width="230" height="140" alt="" src="img/courseImg/'.$row['Cimg'].'"/></div>';
            echo '<span class="course-time-bg"></span>';
            echo '<span class="course-time">'.$row['Ctime'].'</span>';
            echo '</a>';
            echo '<h3 class="course-title">';
            echo '<a href="" target="_blank">';
            echo '<span class="course-name">'.$row['Cname'].'</span>';
            echo '<span class="course-teacher">'.$row['Cteacher']."(".$row['Ccollage'].")".'</span>';
            echo '</a>';
            echo '<div><img src="img/tkrz.gif" class="tkrz" width="50" height="50"></div>';
            echo '</h3>';
            echo '<div class="course-info">';
            echo '<span class="course-info-student">'.$row['Cnof']."人关注".'</span><span class="course-info-score">评论数：<b class="course-info-num">'.$row['Cnoc'].'</b></span>';
            echo '</div></li>';
        }
    }
    else{
        echo "<p style='text-align: center;font-size: 25px;color: #000000'>暂无你想要的课程</p>";
    }
}
if($part){
    $sql1 = "SELECT * FROM course WHERE Cpart='$part'";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
            echo "<li class='course_list-li'>";
            echo '<a class="course-img" href="query.php?Cno='.$row["Cno"].'"target="_blank">';
            echo '<div class="shade">';
            echo '<img width="230" height="140" alt="" src="img/courseImg/'.$row['Cimg'].'"/></div>';
            echo '<span class="course-time-bg"></span>';
            echo '<span class="course-time">'.$row['Ctime'].'</span>';
            echo '</a>';
            echo '<h3 class="course-title">';
            echo '<a href="" target="_blank">';
            echo '<span class="course-name">'.$row['Cname'].'</span>';
            echo '<span class="course-teacher">'.$row['Cteacher']."(".$row['Ccollage'].")".'</span>';
            echo '</a>';
            echo '<div><img src="img/tkrz.gif" class="tkrz" width="50" height="50"></div>';
            echo '</h3>';
            echo '<div class="course-info">';
            echo '<span class="course-info-student">'.$row['Cnof']."人关注".'</span><span class="course-info-score">评论数：<b class="course-info-num">'.$row['Cnoc'].'</b></span>';
            echo '</div></li>';
        }
    }
    else{
        echo "<p style='text-align: center;font-size: 25px;color: #000000'>暂无你想要的课程</p>";
    }
}
if($no){
    if($no=="最多关注"){
        $sql2 = "SELECT * FROM course ORDER BY Cnof DESC ";
    }
    else{
        $sql2 = "SELECT * FROM course ORDER BY Cnoc DESC ";
    }
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
            echo "<li class='course_list-li'>";
            echo '<a class="course-img" href="query.php?Cno='.$row["Cno"].'"target="_blank">';
            echo '<div class="shade">';
            echo '<img width="230" height="140" alt="" src="img/courseImg/'.$row['Cimg'].'"/></div>';
            echo '<span class="course-time-bg"></span>';
            echo '<span class="course-time">'.$row['Ctime'].'</span>';
            echo '</a>';
            echo '<h3 class="course-title">';
            echo '<a href="" target="_blank">';
            echo '<span class="course-name">'.$row['Cname'].'</span>';
            echo '<span class="course-teacher">'.$row['Cteacher']."(".$row['Ccollage'].")".'</span>';
            echo '</a>';
            echo '<div><img src="img/tkrz.gif" class="tkrz" width="50" height="50"></div>';
            echo '</h3>';
            echo '<div class="course-info">';
            echo '<span class="course-info-student">'.$row['Cnof']."人关注".'</span><span class="course-info-score">评论数：<b class="course-info-num">'.$row['Cnoc'].'</b></span>';
            echo '</div></li>';
        }
    }
    else{
        echo "<p style='text-align: center;font-size: 25px;color: #000000'>暂无你想要的课程</p>";
    }
}
$conn->close();
?>