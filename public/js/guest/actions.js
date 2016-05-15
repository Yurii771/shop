function cartTotalCountAction(data){
    if(+data){
        $('.cartCount').html(data).show();
    }else{
        $('.cartCount').hide();
    }
}

function addToCartAction(data){
    if(+data['ok']){
        $.get("/cart/count", cartTotalCountAction);
        goodsCountInCartAjax();
    }
}

function editCountInCartAction(data){
    if(+data['ok']){
        var cost_total = 0;
        $('.goods').each(function(){
            var count = +$('.goods_count', this).val();
            var cost = +$('.cost_goods', this).html();
            var cost_goods_total = count * cost;
            cost_total += cost_goods_total;
            $('.cost_goods_total', this).html(cost_goods_total);
        });
        $('.cost_total').html(cost_total);
    }
}

function deleteGoodsFromCartAction(data, goods){
    if(+data['ok']){
        $.get("/cart/count", cartTotalCountAction);
        goods.remove();
        if($('.goods').size() == 0){
            $('table').remove();
            $('.make_order').remove();
            location.reload();
        }
        editCountInCartAction(data);
    }
}
