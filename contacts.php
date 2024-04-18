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
                    <li><a href="chat.php"><i class="fa fa-commenting-o" aria-hidden="true"></a></i></li>
                    <li><a href="contacts.php"><i class="fa fa-address-book-o" aria-hidden="true"></a></i></li>
                    <li><a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="main_user_profile">
                <img src="assets/img/default-avatar.jpg">
            </div>
        </section>
        <section class="users">
            <div class="header">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input type="text">
            </div>
            <div class="users_list">
                <a href="#">
                    <img src="assets/img/default-avatar.jpg">
                    <div class="user_info">
                        <p>Test name</p>
                        <span>Hi this is a test message!</span>
                    </div>
                </a>
            </div>
        </section>
        <section class="all_users">
            
        </section>
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>