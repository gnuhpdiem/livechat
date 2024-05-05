<?php

    // khai báo
    $fields_message = [];
    $fields_user = [];

    // FIND MESSAGE CẦN XÓA
    $fields_message[] .= $data->message_id;

    $query_message = 'SELECT * FROM messages WHERE id = ? LIMIT 1;';
    $result_message = $db->selectQuery($query_message, $fields_message);

    if (is_array($result_message) && count($result_message) > 0) {

        // take the first result
        $result_message = $result_message[0];

        // prepare the fields
        $arr = [];
        $arr[] .= '1';
        $arr[] .= $fields_message[0];

        // user is the one who sent the message
        if ($result_message['senderID'] == $_SESSION['userID']) {

            $sql = 'UPDATE messages SET is_deleted_sender = ? WHERE id = ?;';
            $result = $db->makeQuery($sql, $arr);
        }

        // user is the one who received the message
        if ($result_message['receiverID'] == $_SESSION['userID']) {

            $sql = 'UPDATE messages SET is_deleted_receiver = ? WHERE id = ?;';
            $result = $db->makeQuery($sql, $arr);
        }

        if ($result) {
            echo 'deleted';
        } else {
            echo 'no';
        }

    } else {
        echo 'Tin nhắn không tồn tại.';
    }