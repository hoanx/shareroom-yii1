<div id="change-view">
    <?php if(isset($_GET['show']) && $_GET['show'] == 'map') :  ?>
        <?php echo $this->renderPartial('_filter', array('model' => $model, 'ajax' => isset($ajax) ? $ajax : false), true, true);?>
    <?php endif; ?>
	<div class="btn-group pull-right" role="group" aria-label="">
        <a href="<?php echo $this->createUrl('', array_merge($_GET, array('show' => 'list'))) ?>" class="btn btn-default <?php RoomAddress::checkShow('list') ?>">Lựa chọn</a>
        <a href="<?php echo $this->createUrl('', array_merge($_GET, array('show' => 'map'))) ?>" class="btn btn-default <?php RoomAddress::checkShow('map') ?>">Bản đồ</a>
    </div>
    <div class="clearfix"></div>
</div>
<hr>
<div class="row">
    <div class="col-md-4" id="map-image">
        <div class="row">
        <?php 
            $location = array();
            $minprice = 0;
            $maxprice = 0;
            $countAm = RoomAddress::listAmenities();
            $i = 0;
        ?>
        <?php foreach($model as $room) : ?>
            <?php 
                if(isset($room->RoomPrice->price)) {
                    if($minprice == 0) {
                        $minprice =  $room->RoomPrice->price;
                    }
                    
                    if($room->RoomPrice->price > $maxprice) $maxprice = $room->RoomPrice->price;
                    if($room->RoomPrice->price < $minprice) $minprice = $room->RoomPrice->price;
                }
                
                $ams = unserialize($room->amenities);
                if(!empty($ams)) {
                    foreach($ams as $am) {
                        $countAm[$am]++;
                    }
                }

                $text = $room->name;
                $content = CHtml::link($room->name, array('rooms/view', 'id' => $room->id), array('class' => 'marker-link'));
                if(isset($room->RoomPrice->price)) {
                    $content .= '<div>' . number_format($room->RoomPrice->price) . 'VND</div>';
                }
            ?>
            <?php $location[] = array($content, $room->lat, $room->long, $room->id, $text) ; ?>
            <div class="room-search col-md-12" id="room_<?php echo $room->id?>" style="min-height: 220px">
                <div class="img-room" data-room='<?php echo $i ?>'>
                    <?php 
                        $images = $room->RoomImages; 
                        if (!empty($images)) {
                            $image = $images[0];
                            echo CHtml::link(CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name, '', array('class' => 'img-responsive img-show', 'style' => 'height: 170px !important;')), array('rooms/view', 'id' => $room->id));
                        }
                    ?>
                    <div class="money-room">
                        <?php if(isset($room->RoomPrice->price)) echo number_format($room->RoomPrice->price) ?> <sup>VND</sup>
                    </div>
                    <div class="user-room">
                        <a href="<?php echo $this->createUrl('profile/show', array('id'=>$room->Users->id)) ?>">
                            <?php echo CHtml::image(Yii::app()->createUrl('profile/image', array('id'=>$room->Users->id)), '', array('class' => 'img-responsive image-user')) ?>
                        </a>
                    </div>
                </div>
                <h4 style="color: #398fd1;"><?php echo CHtml::link($room->name, array('rooms/view', 'id' => $room->id, 'name' => $room->name))?></h4>
                <h5>
                <?php 
                    $room_type_title = Constant::getRoomType($room->room_type);
                    if($room_type_title  && is_string($room_type_title)) echo $room_type_title . '-';
                    echo $room->district . ' - ' . $room->city;
                    $i++;
                ?>
                </h5>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-8 hidden-xs">
        <div class="search-form">
            <div id="map" style="height: 900px;margin-bottom: 10px;"></div>
	        <?php 
		        if(isset($_GET['price']) && $_GET['price']) {
		            $price = explode(",", $_GET['price']);
		        } else {
		            $price = array($minprice, $maxprice);
		        }
	        ?>
		</div>
    </div>
