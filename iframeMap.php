<?php
    $lat = isset($_GET['lat']) ? $_GET['lat']: 0;
    $lng = isset($_GET['lng']) ? $_GET['lng']: 0;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8; nocache">
    <style type="text/css">
        html, body {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map-wrapper {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="map-wrapper" lat="<?= $lat ?>" lng="<?= $lng ?>" />
    <script type="text/javascript">
        var wrapper = document.getElementById('map-wrapper');
        var map = null;
        var marker = null;
        var onMapReady = function() {
            var lat = Number(wrapper.getAttribute('lat'));
            var lng = Number(wrapper.getAttribute('lng'));
            var point = new google.maps.LatLng(lat, lng);
            map = new google.maps.Map(wrapper, {
                center: {lat: lat, lng: lng},
                zoom: 14
            });
            marker =new google.maps.Marker({position: point, map: map});
        };

    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACyFjdFEpjuvl41hQ4biMXlOEeEPxUaXQ&callback=onMapReady"></script>
</body>
</html>