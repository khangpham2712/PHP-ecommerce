$(document).ready(function(){
    $(window).scroll(function(){

        if(this.scrollY > 500){
            $('.scroll-up-btn').addClass("show");
        }else{
            $('.scroll-up-btn').removeClass("show");
        }
    });

    $('.scroll-up-btn').click(function(){
        $('html').animate({scrollTop: 0});

        $('html').css("scrollBehavior", "auto");
    });

});



function editEnable(id) {
    document.getElementById(id).removeAttribute("readonly");
    $('#' + id + "-chanage").hide();
    document.getElementById('current-password').style.display = "flex";
    $("#button-submit").show();
}

function changePasswordShow() {
    $("#changePasswordButton").hide();
    document.getElementById('current-password').style.display = "flex";
    $("#changePassword").show();
    $("#button-submit").show();
}


var check = function() {
    if (document.getElementById('password').value ==
      document.getElementById('confirm_password').value) {
      document.getElementById('confirm_password').style.color = 'green';
      document.getElementById('label_confirm').style.color = 'green';
    } else {
      document.getElementById('confirm_password').style.color = 'red';
      document.getElementById('label_confirm').style.color = 'red';
    }
  }







function seeDetail(content, id) {
    if($("#seeDetailBtn" + id).attr('value')==1) {
        $("#detail" + id).show();
        $("#detail" + id).html("<td colspan='6'>" + content + "</td>");
        $("#seeDetailBtn" + id).html("Hide");
        $("#seeDetailBtn" + id).attr('value', 0);
    }
    else {
        $("#detail" + id).hide();
        $("#seeDetailBtn" + id).html("View");
        $("#seeDetailBtn" + id).attr('value', 1); 
    }
}

// $('#add-user').click(() => {
//     var name = $('#name').val();
//     //check name
//     if(!testText255(name)){
//         $('#name-log').show();
//     }

//     var password = $('#password').val();
//     var confirm_password = $('#confirm_password').val();
//     var type = $('#type').val();
//     //check password
//     if(password != confirm_password){
//         $('#password-match').show();
//     }

//     if(!testText255(password)){
//         $('#password-log').show();
//     }

//     var email = $('#email').val();

//     $.post('../core/add_user.php', {name: name, password: password, email: email, type: type})
//     .done((data) => {
//         console.log(data);
//     })


// })


