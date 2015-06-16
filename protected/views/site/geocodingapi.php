<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/11/15
 */
$baseUrl = Yii::app()->baseUrl;
?>
<style type="text/css">
    #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
    }
    #map-canvas {
        width: 100%;
        height: 500px;
        margin: 0px;
        padding: 0px
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&language=vi&signed_in=true"></script>

<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiBJEvWAxBcYSPW2peUZffQTZcbrjR6AM&sensor=false"></script>-->
<script type="text/javascript" src="<?php echo $baseUrl ?>/js/geocodingapi.js" ></script>

<div style="position: relative; display: block;width: 100%;min-height: 800px">
    <div id="panel">
        <input id="address" type="textbox" value="Tràng thi">
        <input type="button" value="Geocode" onclick="showMarkerAddress(document.getElementById('address').value)">
    </div>
    <div id="map-canvas-new-room"></div>
</div>


<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            initialize();
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>