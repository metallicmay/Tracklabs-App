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
	  <script data-require="angular.js@1.2.1" data-semver="1.2.1" src="http://code.angularjs.org/1.2.1/angular.js"></script>
      <script data-require="underscore.js@1.5.1" data-semver="1.5.1" src="//cdn.jsdelivr.net/underscorejs/1.5.1/underscore-min.js"></script>
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
		$url = $place['url'];
		$durl = urldecode($url);
		 echo $delim."{ name: '$name', address: '$address', lat: $lat, lng: $lng, url: '$durl'}";
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
	 
	 $scope.allChecked = function () {
      var chk = _.reduce($scope.placedetails, function (item, data) {
       return item + (data.selected ? 1 : 0);
        }, 0);

     return (chk === $scope.placedetails.length);
    };
	 
	 $scope.allClicked = function () {
      var newval = !$scope.allChecked();
    
       _.each($scope.placedetails, function (data) {
       data.selected = newval;
       });
     };
	 
	   $scope.deleterow = function() {
       $scope.placedetails = $scope.placedetails.filter(
		   function(data) {
				var xmlhttp;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
					else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					}
				  }
				xmlhttp.open("POST","delete_row.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send(JSON.stringify(data));
				return !data.selected;
				
				 }
			  );
       }
	   
	   $scope.sharerow = function() {
	   var urls = [];
       angular.forEach($scope.placedetails, function(data) {
	     if(data.selected)
         this.push(data.url);
              },urls);
		var link = "mailto:?"+"&subject="+escape('Link to Google Maps Location')+"&body="+urls;
	    window.location.href=link;
	   }
	   $scope.sendCoord = function(data) {
	   var lati = data.lat;
	   var longi = data.lng;
	   var coords = "";
	   coords += escape(lati) + "," + escape(longi);
	   window.location = 'home.php?' + coords;
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
 </br>
 <div ng-app="search" ng-controller="ctrl">
 <form>
 <input type="text" placeholder= "Search by place name" ng-model="searchname"> 
 </form>
 <div align="right"> <button class= "btn btn-primary" ng-disabled="!selectAll && !isChecked()" ng-click="deleterow($index)"> Delete </button>
  <button class= "btn btn-primary" ng-disabled="!selectAll && !isChecked()" ng-click="sharerow($index)"> Share </button></div>
 </br><table class='table table-bordered table-hover'>
     <tr>
		 <td><input class='col-sm-8' type="checkbox" id ="chckHead" ng-model="selectAll" ng-click="allClicked()" ng-checked="allChecked()"/></td>
		 <th><a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">Place Name <span ng-show="sortType == 'name'" class="fa fa-caret-down"></span></a></th>
		 <th>Address</th>
		 <th>Latitude</th>
		 <th>Longitude</th>
     </tr>
	 <tbody>
      <tr ng-repeat="data in placedetails | orderBy:sortType:sortReverse | filter:searchname">
	    <td><input class ='col-sm-8' type="checkbox" id = "chcktbl" ng-checked="selectAll" ng-model="data.selected"/></td>
        <td><a href="#" ng-click="sendCoord(data)">{{ data.name }}</a></td>
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

  
