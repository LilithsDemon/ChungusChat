var conn = null; // First we set a null connection, this is to make sure that setting it later works

// If no connection make connection
if(conn == null) conn = new WebSocket('wss://ws.lilithtech.dev');
else
{
	// If there is already a connection it could have issues so we restart a connection
    conn.terminate();
    conn = new WebSocket('wss://ws.lilithtech.dev');
};

// When the connection opens up
conn.onopen = function (e) {
    // console.log("Connection established!"); // Testing purposes
};

// When the websocket closes
conn.onclose = function (e) {
    // console.log("Connection closed!"); // Testing purposes
};

// When a message is recieved by the client
conn.onmessage = function (e) {
    // console.log(e.data); // Testing purposes
	var data = JSON.parse(e.data); // Parses the data given that was sent in a JSON format

	// If data.groupName is assigned then the message is indicating a new group was created
	if(typeof data.groupName !== 'undefined' && data.groupName !== "")
	{
		$.ajax({
			url: './php/append_new_group.php',
			type: 'POST',
			data: {"Name": data.groupName},
			success: function(data)
			{
				// Adds new group the groups list
				$('.groups').append(data);
			}
		});
	}

	// If data.roomID and data.msg and data.userID then we know that it was a message sent to a room
	// This will update the chat box with the new message
	if(typeof data.roomID !== 'undefined' && typeof data.msg !== 'undefined' && typeof data.userID !== 'undefined')
	{
		console.log("Message");
		$('#' + data.roomID).html(data.msg); 
		if(data.userID == Cookies.get('userID')) return null;
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