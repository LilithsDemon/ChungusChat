$(document).ready(function () {
    $("#group_add_select").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "./php/add_user_by_name.php",
            data: $("#group_add_select").serialize(),
            success: function (data) {
                // Sweet alerts success
                Swal.fire({
                    title: "Success",
                    text: data.responseText,
                    icon: "success",
                    heightAuto: false,
                    color: "white",
                });
                // If successful, should show on the groups model the users in the group
                $.ajax({
                    url: './php/show_group_users.php',
                    type: 'GET',
                    success: function(data)
                    {
                        $('#current_group_users').html(data);
                    }
                });
            },
            error: function (data) {
                Swal.fire({
                    title: "No User Added",
                    text: data.responseText,
                    icon: "error",
                    heightAuto: false,
                    color: "white",
                });
            },
        });
    });

    // This works almost exactly the same as the last submit ajax, except is used for entering specific usernames
    $("#group_add_username").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "./php/add_user_by_name.php",
            data: $("#group_add_username").serialize(),
            success: function (data) {
                Swal.fire({
                    title: "Success",
                    text: data.responseText,
                    icon: "success",
                    heightAuto: false,
                    color: "white",
                });
                $.ajax({
                    url: './php/show_group_users.php',
                    type: 'GET',
                    success: function(data)
                    {
                        $('#current_group_users').html(data);
                    }
                });
            },
            error: function (data) {
                Swal.fire({
                    title: "No User Added",
                    text: data.responseText,
                    icon: "error",
                    heightAuto: false,
                    color: "white",
                });
            },
        });
    });

    // This is ran when the user submits the model for the new group
    var group_name = $('#groupName').val();
    $('#close_new_group_model').on('click', function () {
        group_name = $('#groupName').val();
        $.ajax({
            type: "POST",
            url: "./php/create_group.php",
            data:  {"group_name": group_name},
            success: function (data) {
                Swal.fire({
                    title: "Success",
                    text: data.responseText,
                    icon: "success",
                    heightAuto: false,
                    color: "white",
                });
                $('#groupName').val("");
                // At this point the group users are reset so the model should show no users
                $.ajax({
                    url: './php/show_group_users.php',
                    type: 'GET',
                    success: function(data)
                    {
                        $('#current_group_users').html(data);
                    }
                });
                conn.send(JSON.stringify({groupName: group_name})); // Sends the data to all clients
            },
            error: function (data) {
                Swal.fire({
                    title: "No Group Created",
                    text: data.responseText,
                    icon: "error",
                    heightAuto: false,
                    color: "white",
                });
            }
        })
      });
});