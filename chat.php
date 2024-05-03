<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat!</title>
    <?php include_once __DIR__ . '/styles/styles.php'; ?>
</head>
<body>
    <div class="container">
        <?php
            include_once __DIR__ . '/layout/sidebar.php';
        ?>
        
        <section class="main_content">
            <header class="main_header">
                <div class="username" id="username">Username</div>
                <button onclick="dangxuat()">Đăng xuất</button>
            </header>
            <div>
                <section class="users">
                    <h1>Đoạn chat</h1>
                    <div class="header">
                        <div class="input-box">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" placeholder="Tìm kiếm tin nhắn...">
                        </div>
                    </div>
                    <div class="preview_messages" id="preview_messages">
                        
                    </div>
                </section>
                <section class="chatbox" id="chatbox">
                    <div class="header">
                        <div class="user_box" id="user_box">
                            
                        </div>
                        <div class="user_action_icons tooltip">
                            <i class="fa fa-folder-open-o" aria-hidden="true"></i><span>File</span>
                        </div>
                    </div>
                    <div class="msg_holder" id="msg_holder" style="overflow-y: scroll; height: 600px;">   
                        
                    </div>
                    <div class="user_msg">
                        <label for="file_message"><i class="fa fa-file" aria-hidden="true"></i></label>
                        <input type="file" name="file" id="file_message" style="display: none;">
                        <input type="text" id="text_message">
                        <input type="submit" onclick="send_message(event)">
                    </div>
                </section>
            </div>
        </section>
    </div>
    <script src="js/clickbox.js"></script>
    <script src="js/get_data.js"></script>
    <script src="js/dangxuat.js"></script>
    <script>
        var CURRENT_CHAT_USERID = "";
        get_data({}, "user_info"); // get fire when user comes --> tp check if user logged in yet
        
        <?php if (isset($_GET['id']) && $_GET['id'] != ""):?>
            CURRENT_CHAT_USERID = <?php echo $_GET['id'];?>;
            get_data({userid: CURRENT_CHAT_USERID}, "friend_info");
        <?php endif;?>

        // functions for chatting
        function send_message(e) {
            // collect data
            const text_message = document.getElementById("text_message");

            if (!text_message.value.trim()) {
                alert("Empty messages!");
                return;
            }
            //alert(text_message.value);
    
            // send and get data
            get_data({
                message: text_message.value.trim(),
                userid: CURRENT_CHAT_USERID
            }, "send_message");
        }

    </script>
</body>
</html>