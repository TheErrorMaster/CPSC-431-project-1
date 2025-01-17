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
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">HOME<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Checkout</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-item nav-link">Log out</a>
                </li>
            </ul>
        <div>
    </nav>
    <!-- end nav bar -->

    <!-- sort  -->
    <ul class="nav justify-content-end">
        <li class="nav-item">
        <h4>Sort By: </h4>
        <form action = "home.php" method="post" enctype="multipart/form-data">
            <select id="sortby" class="form-control" name="sort">
				<option value="name">Product Name</option>
                <option value="priceAsc">Price Ascending</option>
                <option value="priceDesc">Price Descending</option>
            </select>
			<button type="submit" name="ok" class="btn btn-primary btnFormat">Submit</button>
        </form>
        </li>
    </ul>
    
    <!-- end sort -->

<!-- display profiles -->
<?php
    /*-------Sorting algorithm to product display---------------------------*/
        
    if (isset($_POST["ok"])) {
        $answer = $_POST["sort"];

        if($answer == 'name') {
            $query = "SELECT * FROM product ORDER BY name";
        } else if($answer == 'priceAsc') {
            $query = "SELECT * FROM product ORDER BY price";
        } else if($answer == 'priceDesc') {
            $query = "SELECT * FROM product ORDER BY price DESC";
        }
    } else {
        //set default $query
        $query = "SELECT * FROM product ORDER BY name";
    }

    // connect to db
    $conn = db_connect();

    // get data
    $result = $conn->query($query);
    // just in case something happes
    if(!$result) {
        throw new Exception('product is not found');
        exit;
    }
    
    while($row = $result->fetch_row()) 
    {
        echo'<div class="list-content">'; // fileName 
        echo'<img src="uploads/'.$row[3].'"/ alt="Error on Displaying"></img>'; //picture
        echo'<p class="titleText">'.$row[1].'</p>'; // name
        echo'<p class="priceText">'. '$'.$row[2].'</p>'; // price
        echo'<p class="descText">'. 'Description: '.$row[4].'</p>'; // description
        echo'<form action="cart.php" method="post">';
        echo'<input class="btn btn-primary btnFormat" type="submit" name="id" value="ADD TO CART"/>';
        echo'<input type="hidden" name="recordID" value="'.$row[0].'">';
        echo'</form>';
        echo'</div>';
    }

    // close connection
    $result->close();
    $conn->close();
?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>