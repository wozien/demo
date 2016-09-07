<?php
session_start();
$database="mydb";
// 创建连接
$conn = new mysqli("localhost", "root", "", $database);
// 检测连接
if ($conn->connect_error) {
    echo "error";
}
$navid=isset($navid)?$navid:0;
$flg=0;
$flg=isset($_SESSION['username'])?1:0;
$name="nouser";

if($flg==1)
{
    $name=$_SESSION['username'];
}

function getJs2($val){
    return "'".$val."'";
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/css1.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-2.2.1.min.js"></script>

</head>
<body>

    <div id="header-wrap">
        <div id="header">
            <img src="img/logo.jpg" alt="#">

            <div class="lg-header">
            </div>

            <div class="ipt-header">
                <form>
                    <input type="text" required placeholder="搜索课程" id="searchCourse">
                    <i class="fa fa-search icon-search" onclick="searchCourse()"></i>
                </form>
            </div>

            <ul class="user-list">
                <li class="user-info">
                    <?php
                    if($_SESSION['username']=="admin"){
                        echo '<a href="Crevise.php">管理中心</a></li><li><a href="admin.php">个人主页</a></li>';
                    }
                    else{
                        echo '<a href="admin.php">个人主页</a></li>';
                    }
                    ?>
                <li class="exit"><a href="#" onclick="return false">退出</a></li>
            </ul>

        </div>
    </div>

    <div id="navbar">
        <ul>
            <li class="nav-vis"><a href="index.php">首页</a></li>
            <li><a href="course.php">课程</a></li>
            <li><a href="community.php">资源</a></li>
        </ul>
    </div>

    
    <!-- login -->
        <div id="box_bg"></div>

        <div id="box_lg">
            <img src="img/loginlogo.png" alt="Liping">
            <img src="img/close.png" alt="close" id="login-close">
            <h2 class="lg-title">与深大人分享你的知识、经验和见解</h2>
        
            <div class="main-panel">
                <ul>
                    <li class="tab-act">注册</li>
                    <li>登录</li>
                    <div class="tab-side"></div>
                </ul>
                <div class="sign-up">
                    <form action="" id="sign-up-form" method="post">
                        <div class="sign-ipt">
                            <input id="signUpName" type="text" name="username" placeholder="用户名">
                            <hr color="#e4e5e5">
                            <input id="signUpSno" type="text" name="Sno" placeholder="学号">
                            <hr color="#e4e5e5">
                            <input id="signUpPassword" type="password" name="password" placeholder="密码(不少于6位)">
                            <hr color="#e4e5e5">
                            <input type="text" name="verify" id="verify" placeholder="验证码" style="width: 210px">
                            <div class="sign-vfy">
                                <img src="../verify/get_num.php" alt="">
                            </div>
                        </div>

                        <button type="button" class="sign-btn" id="btn-sign-up">注册荔评</button>
                    </form>
                </div>

                <div class="sign-in">
                    <form action="" id="sign-in-form">
                        <div class="sign-ipt">
                            <input id="loginInName" type="text" name="username" placeholder="用户名">
                            <hr color="#e4e5e5">
                            <input id="loginInPassword" type="password" name="password" placeholder="密码">
                        </div>

                        <button type="button" class="sign-btn" id="btn-sign-in">登录</button>

                        <div class="label">
                            <input type="checkbox" style="vertical-align: middle" id="rbme">
                            <label for="rbme">&nbsp;&nbsp;记住我</label>
                            <span>社交帐号登录</span>
                            <div class="sign-icon">
                                <i class="fa fa-weixin"></i>
                                <i class="fa fa-qq"></i>
                                <i class="fa fa-weibo"></i>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    <!-- end login -->

    <script>
        $(function () {

            var flg=<?php echo $flg; ?>;
            console.log(flg);
            if(flg===1){
                var user=<?php echo getJs2($name) ?>;
                $(".lg-header").empty().append("<img width='50' src='img/<?php
                if(empty($_SESSION['username']))                              //传值判断并进行赋值
                {
                 echo "accountImg/defaultuser.png";
                }
                else{
                  $sql = "SELECT * FROM client WHERE user="."'".$_SESSION['username']."'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    if($row['Simg']){
                        echo "accountImg/".$row['Simg'];
                    }
                    else{
                        echo "accountImg/defaultuser.png";
                    }
                }
            }
            else{
                 echo "accountImg/defaultuser.png";
            }
                }
            ?>'>")
                    .append("<span class='user'>"+user+"</span>&nbsp;&nbsp;<i class='fa fa-angle-double-down'></i>");
            }
            else{

                $(".lg-header").empty().append("<a href='#' id='signUp'>注册</a>").append('<a href="#" id="signIn">登录</a>');
            }

            var nid=<?php echo $navid ?>;
            $('#navbar ul>li').eq(nid).addClass('nav-vis').siblings('li').removeClass('nav-vis');

            //获取user-list
            $(".lg-header i").click(function () {
                $(".user-list").fadeToggle(400);
            })

            //退出事件
            $(".exit").click(function () {
                $.get("server/exit.php");
                location.pathname="Dhk";
            })

        })

        function searchCourse(){
            var Ckey=document.getElementById("searchCourse").value;
            window.location.href="course.php? Ckey="+Ckey;
        }

    </script>
    <script src='js/header.js'></script>
</body>
</html>