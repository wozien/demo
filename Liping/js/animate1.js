/**
 * Created by zws on 2016/5/16.
 */
$(function () {

    var id=0,t;
    $(".banner-list li").hover(function () {
        id=$(this).index();
        $("#banner>div").eq(id).fadeIn(400).siblings('div').fadeOut(400);
        $(this).addClass('act').siblings('li').removeClass('act');
    });
    $("#banner").mouseover(function () {
        stopplay();
    }).mouseout(function(){
        autoplay();
    });

    autoplay();
    function autoplay(){
        t=setInterval(function () {
            ++id;
            if(id==3){
                id=0;
            }
            $("#banner>div").eq(id).fadeIn(400).siblings('div').fadeOut(400);
            $(".banner-list li").eq(id).addClass('act').siblings('li').removeClass('act');
        },3000);
    }

    function stopplay(){
        clearTimeout(t);
    }




})

