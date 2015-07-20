<div>
    <?php echo $this->renderPartial('//layouts/_form_search', array());?>
</div>
<hr>
<div id="data">
    <?php echo $this->renderPartial('_search', array('model' => $model), true, true);?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
         initialize();

         jQuery('#form-search').on("keyup keypress", function(e) {
        	  var code = e.keyCode || e.which; 
        	  if (code  == 13) {               
        	    e.preventDefault();
        	    return false;
        	  }
	    });

         jQuery('#search-button').on("click", function(e) {
    	    e.preventDefault();
            var address = document.getElementById('place-desc').value;
            var geocodersearch = new google.maps.Geocoder();
            geocodersearch.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                	var latitude = results[0].geometry.location.lat();
                	var longitude = results[0].geometry.location.lng();
                    document.getElementById('place-lat').value =  latitude;
                    document.getElementById('place-long').value =  longitude;
                    jQuery('#form-search').submit();
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
            	    return false;
                }
            });
	    });
         
         var autocompleteSearch;
         
         function initialize() {
        	    autocompleteSearch = new google.maps.places.Autocomplete((document.getElementById('place-desc')),{ types: ['geocode'] });
        	    google.maps.event.addListener(autocompleteSearch, 'place_changed', searchPlaceChanged);
    	}

         function searchPlaceChanged() {
        		var place = autocompleteSearch.getPlace();
        		if (place.geometry) {
        			document.getElementById('place-lat').value =  place.geometry.location.lat();
        		    document.getElementById('place-long').value =  place.geometry.location.lng();
        		}
    	}
    });
</script>