<?php

    $fields = [];
    $fields[] .= $_SESSION['uniqueID'];
    $fields[] .= $_SESSION['username'];

    $query = 'SELECT * FROM users WHERE uniqueID != ? AND username != ?;';
    $result = $db->selectQuery($query, $fields);
    
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

            $image = 'assets/img/default-avatar.jpg'; // default img
            if ($result[$i]['img'] != '') {
                $image = 'assets/uploads/' .$result[$i]['img'];
            }

            $users['data'] .= '<a href="chat.php?id='. $result[$i]['uniqueID'] .'" class="clickable_zone" id="user_contact"><img src="'. $image .'" width="50" height="50"><span>'. $name .'</span></a>';
            $users['type_of_data'] = "contacts";
        }

        echo json_encode($users);
        
    } else {
        echo json_encode('No friend yet :((((');
    }


