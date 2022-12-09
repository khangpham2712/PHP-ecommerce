function testName(input){
    var exp = /^[^<]{3,255}$/;
    return exp.test(input);
}

function testUserName(input) {
    var exp = /^[\w ]{3,255}$/;
    return exp.test(input);
}

function testPassword(input) {
    var exp = /^[\w]{3,255}$/;
    return exp.test(input);
}

$('form#user-info').submit((event)=> {
    $('.log-fail').hide();
    $('.log-success').hide();
    var name = $("input[name='name']").val();
    if(!testUserName(name)){
        $("small#wrong-name").text("Name must be between 3-255 characters. (letter, number, space, underscore)").show();
        event.preventDefault();
    }
    var password = $("input[name='newPass'").val();
    if(password != ''){
        if(!testPassword(password)) {
            $("small#wrong-confirm").text("Password must be between 3-255 characters. (letter, number, underscore)").show();
            event.preventDefault();
        }
        var confirm_password = $("input[name='confirmPass']").val();
        if(password != confirm_password) {
            $("small#wrong-confirm").text("Confirm password does not match").show();
            event.preventDefault();
        }
    }
})

$('form#signup').submit((event) => {
    $('.log-fail').hide();
    $('.log-success').hide();
    var name = $("input[name='username']").val();
    if(!testUserName(name)){
        $('small#log').text("Name must be between 3-255 characters. (letter, number, space, underscore)").show();
        event.preventDefault();
    }
    var password = $("input[name='password']").val();
    var confirm_password = $("input[name='confirm_password']").val();
    if(!testPassword(password)){
        $('small#log').text("Password must be between 3-255 characters. (letter, number, underscore)").show();
        event.preventDefault();
    }
    if(password != confirm_password) {
        $('small#log').text("Confirm password does not match").show();
        event.preventDefault();
    }
})

$('form#add-user').submit((event) => {
    $('.log-fail').hide();
    $('.log-success').hide();
    var name = $("input[name='name']").val();
    if(!testUserName(name)){
        $('small#name-log').text("Name must be between 3-255 characters. (letter, number, space, underscore)").show();
        event.preventDefault();
    }
    var password = $("input[name='password']").val();
    var confirm_password = $("input[name='confirm_password']").val();
    if(!testPassword(password)){
        $('small#password-log').text("Password must be between 3-255 characters. (letter, number, underscore)").show();
        event.preventDefault();
    }else {
        if(password != confirm_password) {
            $('small#password-match').text("Confirm password does not match").show();
            event.preventDefault();
        }
    }
})

$('form#edit-product').submit((event) => {
    $('.log-fail').hide();
    $('.log-success').hide();
    var name = $("input[name='name']").val();
    if(!testName(name)){
        $('small#log-name').text("Name must be between 3-255 characters").show();
        event.preventDefault();
    }
    var price = $("input[name='price']").val();
    if(isNaN(price)){
        $('small#log-price').text("Product price must be a number.").show();
        event.preventDefault();
    }
})