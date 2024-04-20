$(document).ready(function () {
    $('#close_remove_user_model').on('click', function () {
        $.ajax({
            type: "POST",
            url: "./php/remove_user.php",
            success: function (data) {
                Swal.fire({
                    title: "Success",
                    text: data.responseText,
                    icon: "success",
                    heightAuto: false,
                    color: "white",
                });
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