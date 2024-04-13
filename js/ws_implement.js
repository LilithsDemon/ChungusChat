var conn = null;

if(conn == null) conn = new WebSocket('wss://ws.lilithtech.dev');
else
{	
    conn.terminate();
    conn = new WebSocket('wss://ws.lilithtech.dev');
};

conn.onopen = function (e) {
    console.log("Connection established!");
};

conn.onclose = function (e) {
    console.log("Connection closed!");
};

conn.onmessage = function (e) {
    console.log(e.data);
	var data = JSON.parse(e.data);

	console.log(e.data);
	
	if (typeof data.status !== 'undefined') console.log("Connection reopened!");
	if (typeof data.update !== 'undefined') console.log("user Data updated!");

	if(typeof data.roomID !== 'undefined' && typeof data.msg !== 'undefined' && typeof data.userID !== 'undefined')
	{
		console.log("Message");
		$.ajax({
			url: './php/append_message.php',
			type: 'POST',
			data: {"RoomID": data.roomID, "Message": data.msg, "SenderID": data.userID},
			success: function(data)
			{
				console.log("Message Recieved");
				$('#chatMessages').append(data);
			}
		});
	}
};