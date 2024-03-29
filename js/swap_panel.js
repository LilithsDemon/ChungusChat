var roomName = "";
var roomID = 0;

$(".sidebar .main_list li").on('click', function () {
    $(".sidebar ul li.active").removeClass('active');
    $(this).addClass('active');
});

$('.open-btn').on('click', function () {
    $('.sidebar').addClass('active');

});

$('.close-btn').on('click', function () {
    $('.sidebar').removeClass('active');

})

$(".full_page_content .list-group .list-group-item").on('click', function () {
    $(".full_page_content .list-group .list-group-item.active").removeClass('active');
    $(this).addClass('active');
});

$(".profile_open").on('click', function () {
    $('.sidebar').removeClass('active');
    $('#settings').removeClass('show');
});

$(".profile_open").on('click', function () {
    $('.sidebar').removeClass('active');
    $('#settings').removeClass('show');
});

$("#settings_open").on('click', function (){
    $('.sidebar').removeClass('active');
    $('#offCanvasProfile').removeClass('show');
})

$(".chat-group").on('click', function () {
    if($(document).width() < 1100)
    {
        $('.chat-groups').addClass('hide');
        $('.chat-groups').removeClass('d-flex');
        $('.chat-groups').removeClass('d-block');
        $('.chat').removeClass('hide');
        $('.chat').addClass('d-flex');
        $('.chat').addClass('d-block');
    }
    var profile_src = $(this).find($('.profile')).attr('src');
    roomName = $(this).find('.username').text();
    roomID = $(this).find('input[name="roomID"]').val();
    $.ajax({
        url: './php/open_chat.php',
        method: 'POST',
        data: {"RoomID": roomID},
        success: function (data) {
            $.ajax({
                url:FetchMsgs(),
                success:function(){
                $(".messages").scrollTop($(".messages")[0].scrollHeight);
                $('#chat_username').html(roomName);
                $("#profile_chat_img").attr('src', profile_src);
             }
             })
        },
        error: function(err)
        {
            console.log(err);
        }
    });
});



$(".small_to_chat").on('click', function () {
    if($(document).width() < 1100)
    {
        $('.chat-groups').removeClass('hide');
        $('.chat-groups').addClass('d-flex');
        $('.chat-groups').addClass('d-block');
        $('.chat').addClass('hide');
        $('.chat').removeClass('d-flex');
        $('.chat').removeClass('d-block');
    }
});

$(window).resize(function() {

    if($(document).width() > 1100)
    {
        $('.chat').removeClass('hide');
        $('.chat').addClass('d-flex');
        $('.chat').addClass('d-block');
        $('.chat-groups').removeClass('hide');
        $('.chat-groups').addClass('d-flex');
        $('.chat-groups').addClass('d-block');
    } 
    $('.messages').css('max-height', "calc(80% - " +  $('.navbar').height() + "px)");
    $('.messages').css('flex', "calc(80% - " +  $('.navbar').css("height") + "px)");
});

const toastBootstrap = bootstrap.Toast.getOrCreateInstance($(".toast"));

$('#formSendMsg').submit(function (e)
{
    e.preventDefault();
    $.ajax({
        url: 'send.php',
        method: 'POST',
        data: $('#formSendMsg').serialize(),
        success: function (data) {
            $('textarea').val('');
            $.ajax({
                url: FetchMsgs(),
                success: function(){
                    $(".messages").scrollTop($(".messages")[0].scrollHeight);
                }
            });
        },
        error: function(err)
        {
            console.log(err);
        }
    });
});

function FetchMsgs()
{
    $.ajax({
        url: 'fetch.php',
        type: 'GET',
        success: function(data)
        {
            $('#chatMessages').html(data);
        }
    });
}

function MaintainSocket()
{
    var data = {
        status: 1
    };

    conn.send(JSON.stringify(data));
}

$('.messages').css('max-height', "calc(80% - " +  $('.navbar').height() + "px)");
$('.messages').css('flex', "calc(80% - " +  $('navbar').css("height") + "px)");
setInterval(FetchMsgs, 1000);
setInterval(MaintainSocket, 30000);