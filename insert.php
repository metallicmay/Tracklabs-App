<?php
 include_once("database.php");
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$url = $_GET['url'];
$user_email = $_GET['email'];

$urlen=urlencode($url);

$conn=mysql_connect ("localhost", "root","");
if (!$conn) {
  die('Not connected : ' . mysql_error());
}
$db = mysql_select_db("tracklabs", $conn);
if (!$db) {
  die ('Can\'t use db : ' . mysql_error());
}
$sname = mysql_real_escape_string($name);
$saddr = mysql_real_escape_string($address);
$slat = mysql_real_escape_string($lat);
$slng = mysql_real_escape_string($lng);
$surl = mysql_real_escape_string($urlen);
$semail = mysql_real_escape_string($user_email);

$query="INSERT INTO myplaces (name,address,lat,lng,url,user_email)
            VALUES ('$sname','$saddr','$slat','$slng','$surl','$semail')";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
else
{
die('Successfully added');
}
?>

