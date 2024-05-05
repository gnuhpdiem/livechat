<?php

    $arr = [];
    $arr[] .= $_SESSION['userID'];
    $arr[] .= $data->userid;
    $arr[] .= $data->userid;
    $arr[] .= $_SESSION['userID'];

    $array = [];
    
    
    $sql = "SELECT * FROM messages WHERE (senderID = ? AND receiverID = ?) OR (senderID = ? AND receiverID = ?);";
    $result = $db->selectQuery($sql, $arr);
    if (is_array($result) && count($result) > 0) {
        for ($i = 0; $i < count($result); $i ++) {
           
            // user is the one who sent the message
            if ($result[$i]['senderID'] == $_SESSION['userID']) {

                $sql = 'UPDATE messages SET is_deleted_sender = "1" WHERE id = '.$result[$i]['id'].';';
                $result1 = $db->makeQuery($sql);
            }

            // user is the one who received the message
            if ($result[$i]['receiverID'] == $_SESSION['userID']) {

                $sql = 'UPDATE messages SET is_deleted_receiver = "1" WHERE id = '.$result[$i]['id'].';';
                $result2 = $db->makeQuery($sql);
            }

        }
        echo 'rip';
    } else {
        echo 'no';
    }
    