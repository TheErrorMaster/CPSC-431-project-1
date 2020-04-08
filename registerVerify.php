<?php 
// include files
require_once('query.php');
require_once('validation.php');

if(isset($_POST["submit"])){ // when submit is pressed
    // initial variables
    $username = validUser($_POST["username"],"username");
    $email = validEmail($_POST["email"]); 
    $password = validUser($_POST["password"],"password");
    $phone = validNumber($_POST["phone"]);

    $street = validString($_POST["street"]);
    $city = validString($_POST["city"]);
    $state = validString($_POST["state"]);
    $zip = validNumber($_POST["zip"]);

    $name = validString($_POST["name"]);
    $credit_number = validNumber($_POST["credit_number"]);
    $security = validNumber($_POST["security"]);

    // register here but function will be in a other file
    register($username, $email, $password, $phone,
    $street, $city, $state, $zip,
    $name, $credit_number, $security);

    session_start();
    $_SESSION['valid_user'] = $username;
    header( 'Location: home.php');
}
?>