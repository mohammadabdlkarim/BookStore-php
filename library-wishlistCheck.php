<?PHP
		session_start();
		include("library-connection.php");
		if(isset($_SESSION['loggedIn'])){
			if($_SESSION['loggedIn']==0)
				header("Location:library-login.php");
			else{
				header("Location:library-wishlist.php");
			}
		}
		else
			header("Location:library-login.php");
	?>
