<?PHP

//check if the user has clicked the signup button
if (isset($_POST['submit'])) {

	session_start();
	include("library-connection.php");
	
	$FN = $_POST['FirstName'];
	$LN = $_POST['LastName'];
	$UN = $_POST['UserName'];
	$email = $_POST['Email'];
	$address = $_POST['Address'];
	$phone = $_POST['Phone'];
	$password = $_POST['Password'];
	$passConfirm = $_POST['PassConfirm'];

	//check if input characters in FN and LN are valid
	if(!preg_match("/^[a-zA-Z]*$/", $FN) || !preg_match("/^[a-zA-Z]*$/", $LN)) {
		header("Location: ../library-register.php?error=char");
		exit();
		
	}else {
		
		//chech if username is available
		$checkUN = "SELECT * FROM customer WHERE UserName = '$UN'";
		$UNResult = mysqli_query($con, $checkUN) or die (mysqli_error($con));
		$unCount = mysqli_num_rows($UNResult);
		if($unCount!=0){
			header("Location:library-register.php?error=username_not_available");
			exit();
			
		}else {
		
			//check if email is valid
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location:library-register.php?error=Invalid_email");
				exit();
				
				}else {
				
				//chech if email is available
				$checkEmail = "SELECT * FROM customer WHERE Email = '$email'";
				$emailResult = mysqli_query($con, $checkEmail) or die (mysqli_error($con));
				$emailCount = mysqli_num_rows($emailResult);
				if($emailCount!=0){
					header("Location:library-register.php?error=email_is_already_used");
					exit();
							
				}else {
							
					if($password != $passConfirm){
						header("Location:library-register.php?error=Passwords_doesnot_match!");
						exit();
								
					}else {
								
					//insert info
								
					$insert = "CALL insertCustomer('$FN','$LN', '$UN', '$phone', '$address', '$email', '$password')";
					$result = mysqli_query($con, $insert) or die(mysqli_error($con));
			
					$_SESSION['loggedIn'] = 1;
					$_SESSION['user']=$UN;
					$query = "SELECT MAX(ID) AS max FROM customer";
	
					$get_lastid = mysqli_query($con,$query) or die(mysqli_error($con));
					$lastid = mysqli_fetch_array($get_lastid);
					$id = $lastid['max'];
					$_SESSION['CID']=$id;
					header("Location:".$_SESSION['lastPage']);
	
					}
				}
			}
		}
	}
}
?>