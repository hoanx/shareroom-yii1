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
    map = new google.maps.Map(document.getElementById('map-canvas-new-room'), mapOptions);

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

                setAddress(results[0].formatted_address, marker);

                /*var address = "", city = "", state = "", zip = "", country = "", formattedAddress = "";
                var lat;
                var lng;
                console.log(results[0]);

                for (var i = 0; i < results[0].address_components.length; i++) {
                    var addr = results[0].address_components[i];
                    // check if this entry in address_components has a type of country
                    if (addr.types[0] == 'country')
                        country = addr.long_name;
                    else if (addr.types[0] == 'street_number') // address 1
                        address = address + addr.long_name + ' ';
                    else if (addr.types[0] == 'street_address') // address 1
                        address = address + addr.long_name + ', ';
                    else if (addr.types[0] == 'establishment')
                        address = address + addr.long_name + ', ';
                    else if (addr.types[0] == 'route')  // address 2
                        address = address + addr.long_name + ', ';
                    else if (addr.types[0] == 'postal_code')       // Zip
                        zip = addr.short_name;
                    else if (addr.types[0] == ['administrative_area_level_1'])       // State
                        state = addr.long_name;
                    else if (addr.types[0] == ['locality'])       // City
                        city = addr.long_name;
                }


                if (results[0].formatted_address != null) {
                    formattedAddress = results[0].formatted_address;
                }

                //debugger;

                var location = results[0].geometry.location;

                lat = location.lat();
                lng = location.lng();

                console.log(address);
                console.log(country);
                console.log('City: '+ city + '\n' + 'State: '+ state + '\n' + 'Zip: '+ zip + '\n' + 'Formatted Address: '+ formattedAddress + '\n' + 'Lat: '+ lat + '\n' + 'Lng: '+ lng);*/


                //set to input address_detail

            }
            else {
                alert('Cannot determine address at this location.' + status).show(100);
            }
        }
    );
}

function setAddress(formatted_address, marker){
    document.getElementById('RoomAddress_address_detail').value =  formatted_address;

    var arrAddress = formatted_address.split(",");
    var countAddress = arrAddress.length
    var city = arrAddress[countAddress-2];
    var district = arrAddress[countAddress-3];
    var address = formatted_address.replace(district + ',', "");
    console.log(address);
    console.log(district);
    console.log(city);
}
