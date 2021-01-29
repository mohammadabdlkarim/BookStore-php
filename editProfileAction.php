<?PHP
	require'library-topbar.php';
	include("library-connection.php");
	
	$ID=$_SESSION['CID'];
	$Fname=$_POST['Fname'];
	$Lname=$_POST['Lname'];
	$Uname=$_POST['Uname'];
	$Phone=$_POST['Phone'];
	$Address=$_POST['Address'];
	$Email=$_POST['Email'];
	$Password=$_POST['Password'];
	$passConfirm = $_POST['ConfirmPassword'];
	
	$query = "SELECT * FROM customer WHERE ID=$ID";	
	$getData= mysqli_query($con, $query) or die(mysqli_error($con));
	$row=mysqli_fetch_array($getData);
				
	//insert info
	if($Fname!== $row['FirstName']){
		$fn = "UPDATE customer SET FirstName='".$Fname."' WHERE ID = $ID";
		$updateFN = mysqli_query($con, $fn) or die(mysqli_error($con));
		$checkFN = "SELECT * FROM customer WHERE FirstName = '$Fname' AND ID = $ID";
		$fnResult = mysqli_query($con, $checkFN) or die(mysqli_error($con));
		$fnCount = mysqli_num_rows($fnResult);
		if($fnCount !== 0)
			echo"<h4 style=color:green>First Name Updated.</h4>";
	}
	if($Lname!==$row['LastName']){
		$ln = "UPDATE customer SET LastName='".$Lname."' WHERE ID = $ID";
		$updateLN = mysqli_query($con, $ln) or die(mysqli_error($con));
		$checkLN = "SELECT * FROM customer WHERE LastName = '$Lname' AND ID = $ID";
		$lnResult = mysqli_query($con, $checkLN) or die(mysqli_error($con));
		$lnCount = mysqli_num_rows($lnResult);
		if($lnCount !== 0)
			echo"<h4 style=color:green>Last Name Updated.</h4>";
	}
	if($Uname!== $row['UserName']){
		//check if username is available
		$checkUN = "SELECT * FROM customer WHERE UserName = '$Uname'";
		$UNResult = mysqli_query($con, $checkUN) or die (mysqli_error($con));
		$unCount = mysqli_num_rows($UNResult);
		if($unCount!=0){
			echo"<h4 style=color:red>User name is not available</h4>";
		}
		else{
			$un = "UPDATE customer SET UserName='".$Uname."' WHERE ID = $ID";
			$updateUN = mysqli_query($con, $un) or die(mysqli_error($con));
			$checkUN = "SELECT * FROM customer WHERE UserName = '$Uname'";
			$unResult = mysqli_query($con, $checkUN) or die(mysqli_error($con));
			$unCount = mysqli_num_rows($unResult);
			if($unCount !== 0)
				echo"<h4 style=color:green>User Name Updated.</h4>";
		}
	}
	if($Phone!== $row['Phone']){
		$ph = "UPDATE customer SET Phone='".$Phone."' WHERE ID = $ID";
		$updatePH = mysqli_query($con, $ph) or die(mysqli_error($con));
		$checkPH = "SELECT * FROM customer WHERE Phone = '$Phone' AND ID = $ID";
		$phResult = mysqli_query($con, $checkPH) or die(mysqli_error($con));
		$phCount = mysqli_num_rows($phResult);
		if($phCount !== 0)
			echo"<h4 style=color:green>Phone Updated.</h4>";
	}
	if($Address!== $row['Address']){
		$ad = "UPDATE customer SET Address='".$Address."'";
		$updateAD = mysqli_query($con, $ad) or die(mysqli_error($con));
		$checkAD = "SELECT * FROM customer WHERE Address = '$Address' and ID = $ID";
		$adResult = mysqli_query($con, $checkAD) or die(mysqli_error($con));
		$adCount = mysqli_num_rows($adResult);
		if($adCount !== 0)
			echo"<h4 style=color:green>Address Updated.</h4>";
	}
	if($Email!== $row['Email']){
		//check if email is valid
		if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
			echo"<h4 style=color:red>Invalid Email.</h4>";
			//check if email is available
			$checkEmail = "SELECT * FROM customer WHERE Email = '$Email' WHERE ID = $ID";
			$emailResult = mysqli_query($con, $checkEmail) or die (mysqli_error($con));
			$emailCount = mysqli_num_rows($emailResult);
			if($emailCount!=0){
				echo"<h4 style=color:red>Email is used by another account.</h4>";
			}
			else{
				$em = "UPDATE customer SET Email='".$Email."' WHERE ID = $ID";
				$updateEM = mysqli_query($con, $em) or die(mysqli_error($con));
				$checkEM = "SELECT * FROM customer WHERE Email = '$Email'";
				$emResult = mysqli_query($con, $checkEM) or die(mysqli_error($con));
				$emCount = mysqli_num_rows($emResult);
				if($emCount !== 0)
					echo"<h4 style=color:green>Email Updated.</h4>";
			}
		}
	}
	if($Password!== $row['Password'] && $Password!==""){
		if($Password !== $passConfirm){
			echo"<h4 style=color:red>Passwords dont match.</h4>";
		}
		else{
			$pw = "UPDATE customer SET Password='".$Passsword."' WHERE ID = $ID";
			$updatePW = mysqli_query($con, $pw) or die(mysqli_error($con));
			$checkPW = "SELECT * FROM customer WHERE Password = '$Password' and ID = $ID";
			$pwResult = mysqli_query($con, $checkPW) or die(mysqli_error($con));
			$pwCount = mysqli_num_rows($pwResult);
			if($pwCount !== 0)
				echo"<h4 style=color:green>Password Updated.</h4>";
		}
	}
	if(isset($_FILES['newImage'])){//change image
		$destination = 'upload/users/'.$ID.'.jpg';
		$temporary = $_FILES['newImage']['tmp_name'];
		move_uploaded_file($temporary,$destination);
	}
?>
<h4 align="center"><a href = "library-profile.php">Back to profile</a></h4>