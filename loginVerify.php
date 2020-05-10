<?php
// include files
require_once('query.php');
require_once('validation.php');

if(isset($_POST["submit"])){ // when subit is pressed
// assign variables   
$username = validUser($_POST["username"],"username");
$password = validUser($_POST["password"],"password");

login($username, $password);

// if login: start session 
session_start();

$conn = db_connect();


$query = "SELECT name FROM credit 
WHERE username='$username'";

$query2 = "SELECT photo FROM customer 
WHERE username='$username'";

// check if username is unique
$result = $conn->query($query);
if(!$result) {
    throw new Exception("db does not work");
    exit;
}

if($row= $result->fetch_row()) {
    $_SESSION['name'] = $row[0];
}

$result2 = $conn->query($query2);
if(!$result2) {
    throw new Exception("db does not work");
    exit;
}

if($row= $result2->fetch_row()) {
    $_SESSION['photo'] = $row[0];
}
// close connection
$conn->close();

$_SESSION['cart'] = array();
// move to home.php
header( 'Location: home.php');
}
?>