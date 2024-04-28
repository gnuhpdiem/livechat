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
                <input type="submit" name="submitBtn" id="submitBtn" value="Cập nhật" onclick="collect_data(event)">
            </div>
        </form>
            
        </div>

        ';
        $user['type_of_data'] = "edit_user_profile";
        echo json_encode($user);
        
    } else {
        echo 'ohhhhhh';
    }
?>

