<?php

    $fields = [];
    $fields[] .= $_SESSION['uniqueID'];
    $fields[] .= $_SESSION['username'];

    // run db
    $query = "SELECT * FROM users WHERE uniqueID = ? AND username = ? LIMIT 1;";
    $result = $db->selectQuery($query, $fields);

    $user = [];
    $user['data'] = null;

    // result will be an array.
    if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
        
        $result = $result[0];

        // check if image exist
        if ($result['img'] == '') {
            $image = 'assets/img/default-avatar.jpg';
        }
        $user['data'] = 
        '
        <div>
            <img src='. $image .' style="width: 150px; height: 150px;">
            <input type="button" name="changeImgBtn" id="changeImgBtn" value="Thay đổi hình ảnh" style="display: block;">
        </div>
        <form id="formID" action="" method="post">
            <div class="error" id="error"></div>
            <div class="input_field">
                <label for="display_name">Tên hiển thị: </label>
                <input type="text" name="display_name" id="display_name" autocomplete="off" value='. $result['display_name'] .'>
            </div>
            <div class="input_field">
                <label for="username">Tên tài khoản: </label>
                <input type="text" name="username" id="username" autocomplete="off" value='. $result['username'] .'>
            </div>
            <div class="input_field">
                <label for="username">Email: </label>
                <input type="email" name="email" id="email" autocomplete="off" value='. $result['email'] .'>
            </div>
            <div class="input_field">
                <input type="submit" name="submitBtn" id="submitBtn" value="Cập nhật">
            </div>
        </form>
            
        </div>

        <script>
            const submitBtn = document.getElementById("submitBtn");
            const form = document.getElementById("formID");
            const errorText = document.getElementById("error");

            submitBtn.addEventListener("click", function(e) {

                e.preventDefault();

                submitBtn.disabled = true;

                const email = document.getElementById("email");
                const username = document.getElementById("username");
                const password = document.getElementById("password");

                // collect data
                const data = {};
                data.email = email.value;
                data.username = username.value;
                data.password = password.value;

                //console.log(JSON.stringify(data));

                send_data(data, "dangki");
        
            });

            function send_data(data, type) {
                let xml = new XMLHttpRequest();

                xml.addEventListener("load", function() {
                    if (xml.readyState == 4 || xml.status == 200) { // everything good
                        
                        let message = xml.responseText;
                        if (message == "yes") {
                            alert("Tạo tài khoản thành công!");
                            // chuyển hướng qua trang khác
                            location.href = "chat.php";
                        } else {
                            errorText.textContent = message;
                            errorText.style.display = "block";
                        }
                        submitBtn.disabled = false; // after done sending the data, enable the button
                    }

                });

                // send data
                data.type_of_data = type;
                let data_string = JSON.stringify(data); // cannot send object so turn the obj to string
                xml.open("POST", "api.php", true);
                xml.send(data_string);
            }

        </script>

        ';
        $user['type_of_data'] = "edit_user_profile";
        echo json_encode($user);
        
    } else {
        echo 'ohhhhhh';
    }
?>

