<?php
    $data = '
    <a href="#">
        <img src="assets/img/default-avatar.jpg">
        <div class="user_info">
            <p>Test name</p>
            <span>Hi this is a test message!</span>
        </div>
    </a>';
    //$result = $result[0]; // take the first result
    $result = [];
    $result['data'] = $data;
    $result['type_of_data'] = "preview_messages";
    echo json_encode($result);

    die;
    // if user have NO contact yet
    echo 'No contact yet!'; 
?>

