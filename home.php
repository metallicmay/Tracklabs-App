<?php
session_start();
if($_SESSION["name"]) {
echo '<div align=right><a href=logout.php>' . $_SESSION["name"]. '</a></div>';
}
else
{ echo "You have been logged out! Click <a href=login.html> here </a> to log in again.";
}
?>
<html>
<head>
<title>HOME</title>
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
      #map-canvas {
	    
		margin-left: auto;
		margin-right: auto;
		width: 500px;
        height: 400px;
      }
	  #pac-input {
	  margin-left: 430px;
	  
	  }
	  #button {
	  margin-left: 50px;
	  }
	  </style>
    
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(44.5403, -78.5463),
          zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
	
	 var defaultBounds=new google.maps.LatLngBounds(
	 new google.maps.LatLng(-33.8902,151.1759),
	 new google.maps.LatLng(-33.8474,151.2631));
	  
	  var options = {
	  bounds: defaultBounds
	  };
	  
	 var input =document.getElementById('pac-input');
     var searchBox = new google.maps.places.SearchBox(input);
     var markers = [];
	 
	  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location,
        full_address: place.formatted_address
      });

      markers.push(marker);
	
function save(place) 
  {
    console.log(markers[0]);
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
        document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
        }
      }
   var name,addr,lat,lng,url,emailid;
   emailid = <?php echo json_encode($_SESSION["email"]);?> 
   name=markers[0].title;
   addr=markers[0].full_address;
   lat=markers[0].position.A;
   lng=markers[0].position.F;
   url=markers[0].map.mapUrl;
   xmlhttp.open("GET","insert.php?name=" + name + "&address=" + addr + "&lat=" + lat + "&lng=" + lng + "&url=" + url + "&email=" + emailid,true);
   xmlhttp.send();
 
   alert("Place added successfully!");
  }
function share(place) {
 
     console.log(markers[0]);
     var link = "mailto:?"+"&subject="+escape('Link to Google Maps Location')+"&body="+escape(markers[0].map.mapUrl);
	 window.location.href=link;
	 alert('Shared!');
  }  
	  function addInfoWindow(marker, message) {

            var infoWindow = new google.maps.InfoWindow({
                content: message
            });

            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.open(map, marker);
            });
        }
		var placedetails = document.createElement('div');
		placedetails.innerHTML="Options"+ "<br/>";
		var button1 = placedetails.appendChild(document.createElement('input'));
		button1.type='button';
		button1.value='Add to My Places';
		google.maps.event.addDomListener(button1,'click',function() {
		  save(marker);
		  });	
		 
        var button2 = placedetails.appendChild(document.createElement('input'));
		button2.type='button';
		button2.value='Share Location';
		google.maps.event.addDomListener(button2,'click',function() {
		  share(marker);
		  });		  
		
		addInfoWindow(marker,placedetails);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
   
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
 var button = document.getElementById('button'); 
  button.onclick = function() {
    input.value='test';
    input.focus(); 
  }   
 }  
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  </head>
  <body>
    <div id="header"></div>
	<div id="navig">
	<ul class="nav nav-tabs">
  <li class="active"><a href="home.php">HOME</a></li>
  <li><a href="myplaces.php">MY PLACES</a></li>
  </ul>
  </div>
  <input id="pac-input" class="controls" type="text" placeholder="Enter location">	
     <button id="button"> Search </button>
	 <div id="map-canvas"></div>
  </body>
</html>
