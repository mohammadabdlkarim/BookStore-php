<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Cart Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body>
<?PHP
	require'library-topbar.php';
	include("library-connection.php");
	$_SESSION['lastPage'] = "library-cart.php";
	//check if cart is not declared or empty
	if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
		?>
		<div align="center"><h2>Your cart is empty.</h2></div>
<?php
	}
	else{//if session is declared and not empty
		?>
		<table class="table table-striped table-bordered table-hover table-condensed" align="center" width="75%" border="2">
        	<thead>
            <tr bgcolor="#2ad2c9">
        		<th>Book Name</th>
            	<th>Price</th>
           		<th>Remove</th>
        	</tr></thead>
	
	<?php	
		}
		$total = 0;
		foreach($_SESSION['cart'] as &$isbn){
			$getBookInfo = "SELECT Name, Price FROM book WHERE ISBN = '$isbn'";
			$run = mysqli_query($con, $getBookInfo) or die(mysqli_error($con));
			while($info = mysqli_fetch_array($run)){
				$total += $info['Price'];
				echo"<tr>
						<td>".$info['Name']."</td>
						<td>$".$info['Price']."</td>
						<td>
							<a href = addToCart.php?book=".$isbn.">";
							?>
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span>Remove from cart</button></a>
						</td>
					 </tr>
                     
	<?php			
			}
		
	}
	echo "<tr><td>Total Price</td><td>$".$total."</td></tr>";
	?>
        </table>
        <table width="50%" align="center">
        	<tr>
        		<td>
        			<form action="confirm.php">
        			<button type="submit" class="btn btn-primary">Confirm Purchase</button>
        			</form>
                </td><td>
        			<form action="emptyCart.php">
        			<button type="submit" class="btn btn-primary">Clear Cart</button>
        			</form>
            	</td>
        	</tr>
		</table>
</body>
</html>