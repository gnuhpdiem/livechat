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
            if (e.target.id == ''){
                userid = e.target.parentNode.getAttribute("data-userid");
                username = e.target.parentNode.getAttribute("data-username");
            }
            CURRENT_CHAT_USERID = userid;
            CURRENT_CHAT_USERNAME = username;
            //console.log(CURRENT_CHAT_USERID, CURRENT_CHAT_USERNAME);
            //location.href = "chat.php";
            get_data({id: CURRENT_CHAT_USERID,
                        name: CURRENT_CHAT_USERNAME}, "preview_messages");
        }
        
    </script>
</body>
</html>