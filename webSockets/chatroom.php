<?php
session_start();

if (!isset($_SESSION['user_data'])) {
	header('location:index.php');
}

require('database/ChatUser.php');

require('database/ChatRooms.php');

$chat_object = new ChatRooms;

$chat_data = $chat_object->get_all_chat_data();

$user_object = new ChatUser;

$user_data = $user_object->get_user_all_data();

?>

<!DOCTYPE html>
<html>

<head>
	<title>Chat application in php using web scocket programming</title>
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
	<style type="text/css">
		html,
		body {
			height: 100%;
			width: 100%;
			margin: 0;
		}

		#wrapper {
			display: flex;
			flex-flow: column;
			height: 100%;
		}

		#remaining {
			flex-grow: 1;
		}

		#messages {
			height: 200px;
			background: whitesmoke;
			overflow: auto;
		}

		#chat-room-frm {
			margin-top: 10px;
		}

		#user_list {
			height: 450px;
			overflow-y: auto;
		}

		#messages_area {
			height: 650px;
			overflow-y: auto;
			background-color: #e6e6e6;
		}
	</style>
</head>

<body>
	<div class="container">
		<br />
		<h3 class="text-center">PHP Chat Application using Websocket - Display User with Online or Offline Status</h3>
		<br />
		<div class="row">

			<div class="col-lg-8">
				<div class="card">
					<div class="card-header">
						<h3>Chat Room</h3>
					</div>
					<div class="card-body" id="messages_area">
						<?php
						foreach ($chat_data as $chat) {
							if (isset($_SESSION['user_data'][$chat['userid']])) {
								$from = 'Me';
								$row_class = 'row justify-content-start';
								$background_class = 'text-dark alert-light';
							} else {
								$from = $chat['user_name'];
								$row_class = 'row justify-content-end';
								$background_class = 'alert-success';
							}

							echo '
						<div class="' . $row_class . '">
							<div class="col-sm-10">
								<div class="shadow-sm alert ' . $background_class . '">
									<b>' . $from . ' - </b>' . $chat["msg"] . '
									<br />
									<div class="text-right">
										<small><i>' . $chat["created_on"] . '</i></small>
									</div>
								</div>
							</div>
						</div>
						';
						}
						?>
					</div>
				</div>

				<form method="post" id="chat_form" data-parsley-errors-container="#validation_error">
					<div class="input-group mb-3">
						<textarea class="form-control" id="chat_message" name="chat_message"
							placeholder="Type Message Here" data-parsley-maxlength="1000"
							data-parsley-pattern="/^[a-zA-Z0-9\s]+$/" required></textarea>
						<div class="input-group-append">
							<button type="submit" name="send" id="send" class="btn btn-primary"><i
									class="fa fa-paper-plane"></i></button>
						</div>
					</div>
					<div id="validation_error"></div>
				</form>
			</div>
			<div class="col-lg-4">
				<?php

				$login_user_id = '';

				foreach ($_SESSION['user_data'] as $key => $value) {
					$login_user_id = $value['id'];
					?>
					<input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo $login_user_id; ?>" />
					<div class="mt-3 mb-3 text-center">
						<img src="<?php echo $value['profile']; ?>" width="150"
							class="img-fluid rounded-circle img-thumbnail" />
						<h3 class="mt-2">
							<?php echo $value['name']; ?>
						</h3>
						<a href="profile.php" class="btn btn-secondary mt-2 mb-2">Edit</a>
						<input type="button" class="btn btn-primary mt-2 mb-2" name="logout" id="logout" value="Logout" />
					</div>
					<?php
				}
				?>

				<div class="card mt-3">
					<div class="card-header">User List</div>
					<div class="card-body" id="user_list">
						<div class="list-group list-group-flush">
							<?php
							if (count($user_data) > 0) {
								foreach ($user_data as $key => $user) {
									$icon = '<i class="fa fa-circle text-danger"></i>';

									if ($user['user_login_status'] == 'Login') {
										$icon = '<i class="fa fa-circle text-success"></i>';
									}

									if ($user['user_id'] != $login_user_id) {
										echo '
									<a class="list-group-item list-group-item-action">
										<img src="' . $user["user_profile"] . '" class="img-fluid rounded-circle img-thumbnail" width="50" />
										<span class="ml-1"><strong>' . $user["user_name"] . '</strong></span>
										<span class="mt-2 float-right">' . $icon . '</span>
									</a>
									';
									}

								}
							}
							?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
<script type="text/javascript">

	$(document).ready(function () {

		var conn = null;

		if(conn != null) new WebSocket('wss://ws.lilithtech.dev');
		else
		{	
			conn.terminate();
			new WebSocket('wss://ws.lilithtech.dev');
		}
		conn.onopen = function (e) {
			console.log("Connection established!");
		};

		conn.onclose = function (e) {
			console.log("Connection closed!");
		};

		conn.onmessage = function (e) {
			console.log(e.data);

			var data = JSON.parse(e.data);

			var row_class = '';

			var background_class = '';

			if (data.from == 'Me') {
				row_class = 'row justify-content-start';
				background_class = 'text-dark alert-light';
			}
			else {
				row_class = 'row justify-content-end';
				background_class = 'alert-success';
			}

			var html_data = "<div class='" + row_class + "'><div class='col-sm-10'><div class='shadow-sm alert " + background_class + "'><b>" + data.from + " - </b>" + data.msg + "<br /><div class='text-right'><small><i>" + data.dt + "</i></small></div></div></div></div>";

			$('#messages_area').append(html_data);

			$("#chat_message").val("");
		};

		$('#chat_form').parsley();

		$('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

		$('#chat_form').on('submit', function (event) {

			event.preventDefault();

			if ($('#chat_form').parsley().isValid()) {

				var user_id = $('#login_user_id').val();

				var message = $('#chat_message').val();

				var data = {
					userId: user_id,
					msg: message
				};

				conn.send(JSON.stringify(data));

				$('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

			}

		});

		$('#logout').click(function () {

			user_id = $('#login_user_id').val();

			$.ajax({
				url: "action.php",
				method: "POST",
				data: { user_id: user_id, action: 'leave' },
				success: function (data) {
					var response = JSON.parse(data);

					if (response.status == 1) {
						conn.close();
						location = 'index.php';
					}
				}
			})

		});

	});

</script>

</html>