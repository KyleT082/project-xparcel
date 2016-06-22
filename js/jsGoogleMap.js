$(document).ready(function () {
  
  var map;
    var map_marker;
    var marker;
    var lat = null;
    var lng = null;
    var markerSet = false;
  
    // sets your location as default
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) { 
        var locationMarker = null;
        if (locationMarker){
          // return if there is a locationMarker bug
          return;
        }

        lat = position.coords.latitude;
        lng = position.coords.longitude;

        // initialize google maps
        google.maps.event.addDomListener(window, 'load', initialize());
      },
      function(error) {
        console.log("Error: ", error);
      },
      {
        enableHighAccuracy: true
      }
      );
    }   
    
    function initialize() {
      console.log("Google Maps Initialized");
      map = new google.maps.Map(document.getElementById('mapCanvas'), {
        zoom: 15,
        center: {lat: lat, lng : lng, alt: 0},
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControlOptions:{
            style : google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position : google.maps.ControlPosition.TOP_RIGHT
        }
      });

      map_marker = new google.maps.Marker({
        position: {
            lat: lat, 
            lng: lng}, 
            map: map,
            title: "Your current Location",
            icon: 'http://www.poupcash.com.br/aplicativo/assets/img/marker-usuario.png'
        });

     
       //placing marker for users location 
      map_marker.setMap(map);

      //pin package location to the map
        $(document).on("click","#locateBtn",function(){
             if(!markerSet){
                $c = $('#selectMenu').val();
                if($c <=0 ){
                    alert("Please select a package to track");
                }else{
                   //alert($('#selectMenu option:selected').text());
                   packageLocation();
                }
            }else{
                markerSet=false;
                marker.setMap(null);
                $c = $('#selectMenu').val();
                if($c <=0 ){
                    alert("Please select a package to track");
                }else{
                   //alert($('#selectMenu option:selected').text());
                   packageLocation();
                }
            }
          
               
        });

       //setting the map style
       var styles =[
        {
            "featureType": "all",
            "elementType": "labels",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "administrative.province",
            "elementType": "labels.text",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "administrative.locality",
            "elementType": "labels.text",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#a2f05c"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#cccccc"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#b7b3b3"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#a7a8a9"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.text",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#b7b5b5"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "labels.text",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "transit.station.airport",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#e51919"
                }
            ]
        },
        {
            "featureType": "transit.station.airport",
            "elementType": "labels.text",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#45b8eb"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#fefbfb"
                }
            ]
        }];

        map.setOptions({styles: styles});
    }

    $('#locateBtn').button();
    $('#rmveMarkBtn').button();
    $('#selectMenu').change(function(){
        alert("Change happened");
    });
    $('#rmveMarkBtn').click(function(){
        marker.setMap(null);
         window.setTimeout(function(){
                map.panTo(map_marker.getPosition());
            },1500);
    });
    //get the selected package location
    function packageLocation(){

        $.post('php/packLocation.php',{
            method : 'locatePack',
            trackNum : $('#selectMenu option:selected').text()

        },function(data){

            var co_ords = data.split("/");
            $lat = parseFloat(co_ords[0]);
            $lng = parseFloat(co_ords[1]);

            marker = new google.maps.Marker({
                position : {lat:$lat,lng:$lng},
                map:map,
                title: "Tracking Number : " + $('#selectMenu option:selected').text()

            });
            markerSet =true;
            marker.setMap(map);
            window.setTimeout(function(){
                map.panTo(marker.getPosition());
            },1500);
        });
    }

});