<?PHP
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<title>Untitled Document</title>
	
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive styles for this template -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Colors for this template -->
    <link href="css/colors.css" rel="stylesheet">

    <!-- Version Garden CSS for this template -->
    <link href="css/version/garden.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="wrapper">
        <div class="collapse top-search" id="collapseExample">
            <div class="card card-block">
                <div class="newsletter-widget text-center">
                    <form action="search.php" method="get" class="form-inline">
                        <input name="submit-search" type="text" class="form-control" id="submit-search" placeholder="What you are looking for?">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                </div><!-- end newsletter -->
            </div>
        </div><!-- end top-search -->
        
        <div class="topbar-section">
		   <div class="container-fluid">
				<div class="row">
<?PHP
	if(isset($_SESSION['loggedIn'])){
		include("library-connection.php");
	
		$query = "SELECT * FROM customer WHERE ID = ".$_SESSION['CID'];
		
		$getData= mysqli_query($con, $query) or die(mysqli_error($con));
		?>
		<div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
			<table width="50%"><tr>
            <td><a href = "library-profile.php">
            <span class="glyphicon glyphicon-user"></span>
            <?php
				$row=mysqli_fetch_array($getData);
				echo $row['UserName']."</a></td>";
			?>
            <td><a href = "library-cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart </a></td></tr>
            </table>
		</div><!-- end col -->
	<?php
	}
	else{
		?>
		<div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
        	<table width="40%"><tr>
        	<td><a href = "library-login.php"><span class="glyphicon glyphicon-log-in"></span> Login </a></td>
			<td><a href = "library-register.php"><span class="glyphicon glyphicon-plus"></span> Register</a></td>
            </tr></table>
		</div><!-- end col -->
<?php
		}
?>
                    <div class="col-lg-4 hidden-md-down">
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="topsearch text-right">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                        </div><!-- end search -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end topbar -->
        
        <div class="header-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="logo">
                            <a href="library-index.php"><img src="images/version/library-logo.png" alt=""></a>
                        </div><!-- end logo -->
                    </div>
                </div><!-- end row -->
            </div><!-- end header-logo -->
        </div><!-- end header -->
        
        <header class="header">
            <div class="container">
                <nav class="navbar bg-light navbar-toggleable-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Forest Timemenu" aria-controls="Forest Timemenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center" id="Forest Timemenu">
    					<ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="library-index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="library-wishlistCheck.php">Your Books</a>
                            </li>
                            <li class="nav-item">
                            	<a class="nav-link color-green-hover" href="library-category.php">Categories</a>
                            </li>
                            <li class="nav-item">
                            	<a class="nav-link color-green-hover" href="library-category.php?cat=best Selling">Best Selling</a></li>  
                            <li class="nav-item">
                                <a class="nav-link color-green-hover" href="checkContact.php">Contact</a>
                            </li>
                        </ul>
                    </div>
              </nav>
            </div><!-- end container -->
            </header>
</body>
</html>