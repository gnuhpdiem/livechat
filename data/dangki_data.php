<?php 
    
    if (empty($data->email)) {
        echo 'Vui lòng nhập email.';
    } else {
        if (!preg_match("/^[a-zA-Z]\w+@[a-z]+(\.[a-z]+)+/", $data->email)) {
            echo 'Vui lòng nhập địa chỉ email hợp lệ.';
        } else {
            if (empty($data->username)) {
                echo 'Vui lòng nhập tên đăng nhập.';
            } else {
                // check username đã có chưa
                if (is_exist($data->username)) {
                    echo 'Tên tài khoản đã tồn tại.';
                } else {
                    if (!preg_match("/^[a-zA-Z0-9_]+$/", $data->username)) {
                        echo 'Tên đăng nhập phải không dấu, viết liền và không chứa ký tự đặc biệt.';
                    } else {
                        if (empty($data->password)) {
                            echo 'Vui lòng nhập mật khẩu.';
                        } else {

                            $hashedPass = password_hash($data->password, PASSWORD_DEFAULT);
    
                            // bỏ dữ liệu vào array
                            date_default_timezone_set('Asia/Ho_Chi_Minh'); // set thành múi h đúng
    
                            $fields = []; // reset the array so no error
                            $fields[] .= $db->generateID(10);
                            $fields[] .= $data->username;
                            $fields[] .= $data->email;
                            $fields[] .= $hashedPass;
                            $fields[] .= date("Y-m-d H:i:s");
    
                            // var_dump($fields);
                            // die;
    
                            // run db
                            $query = "INSERT INTO users (uniqueID, username, email, `password`, created_at)
                                    VALUES (?, ?, ?, ?, ?);";
                            $result = $db->makeQuery($query, $fields);
    
                            if ($result) {
                                $_SESSION['uniqueID'] = $fields[0];
                                $_SESSION['username'] = $fields[1];
                                echo 'yes';
                            } else {
                                echo 'no';
                            }
    
                        }
                    }
                }
            }
        }
    }

    function is_exist($name) {
        
        $nameArray = [];
        $nameArray[] .= $name;
        $db = new Database();

        $querySelect = "SELECT * FROM users WHERE username = ?;";
        $resultSelect = $db->selectQuery($querySelect, $nameArray);

        // result will be an array.
        if (is_array($resultSelect) && count($resultSelect) > 0) {
            return true;
        } else {
            return false;
        }
    }

