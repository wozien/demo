<?php

$Cname=$_REQUEST['Cname'];
$Cteacher=$_REQUEST['Cteacher'];
$Cno=$_REQUEST['Cno'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>课程点评</title>
    <link rel="shortcut icon" href="img/title-icon.ico">
    <link rel="stylesheet" href="css/css2.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-2.2.1.min.js"></script>
    <script>
        $(function () {
            var level;
            var sco1,sco2,sco3;
            var Cno=$("#Cno").text();

            $("td i").click(function () {
                var id=$(this).index()+1;
                $(this).addClass('icon-act').prevAll('i').addClass('icon-act');
                $(this).nextAll('i').removeClass("icon-act");
                $(this).siblings('span').eq(id-1).show().siblings('span').hide();

                var classname=$(this).parent().attr("class");
                if(classname==="sco1"){
                    sco1=id*2;
                }
                else if(classname==="sco2"){
                    sco2=id*2;
                }
                else{
                    sco3=id*2;
                }

            });

            $(".level").click(function () {
                level=$(this).index()+1;
                $(this).addClass('level-hover').siblings('span').removeClass('level-hover');
            })

            $("#sure").click(function () {

                $.post("server/comment.php",
                    {
                        level:level,
                        sco1:sco1,
                        sco2:sco2,
                        sco3:sco3,
                        content:$("#wcontent").val(),
                        Cno:Cno,

                    }, function (data) {
                        alert("点评成功！");
                        location.href="query.php?Cno="+Cno;
                    });

            })


        })
    </script>
</head>
<body>

    <?php
    $navid=1;
    include 'header.php' ?>

    <div style="display: none;" id="Cno"><?php echo $Cno?></div>

    <div class="qmain" style="padding-bottom: 80px">
        <div class="cou-write">
            <h2 style="margin-bottom: 10px">写点评</h2>
            <h4><?php echo $Cname?>——<?php echo $Cteacher?></h4>

            <hr color="#e9e9e9">

            <div class="write-form">
                <table border="0"  class="write-table">
                    <tr>
                        <td>知识量</td>
                        <td class="sco1">
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <span style="display: none"> ( 2分 很少，几乎没有收获 ) </span>
                            <span style="display: none"> ( 4分 偏少，收获较小 ) </span>
                            <span style="display: none"> ( 6分 一般，收获达到基本期望 ) </span>
                            <span style="display: none"> ( 8分 较多，内容丰富，很有收获 ) </span>
                            <span style="display: none"> ( 10分 很多，收获特别大，超出预期 ) </span>
                        </td>

                    </tr>

                    <tr>
                        <td>实用性</td>
                        <td class="sco2">
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <span style="display: none"> ( 2分 完全用不到，学了也白学 ) </span>
                            <span style="display: none"> ( 4分 只有小部分内容具有应用价值 ) </span>
                            <span style="display: none"> ( 6分 比较实用，能够帮助我解决实际问题 ) </span>
                            <span style="display: none"> ( 8分 大部分内容能运用到实际工作中 ) </span>
                            <span style="display: none"> ( 10分 超实用!所有内容都与实际问题紧密结合 ) </span>
                        </td>
                    </tr>

                    <tr>
                        <td>授课水平</td>
                        <td class="sco3">
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <i class="fa fa-star icon"></i>
                            <span style="display: none"> ( 2分 不知所云，听不下去 ) </span>
                            <span style="display: none"> ( 4分 勉强能听，有些地方讲得不明白 ) </span>
                            <span style="display: none"> ( 6分 水平中等，可以接受 ) </span>
                            <span style="display: none"> ( 8分 讲解清晰，有些地方讲的很出彩 ) </span>
                            <span style="display: none"> ( 10分 出神入化，让人听了还想听 ) </span>
                        </td>
                    </tr>

                    <tr>
                        <td>难度</td>
                        <td>
                            <span class="level">简单</span><span class="level">中等</span><span class="level">困难</span>
                        </td>
                    </tr>

                    <tr>
                        <td>内容</td>
                        <td>
                            <textarea id="wcontent"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-sure" id="sure">发布</button>
                            <a href="javascript:history.go(-1);"><button class="btn btn-back">取消</button></a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

<?php include "footer.php"?>
</body>
</html>


