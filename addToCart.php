<?php
	session_start();
	if(isset($_SESSION['loggedIn'])){//if logged in sesson is declared
		if(isset($_GET["book"]))//from link
			$book = $_GET["book"];
		else//from form
			$book = $_SESSION['book'];
		if(isset($_SESSION['cart'])){//if cart session is daclared
			if(($key = array_search($book, $_SESSION['cart'])) !==false)
				unset($_SESSION['cart'][$key]);
			else
				array_push($_SESSION['cart'], $book);
		}
		else{//if the cart session is not declared
			//declare session
			$_SESSION['cart'] = array($book);
		}
		//go back to the book page
		header("Location:".$_SESSION['lastPage']);
	}
	else
		//if logged in session is not declared(go to login page)
		header("Location:library-login.php");	
?>