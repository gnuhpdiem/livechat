<?php 

    $currentUserData = [];

    if (isset($_SESSION['uniqueID']))
        unset($_SESSION['uniqueID']);
    if (isset($_SESSION['username']))
        unset($_SESSION['username']);

    session_destroy();

    $currentUserData['isLoggedIn'] = false;
    echo json_encode($currentUserData);

