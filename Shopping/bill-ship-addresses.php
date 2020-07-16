<?php
session_start();
//error_reporting(0);
include('includes/config.php');

	if(strlen($_SESSION['login'])==0){   
		header('location:index.php');
	}
	else{
	// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($bd,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
		echo "<script>alert('Billing Address has been updated');</script>";
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($bd,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Shipping Address has been updated');</script>";
		}
	}
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

	    <title>My Account</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">

	</head>
    <body class="cnt-home">
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

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

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="checkout-box inner-bottom-sm">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>1</span>Billing Address
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		
				<div class="col-md-12 col-sm-12 already-registered-login">
		<form class="register-form" role="form" id="billingform" method="post">
			<div class="form-group">
				<label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
				<textarea class="form-control unicase-form-control text-input" name="billingaddress" id="billingaddress" required="required"></textarea>
			</div>
			<div class="form-group">
				<label class="info-title" for="Billing State ">Billing State  <span>*</span></label>
				<input type="text" class="form-control unicase-form-control text-input" id="billingstate" name="billingstate" required="required">
			</div>
			<div class="form-group">
				<label class="info-title" for="Billing City">Billing City <span>*</span></label>
				<input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" required="required" >
			</div>
			<div class="form-group">
				<label class="info-title" for="Billing Pincode">Billing Pincode <span>*</span></label>
				<input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required" >
			</div>
			<button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
		</form>
	</div>	
	<!-- already-registered-login -->		

	</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					    <!-- checkout-step-02  -->
	<div class="panel panel-default checkout-step-02">
		<div class="panel-heading">
		<h4 class="unicase-checkout-title">
			<a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
				 <span>2</span>Shipping Address
			</a>
		</h4>
	</div>
	<div id="collapseTwo" class="panel-collapse collapse">
		<div class="panel-body">			     
					<form class="register-form" role="form" method="post" id="shippingform">
					<div class="form-group">
					    <label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>
					    <textarea class="form-control unicase-form-control text-input" name="shippingaddress" id="shippingaddress" required="required"></textarea>
					</div>
					<div class="form-group">
					    <label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>
			 			<input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" required>
					</div>
					<div class="form-group">
					    <label class="info-title" for="Billing City">Shipping City <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" >
					</div>
 					<div class="form-group">
					    <label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required">
					</div>
					  <button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>
					</form>
						      </div>
						    </div>
					  	</div>
					  	<!-- checkout-step-02  -->
					  	
					</div><!-- /.checkout-steps -->
				</div>
			<?php include('includes/myaccount-sidebar.php');?>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	<?php include('includes/brands-slider.php');?>

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


	<script>
		$(function () {
		getBillingAddress();
		getShippingAddress();
		
//===========================Get all the data from single billing  address==========================
		function getBillingAddress(){
            $.ajax({
                  type: "GET",
                  url: "http://localhost/Mommy-Baby-Online-Shopping/api2/getBillingAddress/" + <?php echo $_SESSION['id'] ?>,
                  dataType: "json",

                  success: function (data, status) {
                     $("#billingstate").val(data.billingState);
                     $("#billingaddress").val(data.billingAddress);
                     $("#billingcity").val(data.billingCity);
                     $("#billingpincode").val(data.billingPincode);   
                                  
                  },
                  error: function () {
					  alert("error");
                     console.log("error");
                  }
               });
        }

//===========================Get all the data from single shipping address=============================
		function getShippingAddress(){
            $.ajax({
                  type: "GET",
                  url: "http://localhost/Mommy-Baby-Online-Shopping/api2/getShippingAddress/" + <?php echo $_SESSION['id'] ?>,
                  dataType: "json",

                  success: function (data, status) {
                     $("#shippingstate").val(data.shippingState);
                     $("#shippingaddress").val(data.shippingAddress);
                     $("#shippingcity").val(data.shippingCity);
                     $("#shippingpincode").val(data.shippingPincode);   
                                  
                  },
                  error: function () {
					  alert("error");
                     console.log("error");
                  }
               });
        }

	});
//===========================Update User billing address =============================
$('#billingform').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);  

            $.ajax({
                type: "PUT",
                url: "http://localhost/Mommy-Baby-Online-Shopping/api2/UpdateBillingAddress/" + <?php echo $_SESSION['id'] ?>,
                dataType: "json",
                data:formData,
                success: function (data, status) {
                    if (data.status=="passed"){
                        alert("Edit succeed");
						getBillingAddress();
                    }
                    else {
                        alert("Edit failed - no record found with the given ID");
                    }
                },
                error: function () {
                    alert("error" + status);
                }
            });
        });

//===========================Update User Shipping address==============================
$('#shippingform').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);  

            $.ajax({
                type: "PUT",
                url: "http://localhost/Mommy-Baby-Online-Shopping/api2/UpdateShippingAddress/" + <?php echo $_SESSION['id'] ?>,
                dataType: "json",
                data:formData,
                success: function (data, status) {
                    if (data.status=="passed"){
                        alert("Edit succeed");
						getShippingAddress();
                    }
                    else {
                        alert("Edit failed - no record found with the given ID");
                    }
                },
                error: function () {
                    alert("error" + status);
                }
            });
        });
	</script>
</body>
</html>
<?php } ?>