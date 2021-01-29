<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Wish List Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body>
	<?PHP
		require'library-topbar.php';
		include("library-connection.php");
	?>
    <section class="section wb">
    	<div class="container">
        	<?PHP
				$getBooks = "SELECT * FROM wishlist WHERE CID = ".$_SESSION['CID'];
				$bookResult = mysqli_query($con, $getBooks) or die(mysqli_error($con));
				$bookCount = mysqli_num_rows($bookResult);
				if($bookCount == 0)
					echo"<h2>Your wishlist is empty.</h2>";
				else{
					while($book = mysqli_fetch_array($bookResult)){
						echo"
							 <a href=library-single.php?ISBN=".$book['BookISBN'].">
							 <img src= bookCovers/".$book['BookISBN'].".jpg width=33% height=468></a>";
					}
				}
			?>
        </div>
    </section>
</body>
</html>