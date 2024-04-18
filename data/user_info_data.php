<?php 
    
    $fields = [];
    $fields[] .= $_SESSION['uniqueID'];
    $fields[] .= $_SESSION['username'];

    // run db
    $query = "SELECT * FROM users WHERE uniqueID = ? AND username = ? LIMIT 1;";
    $result = $db->selectQuery($query, $fields);

    // result will be an array.
    if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
        //print_r($result);
        $result = $result[0]; // take the first result
        $result['type_of_data'] = "user_info";
        echo json_encode($result);

    } else {
        echo 'Tài khoản không tồn tại.';
    }

?>