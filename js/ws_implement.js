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

var conn = null;

if(conn == null) conn = new WebSocket('wss://ws.lilithtech.dev');
else
{	
    conn.terminate();
    conn = new WebSocket('wss://ws.lilithtech.dev');
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
	
	if (typeof data.status !== 'undefined') {
		console.log("Connection reopened!");
	}
};