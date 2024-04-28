<?php
    if ($data->display_name != "" && (!preg_match("/^[^\r\n].*/", $data->display_name))) {
        echo 'Tên không được xuống dòng.';
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
                    if (empty($data->email)) {
                        echo 'Vui lòng nhập email.';
                    } else {
                        if (!preg_match("/^[a-zA-Z]\w+@[a-z]+(\.[a-z]+)+/", $data->email)) {
                            echo 'Vui lòng nhập địa chỉ email hợp lệ.';
                        } else {
                            // prepare query
                            $queryUpdate = "UPDATE users
                                        SET
                                            display_name = ?,
                                            username = ?,
                                            email = ?
                                        WHERE uniqueID = ?";
                            // bind
                            $fieldsUpdate = []; // reset the array so no error
                            $fieldsUpdate[] .= $data->display_name;
                            $fieldsUpdate[] .= $data->username;
                            $fieldsUpdate[] .= $data->email;
                            $fieldsUpdate[] .= $_SESSION['uniqueID'];
                            // update
                            $resultUpdate = $db->makeQuery($queryUpdate, $fieldsUpdate);
                            if ($resultUpdate) {
                                //rebind value
                                $_SESSION['username'] = $fieldsUpdate[1];
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
        $nameArray[] .= $_SESSION['username'];
        $db = new Database();

        $querySelect = "SELECT * FROM users WHERE username = ? AND NOT username = ?;";
        $resultSelect = $db->selectQuery($querySelect, $nameArray);

        // result will be an array.
        if (is_array($resultSelect) && count($resultSelect) > 0) {
            return true;
        } else {
            return false;
        }
    }