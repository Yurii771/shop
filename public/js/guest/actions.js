function cartCountAction(data){
    if(+data){
        $('.cartCount').html(data).show();
    }else{
        $('.cartCount').hide();
    }
}

function addToCartAction(data){
    if(+data['ok']){
        $.get("/cart/count", cartCountAction);
    }
}

function editCountInCartAction(data){
    if(+data['ok']){
        alert('count changed');
    }
}