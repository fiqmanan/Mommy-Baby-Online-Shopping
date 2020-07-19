<?php 
	session_start();

	include('includes/config.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
		background-color: #1abc9c;
		color: white;
	}
    * {
            margin: 0;
            padding: 0;
            margin-left: 10px;
            margin-right: 10px;
            box-sizing: border-box;
        }

        body {
            background: white;
        }

        .p {
            margin-left: 10px;
        }

        .head {
            width: 100%;
            color: black;
            margin: 2px;
            padding: 30px;
        }

        .nav-bar {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            width: 100%;
            margin: auto;
        }

        .link {
            text-decoration: none;
            font-size: small;
            font-weight: normal;
            color: wheat;
            text-align: center;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.3), rgba(9, 9, 9, 0.9));
            margin: 1px;
            padding: 10px;
            border-radius: 5px;

        }

        .container {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.3), rgba(9, 9, 9, 0.6));
            width: 100%;
            /* height: 400px; */
            display: none;
            padding: 10px;
            margin: auto;
            margin-left: 2px;
            margin-bottom: 20px;
        }

        .toggle-Lesson {
            display: block;
        }

        /* .toggle-button {
            
        } */

        .btn-def {
            padding: 3px 10px 5px 10px;
            border-radius: 5px;
            /* margin: 10px; */
        }
</style>
<body>

<div class="head">
        <h2><a class="active" href="http://localhost/Mommy-Baby-Online-Shopping/admin/index.html">ADMIN</a>|<em>Manage Payment</em></h2>
         <ul class="nav pull-right">
            <li class="nav-user dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="images/admin.png" class="nav-avatar" width="50" height="50"/>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/index.html">Home</a></li>
                     <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/insertProducts.html">Insert New Product</a></li>
                     <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/Shopping/managecustomer.php">Manage Customer</a></li>
                    <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/register.html">Add New Admin</a></li>
                    <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
        
    </div>

	<!-- slide -->
	<div class="header" >
		
			<div class="main" style="height: 600px">
				
				<h4>Username : [ <?php echo $_GET['id']?> ]</h4>
				
				<a href="javascript:history.back()">
					<button type="button">< Back</button>
				</a>

				<br><br>

                <table border="2" id="productTable" class="table table-bordered">
					<tr>
						<th>No</th>
						<th>Email</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total Price</th>
						<th>Bank</th>
						<th>Receipt Image</th>
						<th>Order</th>
					</tr>

					<?php 
					$userId = $_GET['id'];
					$counter = 0;
					$sql  = "SELECT * FROM 	cart WHERE 	userId = '$userId' AND (paymentStatus = 'Pending' OR paymentStatus = 'Approve')";

					$list = mysqli_query($bd,$sql);

					while ($item = mysqli_fetch_array($list)) {
					$counter++; 
					$cartId = $item['cartId'];
					$userId = $item['userId'];
					?>

						<tr>
							<td><?php echo $counter?></td>
							<td><?php echo $item['email']?></td>
							<td><?php echo $item['productName']?></td>
							<td><?php echo $item['quantity']?></td>
							<td><?php echo $item['price']?></td>
							<td>RM <?php echo number_format((float)$item['total'], 2, '.', '')?></td>
							<td><?php echo $item['bank']?></td>
							<td>
								<?php $url = $item['FilePath']."/".$item['FileName'];
								?>
								<a href="<?php echo $url; ?>"><image src="<?php echo $url; ?>" class="images" style="width: 60px; height: 60px" /></a>
							</td>
							<!-- Pending button -->
							<?php if ($item['paymentStatus'] == "Pending") {?>
							<td>
								<a href="_approveOrder.php?id=<?php echo $item['cartId']?>" 
								onclick="return confirm('Confirm Order approval?');">
								<button style="color:green">Accept </button>
								</a>
								<a href="_deleteOrder.php?id=<?php echo $item['cartId']?>" 
								onclick="return confirm('Do you really want to reject order?');" >
								<button style="color:red">Reject </button>
								</a>
							</td>
							<?php } ?>
							<!-- Approve button -->
							<?php if ($item['paymentStatus'] == "Approve") {?>
							<td>
                                 APPROVED
							</td>
							<?php } ?>
						</tr>

                    <?php }
                    
                  
                    ?>
				</table>
			</div>
		
	</div>




</body>
</html>