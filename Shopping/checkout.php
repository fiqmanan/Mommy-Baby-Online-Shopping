

<?php 
	session_start();

	include('includes/config.php');

	$userID = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Checkout</title>
	    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

	</head>
	<style>
	table {
		border-collapse: collapse;
		width: 100%;
	}

	th, td {
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2}

	th {
		background-color: #c4c4c4;
		color: white;
	}
</style>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>

<!----------------------MENU BAE------------>

<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
					<div class="nav-outer">
						<ul class="nav navbar-nav">
							<li class="active dropdown yamm-fw">
								<a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
						</ul><!-- /.navbar-nav -->
						<div class="clearfix"></div>				
					</div>
				</div>


            </div>
        </div>
    </div>
</div>

<!-----------------------END OF MENU BAR -------------->

</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
				<div class="col-md-12 col-sm-12 shopping-cart-table ">
	
		<!-- <form class="register-form" role="form" method="post" id="proceedPayment" name="proceedPayment" onsubmit="return confirm('Do you really want to proceed the payment?');" enctype="multipart/form-data"> -->
		<form action="_proceedPayment.php" method="POST" onsubmit="return confirm('Do you really want to proceed the payment?');" enctype="multipart/form-data">
				<!--PAYMENT --->
			<div class="main">
				<h5>Please fill in all the required information below to proceed</h5>
				
				<br><br>

				<!--- CUSTOMER DETAIL ---->
				<button type="button" onclick="myFunction('Demo1')" class="w3-button w3-light-grey w3-block w3-left-align " id="clickthis" style="border-bottom: 1px solid #c4c4c4">
					1. Customer Details <div style="float: right;">↓</div>
				</button>
				<div id="Demo1" class="w3-container w3-hide w3-animate-zoom" style="padding-top: 20px; padding-bottom: 40px; border: 1px solid #d9d9d9; border-top: 0px;">
					<table>
						<tr>
							<td style="text-align:right">Full Name :</td>
							<td><input type="text" name="fullName" required></td>
						</tr>
						<tr>
							<td style="text-align:right">NRIC :</td>
							<td><input type="text" name="nric" required></td>
						</tr>
						<tr>
							<td style="text-align:right">Email :</td>
							<td><input type="text" name="email" required></td>
						</tr>
						<tr>
							<td style="text-align:right">Contact Number :</td>
							<td><input type="text" name="contactno" required></td>
						</tr>
					</table>
				</div>

				<!---- PAYMENT METHOD --->
				<button type="button" onclick="myFunction('Demo2')" class="w3-button w3-light-grey w3-block w3-left-align " id="clickthis" style="border-bottom: 1px solid #c4c4c4">
					2. Payment Method <div style="float: right;">↓</div>
				</button>
				<div id="Demo2" class="w3-container w3-hide w3-animate-zoom" style="padding-top: 20px; padding-bottom: 40px; border: 1px solid #d9d9d9; border-top: 0px;">
				  <table>
						<tr>
							<td><a href="https://www.maybank2u.com.my/home/m2u/common/login.do" target="_blank"><img src="img/maybank.png" style="width: 250px; height: 70px"></a></td>
						
							<td><a href="https://www.bankislam.biz/" target="_blank"><img src="img/bankislam.png" style="width: 250px; height: 70px"></a></td>
						
							<td><a href="https://www.cimbclicks.com.my/" target="_blank"><img src="img/cimb.png" style="width: 250px; height: 70px"></a></td>
						</tr>
						
					</table>
				</div>

				<!--- ACCOUNT NUMBER --->
				<button type="button" onclick="myFunction('Demo3')" class="w3-button w3-light-grey w3-block w3-left-align " id="clickthis" style="border-bottom: 1px solid #c4c4c4">
					3. Bank Account <div style="float: right;">↓</div>
				</button>
				<div id="Demo3" class="w3-container w3-hide w3-animate-zoom" style="padding-top: 20px; padding-bottom: 40px; border: 1px solid #d9d9d9; border-top: 0px;">
				  <table>
						<tr>
							<td style="text-align:right">Account No Recipient:</td>
							<td><input type="text" value="75849394" readonly>CIMB</td>
						</tr>
						<tr>
							<td style="text-align:right">Bank Type :</td>
							<td><select name="bank" required="">
								<option>Select Your Bank</option>
								<option value="Maybank">Maybank</option>
								<option value="Bank Islam">Bank Islam</option>
								<option value="Cimb">Cimb</option>
							</select>
						</td>
						</tr>

						<tr>
							<td style="text-align:right">Total Payment (RM) :</td>
							<td><input type="text" name="total" id="totalAmount" readonly></td>
						</tr>
					</table>
				</div>

				<!--- UPLOAD RECEIPT --->
				<button type="button" onclick="myFunction('Demo4')" class="w3-button w3-light-grey w3-block w3-left-align " id="clickthis" style="border-bottom: 1px solid #c4c4c4">
					4. Receipt <div style="float: right;">↓</div>
				</button>
				<div id="Demo4" class="w3-container w3-hide w3-animate-zoom" style="padding-top: 20px; padding-bottom: 40px; border: 1px solid #d9d9d9; border-top: 0px;">
					<div class="form-group" style="text-align:center">
	         		 <label for="exampleInputFile">Select files to upload:
	              	<input type="file" id="exampleInputFile" name="files[]" multiple="multiple"></label>
	              	<p class="help-block"><span class="label label-info">Note:</span> Please, Select the only images (.jpg, .jpeg, .png, .gif)</p>
		            </div>      				
	        	</div>

				<br>
				
				<!-- BRING OLD FORM -->
				<input type="hidden" name="userID"  value="<?php echo $userID?>">
		<!-- 		<input type="hidden" name="sql2" value="<?php echo $sql2?>">
				<input type="hidden" name="sql3" value="<?php echo $sql3?>">
				<input type="hidden" name="orderId" value="<?php echo $orderId?>"> -->

				<!-- BRING OLD FORM -->
				<div style="text-align:center" >
				<input type="submit" class="button buttongreen" value="Proceed To Payment" name="submit">
			</div>

			</div>
		</form>
	</div>
