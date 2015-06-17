/**
 * Created by ACV.HoaNX.
 * Date: 6/11/15
 */

var geocoder;
var map;
var autocomplete;
var default_center = new google.maps.LatLng(21.027689, 105.852274); // center map in Ha Noi
var infowindow;
var marker;
var componentForm = {
	locality : 'long_name',
	administrative_area_level_1 : 'long_name',
};

function initialize() {
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 10,
        center: default_center
    }
    map = new google.maps.Map(document.getElementById('map-canvas-new-room'), mapOptions);
    
    infowindow = new google.maps.InfoWindow();
    
    if(document.getElementById('lat').value && document.getElementById('lng').value) {
    	marker = new google.maps.Marker({
        	position: new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value),
            map : map,
        	anchorPoint : new google.maps.Point(0, -29)
        });
    	
    	marker.setMap(map);
    } else {
    	marker = new google.maps.Marker({
            map : map,
        	anchorPoint : new google.maps.Point(0, -29)
        });
    }
    

    google.maps.event.addListener(map, 'click', function(e) {
        placeMarker(e.latLng, map);
    });
    
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')));
    google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
}

function onPlaceChanged() {
	infowindow.close();
    marker.setVisible(false);
    
	var place = autocomplete.getPlace();
	if (place.geometry) {
		map.setCenter(place.geometry.location);
		map.setZoom(17);
		
		marker.setIcon(({
			url : place.icon,
			size : new google.maps.Size(71, 71),
			origin : new google.maps.Point(0, 0),
			anchor : new google.maps.Point(17, 34),
			scaledSize : new google.maps.Size(35, 35)
		}));
		marker.setPosition(place.geometry.location);
		marker.setVisible(true);

		var address = '';
		if (place.address_components) {
			address = [
					(place.address_components[0]
							&& place.address_components[0].short_name || ''),
					(place.address_components[1]
							&& place.address_components[1].short_name || ''),
					(place.address_components[2]
							&& place.address_components[2].short_name || '') ]
					.join(' ');
		}

		infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
		infowindow.open(map, marker);
		
		setAddress(document.getElementById('autocomplete').value, marker);
	}
}


function placeMarker(position, map) {
    if(marker) marker.setMap(null);

    map.setCenter(position);
    map.setZoom(17);
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

                setMakerAddress(results[0].formatted_address, marker);

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
    var place = autocomplete.getPlace();
    
    for ( var component in componentForm) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	}

    if(place.address_components) {
    	// Get each component of the address from the place details
    	// and fill the corresponding field on the form.
    	for ( var i = 0; i < place.address_components.length; i++) {
    		var addressType = place.address_components[i].types[0];
    		if (componentForm[addressType]) {
    			var val = place.address_components[i][componentForm[addressType]];
    			document.getElementById(addressType).value = val;
    		}
    	}
    }
	
    var arrAddress = formatted_address.split(",");
    var countAddress = arrAddress.length;
    var city = arrAddress[countAddress-2];
    var district = arrAddress[countAddress-3];
    
    document.getElementById('route').value =  arrAddress[0];
    document.getElementById('lat').value =  place.geometry.location.lat();
    document.getElementById('lng').value =  place.geometry.location.lng();
}

function setMakerAddress(formatted_address, marker) {
	document.getElementById('autocomplete').value =  formatted_address;
	
	geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
			if (results[1]) {
				for ( var component in componentForm) {
					document.getElementById(component).value = '';
					document.getElementById(component).disabled = false;
				}

			    if(results[1].address_components) {
			    	// Get each component of the address from the place details
			    	// and fill the corresponding field on the form.
			    	for ( var i = 0; i < results[1].address_components.length; i++) {
			    		var addressType = results[1].address_components[i].types[0];
			    		if (componentForm[addressType]) {
			    			var val = results[1].address_components[i][componentForm[addressType]];
			    			document.getElementById(addressType).value = val;
			    		}
			    	}
			    }
			} else {
				alert('No results found');
			}
		} else {
			alert('Geocoder failed due to: ' + status);
		}
	});
	
	var arrAddress = formatted_address.split(",");
    var countAddress = arrAddress.length;
    var city = arrAddress[countAddress-2];
    var district = arrAddress[countAddress-3];
    
    document.getElementById('route').value =  arrAddress[0];
    document.getElementById('lat').value =  marker.getPosition().lat();
    document.getElementById('lng').value =  marker.getPosition().lng();
}
