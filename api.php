<?php
    // file that get the data sent by js
    // echoing what the js said
    
    session_start();

    $currentUserData = (Object)[];

    // // check if user login/ signup yet
    // if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {
    //     if ((isset($data->type_of_data)) && ($data->type_of_data != 'dangnhap')) {
    //         $currentUserData->isLoggedIn = false;
    //         echo (json_encode($currentUserData));
    //         die;
    //     }
    // }

    require_once 'classes/load.php';

    $db = new Database();

    $data_raw = file_get_contents("php://input");
    $data = json_decode($data_raw); // turns the string to obj again

    // đăng kí
    if ((isset($data->type_of_data)) && ($data->type_of_data == 'dangki')) {

        include 'data/dangki_data.php';
        // đăng nhập
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'dangnhap')) {

        include 'data/dangnhap_data.php';
        // đăng xuất
    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'dangxuat')) {

        include 'data/dangxuat_data.php';

    } else if ((isset($data->type_of_data)) && ($data->type_of_data == 'user_info')) {

        if (!isset($_SESSION['uniqueID']) && !isset($_SESSION['username'])) {

            $currentUserData->isLoggedIn = false; // user hase NOT logged in

            echo (json_encode($currentUserData)); // tell the chat.php that info

        } else {

            include 'data/user_info_data.php';
        }
    }

