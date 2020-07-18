<?php
session_start();
//error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
	header('location:index.php');
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
<script type="text/javascript">
function valid()
{
if(document.chngpwd.cpass.value=="")
{
alert("Current Password Filed is Empty !!");
document.chngpwd.cpass.focus();
return false;
}
else if(document.chngpwd.newpass.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.newpass.focus();
return false;
}
else if(document.chngpwd.cnfpass.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cnfpass.focus();
return false;
}
else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cnfpass.focus();
return false;
}
return true;
}
</script>

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
	          <span>1</span>My Profile
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		
<h4>Personal info</h4>
				<div class="col-md-12 col-sm-12 already-registered-login">
					<form class="register-form" role="form" method="post" id="personalUpdate" name="personalUpdate">
						<input type="hidden" name="idUser" id="idUser" value="<?php echo $_SESSION['id'] ?>" />
						<div class="form-group">
							<label class="info-title" for="name">Name<span>*</span></label>
							<input type="text" class="form-control unicase-form-control text-input" id="name" name="name" required="required">
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
							<input type="email" class="form-control unicase-form-control text-input" id="email" readonly>
						</div>
						<div class="form-group">
							<label class="info-title" for="Contact No.">Contact No. <span>*</span></label>
							<input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" maxlength="10">
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
						          <span>2</span>Change Password
						        </a>
						      </h4>
						    </div>
						<div id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
						     
					<form class="register-form" role="form" method="post" name="chngpwd" id="chngpwd" onSubmit="return valid();">
						<div class="form-group">
					    	<label class="info-title" for="New Password">New Password <span>*</span></label>
			 				<input type="password" class="form-control unicase-form-control text-input" id="newpass" name="newpass">
					  	</div>
					  	<div class="form-group">
					    	<label class="info-title" for="Confirm Password">Confirm Password <span>*</span></label>
					    	<input type="password" class="form-control unicase-form-control text-input" id="cnfpass" name="cnfpass" required="required" >
					  	</div>
					  	<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Change </button>
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
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
	$(function () {
		getProfile();
		
	//===========================Get all the data from single profile user==========================
		function getProfile(){
            $.ajax({
                  type: "GET",
                  url: "http://localhost/Mommy-Baby-Online-Shopping/api2/getSingleProfile/" + <?php echo $_SESSION['id'] ?>,
                  dataType: "json",

                  success: function (data, status) {
                     $("#id").val(data.id);
                     $("#name").val(data.name);
                     $("#email").val(data.email);
                     $("#contactno").val(data.contactno);   
                                  
                  },
                  error: function () {
                     console.log("error");
                  }
               });
        }
		
	//=================================Update personal data=========================================
		$('#personalUpdate').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);  

            $.ajax({
                type: "PUT",
                url: "http://localhost/Mommy-Baby-Online-Shopping/api2/UpdateProfile/" + <?php echo $_SESSION['id'] ?>,
                dataType: "json",
                data:formData,
                success: function (data, status) {
                    if (data.status=="passed"){
                        alert("Edit succeed");
						getProfile();
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

	//=======================================Update Password============================================
		$('#chngpwd').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            console.log(formData);  

            $.ajax({
                type: "PUT",
                url: "http://localhost/Mommy-Baby-Online-Shopping/api2/UpdatePassword/" + <?php echo $_SESSION['id'] ?>,
                dataType: "json",
                data:formData,
                success: function (data, status) {
                    if (data.status=="passed"){
                        alert("Password Successfull Update");
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
	});
	</script>
</body>
</html>
