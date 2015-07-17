<div class="row">
    <div class="col-md-8">
        <div>
            <label style="margin-right: 20px;">Sắp xếp theo:</label>
            <div class="btn-group" role="group" aria-label="...">
                <a href="<?php echo $this->createUrl('', array_merge($_GET, array('sort' => 'review'))) ?>" class="btn btn-default <?php RoomAddress::checkSort('review') ?>">Lượng giới thiệu</a>
                <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_desc') : ?>
                    <a href="<?php echo $this->createUrl('', array_merge($_GET, array('sort' => 'price_asc'))) ?>" class="btn btn-default <?php RoomAddress::checkSort('price_desc') ?>">Giá <i class="fa fa-arrow-down"></i></a>
                <?php elseif(isset($_GET['sort']) && $_GET['sort'] == 'price_asc'): ?>
                    <a href="<?php echo $this->createUrl('', array_merge($_GET, array('sort' => 'price_desc'))) ?>" class="btn btn-default <?php RoomAddress::checkSort('price_asc') ?>">Giá <i class="fa fa-arrow-up"></i></a>
                <?php else: ?>
                    <a href="<?php echo $this->createUrl('', array_merge($_GET, array('sort' => 'price_desc'))) ?>" class="btn btn-default">Giá <i class="fa fa-arrow-up"></i></a>
                <?php endif; ?>
            </div>
		</div>
        <hr>
        <div class="row">
        <?php 
            $location = array();
            $minprice = 0;
            $maxprice = 0;
            $countAm = RoomAddress::listAmenities();
        ?>
        <?php foreach($model as $room) : ?>
            <?php if($room->distance > Constant::MAX_DISTANCE) break; ?>
            <?php 
                if($minprice == 0) {
                    $minprice =  $room->RoomPrice->price;
                }
                
                if($room->RoomPrice->price > $maxprice) $maxprice = $room->RoomPrice->price;
                if($room->RoomPrice->price < $minprice) $minprice = $room->RoomPrice->price;
                
                
                $ams = unserialize($room->amenities);
                if(!empty($ams)) {
                    foreach($ams as $am) {
                        $countAm[$am]++;
                    }
                }
                    
                
                $content = CHtml::link($room->name, array('rooms/view', 'id' => $room->id), array('class' => 'marker-link'));
                $content .= '<div>' . number_format($room->RoomPrice->price) . 'VND</div>';
            ?>
            <?php $location[] = array($content, $room->lat, $room->long, $room->id) ; ?>
            <div class="room-search col-md-6" id="room_<?php echo $room->id?>">
                <div class="img-room" >
                    <?php 
                        $images = $room->RoomImages; 
                        if (!empty($images)) {
                            $image = $images[0];
                            echo CHtml::link(CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name, '', array('class' => 'img-responsive img-show')), array('rooms/view', 'id' => $room->id));
                        }
                    ?>
                    <div class="money-room">
                        <?php echo number_format($room->RoomPrice->price) ?> <sup>VND</sup>
                    </div>
                    <div class="user-room">
                        <?php if(!empty($room->Users->profile_picture)) : ?>
                            <?php echo CHtml::image($room->Users->profile_picture, '', array('class' => 'img-responsive image-user')) ?>
                        <?php else: ?>
                            <img src="/profile/image" class="img-responsive image-user">
                        <?php endif; ?>
                    </div>
                </div>
                <h4 style="color: #398fd1;"><?php echo CHtml::link($room->name, array('rooms/view', 'id' => $room->id))?></h4>
                <h5>
                <?php 
                    $room_type_title = $room->getRoomType($room->room_type, true);
                    if($room_type_title) echo implode(', ' , $room_type_title) . ' - ';
                    echo $room->district . ' - ' . $room->city;
                ?>
                </h5>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="search-form">
            <h4>Tìm kiếm</h4>
            <div id="map" style="height: 350px;margin-bottom: 10px;"></div>
			<div class="btn-group" data-toggle="buttons">
				<label class="btn btn-info <?php echo RoomAddress::checkRoomtype('entire_home') ?>"><input type="checkbox" autocomplete="off" value="entire_home" name="room_type" <?php echo RoomAddress::checkRoomtype('entire_home', true) ?>> <i class="fa fa-building"></i><br>Cả căn hộ</label> 
				<label class="btn btn-info <?php echo RoomAddress::checkRoomtype('private_room') ?>"> <input type="checkbox" autocomplete="off" value="private_room" name="room_type" <?php echo RoomAddress::checkRoomtype('private_room', true) ?>> <i class="fa fa-user-secret"></i><br>Phòng riêng</label> 
				<label class="btn btn-info <?php echo RoomAddress::checkRoomtype('share_room') ?>"> <input type="checkbox"autocomplete="off" value="share_room" name="room_type" <?php echo RoomAddress::checkRoomtype('share_room', true) ?>> <i class="fa fa-share-alt"></i><br>Phòng chia sẻ</label>
			</div>
			<?php /* 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo Yii::t('app', 'Diện tích') ?></h3>
				</div>
				<div class="panel-body">
	    		    <div class="row">
        			    <div class="col-md-6">
        			        <label><?php echo Yii::t('app', 'Phòng ngủ') ?></label>
        			        <?php echo CHtml::dropDownList('bedrooms', isset($_GET['bedrooms']) ? $_GET['bedrooms'] : null, Constant::listBedRooms(), array('id' => 'bedrooms', 'class' => 'form-control', 'empty' => Yii::t('app', 'Bất kỳ')))?>
        			    </div>
        			    <div class="col-md-6">
        			        <label><?php echo Yii::t('app', 'Giường') ?></label>
        			        <?php echo CHtml::dropDownList('beds', isset($_GET['beds']) ? $_GET['beds'] : null, Constant::listBeds(), array('id' => 'beds','class' => 'form-control', 'empty' => Yii::t('app', 'Bất kỳ')))?>
        			    </div>
        			</div>
				</div>
			</div>
			*/?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo Yii::t('app', 'Giá') ?></h3>
				</div>
				<div class="panel-body">
	    		    <div class="row">
        			    <div class="col-md-12">
        			        <?php 
            			        if(isset($_GET['price']) && $_GET['price']) {
            			            $price = explode(",", $_GET['price']);
            			        } else {
            			            $price = array($minprice, $maxprice);
            			        }
        			        ?>
        			        <input type="text" id="range" value="" name="range" />
        			    </div>
        			</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo Yii::t('app', 'Tiện nghi') ?></h3>
				</div>
				<div class="panel-body">
	    		    <div class="row">
        			    <?php 
        			        if(isset($_GET['amenities']) && $_GET['amenities']) {
        			            $amenities = explode(",", $_GET['amenities']);
        			        } else {
        			            $amenities = array();
        			        }
        			        
        			        $arrayAmenities = Constant::getAmenities();
        			        foreach ($arrayAmenities as $k => $v) :
    			        ?>
        			        <div class="col-md-6">
        			            <div class="checkbox">
        			                <label>
        			                    <input value="<?php echo $k ?>" type="checkbox" name="amenities" <?php if($countAm[$k] == 0) echo 'disabled' ?> <?php if(in_array( $k, $amenities)) echo 'checked' ?>>
        			                    <?php echo $v ?> (<?php echo $countAm[$k] ?>) 
    			                    </label>
    			                </div>
    			            </div>
    			        <?php 
        			        endforeach;
        			    ?>
        			</div>
				</div>
			</div>
		</div>
    </div>
</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
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
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $_GET['lat']?>, <?php echo $_GET['long']?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                    	console.log('aaaaa');
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                        goToByScroll('room_' + locations[i][3]);     
                    }
                })(marker, i));
            }

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
                  $('html,body').animate({
                      scrollTop: $("#"+id).offset().top},
                      'slow');
              }
                       	
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>