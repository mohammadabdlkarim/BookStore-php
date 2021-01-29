<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Categories</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>
<body>
	<?php
		require'library-topbar.php';
		$_SESSION['lastPage'] = "library-category.php";
	?>
    
    <div class="page-title wb">
    	<div class="container">
        	<div class="row">
            	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <?PHP
				if(isset($_GET['cat']))
                	echo"<h2><i class=fa fa-leaf bg-green></i> Category by: ".$_GET['cat']."</h2>";
				else
					echo"<h2><i class=fa fa-leaf bg-green></i> All Categories</h2>";
				?>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section wb">
    	<div class="container">
							<?PHP
								include ("library-connection.php");
								if(isset($_GET['cat'])){
									if($_GET['cat']=="new"){
										$getNew = "SELECT DISTINCT ISBN FROM userbook ORDER BY `LaunchDate` DESC";
										$newResults = mysqli_query($con, $getNew) or die(mysqli_error($con));
										$newCount = mysqli_num_rows($newResults);
										if($newCount == 0){
											echo"No new books.";
										}
										else{
											while($new = mysqli_fetch_array($newResults)){
												echo"
												 	 <a href=library-single.php?ISBN=".$new['ISBN'].">
													 <img src= bookCovers/".$new['ISBN'].".jpg width=33% height=468></a>";
											}echo"<br/>";
										}
									}
									else if($_GET['cat']=="best Selling"){
										$getMostSold = "SELECT DISTINCT ISBN FROM userbook ORDER BY `userbook`.`SoldCount` DESC";
										$mostSoldResult = mysqli_query($con, $getMostSold) or die(mysqli_error($con));
										$mostSoldCount = mysqli_num_rows($mostSoldResult);
										if($mostSoldCount == 0)
											echo"No Sold Books.";
										else{
											while($mostSold = mysqli_fetch_array($mostSoldResult)){
												echo"
														 <a href=library-single.php?ISBN=".$mostSold['ISBN'].">
														 <img src= bookCovers/".$mostSold['ISBN'].".jpg width=33% height=468></a>";
											}
										}
									}
									else if($_GET['cat']=="topRated"){
										$getRated = "SELECT DISTINCT ISBN FROM userbook ORDER BY `userbook`.`Rating` DESC";
										$topQ = mysqli_query($con, $getRated) or die(mysqli_error($con));
										$RatedCount = mysqli_num_rows($topQ);
										if($RatedCount==0)
											echo"No Rated Books.";
										else{
											while($top = mysqli_fetch_array($topQ)){
												echo"
														 <a href=library-single.php?ISBN=".$top['ISBN'].">
														 <img src= bookCovers/".$top['ISBN'].".jpg width=33% height=468></a>";
											}
										}
									}
									else{
										$getBooks = "SELECT * FROM userbook WHERE Category LIKE '%".$_GET['cat']."%'";
										$bookResult = mysqli_query($con, $getBooks) or die(mysqli_error($con));
										$bookCount = mysqli_num_rows($bookResult);
										if($bookCount == 0)
											echo"This category doesn't have any books.";
										else{
											while($book = mysqli_fetch_array($bookResult)){
													 echo"
														 <a href=library-single.php?ISBN=".$book['ISBN'].">
														 <img src= bookCovers/".$book['ISBN'].".jpg width=33% height=468></a>";
											}
											echo"<br/>";
										}
									}
									echo"<br/><h4>All Categories:</h4>";
									$getCat = "SELECT Name FROM category";
									$result = mysqli_query($con, $getCat) or die(mysqli_error($con));
									$i = 1;
									while($row = mysqli_fetch_array($result)){
										echo"<a href = library-category.php?cat=".$row['Name'].">$i- ".$row['Name']."</a></br>";
										$i++;
									}
								}
								else{
									$getCat = "SELECT Name FROM category";
									$result = mysqli_query($con, $getCat) or die(mysqli_error($con));
									$i = 1;
									while($row = mysqli_fetch_array($result)){
										echo"<a href = library-category.php?cat=".$row['Name'].">$i- ".$row['Name']."</a></br>";
										$i++;
									}
								}
							?>
            </div><!-- end container -->
        </section>

        
        <div class="dmtop">Scroll to Top</div>
        
    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>