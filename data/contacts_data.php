<?php
    $query = 'SELECT * FROM users;';
    $result = $db->selectQuery($query, []);
    

    $users = [];
    $users['data'] = null;

    // result will be an array.
    if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
        
        for ($i = 0; $i < count($result); $i++) {
            $users['data'] .= '<a href="chat.php?id='. $result[$i]['uniqueID'] .'"><img src="assets/img/default-avatar.jpg"><span>'. $result[$i]['username'] .'</span></a>';
            $users['type_of_data'] = "contacts";

        }

        echo json_encode($users);
        
    } else {
        echo 'No friend yet :((((';
    }


