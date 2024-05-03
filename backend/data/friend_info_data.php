<?php
    
    $fields = [];
    $fields[] .= $data->object_info->userid;

    $friend = [];
    $friend['info'] = null;
    $friend['messages'] = null;
    $name = '';

    // run db
    $query = "SELECT * FROM users WHERE userID = ? LIMIT 1;";
    $result = $db->selectQuery($query, $fields);

    // result will be an array.
    if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
        //print_r($result);
        $result = $result[0]; // take the first result

        if ($result['display_name'] != '') {
            $name = $result['display_name'];
        } else {
            $name = 'user#' .  $result['userID'];
        }

        $image = 'assets/img/default-avatar.jpg'; // default img
        if ($result['img'] != '') {
            $image = 'assets/uploads/' .$result['img'];
        }
        
        $friend['info'] .= '
        <a href="chat.php?id='. $result['userID'] .'" id="user_contact">
            <img src="'. $image .'">
            <div>
                <span>'. $name .'</span>
            </div>
        </a>';

        $friend['messages'] .= '
        
        
            
                 
            
        
    
        
        ';

        $friend['type_of_data'] = "friend_info";
        echo json_encode($friend);

    } else {
        echo 'Không tìm thấy tài khoản đó.';
    }
    