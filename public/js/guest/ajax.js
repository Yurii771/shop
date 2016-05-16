$(document).ready(function(){
    $.get("/cart/count", cartTotalCountAction);
});

function addToCartAjax(){
    var count = $(this).siblings('[name="goods_count"]').val();
    $.ajax({
        url: $(this).attr('href'),
        method: 'POST',
        data: {count: count},
        success: addToCartAction
    });
    return false;
}

function editCountToCartAjax(){
    var url = '/cart/edit/'+$(this).attr('data-id');
    var count = $(this).val();
    $.ajax({
        url: url,
        method: 'POST',
        data: {count: count},
        success: editCountInCartAction 
    });
    return false;
}

function goodsCountInCartAjax(){
    $.ajax({
        url: '/cart/get',
        data: {},
        success: goodsCountInCartAction // метод находится в шаблоне "представления"
    });
}

function deleteGoodsFromCartAjax(){
    var curent = this;
    $.ajax({
        url: $(this).attr('href'),
        data: {},
        success: function(data){
            var goods = $(curent).parents('.goods');
            deleteGoodsFromCartAction(data, goods);
        }
    });
    return false;
}