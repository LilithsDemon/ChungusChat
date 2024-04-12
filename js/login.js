$(document).ready(function () {
    $("#login_form").submit(function (e) {
        e.preventDefault();

        const username = $("#username").val();
        const password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "./php/log_in.php",
            data: $("#login_form").serialize(),
            success: function (data) {
                console.log(data);
                if (data == "true") window.location.href = "../";
            },
            error: function (data) {
                $("#password").val = "";
                Swal.fire({
                    title: "Authentication Request Denied",
                    text: data.responseText,
                    icon: "error",
                    heightAuto: false,
                    color: "white",
                });
            },
        });
    });
});