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
    $num = 0;
    $total = 0;
    $tax = 0;
    $grand_total= 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECKOUT</title>
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
                    <a class="nav-link" href="#">Checkout<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-item nav-link">Log out</a>
                </li>
            </ul>
        <div>
    </nav>
<!-- Show all items in the cart so far -->
<div class="row">
    <div class="col-sm-10"><h1>My Cart</h1></div>
    <div class="col-sm-2"><h1>Checkout</h1></div>
</div>
<div class="row">
    <div class="col-sm-10">
<?php
if(empty($_SESSION['cart'])) {
    echo "<div><p>There are no items in your cart</p></div><hr/>";
} else {
    //connect to db
    $conn = db_connect();
	foreach ($_SESSION['cart'] as $id) {
		$query = "SELECT * FROM product WHERE prod_id = '$id'";
		$result = $conn->query($query);
		if($row = $result->fetch_row()) {
			echo '<div class="list-content">'; // fileName 
			echo'<img src="uploads/'.$row[3].'"/ alt="Error on Displaying"></img>'; //picture
			echo'<div class="titleText">'.$row[1].'</div>'; // name
			echo'<div class="priceText">'. '$'.$row[2].'</div>'; // 
			$total = $total + $row[2];
			echo'<div class="descText">'. 'Description: '.$row[4].'</div>'; // description
			echo'</div>';
		}
    }
    echo'</div>'; // end 
    $num = count($_SESSION['cart']);
	$total = round($total, 2);
	$tax = round(0.0725*$total, 2);
	$grand_total = round($total + $tax, 2);
    
	// close connection
    $result->close();
    $conn->close();
} 
?>
  <div class="col-sm-2">
    <div class="container">
      <h4>Cart
        <span class="priceText" style="color:black">
          <b><?php echo"$num"; ?></b>
        </span>
      </h4>
      <p>Item Total:<span class="priceText"><?php echo "$total"; ?></span></p>
      <p>Sales Tax:<span class="priceText"><?php echo"$tax"; ?></span></p>
      <hr>
      <p>Grand Total: <span class="priceText" style="color:black"><?php echo"$grand_total"; ?></span></p>
      <br>
      <a href="purchase.php" class="btn btn-primary"> Purchase </a>
    </div>
  </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>