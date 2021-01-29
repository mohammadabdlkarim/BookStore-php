<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Order Result</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body>

            
<?php
	require'library-topbar.php';
	include("library-connection.php");
	if($_GET['res']==0){
		echo"<h2>Your cart is empty.</h2>
		<h3><a href=library-cart.php>Back to cart</a></h3>";
	}
	else if($_GET['res']==1){
		if(isset($_SESSION['errors'])){	
			if(!empty($errors)){
				echo"<br/><h4 align =left>Something went wrong with the following books:</h4>";
				foreach($errors as &$isbn){
					//get error books names
					$bookName = "SELECT `Book Name` FROM userbook WHERE ISBN = '$isbn'";
					$bnQ = mysqli_query($con, $bookName) or die(mysqli_error($con));
					$errored = mysqli_fetch_array($bnQ);//print books names
					echo"<p>-".$errored['Book Name']."</p>";
				}
			}
		}
		if(isset($_SESSION['inserted']) && !empty($_SESSION['inserted'])){			
			?>
            <h2 align="center">Order Finished.</h2>
			<table class="table table-striped table-bordered table-hover table-condensed" align="center" width="75%" border="2">
        		<thead>
            	<tr bgcolor="#2ad2c9">
        			<th>Book Name</th>
            		<th>Price</th>
        		</tr></thead>
           <?php
		   $total = 0;
		   foreach($_SESSION['inserted'] as &$book){
			    $insertedBook = "SELECT Price FROM userbook WHERE `Book Name` = '$book'";
				$ibq = mysqli_query($con, $insertedBook) or die(mysqli_error($con));
				$ordered = mysqli_fetch_array($ibq);
			   	$total += $ordered['Price'];
				echo"<tr>
			   			<td>$book</td>
						<td>$".$ordered['Price']."</td>
			   		</tr>";
		   }
		   echo"<td>Total Price</td>
		   		<td>$ $total</td>";
		   echo"</table>";
		}
	}
	else if($_GET['res']==2){
		foreach($_SESSION['out'] as &$fail){
			echo"<h2>The book : (".$fail.") is out of stock.</h2>";
		}
	}
	?>
</body>
</html>