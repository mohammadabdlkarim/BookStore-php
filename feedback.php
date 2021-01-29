<?php
	session_start();
	include("library-connection.php");
	$sub = $_POST['txtSubject'];
	$feed = $_POST['txtFeedback'];
	$id = $_SESSION['CID'];
	$send = "CALL addFeedback($id, '$feed', '$sub')";
	$sendQ = mysqli_query($con, $send) or die(mysqli_error($con));
	
	$check = "SELECT * FROM Feedback WHERE CID = $id AND Info = '$feed'";
	$checkQ = mysqli_query($con, $check) or die(mysqli_error($con));
	$count = mysqli_num_rows($checkQ);
	if($count==0)
		header("Location:library-contact?res=0");
	else
		header("Location:library-contact?res=1");
?>