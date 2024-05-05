<?php

    // check for unread messages
    $msgs = array();
    $me = $_SESSION['userID'];
    $sql = 'SELECT * FROM messages WHERE receiverID = "'. $me .'" AND received = "0";';
    $result = $db->selectQuery($sql, []);

    if (is_array($result) && count($result) > 0) {
        for ($i=0; $i < count($result); $i++) {
            $senderID = $result[$i]['senderID'];

            if (isset($msgs[$senderID])) {
                $msgs[$senderID] += 1;
            } else {
                $msgs[$senderID] = 1;
            }
            
        }
    }

    // collect messages

    $messages = [];
    $messages['data'] = null;
    
    $fields_user = [];
    // retrieve messages made with said user
    $fields_user[] .= $_SESSION['userID'];
    $fields_user[] .= $_SESSION['userID'];

    $fields_user[] .= $_SESSION['userID'];
    $fields_user[] .= $_SESSION['userID'];

    $fields_user[] .= $_SESSION['userID'];
    $fields_user[] .= $_SESSION['userID'];

    // biggggggg
    // explain:
    // show all the conversations that the user(me) has taken part in, from newest to oldest
    // and show the latest messages from each conversation, 
    // excluding the deleted messages
    // if user have new message or user send a new message, it will appear at the top
    $query_find_conversation = "SELECT * FROM messages WHERE (senderID = ? OR receiverID = ?) AND id IN (SELECT MAX(id) FROM messages WHERE (senderID = ? OR receiverID = ?) AND id NOT IN (SELECT id FROM messages WHERE (senderID = ? OR receiverID = ?) AND ((is_deleted_sender = '1' OR is_deleted_receiver = '1')) GROUP BY conversationID) GROUP BY conversationID) ORDER BY id DESC;";

    $result_find_conversation = $db->selectQuery($query_find_conversation, $fields_user);

    if (is_array($result_find_conversation) && count($result_find_conversation) > 0) {
        
            for ($i=0; $i < count($result_find_conversation); $i++) {

                $friend = $result_find_conversation[$i]['senderID'];
                if ($result_find_conversation[$i]['senderID'] == $_SESSION['userID']) {
                    $friend = $result_find_conversation[$i]['receiverID'];
                }
                $user_info = $db->getUser($friend);
                $user_info = $user_info[0];

                if ($user_info['display_name'] != '') {
                    $name = $user_info['display_name'];
                } else {
                    $name = 'user#' .  $user_info['userID'];
                }
        
                $image = 'assets/img/default-avatar.jpg'; // default img
                if ($user_info['img'] != '') {
                    $image = 'assets/uploads/' .$user_info['img'];
                }

                $message = $name .': '. $result_find_conversation[$i]['files'];
                    
                // we do a little comparing
                if ($result_find_conversation[$i]['senderID'] == $_SESSION['userID']) {
                    $message = 'Bạn: ' . $result_find_conversation[$i]['files'];
                }

                if ($result_find_conversation[$i]['message']) {
                    $message = $name .': '. $result_find_conversation[$i]['message'];
                    
                    // we do a little comparing
                    if ($result_find_conversation[$i]['senderID'] == $_SESSION['userID']) {
                        $message = 'Bạn: ' . $result_find_conversation[$i]['message'];
                    }
                }

                // unread messagees

                $messages['data'] .= '<a href="chat.php?id='. $user_info['userID'] .'" id="user_contact" class="user_contact" style="position: relative; overflow: hidden;"><div style="display: flex; align-item: center;"><img src="'. $image .'" width="50" height="50"><div class="details"><span>'. $name .'</span><p>'. $message .'</p></div></div>';

                if (count($msgs) > 0 && isset($msgs[$user_info['userID']])) {
                    $messages['data'] .= '<div style="width: 20px; height: 20px; border-radius: 50px; background-color: red; color: white; position: absolute; right: 0px;">'.$msgs[$user_info['userID']].'</div>';
                }

                $messages['data'] .= '</a>';

                $messages['type_of_data'] = 'preview_messages';
            }
            echo json_encode($messages);
    } else {
        $messages['data'] = '';
        $messages['type_of_data'] = 'preview_messages';
        echo json_encode($messages);
    }
