<?php 
    
    $fields = [];
    $fields[] .= $_SESSION['userID'];
    $fields[] .= $_SESSION['username'];

    // run db
    $query = "SELECT * FROM users WHERE userID = ? AND username = ? LIMIT 1;";
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
        <table style="width: 100%;">
            <tr>
                <td>
                    <img src="'. $image .'" width="200" height="200">
                </td>
                <td>
                    <table style="width: 100%;">
                        <tr>
                            <td>Tên hiển thị:</td>
                            <td>'. $result['display_name'] .'</td>
                        </tr>
                        <tr>
                            <td>Tên đăng nhập:</td>
                            <td>'. $result['username'] .'</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>'. $result['email'] .'</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        ';
        $user['type_of_data'] = "user_profile";
        echo json_encode($user);
        
    } else {
        echo 'Lỗi';
    }
