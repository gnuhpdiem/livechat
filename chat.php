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
                <section class="chatbox">
                    <div class="header">
                        <div class="user_box" id="user_box">
                            
                        </div>
                        <div class="user_action_icons tooltip">
                            <i class="fa fa-folder-open-o" aria-hidden="true"></i><span>File</span>
                        </div>
                    </div>
                    <div class="chatbox_body">
                        <div class="msg_content" id="msg_content">
                            
                        </div>
                        <div class="user_msg">
                            <input type="text">
                            <button><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
    <script src="js/clickbox.js"></script>
    <script src="js/get_data.js"></script>
    <script src="js/dangxuat.js"></script>
    <script>

        get_data({}, "user_info"); // get fire when user comes --> tp check if user logged in yet
        
        <?php if (isset($_GET['id']) && $_GET['id'] != ""):?>
            get_data({userid: <?php echo $_GET['id'];?>}, "friend_info");
        <?php endif;?>

    </script>
</body>
</html>