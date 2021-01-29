<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Author Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>

<body>
	<?php
		require'library-topbar.php';
		include("library-connection.php");
	?>
    <section class="section wb">
    	<div class="container">
        <?PHP
			$author=$_GET["id"];
			$_SESSION['lastPage'] = "library-author.php?id=".$_GET["id"];
			$sql = "SELECT * FROM author WHERE ID = $author";
			$query = mysqli_query($con, $sql) or die(mysqli_error($con));
			$info = mysqli_fetch_array($query);
		?>
        <div class="media">
        	<a class="media-left">
            	<?PHP
                	echo"<img src=upload/authors/".$info['ID'].".jpg class=rounded-circle height=250>";
				?>
            </a>
           	<div class="media-body">
            <?PHP
            	echo"<h2 class=media-heading user_name>".$info['Name']."</h2>
					<p>".$info['Info']."</p>";
			?>
            </div>
        </div>
        <br/><br/><br/>
        <?PHP
			$books = "SELECT DISTINCT ISBN FROM userbook WHERE `AuthorID` = $author";
			$booksQ = mysqli_query($con, $books) or die(mysqli_error($con));
			echo"<h4>Books by this author:</h4>";
			while($in = mysqli_fetch_array($booksQ))
				echo"
					 <a href=library-single.php?ISBN=".$in['ISBN'].">
					 <img src= bookCovers/".$in['ISBN'].".jpg width=33% height=468></a>";
		?>
</body>
</html>