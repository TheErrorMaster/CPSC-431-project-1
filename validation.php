<?php
// checks if its empty and takes out stuff 
function validString($string) {
    // if string is empty return false
    if(empty($string)) {throw new Exception('Please fill out form');}
    $string = trim($string);// remove whitespace
    $string = stripslashes($string); // removes backslash
    $string = htmlspecialchars($string); // converst < > into HTML entities
    return $string;
}

// checks if their is numbers
function validNumber($num) {
    validString($num);
    if(!preg_match('/^[0-9]+$/', $num)){
        throw new Exception('Numbers only');
    }
    return $num;
}

// checks if choice has starts with at least one 
// letters,numbers, underscore, dot 
// And at least 6 to 30 char that are letters \w
function validUser($user,$choice) {
    validString($user);
    if(!preg_match('/^[a-zA-Z0-9_.]+$/', $user)){
        throw new Exception($choice.' not a valid input');
    }
    if((strlen($user) < 6) || (strlen($user) > 30)){
        throw new Exception($choice.' must be between 6 and 30 characters');
    }
    return $user;
}

// checks
function validEmail($email) {
    if(!preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $email)){
        throw new Exception('not a valid email');
    }
    return $email;
}
?>