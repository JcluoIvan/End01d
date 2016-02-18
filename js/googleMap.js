 (function(keyId) {
    var _key = 'key=' + keyId;
    if (typeof(window.google) == 'undefined' || 
        typeof(window.google.maps) == 'undefined' || 
        typeof(window.google.maps.Map) == 'undefined') {
        if (typeof(initMap) == 'undefined') {
            window.initMap = function() {};
        }
        $.getScript('//maps.googleapis.com/maps/api/js?' + _key + '&callback=initMap');
    }
    var _geocoder = null;
    var _map = null;
    var _marker = null;
    var $element = null;

    var _addMarker = function(location, address) {
        if (_marker) {
            _marker.setMap(null); 
        }
        _map.setCenter(location);
        _marker = new google.maps.Marker({
            position: location,
            map: _map
        });
        $element.trigger('map.marker.change', [_marker, address]);
    };
    var _queryPosition = function(options) {
        gmap.geocoder().geocode(options, function(results, status) {
            if (results && results.length > 0) {
                _addMarker(results[0].geometry.location, results[0].formatted_address);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }


    var gmap = {
        view: function(element, lat, lng, zoom) {
            $element = $(element);
            _map = new window.google.maps.Map(element, {
                center: {lat: lat || 24.136249, lng: lng || 120.70509049999998},
                zoom: zoom || 8
            });
            _map.addListener('click', function(event) {
                _queryPosition({latLng: event.latLng});
            });
        },

        addMarker: function(lat, lng) {
            _queryPosition({latLng: new window.google.maps.LatLng(lat, lng)});
        },
        getMarker: function() {
            return _marker;
        },
        toMarker: function(zoom) {
            if (_marker) {
                _map.setCenter(_marker.getPosition());
                _map.setZoom(zoom || 8);
            }
        },
        resize: function() {
            window.google.maps.event.trigger(_map, 'resize');
        },

        address: function(address) {
            _queryPosition({address: address});
        },
        geocoder: function() {
            return _geocoder || (_geocoder = new window.google.maps.Geocoder());
        }
    };
    window.GMap = gmap;
 })('AIzaSyACyFjdFEpjuvl41hQ4biMXlOEeEPxUaXQ');// 