<?php 
    
    if (empty($data->username)) {
        echo 'Vui lòng nhập tên đăng nhập.';
    } else {
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $data->username)) {
            echo 'Tên đăng nhập phải không dấu, viết liền và không chứa ký tự đặc biệt.';
        } else {
            if (empty($data->password)) {
                echo 'Vui lòng nhập mật khẩu.';
            } else {

                // bỏ dữ liệu vào array

                $fields = []; // reset the array so no error
                $fields[] .= $data->username;

                // var_dump($fields);
                // die;

                // run db
                $query = "SELECT * FROM users WHERE username = ?;";
                $result = $db->selectQuery($query, $fields);

                // result will be an array.
                if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
                    //print_r($result);
                    $result = $result[0]; // take the first result
                    
                    if ($result['password'] != $data->password) {
                        echo 'Mật khẩu không chính xác.';
                    } else {
                        $_SESSION['uniqueID'] = $result['uniqueID'];
                        $_SESSION['username'] = $result['username'];
                        echo 'yes';
                    }

                } else {
                    echo 'Tài khoản không tồn tại.';
                }

            }
        }
    }

?>