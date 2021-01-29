<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Home Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>
<body>
<?php
	require'library-topbar.php';
	include("library-connection.php");
	$_SESSION['lastPage'] = "library-index.php";
?>
        
    <section class="section first-section">
    	<div class="container-fluid">
        	<div class="masonry-blog clearfix">
	                
            	<div class="left-side">
                	<div class="masonry-box post-media">
					<?PHP
					$getNew = "SELECT * FROM userbook ORDER BY `userbook`.`LaunchDate` DESC";
					$result = mysqli_query($con, $getNew) or die(mysqli_error($con));
					$newCount = mysqli_num_rows($result);
					if($newCount==0)
						echo"<img src=upload/library_no_books.jpg width=534 height=468>";
					else{
						$row = mysqli_fetch_array($result);
						echo"<img src=bookCovers/".$row['ISBN'].".jpg width=534 height=468>";
					}
					?>
                    	<div class="shadoweffect">
            				<div class="shadow-desc">
            					<div class="blog-meta">
            						<span class="bg-aqua"><a href="library-category.php?cat=new">New Books</a></span>
                					<h4><a href="library-category.php?cat=new" title="">New Arrival Books</a></h4>
            					</div><!-- end meta -->
           					</div><!-- end shadow-desc -->
                        </div><!-- end shadow -->
                    </div><!-- end post-media -->
               	</div><!-- end left-side -->

					 
				<div class="center-side">
               		<div class="masonry-box post-media">
               		<?PHP
					$getMostSold = "SELECT * FROM userbook ORDER BY `userbook`.`SoldCount` DESC";
					$result = mysqli_query($con, $getMostSold) or die(mysqli_error($con));
					$countSold = mysqli_num_rows($result);
					if($countSold==0)
						echo"<img src=upload/library_no_books.jpg width=534 height=468>";
					else{
						$row = mysqli_fetch_array($result);
						echo"<img src=bookCovers/".$row['ISBN'].".jpg width=534 height=468>";
					}
					?>
                      	<div class="shadoweffect">
                        	<div class="shadow-desc">
                            	<div class="blog-meta">
                                	<span class="bg-aqua"><a href="library-category.php?cat=best Selling">Best Selling</a></span>
                                    <h4><a href="library-category.php?cat=best Selling">Best Selling Books</a></h4>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                        </div><!-- end shadow -->
                   	</div><!-- end post-media -->
               	</div><!-- end center-side -->

                <div class="right-side hidden-md-down">
                	<div class="masonry-box post-media">
					<?PHP
						$getRated = "SELECT * FROM userbook ORDER BY `userbook`.`Rating` DESC";
						$result = mysqli_query($con, $getRated) or die(mysqli_error($con));
						$RatedCount = mysqli_num_rows($result);
						if($RatedCount==0)
							echo"<img src=upload/library_no_books.jpg width=534 height=468>";
						else{
							$row = mysqli_fetch_array($result);
							echo"<img src=bookCovers/".$row['ISBN'].".jpg width=534 height=468>";
						}
					?>
                    	<div class="shadoweffect">
                        	<div class="shadow-desc">
                            	<div class="blog-meta">
                                	<span class="bg-aqua"><a href="library-category.php?cat=topRated" title="">Top</a></span>
                                    <h4><a href="library-category.php?cat=topRated" title="">Top Rated Books</a></h4>
                                </div><!-- end meta -->
                            </div><!-- end shadow-desc -->
                        </div><!-- end shadow -->
                    </div><!-- end post-media -->
               	</div><!-- end right-side -->
           </div><!-- end masonry -->
            </div>
        </section>

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-list clearfix">
                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="library-category.php?cat=philosophy" title="">
                                            <?PHP
												$philosophy = "SELECT * FROM userbook WHERE Category = 'philosophy'";
												$res=mysqli_query($con, $philosophy) or die(mysqli_error($con));
												$philCount = mysqli_num_rows($res);
												if($philCount==0)
													echo"<img src=upload/library_no_books.jpg class=img-fluid>";
												else{													
													$row = mysqli_fetch_array($res);
													echo"<img src=bookCovers/".$row['ISBN'].".jpg class=img-fluid>";
												}
											?>
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <span class="bg-aqua"><a href="library-category.php?cat=philosophy" title="">Philosophy</a></span>
                                        <h4><a href="library-category.php?cat=philosophy" title="">The best books that will change your way of thinking</a></h4>
                                        <p>Helpful books that can change your life forever.</p>
                                        
                                  </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="library-category.php?cat=art" title="">
                                                <?PHP
												$art = "SELECT * FROM userbook WHERE Category = 'Art'";
												$res=mysqli_query($con, $art) or die(mysqli_error($con));
												$artCount = mysqli_num_rows($res);
												if($artCount==0)
													echo"<img src=upload/library_no_books.jpg class=img-fluid>";
												else{
													$row = mysqli_fetch_array($res);
													echo"<img src=bookCovers/".$row['ISBN'].".jpg class=img-fluid>";
												}
											?>
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <span class="bg-aqua"><a href="library-category.php?cat=art" title="">Art</a></span>
                                        <h4><a href="library-category.php?cat=art" title="">Art Books </a></h4>
                                        <p>Helpful books for artists.</p>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">

                                <div class="blog-box row">
                                    <div class="col-md-4">
                                        <div class="post-media">
                                            <a href="library-category.php?cat=Novel" title="">
                                            <?PHP
												$Novel = "SELECT * FROM userbook WHERE Category = 'Novels'";
												$res=mysqli_query($con, $Novel) or die(mysqli_error($con));
												$novelCount = mysqli_num_rows($res);
												if($novelCount==0)
													echo"<img src=upload/library_no_books.jpg class=img-fluid>";
												else{
													$row = mysqli_fetch_array($res);
													echo"<img src=bookCovers/".$row['ISBN'].".jpg class=img-fluid>";
												}
											?>
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div><!-- end media -->
                                    </div><!-- end col -->

                                    <div class="blog-meta big-meta col-md-8">
                                        <span class="bg-aqua"><a href="library-category.php?cat=novel" title="">Novels</a></span>
                                        <h4><a href="library-category.php?cat=novel" title="">Novels</a></h4>
                                        <p>Novels, Stories, there's so much to read.</p>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
   		         <hr class="invis">                
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