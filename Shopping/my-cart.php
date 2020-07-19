<?php 
	session_start();
	error_reporting(0);
	include('includes/config.php');
	//Delete [1]
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

	    <title>My Cart</title>
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
	</head>
    <body class="cnt-home">
		<!-- ============================================== HEADER ============================================== -->
		<header class="header-style-1">
		<?php include('includes/top-header.php');?>
		<?php include('includes/main-header.php');?>
		<?php include('includes/menu-bar.php');?>
		</header>
		<!-- ============================================== HEADER : END ============================================== -->
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<ul class="list-inline list-unstyled">
						<li><a href="#">Home</a></li>
						<li class='active'>Shopping Cart</li>
					</ul>
				</div><!-- /.breadcrumb-inner -->
			</div><!-- /.container -->
		</div><!-- /.breadcrumb -->
		<div class="body-content outer-top-xs">
			<div class="container">
				<div class="row inner-bottom-sm">
					<div class="shopping-cart">
						<div class="col-md-12 col-sm-12 shopping-cart-table ">
							<div class="table-responsive">
								<!-- <form name="cart" method="post"> -->
								<p id="display"></p>
								<table class="table table-bordered" id="tabledata">
									<thead>
										<tr>
											<th class="cart-product-name item">Product Name</th>
											<th class="cart-qty item">Quantity</th>
											<th class="cart-sub-total item">Price Per unit</th>
											<th class="cart-romove item">Remove</th>
										</tr>
									</thead>
									<tbody  style="text-align:center;">
									</tbody>
								</table>
								
								<h4 style="text-align:right;">$Total = RM  <text id="totalAmount"></text> </h4>
								<div style="text-align:center">
								<a href="checkout.php?id=<?php echo $_SESSION['id'] ?>" ><button >Proceed To Payment</button></a>
								</div>
							</div>
						</div>
						<!-- ==================================Cart _End_================================-->
					</div>
				</div> 
			</form>
			<?php echo include('includes/brands-slider.php');?>
		</div>
	</div>
	<?php include('includes/footer.php');?>

	<!-- ==================================Script================================-->
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
					  if (data != null)
					  {
						  if (data.length == 0)
						  {
							document.querySelector('#display').innerHTML = "<h4 style='text-align:center;'>Your shopping Cart is empty</h4> <br><br>";
						  }
						  else{
							var tot = 0;
							for (let x = 0; x < data.length; x++) 
							{
								
								$("#tabledata tbody").append("<tr>" +
								"   <td id='id' style='display:none;'>" + data[x].cartId + "</td>" +
								"   <td>" + data[x].productName + "</td>" +
								"   <td>" + "<input type='number' id='quantityup' name='quantityup' min='0' max='100' step='1'>" +"</td>" +
								"   <td id='price'>" + data[x].price + "</td>" +
								"   <td >" + '<button style="background-color: red;"><a style="color:white;" href="#">REMOVE</a></button>' + "</td>" +
								"</tr>");

								$("#quantityup").val(data[x].quantity);
								var bil = $("#quantityup").val();
								var mul = data[x].price * bil;
								tot += mul;
							}
							document.querySelector('#totalAmount').innerHTML = tot;							
						  }
					  }	 
					  else{						
						document.getElementById('#display').innerHTML = "Your shopping Cart is empty";
					  }                    
                  },
                  error: function () {
                     console.log("error");
                  }
               });
        }
	//=======================RESTFUL API PUT - UPDATE QUANTITY - ===============================
	$('#tabledata tbody').on('click', 'input', function () {
		var parentTR = $(this).parent().parent().parent().parent();
        cartId = parentTR.find('#id').html();
		quantityup = parentTR.find('#quantityup').html();
		$.ajax({
                type: "PUT",
                url: "http://localhost/Mommy-Baby-Online-Shopping/api2/updateCart/" + cartId,
                data: 
				{ 
					quantity: $("#quantityup").val(), 
				},
                success: function (data, status) {
                    if (status == "success"){
                        //alert("Edit succeed");
						location.reload();
                    }
                    else {
                        alert("Edit failed - no record found with the given ID");
                    }
					
                },
                error: function () {
                    alert("error" + status);
                }
            });
	} );	
		
	//=======================RESTFUL API DELETE ITEM ===============================
		$("#tabledata").on("click", "button", function ()
		{
			var parentTR = $(this).parent().parent().parent().parent();
            cartId = parentTR.find('#id').html();
            $.ajax({
                  type: "DELETE",
                  url: "http://localhost/Mommy-Baby-Online-Shopping/api2/deleteItem/" + cartId,
                  dataType: "json",
                  success: function (data,status) {
                     if (status== "success") {                        
                        alert("Item deleted !");
						location.reload();
                     }
                     else {
                        alert("Deletion failed - please try again: " + data.error)
                     }
                  },
                  error: function () {
                     console.log("error");
                  }
               });
        });
		//deleteEnd
	
	});

	
	</script>
</body>
</html>