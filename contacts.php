<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contacts</title>
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
                
                <section class="all_users" id="all_users">
                    <div id="list_of_users">

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
        var CURRENT_CHAT_USERNAME = "";
        get_data({}, "user_info");
        get_data({}, "contacts");

        //get_data({}, "preview_messages"); // display preview messages
        
        function start_chat(e) {
            
            var userid = e.target.getAttribute("data-userid");
            var username = e.target.getAttribute("data-username");
            if (e.target.id == "") {
                userid = e.target.parentNode.getAttribute("data-userid");
                username = e.target.parentNode.getAttribute("data-username");
            }
            // console.log(userid, username);
            CURRENT_CHAT_USERID = userid;
            CURRENT_CHAT_USERNAME = username;

            // collect data
            const data = {};
            data.userid = userid;
            data.username = username;

            //console.log(JSON.stringify(data));

            send_data(data, 'friend_info');
            // 1. Get friends information that the user want to chat
            //location.href = 'chat.php';
            // 2. redirect to the chat.php to start chatting
        }

        function send_data(data, type) {
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    
                    let message = xml.responseText;
                    alert(message);
                    //location.href = 'chat.php';
                }

            });

            // send data
            data.type_of_data = type;
            let data_string = JSON.stringify(data); // cannot send object so turn the obj to string
            xml.open("POST", "chat.php", true);
            xml.send(data_string);
        }
        
    </script>
</body>
</html>