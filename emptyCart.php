<?php
	session_start();
	$_SESSION['cart'] = array();
	header("Location:library-cart.php");
?>