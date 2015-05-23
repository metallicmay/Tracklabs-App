<?php
include_once("database.php");
$postdata = file_get_contents("php://input");
$data = json_decode($postdata);
    	if (property_exists($data, "selected")) {
		$con = mysql_connect('localhost','root','') or die("Cannot connect :" . mysql_error()); 
		mysql_select_db("tracklabs",$con) or die("Can't connect :" . mysql_error()); 
		$sql="DELETE FROM myplaces WHERE name = '" . $data -> name . "' AND user_email = '" . $data -> email . "'";
		$query=mysql_query($sql);
	}
?>
