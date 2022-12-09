$(document).ready(() => {
    var prices = document.getElementsByClassName('price-item');
    console.log(prices.length);
    var sum = 0;
    for(var i = 0; i < prices.length; i++){
        sum += parseFloat(prices[i].innerHTML);
        prices[i].innerHTML = (formatVND(parseFloat(prices[i].innerHTML)));
    }
    sum = Math.round(sum*1000)/1000;
    $('#total').html(formatVND(sum));
    var ship = Math.round(sum*2)/100;
    $('#ship').html(formatVND(ship));
    $('#total-and-ship').html(formatVND(Math.round((sum + ship)*100)/100));
    $('#amount').val((Math.round((sum + ship)*100)/100));
});

function formatVND(number) {
    return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(number)
}

function changeQuantity(id) {
    var quantity = parseInt($('#quantity' + id).val(), 10);
    $.post("./core/edit_cart.php", {type: 'change', id: parseInt(id), quantity: quantity})
    .done(() => {
        $('#cart-table').load('cart_content.php');
    });
}

function remove(id) {
    $.post("./core/edit_cart.php", {type: 'remove', id: parseInt(id)})
    .done(() => {
        $('#cart-table').load('cart_content.php');
    });
}