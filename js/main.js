//Some variables needed later
var roomName = "";
var roomID = 0;

// This allows for tooltips in bootstrap to be initialized
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

// This sets a cookie for the users ID to be used for some ajax calls
function SetUserID(userID)
{
    Cookies.set('userID', userID , { expires:86400, path: '/' }); // 86400 seconds in day
    console.log(Cookies.get('userID'));
}

//Controlling how the website acts when things are pressed when in different sizes

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
        $('.chat-groups').addClass('d-none');
        $('.chat').removeClass('d-none');
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
        $('.chat-groups').removeClass('d-none');
        $('.chat').addClass('d-none');
    }
});

$(window).resize(function() {

    if($(document).width() > 1100)
    {
        $('.chat').removeClass('d-none');
        $('.chat-groups').removeClass('d-none');
    } 
    $('.messages').css('max-height', "calc(80% - " +  $('.navbar').height() + "px)");
    $('.messages').css('flex', "calc(80% - " +  $('.navbar').css("height") + "px)");
});

// For getting the toast from bootstrap to work
const toastBootstrap = bootstrap.Toast.getOrCreateInstance($(".toast"));

// Ajax for when sending a message
$('#formSendMsg').submit(function (e)
{
    e.preventDefault();
    $.ajax({
        url: './php/send.php',
        method: 'POST',
        data: $('#formSendMsg').serialize(),
        success: function (data) {
            console.log(Cookies.get('userID'));
            var userID = Cookies.get('userID');
            var message = $('#message_input').val();
    
            var data = {
                roomID, roomID,
                userID: userID,
                msg: message
            };
    
            conn.send(JSON.stringify(data));
    
            $('#message_input').val('');

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

// This gets all messages used in short polling
function FetchMsgs()
{
    $.ajax({
        url: './php/fetch.php',
        type: 'GET',
        success: function(data)
        {
            $('#chatMessages').html(data);
        }
    });
}

// This helps maintain a socket in case the db does not want to keep a long connection
function MaintainSocket()
{
    var data = {
        status: 1
    };

    conn.send(JSON.stringify(data));
}


// This is called when a profile is opened to make sure the right data is obtrieved
function SetProfile(username)
{
    $.ajax({   
        url: './components/profile.php',
        type: 'POST',
        data: {Username: username},
        success: function(data)
        {
            $.ajax({
                url: SetProfileHTML(data),
                success: function(){
                    AddButton();
                }
            });
        }
    });
}

// This is called when a profile is opened to output the right data to the user
function SetProfileHTML(data)
{
    $('#offCanvasProfile').html(data);
    AddButton();
    var myModal = new bootstrap.Modal(document.getElementById('#offCanvasProfile'));
    myModal.show();
}

// Side bar buttons
$('.chat-button').on('click', function(){
    $('.chat-groups').removeClass('d-none');
    $('.collegues').addClass('d-none');
});

$('.collegue-button').on('click', function(){
    $('.collegues').removeClass('d-none');
    $('.chat-groups').addClass('d-none');
});


// Sets the correct size for the messages section
$('.messages').css('max-height', "calc(80% - " +  $('.navbar').height() + "px)");
$('.messages').css('flex', "calc(80% - " +  $('navbar').css("height") + "px)");

// Sets up short polling for messages
setInterval(FetchMsgs, 1000); // Every second
setInterval(MaintainSocket, 10000); //Every 10 seconds