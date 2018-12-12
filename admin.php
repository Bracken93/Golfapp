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
//otherwise they are shown the admin area
else
{
echo "Admin Area<p>";
echo "Your Content<p>";
echo $info["username"];
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