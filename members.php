<?php
require "header.php";

// Connects to your Database
$link = mysqli_connect("localhost", "root", "") or die(mysqli_error());
mysqli_select_db($link, "golfapp") or die(mysqli_error($link));
//checks cookies to make sure they are logged in
if(isset($_COOKIE['ID_my_site']))
{
$username = $_COOKIE['ID_my_site'];
$pass = $_COOKIE['Key_my_site'];
$check = mysqli_query($link, "SELECT * FROM users WHERE username = '$username'")or die(mysqli_error($link));
while($info = mysqli_fetch_array( $check ))
{
//if the cookie has the wrong password, they are taken to the login page
if ($pass != $info['password'])
{ header("Location: login.php");
}
//otherwise they are shown the member area
else
{
	?>

	<div class="member-card-wrapper">

			<div class="member-card-header">

				<img class="profile-pic" src="profilepic.jpeg" alt="User"/>
				<h1 class="username"><?php echo $info["username"];?></h1>

			</div>

			<div class="member-card-content">

				<h3><span class="heavy">Club:</span> <?php echo $info["golfclub"];?> </h3>
    			<h3><span class="heavy">Handicap:</span> <?php echo $info["handicap"];?> </h3>
    			<h3><span class="heavy">Balance:</span> <?php echo $info["balance"];?> </h3>
    			<h3><span class="heavy">Email:</span> <?php echo $info["email"];?> </h3>

			</div>	

			<div class="member-card-footer">

				<a class="button" href="topup.php">Topup</a>
				<a class="button" href="logout.php">Logout</a>

			</div>			

	</div> 

<?php

echo "<a href=logout.php>Logout</a>";
}
}
}
else
//if the cookie does not exist, they are taken to the login screen
{
header("Location: login.php");
}
?>