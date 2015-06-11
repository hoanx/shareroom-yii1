/**
 * Created by ACV.HoaNX.
 * Date: 6/11/15
 */

var geocoder;
var map;
var default_center = new google.maps.LatLng(21.027689, 105.852274); // center map in Ha Noi
var marker;
var infowindow;
function initialize() {
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 10,
        center: default_center
    }
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    google.maps.event.addListener(map, 'click', function(e) {
        placeMarker(e.latLng, map);
    });
}


function placeMarker(position, map) {
    if(marker) marker.setMap(null);

    map.setCenter(position);
    map.setZoom(14);
    marker = new google.maps.Marker({
        draggable: true,
        position: position,
        map: map
    });

    showInfoWindow(marker);
    /*geocoderAdress = new google.maps.Geocoder();
    geocoderAdress.geocode
    ({
            latLng: marker.getPosition()
        },
        function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (infowindow) infowindow.close();
                //Set info windown on maker
                infowindow = new google.maps.InfoWindow({
                    content: results[0].formatted_address
                });
                infowindow.open(map, marker);
            }
            else {
                alert('Cannot determine address at this location.' + status).show(100);
            }
        }
    );*/

    google.maps.event.addListener(marker, 'dragend', function () {
        showInfoWindow(marker);
        /*geocoderAdressDrag = new google.maps.Geocoder();
        geocoderAdressDrag.geocode
        ({
                latLng: marker.getPosition()
            },
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (infowindow) infowindow.close();
                    //Set info windown on maker
                    infowindow = new google.maps.InfoWindow({
                        content: results[0].formatted_address
                    });
                    infowindow.open(map, marker);
                }
                else {
                    alert('Cannot determine address at this location.' + status).show(100);
                }
            }
        );*/

    });

    google.maps.event.addListener(marker, 'click', function () {
        if (infowindow) infowindow.close();
    });

}


function showMarkerAddress(address) {
    if (geocoder) {
        geocoder.geocode({ 'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                placeMarker(results[0].geometry.location, map);

            } else {
                alert("Geocode was not successful for the following reason: " + status).show(100);
            }
        });
    }
}

function showInfoWindow(marker){
    map.setCenter(marker.getPosition());
    var geocoderAdressDrag = new google.maps.Geocoder();
    geocoderAdressDrag.geocode
    ({
            latLng: marker.getPosition()
        },
        function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (infowindow) infowindow.close();
                //Set info windown on maker
                infowindow = new google.maps.InfoWindow({
                    content: results[0].formatted_address
                });
                infowindow.open(map, marker);
            }
            else {
                alert('Cannot determine address at this location.' + status).show(100);
            }
        }
    );
}
