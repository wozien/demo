<?php

$Cno=$_REQUEST['Cno'];

function getJs1($val){
    return "'".$val."'";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="shortcut icon" href="img/title-icon.ico">
    <link rel="stylesheet" href="css/css2.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-2.2.1.min.js"></script>
    <script src="js/query.js"></script>
    <script>
        var s=<?php echo getJS1($Cno)?>;
    </script>

</head>
<body>

    <?php
    $navid=1;
    include 'header.php' ?>

    <div class="qmain">

        <!--   课程详情     -->
        <div class="cou">
            <div class="cou-tit">
                <a onclick="return false"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="guanzhu">加关注</span></a>
                <a href="#" class="write"><span class="dianpin"><i class="fa fa-pencil-square"></i>&nbsp;&nbsp;去点评</span></a>
            </div>
            <hr color="#e9e9e9">

            <div class="cou-list">
                <div class="cou-img" style="float: left">
                    <img  alt="" width="460px" height="260px">
                </div>

                <div class="cou-del" style="float: left">
                    <table border="0" >
                        <tr>
                            <td colspan="3" >评分 : <span style="font-size: 20px;color:crimson" class="fenshu"></span></td>
                        </tr>

                        <tr>
                            <td>课程编号 ： <span class="cno"></span></td>
                            <td>分类 ： <span class="part"></span></td>
                            <td style="width: 200px">开课时间 ：<span class="time"></span></td>
                        </tr>
                        <tr>
                            <td colspan="2">所属学院 ：<span class="collage"></span></td>
                            <td>主讲教师 ：<span class="teacher"></span></td>
                        </tr>
                        <tr>
                            <td>课程描述 :</td>
                        </tr>
                    </table>

                    <p class="des">
                    </p>
                </div>

            </div>
        </div>

        <!--    课程对应评价    -->
        <div class="comment">
            <div class="com-tit">课程点评</div>

            <!--<div class="com-item">
                <div class="com-left">
                    <img src="img/accountImg/defaultuser.png" alt="" width="100px" height="100px" class="com-img">
                    <p class="com-user">admin</p>
                    <img src="img/start/start4-h.jpg" class="com-icon">
                </div>
                <div class="com-right">
                    <p class="com-level level-1">困难</p>
                    <p class="com-content">虽然这门课很难，但是收获很多啊！</p>
                    <span class="com-time">1楼 2016-5-30 17:30</span>
                </div>
            </div>-->

        </div>

    </div>
</body>
</html>
