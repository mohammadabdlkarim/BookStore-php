<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Reading Time - Search</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
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
    <?php
	require'library-topbar.php';
	include("library-connection.php");
?>
        
        <section class="section wb">
    		<div class="container">
    	<?php
			if(isset($_GET['submit-search'])){
				
				$search = $_GET['submit-search'];
				$sql = "SELECT DISTINCT ISBN FROM userbook WHERE `Book Name` LIKE '%".$search."%'
						OR author LIKE '%".$search."%'
						OR category LIKE '%".$search."%'";
				$result = mysqli_query($con, $sql) or die(mysqli_error($con));
				$queryResult = mysqli_num_rows($result);
				
			if($queryResult==0)
					echo"No books matches your search!";
				else{
					echo"<h2>Search Results: ($search)</h2>";
					while($book = mysqli_fetch_array($result)){
						echo"
							 <a href=library-single.php?ISBN=".$book['ISBN'].">
							 <img src= bookCovers/".$book['ISBN'].".jpg width=33% height=468></a>";                            
					}
				}
			}
		?>
        	</div>
        </section>

</body>
</html>