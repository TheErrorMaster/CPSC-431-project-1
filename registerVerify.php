<?php 
// include files
require_once('query.php');
require_once('validation.php');

if(isset($_POST["submit"])){ // when submit is pressed
    // account detail
    $username = validUser($_POST["username"],"username");
    $email = validEmail($_POST["email"]); 
    $password = validUser($_POST["password"],"password");
    $phone = validNumber($_POST["phone"]);
    // upload picture
    $file = $_FILES['fileToUpload'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
    $fileError = $_FILES['fileToUpload']['error'];
    $fileType = $_FILES['fileToUpload']['type'];// Gets the ext of file

    //if there is a error then display error sign
    if($fileError > 0){ 
        echo 'Problem: ';
        switch ($fileError) {
            case 1:
                echo 'File exceed upload_max_file_size.';
                break;
            case 2:
                echo 'File exceed max_file_size';
                break;
            case 3: 
                echo 'File only partially uploaded.';
            break;
            case 4: 
                echo 'No file uploaded.';
            break;
            case 6:
                echo 'Cannot upload file: No temp directory specified.';
            break;
            case 7: 
                echo 'Upload failed: Cannot write to disk';
            break;
            case 8: 
                echo 'A PHP extension blocked the file upload';
            break;
            default:
                break;
        }
    } 

    $uploaded_file = "photo/$fileName";

    if(is_uploaded_file($fileTmpName)){
        if(!move_uploaded_file($fileTmpName,$uploaded_file)){
            echo 'Problem: Could not move file to destination directory';
            exit;
        }
    }

    // this checks if the file extension is correct
    if($fileType != 'image/jpeg' && $fileType != 'image/png'){
        echo 'Problem: file is not a PNG image or a JPEG: ';
        exit;
    } 
    // address
    $street = validString($_POST["street"]);
    $city = validString($_POST["city"]);
    $state = validString($_POST["state"]);
    $zip = validNumber($_POST["zip"]);
    // credit info
    $name = validString($_POST["name"]);
    $credit_number = validNumber($_POST["credit_number"]);
    $security = validNumber($_POST["security"]);

    // register here but function will be in a other file
    register($username, $email, $password, $phone,
    $uploaded_file, $street, $city, $state, $zip,
    $name, $credit_number, $security);

    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['photo'] = $fileName;
    header( 'Location: home.php');
}
?>