</div>
</div>
</div>
</div>
		
</div>
</div>
<?php include('includes/footer.php');?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	
</body>

<script>
	function myFunction(id) {
		var x = document.getElementById(id);
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
</script>



<script type="text/javascript">
	$(function () {
		getLatestCart();

		//=======================RESTFUL API GET - LIST CART===============================
		function getLatestCart(){			
            $.ajax({
                  type: "GET",
                  url: "http://localhost/Mommy-Baby-Online-Shopping/api2/getlatestcart/" + <?php echo $_SESSION['id'] ?> ,
                  dataType: "json",
                  success: function (data, status) {
					  
						  if (data.length == 0)
						  {
							alert("Cart is Empty. Please Select Item!");
							window.location.href='my-cart.php';
						  }
						  else{
							var tot = 0;
							for (let x = 0; x < data.length; x++) 
							{
								var mul = data[x].price * data[x].quantity;
								tot += mul;
							}
							document.querySelector('#totalAmount').value = tot;							
						  }
					                    
                  },
                  error: function () {
                     console.log("error");
                  }
               });
        }
	

	
	});

	//================================Proceed Payment=========================================
	$('#proceedPayment').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
			console.log(formData);  
			


            $.ajax({
                type: "PUT",
                url: "http://localhost/Mommy-Baby-Online-Shopping/api2/payment/" + <?php echo $_SESSION['id'] ?>,
                dataType: "json",
                data:formData,
                success: function (data, status) {
                    if (data.status=="passed"){
                        alert("Payment Successful");
						getProfile();
                    }
                    else {
                        alert("Payment failed - no record found with the given ID");
                    }
                },
                error: function () {
                    alert("error2" + status);
                }
            });
        });
	
	</script>

</html>