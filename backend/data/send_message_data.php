<?php

    // khai báo
    $fields_message = [];
    $fields_user = [];

    // db run # 1
    // find to see if the user exist
    $fields_find_receiver = [];
    $fields_find_receiver[] .= $data->userid;

    // run db
    $query = "SELECT * FROM users WHERE userID = ? LIMIT 1;";
    $result_find_receiver = $db->selectQuery($query, $fields_find_receiver);

    // result_find_receiver will be an array.
    if (is_array($result_find_receiver) && count($result_find_receiver) > 0) { // nếu có trả về kết quả

        // db run # 2        
        $fields_user[] .= $_SESSION['userID'];
        $fields_user[] .= $fields_find_receiver[0];
        $fields_user[] .= $fields_find_receiver[0];
        $fields_user[] .= $_SESSION['userID'];

        $query_find_conversation = "SELECT * FROM messages WHERE (senderID = ? AND receiverID = ?) OR (senderID = ? AND receiverID = ?) LIMIT 1;";
        $result_find_conversation = $db->selectQuery($query_find_conversation, $fields_user);

        // result_find_conversation will be an array.
        if (is_array($result_find_conversation) && count($result_find_conversation) > 0) { 
            // if already exist a conversation, then take that conversationID
            $result_find_conversation = $result_find_conversation[0]; // take the first result
            $fields_message[] .= $result_find_conversation['conversationID']; // take the existing conversationID
        } else {
            // generate a new conversationID
            $fields_message[] .= generateRandomString(50);
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh'); // set thành múi h đúng

        // db run # 3
        $fields_message[] .= $_SESSION['userID'];  // who send
        $fields_message[] .= $fields_find_receiver[0];  // who recieve
        $fields_message[] .= $data->message;  // send what
        $fields_message[] .= date("Y-m-d H:i:s");  // when

        // the main one
        $query_message = "INSERT INTO messages
                    (conversationID, senderID, receiverID, message, created_at)
                    VALUES (?, ?, ?, ?, ?);";
        
        $result_message = $db->makeQuery($query_message, $fields_message);


        if ($result_message) {
            echo 'sent';
        } else {
            echo 'no';
        }

    } else {
        echo 'Không tìm thấy tài khoản đó.';
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }