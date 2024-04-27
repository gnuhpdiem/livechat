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
        <section class="sidebar">
            <div class="quicklinks">
                <ul>
                    <a href="chat.php"><li class="tooltip"><i class="fa fa-commenting-o" aria-hidden="true"></i><span>Chat</span></li></a>
                    <a href="contacts.php"><li class="tooltip"><i class="fa fa-address-book-o" aria-hidden="true"><span>Contacts</span></i></li></a>
                    <a href="settings.php"><li class="tooltip"><i class="fa fa-cog" aria-hidden="true"><span>Settings</span></i></li></a>
                </ul>
            </div>
            <div class="main_user_profile">
                <img src="assets/img/default-avatar.jpg">
            </div>
            <div class="click_box" style="display: none;">
                <ul>
                    <li><a href="index.php">Đăng nhập</a></li>
                    <li><a href="dangki.php">Đăng kí</a></li>
                    <li id="dangxuatBtn"><a href="">Đăng xuất</a></li>
                    <li><a href="main_user_profile.php">Hồ sơ của tôi</a></li>
                </ul>
            </div>
        </section>
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
                <div class="user_box">
                    <img src="assets/img/default-avatar.jpg" id="profile_image">
                    <div class="user_info">
                        <p id="username">Test name</p>
                        <span id="is_online">Đang hoạt động</span>
                    </div>
                </div>
                <div class="user_action_icons tooltip">
                    <i class="fa fa-folder-open-o" aria-hidden="true"></i><span>File</span>
                </div>
            </div>
            <div class="chatbox_body">
                <div class="msg_content">
                    Pretend this is some messages.
                </div>
                <div class="user_msg">
                    <input type="text">
                    <button><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </section>
    </div>

    <script src="js/scripts.js"></script>
    <script src="js/get_data.js"></script>
    <script src="js/dangxuat.js"></script>
    <script>

        get_data({}, "user_info"); // get fire when user comes --> tp check if user logged in yet

        get_data({}, "preview_messages");

    </script>
</body>
</html>