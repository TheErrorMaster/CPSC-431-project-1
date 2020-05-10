<?php
require_once("query.php");
session_start();
// only users are allowed if not they go to errorpage
if(!isset($_SESSION['name']))
{
    echo "sorry log in";
    header("location: error.html");
}
$name = $_SESSION['name'];
$photo = $_SESSION['photo'];
$id = $_POST['recordID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<!-- nav bar -->
<nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="#" class="navbar-brand">
            <img src="Humor.PNG" height="50" alt="Humor.ly ">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#"><?php echo "Hello $name"; ?></a>
                </li>
                <li class="nav-item">
                    <img src="<?php echo"$photo"; ?>" height="50" alt="Humor.ly" class="rounded-circle">
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Continue Shopping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="checkout.php">Checkout</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-item nav-link">Log out</a>
                </li>
            </ul>
        <div>
    </nav>

    <!-- success  -->
<div class="alert alert-success">
  <strong>Success!</strong> Item added Successfully!
</div>
    
    <!-- end success -->

<!-- display profiles -->
<?php
    // save the item to the session cart
    array_push($_SESSION['cart'], $id);
    
    // connect to db
    $conn = db_connect();

    // get data
    $query = "SELECT * FROM product WHERE prod_id = '$id'";
    $result = $conn->query($query);
    // just in case something happes
    if(!$result) {
        throw new Exception('product is not found');
        exit;
    }
    
    if($row = $result->fetch_row()) 
    {
        echo '<div class="list-content">'; // fileName 
        echo'<img src="uploads/'.$row[3].'"/ alt="Error on Displaying"></img>'; //picture
        echo'<div class="text">'.$row[1].'</div>'; // name
        echo'<div class="price">'. '$'.$row[2].'</div>'; // price
        echo'<div class="text">'. 'Description: '.$row[4].'</div>'; // description
        echo'</div>';
    }

    // close connection
    $result->close();
    $conn->close();
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>