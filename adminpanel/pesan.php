<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Chat</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            loadMessages();

            $('#userSelect').change(function() {
                loadMessages();
            });

            $('#sendBtn').click(function() {
                var message = $('#message').val();
                var id_user = $('#userSelect').val();
                $.post('../chat/send_message.php', { message: message, sender: 'admin', id_user: id_user }, function() {
                    $('#message').val('');
                    loadMessages();
                });
            });

            function loadMessages() {
                var id_user = $('#userSelect').val();
                if (id_user) {
                    $.get('../chat/load_messages.php', { id_user: id_user }, function(data) {
                        $('#chatBox').html(data);
                    });
                }
            }

            setInterval(loadMessages, 2000); // Refresh messages every 2 seconds
        });
    </script>
</head>
<body>
<?php require "navbar.php"; ?>
    <div class="container mt-5">
        <div class="my-5 col-12 ">
        <h3>Pesan</h3>
        <div class="chat-container">
            <div class="form-group">
                <label for="userSelect">Select User:</label>
                <select class="form-control col-md-6" id="userSelect">
                    <option value="">Select a user</option>
                    <?php
                    $result = $con->query("SELECT id_user, email, username FROM login WHERE role = 'user'");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['id_user']."'>".$row['username']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="chatBox" class="chat-box border rounded p-3 mb-3" style="height: 300px; overflow-y: scroll;"></div>
            <div class="input-group">
                <input type="text" class="form-control" id="message" placeholder="Type your message here" required>
                <div class="input-group-append">
                    <button id="sendBtn" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
        </div>
    </div>


<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
