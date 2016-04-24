/**
 * Created by zws on 2016/4/18.
 */

$(function () {
    var p;
    $div=$("#container>div");
    $("#container").mousewheel(function (event,delta) {
        for(var i=0;i<4;i++){
            if($div.eq(i).is(':visible')){
                p=i;
            }
        }
        if(delta===1){
            if(p===0) { p=3; }
            else{ --p;}
        }
        else{
            if(p===3){p=0;}
            else{++p;}
        }
        $div.eq(p).fadeIn(400).siblings('div').fadeOut(400);
        $("#container>ul>li").eq(p).addClass('hov').siblings().removeClass('hov');
        $("#header ul>li").eq(3-p).addClass('over').siblings().removeClass('over');
        console.log(p);
    });

    $("#header ul>li").click(function(){
        var id=$(this).index();
        $(this).addClass('over').siblings().removeClass('over');
        $div.eq(3-id).fadeIn(400).siblings('div').fadeOut(400);
        $("#container>ul>li").eq(3-id).addClass('hov').siblings().removeClass('hov');
    })

    $("#container>ul>li").click(function(){
        var id=$(this).index();
        $(this).addClass('hov').siblings().removeClass('hov');
        $div.eq(id).fadeIn(400).siblings('div').fadeOut(400);
        $("#header ul>li").eq(3-id).addClass('over').siblings().removeClass('over');
    })

    //con1
    $("html,body").animate({width:'100%',height:'100%'},1000, function () {
        $(".con1 .suibi").show();
        $p=$(".con1 p");
        var t=1400;
        for(var i= 0,len=$p.length;i<len;i++){
            $p.eq(i).delay(t).slideDown(400);
            t+=400;
        }
        $("#container  .ul1").delay(t).show(600);
    });

    $(".con3 i").click(function () {
        var id=$(this).index()-3;
        console.log(id);
        $(this).toggleClass('icon-act');
        $(".sk-con>ul").eq(id).fadeToggle(600);
    })

    $(".banner .side2").click(function () {
        $(".banner ul").animate({marginLeft:"-600px"},600, function () {
            $(".banner ul>li").eq(0).appendTo($(".banner ul"));
            $(".banner ul").css("marginLeft","0px");
        })
    })
    $(".banner .side1").click(function () {
        $(".banner ul").css("marginLeft","-600px");
        $(".banner ul>li").eq(1).prependTo($(".banner ul"));
        $(".banner ul").animate({marginLeft:"0px"},600);
    })

    $(".con4 .banner").hover(function () {
        $(".side").show(600);
    }, function () {
       $(".side").hide(600);
    })
})
