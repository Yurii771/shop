function cartCountAction(data){
    if(+data){
        $('.cartCount').html(data).show();
    }else{
        $('.cartCount').hide();
    }
}