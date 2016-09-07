<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>深大荔评网</title>
    <link rel="shortcut icon" href="img/title-icon.ico">
    <link rel="stylesheet" href="css/css1.css">
    <script src="js/jquery-2.2.1.min.js"></script>
    <script src="js/animate1.js"></script>

</head>

<body>

    <?php include 'header.php'?>

    <div id="banner">
        <div class="img4"></div>
        <div class="img2"></div>
        <div class="img3"></div>
        <ul class="banner-list">
            <li class="act"></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <div id="container">

        <ul>
            <div class="con-title">
                热门课程
                <a href="course.php">全部课程</a>
            </div>
        </ul>

    </div>

    <?php include 'footer.php'?>

    <script>
        $(function () {

            var courses=[];   //获取热门课程
            $.get("server/gethot.php",{}, function (data) {
                showhot(data);
            },"json");

            //输出热门课程
            function showhot(data){
                courses=data;
                var len=courses.length<8?courses.length:8;
                console.log(courses[0]['Cno']);


                for(var i=0;i<len;i++){
                    $("#container ul").append("<li><a class='con-img'><img src='' alt='' width='220px' height='140px'><div class='con-bg'><span></span></div></a>" +
                        "<p></p><p></p></li>");
                    $li=$("#container ul>li").eq(i);


                    $li.find('img').attr('src',"img/courseImg/"+courses[i]['Cimg']).end().find('span').text(courses[i]['Ctime']+"开课");

                    
                    <?php
                    if($flg==0){
                    ?>
                    $li.find('a').click(function(){
                        alert('请先登录');
                    })
                    <?php }else{ ?>
                    $li.find('a').attr("href","query.php?Cno="+courses[i]['Cno']);
                    <?php } ?>

                    $li.find("p").eq(0).text(courses[i]['Cname']).end().eq(1).html("关注 : "+courses[i]['Cnof']+" <span>&nbsp;|&nbsp;</span> 评论 : "+courses[i]['Cnoc']);
                }
            }



        })
    </script>
</body>
</html>