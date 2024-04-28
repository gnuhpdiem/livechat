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
        <section class="sidebar">
            <div class="quicklinks">
                <ul>
                    <a href="chat.php"><li class="tooltip"><i class="fa fa-commenting-o" aria-hidden="true"></i><span>Chat</span></li></a>
                    <a href="contacts.php"><li class="tooltip"><i class="fa fa-address-book-o" aria-hidden="true"><span>Contacts</span></i></li></a>
                    <a href="settings.php" class="tooltip"><li class="tooltip"><i class="fa fa-cog" aria-hidden="true"><span>Settings</span></i></li></a>
                </ul>
            </div>

            <div class="settings_section">
                <a href="main_user_profile.php" class="tooltip"><img src="assets/img/default-avatar.jpg"><span>Tài khoản</span></a>
                <div class="settings tooltip" id="settings"><i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span></div>
            </div>
            <div class="click_box" style="display: none;">
                <ul>
                    <li><a href="main_user_profile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>Hồ sơ của tôi</a></li>
                    <li style="border: none;" onclick="dangxuat()"><span style="color: red;">Đăng xuất</span></li>
                </ul>
            </div>
            
        </section>
        <section class="main_content">
            <header class="main_header">
                <div class="username" id="username">Username</div>
                <button id="dangxuatBtn">Đăng xuất</button>
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
                <section class="all_users">
                    <div id="list_of_users">

                    </div>
                </section>
            </div>
        </section>
    </div>
    <script src="js/scripts.js"></script>
    <script src="js/get_data.js"></script>
    <script src="js/dangxuat.js"></script>
    <script>
        get_data({}, "user_info");
        get_data({}, "contacts");

        get_data({}, "preview_messages"); // display preview messages
        
    </script>
</body>
</html>