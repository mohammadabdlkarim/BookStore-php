<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Contact</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

</head>
<body>
    <?php
		require'library-topbar.php';
		include("library-connection.php");
		$_SESSION['lastPage'] = "library-contact.php";
	?>
 
        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-wrapper">

                            <hr class="invis">

                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form class="form-wrapper" method="post" action="feedback.php">
                                        <input type="text" class="form-control" placeholder="Subject" name="txtSubject">
                                        <textarea class="form-control" placeholder="Your feedback" name="txtFeedback"></textarea>
                                        <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                                    </form>
                                </div>
                            </div>
                            <?php
								if(isset($_GET['res'])){
									if($_GET['res']==0)
										echo"<h4 align=center style=color:red>Something went wrong please try again later.</h4>";
									else
										echo"<h4 align=center style=color:green>Your feedback is sent.</h4>";
								}
							?>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
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
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAkADq7R0xf6ami9YirAM1N-yl7hdnYBhM "></script>
   <!-- MAP & CONTACT -->
    <script src="js/garden-map.js"></script>
</body>
</html>