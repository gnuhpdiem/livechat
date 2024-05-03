<?php 

    $currentUserData = [];

    if (isset($_SESSION['userID']))
        unset($_SESSION['userID']);
    if (isset($_SESSION['username']))
        unset($_SESSION['username']);

    session_destroy();

    $currentUserData['isLoggedIn'] = false;
    echo json_encode($currentUserData);

