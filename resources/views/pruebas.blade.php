
<!DOCTYPE html>
<html>
<body>

<h1>Pintia Map</h1>

<div id="map" style="width:400px;height:400px;background:yellow"></div>

<script>
    function myMap() {

        var myLatlng = new google.maps.LatLng(41.617778,-4.17000);
        var mapOptions = {
            zoom: 12,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Yacimiento arqueológico de Pintia"
        });

// To add the marker to the map, call setMap();
        marker.setMap(map);

    }
</script>

<!--Clave de la API -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD99-qP8UYSTmqE8yU7iDN8_zcNe18ZzyI&callback=myMap"></script>

</body>
</html>