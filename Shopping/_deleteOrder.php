<!--CONNECTION------------------------------------------------------------------>
<?php session_start();include('includes/config.php');?>
<!------------------------------------------------------------------------------>     
<?php

$id = $_GET['id'];
$sql      = "DELETE FROM cart WHERE cartId = '$id'";
$query    = mysqli_query($bd,$sql);
if (!$query) die("SQL query error encountered :".mysqli_error() );

?>

<script>

        window.history.back();
</script>

?>