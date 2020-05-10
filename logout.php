<?php 
    session_start();
    $old = $_SESSION['name'];

    unset($_SESSION['name']);
    $result = session_destroy();
    header( 'Location: index.html');
    if(!empty($old)){
        if($result) {
            header( 'Location: index.html'); // login again 
        } else {
            echo "Could not log you out";
            header("location: error.html");
        }
    } else {
        echo 'you were not logged in.';
        header( 'Location: index.html');
    }
?>