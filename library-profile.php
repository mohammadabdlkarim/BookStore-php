<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Client Profile</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="profile" content="">

</head>
<body>
<?PHP
	require'library-topbar.php';
	include("library-connection.php");
	$ID=$_SESSION["CID"];
		$query = "SELECT * FROM customer WHERE ID=$ID";	
		$getData= mysqli_query($con, $query) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($getData)){
			$_SESSION['username'] = $row['UserName'];
?>
	<section class="section wb">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-10 offset-lg-1">
            	<div class="page-wrapper">
                	<div class="row">
                    	<div class="col-lg-8 offset-lg-2">
                            <form action="editProfileAction.php" method="post" class="form-wrapper">
                            <div class="media">
        						<a class="media-left">
            					<?PHP
                					echo"<img src=upload/users/".$row['ID'].".jpg class=rounded-circle height=250>";
								?>
        			    		</a>
       						 </div>
                            Change Profie Picture: <input class="form-control" type="file" name="newImage" id="newImage" />
                                <input class="form-control" type="text" name="Fname" placeHolder="Change FirstName" <?php echo"value=".$row['FirstName']; ?>>
                                <input class="form-control" type="text" name="Lname" placeHolder="Change Last Name" <?php echo"value=".$row['LastName']; ?>>
                                <input class="form-control" type="text" name="Uname" placeHolder="Change UserName" <?php echo"value=".$row['UserName']; ?>>
                                <input class="form-control" type="text" name="Phone" placeHolder="Change Phone" <?php echo"value=".$row['Phone']; ?>>
                                <input class="form-control" type="text" name="Address" placeHolder="Change Address" <?php echo"value=".$row['Address']; ?>>
                                <input class="form-control" type="text" name="Email" placeHolder="Change Email" <?php echo"value=".$row['Email']; ?>>
                                <input class="form-control" type="text" name="Password" placeHolder="Change Password">
                                <input class="form-control" type="text" name="ConfirmPassword" placeHolder="Confirm Password">
                                <button type="submit" name="submit" class="btn btn-primary">Update Info
                                			<i class="fa fa-envelope-open-o"></i></button>                                            
                            </form>
                            <br>
	<?php
		
		?>
        <table width= "100%">
             <tr> 
             	<td><a href="library-CustomerBooks.php" class="btn btn-primary">Books Bought</a></td>
                <td><a href="library-logout.php" class="btn btn-primary">Logout</a></td>
			</tr>
		</table>
	<?php		
		}
		
	?>
    
		</div>
	</section>
</body>
</html>