</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
        	jQuery(function() {
        	    var $sidebar   = jQuery(".search-form"), 
        	        $window    = jQuery(window),
        	        $divheight = jQuery("#map-image").height(),
        	        offset     = $sidebar.offset(),
        	        topPadding = 15;
        	    $window.scroll(function() {
            	    console.log();
        	        if ($window.scrollTop() > offset.top) {
            	        if(($window.scrollTop() + offset.top + topPadding) < $divheight) {
            	        	$sidebar.css('margin-top', $window.scrollTop() - offset.top + topPadding);
            	        }
        	        } else {
            	        $sidebar.css('margin-top', 0);
        	        }
        	    });
        	    
        	});
        	
        	jQuery("input[name='room_type']").change(function() {
            	var room_type = [];
        	    jQuery("input[name='room_type']").each(function () {
            	    if(this.checked) {
            	    	room_type.push(jQuery(this).val());
            	    }
        	    });
        	    setGetParameter('room_type', room_type.join());
        	});

        	jQuery("input[name='amenities']").change(function() {
            	var amenities = [];
        	    jQuery("input[name='amenities']").each(function () {
            	    if(this.checked) {
            	    	amenities.push(jQuery(this).val());
            	    }
        	    });
        	    setGetParameter('amenities', amenities.join());
        	});

        	jQuery("#bedrooms").change(function() {
        	    setGetParameter('bedrooms', jQuery(this).val());
        	});

        	jQuery("#beds").change(function() {
        	    setGetParameter('beds', jQuery(this).val());
        	});

    		jQuery("#range").ionRangeSlider({
                min: <?php echo 20000 ?>,
                max: <?php echo 5000000 ?>,
        	    from: <?php echo $price[0] ?>,
        	    to: <?php echo $price[1] ?>,
                type: 'double',
                step: <?php echo(($maxprice - $minprice)/ 10); ?>,
                postfix: " VND",
                onFinish: function (data) {
                    var price = data.from + ',' + data.to;
                    setGetParameter('price', price);
                },
            });


            jQuery('#form-search').on("keyup keypress", function(e) {
              	  var code = e.keyCode || e.which; 
              	  if (code  == 13) {               
              	    e.preventDefault();
              	    return false;
              	  }
            });
        	
        	var autocompleteSearch;
       	    autocompleteSearch = new google.maps.places.Autocomplete((document.getElementById('place-desc')),{ types: ['geocode'] });
       	    google.maps.event.addListener(autocompleteSearch, 'place_changed', searchPlaceChanged);

            function searchPlaceChanged() {
           		var place = autocompleteSearch.getPlace();
           		if (place.geometry) {
           			document.getElementById('place-lat').value =  place.geometry.location.lat();
           		    document.getElementById('place-long').value =  place.geometry.location.lng();
           		}
           	}

            var locations = <?php echo json_encode($location) ?>;

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: new google.maps.LatLng(<?php echo $_GET['lat']?>, <?php echo $_GET['long']?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;
            var markers = new Array();

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    title: locations[i][4]
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                        goToByScroll('room_' + locations[i][3]);     
                    }
                })(marker, i));

                google.maps.event.addListener(marker, 'rightclick', (function(marker, i) {
                    return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

                markers.push(marker);
            }

            jQuery('.img-room').hover(function(){
                var room = jQuery(this).data('room');
            	google.maps.event.trigger(markers[room], 'rightclick');
            });

            function setGetParameter(paramName, paramValue) {
                var url = window.location.href;
                if (url.indexOf(paramName + "=") >= 0) {
                    var prefix = url.substring(0, url.indexOf(paramName));
                    var suffix = url.substring(url.indexOf(paramName));
                    suffix = suffix.substring(suffix.indexOf("=") + 1);
                    suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
                    url = prefix + paramName + "=" + paramValue + suffix;
                } else {
                    if (url.indexOf("?") < 0) {
                        url += "?" + paramName + "=" + paramValue;
                    } else {
                    	url += "&" + paramName + "=" + paramValue;
                    }
                }
                window.history.pushState("object or string", "Title", url);

                jQuery.ajax({
                    url: url,
            	    context: document.body
            	}).done(function(data) {
            	    jQuery("#data").html(data);
            	});
 
            }

            function goToByScroll(id){
                // Remove "link" from the ID
                  id = id.replace("link", "");
                    // Scroll
                  jQuery('html,body').animate({
                      scrollTop: jQuery("#"+id).offset().top},
                      'slow');
            }
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>