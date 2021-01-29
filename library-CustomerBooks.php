<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Client Books</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="profile" content="">

</head>
<body>
<?php
	require'library-topbar.php';
    include("library-connection.php");                            
?>
<section class="section wb">
	<div class="container">
		<?PHP
			if(isset($_SESSION['username'])){
				$un = $_SESSION['username'];
				$getBooksBought = "SELECT DISTINCT `Book ISBN` FROM userorder WHERE `User Name` = '$un'";
				$res = mysqli_query($con, $getBooksBought) or die(mysqli_error($con));
				$count = mysqli_num_rows($res);
				if($count==0)
					echo"<h4>You haven't bought any books</h4>";
				else{
					echo"<h4>Books Bought:</h4>";
					while($books = mysqli_fetch_array($res)){
						echo"
						<a href=library-single.php?ISBN=".$books['Book ISBN'].">
						<img src= bookCovers/".$books['Book ISBN'].".jpg width=33% height=468></a>";
					}
				}
			}
		?>
	</div>
</section>
<body>
</body>
</html>