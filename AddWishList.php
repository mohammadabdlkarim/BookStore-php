<?PHP
	session_start();
	include("library-connection.php");
	$isbn = $_SESSION['book'];
	$cid = $_SESSION['CID'];
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn']==0){
			header("Location:library-login.php");
		}
		else{
			$checkBook = "SELECT * FROM wishlist WHERE CID = ".$cid."
									 AND BookISBN = '".$isbn."'";
			$checkRes = mysqli_query($con, $checkBook) or die(mysqli_error($con));
			$checkCount = mysqli_num_rows($checkRes);
			if($checkCount==0){
				$add = "CALL AddWishList(".$cid.", '".$isbn."')";
				$query = mysqli_query($con,$add) or die(mysqli_error($con));
				header("Location:".$_SESSION['lastPage']);
			}
			else{
				$remove = "CALL removeWishList(".$cid.", '".$isbn."')";
				$removeQuery = mysqli_query($con, $remove) or die(mysqli_error($con));
				header("Location:".$_SESSION['lastPage']);
			}
		}
	}
	else{
		header("Location:library-login.php");
	}
?>