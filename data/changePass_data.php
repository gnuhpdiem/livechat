<?php
    if (empty($data->currentPass)) {
        echo 'Vui lòng nhập mật khẩu hiện tại.';
    } else {
        if (empty($data->newPass)) {
            echo 'Vui lòng nhập mật khẩu mới.';
        } else {
            // bỏ dữ liệu vào array

            $fields = []; // reset the array so no error
            $fields[] .= $_SESSION['username'];

            // var_dump($fields);
            // die;

            // run db
            $query = "SELECT * FROM users WHERE username = ?;";
            $result = $db->selectQuery($query, $fields);

            // result will be an array.
            if (is_array($result) && count($result) > 0) { // nếu có trả về kết quả
                //print_r($result);
                $result = $result[0]; // take the first result

                $passHashed = $result['password'];
                
                if (!password_verify($data->currentPass, $passHashed)) {  // kiểm tra mật khẩu
                    echo 'Mật khẩu hiện tại không chính xác.';
                } else {
                    // prepare query
                    $queryUpdate = "UPDATE users
                                    SET `password`= ?
                                    WHERE username = ?";
        
                    
                    // hash the new pass
                    $hashedPass = password_hash($data->newPass, PASSWORD_DEFAULT); 

                    // bind
                    $fieldsUpdate = []; // reset the array so no error
                    $fieldsUpdate[] .= $hashedPass;
                    $fieldsUpdate[] .= $_SESSION['username'];

                    // update the pass
                    $resultUpdate = $db->makeQuery($queryUpdate, $fieldsUpdate);
                    if ($resultUpdate) {
                        echo 'yes';
                    } else {
                        echo 'no';
                    }
                }

            } else {
                echo 'Tài khoản không tồn tại.';
            }
        }
    }