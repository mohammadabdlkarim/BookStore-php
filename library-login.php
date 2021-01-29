<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Library Website - Login Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
                                    <form action="login-action.php" method="post" class="form-wrapper">
                                        <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="User name or Email">
                                        <input type="password" class="form-control" name="txtPass" id="txtPass" placeholder="Your password">
                                        <button type="submit" name="submit" class="btn btn-primary" onClick="MM_validateForm('txtEmail','','R','txtPass','','R');return document.MM_returnValue">Sign in <i class="fa fa-envelope-open-o"></i></button>
                                        <a href = "library-register.php"> Not Registered? Sign Up</a>
                                    </form>
                                    <?php
									$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
									
									if(strpos($fullUrl, "error=empty") == true) {
										echo "You did not fill in all fields!";
										exit();
									}
									else if(strpos($fullUrl, "error=wrong_username_or_password") == true) {
										echo "Wrong username or password!";
										exit();
									}
									?>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
</body>
</html>
