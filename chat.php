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
                    <li class="tooltip"><a href="chat.php" class="tooltip"><i class="fa fa-commenting-o" aria-hidden="true"></i><span>Chat</span></a></li>
                    <li class="tooltip"><a href="contacts.php"><i class="fa fa-address-book-o" aria-hidden="true"></i><span>Contacts</span></a></li>
                    <li class="tooltip"><a href="settings.php" class="tooltip"><i class="fa fa-cog" aria-hidden="true"></i><span>Settings</span></a></li>
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
    <script>
        
        // function to get an obj and its type
        function get_data(find_object, type) {
            
            let data = {};
            let xml = new XMLHttpRequest();

            xml.addEventListener("load", function() {
                if (xml.readyState == 4 || xml.status == 200) { // everything good
                    let obj = JSON.parse(xml.responseText);
                    if (typeof(obj.isLoggedIn) != "undefined" && !obj.isLoggedIn) { // chat.php see the info from the api {user has NOT logged in}
                        location.href = "index.php"; // go to login page
                    } else {
                        switch(obj.type_of_data) {
                            case "user_info":
                                let username = document.getElementById("username");
                                if (obj.display_name == null) {
                                    username.innerHTML = 'user#' + obj.uniqueID;
                                } else {
                                    username.innerHTML = obj.display_name;
                                }
                                break;
                        }
                    }
                }
            });

            
            data.object_info = find_object; // is an obj in an obj
            data.type_of_data = type;
            // get data
            
            let data_string = JSON.stringify(data); // turns to string
            xml.open("POST", "api.php", true);
            xml.send(data_string);
        }

        get_data({}, "user_info"); // get fire when user comes --> tp check if user logged in yet

        const dangxuatBtn = document.getElementById("dangxuatBtn");
        dangxuatBtn.addEventListener("click", function() {
            // make a alert asking if the user is sure
            let answer = confirm("Bạn có chắc chắn bạn muốn đăng xuất không?");
            if (answer) {
                get_data({}, "dangxuat");
            }
        });

    </script>
</body>
</html>