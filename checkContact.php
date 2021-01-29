<?php
	session_start();
	if(isset($_SESSION['loggedIn']))
		header("Location:library-contact.php");
	else{
		$_SESSION['lastPage'] = "library-contact.php";
		header("Location:library-login.php");
	}
?>