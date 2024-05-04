<?php
    $messages = [];
    $messages['data'] = null;

    
    $fields_user = [];
    // retrieve messages made with said user
    $fields_user[] .= $_SESSION['userID'];
    $fields_user[] .= $_SESSION['userID'];

    $query_find_conversation = "SELECT * FROM messages WHERE senderID = ? OR receiverID = ? GROUP BY conversationID ORDER BY id desc;";
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

                // show the last messages and the sender name
                $message = $name . ': ' . $result_find_conversation[$i]['message'];
                if ($result_find_conversation[$i]['senderID'] == $_SESSION['userID']) {
                    $message = 'Bạn: ' . $result_find_conversation[$i]['message'];
                }

                $messages['data'] .= '<a href="chat.php?id='. $user_info['userID'] .'" class="clickable_zone" id="user_contact"><img src="'. $image .'" width="50" height="50"><div><span>'. $name .'</span><p>'. $message .'</p></div></a>';

                $messages['type_of_data'] = "preview_messages";
            }

            echo json_encode($messages);
    }