<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat!</title>
    <?php include_once __DIR__ . '/styles/styles.php'; ?>
</head>
<body>
    <div id="viewer" class="viewer_off" onclick="toggle_viewer(event)"></div>
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
                    <div class="preview_messages" id="preview_messages" style="display: block;">
                        
                    </div>
                </section>
                <section class="chatbox" id="chatbox">
                    <div class="header">
                        <div class="user_box" id="user_box">
                            
                        </div>
                        <div class="user_action_icons tooltip">
                            <!-- <i class="fa fa-folder-open-o" aria-hidden="true"></i><span>File</span> -->
                            <?php if (isset($_GET['id']) && $_GET['id'] != ""):?>
                            <div onclick="delete_conversation(event)"><p style="color: red;">Xóa cuộc trò chuyện</p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="msg_holder" id="msg_holder" style="overflow-y: scroll; height: 600px;">   
                        
                    </div>
                    <div class="user_msg">
                        <label for="file_message"><i class="fa fa-file" aria-hidden="true"></i></label>
                        <input type="file" name="file" id="file_message" style="display: none;" onchange="send_file(this.files)">
                        <input type="text" id="text_message" onkeyup="enter_pressed(event)">
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

        var sent_audio = new Audio("assets/soundeffect/message_sent.wav");

        var CURRENT_CHAT_USERID = "";
        var SEEN = false;
        get_data({}, "user_info"); // get fire when user comes --> tp check if user logged in yet
        
        // when user click on a friend to chat
        <?php if (isset($_GET['id']) && $_GET['id'] != ""):?>
            // get friend id to start chat
            CURRENT_CHAT_USERID = <?php echo $_GET['id'];?>;
            // but when clicked on friend --> u see their messages
            SEEN = true;
            get_data({userid: CURRENT_CHAT_USERID, seen: SEEN}, "friend_info");
            //get_data({}, "preview_messages");
        <?php endif;?>
        get_data({}, "preview_messages");

        // functions for chatting
        function send_message(e) {
            
            const text_message = document.getElementById("text_message");

            if (!text_message.value.trim()) {
                alert("Empty messages!");
                return;
            }

            // collect data
            const data = {};
            data.message = text_message.value.trim();
            data.userid = CURRENT_CHAT_USERID;

            //alert(text_message.value);
            
            // send and get data
            send_data(data, "send_message");
            
            text_message.value = '';
        }

        function enter_pressed(e) {

            if (e.keyCode == 13) {  // pressed enter key
                send_message(e);
            }

            // press any key and seen = true
            SEEN = true;
            get_data({userid: CURRENT_CHAT_USERID, seen: SEEN}, "friend_info");
        }

        setInterval(function() {

            SEEN = false;  // reset the seen value
            // alert("heyy");
            if (CURRENT_CHAT_USERID) {
                get_data({
                    userid: CURRENT_CHAT_USERID,
                    seen: SEEN
                }, "friend_info");
            
            }
            get_data({}, "preview_messages");

            
        }, 5000);

        function delete_message(e) {
            let answer = confirm("Bạn có chắc chắn bạn muốn xóa tin nhắn này không?");
            if (answer) {
                var msg_id = e.target.getAttribute("msg_id");
                //alert(msg_id);

                // collect data
                const data = {};
                data.message_id = msg_id;

                send_data(data, "delete_message");
                //get_data({userid: CURRENT_CHAT_USERID, seen: SEEN}, "friend_info");
            }
        }

        function delete_conversation(e) {
            
            let answer = confirm("Bạn có chắc chắn bạn muốn xóa cuộc trò chuyện này không?");
            if (answer) {

                // collect data
                const data = {};
                data.userid = CURRENT_CHAT_USERID;

                send_data(data, "delete_conversation");
                //get_data({userid: CURRENT_CHAT_USERID, seen: SEEN}, "friend_info");
            }
            
        }

        function send_file(files) {

            var start_ext = files[0].name;
            var index_start_ext = start_ext.lastIndexOf(".");
            var ext = start_ext.substr(index_start_ext + 1, 4);
            if (!(ext == 'jpg' || ext == 'JPG' || ext == 'png' || ext == 'PNG' || ext == 'jpeg' || ext == 'JPEG')) {
                alert("File không hợp lệ! Chỉ hỗ trợ '.jpg', 'png', 'jpeg'");
                return;
            }
            
            let form = new FormData();
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    
                    let message = xml.responseText;
                    //alert(message);
                    sent_audio.play();
                    
                }

            });

            // send data
            form.append('data', files[0]);
            form.append('userID', CURRENT_CHAT_USERID);
            form.append('type_of_data', "send_file");
            
            xml.open("POST", "backend/uploader.php", true);
            xml.send(form);
        }

        function toggle_viewer(e) {
            e.target.className = "viewer_off";
        }

        function image_show(e) {
            var image = e.target.src;
            var viewer = document.getElementById("viewer");

            viewer.innerHTML = "<img src='"+image+"' style='width: 100%; height: 100%; border-radius: 0px;'>";
            viewer.className = 'viewer_on';
        }

        function send_data(data, type) {
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    
                    let message = xml.responseText;

                    //alert(message);
                    if (message == 'sent') {

                        //alert(message);
                        sent_audio.play();

                    } else if (message == 'deleted') {

                        alert(message);

                    } else if (message == 'rip') {

                        alert(message);

                    }
                    
                }

            });

            // send data
            data.type_of_data = type;
            let data_string = JSON.stringify(data); // cannot send object so turn the obj to string
            xml.open("POST", "backend/handle_data.php", true);
            xml.send(data_string);
        }

    </script>
</body>
</html>