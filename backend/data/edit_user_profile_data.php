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
        $image = '/livechat/assets/img/default-avatar.jpg'; // default img
        if ($result['img'] != '') {
            $image = 'assets/uploads/' .$result['img'];
        }
       
        $user['data'] = 
        '
        <form id="formID" action="" method="post" enctype="multipart/form-data">
            <div class="error" id="error"></div>
            <div>
                <div>
                    <img src="'. $image .'" width="150" height="150" id="preview_img">
                </div>
                <label for="img" id="change_img_button" style="display: inline-block; cursor: pointer; padding: 5px 10px; border: 1px solid black; border-radius: 5px;">
                    Change Image
                </label>
                <input type="file" name="img" id="img" style="display: none;" onchange="preview_image(event)" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <div class="input_field">
                <label for="display_name">Tên hiển thị: </label>
                <textarea name="display_name" id="display_name" autocomplete="off">'. $result['display_name'] .'</textarea>
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

