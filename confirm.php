<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Finish Order</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body>
<?php
	include("library-connection.php");
	if(!empty($_SESSION['cart'])){
		$out = 1;
		$_SESSION['out'] = array();
		foreach($_SESSION['cart'] as &$book){
			$check = "SELECT * FROM book WHERE ISBN = '$book'";
			$query = mysqli_query($con, $check) or die(mysqli_error($con));
			while($results = mysqli_fetch_array($query)){
				if($results['Stock']>0)
					$out = 0;
				else{
					array_push($_SESSION['out'], $results['Name']);
					$out = 1;
				}
			}
		}
		if($out==0){//if all the books is in stock
			//insert new order
			$insertOrder = "CALL insertOrder(".$_SESSION['CID'].")";
			$insert = mysqli_query($con, $insertOrder) or die(mysqli_error($con));
			//get order ID
			$getOID = "SELECT MAX(ID) AS max FROM `order`";	
			$get_lastid = mysqli_query($con,$getOID) or die(mysqli_error($con));
			$lastid = mysqli_fetch_array($get_lastid);
			$id = $lastid['max'];
			//array for books which is not inserted
			$_SESSION['errors'] = array();
			foreach($_SESSION['cart'] as &$book){
				//get books info
				$check = "SELECT * FROM userbook WHERE ISBN = '$book'";
				$query = mysqli_query($con, $check) or die(mysqli_error($con));
				$result = mysqli_fetch_array($query);
				//insert details of the order
				$insertDetail = "CALL insertOrderDetail($id, '$book', ".$result['Price'].")";
				$insert = mysqli_query($con, $insertDetail) or die(mysqli_error($con));
				//check if the details are inserted
				$checkD = "SELECT * FROM `userorder` WHERE OID = $id AND `Book Name` = '$book'";
				$dResult = mysqli_query($con, $checkD) or die(mysqli_error($con));
				$count = mysqli_num_rows($dResult);
				if($count==0){//if this detail is not inserted
					array_push($_SESSION['errors'], $book);
				}
				else{//update book table
					$update = "UPDATE book SET Stock = Stock - 1, SoldCount = SoldCount +1 WHERE ISBN = '$book'";
					$updateQ = mysqli_query($con, $update) or die(mysqli_error($con));
				}
			}//get inserted books
			$getOrderInfo = "SELECT * FROM `userorder` WHERE `User Name` = '".$_SESSION['user']."' AND OID = $id";
			$get = mysqli_query($con,$getOrderInfo) or die(mysqli_error($con));
			$_SESSION['inserted'] = array();
			while($orderResults = mysqli_fetch_array($get)){
				array_push($_SESSION['inserted'], $orderResults['Book Name']);
			}
			$_SESSION['cart'] = array();
			header("Location:library-result.php?res=1");
		}
		else if($out==1)
			header("Location:library-result.php?res=2");
	}else{//if the cart is empty
		header("Location:library-result.php?res=0");
	}
?>
</body>
</html>