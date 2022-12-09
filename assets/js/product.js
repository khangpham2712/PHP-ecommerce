$(document).ready(function(){
  
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
    
        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
        if (e < onStar) {
            $(this).addClass('hover');
        }
        else {
            $(this).removeClass('hover');
        }
        });
        
    }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });


    /* 2. Action to perform on click */
    $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }
    });
});

$(function() {
    $(".img-small").hover(function(){
        var url = $(this).attr("src");
        $(".img-large").attr("src", url);
    }, function() {

    })
})

$('#send-rating').click(() => {
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    if (isNaN(ratingValue)) {
        return;
    }
    var id = parseInt($('#id').val(), 10);
    $.post("./core/ratingAndCmt.php", {type: "rate", id: id, rate: ratingValue})
    .done(() =>{
        var msg = "";
        msg = "Thanks for your rating";
        responseMessage(msg);
    });
});

function responseMessage(msg) {
    $('.success-box').fadeIn(200);  
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
}

$('#send-cmt').click(() => {
    var cmt = $('#cmt').val();
    var id = parseInt($('#id').val(), 10);
    if(cmt!=''){
        $.post("./core/ratingAndCmt.php", {type: 'cmt', cmt : cmt, id: id})
        .done(() => {
            $('#cmt').val("");
            $('#cmt-item').load("comment.php?id=" + id);
        });
    }
});

$('#send-respone').click(() => {
    var cmt = $('#respone').val();
    var id = parseInt($('#id').val(), 10);
    if(cmt!=''){
        $.post("../core/ratingAndCmt.php", {type: 'cmt', cmt : cmt, id: id})
        .done(() => {
            $('#respone').val("");
            $('#cmt-item').load("../comment.php?id=" + id);
        });
    }
});

$('#load-comment').click(() => {
    var id = parseInt($('#id').val(), 10);
    $('#cmt-item').load("comment.php?id=" + id);
    $('#load-comment').hide();
});

$('#load-comment-admin').click(() => {
    var id = parseInt($('#id').val(), 10);
    $('#cmt-item').load("../comment.php?id=" + id);
    $('#load-comment-admin').hide();
});


$('#send-message').click(() => {
    var msg = $('#message').val();
    if (msg == "") {
        alert("Please input message");
        return;
    }
    $.post("./core/ratingAndCmt.php", {type: "msg", msg : msg})
    .done((data) => {
        console.log(data);
        $('#form-message').hide();
        $('#thankyou').show();
    })
})

