<?php
    include_once("database.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $name = $request->name;	
    $password = $request->password;
    $email = $request->email;
    $dob = $request->dob;
    $num = $request->num;
    $con = mysql_connect('localhost','root','') or die("Cannot connect :" . mysql_error()); 
    mysql_select_db("tracklabs",$con) or die("Can't connect :" . mysql_error()); 
    $sql="INSERT INTO users (user_name,user_pass,user_email,user_dob,user_num)
            VALUES ('$name','$password','$email','$dob','$num')";
    $query=mysql_query($sql);
   if($query)
    die('1');
   else
    die('0');
    mysql_close($con);
?>
