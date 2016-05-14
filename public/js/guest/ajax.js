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

function editCountToCartAjax(){
    var url = 'cart/edit/'+$(this).attr('data-id');
    var count = $(this).val();
    $.ajax({
        url: url,
        method: 'POST',
        data: {count: count},
        success: editCountInCartAction
    });
    return false;
}