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
                <section class="all_users">
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
        get_data({}, "user_info");
        get_data({}, "contacts");

        //get_data({}, "preview_messages"); // display preview messages
        
    </script>
</body>
</html>