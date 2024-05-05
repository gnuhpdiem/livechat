<?php

    session_start();

    $currentUserData = (Object)[];

    require_once __DIR__ . '/classes/load.php';

    $db = new Database();  // to use for all the include files

    $data_raw = file_get_contents("php://input");
    $data = json_decode($data_raw); // turns the string to obj again

    $isLoggedIn = isset($_SESSION['userID']) && isset($_SESSION['username']);  // user logged in or not

    if (!$isLoggedIn) {
        $currentUserData->isLoggedIn = false;
        echo json_encode($currentUserData);
    } else {
        // do things
        $images = [];
        //$images['data'] = null;

        $type_of_data = '';
        if (isset($_POST['type_of_data'])) {
            $type_of_data = $_POST['type_of_data'];
        }

        $destination = '';
        if(isset($_FILES['data']) && !empty($_FILES['data']['name'])) { // nếu chọn file nào đó

            $allowed = [];
            $allowed[] .= "image/jpeg";
            $allowed[] .= "image/jpg";
            $allowed[] .= "image/png";

            if ($_FILES['data']['error'] == 0 && in_array($_FILES['data']['type'], $allowed)) {

                // gooooooooooooooooooooo
                $uploadDir = __DIR__ . '/../assets/uploads/';

                // create a folder name uploads to chứa hình nếu folder không tồn tại
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // đổi tên file
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $newFileName = date('Ymd_His') . '_' . $_FILES['data']['name']; //20240429_230102_picture.jpg

                // di chuyển từ tmp vô uploads
                $destination = $uploadDir . $newFileName;
                move_uploaded_file($_FILES['data']['tmp_name'], $destination);
                //echo json_encode('Đổi hình thành công.');
                $images['type_of_data'] = $type_of_data;
            }
        }

        if ($type_of_data == 'change_profile_image') {  // if user want to change profile img
            if (!empty($destination)) {

                $fields = [];
                $fields[] .= $newFileName;
                $fields[] .= $_SESSION['userID'];
                $fields[] .= $_SESSION['username'];

                $query = "UPDATE users
                            SET img = ?
                            WHERE userID = ? AND username = ? LIMIT 1;";

                $result = $db->makeQuery($query, $fields);
                if ($result) {
                    echo 'yes';
                } else {
                    echo 'no';
                }
            }
        } else if ($type_of_data == 'send_file') {

            // $_SESSION['userID'];
            // $_POST['userID'];
            $fields_message = [];

            $fields_user = [];
            $fields_user[] .= $_SESSION['userID'];
            $fields_user[] .= $_POST['userID'];
            $fields_user[] .= $_POST['userID'];
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
            $fields_message[] .= addslashes($_POST['userID']);  // who recieve
            $fields_message[] .= '';  // send what
            $fields_message[] .= $newFileName;  // send what file
            $fields_message[] .= date("Y-m-d H:i:s");  // when

            // the main one
            $query_message = "INSERT INTO messages
                        (conversationID, senderID, receiverID, message, files, created_at)
                        VALUES (?, ?, ?, ?, ?, ?);";
            
            $result_message = $db->makeQuery($query_message, $fields_message);


            if ($result_message) {
                echo 'sent';
            } else {
                echo 'no';
            }
        }

        
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
    
