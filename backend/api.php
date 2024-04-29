<?php
    // file that get the data sent by js
    // echoing what the js said
    
    session_start();

    $currentUserData = (Object)[];


    require_once __DIR__ . '/classes/load.php';

    $db = new Database();  // to use for all the include files

    $data_raw = file_get_contents("php://input");
    $data = json_decode($data_raw); // turns the string to obj again

    // đăng kí
    if ((isset($data->type_of_data)) && ($data->type_of_data == 'dangki')) {

        include __DIR__ . '/data/dangki_data.php';
        // đăng nhập
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'dangnhap')) {

        include __DIR__ . '/data/dangnhap_data.php';
        // đăng xuất
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'dangxuat')) {

        include __DIR__ . '/data/dangxuat_data.php';

    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'user_info')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the chat.php that info

        } else {

            include __DIR__ . '/data/user_info_data.php';
        }
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'contacts')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the contacts.php that info

        } else {
            include __DIR__ . '/data/contacts_data.php';
        }
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'preview_messages')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the preview_messages.php that info

        } else {
            include __DIR__ . '/data/preview_messages_data.php';
        }
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'edit_user_profile')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the settings.php that info

        } else {
            include __DIR__ . '/data/edit_user_profile_data.php';
        }
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'user_profile')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the user_profile.php that info

        } else {
            include __DIR__ . '/data/user_profile_data.php';
        }
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'update_profile')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the user_profile.php that info

        } else {
            include __DIR__ . '/data/update_user_profile_data.php';
        }
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'changePass')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the user_profile.php that info

        } else {
            include __DIR__ . '/data/changePass_data.php';
        }
    }