<?php 
    session_start();
    if(isset($_SESSION['login']) == NULL) 
    {
        echo'<script>alert("please log in first!")</script>';
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Products</title>
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
</head>

<body>

    <div class="head">
        <h2><a class="active" href="http://localhost/Mommy-Baby-Online-Shopping/admin/index.html">ADMIN</a>|<em>Manage Products</em></h2>
         <ul class="nav pull-right">

            <li class="nav-user dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="images/admin.png" class="nav-avatar" width="50" height="50"/>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/main.php">Home</a></li>
                    <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/insertProducts.php">Insert New Product</a></li>
                    <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/Shopping/managecustomer.php">Manage Customer</a></li>
                    <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/registerAdmin.php">Add New Admin</a></li>
                    <li class="divider"></li>
                    <li><a href="http://localhost/Mommy-Baby-Online-Shopping/admin/logout.php">Logout</a></li>
                </ul>
            </li>

        </ul>
        
    </div>

    <div>
        <table border="2" id="productTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Id</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Color</th>
                    <th>Company/Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date Arrive</th>
                    <th>Product Availability</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>

    <!-- JAVASCRIPT SECTION - STARTS HERE  -->
    <script src="script.js"></script>

</body>

</html>