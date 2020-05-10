<?php
// connection function
function db_connect() { // host, username, password, dbname
    $result = new mysqli('localhost', 'root', '', 'store');
    if(!$result) {
        throw new Exception('Could not connect to db server');
    } else {
        return $result;
    }
}

// register function
function register($username, $email, $password, $phone, 
$uploaded_file, $street, $city, $state, $zip,
$name, $credit_number,$security)
{ 
    //connect to db
    $conn = db_connect();

    // check if username is unique 
    $result = $conn->query("SELECT * FROM customer WHERE username='".$username."'");
    if(!$result) {
        throw new Exception('Could not execute query');
    }
    
    if($result->num_rows>0){
        throw new Exception('That username is taken');
    } 

    // else put in db
    // insert customer table
    $query1 = "INSERT INTO customer(username, email, password, phone, photo)
    VALUES ('$username', '$email', sha1('".$password."'), '$phone', '$uploaded_file')";
    // $query1 = "INSERT INTO customer(username, email, password, phone)
    // VALUES ('$username', '$email', '$password', '$phone')";
    $result1 = $conn->query($query1);

    if(!$result1) {
        throw new Exception('Could not register query1 into db please try again later');
    }

    //insert address table
    $query2 = "INSERT INTO address(street, city, state, zip, username)
    VALUES ('$street', '$city', '$state', '$zip', '$username')";
    $result2 = $conn->query($query2);

    if(!$result2){
        throw new Exception('Could not register query2 into db please try again later');
    }

    //insert credit table
    $query3 = "INSERT INTO credit(name, credit_number, security, username)
    VALUES ( '$name', '$credit_number', '$security', '$username')";
    $result3 = $conn->query($query3);
    if(!$result3){
        throw new Exception('Could not register query3 into db please try again later');
    }

    // close connection
    $conn->close();
}

// login function
function login($username, $password) 
{
    // connect to db
    $conn = db_connect();

    // check if username is unique
    $result = $conn->query("SELECT * FROM customer WHERE 
    username='".$username."' AND password=sha1('".$password."')");
    // sha1 = 40 log & sha256 = 64
    if(!$result) {
        throw new Exception('user is used already');
        exit;
    }

    if($result->num_rows>0) {
        return true;
    } else {
        throw new Exception('could not log you in, You are not in the db');
        exit;
    }
    // close connection
    $conn->close();
}
?>