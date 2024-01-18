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
});

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
});

const toastBootstrap = bootstrap.Toast.getOrCreateInstance($(".toast"));
toastBootstrap.show();