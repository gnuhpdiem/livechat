<?php
    
    $fields = [];
    if (empty($data->object_info->userid)) {
        $fields[] .= '';
    } else {
        $fields[] .= $data->object_info->userid;
    }

    $friend = [];
    $friend['info'] = null;
    $friend['messages'] = null;
    $name = '';
    $fields_user = [];

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

        // retrieve messages made with said user
        $fields_user[] .= $_SESSION['userID'];
        $fields_user[] .= $fields[0];
        $fields_user[] .= $fields[0];
        $fields_user[] .= $_SESSION['userID'];

        $query_find_conversation = "SELECT * FROM messages WHERE (senderID = ? AND receiverID = ?) OR (senderID = ? AND receiverID = ?) ORDER BY id desc;";
        $result_find_conversation = $db->selectQuery($query_find_conversation, $fields_user);

        if (is_array($result_find_conversation) && count($result_find_conversation) > 0) {
            $result_find_conversation = array_reverse($result_find_conversation);
                for ($i=0; $i < count($result_find_conversation); $i++) {

                    $user_info = $db->getUser($result_find_conversation[$i]['senderID']);
                    $user_info = $user_info[0];

                    if ($user_info['display_name'] != '') {
                        $name = $user_info['display_name'];
                    } else {
                        $name = 'user#' .  $user_info['userID'];
                    }
            
                    $image = 'assets/img/default-avatar.jpg'; // default img
                    if ($user_info['img'] != '') {
                        $image = 'assets/uploads/' .$user_info['img'];
                    }

                    if ($result_find_conversation[$i]['senderID'] == $_SESSION['userID']) {  // sender is me
                        $friend['messages'] .= right_message($result_find_conversation[$i]['message'], $result_find_conversation[$i]['created_at']);
                    } else {
                        $friend['messages'] .= left_message($result_find_conversation[$i]['message'], $image, $result_find_conversation[$i]['created_at']);
                    }
                                  
                    
                    
                }
        }

        //$friend['messages'] .= '';

        $friend['type_of_data'] = "friend_info";
        echo json_encode($friend);

    } else {
        echo 'Không tìm thấy tài khoản đó.';
    }
    