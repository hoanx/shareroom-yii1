<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/3/15
 */
 ?>
<ul id="progressbar">
    <li class="active">
        <?php echo CHtml::link(Yii::t('app', 'Địa chỉ'),
            array(
                'spaces/editlisting',
                'id' => ($model->id),
            ),
            array('class'=>'btn btn-success')
        ); ?>
    </li>

    <li class="<?php echo($step >=2 ? 'active' : '') ?>">
        <?php echo CHtml::link(Yii::t('app', 'Giá'),
            array(
                'spaces/pricing',
                'id' => ($model->id),
            ),
            array('class'=>'btn btn-success')
        ); ?>
    </li>

    <li class="<?php echo($step >=3 ? 'active' : '') ?>">
        <?php echo CHtml::link(Yii::t('app', 'Hình ảnh'),
            array(
                'spaces/photos',
                'id' => ($model->id),
            ),
            array('class'=>'btn btn-success')
        ); ?>
    </li>
</ul>