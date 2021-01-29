<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Book Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
</head>
<body>

    <?php
		require'library-topbar.php';
		include("library-connection.php");
	?>
        <div class="page-title wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2><i class="fa fa-leaf bg-green"></i>Book Details</h2>
                    </div><!-- end col -->                   
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end page-title -->

        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area"> 
                                <?PHP
									if(isset($_GET['ISBN'])){
										$_SESSION['lastPage'] = "library-single.php?ISBN=".$_GET['ISBN'];
                                		$getBookDetail = "SELECT * FROM userbook WHERE ISBN = '".$_GET['ISBN']."'";
										$detailResult = mysqli_query($con, $getBookDetail) or die(mysqli_error($con));
										$count = mysqli_num_rows($detailResult);
										if($count==0)//if the isbn does not for any book
											echo"<h3>Book does not exists.</h3>";
										else{//get book details
											$detail = mysqli_fetch_array($detailResult);
											echo"<h3>".$detail['Book Name']." by ";
											$bookauthors = "SELECT DISTINCT authorID FROM userbook WHERE ISBN = '".$_GET['ISBN']."'";
											$authorsQ = mysqli_query($con, $bookauthors) or die(mysqli_error($con));
											while($authors = mysqli_fetch_array($authorsQ)){
											$getAuthor = "SELECT * FROM author WHERE ID = ".$authors['authorID'];
											$authorQuery = mysqli_query($con, $getAuthor) or die(mysqli_error($con));
											while($author = mysqli_fetch_array($authorQuery)){
												echo"<a href=library-author?id=".$author['ID'].">".$author['Name']."
													 </a>, </h3>";	
											}}
												echo"
												 <h4>Price: $".$detail['Price']."</h4>";
												 if($detail['Stock']==0)//if the book quantity is 0
												 	echo"<p>Sorry this book is out of stock.</p>";
										
								?>
							</div><!-- end title -->
                            
                            <div class="single-post-media">
                            <?PHP
								//print book cover image
								echo"<img src=bookCovers/".$detail['ISBN'].".jpg class=img-fluid>";
							?>
                            </div><!-- end media -->
							
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <?PHP
										$_SESSION['book'] = $_GET["ISBN"];
										if(isset($_SESSION['loggedIn'])){//if the user is logged in
											$checkBook = "SELECT * FROM wishlist WHERE CID = ".$_SESSION['CID']."
														 AND BookISBN = '".$_GET['ISBN']."'";
											$checkRes = mysqli_query($con, $checkBook) or die(mysqli_error($con));
											$checkCount = mysqli_num_rows($checkRes);
											if($checkCount==0){//if book is not in the wishlist
												?>
												<table align=center width=100%>
													<tr>
														<td>
															<form action="AddWishList.php" method="get" class="form-wrapper">
																<button "type=submit" class="btn btn-primary"><span class="glyphicon glyphicon-star-empty"></span> Add To WishList</button>
															</form>
														</td>
                                                <?PHP
											}//end if is not in wishlist
											else{//if the book is in the wishlist
												?>
											<table align=center width=100%>
													<tr>
														<td>
															<form action="AddWishList.php" method="get" class="form-wrapper">
																<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-star"></span> Added To WishList</button>
															</form>
														</td>
                                            <?PHP
											}//end else (is in the wishlist)
											if(isset($_SESSION['cart'])){//to prevent errors before declaring cart
												if(in_array($_SESSION['book'], $_SESSION['cart'])){//if book is already added to cart
													?>
													<td>
                                                    	<form action="AddToCart.php" method="get" class="form-wrapper">
															<button type="submit" class="btn btn-primary"><span class= "glyphicon glyphicon-shopping-cart"></span> Added To Cart</button>
														</form>
													</td></tr>
                                                    </table>
												<?PHP
                                                }//end if book is added to the cart
                                                else{//if the book is not added to cart
                                                    ?>
                                                    <td>
                                                    	<form action="AddToCart.php" method="get" class="form-wrapper">
															<button type="submit" class="btn btn-primary"><span class= "glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
														</form>
                                                    </td></tr>
                                                 	</table>
                                                    <?PHP
                                                }//end eld (the book is not added to cart)
											}//end if isset cart session
											else{//if the cart session is not declared
											?>
                                            	<td>
                                                	<form action="AddToCart.php" method="get" class="form-wrapper">
															<button type="submit" class="btn btn-primary"><span class= "glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
														</form>
                                                </td></tr>
                                                </table>
                                            <?PHP
											}//end else(cart not declared)
										}//end if isset logged in
										else{//if the user is not logged in
											?>
											<table align=center width=100%>
												<tr>
													<td>
														<form action="AddWishList.php" method="get" class="form-wrapper">
															<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-star-empty"></span> Add To WishList</button>
														</form>
													</td><td>
														<form action="AddToCart.php" method="get" class="form-wrapper">
															<button type="submit" class="btn btn-primary"><span class= "glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
														</form>
													</td>
                                            	</tr>
											</table>
									<?PHP
										}//end else(user not logged in)
									?>
                                </div>
                            </div>
                            <br/>
                                    <?PHP
										//print book info
										echo"<div class=custombox clearfix>
                                    			<h4 class = small-title>About Book:</h4>
												<p>".$detail['Info']."</p>
											</div>";
									?> 
                            <hr class="invis1">
                            <div class="custombox clearfix">
                                <h4 class="small-title">Ratings</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                        <?php
											echo"<h3> Rating: ".$detail['Rating']." stars.</h3>";
											//get number of 5 stars
											$fivestars = "SELECT COUNT(RATING) AS 'Num' FROM bookreviews WHERE ISBN = '".$_GET['ISBN']."'
															 AND Rating = 5";
											$fiveQ = mysqli_query($con, $fivestars) or die(mysqli_error($con));
											$five = mysqli_fetch_array($fiveQ);
											echo $five['Num']." people rated this book as 5 stars<br>";
											//get number of 4 stars
											$fourstars = "SELECT COUNT(RATING) AS 'Num' FROM bookreviews WHERE ISBN = '".$_GET['ISBN']."'
															 AND Rating = 4";
											$fourQ = mysqli_query($con, $fourstars) or die(mysqli_error($con));
											$four = mysqli_fetch_array($fourQ);
											echo $four['Num']." people rated this book as 4 stars<br>";
											//get number of 3 stars
											$threestars = "SELECT COUNT(RATING) AS 'Num' FROM bookreviews WHERE ISBN = '".$_GET['ISBN']."'
															 AND Rating = 3";
											$threeQ = mysqli_query($con, $threestars) or die(mysqli_error($con));
											$three = mysqli_fetch_array($threeQ);
											echo $three['Num']." people rated this book as 3 stars<br>";
											//get number of 2 stars
											$twostars = "SELECT COUNT(RATING) AS 'Num' FROM bookreviews WHERE ISBN = '".$_GET['ISBN']."'
															 AND Rating = 2";
											$twoQ = mysqli_query($con, $twostars) or die(mysqli_error($con));
											$two = mysqli_fetch_array($twoQ);
											echo $two['Num']." people rated this book as 2 stars<br>";
											//get number of 1 stars
											$onestars = "SELECT COUNT(RATING) AS 'Num' FROM bookreviews WHERE ISBN = '".$_GET['ISBN']."'
															 AND Rating = 1";
											$oneQ = mysqli_query($con, $onestars) or die(mysqli_error($con));
											$one = mysqli_fetch_array($oneQ);
											echo $one['Num']." people rated this book as 1 star<br>";
										?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                            <hr class="invis1">
                            <div class="custombox clearfix">
                                <h4 class="small-title">Categories tagged</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                        <?php
											$getcats = "SELECT DISTINCT category FROM userbook WHERE ISBN = '".$_GET['ISBN']."'";
											$getcatsQ = mysqli_query($con, $getcats) or die(mysqli_error($con));
											$last = "right";
											echo"<table width=100%>";
											while($cats = mysqli_fetch_array($getcatsQ)){
												if($last=="right"){
													echo"<tr><td><a href=library-category?cat=".$cats['category']."> ".$cats['category']."</a></td>";
													$last = "left";
												}
												elseif($last=="left"){
													echo"<td><a href=library-category?cat=".$cats['category']."> ".$cats['category']."</a></td>";
													$last = "center";
												}
												elseif($last=="center"){
													echo"<td><a href=library-category?cat=".$cats['category']."> ".$cats['category']."</a></td></tr>";						
													$last="right";
												}
											}
											echo"</table>";
                                        ?>
                                        </div>
                                    </div>
                                </div>
                           	</div>
                                    
                            <hr class="invis1">

                            <div class="custombox authorbox clearfix">
                                <h4 class="small-title">About author</h4>
                                <div class="row">

                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <?PHP
											//get authors
											$bookauthors = "SELECT DISTINCT authorID FROM userbook WHERE ISBN = '".$_GET['ISBN']."'";
											$authorsQ = mysqli_query($con, $bookauthors) or die(mysqli_error($con));
											while($authors = mysqli_fetch_array($authorsQ)){
												$getAuthor = "SELECT * FROM author WHERE ID = ".$authors['authorID'];
												$authorQuery = mysqli_query($con, $getAuthor) or die(mysqli_error($con));
												while($author = mysqli_fetch_array($authorQuery)){
													if($author['Info']=="")//if there is no info about the auhor
														echo"<h4><a href=library-author?id=".$author['ID'].">".$author['Name']."</a></h4>
                                        					 	<p>No Information Available.</p>";
													else{
														
														echo"
															<h4><a href=library-author?id=".$author['ID'].">".$author['Name']."</a></h4>
                                        			 			<p>".$author['Info']."</p>";
													}//end else
												}//end while
											}//end while
										?>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end author-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">You may also like</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <?PHP
													$getLike = "SELECT * FROM userbook WHERE category = '".$detail['category']."'
																AND ISBN NOT LIKE '".$detail['ISBN']."'
																ORDER BY `SoldCount` DESC";
													$likeRes = mysqli_query($con, $getLike) or die(mysqli_error($con));
													$likeCount = mysqli_num_rows($likeRes);
													if($likeCount == 0){//if there is no books fom the same category
														$getNew = "SELECT * FROM userbook WHERE	ISBN NOT LIKE '".$detail['ISBN']."' 
																	ORDER BY `userbook`.`LaunchDate` DESC";
														$result = mysqli_query($con, $getNew) or die(mysqli_error($con));
														$newCount = mysqli_num_rows($result);
														if($newCount==0)
															echo"<img src=upload/library_no_recommendation.jpg width=534 height=468>";
														else{
															$newRec = mysqli_fetch_array($result);
															echo"<a href=library-single.php?ISBN=".$newRec['ISBN']." title=>
																<img src=bookCovers/".$newRec['ISBN'].".jpg width=534 height=468></a>";
																?>
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                            			<?PHP
															//print book name
															echo"<h4><a href=library-single.php?ISBN=".$newRec['ISBN']." title=>
																	".$newRec['Book Name']."</a>";
														}
													}
													else{
														$likeDet = mysqli_fetch_array($likeRes);
														echo"<a href = library-single.php?ISBN=".$likeDet['ISBN'].">
															 <img src=bookCovers/".$likeDet['ISBN'].".jpg width=534 height = 468>
															 </a>";
												?>
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                            			<?PHP
															//print book name
															echo"<h4><a href=library-single.php?ISBN=".$likeDet['ISBN']." title=>
																	".$likeDet['Book Name']."</a>";
														}
														?>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <?PHP
														$getLike2 = "SELECT * FROM userbook WHERE `authorID` = ".$detail['authorID']."
																	AND ISBN NOT LIKE '".$detail['ISBN']."'
																	ORDER BY `SoldCount` DESC";
														$like2Res = mysqli_query($con, $getLike2) or die(mysqli_error($con));
														$like2Count = mysqli_num_rows($like2Res);
														if($like2Count == 0){//if there is no books from the same author
															$getMostSold = "SELECT * FROM userbook WHERE ISBN NOT LIKE '".$detail['ISBN']."'
															 				ORDER BY `userbook`.`SoldCount` DESC";
															$result = mysqli_query($con, $getMostSold) or die(mysqli_error($con));
															$countSold = mysqli_num_rows($result);
															if($countSold==0)
																echo"<img src=upload/library_no_reecommendation.jpg width=534 height=468>";
															else{
																$mostSoldRec = mysqli_fetch_array($result);
																echo"<a href = library-single.php?ISBN=".$mostSoldRec['ISBN'].">
																<img src=bookCovers/".$mostSoldRec['ISBN'].".jpg width=534 height=468></a>";
																?>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <?PHP
													//print book name
														echo"<h4><a href=library-single.php?ISBN=".$mostSoldRec['ISBN'].">
															".$mostSoldRec['Book Name']."</a>";
														}
														}
														else{
															$like2Det = mysqli_fetch_array($like2Res);
															echo"<a href = library-single.php?ISBN=".$like2Det['ISBN'].">
																 <img src=bookCovers/".$like2Det['ISBN'].".jpg width=534 height = 468>
																 </a>";
														
												?>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <?PHP
													//print book name
                                                	echo"<h4><a href=library-single.php?ISBN=".$like2Det['ISBN'].">
															".$like2Det['Book Name']."</a>";
													}
												?>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                            <?PHP
								//get users review about this book
								$getReviews = "SELECT * FROM bookreviews WHERE ISBN = '".$detail['ISBN']."'";
								$reviewRes = mysqli_query($con, $getReviews) or die(mysqli_error($con));
								$revCount = mysqli_num_rows($reviewRes);
								if($revCount == 0)//no reeviews
									echo"<h4 class=small-title>No Reviews.</h4>";
								else
									echo"<h4 class=small-title>".$revCount." Reviews</h4>";
							?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                        <?PHP
											//get reviews
                                            while($review = mysqli_fetch_array($reviewRes)){
											echo"
											<div class=media>
                                                <a class=media-left>
                                                    <img src=upload/users/".$review['CID'].".jpg class=rounded-circle>
                                                </a>
                                                <div class=media-body>
                                                    <h4 class=media-heading user_name>".$review['FirstName']." ".$review['LastName']."<small>".$review['Date']."</small></h4>
													<h5>".$review['Rating']." stars</h5>
                                                    <p>".$review['Info']."</p>
                                                </div>
                                            </div>";
											}
									
										?>
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end custom-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a Review</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="addReview.php" method="post" class="form-wrapper">
                                        	<select name="slctRating" id="slctRating" class="btn btn-primary">
                                                <option>Pick Rating</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                            </select>
                                            <textarea <?php if(isset($_SESSION['review'])) echo"value=".$_SESSION['review']; ?> name="txtReview" class="form-control" id="txtReview" placeholder="Your review"></textarea>
                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                        </form>
                                        <?php
											if(isset($_GET['error'])){
												if($_GET['error']==1)
													echo"<p align=center style=color:red> Review Not Added, please try again.</p>";
												elseif($_GET['error']==2)
													echo"<p align=center style=color:red> Review Not Updated, please try again.</p>";													
											}
											else if(isset($_GET['res'])){
												if($_GET['res']==1)
													echo"<p align=center style=color:green> Review Added.</p>";
												elseif($_GET['res']==2)
													echo"<p align=center style=color:green> Review Updated.</p>";													
											}
										?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                    
        <div class="dmtop">Scroll to Top</div>
        
    </div><!-- end wrapper -->
    									<?PHP
											}//end else(book found)
											}//end if isbn is set
										?>

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>