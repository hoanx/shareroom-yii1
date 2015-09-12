<?php
/* @var $this CouponController */
/* @var $model Coupon */

echo CHtml::link('<i class="fa fa-arrow-left"></i> '.Yii::t('app', 'Quay lại'),
    $this->createUrl('index'),
    array(
        'class' => 'btn btn-info back-link'
    ));
?>

<div class="row">
    <div class="col-md-7">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'coupon_code',
                array(
                    'name'=>'discount_amount_percent',
                    'value'=>$model->discount_amount_percent.'%'
                ),
                'period',
                'coupon_uses',
                'created',
                'updated',
            ),
            'htmlOptions' => array(
                'class' => 'table table-striped'
            ),
        )); ?>
    </div>
</div>

