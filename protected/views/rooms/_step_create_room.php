<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/3/15
 */
 ?>
<ul id="progressbar">
    <li class="active">
        <?php echo Yii::t('app', 'Địa chỉ') ?>
    </li>

    <li class="<?php echo($step >=2 ? 'active' : '') ?>">
        <?php echo Yii::t('app', 'Giá') ?>
    </li>

    <li class="<?php echo($step >=3 ? 'active' : '') ?>">
        <?php echo Yii::t('app', 'Hình ảnh') ?>
    </li>
</ul>