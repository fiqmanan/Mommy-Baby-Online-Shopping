<?php 
//$_SESSION['login']="anuj.lpu1@gmail.com";
//$_SESSION['id']= "1";
//$_SESSION['username']= "Anuj Kumar";
?>

<div class="top-bar animate-dropdown">
	<div class="container">
		<div class="header-top-inner">
			<div class="cnt-account">
				<ul class="list-unstyled">
					
					<?php if(isset($_SESSION['login']))
					{ ?>
						<li><a href="#"><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']);?></a></li>
					<?php 
					}?>

						<li><a href="my-account.php"><i class="icon fa fa-user"></i>My Account</a></li>
						<li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
						<!-- <li><a href="checkout.php"><i class="icon fa fa-key"></i>Checkout</a></li> -->
	
					<?php if(isset($_SESSION['login'])==0)
    				{ ?>
						<li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
					<?php 
					}

					else
					{ ?>
						<li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
					<?php 
					} ?>

				</ul>
		</div><!-- /.cnt-account -->
		<div class="clearfix"></div>
		</div><!-- /.header-top-inner -->
	</div><!-- /.container -->
</div><!-- /.header-top -->