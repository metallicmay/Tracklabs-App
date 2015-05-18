<?php
session_start();
if($_SESSION["name"]) {
echo '<div align=right><a href=logout.php>' . $_SESSION["name"]. '</a></div>';	
}
else
{ echo "You have been logged out! Click <a href=login.html> here </a> to log in again.";
}
?>
<?php
  include_once("database.php");
  $conn=mysql_connect ("localhost", "root","");
  if (!$conn) {
  die('Not connected : ' . mysql_error());
  }
  $db = mysql_select_db("tracklabs", $conn);
  if (!$db) {
  die ('Can\'t use db : ' . mysql_error());
  }
  $emailid = $_SESSION["email"];
  $places = mysql_query("SELECT * from myplaces WHERE user_email = '$emailid'");
  $array = array();
  while($row = mysql_fetch_assoc($places)){
   $array[] = $row;
   }
 mysql_close($conn);
   ?>
<html>
<head>
<title>MY PLACES</title>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
	  #header {
	  
	  margin-top: 0px;
	  width: 100%;
	  }
	  
	  #navig {
	    
	  margin-top: 10%;
	  width: 100%;
	  }
	  </style>
	  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
	  <script type="text/javascript">
	  var place = <?php echo json_encode( $array ) ?>;
	  var app = angular.module("search",[]);
	  app.controller('ctrl',function($scope) {
	  $scope.sortType = 'name';
	  $scope.sortReverse = 'false';
	  $scope.searchName = '';
	  
	  $scope.placedetails = [
	  <?php
	  $delim="";
		foreach($array as $place)
		{
		$name = $place['name'];
		$address = $place['address'];
		$lat = $place['lat'];
		$lng = $place['lng'];
		 echo $delim."{ name: '$name', address: '$address', lat: $lat, lng: $lng }";
		 $delim = ",\n\t";
		}
	  ?>
	  ];
	   $scope.isChecked = function() {
	       var count = 0;
           angular.forEach($scope.placedetails, function (item) {
            if (item.selected) 
			 count += 1;
        });
        if (count!=0) {
    		
			return true
        }
		 return false
	 }
	   $scope.deleterow = function() {
       $scope.placedetails = $scope.placedetails.filter(
       function(data) {
       return !data.selected;
	   <?php
	   include_once("database.php");
       $conn=mysql_connect ("localhost", "root","");
       if (!$conn) {
        die('Not connected : ' . mysql_error());
             }
        $db = mysql_select_db("tracklabs", $conn);
       if (!$db) {
       die ('Can\'t use db : ' . mysql_error());
                    }
        $emailid = $_SESSION["email"];
        $delrow = mysql_query("DELETE from myplaces WHERE user_email = '$emailid' AND ");
        
         mysql_close($conn);
	   ?>
             }
          );
       }
	 });
	 </script>
	  </head>
  <body>
    <div id="header"></div>
	<div id="navig">
	<ul class="nav nav-tabs">
  <li><a href="home.php">HOME</a></li>
  <li class="active"><a href="myplaces.php">MY PLACES</a></li>
  </ul>
 <br></br>
 <div ng-app="search" ng-controller="ctrl">
 <form>
 <input type="text" placeholder= "Search by place name" ng-model="searchname"> 
 </form>
 <div align="right"> <button class= "btn btn-primary" ng-disabled="!isChecked()" ng-click="deleterow($index)" > Delete </button></div>
 <br></br><table class='table table-bordered table-hover'>
     <tr>
     <td><input class='col-sm-8' type="checkbox" id ="chckHead" ng-model="selectAll"/></td>
	 <th><a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">Place Name <span ng-show="sortType == 'name'" class="fa fa-caret-down"></span></a></th>
     <th>Address</th>
	 <th>Latitude</th>
	 <th>Longitude</th>
     </tr>
	 <tbody>
      <tr ng-repeat="data in placedetails | orderBy:sortType:sortReverse | filter:searchname">
	    <td><input class ='col-sm-8' type="checkbox" id = "chcktbl" ng-checked="selectAll" ng-model="data.selected"/></td>
        <td>{{ data.name }}</td>
        <td>{{ data.address }}</td>
        <td>{{ data.lat }}</td>
		<td>{{ data.lng }}</td>
      </tr>
    </tbody>    
	 </table>
 </div>

 
  </div>
  </body>
  </html>

  
