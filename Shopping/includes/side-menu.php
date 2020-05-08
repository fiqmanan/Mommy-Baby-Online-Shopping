<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "shopping";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysqli_select_db($bd,$mysql_database) or die("Could not select database");

?>

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
  
        <ul class="nav">
            <li class="dropdown menu-item">
              <?php $sql=mysqli_query($bd,"select id,categoryName  from category");
				while($row=mysqli_fetch_array($sql))
				{
			?>
                <a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>
                <?php echo $row['categoryName'];?></a>
                <?php }?>
                        
</li>
</ul>
    </nav>
</div>