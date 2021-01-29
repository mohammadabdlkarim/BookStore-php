<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Library Website - Register Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <script type="text/javascript">

    </script>
    </head>

<body>
    <?php
		require'library-topbar.php';
		include("library-connection.php");
	?>
         <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="page-wrapper">
                         <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form action="register-action.php" method="post" class="form-wrapper">
                                    <h1 align="center">Registration Page</h1>
                                        <div align="center">
                                          <input name="FirstName" type="text" class="form-control" id="FirstName" placeholder="Your first name">
                                          <input name="LastName" type="text" class="form-control" id="LastName" placeholder="Your last name">
                                          <input name="UserName" type="text" class="form-control" id="UserName" placeholder="User name">
                                          <input type="text" class="form-control" name="Email" id="Email" placeholder="Your Email">
                                          <input name="Address" type="text" class="form-control" id="Address" placeholder="Your Address">
                                          <input name="Phone" type="text" class="form-control" id="Phone" placeholder="Your Phone number">
                                          <input type="password" class="form-control" name="Password" id="Password" placeholder="Password">
                                          <input name="PassConfirm" type="password" class="form-control" id="PassConfirm" placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary" onClick="MM_validateForm('FirstName','','R','LastName','','R','UserName','','R','Email','','R','Address','','R','Phone','','R','Password','','R','PassConfirm','','R');return document.MM_returnValue">Sign Up <i class="fa fa-envelope-open-o"></i></button>
                                        <a href = "library-login.php"> Already Registered? Login</a>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
</body>
</html>
