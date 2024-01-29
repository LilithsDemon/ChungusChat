<!-- List to store the chat messages. -->
<ul id="chatMessages"></ul>
<!-- Form to send a chat message. -->
<form> <input type="text" name="txtInput" placeholder="New Message" /> <button type="submit">Send</button></form><!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    //Connect to the WebSocket server at the specified route.
    const conn = new WebSocket('ws://172.17.0.1:8880');
    //This event is called when a new message is received.
    conn.onmessage = function(e) {
        $('#chatMessages').append("<li>" + e.data + "</li>");
    };
    //This event is called when the form is submitted.
    $('form').submit(function(e) {
        e.preventDefault();
        //Gets the message from the input field.    
        let msg = $('input[name=txtInput]').val();
        //Sends the message to the WebSocket server.    
        conn.send(msg);
    });
</script>