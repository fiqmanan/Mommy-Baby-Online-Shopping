<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "shopping";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysqli_select_db($bd,$mysql_database) or die("Could not select database");

?>

<?php
session_start();
include("api/db.php");
$_SESSION['login']=="";
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>

<script language="javascript">
    document.location="login.php";
</script>