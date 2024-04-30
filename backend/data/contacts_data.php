<?php
    $query = 'SELECT * FROM users;';
    $result = $db->selectQuery($query, []);
    

    $users = [];
    $users['data'] = null;
    $name = '';

    // result will be an array.
    if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
        
        for ($i = 0; $i < count($result); $i++) {
            if ($result[$i]['display_name'] != '') {
                $name = $result[$i]['display_name'];
            } else {
                $name = 'user#' .  $result[$i]['uniqueID'];
            }

            $image = '/livechat/assets/img/default-avatar.jpg'; // default img
            if ($result[$i]['img'] != '') {
                $image = 'assets/uploads/' .$result[$i]['img'];
            }

            $users['data'] .= '<a href="chat.php?id='. $result[$i]['uniqueID'] .'"><img src="'. $image .'"><span>'. $name .'</span></a>';
            $users['type_of_data'] = "contacts";
        }

        echo json_encode($users);
        
    } else {
        echo json_encode('No friend yet :((((');
    }


