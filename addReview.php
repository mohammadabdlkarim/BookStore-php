<?PHP
	session_start();
	include("library-connection.php");
	$rating = $_POST['slctRating'];
	$info = $_POST['txtReview'];
	$_SESSION['review'] = $_POST['txtReview'];
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn']==0)
			header("Location:library-login.php");
		else{
			$getCID = "SELECT ID FROM customer WHERE UserName = '".$_SESSION['user']."'
						OR Email = '".$_SESSION['user']."'";
			$IDRes = mysqli_query($con, $getCID) or die(mysqli_error($con));
			$user = mysqli_fetch_array($IDRes);
			$_SESSION['CID'] = $user['ID'];
			//check if the user already reviewed the book
			$checkOldRev = "SELECT * FROM bookreviews WHERE CID = ".$_SESSION['CID']." AND ISBN = '".$_SESSION['book']."'";
			$checkOldQ = mysqli_query($con, $checkOldRev) or die(mysqli_error($con));
			$revOldCount = mysqli_num_rows($checkOldQ);
			if($revOldCount==0){
				$place = "CALL addReview(".$_SESSION['CID'].",".$_SESSION['book'].", $rating, '$info')";
				$placeQ = mysqli_query($con, $place) or die(mysqli_error($con));
				//check if review is inserted
				$checkRev = "SELECT * FROM bookreviews WHERE CID = ".$_SESSION['CID']." AND ISBN = '".$_SESSION['book']."'";
				$checkQ = mysqli_query($con, $checkRev) or die(mysqli_error($con));
				$revCount = mysqli_num_rows($checkQ);
				if($revCount==0)
					header("Location:library-single.php?ISBN=".$_SESSION['book']."&error=1");
				else{
					//get number of reviews and the average rating
					$getMax_Count = "SELECT SUM(Rating) AS 'Sum', COUNT(Rating) AS 'Num' FROM review WHERE BookISBN = '".$_SESSION['book']."'";
					$maxQ = mysqli_query($con, $getMax_Count) or die(mysqli_error($con));
					$details = mysqli_fetch_array($maxQ);
					$sum = $details['Sum'];
					$num = $details['Num'];
					$newR = $sum/$num;
					$update = "UPDATE book SET Rating = $newR WHERE ISBN = '".$_SESSION['book']."'";
					$updQ = mysqli_query($con, $update) or die(mysqli_error($con));
					header("Location:library-single.php?ISBN=".$_SESSION['book']."&res=1");
				}
			}
			else{//Update review
				//remove old review
				$removeOld = "CALL removeReview(".$_SESSION['CID'].",".$_SESSION['book'].")";
				$removeOldQ = mysqli_query($con, $removeOld) or die(mysqli_error($con));
				//add new review
				$placeNew = "CALL addReview(".$_SESSION['CID'].",".$_SESSION['book'].", $rating, '$info')";
				$placeNewQ = mysqli_query($con, $placeNew) or die(mysqli_error($con));
				//check if review is inserted
				$checkNewRev = "SELECT * FROM bookreviews WHERE CID = ".$_SESSION['CID']." AND ISBN = '".$_SESSION['book']."'";
				$checkNewQ = mysqli_query($con, $checkNewRev) or die(mysqli_error($con));
				$revNewCount = mysqli_num_rows($checkNewQ);
				if($revNewCount==0)
					header("Location:library-single.php?ISBN=".$_SESSION['book']."&error=1");
				else{
					$getMax_Count = "SELECT SUM(Rating) AS 'Sum', COUNT(Rating) AS 'Num' FROM review WHERE BookISBN = '".$_SESSION['book']."'";
					$maxQ = mysqli_query($con, $getMax_Count) or die(mysqli_error($con));
					$details = mysqli_fetch_array($maxQ);
					$sum = $details['Sum'];
					$num = $details['Num'];
					$newR = $sum/$num;
					$update = "UPDATE book SET Rating = $newR WHERE ISBN = '".$_SESSION['book']."'";
					$updQ = mysqli_query($con, $update) or die(mysqli_error($con));
					header("Location:library-single.php?ISBN=".$_SESSION['book']."&res=2");
				}
			}
		}
	}
	else{
		header("Location:library-login.php");
	}
?>