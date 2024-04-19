$(document).ready(function () {
$('#close_new_user_model').on('click', function () {
    username = $('#username').val();
    first_name = $('#first_name').val();
    last_name = $('#last_name').val();
    role = $('#role').val();
    password = $('#password').val();
    admin = $('#admin').val();
    creator = $('#creator').val();
    $.ajax({
        type: "POST",
        url: "./php/create_user.php",
        data:  {username: username, first_name: first_name, last_name: last_name, role: role, password: password, admin: admin, creator: creator},
        success: function (data) {
            Swal.fire({
                title: "Success",
                text: data.responseText,
                icon: "success",
                heightAuto: false,
                color: "white",
            });
            $('#username').val("");
            $('#first_name').val("");
            $('#last_name').val("");
            $('#role').val("");
            $('#password').val("");
            $('#admin').val("");
            $('#creator').val("");
        },
        error: function (data) {
            Swal.fire({
                title: "No User Created",
                text: data.responseText,
                icon: "error",
                heightAuto: false,
                color: "white",
            });
        }
    })
  });
});