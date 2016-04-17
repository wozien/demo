/**
 * Created by zws on 2016/4/10.
 */
$(function () {
    $("#navTab li").click(function () {
        var id=$(this).index();
        $(this).addClass('hove').siblings().removeClass('hove');
        if(id==0)
        {
            $('#conlist').slideDown(300).siblings('div').slideUp(100);
        }
        else{
            $('#hoslist').slideDown(300).siblings('div').slideUp(100);
        }
    })

    $(".head").animate({left:"80px"},400);

    //删除便签
    $("#box_lg .del").click(function(){
        var s=$('#box_lg .header').text();
        var t=$("#box_lg .time").text();
        var u=$("#lg").text();
        queryDetail('2',t,s,u);
    })

    //登录弹出框
    $("#lg").click(function () {
        $("#box_bg").fadeIn(100);
        $("#login").slideDown(100);
        $(".ipt-gp .tip").removeClass('tipempty');
    })

    $("#login .cls").click(function(){
        $("#box_bg").fadeOut(100);
        $("#login").slideUp(100);
    })
    $("#register .cls").click(function(){
        $("#box_bg").fadeOut(100);
        $("#register").slideUp(100);
    })

    $ipt= $(".ipt-gp .ipt");
    for(var i= 0,len=$ipt.length;i<len;i++){
        $ipt.eq(i).keyup(function () {
            $(this).next("i").css("display","block");
        })
    }
    $(".ipt-gp .icon-cls").click(function () {
        $(this).siblings('input').val("").focus();
        $(this).hide(100);
    })

    //验证邮箱
    $("#fm2-info .ipt:eq(1)").blur(function () {
        var email=$(this).val();
        if(email.length>0) {
            var reg = /^(\w)+@(\w)+((\.\w+)+)$/;
            if (reg.test(email) === false) {
                $("#fm2-info .tip:eq(1)").css("display", "block");
            }
            else{
                $("#fm2-info .tip:eq(1)").css("display", "none");
            }
        }
    })


    //注册弹出框
    $("#rg").click(function () {
        var s=$(this).text();
        if(s==="注册"){
            $("#box_bg").fadeIn(100);
            $("#register").slideDown(100);
        }
        else{
            location.reload();
        }
    })
    //home logo animate
    $("#Navbar i").animate({fontSize:"50px"},1000);

    //显示/隐藏列表
    $("#conlist .conlist-time").click(function () {
        $("#conlist ul").slideToggle(200);
        $("#conlist span:eq(1)>i").toggleClass('icon1');
    })
    $("#hoslist>span").click(function () {
        $("#hoslist>ul").slideToggle(200);
        $("#hoslist>span:eq(1)>i").toggleClass('icon3');
    })
})