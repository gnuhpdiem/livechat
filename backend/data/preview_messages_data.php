<?php
    

    $dataMssg = $data->object_info->id;
    //$result = $result[0]; // take the first result
    $result = [];
    $result['data'] = $dataMssg;
    $result['type_of_data'] = "preview_messages";
    echo json_encode($result);

    die;
    // if user have NO contact yet
    echo 'No contact yet!'; 
?>

