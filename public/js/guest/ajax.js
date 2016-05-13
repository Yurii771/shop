$(document).ready(function(){
    $.get("/cart/count", cartCountAction);
});

function addToCartAjax(){
    var url = $(this).attr('href');
    var count = $(this).siblings('[name="goods_count"]').val();
    $.ajax({
        url: url,
        method: 'POST',
        data: {count: count},
        success: addToCartAction
    });
    return false;
}