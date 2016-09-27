/**
 * Created by zws on 2016/9/26.
 */
function showNumberWithAnimation(x,y,num){

    var numberCell = $("#number-cell-"+x+"-"+y);

    numberCell.css({
        'background-color': getNumberBackgroundColor(num),
        'color': getNumberColor(num)
    }).text(num);

    numberCell.animate({
        width: cellSideLength,
        height: cellSideLength,
        top: getTop(x,y),
        left: getLeft(x,y)
    },50);
}

function showMoveAnimation(fromx,fromy,tox,toy){

    var numberCell = $("#number-cell-"+fromx+"-"+fromy);

    numberCell.animate({
        top: getTop(tox,toy),
        left: getLeft(tox,toy)
    },200);
}