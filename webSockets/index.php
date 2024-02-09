<?php

session_start();

$error = '';

if (isset($_SESSION['user_data'])) {
    header('location:chatroom.php');
}

if (isset($_POST['login'])) {
    require_once('database/ChatUser.php');

    $user_object = new ChatUser;

    $user_object->setUserEmail($_POST['user_email']);

    $user_data = $user_object->get_user_data_by_email();

    if (is_array($user_data) && count($user_data) > 0) {
        if ($user_data['user_status'] == 'Enable') {
            if ($user_data['user_password'] == $_POST['user_password']) {
                $user_object->setUserId($user_data['user_id']);
                $user_object->setUserLoginStatus('Login');

                if ($user_object->update_user_login_data()) {
                    $_SESSION['user_data'][$user_data['user_id']] = [
                        'id' => $user_data['user_id'],
                        'name' => $user_data['user_name'],
                        'profile' => $user_data['user_profile']
                    ];

                    header('location:chatroom.php');

                }
            } else {
                $error = 'Wrong Password';
            }
        } else {
            $error = 'Please Verify Your Email Address';
        }
    } else {
        $error = 'Wrong Email Address';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | PHP Chat Application using Websocket</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/jquery.easing@1.4.1/jquery.easing.min.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/src/parsley.min.css
" rel="stylesheet">
</head>

<body>

    <div class="containter">
        <br />
        <br />
        <h1 class="text-center">Chat Application in PHP & MySql using WebSocket - Login</h1>
        <div class="row justify-content-md-center mt-5">

            <div class="col-md-4">
                <?php
                if (isset($_SESSION['success_message'])) {
                    echo '
                    <div class="alert alert-success">
                    ' . $_SESSION["success_message"] . '
                    </div>
                    ';
                    unset($_SESSION['success_message']);
                }

                if ($error != '') {
                    echo '
                    <div class="alert alert-danger">
                    ' . $error . '
                    </div>
                    ';
                }
                ?>
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="post" id="login_form">
                            <div class="form-group">
                                <label>Enter Your Email Address</label>
                                <input type="text" name="user_email" id="user_email" class="form-control"
                                    data-parsley-type="email" required />
                            </div>
                            <div class="form-group">
                                <label>Enter Your Password</label>
                                <input type="password" name="user_password" id="user_password" class="form-control"
                                    required />
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="login" id="login" class="btn btn-primary" value="Login" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>

    $(document).ready(function () {

        $('#login_form').parsley();

    });

</script>