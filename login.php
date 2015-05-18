<?php
	include_once("database.php");
    session_start();
	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $email = $request->email;
    $password = $request->password;
	$con = mysql_connect('localhost','root','') or die("Cannot connect :" . mysql_error()); 
    mysql_select_db("tracklabs",$con) or die("Can't connect :" . mysql_error());
	$query = mysql_query("SELECT * FROM users WHERE user_email ='".$email."' AND user_pass ='".$password."'") or die(mysql_error());
	$result=mysql_fetch_array($query);
	$_SESSION["name"]=$result['user_name'];
	$_SESSION["email"]=$result['user_email'];
   if($result) {
	 // User login succeeded
		die('1');
	} else {
	 // User login failed
		die('0');
	}
	mysql_close($con);
?>
