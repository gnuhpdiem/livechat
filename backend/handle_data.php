<?php
    session_start();

    $currentUserData = (Object)[];


    require_once __DIR__ . '/classes/load.php';

    $db = new Database();  // to use for all the include files

    $data_raw = file_get_contents("php://input");
    $data = json_decode($data_raw); // turns the string to obj again

    if (isset($data->type_of_data)) {
        $type_of_data = $data->type_of_data;
        $isLoggedIn = isset($_SESSION['userID']) && isset($_SESSION['username']);

        switch ($type_of_data) {
            case 'dangki':
            case 'dangnhap':
            case 'dangxuat':
                include __DIR__ . '/data/'.$type_of_data.'_data.php';
                break;
            
            case 'user_info':
            case 'contacts':
            case 'user_profile':
            case 'edit_user_profile':
            case 'update_profile':
            case 'change_password':
            case 'friend_info':
            case 'send_message':
            case 'preview_messages':
            case 'delete_message':
            case 'delete_conversation':
                if (!$isLoggedIn) {
                    $currentUserData->isLoggedIn = false;
                    echo json_encode($currentUserData);
                } else {
                    include __DIR__ . '/data/'.$type_of_data.'_data.php';
                }
                break;
            default:
                # some err0or messages...
                break;
        }
    }

    function left_message($id, $message, $image, $date_send) {
        return '<div id="message_left"><img src="'. $image .'"><p>' . $message . '</p><span>'. date("d/m/Y H:i", strtotime($date_send)) .'</span><span onclick="delete_message(event)" msg_id='. $id .'>Trash</span></div>';
    }

    function right_message($id, $message, $date_send, $received, $seen) {

        $status = '';
        if ($seen) {
            $status = 'seen';
        } elseif ($received) {
            $status = 'received';
        }
        
        return
        '<div id="message_right">
            <span>'. date("d/m/Y H:i", strtotime($date_send)) .'</span>
            <p>' . $message . '</p>
            <div><span>'. $status . '</span><span onclick="delete_message(event)" msg_id='. $id .'>Trash</span></div>
        </div>';
    }

    