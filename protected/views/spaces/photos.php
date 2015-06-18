<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/17/15
 */

echo $this->renderPartial('//profile/_menu_profile');
echo $this->renderPartial('_step_edit_room', array(
    'step' => 3,
    'model' => $room,
));
?>

<div class="box box-new-room box-price-room">
    <?php
    echo $this->renderPartial('//rooms/_form_image', array(
        'images' => $images,
        'room' => $room
    ));
    ?>
</div>
