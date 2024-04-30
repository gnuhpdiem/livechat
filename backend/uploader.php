<?php

    session_start();

    $currentUserData = (Object)[];

    require_once __DIR__ . '/classes/load.php';

    $db = new Database();  // to use for all the include files

    $data_raw = file_get_contents("php://input");
    $data = json_decode($data_raw); // turns the string to obj again

    $isLoggedIn = isset($_SESSION['uniqueID']) && isset($_SESSION['username']);  // user logged in or not

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
            if ($_FILES['data']['error'] == 0) {

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
                $fields[] .= $_SESSION['uniqueID'];
                $fields[] .= $_SESSION['username'];

                $query = "UPDATE users
                            SET img = ?
                            WHERE uniqueID = ? AND username = ? LIMIT 1;";

                $result = $db->makeQuery($query, $fields);
                if ($result) {
                    echo 'yes';
                } else {
                    echo 'no';
                }
            }
        }
    }
    
