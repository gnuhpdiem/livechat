<?php

    session_start();
    require_once __DIR__ . '/classes/load.php';

    $db = new Database();  // to use for all the include files

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
            $newFileName = date('Ymd_His') . '_' . $_FILES['data']['name']; //20240429_230102_profilepic.jpg

            // di chuyển từ tmp vô uploads
            $destination = $uploadDir . $newFileName;
            move_uploaded_file($_FILES['data']['tmp_name'], $destination);
            echo 'Đổi hình thành công.';
        }
    }

    $type_of_data = '';
    if (isset($_POST['type_of_data'])) {
        $type_of_data = $_POST['type_of_data'];
    }

    if ($type_of_data == 'change_profile_image') {  // if user want to change profile img
        if (!empty($destination)) {
            // save to database
            $query = "";

        }
    }
