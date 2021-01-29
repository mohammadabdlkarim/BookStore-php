<?PHP
	//check if the user has clicked the signup button
	if (isset($_POST['submit'])) {
		session_start();
		include("library-connection.php");
		
		$email = $_POST['txtEmail'];
		$password = $_POST['txtPass'];
		
		$check = "SELECT * FROM customer WHERE Email = '$email' 
					AND Password = '$password' OR UserName = '$email' AND Password = '$password'";
		$result = mysqli_query($con, $check) or die (mysqli_error($con));
		$count = mysqli_num_rows($result);
		
		if($count==0){
			header("Location:library-login.php?error=wrong_username_or_password");
			exit();
		}
		else{
			$_SESSION['loggedIn'] = 1;
			$_SESSION['user']=$email;
			$getCID = "SELECT ID FROM customer WHERE UserName = '".$email."'
							OR Email = '".$email."'";
			$IDRes = mysqli_query($con, $getCID) or die(mysqli_error($con));
			$user = mysqli_fetch_array($IDRes);
			$_SESSION['CID'] = $user['ID'];
			header("Location:".$_SESSION['lastPage']);
		}
	}
?>