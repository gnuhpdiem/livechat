<?php
    session_start();

    $currentUserData = (Object)[];


    require_once __DIR__ . '/classes/load.php';

    $db = new Database();  // to use for all the include files

    $data_raw = file_get_contents("php://input");
    $data = json_decode($data_raw); // turns the string to obj again

    if (isset($data->type_of_data)) {
        $type_of_data = $data->type_of_data;
        $isLoggedIn = isset($_SESSION['uniqueID']) && isset($_SESSION['username']);

        switch ($type_of_data) {
            case 'dangki':
            case 'dangnhap':
            case 'dangxuat':
            case 'preview_messages':
                include __DIR__ . '/data/'.$type_of_data.'_data.php';
                break;
            
            case 'user_info':
            case 'contacts':
            case 'user_profile':
            case 'edit_user_profile':
            case 'update_profile':
            case 'change_password':
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
